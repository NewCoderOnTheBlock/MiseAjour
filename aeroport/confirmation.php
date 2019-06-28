<?php
	session_start();
	
	@set_time_limit(300);
	
	require_once('../includes/tpl_base.php');
	require_once("traitement.php");
	
	
	if(isset($_POST['res_4']) && !isset($_SESSION['fin_resa']))
	{
		$custom = $_SESSION['id_paypal'] . '|';
		
		if($_SESSION['logger'])
			$custom .= $_SESSION['client']['id_client'] . '|1';
		else
			$custom .= '0|0';
			
		$custom .= '|' . $_SESSION['lang'] . '|1|0|0|0|0|0';
		

        if($_SESSION['client']['pro'] == 1)
            traitement($custom, $_SESSION['mode'], 'Pro');
        else
            traitement($custom, $_SESSION['mode'], '');
		
		// KEMPF : On garde les informations en mémoire pour pouvoir les réutiliser plus tard
		//write("DELETE FROM aeroport_paypal WHERE id_paypal = '" . $_SESSION['id_paypal'] . "'");
		
	
		$_SESSION['debut_resa'] = "0";

		unset($_SESSION['debut_resa']);
		unset($_SESSION['res_der_min']);
		
		$_SESSION['fin_resa'] = "1";

		header('Location: paiement.html');
		exit();
	}
	else
	{
		header('Location: ../index.html');
		exit();
	}



?>