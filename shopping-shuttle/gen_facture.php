<?php
	include("./includes/init_functions.php");
	
	$id_temp = $_GET['f'];
	
	// Recherche du SHA1 correspondant :
	$req = $bdd->query("	SELECT id_reservation
							FROM europa_reservation");
	
	$bool = false;
	while ($res = $req->fetch() and !$bool){
		if ($id_temp == sha1($res["id_reservation"])){
			$b = true;
			$id_reserv = $res["id_reservation"];
		}
	}
	
	$req->closeCursor();
	
	if (isset($id_reserv)){
	
		// Requete Reservation + Client
		$req = $bdd->query("	SELECT *
								FROM europa_reservation as r, europa_client as c, europa_lieu as l
								WHERE r.id_reservation = ".$id_reserv."
								AND r.id_client = c.id_client");
		
		$res = $req->fetch();
		
		//Info Client
		$nom_c = $res["nom"];
		$prenom_c = $res["prenom"];
		$ville_c = $res["ville"];
		$adresse_c = $res["adresse"];
		$code_postal_c = $res["cp"];
		$tel_fixe_c = $res["tel_fixe"];
		$tel_port_c = $res["tel_port"];
		$mail_c = $res["mail"];
		
		//Info réservation
		$date_r = $res["date"];
		$prix_r = $res["prix"];
		$type_aller_r = $res["type_lieu_aller"];
		$type_retour_r = $res["type_lieu_retour"];
		$adresse_aller_r = $res["adresse_aller"];
		$adresse_retour_r = $res["adresse_retour"];
		$date_aller_r = $res["date_aller"];
		$date_retour_r = $res["date_retour"];
		
		$req->closeCursor();
		
		// Requete Lieu Aller
		$req = $bdd->query("	SELECT nom_lieu
								FROM europa_lieu as l
								WHERE l.id_lieu = ".$type_aller_r."");
		
		$res = $req->fetch();
		
		$libelle_aller_r = $res["nom_lieu"];
		
		$req->closeCursor();
		
		// Requete Lieu Retour
		$req = $bdd->query("	SELECT nom_lieu
								FROM europa_lieu as l
								WHERE l.id_lieu = ".$type_retour_r."");
		
		$res = $req->fetch();
		
		$libelle_retour_r = $res["nom_lieu"];
		
		$req->closeCursor();
		
		// Requete TVA
		$req = $bdd->query("	SELECT valeur_option
								FROM roppenheim_option
								WHERE nom_option = 'tva'");
		
		$res = $req->fetch();
		
		$taux_tva = (double)$res["valeur_option"];
		
		$req->closeCursor();
		
		
		include("facture_tpl.php");
	
	}else{
		
		echo "Une erreur s'est produite. Merci de réessayer.";
		
	}
?>