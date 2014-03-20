<?php
require('AvaTax4PHP\AvaTax.php');
//Authentication
//TODO: Replace sample account and license key with your credentials
new ATConfig('Development', array(
    'url' => 'https://development.avalara.net',
    'account' => '1234567890',
    'license' => 'A1B2C3D4E5F6G7H8')
);
$client = new TaxServiceSoap('Development');
$request = new GetTaxRequest();
//
//Document Level
$request->setCompanyCode("APITrialCompany");
$request->setDocType("SalesInvoice");
$request->setDocCode("INV001");
$request->setDocDate("2014-01-01");
$request->setCustomerCode("ABC4335");
$request->setDetailLevel(DetailLevel::$Tax);
//
//*Situational Request Document Parameters
//
//$request->setSalespersonCode("Bill Sales");
//$request->setCustomerUsageType("G");
//$request->setDiscount(5.00);
//$request->setPurchaseOrderNo("PO123456");
//$request->setExemptionNo("12345");
//$request->setReferenceCode("ref123456");
//$request->setLocationCode("01");
//$request->setCommit(false);
//$request->setDiscount(5.00);
//$request->setCurrencyCode("USD");
//$request->setServiceMode("Automatic");
//$request->setExchangeRate("1.0");
//$request->setExchangeRateEffDate("2013-01-01");
//$request->setPosLaneCode("09");
//$request->setBusinessIdentificationNo(234243);
//
//*TaxOverride at the Document Level
//*Note: TaxOverride can exist at the 
//*      Document Level OR Line Level
//*      Never both at the same time.
//$taxOverride = new TaxOverride();
//$request->setTaxOverride($taxOverride); 
//$taxOverride->setTaxOverrideType(TaxOverrideType::$TaxDate);
//$taxOverride->setTaxAmount(0.00);
//$taxOverride->setReason("Adjustment for return");
//$taxOverride->setTaxDate("2013-07-01");
//
//Origin Address
$origin = new Address();
$origin->setLine1("45 Fremont Street");
$origin->setLine2("");
$origin->setCity("San Francisco");
$origin->setRegion("CA");
$origin->setPostalCode("94105-2204");
$origin->setCountry("US");
$request->setOriginAddress($origin);
//
//Destination Address
$destination = new Address();
$destination->setLine1("118 N Clark St");
$destination->setLine2("Suite 100");
$destination->setLine2("ATTN Accounts Payable");
$destination->setCity("Chicago");
$destination->setRegion("IL");
$destination->setPostalCode("60602-1304");
$destination->setCountry("US");
$request->setDestinationAddress($destination);
//
//Third Address
$thirdaddress = new Address();
$thirdaddress->setLine1("100 Ravine Lane");
$thirdaddress->setLine2("Suite 100");
$thirdaddress->setLine2("");
$thirdaddress->setCity("Bainbridge Island");
$thirdaddress->setRegion("WA");
$thirdaddress->setPostalCode("98110");
$thirdaddress->setCountry("US");
$request->setAddressCode($thirdaddress);
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
$line2->setOriginAddress($OrigAddress);
$line2->setDestinationAddress($thirdaddress);
$line2->setItemCode("T345");
$line2->setDescription("Size 10 Green Running Shoe");
$line2->setQty(3);
$line2->setAmount(150);
$line2->setTaxCode("PC030147");
//
//*Situational Request Line Parameters
//$line2->setDiscounted(true);
//$line2->setTaxIncluded(true);
//$line2->setRevAcct("");
//$line2->setRef1("ref123");
//$line2->setRef2("ref456");
//$line2->setExemptionNo("12345");
//$line2->setCustomerUsageType("L");
//*TaxOverride at the line level
//
//*Note: TaxOverride can exist at the 
//*      Document Level OR Line Level
//*      Never both at the same time.
//$taxOverride = new TaxOverride();
//$line2->setTaxOverride($taxOverride); 
//$taxOverride->setTaxOverrideType(TaxOverrideType::$TaxDate);
//$taxOverride->setTaxAmount(0.00);
//$taxOverride->setReason("Adjustment for return");
//$taxOverride->setTaxDate("2013-07-01");
//$request->setLines(array($line2));
//
// Line Level 3
$line3 = new Line();
$line3->setOriginAddress($OrigAddress);
$line3->setDestinationAddress($thirdaddress);
$line3->setNo(3);
$line3->setItemCode("FREIGHT");
$line3->setDescription("Shipping Charge");
$line3->setQty(1);
$line3->setAmount(15);
$line3->setTaxCode("FR");
//
//*Situational Request Line Parameters
//$line3->setDiscounted(true);
//$line3->setTaxIncluded(true);
//$line3->setRevAcct("");
//$line3->setRef1("ref123");
//$line3->setRef2("ref456");
//$line3->setExemptionNo("12345");
//$line3->setCustomerUsageType("L");
//
//*TaxOverride at the line level
//*Note: TaxOverride can exist at the 
//*      Document Level OR Line Level
//*      Never both at the same time.
//$taxOverride = new TaxOverride();
//$line3->setTaxOverride($taxOverride);
//$taxOverride->setTaxOverrideType(TaxOverrideType::$TaxDate);
//$taxOverride->setTaxAmount(0.00);
//$taxOverride->setReason("Adjustment for return");
//$taxOverride->setTaxDate("2013-07-01");
//
//Compile all three lines into an array
$request->setLines(array($line1, $line2, $line3));
// Results
try
    {
    $getTaxResult = $client->getTax($request);
    echo 'GetTax is: ' . $getTaxResult->getResultCode() . "\n";
// Error Trapping
    if ($getTaxResult->getResultCode() == SeverityLevel::$Success)
        {
//Success - Display GetTaxResults to console
//Document Level Results
        echo "DocCode: " . $request->getDocCode() . "\n";
        echo "TotalAmount: " . $getTaxResult->getTotalAmount() . "\n";
        echo "TotalTax: " . $getTaxResult->getTotalTax() . "\n";
//Line Level Results (from TaxLines array class)
        foreach ($getTaxResult->getTaxLines() as $ctl)
            {
            echo "     Line: " . $ctl->getNo() . " Tax: " . $ctl->getTax() . " TaxCode: " . $ctl->getTaxCode() . "\n";
//Line Level Results
            foreach ($ctl->getTaxDetails() as $ctd)
                {
                echo "          Juris Type: " . $ctd->getJurisType() . "; Juris Name: " . $ctd->getJurisName() . "; Rate: " . $ctd->getRate() . "; Amt: " . $ctd->getTax() . "\n";
                }
            echo"\n";
            }
//If NOT success - display error messages to console     
        } else
        {
        foreach ($getTaxResult->getMessages() as $msg)
            {
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