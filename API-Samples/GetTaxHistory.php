<?php

require('../AvaTax4PHP/AvaTax.php');
require('../Security/Credentials.php');

$client = new TaxServiceSoap('Development');
$request = new GetTaxHistoryRequest();

$request->setDocCode("");
$request->setCompanyCode(""); // Dashboard Company Code
$request->setDocType(DocumentType::$SalesInvoice);
$request->setDetailLevel(DetailLevel::$Tax);

try {
  $result = $client->getTaxHistory($request);
  echo 'GetTaxHistory ResultCode is: ' . $result->getResultCode() . "\n";
  if ($result->getResultCode() != SeverityLevel::$Success) {
    foreach ($result->getMessages() as $msg) {
      echo $msg->getName() . ": " . $msg->getSummary() . "\n";
    }
  } else {

    echo "Document Date:  " . $result->getGetTaxResult()->getDocDate() . "\n";
    echo "Document Type:  " . $result->getGetTaxResult()->getDocType() . "\n";
    echo "Invoice Number: " . $result->getGetTaxRequest()->getDocCode() . "\n";
    echo "Tax Date:  " . $result->getGetTaxResult()->getTaxDate() . "\n";
    echo "Last Timestamp:  " . $result->getGetTaxResult()->getTimestamp() . "\n";
    echo "Detail:  " . $result->getGetTaxRequest()->getDetailLevel() . "\n";
    echo "Document Status:  " . $result->getGetTaxResult()->getDocStatus() . "\n";
    echo "Total Amount:  " . $result->getGetTaxResult()->getTotalAmount() . "\n";
    echo "Total Taxable:  " . $result->getGetTaxResult()->getTotalTaxable() . "\n";
    echo "Total Tax:  " . $result->getGetTaxResult()->getTotalTax() . "\n";
    echo "Total Discount:  " . $result->getGetTaxResult()->getTotalDiscount() . "\n";
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