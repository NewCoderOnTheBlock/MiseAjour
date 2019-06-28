<?php

	session_start();
	
	if(!$_SESSION['logger'])
	{
		header('Location: client.html');
		exit();
	}
		
	require_once('../includes/tpl_base.php');
	
	$db = mysql_connect('db922.1and1.fr', 'dbo206617947', 'D5ZEtV4h');
	mysql_select_db('db206617947');
	$req = mysql_query("SELECT count(*) FROM aeroport_facture WHERE email='".$_SESSION['client']['mail']."'");
	
	for($i = 0; $i<mysql_num_rows($req); $i++)
	{
		if( isset($POST['civilite'.$i]) && isset($POST['nom'.$i]) && isset($POST['prenom'.$i]))
		{
			$sql = "UPDATE aeroport_facture SET adresse_facture='"."1|".$POST['civilite'.$i]."|".$POST['nom'.$i]."|".$POST['prenom'.$i]."' WHERE id_facture='".$POST['id_facture'.$i]."'";
			$maj = query($sql);
			
		}

		else if( isset($POST['adresse'.$i]) && isset($POST['ville'.$i]) && isset($POST['cp'.$i]))
		{
		
			$sql="UPDATE aeroport_facture SET adresse_facture='"."2|".$POST['adresse'.$i]."|".$POST['ville'.$i]."|".$POST['cp'.$i]."|France' WHERE id_facture='".$POST['id_facture'.$i]."'";
			$maj = query($sql);
			
		}
		else if( isset($POST['adresse'.$i]) &&  isset($POST['ville'.$i]) && isset($POST['cp'.$i]) && isset($POST['pays'.$i]))
		{
			$sql="UPDATE aeroport_facture SET adresse_facture='"."2|".$POST['adresse'.$i]."|".$POST['ville'.$i]."|".$POST['cp'.$i]."|".$POST['pays'.$i]."' WHERE id_facture='".$POST['id_facture'.$i]."'";
			$maj = query($sql);
			
		}

		else if( isset($POST['civilite'.$i]) && isset($POST['nom'.$i]) && isset($POST['prenom'.$i]) && isset($POST['adresse'.$i]) && isset($POST['ville'.$i]) && isset($POST['cp'.$i]))
		{
			$sql = "UPDATE aeroport_facture SET adresse_facture='"."3|".$POST['civilite'.$i]."|".$POST['nom'.$i]."|".$POST['prenom'.$i]."|".$POST['adresse'.$i]."|".$POST['ville'.$i]."|".$POST['cp'.$i]."|France' WHERE id_facture='".$POST['id_facture'.$i]."'";
			$maj = query($sql);
			
		}

		else if( isset($POST['civilite'.$i]) && isset($POST['nom'.$i]) && isset($POST['prenom'.$i]) && isset($POST['adresse'.$i]) && isset($POST['ville'.$i]) && isset($POST['cp'.$i]) && isset($POST['pays'.$i]))
		{
			$sql = "UPDATE aeroport_facture SET adresse_facture='".$POST['civilite'.$i]."|".$POST['nom'.$i]."|".$POST['prenom'.$i]."|".$POST['adresse'.$i]."|".$POST['ville'.$i]."|".$POST['cp'.$i]."|".$POST['pays'.$i]."' WHERE id_facture='".$POST['id_facture'.$i]."'";
			$maj = query($sql);

		}
		else
		{
		}
	}
?>