<?php

	session_start();
	
	$id_client = $_POST['id_c'];
	$id_reserv = $_POST['id_r'];
	
	if(!$_SESSION['logger'] || empty($id_client) || empty($id_reserv) || $_SESSION['client']['id_client'] != $id_client)
	{
		header('Location: trajet.html');
		exit();
	}
	
	require_once('../includes/tpl_base.php');
	
	// On récupère les infos sur la/les lignes_resa pour savoir s'il faut procéder à un remboursement
	$a_rembourser = 0;
	
	$info_lignes = query("	SELECT 	UNIX_TIMESTAMP(t.date) as timestamp_date,
									SUM(l.prix) as somme_prix
							FROM 	aeroport_ligne_resa l,
									aeroport_trajet t
							WHERE l.id_res = '" . $id_reserv . "'
							AND t.id_trajet = l.id_trajet
							AND l.est_paye = 1
						");
	
	$row_ligne = $info_lignes->fetch();
	
	// On calcul la différence entre les deux dates	(En heure, d'où le 3600)
	$timestamp_trajet = $row_ligne['timestamp_date'];
	$timestamp_actuel = date('U');
	$timestamp_difference = ($timestamp_trajet - $timestamp_actuel)/3600;
	
	// Calcul du prix initial
	$prix_initial = $row_ligne['somme_prix'] / (1+intval(get_option("maj_annulation"))/100);
	
	// On calcul à combien le remboursement doit se faire
	if ($timestamp_difference < 12){
		
		$a_rembourser = $prix_initial * 0.2;
		
	}elseif ($timestamp_difference < 12){
		
		$a_rembourser = $prix_initial * 0.6;
		
	}else{
		
		$a_rembourser = $prix_initial;
		
	}
	
	// On met à jour le trajet ALLER
	write("	UPDATE aeroport_ligne_resa 
			SET est_annule = '1',
				nb_pers = '0',
				nb_enfant = '0',
				remboursement = '".$a_rembourser."'
			WHERE id_res = ".$id_reserv."
			AND type_trajet = 'ALLER'");
			
	// On met à jour le trajet RETOUR
	write("	UPDATE aeroport_ligne_resa 
			SET est_annule = '1',
				nb_pers = '0',
				nb_enfant = '0'
			WHERE id_res = ".$id_reserv."
			AND type_trajet = 'RETOUR'");
	
	/*			
		On met à jour l'agenda	
		/!\ Dirty Code !
		Code copié d'un autre stagiaire 
			-> C'est sale
	*/
	include("../../admin/connection.php");
	
	$info_lignes = query("	SELECT 	id_trajet
							FROM 	aeroport_ligne_resa
							WHERE id_res = '" . $id_reserv . "'
							AND est_paye = 1
						");
	
	while($row_ligne = $info_lignes->fetch()){
	
		$numTrajet = $row_ligne["id_trajet"];
	
		$info_trajet = mysql_query("SELECT DATE_FORMAT(date, '%d/%m/%Y à %Hh%i') as date, id_lieu_depart, id_lieu_dest, id_chauffeur, id_vehicule FROM aeroport_trajet WHERE id_trajet = '" . $numTrajet . "'") or die(mysql_error());
		$row_trajet = mysql_fetch_assoc($info_trajet);

		$depart = mysql_query("SELECT nom FROM aeroport_lieu WHERE id_lieu = '" . $row_trajet['id_lieu_depart'] . "'") or die(mysql_error());
		$row_depart = mysql_fetch_assoc($depart);

		$retour = mysql_query("SELECT nom FROM aeroport_lieu WHERE id_lieu = '" . $row_trajet['id_lieu_dest'] . "'") or die(mysql_error());
		$row_retour = mysql_fetch_assoc($retour);

		$chauffeur = mysql_query("SELECT prenom, mail FROM chauffeur WHERE idchauffeur = '" . $row_trajet['id_chauffeur'] . "'") or die(mysql_error());
		$row_chauff = mysql_fetch_assoc($chauffeur);
		
		$chauffeur = mysql_query("SELECT prenom, mail FROM chauffeur WHERE idchauffeur = '" . $row_trajet['id_chauffeur'] . "'") or die(mysql_error());
		$row_chauff = mysql_fetch_assoc($chauffeur);
		
		$idChauffeur = $row_trajet['id_chauffeur'];
		$idVehicule = $row_trajet['id_vehicule'];

		//selection des infos du trajet
		$query7= "SELECT id_lieu_depart, id_lieu_dest, id_vehicule, DATE_FORMAT(date, '%Y-%m-%d') as dateDep, DATE_FORMAT(date, '%d/%m/%Y') as dateDep2, DATE_FORMAT(date, '%H') as heureDep, DATE_FORMAT(date, '%i') as minutesDep FROM aeroport_trajet where id_trajet = '$numTrajet'";


		$result7 = mysql_query($query7) or die ($query7);
		while ($r7 = @mysql_fetch_assoc($result7)){
			$id_depart = $r7["id_lieu_depart"];
			$id_dest = $r7["id_lieu_dest"];
			$dateDep = $r7["dateDep"];
			$dateDep2 = $r7["dateDep2"];
			$heureDep = $r7["heureDep"];
			$minutesDep = $r7["minutesDep"];
		}

		//selection des infos vehicule
		$query69 = "SELECT * FROM aeroport_vehicule WHERE id_vehicule = ".$idVehicule;

		$result69 = mysql_query($query69) or die ($query69);
		$r69 = @mysql_fetch_assoc($result69);
		$libelle_vehicule = $r69["libelle"];
			
		//selection du nom de départ et arrivée
		$query6 = "SELECT l.nom as nom, l.duree as duree FROM aeroport_lieu l WHERE l.id_lieu = ".$id_depart;

		$result6 = mysql_query($query6) or die ($query6);
		while ($r6 = @mysql_fetch_assoc($result6)){
			$nom_depart = $r6["nom"];
			$duree = $r6["duree"];
		}
	
		//requête de récupération du lieu d'arrivé
		$query7 = "SELECT l.nom as nom, l.duree as duree FROM aeroport_lieu l WHERE l.id_lieu = ".$id_dest;

		$result7 = mysql_query($query7) or die (mysql_error());
		while ($r7 = @mysql_fetch_assoc($result7)){
			$nom_dest = $r7["nom"];
			if($duree==0){$duree = $r7["duree"];}
		}
		
		$id = "";
		$mere_id = 0;
		$util_id = $_SESSION['user_id'];
		$aty_id = 2;
		$date = $dateDep  ;
		$plage = 1;
		$plage_duree = 1;

		$nb_pers_total = 0;


$detail = "
Voiture : ".$libelle_vehicule."

PRENDRE
";

		$query3 = "SELECT *, DATE_FORMAT(heure, '%H') as heureDep, DATE_FORMAT(heure, '%Hh%i') as tpsDep, DATE_FORMAT(heure, '%i') as minutesDep from aeroport_ligne_resa WHERE id_trajet = '$numTrajet' ORDER BY heure";
		$result3 = mysql_query($query3)or die(mysql_error());
		$ok=true;
		
		while ($r3 = @mysql_fetch_assoc($result3)){
			$id_res = $r3["id_res"];
			$id_ligne = $r3["id_ligne"];
			$a_ete_mail = $r3["a_ete_mail"];
			$id_trajet = $r3["id_trajet"];
			$id_pt_rass = $r3["id_pt_rass"];
			$tpsDep = $r3["tpsDep"];
			$com = addslashes($r3["comm_bis"]);
			
			//lieu de rassemblement, soit adresse si personnalisé, soit pt rassemblement
			if($id_pt_rass == 4){
				$rassemblement = $r3["rassemblement"];		
			}
			else{
				$query5 = "SELECT fr from aeroport_rassemblement WHERE id_pt = '$id_pt_rass'";
				$result5 = mysql_query($query5)or die(mysql_error());
				$r5 = @mysql_fetch_assoc($result5);
				$rassemblement = $r5["fr"];
			}
			$info_vol =$r3["info_vol"];
			$nb_pers = $r3["nb_pers"];
			$nb_enfant = $r3["nb_enfant"];
			$heure = $r3["heure"];
			
			$rassemblement = addslashes($rassemblement);
			
				$query4 = "SELECT cli.civilite as civ, " .
						"cli.nom as nom, " .
						"cli.prenom as prenom, " .
						"cli.mail as mail, " .
						"cli.tel_port as telport, " .
						"cli.tel_fixe as telfixe, " .
						"(SELECT aeroport_pays.identifiant_tel
						FROM aeroport_pays, aeroport_client
						WHERE aeroport_pays.id_pays = aeroport_client.ind_fixe
						AND aeroport_client.id_client = resa.id_client
						) AS indfixe, " .
						"(SELECT aeroport_pays.identifiant_tel
						FROM aeroport_pays, aeroport_client
						WHERE aeroport_pays.id_pays = aeroport_client.ind_port
						AND aeroport_client.id_client = resa.id_client
						) AS indport " .	
						"from aeroport_client cli, aeroport_reservation resa WHERE resa.id_res = '".$id_res."' AND resa.id_client = cli.id_client";
			
			$result4 = mysql_query($query4)or die(mysql_error());
			
			$r4 = @mysql_fetch_assoc($result4);
			
			$civilite = $r4["civ"];
			$nom = addslashes($r4["nom"]);
			$prenom =addslashes($r4["prenom"]);
			$mail = $r4["mail"];
			$telport = $r4["telport"];
			$telfixe = $r4["telfixe"];
		
			$indfixe = $r4["indfixe"]; 
			$indport = $r4["indport"];        
			
			$nb_pers_total += ($nb_pers+$nb_enfant);
	
	
$detail.="
- ".$civilite." ".stripslashes($nom)." ".stripslashes($prenom)." (".$nb_pers." adulte(s) + ".$nb_enfant." enfant(s) ), ".stripslashes($rassemblement).", ".$heure."
port: "."(".$indport.")".$telport." - fixe: "."(".$indfixe.")" .$telfixe."
courriel : ".$mail."
".$info_vol."
";
if($com!=""){$detail.="	( ".stripslashes($com)." )";}

		}
		
		$detail = addslashes($detail);

		if(date("I", mktime($dateSec)) == 0 ){//si on est en heure d'hiver, on fait -1 pour passer en UTC (format d'heure Phenix), sinon on fait -2
			$heureDep2 = $heureDep - 1;
			$minutesDep2 = $minutesDep /0.6;
			$heure_debut =$heureDep2.".".$minutesDep2  ; 
			$heureDuree=intval(abs($duree/3600)); 
			$minutesDuree=(abs($duree/3600)-intval(abs($duree/3600)))*60; 
			$heuresFin = $heureDuree + $heureDep;
			$minutesFin = ($minutesDuree + $minutesDep);
			if($minutesFin >=60){
				$minutesFin = $minutesFin - 60;
				$heuresFin = heuresFin +1;
			}
			if($heuresFin <25){ 
				$heuresFin = $heuresFin-1;
				$minutesFin = $minutesFin / 0.6;
				$heure_fin = $heuresFin.".".$minutesFin ;
			}
			else{
				$heure_fin = "00.00";
			}
		}
		else{
			$heureDep2 = $heureDep - 2;
			$minutesDep2 = $minutesDep /0.6;
			$heure_debut =$heureDep2.".".$minutesDep2  ; 
			$heureDuree=intval(abs($duree/3600)); 
			$minutesDuree=(abs($duree/3600)-intval(abs($duree/3600)))*60; 
			$heuresFin = $heureDuree + $heureDep;
			$minutesFin = ($minutesDuree + $minutesDep);
			if($minutesFin >=60){
				$minutesFin = $minutesFin - 60;
				$heuresFin = heuresFin +1;
			}
			if($heuresFin <25){ 
				$heuresFin = $heuresFin-2;
				$minutesFin = $minutesFin / 0.6;
				$heure_fin = $heuresFin.".".$minutesFin ;
			}
			else{
				$heure_fin = "00.00";
			}
		}
		
		$rappel=1;
		$rappel_coef=1440;
		$email = 0;
		$prive = 0;
		$couleur = "orange";
		$nb_participant=1;
		$createur_id = $_SESSION['user_id'];
		$query51 = "SELECT DATE_FORMAT(now(), '%H') as heureNow, DATE_FORMAT(now(), '%i') as minutesNow, DATE_FORMAT(now(), '%Y-%m-%d') as dateNow";
				$result51 = mysql_query($query51)or die(mysql_error());
				$r51 = @mysql_fetch_assoc($result51);
				$heureNow = $r51["heureNow"]-1;
				$minutesNow = $r51["minutesNow"];
				$dateNow = $r51["dateNow"];
				
		$date_creation = $dateNow." ".$heureNow.":".$minutesNow.":00";
		$modificateur_id = $_SESSION['user_id'];
		$date_modif = "";

		$libelle = $nom_depart." - ".$nom_dest . " (" . $nb_pers_total . " personnes )";


		$reqVide = "SELECT * 
					FROM aeroport_ligne_resa 
					WHERE id_trajet = '".$numTrajet."'
					AND est_annule = '0'";
					
		$resVide = mysql_query($reqVide)or die(mysql_error());
		$numLigne = mysql_num_rows($resVide);
		
		if($numLigne !=0){
			$doitRefresh = false;
			$date_modif = $dateNow." ".$heureNow.":".$minutesNow.":00";
			$query2 = "UPDATE agenda_agenda SET age_mere_id = '$mere_id',
												age_util_id = '$util_id',
												  age_aty_id = '$aty_id',
												  age_date = '$date',
												  age_heure_debut = '$heure_debut',
												  age_heure_fin = '$heure_fin',
												  age_plage = '$plage',
												  age_plage_duree = '$plage_duree',
												  age_libelle = '$libelle',
												  age_detail = '$detail',
												  age_rappel = '$rappel',
												  age_rappel_coeff = '$rappel_coeff',
												  age_email = '$email',
												  age_prive = '$prive',
												  age_couleur = '$couleur',
												  age_nb_participant = '$nb_participant',
												  age_modificateur_id = '$modificateur_id',
												  age_date_modif = '$date_modif'
											WHERE id_trajet = '$numTrajet'";
			$result2 = mysql_query($query2)or die($query2);

		}else {
			$doitRefresh = true;
			$queryVide1 = "SELECT age_id FROM agenda_agenda WHERE id_trajet = '".$numTrajet."'";
			$resultVide1 = mysql_query($queryVide1)or die(mysql_error());
			while ($rVide1 = @mysql_fetch_assoc($resultVide1)){
				$queryVide3 = "DELETE FROM agenda_agenda_concerne WHERE aco_age_id = '".$rVide1["age_id"]."'";
				$resultVide3 = mysql_query($queryVide3)or die(mysql_error());
				
			}
			$queryVide2 = "DELETE FROM agenda_agenda WHERE id_trajet = '".$numTrajet."'";
			$resultVide2 = mysql_query($queryVide2)or die(mysql_error());
			$queryVide4 = "DELETE FROM aeroport_gestion_planning WHERE id_trajet = '".$numTrajet."'";
			$resultVide4 = mysql_query($queryVide4)or die(mysql_error());
		
		}
	}
	
	
	header('Location: trajet.html');
		
?>