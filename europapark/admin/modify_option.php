<?php 
	session_start();
	include("verifAuth.php");
	// connexion à la bdd
	include("connection.php");
	
	if(!empty($_POST['val']))
	{
		$valide = true;
		// Vérification pour les horaires de Royal palace :
		if ($_POST["table"] == "royal" && ($_POST['opt'] == "8" || $_POST['opt'] == "9" || $_POST['opt'] == "10" || $_POST['opt'] == "11" || $_POST['opt'] == "13" || $_POST['opt'] == "14")){
			
			if (preg_match('#^[0-2][0-9]:[0-5][0-9]$#', $_POST['val']) != 1){
				$valide = false;
			}
		}
		
		//
		if ($valide){
				if(!empty($_POST['outlet']))
		{
			$valide = false;
			$query = '	UPDATE '.$_POST["table"].'_outlet
						SET tarif_outlet = "'.$_POST['val'].'"
						WHERE id_outlet = '.$_POST['opt'].'';
								
			$result = mysql_query($query) or die (mysql_error());
			
			header("Location: index.php?p=2&msg=1&t=".$_POST["table"]."");
		}
		else
		{
			$query = '	UPDATE '.$_POST["table"].'_option
						SET valeur_option = "'.$_POST['val'].'"
						WHERE id_option = '.$_POST['opt'].'';
								
			$result = mysql_query($query) or die (mysql_error());
			
			header("Location: index.php?p=2&msg=1&t=".$_POST["table"]."");
		}
		}else{
		
			header("Location: index.php?p=2&msg=0&t=".$_POST["table"]."");
			
		}
	}
	else
	{
		header("Location: index.php?p=2&msg=0&t=".$_POST["table"]."");
	}
?>