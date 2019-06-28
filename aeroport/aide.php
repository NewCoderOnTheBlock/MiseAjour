<?php

	session_start();
		
	require_once('includes/tpl_base.php');
	
	$tab = get_liste_faq($_SESSION['lang']);
	for($i = 0; $i< count($tab);$i++)
	{
		$tpl->setBlock('faq', array(
									'QUESTION' => $tab[$i]['question_faq'],
									'REPONSE' => $tab[$i]['reponse_faq'],
									'NUM' => $i+1
									)
						);
	}

	$tpl->set(array(
					"TITRE_PAGE" => $titre_aide,
					"TITRE_AIDE" => $aide,
					"TITRE_ETAPE_1" => $titre_etape_1,
					"TITRE_ETAPE_2" => $titre_etape_2,
					"TITRE_ETAPE_3" => $titre_etape_3,
					"TITRE_ETAPE_4" => $titre_etape_4,
					"TITRE_ETAPE_5" => $titre_etape_5,
					"TITRE_ETAPE_6" => $titre_etape_6,
					"TITRE_ETAPE_7" => $titre_etape_7,
					"TITRE_ETAPE_8" => $titre_etape_8,
					"TITRE_ETAPE_9" => $titre_etape_9,
					"TITRE_ETAPE_10" => $titre_etape_10,
					"TXT_ETAPE_1" => $txt_etape_1,
					"TXT_ETAPE_2" => $txt_etape_2,
					"TXT_ETAPE_3" => $txt_etape_3,
					"TXT_ETAPE_5" => $txt_etape_5,
					"TXT_ETAPE_6_1" => $txt_etape_6_1,
					"TXT_ETAPE_6_2" => $txt_etape_6_2,
					"TXT_ETAPE_6_3" => $txt_etape_6_3,
					"TXT_ETAPE_7" => $txt_etape_7,
					"TXT_ETAPE_8" => $txt_etape_8,
					"ETAPE_8_LIEN_RASS" => $etape_8_lien_rass,
					"ETAPE_8_LIEN_RASS_AEROPORT" => $etape_8_lien_rass_aeroport,
					"TXT_ETAPE_9" => $txt_etape_9,
					"TXT_ETAPE_10" => $txt_etape_10,
					"TXT_BON_VOYAGE" => $txt_bon_voyage
					)
			);
	
	$tpl->parse("aeroport/aide.html");
	
?>