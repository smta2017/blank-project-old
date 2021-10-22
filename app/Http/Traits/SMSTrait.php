<?php

namespace App\Http\Traits;

use GuzzleHttp\Client;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

trait SMSTrait
{
    public $clint_header;
    public $clint_body;
    public $clint_form_params;
    public $clint_url;
    public $clint_method;

    public function _send()
    {
        $client = new Client();
        $res = $client->request($this->clint_method, $this->clint_url, $this->clint_form_params, $this->clint_header, $this->clint_body);
        return $res->getBody();
    }


    public function sendSms($number, $message)
    {
        return $this->sendTwilioSMS($number, $message);
    }
 
    public function sendTwilioSMS($number, $message)
    {
        $sms = [
            "Body" => $message,
            "From" => env("TWILIO_SENDER_PHONE"),
            "To" => "+2" . $number
        ];

        if (app()->environment() === 'production' || app()->environment() === 'development' || app()->environment() === 'local') {
            $SID = env("TWILIO_SID");
            $token = env("TWILIO_TOKEN");

            $this->clint_method = 'post';
            $this->clint_url = 'https://api.twilio.com/2010-04-01/Accounts/' . $SID . '/Messages.json';
            $this->clint_form_params = [
                "form_params" => $sms,
                'auth' => [$SID, $token]
            ];
            $res = ($this->_send());
        }

        return $res;
    }
}
