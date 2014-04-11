  <p>The <strong>AvaTaxCalc PHP (for SOAP) Sample</strong> is open source designed to assist you with developing your own <em>custom</em> integration to your chosen web store or e-commerce solution. Each sample can be executed independently from a command prompt provided they have been pre-configured with the Web service URL and your Account Number and License Key.</p>
  <em><strong>Note: </strong></em>The Avalara Admin Account <em>Username</em> and <em>Password</em> can be used in place of <em>Account</em> and <em>License Key</em>
 <p>See http://developer.avalara.com/api-docs/designing-your-integration/gettax for more information.
  </p>
  <h4><strong>Installation Dependencies</strong></h4>
  <li>PHP V5.2 or later</li>
  <li><em>SSL</em> and <em>SoapClient</em> support must be enabled for your PHP interpreter. For windows, add the following extentions to php.ini: <br />
    <br />
    <span class="cmeta"><code>extension=php_soap.dll</code><br />
    <code>extension=php_openssl.dll</code></span></code> <br />
    <br />
    <em><strong>Note: </strong></em>For <em>*nix</em>, it may be necessary to recompile your PHP interpreter with <em>soap.dll</em> and <em>oenssl.dll</em> enabled. </li>
  <h4><strong>Samples Included</strong></h4>
  <table width="1000" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="172"><div align="center"><strong>API</strong></div></td>
      <td width="828"><div align="center"><strong>Method Demonstrated</strong></div></td>
    </tr>
    <tr>
      <td><strong>IsAuthorizedTest.php</strong></td>
      <td> IsAuthorized is a method that allows the user to specify a number of a methods or services to ascertain  if they are permitted to use them based on the credentials  provided in the request.</td>
    </tr>
    <tr>
      <td><strong>PingTest.php</strong></td>
      <td> The Ping method can be used for testing connectivity to the AvaTax web service, verify  supplied credentials, and return the service version in use by the AvaTax web service. </td>
    </tr>
    <tr>
      <td><strong>ValidateTest.php</strong></td>
      <td>Validate demonstrates the <a href="http://developer.avalara.com/api-docs/avalara-avatax-api-reference#cat-Validate" target="_blank">ValidateAddress</a> method that <a href="http://developer.avalara.com/api-docs/api-reference/address-validation">normalizes a provided address</a>. US and Canada only.</td>
    </tr>
    <tr>
      <td><strong>GetTaxRequestTest.php </strong></td>
      <td>The <a href="http://developer.avalara.com/api-docs/avalara-avatax-api-reference#cat-GetTax" target="_blank">GetTaxRequest</a> method calculates retail sales tax on documents such as sales orders, sales invoices, purchase orders, purchase invoices, or credit memos.<strong> Note:</strong> A document can be committed at this stage by setting the <em>Commit</em> property to <em>true</em> (default is <em>false</em>).</td>
    </tr>
    <tr>
      <td><strong>PostTaxTest.php</strong></td>
      <td> The <a href="http://developer.avalara.com/api-docs/avalara-avatax-api-reference#cat-PostTax">PostTax</a> method can be used to modify the state of a SalesInvoice, ReturnInvoice or PurchaseInvoice document saved to the AvaTax database. <strong>Note:</strong> A document can be committed at this stage by setting the Commit property to true (default is false).</td>
    </tr>
    <tr>
      <td><strong>CommitTaxTest.php</strong></td>
      <td>The CommitTax method  can be used to modify the state of a document that is &quot;<em>posted</em>&quot; (only) to the AvaTax database via SalesInvoice, ReturnInvoice or PurchaseInvoice a methods. <strong>Note:</strong> CommitTax is not a required step to commit a document to AvaTax. Documents can  be committed during the GetTax or PostTax document lifecycle. </td>
    </tr>
    <tr>
      <td><strong>GetTaxHistoryTest.php</strong></td>
      <td><a href="http://developer.avalara.com/api-docs/avalara-avatax-api-reference#cat-GetTaxHistory" target="_blank">GetTaxHistory</a> is a method that retrieves  details from a previously saved (to the AvaTax database) documents.</td>
    </tr>
    <tr>
      <td><strong>AdjustTaxTest.php</strong></td>
      <td>AdjustTax is a method that has the ability to modify elements of an <em>already committed document</em>. <strong>Note:</strong> Sets the <em>Document Modified</em> flag.</td>
    </tr>
    <tr>
      <td><strong>CancelTaxTest.php</strong></td>
      <td><a href="http://developer.avalara.com/api-docs/avalara-avatax-api-reference#cat-CancelTax">CancelTax</a> is a method that cancels a tax document specified by the DocId, DocCode, and DocType parameters. See&nbsp;<a href="http://developer.avalara.com/api-docs/avalara-avatax-api-reference#cat-CancelTax" target="_blank">CancelTax</a>&nbsp;for more details.</td>
    </tr>
    <tr>
      <td><strong>ReconcileTaxHistoryTest.php</strong></td>
      <td>ReconcileTaxHistory is a method that  will produce a listing of documents saved to the AvaTax database -based on a range of dates or document codes.</td>
    </tr>
    <tr>
      <td><strong>/AvaTax4PHP</strong></td>
      <td><em>../AvaTax4PHP is a Directory</em> containing the core classes that enable the API samples to make Avatax web service calls.</td>
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
  </table>
<h4><strong>Resources</strong><br />
  </h4>
  <p>Developer API Documentation is located here: <a href="http://developer.avalara.com/api-docs" target="_blank">http://developer.avalara.com/api-docs</a></p>
  <p>The Avalara AvaTax API Reference is located here: <a href="http://developer.avalara.com/api-docs/avalara-avatax-api-reference" target="_blank">http://developer.avalara.com/api-docs/avalara-avatax-api-reference</a></p>
  <p>Find out what other developers are talking about on the <em>Avalara Developer Community Forum</em> located here: <a href="https://community.avalara.com/avalara/category_sets/developers" target="_blank">https://community.avalara.com/avalara/category_sets/developers</a></p>
<p>Frequently asked questions regarding the Avalara product is located here: <a href="https://help.avalara.com/" target="_blank">https://help.avalara.com/</a></p>
