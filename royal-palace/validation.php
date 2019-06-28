<?php
	// On inclue tout ce qui est nécessaire
	require_once('./includes/init_functions.php');
	
	/* 
		Redirection en cas de tentative d'accès à la page
		par un autre moyen que le formulaire
	*/
	if (!isset($_POST['txt_nom']) || $_SESSION["service"] != "royal"){ 
		header("Location: index.php");
	}else{
	
	// Bouclage de la BDD permettant de supprimer les réservations non-payées
	// clear_reserv();
		
	/*
		Mise en place des variables de session
	*/
	
	list($_SESSION["pays_client"], $_SESSION["ind_tel_client"]) = split(':', $_POST['select_pays']);
	$_SESSION["Payment_Amount"] = $_SESSION["trajet"]["prix"];
	$_SESSION["nom_client"] = htmlspecialchars($_POST['txt_nom']);
	$_SESSION["prenom_client"] = htmlspecialchars($_POST['txt_prenom']);
	$_SESSION["ville_client"] = htmlspecialchars($_POST['txt_ville']);
	$_SESSION["tel_fixe_client"] = $_POST['txt_num_telephone_fixe'];
	$_SESSION["tel_port_client"] = $_POST['txt_num_telephone_port'];
	$_SESSION["mail_client"] = htmlspecialchars($_POST['txt_email']);
	
	// On ajoute le client dans la base
	ajouter_client($_SESSION["nom_client"], $_SESSION["prenom_client"], $_SESSION["ville_client"], $_SESSION["tel_fixe_client"], $_SESSION["tel_port_client"], $_SESSION["mail_client"], $_SESSION["pays_client"]);
	
	// On ajoute l'ID du client dans les variables de session
	$_SESSION["id_client"] = get_id_client($_SESSION["mail_client"]);
	
	// On ajoute la réservation dans la base de données
	ajouter_reservation($_SESSION["id_client"], $_SESSION["trajet"]["prix"], $_SESSION["trajet"]["lieu_aller"], $_SESSION["trajet"]["lieu_retour"], $_SESSION["trajet"]["adresse_aller"], $_SESSION["trajet"]["adresse_retour"], $_SESSION["trajet"]["date_aller"], $_SESSION["trajet"]["date_retour"], $_SESSION["trajet"]["nb_personnes"], $_SESSION["trajet"]["commentaire"]);
	
	// On récupère l'ID de la réservation qui a été inséré
	$_SESSION["id_reserv"] = get_max_id_reserv();
	
	// Création de la variable custom qui contiendra diverses informations
	$custom = $_SESSION["id_reserv"]."|".$_SESSION['lang']."|".$_SESSION["trajet"]["prix"]."|ROYAL";
	
	// Cryptage pour Credit Agricole :
	$encrypted_ca = crypter($custom."-|-".$_SESSION["trajet"]["prix"]."-|-".$_SESSION["mail_client"]);	
	
	}
