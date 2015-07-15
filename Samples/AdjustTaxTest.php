<?php
require 'vendor/autoload.php';
//Authentication
//TODO: Modify the account and license key values
//      contained set in Credentials.php with your own
require('Credentials.php');
use AvaTax\Address;
use AvaTax\AdjustTaxRequest;
use AvaTax\DetailLevel;
use AvaTax\GetTaxRequest;
use AvaTax\Line;
use AvaTax\SeverityLevel;
//use AvaTax\TaxOverride;
//use AvaTax\TaxOverrideType;
use AvaTax\TaxServiceSoap;

$taxSvc = new TaxServiceSoap('Development');
//GetTaxRequest to be modified (duplicate of an original)
$getTaxRequest = new GetTaxRequest();
//
//Document Level
$getTaxRequest->setCompanyCode("APITrialCompany");
$getTaxRequest->setDocType("SalesInvoice");
$getTaxRequest->setDocCode("INV001");
$getTaxRequest->setDocDate("2014-01-01");
$getTaxRequest->setCustomerCode("ABC4335");

$getTaxRequest->setDetailLevel(DetailLevel::$Tax);
//
//*Situational Request Document Parameters
//
//$getTaxRequest->setSalespersonCode("Bill Sales");
//$getTaxRequest->setCustomerUsageType("G");
//$getTaxRequest->setDiscount(5.00);
//$getTaxRequest->setPurchaseOrderNo("PO123456");
//$getTaxRequest->setExemptionNo("12345");
//$getTaxRequest->setReferenceCode("ref123456");
//$getTaxRequest->setLocationCode("01");
//$getTaxRequest->setCommit(false);
//$getTaxRequest->setDiscount(5.00);
//$getTaxRequest->setCurrencyCode("USD");
//$getTaxRequest->setServiceMode("Automatic");
//$getTaxRequest->setExchangeRate("1.0");
//$getTaxRequest->setExchangeRateEffDate("2013-01-01");
//$getTaxRequest->setPosLaneCode("09");
//$getTaxRequest->setBusinessIdentificationNo(234243);
//
//*TaxOverride at the Document Level
//*Note: TaxOverride can exist at the 
//*      Document Level OR Line Level
//*      Never both at the same time.
//$taxOverride = new TaxOverride();
//$getTaxRequest->setTaxOverride($taxOverride); 
//$taxOverride->setTaxOverrideType(TaxOverrideType::$TaxDate);
//$taxOverride->setTaxAmount(0.00);
//$taxOverride->setReason("Adjustment for return");
//$taxOverride->setTaxDate("2013-07-01");
//
//Origin Address
$address01 = new Address();
$address01->setLine1("45 Fremont Street");
$address01->setLine2("");
$address01->setCity("San Francisco");
$address01->setRegion("CA");
$address01->setPostalCode("94105-2204");
$address01->setCountry("US");
$getTaxRequest->setOriginAddress($address01);
//
//Destination Address
$address02 = new Address();
$address02->setLine1("118 N Clark St");
$address02->setLine2("Suite 100");
$address02->setLine2("ATTN Accounts Payable");
$address02->setCity("Chicago");
$address02->setRegion("IL");
$address02->setPostalCode("60602-1304");
$address02->setCountry("US");
$getTaxRequest->setDestinationAddress($address02);
//
//Third Address
$address03 = new Address();
$address03->setLine1("100 Ravine Lane");
$address03->setLine2("Suite 100");
$address03->setLine2("");
$address03->setCity("Bainbridge Island");
$address03->setRegion("WA");
$address03->setPostalCode("98110");
$address03->setCountry("US");
//Coming Soon
//$address03->setLatitude("47.626930");
//$address03->setLongitude("-122.521004");
$getTaxRequest->setAddressCode($address03);
//
//Set DocumentLevel Addresses
$getTaxRequest->setOriginAddress($address01);
$getTaxRequest->setDestinationAddress($address02);
//
// Line Level 1
$line1 = new Line();
$line1->setNo(1);
$line1->setItemCode("N543");
$line1->setDescription("Red Size 7 Widget");
$line1->setQty(1);
$line1->setAmount(10);
$line1->setTaxCode("NT");
//
//*Situational Request Line Parameters
//$line1->setDiscounted(true);
//$line->setTaxIncluded(true);
//$line1->setRevAcct("");
//$line1->setRef1("ref123");
//$line1->setRef2("ref456");
//$line1->setExemptionNo("12345");
//$line1->setCustomerUsageType("L");
//
//*TaxOverride at the line level
//*Note:    TaxOverride can exist at the 
//*         Document Level OR Line Level
//*         Never both at the same time.
//
//$taxOverride = new TaxOverride();
//$line1->setTaxOverride($taxOverride); 
//$taxOverride->setTaxOverrideType(TaxOverrideType::$TaxDate);
//$taxOverride->setTaxAmount(0.00);
//$taxOverride->setReason("Adjustment for return");
//$taxOverride->setTaxDate("2013-07-01");
//
// Line Level 2
$line2 = new Line();
$line2->setNo(2);
//Set Line Level Address
$line2->setOriginAddress($address01);
$line2->setDestinationAddress($address03);
$line2->setItemCode("T345");
$line2->setDescription("Size 10 Green Running Shoe");
$line2->setQty(3);
$line2->setAmount(150);
$line2->setTaxCode("PC030147");
//
// Line Level 3
$line3 = new Line();
$line3->setNo(3);
//Set Line Level Address
$line3->setOriginAddress($address01);
$line3->setDestinationAddress($address03);
$line3->setItemCode("FREIGHT");
$line3->setDescription("Shipping Charge");
$line3->setQty(1);
$line3->setAmount(15);
$line3->setTaxCode("FR");
//
//Compile all three lines into an array
$getTaxRequest->setLines(array($line1, $line2, $line3));
//
// Adjustment Results
//
$adjustTaxRequest = new AdjustTaxRequest();
$adjustTaxRequest->setAdjustmentReason(4);
$adjustTaxRequest->setAdjustmentDescription("");
$adjustTaxRequest->setGetTaxRequest($getTaxRequest);
//$adjustTaxResult = $taxSvc->AdjustTax($adjustTaxRequest);
try {
  $adjustTaxResult = $taxSvc->AdjustTax($adjustTaxRequest);
  echo 'GetTax is: ' . $adjustTaxResult->getResultCode() . "\n";
// Error Trapping
  if ($adjustTaxResult->getResultCode() == SeverityLevel::$Success) {
//Document Level Results
    echo "DocCode: " . $adjustTaxResult->getDocCode() . "\n";
    echo "DocStatus: " . $adjustTaxResult->getDocStatus() . "\n";
    echo "TotalAmount: " . $adjustTaxResult->getTotalAmount() . "\n";
    echo "TotalTax: " . $adjustTaxResult->getTotalTax() . "\n";
//Line Level Results (from TaxLines array class)
    foreach ($adjustTaxResult->getTaxLines() as $currentTaxLine) {
      echo "     Line: " . $currentTaxLine->getNo() .
      " Tax: " . $currentTaxLine->getTax() .
      " TaxCode: " . $currentTaxLine->getTaxCode() . "\n";
//Line Level Results
      foreach ($currentTaxLine->getTaxDetails() as $currentTaxDetail) {
        echo "          Juris Type: " . $currentTaxDetail->getJurisType() .
        "; Juris Name: " . $currentTaxDetail->getJurisName() .
        "; Rate: " . $currentTaxDetail->getRate() .
        "; Amt: " . $currentTaxDetail->getTax() . "\n";
      }
      echo"\n";
    }
// If NOT success - display error messages to console     
  } else {
    foreach ($adjustTaxResult->getMessages() as $message) {
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
