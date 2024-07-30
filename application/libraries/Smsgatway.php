<?php
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Smsgatway {
    private $CI = null; 
    function __construct()
    {
        $this->CI =& get_instance();
    }

    function send_sms($contact, $content) {
      // $url = "https://msg.elitbuzz-bd.com/smsapi";
      // $data = [
      //   "api_key" => "C2008248620b60df87b9e5.61085676",
      //   "type" => "text",
      //   "contacts" => $contact,
      //   "senderid" => "8809612472962",
      //   "msg" => $content
      // ];
      // $ch = curl_init();
      // curl_setopt($ch, CURLOPT_URL, $url);
      // curl_setopt($ch, CURLOPT_POST, 1);
      // curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
      // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      // $response = curl_exec($ch);
      // curl_close($ch);
      // return $response;

       $textmessage = urlencode($content);
        
        $smsgatewaydata = "https://smpp.ajuratech.com:7790/sendtext?apikey=a7fbea2f01efa485&secretkey=94e073ce&callerID=1234&toUser=".$contact."&messageContent=".$textmessage;   
        
        $url = $smsgatewaydata;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, false);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);
        echo $output;      

      //echo "none";
    }
}
?>