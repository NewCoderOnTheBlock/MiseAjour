<?php

//permet de traiter le retour ipn de paypal
// lire la publication du système PayPal et ajouter 'cmd'

@set_time_limit(300);

require_once("./includes/init_functions.php");

$req = 'cmd=_notify-validate';
 
foreach ($_POST as $key => $value)
{
	$value = urlencode(stripslashes($value));
	$req .= "&$key=$value";
}
 
// renvoyer au système PayPal pour validation
$header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
 
//www.sandbox.paypal.com pour la phase de test
//www.paypal.com pour la phase réel.
$fp = fsockopen ('ssl://www.paypal.com', 443, $errno, $errstr, 30);
//$fp = fsockopen ('ssl://ipnpb.paypal.com', 443, $errno, $errstr, 30);

// assign posted variables to local variables
$item_name = $_POST['item_name'];
$item_number = $_POST['item_number'];
$payment_status = $_POST['payment_status'];
$mc_gross = $_POST['mc_gross'];
$txn_id = $_POST['txn_id'];
$quantity = $_POST['quantity'];
$payment_date = $_POST['payment_date'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$payment_type = $_POST['payment_type'];
$payer_email = $_POST['payer_email'];
$address_street = $_POST['address_street'];
$address_city = $_POST['address_city'];
$address_state = $_POST['address_state'];
$address_zip = $_POST['address_zip'];
$address_country = $_POST['address_country'];
$tax = $_POST['tax'];
$option_name1 = $_POST['option_name1'];
$option_selection1 = $_POST['option_selection1'];
$option_name2 = $_POST['option_name2'];
$option_selection2 = $_POST['option_selection2'];
$mc_fee = $_POST['mc_fee'];
$pending_reason = $_POST['pending_reason'];
$reason_code = $_POST['reason_code'];
$memo = $_POST['memo'];

//email 
$notify_email =  "info@alsace-navette.com";         //email address to which debug emails are sent to

if (!$fp)
{

} 
else
{
	/*
		Code de test
	*/
	// si le paiement à réussi, on modifie la réservation dans la base (est_payee)
	/*if($payment_status != "Refunded")
	{	
		$custom = $_POST['custom'];
		
		$custom_r = explode('|', $custom);
		
		$id_reserv = $custom_r[0];
		
		$array_client = get_info_client($id_client);
		
		set_reservation_paye($id_reserv, 1);
	}*/
	
	
	fputs ($fp, $header . $req);
	
	while (!feof($fp))
	{
	
		$res = fgets ($fp, 1024);
		if (strcmp ($res, "VERIFIED") == 0)
		{
		
            // On envoie un email pour prévenir qu'une commande a ete passee
			
			$fecha = date("m")."/".date("d")."/".date("Y");
			$fecha = date("Y").date("m").date("d");
			
			// Check if transaction ID has been processed before
			$checkquery = "	SELECT txnid 
							FROM paypal_payment_info 
							WHERE txnid='".$txn_id."'";
			$sihay = $bdd->query($checkquery);
			
			$nm = $sihay->rowCount();
			
			$sihay->closeCursor();
			
			if ($nm == 0)
			{
			
				//execute query
				
				$bdd->query("insert into paypal_payment_info(paymentstatus,buyer_email,firstname,lastname,street,city,state,zipcode,country,mc_gross,mc_fee,itemnumber,itemname,os0,on0,os1,on1,quantity,memo,paymenttype,paymentdate,txnid,pendingreason,reasoncode,tax,datecreation) values ('".$payment_status."','".$payer_email."','".$first_name."','".$last_name."','".$address_street."','".$address_city."','".$address_state."','".$address_zip."','".$address_country."','".$mc_gross."','".$mc_fee."','".$item_number."','".$item_name."','".$option_name1."','".$option_selection1."','".$option_name2."','".$option_selection2."','".$quantity."','".$memo."','".$payment_type."','".$payment_date."','".$txn_id."','".$pending_reason."','".$reason_code."','".$tax."','".$fecha."')");

				// si le paiement à réussi, on modifie la réservation dans la base (est_payee)
				if($payment_status != "Refunded")
				{	
					$custom = $_POST['custom'];
					$custom .= "|PayPal";
					
					traitementPayement($custom);
				}
			}
			else
			{
				if($payment_status != "Refunded")
				{
					// send an email
					if($mode_paypal == "online")
						//@mail($notify_email, "VERIFIED DUPLICATED TRANSACTION", "$res\n $req \n $strQuery\n $struery\n  $strQuery2");
				}
			}
		}
		else if (strcmp ($res, "INVALID") == 0)
		{
			// consigner pour étude manuelle
			
			if($mode_paypal == "online")
				//@mail($notify_email, "INVALID IPN", "$res\n $req", $headerMail);
		}
	}
	
	fclose ($fp);
}


?>
