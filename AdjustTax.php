<?php
require('AvaTax4PHP\AvaTax.php');
//Authentication
//TODO: Replace account and license key with your credentials
new ATConfig('Development', array(
    'url' => 'https://development.avalara.net',
    'account' => '110000000',
    'license' => '1A2B3C4D5E6F7G8')
);
$client = new TaxServiceSoap('Development');
//GetTaxRequest to be modified (duplicate of an original)
$getTaxRequest = new GetTaxRequest();
$dateTime = new DateTime();
$getTaxRequest->setCompanyCode("APITrialCompany");
$getTaxRequest->setDocType(DocumentType::$SalesInvoice);
$getTaxRequest->setDocCode("1000000");
$getTaxRequest->setDocDate(date_format($dateTime, "Y-m-d"));
$getTaxRequest->setCustomerCode("Cust1234");
$getTaxRequest->setDetailLevel(DetailLevel::$Tax);
$getTaxRequest->setSalespersonCode("");
$getTaxRequest->setCustomerUsageType("");
$getTaxRequest->setDiscount(0.00);
$getTaxRequest->setPurchaseOrderNo("");
$getTaxRequest->setExemptionNo("");
$getTaxRequest->setCommit("false");
//Origin Address
$origin = new Address();
$origin->setLine1("100 Ravine Lane");
$origin->setLine2("Suite 220");
$origin->setCity("Bainbridge Island");
$origin->setRegion("WA");
$origin->setPostalCode("98110");
$origin->setCountry("US");
$getTaxRequest->setOriginAddress($origin);
//Destination Address
$destination = new Address();
$destination->setLine1("100 Ravine Lane");
$destination->setLine2("Suite 220");
$destination->setCity("Bainbridge Island");
$destination->setRegion("WA");
$destination->setPostalCode("98110");
$destination->setCountry("US");
$getTaxRequest->setDestinationAddress($destination);
//Line(s)
$lines = array();
$line1 = new Line();
$line1->setNo(1);
$line1->setItemCode("SKU1234");
$line1->setDescription("Description of SKU1234");
$line1->setTaxCode("P0000000");
$line1->setQty(1);
$line1->setAmount(200);
$line1->setDiscounted(false);
$line1->setRevAcct("");
$line1->setRef1("");
$line1->setRef2("");
$line1->setExemptionNo("");
$line1->setCustomerUsageType("");
$getTaxRequest->setLines(array($line1));
//Adjustment 
$adjustTaxRequest = new AdjustTaxRequest();
$adjustTaxRequest->setAdjustmentReason(4);
$adjustTaxRequest->setAdjustmentDescription("");
$adjustTaxRequest->setGetTaxRequest($getTaxRequest);
$adjustTaxResult = $client->AdjustTax($adjustTaxRequest);
try
    {
    $adjustTaxResult = $client->AdjustTax($adjustTaxRequest);
    echo 'GetTax is: ' . $adjustTaxResult->getResultCode() . "\n";
// Error Trapping
    if ($adjustTaxResult->getResultCode() == SeverityLevel::$Success)
        {
//Document Level Results
        echo "DocCode: " . $adjustTaxResult->getDocCode() . "\n";
        echo "DocStatus: " . $adjustTaxResult->getDocStatus() . "\n";
        echo "TotalAmount: " . $adjustTaxResult->getTotalAmount() . "\n";
        echo "TotalTax: " . $adjustTaxResult->getTotalTax() . "\n";
//Line Level Results (from TaxLines array class)
        foreach ($adjustTaxResult->getTaxLines() as $ctl)
            {
            echo "     Line: " . $ctl->getNo() .
            " Tax: " . $ctl->getTax() .
            " TaxCode: " . $ctl->getTaxCode() . "\n";
//Line Level Results
            foreach ($ctl->getTaxDetails() as $ctd)
                {
                echo "          Juris Type: " . $ctd->getJurisType() .
                "; Juris Name: " . $ctd->getJurisName() .
                "; Rate: " . $ctd->getRate() .
                "; Amt: " . $ctd->getTax() . "\n";
                }
            echo"\n";
            }
// If NOT success - display error messages to console     
        } else
        {
        foreach ($adjustTaxResult->getMessages() as $msg)
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