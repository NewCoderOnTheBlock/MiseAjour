<?php
	/*
		KEMPF Pierre-Louis
		verifAuth.php
		Permet de vérifier si la personne tentant d'accéder aux pages est bien
		administrateur ou conducteur.
		Cela permet de contrer la faille qui permettait d'y accéder en entrant 
		le chemin du fichier.
	*/
	if (!isset($_SESSION)){
		session_start();
	}
	if (!isset($_SESSION['user'])){
		echo "<div style='margin:auto;width:100%;text-align:center;'>Error : NoUser</div>";
		require("log.php");
		exit;
	}elseif($_SESSION['user_type']!="a"){
		echo "<div style='margin:0 auto 0 auto'>Error : Access Denied</div>";
		session_unset();
		session_destroy();
		require("log.php");
		exit;
	}
?>