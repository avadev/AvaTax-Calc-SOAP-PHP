<?php
require('AvaTax4PHP\AvaTax.php');
//Authentication
//TODO: Replace account and license key with your credentials
new ATConfig('Development', array(
    'url' => 'https://development.avalara.net',
    'account' => '1234567890',
    'license' => 'A1B2C3D4E5F6G7H8',
    'client' => 'AvaTaxSample',
    'name' => '14.2')
);
$taxSvc = new TaxServiceSoap('Development');
$postTaxRequest = new PostTaxRequest();
$postTaxRequest->setCompanyCode("APITrialCompany");
$postTaxRequest->setDocType("SalesInvoice");
$postTaxRequest->setDocCode("INV001");
$postTaxRequest->setDocDate("2014-01-01");
$postTaxRequest->setTotalAmount(175.00);
$postTaxRequest->setTotalTax(14.27);
$postTaxRequest->setCommit(false);
// PostTax and Results
try {
  $postTaxResult = $taxSvc->postTax($postTaxRequest);
  echo 'PostTax ResultCode is: ' . $postTaxResult->getResultCode() . "\n";
// Success - Display GetTaxResults to console
  if ($postTaxResult->getResultCode() != SeverityLevel::$Success) {
    foreach ($postTaxResult->getMessages() as $message) {
      echo $message->getName() . ": " . $message->getSummary() . "\n";
    }
  }
} catch (SoapFault $exception)
    {
    $message = "Exception: ";
    if ($exception)
        {
        $message .= $exception->faultstring;
        }
    echo $message . "\n";
    echo $taxSvc->__getLastRequest() . "\n";
    echo $taxSvc->__getLastResponse() . "\n   ";
    }