<?php

    session_start();

	require_once('../includes/tpl_base.php');


    if(count($_GET) == 3)
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
								'ARIANE' => $titre_pro,
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

        $id_client = intval($_GET['id_pro']);
        $datee = intval($_GET['date']);
        $nb_alea = $_GET['nb_alea'];


        $class_erreur = "";
		$erreur = "";




        $sql_get_info_client = query("SELECT id_pays, civilite, nom, prenom, adresse, code_postal, ville, mail, tel_fixe, tel_port, nb_alea, ind_fixe, ind_port
									 FROM aeroport_client
									 WHERE id_client = '" . $id_client . "'");

		if($sql_get_info_client->rowCount() != 1)
		{
			$class_erreur = "erreur";
			$erreur = $client_existe_pas;
		}
		else
		{
			$row_client = $sql_get_info_client->fetch();

			if($nb_alea != $row_client['nb_alea'])
			{
				$class_erreur = "erreur";
				$erreur = $code_incorect;

                $sql_get_info_client->closeCursor();
			}
			else
			{
				$tpl->set(array(
							"TXT_CIVILITE_CLIENT" => $row_client['civilite'],
							"TXT_NOM_CLIENT" => $row_client['nom'],
							"TXT_PRENOM_CLIENT" => $row_client['prenom'],
							"TXT_MAIL_CLIENT" => $row_client['mail'],
							"TXT_TEL_CLIENT" => $row_client['tel_fixe'],
							"TXT_PORT_CLIENT" => $row_client['tel_port'],
							"TXT_ADRESSE_CLIENT" => $row_client['adresse'],
							"TXT_CODE_POST_CLIENT" => $row_client['code_postal'],
							"TXT_VILLE_CLIENT" => $row_client['ville'],
							"TXT_PAYS_CLIENT" => get_pays(intval($row_client['id_pays'])),
							"TXT_IND_FIXE" => get_indicatif($row_client['ind_fixe']),
							"TXT_IND_PORT" => get_indicatif($row_client['ind_port'])
							)
					 );

                $mail_client_ca = $row_client['mail'];

                $sql_get_info_client->closeCursor();
                

                $query = "SELECT
                            DATE_FORMAT(t.date, '%d-%m-%Y' ) as dateDep,
                            DATE_FORMAT(t.date, '%Hh%i' ) as heureDep,
                            t.id_lieu_depart as id_depart,
                            t.id_lieu_dest as id_dest,
                            l.prix,
                            l.nb_pers,
                            l.nb_enfant
                      FROM aeroport_ligne_resa l,
						   aeroport_reservation r,
                           aeroport_facture_pro f,
                           aeroport_trajet t
                      WHERE l.id_trajet = t.id_trajet
							AND l.id_res = r.id_res
							AND r.id_client = ".$id_client."
                            AND l.id_ligne = f.num_ligne
                            AND f.statut = 0
                            AND f.id_pro = ".$id_client."
                            AND f.date <= ".$datee."
							ORDER BY t.date DESC";

                $ret_trajet = query($query);

                if($ret_trajet->rowCount() == 0)
                {
                    $class_erreur = "erreur";
					$erreur = "Aucun trajet non payé trouvé";

                    $ret_trajet->closeCursor();
                }
                else
                {
                    $total = 0;

                    while($row = $ret_trajet->fetch())
                    {
                        $total += $row['prix'];

                        $tpl->setBlock("navette", array("DDEPART" => $row['dateDep'],
                                                        "HEURE" => $row['heureDep'],
                                                        "DEPART" => get_lieu($row['id_depart']),
                                                        "DEST" => get_lieu($row['id_dest']),
                                                        "NB_PERS" => ($row['nb_pers'] + $row['nb_enfant']),
                                                        "PRIX" => $row['prix']
                                                        )
                                      );
                    }
                    $ret_trajet->closeCursor();
                }
            }
        }


        if($class_erreur == "erreur")
		{
			$tpl->set(array(
							"CLASS_ERREUR" => $class_erreur,
							"ERREUR" => $erreur,
							"TITRE_PAGE" => $ariane_paiement_manuel_titre,
							"RECAPITULATIF" => $recapitulatif
							)
					 );
		}
        else
        {
            
            $lang_paypal = (strtolower($_SESSION['lang']) == 'fr') ? 'FR' : 'GB';
            $custom = $datee . "|" . $id_client . "|0|" . $_SESSION['lang'] . "|0|0|0|0|0|1";


            //$descr_trajet = 'Trajet '. $lieu_depart. ' -> '. $lieu_arrive . ' | Date : ' . $row_trajet1['date_jour'];
            $descr_trajet = "Paiement des navettes (professionnel)";


            if($active_ca)
                $encrypted_ca = crypter($custom . "-|-" . $total . "-|-" . $mail_client_ca);
            else
                $encrypted_ca = "";


            global $active_paypal, $active_ca;


            if($active_paypal)
                $encrypted = form_paypal($total, $descr_trajet, $custom, $lang_paypal);
            else
                $encrypted = "0";


            $tpl->set(array(
                            "CLASS_ERREUR" => $class_erreur,
							"ERREUR" => $erreur,
                            "TITRE_PAGE" => $titre_pro,
							"RECAPITULATIF" => $recapitulatif_pro,
                            "TOTAL" => $total,
                            "DATE_TRAJET" => $date,
                            "HEURE_TRAJET" => $heure,
                            "DEPART_TRAJET" => $trajet_depart,
                            "DEST_TRAJET" => $trajet_arrive,
                            "PERS_TRAJET" => $nombre_passager,
                            "PRIX_TRAJET" => $prix_navette,
                            "NOM_CLIENT" => $nom_client,
                            "PRENOM_CLIENT" => $prenom_client,
                            "TEL_CLIENT" => $tel_client,
                            "PORT_CLIENT" => $port_client,
                            "ADRESSE_CLIENT" => $adresse_client,
                            "CODE_POST_CLIENT" => $code_post_client,
                            "VILLE_CLIENT" => $ville_client,
                            "PAYS_CLIENT" => $pays_client,
                            "CIVILITE" => $civilite,
                            "EMAIL" => $email,
                            "TITRE_CLIENT" => $titre_client,
                            "ENCRYPTED" => $encrypted,
							"TARGET_IMG_PAYPAL" => (strtolower($_SESSION['lang']) == 'fr') ? 'fr_FR/FR' : 'en_US',
							"ALT_PAYPAL" => $alt_paypal,
                            "ACTIVE_PAYPAL" => $active_paypal,
                            "ACTIVE_CA" => $active_ca,
                            "MODE_DE_PAIEMENT" => $mode_de_paiement,
                            "INFO_MODE_PAIEMENT" => $info_mode_paiement,
                            "ENCRYPTED_CA" => $encrypted_ca,
                            "PRIX_TOTAL" => $prix_total
                        )
                     );             
             
        }

		$tpl->set(array(
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
		
        $tpl->parse("aeroport/reservation/professionnel.html");

    }
    else
	{
		header('Location: ../index.php');
		exit();
	}

?>
