<?php

namespace App\Http\Controllers;

use App\Http\Sms\Ebulksms;
use App\Http\Sms\Whispersms;
use App\Models\Application;
use App\Models\customer;
use App\Models\Dispatcher;
use App\Models\DispatcherState;
use App\Models\Product;
use App\Models\state;
use App\Models\User;
use App\Notifications\PushBoardcast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $datas = customer::all()->sortBy('id');
        
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
            ->select('states.name as state_name', 'dispatcher_state.user_id as state_id')
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
            'phone_number' => 'required|max:255',
            'customer_state' => 'required|max:255',
            'products' => 'required|max:255',
            'date_of_delivery' => 'required|max:255',
            'customer_address' => 'required|max:255',
            'dispatcher_note' => 'required|max:255'
        ]);

        $data = customer::create([
            'fullname' => $request->fullname,
            'phone_number' => $request->phone_number,
            'customer_state' => $request->customer_state,
            'products' => $request->products,
            'date_of_delivery' => $request->date_of_delivery,
            'total_cost_of_products' => $this->sum($request),
            'customer_address' => $request->customer_address,
            'dispatcher_note' => $request->dispatcher_note,
            'dispatcher_id' => $request->customer_state,
            'customer_email' => $request->customer_email,
            'invoice_number' => $this->set_invoice(),
        ]);

        /**
         * sends user invoice using the 
         * customoer infor
         * @param $request $data
         */
        $this->sendMail($request, $data);
        return redirect('/customers/list');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = customer::where('id', $id)->first();
        $application = Application::where('id', 1)->first();
        return view('customer.show', compact('data', 'application'));
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
            ->select('states.name as state_name', 'dispatcher_state.user_id as state_id')
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
        $update_req->customer_state = $request->customer_state;
        $update_req->dispatcher_id = $request->customer_state;
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
        
        return redirect()->route('customers.notify', $id);
    }

    public function sum($arr)
    {
        $sum = 0;

        foreach ($arr->products as $num => $values) {
            $sum += $values['px'];
        }

        return $sum;
    }

    private function sendMail($req, $data)
    {
        if(!empty($req->customer_email))
        {
            
             Notification::route('mail', [$req->customer_email => $req->fullname])->notify(new PushBoardcast($data));
            
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
