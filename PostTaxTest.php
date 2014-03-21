<?php
require('AvaTax4PHP\AvaTax.php');
//Authentication
//TODO: Replace account and license key with your credentials
new ATConfig('Development', array(
    'url' => 'https://development.avalara.net',
    'account' => '1234567890',
    'license' => 'A1B2C3D4E5F6G7H8')
);
$client = new TaxServiceSoap('Development');
$request = new PostTaxRequest();
$request->setCompanyCode("APITrialCompany");
$request->setDocType("SalesInvoice");
$request->setDocCode("INV001");
$request->setDocDate("2014-01-01");
$request->setTotalAmount(175.00);
$request->setTotalTax(14.27);
$request->setCommit(false);
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
} catch (SoapFault $exception)
    {
    $msg = "Exception: ";
    if ($exception)
        {
        $msg .= $exception->faultstring;
        }
    echo $msg . "\n";
    echo $client->__getLastRequest() . "\n";
    echo $client->__getLastResponse() . "\n   ";
    }