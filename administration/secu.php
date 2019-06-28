<?php


session_start();

$login = $_POST['log'];
$pass = $_POST['pass'];

//Connection à mysql et sélection de la base de données
$db = mysql_connect('db922.1and1.fr', 'dbo206617947', 'D5ZEtV4h');
//$db = mysql_connect('localhost', 'root', '');
mysql_select_db('db206617947',$db);
//mysql_select_db('navette',$db);
//Préparation de la requête
$query = "SELECT * FROM profil WHERE log = '$login' AND pass = '$pass'";

//exécution de la requête et récupération du nombre de résultats
$result = mysql_query($query);
$affected_rows = mysql_num_rows($result);

//S'il y a exactement un résultat, l'utilisateur est authentifié, sinon, on l'empêche d'entrer

if($affected_rows == 1) 
{
include "accueil.php";

//On ajoute l'utilisateur aux variables de session

$_SESSION['user'] = $login; 
$_SESSION['pass'] = $pass; 
}

else 
{
print 'Accès refusé';
}
?>
