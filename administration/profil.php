<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

<head>

<title>r&eacute;servation</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="style.css" rel="stylesheet" type="text/css" > 

</head>

<body>

<div id="container">
	
	<h1>R&eacute;servation</h1>

	<?php
	  include("menu.php");
	  ?>
	
	<div id="centre">
<?
	session_start();
	$user = $_SESSION['user']; 
	echo 'Bonjour <b>'.$user.'</b><br>';
	echo 'votre profil est le suivant:<br><br>';
	
	$db = mysql_connect('db922.1and1.fr', 'dbo206617947', 'D5ZEtV4h');
	mysql_select_db('db206617947',$db);
	
	$info_user = "SELECT * FROM profil WHERE log = '$user'";	
	$info_query = mysql_query($info_user);
		
	if ($ligne = mysql_fetch_array($info_query)) 
{
	echo "<table>\n";
    echo "<thead><th>id user</th><th>nom</th><th>prenom</th><th>log</th><th>pass</th></thead>\n";
	do 
	{
        printf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>\n", $ligne["iduser"] , $ligne["log"], $ligne["pass"], $ligne["nom"] , $ligne["prenom"] );
	} 
    while ($ligne = mysql_fetch_array($info_user));
    echo "</table>\n";
} 
else  
{
echo "Désolé, pas d'enregistrement !";   
}

?>
	</div>
</form>

</div>
</body>
</html>