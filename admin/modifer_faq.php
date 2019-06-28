<?php 
	session_start();
	include("verifAuth.php");
	// connexion à la bdd
	include("connection.php");
	
	$err = 1;
	
	if ($_POST['type_modif'] == "update"){
		
		if (!empty($_POST['question']) && !empty($_POST['question'])){
		
			$query = '	UPDATE aeroport_faq
						SET langue_faq = "'.$_POST['langue'].'", 
							reponse_faq = "'.$_POST['reponse'].'",
							question_faq = "'.$_POST['question'].'"
						WHERE id_faq = '.$_POST['id'].'';
								
			$result = mysql_query($query) or die (mysql_error());
		
		}else if (empty($_POST['question']) && empty($_POST['question'])){
			
			$query = '	DELETE FROM aeroport_faq
						WHERE id_faq = "'.$_POST['id'].'"';
								
			$result = mysql_query($query) or die (mysql_error());
			
		}else{
			$err = 0;
		}
	}else if($_POST['type_modif'] == "ajout"){
	
		if (!empty($_POST['question']) && !empty($_POST['question'])){
		
			$query = '	INSERT INTO aeroport_faq (langue_faq, reponse_faq, question_faq)
						VALUES ("'.$_POST['langue'].'", "'.$_POST['reponse'].'", "'.$_POST['question'].'")';
								
			$result = mysql_query($query) or die (mysql_error());
		
		}else{
			$err = 0;
		}
	}
		
	header("Location: index.php?p=173&msg=".$err."");
?>