<?php
	include("verifAuth.php");
?>

<?php
	// connexion à la bdd
	include("connection.php");
	$type = $_POST['type'];
	$nom = $_POST['nom'];
	$prenom = $_POST['prenom'];
	
	//Ajout KEMPF : Verif' non-vide
	$valide = true;
	if (!empty($nom) && !empty($prenom)){
	
		//////////////////////////////////////////////////CONDUCTEUR///////////////////////////////////////////////////////
		if($_POST['type'] == 'conducteur'){
			
			$adresse = $_POST['adresse'];
			$cp = $_POST['cp'];
			$ville = $_POST['ville'];
			$mail = $_POST['mail'];
			$fixe = $_POST['fixe'];
			$portable = $_POST['portable'];
			
			$pass = 'alsacenavette'.date('Y');
			$s=(string) $pass;
			$md5Pass = md5($s);
			
			if (!empty($adresse) && !empty($cp) && !empty($ville) && !empty($mail) && !empty($fixe) && !empty($portable))
			{
			
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
					'', '".$nom."', '".$prenom."', '".strtolower($prenom)."', '".$md5Pass."', 'Grise', '0.00', '23.50', 'O', '2', '0', '', '0', 'N', '1', '1111111', '1', '0', '1', '0', '0', '8', '94ba2b3c4196860d410c82c9a5dd0bd1', 'O', '0', '1440', '0', 'fr', 'Europe/Paris', 'O', '24', 'N', 'Intermed'
					) ";
				mysql_query($req1) or die (mysql_error());  
				
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
				'".mysql_insert_id()."', '".$nom."', '".$prenom."', '".$adresse."', '".$cp."', '".$ville."', '".$mail."', '".$fixe."', '".$portable."', '".$pass."'
				) ";
				
				mysql_query($req3) or die (mysql_error());  
				
				$req2 =  "INSERT INTO `agenda_droit` (
				`droit_util_id` ,
				`droit_profils` ,
				`droit_agendas` ,
				`droit_notes` ,
				`droit_aff` ,
				`droit_admin`
				)
				VALUES (
				'".mysql_insert_id()."', '20', '20', '0', '000', 'N'
				) ";
				mysql_query($req2) or die (mysql_error());  
			
			}
			else
			{
				$valide = false;
			}
			
		}
		
		//////////////////////////////////////////////////ADMINISTRATIF///////////////////////////////////////////////////////
		elseif($_POST['type'] == 'bureau'){
			
			$identifiant = $_POST['identifiant'];
			
			// Ajout KEMPF : Vérifications non-vide
			if (!empty($identifiant))
			{
			
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
				
				mysql_query($req1) or die (mysql_error());  
				
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
				mysql_query($req4) or die (mysql_error());  
				
				
				
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
				
				mysql_query($req2) or die (mysql_error());  
				
				
				
				 $req3 ="INSERT INTO `agenda_admin` (
				`admin_id` ,
				`admin_login` ,
				`admin_passwd`
				)
				VALUES (
				'', '".$identifiant."', 'ae12f555494c299128b0a75312a68e03'
				) ";
				
				mysql_query($req3) or die (mysql_error()); 
			
			}else{
				$valide = false;
			}
		}
	}else{
		$valide = false;
	}
	?>
    <div style="text-align:center; margin-top:30px;">
    <?php
	if ($valide)
	{
		echo "Ajout effectué avec succès";
	}
	else
	{
		echo "L'ajout n'a pas pu etre effectué : avez-vous rempli tous les champs ?";
	}
	
	?>
    </div>
	


