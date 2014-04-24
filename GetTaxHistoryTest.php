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
$getTaxHistoryRequest = new GetTaxHistoryRequest();
$getTaxHistoryRequest->setCompanyCode("APITrialCompany");
$getTaxHistoryRequest->setDocType(DocumentType::$SalesInvoice);
$getTaxHistoryRequest->setDocCode("INV001");

$getTaxHistoryRequest->setDetailLevel(DetailLevel::$Tax);
try
    {
    $getTaxHistoryResult = $taxSvc->getTaxHistory($getTaxHistoryRequest);
    echo 'GetTaxHistory ResultCode is: ' . $getTaxHistoryResult->getResultCode() . "\n";
    if ($getTaxHistoryResult->getResultCode() != SeverityLevel::$Success)
        {
        foreach ($getTaxHistoryResult->getMessages() as $message)
            {
            echo $message->getName() . ": " . $message->getSummary() . "\n";
            }
        } else
        {
        echo "Document Date:  " . $getTaxHistoryResult->getGetTaxResult()->getDocDate() . "\n";
        echo "Document Type:  " . $getTaxHistoryResult->getGetTaxResult()->getDocType() . "\n";
        echo "Invoice Number: " . $getTaxHistoryResult->getGetTaxRequest()->getDocCode() . "\n";
        echo "Tax Date:  " . $getTaxHistoryResult->getGetTaxResult()->getTaxDate() . "\n";
        echo "Last Timestamp:  " . $getTaxHistoryResult->getGetTaxResult()->getTimestamp() . "\n";
        echo "Detail:  " . $getTaxHistoryResult->getGetTaxRequest()->getDetailLevel() . "\n";
        echo "Document Status:  " . $getTaxHistoryResult->getGetTaxResult()->getDocStatus() . "\n";
        echo "Total Amount:  " . $getTaxHistoryResult->getGetTaxResult()->getTotalAmount() . "\n";
        echo "Total Taxable:  " . $getTaxHistoryResult->getGetTaxResult()->getTotalTaxable() . "\n";
        echo "Total Tax:  " . $getTaxHistoryResult->getGetTaxResult()->getTotalTax() . "\n";
        echo "Total Discount:  " . $getTaxHistoryResult->getGetTaxResult()->getTotalDiscount() . "\n";
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