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
			
			function show_div_horaire_aller(type){
				var select_fixe = document.getElementById("div_horaire_fixe_aller");
				var select_demande = document.getElementById("div_horaire_demande_aller");
				
				if (type == "fixe"){
					select_fixe.style.display = '';
					select_demande.style.display = 'none';
				}else{
					select_fixe.style.display = 'none';
					select_demande.style.display = '';
				}
				
			}
			
			function show_div_horaire_retour(type){
				var select_fixe = document.getElementById("div_horaire_fixe_retour");
				var select_demande = document.getElementById("div_horaire_demande_retour");
				
				if (type == "fixe"){
					select_fixe.style.display = '';
					select_demande.style.display = 'none';
				}else{
					select_fixe.style.display = 'none';
					select_demande.style.display = '';
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
			<?php require_once('./includes/include_entete_menu.php'); ?>
			
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
							<legend>'.$lang_le_trajet.' : '.$lang_aller.'</legend>
							<table class="table_reserv">
							
								<tr>
									<th><label for="lbl_jour_aller">'.$lang_date_aller.'</label></th>
									<td>
										<input type="button" id="lbl_jour_aller" style="background-color:#FFF" value="Sélectionner une date" class="pointer" onclick="document.getElementById(\'ds_conclass2\').style.display=\'none\';ds_sh(\'lbl_jour_aller\', \'ds_conclass1\', \'ds_calclass1\', \'1\', \''.$_SESSION['lang'].'\');ds_sh(\'lbl_jour_aller\', \'ds_conclass1\', \'ds_calclass2\', \'2\', \''.$_SESSION['lang'].'\');" />
										<input type="button" id="lbl_jour" style="background:none;border:none;background-image:url(\'http://alsace-navette.com/aeroport/images/calendar.png\');width:16px;height:16px;" class="pointer" onclick="document.getElementById(\'ds_conclass2\').style.display=\'none\';ds_sh(\'lbl_jour_aller\', \'ds_conclass1\', \'ds_calclass1\', \'1\', \''.$_SESSION['lang'].'\');ds_sh(\'lbl_jour_aller\', \'ds_conclass1\', \'ds_calclass2\', \'2\', \''.$_SESSION['lang'].'\');" />

										<!-- Valeurs à récupérer -->
										
										<input type="hidden" name="jour_aller" id="jour_aller" value="" />
										<input type="hidden" name="jour_aller_long" id="jour_aller_long" value="" />


										<table class="ds_box" cellpadding="0" cellspacing="0" id="ds_conclass1" style="display: none;">
											<tr>
												<td id="ds_calclass1" valign="top"></td>
												<td id="ds_calclass2" valign="top"></td>
											</tr>
										</table>
										
									</td>
								</tr>
								
								<tr>
									<th><label for="select_heure_aller">'.$lang_heure_aller.'</label></th>
									<td>
										<input type="radio" name="radio_heure_aller" value="fixe" checked onclick="show_div_horaire_aller(\'fixe\')">'.$lang_horaire_fixe.'<br />
										<input type="radio" name="radio_heure_aller" value="demande" onclick="show_div_horaire_aller(\'demande\')">'.$lang_horaire_demande.'<br /><br />
										
										<div id="div_horaire_fixe_aller">
											<select name="select_heure_aller_fixe" id="select_heure_aller_fixe">';
											$lst_hor = get_list_horaires_fixes("aller");
											
											foreach ($lst_hor as $k => $v) {
												echo '<option value="'.$v.'">'.$v.'</option>';
											}
											
											echo '
											</select>
										</div>
										
										<div id="div_horaire_demande_aller" style="display:none;">
											'.$lang_majoration_horaire_demande.' '.get_value_of_option("maj_demande").' € <br /><br />
											<select name="select_heure_aller_demande" id="select_heure_aller_demande">
											';
												for ($i=0;$i<24;$i++){
													echo '<option value="'.$i.'">'.sprintf('%02d', $i).'</option>';
												}
											echo '
											</select>
											:
											<select name="select_minute_aller_demande" id="select_minute_aller_demande">
											';
												for ($i=0;$i<60;$i=$i+10){
													echo '<option value="'.$i.'">'.sprintf('%02d', $i).'</option>';
												}
											echo '
											</select>
										
										</div><br />
										( '.$lang_duree_estimee.' : 45 '.$lang_minutes.' )
									</td>
								</tr>
								
								<tr>
									<th><label for="txt_lieu_aller">'.$lang_lieu_aller.'</label></th>
									<td>
										<select name="select_lieu_aller" id="select_lieu_aller" onchange="show_domicile_info(\'aller\')">';
										
										$lst_lieu = get_list_lieu();
										foreach ($lst_lieu as $v) {
											echo '<option value="'.($v['id_lieu']).'">'.$v['nom_lieu'].'</option>';
										}
										
										echo '
										</select>
									</td>
								</tr>
								
								<tr id="info_dom_aller" style="display:none">
									<th></th>
									
									<td>
										<table>
											<th style="text-align:left;" colspan="2">'.$lang_info_complementaires.'</th>
											<tr>
												<td><label for="txt_ville_compl_aller">'.$lang_ville.'</label></td>
												<td><input class="dotted_input" type="text" id="txt_ville_compl_aller" name="txt_ville_compl_aller" /></td>
											</tr>
											<tr>
												<td><label for="txt_cp_compl_aller">'.$lang_code_postal.'</label></td>
												<td><input class="dotted_input" type="text" id="txt_cp_compl_aller" name="txt_cp_compl_aller" /></td>
											</tr>
											<tr>
												<td><label for="txt_adresse_compl_aller">'.$lang_adresse.'</label></td>
												<td><input class="dotted_input" type="text" id="txt_adresse_compl_aller" name="txt_adresse_compl_aller" /></td>
											</tr>
										</table>
									</td>
								</tr>
								
							</table>
						</fieldset>
						
						<fieldset class="spaced_fieldset">
							<legend>'.$lang_le_trajet.' : '.$lang_retour.'</legend>
							<table class="table_reserv">
											
								<tr>
									<th><label for="lbl_jour_retour">'.$lang_date_retour.'</label></th>
									<td>
										<input type="button" id="lbl_jour_retour" style="background-color:#FFF" value="Sélectionner une date" class="pointer" onclick="document.getElementById(\'ds_conclass1\').style.display=\'none\';ds_sh(\'lbl_jour_retour\', \'ds_conclass2\', \'ds_calclass3\', \'1\', \''.$_SESSION['lang'].'\');ds_sh(\'lbl_jour_retour\', \'ds_conclass2\', \'ds_calclass4\', \'2\', \''.$_SESSION['lang'].'\');" />
										<input type="button" id="lbl_jour" style="background:none;border:none;background-image:url(\'http://alsace-navette.com/aeroport/images/calendar.png\');width:16px;height:16px;" class="pointer" onclick="document.getElementById(\'ds_conclass1\').style.display=\'none\';ds_sh(\'lbl_jour_retour\', \'ds_conclass2\', \'ds_calclass3\', \'1\', \''.$_SESSION['lang'].'\');ds_sh(\'lbl_jour_retour\', \'ds_conclass2\', \'ds_calclass4\', \'2\', \''.$_SESSION['lang'].'\');" />

										<!-- Valeurs à récupérer -->
										
										<input type="hidden" name="jour_retour" id="jour_retour" value="" />
										<input type="hidden" name="jour_retour_long" id="jour_retour_long" value="" />

										<table class="ds_box" cellpadding="0" cellspacing="0" id="ds_conclass2" style="display: none;">
											<tr>
												<td id="ds_calclass3" valign="top"></td>
												<td id="ds_calclass4" valign="top"></td>
											</tr>
										</table>
										
									</td>
								</tr>
								
								<tr>
									<th><label for="select_heure_retour">'.$lang_heure_retour.'</label></th>
									<td>
										<input type="radio" name="radio_heure_retour" value="fixe" checked onclick="show_div_horaire_retour(\'fixe\')">'.$lang_horaire_fixe.'<br />
										<input type="radio" name="radio_heure_retour" value="demande" onclick="show_div_horaire_retour(\'demande\')">'.$lang_horaire_demande.'<br /><br />
										
										<div id="div_horaire_fixe_retour">
											<select name="select_heure_retour_fixe" id="select_heure_retour_fixe">';
											$lst_hor = get_list_horaires_fixes("retour");
											
											foreach ($lst_hor as $k => $v) {
												echo '<option value="'.$v.'">'.$v.'</option>';
											}
											
											echo '
											</select>
										</div>
										
										<div id="div_horaire_demande_retour" style="display:none;">
											'.$lang_majoration_horaire_demande.' '.get_value_of_option("maj_demande").' € <br /><br />
											<select name="select_heure_retour_demande" id="select_heure_retour_demande">
											';
												for ($i=0;$i<24;$i++){
													echo '<option value="'.$i.'">'.sprintf('%02d', $i).'</option>';
												}
											echo '
											</select>
											:
											<select name="select_minute_retour_demande" id="select_minute_retour_demande">
											';
												for ($i=0;$i<60;$i=$i+10){
													echo '<option value="'.$i.'">'.sprintf('%02d', $i).'</option>';
												}
											echo '
											</select>
										
										</div><br />
										( '.$lang_duree_estimee.' : 45 '.$lang_minutes.' )
									</td>
								</tr>
								
								<tr>
									<th><label for="select_lieu_retour">'.$lang_lieu_retour.'</label></th>
									<td>
										<select name="select_lieu_retour" id="select_lieu_retour" onchange="show_domicile_info(\'retour\')">';
										
										$lst_lieu = get_list_lieu();
										foreach ($lst_lieu as $v) {
											echo '<option value="'.($v['id_lieu']).'">'.$v['nom_lieu'].'</option>';
										}
										
										echo '
										</select>
									</td>
								</tr>
								
								<tr id="info_dom_retour" style="display:none">
									<th></th>
									
									<td>
										<table>
											<th style="text-align:left;" colspan="2">'.$lang_info_complementaires.' :</th>
											<tr>
												<td><label for="txt_ville_compl_retour">'.$lang_ville.'</label></td>
												<td><input class="dotted_input" type="text" id="txt_ville_compl_retour" name="txt_ville_compl_retour" /></td>
											</tr>
											<tr>
												<td><label for="txt_cp_compl_retour">'.$lang_code_postal.'</label></td>
												<td><input class="dotted_input" type="text" id="txt_cp_compl_retour" name="txt_cp_compl_retour" /></td>
											</tr>
											<tr>
												<td><label for="txt_adresse_compl_retour">'.$lang_adresse.'</label></td>
												<td><input class="dotted_input" type="text" id="txt_adresse_compl_retour" name="txt_adresse_compl_retour" /></td>
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
									<th><label for="select_nb_personnes">'.$lang_nombre_personnes.'</label></th>
									<td>
										<select name="select_nb_personnes" id="select_nb_personnes">';
										
										for ($i=1;$i<9;$i++){
											echo '<option value="'.$i.'">'.$i.'</option>';
										}
										
									echo '	
										</select>
									
									</td>
								</tr>
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
					</form>';
				?>
			</div>
			
			<!-- Le pied de page -->
			<?php require_once('./includes/include_pied_de_page.php'); ?>
		</div>
		
	</body> 
</html>