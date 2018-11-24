<?php
function insert_response($jsonMpesaResponse){
    $servername = "localhost";
    $username = "nimcoke";
    $password = "B2Dumd847o";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=nimcoke_passioncafe", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Connected successfully"; 
        }
    catch(PDOException $e)
        {
        echo "Connection failed: " . $e->getMessage();
        }

        try{
            $insert = $conn ->prepare("INSERT INTO `mobile_payments`(
            `TransactionType`,
            `TransID`,
            `TransTime`,
            `TransAmount`,
            `BusinessShortCode`,
            `BillRefNumber`,
            `InvoiceNumber`,
            `ThirdPartyTransID`,
            `MSISDN`, `FirstName`,
            `MiddleName`,
            `LastName`) 
            VALUES(
                :TransactionType,
                :TransID, 
                :TransTime, 
                :TransAmount, 
                :BusinessShortCode, 
                :BillRefNumber, 
                :InvoiceNumber,
                :ThirdPartyTransID,
                :MSISDN,
                :FirstName,
                :MiddleName,
                :LastName
            )");
            $insert -> execute((array)($jsonMpesaResponse));
            
        }
        catch(PDOException $e){
            //transaction not succeful, API ERRORS
            $errLog = fopen('error.txt','a');
            fwrite($errLog, $e -> getMessage());
            fclose($errLog);

            //logging failed transaction or succesful transaction but insert error
            $logFailedTransaction = fopen('failedTransaction.txt', 'a');
            fwrite($logFailedTransaction, json_encode($jsonMpesaResponse));
            fclose($logFailedTransaction);
        }
}

?>