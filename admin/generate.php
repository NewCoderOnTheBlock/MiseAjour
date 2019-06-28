<?php 
include("connection.php");
// si le formulaire a été envoyé
if(isset($_POST['choix'])){
	include("fct.php");
	if($_POST['choix'] == "conducteur"){
		creer_csv_chauff($_POST['annee'], $_POST['periode']);
		
	}
	if($_POST['choix'] == "navette"){
		creer_csv_navette($_POST['annee'], $_POST['periode']);
	}
}