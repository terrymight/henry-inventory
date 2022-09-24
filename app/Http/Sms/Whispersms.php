<?php

namespace App\Http\Sms;

use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class Whispersms 
{
    /**
     * receives the message & recipients
     * @param $msg 
     * @param $recipients
     * @return status
     */
    public function sendSms(string $campaign_name, string $msg, $recipients)
    {
        $country_code = '234';
        $headers = [
            'Authorization' => 'Api_key gAAAAABi-pVoRHJ7O3D3GjIptLrkDpAG58QDGJS024QAbWWqIO5-KNkYW6SGKilgDDjjz3I3t300azBCYbx8-XD7hey8LWWduxe4I05wR-PlTuCLhLtUP0FJNo1Uyu_twyu07yib9DtTz5eFVujp8RquBhOg1GEybQ==',
            'Content-Type'=> 'application/json; charset=UTF-8',
        ];
        $sender_id = env('APP_NAME');

        foreach($recipients as $recipient)
        {
            $mobile_no = trim($recipient);
            if (substr($mobile_no, 0, 1) !== '0')
            {
                $mobile_no = $country_code .$mobile_no;
            } elseif (substr($mobile_no, 0, 1) == '+') 
            {
                $mobile_no = substr($mobile_no, 1);
            }
            $gsm[] = $mobile_no;
        }

        $req = array(
            'contacts' => $gsm,
            'sender_id' => 'Lidoria',
            'message' => $msg,
            'send_date' =>   date('d-m-Y H:i'),
            'priority_route' => false,
            'campaign_name' => $campaign_name,
        );
        $req = json_encode($req);

        $client = new Client();

        $request = new Request(
            'POST',
            'https://whispersms.xyz/api/send_message/',
            $headers,
            $req
        );
        $res = $client->sendAsync($request)->wait();
        return $res->getStatusCode();
    }
}