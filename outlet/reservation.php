<?php
	require_once('./includes/init_functions.php');
	
	if (isset($_GET['event']) && $_GET['event'] == '14_juillet')
	{
		$id_lieu = 1;
		$trajet_aller = get_trajet_par_nom_et_date('Outlet City - Metzingen','2015-07-14');
		$date_aller = strtotime($trajet_aller['date_trajet']);
		$trajet_retour = get_le_trajet($trajet_aller['id_trajet'] + 1);
		$date_retour = strtotime($trajet_retour['date_trajet']);
		$mois_calendrier = '7';
		$annee_calendrier = '2015';
		$disabled = 'disabled';
	}
	else
	{
		$id_lieu = '';
		$trajet_aller = '';
		$date_aller = '';
		$trajet_retour = '';
		$date_retour = '';
		$premier_trajet = get_premier_trajet();
		$date_premier_trajet = strtotime($premier_trajet['date_trajet']);
		$mois_calendrier = date('m',$date_premier_trajet);
		$annee_calendrier = date('Y', $date_premier_trajet);
		$disabled = '';
	}
?>
<html>
	<head>
		<title><?php echo $lang_titre_reservation.' :: '.$lang_titre_main; ?></title>
		
		<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
		<meta name="Language" content="fr" />
		<meta name="viewport" content="width=device-width, initial-scale=1">	
		
		<link rel="stylesheet" type="text/css" href="styles/base.css" media="all" />
		<link rel="stylesheet" type="text/css" href="styles/style.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="styles/calendrier.css" />
		<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
		
		<script type="text/javascript">var lang = '<?php echo $_SESSION['lang'] ;?>'; </script>
		<script src="./scripts/rico/src/prototype.js" type="text/javascript"></script>
		<script type="text/javascript" src="scripts/fonctions.js"></script>
		<!--<script type="text/javascript" src="scripts/charger_tableaux_trajets.js"></script>-->
		<script type="text/javascript" src="scripts/verification_formulaire.js"></script>
		
		<!-- Chargement de JQuery et Jquery UI depuis Google API -->
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
		<link rel="stylesheet" type="text/css" href="styles/ui-lightness/jquery-ui.css" media="all" />
		<script type="text/javascript" src="scripts/jssor.slider.mini.js"></script>
		<script type="text/javascript" src="scripts/slider.js"></script>
	</head> 
	
	<body>
		
		<div id="global">
			<!-- On insère le header + le menu -->
			<?php require_once('./includes/include_entete_menu.php'); ?>
			
			<div id="contenu" style="margin-bottom:20px;">
			
				<div class="row" style="text-align:center;position:relative;">
					<?php require_once('./includes/slider.php'); ?>
					<div class="texte_accueil">
						<?php echo $lang_texte_info_accueil; ?>
					</div>
				</div>
				
				<div class="row" id="reservation">
					<div class="col-xs-12 col-sm-6 col-md-6">
						<p class="row" style="text-align:center;padding-bottom:10px;"><span style="font-weight:bold;">1. </span><?php echo $lang_etape_1; ?></p>
						<div class="row" style="border-top:3px solid black;">
						
							<!-- on crée l'élément "calendrier" dans lequel va s'afficher dynamiquement le calendrier-->
							<script>window.addEventListener('load', function() {tableau(<?php echo $mois_calendrier;?>,<?php echo $annee_calendrier;?>); });</script>
							<div id="calendrier" class="conteneur calendrier" align="center">
								<p style="height:50px;"><span id="link_precedent" class="glyphicon glyphicon-chevron-left" style="margin-top:15px;font-size:18px;"></span> <span id="link_suivant" class="glyphicon glyphicon-chevron-right" style="margin-top:15px;font-size:18px;"></span> <span id="titre" style="text-transform:uppercase;"><span style="font-size:18px;"><?php echo $lang_table_mois[$mois_calendrier-1];?></span><br><?php echo $annee_calendrier;?></span></p>
								<div>
									<table class="tab_calendrier" align="center">
										<tr>
											<?php 
												for ($i = 0; $i < 7; $i++)
												{?>
													<td  class="cell_calendrier_jour"><?php
													if ($i == 6)
													{
														echo $lang_table_jour_court[0];
													}
													else
													{
														echo $lang_table_jour_court[$i+1];
													}?>
													</td><?php
												}
											?>
										</tr>
										<?php
											$compteur_lignes=0;
											$total=1;
											while($compteur_lignes<6)
											{
												echo '<tr>';
												$compteur_colonnes=0;
												while($compteur_colonnes<7)
												{
												   echo '<td id="'.$total.'" class="cell_calendrier" >';
												   echo '</td>';
												   $compteur_colonnes++;
												   $total++;
												}
												echo '</tr>';
												$compteur_lignes++;
											}
										?>
									</table>
								</div>
							</div>
							
							<div class="row" style="margin-top:20px;">
								<div class="col-xs-6 bloc_legende">
									<div class="col-xs-2 col-sm-2 col-md-2 case_legende case_talange">
									</div>
									<div class="col-xs-9 col-sm-9 col-md-9">
										Marques Avenue<br>TALANGE
									</div>
								</div>
								
								<div class="col-xs-6 bloc_legende">
									<div class="col-xs-2 col-sm-2 col-md-2 case_legende case_zweibrucken">
									</div>
									<div class="col-xs-10 col-sm-10 col-md-10">
										The Style Outlet<br>ZWEIBRUCKEN
									</div>
								</div>
								
								<div class="col-xs-6 bloc_legende">
									<div class="col-xs-2 col-sm-2 col-md-2 case_legende case_roppenheim">
									</div>
									<div class="col-xs-10 col-sm-10 col-md-10">
										The Style Outlet<br>ROPPENHEIM
									</div>
								</div>
								
								<div class="col-xs-6 bloc_legende">
									<div class="col-xs-2 col-sm-2 col-md-2 case_legende case_metzingen">
									</div>
									<div class="col-xs-10 col-sm-10 col-md-10">
										Outlet City<br>METZINGEN
									</div>
								</div>
								
								<div class="col-xs-6 bloc_legende">
									<div class="col-xs-2 col-sm-2 col-md-2 case_legende" style="background-color:grey;">
									</div>
									<div class="col-xs-10 col-sm-10 col-md-10">
										<?php echo $lang_trajet_complet ;?>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-xs-12 col-sm-6 col-md-6 reservation_droite" id="form_reservation">
						<p class="row" style="text-align:center;padding-bottom:10px;"><span style="font-weight:bold;">2. </span><?php echo $lang_etape_2; ?></p>
						<div class="row formulaire_reservation" style="border-top:3px solid black;">
							<form action="info_client.php" method="post" class="col-xs-12 col-sm-12 col-md-12">
								<div class="col-xs-12 col-sm-7 col-md-7">
									<div class="row">
										<label class="col-xs-12 col-sm-12 col-md-6" for="date"><?php echo $lang_date_trajet; ?></label>
										<input value="<?php echo date('d/m/Y',$date_aller); ?>" type="text" id="date" name="date" class="col-sm-12 col-md-6" disabled>
									</div>
									
									<div class="row">
										<label class="col-xs-12 col-sm-12 col-md-6" for="depart"><?php echo $lang_depart_trajet; ?> <sup class="rouge">*</sup></label>
										<select name="depart" id="depart" class="col-sm-12 col-md-6" <?php echo $disabled; ?>>
											<?php foreach(get_list_lieu() as $lieu)
											{?>
												<option value="<?php echo $lieu['id_lieu'];?>"><?php echo $lieu['nom_lieu_'.$_SESSION["lang"]];?></option><?php
											}?>
										</select>
										<input type="hidden" name="depart" value="3" id="input_depart"/>
									</div>
									
									<div class="row" id="adresse_client" style="display:none;">
										<div class="row">
											<label class="col-xs-12 col-sm-12 col-md-6" for="txt_adresse_compl_aller"><?php echo $lang_adresse; ?> <sup class="rouge">*</sup></label>
											<input type="text" name="txt_adresse_compl_aller" id="txt_adresse_compl_aller" class="col-sm-12 col-md-6">
										</div>
										
										<div class="row">
											<label class="col-xs-12 col-sm-12 col-md-6" for="txt_cp_compl_aller"><?php echo $lang_code_postal; ?> <sup class="rouge">*</sup></label>
											<input type="text" name="txt_cp_compl_aller" id="txt_cp_compl_aller" class="col-sm-12 col-md-6">
										</div>
										
										<div class="row">
											<label class="col-xs-12 col-sm-12 col-md-6" for="txt_ville_compl_aller"><?php echo $lang_ville; ?> <sup class="rouge">*</sup></label>
											<input type="text" name="txt_ville_compl_aller" id="txt_ville_compl_aller" class="col-sm-12 col-md-6">
										</div>
									</div>
									
									<div class="row">
										<label class="col-xs-12 col-sm-12 col-md-6" for="destination"><?php echo $lang_destination_trajet; ?> <sup class="rouge">*</sup></label>
										<input value="<?php echo $trajet_aller['service_trajet']; ?>" type="text" name="destination" id="destination" class="col-sm-12 col-md-6" disabled>
										<input value="<?php echo $id_lieu; ?>" type="hidden" name="id_lieu" id="id_lieu">
									</div>
									
									<div class="row">
										<label class="col-xs-12 col-sm-12 col-md-6" for="heure_depart"><?php echo $lang_heure_depart; ?> <sup class="rouge">*</sup></label>
										<input value="<?php echo date('H\Hi',$date_aller); ?>" type="text" name="heure_depart" id="heure_depart" class="col-sm-12 col-md-6" disabled>
									</div>
									
									<div class="row">
										<label class="col-xs-12 col-sm-12 col-md-6" for="heure_retour"><?php echo $lang_heure_retour; ?> <sup class="rouge">*</sup></label>
										<input value="<?php echo date('H\Hi',$date_retour); ?>" type="text" name="heure_retour" id="heure_retour" class="col-sm-12 col-md-6" disabled>
									</div>
									
									<div class="row">
										<label class="col-xs-12 col-sm-12 col-md-6" for="nbre_passagers"><?php echo $lang_nbre_passagers; ?> <sup class="rouge">*</sup></label>
										<input type="number" name="nbre_passagers" id="nbre_passagers" class="col-sm-12 col-md-6" value="1" min="1">
									</div>
									
									<div class="row">
										<label class="col-xs-12 col-sm-12 col-md-6" for="nbre_passagers_enfants"><?php echo $lang_nbre_passagers_enfants; ?> <sup class="rouge">*</sup></label>
										<input type="number" name="nbre_passagers_enfants" id="nbre_passagers_enfants" class="col-sm-12 col-md-6" value="0" min="0">
									</div>
									
									<div class="row">
										<input value="<?php echo $trajet_aller['id_trajet']; ?>" type="hidden" name="id_trajet" id="id_trajet">
										<input type="submit" value="<?php echo $lang_etape_suivante; ?>" class="col-md-offset-6 btn_etape_suivante">
									</div>
									
									<div class="row" style="text-align:center;margin-top:20px;font-size:12px;">
										<sup class="rouge">*</sup> : <?php echo $lang_champ_obligatoire; ?>
									</div>
								</div>
								
								<div class="col-xs-12 col-sm-5 col-md-5" style="padding:0 20px;text-align:center;">
									<img src="images/liste_logo_outlet.png" style="width:80%;">
								</div>
							</form>
							
							<div class="col-xs-12 col-sm-4 col-md-4">
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<!-- Le pied de page -->
			<?php require_once('./includes/include_pied_de_page.php'); ?>
		</div>
		
	</body>
</html>