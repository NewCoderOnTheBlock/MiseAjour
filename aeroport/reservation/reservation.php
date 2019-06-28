<?php
/*
 * Nom du fichier : reservation.php
 * 
 * 
 * Objectif :Creer le template de la page 4/5
 * Remarques : toutes ces variables indiquent le passager qui n'est pas celui qui reserve 
 * 
 * 			$_SESSION['lstIndicatifTelephone']=$_POST['lstIndicatifTelephone'];
			$_SESSION['txtPortable']=$_POST['txtPortable'];
			$_SESSION['txtNom']=$_POST['txtNom'];
 * **/
	session_start();
	
	// Ajout KEMPF : Une variable de session pour savoir que l'on viens de RESERVATION lorsque l'on fait précédent
	$_SESSION['est_alle_page_reservation'] = true;
	
	require_once('../includes/tpl_base.php');
	require_once('fonctionConnection.php');
	
	if(!isset($btn_etape_suivante)){
		$btn_etape_suivante			= 0;
		$type_reservation			= 0;
		$supplement_res_der_min2	= 0;
		$remise_promo				= 0;
		$forfait_mini_aller			= 0;
		$forfait_mini_retour		= 0;
	}
	if(!isset($_SESSION['etat_retour']['type_reservation'])){
		$_SESSION['etat_retour']['type_reservation']="";
	}
	if(isset($_SESSION['trajet']))
	{
		// le fil d'ariane
		$tab_ariane = array(
							array(
								'ARIANE' => $ariane_accueil,
								'LIEN' => 'index.html'
								),
							array(
								'ARIANE' => $ariane_reserver,
								'LIEN' => 'reserver.html'
								),
							array(
								'ARIANE' => $ariane_reservation_2,
								'LIEN' => ''
								)
							);
							
		foreach($tab_ariane as $tab)
		{
			$tpl->setBlock('fil', array(
										'ARIANE' => $tab['ARIANE'],
										'LIEN' => $tab['LIEN']
										)
							);
		}
		if(isset($_POST['code_promo'])){
			$_SESSION['code_promo']['nom'] = $_POST['code_promo'];
		}
		else
		{
			$_SESSION['code_promo']['nom']="Nada";
		}
        // récupération des infos de l'aller
        
		if(!isset($_POST['formulaire_promo']))
		{
		
			/*if($_SESSION['trajet']['type_trajet'] == '1')
			{
				$type_reservation = "RAJOUT";

				if(isset($_POST['accept_forfait_mini']) && $_POST['accept_forfait_mini'] == "on")
					$type_reservation = "FORFAIT";


				// on attend pour l'aller
				if(isset($_POST['attendre']) && $_POST['attendre'] == "on")
					$type_reservation = "ATTENDRE";

				if(isset($_POST['rb_navette']))
					$_SESSION['etat_aller']['rb_navette'] = $_POST['rb_navette'];
				else
					$_SESSION['etat_aller']['rb_navette'] = "";

				$_SESSION['etat_retour']['rb_navette'] = "";


				// si on choisi une navette existante

				if($_POST['navette_dispo'] == 1)
				{
					$t = get_navette(intval($_POST['rb_navette']));

					$_SESSION['vehicule_id_aller'] = $t['vehicule'];
					$_SESSION['chauffeur_id_aller'] = $t['chauffeur'];
					$_SESSION['trajet']['heure_depart'] = $t['date'];
				}

				$_SESSION['vehicule_id_retour'] = "";
				$_SESSION['chauffeur_id_retour'] = "";
				$_SESSION['trajet']['heure_retour'] = "";
				$_SESSION['etat_retour']['type_reservation'] = "";

				$_SESSION['id_com_retour'] = 0;


				$_SESSION['etat_aller']['type_reservation'] = $type_reservation;


				if($_SESSION['trajet']['pt_rass_aller'] == 4)
				{
					$_SESSION['etat_aller']['distance'] = intval($_POST['distance']);
					$_SESSION['etat_aller']['decalage'] = intval($_POST['decalage']);
				}

				$_SESSION['etat_retour']['distance'] = 0;
				$_SESSION['etat_retour']['decalage'] = 0;
			}
			else
			{
				$type_reservation = "RAJOUT";

				if(isset($_POST['accept_forfait_mini']) && $_POST['accept_forfait_mini'] == "on")
					$type_reservation = "FORFAIT";


				// on attend pour le retour
				if(isset($_POST['attendre']) && $_POST['attendre'] == "on")
					$type_reservation = "ATTENDRE";

				if(isset($_POST['rb_navette']))
					$_SESSION['etat_retour']['rb_navette'] = $_POST['rb_navette'];
				else
					$_SESSION['etat_retour']['rb_navette'] = "";


				// si on choisi une navette existante

				if($_POST['navette_dispo'])
				{
					$t = get_navette(intval($_POST['rb_navette']));

					$_SESSION['vehicule_id_retour'] = $t['vehicule'];
					$_SESSION['chauffeur_id_retour'] = $t['chauffeur'];
					$_SESSION['trajet']['heure_retour'] = $t['date'];
				}

				if($_SESSION['etat_aller']['rajout'])
				{
					$_SESSION['vehicule_id_aller'] = $_SESSION['etat_aller']['vehicule'];
					$_SESSION['chauffeur_id_aller'] = $_SESSION['etat_aller']['chauffeur'];
					$_SESSION['trajet']['heure_depart'] = $_SESSION['etat_aller']['heure_depart'];
				}


				$_SESSION['etat_retour']['type_reservation'] = $type_reservation;

				if($_SESSION['trajet']['pt_rass_retour'] == 4)
				{
					$_SESSION['etat_retour']['distance'] = intval($_POST['distance']);
					$_SESSION['etat_retour']['decalage'] = intval($_POST['decalage']);
				}
			}*/
		}
		
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$_SESSION['client']['civilite'] = htmlspecialchars($_POST['lst_civ']);
			$_SESSION['client']['nom'] = htmlspecialchars($_POST['nom_client']);
			$_SESSION['client']['prenom'] = htmlspecialchars($_POST['prenom_client']);
			$_SESSION['client']['mail'] = htmlspecialchars($_POST['email_client']);
			$_SESSION['client']['tel_fixe'] = htmlspecialchars($_POST['tel_client']);
			$_SESSION['client']['tel_port'] = htmlspecialchars($_POST['port_client']);
            $_SESSION['client']['ind_port'] = htmlspecialchars($_POST['indicatif_port']);
			$_SESSION['client']['ind_fixe'] = htmlspecialchars($_POST['indicatif_fixe']);
		}
		
		$query = "SELECT * FROM aeroport_code_promo WHERE nom_promo ='" . $_SESSION['code_promo']['nom']."' AND date_debut < NOW() AND date_fin > NOW()";
				  
		$statement=Connectbdd()->prepare($query);
		$statement->execute();
		$result=$statement->fetchAll();
		
		$_SESSION['code_promo']['bool'] = false;
		foreach($result as $r)
		{
			$repetition = $r['repetition'];
			if($r['repetition'] == '1')
			{
				if($r['identifiant'] == '1')
				{
					if($r['email'] == $_SESSION['client']['mail'])
					{
						$_SESSION['code_promo']['bool'] = true;
						$_SESSION['code_promo']['condition'] = $r['condition'];
						$_SESSION['code_promo']['effet'] = $r['effet'];
						$_SESSION['code_promo']['montant'] = $r['montant'];
					}
					else
					{
						$_SESSION['code_promo']['bool'] = false;
					}
				}
				else
				{
					$_SESSION['code_promo']['bool'] = true;
					$_SESSION['code_promo']['condition'] = $r['condition'];
					$_SESSION['code_promo']['effet'] = $r['effet'];
					$_SESSION['code_promo']['montant'] = $r['montant'];				
				}
			}
			else
			{
				if($r['compteur'] == '1')
				{
					$_SESSION['code_promo']['bool'] = false;
				}
				else
				{
					if($r['identifiant'] == '1')
					{
						if($r['email'] == $_SESSION['client']['mail'])
						{
							$_SESSION['code_promo']['bool'] = true;
							$_SESSION['code_promo']['condition'] = $r['condition'];
							$_SESSION['code_promo']['effet'] = $r['effet'];
							$_SESSION['code_promo']['montant'] = $r['montant'];
						}
						else
						{
							$_SESSION['code_promo']['bool'] = false;
						}
					}
					else
					{
						$_SESSION['code_promo']['bool'] = true;
						$_SESSION['code_promo']['condition'] = $r['condition'];
						$_SESSION['code_promo']['effet'] = $r['effet'];
						$_SESSION['code_promo']['montant'] = $r['montant'];				
					}				
				}
			}
		}
		
		if($_SESSION['code_promo']['bool'] == true && $repetition == '0')
		{
			$query2 = "UPDATE aeroport_code_promo SET compteur = '1' WHERE nom_promo = '".$_SESSION['code_promo']['nom']."'";
			$statement=Connectbdd()->prepare($query2);
			$statement->exec();
			$result2=$statement->fetchAll();
		}
		
        $type_res_min = "";


		$tab_date_depart = explode('-', $_SESSION['trajet']['date_depart']);
		

		$annee_depart = intval($tab_date_depart[2]);
		$mois_depart = intval($tab_date_depart[1]);
		$jour_depart = intval($tab_date_depart[0]);

		$format_date_aller = "'" . $annee_depart . "-" . $mois_depart . "-" . $jour_depart . " " . $_SESSION['trajet']['heure_depart'] . "'";
		$format_date_aller_final = substr($format_date_aller, 1, (strlen($format_date_aller) - 2)). ':00';


		if($_SESSION['trajet']['type_trajet'] == 0)
		{

			$tab_date_retour = explode('-', $_SESSION['trajet']['date_retour']);
			
			$annee_retour = intval($tab_date_retour[2]);
			$mois_retour = intval($tab_date_retour[1]);
			$jour_retour = intval($tab_date_retour[0]);
			
			$format_date_retour = "'" . $annee_retour . "-" . $mois_retour . "-" . $jour_retour . " " . $_SESSION['trajet']['heure_retour'] . "'";
			$format_date_retour_final = substr($format_date_retour, 1, (strlen($format_date_retour) - 2)). ':00';
		}
		else
			$format_date_retour = "";
			$format_date_retour_final = "";
		
		

		
		$nb_pers_aller = ($_SESSION['trajet']['passager_adulte_aller'] + $_SESSION['trajet']['passager_enfant_aller']);
		$nb_pers_retour = ($_SESSION['trajet']['passager_adulte_aller'] + $_SESSION['trajet']['passager_enfant_aller']);
		
			
		// calcul du prix

		$majoration_derniere_minute = 0;
		$majoration_domicile = 0;
		$prix_prise_aller = 0;
		$prix_prise_retour = 0;
        $prix_km_domicile = floatval(get_option("maj_dom_km"));
		$navette_aller = false;
		$navette_retour = false;
		$maj_der_min_72 = false;
		$maj_der_min_24 = false;
		$maj_dom_aller = false;
		$maj_dom_retour = false;
		
		$txt_der_min_72 = intval(get_option("maj_72"));
		$txt_der_min_24 = intval(get_option("maj_24"));

        $txt_prix_prise_dom_gen = intval(get_option("maj_dom")); // cout domicile si adresse pas trouvé ou sur strasbourg

		if($_SESSION['trajet']['pt_rass_aller'] == 4)
		{
			$maj_dom_aller = true;

			if($_SESSION['etat_aller']['distance'] <= 10000)
			{
				$prix_prise_aller = $txt_prix_prise_dom_gen;
				if($_SESSION['code_promo']['bool'] == true && $_SESSION['code_promo']['condition'] == 'prise_domicile')
				{
					$remise_promo += 10;
				}
				
				$majoration_domicile += $prix_prise_aller;
			}
			else
			{
				$prix_prise_aller = (floor(($_SESSION['etat_aller']['distance'] / 1000))) * $prix_km_domicile;
				if($_SESSION['code_promo']['bool'] == true && $_SESSION['code_promo']['condition'] == 'prise_domicile')
				{
					$remise_promo += 10;
				}
				
				$majoration_domicile += $prix_prise_aller;
			}
		}
		
		if($_SESSION['trajet']['type_trajet'] == 0 && $_SESSION['trajet']['pt_rass_retour'] == 4)
		{
			$maj_dom_retour = true;
			
			if($_SESSION['etat_retour']['distance'] <= 10000)
			{
				$prix_prise_retour = $txt_prix_prise_dom_gen;
				if($_SESSION['code_promo']['bool'] == true && $_SESSION['code_promo']['condition'] == 'prise_domicile')
				{
					$remise_promo += 10;
				}
				
				$majoration_domicile += $prix_prise_retour;
			}
			else
			{
				$prix_prise_retour = (floor(($_SESSION['etat_retour']['distance'] / 1000))) * $prix_km_domicile;
				if($_SESSION['code_promo']['bool'] == true && $_SESSION['code_promo']['condition'] == 'prise_domicile')
				{
					$remise_promo += 10;
				}
				
				$majoration_domicile += $prix_prise_retour;
			}
		}

        $tab_date_depart = explode('-', $_SESSION['trajet']['date_depart']);
        $tab_dbl_pt = explode(":", $_SESSION['trajet']['heure_depart']);

		$diff = mktime(intval($tab_dbl_pt[0]), intval($tab_dbl_pt[1]), 0, $mois_depart, $jour_depart, $annee_depart) - time();

		if($diff <= 3600*24)
		{
			$type_res_min = "24";
			$maj_der_min_24 = true;
			$majoration_derniere_minute = $txt_der_min_24;
			if($_SESSION['code_promo']['bool'] == true && $_SESSION['code_promo']['condition'] == 'res_der_24')
			{
				$remise_promo += 14;
			}
		}
		elseif($diff > 3600*24 && $diff <= 3600*72)
		{
			$type_res_min = "72";
			$maj_der_min_72 = true;
			$majoration_derniere_minute = $txt_der_min_72;
			if($_SESSION['code_promo']['bool'] == true && $_SESSION['code_promo']['condition'] == 'res_der_72')
			{
				$remise_promo += 7;
			}
		}

		
		
		$prix_total_aller = 0;
        $prix_total_retour = 0;
		/* KEMPF : Ajout de la gestion de majoration pour les jours feriés, etc... */
		$majoration_jour_special_aller = 0;
		$majoration_jour_special_retour = 0;
		
		$prix_aller = 0;
		$prix_retour = 0;
		$supplement = 0;
		$remise = 0;
		$remise_retour = 0;
		
		/* KEMPF : Gestion de la majoration des horaires de nuit */
		
		$majoration_nuit_aller = 0;
		$majoration_nuit_retour = 0;
		$montant_maj_nuit = intval(get_option("maj_horaire_nuit"));		
		
		/* Fin */
		
		// KEMPF : Option d'annulation
		$opt_annulation = $_SESSION['trajet']['opt_annulation'];
		$montant_opt_annulation = 0;
		
		$surcout_aller = 0;
		$surcout_retour = 0;
		
		$cout_par_personne_retour = "";
		$nb_personne_forfait_retour = "";
		$cout_par_personne_aller = "";
		$nb_personne_forfait_aller = "";
		
		// Modification KEMPF : Suppression de la table tab_surcout
		//$tab_surcout = array(1, 2); // id des destinations où la navette à la demande est surtaxée
		$txt_surcout_demande = get_option("maj_surcout_demande");
		
		// KEMPF : Majoration jour ferié ALLER OUI/NON
		$resultat_majoration_jour_aller = get_jour_majore($format_date_aller_final);
		$majoration_jour_special_aller = $resultat_majoration_jour_aller["montant"] * $nb_pers_aller;
		$txt_majoration_jour_ferie_aller = $resultat_majoration_jour_aller[strtolower($_SESSION['lang'])];
		
		// KEMPF : Majoration jour ferié RETOUR OUI/NON
		$resultat_majoration_jour_retour = get_jour_majore($format_date_retour_final);
		$txt_majoration_jour_ferie_retour = "";
		
		
		if($_SESSION['trajet']['type_trajet'] == 0)
		{
			$majoration_jour_special_retour = $resultat_majoration_jour_retour["montant"] * $nb_pers_retour;
			$txt_majoration_jour_ferie_retour = $resultat_majoration_jour_retour[strtolower($_SESSION['lang'])];
		}
	
		if($_SESSION['etat_aller']['type_reservation'] != "RAJOUT") // nouveau trajet pour l'aller
		{
			$id_lieu_dest = $_SESSION['trajet']['dest'];
			$id_lieu_depart = $_SESSION['trajet']['depart'];
			
			$id_lieu = $id_lieu_dest;
		
			$ret_prix_trajet = query("SELECT prix_forfait, nb_personne FROM aeroport_lieu WHERE id_lieu = '" . $id_lieu_dest . "'");
			
			$sql = "";
			if($id_lieu_dest == 100)
			{
				$sql = "SELECT prix_forfait, nb_personne FROM aeroport_lieu WHERE id_lieu = '" . $id_lieu_depart . "'";
				
				$ret_prix_trajet->closeCursor();
		
				$ret_prix_trajet = query($sql);
				
				$id_lieu = $id_lieu_depart;
			}
			
			$row = $ret_prix_trajet->fetch();
			
			$prix_forfait_aller = $row['prix_forfait'];


			$ret_prix_trajet->closeCursor();


            $nb_personne_forfait_aller = $row['nb_personne'];
			
			
			$cout_par_personne_aller = round(($prix_forfait_aller / $nb_personne_forfait_aller), 2);
			

            if($_SESSION['id_com_aller'] != 0 && $_SESSION['trajet']['dest'] == 100)
                $nb_personne_forfait_aller = 1;
            else
                $nb_personne_forfait_aller = $row['nb_personne'];

        
			if($nb_pers_aller < $nb_personne_forfait_aller)
			{
				$prix_aller = $prix_forfait_aller;// forfait mini
				$forfait_mini_aller = 1;//true
			}
			else
			{
				$prix_aller = $cout_par_personne_aller * $nb_pers_aller;
				$forfait_mini_aller = 0;//false
			}
			
			/*
				Ajout KEMPF :
				Gestion de la remise de 10% si une réservation de 
				8 personnes est effectué
			*/
			
			if ($nb_pers_aller == 8){
				$remise_8_pers_pourcent = intval(get_option("remise_pourcent_8_pers"));
				$remise += ($prix_aller*($remise_8_pers_pourcent/100));
			}
			
			/*
				Ajout KEMPF : 
				Gestion du supplément pour les horaires effectués la nuit
			*/
			$majoration_nuit_aller = (est_horaire_nuit($_SESSION['trajet']['heure_depart'])) ? $montant_maj_nuit : 0;
			if($_SESSION['code_promo']['bool'] == true && $_SESSION['code_promo']['condition'] == 'hor_nuit')
			{
				$remise_promo += 14;
			}

			//if(!$_SESSION['trajet']['bool_depart_fixe'] && (in_array($_SESSION['trajet']['depart'], $tab_surcout) || in_array($_SESSION['trajet']['dest'], $tab_surcout)))
			if(!$_SESSION['trajet']['bool_depart_fixe'])
			{
				$surcout_aller += $txt_surcout_demande;
				if($_SESSION['code_promo']['bool'] == true && $_SESSION['code_promo']['condition'] == 'hor_demande')
				{
					$remise_promo += 16;
				}
			}

			$supplement = $majoration_derniere_minute + $prix_prise_aller + $majoration_nuit_aller + $majoration_jour_special_aller;
			if($_SESSION['code_promo']['bool'] == true && $_SESSION['code_promo']['condition'] == 'trajet')
			{
				if($_SESSION['code_promo']['effet'] == 'remise')
				{
					$remise_promo += $_SESSION['code_promo']['montant'];
				}
				elseif($_SESSION['code_promo']['effet'] == 'pourcentage')
				{
					$remise_promo += $prix_aller * ($_SESSION['code_promo']['montant']/100);
				}
			}
			
			$prix_total_aller = $prix_aller + $supplement + $surcout_aller - $remise;

		}
		else // trajet existant : on paye toujours le prix par personne
		{
			$id_lieu_dest = $_SESSION['trajet']['dest'];
			$id_lieu_depart = $_SESSION['trajet']['depart'];
			
			$id_lieu = $id_lieu_dest;
		
			$ret_prix_trajet = query("SELECT prix_forfait, nb_personne FROM aeroport_lieu WHERE id_lieu = '" . $id_lieu_dest . "'");
			
			$sql = "";
			if($id_lieu_dest == 100)
			{
				$sql = "SELECT prix_forfait, nb_personne FROM aeroport_lieu WHERE id_lieu = '" . $id_lieu_depart . "'";
				
				$ret_prix_trajet->closeCursor();
		
				$ret_prix_trajet = query($sql);
				
				$id_lieu = $id_lieu_depart;
			}
			
			$row = $ret_prix_trajet->fetch();
			
			
			$prix_forfait_aller = $row['prix_forfait'];
			
			$ret_prix_trajet->closeCursor();
			

			$nb_personne_forfait_aller = 1;
				
			$cout_par_personne_aller = round(($prix_forfait_aller / $row['nb_personne']), 2);
			
			$prix_aller = $cout_par_personne_aller * $nb_pers_aller;
			
			/*
				Ajout KEMPF :
				Gestion de la remise de 10% si une réservation de 
				8 personnes est effectué
			*/
			
			if ($nb_pers_aller == 8){
				$remise_8_pers_pourcent = intval(get_option("remise_pourcent_8_pers"));
				$remise += ($prix_aller*($remise_8_pers_pourcent/100));
			}
			
			// Les personnes se rajoutant sur un trajet existant ne payent pas la majoration horaire à la demande
			$_SESSION['trajet']['bool_depart_fixe'] = true;
			
			/*
				Ajout KEMPF : 
				Gestion du supplément pour les horaires effectués la nuit
			*/
			$majoration_nuit_aller = (est_horaire_nuit($_SESSION['trajet']['heure_depart'])) ? $montant_maj_nuit : 0;
			if($_SESSION['code_promo']['bool'] == true && $_SESSION['code_promo']['condition'] == 'hor_nuit')
			{
				$majoration_nuit_aller = 0;
			}
			
			$supplement = $majoration_derniere_minute + $prix_prise_aller + $majoration_nuit_aller + $majoration_jour_special_aller;
			if($_SESSION['code_promo']['bool'] == true && $_SESSION['code_promo']['condition'] == 'trajet')
			{
				if($_SESSION['code_promo']['effet'] == 'remise')
				{
					$prix_aller = $prix_aller - $_SESSION['code_promo']['montant'];
				}
				elseif($_SESSION['code_promo']['effet'] == 'pourcentage')
				{
					$reduction = $prix_aller * ($_SESSION['code_promo']['montant']/100);
					$prix_aller = $prix_aller - $reduction;
				}
			}
			
			$prix_total_aller = $prix_aller + $supplement + $surcout_aller - $remise;

		}

        if($_SESSION['trajet']['type_trajet'] == "0")
        {
            if($_SESSION['etat_retour']['type_reservation'] != "RAJOUT") // nouveau trajet pour le retour
            {
                $id_lieu_dest = $_SESSION['trajet']['dest'];
                $id_lieu_depart = $_SESSION['trajet']['depart'];

                $id_lieu = $id_lieu_dest;

                $ret_prix_trajet = query("SELECT prix_forfait, nb_personne FROM aeroport_lieu WHERE id_lieu = '" . $id_lieu_dest . "'");

                $sql = "";
                if($id_lieu_dest == 100)
                {
                    $sql = "SELECT prix_forfait, nb_personne FROM aeroport_lieu WHERE id_lieu = '" . $id_lieu_depart . "'";

                    $ret_prix_trajet->closeCursor();

                    $ret_prix_trajet = query($sql);

                    $id_lieu = $id_lieu_depart;
                }

                $row = $ret_prix_trajet->fetch();

                $prix_forfait_retour = $row['prix_forfait'];

                $nb_personne_forfait_retour = $row['nb_personne'];

                $ret_prix_trajet->closeCursor();

                $cout_par_personne_retour = round(($prix_forfait_retour / $nb_personne_forfait_retour), 2);


                if($_SESSION['id_com_retour'] != 0 && $_SESSION['trajet']['dest'] == 100)
                    $nb_personne_forfait_retour = 1;
                else
                    $nb_personne_forfait_retour = $row['nb_personne'];


                if($nb_pers_retour < $nb_personne_forfait_retour)
				{
                    $prix_retour = $prix_forfait_retour; // forfait mini
					$forfait_mini_retour = 1; //true
				}
                else
				{
                    $prix_retour = $cout_par_personne_retour * $nb_pers_retour;
					$forfait_mini_retour = 0; //false
				}

				/*
					Ajout KEMPF :
					Gestion de la remise de 10% si une réservation de 
					8 personnes est effectué
				*/
				if ($nb_pers_retour == 8){
					$remise_8_pers_pourcent = intval(get_option("remise_pourcent_8_pers"));
					$remise_retour += ($prix_retour*($remise_8_pers_pourcent/100));
				}
				
				/*
					Ajout KEMPF : 
					Gestion du supplément pour les horaires effectués la nuit
				*/
				$majoration_nuit_retour = (est_horaire_nuit($_SESSION['trajet']['heure_retour'])) ? $montant_maj_nuit : 0;
				if($_SESSION['code_promo']['bool'] == true && $_SESSION['code_promo']['condition'] == 'hor_nuit')
				{
					$majoration_nuit_retour = 0;
				}

                //if(!$_SESSION['trajet']['bool_retour_fixe'] && (in_array($_SESSION['trajet']['depart'], $tab_surcout) || in_array($_SESSION['trajet']['dest'], $tab_surcout)))
                if(!$_SESSION['trajet']['bool_retour_fixe'])
                {
					$surcout_retour += $txt_surcout_demande;
					if($_SESSION['code_promo']['bool'] == true && $_SESSION['code_promo']['condition'] == 'hor_demande')
					{
						$remise_promo += 16;
					}
				}

                $supplement = $prix_prise_retour + $majoration_nuit_retour + $majoration_jour_special_retour;

			if($_SESSION['code_promo']['bool'] == true && $_SESSION['code_promo']['condition'] == 'trajet')
			{
				if($_SESSION['code_promo']['effet'] == 'remise')
				{
					$remise_promo = $_SESSION['code_promo']['montant'];
				}
				elseif($_SESSION['code_promo']['effet'] == 'pourcentage')
				{
					$remise_promo = $prix_retour * ($_SESSION['code_promo']['montant']/100);
				}
			}
			
                $prix_total_retour = $prix_retour + $supplement + $surcout_retour - $remise_retour;

            }
            else // trajet existant : on paye toujours le prix par personne
            {
                $id_lieu_dest = $_SESSION['trajet']['dest'];
                $id_lieu_depart = $_SESSION['trajet']['depart'];

                $id_lieu = $id_lieu_dest;

                $ret_prix_trajet = query("SELECT prix_forfait, nb_personne FROM aeroport_lieu WHERE id_lieu = '" . $id_lieu_dest . "'");

                $sql = "";
                if($id_lieu_dest == 100)
                {
                    $sql = "SELECT prix_forfait, nb_personne FROM aeroport_lieu WHERE id_lieu = '" . $id_lieu_depart . "'";

                    $ret_prix_trajet->closeCursor();

                    $ret_prix_trajet = query($sql);

                    $id_lieu = $id_lieu_depart;
                }

                $row = $ret_prix_trajet->fetch();

                $prix_forfait_retour = $row['prix_forfait'];

                $ret_prix_trajet->closeCursor();

                $nb_personne_forfait_retour = 1;

                $cout_par_personne_retour = round(($prix_forfait_retour / $row['nb_personne']), 2);

                $prix_retour = $cout_par_personne_retour * $nb_pers_retour;
				
				/*
					Ajout KEMPF :
					Gestion de la remise de 10% si une réservation de 
					8 personnes est effectué
				*/
				if ($nb_pers_retour == 8){
					$remise_8_pers_pourcent = intval(get_option("remise_pourcent_8_pers"));
					$remise_retour += ($prix_retour*($remise_8_pers_pourcent/100));
				}
				
				// Les personnes se rajoutant sur un trajet existant ne payent pas la majoration horaire à la demande
                $_SESSION['trajet']['bool_retour_fixe'] = true;

				/*
					Ajout KEMPF : 
					Gestion du supplément pour les horaires effectués la nuit
				*/
				$majoration_nuit_retour = (est_horaire_nuit($_SESSION['trajet']['heure_retour'])) ? $montant_maj_nuit : 0;
				if($_SESSION['code_promo']['bool'] == true && $_SESSION['code_promo']['condition'] == 'hor_nuit')
				{
					$remise_promo += 14;
				}
                $supplement = $prix_prise_retour + $majoration_nuit_retour + $majoration_jour_special_retour;
				
				if($_SESSION['code_promo']['bool'] == true && $_SESSION['code_promo']['condition'] == 'trajet')
				{
					if($_SESSION['code_promo']['effet'] == 'remise')
					{
						$remise_promo += $_SESSION['code_promo']['montant'];
					}
					elseif($_SESSION['code_promo']['effet'] == 'pourcentage')
					{
						$remise_promo = $prix_retour * ($_SESSION['code_promo']['montant']/100);
					}
				}
				
                $prix_total_retour = $prix_retour + $supplement - $remise_retour;

            }
        }
		if(!isset($remise_promo)){
        $prix = $prix_total_aller + $prix_total_retour - 0;
		}
		else
		{
			$prix = $prix_total_aller + $prix_total_retour - $remise_promo;
		}
		// KEMPF : Ajout de l'option d'annulation
		if ($opt_annulation == 1){
			
			$montant_opt_annulation = ceil($prix*(intval(get_option("maj_annulation"))/100));
			$prix_total_aller += $montant_opt_annulation;
			$prix = $prix_total_aller + $prix_total_retour - $remise_promo;
			
		}

		// calcul de l'heure réelle de prise à domicile
		if($_SESSION['trajet']['type_trajet'] == 0) // si aller-retour
		{
			if($_SESSION['trajet']['dest'] != 100) // str -> aéroport -> str
			{
				$tps_pt_rass = get_tps_rass(intval($_SESSION['trajet']['pt_rass_aller']));

				$tab_tps_rass = explode(':', $_SESSION['trajet']['heure_depart']);
			
				$tps_rassemblement_aller = mktime($tab_tps_rass[0], $tab_tps_rass[1]) + $tps_pt_rass;
					
				if($_SESSION['trajet']['pt_rass_aller'] == 4)
					$tps_rassemblement_aller -= $_SESSION['etat_aller']['decalage'];

				$tab_tps_rass = explode(':', $_SESSION['trajet']['heure_retour']);
				
				$tps_rassemblement_retour = mktime($tab_tps_rass[0], $tab_tps_rass[1]);
			}
			else // sinon, aéroport -> str -> aéroport
			{
				$tps_pt_rass = get_tps_rass(intval($_SESSION['trajet']['pt_rass_retour']));

				$tab_tps_rass = explode(':', $_SESSION['trajet']['heure_retour']);
			
				$tps_rassemblement_retour = mktime($tab_tps_rass[0], $tab_tps_rass[1]) + $tps_pt_rass;
					
				if($_SESSION['trajet']['pt_rass_retour'] == 4)
					$tps_rassemblement_retour -= $_SESSION['etat_retour']['decalage'];

				$tab_tps_rass = explode(':', $_SESSION['trajet']['heure_depart']);
				
				$tps_rassemblement_aller = mktime($tab_tps_rass[0], $tab_tps_rass[1]);
			}
		}
		else // si aller simple
		{
			$tps_pt_rass = get_tps_rass(intval($_SESSION['trajet']['pt_rass_aller']));

			$tab_tps_rass = explode(':', $_SESSION['trajet']['heure_depart']);
	
			if($_SESSION['trajet']['dest'] != 100) // si on part de strasbourg
			{
				$tps_rassemblement_aller = mktime($tab_tps_rass[0], $tab_tps_rass[1]) + $tps_pt_rass;
				
				if($_SESSION['trajet']['pt_rass_aller'] == 4)
					$tps_rassemblement_aller -= $_SESSION['etat_aller']['decalage'];
			}
			else
				$tps_rassemblement_aller = mktime($tab_tps_rass[0], $tab_tps_rass[1]);
				
			$tps_rassemblement_retour = 0;
		}
		
		
		// on enregistre le tout dans la base pour y avoir accès après le paiement
		if($_SESSION['res_der_min'])
			$is_der_min = "1";
		else
			$is_der_min = "0";
		
		
		if(isset($_SESSION['id_paypal']))
			write("DELETE FROM aeroport_paypal WHERE id_paypal = '" . $_SESSION['id_paypal'] . "' AND code_reserv = '0'");

		$_SESSION['id_paypal'] = get_max_id('aeroport_paypal', 'id_paypal') + 1;
		
		$info_vol_aller = $compagnie_vol . " : " . $_SESSION['trajet']['compagnie_depart_vol'] . "\n";
		$info_vol_aller .= $dest_vol . " : " . $_SESSION['trajet']['provenance_depart_vol'] . "\n";
		$info_vol_aller .= $heure_vol . " : " . $_SESSION['trajet']['heure_depart_vol'] . "h" . $_SESSION['trajet']['minute_depart_vol'] . "\n";
		
		$info_vol_retour = $compagnie_vol . " : " . $_SESSION['trajet']['compagnie_retour_vol'] . "\n";
		$info_vol_retour .= $dest_vol . " : " . $_SESSION['trajet']['provenance_retour_vol'] . "\n";
		$info_vol_retour .= $heure_vol . " : " . $_SESSION['trajet']['heure_retour_vol'] . "h" . $_SESSION['trajet']['minute_retour_vol'] . "\n";


		$fixe_paypal_aller = 0;
		$fixe_paypal_retour = 0;
		
		if($_SESSION['trajet']['bool_depart_fixe']){
			$fixe_paypal_aller = 1;
		}

		if($_SESSION['trajet']['bool_retour_fixe']){
			$fixe_paypal_retour = 1;
		}

        $mnt_a_facturer = 0;
        $reste_a_payer = 0;

        $a_payer_aller = 1;
        $a_payer_retour = 1;

		// aller simple
		if($_SESSION['trajet']['type_trajet'] != "0")
		{
			if($type_res_min != '24')
			{
				if($_SESSION['etat_aller']['type_reservation'] != "ATTENDRE")
					$mnt_a_facturer = $prix;
				else
					$a_payer_aller = 0;
			}
			else
			{
				if($_SESSION['etat_aller']['type_reservation'] == "RAJOUT" && est_valide($_SESSION['etat_aller']['rb_navette']))
					$mnt_a_facturer = $prix;
				else
					$a_payer_aller = 0;
			}
		}
		else
		{
            if($type_res_min != '24')
            {
                if($_SESSION['etat_aller']['type_reservation'] != "ATTENDRE" && $_SESSION['etat_retour']['type_reservation'] != "ATTENDRE")
                    $mnt_a_facturer = $prix;
                else
                {
                    if($_SESSION['etat_aller']['type_reservation'] == "ATTENDRE" && $_SESSION['etat_retour']['type_reservation'] == "ATTENDRE")
                    {
                        $mnt_a_facturer = 0;
                        $reste_a_payer = $prix;

                        $a_payer_aller = 0;
                        $a_payer_retour = 0;
                    }
                    elseif($_SESSION['etat_aller']['type_reservation'] == "ATTENDRE")
                    {
                        $mnt_a_facturer = $prix_total_retour;
                        $reste_a_payer = $prix - $mnt_a_facturer;

                        $a_payer_aller = 0;
                    }
                    else
                    {
                        $mnt_a_facturer = $prix_total_aller;
                        $reste_a_payer = $prix - $mnt_a_facturer;

                        $a_payer_retour = 0;
                    }
                }
            }
            else
            {
                if($_SESSION['etat_aller']['type_reservation'] == "RAJOUT" && est_valide($_SESSION['etat_aller']['rb_navette']))
                {
                    if($_SESSION['etat_aller']['type_reservation'] != "ATTENDRE" && $_SESSION['etat_retour']['type_reservation'] != "ATTENDRE")
                        $mnt_a_facturer = $prix;
                    else
                    {
                        if($_SESSION['etat_aller']['type_reservation'] == "ATTENDRE" && $_SESSION['etat_retour']['type_reservation'] == "ATTENDRE")
                        {
                            $mnt_a_facturer = 0;
                            $reste_a_payer = $prix;

                            $a_payer_aller = 0;
                            $a_payer_retour = 0;
                        }
                        elseif($_SESSION['etat_aller']['type_reservation'] == "ATTENDRE")
                        {
                            $mnt_a_facturer = $prix_total_retour;
                            $reste_a_payer = $prix - $mnt_a_facturer;

                            $a_payer_aller = 0;
                        }
                        else
                        {
                            $mnt_a_facturer = $prix_total_aller;
                            $reste_a_payer = $prix - $mnt_a_facturer;

                            $a_payer_retour = 0;
                        }
                    }
                }
                else
                {
                    $a_payer_aller = 0;
                    $a_payer_retour = 0;
                }
            }
		}

		if(!isset($_SESSION['client']['pro'])){
			$_SESSION['client']['pro']="0";
			$_SESSION['trajet']['rass_pays_aller']=0;
			$_SESSION['trajet']['rass_pays_retour']=0;
			
		}
		$sql = "INSERT INTO
					aeroport_paypal
				VALUES (
						'" . intval($_SESSION['id_paypal']) . "',
						'0',
						'" . intval($_SESSION['trajet']['type_trajet']) . "',
						'" . intval($_SESSION['trajet']['depart']) . "', 
						'" . intval($_SESSION['trajet']['dest']) . "', 
						'" . intval($_SESSION['trajet']['pt_rass_aller']) . "', 
						'" . addslashes($_SESSION['trajet']['rass_adresse_aller']) . "', 
						'" . addslashes(trim($_SESSION['trajet']['rass_cp_aller'])) . "', 
						'" . addslashes($_SESSION['trajet']['rass_ville_aller']). "', 
						'" . addslashes($info_vol_aller) . "', 
						'" . intval($_SESSION['trajet']['pt_rass_retour']) . "', 
						'" . addslashes($_SESSION['trajet']['rass_adresse_retour']) . "', 
						'" . addslashes(trim($_SESSION['trajet']['rass_cp_retour'])) . "', 
						'" . addslashes($_SESSION['trajet']['rass_ville_retour']). "', 
						'" . addslashes($info_vol_retour) . "', 
						'" . substr($format_date_aller, 1, (strlen($format_date_aller) - 2)). ':00' . "', 
						'" . substr($format_date_retour, 1, (strlen($format_date_retour) - 2)). ':00' . "', 
						'" . date('H:i', $tps_rassemblement_aller) . "',
						'" . date('H:i', $tps_rassemblement_retour) . "',
						'" . intval($_SESSION['trajet']['passager_adulte_aller']) . "', 
						'" . intval($_SESSION['trajet']['passager_enfant_aller']) . "', 
						'" . $_SESSION['trajet']['passager_bebe_aller_g0'] . "|" . $_SESSION['trajet']['passager_bebe_aller_g1'] . "|" . $_SESSION['trajet']['passager_bebe_aller_g2'] . "|" . $_SESSION['trajet']['passager_bebe_aller_g3'] . "',
						'" . addslashes($_SESSION['trajet']['info_compl']) . "', 
						'" . intval($_SESSION['trajet']['passager_adulte_aller']) . "', 
						'" . intval($_SESSION['trajet']['passager_enfant_aller']) . "', 
						'" . $_SESSION['trajet']['passager_bebe_retour_g0'] . "|" . $_SESSION['trajet']['passager_bebe_retour_g1'] . "|" . $_SESSION['trajet']['passager_bebe_retour_g2'] . "|" . $_SESSION['trajet']['passager_bebe_retour_g3'] . "',
						'" . addslashes($_SESSION['client']['civilite']) . "', 
						'" . addslashes($_SESSION['client']['nom']) . "', 
						'" . addslashes($_SESSION['client']['prenom']) . "', 
						'" . addslashes($_SESSION['client']['mail']) . "', 
						'" . addslashes($_SESSION['client']['tel_fixe']) . "',
						'" . addslashes($_SESSION['client']['tel_port']) . "',
						'" . addslashes($_SESSION['client']['adresse']) . "', 
						'" . intval($_SESSION['client']['cp']) . "', 
						'" . addslashes($_SESSION['client']['ville']) . "', 
						'" . intval($_SESSION['client']['pays']) . "', 
						'" . $prix . "',
						'" . intval($_SESSION['chauffeur_id_aller']) . "', 
						'" . intval($_SESSION['chauffeur_id_retour']) . "',
						'" . intval($_SESSION['vehicule_id_aller']) . "', 
						'" . intval($_SESSION['vehicule_id_retour']) . "',
						'" . intval($_SESSION['etat_aller']['rb_navette']) . "',
						'" . intval($_SESSION['etat_retour']['rb_navette']) . "',
						'" . intval($prix_aller) . "',
						'" . intval($prix_retour) . "',
						'" . intval($prix_prise_aller) . "',
						'" . intval($prix_prise_retour) . "',
						'" . $type_res_min . "',
						'" . intval($is_der_min) . "',
						'" . get_ip() . "',
						'" . $fixe_paypal_aller . "',
						'" . $fixe_paypal_retour . "',
						'" . $_SESSION['id_com_aller'] . "',
						'" . $_SESSION['id_com_retour'] . "',
						'1',
						'" . $_SESSION['etat_aller']['type_reservation'] . "',
                        '" . $_SESSION['etat_retour']['type_reservation'] . "',
						'" . $a_payer_aller . "',
                        '" . $a_payer_retour . "',
                        '" . addslashes ($_SESSION['trajet']['provenance_depart_vol']) . "',
                        '" . addslashes ($_SESSION['trajet']['provenance_retour_vol']) . "',
                        '" . $_SESSION['client']['ind_fixe'] . "',
                        '" . $_SESSION['client']['ind_port'] . "',
                        '" . $_SESSION['client']['pro'] . "',
						'" . (($majoration_nuit_aller > 0) ? 1 : 0) . "',
						'" . (($majoration_nuit_retour > 0) ? 1 : 0) . "',
						'" . $opt_annulation . "',
						'" . $montant_opt_annulation ."',
						'',
						'" . $_SESSION['trajet']['rass_pays_aller'] . "',
						'" . $_SESSION['trajet']['rass_pays_retour'] . "',
						null)
						
					";

		write($sql);

		$custom = $_SESSION['id_paypal'] . '|';
		
		if($_SESSION['logger'])
			$custom .= $_SESSION['client']['id_client'] . '|1';
		else
			$custom .= '0|0';
		
		$id_non_finalise = (!empty($_SESSION['id_demande_non_finalisee'])) ? $_SESSION['id_demande_non_finalisee'] : 0;
				
		$custom .= '|' . $_SESSION['lang'] . '|1|0|0|0|0|0|'.$id_non_finalise;


		$_SESSION['resa']['custom'] = $custom;
        $_SESSION['resa']['prix'] = $mnt_a_facturer;

        
		$lieu_depart = get_lieu($_SESSION['trajet']['depart']);
		$lieu_arrive = get_lieu($_SESSION['trajet']['dest']);
			
			
		$descr_trajet = 'Trajet '.$lieu_depart. ' -> '. $lieu_arrive . ' | Date : ' . $_SESSION['trajet']['date_depart_long'];
		
		if($_SESSION['trajet']['type_trajet'] == 0)
			$descr_trajet .= " et " . $_SESSION['trajet']['date_retour_long'];


