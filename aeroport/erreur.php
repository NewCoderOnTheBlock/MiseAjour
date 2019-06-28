<?php

session_start();

require_once('includes/tpl_base.php');

if(isset($_GET['erreur']))
	$num_erreur = intval($_GET['erreur']);
else
	$num_erreur = 1;


$txt_erreur = "";

$tab_erreur = array(400, 401, 403, 404, 405, 500, 501, 502, 503, 504, 505);

if(in_array($num_erreur, $tab_erreur))
{
	$tmp = "erreur_" . $num_erreur;
	$txt_erreur = $$tmp;
}
elseif($num_erreur == 0)
	$txt_erreur = $erreur_sql;
else
	$txt_erreur = $erreur_defaut;


$tpl->set(array(
				"TITRE_PAGE" => $page_erreur,
				"ERREUR" => $txt_erreur,
				"REVENIR" => $revenir,
				"TXT_ERREUR" => $erreur,
				"NUM_ERREUR" => $num_erreur
				)
		 );

$tpl->parse('aeroport/erreur.html');

?>
