<?php
  /* access token */
  $consumerkey = 'GbGKA2zZ6Zd5MsJazG1XPNOym6bDuEuV';
	$consumersecret = 'U3MIAc4GygmAXGYK';             # Fill with your app Secret
  $headers = ['Content-Type:application/json; charset=utf8'];
  $access_token_url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
  $curl = curl_init($access_token_url);
  curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($curl, CURLOPT_HEADER, FALSE);
  curl_setopt($curl, CURLOPT_USERPWD, $consumerKey.':'.$consumerSecret);
  $result = curl_exec($curl);
  $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
  $result = json_decode($result);
  $access_token = $result->access_token;
  curl_close($curl);
  /* variables from Test Credentials on your developer account */
  $Initiator = 'testapi251'; 
  $SecurityCredential = 'PZhrFknXmZXuOsxFX6gqv4NKHf/udExm3Vz+RaWyn9RtO3i4G9uQFPJR8AOdceL/DQ9uMb6f29aCkAaI91fwAlaLG/ZO1MnURrugP8+FW4hn8Rjzo8wGbVi9esp1ZsECiaEv53JnG1RSZ2IvTAvg2zANtxW2uASX9rBuPuPPUj7C8LeGZvixNGXiHpxdv4mRh+RL7MS3CO74Hkvw5Yg+C+lSZRX+JAoqtct1gx890gZD8xk3PMQ085o6ZrW5e42mJ+EmDoe5y9VpKEj8Skl+SmVShcIEoM61osPpY8xARsxNLC4RJ4miCfCeY1c3SuADMcaIh8Z8JQcxwQUSHOXPJw==';           # SBase64 encoded string of the Security Credential, which is encrypted using M-Pesa public key
  $CommandID = 'BusinessPayBill';
  $SenderIdentifierType = '4';
  $Amount = '9';
  $PartyA = '600251';
  $PartyB = '600000';
  $AccountReference = 'sm98';
  $Remarks = 'buy stuff online';
  $QueueTimeOutURL = 'http://mfano.nim.co.ke/mpesa/b2bresulturl.php';
  $ResultURL = 'http://mfano.nim.co.ke/mpesa/b2bresulturl.php';
  $b2bHeader = ['Content-Type:application/json','Authorization:Bearer '.$access_token]; 
  /* Main B2B API Call Section */
  $b2b_url = 'https://sandbox.safaricom.co.ke/mpesa/b2b/v1/paymentrequest';
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $b2b_url);
  curl_setopt($curl, CURLOPT_HTTPHEADER, $b2bHeader); //setting custom header
  $curl_post_data = array(
    //Fill in the request parameters with valid values
    'Initiator' => $Initiator,
    'SecurityCredential' => $SecurityCredential,
    'CommandID' => $CommandID,
    'SenderIdentifierType' => $SenderIdentifierType,
    'RecieverIdentifierType' => $SenderIdentifierType,
    'Amount' => $Amount,
    'PartyA' => $PartyA,
    'PartyB' => $PartyB,
    'AccountReference' => $AccountReference,
    'Remarks' => $Remarks,
    'QueueTimeOutURL' => $QueueTimeOutURL,
    'ResultURL' => $ResultURL
  );
  $data_string = json_encode($curl_post_data);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_POST, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
  $curl_response = curl_exec($curl);
  print_r($curl_response);
  echo $curl_response;
?>