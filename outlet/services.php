<?php
	require_once('./includes/init_functions.php');
?>
<html>
	<head>
		<title><?php echo $lang_titre_services.' :: '.$lang_titre_main; ?></title>
		
		<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
		<meta name="Language" content="fr" />
		<meta name="viewport" content="width=device-width, initial-scale=1">	
		
		<link rel="stylesheet" type="text/css" href="styles/base.css" media="all" />
		<link rel="stylesheet" type="text/css" href="styles/style.css" media="screen" />
		<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
		
		<!-- Chargement de JQuery et Jquery UI depuis Google API -->
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
		<script type="text/javascript" src="scripts/services.js"></script>
	</head> 
	<body> 

		<div id="global">
			<!-- On insère le header + le menu -->
			<?php require_once('./includes/include_entete_menu.php'); ?>
			
			<!-- Le contenu -->
			<div id="contenu">
				<!-- Titre de la page -->
				<h1><?php echo $lang_titre_services; ?></h1>
				
				<?php if (time() < mktime(0,0,0,7,14,2015))
				{?>
					<div class="row" style="margin-bottom:20px;margin-top:20px;">
						<div class="col-xs-12 col-sm-6 col-md-6">
							<?php
								// Contenu de la page
								echo $lang_texte_metzingen;
							?>
							<p style="text-align:center;font-size:18px;margin-top:20px;"><a href="reservation.php?event=14_juillet#reservation" style="background-color:#da3a57;padding:5 10px;color:white;"><?php echo $lang_reserver; ?></a></p>
						</div>
						
						<div class="col-xs-12 col-sm-6 col-md-6">
							<a href="reservation.php?event=14_juillet#reservation"><img src="images/14th_july_v2.png" style="width:100%;"></a>
						</div>
					</div><?php
				}?>
				
				<div class="row formules">
				
					<div class="col-xs-12 col-sm-3 col-md-3 services">
					
						<div class="col-xs-12 col-sm-12 col-md-12" style="text-align:center;">
							<div style="display:inline-block;position:relative;">
								<img src="images/photo_centre_1.png">
								<img src="images/picto_after_work.png" class="picto_sur_image">
							</div><br>
						</div>
						
						<div class="col-xs-12 col-sm-12 col-md-12 texte_formules texte_affiche texte_formules_services" style="padding:15px;">
							<?php echo $lang_texte_after_work; ?>
						</div>
						
						<div class="col-xs-12 col-sm-12 col-md-12">
							<p class="titre_infos titre_infos_grand" style="margin-bottom:30px;"><?php echo $lang_after_work; ?></p>
							<span class="plus plus_services" style="padding:3px 9px;" id="service_1">
								+
							</span>
							
							<div class="col-xs-12 col-sm-12 col-md-12 texte_formules texte_formules_services" id="infos_service_1" style="padding:15px;padding-top:0;">
								<?php echo $lang_texte_after_work; ?>
							</div>
						</div>
						
						<div class="col-xs-12 col-sm-12 col-md-12" style="text-align:center;">
							<p class="titre_infos titre_infos_grand"><?php echo $lang_horaires_tarifs; ?></p>
							<span class="plus plus_infos_pratiques" style="padding:3px 9px;" id="infos_1">
								+
							</span>
							
							<div id="horaires_tarifs_1" style="display:none;">
						
								<?php $outlets = get_outlets_par_service(1);
								foreach ($outlets as $outlet)
								{
									$nom = explode('_',$outlet['code_outlet']);
									$tarif = $outlet['tarif_outlet'] + $outlet['supplement'];?>
									<div class="row formules_outlet" style="margin-bottom:20px;">
										<p class="titre_infos titre_infos_grand"><?php echo $nom[1]; ?></p>
										
										<div class="col-xs-12 col-sm-12 col-md-12 bloc_infos_pratiques" id="infos_pratiques_<?php echo $outlet['id_outlet']; ?>" style="padding:0;padding-bottom:10px;">
											<div class="row" style="text-align:left;padding:0 30px;">
												<div class="col-xs-4 col-sm-4 col-md-4" style="padding:0;">
													<span style="text-decoration:underline;"><?php echo $lang_depart;?></span> 
												</div>
												
												<div class="col-xs-8 col-sm-8 col-md-8" style="padding:0;">
													<span style="font-weight:bold;">Strasbourg</span> 16h00
												</div>
											</div>
											
											<?php
											$duree_trajet = $outlet['duree_trajet'];
											$duree = explode(':',$outlet['duree_trajet']);
											$heure_retour = date('c',mktime(16+$duree[0],$duree[1],0)+60*60*3);
											$heure_retour_outlet = new DateTime($heure_retour);
											$heure_retour_stras = date('c',mktime(16+2*$duree[0],2*$duree[1],0)+60*60*3);
											$heure_retour_strasbourg = new DateTime($heure_retour_stras);?>
											
											<div class="row" style="margin-top:10px;text-align:left;padding:0 30px;">
												<div class="col-xs-4 col-sm-4 col-md-4" style="padding:0;">
													<span style="text-decoration:underline;"><?php echo $lang_retour;?></span>
												</div>
												
												<div class="col-xs-8 col-sm-8 col-md-8" style="padding:0;">
													<span style="font-weight:bold;">Outlet</span> <?php echo $heure_retour_outlet->format('H\hi'); ?>
												</div>
											</div>
											
											<div class="row" style="padding:0 30px;">										
												<div class="col-xs-8 col-xs-offset-4 col-sm-8 col-sm-offset-4 col-md-8 col-md-offset-4" style="text-align:left;padding:0;">
													<span style="font-weight:bold;">Strasbourg</span> <?php echo $heure_retour_strasbourg->format('H\hi'); ?>
												</div>
											</div>
											
											<div class="row" style="margin-top:10px;padding:0 30px;">
												<p class="col-xs-12 col-sm-12 col-md-12 titre_infos" style="font-size:12px;padding:0;"><span style="text-transform:uppercase;"><?php echo $lang_tarif_minimum; ?></span> <?php echo $lang_aller_retour; ?></p>
												
												<div class="row" style="text-align:left;">
													<div class="col-xs-8 col-sm-8 col-md-8" style="padding:0;">
														<span style="font-weight:bold;"><?php echo $lang_tarif_par_personne;?></span>
													</div>
													
													<div class="col-xs-4 col-sm-4 col-md-4" style="padding:0;text-align:right;">
														<?php echo $tarif.' €'; ?>
													</div>
												</div>
												
												<div class="row" style="text-align:left;">
													<?php echo $lang_soit_pour; ?>
												</div>
												
												<div class="row" style="text-align:left;">
													<div class="col-xs-8 col-sm-8 col-md-8" style="padding:0;">
														<span style="font-weight:bold;">4 <?php echo $lang_personnes;?></span>
													</div>
													
													<div class="col-xs-4 col-sm-4 col-md-4" style="padding:0;text-align:right;">
														<?php echo 4*$tarif.' €'; ?>
													</div>
												</div>
												
												<div class="row" style="text-align:left;">
													<div class="col-xs-8 col-sm-8 col-md-8" style="padding:0;">
														<span style="font-weight:bold;">8 <?php echo $lang_personnes;?></span>
													</div>
													
													<div class="col-xs-4 col-sm-4 col-md-4" style="padding:0;text-align:right;">
														<?php echo 8*$tarif.' €'; ?>
													</div>
												</div>
												
											</div>
											
										</div>
									</div><?php
								}?>
							</div>
						
						</div>
						
					</div>
					
					<div class="col-xs-12 col-sm-3 col-md-3 services">
					
						<div class="col-xs-12 col-sm-12 col-md-12" style="text-align:center;">
							<div style="display:inline-block;position:relative;">
								<img src="images/photo_centre_2.png">
								<img src="images/picto_shopping_day.png" class="picto_sur_image">
							</div><br>
						</div>
						
						<div class="col-xs-12 col-sm-12 col-md-12 texte_formules texte_affiche texte_formules_services" style="padding:15px;">
							<?php echo $lang_texte_shopping_day; ?>
						</div>
						
						<div class="col-xs-12 col-sm-12 col-md-12">
							<p class="titre_infos titre_infos_grand" style="margin-bottom:30px;"><?php echo $lang_shopping_day; ?></p>
							<span class="plus plus_services" style="padding:3px 9px;" id="service_2">
								+
							</span>
							
							<div class="col-xs-12 col-sm-12 col-md-12 texte_formules texte_formules_services" id="infos_service_2" style="padding:15px;padding-top:0;">
								<?php echo $lang_texte_shopping_day; ?>
							</div>
						</div>
						
						<div class="col-xs-12 col-sm-12 col-md-12" style="text-align:center;">
							<p class="titre_infos titre_infos_grand"><?php echo $lang_horaires_tarifs; ?></p>
							<span class="plus plus_infos_pratiques" id="infos_2" style="padding:3px 9px;">
								+
							</span>
							
							<div id="horaires_tarifs_2" style="display:none;">
							
								<?php $outlets = get_outlets_par_service(2);
								foreach ($outlets as $outlet)
								{
									$nom = explode('_',$outlet['code_outlet']);
									$tarif = $outlet['tarif_outlet'] + $outlet['supplement'];?>
									<div class="row formules_outlet" style="margin-bottom:20px;">
										<p class="titre_infos titre_infos_grand"><?php echo $nom[1]; ?></p>
										
										<div class="col-xs-12 col-sm-12 col-md-12 bloc_infos_pratiques" id="infos_pratiques_<?php echo $outlet['id_outlet']; ?>" style="padding:0;padding-bottom:10px;">
											<div class="row" style="text-align:left;padding:0 30px;">
												<div class="col-xs-4 col-sm-4 col-md-4" style="padding:0;">
													<span style="text-decoration:underline;"><?php echo $lang_depart;?></span> 
												</div>
												
												<div class="col-xs-8 col-sm-8 col-md-8" style="padding:0;">
													<span style="font-weight:bold;">Strasbourg</span> 9h00
												</div>
											</div>
											
											<?php
											$duree_trajet = $outlet['duree_trajet'];
											$duree = explode(':',$outlet['duree_trajet']);
											$heure_retour = date('c',mktime(9+$duree[0],$duree[1],0)+60*60*5);
											$heure_retour_outlet = new DateTime($heure_retour);
											$heure_retour_stras = date('c',mktime(9+2*$duree[0],2*$duree[1],0)+60*60*5);
											$heure_retour_strasbourg = new DateTime($heure_retour_stras);?>
											
											<div class="row" style="margin-top:10px;text-align:left;padding:0 30px;">
												<div class="col-xs-4 col-sm-4 col-md-4" style="padding:0;">
													<span style="text-decoration:underline;"><?php echo $lang_retour;?></span>
												</div>
												
												<div class="col-xs-8 col-sm-8 col-md-8" style="padding:0;">
													<span style="font-weight:bold;">Outlet</span> <?php echo $heure_retour_outlet->format('H\hi'); ?>
												</div>
											</div>
											
											<div class="row" style="padding:0 30px;">										
												<div class="col-xs-8 col-xs-offset-4 col-sm-8 col-sm-offset-4 col-md-8 col-md-offset-4" style="text-align:left;padding:0;">
													<span style="font-weight:bold;">Strasbourg</span> <?php echo $heure_retour_strasbourg->format('H\hi'); ?>
												</div>
											</div>
											
											<div class="row" style="margin-top:10px;padding:0 30px;">
												<p class="col-xs-12 col-sm-12 col-md-12 titre_infos" style="font-size:12px;padding:0;"><span style="text-transform:uppercase;"><?php echo $lang_tarif_minimum; ?></span> <?php echo $lang_aller_retour; ?></p>
												
												<div class="row" style="text-align:left;">
													<div class="col-xs-8 col-sm-8 col-md-8" style="padding:0;">
														<span style="font-weight:bold;"><?php echo $lang_tarif_par_personne;?></span>
													</div>
													
													<div class="col-xs-4 col-sm-4 col-md-4" style="padding:0;text-align:right;">
														<?php echo $tarif.' €'; ?>
													</div>
												</div>
												
												<div class="row" style="text-align:left;">
													<?php echo $lang_soit_pour; ?>
												</div>
												
												<div class="row" style="text-align:left;">
													<div class="col-xs-8 col-sm-8 col-md-8" style="padding:0;">
														<span style="font-weight:bold;">4 <?php echo $lang_personnes;?></span>
													</div>
													
													<div class="col-xs-4 col-sm-4 col-md-4" style="padding:0;text-align:right;">
														<?php echo 4*$tarif.' €'; ?>
													</div>
												</div>
												
												<div class="row" style="text-align:left;">
													<div class="col-xs-8 col-sm-8 col-md-8" style="padding:0;">
														<span style="font-weight:bold;">8 <?php echo $lang_personnes;?></span>
													</div>
													
													<div class="col-xs-4 col-sm-4 col-md-4" style="padding:0;text-align:right;">
														<?php echo 8*$tarif.' €'; ?>
													</div>
												</div>
												
											</div>
											
										</div>
									</div><?php
								}?>
							</div>
						</div>
						
					</div>
					
					<div class="col-xs-12 col-sm-6 col-md-6 services">
					
						<?php $service = get_service(3); ?>
					
						<div class="col-xs-12 col-sm-12 col-md-12" style="text-align:center;">
							<div style="display:inline-block;position:relative;">
								<img src="images/team.png"> 
								<img src="images/picto_team_building.png" class="picto_sur_image picto_sur_image_droite">
							</div><br>
						</div>
						
						<div class="col-xs-12 col-sm-12 col-md-12 texte_formules texte_affiche texte_formules_services" style="padding:15px;">
							<?php echo $lang_texte_team_building; ?>
						</div>
						
						<div class="col-xs-12 col-sm-12 col-md-12" style="padding-bottom:20px;">
							<p class="titre_infos titre_infos_grand"><?php echo $lang_entre_amis; ?></p>
							<span class="plus plus_services plus_services_droite" id="service_3" style="padding:3px 9px;">
								+
							</span>
						</div>
						
						<div class="col-xs-12 col-sm-12 col-md-12" id="infos_service_3" style="padding-bottom:20px;display:none;">
							
							<div class="col-xs-12 col-sm-6 col-md-6" style="padding:0 30px;">
								<p class="titre_infos"><span style="text-transform:uppercase;"><?php echo $lang_titre_informations; ?></span></p>
								<div class="row">
									<div class="col-xs-3 col-sm-3 col-md-3" style="padding:0;">
										<span style="text-decoration:underline;"><?php echo $lang_depart; ?></span> 
									</div>
									<div class="col-xs-9 col-sm-9 col-md-9" style="padding:0;">
										<span style="font-weight:bold;">Strasbourg</span> 9h00
									</div>
								</div>
								<div class="row">
									<div class="col-xs-3 col-sm-3 col-md-3" style="padding:0;">
										<span style="text-decoration:underline;"><?php echo $lang_retour; ?></span> 
									</div>
									<div class="col-xs-9 col-sm-9 col-md-9" style="padding:0;">
										<span style="font-weight:bold;">Outlet</span> 16h00
									</div>
								</div>
								<div class="row">
									<div class="col-xs-9 col-xs-offset-3 col-sm-9 col-sm-offset-3 col-md-9 col-md-offset-3" style="padding:0;">
										<span style="font-weight:bold;">Strasbourg</span> 18h00
									</div>
								</div>
								
							</div>
							
							<div class="col-xs-12 col-sm-6 col-md-6" style="padding:0 30px;">
								<p class="col-xs-12 col-sm-12 col-md-12 titre_infos" style="font-size:12px;padding:0;"><span style="text-transform:uppercase;"><?php echo $lang_supplement; ?></span> <?php echo $lang_aller_retour; ?></p>
								
								<div class="row" style="text-align:left;">
									<div class="col-xs-8 col-sm-8 col-md-8" style="padding:0;">
										<span style="font-weight:bold;"><?php echo $lang_tarif_par_personne;?></span>
									</div>
									
									<div class="col-xs-4 col-sm-4 col-md-4" style="padding:0;text-align:right;">
										<?php echo $service['supplement'].' €'; ?>
									</div>
								</div>
								
								<div class="row" style="text-align:left;">
									<?php echo $lang_soit_pour; ?>
								</div>
								
								<div class="row" style="text-align:left;">
									<div class="col-xs-8 col-sm-8 col-md-8" style="padding:0;">
										<span style="font-weight:bold;">4 <?php echo $lang_personnes;?></span>
									</div>
									
									<div class="col-xs-4 col-sm-4 col-md-4" style="padding:0;text-align:right;">
										<?php echo 4*$service['supplement'].' €'; ?>
									</div>
								</div>
								
								<div class="row" style="text-align:left;">
									<div class="col-xs-8 col-sm-8 col-md-8" style="padding:0;">
										<span style="font-weight:bold;">8 <?php echo $lang_personnes;?></span>
									</div>
									
									<div class="col-xs-4 col-sm-4 col-md-4" style="padding:0;text-align:right;">
										<?php echo 8*$service['supplement'].' €'; ?>
									</div>
								</div>
								
							</div>
							
						</div>
						
						<?php $service = get_service(4); ?>
					
						<div class="col-xs-12 col-sm-12 col-md-12" style="text-align:center;">
							<div style="display:inline-block;position:relative;">
								<img src="images/team.png"> 
							</div><br>
						</div>
						
						<div class="col-xs-12 col-sm-12 col-md-12" style="padding-bottom:20px;">
							<p class="titre_infos titre_infos_grand"><?php echo $lang_entre_collegues; ?></p>
							<span class="plus plus_services plus_services_droite" id="service_4" style="padding:3px 9px;">
								+
							</span>
						</div>
						
						<div class="col-xs-12 col-sm-12 col-md-12" id="infos_service_4" style="padding-bottom:20px;display:none;">
							
							<div class="col-xs-12 col-sm-6 col-md-6" style="padding:0 30px;">
								<p class="titre_infos"><span style="text-transform:uppercase;"><?php echo $lang_titre_informations; ?></span></p>
								<div class="row">
									<div class="col-xs-3 col-sm-3 col-md-3" style="padding:0;">
										<span style="text-decoration:underline;"><?php echo $lang_depart; ?></span> 
									</div>
									<div class="col-xs-9 col-sm-9 col-md-9" style="padding:0;">
										<span style="font-weight:bold;">Strasbourg</span> 9h00
									</div>
								</div>
								<div class="row">
									<div class="col-xs-3 col-sm-3 col-md-3" style="padding:0;">
										<span style="text-decoration:underline;"><?php echo $lang_retour; ?></span> 
									</div>
									<div class="col-xs-9 col-sm-9 col-md-9" style="padding:0;">
										<span style="font-weight:bold;">Outlet</span> 16h00
									</div>
								</div>
								<div class="row">
									<div class="col-xs-9 col-xs-offset-3 col-sm-9 col-sm-offset-3 col-md-9 col-md-offset-3" style="padding:0;">
										<span style="font-weight:bold;">Strasbourg</span> 18h00
									</div>
								</div>
								
							</div>
							
							<div class="col-xs-12 col-sm-6 col-md-6" style="padding:0 30px;">
								<p class="col-xs-12 col-sm-12 col-md-12 titre_infos" style="font-size:12px;padding:0;"><span style="text-transform:uppercase;"><?php echo $lang_supplement; ?></span> <?php echo $lang_aller_retour; ?></p>
								
								<div class="row" style="text-align:left;">
									<div class="col-xs-8 col-sm-8 col-md-8" style="padding:0;">
										<span style="font-weight:bold;"><?php echo $lang_tarif_par_personne;?></span>
									</div>
									
									<div class="col-xs-4 col-sm-4 col-md-4" style="padding:0;text-align:right;">
										<?php echo $service['supplement'].' €'; ?>
									</div>
								</div>
								
								<div class="row" style="text-align:left;">
									<?php echo $lang_soit_pour; ?>
								</div>
								
								<div class="row" style="text-align:left;">
									<div class="col-xs-8 col-sm-8 col-md-8" style="padding:0;">
										<span style="font-weight:bold;">4 <?php echo $lang_personnes;?></span>
									</div>
									
									<div class="col-xs-4 col-sm-4 col-md-4" style="padding:0;text-align:right;">
										<?php echo 4*$service['supplement'].' €'; ?>
									</div>
								</div>
								
								<div class="row" style="text-align:left;">
									<div class="col-xs-8 col-sm-8 col-md-8" style="padding:0;">
										<span style="font-weight:bold;">8 <?php echo $lang_personnes;?></span>
									</div>
									
									<div class="col-xs-4 col-sm-4 col-md-4" style="padding:0;text-align:right;">
										<?php echo 8*$service['supplement'].' €'; ?>
									</div>
								</div>
								
							</div>
							
						</div>
						
						<?php $service = get_service(5); ?>
					
						<div class="col-xs-12 col-sm-12 col-md-12" style="text-align:center;">
							<div style="display:inline-block;position:relative;">
								<img src="images/team.png"> 
							</div><br>
						</div>
						
						<div class="col-xs-12 col-sm-12 col-md-12" style="padding-bottom:20px;">
							<p class="titre_infos titre_infos_grand"><?php echo $lang_cohesion_equipe; ?></p>
							<span class="plus plus_services plus_services_droite" id="service_5" style="padding:3px 9px;">
								+
							</span>
						</div>
						
						<div class="col-xs-12 col-sm-12 col-md-12" id="infos_service_5" style="padding-bottom:20px;display:none;">
							
							<div class="col-xs-12 col-sm-6 col-md-6" style="padding:0 30px;">
								<p class="titre_infos"><span style="text-transform:uppercase;"><?php echo $lang_titre_informations; ?></span></p>
								<div class="row">
									<div class="col-xs-3 col-sm-3 col-md-3" style="padding:0;">
										<span style="text-decoration:underline;"><?php echo $lang_depart; ?></span> 
									</div>
									<div class="col-xs-9 col-sm-9 col-md-9" style="padding:0;">
										<span style="font-weight:bold;">Strasbourg</span> 9h00
									</div>
								</div>
								<div class="row">
									<div class="col-xs-3 col-sm-3 col-md-3" style="padding:0;">
										<span style="text-decoration:underline;"><?php echo $lang_retour; ?></span> 
									</div>
									<div class="col-xs-9 col-sm-9 col-md-9" style="padding:0;">
										<span style="font-weight:bold;">Outlet</span> 16h00
									</div>
								</div>
								<div class="row">
									<div class="col-xs-9 col-xs-offset-3 col-sm-9 col-sm-offset-3 col-md-9 col-md-offset-3" style="padding:0;">
										<span style="font-weight:bold;">Strasbourg</span> 18h00
									</div>
								</div>
								
							</div>
							
							<div class="col-xs-12 col-sm-6 col-md-6" style="padding:0 30px;">
								<p class="col-xs-12 col-sm-12 col-md-12 titre_infos" style="font-size:12px;padding:0;"><span style="text-transform:uppercase;"><?php echo $lang_supplement; ?></span> <?php echo $lang_aller_retour; ?></p>
								
								<div class="row" style="text-align:left;">
									<div class="col-xs-8 col-sm-8 col-md-8" style="padding:0;">
										<span style="font-weight:bold;"><?php echo $lang_tarif_par_personne;?></span>
									</div>
									
									<div class="col-xs-4 col-sm-4 col-md-4" style="padding:0;text-align:right;">
										<?php echo $service['supplement'].' €'; ?>
									</div>
								</div>
								
								<div class="row" style="text-align:left;">
									<?php echo $lang_soit_pour; ?>
								</div>
								
								<div class="row" style="text-align:left;">
									<div class="col-xs-8 col-sm-8 col-md-8" style="padding:0;">
										<span style="font-weight:bold;">4 <?php echo $lang_personnes;?></span>
									</div>
									
									<div class="col-xs-4 col-sm-4 col-md-4" style="padding:0;text-align:right;">
										<?php echo 4*$service['supplement'].' €'; ?>
									</div>
								</div>
								
								<div class="row" style="text-align:left;">
									<div class="col-xs-8 col-sm-8 col-md-8" style="padding:0;">
										<span style="font-weight:bold;">8 <?php echo $lang_personnes;?></span>
									</div>
									
									<div class="col-xs-4 col-sm-4 col-md-4" style="padding:0;text-align:right;">
										<?php echo 8*$service['supplement'].' €'; ?>
									</div>
								</div>
								
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