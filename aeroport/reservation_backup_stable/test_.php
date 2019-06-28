<?php
	$dirname = dirname(__FILE__);

	require_once($dirname . "/../../libs/config.php");	
	require_once($dirname . "/../../libs/db.php");
	require_once($dirname . "/../../includes/fonctions.php");
	
	function ajouterFacture($id_paypal, $lang)
	{	
		// On récupère l'ID de la facture et on le remet à jour
		$id_facture = intval(get_option("id_max_facture"));
		set_option("id_max_facture", ($id_facture + 1));
		
		// TVA
		$fac_tva = intval(get_option("tva"));
		
		// Récupération de la majoration à la demande
		$taux_demande = intval(get_option("maj_surcout_demande"));
		
		// Récupération de la majoration à domicile
		$taux_domicile = intval(get_option("maj_surcout_demande"));
	
		// Récupère toutes les données pour la facture		
		$req = query("	SELECT *,
						DATE_FORMAT(date_depart, '%d-%m-%Y') AS date_aller_f,
						DATE_FORMAT(date_retour, '%d-%m-%Y') AS date_retour_f
						FROM aeroport_paypal
						WHERE id_paypal = '" . $id_paypal . "'");
						
		$r = $req->fetch();
		
		// Récupération des lieux
		$fac_lieu_1_aller = get_lieu(intval($r['id_depart']));
		$fac_lieu_2_aller = get_lieu(intval($r['id_dest']));
				
		$fac_civilite = $r['civilite'];
		$fac_nom = $r['nom'];
		$fac_prenom = $r['prenom'];
		$fac_mail = $r['email'];
		$fac_prix_total = $r['prix'];
		$fac_date_aller = $r['date_aller_f'];
		$fac_prix_aller = $r['prix_aller'];
		$fac_demande_aller = ($r['depart_fixe'] == 0) ? $taux_demande : 0;
		$fac_domicile_aller = ($r['id_pt_rass_aller'] == 4) ? $taux_domicile : 0;
		$fac_date_retour = $r['date_retour_f'];
		$fac_prix_retour = $r['prix_retour'];
		$fac_lieu_1_retour = $fac_lieu_2_aller;
		$fac_lieu_2_retour = $fac_lieu_1_aller;
		$fac_demande_retour = ($r['retour_fixe'] == 0) ? $taux_demande : 0;
		$fac_domicile_retour = ($r['id_pt_rass_retour'] == 4) ? $taux_domicile : 0;
		$fac_der_minute = $r['is_der_min'];
		$fac_langue = $lang;
		$fac_valide = 1;
		
		$req->closeCursor();
		
		$sql = "INSERT INTO
					aeroport_facture
				VALUES (
					'" . $id_facture . "',
					'" . $fac_civilite . "', 
					'" . $fac_nom . "', 
					'" . $fac_prenom . "', 
					'" . $fac_mail . "', 
					'" . $fac_prix_total . "',
					'" . $fac_tva . "',
					'" . $fac_date_aller . "',
					'" . $fac_prix_aller . "',
					'" . $fac_lieu_1_aller . "',
					'" . $fac_lieu_2_aller . "',
					'" . $fac_demande_aller . "',
					'" . $fac_domicile_aller . "',
					'" . $fac_date_retour . "',
					'" . $fac_prix_retour . "',
					'" . $fac_lieu_1_retour . "',
					'" . $fac_lieu_2_retour . "',
					'" . $fac_demande_retour . "',
					'" . $fac_domicile_retour . "',
					'" . $fac_der_minute . "',
					'" . date('d-m-Y') . "',
					'" . $fac_langue . "',
					'" . $fac_valide . "')";
					
		write($sql);
		
		return $id_facture;
	}
	
	echo ajouterFacture(3054, "fr");
?>