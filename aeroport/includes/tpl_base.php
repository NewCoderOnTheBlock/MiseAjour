<?php
	@session_start();
	//~ if($_SESSION['config']['error_reporting'])
		//~ error_reporting(E_ALL | E_STRICT);
	
	require_once(dirname(__FILE__) . "/../../includes/fonctions.php");
	require_once(dirname(__FILE__) . "/../../libs/db.php");
	
	
	if($_SESSION['config']['maintenance'])
	{		
		if(get_ip() != $_SESSION['config']['ip_autorise'])
		{
			$_SESSION['txt_maintenance'] = "";
			
			
			header('Location: maintenance.html');
			exit();
		}
		else
			$_SESSION['txt_maintenance'] = '<br /><h2 style="text-decoration:blink;color:red">Le site est en maintenance<br />Seul l\'IP ' . $_SESSION['config']['ip_autorise'] . ' est autorisée</h2><br />';
	}
	else
		$_SESSION['txt_maintenance'] = "";

	
	if(!isset($_SESSION['logger']))
		$_SESSION['logger'] = false;
		
	if(!isset($_SESSION['client']['est_admin']))
		$_SESSION['client']['est_admin'] = "0";
		
	if(!isset($_SESSION['est_admin_client']))
	{
		$_SESSION['client']['nom'] = "";
		$_SESSION['client']['prenom'] = "";
		$_SESSION['client']['mail'] = "";
	}
	
	
	if(!isset($_SESSION['est_admin_client']))
		$_SESSION['est_admin_client'] = "0";
	
	
	
	if(!isset($_SESSION['debut_resa']))
		$_SESSION['debut_resa'] = "0";
	
	// pour la gestion des dates
	date_default_timezone_set('Europe/Paris');
	
	
	quote();
	
	langue();
	
	
	require_once($_SESSION['lang'] . '.lang.php');
	require_once("../includes/" . $_SESSION['lang'] . '.lang.php');
	require_once(dirname(__FILE__) . "/../../includes/template.php");
	
	global $file, $cache, $baseurl;
	
	$tpl = new Talus_TPL($file, $cache);
	
	
	//menu de gauche
	foreach(set_menu_gauche() as $tab)
	{
		$tpl->setBlock('menu_gauche', array(
									'IMAGE' => $tab['IMAGE'],
									'LIEN' => $tab['LIEN'],
									'TEXT' => $tab['TEXT']
										)
						);
	}
	
	//menu de droite
	foreach(set_menu_droite() as $tab)
	{
		$tpl->setBlock('menu_droite', array(
									'IMAGE' => $tab['IMAGE'],
									'LIEN' => $tab['LIEN'],
									'TEXTE' => $tab['TEXTE']
										)
						);
	}
	
	
		
	
	// la speedbar
	foreach(set_speed_bar() as $tab)
	{
		$tpl->setBlock('speed', array(
									'ITEM' => $tab['ITEM'],
									'LIEN' => $tab['LIEN'],
									'IMAGE' => $tab['IMAGE']
										)
						);
	}
	
	// les éléments de base identiques sur chaques pages
	foreach(tpl_base() as $key => $value)
		$tpl->set($key, $value);
	
	
	// le bas de page
	$footer = set_footer();
	$tpl->set($footer);
	
	$tpl->set(array(
		"EST_ADMIN" => $_SESSION['client']['est_admin'],
		//~ "ID_CLIENT" => $_SESSION['client']['id_client'],
		"INFO_BARRE" => $lang_info_barre,
		"LANGUE" => $_SESSION['lang'],
		"LIEN_QUI_SOMMES_NOUS" => $lien_qui_sommes_nous,
		"LIEN_SERVICES" => $lien_services,
		"LIEN_CONTACT" => $contact,
		"TEXTE_LICENCE" => $lang_texte_licence,
		"EMAIL" => $email,
		"PASSWD" => $passwd,
		"MDP_OUBLIE" => $mdp_oublie,
		"BTN_ENVOYER" => $btn_envoyer,
		"URI" => $_SERVER['REQUEST_URI'],
		"FERMER" => $fermer
	));
		
?>
