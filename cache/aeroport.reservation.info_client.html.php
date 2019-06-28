<?php $tpl->includeTpl('aeroport/include.html', false, 0); ?>

<!--
fichier:aeroport.reservation.info_client.html
updated:19/06/2019
-->
<div class="row" id="contenu">
	
	<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>

    <?php if ($tpl->vars['CLASS_ERREUR'] != '') : ?>
    
        <div class="<?php echo $tpl->vars['CLASS_ERREUR']; ?>">
            <strong><?php echo $tpl->vars['ERREUR']; ?></strong>
        </div>
		
        <br />
        
    <?php endif; ?>
	
	<div class="col-xs-12 col-sm-6 col-md-6 info_client">
	
		<h4><?php echo $tpl->vars['TITRE']; ?></h4>
		<div class="col-xs-12 col-sm-12 col-md-12 info_client_form">
			
			<?php if ($tpl->vars['DEJA__CLIENT']) : ?>
 
				<p class="row" style="margin-bottom:20px;"><?php echo $tpl->vars['TXT_DEJA_CLIENT']; ?></p>
				
			<?php endif; ?>
			
			<form method="post" action="reservation/reservation.php" id="form_info_client">
    
				<p class="row" style="margin-bottom:20px;"><?php echo $tpl->vars['DEJA_CLIENT']; ?></p>

				<div class="row">
					<label for="lst_civ" class="label_cote_4 col-xs-12 col-sm-6 col-md-4" style="text-transform:none;"><?php echo $tpl->vars['CIVILITE']; ?> <sup class="rouge">*</sup></label>
					<select name="lst_civ" id="lst_civ">

						<?php foreach ($tpl->vars['TAB_CIV'] as $__tpl_foreach_key['TAB_CIV'] => $__tpl_foreach_value['TAB_CIV']) : ?>

							<?php if ($tpl->vars['CIV_CHERCHE'] == $__tpl_foreach_value['TAB_CIV']['civilite']) : ?>

								<option value="<?php echo $__tpl_foreach_value['TAB_CIV']['civilite']; ?>" selected="selected"><?php echo $__tpl_foreach_value['TAB_CIV']['civilite']; ?></option>

							<?php else : ?>

								<option value="<?php echo $__tpl_foreach_value['TAB_CIV']['civilite']; ?>"><?php echo $__tpl_foreach_value['TAB_CIV']['civilite']; ?></option>

							<?php endif; ?>

						<?php endforeach; ?>

					</select>
				</div>

				<div class="row">
					<label for="nom_client" class="label_cote_4 col-xs-12 col-sm-6 col-md-4" style="text-transform:none;"><?php echo $tpl->vars['NOM_CLIENT']; ?> <sup class="rouge">*</sup></label>
					<input class="col-xs-9 col-sm-6 col-md-4" type="text" id="nom_client" name="nom_client" value="<?php echo $tpl->vars['TXT_NOM_CLIENT']; ?>" tabindex="1" maxlength="50" />
				</div>
				
				<div class="row">
					<label for="prenom_client" class="label_cote_4 col-xs-12 col-sm-6 col-md-4" style="text-transform:none;"><?php echo $tpl->vars['PRENOM_CLIENT']; ?> <sup class="rouge">*</sup></label>
					<input class="col-xs-9 col-sm-6 col-md-4" type="text" id="prenom_client" name="prenom_client" value="<?php echo $tpl->vars['TXT_PRENOM_CLIENT']; ?>" tabindex="2" maxlength="50" />
				</div>
				
				<div class="row" style="margin-bottom:10px;">
					<div class="col-xs-12 col-sm-12 col-md-12" style="text-align:center;font-weight:bold;color:black;border-bottom:2px solid #00A0C3;margin-bottom:10px;"><?php echo $tpl->vars['TEL_CLIENT']; ?></div>
					<div class="row">
						<label for="indicatif_fixe" class="label_cote_4 col-xs-12 col-sm-6 col-md-4" style="text-transform:none;"><?php echo $tpl->vars['INDICATIF']; ?> <sup class="rouge">*</sup></label>
						<select class="col-xs-9 col-sm-6 col-md-4" name="indicatif_fixe" id="indicatif_fixe" tabindex="3">

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
						<div class="col-xs-3 col-sm-6 col-md-4">
							<img class="pointer" style="margin-left:5px;" src="images/icones/info-16.png" alt="<?php echo $tpl->vars['ALT_AIDE']; ?>" onclick='$("#popup_aideIndicatif").dialog("open");' />
							<img id="img_fixe" class="pointer" src="images/error.png" alt="Attention" style="visibility:hidden" />
						</div>
					</div>
					
					<div class="row">
						<label for="tel_client" class="label_cote_4 col-xs-12 col-sm-6 col-md-4" style="text-transform:none;"><?php echo $tpl->vars['TEL_CLIENT']; ?> <sup class="rouge">*</sup></label>
						<input type="text" id="ind_fixe" size="3" readonly="readonly" />
						<input type="text" id="tel_client" name="tel_client" value="<?php echo $tpl->vars['TXT_TEL_CLIENT']; ?>" tabindex="4"  maxlength="20" />
					</div>
				</div>
				
				<div class="row" style="margin-bottom:20px;">
					<div class="col-xs-12 col-sm-12 col-md-12" style="text-align:center;font-weight:bold;color:black;border-bottom:2px solid #00A0C3;margin-bottom:10px;"><?php echo $tpl->vars['PORT_CLIENT']; ?></div>
					<div class="row">
						<label for="indicatif_port" class="label_cote_4 col-xs-12 col-sm-6 col-md-4" style="text-transform:none;"><?php echo $tpl->vars['INDICATIF']; ?> <sup class="rouge">*</sup></label>
						<select class="col-xs-9 col-sm-6 col-md-4" name="indicatif_port" id="indicatif_port" tabindex="5">

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
						<div class="col-xs-3 col-sm-6 col-md-4"><img class="pointer" style="margin-left:5px;" src="images/icones/info-16.png" alt="<?php echo $tpl->vars['ALT_AIDE']; ?>" onclick='$("#popup_aideIndicatif").dialog("open");' />
						<img id="img_port" class="pointer" src="images/error.png" alt="Attention" style="visibility:hidden" /></div>
					</div>
					
					<div class="row">
						<label for="port_client" class="label_cote_4 col-xs-12 col-sm-6 col-md-4" style="text-transform:none;"><?php echo $tpl->vars['PORT_CLIENT']; ?> <sup class="rouge">*</sup></label>
						<input type="text" id="ind_port" size="3" readonly="readonly" />
						<input type="text" id="port_client" name="port_client" value="<?php echo $tpl->vars['TXT_PORT_CLIENT']; ?>" tabindex="6" maxlength="20" />
					</div>
				</div>

				<!-- KEMPF : Passage de l'adresse en hidden (N'est plus nécessaire)
				
				<span>
					<label for="adresse_client" class="label_cote_4"><?php echo $tpl->vars['ADRESSE_CLIENT']; ?> : </label>
					<input type="text" id="adresse_client" name="adresse_client" value="<?php echo $tpl->vars['TXT_ADRESSE_CLIENT']; ?>" tabindex="8" maxlength="200" />
				</span>
				
				<br />-->
					<input type="hidden" id="adresse_client" name="adresse_client" value="<?php echo $tpl->vars['TXT_ADRESSE_CLIENT']; ?>" tabindex="8" maxlength="200" />

				<!-- KEMPF : Passage du code postal en hidden (N'est plus nécessaire)
				<span>
					<label for="code_post_client" class="label_cote_4"><?php echo $tpl->vars['CODE_POST_CLIENT']; ?> : </label>
					<input type="text" id="code_post_client" name="code_post_client" value="<?php echo $tpl->vars['TXT_CODE_POST_CLIENT']; ?>" tabindex="9" maxlength="5" />
				</span>-->
					<input type="hidden" id="code_post_client" name="code_post_client" value="<?php echo $tpl->vars['TXT_CODE_POST_CLIENT']; ?>" tabindex="9" maxlength="5" />
				
				
				<!-- KEMPF : Passage de la ville en hidden (N'est plus nécessaire)
				<span>
					<label for="ville_client" class="label_cote_4"><?php echo $tpl->vars['VILLE_CLIENT']; ?> <span class="rouge">*</span> : </label>
					<input type="text" id="ville_client" name="ville_client" value="<?php echo $tpl->vars['TXT_VILLE_CLIENT']; ?>" tabindex="10" maxlength="50" />
				</span>

				<br /><br />-->
					<input type="hidden" id="ville_client" name="ville_client" value="Non définie" tabindex="10" maxlength="50" />
				
				<div class="row">
					<label for="pays_client" class="label_cote_4 col-xs-12 col-sm-6 col-md-4" style="text-transform:none;"><?php echo $tpl->vars['PAYS_CLIENT']; ?> <sup class="rouge">*</sup></label>
					<select class="col-xs-9 col-sm-6 col-md-4" name="pays_client" id="pays_client" tabindex="11">

						<?php foreach ($tpl->vars['TAB_PAYS'] as $__tpl_foreach_key['TAB_PAYS'] => $__tpl_foreach_value['TAB_PAYS']) : ?>

							<?php if ($__tpl_foreach_value['TAB_PAYS']['code_pays'] == $tpl->vars['PAYS_CHERCHE']) : ?>

								<option value="<?php echo $__tpl_foreach_value['TAB_PAYS']['code_pays']; ?>" selected="selected"><?php echo $__tpl_foreach_value['TAB_PAYS']['nom_pays']; ?></option>

							<?php else : ?>

								<option value="<?php echo $__tpl_foreach_value['TAB_PAYS']['code_pays']; ?>"><?php echo $__tpl_foreach_value['TAB_PAYS']['nom_pays']; ?></option>

							<?php endif; ?>

						<?php endforeach; ?>

					</select>
				</div>

				<div class="row">
					<label for="email_client" class="label_cote_4 col-xs-12 col-sm-6 col-md-4" style="text-transform:none;"><?php echo $tpl->vars['EMAIL']; ?> <sup class="rouge">*</sup></label>
					<input class="col-xs-9 col-sm-6 col-md-4" type="text" id="email_client" name="email_client" value="<?php echo $tpl->vars['TXT_EMAIL_CLIENT']; ?>" tabindex="7" maxlength="50" />
				</div>
				
				<div class="row">
					<label for="verif_email_client" class="label_cote_4 col-xs-12 col-sm-6 col-md-4" style="text-transform:none;"><?php echo $tpl->vars['VERIF_EMAIL']; ?> <sup class="rouge">*</sup></label>
					<input class="col-xs-9 col-sm-6 col-md-4" type="text" id="verif_email_client" name="verif_email_client" value="" tabindex="7" maxlength="50" />
				</div>
				
				<p class="row" style="margin-top:20px;margin-bottom:20px;"><?php echo $tpl->vars['WARNING_TEL']; ?></p>
  
				<div class="row" style="text-align:center;margin-top:10px;margin-bottom:10px;">
					<input type="hidden" name="res_2" value="0" />
					<input type="button" id="retour" value="<?php echo $tpl->vars['BTN_RETOUR']; ?>" tabindex="10" onclick="history.back();" style="font-size:1em;padding-left:5px;padding-right:5px;"/>
					<input type="button" id="raz" value="<?php echo $tpl->vars['BTN_RAZ']; ?>" tabindex="11" style="font-size:1em;padding-left:5px;padding-right:5px;"/>
					<input type="button" value="<?php echo $tpl->vars['BTN_CONTINUER']; ?>" id="btn_envoie" tabindex="12" style="font-size:1em;padding-left:5px;padding-right:5px;"/>
				</div>
				
				<span style="font-size:0.8em;"><sup class="rouge">*</sup> : <?php echo $tpl->vars['OBLIGATOIRE']; ?>
				<br />
				<sup class="rouge">**</sup> : <?php echo $tpl->vars['OBLIGATOIRE_2']; ?>
				</span>
				
			</form>
				
			<script type="text/javascript" src="scripts/info_client.js"></script>
			
		</div>
		
	</div>
	
	<div class="col-xs-12 col-sm-6 col-md-6">

		<?php include("block_droite.html.php"); ?> 										<!--		includeeeeeeeeeeeee iccci
-->
	</div>

<div id="popup_aideIndicatif" title="<?php if(isset($tpl->var['ALT_AIDE'])) {echo $tpl->vars['ALT_AIDE'];} ?>">
	<img class="pointer" src="images/icones/info-16.png" /> <?php if(isset($tpl->var['EXPLI_INDICATIF'])) {echo $tpl->vars['EXPLI_INDICATIF'];}  ?>
</div>

<script type="text/javascript">
	$(function() {
		$( "#popup_aideIndicatif" ).dialog({
			modal: true,
			autoOpen: false,
			width: 500,
			resizable: false,
			draggable: false,
			buttons: {
				Ok: function() {
					$( this ).dialog( "close" );
				}
			}
		});
	});
</script>

<?php $tpl->includeTpl('footer.html', false, 0); ?>
