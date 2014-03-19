The <strong>AvaTaxCalc PHP (for SOAP)Sample</strong> is open source designed to assist you with developing your own <em>custom</em> integration to your chosen web store or e-commerce solution. Each sample can be executed from a command prompt provided they have been pre-configured with:<br />
<li>The Web service URL:</li>
<li>Account Number</li>
<li>License Key</li>
<br />
<em><strong>Note: </strong></em>The Avalara Admin Account <em>Username</em> and <em>Password</em> can be used in place of <em>Account</em> and <em>License Key</em>
</p>
<p><strong>Installation Dependencies</strong></p>
<li>PHP V5.2 or later</li>
<li><em>SSL</em> and <em>SoapClient</em> support must be enabled for your PHP interpretor: </li>
For windows, add the following extentions to php.ini: <br />
<span class="cmeta"><code>extension=php_soap.dll</code><br />
<code>exetnsion=php_openssl.dl</code></span><code>l </code> <br />
<br />
<em><strong>Note: </strong></em>For <em>*nix</em>, it may be necessary to recompile your PHP interpretor with <em>soap.dll</em> and <em>oenssl.dll</em> enabled.
<p><strong>Included in this sample set</strong>, and recommended testing order, are:</p>
<table width="750" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="172"><div align="center"><strong>API</strong></div></td>
    <td width="328"><div align="center"><strong>a method thatDemonstrated</strong></div></td>
  </tr>
  <tr>
    <td><strong>IsAuthorized.php</strong></td>
    <td> a method that allows the user to specify a number of a methods or services to ascertain  if they are permitted to use them based on the credentials  provided in the request.</td>
  </tr>
  <tr>
    <td><strong>Ping.php</strong></td>
    <td> a method for testing connectivity to the AvaTax web service, verify  supplied credentials, and return the service version in use by the AvaTax web service. </td>
  </tr>
  <tr>
    <td><strong>Validate.php</strong></td>
    <td>demonstrates the <a href="http://developer.avalara.com/api-docs/avalara-avatax-api-reference#cat-Validate" target="_blank">ValidateAddress</a> method that <a href="http://developer.avalara.com/api-docs/api-reference/address-validation">normalizes a provided address</a>. US and Canada only.</td>
  </tr>
  <tr>
    <td><strong>GetTaxRequest.php </strong></td>
    <td>a <a href="http://developer.avalara.com/api-docs/avalara-avatax-api-reference#cat-GetTax" target="_blank">method</a> that calculates retail sales tax on documents such as sales orders, sales invoices, purchase orders, purchase invoices, or credit memos.<strong> Note:</strong> A document can be committed at this stage by setting the <em>Commit</em> property to <em>true</em> (default is <em>false</em>).</td>
  </tr>
  <tr>
    <td><strong>PostTax.php</strong></td>
    <td> a <a href="http://developer.avalara.com/api-docs/avalara-avatax-api-reference#cat-PostTax" target="_blank">method</a> that can be used to modify the state of a SalesInvoice, ReturnInvoice or PurchaseInvoice document saved to the AvaTax database. <strong>Note:</strong> A document can be committed at this stage by setting the Commit property to true (default is false).</td>
  </tr>
  <tr>
    <td><strong>CommitTax.php</strong></td>
    <td>a method that can be used to modify the state of a document that is &quot;posted&quot; to the AvaTax database via SalesInvoice, ReturnInvoice or PurchaseInvoice a methods. <strong>Note:</strong> CommitTax is not a required step to commit a document to AvaTax. Documents can  be committed during the GetTax or PostTax document lifecycle. </td>
  </tr>
  <tr>
    <td><strong>GetTaxHistory.php</strong></td>
    <td>a <a href="http://developer.avalara.com/api-docs/avalara-avatax-api-reference#cat-GetTaxHistory" target="_blank">method</a> thatthat retrieves  details for previously saved (to the AvaTax database) documents.</td>
  </tr>
  <tr>
    <td><strong>AdjustTax.php</strong></td>
    <td>a method that can modify elements of an <em>already committed document</em>. <strong>Note:</strong> Sets the <em>Document Modified</em> flag.</td>
  </tr>
  <tr>
    <td><strong>CancelTax.php</strong></td>
    <td>a <a href="http://developer.avalara.com/api-docs/avalara-avatax-api-reference#cat-CancelTax" target="_blank">method</a> that cancels a tax document specified by the DocId, DocCode, and DocType parameters. See&nbsp;<a href="http://developer.avalara.com/api-docs/avalara-avatax-api-reference#cat-CancelTax" target="_blank">CancelTax</a>&nbsp;for more details.</td>
  </tr>
  <tr>
    <td><strong>ReconcileTaxHistory.php</strong></td>
    <td>a method that will produce a listing of documents saved to the AvaTax database based on dates or document codes.</td>
  </tr>
  <tr>
    <td><strong>/AvaTax4PHP</strong></td>
    <td><em>a Directory</em> containing the core classes that facilitate Avatax web service calls.</td>
  </tr>
  <tr>
    <td colspan="2"><strong>Other Files Included in this Repository</strong></td>
  </tr>
  <tr>
    <td><strong><em>.gitattributes</em></strong></td>
    <td><em>-GitHub attribute file. Not required for sample use.</em></td>
  </tr>
  <tr>
    <td><strong><em>.gitignore</em></strong></td>
    <td><em>-GitHub config file. Not required for sample use.</em></td>
  </tr>
  <tr>
    <td><strong>LICENSE.md</strong></td>
    <td>-Apache License TERMS AND CONDITIONS FOR USE, REPRODUCTION, AND DISTRIBUTION</td>
  </tr>
  <tr>
    <td><strong>README.md</strong></td>
    <td>-This document describing how to make use of the sample code.</td>
  </tr>
</table>
<p><strong>Resources</strong><br />
</p>
<p>Developer API Documentation is located here: <a href="http://developer.avalara.com/api-docs" target="_blank">http://developer.avalara.com/api-docs</a></p>
<p>Find out what other developers are talking about at the Avalara Developer Community Forum located here: <a href="https://community.avalara.com/avalara/categories/avalara_developersintegrations" target="_blank">https://community.avalara.com/avalara/categories/avalara_developersintegrations</a></p>
<p>Frequently asked questions regarding Avalara is located here: <a href="https://help.avalara.com/" target="_blank">https://help.avalara.com/</a></p>