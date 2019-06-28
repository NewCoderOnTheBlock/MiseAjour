<?php
	// On inclue tout ce qui est nécessaire
	require_once('./includes/init_functions.php');
	
	/* 
		Redirection en cas de tentative d'accès à la page
		par un autre moyen que le formulaire
	*/
	if (!isset($_POST['txt_nom']) || $_SESSION["service"] != "Outlet"){ 
		header("Location: index.php");
		exit();
	}
	
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
	
	if (est_admin($_SESSION['mail_client']))
	{
		$_SESSION['admin'] = 1;
		$_SESSION['trajet']['prix'] = 0;
	}
	else
	{
		$_SESSION['admin'] = 0;
	}

	// On ajoute le client dans la base
	ajouter_client($_SESSION["nom_client"], $_SESSION["prenom_client"], $_SESSION["ville_client"], $_SESSION["tel_fixe_client"], $_SESSION["tel_port_client"], $_SESSION["mail_client"], $_SESSION["pays_client"]);
	
	// On ajoute l'ID du client dans les variables de session
	$_SESSION["id_client"] = get_id_client($_SESSION["mail_client"]);
	
	// On ajoute la réservation dans la base de données
	ajouter_reservation($_SESSION["id_client"], $_SESSION["trajet"]["prix"], $_SESSION["trajet"]["lieu_aller"], $_SESSION["trajet"]["lieu_retour"], $_SESSION["trajet"]["adresse_aller"], $_SESSION["trajet"]["adresse_retour"], $_SESSION["trajet"]["date_aller"], $_SESSION["trajet"]["date_retour"], $_SESSION["trajet"]["nb_personnes"], $_SESSION["trajet"]["leOutlet"]["libelle_outlet"]);
	
	// On récupère l'ID de la réservation qui a été insérée
	$_SESSION["id_reserv"] = get_max_id_reserv();
	
	$id_trajet = $_SESSION['trajet']['id_trajet'];
	$capacite = $_SESSION['trajet']['leTrajet_aller']['nb_pers'];
	$nb_passagers = get_nb_passagers($id_trajet);
	
	// Création de la variable custom qui contiendra diverses informations
	$custom = $_SESSION["id_reserv"]."|".$_SESSION['lang']."|".$_SESSION["trajet"]["prix"]."|OUTLET|".$id_trajet;
	
	// Cryptage pour Credit Agricole :
	$encrypted_ca = crypter($custom."-|-".$_SESSION["trajet"]["prix"]."-|-".$_SESSION["mail_client"]);
	
