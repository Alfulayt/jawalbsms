<?php

namespace Abdualrhmanio\JawalbSms;

use GuzzleHttp\Client;

class JawalbSmsClient
{
    const API_URL = "https://www.jawalbsms.ws/api.php/sendsms";

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



    // public function serializeResponse($body) {
    //     switch ($body) {
    //       case '-100':
    //           return "Missing parameters (not exist or empty) Username + password." ;
    //         break;
    //       case '-110':
    //             return "Account not exist (wrong username or password)." ;
    //         break;
    //       case '-111':
    //           return "The account not activated." ;
    //         break;
    //       case '-112':
    //             return "Blocked account." ;
    //         break;
    //         case '-113':
    //           return "Not enough balance." ;
    //         break;
    //       case '-114':
    //             return "The service not available for now." ;
    //         break;
    //       case '-115':
    //           return "The sender not available (if user have no opened sender)." ;
    //         break;
    //       case '-116':
    //             return "Invalid sender name" ;
    //         break;
    //       case '-120':
    //               return "No destination addresses, or all destinations are not correct" ;
    //         break;
    //
    //       default:
    //              return "unknown Error !";
    //         break;
    //     }
    //
    //
    // }


}
