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
$request = new GetTaxHistoryRequest();
$request->setCompanyCode("APITrialCompany");
$request->setDocType(DocumentType::$SalesInvoice);
$request->setDocCode("INV001");

$request->setDetailLevel(DetailLevel::$Tax);
try
    {
    $result = $client->getTaxHistory($request);
    echo 'GetTaxHistory ResultCode is: ' . $result->getResultCode() . "\n";
    if ($result->getResultCode() != SeverityLevel::$Success)
        {
        foreach ($result->getMessages() as $msg)
            {
            echo $msg->getName() . ": " . $msg->getSummary() . "\n";
            }
        } else
        {
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