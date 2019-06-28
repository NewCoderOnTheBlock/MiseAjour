<?php
// include("verifAuth.php");

	// SCRIPT PERMETTANT DE REMPLIR LE CHAMP recap_recherche POUR LES CHAMPS DE RECHERCHE

function execution($req)
{	
	if($_SERVER["SERVER_ADDR"]=="192.168.3.2") // si localhost
	{
		$c = mysql_connect('localhost', 'root', '');
		mysql_select_db('a-n');
	}
	else
	{
		$c = mysql_connect('db922.1and1.fr', 'dbo206617947', 'D5ZEtV4h');
		mysql_select_db('db206617947');
	}
	
	mysql_query("SET NAMES 'utf8'");
	mysql_query('SET CHARACTER SET utf8');
	
	$res = mysql_query($req,$c);
	mysql_close($c);
	return $res;
}

$sql = "select * from aeroport_client";
$r = execution($sql);

while($l=mysql_fetch_array($r))
{
	$txt = "";
	$sql_pays = "select * from  aeroport_pays where id_pays=".$l['id_pays'];
	$rPays = mysql_fetch_array(execution($sql_pays));
	
	$txt .= $rPays['nom_pays']." ".$l['nom']." ".$l['prenom']." ".$l['adresse']." ".$l['code_postal']." ".$l['ville']." ".$l['mail'];
	
	$ad = "update aeroport_client set recap_recherche='".addslashes(strtolower($txt))."' where id_client=".$l['id_client'];
	execution($ad);
}
?>