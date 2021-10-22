<?php

namespace App\Http\Traits;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

trait SMSTrait
{
    public $client;
    public function __construct()
    {
        $this->client = new \GuzzleHttp\Client(["cookies" => true, 'defaults' => ['verify' => false]]);
    }

    public function sendSms($number, $message)
    {
        return $this->sendTwilioSMS($number, $message);
    }

    function sendVictoryLinkSMS($number, $message)
    {
        $sms = [
            "UserName" => env("VICTORYLINK_USER"),
            "Password" => env("VICTORYLINK_PASSWORD"),
            "SMSText" => $message,
            "SMSLang" => "e",
            "SMSSender" => env("VICTORYLINK_SENDER"),
            "SMSReceiver" => $number
        ];
        Log::info($sms);
        if (app()->environment() === 'production' || app()->environment() === 'development') {
            $res = $this->client->post('https://smsvas.vlserv.com/KannelSending/service.asmx/SendSMSWithDLR', [
                "form_params" => $sms
            ]);
        }

        $response = (string)$res->getBody();

        return $response;
    }

    function sendTwilioSMS($number, $message)
    {
        $sms = [
            "Body" => $message,
            "From" => env("TWILIO_SENDER_PHONE"),
            "To" => "+2" . $number
        ];

        if (app()->environment() === 'production' || app()->environment() === 'development') {
            $SID = env("TWILIO_SID");
            $token = env("TWILIO_TOKEN");
            $res = $this->client->post("https://api.twilio.com/2010-04-01/Accounts/$SID/Messages.json", [
                "form_params" => $sms,
                'auth' => [$SID, $token]
            ]);
        }

        $response = (string)$res->getBody();

        return $response;
    }

    public function checkCredit()
    {
        $credentials = [
            "UserName" => env("VICTORYLINK_USER"),
            "Password" => env("VICTORYLINK_PASSWORD")
        ];

        $res = $this->client->post('https://smsvas.vlserv.com/KannelSending/service.asmx/CheckCredit', [
            "form_params" => $credentials
        ]);


        $response = simplexml_load_string((string)$res->getBody());

        return (string)$response;
    }
}
