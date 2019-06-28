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

<title>conducteurs</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="style.css" rel="stylesheet" type="text/css" > 

</head>

<body>

<div id="container">
	<h1>Administration du site www.alsace-navette.com</h1>
	<?php
	  include("menu.php");
	  ?>
<br><br><br><br><br><br><br><br>	
	<div id="centre">
<?
    echo "<h1>Infos Conducteurs</h1>";
	echo "<table>\n";
    echo "<thead><th>Prénom</th><th>Tel Fixe</th><th>Tel Portable</th><th>E-mail Pro</th><th>E-Mail Privé</th><th>Jour Repos</th></thead>\n"; 
    echo"<tr><td>HAMID</td><td>03 88 83 71 49</td><td>06 28 45 66 14</td><td>hamid.saadat@alsace-navette.com</td><td>hshsaadat@hotmail.com</td><td>Lundi</td></tr>";
	echo "<tr><td>KEVIN</td><td></td><td>06 66 79 59 91</td><td></td><td>guilerat-kevin@live.fr</td><td>Jeudi</td></tr>";
	echo"<tr><td>PACHA</td><td>03 88 19 92 54</td><td>06 27 18 12 52</td><td>alsace@franco-iraniens.fr</td><td>pacha.mobasher@franco-iraniens.fr</td><td></td></tr>";
	echo"<tr><td>PHILIPPE</td><td>03 88 77 18 87</td><td>06 32 71 04 94</td><td>philippe.lebosse@alsace-navette.com</td><td>lebossephilippe@wanadoo.fr</td><td>Mardi</td></tr>";
    echo "</table>\n";
?>
</div>
	
</div>

</body>

</html>