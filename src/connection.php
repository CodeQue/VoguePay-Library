<?php
namespace Voguepay;

class connection {

   function encrypt ($data, $publicKey) {
      openssl_public_encrypt($data, $encrypted, $publicKey);
      $encrypteData = bin2hex($encrypted);
      return $encrypteData;
   }

   function connect ($data) {
      global $merchant;
      $data->developer_code = "5cb86b78408f4";
      $payload = 'json='.urlencode(json_encode($data));
      //open curl connection
      $ch = curl_init();
      curl_setopt($ch,CURLOPT_URL, $merchant->api());
      curl_setopt($ch,CURLOPT_HEADER, false);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch,CURLOPT_POSTFIELDS, $payload);
      curl_setopt($ch,CURLOPT_FOLLOWLOCATION,TRUE);
      curl_setopt($ch,CURLOPT_MAXREDIRS,2);
      $receivedResponse = curl_exec($ch);
      curl_close($ch);//close connection
      //Result is json string so we convert into array
      $receivedResponse = substr($receivedResponse, 3);
      //Result is json string so we convert into array
      return(json_decode($receivedResponse,true));
   }
}
$connection = new connection;
?>