<?php
require('../AvaTax4PHP/AvaTax.php');
require('../Security/Credentials.php');
$client = new TaxServiceSoap('Development');
$request = new CancelTaxRequest();
$request->setDocCode('100000');
$request->setDocType('SalesInvoice');
$request->setCompanyCode('');
$request->setCancelCode('DocDeleted');
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
  echo $client->__getLastRequest() . "\n";
  echo $client->__getLastResponse() . "\n";
}
?>