/*
 * Determination pour la langue de PAYPAL
 * 
 * INFO MARC
 * */
        $lang_paypal = (strtolower($_SESSION['lang']) == 'fr') ? 'FR' : 'GB';


        global $active_paypal, $active_ca;

        
        if($_SESSION['client']['est_admin'] == "0" && $mnt_a_facturer != 0)
        {
            if($active_paypal)
                $encrypted = form_paypal($mnt_a_facturer, $descr_trajet, $custom, $lang_paypal);
            else
                $encrypted = "0";
        }
        else
            $encrypted = "";


        if($active_ca)
            $encrypted_ca = crypter($_SESSION['resa']['custom'] . "-|-" . $_SESSION['resa']['prix'] . "-|-" . $_SESSION['client']['mail']);
        else
            $encrypted_ca = "";
        

		$tpl->set(array(
						"TITRE_PAGE" => $titre_page_res_recap,
						"BTN_CONTINUER" => $btn_etape_suivante,
						"CODE_PROMO" => $code_promo,
						"REMISE_PROMO" => $remise_code_promo,
						"TXT_REMISE_PROMO" => $remise_promo,
						"TITRE_MON_TRAJET" => $mon_trajet,
						"IS_DER_MIN" => $is_der_min,
						"TXT_DER_MIN" => $txt_der_min,
						"RECAPITULATIF" => $recapitulatif,
						"TITRE_TRAJET" => $titre_trajet,
						"TITRE_CLIENT" => $titre_client,
						"TYPE_TRAJET" => $trajet_type,
						"TRAJET_DEPART" => $trajet_depart,
						"TRAJET_ARRIVE" => $trajet_arrive,
						"DATE_DEPART" => $date,
						"DATE_RETOUR" => $date,
						"HEURE_DEPART" => $heure,
						"HEURE_RETOUR" => $heure,
						"INFO_VOL" => $info_vol,
						"PT_RASSEMBLEMENT" => $pt_rassemblement,
						"PASSAGER_ADULTE" => $passager_adulte,
						"PASSAGER_ENFANT" => htmlspecialchars($passager_enfant, ENT_COMPAT, "UTF-8"),
						"INFO_COMPL" => $info_compl,
						"ALLER" => $aller,
						"RETOUR" => $retour,
						"PROVENANCE_VOL" => $provenance_vol,
						"COMPAGNIE_VOL" => $compagnie_vol,
						"HEURE_VOL" => $heure_vol,
						"DEST_VOL" => $dest_vol,
						"ALT_PAYPAL" => $alt_paypal,
						"TRAJET" => $_SESSION['trajet']['type_trajet'],
						"TXT_TYPE_TRAJET" => ($_SESSION['trajet']['type_trajet'] == 1) ? $trajet_aller_simple : $trajet_aller_retour,
						"TXT_TRAJET_DEPART" => $lieu_depart,
						"TXT_TRAJET_ARRIVE" => $lieu_arrive,
						"TXT_PT_RASS_ALLER" => get_pt_rass($_SESSION['trajet']['pt_rass_aller']),
						"TXT_PT_RASS_RETOUR" => get_pt_rass($_SESSION['trajet']['pt_rass_retour']),
						"TXT_RASS_ADRESSE_ALLER" => $_SESSION['trajet']['rass_adresse_aller'],
						"TXT_RASS_CP_ALLER" => $_SESSION['trajet']['rass_cp_aller'],
						"TXT_RASS_VILLE_ALLER" => $_SESSION['trajet']['rass_ville_aller'],
						"TXT_RASS_ADRESSE_RETOUR" => $_SESSION['trajet']['rass_adresse_retour'],
						"TXT_RASS_CP_RETOUR" => $_SESSION['trajet']['rass_cp_retour'],
						"TXT_RASS_VILLE_RETOUR" => $_SESSION['trajet']['rass_ville_retour'],
						"TXT_DATE_DEPART" => $_SESSION['trajet']['date_depart_long'],
						"TXT_DATE_RETOUR" => $_SESSION['trajet']['date_retour_long'],
						"COMPAGNIE" => $compagnie_vol,
						"DEST_VOL" => $dest_vol,
						"HEURE_VOL" => $heure_vol,
						"COMPAGNIE_INFO_VOL_ALLER" => $_SESSION['trajet']['compagnie_depart_vol'],
						"DEST_INFO_VOL_ALLER" => $_SESSION['trajet']['provenance_depart_vol'],
						"HEURE_INFO_VOL_ALLER" => $_SESSION['trajet']['heure_depart_vol'] . "h" . $_SESSION['trajet']['minute_depart_vol'],
						"COMPAGNIE_INFO_VOL_RETOUR" => $_SESSION['trajet']['compagnie_retour_vol'],
						"DEST_INFO_VOL_RETOUR" => $_SESSION['trajet']['provenance_retour_vol'],
						"HEURE_INFO_VOL_RETOUR" => $_SESSION['trajet']['heure_retour_vol'] . "h" . $_SESSION['trajet']['minute_retour_vol'],
						"TXT_HEURE_DEPART" => str_replace(':', 'h', date('H:i', $tps_rassemblement_aller)),
						"TXT_HEURE_RETOUR" => str_replace(':', 'h', date('H:i', $tps_rassemblement_retour)),
						"TXT_PASSAGER_ADULTE_ALLER" => $_SESSION['trajet']['passager_adulte_aller'],
						"TXT_PASSAGER_ENFANT_ALLER" => $_SESSION['trajet']['passager_enfant_aller'],
						"TXT_PASSAGER_ADULTE_RETOUR" => $_SESSION['trajet']['passager_adulte_aller'],
						"TXT_PASSAGER_ENFANT_RETOUR" => $_SESSION['trajet']['passager_enfant_aller'],
						"TXT_INFO_COMPL" => nl2br(wordwrap($_SESSION['trajet']['info_compl'], 100, '<br />', true)),
						"NOM_CLIENT" => $nom_client,
						"PRENOM_CLIENT" => $prenom_client,
						"TEL_CLIENT" => $tel_client,
						"PORT_CLIENT" => $port_client,
						"ADRESSE_CLIENT" => $adresse_client,
						"CODE_POST_CLIENT" => $code_post_client,
						"VILLE_CLIENT" => $ville_client,
						"PAYS_CLIENT" => $pays_client,
						"CIVILITE" => $civilite,
						"TXT_CIVILITE_CLIENT" => $_SESSION['client']['civilite'],
						"TXT_NOM_CLIENT" => $_SESSION['client']['nom'],
						"TXT_PRENOM_CLIENT" => $_SESSION['client']['prenom'],
						"TXT_MAIL_CLIENT" => $_SESSION['client']['mail'],
						"TXT_TEL_CLIENT" => $_SESSION['client']['tel_fixe'],
						"TXT_PORT_CLIENT" => $_SESSION['client']['tel_port'],
                        "TXT_IND_PORT" => get_indicatif($_SESSION['client']['ind_port']),
                        "TXT_IND_FIXE" => get_indicatif($_SESSION['client']['ind_fixe']),
						"TXT_ADRESSE_CLIENT" => $_SESSION['client']['adresse'],
						"TXT_CODE_POST_CLIENT" => $_SESSION['client']['cp'],
						"TXT_VILLE_CLIENT" => $_SESSION['client']['ville'],
						"TXT_PAYS_CLIENT" => get_pays($_SESSION['client']['pays']),
						"INFO_INCORRECT" => $info_incorrect,
						"BTN_PAYER" => $btn_payer,
						"TARIFS" => $tarif,
						"COUT_TRAJET_BASE" => $cout_trajet_base,
						"COUT_PAR_PERSONNE" => $cout_par_personne_aller,
						"TXT_COUT_TRAJET_ALLER" => $prix_aller,
						"TXT_COUT_TRAJET_RETOUR" => $prix_retour,
						"COUT_PAR_PERSONNE_ALLER" => $cout_par_personne_aller,
						"COUT_PAR_PERSONNE_RETOUR" => $cout_par_personne_retour,
						"NB_PASSAGER" => $nb_passager,
						"DOMICILE_ALLER" => $maj_dom_aller,
						"DOMICILE_RETOUR" => $maj_dom_retour,
						"PRISE_DOMICILE" => $prise_domicile,
						"DEPOSE_DOMICILE" => $depose_domicile,
						"DERNIERE_MINUTE_72" => $maj_der_min_72,
						"DERNIERE_MINUTE_24" => $maj_der_min_24,
						"TXT_DER_MIN_72" => $txt_der_min_72,
						"TXT_DER_MIN_24" => $txt_der_min_24,
						"RES_DER_MIN_72" => $res_der_minute_72,
						"RES_DER_MIN_24" => $res_der_minute_24,
						"PRIX_TOTAL" => $prix_total,
						"TXT_PRIX_TOTAL" => $prix,
						"PERSONNE" => $personne,
						"TXT_FORFAIT_MINI" => $nb_personne_forfait_aller,
						"TXT_FORFAIT_MINI_ALLER" => $nb_personne_forfait_aller,
						"TXT_FORFAIT_MINI_RETOUR" => $nb_personne_forfait_retour,
						"FORFAIT_MINI" => $forfait_mini,
						"FORFAIT_MINI_ALLER" => $forfait_mini_aller,
						"FORFAIT_MINI_RETOUR" => $forfait_mini_retour,
						"TARGET_IMG_PAYPAL" => (strtolower($_SESSION['lang']) == 'fr') ? 'fr_FR/FR' : 'en_US',
                        "ENCRYPTED" => $encrypted,
						"TARIFS_XX_PERSONNE" => $tarif_s . " " . $nb_pers_aller . " " . $personne . "(s)",
						"TARIFS_XX_PERSONNE_ALLER" => $tarif_s,
						"TARIFS_XX_PERSONNE_RETOUR" => $tarif_s,
						"TXT_NB_PASSAGER" => $nb_pers_aller + $nb_pers_retour,
						"TXT_NB_PASSAGER_ALLER" => $nb_pers_aller,
						"TXT_NB_PASSAGER_RETOUR" => $nb_pers_retour,
						"TXT_NB_PASSAGER_TOT" => ($nb_pers_aller + $nb_pers_retour),
						"PRIX_PRISE_ALLER" => $prix_prise_aller,
						"PRIX_PRISE_RETOUR" => $prix_prise_retour,
						"SURCOUT_DEMANDE" => $surcout_demande,
						"TXT_SURCOUT_ALLER" => $surcout_aller,
						"TXT_SURCOUT_RETOUR" => $surcout_retour,
						"EST_ADMIN" => $_SESSION['client']['est_admin'],
						"TYPE_RESA" => $type_reservation,
						"JAI_ATTENDU" => $jai_attendu,
						"ID_PAYPAL" => $_SESSION['id_paypal'],
						"TXT_TOTAL_ALLER" => $prix_aller,
						"TXT_TOTAL_RETOUR" => $prix_retour,
						"TXT_SUPPLEMENT_ALLER" => $prix_prise_aller,
						"TXT_SUPPLEMENT_RETOUR" => $prix_prise_retour,
						"BOOL_NAVETTE_DEMANDE" => ($_SESSION['trajet']['bool_depart_fixe'] || $_SESSION['trajet']['bool_retour_fixe']) ? "1" : "0",
						"BOOL_NV_DEMANDE_ALLER" => ($_SESSION['trajet']['bool_depart_fixe']) ? "1" : "0",
						"BOOL_NV_DEMANDE_RETOUR" => ($_SESSION['trajet']['bool_retour_fixe']) ? "1" : "0",
						"TYPE_RES_DER_MIN" => $type_res_min,
						"ON_A_ATTENDU" => ($_SESSION['etat_aller']['type_reservation'] == "ATTENDRE" || (isset($_SESSION['etat_retour']) && $_SESSION['etat_retour']['type_reservation'] == "ATTENDRE") ),
						"JAI_ATTENDU_ALLER" => $jai_attendu_aller,
						"JAI_ATTENDU_RETOUR" => $jai_attendu_retour,
                        "PRIX_A_PAYER" => $prix_a_payer,
						"ATTENDRE_ALLER" => (($_SESSION['etat_aller']['type_reservation'] == "ATTENDRE") ? true : false),
						"ATTENDRE_RETOUR" => (isset($_SESSION['etat_retour']) && ($_SESSION['etat_retour']['type_reservation'] == "ATTENDRE") ? true : false),
						"EMAIL" => $email,
						"CONFIRMATION_RESA" => $confirmation_resa,
						"BTN_CONFIRMATION" => $btn_envoyer,
                        "TXT_MNT_A_PAYER" => $mnt_a_facturer,
                        "A_PAYER_ALLER" => $a_payer_aller,
                        "A_PAYER_RETOUR" => $a_payer_retour,
                        "TARIF_MAJ_DEMANDE" => $txt_surcout_demande,
                        "ACTIVE_PAYPAL" => $active_paypal,
                        "ACTIVE_CA" => $active_ca,
                        "MODE_DE_PAIEMENT" => $mode_de_paiement,
                        "INFO_MODE_PAIEMENT" => $info_mode_paiement,
                        "ENCRYPTED_CA" => $encrypted_ca,
                        "PROFESSIONNEL" => $_SESSION['client']['pro'],
                        "JESUISPRO" => $je_suis_pro,
						
						// KEMPF : Remise (8 personnes)
						"REMISE" => $lang_remise,
						"VALEUR_REMISE" => $remise + $remise_retour,
						
						// KEMPF : Majoration trajets de nuit
						"MAJ_NUIT_ALLER" => $majoration_nuit_aller,
						"MAJ_NUIT_RETOUR" => $majoration_nuit_retour,
						"HORAIRE_NUIT" => $lang_horaires_de_nuit,
						
						// KEMPF : Majoration sur jours feriés
						"MAJ_FERIE_ALLER" => $majoration_jour_special_aller,
						"MAJ_FERIE_RETOUR" => $majoration_jour_special_retour,
						"LIBELLE_MAJ_FERIE_ALLER" => $txt_majoration_jour_ferie_aller,
						"LIBELLE_MAJ_FERIE_RETOUR" => $txt_majoration_jour_ferie_retour,
		
						// KEMPF : Données nécessaires pour la fonction AJAX de demande annulée
						
						"CIVILITE_CLIENT2" => ($_SESSION['client']['civilite']),
						"NOM_CLIENT2" => ($_SESSION['client']['nom']),
						"PRENOM_CLIENT2" => ($_SESSION['client']['prenom']),
						"EMAIL_CLIENT" => $_SESSION['client']['mail'],
						"ID_TRAJET_DEPART" => $_SESSION['trajet']['depart'],
						"ID_TRAJET_DEST" => $_SESSION['trajet']['dest'],
						"TRAJET_EST_SIMPLE" => $_SESSION['trajet']['type_trajet'],
						"PRIX_TRAJET" => ($prix + $supplement_res_der_min2),
						
						// KEMPF : Option annulation
						"OPT_ANNULATION" => ($opt_annulation == 1) ? true : false,
						"MONTANT_OPTION_ANNULATION" => $montant_opt_annulation,
						"TXT_OPTION_ANNULATION" => $lang_annulation,
		
						/***
						 * Cas rajout d'un passager
						 * 
						 *  * */
						"TXT_AUTRE_PASSAGER" => $_SESSION['chckPassagerDifferent'],
		
						"TITRE_AUTRE_PASSAGER" => $titre_autre_passager,
						"NOM_AUTRE_PASSAGER" => $nom_autre_passager,
						"INDICATIF_TEL_AUTRE_PASSAGER" => $indicatif_tel_autre_passager,
						"TEL_PORT_AUTRE_PASSAGER" => $tel_port_autre_passager,

						
						"TXT_NOM_AUTRE_PASSAGER" =>	$_SESSION['txtNom'],
						/*"TXT_INDICATIF_TEL_AUTRE_PASSAGER" => $_SESSION['lstIndicatifTelephone'],*/
						"TXT_TEL_PORT_AUTRE_PASSAGER" => $_SESSION['txtPortable'],
						"TXT_INDICATIF_TEL_AUTRE_PASSAGER" => $_SESSION['txtIndicatifPortable'],
						
						"EMAIL" => $email,
						"PASSWD" => $passwd,
						"MDP_OUBLIE" => $mdp_oublie,
						"AIDE_RESERVATION" => $aide_reservation,
						"ETAPE_1" => $etape1,
						"ETAPE_2" => $etape2,
						"ETAPE_3" => $etape3,
						"ETAPE_4" => $etape4,
						"HORAIRES_NAVETTES" => $horaires_navettes,
						"HORAIRES_VOLS" => $horaires_vols,
						"INFOS" => $infos,
						"POINTS_PRISE" => $points_prise
							)
				  );

		//die(
		//print("<PRE>").print_r($_SESSION).print("</PRE>")
		//);
		
		$tpl->parse("aeroport/reservation/index.html");
	}
	else
	{
		header('Location: ../demande_reservation.php');
		exit();
	}
		
?>
