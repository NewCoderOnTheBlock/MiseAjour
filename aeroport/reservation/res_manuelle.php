<?php
	session_start();
	
	@set_time_limit(300);
	
	require_once('../includes/tpl_base.php');
	require_once("traitement.php");
	
	
	if(isset($_POST['res_manuelle']) && $_SESSION['client']['est_admin'] == "1")
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
								'ARIANE' => $ariane_paiement_manuel,
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
		
		
		$id_paypal = intval($_POST['id_paypal']);
		
		$sql = "UPDATE aeroport_paypal SET ";


        $maj_depart_fixe = 0;
        $maj_retour_fixe = 0;
        $maj_res_der_min = 0;
		
		
		// considérer si payé ou pas pour l'aller
		if(isset($_POST['a_payer_aller']) && $_POST['a_payer_aller'] == "on")
			$sql .= " a_payer_aller = '1'";
		else
			$sql .= " a_payer_aller = '0'";


        // considérer si payé ou pas pour le retour
		if(isset($_POST['a_payer_retour']) && $_POST['a_payer_retour'] == "on")
			$sql .= ", a_payer_retour = '1'";
		else
			$sql .= ", a_payer_retour = '0'";
			
		
		// envoyer ou pas un mail au client
		if(isset($_POST['avertir_client']) && $_POST['avertir_client'] == "on")
			$sql .= ", envoyer_mail = '1'";
		else
			$sql .= ", envoyer_mail = '0'";
			
		
		// changer le prix du trajet pour l'aller
		$sql .= ", prix_aller = '" . intval($_POST['nv_prix_aller']) . "'";
		
		// changer le prix du trajet pour le retour
		$sql .= ", prix_retour = '" . intval($_POST['nv_prix_retour']) . "'";
		
		
		// KEMPF : Type du client (Tourren Service ?) type_client
		if (!empty($_POST['type_client'])){
			$sql .= ", type_client = '" . $_POST['type_client'] . "'";
		}
		
		// KEMPF : Horaires de nuit aller
		if ($_POST['est_nuit_aller'] == "1"){
			$sql .= ", est_nuit_aller = '" . $_POST['est_nuit_aller'] . "'";
		}
		
		// KEMPF : Horaires de nuit retour
		if ($_POST['est_nuit_retour'] == "1"){
			$sql .= ", est_nuit_retour = '" . $_POST['est_nuit_retour'] . "'";
		}
		
		// Navette à la demande ?
		if($_POST['lst_nv_fixe_aller'] == '1')
        {
			$sql .= ", depart_fixe = '" . (($_POST['lst_nv_fixe_aller'] == "0") ? "1" : "0") . "'";
            $maj_depart_fixe = get_option("maj_surcout_demande");
        }
		else
			$sql .= ", depart_fixe = '1'";
			
		if($_POST['lst_nv_fixe_retour'] == '1' && $_SESSION['trajet']['type_trajet'] == '0')
        {
			$sql .= ", retour_fixe = '" . (($_POST['lst_nv_fixe_retour'] == "0") ? "1" : "0") . "'";
            $maj_retour_fixe = get_option("maj_surcout_demande");
        }
		else
			$sql .= ", retour_fixe = '1'";
			
		// prix prise à domicile
		$sql .= ", supplement_aller = '" . intval($_POST['nv_supplement_aller']) . "'";
		
		$sql .= ", supplement_retour = '" . intval($_POST['nv_supplement_retour']) . "'";
			
		// réservation de dernière minute
		
		$sql .= ", is_der_min = '" . $_POST['lst_der_min'] . "'";
		
		if($_POST['lst_der_min'] != '')
        {
            $maj_res_der_min = get_option("maj_" . $_POST['lst_der_min']);
			$sql .= ", res_der_min = '1'";
        }
        else
            $sql .= ", res_der_min = '0'";

        

        $sql .= ", prix = " . (intval($_POST['nv_prix_aller']) + intval($_POST['nv_supplement_aller']) + intval($_POST['nv_supplement_retour']) + intval($_POST['nv_prix_retour']) + $maj_depart_fixe + $maj_retour_fixe + $maj_res_der_min);
			
		
		$sql .= " WHERE id_paypal = '" . $id_paypal . "'";
		
		write($sql);
		
		$custom = $id_paypal . '|';
		
		if($_SESSION['est_admin_client'] == "1")
			$custom .= $_SESSION['client']['id_client'] . '|1';
		else
			$custom .= '0|0';
			
		$custom .= '|' . $_SESSION['lang'] . '|1|0|0|0|0|0';

        if($_SESSION['client']['pro'] == 1)
            $tab_id = traitement($custom, $_SESSION['mode'], 'Pro');
		else{
            $tab_id = traitement($custom, $_SESSION['mode'], '');
		}
		
		write("DELETE FROM aeroport_paypal WHERE id_paypal = '" . $id_paypal . "'");
		

		
		$tpl->set(array(
						"TITRE_PAGE" => "Récapitulatif de la réservation manuelle"
						)
				  );
		
		$tpl->parse('aeroport/reservation/res_manuelle.html');
	}
	else
	{
		header('Location: ../index.php');
		exit();
	}
?>