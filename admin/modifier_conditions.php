<?php 
	session_start();
	include("verifAuth.php");
	// connexion à la bdd
	include("connection.php");
	
	$valide = false;
	
	if(!empty($_POST['val']))
	{
		$valide = true;
	}
	
	if ($valide){
		$query = '	UPDATE aeroport_cgv
					SET val_cgv = "'.$_POST['val'].'"
					WHERE id_cgv = '.$_POST['opt'].'';
							
		$result = mysql_query($query) or die (mysql_error());
		
		header("Location: index.php?p=257&msg=1");
	}
	else
	{
		header("Location: index.php?p=257&msg=0");
	}
	
?>