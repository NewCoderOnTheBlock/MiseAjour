<?php

	session_start();

	require_once('includes/tpl_base.php');
		
	$tpl->set(array(
					"TITRE_PAGE" => $titre_faq,
					"TITRE" => $presentation_faq,
					
					"TXT_QUESTION" => $lang_question,
					"TXT_REPONSE" => $lang_reponse
					)
			);
	
	// Liste des aéroports
	foreach($lang_liste_aero as $tab)
	{
		$tpl->setBlock('liste_aero', array(
									'IMAGE' => $tab['IMAGE'],
									'LIEN' => $tab['LIEN'],
									'TEXTE' => $tab['TEXTE']
									)
						);
	}
    
	// Liste des Q & A
	$count = 1;
	foreach(get_liste_faq($_SESSION['lang']) as $tab){
		$tpl->setBlock('liste_faq', array(
									'ID' => $tab['id_faq'],
									'NUMERO' => $count,
									'QUESTION' => nl2br($tab['question_faq']),
									'REPONSE' => nl2br($tab['reponse_faq'])
									)
						);
		$count += 1;
	}
	
	
    $tpl->parse("aeroport/faq.html");

?>
