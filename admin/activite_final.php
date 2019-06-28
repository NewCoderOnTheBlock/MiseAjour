<?php
session_start();
// connexion à la bdd
include("connection.php");



$remarques = addslashes($_POST['remarques']);//
$id_activite = $_POST['id_activite'];
$mission = addslashes($_POST['mission']);
$id_admin_ordre = $_POST['id_admin_ordre'];
$comment_ordre = $_POST['comment_ordre'];
$autre_activite = $_POST['autre_activite'];
if($autre_activite == ""){
    $autre_activite= "NULL";
}
else{
    $autre_activite="'".addslashes($autre_activite)."'";
}



$heureD_str = $_POST['heureD'];
$minuteD_str = $_POST['minuteD'];
//concaténation pour le champ time
$heureD_str = $heureD_str.":".$minuteD_str.":00";

$heureA_aero = $_POST['heureD'];
$minuteA_aero = $_POST['minuteD'];
//concaténation pour le champ time
$heureA_aero = $heureA_aero.":".$minuteA_aero.":00";

$heureD_aero = $_POST['heureD'];
$minuteD_aero = $_POST['minuteD'];
//concaténation pour le champ time
$heureD_aero = $heureD_aero.":".$minuteD_aero.":00";

$heureA_str = $_POST['heureA'];
$minuteA_str = $_POST['minuteA'];
//concaténation pour le champ time
$heureA_str = $heureA_str.":".$minuteA_str.":00";

//DATE

$request = "INSERT INTO aeroport_recap_trajet (
`id_recap` ,
`idcm` ,
`id_conducteur` ,
`id_vehicule` ,
`date` ,
`heureD_str` ,
`heureA_aero` ,
`heureD_aero` ,
`heureA_str` ,
`nb_grp_aller` ,
`nb_grp_retour` ,
`pass_aller_res` ,
`pass_retour_res` ,
`kmsD` ,
`kmsA` ,
`niv_essence_depart` ,
`niv_essence_arrivee` ,
`remarques` ,
`pass_aller_nonres` ,
`pass_retour_nonres` ,
`montantA` ,
`montantR` ,
`essence` ,
`lavext` ,
`lavint` ,
`unites` ,
`depot` ,
`id_activite` ,
`mission` ,
`id_admin_ordre` ,
`comment_ordre` ,
`autre_activite`
)
VALUES (
NULL ,
 '-1',
 '".$_SESSION['user_id']."',
 NULL ,
 '" . $_POST['hdn_date'] . "',
 '".$heureD_str."',
 '".$heureA_aero."',
 '".$heureD_aero."',
 '".$heureA_str."',
 NULL ,
 NULL ,
 NULL ,
 NULL ,
 NULL ,
 NULL ,
 NULL ,
 NULL ,
 '".$remarques."',
 NULL ,
 NULL ,
 '',
 '',
 '',
 NULL ,
 NULL ,
 '',
 NULL ,
 '".$id_activite."',
 '".$mission."',
 '".$id_admin_ordre."',
 '".$comment_ordre."',
 ".$autre_activite.")";

mysql_query($request) or die (mysql_error());


?>
<script type="text/javascript">
		<!--
		window.location.replace("index2.php?p=1");
		-->
</script>