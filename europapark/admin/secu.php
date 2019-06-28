<?php

session_start();

$login = $_POST['log'];
$pass = $_POST['pass'];
include("connection.php");
//Préparation de la requête
$query = "SELECT * FROM zzprofile WHERE log = '$login' AND pass = '$pass' AND iduser not in (SELECT iduser from aeroport_administratifs_exclus)";

//exécution de la requête et récupération du nombre de résultats
$result = mysql_query($query)or die($query);
$affected_rows = mysql_num_rows($result);

//S'il y a exactement un résultat, l'utilisateur est authentifié, sinon, on l'empêche d'entrer

if($affected_rows == 1) 
{
	$r = @mysql_fetch_assoc($result);
	$id = $r['iduser'];
	
	
	//On ajoute l'utilisateur aux variables de session
	
	$_SESSION['user'] = $login;
	$_SESSION['user_id'] = $id;
    $_SESSION['user_type'] = "a";
	?>
	<script type="text/javascript">
	<!--
	window.location.replace("index.php?p=1&action=1");
	-->
	</script>
	<?php
}

else {
	$msg = urlencode("Utilisateur inconnu !");

	header("Location: index.php?msg_error=".$msg);
}
?>
