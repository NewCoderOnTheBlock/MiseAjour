<?php
	
// Connexion à la base de données
try
{
	$db = new PDO('mysql:host=localhost;dbname=db206617947;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}


//	mysql_connect('localhost', 'root', '');
//	mysql_select_db('a-n');

	// sur jardin de safran
	//$db = mysql_connect('db1038.1and1.fr', 'dbo211822882', 'ZVUfH3fT');
	//mysql_select_db('db211822882',$db);
?>
