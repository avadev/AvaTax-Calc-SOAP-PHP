<?php

require('../AvaTax4PHP/AvaTax.php');            // location of the AvaTax.PHP Classes - Required
require('../Security/Credentials.php');        // where service URL, account, license key are set

$client = new TaxServiceSoap('Development');
$request = new CancelTaxRequest();
$request->setDocCode('100000');
$request->setDocType('SalesInvoice');
$request->setCompanyCode('DEFAULT'); // Dashboard Company Code
$request->setCancelCode('DocDeleted'); //DocDeleted or PostFailed
try {

    $result = $client->cancelTax($request);
    echo 'CancelTax ResultCode is: ' . $result->getResultCode() . "\n";

    if ($result->getResultCode() != "Success") {
        foreach ($result->getMessages() as $msg) {
            echo $msg->getName() . ": " . $msg->getSummary() . "\n";
        }
    }
} catch (SoapFault $exception) {
    $msg = "Exception: ";
    if ($exception)
        $msg .= $exception->faultstring;

    echo $msg . "\n";
//}   //UN-comment this line to return SOAP XML
    echo $client->__getLastRequest() . "\n";
    echo $client->__getLastResponse() . "\n";
}   //Comment this line to return SOAP XML
?>