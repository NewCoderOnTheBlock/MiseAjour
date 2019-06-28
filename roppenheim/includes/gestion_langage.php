<?php
	// Si il y a une variable lang dans les cookies, on la r�cup�re
	if (isset($_GET['lang']) && ($_GET['lang'] == 'fr' || $_GET['lang'] == 'en')){
		$_SESSION['lang'] = $_GET['lang'];
	}
	// Si il y a une variable lang dans les cookies, on la r�cup�re
	elseif (isset($_COOKIE['lang'])){
		$_SESSION['lang'] = $_COOKIE['lang'];
	}
	// Si aucune langue n'est sp�cifi�e, on met le fran�ais par defaut
	else{
		$_SESSION['lang'] = 'fr';
	}
	// On inclue le fichier lang correspondant
	require_once('/homepages/3/d205267944/htdocs/roppenheim/includes/'.$_SESSION['lang'].'_lang.php');
	// On ins�re �galement le cookie
	setcookie("lang", $_SESSION['lang'], time()+3600*24*30, '/');
?>