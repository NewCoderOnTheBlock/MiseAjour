<?php 
// include("verifAuth.php");
// connexion � la bdd
include("connection.php");

$idcm = $_POST['idcm'];

$id_conducteur = $_POST['conducteur'];

$id_vehicule = $_POST['vehicule'];

$remarques = $_POST['remarques']."<br/>".$_POST['expli'];//

$pass_aller_res = $_POST['pass_aller_res'];

$pass_retour_res = $_POST['pass_retour_res'];

$pass_aller_nonres = $_POST['pass_aller_nonres'];//

$pass_retour_nonres = $_POST['pass_retour_nonres'];//


    	   
$montantA = $_POST['montantA'];//

$montantR = $_POST['montantR'];//

$nb_grp_aller = $_POST['nb_grp_aller'];

$nb_grp_retour = $_POST['nb_grp_retour'];	

$heureD_str = $_POST['heureD_str'];
$minuteD_str = $_POST['minuteD_str'];
//concat�nation pour le champ time
$heureD_str = $heureD_str.":".$minuteD_str.":00";

$heureA_aero = $_POST['heureA_aero'];
$minuteA_aero = $_POST['minuteA_aero'];
//concat�nation pour le champ time
$heureA_aero = $heureA_aero.":".$minuteA_aero.":00";

$heureD_aero = $_POST['heureD_aero'];
$minuteD_aero = $_POST['minuteD_aero'];
//concat�nation pour le champ time
$heureD_aero = $heureD_aero.":".$minuteD_aero.":00";

$heureA_str = $_POST['heureA_str']; 
$minuteA_str = $_POST['minuteA_str'];
//concat�nation pour le champ time
$heureA_str = $heureA_str.":".$minuteA_str.":00";


if(isset($_POST['priseDom'])){
	$remarques = $remarques."<br />[présence de prises à domicile]";
}
if(isset($_POST['deposeDom'])){
	$remarques = $remarques."<br />[présence de dépose à domicile]";
}

if($_POST['from']=='from_this_aero'){
    $heureD_str=$heureD_aero;
    $heureA_aero=$heureD_aero;
    $remarques = $remarques."<br />[retour à la suite d'une longue attente à cet aéroport]";
}
elseif($_POST['from']=='from_other_aero'){
    $heureD_str=$heureA_aero;
    $remarques = $remarques."<br />[en provenance directe d'un autre aéroport]";
}
if($_POST['to']=='to_this_aero'){
    $heureD_aero=$heureA_aero;
    $heureA_str=$heureA_aero;
    $remarques = $remarques."<br />[En attente sur l'aéroport pour un trajet retour beaucoup plus tard]";
}
elseif($_POST['to']=='to_other_aero'){
    $remarques = $remarques."<br />[en route vers un autre aéroport sans passer par Strasbourg]";
}

$kmsD = $_POST['kmsD'];

$kmsA = $_POST['kmsA'];

$niv_essence_depart = $_POST['niv_essence_depart'];

$niv_essence_arrivee = $_POST['niv_essence_arrivee'];

$essence = $_POST['essence'];//

$consoMoyenne = $_POST["consoMoyenne"];

$lavext = $_POST['lavext'];//

$lavint = $_POST['lavint'];//

$unites = $_POST['unites'];//

$depot = $_POST['depot'];//

//is l'id recap n'est pas renseign�e, c'est une nouvelle r�cap
if(!isset ($_POST['id_recap']))
{
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
    `consommationMoyenne`
    `lavext` ,
    `lavint` ,
    `unites` ,
    `depot` ,
    `id_activite` ,
    `mission` ,
    `id_admin_ordre` ,
    `comment_ordre` ,
    `autre_activite`
    ) VALUES('','".$idcm."',
                                                       '".$id_conducteur."',
                                                       '".$id_vehicule."',
                                                       NOW(),
                                                       '".$heureD_str."',
                                                       '".$heureA_aero."',
                                                       '".$heureD_aero."',
                                                       '".$heureA_str."',
                                                       '".$nb_grp_aller."',
                                                       '".$nb_grp_retour."',
                                                       '".$pass_aller_res."',
                                                       '".$pass_retour_res."',
                                                       '".$kmsD."',
                                                       '".$kmsA."',
                                                       '".$niv_essence_depart."',
                                                       '".$niv_essence_arrivee."',
                                                       '".addslashes($remarques)."',
                                                       '".$pass_aller_nonres."',
                                                       '".$pass_retour_nonres."',
                                                       '".$montantA."',
                                                       '".$montantR."',
                                                       '".$essence."',
                                                       '".$consoMoyenne."',
                                                       '".$lavext."',
                                                       '".$lavint."',
                                                       '".$unites."',
                                                       '".addslashes($depot)."',
    null,null,null,null,null)";

    mysql_query($request) or die (mysql_error());
    $up = "update aeroport_gestion_planning set estComment = 1 WHERE id_com = ".$idcm;
     mysql_query($up) or die (mysql_error());

     ?>
        <script type="text/javascript">
		<!--
		window.location.replace("index2.php?p=1");
		-->
        </script>

     <?php
}
//sinon c'est un update � faire
else{
    $request = "UPDATE aeroport_recap_trajet set
    `idcm`= '".$idcm."',
    `id_conducteur`= '".$id_conducteur."',
    `id_vehicule`= '".$id_vehicule."',
    `date`= '".$idcm."',
    `heureD_str`= '".$heureD_str."',
    `heureA_aero`= '".$heureA_aero."',
    `heureD_aero`= '".$heureD_aero."',
    `heureA_str`= '".$heureA_str."',
    `nb_grp_aller`= '".$nb_grp_aller."',
    `nb_grp_retour`= '".$nb_grp_retour."',
    `pass_aller_res`= '".$pass_aller_res."',
    `pass_retour_res`= '".$pass_retour_res."',
    `kmsD`= '".$kmsD."',
    `kmsA`= '".$kmsA."',
    `niv_essence_depart`= '".$niv_essence_depart."',
    `niv_essence_arrivee`= '".$niv_essence_arrivee."',
    `remarques`= '".addslashes($remarques)."',
    `pass_aller_nonres`= '".$pass_aller_nonres."',
    `pass_retour_nonres`= '".$pass_retour_nonres."',
    `montantA`= '".$montantA."',
    `montantR`= '".$montantR."',
    `essence`= '".$essence."',
    `consommationMoyenne`='".$consoMoyenne."',
    `lavext`= '".$lavext."',
    `lavint`= '".$lavint."',
    `unites`= '".$unites."',
    `depot`= '".addslashes($depot)."'
    WHERE id_recap = '".$_POST['id_recap']."'";

     mysql_query($request) or die (mysql_error());

      ?>
        <script type="text/javascript">
		<!--
		window.location.replace("index.php?p=13&idV=<?php echo $id_vehicule;?>");
		-->
        </script>

     <?php
}
?>
