<?php
	include("verifAuth.php");
?>

<?php
	// connexion à la bdd
	include("connection.php");
	$qui = $_POST['qui'];
	
	
	
	//////////////////////////////////////////////////CONDUCTEUR///////////////////////////////////////////////////////
	if($qui == 'conducteur'){
		$idConducteur = $_POST['idConducteur'];
		
		$req = "INSERT INTO aeroport_conducteurs_exclus VALUE ('".$idConducteur."')";
		mysql_query($req);
		
		$updateAgenda = "UPDATE agenda_utilisateur set util_passwd = 'abcd', util_login = '".$idConducteur."' WHERE util_id = '".$idConducteur."'";
		mysql_query($updateAgenda);
		
		$delete_droit = "DELETE FROM agenda_droit WHERE droit_util_id = " . $idConducteur;
		mysql_query($delete_droit);
		
	}
	
	//////////////////////////////////////////////////ADMINISTRATIF/////////////////////////////////////////////////////
	elseif($qui == 'bureau'){
		$idBureau = $_POST['idBureau'];
			//
			$updateAgenda = "UPDATE agenda_utilisateur set util_passwd = 'abcdefg', util_login = '".$idBureau."' WHERE util_id = '".$idBureau."'";
			
			$req = "INSERT INTO aeroport_administratifs_exclus VALUE ('".$idBureau."')";
			mysql_query($req);
			
			$updateAgenda = "UPDATE agenda_utilisateur set util_passwd = 'abcd', util_login = '".$idBureau."' WHERE util_id = '".$idBureau."'";
			mysql_query($updateAgenda);
			
			$delete_droit = "DELETE FROM agenda_droit WHERE droit_util_id = " . $idBureau;
			mysql_query($delete_droit);
	}