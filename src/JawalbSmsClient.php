<?php

namespace AbdualrhmanIO\JawalbSms;

use GuzzleHttp\Client;

class JawalbSmsClient
{
    const API_URL = "http://www.jawalbsms.ws/api.php/sendsms";

    private $client;
    private $headers;
    private $username ;
    private $password ;
    private $senderName;
    private $additionalParams;
    public $configs;


    public function __construct($appId, $restApiKey, $userAuthKey)
    {

        $this->configs = \Config::get('jawalbsms');

        $this->client = new Client();
        $this->headers = ['headers' => []];
        $this->additionalParams = [];
    }



    public function sendSMS($message,$to) {
      $this->username   = $this->configs["Username"];
      $this->password   = $this->configs["Password"];
      $this->senderName = $this->configs["SenderName"];


      if(is_null($message) or !isset($message) or is_null($to) or !isset($to)) {
          throw new \Exception('MESSAGE And TO Number are Require');
      }


        return $this->client->get(self::API_URL,['query' =>
            [
              'user' => $this->username,
              'pass' => $this->password,
              'to'   => $to,
              'unicode' => 'u',
              'message' => $message,
              'sender' => $this->senderName
            ]
         ]);

    }


}
