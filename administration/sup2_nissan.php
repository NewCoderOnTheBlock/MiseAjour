<?php

$id = $_POST['id'];

$db = mysql_connect('db922.1and1.fr', 'dbo206617947', 'D5ZEtV4h');
mysql_select_db('db206617947',$db);
//$db = mysql_connect('localhost', 'root', '');
//mysql_select_db('navette',$db);

$sql = "DELETE * FROM navette  where reservation = '$id' "; 

mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());

mysql_close();

session_destroy();

include ("accueil.php");
 
?>