?>
<html>
	<head>
		<title><?php echo $lang_titre_validation.' :: '.$lang_titre_main; ?></title>
		
		<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
		<meta name="Language" content="fr" />
		<meta name="viewport" content="width=device-width, initial-scale=1">		
		
		<link rel="stylesheet" type="text/css" href="styles/base.css" media="all" />
		<link rel="stylesheet" type="text/css" href="styles/style.css" media="screen" />
		<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
	</head> 
	<body> 

		<div id="global">
			<!-- On insère le header + le menu -->
			<?php require_once('./includes/include_entete_menu.php'); ?>
			
			<!-- Le contenu -->
			<div id="contenu" class="row validation">
				<!-- Titre de la page -->
				<h1><?php echo $lang_titre_validation; ?></h1>
				
				<?php
					// Contenu de la page
					echo '
					
					<fieldset class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2 fieldset_infos_client" style="margin-top:20px;">
						<legend>'.$lang_vos_informations.'</legend>
						<div class="row">
							<label class="col-xs-12 col-sm-6 col-md-4">'.$lang_nom.'</label>
							'.$_SESSION['nom_client'].'
						</div>
						
						<div class="row">
							<label class="col-xs-12 col-sm-6 col-md-4">'.$lang_prenom.'</label>
							'.$_SESSION['prenom_client'].'
						</div>
						
						<div class="row">
							<label class="col-xs-12 col-sm-6 col-md-4">'.$lang_ville.'</label>
							'.$_SESSION['ville_client'].'
						</div>
						
						';
						if (!empty($_SESSION['tel_fixe_client']))
						{
							echo '
							<div class="row">
								<label class="col-xs-12 col-sm-6 col-md-4">'.$lang_num_telephone_fixe.'</label>
								'.$_SESSION['tel_fixe_client'].'
							</div>';
						}
						
						if (!empty($_SESSION['tel_port_client']))
						{
							echo '
							<div class="row">
								<label class="col-xs-12 col-sm-6 col-md-4">'.$lang_num_telephone_port.'</label>
								'.$_SESSION['tel_port_client'].'
							</div>';
						}
						
						echo '
						<div class="row">
							<label class="col-xs-12 col-sm-6 col-md-4">'.$lang_email.'</label>
							'.$_SESSION['mail_client'].'
						</div>
							
					</fieldset>
					
					<div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2" style="padding:0;margin-top:20px;">
						<fieldset class="col-xs-12 col-sm-12 col-md-6">
							<legend>'.$lang_le_trajet.' : '.$lang_aller.'</legend>
							<p>
								<strong>'.$lang_nombre_personnes.' :</strong> '.$_SESSION["trajet"]["nb_personnes"].' '.$lang_dont.' '.$_SESSION['trajet']['nbre_passagers_enfants'].' '.$lang_enfants.'
								<br />
								<strong>'.$lang_nous_vous_cherchons_a.' :</strong> <span style="font-weight:bold;">'.get_nom_lieu($_SESSION["trajet"]["lieu_aller"]);
								
								if ($_SESSION["trajet"]["lieu_aller"] == 4){
									echo 	'<div style="text-align:center;"><i>'.$_SESSION["trajet"]["adresse_aller"].'</i></div>';
								}
								else
								{
									echo ', ';
								}
								
								echo $_SESSION["trajet"]["jour_long_aller"].' '.$lang_a_heure_min.' '.$_SESSION["trajet"]["heure_aller"];
								echo '</span>
							</p>
						</fieldset>
					
						<fieldset class="col-xs-12 col-sm-12 col-md-6 fieldset_retour">
							<legend>'.$lang_le_trajet.' : '.$lang_retour.'</legend>
							
							<p>
								<strong>'.$lang_nombre_personnes.' :</strong> '.$_SESSION["trajet"]["nb_personnes"].' '.$lang_dont.' '.$_SESSION['trajet']['nbre_passagers_enfants'].' '.$lang_enfants.'
								<br />
								<strong>'.$lang_nous_vous_cherchons_a.' :</strong> <span style="font-weight:bold;">'.$_SESSION["trajet"]["leOutlet"]["libelle_outlet"].', '.$_SESSION["trajet"]["jour_long_retour"].' '.$lang_a_heure_min.' '.$_SESSION["trajet"]["heure_retour"].'</span>
								<br />
								<strong>'.$lang_et_vous_deposons_a.' :</strong> '.get_nom_lieu($_SESSION["trajet"]["lieu_retour"]).'';
								
								if ($_SESSION["trajet"]["lieu_retour"] == 4){
									echo 	'<div style="text-align:center;"><i>'.$_SESSION["trajet"]["adresse_retour"].'</i></div>';
								}
								else
								{
									echo ', ';
								}
								echo $_SESSION["trajet"]["jour_long_retour"].' '.$lang_a_heure_min.' '.$_SESSION["trajet"]["heure_retour_strasbourg"];
							
							echo '
							</p>
						</fieldset>
						
						<div class="col-xs-12 col-sm-12 col-md-12" style="text-align:center;margin-top:10px;">
							<a href="reservation.php" title="'.$lang_modifier_mes_infos.'">'.$lang_modifier_mes_infos.'</a>
							<br />
						</div>
					</div>
				
					<fieldset class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2 fieldset_tarifs" style="margin-top:20px;font-size:16px;">
						<legend>'.$lang_cout_du_trajet.'</legend>
						
						<div class="row">
							<label class="col-xs-12 col-sm-6 col-md-4">'.$lang_tarif_minimum.'</label>
							<span class="col-xs-12 col-sm-6 col-md-3" style="padding:0;">';
							if ($_SESSION['trajet']['leTrajet_aller']['prix_trajet'] != NULL && $_SESSION['trajet']['leTrajet_aller']['prix_trajet'] != 0 && $_SESSION['admin'] == 0) 
							{ 
								echo $_SESSION['trajet']['leTrajet_aller']['prix_trajet'];
							}
							else if ($_SESSION['admin'] == 1)
							{
								echo '0';
							}
							else
							{
								echo $_SESSION["trajet"]["leOutlet"]["tarif_outlet"];
							}
							echo '€ '.$lang_par_personne.' '.(($_SESSION['admin'] == 1) ? '(Administrateur)' : ' ').'</span>
						</div>
						<div class="row">
							<label class="col-xs-12 col-sm-6 col-md-4">'.$lang_nombre_personnes.'</label>
							'.$_SESSION["trajet"]["nb_personnes"].'
						</div>';
						// Ajout de la majoration car recherche à domicile
						if (($_SESSION["trajet"]["lieu_aller"] == 4) && get_value_of_option("maj_domicile") > 0)
						{
							echo '
							<div class="row">
								<label class="col-xs-12 col-sm-6 col-md-4">'.$lang_majoration_domicile.'</label>
								<span class="col-xs-12 col-sm-6 col-md-3" style="padding:0;">+ '.(($_SESSION['admin'] == 1) ? '0' : get_value_of_option("maj_domicile")).'€ '.(($_SESSION['admin'] == 1) ? '(Administrateur)' : ' ').'</span>
							</div>';
						}
						
						echo '
						<div class="row" style="margin-top:5px;">
							<label class="col-xs-12 col-sm-6 col-md-4">'.$lang_total.'</label>
							<span class="col-xs-12 col-sm-6 col-md-3" style="padding:0;">'.$_SESSION["trajet"]["prix"].'€ '.(($_SESSION['admin'] == 1) ? '(Administrateur)' : ' ').'</span>
						</div>
						
					</fieldset>
					
					<fieldset class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2" style="margin-top:20px;margin-bottom:10px;">
						<legend>'.$lang_mode_paiement.'</legend>
						
						<div class="row">';
							if ($nb_passagers + $_SESSION['trajet']['nb_personnes'] > $capacite)
							{
								echo $lang_explication_capacite.'<br>'.$lang_explication_confirmation;?>
								<br><a href="confirmation_attente.php" style="color:black;"><button><?php echo $lang_envoyer;?></button></a>
								<?php
							}
							else if ($_SESSION['admin'] == 1)
							{
								echo '<p style="font-weight:bold;text-align:center;">En tant qu\'administrateur, vous pouvez confirmer votre trajet sans payer !<br>Cliquez sur le bouton ci-dessous<br>
								<a href="confirmation_admin.php" style="color:black;font-weight:normal;"><button>Confirmer</button></a></p>';
							}
							else
							{
								// E-Transaction
								echo '
								<div class="col-xs-12 col-sm-6 col-md-6" style="text-align:center;">
									<form action="envoie_ca.php" method="post">
										<input type="hidden" name="paiement_ca" value="'.$encrypted_ca.'" />
										<input type="image" src="images/paiement.png" alt="e-transaction" name="bouton_paiement" class="image_paiement" />
									</form>
								</div>';
								
								// PayPal
								echo '
								<div class="col-xs-12 col-sm-6 col-md-6" style="text-align:center;">
									
									<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
										<input type="hidden" name="cmd" value="_s-xclick" />
										<input type="hidden" name="encrypted" value="'.form_paypal($_SESSION["trajet"]["prix"],"Trajet aller-retour pour un centre Outlet", $custom ,strtoupper($_SESSION['lang'])).'" />
										<input type="image" src="./images/paypal_logo.png" name="submit" alt="" />
									</form>';
							}
							echo '
								
							</div>
							
						</div>
						
					</fieldset>
					';
				?>
			</div>
			
			<!-- Le pied de page -->
			<?php require_once('./includes/include_pied_de_page.php'); ?>
		</div>
		
	</body> 
</html>