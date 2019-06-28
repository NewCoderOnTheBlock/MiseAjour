<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

<head>

<title>infos client</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="style.css" rel="stylesheet" type="text/css" > 

</head>

<body>

<div id="container">

	<div id="centre">
	
<?

// ouverture de la connexion et choix de la BD 
   
$connexion = mysql_connect('db922.1and1.fr', 'dbo206617947', 'D5ZEtV4h');
//$db = mysql_connect('localhost', 'root', '');
mysql_select_db('db206617947', $connexion);
//mysql_select_db('navette',$db);
$nom=$_GET["ID"];
$mysql_result4 = mysql_query("SELECT distinct nom,prenom,n_voie,type_voie,nom_voie,code_postal,ville,e_mail,telephone,portable FROM admin_reserv where nom='".$nom."'");
//prendre chaque rangée

if ($ligne4 = mysql_fetch_array($mysql_result4)) 
{
	echo "<table>\n";
    echo "<thead><th>nom</th><th>prenom</th><th>adresse</th><th>cp</th><th>ville</th><th>mail</th><th>telephone</th><th>portable</th></thead>\n";
	do 
	{
        printf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>\n",  $ligne4["nom"],  $ligne4["prenom"] , $ligne4["n_voie"].' '.$ligne4["type_voie"].' '.$ligne4["nom_voie"], $ligne4["code_postal"] ,$ligne4["ville"], $ligne4["e_mail"], $ligne4["telephone"], $ligne4["portable"]);
	} 
    while ($ligne4 = mysql_fetch_array($mysql_result4));
    echo "</table>\n";
} 

mysql_close();

?>
</div>
	
</div>


	

</body>

</html>
