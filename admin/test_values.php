<?php 

include('connection.php');
$idcm = $_POST['idcm'];
$heureD_str = $_POST['heureD_str'];
$minuteD_str = $_POST['minuteD_str'];
$heureA_str = $_POST['heureA_str'];
$minuteA_str = $_POST['minuteA_str'];
$heureA_aero = $_POST['heureA_aero'];
$minuteA_aero = $_POST['minuteA_aero'];
$heureD_aero = $_POST['heureD_aero'];
$minuteD_aero = $_POST['minuteD_aero'];


//calcul du temps mis en sec sur les 2 trajets
$dureeStrAero = ($heureA_aero*3600 + $minuteA_aero*60)-($heureD_str*3600 + $minuteD_str*60);
$dureeAeroStr = ($heureA_str*3600 + $minuteA_str*60)-($heureD_aero*3600 + $minuteD_aero*60);


//selection de la durée moyenne en sec sur ce trajet
$req = "SELECT duree FROM aeroport_lieu where id_lieu = (SELECT id_lieu FROM aeroport_gestion_planning WHERE id_com = '".$idcm."' LIMIT 1)";

$res = mysql_query($req) or die (mysql_error());
$r = @mysql_fetch_assoc($res);
$duree = $r["duree"];


//si c merdé
if(($dureeStrAero >= $duree)||($dureeAeroStr >= $duree)){
	$msg = 'alert("Il y a un écart trop important entre la durée du/des trajet(s), il faut donc le justifier dans la case du formulaire");';
	$msg = 'returnation(false);';
}
else{
	$msg = 'returnation(true);';
}
echo $msg;

?>