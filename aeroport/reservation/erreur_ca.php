<?php
    session_start();

	require_once('../includes/tpl_base.php');

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
                            'ARIANE' => $ariane_erreur_paiement,
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

    $num_erreur_ca = str_replace("-", "", $_GET['NUMERR']);

    if($num_erreur_ca > 0 && $num_erreur_ca < 17)
    {
        $txt_erreur_ca = "txt_erreur_ca_" . $num_erreur_ca;
        $txt_erreur_final = $$txt_erreur_ca;
    }
    else
        $txt_erreur_final = "";


    $tpl->set(array(
                    "TITRE_PAGE" => $erreur_paiement_ca,
                    "TITRE_ERREUR" => $ariane_erreur_paiement,
                    "ERREUR" => $txt_erreur_final,
                    "INTRO_ERREUR" => $intro_erreur_ca,
                    "FIN_ERREUR" => $fin_erreur_ca
                    )
             );


    $tpl->parse("aeroport/reservation/erreur_ca.html");

    

?>
