<?php
require('AvaTax4PHP\AvaTax.php');
//Authentication
//TODO: Replace sample account and license key with your credentials
new ATConfig('Development', array(
    'url' => 'https://development.avalara.net',
    'account' => '110000000',
    'license' => '1A2B3C4D5E6F7G8')
);
$client = new TaxServiceSoap('Development');
$request = new GetTaxRequest();

//Document Level
$request->setDetailLevel(DetailLevel::$Tax);
$dateTime = new DateTime();
$request->setDocDate(date_format($dateTime, "Y-m-d"));
$request->setCompanyCode("APITrialCompany");
$request->setCustomerCode("Cust1234");
$request->setDocType("SalesInvoice");
$request->setDocCode("1000000");

//*Situational Request Document Parameters
//$request->setCommit(false);
//$request->setDiscount(0);
//$request->setCustomerUsageType("");
//$request->setExemptionNo("");
//$request->setSalespersonCode("");
//$request->setPurchaseOrderNo("");
//$request->setLocationCode("");

//*TaxOverride at the Document Level
//*Note: TaxOverride can exist at the 
//*      Document Level OR Line Level
//*      Never both at the same time.
//$taxOverride = new TaxOverride();
//$taxOverride->setTaxOverrideType(TaxOverrideType::$TaxDate);
//$taxOverride->setTaxAmount(0.00);
//$taxOverride->setReason("Return");
//$taxOverride->setTaxDate("2014-01-01");

//Origin Address
$origin = new Address();
$origin->setLine1("100 Ravine Lane");
$origin->setLine2("Suite 220");
$origin->setCity("Bainbridge Island");
$origin->setRegion("WA");
$origin->setPostalCode("98110");
$origin->setCountry("US");
$request->setOriginAddress($origin);

//Destination Address
$destination = new Address();
$destination->setLine1("100 Ravine Lane");
$destination->setLine2("Suite 220");
$destination->setCity("Bainbridge Island");
$destination->setRegion("WA");
$destination->setPostalCode("98110");
$destination->setCountry("US");
$request->setDestinationAddress($destination);

// Line Level
$line1 = new Line();
$line1->setNo(1);
$line1->setItemCode("SKU1234");
$line1->setDescription("Description of SKU1234");
$line1->setTaxCode("P0000000");
$line1->setQty(1);
$line1->setAmount(100);

//*Situational Request Line Parameters
//$line1->setDiscounted(false);
//$line1->setRevAcct("");
//$line1->setRef1("");
//$line1->setRef2("");
//$line1->setExemptionNo("");
//$line1->setCustomerUsageType("");

//*TaxOverride at the line level
//*Note: TaxOverride can exist at the 
//*      Document Level OR Line Level
//*      Never both at the same time.
//$taxOverride = new TaxOverride();
//$taxOverride->setTaxOverrideType(TaxOverrideType::$TaxDate);
//$taxOverride->setTaxAmount(0.00);
//$taxOverride->setReason("Return");
//$taxOverride->setTaxDate("2014-01-01");
$request->setLines(array($line1));
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