?>
<html>
	<head>
		<title><?php echo $lang_titre_validation.' :: '.$lang_titre_main; ?></title>
		
		<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
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
				<?php
					/*if (isset($_SESSION['user']) && $_SESSION['user_type'] == "a"){
						$custom .= "|PayPal";
					
						traitementPayement($custom);
					}*/
				?>
				<!-- Titre de la page -->
				<h1><?php echo $lang_titre_validation; ?></h1>
				
				<?php
					// Contenu de la page
					echo '
					<h2 align=center>'.$lang_recap_commande.'</h2>
					
					<fieldset class="spaced_fieldset">
						<legend>'.$lang_vos_informations.'</legend>
						<table class="table_reserv">
							<tr>
								<th><label for="txt_nom">'.$lang_nom.'</label></th>
								<td>'.$_POST['txt_nom'].'</td>
							</tr>
							
							<tr>
								<th><label for="txt_prenom">'.$lang_prenom.'</label></th>
								<td>'.$_POST['txt_prenom'].'</td>
							</tr>
							
							<tr>
								<th><label for="txt_ville">'.$lang_ville.'</label></th>
								<td>'.$_POST['txt_ville'].'</td>
							</tr>
							
							';
							if (!empty($_POST['txt_num_telephone_fixe']))
							{
								echo '
								<tr>
									<th><label for="txt_num_telephone_fixe">'.$lang_num_telephone_fixe.'</label></th>
									<td>'.$_POST['txt_num_telephone_fixe'].'</td>
								</tr>';
							}
							
							if (!empty($_POST['txt_num_telephone_port']))
							{
								echo '
								<tr>
									<th><label for="txt_num_telephone_port">'.$lang_num_telephone_port.'</label></th>
									<td>'.$_POST['txt_num_telephone_port'].'</td>
								</tr>';
							}
							
							echo '
							<tr>
								<th><label for="txt_email">'.$lang_email.'</label></th>
								<td>'.$_POST['txt_email'].'</td>
							</tr>
							
						</table>
					</fieldset>
					
					<fieldset class="spaced_fieldset">
						<legend>'.$lang_le_trajet.' : '.$lang_aller.'</legend>
						<p>
							<b>'.$lang_nombre_personnes.' :</b> '.$_SESSION["trajet"]["nb_personnes"].'
							<br />
							<b>'.$lang_nous_vous_cherchons_a.' :</b> '.get_nom_lieu($_SESSION["trajet"]["lieu_aller"]).'
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
							<b>'.$lang_nombre_personnes.' :</b> '.$_SESSION["trajet"]["nb_personnes"].'
							<br />
							<b>'.$lang_nous_vous_cherchons_a.' :</b> Royal Palace '.$lang_a_heure_min.' '.$_SESSION["trajet"]["heure_retour"].'
							<br />
							'.$lang_et_vous_deposons_a.' '.get_nom_lieu($_SESSION["trajet"]["lieu_retour"]).'';
							
							if ($_SESSION["trajet"]["lieu_retour"] == 4){
								echo 	'<div style="text-align:center;"><i>'.$_SESSION["trajet"]["adresse_retour"].'</i></div>';
							}
						
						echo '
						</p>
					</fieldset>
					
					<div style="width:100%;text-align:center;">
						<a href="http://alsace-navette.com/royal-palace/" title="'.$lang_modifier_mes_infos.'">'.$lang_modifier_mes_infos.'</a>
						<br />
					</div>
					
					<fieldset class="spaced_fieldset">
						<legend>'.$lang_cout_du_trajet.'</legend>
						
						<table class="table_reserv">
							<tr>
								<th>'.$lang_tarif_minimum.'</th>
								<td>'.get_value_of_option("tarif_min_aller_retour").'€</td>
							</tr>
							<tr>
								<th>'.$lang_nombre_personnes.'</th>
								<td>'.$_SESSION["trajet"]["nb_personnes"].'</td>
							</tr>';
							// Ajout de la majoration car recherche à domicile
							if (($_SESSION["trajet"]["lieu_aller"] == 4 || $_SESSION["trajet"]["lieu_retour"] == 4) && intval(get_value_of_option("maj_domicile")) > 0)
							{
								echo '
								<tr>
									<th>'.$lang_majoration_domicile.'</th>
									<td>+ '.get_value_of_option("maj_domicile").'€</td>
								</tr>';
							}
							
							// Ajout de la majoration si spectacle uniquement
							if ($_SESSION["trajet"]["menu_spectacle"] == 1){
								echo '
								<tr>
									<th>'.$lang_majoration_spectacle_only.'</th>
									<td>+ '.(intval(get_value_of_option("maj_only_spectacle")) * $_SESSION["trajet"]["nb_personnes"]).'€</td>
								</tr>';
							}
							
							echo '
							<tr>
								<th>'.$lang_total.'</th>
								<td style="border-top:solid white 1px;">'.$_SESSION["trajet"]["prix"].'€</td>
							</tr>
							<tr>
								<th>&nbsp;</th>
								<td>('.number_format(($_SESSION["trajet"]["prix"] / $_SESSION["trajet"]["nb_personnes"]), 2, ',', ' ').'€ '.$lang_par_personne.')</td>
							</tr>
						</table>
						
					</fieldset>
					
					<fieldset class="spaced_fieldset">
						<legend>'.$lang_mode_paiement.'</legend>
						
						<table class="table_reserv">
							<tr>
								<td colspan=2 style="text-align:center;">
									'.$lang_cartes_acceptees.'
									<br /><br />
									<form action="envoie_ca.php" method="post">
										<div class="centre">
											<input type="hidden" name="paiement_ca" value="'.$encrypted_ca.'" />
											<input type="image" src="images/carte_paypal.png" alt="Cartes de paiement - Credit Cards" name="bouton_paiement" />
										</div>
									</form>
								</td>
							</tr>
							<tr>
								<td colspan=2 style="text-align:center;">
									'.$lang_modes_de_paiement.'
									<br />
								</td>
							</tr>
							<tr>';
								
								// E-Transaction
								echo '
								<td style="text-align:center;">
									<form action="envoie_ca.php" method="post">
										<div class="centre">
											<input type="hidden" name="paiement_ca" value="'.$encrypted_ca.'" />
											<input type="image" src="images/ca_logo.png" alt="e-transaction" name="bouton_paiement" />
										</div>
									</form>
								</td>';
								
								// PayPal
								echo '
								<td style="text-align:center;">
									
									<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
										<input type="hidden" name="cmd" value="_s-xclick" />
										<input type="hidden" name="encrypted" value="'.form_paypal($_SESSION["trajet"]["prix"],"Trajet aller-retour pour Royal Palace", $custom ,"FR").'" />
										<input type="image" src="./images/paypal_logo.png" name="submit" alt="" />
									</form>
									
								</td>';
									
								/*
								// Test avec la sandbox
								echo '
								<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post"> 
									<!-- Identify your business so that you can collect the payments. --> 
									<input type="hidden" name="business" value="pilou_1323099329_biz@hotmail.com " /> 
									<!-- Specify a Buy Now button. -->
									<input type="hidden" name="cmd" value="_xclick" />
									<!-- Specify details about the item that buyers will purchase. --> 
									<input type="hidden" name="item_name" value="Trajet aller-retour pour Europa-Park" /> 
									<input type="hidden" name="amount" value="'.$_SESSION["trajet"]["prix"].'" /> 
									<input type="hidden" name="currency_code" value="EUR" /> 
									<input type="hidden" name="item_number" value="1" /> 
									<input type="hidden" name="no_shipping" value="1" /> 
									<input type="hidden" name="return" value="http://alsace-navette.com/europapark/confirmationPaypal.php" /> 
									<input type="hidden" name="cancel_return" value="http://alsace-navette.com/europapark/annulationPaypal.php" /> 
									<input type="hidden" name="no_note" value="1" />
									<input type="hidden" name="custom" value="'.$custom.'" /> 
									<input type="hidden" name="notify_url" value="http://alsace-navette.com/europapark/ipn.php" /> 
									<!-- Display the payment button. --> 
									<input type="image" name="submit" border="0" src="./images/paypal.png" alt="PayPal - The safer, easier way to pay online" /> 
									<img alt="" border="0" width="1" height="1" src="https://www.paypal.com/en_US/i/scr/pixel.gif" /> 
									<br />
									<img src="./images/carte_paypal.png" alt="PayPal - The safer, easier way to pay online"> 
								</form>';*/
								
							echo '
							</tr>
						</table>
						
					</fieldset>
					';
				?>
			</div>
			
			<!-- Le pied de page -->
			<?php require_once('./includes/include_pied_de_page.php'); ?>
		</div>
		
	</body> 
</html>