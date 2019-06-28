<?php $tpl->includeTpl('aeroport/include.html', false, 0); ?>
<!--
fichier:AEROPORT.CLIENT.INFO.HTML.PHP
updated 26/06/2019

-->
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />

<div class="row" id="contenu">
    
    <?php if ($tpl->vars['ERREUR'] != '') : ?>
    
        <div class="<?php echo $tpl->vars['CLASS_ERREUR']; ?>">
            <strong><?php echo $tpl->vars['ERREUR']; ?></strong>
        </div>
	
    <?php endif; ?>
    
	<div class="col-xs-12 col-sm-6 col-md-6 infos_persos">
		<h4><?php echo $tpl->vars['TITRE']; ?></h4>
		<div class="col-xs-12 col-sm-12 col-md-12 infos_persos_form">
			<p class="row"><?php echo $tpl->vars['EXPLICATION']; ?></p>
			
			<form method="post" action="client/info.php" id="form_res">
			
				<div class="row" style="margin-top:20px;">
					<label for="lst_civ" class="label_cote_4 col-xs-12 col-sm-6 col-md-4" style="text-transform:none;"><?php echo $tpl->vars['CIVILITE']; ?> <sup class="rouge">*</sup></label>
					<span id="spryselect_civilite_client" style="padding:0;">
						<select name="lst_civ" id="lst_civ">
						
							<?php foreach ($tpl->vars['TAB_CIV'] as $__tpl_foreach_key['TAB_CIV'] => $__tpl_foreach_value['TAB_CIV']) : ?>
							
								<?php if ($tpl->vars['CIV_CHERCHE'] == $__tpl_foreach_value['TAB_CIV']['civilite']) : ?>
								
									<option value="<?php echo $__tpl_foreach_value['TAB_CIV']['civilite']; ?>" selected="selected"><?php echo $__tpl_foreach_value['TAB_CIV']['civilite']; ?></option>
								
								<?php else : ?>
								
									<option value="<?php echo $__tpl_foreach_value['TAB_CIV']['civilite']; ?>"><?php echo $__tpl_foreach_value['TAB_CIV']['civilite']; ?></option>
								
								<?php endif; ?>
							
							<?php endforeach; ?>
						
						</select>
					</span>
				</div>
				
				<div class="row" id="sprytextfield_nom_client">
					<label for="nom_client" class="label_cote_4 col-xs-12 col-sm-6 col-md-4" style="text-transform:none;"><?php echo $tpl->vars['NOM_CLIENT']; ?> <sup class="rouge">*</sup></label>
					<input class="col-xs-9 col-sm-6 col-md-4" type="text" id="nom_client" name="nom_client" value="<?php echo $tpl->vars['TXT_NOM_CLIENT']; ?>" tabindex="1" maxlength="50" />
					<span class="textfieldRequiredMsg"><?php echo $tpl->vars['SPRY_VIDE']; ?></span>
				</div>
				
				<div class="row" id="sprytextfield_prenom_client">
					<label for="prenom_client" class="label_cote_4 col-xs-12 col-sm-6 col-md-4" style="text-transform:none;"><?php echo $tpl->vars['PRENOM_CLIENT']; ?> <sup class="rouge">*</sup></label>
					<input class="col-xs-9 col-sm-6 col-md-4" type="text" id="prenom_client" name="prenom_client" value="<?php echo $tpl->vars['TXT_PRENOM_CLIENT']; ?>" tabindex="2" maxlength="50" />
					<span class="textfieldRequiredMsg"><?php echo $tpl->vars['SPRY_VIDE']; ?></span>
				</div>

				<div class="row" style="margin-top:20px;"><?php echo $tpl->vars['EXPLI_INDICATIF']; ?></div>

				<div class="row">
					<div class="row" style="text-align:center;font-weight:bold;color:black;border-bottom:2px solid #00A0C3;margin:20px 0 10px 0;"><?php echo $tpl->vars['TEL_CLIENT']; ?></div>
					<div class="row" id="spryselect_indicatif_fixe">

						<label for="indicatif_fixe" class="label_cote_3 col-xs-12 col-sm-6 col-md-4" style="text-transform:none;"><?php echo $tpl->vars['INDICATIF']; ?> <sup class="rouge">*</sup></label>
						<select class="col-xs-9 col-sm-6 col-md-4" name="indicatif_fixe" id="indicatif_fixe">

							<?php foreach ($tpl->vars['TAB_IND'] as $__tpl_foreach_key['TAB_IND'] => $__tpl_foreach_value['TAB_IND']) : ?>

								<?php if ($__tpl_foreach_value['TAB_IND']['indicatif'] != '0') : ?>

									<?php if ($__tpl_foreach_value['TAB_IND']['indicatif'] != '') : ?>

										<?php if ($__tpl_foreach_value['TAB_IND']['code_pays'] == $tpl->vars['IND_FIXE_CHERCHE']) : ?>

											<option value="<?php echo $__tpl_foreach_value['TAB_IND']['code_pays']; ?>" selected="selected"><?php echo $__tpl_foreach_value['TAB_IND']['nom_pays']; ?> - <?php echo $__tpl_foreach_value['TAB_IND']['indicatif']; ?></option>

										<?php else : ?>

											<option value="<?php echo $__tpl_foreach_value['TAB_IND']['code_pays']; ?>"><?php echo $__tpl_foreach_value['TAB_IND']['nom_pays']; ?> - <?php echo $__tpl_foreach_value['TAB_IND']['indicatif']; ?></option>

										<?php endif; ?>

									<?php endif; ?>

								<?php else : ?>

									<option value=""></option>

								<?php endif; ?>

						  <?php endforeach; ?>

						</select>

					</div>
					
					<div class="row" id="sprytextfield_tel_client">
						<label for="tel_client" class="label_cote_4 col-xs-12 col-sm-6 col-md-4" style="text-transform:none;"><?php echo $tpl->vars['TEL_CLIENT']; ?> <sup class="rouge">**</sup></label>
						<input class="col-xs-9 col-sm-6 col-md-4" type="text" id="tel_client" name="tel_client" value="<?php echo $tpl->vars['TXT_TEL_CLIENT']; ?>" tabindex="3" maxlength="20" />
						<span class="textfieldRequiredMsg"><?php echo $tpl->vars['SPRY_VIDE']; ?></span>
						<span class="textfieldInvalidFormatMsg"><?php echo $tpl->vars['SPRY_FORMAT']; ?></span>
					</div>
				</div>

				<div class="row">
					<div class="row" style="text-align:center;font-weight:bold;color:black;border-bottom:2px solid #00A0C3;margin:20px 0 10px 0;"><?php echo $tpl->vars['PORT_CLIENT']; ?></div>
					<div class="row" id="spryselect_indicatif_port">

						<label for="indicatif_port" class="label_cote_3 col-xs-12 col-sm-6 col-md-4" style="text-transform:none;"><?php echo $tpl->vars['INDICATIF']; ?> <sup class="rouge">*</sup></label>
						<select class="col-xs-9 col-sm-6 col-md-4" name="indicatif_port" id="indicatif_port">

							<?php foreach ($tpl->vars['TAB_IND'] as $__tpl_foreach_key['TAB_IND'] => $__tpl_foreach_value['TAB_IND']) : ?>

								<?php if ($__tpl_foreach_value['TAB_IND']['indicatif'] != '0') : ?>

									<?php if ($__tpl_foreach_value['TAB_IND']['indicatif'] != '') : ?>

										<?php if ($__tpl_foreach_value['TAB_IND']['code_pays'] == $tpl->vars['IND_PORT_CHERCHE']) : ?>

											<option value="<?php echo $__tpl_foreach_value['TAB_IND']['code_pays']; ?>" selected="selected"><?php echo $__tpl_foreach_value['TAB_IND']['nom_pays']; ?> - <?php echo $__tpl_foreach_value['TAB_IND']['indicatif']; ?></option>

										<?php else : ?>

											<option value="<?php echo $__tpl_foreach_value['TAB_IND']['code_pays']; ?>"><?php echo $__tpl_foreach_value['TAB_IND']['nom_pays']; ?> - <?php echo $__tpl_foreach_value['TAB_IND']['indicatif']; ?></option>

										<?php endif; ?>

									<?php endif; ?>

								<?php else : ?>

									<option value=""></option>

								<?php endif; ?>

							<?php endforeach; ?>

						</select>

					</div>

					<div class="row" id="sprytextfield_port_client">
						<label for="port_client" class="label_cote_4 col-xs-12 col-sm-6 col-md-4" style="text-transform:none;"><?php echo $tpl->vars['PORT_CLIENT']; ?> <sup class="rouge">**</sup></label>
						<input class="col-xs-9 col-sm-6 col-md-4" type="text" id="port_client" name="port_client" value="<?php echo $tpl->vars['TXT_PORT_CLIENT']; ?>" tabindex="4" maxlength="20" />
						<span class="textfieldRequiredMsg"><?php echo $tpl->vars['SPRY_VIDE']; ?></span>
						<span class="textfieldInvalidFormatMsg"><?php echo $tpl->vars['SPRY_FORMAT']; ?></span>
					</div>
				</div>
				
				<div class="row">
					<div class="row" style="text-align:center;font-weight:bold;color:black;border-bottom:2px solid #00A0C3;margin:20px 0 10px 0;"><?php echo $tpl->vars['AUTRES_INFOS']; ?></div>
					<div class="row" id="sprytextfield_email_client">
						<label for="email_client" class="label_cote_4 col-xs-12 col-sm-6 col-md-4" style="text-transform:none;"><?php echo $tpl->vars['EMAIL']; ?> <sup class="rouge">*</sup></label>
						<input class="col-xs-9 col-sm-6 col-md-4" type="text" id="email_client" name="email_client" value="<?php echo $tpl->vars['TXT_EMAIL_CLIENT']; ?>" tabindex="5" maxlength="50" />
						<span class="textfieldRequiredMsg"><?php echo $tpl->vars['SPRY_VIDE']; ?></span>
						<span class="textfieldInvalidFormatMsg"><?php echo $tpl->vars['SPRY_FORMAT']; ?></span>
					</div>

					<div class="row">
						<label for="adresse_client" class="label_cote_4 col-xs-12 col-sm-6 col-md-4" style="text-transform:none;"><?php echo $tpl->vars['ADRESSE_CLIENT']; ?></label>
						<input class="col-xs-9 col-sm-6 col-md-4" type="text" id="adresse_client" name="adresse_client" value="<?php echo $tpl->vars['TXT_ADRESSE_CLIENT']; ?>" tabindex="6" maxlength="200" />
					</div>

					<div class="row">
						<label for="code_post_client" class="label_cote_4 col-xs-12 col-sm-6 col-md-4" style="text-transform:none;"><?php echo $tpl->vars['CODE_POST_CLIENT']; ?></label>
						<input class="col-xs-9 col-sm-6 col-md-4" type="text" id="code_post_client" name="code_post_client" value="<?php echo $tpl->vars['TXT_CODE_POST_CLIENT']; ?>" tabindex="7" maxlength="5" />
					</div>

					<div class="row" id="sprytextfield_ville_client">
						<label for="ville_client" class="label_cote_4 col-xs-12 col-sm-6 col-md-4" style="text-transform:none;"><?php echo $tpl->vars['VILLE_CLIENT']; ?> <sup class="rouge">*</sup></label>
						<input class="col-xs-9 col-sm-6 col-md-4" type="text" id="ville_client" name="ville_client" value="<?php echo $tpl->vars['TXT_VILLE_CLIENT']; ?>" tabindex="8" maxlength="50" />
						<span class="textfieldRequiredMsg"><?php echo $tpl->vars['SPRY_VIDE']; ?></span>
					</div>
					
					<div class="row" id="spryselect_pays_client">
						<label for="pays_client" class="label_cote_4 col-xs-12 col-sm-6 col-md-4" style="text-transform:none;"><?php echo $tpl->vars['PAYS_CLIENT']; ?> <sup class="rouge">*</sup></label>
						<select class="col-xs-9 col-sm-6 col-md-4" name="pays_client" id="pays_client" tabindex="9" >

							<?php foreach ($tpl->vars['TAB_PAYS'] as $__tpl_foreach_key['TAB_PAYS'] => $__tpl_foreach_value['TAB_PAYS']) : ?>

								<?php if ($__tpl_foreach_value['TAB_PAYS']['code_pays'] == $tpl->vars['PAYS_CHERCHE']) : ?>

									<option value="<?php echo $__tpl_foreach_value['TAB_PAYS']['code_pays']; ?>" selected="selected"><?php echo $__tpl_foreach_value['TAB_PAYS']['nom_pays']; ?></option>

								<?php else : ?>

									<option value="<?php echo $__tpl_foreach_value['TAB_PAYS']['code_pays']; ?>"><?php echo $__tpl_foreach_value['TAB_PAYS']['nom_pays']; ?></option>

								<?php endif; ?>

							<?php endforeach; ?>

						</select>
					</div>
				</div>

				<p class="row" style="margin:20px 0;"><?php echo $tpl->vars['WARNING_TEL']; ?></p>
				
				<span style="font-size:0.8em;"><sup class="rouge">*</sup> : <?php echo $tpl->vars['OBLIGATOIRE']; ?>
				<br />
				<sup class="rouge">**</sup> : <?php echo $tpl->vars['OBLIGATOIRE_2']; ?></span>
				
				<div class="row" style="text-align:center;margin-top:20px;">
					<input type="hidden" name="info" />
					<input type="button" id="raz" value="<?php echo $tpl->vars['BTN_RAZ']; ?>" tabindex="10" style="font-size:1em;padding-right:5px;" />
					<input type="button" value="<?php echo $tpl->vars['BTN_ENVOYER']; ?>" id="btn_envoie" tabindex="11" style="font-size:1em;padding-right:5px;" />
				</div>
		
			</form>
		</div>
			
		<script type="text/javascript">
		<!--

			var sprytextfield_nom_client = new Spry.Widget.ValidationTextField("sprytextfield_nom_client", "none", {validateOn:["blur"]});
			var sprytextfield_prenom_client = new Spry.Widget.ValidationTextField("sprytextfield_prenom_client", "none", {validateOn:["blur"]});
			var sprytextfield_email_client = new Spry.Widget.ValidationTextField("sprytextfield_email_client", "email", {validateOn:["blur"]});
			
			var sprytextfield_ville_client = new Spry.Widget.ValidationTextField("sprytextfield_ville_client", "none", {validateOn:["blur"]});
			
			var spryselect_pays_client = new Spry.Widget.ValidationSelect("spryselect_pays_client", {validateOn:["change"]});
			
			var spryselect_civilite_client = new Spry.Widget.ValidationSelect("spryselect_civilite_client", {validateOn:["change"]});
			var spryselect_indicatif_fixe = new Spry.Widget.ValidationSelect("spryselect_indicatif_fixe", {validateOn:["change"]});
			var spryselect_indicatif_port = new Spry.Widget.ValidationSelect("spryselect_indicatif_port", {validateOn:["change"]});

		//-->
		</script>

		<script type="text/javascript" src="scripts/info.js"></script>
		
	</div>
		
	<div class="col-xs-12 col-sm-6 col-md-6">
		<div class="bloc_droite" style="height:auto;">
			<a href="<?php echo $tpl->vars['LIEN_AIDE']; ?>" style="text-decoration:none;">
				<div class="row info_reservation" style="background-color:#00A0C3;">
					<h4 style="text-transform:uppercase;color:white;font-size:1.1em;margin-bottom:20px;"><?php echo $tpl->vars['AIDE_RESERVATION']; ?></h4>
					<div class="col-xs-12 col-sm-6 col-md-3">
						<img src="./images/etape1.png" class="image_etape"><br>
						<p class="image_hover"><span><?php echo $tpl->vars['ETAPE_1']; ?></span></p>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-3">
						<img src="./images/etape2.png" class="image_etape"><br>
						<p class="image_hover"><span><?php echo $tpl->vars['ETAPE_2']; ?></span></p>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-3">
						<img src="./images/etape3.png" class="image_etape"><br>
						<p class="image_hover"><span><?php echo $tpl->vars['ETAPE_3']; ?></span></p>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-3">
						<img src="./images/etape4.png" class="image_etape"><br>
						<p class="image_hover"><span><?php echo $tpl->vars['ETAPE_4']; ?></span></p>
					</div>
				</div>
			</a>
			<div class="row liens_accueil">
				<a href="<?php echo $tpl->vars['LIEN_HORAIRES']; ?>">
					<div class="col-xs-12 col-sm-6 col-md-6 gauche" style="background-color:#2C9EB4;">
						<img src="images/Horaires_navettes.png">
						<h4><?php echo $tpl->vars['HORAIRES_NAVETTES']; ?></h4>
					</div>
				</a>
				<a href="<?php echo $tpl->vars['LIEN_HORAIRES']; ?>">
					<div class="col-xs-12 col-sm-6 col-md-6 droite" style="background-color:#45B3C8;">
						<img src="images/horaires_vols.png">
						<h4><?php echo $tpl->vars['HORAIRES_VOLS']; ?></h4>
					</div>
				</a>
			</div>
			<div class="row liens_accueil">
				<a href="<?php echo $tpl->vars['LIEN_AIDE']; ?>">
					<div class="col-xs-12 col-sm-6 col-md-6 gauche" style="background-color:#45B3C8;">
						<img src="images/infos_trajet.png">
						<h4><?php echo $tpl->vars['INFOS']; ?></h4>
					</div>
				</a>
				<a href="<?php echo $tpl->vars['LIEN_HORAIRES']; ?>">
					<div class="col-xs-12 col-sm-6 col-md-6 droite" style="background-color:#2C9EB4;">
						<img src="images/point_prise.png">
						<h4><?php echo $tpl->vars['POINTS_PRISE']; ?></h4>
					</div>
				</a>
			</div>
		</div>
	</div>
	
</div>

<?php $tpl->includeTpl('footer.html', false, 0); ?>
