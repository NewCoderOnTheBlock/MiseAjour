<?php
	try{
		$bdd = new PDO('mysql:host=db922.1and1.fr;dbname=db206617947', 'dbo206617947', 'D5ZEtV4h');
		$bdd->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
	}catch(Exception $e){
		echo 'Erreur de connexion à la base de données.';
	}
?>