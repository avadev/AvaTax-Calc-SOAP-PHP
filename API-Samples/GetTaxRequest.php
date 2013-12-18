<?php
require('../AvaTax4PHP/AvaTax.php');     // location of the AvaTax.PHP Classes - Required
require('../Security/Credentials.php'); // where service URL, account, license key are set
$client = new TaxServiceSoap('Development');
$request = new GetTaxRequest();
$request->setDetailLevel(DetailLevel::$Tax);
$dateTime = new DateTime();
$request->setDocDate(date_format($dateTime, "Y-m-d"));
$request->setCompanyCode("");
$request->setCustomerCode("AvaTaxTest");
$request->setDocType("SalesOrder");
$request->setDocCode("10000");
$request->setCommit(FALSE);
$request->setDiscount(0);
$request->setCustomerUsageType("");
$request->setExemptionNo("");
$request->setSalespersonCode("");
$request->setPurchaseOrderNo("");
$request->setLocationCode("");

//Add Origin Address
$origin = new Address();
$origin->setLine1("100 Ravine Lane");
$origin->setLine2("Suite 220");
$origin->setCity("Bainbridge Island");
$origin->setRegion("WA");
$origin->setPostalCode("98110");
$origin->setCountry("US");
$request->setOriginAddress($origin);

// Add Destination Address
$destination = new Address();
$destination->setLine1("100 Ravine Lane");
$destination->setLine2("Suite 220");
$destination->setCity("Bainbridge Island");
$destination->setRegion("WA");
$destination->setPostalCode("98110");
$destination->setCountry("US");
$request->setDestinationAddress($destination);

// Line level processing
$line1 = new Line();
$line1->setNo(1);
$line1->setItemCode("SKU1234");
$line1->setDescription("Description of SKU123");
$line1->setTaxCode("");
$line1->setQty(1);
$line1->setAmount(100);
$line1->setDiscounted(false);
$line1->setRevAcct("");
$line1->setRef1("");
$line1->setRef2("");
$line1->setExemptionNo("");
$line1->setCustomerUsageType("");
$request->setLines(array($line1));

// GetTaxRequest and Results
try {
  $getTaxResult = $client->getTax($request);
  echo 'GetTax is: ' . $getTaxResult->getResultCode() . "\n";

// Error Trapping

  if ($getTaxResult->getResultCode() == SeverityLevel::$Success) {

// Success - Display GetTaxResults to console
//Document Level Results

    echo "DocCode: " . $request->getDocCode() . "\n";
    echo "TotalAmount: " . $getTaxResult->getTotalAmount() . "\n";
    echo "TotalTax: " . $getTaxResult->getTotalTax() . "\n";

//Line Level Results (from a TaxLines array class)
//Displayed in a readable format

    foreach ($getTaxResult->getTaxLines() as $ctl) {
      echo "     Line: " . $ctl->getNo() . " Tax: " . $ctl->getTax() . " TaxCode: " . $ctl->getTaxCode() . "\n";

//Line Level Results (from a TaxDetails array class)
//Displayed in a readable format
      foreach ($ctl->getTaxDetails() as $ctd) {
        echo "          Juris Type: " . $ctd->getJurisType() . "; Juris Name: " . $ctd->getJurisName() . "; Rate: " . $ctd->getRate() . "; Amt: " . $ctd->getTax() . "\n";
      }
      echo"\n";
    }

// If NOT success - display error messages to console     
  } else {
    foreach ($getTaxResult->getMessages() as $msg) {
      echo $msg->getName() . ": " . $msg->getSummary() . "\n";
    }
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

