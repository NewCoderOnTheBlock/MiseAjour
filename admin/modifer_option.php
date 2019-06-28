<?php 
	session_start();
	include("verifAuth.php");
	// connexion à la bdd
	include("connection.php");
	
	$valide = false;
	
	if(!empty($_POST['val']))
	{
		// On effectue toutes les vérifications nécessaires
			// Si ce sont des entiers simples
		if ($_POST['opt'] != 9 && $_POST['opt'] != 10){
			
			if ($_POST['opt'] != 15 && $_POST['opt'] != 16){
				
				if ($_POST['opt'] != 18 && $_POST['opt'] != 19 && $_POST['opt'] != 20){
					if (is_numeric($_POST['val']))
					{
						$valide = true;
					}
				}
				else{
				$valide = true;
				}
				
			}else{
				
				$valide = true;
				
			}
			
			
		}
			// Si ce sont des horaires (Ici pour les horaires de nuit)
		else{
			// Expression régulière : On repère si l'horaire est bien formaté
			if (preg_match('#^[0-2][0-9]:[0-5][0-9]$#', $_POST['val']) == 1){
				$valide = true;
			}
		}
	}
	
	if ($valide){
		$query = '	UPDATE aeroport_options
					SET val_option = "'.$_POST['val'].'"
					WHERE id_option = '.$_POST['opt'].'';
							
		$result = mysql_query($query) or die (mysql_error());
		
		header("Location: index.php?p=172&msg=1");
	}
	else
	{
		header("Location: index.php?p=172&msg=0");
	}
	
?>