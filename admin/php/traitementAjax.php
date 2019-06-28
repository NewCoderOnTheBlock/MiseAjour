<?php
/*@alex */



function execution($req)
{	
	
		$c = mysqli_connect('localhost', 'root', '');
		mysql_select_db('a-n');
	
	
	mysql_query("SET NAMES 'utf8'");
	mysql_query('SET CHARACTER SET utf8');
	
	$res = mysql_query($req,$c);
	$last_inserted_id = mysql_insert_id();

	mysql_close($c);
	return $res;
}


function execution2($req)
{	
	
		$c = mysqli_connect('localhost', 'root', '');
		mysql_select_db('a-n');
	}
		
	mysql_query("SET NAMES 'utf8'");
	mysql_query('SET CHARACTER SET utf8');
	
	$res = mysql_query($req,$c) or die (mysql_error());
	$last_inserted_id = mysql_insert_id();

	mysql_close($c);
	return $last_inserted_id;
}


function soustraireHeure($deb,$arr)
{
	$jourD = date("d",strtotime($deb));
	$moisD = date("m",strtotime($deb));
	$anneeD = date("Y",strtotime($deb));
	$heureD = date("H",strtotime($deb));
	$minuteD = date("i",strtotime($deb));
	
	$jourA = date("d",strtotime($arr));
	$moisA = date("m",strtotime($arr));
	$anneeA = date("Y",strtotime($arr));
	$heureA = date("H",strtotime($arr));
	$minuteA = date("i",strtotime($arr));

	$depart = mktime($heureD,$minuteD,0,$moisD,$jourD,$anneeD);
	$arrive = mktime($heureA,$minuteA,0,$moisA,$jourA,$anneeA);
	
	$tps = date('G:i',$arrive-$depart);
	$tps = str_replace(':','h',$tps);
	
	return $tps;
}

function additionnerHeure($deb,$arr)
{
	$tabDeb = explode('h',$deb);
	$tabArr = explode('h',$arr);
	
	$d = mktime($tabDeb[0],$tabDeb[1],0,0,0,0);
	$a = mktime($tabArr[0]+1,$tabArr[1],0,0,0,0);
	
	$tps = date('G:i',$d+$a);
	$tps = str_replace(':','h',$tps);
	
	return $tps;
}

function additionnerJourHeure($deb,$arr)
{
	$tabDeb = explode('h',$deb);
	$tabArr = explode('h',$arr);
	
	$d = mktime($tabDeb[0],$tabDeb[1],0,0,0,0);
	$a = mktime($tabArr[0]+1,$tabArr[1],0,0,0,0);
	
	$tps = date('G:i',$d+$a);
	$tps = str_replace(':','h',$tps);
	
	return $tps;
}

