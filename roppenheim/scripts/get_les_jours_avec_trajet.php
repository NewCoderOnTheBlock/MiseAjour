<?php
	$array_jours = "";
	
	if (isset($_POST['mois']) && isset($_POST['annee'])){
		include_once("/homepages/3/d205267944/htdocs/roppenheim/includes/connexion_bdd.php");
		include_once("/homepages/3/d205267944/htdocs/roppenheim/includes/fonctions.php");
		
		$mois = $_POST['mois'];
		$annee = $_POST['annee'];
		
		$v = $bdd->query("	SELECT DISTINCT DATE_FORMAT(date_trajet, '%d') as jour_trajet
							FROM europa_trajet
							WHERE date_trajet LIKE '".$annee."-".$mois."%'
							AND service_trajet = 'ROPPENHEIM'");
	
		while($r = $v->fetch()){
			
			$array_jours .= $r['jour_trajet']."-";
			
		}
		
		$v->closeCursor();
		
		$array_jours = substr($array_jours, 0, -1);
		
	}
	
	echo $array_jours;
	
?>