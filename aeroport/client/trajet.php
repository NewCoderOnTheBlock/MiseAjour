<?php		
	session_start();
	
	if(!$_SESSION['logger'])
	{
		header('Location: client.php?p='.$_SERVER['REQUEST_URI']);
		exit();
	}
		include("../../libs/db.php");
	require_once('../includes/tpl_base.php');
	
		$req = query("SELECT * FROM aeroport_facture WHERE email='".$_SESSION['client']['mail']."'");
	$i = 0;
	while ($data = $req->fetch())
	{	
		if( !empty($_POST['civilite'.$i]) && !empty($_POST['nom'.$i]) && !empty($_POST['prenom'.$i]) && !empty($_POST['adresse'.$i]) && !empty($_POST['ville'.$i]) && !empty($_POST['cp'.$i]) && !empty($_POST['pays'.$i]))
		{
			$sql = "UPDATE aeroport_facture SET adresse_facture='"."3|".$_POST['civilite'.$i]."|".$_POST['nom'.$i]."|".$_POST['prenom'.$i]."|".$_POST['adresse'.$i]."|".$_POST['ville'.$i]."|".$_POST['cp'.$i]."|".$_POST['pays'.$i]."' WHERE id_facture='".$_POST['id_facture'.$i]."'";
			$maj = query($sql);
		}
			
		elseif( !empty($_POST['civilite'.$i]) && !empty($_POST['nom'.$i]) && !empty($_POST['prenom'.$i]) && !empty($_POST['adresse'.$i]) && !empty($_POST['ville'.$i]) && !empty($_POST['cp'.$i]))
		{
			$sql = "UPDATE aeroport_facture SET adresse_facture='"."3|".$POST['civilite'.$i]."|".$POST['nom'.$i]."|".$POST['prenom'.$i]."|".$POST['adresse'.$i]."|".$POST['ville'.$i]."|".$POST['cp'.$i]."|France' WHERE id_facture='".$POST['id_facture'.$i]."'";
			$maj = query($sql);
		}
			
		elseif( !empty($_POST['adresse'.$i]) &&  !empty($_POST['ville'.$i]) && !empty($_POST['cp'.$i]) && !empty($_POST['pays'.$i]))
		{
			$sql="UPDATE aeroport_facture SET adresse_facture='"."2|".$_POST['adresse'.$i]."|".$_POST['ville'.$i]."|".$_POST['cp'.$i]."|".$_POST['pays'.$i]."' WHERE id_facture='".$_POST['id_facture'.$i]."'";
			$maj = query($sql);
		}
			
		elseif( !empty($_POST['adresse'.$i]) && !empty($_POST['ville'.$i]) && !empty($_POST['cp'.$i]))
		{			
			$sql="UPDATE aeroport_facture SET adresse_facture='"."2|".$_POST['adresse'.$i]."|".$_POST['ville'.$i]."|".$_POST['cp'.$i]."|France' WHERE id_facture='".$_POST['id_facture'.$i]."'";
			$maj = query($sql);			}
			
		elseif ( !empty($_POST['civilite'.$i]) && !empty($_POST['nom'.$i]) && !empty($_POST['prenom'.$i]))
		{
			$sql = "UPDATE aeroport_facture SET adresse_facture='"."1|".$_POST['civilite'.$i]."|".$_POST['nom'.$i]."|".$_POST['prenom'.$i]."' WHERE id_facture='".$POST['id_facture'.$i]."'";
			$maj = query($sql);
		}
		$i++;
	}
	
	// le fil d'ariane
	$tab_ariane = array(
						array(
							'ARIANE' => $ariane_accueil,
							'LIEN' => 'index.html'
							),
						array(
							'ARIANE' => $ariane_trajet,
							'LIEN' => 'client/trajet.html'
							),
						array(
							'ARIANE' => $ariane_visu_trajet,
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
	
	
	$tpl->set(array(
					'TITRE_PAGE' => $titre_page_trajet,
					"TITRE" => $titre_trajet1,
					'MES_TRAJETS' => get_tab_mes_trajet(),
					'TRAJET_DU' => $trajet_du,
					"TITRE_TRAJET" => $titre_trajet,
					"TRAJET_DEPART" => $trajet_depart,
					"TRAJET_ARRIVE" => $trajet_arrive,
					"DATE_DEPART" => $date_depart,
					"HEURE_DEPART" => $horaire_choisi,
					"INFO_VOL" => $info_vol,
					"PT_RASSEMBLEMENT" => $pt_rassemblement,
					"PASSAGER_ADULTE" => $passager_adulte,
					"PASSAGER_ENFANT" => htmlentities($passager_enfant),
					"INFO_COMPL" => $info_compl,
					"INFO_PRATIQUE" => $info_pratique,
					'FACTURE' => $facture,
					'CHAUFFEUR_NOM' => $chauffeur_nom,
					"CHAUFFEUR_PRENOM" => $chauffeur_prenom,
					"CHAUFFEUR_PORT" => $chauffeur_port,
					"NAVETTE_INDIVIDUELLE" => $navette_individuelle,
					"PAS_DE_TRAJET" => $pas_de_trajet,
					'TRAJETS_EXISTANT' => (get_nb_trajet_moi() == 0) ? false : true,
					"EXPLICATION" => $explication_trajet,
                    'TARIF' => $tarif_s,
                    'ALT_PAYER' => $btn_payer,
                    'POUR_PAYER' => $pour_payer,
					'OPT_ANNULATION' => $lang_annuler_le_trajet,
					'TRAJET_ANNULE' => $lang_trajet_annule,
					'CREER_FACTURE' => $creer_facture,
					'CIVILITE' => $civilite,
					'NOM' => $nom,
					'PRENOM' => $prenom,
					'ADRESSE_POSTALE' => $adresse_postale,
					'VILLE' => $ville,
					'CODE_POSTAL' => $code_postal,
					'PAYS' => $pays,
					'CHANGER_ADRESSE' => $changer_adresse,
					'MODIFIER_FACTURE' => $modifier,
					'VOIR_FACTURE' => $voir
					)
			 );
		
	$tpl->parse('aeroport/client/trajet.html');
?>
