<?php
	include("./reservation/fonctionConnection.php");
	include("../includes/fonctions.php");
	include("../libs/db.php");
	
	$id_temp = $_GET['f'];
	
	// Recherche du SHA1 correspondant :
	$req = query("	SELECT id_paypal
					FROM aeroport_paypal");
	
	$bool = false;
	while ($res = $req->fetch() and !$bool){
		if ($id_temp == sha1($res["id_paypal"])){
			$b = true;
			$id_paypal = $res["id_paypal"];
		}
	}
	
	$req->closeCursor();
	
	//$id_paypal = $id_temp;
	
	if (isset($id_paypal)){
	
		// Récolte des informations
		$req = query("	SELECT type_trajet, id_depart, id_dest, id_pt_rass_aller, rass_adresse_aller, rass_cp_aller, rass_ville_aller, info_vol_aller, id_pt_rass_retour, rass_adresse_retour, rass_cp_retour, rass_ville_retour, info_vol_retour, date_depart, DATE_FORMAT(date_depart, '%d/%m/%Y') AS date_depart_mail, date_retour, DATE_FORMAT(date_retour, '%d/%m/%Y') AS date_retour_mail, heure_reel_aller, DATE_FORMAT(heure_reel_aller, '%Hh%i') AS heure_reel_aller_mail, heure_reel_retour, DATE_FORMAT(heure_reel_retour, '%Hh%i') AS heure_reel_retour_mail, passager_adulte_aller, passager_enfant_aller, bebe_aller, info_compl, passager_adulte_retour, passager_enfant_retour, bebe_retour, civilite, nom, prenom, email, fixe, portable, adresse, code_post, ville, pays, prix, chauffeur_aller, chauffeur_retour, vehicule_aller, vehicule_retour, existant_aller, existant_retour, prix_aller, prix_retour, supplement_aller, supplement_retour, is_der_min, res_der_min, ip, depart_fixe, retour_fixe, id_com_aller, id_com_retour, envoyer_mail, type_resa_aller, type_resa_retour, a_payer_aller, a_payer_retour, prov_dest_aller, prov_dest_retour, ind_fixe, ind_port
						FROM aeroport_paypal
						WHERE id_paypal = '" . $id_paypal . "'");
		
		$res = $req->fetch();
		
		//Info Client
		$civilite_c = $res["civilite"];
		$nom_c = $res["nom"];
		$prenom_c = $res["prenom"];
		$mail_c = $res["email"];
		$prix_total = $res["prix"];
		$tva = (double)get_option("tva");
		
		//Info réservation
		// ALLER
			$date_aller_ob = new DateTime($res["date_depart"]);
			$date_aller = $date_aller_ob->format("d/m/Y");
			$prix_aller = $res["prix_aller"];
			
			// On récupère le libellé du lieu de départ et d'arrivé
			$lieu_1_aller = get_lieu($res["id_depart"]);
			$lieu_2_aller = get_lieu($res["id_dest"]);
			
			// Surcout horaires non-fixes
			if ($res["depart_fixe"] == 0){
				$horaire_demande_aller = get_option("maj_surcout_demande");
			}
			
			// Surcout Domicile
			if ($res["id_pt_rass_aller"] == 4){
				$maj_dom_aller = get_option("maj_dom");
			}
		
		// RETOUR : On vérifie si il y a un trajet retour :
		if ($res["id_pt_rass_retour"] > 0){
			$date_retour_ob = new DateTime($res["date_retour"]);
			$date_retour = $date_retour_ob->format("d/m/Y");
			$prix_retour = $res["prix_retour"];
			
			$lieu_1_retour = $lieu_2_aller;
			$lieu_2_retour = $lieu_1_aller;
				
			// Surcout horaires non-fixes
			if ($res["retour_fixe"] == 0){
				$horaire_demande_retour = get_option("maj_surcout_demande");
			}
			
			// Surcout Domicile
			if ($res["id_pt_rass_retour"] == 4){
				$maj_dom_retour = get_option("maj_dom");
			}
		}
		
		// Surcout dernière minute
		if ($res["res_der_min"] == 1){
			$res_der_min = get_option("maj_".$res["is_der_min"]);
		}
			
		$req->closeCursor();
		
		// On lance la génération
		ob_start();
		include("facture_aeroport.php");
	
	}else{
		
		echo "Une erreur s'est produite. Merci de réessayer.";
		
	}
?>