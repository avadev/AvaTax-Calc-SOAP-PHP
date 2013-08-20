<?php

require('../AvaTax4PHP/AvaTax.php');     // location of the AvaTax.PHP Classes - Required
require('../Security/Credentials.php'); // where service URL, account, license key are set

$client = new TaxServiceSoap('Development');
$request = new GetTaxRequest();

$file = fopen('..\Invoice-Samples\SampleImportTransactionSingleLine.csv', 'r'); //uses sample input document
while ($line = fgets($file)) {                                          //Reads a line from the input document

//data elements from input document are set to variables (Follows AvaTax Import Transaction Format. 
    list( $ProcessCode, $DocCode, $DocType, $DocDate, $CompanyCode, $CustomerCode, $EntityUseCode,
    $LineNo, $TaxCode, $TaxDate, $ItemCode, $Description, $Qty, $Amount, $Taxable, $Discount,
    $TotalTax, $CountryTax, $StateTax, $CountyTax, $CityTax, $Other1Tax, $Other2Tax, $Ref1,
    $Ref2, $ExemptionNo, $RevAcct, $TaxType, $DestAddress, $DestCity, $DestRegion, $DestPostalCode,
    $DestCountry, $OrigAddress, $OrigCity, $OrigRegion, $OrigPostalCode, $OrigCountry,
    $LocationCode, $SalesPersonCode, $PurchaseOrderNo, $CurrencyCode, $ExchangeRate,
    $ExchangeRateEffDate, $PaymentDate, $TaxIncluded) = explode(',', str_replace('"', '', $line));

//Document Level Setup  
//     R: indicates Required Element
//     O: Indicates Optional Element
//
    $dateTime = new DateTime();                                  // R: Sets dateTime format 
//  $request->setDocDate($DocDate);                             // O:  sets DocDate to current date / time.
    $request->setCompanyCode($CompanyCode);                    // R: Company Code from the accounts Admin Console
    $request->setDocType($DocType);                           // R: Typically SalesOrder,SalesInvoice, ReturnInvoice
    $request->setDocCode($DocCode);                          // R: Invoice or document tracking number - Must be unique
    $request->setDocDate(date_format($dateTime, "Y-m-d"));  // R: Date the document is processed and Taxed - See TaxDate
    $request->setSalespersonCode($SalesPersonCode);        // O: String
    $request->setCustomerCode($CustomerCode);             // R: String - Customer Tracking number
    $request->setCustomerUsageType($EntityUseCode);      // O: String   Entity Usage
    $request->setDiscount($Discount);                   // O: Decimal - amount of total document discount
    $request->setPurchaseOrderNo($PurchaseOrderNo);    // O: String 
    $request->setExemptionNo($ExemptionNo);           // O: String   if not using ECMS which keys on customer code
    $request->setDetailLevel(DetailLevel::$Tax);     // R: Chose $Summary, $Document, $Line or $Tax - varying levels of results detail 
    $request->setLocationCode($LocationCode);       // O: string - also known as Outlet ID for tax forms / reporting
    $request->setCommit(FALSE);                    // O: Default is FALSE - Set to TRUE to commit the Document

//Add Origin Address
    $origin = new Address();                      // R: New instance of an origin address
    $origin->setLine1($OrigAddress);              // O: It is not required to pass a valid street address however the 
    $origin->setLine2("");                        // O: tax results may be of lower precision (i.e. no City or Local Juris)
    $origin->setCity($OrigCity);                  // R: City
    $origin->setRegion($OrigRegion);              // R: State or Province
    $origin->setPostalCode($OrigPostalCode);      // R: String (Expects to be NNNNN or NNNNN-NNNN or LLN-LLN)
    $origin->setCountry($OrigCountry);            // O: String Country, Country Code, etc.
    $request->setOriginAddress($origin);          // R: Sets OrignAddress string to $origin

// Add Destination Address
    $destination = new Address();                 // R: New instance of an destination address
    $destination->setLine1($DestAddress);         // O: It is not required to pass a valid street address however the 
    $destination->setLine2("");                   // O: tax results may be of lower precision (i.e. no City or Local Juris)
    $destination->setCity($DestCity);             // R: City
    $destination->setRegion($DestRegion);         // R: State or Province
    $destination->setPostalCode($DestPostalCode); // R: String (Expects to be NNNNN or NNNNN-NNNN or LLN-LLN)
    $destination->setCountry($DestCountry);       // O: String Country, Country Code, etc.
    $request->setDestinationAddress($destination);// R: Sets DestinationAddress string to $destination
//
// Line level processing
    
    $lines = array();                                     // array of lines for the invoice
    //$i = 0;                                            // sets counter to 0 (multiple lines)
    $line1 = new Line();                                // New instance of a line  
    $line1->setNo($LineNo);                            // R: string - line Number of invoice - must be unique.
    $line1->setItemCode($ItemCode);                   // R: string - SKU or short name of Item
    $line1->setDescription($data[11]);               // O: string - Longer description of Item - R: for SST
    $line1->setTaxCode($Description);               // O: string - Tax Code associated with Item
    $line1->setQty($Qty);                          // R: decimal - The number of items 
    $line1->setAmount($Amount);                   // R: decimal - the "NET" amount of items 
    $line1->setDiscounted(false);                //O: boolean - Set to true if line item is to discounted - see Discount
    $line1->setRevAcct($RevAcct);               // O: string - Revenue Account (for reporting)
    $line1->setRef1($Ref1);                    // O: string - User definable field
    $line1->setRef2($Ref2);                   // O:string - User definable field
    $line1->setExemptionNo($ExemptionNo);            // O: string - Exemption number for line level exemptions
    $line1->setCustomerUsageType($EntityUseCode);   // O: string - Entity Use Code - Typically A - L (G = Reseller)
    $request->setLines(array($line1));             // sets line items to $lineX array    

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
// it is important to itterate through the entire message class        
                      
            } else {
            foreach ($getTaxResult->getMessages() as $msg) {
                echo $msg->getName() . ": " . $msg->getSummary() . "\n";
            }
        }
    } catch (SoapFault $exception) {
        $msg = "Exception: ";
        if ($exception)
            $msg .= $exception->faultstring;

// If you desire to retrieve SOAP IN / OUT XML
//  - Follow directions below
//  - if not, leave as is
       
        echo $msg . "\n";
//    }   //UN-comment this line to return SOAP XML
    echo $client->__getLastRequest() . "\n";
    echo $client->__getLastResponse() . "\n";
}   //Comment this line to return SOAP XML
}
?>
