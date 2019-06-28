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
		
		<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
		<meta name="Language" content="fr" />		
		
		<link rel="stylesheet" type="text/css" href="styles/base.css" media="all" />
		<link rel="stylesheet" type="text/css" href="styles/style.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="styles/calendrier.css" media="screen" />
		<script type="text/javascript" src="scripts/calendrier.js"></script>
		<script type="text/javascript" src="scripts/verification_formulaire.js"></script>
		
		<script type="text/javascript"
			src="http://maps.googleapis.com/maps/api/js?key=AIzaSyB7P6dmOYSXqZq9IWZUnr5NGyqXJTvBM5w&sensor=false">
		</script>
		
		<!-- Gestion de l'affichage des données supplémentaires liées au lieu domicile ou non -->
		<script type="text/javascript">
		
			function show_domicile_info(type){
				var select = document.getElementById("select_lieu_" + type);
				var div = document.getElementById("info_dom_" + type);
				
				if (select.options[select.selectedIndex].value == 4){
					div.style.display = '';
				}else{
					div.style.display = 'none';
				}
				
			}
			
			function verif_champ_vide(id){
				var champ = document.getElementById(id).value;
				var span = document.getElementById("error_"+id);
				
				if(champ == ""){
					span.style.display = '';
				}else{
					span.style.display = 'none';
				}
			}
			
		</script>
		
	</head> 
	<body> 
	
		<div id="global">
			<!-- On insère le header + le menu -->
			<?php require_once('includes/include_entete_menu.php'); ?>
			
			<!-- Le contenu -->
			<div id="contenu">
				<!-- Titre de la page -->
				<h1><?php echo $lang_titre_accueil; ?></h1>
				
				<?php
					// Contenu de la page
					echo '
					'.$lang_effectuez_reservation.'
					<form name="form_reserv" method="post" action="info_client.php" id="form_reservation">
						
						<fieldset class="spaced_fieldset">
							<legend>'.$lang_le_trajet.'</legend>
							<table class="table_reserv">
							
								<tr>
									<th><label for="lbl_jour_trajet">'.$lang_date.'</label></th>
									<td>
										<input type="button" id="lbl_jour_trajet" style="background-color:#FFF" value="Sélectionner une date" class="pointer" onclick="ds_sh(\'lbl_jour_trajet\', \'ds_conclass1\', \'ds_calclass1\', \'1\', \''.$_SESSION['lang'].'\');ds_sh(\'lbl_jour_trajet\', \'ds_conclass1\', \'ds_calclass2\', \'2\', \''.$_SESSION['lang'].'\');" />
										<input type="button" id="lbl_jour" style="background:none;border:none;background-image:url(\'http://alsace-navette.com/aeroport/images/calendar.png\');width:16px;height:16px;" class="pointer" onclick="ds_sh(\'lbl_jour_trajet\', \'ds_conclass1\', \'ds_calclass1\', \'1\', \''.$_SESSION['lang'].'\');ds_sh(\'lbl_jour_trajet\', \'ds_conclass1\', \'ds_calclass2\', \'2\', \''.$_SESSION['lang'].'\');" />

										<!-- Valeurs à récupérer -->
										
										<input type="hidden" name="jour_trajet" id="jour_trajet" value="" />
										<input type="hidden" name="jour_trajet_long" id="jour_trajet_long" value="" />

										<table class="ds_box" cellpadding="0" cellspacing="0" id="ds_conclass1" style="display: none;">
											<tr>
												<td id="ds_calclass1" valign="top"></td>
												<td id="ds_calclass2" valign="top"></td>
											</tr>
										</table>
										
									</td>
								</tr>
								
								<tr>
									<th><label for="select_type_vehicule">'.$lang_type_vehicule.'</label></th>
									<td>
										<select name="select_type_vehicule" id="select_type_vehicule">
										
											<option value="4">4 '.$lang_places.'</option>
											<option value="8">8 '.$lang_places.'</option>										
									
										</select>
									
									</td>
								</tr>
								
								<tr>
									<th><label for="select_heure_trajet">'.$lang_heure_aller.'</label></th>
									<td>

										<div id="div_horaire_demande_trajet">
										
											<select name="select_heure_trajet" id="select_heure_trajet">
											';
												for ($i=0;$i<24;$i++){
													echo '<option value="'.$i.'">'.sprintf('%02d', $i).'</option>';
												}
											echo '
											</select>
											:
											<select name="select_minute_trajet" id="select_minute_trajet">
											';
												for ($i=0;$i<60;$i=$i+10){
													echo '<option value="'.$i.'">'.sprintf('%02d', $i).'</option>';
												}
											echo '
											</select>
										
										</div>
										
									</td>
								</tr>
								
								<tr>
									<th><label for="select_lieu_provenance">'.$lang_lieu_aller.'</label></th>
									<td>
										<select name="select_lieu_provenance" id="select_lieu_provenance" onchange="show_domicile_info(\'provenance\')">';
										
										$lst_lieu = get_list_lieu();
										foreach ($lst_lieu as $v) {
											echo '<option value="'.($v['id_lieu']).'">'.$v['nom_lieu'].'</option>';
										}
										
										echo '
										</select>
									</td>
								</tr>
								
								<tr id="info_dom_provenance" style="display:none">
									<th></th>
									
									<td>
										<table>
											<th style="text-align:left;" colspan="2">'.$lang_info_complementaires.'</th>
											<tr>
												<td><label for="txt_ville_compl_provenance">'.$lang_ville.'</label></td>
												<td><input class="dotted_input" type="text" id="txt_ville_compl_provenance" name="txt_ville_compl_provenance" /></td>
											</tr>
											<tr>
												<td><label for="txt_cp_compl_provenance">'.$lang_code_postal.'</label></td>
												<td><input class="dotted_input" type="text" id="txt_cp_compl_provenance" name="txt_cp_compl_provenance" /></td>
											</tr>
											<tr>
												<td><label for="txt_adresse_compl_provenance">'.$lang_adresse.'</label></td>
												<td><input class="dotted_input" type="text" id="txt_adresse_compl_provenance" name="txt_adresse_compl_provenance" /></td>
											</tr>
										</table>
									</td>
								</tr>
								
								<tr>
									<th><label for="select_lieu_destination">'.$lang_lieu_retour.'</label></th>
									<td>
										<select name="select_lieu_destination" id="select_lieu_destination" onchange="show_domicile_info(\'destination\')">';
										
										$lst_lieu = get_list_lieu();
										foreach ($lst_lieu as $v) {
											echo '<option value="'.($v['id_lieu']).'">'.$v['nom_lieu'].'</option>';
										}
										
										echo '
										</select>
									</td>
								</tr>
								
								<tr id="info_dom_destination" style="display:none">
									<th></th>
									
									<td>
										<table>
											<th style="text-align:left;" colspan="2">'.$lang_info_complementaires.' :</th>
											<tr>
												<td><label for="txt_ville_compl_destination">'.$lang_ville.'</label></td>
												<td><input class="dotted_input" type="text" id="txt_ville_compl_destination" name="txt_ville_compl_destination" onchange="document.getElementById(\'verification_destination\').innerHTML=\'\';" /></td>
											</tr>
											<tr>
												<td><label for="txt_cp_compl_destination">'.$lang_code_postal.'</label></td>
												<td><input class="dotted_input" type="text" id="txt_cp_compl_destination" name="txt_cp_compl_destination" /></td>
											</tr>
											<tr>
												<td><label for="txt_adresse_compl_destination">'.$lang_adresse.'</label></td>
												<td><input class="dotted_input" type="text" id="txt_adresse_compl_destination" name="txt_adresse_compl_destination" /></td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
							
						</fieldset>
						
						<fieldset class="spaced_fieldset">
							<legend>'.$lang_validation.'</legend>
							
							<table class="table_reserv">
								<tr>
									<th>'.$lang_demande_particulière.'</th>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td colspan="2" style="text-align:center;"><textarea rows="4" cols="50" name="commentaire" id="commentaire"></textarea></td>
								</tr>
								<tr>
									<td colspan="2" style="text-align:center;"><input type="button" id="bt_valider" name="bt_valider" value="'.$lang_etape_suivante.'" onclick="verif_formulaire();"/></td>
								</tr>
							</table>
							
						</fieldset>
						* : '.$lang_champ_obligatoire.'<br />
						** : '.$lang_champ_semi_obligatoire.'<br />
						
						<input type="hidden" name="distance" id="distance" value="" />
						<input type="hidden" name="duree" id="duree" value="" />
					</form>';
				?>
			</div>
			
			<!-- Le pied de page -->
			<?php require_once('./includes/include_pied_de_page.php'); ?>
		</div>
		
	</body> 
</html>