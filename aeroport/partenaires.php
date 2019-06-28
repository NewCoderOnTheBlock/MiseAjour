<?php

	session_start();

	require_once('includes/tpl_base.php');
	
	
	// le fil d'ariane
	
	$tab_ariane = array(
						array(
							'ARIANE' => $ariane_accueil,
							'LIEN' => 'index.html'
							),
						array(
							'ARIANE' => $presentation_partenaires,
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


    if(isset($_GET['partner']) && is_numeric($_GET['partner']))
    {
        $tab_partner = get_un_partner(intval($_GET['partner']));

        $tab_id_partner = get_id_partner();

        $id_courrant;

        $trouve = false;
        for($i = 0; $i < count($tab_id_partner) && !$trouve; $i++)
        {
            if($tab_id_partner[$i] == intval($_GET['partner']))
            {
                $trouve = true;
                $id_courrant = $i;
            }
        }


        $partner_suivant = ($id_courrant < count($tab_id_partner) -1) ? $tab_id_partner[$id_courrant+1] : $tab_id_partner[0];
        $partner_precedent = ($id_courrant == 0) ? $tab_id_partner[count($tab_id_partner)-1] : $tab_id_partner[$id_courrant-1];

        

        $tpl->set(array(
                        "TITREE" => stripslashes($tab_partner['titre']),
                        "TEXT" => stripslashes($tab_partner['text']),
                        "LIENN" => $tab_partner['lien'],
                        "IMAGE" => $tab_partner['image'],
                        "TYPE" => "SEUL",
                        "TITRE" => $fiche_partenaire,
                        "DESCRIPTION" => $description,
                        "PARTNER_SUIVANT" => $partner_suivant,
                        "PARTNER_PRECEDENT" => $partner_precedent
                        )
                   );
    }
    else
    {
        foreach(set_partner_client("partner") as $tab)
        {
            $tpl->setBlock('tab_partner', array(
                                                "TITRE" => stripslashes($tab['titre']),
                                                "ID" => $tab['id'],
                                                "IMAGE" => $tab['image'],
                                                "LIEN" => $tab['lien']
                                                )
                          );
        }

        foreach(set_partner_client("client") as $tab)
        {
            $tpl->setBlock('tab_partner', array(
                                                "TITRE" => stripslashes($tab['titre']),
                                                "ID" => $tab['id'],
                                                "IMAGE" => $tab['image'],
                                                "LIEN" => $tab['lien']
                                                )
                          );
        }

        $tpl->set(array(
                        "TYPE" => "TOUS",
                        "TITRE" => $presentation_partenaires
                        )
                  );
    }



    
	$tpl->set(array(
					"TITRE_PAGE" => $titre_partenaires,
                    "NOM" => $nom_client,
                    "LIEN" => $lien,
                    "VOIR_LE_DETAIL" => $voir_le_detail,
                    "PRECEDENT" => $page_precedent,
                    "SUIVANT" => $page_suivant
					)
			);
			
    
    $tpl->parse("aeroport/partenaires.html");

?>
