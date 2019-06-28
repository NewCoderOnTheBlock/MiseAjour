<?php
	require_once('./includes/init_functions.php');
		
	// Fonction permettant de gérer l'affichage des petits 
	// panneau en fonction des champs déjà remplis
	function get_display($v)
	{
		if (!empty($v))
		{
			return "style=\"display:none;\"";
		}
		else
		{
			return "";
		}
	}
	
?>
<html>
	<head>
		<title><?php echo $lang_titre_accueil.' :: '.$lang_titre_main; ?></title>
		
		<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
		<meta name="Language" content="fr" />
		<meta name="viewport" content="width=device-width, initial-scale=1">		
		
		<link rel="stylesheet" type="text/css" href="styles/base.css" media="all" />
		<link rel="stylesheet" type="text/css" href="styles/style.css" media="screen" />
		<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
		
		<script type="text/javascript" src="scripts/accueil.js"></script>
		
		<!-- Chargement de JQuery et Jquery UI depuis Google API -->
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
		<link rel="stylesheet" type="text/css" href="styles/ui-lightness/jquery-ui.css" media="all" />
		<script type="text/javascript" src="scripts/jssor.slider.mini.js"></script>
		<script type="text/javascript" src="scripts/slider.js"></script>
		
		<!-- Gestion de l'affichage des données supplémentaires liées au lieu domicile ou non -->
		<script type="text/javascript">
			
			function toggle_fenetre_details(id_trajet){
				var element = document.getElementById("details_"+id_trajet);
				
				if (element.style.display == "block"){
					element.style.display = "none";
				}else{
					element.style.display = "block";
				}
			}
			
			function show_domicile_info(elem, id){
				var select = elem;
				var div = document.getElementById("info_dom_" + id);
				
				if (select.options[select.selectedIndex].value == 4){
					div.style.display = '';
				}else{
					div.style.display = 'none';
				}
				
			}
			
			/* JQuery : UI */
			/*$(function() {
				$( "#liste_outlet" ).accordion({ autoHeight: false, clearStyle: true });
			});*/
			
		</script>
		
	</head> 
	<body> 
	
		<div id="global">
			<!-- On insère le header + le menu -->
			<?php require_once('./includes/include_entete_menu.php'); ?>
			
			<!-- Le contenu -->
			<div id="contenu">

				<div class="row" style="text-align:center;position:relative;">
					<?php require_once('./includes/slider.php'); ?>
					<div class="texte_accueil">
						<?php echo $lang_texte_info_accueil; ?>
					</div>
				</div>
				
				<div class="row formules">
					<div class="col-xs-12 col-sm-6 col-md-3">
						<div class="col-xs-12 col-sm-12 col-md-12">
							<div style="display:inline-block;position:relative;">
								<img src="images/photo_centre_1_gris.png">
								<img src="images/picto_after_work_blanc.png" class="picto_sur_image picto_blanc">
							</div><br>
							<span class="plus plus_formules" id="formule_1">
								+
							</span>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12 texte_formules" id="texte_formule_1">
							<?php echo $lang_texte_after_work; ?>
						</div>
					</div>
					
					<div class="col-xs-12 col-sm-6 col-md-3">
						<div class="col-xs-12 col-sm-12 col-md-12">
							<div style="display:inline-block;position:relative;">
								<img src="images/photo_centre_2_gris.png">
								<img src="images/picto_shopping_day_blanc.png" class="picto_sur_image picto_blanc">
							</div><br>
							<span class="plus plus_formules" id="formule_2">
								+
							</span>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12 texte_formules" id="texte_formule_2">
							<?php echo $lang_texte_shopping_day; ?>
						</div>
					</div>
					
					<div class="col-xs-12 col-sm-6 col-md-3">
						<div class="col-xs-12 col-sm-12 col-md-12">
							<div style="display:inline-block;position:relative;">
								<img src="images/photo_centre_3_gris.png">
								<img src="images/picto_team_building_blanc.png" class="picto_sur_image picto_blanc">
							</div><br>
							<span class="plus plus_formules" id="formule_3">
								+
							</span>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12 texte_formules" id="texte_formule_3">
							<?php echo $lang_texte_team_building; ?>
						</div>
					</div>
					
					<div class="col-xs-12 col-sm-6 col-md-3">
						<div class="col-xs-12 col-sm-12 col-md-12">
							<div style="display:inline-block;position:relative;">
								<img src="images/photo_centre_4_gris.png">
								<img src="images/picto_soldes.png" class="picto_sur_image picto_blanc">
							</div><br>
							<span class="plus plus_formules" id="formule_4">
								+
							</span>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12 texte_formules" id="texte_formule_4">
							<?php echo $lang_texte_soldes; ?>
						</div>
					</div>
				</div>

				<div class="row" id="liste_outlet">
					<?php
					$lesOutlet = get_list_outlet();
					foreach ($lesOutlet as $leOutlet)
					{?>
						<div class="col-xs-12 col-sm-6 col-md-3">
							<div class="col-xs-12 col-sm-12 col-md-12">
								<div class="col-xs-12 col-sm-12 col-md-12" style="display:inline-block;padding:15px;">
									<img src="images/logo_<?=$leOutlet["id_outlet"]?>.png">
								</div>
								<p class="col-xs-12 col-sm-12 col-md-12" style="text-transform:uppercase;font-size:12px;padding:0;height:2.5em;"><?php echo $leOutlet['libelle_outlet'];?></p>
							</div>
							
							<div class="col-xs-12 col-sm-12 col-md-12 infos_pratiques">
								<p class="titre_infos titre_infos_grand"><?php echo $lang_infos_pratiques; ?></p>
								
								<span class="plus plus_infos_pratiques" style="cursor:pointer;" id="plus_<?php echo $leOutlet['id_outlet']; ?>"> + </span>
								
								<div class="col-xs-12 col-sm-12 col-md-12 bloc_infos_pratiques" id="infos_pratiques_<?php echo $leOutlet['id_outlet']; ?>" style="padding:0;padding-bottom:10px;">
									<div class="col-xs-12 col-sm-12 col-md-12" style="margin-top:10px;font-size:12px;">
										<a href="http://<?php echo $leOutlet['lien_outlet'];?>"><?php echo $leOutlet['lien_outlet'];?></a>
									</div>
									
									<div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 horaires" style="margin-top:20px;">
										<p class="col-xs-12 col-sm-12 col-md-12 titre_infos" style="font-size:12px;padding:0;"><?php echo $lang_horaires; ?></p>
										<?php switch($leOutlet['id_outlet'])
										{
											case 1:?>
												<div class="col-xs-12 col-sm-12 col-md-12">
													<div class="col-xs-8 col-sm-8 col-md-8 horaires_jours">
														<?php echo $lang_table_jour[1]. ' - '.$lang_table_jour[5]; ?>
													</div>
													<div class="col-xs-4 col-sm-4 col-md-4 horaires_heures">
														10h - 20h
													</div>
												</div>
												<div class="col-xs-12 col-sm-12 col-md-12">
													<div class="col-xs-8 col-sm-8 col-md-8 horaires_jours">
														<?php echo $lang_table_jour[6]; ?>
													</div>
													<div class="col-xs-4 col-sm-4 col-md-4 horaires_heures">
														9h - 20h
													</div>
												</div><?php
											break;
											
											case 2:?>
												<div class="col-xs-12 col-sm-12 col-md-12">
													<div class="col-xs-8 col-sm-8 col-md-8 horaires_jours">
														<?php echo $lang_table_jour[1]. ' - '.$lang_table_jour[5]; ?>
													</div>
													<div class="col-xs-4 col-sm-4 col-md-4 horaires_heures">
														10h - 19h
													</div>
												</div><?php
											break;
											
											case 3:?>
												<div class="col-xs-12 col-sm-12 col-md-12">
													<div class="col-xs-8 col-sm-8 col-md-8 horaires_jours">
														<?php echo $lang_table_jour[1]. ' - '.$lang_table_jour[6]; ?>
													</div>
													<div class="col-xs-4 col-sm-4 col-md-4 horaires_heures">
														10h - 19h
													</div>
												</div><?php
											break;
											
											case 4:?>
												<div class="col-xs-12 col-sm-12 col-md-12">
													<div class="col-xs-8 col-sm-8 col-md-8 horaires_jours">
														<?php echo $lang_table_jour[1]. ' - '.$lang_table_jour[6]; ?>
													</div>
													<div class="col-xs-4 col-sm-4 col-md-4 horaires_heures">
														9h - 19h
													</div>
												</div><?php
											break;
										}?>
									</div><br>
									
									<div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 adresse">
										<p class="titre_infos col-xs-12 col-sm-12 col-md-12" style="font-size:12px;padding:0;"><?php echo $lang_adresse_centre; ?></p>
										<p><?php echo utf8_encode($leOutlet['adresse_outlet']);?></p>
										<p><a href="<?php echo $leOutlet['lien_map']; ?>"><img src="images/maps.png" style="width:auto;margin-right:5px;margin-bottom:3px;"><?php echo $lang_voir_map;?></a></p>
									</div>
								</div>
							</div>
							
							<div class="col-xs-12 col-sm-12 col-md-12 services">
								<p class="titre_infos titre_infos_grand titre_infos_grand_services" style="margin:0;"><?php echo $lang_services;?></p>
								
								<span class="plus plus_services" style="cursor:pointer;" id="plus_services_<?php echo $leOutlet['id_outlet']; ?>"> - </span>
								
								<div class="col-xs-12 col-sm-12 col-md-12 bloc_services" id="services_<?php echo $leOutlet['id_outlet']; ?>" style="padding:0;">
									<?php $services = get_services($leOutlet['id_outlet']);
									$i = 0;
									$termine = false;
									while ($i < count($services) && !$termine)
									{
										$id_service = $services[$i]['id_service'];
										$nom_service = $services[$i]['nom_service'];
										$supplement = $services[$i]['supplement'];
										$name = $services[$i]['name'];
										if ($id_service == 3 || $id_service == 4 || $id_service == 5)
										{?>
											<div class="col-xs-12 col-sm-12 col-md-12">
												<div style="display:inline-block;position:relative;">
													<img src="images/photo_centre_3.png">
													<img src="images/picto_team_building.png" class="picto_sur_image">
													<div class="div_texte"><?php echo $nom_service; ?></div>
													<div class="div_prix"><?php echo $lang_a_partir_de.' <span style="font-weight:bold;">'.($leOutlet['tarif_outlet']+$supplement). ' €</span>';?></div>
												</div>
											</div><?php
											$termine = true;
										}
										else
										{?>
											<div class="col-xs-12 col-sm-12 col-md-12">
												<div style="display:inline-block;position:relative;">
													<img src="images/photo_centre_<?php echo $id_service; ?>.png">
													<img src="images/picto_<?php echo $name; ?>.png" class="picto_sur_image">
													<div class="div_texte"><?php echo $nom_service; ?></div>
													<div class="div_prix"><?php echo $lang_a_partir_de.' <span style="font-weight:bold;">'.($leOutlet['tarif_outlet']+$supplement). ' €</span>';?></div>
												</div>
											</div><?php
										}
										$i++;
									}								
									?>
								</div>
							</div>
						</div>
					<?php
					}
					?>
					
				</div>
				
			</div>
			
			<!-- Le pied de page -->
			<?php require_once('./includes/include_pied_de_page.php'); ?>
		</div>
		
	</body> 
</html>