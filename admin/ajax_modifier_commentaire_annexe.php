<?php

include_once("verifAuth.php");
include_once("../includes/fonctions.php");
include_once("../libs/db.php");

include('connection.php');

if(!empty($_POST['id']) && isset($_POST['valeur'])){

	mysql_query("UPDATE europa_reservation SET commentaire = '" . $_POST['valeur'] . "' WHERE id_reservation = " . $_POST['id']);

}

?>