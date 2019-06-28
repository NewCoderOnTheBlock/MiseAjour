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
		<script type="text/javascript" src="scripts/charger_tableaux_trajets.js"></script>
		<script type="text/javascript" src="scripts/calendrier_restriction.js"></script>
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
			
			function setTypeSpectacle(id){
				
				if (id == "midi")
				{
					document.getElementById('div_horaire_aller_soir').style.display = 'none';
					document.getElementById('div_horaire_retour_soir').style.display = 'none';
					document.getElementById('div_horaire_aller_midi').style.display = 'block';
					document.getElementById('div_horaire_retour_midi').style.display = 'block';
				}
				else
				{
					document.getElementById('div_horaire_aller_soir').style.display = 'block';
					document.getElementById('div_horaire_retour_soir').style.display = 'block';
					document.getElementById('div_horaire_aller_midi').style.display = 'none';
					document.getElementById('div_horaire_retour_midi').style.display = 'none';
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
							<legend>'.$lang_le_trajet.'</legend>
							<table class="table_reserv">
							
								<tr>
									<th><label for="lbl_jour">'.$lang_date.'</label></th>
									<td>
										<input type="button" id="lbl_jour" style="background-color:#FFF" value="Sélectionner une date" class="pointer" onclick="ds_sh(\'lbl_jour\', \'ds_conclass1\', \'ds_calclass1\', \'1\', \''.$_SESSION['lang'].'\');ds_sh(\'lbl_jour\', \'ds_conclass1\', \'ds_calclass2\', \'2\', \''.$_SESSION['lang'].'\');" />
										<input type="button" id="lbl_jour" style="background:none;border:none;background-image:url(\'http://alsace-navette.com/aeroport/images/calendar.png\');width:16px;height:16px;" class="pointer" onclick="ds_sh(\'lbl_jour\', \'ds_conclass1\', \'ds_calclass1\', \'1\', \''.$_SESSION['lang'].'\');ds_sh(\'lbl_jour\', \'ds_conclass1\', \'ds_calclass2\', \'2\', \''.$_SESSION['lang'].'\');" />

										<!-- Valeurs à récupérer -->
										
										<input type="hidden" name="jour" id="jour" value="" />
										<input type="hidden" name="jour_long" id="jour_long" value="" />


										<table class="ds_box" cellpadding="0" cellspacing="0" id="ds_conclass1" style="display: none;">
											<tr>
												<td id="ds_calclass1" valign="top"></td>
												<td id="ds_calclass2" valign="top"></td>
											</tr>
										</table>
										
									</td>
								</tr>
								<tr>
									<th><label for="select_formule">'.$lang_formule.'</label></th>
									<td>
										<select name="select_formule" id="select_formule">';
										
										$i = 1;
										foreach (get_les_packs() as $lePack){
											
											echo '<option value="'.($lePack['id_pack']).'">Pack n°'.$i.' : '.$lePack['heure_aller'].' - '.$lePack['heure_retour'].'</option>';
											
											$i++;
										}
										
									echo '
										</select>
									</td>
								</tr>
								<tr>
									<th><label for="txt_lieu_aller">'.$lang_lieu_aller.'</label></th>
									<td>
										
										'.$lang_div_info_prise.'
										
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