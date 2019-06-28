<?php session_start(); 
/*
si la variable de session login n'existe pas cela siginifie que le visiteur
n'a pas de session ouverte, il n'est donc pas logué ni autorisé à
acceder à l'espace membres
*/
if (!isset($_SESSION['user'])  ) { 
   //header ('Location: index.php'); 
   echo '<script language="Javascript">
		<!--
		document.location.replace("index.html");
		// -->
		</script>'; 
  exit();  
 } 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

<head>

<title>saisir véhicule</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="style.css" rel="stylesheet" type="text/css" > 
<link href="styles/formulaire1.css" rel="stylesheet" type="text/css" >
</head>

<body>

<div id="container">
	
<h1>Saisie Insérée</h1>

<?php
	  include("menu.php");
	  ?>


<?php

$vehicule = $_POST['vehicule'];

$input1 = $_POST['input1'];
$mois = substr($input1, 3, 2);
$jour = substr($input1, 0, 2);
$an = substr($input1,6,4);
$date = $an."-".$mois."-".$jour;

$conducteur = $_POST['conducteur'];
$service = $_POST['Rubrique'];
$navette = $_POST['Page'];
$remarques = $_POST['remarques'];
$groupe = $_POST['groupe']; 
$pass_aller = $_POST['pass_aller'];
$pass_retour = $_POST['pass_retour'];
$mnt = $_POST['mnt'];
$heureD = $_POST['heureD'];
$minuteD = $_POST['minuteD'];
$heureA = $_POST['heureA'];
$minuteA = $_POST['minuteA'];
$domicile = $_POST['domicile'];
$kmsD = $_POST['kmsD'];
$kmsA = $_POST['kmsA'];
$essenceD = $_POST['nivD'];	
$essenceA = $_POST['nivA']; 
$essence = $_POST['essence'];
$unites = $_POST['unites'];	
$lavext = $_POST['lavext']; 
$lavint = $_POST['lavint'];
$depot = $_POST['depot'];

$kms=$kmsA-$kmsD;

if ($heureA<$heureD)
{
$duree=24-$heureD-($minuteD/60)+$heureA+($minuteA/60);
}
else
{
$duree=$heureA+($minuteA/60)-$heureD-($minuteD/60);
}

$duree=round($duree,2);

$depart = $heureD.":".$minuteD;
$arrivee = $heureA.":".$minuteA; 

$db = mysql_connect('db922.1and1.fr', 'dbo206617947', 'D5ZEtV4h');
mysql_select_db('db206617947',$db);
//$db = mysql_connect('localhost', 'root', '');
//mysql_select_db('navette',$db);

$sql = "INSERT INTO navette (vehicule , date , conducteur , service , navette , remarques, groupes , pass_aller , pass_retour , montant , depart , arrivee , duree , domicile, kmsD , kmsA , kms , essenceD , essenceA,essence,lavext,lavint,unites,depot) VALUES ('$vehicule' , '$date' , '$conducteur' , '$service' , '$navette' , '$remarques', '$groupe' , '$pass_aller' , '$pass_retour' , '$mnt' , '$depart' , '$arrivee' , '$duree' , '$domicile', '$kmsD' , '$kmsA' , '$kms' , '$essenceD' , '$essenceA', '$essence', '$lavext', '$lavint', '$unites' , '$depot' )"; 

mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());

mysql_close();

session_destroy();

 
?>
</div>
</body>
</html>
