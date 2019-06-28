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

<title>envoi e-mail</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="style.css" rel="stylesheet" type="text/css" > 

</head>

<body>

<div id="container">
	<h1>Administration du site www.alsace-navette.com</h1>
	<?php
	  include("menu.php");
	  ?>
	
	<div id="centre">
<br><br><br><br><br><br><br><br>	
<?

// ouverture de la connexion et choix de la BD 
   
$connexion = mysql_connect('db922.1and1.fr', 'dbo206617947', 'D5ZEtV4h');
//$db = mysql_connect('localhost', 'root', '');
mysql_select_db('db206617947', $connexion);
//mysql_select_db('navette',$db);
$date=date('Y-m-d');
$an=substr($date,0,4);
$mois=substr($date,5,2);
$jour=substr($date,8,2);

$jour3=$jour+3;
$mois3=$mois;

if ($mois == 2)
{
 if($jour3>29)
 {
  $jour3=$jour3-29;
  $mois3=3;
 }
}
else if ($mois==1 || $mois==3 || $mois==5 || $mois==7 || $mois==8 || $mois==10 || $mois==12)
{
  if($jour3>31)
  {
   $jour3=$jour3-31;
   $mois3=$mois+1;
  }  
}
else
{
	if($jour3>30)
  {
   $jour3=$jour3-30;
   $mois3=$mois+1;
  }  
}

$date3=$an.'-'.$mois3.'-'.$jour3;

// prendre la liste des champs 
$sql= "SELECT nom,e_mail FROM vue_globale where paiement = '' and d_depart = '".$date3 ."' ";

$result = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
//prendre chaque rangée
$nbr_champ=mysql_num_fields($result);

if ($nbr_champ !=0) 
{
    echo "<h1>Clients avec demande non validée au départ le '".$date3 ."'  </h1>";
	echo "<table>\n";
    echo "<thead><th>Nom</th><th>E-Mail</th></thead>\n";
	$i=0;
	while($row = mysql_fetch_row($result)){
		echo"<tr><td>$row[0]</td><td>$row[1]</td></tr>";
		$a[$i]=$row[1];
		$i=$i+1;
	}
	echo "</table>\n";
	echo "<tr><td>";
	?>
	<form method="post" action="email1.php" name ="email">
	<p id="buttons">
	<input type="submit" value="envoi e-mail auto" />
	</p>
	<input type = "hidden" name = "nbrchamps" value="<?=$nbr_champ?>">
	<?
	
	for($i=0;$i<$nbr_champ;$i++)
	{
	 ?>
	 <input type = "hidden" name = "<?=$i?>" value="<?=$a[$i]?>">
	 <?
	}	
	echo "</form></td></tr>";	
} 
else  
{
echo "<h1>Clients avec demande non validée au départ le '".$date3 ."' </h1>";
echo "Désolé, pas d'enregistrement !";   
}

mysql_close();

?>
</div>
	
</div>


	

</body>

</html>