if(isset($_POST['action']))
{
	$action = $_POST['action'];
	if($action=="ajoutVehicule")
	{
		$type = $_POST['type'];
		$capacite = $_POST['capacite'];
		
		$sql = 'insert into aeroport_vehicule values("","'.$type.'","'.$capacite.'")';
		return execution($sql);
	}
	
	if($action=='ajoutConducteur')
	{
		$type = 'conducteur';
		$nom = $_POST['nom'];
		$prenom = $_POST['prenom'];
		$adresse = $_POST['adresse'];
		$cp = $_POST['cp'];
		$ville = $_POST['ville'];
		$mail = $_POST['mail'];
		$fixe = $_POST['fixe'];
		$portable = $_POST['portable'];
		$pass = 'alsacenavette'.date('Y');
		$md5Pass = md5($pass);
		
		$req1 = " INSERT INTO `agenda_utilisateur` (
			`util_id` ,
			`util_nom` ,
			`util_prenom` ,
			`util_login` ,
			`util_passwd` ,
			`util_interface` ,
			`util_debut_journee` ,
			`util_fin_journee` ,
			`util_telephone_vf` ,
			`util_planning` ,
			`util_partage_planning` ,
			`util_email` ,
			`util_autorise_affect` ,
			`util_alert_affect` ,
			`util_precision_planning` ,
			`util_semaine_type` ,
			`util_duree_note` ,
			`util_rappel_delai` ,
			`util_rappel_type` ,
			`util_rappel_email` ,
			`util_format_nom` ,
			`util_menu_dispo` ,
			`util_url_export` ,
			`util_note_barree` ,
			`util_rappel_anniv` ,
			`util_rappel_anniv_coeff` ,
			`util_rappel_anniv_email` ,
			`util_langue` ,
			`util_timezone` ,
			`util_timezone_partage` ,
			`util_format_heure` ,
			`util_fcke` ,
			`util_fcke_toolbar`
			)
			VALUES (
			'', '".$nom."', '".$prenom."', '".strtolower($prenom)."', '".$md5pass."', 'Grise', '0.00', '23.50', 'O', '2', '0', '".$mail."', '0', 'N', '1', '1111111', '1', '0', '1', '0', '0', '8', '94ba2b3c4196860d410c82c9a5dd0bd1', 'O', '0', '1440', '0', 'fr', 'Europe/Paris', 'O', '24', 'N', 'Intermed'
			) ";
			
		
		$bon_last_inserted_id = execution2($req1);  

		
		 $req3 =  "INSERT INTO `chauffeur` (
		`idchauffeur` ,
		`nom` ,
		`prenom` ,
		`adresse` ,
		`cp` ,
		`ville` ,
		`mail` ,
		`telephone` ,
		`portable` ,
		`mdp`
		)
		VALUES (
		'', '".$nom."', '".$prenom."', '".$adresse."', '".$cp."', '".$ville."', '".$mail."', '".$fixe."', '".$portable."', '".$pass."'
		) ";
		
		echo execution($req3) or die (mysql_error());  

		$req2 =  "INSERT INTO `agenda_droit` (
		`droit_util_id` ,
		`droit_profils` ,
		`droit_agendas` ,
		`droit_notes` ,
		`droit_aff` ,
		`droit_admin`
		)
		VALUES (
		" . $bon_last_inserted_id . ", '20', '20', '0', '000', 'N'
		) ";

		echo execution($req2) or die (mysql_error());  
	}
	
	if($action=="supprimerConducteur")
	{
		$idConducteur = $_POST['id'];
		
		$req = "INSERT INTO aeroport_conducteurs_exclus VALUE ('".$idConducteur."')";
		echo execution($req);
		
		$updateAgenda = "UPDATE agenda_utilisateur set util_passwd = 'abcd', util_login = '".$idConducteur."' WHERE util_id = '".$idConducteur."'";
		echo execution($updateAgenda);
		
		$delete_droit = "DELETE FROM agenda_droit WHERE droit_util_id = " . $idConducteur;
		echo execution($delete_droit);
	}
	
	if($action=='ajoutAdmin')
	{
		$nom = $_POST['nom'];
		$prenom = $_POST['prenom'];
		$identifiant = $_POST['identifiant'];

		 $req1 = "INSERT INTO `agenda_utilisateur` (
		`util_id` ,
		`util_nom` ,
		`util_prenom` ,
		`util_login` ,
		`util_passwd` ,
		`util_interface` ,
		`util_debut_journee` ,
		`util_fin_journee` ,
		`util_telephone_vf` ,
		`util_planning` ,
		`util_partage_planning` ,
		`util_email` ,
		`util_autorise_affect` ,
		`util_alert_affect` ,
		`util_precision_planning` ,
		`util_semaine_type` ,
		`util_duree_note` ,
		`util_rappel_delai` ,
		`util_rappel_type` ,
		`util_rappel_email` ,
		`util_format_nom` ,
		`util_menu_dispo` ,
		`util_url_export` ,
		`util_note_barree` ,
		`util_rappel_anniv` ,
		`util_rappel_anniv_coeff` ,
		`util_rappel_anniv_email` ,
		`util_langue` ,
		`util_timezone` ,
		`util_timezone_partage` ,
		`util_format_heure` ,
		`util_fcke` ,
		`util_fcke_toolbar`
		)
		VALUES (
		'', '".$nom."', '".$prenom."', '".$identifiant."', 'ae12f555494c299128b0a75312a68e03', 'Grise', '0.00', '23.50', 'O', '6', '0', '', '0', 'N', '1', '1111111', '1', '0', '1', '0', '0', '8', '343cc504faf7d5cafcea8f97e4e8f8d1', 'O', '0', '1440', '0', 'fr', 'Europe/Paris', 'O', '24', 'N', 'Intermed'
		) ";
		
		echo execution($req1) or die (mysql_error());  
		
		$req4 = " INSERT INTO `zzprofile` (
		`iduser` ,
		`log` ,
		`pass` ,
		`nom` ,
		`prenom`
		)
		VALUES (
		'".mysql_insert_id()."', '".$identifiant."', 'ruekuhn', '".$nom."', '".$prenom."'
		) ";
		echo execution($req4) or die (mysql_error());  
		
		
		
		 $req2 = "INSERT INTO `agenda_droit` (
		`droit_util_id` ,
		`droit_profils` ,
		`droit_agendas` ,
		`droit_notes` ,
		`droit_aff` ,
		`droit_admin`
		)
		VALUES (
		'".mysql_insert_id()."', '20', '20', '0', '000', 'O'
		) ";
		
		echo execution($req2) or die (mysql_error());  
		
		
		
		 $req3 ="INSERT INTO `agenda_admin` (
		`admin_id` ,
		`admin_login` ,
		`admin_passwd`
		)
		VALUES (
		'', '".$identifiant."', 'ae12f555494c299128b0a75312a68e03'
		) ";
		
		echo execution($req3) or die (mysql_error()); 
		
	}
	
	if($action=="supprimerAdmin")
	{
		$idBureau = $_POST['id'];
		//
		$updateAgenda = "UPDATE agenda_utilisateur set util_passwd = 'abcdefg', util_login = '".$idBureau."' WHERE util_id = '".$idBureau."'";
		
		$req = "INSERT INTO aeroport_administratifs_exclus VALUE ('".$idBureau."')";
		execution($req);
		
		$updateAgenda = "UPDATE agenda_utilisateur set util_passwd = 'abcd', util_login = '".$idBureau."' WHERE util_id = '".$idBureau."'";
		execution($updateAgenda);
		
		$delete_droit = "DELETE FROM agenda_droit WHERE droit_util_id = " . $idBureau;
		execution($delete_droit);
	}
	
	if($action=='statConducteur')
	{
		$id_chauffeur=$_POST['id'];
		// on recherche les trajets du conducteur selectionné
		$req = "SELECT * FROM aeroport_recap_trajet WHERE id_conducteur = '".$id_chauffeur."' order by date";
		$result = execution($req) or die (mysql_error());
		$nb = mysql_num_rows($result);
		if($nb>0)		// s'il y a + d'un résultat
		{
			// on créé le début du tableaur
			$tabTrajetKm = "<table style='padding:3px' frame='all' rules='all'><th>Date</th><th>Trajet</th><th>Nombre de km</th><th>Temps aller</th><th>Temps retour</th><th>Temps total</th><th>Véhicule utilisé</th>";
			while($l=mysql_fetch_array($result)) // pour tous les résultats du chauffeur
			{
				if(($l['kmsA']-$l['kmsD'])>0) // si le nombre de km est > 0
				{
					// on recuperer les infos du planing pour avoir l'id du trajet
					$sql = 'select * from aeroport_gestion_planning where id_com='.$l['idcm'];
					$resGestPlan = execution($sql);
					while($lGestPlan = mysql_fetch_array($resGestPlan)) // pour tous les trajets
					{
						// on recupere les dates, lieu de départ, lieu de destination
						$sqlTrajet = 'select day(date) as jour,month(date) as mois, year(date) as annee, id_lieu_depart, id_lieu_dest from aeroport_trajet where id_trajet='.$lGestPlan['id_trajet'];
						$resTrajet = execution($sqlTrajet);
						while($lTrajet = mysql_fetch_array($resTrajet)) // pour tous les trajets
						{
							// on recupere le nom du lieu de départ
							$sqlDepart = 'select nom from aeroport_lieu where id_lieu='.$lTrajet['id_lieu_depart'];
							$resDepart = mysql_fetch_array(execution($sqlDepart));
							// on recupere le nom du lieu de destination
							$sqlDest = 'select nom from aeroport_lieu where id_lieu='.$lTrajet['id_lieu_dest'];
							$resDest = mysql_fetch_array(execution($sqlDest));
							
							// on récupère le nombre de km
							$km = $l['kmsA']-$l['kmsD'];
							
							// on calcule le temps pris à l'aller
							$aller = soustraireHeure($l['heureD_str'],$l['heureA_aero']);
							// on calcule le temps pris au retour
							$retour = soustraireHeure($l['heureD_aero'],$l['heureA_str']);
							// on calcule le temps total
							$total = additionnerHeure($aller,$retour);
							
							// on recherche le véhicule
							$sqlVehicule = "select libelle from aeroport_vehicule where id_vehicule=".$l['id_vehicule'];
							$resVehicule = mysql_fetch_array(execution($sqlVehicule));
							
							// on ajoute les lignes au tableau
							$tabTrajetKm .= "<tr style='vertical-align:middle'><td style='padding:3px;vertical-align:middle'>".$lTrajet['jour']."/".$lTrajet['mois']."/".$lTrajet['annee']."</td><td style='padding:3px'>".$resDepart['nom']." <img src='./images/fleche.png' width='15' /> ".$resDest['nom']."</td><td style='padding:3px'>".$km." km</td><td>".$aller."</td><td>".$retour."</td><td>".$total."</td><td>".$resVehicule['libelle']."</td></tr>";
						}
					}
				}
			}
		}
		else // s'il n'y a pas de résultat, on affiche un message
		{
			$tabTrajetKm = "<img src='./images/attention.png' width='100' /><br /><br /><b>Pas de trajet enregistré.</b>";	
		}
		echo $tabTrajetKm;
	}
	
	// Compte rendu conducteur
	if($action=="validerCompteRendu")
	{
		$idcm = $_POST['idcm'];
		$conducteur = $_POST['conducteur'];
		$vehicule = $_POST['vehicule'];
		
		$d = $_POST['date'];
		$tabDate = explode('-',$d);
		$date = $tabDate[2]."-".$tabDate[1]."-".$tabDate[0];
		
		// aller
		$mp_a = $_POST['montantPaye_a'];
		$pasR_a = $_POST['passagerReserve_a'];
		$pasNR_a = $_POST['passagerNonReserve_a'];
		$nbGp_a = $_POST['nbGroupe_a'];
		$pasDom_a = $_POST['passagerDomicile_a'];
		$pasRdv_a = $_POST['passagerRdv_a'];
		
		// retour
		$mp_r = $_POST['montantPaye_r'];
		$pasR_r = $_POST['passagerReserve_r'];
		$pasNR_r = $_POST['passagerNonReserve_r'];
		$nbGp_r = $_POST['nbGroupe_r'];
		$pasDom_r = $_POST['passagerDomicile_r'];
		$pasRdv_r = $_POST['passagerRdv_r'];
		
		// horaire
		if($_POST['hdDepart_a']=="1")
		{
			$heureD_a = $_POST['heureDepart_a'].":".$_POST['minuteDepart_a'].":00";
			$heureA_a = $_POST['heureArrive_a'].":".$_POST['minuteArrive_a'].":00";
		}
		else if($_POST['hdDepart']=="3")
		{
			$heureD_a = "00:00:00";
			$heureA_a = $_POST['heureArrive_a'].":".$_POST['minuteArrive_a'].":00";
		}
		else
		{
			$heureD_a = "00:00:00";
			$heureA_a = "00:00:00";
		}
		
		if($_POST['hdDepart_r']=="2")
		{
			$heureD_r = "00:00:00";
			$heureA_r = "00:00:00";
		}
		else
		{
			$heureD_r = $_POST['heureDepart_r'].":".$_POST['minuteDepart_r'].":00";
			$heureA_r = $_POST['heureArrive_r'].":".$_POST['minuteArrive_r'].":00";
		}
		
		// reste
		$kmDep = $_POST['nbKmDepart'];
		$kmArr = $_POST['nbKmArrive'];
		$nvCarDep = $_POST['nvCarburantDepart'];
		$nvCarArr = $_POST['nvCarburantArrive'];
		$essAch = $_POST['essenceAchete'];
		$consoMoy = $_POST['consoMoyenne'];
		$lavExt = $_POST['lavageExt'];
		$lavInt = $_POST['lavageInt'];
		$nbUnite = $_POST['nbUnite'];
		$lieuDepot = $_POST['lieuDepot'];
		$raisonRetard = $_POST['raisonRetard'];
		$remarque = $_POST['remarque'];
		
		$req = "insert into aeroport_recap_trajet values('','".$idcm."','".$conducteur."','".$vehicule."','".$date."','".$heureD_a."','".$heureA_a."','".$heureD_r."','".$heureA_r."','".$nbGp_a."','".$nbGp_r."','".$pasR_a."','".$pasR_r."','".$kmDep."','".$kmArr."','".$nvCarDep."','".$nvCarArr."','".$remarque."','".$pasNR_a."','".$pasNR_r."','".$mp_a."','".$mp_r."','".$essAch."','".$consoMoy."','".$lavExt."','".$lavInt."','".$nbUnite."','".$lieuDepot."',null,null,null,null,null,'".$pasDom_a."','".$pasRdv_a."','".$pasDom_r."','".$pasRdv_r."')";
		echo execution($req);
	}
	
	if($action=='rechercheClient')
	{
		$rech = $_POST['critere'];	
		$sql = 'select * from aeroport_client';
		$res = execution($sql);

		$nb=0;
		
		
		$tab = "<table rules='all' frame='all' style='margin-top:20px; text-align:center;width:1600px;margin-left:20px;margin-right:20px'><th>Id</th><th>Civilité</th><th>Nom</th><th>Prénom</th><th>Adresse</th><th>Code postal</th><th>Ville</th><th>Email</th><th>Téléphone fixe</th><th>Téléphone portable</th><th>Modifier</th><th>Supprimer</th>";
		while($r=mysql_fetch_array($res))
		{
			if(eregi($rech,$r['recap_recherche']))
			{
				$nb++;
				$tab .= "<tr id='".$r['id_client']."'><td>".$r['id_client']."</td><td>".$r['civilite']."</td><td>".$r['nom']."</td><td>".$r['prenom']."</td><td>".$r['adresse']."</td><td>".$r['code_postal']."</td><td>".$r['ville']."</td><td>".$r['mail']."</td><td>".$r['tel_fixe']."</td><td>".$r['tel_port']."</td><td><img src='./images/modifier.png' alt='modifier' onclick='modifClient(".$r['id_client'].")' style='cursor:pointer' /></td><td><img src='./images/croix.png' alt='supprimer' width='21' onclick='supprimerClient(".$r['id_client'].")' style='cursor:pointer;' /></td></tr>";
			}
		}
		$tab.="</table>";
		echo "<br />Nombre de résultats : ".$nb."<br />".$tab;
	}
	
	if($action=='modifClient')
	{

		$id = $_POST['id'];
		$nom = $_POST['nom'];
		$prenom = $_POST['prenom'];
		$adresse = $_POST['adresse'];
		$cp = $_POST['cp'];
		$ville = $_POST['ville'];
		$mail = $_POST['mail'];
		$fixe = $_POST['fixe'];
		$port = $_POST['port'];
		$indFixe = $_POST['indFixe'];
		$indPort = $_POST['indPort'];
		
		$sql = 'select * from aeroport_pays where id_pays=(select id_pays from aeroport_client where id_client='.$id.')';
		$res = execution($sql);
		$l = mysql_fetch_array($res);

		$txt = $l['nom_pays']." ".$nom." ".$prenom." ".str_replace("'","`",$adresse)." ".$cp." ".str_replace("'","`",$ville)." ".$mail;
		
		$sql='update aeroport_client set nom="'.$nom.'",prenom="'.$prenom.'",adresse="'.str_replace("'","`",$adresse).'",code_postal="'.$cp.'",ville="'.str_replace("'","`",$ville).'",mail="'.$mail.'",tel_fixe="'.$fixe.'",tel_port="'.$port.'",ind_fixe="'.$indFixe.'",ind_port="'.$indPort.'",recap_recherche="'.$txt.'" where id_client='.$id;
		echo execution($sql);
		
	}
	
	if($action=='supprimerClient')
	{
		$id = $_POST['id'];
		$sql = "delete from aeroport_client where id_client=".$id;
		execution($sql);
	}
	
	if($action=='recupInfoModifTarif')
	{
		$id = $_POST['id'];
		$sql = 'select * from aeroport_lieu where id_lieu='.$id;
		$res = execution($sql);
		$l = mysql_fetch_array($res);
		
		echo mysql_real_escape_string($l['id_lieu']).'|||'.$l['prix_forfait'].'|||'.$l['nb_personne'];
	}
	
	if($action=='modifTarif')
	{
		$id = $_POST['id'];
		$forfait_minimum = $_POST['forfait_minimum'];
		$nombre_personne = $_POST['nombre_personne'];
		
		$sql = 'update aeroport_lieu set prix_forfait="'.$forfait_minimum.'",nb_personne="'.$nombre_personne.'" where id_lieu='.$id;
		$res = execution($sql);
	}
	
	if($action=='supprimerTarif')
	{
		$id = $_POST['id'];
		$sql = "delete from aeroport_lieu where id_lieu=".$id;
		execution($sql);
	}
	
	if($action=='confirmationModifHoraire')
	{
		$ancienStg = $_POST['ancienStg'];
		$ancienAero = $_POST['ancienAero'];
		
		$nom = $_POST['nom'];
		$depHeureStrasbourg = $_POST['depHeureStrasbourg'];
		$depMinuteStrasbourg = $_POST['depMinuteStrasbourg'];
		$hStg = $depHeureStrasbourg.":".$depMinuteStrasbourg.":00";
		$depHeureAero = $_POST['depHeureAero'];
		$depMinuteAero = $_POST['depMinuteAero'];
		$hAero = $depHeureAero.":".$depMinuteAero.":00";
		$type = $_POST['type'];
		
		$req = 'select id_lieu from aeroport_lieu where nom="'.$nom.'"';
		$res = execution($req);
		$r = mysql_fetch_array($res);
		
		$sql = 'update aeroport_fixe set type_horaire="'.$type.'",depart="'.$hStg.'",retour="'.$hAero.'" where depart="'.$ancienStg.'" and retour="'.$ancienAero.'" and id_lieu="'.$r['id_lieu'].'"';
		$res = execution($sql);
	}
	
	if($action=='ajoutHoraire')
	{
		$dest = $_POST['dest'];

		$hd = $_POST['hd'];
		$md = $_POST['md'];
		$sd = $_POST['sd'];
		
		$ha = $_POST['ha'];
		$ma = $_POST['ma'];
		$sa = $_POST['sa'];
		
		$type = $_POST['type'];
		
		$hdepart = $hd.":".$md.":".$sd;
		$harrive = $ha.":".$ma.":".$sa;
		
		$sql = 'insert into aeroport_fixe (id_lieu,id_dest,depart,retour,corr_depart,corr_retour, type_horaire) 
				values ("'.$dest.'","1","'.$hdepart.'","'.$harrive.'","1","1", "'.$type.'")';
		$res = execution($sql);
	}
			
			
	if($action=='statVehicule')
	{
		$id_vehicule=$_POST['id'];
		// on recherche les trajets du conducteur selectionné
		$req = "SELECT day(date) as jour, month(date) as mois, year(date) as annee, kmsD, kmsA, id_conducteur FROM aeroport_recap_trajet WHERE id_vehicule = '".$id_vehicule."' and date!='0000-00-00 00:00:00' order by date";
		$result = execution($req) or die (mysql_error());
		$nb = mysql_num_rows($result);
		$tab = "<table style='padding:3px;width:800px;' frame='all' rules='all'><th>Date</th><th>Conducteur</th><th>km départ</th><th>km arrivée</th>";
		while($l = mysql_fetch_array($result))
		{
			$sql2 = "select nom, prenom from chauffeur where idchauffeur=".$l['id_conducteur'];
			$res2 = execution($sql2);
			$l2 = mysql_fetch_array($res2);
			$tab.="<tr><td>".$l['jour']."/".$l['mois']."/".$l['annee']."</td><td>".strtoupper($l2['nom'])." ".$l2['prenom']."</td><td>".$l['kmsD']."</td><td>".$l['kmsA']."</td></tr>";
		}
		$tab.="</table>";
		echo $tab;
	}
	
	if($action=="suppressionHoraire")
	{
		$id = $_POST['id'];
		$dep = $_POST['dep'];
		$ret = $_POST['ret'];
		
		$sql = 'delete from aeroport_fixe where id_lieu="'.$id.'" and depart="'.$dep.'" and retour="'.$ret.'"';
		$res = execution($sql);
	}
}
?>
