<?php
include("verifAuth.php");
include('connection.php');

if(isset($_GET['id']))
{
    $id_lieu = $_GET['id'];
    $horaire_ete = $_POST['date_ete'];
    $horaire_hiver = $_POST['date_hiver'];
	
	if ((preg_match('#^[0-3][0-9]-[0-1][0-9]-[0-9][0-9][0-9][0-9]$#',$horaire_ete) == 1 && preg_match('#^[0-3][0-9]-[0-1][0-9]-[0-9][0-9][0-9][0-9]$#',$horaire_hiver) == 1)
		|| (empty($horaire_ete) && empty($horaire_hiver))){
		mysql_query("	UPDATE aeroport_lieu 
						SET horaire_ete = '".$horaire_ete."', horaire_hiver = '".$horaire_hiver."'
						WHERE id_lieu = ".$id_lieu);
	}
	
	header('Location: http://alsace-navette.com/admin/index.php?p=12');
}

?>
