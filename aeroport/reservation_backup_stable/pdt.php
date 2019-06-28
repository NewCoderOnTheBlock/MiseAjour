<?php
// read the post from PayPal system and add 'cmd'
$req = 'cmd=_notify-synch';

$tx_token = $_GET['tx'];

$auth_token = "dVHbYbQ9lF36qRxJOekXDmcYGUq5e96WeHXX3Rx0W9eqFdqPJJqR8jNuOLq";

// version de test
//$auth_token = "ukBo_QThfTUEp-G1fMVORy5CIiMN09kkhsMTq_7cM8p9m-GzYiBiA1LHZ8G";

$req .= "&tx=$tx_token&at=$auth_token";


// post back to PayPal system to validate
$header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";

$fp = fsockopen ('ssl://www.paypal.com', 443, $errno, $errstr, 30);


if (!$fp)
{
// HTTP ERROR
}
else
{
	fputs ($fp, $header . $req);
	// read the body data
	$res = '';
	$headerdone = false;
	while (!feof($fp))
	{
		$line = fgets ($fp, 1024);
		if (strcmp($line, "\r\n") == 0) 
		{
			// read the header
			$headerdone = true;
		}
		else if ($headerdone)
		{
			// header has been read. now read the contents
			$res .= $line;
		}
	}

	// parse the data
	$lines = explode("\n", $res);
	$keyarray = array();
	if (strcmp ($lines[0], "SUCCESS") == 0)
	{
		for ($i=1; $i<count($lines);$i++)
		{
			list($key,$val) = explode("=", $lines[$i]);
			$keyarray[urldecode($key)] = urldecode($val);
		}

		$custom = $keyarray['custom'];
		$custom_r = explode('|', $custom);
		$lang = $custom_r[3];
		
		header('Location: paiement.html?lang=' . $lang);
	}
	else if (strcmp ($lines[0], "FAIL") == 0)
	{
		// log for manual investigation
	}
}

fclose ($fp);

?>
