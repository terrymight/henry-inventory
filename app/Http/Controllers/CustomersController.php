<?php

namespace App\Http\Controllers;


use App\Http\Sms\Whispersms;
use App\Models\Application;
use App\Models\customer;
use App\Models\Comments;
use App\Models\DispatcherState;
use App\Models\Product;
use App\Models\state;
use App\Models\User;
use App\Notifications\PushBoardcast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;

use function Ramsey\Uuid\v1;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       if(Auth::user()->role_permission == 2)
       {
            $datas = customer::join('states', 'states.id','=','customers.customer_state')
                    ->join('users', 'users.id', '=','customers.user_id')
                    ->join('dispatcher_state', 'dispatcher_state.state_id', '=', 'customers.customer_state')
                    ->where('customers.dispatcher_id',Auth::user()->id)
                    ->get([
                        'customers.id','customers.fullname','customers.invoice_number','customers.phone_number','customers.products','customers.products_status','customers.total_cost_of_products',
                        'users.name as owned_by',
                        'states.name as customer_state'
                    ]);
       }elseif(Auth::user()->role_permission == 3){
        $datas = customer::join('states', 'states.id','=','customers.customer_state')
                    ->join('users', 'users.id', '=','customers.user_id')
                    ->join('dispatcher_state', 'dispatcher_state.state_id', '=', 'customers.customer_state')
                    ->where('customers.user_id',Auth::user()->id)
                    ->get([
                        'customers.id','customers.fullname','customers.invoice_number','customers.phone_number','customers.products','customers.products_status','customers.total_cost_of_products',
                        'users.name as owned_by',
                        'states.name as customer_state'
                    ]);
       }else{
        $datas = customer::addSelect(
            ['owned_by' => User::select('name')
            ->whereColumn('id', 'customers.user_id')]
            )
            ->addSelect(
                ['customer_state' => state::select('name')
                ->whereColumn('customer_state', 'states.id')]
            )->get();
        }
       // dd($datas);
        return view('customer.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $states = DB::table('states')
            ->join('dispatcher_state', 'dispatcher_state.state_id', '=', 'states.id')
            ->select('states.name as state_name', 'dispatcher_state.user_id', 'dispatcher_state.state_id')
            ->get();
        $data = new customer;
        return view('customer.create', compact(['data', 'states']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response customer
     */
    public function store(Request $request)
    {
        
        // Validate the request...
        $this->validate($request, [
            'fullname' => 'required|max:255',
            'phone_number' => 'required|max:255', 'unique:customers',
            'customer_state' => 'required|max:255',
            'products' => 'required|max:255',
            'date_of_delivery' => 'required|max:255',
            'customer_address' => 'required|max:255',
            'dispatcher_note' => 'required|max:255',
        ]);

        $data = customer::create([
            'fullname' => $request->fullname,
            'phone_number' => $request->phone_number,
            'customer_state' => $request->customer_state[1],
            'products' => $request->products,
            'date_of_delivery' => $request->date_of_delivery,
            'total_cost_of_products' => $this->sum($request),
            'customer_address' => $request->customer_address,
            'dispatcher_note' => $request->dispatcher_note,
            'dispatcher_id' => $request->customer_state[3],
            'user_id' => Auth::user()->id,
            'customer_email' => $request->customer_email,
            'invoice_number' => $this->set_invoice(),
        ]);

        Comments::create([
            'comments_name' => $request->dispatcher_note,
            'invoice_id' => $data->id,
        ]);

        return redirect('/customers/list');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {

        $err = $request->input('err');

        $data = customer::find($id);

        $application = Application::where('id', 1)->first();
        return view('customer.show', compact('data', 'application', 'err'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $states = DB::table('states')
            ->join('dispatcher_state', 'dispatcher_state.state_id', '=', 'states.id')
            ->select('states.name as state_name', 'dispatcher_state.user_id', 'dispatcher_state.state_id')
            ->get();
        $products = Product::all()->sortBy('id');
        $data = customer::where('id', $id)->firstOrFail();
        $input = customer::where('id', $id)->firstOrFail();
        $selected = [];
        $selected['products'] = json_encode($input->products);
        return view('customer.create', compact(['data', 'states', 'products']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        // Validate the request...
        $this->validate($request, [
            'fullname' => 'required|max:255',
            'phone_number' => 'required|max:255',
            'customer_state' => 'required|max:255',
            'products' => 'required|max:255',
            'date_of_delivery' => 'required|max:255',
            'customer_address' => 'required|max:255',
            'dispatcher_note' => 'required|max:255'
        ]);

        $update_req = customer::where('id', $id)->firstOrFail();

        $update_req->fullname = $request->fullname;
        $update_req->customer_email = $request->customer_email;
        $update_req->phone_number = $request->phone_number;
        $update_req->whatsapp_number = $request->whatsapp_number;
        $update_req->customer_state = $request->customer_state[1];
        $update_req->dispatcher_id = $request->customer_state[3];
        $update_req->products = $request->products;
        $update_req->date_of_delivery = $request->date_of_delivery;
        $update_req->total_cost_of_products = $this->sum($request);
        $update_req->customer_address = $request->customer_address;
        $update_req->dispatcher_note = $request->dispatcher_note;


        $update_req->save();
        return redirect()->route('customers.list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $del_req = customer::where('id', $id)->firstOrFail();
        $del_req->delete();
        return redirect()->route('customers.list');
    }

    public function commentDestroy ($id,$user_id)
    {
        //dd('first :'.$id. 'Second :'.$user_id);
        comments::where('id', $id)->delete();
        return redirect('customer/show/'.$user_id);
        // return redirect()->route('customers.notify', [$user_id]);
    }

    public function set_invoice()
    {
        $timestamp = mt_rand(1, time());

        //Format that timestamp into a readable date string.
        $randomDate = date("d M Y", $timestamp);
        $andom = date("Ym") . random_int(10, 50);
        return $andom;
    }

    public function notify (Request $request, $id) 
    {
        
        $data = customer::where('id', $id)->first();
        if($data->customer_email == null ){
        
            $err = 'No e-mail on Customer invoice';
            
            return redirect()->route('customers.notify', compact(['err','id']));
        
        }
        if(!empty($request->email_notification))
        {
           
            Notification::route('mail', [$request->customer_email])
        ->notify(new PushBoardcast($data));
        }

        if(!empty($request->sms_notification))
        {
           // info($request->phone_number);
           $this->sendSms($request);
        }
        $err = 'Invoice sent successfully';
        return redirect()->route('customers.notify', compact(['id','err']));
    }

    public function sum($arr)
    {
        $sum = 0;

        foreach ($arr->products as $num => $values) {
            $sum += $values['px'];
        }

        return $sum;
    }

    public function storeComment (Request $request) 
    {
        $request->validate([
            'comments_name' => 'required|max:255',
        ]);
        Comments::create([
            'comments_name' => $request->comments_name,
            'invoice_id' => $request->invoice_id,
        ]);
        $err = "Comment added to Invoice";
        return redirect('customer/show/'.$request->invoice_id)->with('err', $err);
    }

    public function createComment ($invoice_id)
    {
        $data = null;
        if(!$invoice_id){
            return view('comments.create', compact(['data','invoice_id']));
        }
        $err = 'something want wrong with request, try again';
        return view('comments.create', compact(['err','data','invoice_id']));
    }

    public function changeStatus (Request $request)
    {
        $item = customer::where('id', $request->customer_id)->first();
        $item->products_status = $request->products_status;        
        $item->save();

        $err = "Invoice Status updated";
        return redirect('customer/show/'.$request->customer_id)->with('err', $err);

    }

    private function sendMail($req, $data)
    {
        if(!empty($req->customer_email))
        {
            
             Notification::route('mail', [$req->customer_email => $req->fullname])->notify(new PushBoardcast($data));
             return true;
            
        }else{
            return false;
        }

        // User::chunk(10, function($users){
        //     Notification::route('mail', [$req->customer_email => $req->fullname])->notify(new PushBoardcast($data));
        // });
    }

    private function sendSms($req)
    {
        $smsBody = 'Hello '.$req->fullname .' '.'Your invoice is ready you can view  invoice no. '. $req->invoice_number .' ' . env('APP_URL');
        
        $sendSms = new Whispersms();
        $sendSms->sendSms('invoice sent',$smsBody, $req->phone_number);
    }
}
