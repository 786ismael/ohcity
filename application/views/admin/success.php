<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Success</title>

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<link rel="stylesheet" type="text/css" href="<?=base_url('invite/css/myDefault.css');?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('invite/css/style.css');?>">
	
<script type="text/javascript" src="<?=base_url('invite/js/timezones.js');?>"></script>
<script type="text/javascript" src="<?=base_url('invite/js/timezones.full.js');?>"></script>
</head>
<body>
	<div class="container cart mt20 mb20">
		<div class="heading text-center "><h3>PLANNENDER</h3></div>
    		<div class="panel panel-default">
	        	<div class="panel-body">
        			<div class="row">
        				
                                   <div class="col-sm-12">
                                         <h3 style="color:green">SUCEESS! </h3>
                                         <!--<h3>404! </h3>-->
                                         <p>Invite the user successfully. </p>
                                   </div>

                                </div>

	        	</div><!--panel-body-->
    		</div><!--panel-default-->
	</div>



<form method="post" action="https://secure.payza.com/checkout">
    <input type="hidden" name="ap_merchant" value="rasool.aslan@gmail.com"/>
    <input type="hidden" name="ap_purchasetype" value="item"/>
    <input type="hidden" name="ap_itemname" value="MP3 Player"/>
    <input type="hidden" name="ap_amount" value="50"/>
    <input type="hidden" name="ap_currency" value="USD"/>
    <input type="hidden" name="ap_quantity" value="1"/>
    <input type="hidden" name="ap_itemcode" value="HIJ123"/>
    <input type="hidden" name="ap_description" value="Audio equipment"/>
    <input type="hidden" name="ap_taxamount" value="2.49"/>
    <input type="hidden" name="ap_additionalcharges" value="1.19"/>
    <input type="hidden" name="ap_shippingcharges" value="7.99"/> 
    <input type="hidden" name="ap_discountamount" value="4.99"/>
    <input type="hidden" name="apc_1" value="Blue"/>
    <input type="hidden" name="apc_2" value="UE plug"/>
    <input type="hidden" name="ap_ipnversion" value="2"/>
    <input type="hidden" name="ap_testmode" value="0"/>
    <input type="hidden" name="ap_returnurl" value="http://www.example.com/thankyou.html" />
    <input type="hidden" name="ap_cancelurl" value="http://www.example.com/cancel.html" />

    <input type="image" src="https://www.payza.com/images/payza-buy-now.png"/>
</form>

<?php

function GetPaymentTokenSPClient($myUserName,$apiPassword,$websiteUrl,$purchaseType,$itemName, $itemDescription, $itemCode, $amount, $currency, $shippingAmount, $addAmount, $taxAmount, $returnUrl, $cancelUrl, $apc_1, $apc_2, $apc_3, $apc_4, $apc_5, $apc_6, $splitRecipients)
{

	$responseArray; // The API's response variables
	$server = 'api.payza.com'; // The server address of the API
	$url = '/svc/api.svc/GetPaymentToken'; // The exact URL of the API
	$dataToSend = ''; // The data that will be sent to the API

	$dataToSend = sprintf("USER=%s&PASSWORD=%s&ap_url=%s&ap_purchasetype=%s&ap_itemname=%s&ap_description=%s&ap_itemcode=%s&ap_amount=%s&ap_currency=%s&ap_shippingcharges=%s&ap_additionalcharges=%s&ap_taxamount=%s&ap_returnurl=%s&ap_cancelurl=%s&apc_1=%s&apc_2=%s&apc_3=%s&apc_4=%s&apc_5=%s&apc_6=%s",
                      urlencode((string)$myUserName),
                      urlencode((string)$apiPassword),
                      urlencode((string)$websiteUrl),
                      urlencode((string)$purchaseType),
                      urlencode((string)$itemName),
                      urlencode((string)$itemDescription),
                      urlencode((string)$itemCode),
                      urlencode((string)$amount),
                      urlencode((string)$currency),
                      urlencode((string)$shippingAmount),
                      urlencode((string)$addAmount),
                      urlencode((string)$taxAmount),
                      urlencode((string)$returnUrl),
                      urlencode((string)$cancelUrl),
                      urlencode((string)$apc_1),
                      urlencode((string)$apc_2),
                      urlencode((string)$apc_3),
                      urlencode((string)$apc_4),
                      urlencode((string)$apc_5),
                      urlencode((string)$apc_6));
  
	//check if the received variable is an array
	if (!is_array($splitRecipients)) 
	{ 
		die ("Argument is not an array!"); 
	}
	else
	{
		$iteration = count($splitRecipients);
		$splitpay='';
    	
		// create another array with proper parameter names
		$p = 0; // variable used for the subscript of the payment number
		for ($x = 0; $x < $iteration; $x++)
		{
			$p++;
			$splitpay .= "&ap_recipient_email_$p=".urlencode($splitRecipients[$x]["receiver"])."&ap_recipient_amount_$p=".urlencode($splitRecipients[$x]["amount"])."&ap_recipient_payfees_$p=".urlencode($splitRecipients[$x]["payfees"]);
		}
	}

	$dataToSend .= $splitpay;

	$response = '';

	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, 'https://' . $server . $url);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $dataToSend);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_TIMEOUT, 30);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

	$response = curl_exec($ch);

	curl_close($ch);

	if($response)
	{
		// urldecode the response received from Payza into an associative array
		parse_str($response, $responseArray);
	}
	else
	{
		// something is wrong, no response is received from Payza
	}

}

?>

</body>
</html>
<style type="text/css">
	.editBox{ opacity: 0;     transition: all 0.5s ease 0s;}
	.deletBox{ display: none; }
	.row:hover .editBox{ opacity:1; }
</style>