<?php

namespace App\Http\Controllers;

use App\Http\Sms\Whispersms;
use App\Models\customer;
use Illuminate\Http\Request;

class SmsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $leads = $request->input('ans');
        
        return view('administrator.sms.index', compact('leads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * send a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function send(Request $request)
    {
        $select_type = customer::where('products_status', $request->product_status)->get();

        foreach ($select_type as $phone_no) {
            $phone_num[] = $phone_no->phone_number;
        }
        if (!empty($phone_num)) {
            $leads = $this->sendBulkSms($phone_num, $request->sms_body);
            if ($leads == 201) {
                $ans = 'The request has succeeded';
                return redirect()->route('sms.index', compact('ans'));
            } else {
                $ans = 'Unsucceeful, something went wrong';
                return redirect()->route('sms.index', compact('ans'));
            }
        }else{
            $ans = 'Customers Selected Types is empty';
            return redirect()->route('sms.index', compact('ans'));
        }
    }


    private function sendBulkSms($phone_num, $sms_body)
    {
        $sendSms = new Whispersms();
        $reponse = $sendSms->sendSms('test campaign', $sms_body, $phone_num);
        return $reponse;
    }
}
