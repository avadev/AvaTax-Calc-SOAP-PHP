AvaTax-Calc-SOAP-PHP
=====================
[Other Samples](http://developer.avalara.com/api-docs/api-sample-code)

This is a PHP sample demonstrating the [AvaTax SOAP API](http://developer.avalara.com/api-docs/soap). 
 For more information on the use of these methods and the AvaTax product, please visit our [developer site](http://developer.avalara.com/) or [homepage](http://www.avalara.com/)

Dependencies:
-----------
- PHP 5.3 or later (not tested on versions older than PHP 5.3)

Requirements:
----------
- Authentication requires an valid **Account Number** and **License Key**, which should be entered in the test file (e.g. GetTaxTest.php) you would like to run.
- If you do not have an AvaTax account, a free trial account can be acquired through our [developer site](http://developer.avalara.com/api-get-started)
- **SSL** and **SoapClient** support must be enabled for your PHP interpreter. For windows, add the following extentions to php.ini:
```
extension=php_soap.dll
extension=php_openssl.dll
```
Note: For *nix, it may be necessary to recompile your PHP interpreter with soap.dll and openssl.dll enabled.


- If you would like to use these core classes as part of a project and manage your depencies through [composer](https://getcomposer.org/), the Avatax classes can be added to your existing project by adding
```
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/avadev/AvaTax-Calc-SOAP-PHP"
        }
    ],
    "require": {
        "avalara/avatax": "*"
    }
```
to your composer.json file and run `php composer.phar update` from your command line.




Contents:
------------

  <table width="1000" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="172"><div align="center"><strong>File</strong></div></td>
      <td width="828"><div align="center"><strong>Method Demonstrated</strong></div></td>
    </tr>
    <tr>
      <td><strong>Samples/Credentials.php</strong></td>
      <td>contains authentication elements (URL, Account, LicenseKey, Client) that are passed into the ATConfig object which ontains various service configuration parameters as class static variables. </td>
    </tr>
    <tr>
      <td><strong>Samples/IsAuthorizedTest.php</strong></td>
      <td> IsAuthorized is a method that allows the user to specify a number of a methods or services to ascertain  if they are permitted to use them based on the credentials  provided in the request.</td>
    </tr>
    <tr>
      <td><strong>Samples/PingTest.php</strong></td>
      <td> The Ping method can be used for testing connectivity to the AvaTax web service, verify  supplied credentials, and return the service version in use by the AvaTax web service. </td>
    </tr>
    <tr>
      <td><strong>Samples/ValidateTest.php</strong></td>
      <td>Validate demonstrates the <a href="http://developer.avalara.com/api-docs/avalara-avatax-api-reference#cat-Validate" target="_blank">ValidateAddress</a> method that <a href="http://developer.avalara.com/api-docs/api-reference/address-validation">normalizes a provided address</a>. US and Canada only.</td>
    </tr>
    <tr>
      <td><strong>Samples/GetTaxRequestTest.php </strong></td>
      <td>The <a href="http://developer.avalara.com/api-docs/avalara-avatax-api-reference#cat-GetTax" target="_blank">GetTaxRequest</a> method calculates retail sales tax on documents such as sales orders, sales invoices, purchase orders, purchase invoices, or credit memos.<strong> Note:</strong> A document can be committed at this stage by setting the <em>Commit</em> property to <em>true</em> (default is <em>false</em>).</td>
    </tr>
    <tr>
      <td><strong>Samples/PostTaxTest.php</strong></td>
      <td> The <a href="http://developer.avalara.com/api-docs/avalara-avatax-api-reference#cat-PostTax">PostTax</a> method can be used to modify the state of a SalesInvoice, ReturnInvoice or PurchaseInvoice document saved to the AvaTax database. <strong>Note:</strong> A document can be committed at this stage by setting the Commit property to true (default is false).</td>
    </tr>
    <tr>
      <td><strong>Samples/CommitTaxTest.php</strong></td>
      <td>The CommitTax method  can be used to modify the state of a document that is &quot;<em>posted</em>&quot; (only) to the AvaTax database via SalesInvoice, ReturnInvoice or PurchaseInvoice a methods. <strong>Note:</strong> CommitTax is not a required step to commit a document to AvaTax. Documents can  be committed during the GetTax or PostTax document lifecycle. </td>
    </tr>
    <tr>
      <td><strong>Samples/GetTaxHistoryTest.php</strong></td>
      <td><a href="http://developer.avalara.com/api-docs/avalara-avatax-api-reference#cat-GetTaxHistory" target="_blank">GetTaxHistory</a> is a method that retrieves  details from a previously saved (to the AvaTax database) documents.</td>
    </tr>
    <tr>
      <td><strong>Samples/AdjustTaxTest.php</strong></td>
      <td>AdjustTax is a method that has the ability to modify elements of an <em>already committed document</em>. <strong>Note:</strong> Sets the <em>Document Modified</em> flag.</td>
    </tr>
    <tr>
      <td><strong>Samples/CancelTaxTest.php</strong></td>
      <td><a href="http://developer.avalara.com/api-docs/avalara-avatax-api-reference#cat-CancelTax">CancelTax</a> is a method that cancels a tax document specified by the DocId, DocCode, and DocType parameters. See&nbsp;<a href="http://developer.avalara.com/api-docs/avalara-avatax-api-reference#cat-CancelTax" target="_blank">CancelTax</a>&nbsp;for more details.</td>
    </tr>
    <tr>
      <td><strong>/AvaTax</strong></td>
      <td><em>../AvaTax is a Directory</em> containing the core classes that enable the API samples to make Avatax web service calls.</td>
    </tr>
    <tr>
      <td colspan="2"><h4><strong>Other Files Included in this Repository</strong></h4></td>
    </tr>
    <tr>
      <td><strong><em>.gitattributes</em></strong></td>
      <td><em>GitHub attribute file. Not required for sample use.</em></td>
    </tr>
    <tr>
      <td><strong><em>.gitignore</em></strong></td>
      <td><em>GitHub config file. Not required for sample use.</em></td>
    </tr>
    <tr>
      <td><strong>LICENSE.md</strong></td>
      <td>Apache License TERMS AND CONDITIONS FOR USE, REPRODUCTION, AND DISTRIBUTION</td>
    </tr>
    <tr>
      <td><strong>README.md</strong></td>
      <td>This document describing how to make use of the sample API code.</td>
    </tr>
    <tr>
      <td><strong>composer.json</strong></td>
      <td>Allows for composer management of packages.</td>
    </tr>
  </table>
<h4><strong>Resources</strong><br />
  </h4>
  <p>Developer API Documentation is located here: <a href="http://developer.avalara.com/api-docs" target="_blank">http://developer.avalara.com/api-docs</a></p>
  <p>The Avalara AvaTax API Reference is located here: <a href="http://developer.avalara.com/api-docs/avalara-avatax-api-reference" target="_blank">http://developer.avalara.com/api-docs/avalara-avatax-api-reference</a></p>
  <p>Find out what other developers are talking about on the <em>Avalara Developer Community Forum</em> located here: <a href="https://community.avalara.com/avalara/category_sets/developers" target="_blank">https://community.avalara.com/avalara/category_sets/developers</a></p>
<p>Frequently asked questions regarding the Avalara product is located here: <a href="https://help.avalara.com/" target="_blank">https://help.avalara.com/</a></p>
