<?php

namespace App\Http\Sms;

use App\Exceptions\CustomException;

class Ebulksms
{
    public function sendSingleSms($msg, $recipients)
    {

        $country_code = '234';
        $arr_recipient = explode(',', $recipients);
        foreach ($arr_recipient as $recipient) {
            $mobilenumber = trim($recipient);
            if (substr($mobilenumber, 0, 1) == '0') {
                $mobilenumber = $country_code . substr($mobilenumber, 1);
            } elseif (substr($mobilenumber, 0, 1) == '+') {
                $mobilenumber = substr($mobilenumber, 1);
            }
            $generated_id = uniqid('int_', false);
            $generated_id = substr($generated_id, 0, 30);
            $gsm['gsm'][] = array('msidn' => $mobilenumber, 'msgid' => $generated_id);
        }
        $sms = array(
            "sender" => env('APP_NAME'),
            'messagetext' => $msg,
            'flash' => 0,
        );
        $req = array('SMS' => array(
            'auth' => array(
                'username' => env('API_USER_NAME'),
                'apikey' => env('API_KEY'),
            ),
            'message' => $sms,
            'recipients' => $gsm,
        ));

       
        info($req);
        $json_data = json_encode($req);
        if ($json_data) {
            $response =  $this->sendRequest($json_data, array('Content-Type: application/json'));
            $results = json_decode($response);
            return $results;
        } else {
            return false;
        }
    }

    private function sendRequest($body, $headers = array('Content-Type: application/x-www-form-urlencoded'))
    {
        $response = array('code' => '', 'body' => '');
        $url = env('API_HTTP_URL');
        $data = $body;
        if (is_array($body)) {
            $data = http_build_query($body, '', '&');
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);

        try {
            $response['body'] = curl_exec($ch);
            $response['code'] = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if ($response['code'] != '200') {
                throw new CustomException("Problem reading data from $url");
            }
            curl_close($ch);
        } catch(CustomException $e) {
            info('cURL error: ' . $e->getMessage());
        }

        return $response['body'];
    }
}
