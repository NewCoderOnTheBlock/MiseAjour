<?php
	session_start();
	
	$_SESSION['trajet']['heure_depart'] = "05:00";
	
	require_once('../includes/tpl_base.php');
	
	$majoration_horaire_aller = 0;
	$majoration_horaire_retour = 0;
	$taux_maj_nuit = intval(get_option("pourc_horaire_nuit"));
	
	list($heure_nuit, $minute_nuit) = split(':', get_option("horaire_nuit_debut"));
	$heure_debut_nuit = mktime(intval($heure_nuit), intval($minute_nuit));
	
	// Calcul mktime de la fin des horaires de nuit (On ajoute 1 jour puisque c'est le lendemain)
	list($heure_nuit, $minute_nuit) = split(':', get_option("horaire_nuit_fin"));
	$heure_fin_nuit = mktime(intval($heure_nuit), intval($minute_nuit)) + (3600*24);	

	echo "Début :".$heure_debut_nuit."<br/>Fin : ".$heure_fin_nuit."<br /><br />";
	echo "Diff. :".($heure_fin_nuit-$heure_debut_nuit)." h<br /><br />";
			
	// Calcul mktime de l'heure de départ du trajet
	list($heure_nuit, $minute_nuit) = split(':', $_SESSION['trajet']['heure_depart']);
	$heure_depart_trajet = mktime(intval($heure_nuit), intval($minute_nuit));
	
	if (intval($heure_nuit) <= 8){
		$heure_depart_trajet += 3600*24;		
	}
	
	if ($heure_depart_trajet >= $heure_debut_nuit && $heure_depart_trajet <= $heure_fin_nuit){
		$majoration_horaire_aller = $taux_maj_nuit;
	}
	
	echo "Taux de majoration : ".$taux_maj_nuit;
	
	echo "<br /><br />Heure demandée : ".$_SESSION['trajet']['heure_depart']." (".$heure_depart_trajet.")";
	
	echo "<br /><br />Majoration ? ".$majoration_horaire_aller;
	
?>