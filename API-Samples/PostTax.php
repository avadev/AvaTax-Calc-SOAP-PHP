<?php

require('../AvaTax4PHP/AvaTax.php');
require('../Security/Credentials.php');
$client = new TaxServiceSoap('Development');
$request = new PostTaxRequest();
$request->setCompanyCode("");
$request->setDocType("SalesInvoice");
$request->setDocCode("10000");
$request->setDocDate("2013-12-18");
$request->setTotalAmount(100.00);
$request->setTotalTax(8.6);
$request->setCommit(FALSE);
// PostTax and Results
try {
  $result = $client->postTax($request);
  echo 'PostTax ResultCode is: ' . $result->getResultCode() . "\n";
// Success - Display GetTaxResults to console
  if ($result->getResultCode() != SeverityLevel::$Success) {
    foreach ($result->getMessages() as $msg) {
      echo $msg->getName() . ": " . $msg->getSummary() . "\n";
    }
  }
// If NOT success - display error or warning messages to console
} catch (SoapFault $exception) {
  $msg = "Exception: ";
  if ($exception)
    $msg .= $exception->faultstring;
  echo $msg . "\n";
  echo $client->__getLastRequest() . "\n";
  echo $client->__getLastResponse() . "\n";
}
?>