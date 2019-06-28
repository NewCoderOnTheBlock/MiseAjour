<?php
	// On inclue tout ce qui est nécessaire
	require_once('./includes/init_functions.php');
	
	/* 
		Redirection en cas de tentative d'accès à la page
		par un autre moyen que le formulaire
	*/
	if (!isset($_POST['txt_nom']) || $_SESSION["service"] != "roppenheim"){ 
		header("Location: index.php");
		exit;
	}
	
	// Bouclage de la BDD permettant de supprimer les réservations non-payées
	clear_reserv();
		
	/*
		Mise en place des variables de session
	*/
	
	$_SESSION["Payment_Amount"] = $_SESSION["trajet"]["prix"];
	
	list($_SESSION["pays_client"], $_SESSION["ind_tel_client"]) = split(':', $_POST['select_pays']);
	$_SESSION["nom_client"] = $_POST['txt_nom'];
	$_SESSION["prenom_client"] = $_POST['txt_prenom'];
	$_SESSION["ville_client"] = $_POST['txt_ville'];
	$_SESSION["tel_fixe_client"] = $_POST['txt_num_telephone_fixe'];
	$_SESSION["tel_port_client"] = $_POST['txt_num_telephone_port'];
	$_SESSION["mail_client"] = $_POST['txt_email'];
	
	// On ajoute le client dans la base
	ajouter_client($_SESSION["nom_client"], $_SESSION["prenom_client"], $_SESSION["ville_client"], $_SESSION["tel_fixe_client"], $_SESSION["tel_port_client"], $_SESSION["mail_client"], $_SESSION["pays_client"]);
	
	// On ajoute l'ID du client dans les variables de session
	$_SESSION["id_client"] = get_id_client($_SESSION["mail_client"]);
	
?>
<html>
	<head>
		<title><?php echo $lang_titre_choix_navette.' :: '.$lang_titre_main; ?></title>
		
		<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
		<meta name="Language" content="fr" />		
		
		<link rel="stylesheet" type="text/css" href="styles/base.css" media="all" />
		<link rel="stylesheet" type="text/css" href="styles/style.css" media="screen" />
	</head> 
	<body> 

		<div id="global">
			<!-- On insère le header + le menu -->
			<?php require_once('./includes/include_entete_menu.php'); ?>
			
			<!-- Le contenu -->
			<div id="contenu">
				<!-- Titre de la page -->
				<h1><?php echo $lang_titre_choix_navette; ?></h1>
				
				<?php
					
					// Contenu de la page
					echo '
					'.$lang_effectuez_reservation.'
					<fieldset class="spaced_fieldset">
						<legend>'.$lang_le_trajet.' : '.$lang_aller.'</legend>
						<p>
							<strong>'.$lang_nombre_personnes.' :</strong> '.$_SESSION["trajet"]["nb_personnes"].'
							<br />
							<strong>'.$lang_nous_vous_cherchons_a.' :</strong> '.get_nom_lieu($_SESSION["trajet"]["lieu_aller"]).'
							<br />';
							
							if ($_SESSION["trajet"]["lieu_aller"] == 4){
								echo 	'<div style="text-align:center;"><i>'.$_SESSION["trajet"]["adresse_aller"].'</i></div>';
							}
							
							echo $_SESSION["trajet"]["jour_long"].' '.$lang_a_heure_min.' '.$_SESSION["trajet"]["heure_aller"];
							echo '
						</p>
					</fieldset>
					
					<fieldset class="spaced_fieldset">
						<legend>'.$lang_le_trajet.' : '.$lang_retour.'</legend>
						
						<p>
							<strong>'.$lang_nombre_personnes.' :</strong> '.$_SESSION["trajet"]["nb_personnes"].'
							<br />
							<strong>'.$lang_nous_vous_cherchons_a.' :</strong> TheStyleOutlets : Roppenheim '.$lang_a_heure_min.' '.$_SESSION["trajet"]["heure_retour"].'
							<br />
							'.$lang_et_vous_deposons_a.' '.get_nom_lieu($_SESSION["trajet"]["lieu_retour"]).'';
							
							if ($_SESSION["trajet"]["lieu_retour"] == 4){
								echo 	'<div style="text-align:center;"><i>'.$_SESSION["trajet"]["adresse_retour"].'</i></div>';
							}
						
						echo '
						</p>
					</fieldset>
					
					<fieldset class="spaced_fieldset" >
						<legend>'.$lang_navettes_disponibles.'</legend>
						
						<table class="table_reserv" style="margin:auto;">';
								$lesTrajetsDisponibles = get_les_trajets_dispo($_SESSION["trajet"]["date_aller"], $_SESSION["trajet"]["nb_personnes"]);
								
								if (!empty($lesTrajetsDisponibles)){
									
									echo '
										<tr>
											<td colspan="2"><strong>'.$lang_veuillez_choisir_une_navette.'</strong></td>
										</tr>';
										
									$i = 1;
									foreach($lesTrajetsDisponibles as $uneNavette){
																					
										echo '
											<tr>
												<td>'.$lang_navette.' #'.$i.' : '.$uneNavette['nb_pers'].'/8 '.$lang_personnes.'</td>
												<td>
													<form name="form_reserv" method="post" action="validation.php" id="form_reservation">
														<input type="hidden" name="id_trajet" value="'.$uneNavette['id_trajet'].'" />
														<input type="submit" id="bt_choisir" name="bt_choisir" value="'.$lang_choisir.'" />
													</form>
												</td>
											</tr>
										';
										
										$i++;
										
									}
								}else{
									
									echo '
										<tr>
											<td colspan="2">'.$lang_plus_de_navette_dispo.'</td>
										</tr>';
									
								}
							
							echo '
						</table>
						
					</fieldset>';
					
				?>
			</div>
			
			<!-- Le pied de page -->
			<?php require_once('./includes/include_pied_de_page.php'); ?>
		</div>
		
	</body> 
</html>