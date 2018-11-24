<?php
//acces token
        $consumerkey = 'FwmpiGjAETs9YqE5gXOVwLBQkJMv7lHq';
        $consumersecret = 'NEmjGgX8eHGxUHMz';
        $headers =['Content-Type:application/json; charset=utf8'];
        $access_token_url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
        $curl = curl_init($access_token_url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_HEADER, FALSE);
        curl_setopt($curl, CURLOPT_USERPWD, $consumerkey. ':'.$consumersecret);
        $result = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $result = json_decode($result);
        $access_token = $result->access_token;
        //echo $access_token;
        curl_close($curl); 
//variables
    $url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
    $BusinessShortCode = '174379';
    $TimeStamp = date('YmdGis');
    $Amount = '10';
    $PartyA = '254700551212';
    $PassKey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';
    $CallBackURL = 'http://mfano.nim.co.ke/mpesa/callbackurl.php';
    $Password = base64_encode($BusinessShortCode.$PassKey.$TimeStamp);
    $AccountReference = 'Trans001';
    $TransactionDesc = 'Buy goods online';
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$access_token));
  $curl_post_data = array(
    //Fill in the request parameters with valid values
    'BusinessShortCode' => '$BusinessShortCode ',
    'Password' => '$Password ',
    'Timestamp' => '$TimeStamp ',
    'TransactionType' => 'CustomerPayBillOnline',
    'Amount"' => '$Amount ',
    'PartyA' => ' $PartyA',
    'PartyB' => '$BusinessShortCode ',
    'PhoneNumber' => ' $PartyA',
    'CallBackURL' => '$CallBackURL',
    'AccountReference' => ' $AccountReference',
    'TransactionDesc' => ' $TransactionDesc'
  );

    $data_string = json_encode($curl_post_data);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

    $curl_response = curl_exec($curl);
    print_r($curl_response);

    echo $curl_response;
?>