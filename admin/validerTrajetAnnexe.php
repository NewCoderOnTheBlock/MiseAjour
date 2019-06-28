<?php
/*
	KEMPF : 
	Gestion de l'ajout dans l'agenda d'une navette d'un service annexe
	+ validation de cette navette
*/
include("verifAuth.php");

$idTrajet = $_POST['id_trajet'];

include("connection.php");

function get_libelle_lieu($id){
	
	$query = '	SELECT nom_lieu
				FROM europa_lieu
				WHERE id_lieu = "'.$id.'"
			';
					
	$result = mysql_query($query) or die (mysql_error());
	
	$r = @mysql_fetch_assoc($result);
	
	$value = $r['nom_lieu'];
	
	return $value;
}

function get_indice($id){
	
	$query = '	SELECT identifiant_tel
				FROM aeroport_pays
				WHERE id_pays = "'.$id.'"
			';
					
	$result = mysql_query($query) or die (mysql_error());
	
	$r = @mysql_fetch_assoc($result);
	
	$value = $r['identifiant_tel'];
	
	return $value;
}

if (!empty($idTrajet)){
	
	$query_annexe = "	SELECT *,
							r.nb_pers as nb_pers_res,
							t.nb_pers as nb_pers_total,
							vehi.libelle as libelle_vehi,
							chau.nom as nom_chauf,
							chau.prenom as prenom_chauf,
							c.nom as nom_cli,
							c.prenom as prenom_cli,
							c.mail as mail_cli,
							DATE_FORMAT(t.date_trajet, '%w' ) as jour_trajet,
							DATE_FORMAT(t.date_trajet, '%d-%m-%Y' ) as date_trajet,
							DATE_FORMAT(t.date_trajet, '%d' ) as jour_f_trajet,
							DATE_FORMAT(t.date_trajet, '%m' ) as mois_f_trajet,
							DATE_FORMAT(t.date_trajet, '%Y' ) as annee_f_trajet,
							DATE_FORMAT(t.date_trajet, '%H.%i' ) as horaire_trajet,
							DATE_FORMAT(t.date_trajet, '%H' ) as heure_trajet,
							DATE_FORMAT(t.date_trajet, '%i' ) as minute_trajet,
							DATE_FORMAT(r.date, '%d-%m-%Y %Hh%i' ) as date_reserv,
							DATE_FORMAT(t.date_trajet, '%Y-%m-%d') as date_trajet_en
						FROM europa_reservation r,
							europa_client c,
							europa_trajet t,
							europa_ligne_reserv ligne,
							chauffeur chau,
							aeroport_vehicule vehi
						WHERE r.id_client = c.id_client
						AND ligne.code_reserv = r.id_reservation
						AND ligne.code_trajet = t.id_trajet 
						AND t.code_chauffeur = chau.idchauffeur
						AND t.code_vehicule = vehi.id_vehicule
						AND id_trajet = '".$idTrajet."'";
		
	$result_annexe = mysql_query($query_annexe) or die (mysql_error());
	$r = @mysql_fetch_assoc($result_annexe);
	
	if ($r['idchauffeur'] == 0 || $r['id_vehicule'] == 6){
		header("Location: index.php?p=1&action=1");
		exit;
	}
	
	// Affectation des variables
	$util_id = 6;
	$aty_id = 2;
	$date = $r['date_trajet_en'];
	$plage = 1;
	$plage_duree = 1;
		
	$horaire_base = $r['horaire_trajet'];
	$heure_base = intval($r['heure_trajet']);
	$minute_base = intval($r['minute_trajet']);
	
	/* Gestion de l'heure */
	/* ETE */
	if (date('I')){
		// Les minutes doivent être divisées par 0.6 pour correspondre avec phoenix (Divisées par 60/100) Exemple : 19h45 => 19.75		
		$heure_debut = ($heure_base - 2).".".($minute_base / 0.6);
		$heure_fin = ($heure_base - 1).".".($minute_base / 0.6);
		
	/* HIVER */
	}else{
		// Les minutes doivent être divisées par 0.6 pour correspondre avec phoenix (Divisées par 60/100) Exemple : 19h45 => 19.75		
		$heure_debut = ($heure_base - 1).".".($minute_base / 0.6);
		$heure_fin = ($heure_base).".".($minute_base / 0.6);
	}
	
	$id_chauffeur = $r['code_chauffeur'];
	
	$rappel=1;
	$rappel_coef=1440;
	$email = 0;
	$prive = 0;
	$couleur = "orange";
	$nb_participant=1;
	$createur_id = 6;
	$modificateur_id = 6;
	$date_creation = date("Y-m-d H:m:s");
	$date_modif = "";
	$idChauffeur = $r['idchauffeur'];
	
	if ($r['type_trajet'] == 'ALLER'){
		$libelle = "Strasbourg - ".$r['service']." (".$r['nb_pers_total']." personnes)";
	}else{
		$libelle = $r['service']." - Strasbourg (".$r['nb_pers_total']." personnes)";
	}
	
	/* Détails du trajet */
	
	$detail = "
	Voiture : ".$r['libelle_vehi']."

	PRENDRE
	";
	
	do {
		$id_lieu = intval($r['type_lieu_'.strtolower($r['type_trajet'])]);
		$rass = ($id_lieu == 4) ? " - ".$r['adresse_'.strtolower($r['type_trajet'])] : "";
		$tel_port = substr($r["tel_port"], 1);
		$tel_fixe = substr($r["tel_fixe"], 1);
		$indice_tel = get_indice($r["pays"]);
		$txt_tel_port = ($tel_port == "") ? "" : "(".$indice_tel.")".$tel_port."";
		$txt_tel_fixe = ($tel_fixe == "") ? "" : "(".$indice_tel.")".$tel_fixe."";
		
		$detail .= "
		- ".addslashes($r['nom_cli'])." ".addslashes($r['prenom_cli'])." (".$r['nb_pers_res']." personnes), ".addslashes(get_libelle_lieu($id_lieu).$rass).", ".$r['horaire_trajet']."
		port: ".$txt_tel_port." - fixe: ".$txt_tel_fixe."
		courriel : ".addslashes($r['mail_cli'])."
		";
		
	} while ($r = @mysql_fetch_assoc($result_annexe));
	

	/* On met à jour la table Trajet */
	$query = "	UPDATE europa_trajet 
				SET estValide = '1' 
				WHERE id_trajet = '$idTrajet'";
	$result = mysql_query($query)or die($query);

	/* Ajout dans l'agenda */


	$query2 = "INSERT INTO agenda_agenda (age_id,
										  age_mere_id,
										  age_util_id,
										  age_aty_id,
										  age_date,
										  age_heure_debut,
										  age_heure_fin,
										  age_plage,
										  age_plage_duree,
										  age_libelle,
										  age_detail,
										  age_rappel,
										  age_rappel_coeff,
										  age_email,
										  age_prive,
										  age_couleur,
										  age_nb_participant,
										  age_createur_id,
										  age_date_creation,
										  age_modificateur_id,
										  age_date_modif,
										  id_trajet)
									VALUES ('',
										  '0',
										  '$util_id',
										  '$aty_id',
										  '$date',
										  '$heure_debut',
										  '$heure_fin',
										  '$plage',
										  '$plage_duree',
										  '$libelle',
										  '$detail',
										  '$rappel',
										  '$rappel_coef',
										  '$email',
										  '$prive',

										  '$couleur',
										  '$nb_participant',
										  '$createur_id',
										  '$date_creation',
										  '$modificateur_id',
										  '$date_modif',
										  '$idTrajet')";
							
							
	$result2 = mysql_query($query2)or die(mysql_error());	
	$last_id = mysql_insert_id();
	$query10 = "INSERT INTO agenda_agenda_concerne (aco_age_id, aco_util_id, aco_rappel_ok, aco_termine) VALUES ('$last_id','$idChauffeur', '1', '0') ";
	$result10 = mysql_query($query10)or die(mysql_error());
	
	header("Location: index.php?p=1&action=1");
}
?>