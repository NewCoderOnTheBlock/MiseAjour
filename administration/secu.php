<?php


session_start();

$login = $_POST['log'];
$pass = $_POST['pass'];

//Connection � mysql et s�lection de la base de donn�es
$db = mysql_connect('db922.1and1.fr', 'dbo206617947', 'D5ZEtV4h');
//$db = mysql_connect('localhost', 'root', '');
mysql_select_db('db206617947',$db);
//mysql_select_db('navette',$db);
//Pr�paration de la requ�te
$query = "SELECT * FROM profil WHERE log = '$login' AND pass = '$pass'";

//ex�cution de la requ�te et r�cup�ration du nombre de r�sultats
$result = mysql_query($query);
$affected_rows = mysql_num_rows($result);

//S'il y a exactement un r�sultat, l'utilisateur est authentifi�, sinon, on l'emp�che d'entrer

if($affected_rows == 1) 
{
include "accueil.php";

//On ajoute l'utilisateur aux variables de session

$_SESSION['user'] = $login; 
$_SESSION['pass'] = $pass; 
}

else 
{
print 'Acc�s refus�';
}
?>
