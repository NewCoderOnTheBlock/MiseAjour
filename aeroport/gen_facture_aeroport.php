<?php
	/*
		Génération de facture 
		Par KEMPF
		
		Voir table : aeroport_facture
	*/

	include("./reservation/fonctionConnection.php");
	include("../includes/fonctions.php");
	include("../libs/db.php");
	
	$fac_id_temp = $_GET['f'];
	
	// Recherche du SHA1 correspondant :
	$fac_req = query("	SELECT id_facture
						FROM aeroport_facture");
	
	$fac_bool = false;
	while ($fac_res = $fac_req->fetch() and !$fac_bool){
		if ($fac_id_temp == sha1($fac_res["id_facture"])){
			$fac_bool = true;
			$fac_id_facture = $fac_res["id_facture"];
		}
	}
	
	$fac_req->closeCursor();
	
	if (isset($fac_id_facture)){
	
		// Récolte des informations
		$fac_req = query("	SELECT *
						FROM aeroport_facture
						WHERE id_facture = '" . $fac_id_facture . "'");
		
		$fac_res = $fac_req->fetch();
		
		//Info Client
		$fac_civilite_c = $fac_res["civilite"];
		$fac_nom_c = $fac_res["nom"];
		$fac_prenom_c = $fac_res["prenom"];
		$fac_mail_c = $fac_res["email"];
		
		$fac_adresse = $fac_res["adresse_facture"];
		$fac_adresse = empty($fac_adresse) ? "" : "<br /><i>".$fac_adresse."</i><br />";
		
		$fac_prix_total = $fac_res["prix_total"];
		$fac_tva = (double)$fac_res["tva"];
		$fac_langue = $fac_res["lang"];
		
		list($f_d, $f_m, $f_y) = split('[/-]', $fac_res["date_res"]);
		$fac_date_res = ($fac_langue == "fr") ? (sprintf("%02d", $f_d)."-".sprintf("%02d", $f_m)."-".$f_y) : ($f_y."-".sprintf("%02d", $f_m)."-".sprintf("%02d", $f_d));
		
		$fac_taux_maj_nuit = intval(get_option("maj_horaire_nuit"));
		$taux_remise_8_pers = intval(get_option("remise_pourcent_8_pers"));
		$fac_remise_8_pers_aller = 0;
		$fac_remise_8_pers_retour = 0;
		
		//Info réservation
		// ALLER
		list($f_d, $f_m, $f_y) = split('[/-]', $fac_res["date_aller"]);
		$fac_date_aller = ($fac_langue == "fr") ? (sprintf("%02d", $f_d)."-".sprintf("%02d", $f_m)."-".$f_y) : ($f_y."-".sprintf("%02d", $f_m)."-".sprintf("%02d", $f_d));
		
		$fac_prix_aller = $fac_res["prix_aller"];
		$fac_nb_pers_aller = $fac_res["nb_pers_aller"];
		
		// On récupère le libellé du lieu de départ et d'arrivé
		$fac_lieu_1_aller = $fac_res["lieu_1_aller"];
		$fac_lieu_2_aller = $fac_res["lieu_2_aller"];
		
		// Surcout horaires non-fixes
		if (!empty($fac_res["horaire_demande_aller"])){
			$fac_horaire_demande_aller = $fac_res["horaire_demande_aller"];
		}
		
		// Surcout Domicile
		if (!empty($fac_res["maj_dom_aller"])){
			$fac_maj_dom_aller = $fac_res["maj_dom_aller"];
		}
		
		// Surcout nuit
		if ($fac_res["nuit_aller"] == 1){
			$fac_maj_nuit_aller = $fac_taux_maj_nuit;
		}
		// Remise 8 personnes
		if ($fac_nb_pers_aller == 8){
			$fac_remise_8_pers_aller = floor($fac_prix_aller*$taux_remise_8_pers/100);
		}
		
		// RETOUR : On vérifie si il y a un trajet retour :
		if ($fac_res["prix_retour"] != 0){
			list($f_d, $f_m, $f_y) = split('[/-]', $fac_res["date_retour"]);
			$fac_date_retour = ($fac_langue == "fr") ? (sprintf("%02d", $f_d)."-".sprintf("%02d", $f_m)."-".$f_y) : ($f_y."-".sprintf("%02d", $f_m)."-".sprintf("%02d", $f_d));
			
			$fac_prix_retour = $fac_res["prix_retour"];
			$fac_nb_pers_retour = $fac_res["nb_pers_retour"];
			
			$fac_lieu_1_retour = $fac_res["lieu_1_retour"];
			$fac_lieu_2_retour = $fac_res["lieu_2_retour"];
				
			// Surcout horaires non-fixes
			if (!empty($fac_res["horaire_demande_retour"])){
				$fac_horaire_demande_retour = $fac_res["horaire_demande_retour"];
			}
			
			// Surcout Domicile
			if (!empty($fac_res["maj_dom_retour"])){
				$fac_maj_dom_retour = $fac_res["maj_dom_retour"];
			}
			
			// Surcout nuit
			if ($fac_res["nuit_retour"] == 1){
				$fac_maj_nuit_retour = $fac_taux_maj_nuit;
			}
			// Remise 8 personnes
			if ($fac_nb_pers_retour == 8){
				$fac_remise_8_pers_retour = floor($fac_prix_retour*$taux_remise_8_pers/100);
			}
		}
		
		// Surcout dernière minute
		if (!empty($fac_res["res_der_min"])){
			$fac_res_der_min = $fac_res["res_der_min"];
		}
		
		// Surcout attente aéroport
		if(!empty($fac_res["supplement_attente"])){
			$fac_res_attente = $fac_res["supplement_attente"];
		}
			
		// Eventuel supplément
		$fac_diff = $fac_prix_total - (($fac_prix_aller + $fac_prix_retour + $fac_horaire_demande_aller + $fac_maj_dom_aller + $fac_horaire_demande_retour + $fac_maj_dom_retour + $fac_res_der_min + $fac_maj_nuit_retour + $fac_maj_nuit_aller + $fac_res_attente) - ($fac_remise_8_pers_aller + $fac_remise_8_pers_retour));
		if ($fac_diff > 0){
			$fac_supplement = $fac_diff;
		}elseif ($fac_diff < 0){
			$fac_remise = $fac_diff;
		}
		
		$fac_req->closeCursor();
		
		// On lance la génération
		ob_start();
		include("./includes/".$fac_langue.".lang.php");
		include("facture_aeroport.php");
	
	}else{
		
		echo "
			Une erreur s'est produite. Merci de réessayer ou de contacter nos services.
			<br /><br />
			An error has occured. Please try again, or contact our services.
			<br /><br />
			Alsace-Navette.com
			<br />
			2 rue du Coq
			<br />
			67000 STRASBOURG
			<br />
			Tel : +33 (0)3 88 22 22 71
			<br />
			info@alsace-navette.com";
		
	}
?>