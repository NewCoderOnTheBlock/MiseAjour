<?php
	// Si il y a une variable lang dans les cookies, on la récupère
	if (isset($_GET['lang']) && ($_GET['lang'] == 'fr' || $_GET['lang'] == 'en')){
		$_SESSION['lang'] = $_GET['lang'];
	}
	// Si il y a une variable lang dans les cookies, on la récupère
	elseif (isset($_COOKIE['lang'])){
		$_SESSION['lang'] = $_COOKIE['lang'];
	}
	// Si aucune langue n'est spécifiée, on met le français par defaut
	else{
		$_SESSION['lang'] = 'fr';
	}
	// On inclue le fichier lang correspondant
	require_once('/homepages/3/d205267944/htdocs/roppenheim/includes/'.$_SESSION['lang'].'_lang.php');
	// On insère également le cookie
	setcookie("lang", $_SESSION['lang'], time()+3600*24*30, '/');
?>