<?php
require('vendor/autoload.php');
//Authentication
//TODO: Modify the account and license key values
//      contained set in Credentials.php with your own
require('Credentials.php');
use AvaTax\GetTaxHistoryRequest;
use AvaTax\DetailLevel;
use AvaTax\DocumentType;
use AvaTax\SeverityLevel;
use AvaTax\TaxServiceSoap;

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
