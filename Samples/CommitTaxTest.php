<?php
require('vendor/autoload.php');
//Authentication
//TODO: Modify the account and license key values
//      contained set in Credentials.php with your own
require('Credentials.php');
use AvaTax\CommitTaxRequest;
use AvaTax\SeverityLevel;
use AvaTax\TaxServiceSoap;

$taxSvc = new TaxServiceSoap('Development');
$commitTaxRequest = new CommitTaxRequest();
$commitTaxRequest->setDocCode('INV0029');
$commitTaxRequest->setDocType('SalesInvoice');
$commitTaxRequest->setCompanyCode("APITrialCompany");
try {
  $commitTaxResult = $taxSvc->commitTax($commitTaxRequest);
  echo 'CommitTax ResultCode is: ' . $commitTaxResult->getResultCode() . "\n";

  if ($commitTaxResult->getResultCode() != SeverityLevel::$Success) {
    foreach ($commitTaxResult->getMessages() as $message) {
      echo $message->getName() . ": " . $message->getSummary() . "\n";
    }
  }
} catch (SoapFault $exception) {
  $message = "Exception: ";
  if ($exception) {
    $message .= $exception->faultstring;
  }
  echo $message . "\n";
  echo $taxSvc->__getLastRequest() . "\n";
  echo $taxSvc->__getLastResponse() . "\n   ";
}
