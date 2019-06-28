
<?php $tpl->includeTpl('aeroport/include.html', false, 0); ?>
<!--
FICHIER:areoport.demande_reservation.html
updated:28/06/2019
-->
<div class="row" id="contenu">

    <input type="hidden" id="logger" value="<?php echo $tpl->vars['LOGGER']; ?>" />
    <input type="hidden" id="heure_fixe_aller" value="<?php echo $tpl->vars['HEURE_FIXE_ALLER']; ?>" />
    <input type="hidden" id="heure_fixe_retour" value="<?php echo $tpl->vars['HEURE_FIXE_RETOUR']; ?>" />

	<script type="text/javascript" src="<?php echo $tpl->vars['BASEURL']; ?>styles/csshover.js"></script>
    <script type="text/javascript" src="scripts/calendrier.js"></script>
	<script type="text/javascript" src="<?php echo $tpl->vars['BASEURL']; ?>scripts/accueil_mini2.js"></script>

	<!-- Colonne de droite
	<div class='colonneDroite_2c'>
	
		<!-- Programme fidélité si le client est connecté -->
		<?php if ($tpl->vars['LOGGER']) : ?>
			<?php if (!$tpl->vars['EST_FIDELE']) : ?>
				<!--
				<div class='titreColonne_2c'>
					<span class='txt_titre_colonne_2c'><?php echo $tpl->vars['TITRE_FIDELITE']; ?></span>
				</div>
				<div class='contenuBloc_2c_h180' style="padding:10px;text-align:center;">
					<?php echo $tpl->vars['EXPLICATION_FIDELITE']; ?>
				</div>
				-->
			<?php endif; ?>
		<?php endif; ?>	
		
		<!-- Bloc des paiements -->
		<!--<div class='titreColonne_2c'>
			<span class='txt_titre_colonne_2c'><?php echo $tpl->vars['MODE_DE_PAIEMENT']; ?></span>
		</div>
		<div class='contenuBloc_2c_h180' style="text-align:center;">

			<br /><br />
			
			<img src="images/carte_paypal.png" alt="Carte PayPal" class="resize" />

			<br /><br /><br /><br />

			<img src="http://alsace-navette.com/europapark/images/ca_logo.png" alt="e-transaction" />
			&nbsp;&nbsp;
			<img src="http://alsace-navette.com/europapark/images/paypal_logo.png" alt="<?php echo $tpl->vars['ALT_PAYPAL']; ?>" />

		</div>
		
	</div>-->
	
	<!-- CONTENU -->
	<div class="col-xs-12 col-sm-6 col-md-6 demande_reservation">
		<h4><?php echo $tpl->vars['TITLE_RESERVATION']; ?></h4>
		<div class="col-xs-12 col-sm-12 col-md-12 demande_reservation_form">
			<?php if ($tpl->vars['CLASS_ERREUR'] != '') : ?>

				<br />

				<div class="<?php echo $tpl->vars['CLASS_ERREUR']; ?>">
					<strong><?php echo $tpl->vars['ERREUR']; ?></strong>
				</div>

				<br />

			<?php endif; ?>

			<?php if (!$tpl->vars['LOGGER']) : ?>
				<p style="margin-bottom:20px;"><img class="no-class" src="../aeroport/images/icones/connect-16.png" alt="<?php echo $tpl->vars['ALT_AIDE']; ?>" /> <?php echo $tpl->vars['DEJA_CLIENT']; ?></p>
			<?php endif; ?>

			<form method="post" action="reservation/info_client.php" id="form_res">
				<script type="text/javascript" src="../aeroport/scripts/infobulle.js"></script>

				<div class="type-trajet row">
					<span class="label_cote_3 col-xs-12 col-sm-12 col-md-4" style="padding:0;"><?php echo $tpl->vars['TRAJET_TYPE']; ?><sup class="rouge">*</sup></span>
					<div class="col-xs-6 col-xs-6 col-md-4">
						<label for="trajet_aller_simple" style="font-weight:normal;"><?php echo $tpl->vars['TRAJET_ALLER_SIMPLE']; ?></label>
						<?php if ($tpl->vars['TRAJET'] == '1') : ?>
							<input type="radio" name="type_trajet" id="trajet_aller_simple" value="1" checked="checked" />
						<?php else : ?>
							<input type="radio" name="type_trajet" id="trajet_aller_simple" value="1" />
						<?php endif; ?>
					</div>
					<div class="col-xs-6 col-xs-6 col-md-4">
						<label for="trajet_aller_retour" style="font-weight:normal;"><?php echo $tpl->vars['TRAJET_ALLER_RETOUR']; ?></label>
						<?php if ($tpl->vars['TRAJET'] == '0') : ?>
							<input type="radio" name="type_trajet" id="trajet_aller_retour" value="0" checked="checked" />
						<?php else : ?>
							<input type="radio" name="type_trajet" id="trajet_aller_retour" value="0" />
						<?php endif; ?>
					</div>
				</div>

				<div class="row">
					<label for="lst_trajet_depart" class="label_cote_3 col-xs-12 col-sm-6 col-md-4"><?php echo $tpl->vars['TRAJET_DEPART']; ?><sup class="rouge">*</sup></label>
					<select name="lst_trajet_depart" id="lst_trajet_depart" class="col-xs-9 col-sm-6 col-md-4">
						<?php foreach ($tpl->vars['LST_DEPART'] as $__tpl_foreach_key['LST_DEP'] => $__tpl_foreach_value['LST_DEP']) : ?>
						
							<?php if ($__tpl_foreach_value['LST_DEP']['id_lieu'] == $tpl->vars['DEP_CHERCHE']) : ?>
							
								<option value="<?php echo $__tpl_foreach_value['LST_DEP']['id_lieu']; ?>" selected="selected"><?php echo $__tpl_foreach_value['LST_DEP']['nom']; ?></option>
								
							<?php else : ?>

								<option value="<?php echo $__tpl_foreach_value['LST_DEP']['id_lieu']; ?>"><?php echo $__tpl_foreach_value['LST_DEP']['nom']; ?></option>
								
							<?php endif; ?>
							
						<?php endforeach; ?>
						
					</select>
				</div>

				<div class="row">
					<label for="lst_trajet_arrive" class="label_cote_3 col-xs-12 col-sm-6 col-md-4"><?php echo $tpl->vars['TRAJET_ARRIVE']; ?><sup class="rouge">*</sup></label>
					<select name="lst_trajet_arrive" id="lst_trajet_arrive" class="col-xs-9 col-sm-6 col-md-4">

						<?php foreach ($tpl->vars['LST_DEPART'] as $__tpl_foreach_key['LST_DEP'] => $__tpl_foreach_value['LST_DEP']) : ?>

							<?php if ($__tpl_foreach_value['LST_DEP']['id_lieu'] == $tpl->vars['DEST_CHERCHE']) : ?>

								<option value="<?php echo $__tpl_foreach_value['LST_DEP']['id_lieu']; ?>" selected="selected"><?php echo $__tpl_foreach_value['LST_DEP']['nom']; ?></option>

							<?php else : ?>

								<option value="<?php echo $__tpl_foreach_value['LST_DEP']['id_lieu']; ?>"><?php echo $__tpl_foreach_value['LST_DEP']['nom']; ?></option>

							<?php endif; ?>

						<?php endforeach; ?>

					</select>
				</div>

				<div class="row">
					<h4 class="demande_reservation_form_titre"><?php echo $tpl->vars['INFO_VOL']; ?></h4>
					<div class="row info_vol">
						<div class="header_tab" style="display:none;width:100%;text-align:center;font-weight:bold;color:black;border-bottom:2px solid #00A0C3;margin-bottom:10px;"><?php echo $tpl->vars['ALLER']; ?></div>
														
						<div class="row">
							<div class="label_cote_4 col-xs-12 col-sm-6 col-md-4" style="text-transform:none;"><?php echo $tpl->vars['DATE_DEPART']; ?><sup class="rouge">*</sup></div>
							<div class="col-xs-9 col-sm-6 col-md-4">
								<span id="lbl_jour_depart" style="background-color:#FFF" class="pointer" onclick="document.getElementById('ds_conclass2').style.display='none';ds_sh('lbl_jour_depart', 'ds_conclass1', 'ds_calclass1', '1');ds_sh('lbl_jour_depart', 'ds_conclass1', 'ds_calclass2', '2');"><?php echo $tpl->vars['SELECTIONNER_DATE_DEPART']; ?></span>
								<span>
									<input type="hidden" name="jour_depart" id="jour_depart" value="<?php echo $tpl->vars['TXT_JOUR_DEPART']; ?>" />
									<input type="hidden" name="jour_depart_long" id="jour_depart_long" value="<?php echo $tpl->vars['TXT_JOUR_DEPART_LONG']; ?>" />
									<input type="button" onfocus="ds_sh('lbl_jour_depart', 'ds_conclass1', 'ds_calclass1', '1');ds_sh('lbl_jour_depart', 'ds_conclass1', 'ds_calclass2', '2');" onclick="ds_sh('lbl_jour_depart', 'ds_conclass1', 'ds_calclass1', '1');ds_sh('lbl_jour_depart', 'ds_conclass1', 'ds_calclass2', '2');" style="background-image:url(images/icones/calendar-16.png); height:16px; width:16px;padding:0;margin:0;border:0;" class="pointer" />
								</span>
							</div>
						</div>
						
						<div class="row" style="text-align:center;">
							<table class="ds_box" cellpadding="0" cellspacing="0" id="ds_conclass1" style="display:none;margin:10px auto 0 auto;">
								<tr>
									<td id="ds_calclass1" valign="top"></td>
									<td id="ds_calclass2" valign="top"></td>
								</tr>
							</table>
						</div>
						
						<div class="row">
							<label for="compagnie_depart_vol" class="label_cote_4 col-xs-12 col-sm-6 col-md-4" style="text-transform:none;"><?php echo $tpl->vars['COMPAGNIE_VOL']; ?><sup class="rouge">*</sup></label>
							<input class="col-xs-9 col-sm-6 col-md-4" type="text" id="compagnie_depart_vol" name="compagnie_depart_vol" value="<?php echo $tpl->vars['TXT_COMPAGNIE_DEPART_VOL']; ?>" />
							<div class="col-xs-3 col-sm-6 col-md-4"><img class="pointer" style="margin-left:5px;" src="images/icones/info-16.png" alt="<?php echo $tpl->vars['ALT_AIDE']; ?>" onclick='$("#popup_aideVol").dialog("open");' /></div>
						</div>

						<div class="row">
							<label for="provenance_depart_vol_2" class="label_cote_4 col-xs-12 col-sm-6 col-md-4" style="text-transform:none;"><?php echo $tpl->vars['PROVENANCE_VOL']; ?><sup class="rouge">*</sup></label>
							<input class="col-xs-9 col-sm-6 col-md-4" type="text" id="provenance_depart_vol_2" name="provenance_depart_vol_2" maxlength="40" value="<?php echo $tpl->vars['TXT_PROVENANCE_DEPART_VOL_2']; ?>"/>
							<div class="col-xs-3 col-sm-6 col-md-4"><img class="pointer" style="margin-left:5px;" src="images/icones/info-16.png" alt="<?php echo $tpl->vars['ALT_AIDE']; ?>" onclick='$("#popup_aideVol").dialog("open");' /></div>
						</div>

						<div class="row">
							<label for="provenance_depart_vol_1" class="label_cote_4 col-xs-12 col-sm-6 col-md-4" style="text-transform:none;"><?php echo $tpl->vars['DEST_VOL']; ?><sup class="rouge">*</sup></label>
							<input class="col-xs-9 col-sm-6 col-md-4" type="text" id="provenance_depart_vol_1" name="provenance_depart_vol_1" maxlength="40" value="<?php echo $tpl->vars['TXT_PROVENANCE_DEPART_VOL_1']; ?>" />
							<div class="col-xs-3 col-sm-6 col-md-4"><img class="pointer" style="margin-left:5px;" src="images/icones/info-16.png" alt="<?php echo $tpl->vars['ALT_AIDE']; ?>" onclick='$("#popup_aideVol").dialog("open");' /></div>
						</div>

						<div class="row">
							<label for="heure_depart_vol" class="label_cote_4 col-xs-12 col-sm-6 col-md-4" style="text-transform:none;"><span id="text_heure_vol_1"><?php echo $tpl->vars['HEURE_VOL']; ?></span><sup class="rouge">*</sup></label>
							<div class="col-xs-9 col-sm-6 col-md-4" style="padding:0;">
								<select name="heure_depart_vol" id="heure_depart_vol">

									<?php foreach ($tpl->vars['HEURE_LST'] as $__tpl_foreach_key['HEURE_LST'] => $__tpl_foreach_value['HEURE_LST']) : ?>

										<?php if ($__tpl_foreach_value['HEURE_LST']['code_heure'] == $tpl->vars['TXT_HEURE_DEPART_VOL']) : ?>

											<option value="<?php echo $__tpl_foreach_value['HEURE_LST']['code_heure']; ?>" selected="selected"><?php echo $__tpl_foreach_value['HEURE_LST']['heure']; ?></option>

										<?php else : ?>

											<option value="<?php echo $__tpl_foreach_value['HEURE_LST']['code_heure']; ?>"><?php echo $__tpl_foreach_value['HEURE_LST']['heure']; ?></option>

										<?php endif; ?>

									<?php endforeach; ?>

								</select>
								<span>h</span>
								<select name="minute_depart_vol" id="minute_depart_vol">

									<?php foreach ($tpl->vars['MINUTE_LST'] as $__tpl_foreach_key['MINUTE_LST'] => $__tpl_foreach_value['MINUTE_LST']) : ?>

										<?php if ($__tpl_foreach_value['MINUTE_LST']['code_heure'] == $tpl->vars['TXT_MINUTE_DEPART_VOL']) : ?>

											<option value="<?php echo $__tpl_foreach_value['MINUTE_LST']['code_heure']; ?>" selected="selected"><?php echo $__tpl_foreach_value['MINUTE_LST']['heure']; ?></option>

										<?php else : ?>

											<option value="<?php echo $__tpl_foreach_value['MINUTE_LST']['code_heure']; ?>"><?php echo $__tpl_foreach_value['MINUTE_LST']['heure']; ?></option>

										<?php endif; ?>

									<?php endforeach; ?>

								</select>
							</div>
						</div>
					</div>

					<div class="row" id="vol_retour" style="display:none;margin-top:10px;">
						<div class="header_tab" style="display:none;width:100%;text-align:center;font-weight:bold;color:black;border-bottom:2px solid #00A0C3;margin-bottom:10px;"><?php echo $tpl->vars['RETOUR']; ?></div>

						<div class="row">
							<span class="label_cote_4 col-xs-12 col-sm-6 col-md-4" style="text-transform:none;"><?php echo $tpl->vars['DATE_RETOUR']; ?><sup class="rouge">*</sup></span>
							<div class="col-xs-9 col-sm-6 col-md-4">
								<span class="pointer" id="lbl_jour_retour" style="background-color:#FFF" onclick="document.getElementById('ds_conclass1').style.display='none';ds_sh('lbl_jour_retour', 'ds_conclass2', 'ds_calclass3', '1');ds_sh('lbl_jour_retour', 'ds_conclass2', 'ds_calclass4', '2');"><?php echo $tpl->vars['SELECTIONNER_DATE_RETOUR']; ?></span>
								<span>
									<input type="hidden" name="jour_retour" id="jour_retour" value="<?php echo $tpl->vars['TXT_JOUR_RETOUR']; ?>" />
									<input type="hidden" name="jour_retour_long" id="jour_retour_long" value="<?php echo $tpl->vars['TXT_JOUR_RETOUR_LONG']; ?>" />
									<input type="button" onfocus="ds_sh('lbl_jour_retour', 'ds_conclass2', 'ds_calclass3', '1');ds_sh('lbl_jour_retour', 'ds_conclass2', 'ds_calclass4', '2');" onclick="ds_sh('lbl_jour_retour', 'ds_conclass2', 'ds_calclass3', '1');ds_sh('lbl_jour_retour', 'ds_conclass2', 'ds_calclass4', '2');" style="background-image:url(images/icones/calendar-16.png); height:16px; width:16px;padding:0;margin:0;border:0;" class="pointer" />
								</span>
							</div>
						</div>
							
						<div class="row" style="text-align:center;">
							<table class="ds_box" cellpadding="0" cellspacing="0" id="ds_conclass2" style="display:none;margin:10px auto 0 auto;">
								<tr style="float:left; display:inline;">
									<td id="ds_calclass3" valign="top"></td>
									<td id="ds_calclass4" valign="top"></td>
								</tr>
							</table>
						</div>
								
						<div class="row">
							<label for="compagnie_retour_vol" class="label_cote_4 col-xs-12 col-sm-6 col-md-4" style="text-transform:none;"><?php echo $tpl->vars['COMPAGNIE_VOL']; ?><sup class="rouge">*</sup></label>
							<input class="col-xs-9 col-sm-6 col-md-4" type="text" id="compagnie_retour_vol" name="compagnie_retour_vol" value="<?php echo $tpl->vars['TXT_COMPAGNIE_RETOUR_VOL']; ?>" />
							<div class="col-xs-3 col-sm-6 col-md-4"><img class="pointer" style="margin-left:5px;" src="images/icones/info-16.png" alt="<?php echo $tpl->vars['ALT_AIDE']; ?>" onclick='$("#popup_aideVol").dialog("open");' /></div>
						</div>

						<div class="row">
							<label for="provenance_retour_vol_1" class="label_cote_4 col-xs-12 col-sm-6 col-md-4" style="text-transform:none;"><?php echo $tpl->vars['PROVENANCE_VOL']; ?><sup class="rouge">*</sup></label>
							<input class="col-xs-9 col-sm-6 col-md-4" type="text" id="provenance_retour_vol_1" name="provenance_retour_vol_1" maxlength="40" value="<?php echo $tpl->vars['TXT_PROVENANCE_RETOUR_VOL_1']; ?>" />
							<div class="col-xs-3 col-sm-6 col-md-4"><img class="pointer" style="margin-left:5px;" src="images/icones/info-16.png" alt="<?php echo $tpl->vars['ALT_AIDE']; ?>" onclick='$("#popup_aideVol").dialog("open");' /></div>
						</div>

						<div class="row">
							<label for="provenance_retour_vol_2" class="label_cote_4 col-xs-12 col-sm-6 col-md-4" style="text-transform:none;"><?php echo $tpl->vars['DEST_VOL']; ?><sup class="rouge">*</sup></label>
							<input class="col-xs-9 col-sm-6 col-md-4" type="text" id="provenance_retour_vol_2" name="provenance_retour_vol_2" maxlength="40" value="<?php echo $tpl->vars['TXT_PROVENANCE_RETOUR_VOL_2']; ?>" />
							<div class="col-xs-3 col-sm-6 col-md-4"><img class="pointer" style="margin-left:5px;" src="images/icones/info-16.png" alt="<?php echo $tpl->vars['ALT_AIDE']; ?>" onclick='$("#popup_aideVol").dialog("open");' /></div>
						</div>

						<div class="row">
							<label for="heure_retour_vol" class="label_cote_4 col-xs-12 col-sm-6 col-md-4" style="text-transform:none;"><span id="text_heure_vol_2"><?php echo $tpl->vars['HEURE_VOL']; ?></span><sup class="rouge">*</sup></label>
							<div class="col-xs-9 col-sm-6 col-md-4" style="padding:0;">
								<select name="heure_retour_vol" id="heure_retour_vol">

									<?php foreach ($tpl->vars['HEURE_LST'] as $__tpl_foreach_key['HEURE_LST'] => $__tpl_foreach_value['HEURE_LST']) : ?>

										<?php if ($__tpl_foreach_value['HEURE_LST']['code_heure'] == $tpl->vars['TXT_HEURE_RETOUR_VOL']) : ?>

											<option value="<?php echo $__tpl_foreach_value['HEURE_LST']['code_heure']; ?>" selected="selected"><?php echo $__tpl_foreach_value['HEURE_LST']['heure']; ?></option>

										<?php else : ?>

											<option value="<?php echo $__tpl_foreach_value['HEURE_LST']['code_heure']; ?>"><?php echo $__tpl_foreach_value['HEURE_LST']['heure']; ?></option>

										<?php endif; ?>

									<?php endforeach; ?>

								</select>
								<span>h</span>
								<select name="minute_retour_vol" id="minute_retour_vol">

									<?php foreach ($tpl->vars['MINUTE_LST'] as $__tpl_foreach_key['MINUTE_LST'] => $__tpl_foreach_value['MINUTE_LST']) : ?>

										<?php if ($__tpl_foreach_value['MINUTE_LST']['code_heure'] == $tpl->vars['TXT_MINUTE_RETOUR_VOL']) : ?>

											<option value="<?php echo $__tpl_foreach_value['MINUTE_LST']['code_heure']; ?>" selected="selected"><?php echo $__tpl_foreach_value['MINUTE_LST']['heure']; ?></option>

										<?php else : ?>

											<option value="<?php echo $__tpl_foreach_value['MINUTE_LST']['code_heure']; ?>"><?php echo $__tpl_foreach_value['MINUTE_LST']['heure']; ?></option>

										<?php endif; ?>

									<?php endforeach; ?>

								</select>
							</div>
						</div>
					</div>
				</div>
					
				<div class="row">
					<h4 class="demande_reservation_form_titre"><?php echo $tpl->vars['INFO_TRANSPORT']; ?></h4>
					<div class="row info_transport">
						<div class="header_tab" style="display:none;width:100%;text-align:center;font-weight:bold;color:black;border-bottom:2px solid #00A0C3;margin-bottom:10px;"><?php echo $tpl->vars['ALLER']; ?></div>
						
						<?php if ($tpl->vars['CHANGE_ALLER'] != '') : ?>
							<div class="row" id="horaire_aller">
								<p class="col-xs-12 col-sm-6 col-md-4" style="text-transform:none;"><?php echo $tpl->vars['HORAIRE_CHOISI']; ?><sup class="rouge">**</sup></p>
								<p class="col-xs-3 col-sm-6 col-md-4"><?php echo $tpl->vars['NOUVEL_HORAIRE_ALLER']; ?></p>
								<input type="hidden" value="<?php echo $tpl->vars['NOUVEL_HORAIRE_ALLER']; ?>" name="nouvel_horaire_aller">
							</div>
						<?php endif; ?>	
						
						<div class="row" id="horaire_fixe_aller" style="display:none;">
							<label for="lst_fixe_depart" class="label_cote_4 col-xs-12 col-sm-6 col-md-4" style="text-transform:none;"><?php echo $tpl->vars['FIXE_ALLER']; ?><sup class="rouge">**</sup></label>
							<select id="lst_fixe_depart" name="lst_fixe_depart"><option></option></select>
							<img class="pointer" src="images/icones/info-16.png" alt="<?php echo $tpl->vars['ALT_AIDE']; ?>" onclick='$("#popup_aideFixe").dialog("open");' />
							<input type="hidden" value="<?php echo $tpl->vars['HEURE_DEPART_CHERCHE']; ?>" id="heure_depart_cherche">
						</div>
						
						<div class="row">
							<label for="lst_heure_depart" class="label_cote_4 col-xs-12 col-sm-6 col-md-4" style="text-transform:none;"><?php echo $tpl->vars['HEURE_DEPART']; ?><sup class="rouge">*</sup><span id="etoile_depart" style="display:none"><sup class="rouge">*</sup></span></label>
							<select name="lst_heure_depart" id="lst_heure_depart">

								<?php foreach ($tpl->vars['LST_HEURE'] as $__tpl_foreach_key['LST_HEURE'] => $__tpl_foreach_value['LST_HEURE']) : ?>

									<?php if ($__tpl_foreach_value['LST_HEURE']['code_heure'] == $tpl->vars['HEURE_DEPART_CHERCHE'] && $tpl->vars['HEURE_FIXE_ALLER'] == 0) : ?>

										<option value="<?php echo $__tpl_foreach_value['LST_HEURE']['code_heure']; ?>" selected="selected"><?php echo $__tpl_foreach_value['LST_HEURE']['heure']; ?></option>

									<?php else : ?>

										<option value="<?php echo $__tpl_foreach_value['LST_HEURE']['code_heure']; ?>"><?php echo $__tpl_foreach_value['LST_HEURE']['heure']; ?></option>

									<?php endif; ?>

								<?php endforeach; ?>

							</select>
							<img class="pointer" src="images/icones/info-16.png" alt="<?php echo $tpl->vars['ALT_AIDE']; ?>" onclick='$("#popup_aideDemande").dialog("open");'/>
						</div>

						<div class="row">
							<label for="pt_rassemblement_aller" class="label_cote_4 col-xs-12 col-sm-6 col-md-4" style="text-transform:none;"><span id="label_pt_rassemblement_aller" ><?php echo $tpl->vars['PT_RASSEMBLEMENT']; ?></span><sup class="rouge">*</sup></label>
							<select name="pt_rassemblement_aller" id="pt_rassemblement_aller" class="col-xs-9 col-sm-6 col-md-4">

								<?php foreach ($tpl->vars['LST_PT_RASSEMBLEMENT'] as $__tpl_foreach_key['PT'] => $__tpl_foreach_value['PT']) : ?>

									<?php if ($__tpl_foreach_value['PT']['id_pt'] == $tpl->vars['PT_RASSEMBLEMENT_ALLER_CHERCHE']) : ?>

										<option value="<?php echo $__tpl_foreach_value['PT']['id_pt']; ?>" selected="selected"><?php echo $__tpl_foreach_value['PT']['nom']; ?></option>

									<?php else : ?>

										<option value="<?php echo $__tpl_foreach_value['PT']['id_pt']; ?>"><?php echo $__tpl_foreach_value['PT']['nom']; ?></option>

									<?php endif; ?>

								<?php endforeach; ?>

							</select>
							<div class="col-xs-3 col-sm-6 col-md-4"><img class="pointer" style="margin-left:5px;" src="images/icones/info-16.png" alt="<?php echo $tpl->vars['ALT_AIDE']; ?>" onclick='$("#popup_aideRassemblement").dialog("open");' /></div>
						</div>
						
						<div class="row" id="rass_aller" style="display:none">								
							<div class="row">
								<label for="rass_adresse_aller" class="label_cote_4 col-xs-12 col-sm-6 col-md-4" style="text-transform:none;"><?php echo $tpl->vars['ADRESSE_CLIENT']; ?> <sup class="rouge">*</span></label>
								<input class="col-xs-9 col-sm-6 col-md-4" type="text" id="rass_adresse_aller" name="rass_adresse_aller" value="<?php echo $tpl->vars['TXT_RASS_ADRESSE_ALLER']; ?>" maxlength="200" />
							</div>

							<div class="row">
								<label for="rass_cp_aller" class="label_cote_4 col-xs-12 col-sm-6 col-md-4" style="text-transform:none;"><?php echo $tpl->vars['CODE_POST_CLIENT']; ?> <sup class="rouge">*</sup></label>
								<input class="col-xs-9 col-sm-6 col-md-4" type="text" id="rass_cp_aller" name="rass_cp_aller" value="<?php echo $tpl->vars['TXT_RASS_CP_ALLER']; ?>" maxlength="5" />
							</div>

							<div class="row">
								<label for="rass_ville_aller" class="label_cote_4 col-xs-12 col-sm-6 col-md-4" style="text-transform:none;"><?php echo $tpl->vars['VILLE_CLIENT']; ?> <sup class="rouge">*</sup></label>
								<input class="col-xs-9 col-sm-6 col-md-4" type="text" id="rass_ville_aller" name="rass_ville_aller" value="<?php echo $tpl->vars['TXT_RASS_VILLE_ALLER']; ?>" maxlength="50" />
							</div>
						</div>
					</div>
				
					<div class="row" id="retour" style="display:none;">
				
						<div class="header_tab" style="display:none;width:100%;text-align:center;font-weight:bold;color:black;border-bottom:2px solid #00A0C3;margin-bottom:10px;"><?php echo $tpl->vars['RETOUR']; ?></div>

						<?php if ($tpl->vars['CHANGE_RETOUR'] != '') : ?>
							<div class="row" id="horaire_retour">
								<p class="col-xs-12 col-sm-6 col-md-4" style="text-transform:none;"><?php echo $tpl->vars['HORAIRE_CHOISI']; ?><sup class="rouge">**</sup></p>
								<p class="col-xs-3 col-sm-6 col-md-4"><?php echo $tpl->vars['NOUVEL_HORAIRE_RETOUR']; ?></p>
								<input type="hidden" value="<?php echo $tpl->vars['NOUVEL_HORAIRE_RETOUR']; ?>" name="nouvel_horaire_retour">
							</div>
						<?php endif; ?>
						
						<div class="row" id="horaire_fixe_retour">
							<label for="lst_fixe_retour" class="label_cote_4 col-xs-12 col-sm-6 col-md-4" style="text-transform:none;"><?php echo $tpl->vars['FIXE_RETOUR']; ?><sup class="rouge">**</sup></label>
							<select id="lst_fixe_retour" name="lst_fixe_retour"><option></option></select> 
							<img class="pointer" src="images/icones/info-16.png" alt="<?php echo $tpl->vars['ALT_AIDE']; ?>" onclick='$("#popup_aideFixe").dialog("open");' />
							<input type="hidden" value="<?php echo $tpl->vars['HEURE_RETOUR_CHERCHE']; ?>" id="heure_retour_cherche">
						</div>

						<div class="row">
							<label for="lst_heure_retour" class="label_cote_4 col-xs-12 col-sm-6 col-md-4" style="text-transform:none;"><?php echo $tpl->vars['HEURE_RETOUR']; ?><sup class="rouge">*</sup><span id="etoile_retour"><sup class="rouge">*</sup></span></label>
							<select name="lst_heure_retour" id="lst_heure_retour">

								<?php foreach ($tpl->vars['LST_HEURE'] as $__tpl_foreach_key['LST_HEURE'] => $__tpl_foreach_value['LST_HEURE']) : ?>

									<?php if ($__tpl_foreach_value['LST_HEURE']['code_heure'] == $tpl->vars['HEURE_RETOUR_CHERCHE'] && $tpl->vars['HEURE_FIXE_RETOUR'] == 0) : ?>

										<option value="<?php echo $__tpl_foreach_value['LST_HEURE']['code_heure']; ?>" selected="selected"><?php echo $__tpl_foreach_value['LST_HEURE']['heure']; ?></option>

									<?php else : ?>

										<option value="<?php echo $__tpl_foreach_value['LST_HEURE']['code_heure']; ?>"><?php echo $__tpl_foreach_value['LST_HEURE']['heure']; ?></option>

									<?php endif; ?>

								<?php endforeach; ?>

							</select>
							<img class="pointer" src="images/icones/info-16.png" alt="<?php echo $tpl->vars['ALT_AIDE']; ?>" onclick='$("#popup_aideDemande").dialog("open");' />
						</div>

						<div class="row">
							<label for="pt_rassemblement_retour" class="label_cote_4 col-xs-12 col-sm-6 col-md-4" style="text-transform:none;"><span id="label_pt_rassemblement_retour" ><?php echo $tpl->vars['PT_RASSEMBLEMENT']; ?></span><sup class="rouge">*</sup></label>
							<select name="pt_rassemblement_retour" id="pt_rassemblement_retour" class="valign_select" style="width:200px;">

								<?php foreach ($tpl->vars['LST_PT_RASSEMBLEMENT'] as $__tpl_foreach_key['PT'] => $__tpl_foreach_value['PT']) : ?>

									<?php if ($__tpl_foreach_value['PT']['id_pt'] == $tpl->vars['PT_RASSEMBLEMENT_RETOUR_CHERCHE']) : ?>

										<option value="<?php echo $__tpl_foreach_value['PT']['id_pt']; ?>" selected="selected"><?php echo $__tpl_foreach_value['PT']['nom']; ?></option>

									<?php else : ?>

										<option value="<?php echo $__tpl_foreach_value['PT']['id_pt']; ?>"><?php echo $__tpl_foreach_value['PT']['nom']; ?></option>

									<?php endif; ?>

								<?php endforeach; ?>

							</select>
							<img class="pointer" src="images/icones/info-16.png" alt="<?php echo $tpl->vars['ALT_AIDE']; ?>" onclick='$("#popup_aideRassemblement").dialog("open");' />
						</div>
							
						<div class="row" id="rass_retour" style="display:none">									
							<div class="row">
								<label for="rass_adresse_retour" class="label_cote_4 col-xs-12 col-sm-6 col-md-4" style="text-transform:none;"><?php echo $tpl->vars['ADRESSE_CLIENT']; ?> <sup class="rouge">*</sup></label>
								<input class="col-xs-9 col-sm-6 col-md-4" type="text" id="rass_adresse_retour" name="rass_adresse_retour" value="<?php echo $tpl->vars['TXT_RASS_ADRESSE_RETOUR']; ?>" maxlength="200" />
							</div>

							<div class="row">
								<label for="rass_cp_retour" class="label_cote_4 col-xs-12 col-sm-6 col-md-4" style="text-transform:none;"><?php echo $tpl->vars['CODE_POST_CLIENT']; ?> <sup class="rouge">*</sup></label>
								<input class="col-xs-9 col-sm-6 col-md-4" type="text" id="rass_cp_retour" name="rass_cp_retour" value="<?php echo $tpl->vars['TXT_RASS_CP_RETOUR']; ?>" maxlength="5" />
							</div>

							<div class="row">
								<label for="rass_ville_retour" class="label_cote_4 col-xs-12 col-sm-6 col-md-4" style="text-transform:none;"><?php echo $tpl->vars['VILLE_CLIENT']; ?> <sup class="rouge">*</sup></label>
								<input class="col-xs-9 col-sm-6 col-md-4" type="text" id="rass_ville_retour" name="rass_ville_retour" value="<?php echo $tpl->vars['TXT_RASS_VILLE_RETOUR']; ?>" maxlength="50" />
							</div>
						</div>
						
					</div>
				</div>
				
				<div class="row">
					<h4 class="demande_reservation_form_titre"><?php echo $tpl->vars['NOMBRE_PASSAGER']; ?></h4>
					<div class="row passager">
					<!--<table>
						<tr>
							<th class="header_tab" style="display:none;width:350px;padding:1px;color:#363636;background:#F4BE04;"><?php echo $tpl->vars['ALLER']; ?></th>
							<th class="header_tab" style="display:none;width:350px;padding:1px;color:#363636;background:#F4BE04;"><?php echo $tpl->vars['RETOUR']; ?></th>
						</tr>
						
						<tr>
							<th class="header_tab" style="display:none;">&nbsp;</th>
							<th class="header_tab" style="display:none;">&nbsp;</th>
						</tr>

						<tr>
							<td>-->
						<div class="row">
							<label for="lst_passager_adulte_aller" class="label_cote_4 col-xs-12 col-sm-6 col-md-4" style="text-transform:none;"><?php echo $tpl->vars['PASSAGER_ADULTE']; ?><sup class="rouge">*</sup></label>
							<select name="lst_passager_adulte_aller" id="lst_passager_adulte_aller">
							
								<?php foreach ($tpl->vars['LST_PERSONNE'] as $__tpl_foreach_key['LST_PERSONNE'] => $__tpl_foreach_value['LST_PERSONNE']) : ?>

									<?php if ($__tpl_foreach_value['LST_PERSONNE']['personne'] == $tpl->vars['NB_PERSONNE_CHERCHE_ALLER']) : ?>

										<option value="<?php echo $__tpl_foreach_value['LST_PERSONNE']['personne']; ?>" selected="selected"><?php echo $__tpl_foreach_value['LST_PERSONNE']['personne']; ?></option>

									<?php else : ?>

										<option value="<?php echo $__tpl_foreach_value['LST_PERSONNE']['personne']; ?>"><?php echo $__tpl_foreach_value['LST_PERSONNE']['personne']; ?></option>

									<?php endif; ?>

								<?php endforeach; ?>

							</select>
						</div>

						<div class="row">
							<label for="lst_passager_enfant_aller" class="label_cote_4 col-xs-12 col-sm-6 col-md-4" style="text-transform:none;"><?php echo $tpl->vars['PASSAGER_ENFANT']; ?><sup class="rouge">*</sup></label>
							<select name="lst_passager_enfant_aller" id="lst_passager_enfant_aller">

								<?php foreach ($tpl->vars['LST_ENFANT'] as $__tpl_foreach_key['LST_ENFANT'] => $__tpl_foreach_value['LST_ENFANT']) : ?>

									<?php if ($__tpl_foreach_value['LST_ENFANT']['personne'] == $tpl->vars['NB_ENFANT_CHERCHE_ALLER']) : ?>

										<option value="<?php echo $__tpl_foreach_value['LST_ENFANT']['personne']; ?>" selected="selected"><?php echo $__tpl_foreach_value['LST_ENFANT']['personne']; ?></option>

									<?php else : ?>

										<option value="<?php echo $__tpl_foreach_value['LST_ENFANT']['personne']; ?>"><?php echo $__tpl_foreach_value['LST_ENFANT']['personne']; ?></option>

									<?php endif; ?>

								<?php endforeach; ?>

							</select>
						</div>

						<div class="row" id="passager_aller_enfant" style="display:none">
							<div class="row">
								<label for="lst_passager_enfant_aller_g0" class="label_cote_4 col-xs-12 col-sm-6 col-md-4" style="text-transform:none;"><?php echo $tpl->vars['PASSAGER_ENFANT_G0']; ?><sup class="rouge">*</sup></label>
								<select name="lst_passager_enfant_aller_g0" id="lst_passager_enfant_aller_g0">

									<?php foreach ($tpl->vars['LST_ENFANT'] as $__tpl_foreach_key['LST_ENFANT'] => $__tpl_foreach_value['LST_ENFANT']) : ?>

										<?php if ($__tpl_foreach_value['LST_ENFANT']['personne'] == $tpl->vars['NB_ENFANT_CHERCHE_ALLER_G0']) : ?>

											<option value="<?php echo $__tpl_foreach_value['LST_ENFANT']['personne']; ?>" selected="selected"><?php echo $__tpl_foreach_value['LST_ENFANT']['personne']; ?></option>

										<?php else : ?>

											<option value="<?php echo $__tpl_foreach_value['LST_ENFANT']['personne']; ?>"><?php echo $__tpl_foreach_value['LST_ENFANT']['personne']; ?></option>

										<?php endif; ?>

									<?php endforeach; ?>

								</select>
							</div>

							<div class="row">
								<label for="lst_passager_enfant_aller_g1" class="label_cote_4 col-xs-12 col-sm-6 col-md-4" style="text-transform:none;"><?php echo $tpl->vars['PASSAGER_ENFANT_G1']; ?><sup class="rouge">*</sup></label>
								<select name="lst_passager_enfant_aller_g1" id="lst_passager_enfant_aller_g1">

									<?php foreach ($tpl->vars['LST_ENFANT'] as $__tpl_foreach_key['LST_ENFANT'] => $__tpl_foreach_value['LST_ENFANT']) : ?>

										<?php if ($__tpl_foreach_value['LST_ENFANT']['personne'] == $tpl->vars['NB_ENFANT_CHERCHE_ALLER_G1']) : ?>

											<option value="<?php echo $__tpl_foreach_value['LST_ENFANT']['personne']; ?>" selected="selected"><?php echo $__tpl_foreach_value['LST_ENFANT']['personne']; ?></option>

										<?php else : ?>

											<option value="<?php echo $__tpl_foreach_value['LST_ENFANT']['personne']; ?>"><?php echo $__tpl_foreach_value['LST_ENFANT']['personne']; ?></option>

										<?php endif; ?>

									<?php endforeach; ?>

								</select>
							</div>

							<div class="row">
								<label for="lst_passager_enfant_aller_g2" class="label_cote_4 col-xs-12 col-sm-6 col-md-4" style="text-transform:none;"><?php echo $tpl->vars['PASSAGER_ENFANT_G2']; ?><sup class="rouge">*</sup></label>
								<select name="lst_passager_enfant_aller_g2" id="lst_passager_enfant_aller_g2">

									<?php foreach ($tpl->vars['LST_ENFANT'] as $__tpl_foreach_key['LST_ENFANT'] => $__tpl_foreach_value['LST_ENFANT']) : ?>

										<?php if ($__tpl_foreach_value['LST_ENFANT']['personne'] == $tpl->vars['NB_ENFANT_CHERCHE_ALLER_G2']) : ?>

											<option value="<?php echo $__tpl_foreach_value['LST_ENFANT']['personne']; ?>" selected="selected"><?php echo $__tpl_foreach_value['LST_ENFANT']['personne']; ?></option>

										<?php else : ?>

											<option value="<?php echo $__tpl_foreach_value['LST_ENFANT']['personne']; ?>"><?php echo $__tpl_foreach_value['LST_ENFANT']['personne']; ?></option>

										<?php endif; ?>

									<?php endforeach; ?>

								</select>
							</div>
							
							<div class="row">
								<label for="lst_passager_enfant_aller_g3" class="label_cote_4 col-xs-12 col-sm-6 col-md-4" style="text-transform:none;"><?php echo $tpl->vars['PASSAGER_ENFANT_G3']; ?><sup class="rouge">*</sup></label>
								<select name="lst_passager_enfant_aller_g3" id="lst_passager_enfant_aller_g3">

									<?php foreach ($tpl->vars['LST_ENFANT'] as $__tpl_foreach_key['LST_ENFANT'] => $__tpl_foreach_value['LST_ENFANT']) : ?>

										<?php if ($__tpl_foreach_value['LST_ENFANT']['personne'] == $tpl->vars['NB_ENFANT_CHERCHE_ALLER_G3']) : ?>

											<option value="<?php echo $__tpl_foreach_value['LST_ENFANT']['personne']; ?>" selected="selected"><?php echo $__tpl_foreach_value['LST_ENFANT']['personne']; ?></option>

										<?php else : ?>

											<option value="<?php echo $__tpl_foreach_value['LST_ENFANT']['personne']; ?>"><?php echo $__tpl_foreach_value['LST_ENFANT']['personne']; ?></option>

										<?php endif; ?>

									<?php endforeach; ?>

								</select>
							</div>
						</div>
					</div>
				</div><!--
							</td>

							<td>
							
								<div id="passager_retour" style="display:none;">

									<label for="lst_passager_adulte_retour" class="label_cote_4"><?php echo $tpl->vars['PASSAGER_ADULTE']; ?> <span class="rouge">*</span> : </label>
									<select name="lst_passager_adulte_retour" id="lst_passager_adulte_retour">

										<?php foreach ($tpl->vars['LST_PERSONNE'] as $__tpl_foreach_key['LST_PERSONNE'] => $__tpl_foreach_value['LST_PERSONNE']) : ?>

											<?php if ($__tpl_foreach_value['LST_PERSONNE']['personne'] == $tpl->vars['NB_PERSONNE_CHERCHE_RETOUR']) : ?>

												<option value="<?php echo $__tpl_foreach_value['LST_PERSONNE']['personne']; ?>" selected="selected"><?php echo $__tpl_foreach_value['LST_PERSONNE']['personne']; ?></option>

											<?php else : ?>

												<option value="<?php echo $__tpl_foreach_value['LST_PERSONNE']['personne']; ?>"><?php echo $__tpl_foreach_value['LST_PERSONNE']['personne']; ?></option>

											<?php endif; ?>

										<?php endforeach; ?>

									</select>

									<br />

									<label for="lst_passager_enfant_retour" class="label_cote_4"><?php echo $tpl->vars['PASSAGER_ENFANT']; ?> <span class="rouge">*</span> : </label>
									<select name="lst_passager_enfant_retour" id="lst_passager_enfant_retour">

										<?php foreach ($tpl->vars['LST_ENFANT'] as $__tpl_foreach_key['LST_ENFANT'] => $__tpl_foreach_value['LST_ENFANT']) : ?>

											<?php if ($__tpl_foreach_value['LST_ENFANT']['personne'] == $tpl->vars['NB_ENFANT_CHERCHE_RETOUR']) : ?>

												<option value="<?php echo $__tpl_foreach_value['LST_ENFANT']['personne']; ?>" selected="selected"><?php echo $__tpl_foreach_value['LST_ENFANT']['personne']; ?></option>

											<?php else : ?>

												<option value="<?php echo $__tpl_foreach_value['LST_ENFANT']['personne']; ?>"><?php echo $__tpl_foreach_value['LST_ENFANT']['personne']; ?></option>

											<?php endif; ?>

										<?php endforeach; ?>

									</select>
									<br />

									<div id="passager_retour_enfant" style="display:none">
										<br />

										<span>
											<label for="lst_passager_enfant_retour_g0" class="label_cote_4"><?php echo $tpl->vars['PASSAGER_ENFANT_G0']; ?> <span class="rouge">*</span> : </label>
											<select name="lst_passager_enfant_retour_g0" id="lst_passager_enfant_retour_g0">

												<?php foreach ($tpl->vars['LST_ENFANT'] as $__tpl_foreach_key['LST_ENFANT'] => $__tpl_foreach_value['LST_ENFANT']) : ?>

													<?php if ($__tpl_foreach_value['LST_ENFANT']['personne'] == $tpl->vars['NB_ENFANT_CHERCHE_RETOUR_G0']) : ?>

														<option value="<?php echo $__tpl_foreach_value['LST_ENFANT']['personne']; ?>" selected="selected"><?php echo $__tpl_foreach_value['LST_ENFANT']['personne']; ?></option>

													<?php else : ?>

														<option value="<?php echo $__tpl_foreach_value['LST_ENFANT']['personne']; ?>"><?php echo $__tpl_foreach_value['LST_ENFANT']['personne']; ?></option>

													<?php endif; ?>

												<?php endforeach; ?>

											</select>
										</span>

										<br />

										<span>
											<label for="lst_passager_enfant_retour_g1" class="label_cote_4"><?php echo $tpl->vars['PASSAGER_ENFANT_G1']; ?> <span class="rouge">*</span> : </label>
											<select name="lst_passager_enfant_retour_g1" id="lst_passager_enfant_retour_g1">

												<?php foreach ($tpl->vars['LST_ENFANT'] as $__tpl_foreach_key['LST_ENFANT'] => $__tpl_foreach_value['LST_ENFANT']) : ?>

													<?php if ($__tpl_foreach_value['LST_ENFANT']['personne'] == $tpl->vars['NB_ENFANT_CHERCHE_RETOUR_G1']) : ?>

														<option value="<?php echo $__tpl_foreach_value['LST_ENFANT']['personne']; ?>" selected="selected"><?php echo $__tpl_foreach_value['LST_ENFANT']['personne']; ?></option>

													<?php else : ?>

														<option value="<?php echo $__tpl_foreach_value['LST_ENFANT']['personne']; ?>"><?php echo $__tpl_foreach_value['LST_ENFANT']['personne']; ?></option>

													<?php endif; ?>

												<?php endforeach; ?>

											</select>
										</span>

										<br />

										<span>
											<label for="lst_passager_enfant_retour_g2" class="label_cote_4"><?php echo $tpl->vars['PASSAGER_ENFANT_G2']; ?> <span class="rouge">*</span> : </label>
											<select name="lst_passager_enfant_retour_g2" id="lst_passager_enfant_retour_g2">

												<?php foreach ($tpl->vars['LST_ENFANT'] as $__tpl_foreach_key['LST_ENFANT'] => $__tpl_foreach_value['LST_ENFANT']) : ?>

													<?php if ($__tpl_foreach_value['LST_ENFANT']['personne'] == $tpl->vars['NB_ENFANT_CHERCHE_RETOUR_G2']) : ?>

														<option value="<?php echo $__tpl_foreach_value['LST_ENFANT']['personne']; ?>" selected="selected"><?php echo $__tpl_foreach_value['LST_ENFANT']['personne']; ?></option>

													<?php else : ?>

														<option value="<?php echo $__tpl_foreach_value['LST_ENFANT']['personne']; ?>"><?php echo $__tpl_foreach_value['LST_ENFANT']['personne']; ?></option>

													<?php endif; ?>

												<?php endforeach; ?>

											</select>
										</span>

										<br />

										<span>
											<label for="lst_passager_enfant_retour_g3" class="label_cote_4"><?php echo $tpl->vars['PASSAGER_ENFANT_G3']; ?> <span class="rouge">*</span> : </label>
											<select name="lst_passager_enfant_retour_g3" id="lst_passager_enfant_retour_g3">

												<?php foreach ($tpl->vars['LST_ENFANT'] as $__tpl_foreach_key['LST_ENFANT'] => $__tpl_foreach_value['LST_ENFANT']) : ?>

													<?php if ($__tpl_foreach_value['LST_ENFANT']['personne'] == $tpl->vars['NB_ENFANT_CHERCHE_RETOUR_G3']) : ?>

														<option value="<?php echo $__tpl_foreach_value['LST_ENFANT']['personne']; ?>" selected="selected"><?php echo $__tpl_foreach_value['LST_ENFANT']['personne']; ?></option>

													<?php else : ?>

														<option value="<?php echo $__tpl_foreach_value['LST_ENFANT']['personne']; ?>"><?php echo $__tpl_foreach_value['LST_ENFANT']['personne']; ?></option>

													<?php endif; ?>

												<?php endforeach; ?>

											</select>
											
										</span>

									</div>

								</div>
								
							</td>
							
						</tr>
						
					</table>-->
				<div class="row">
					<h4 class="demande_reservation_form_titre"><?php echo $tpl->vars['CONFIRMATION']; ?></h4>
					<div class="row info_compl">
						<label for="info_compl" class="col-xs-12 col-sm-6 col-md-4" style="font-weight:normal;"><?php echo $tpl->vars['INFO_COMPL']; ?></label>
						<div class="col-xs-12 col-sm-6 col-md-8" style="padding:0;"><textarea rows="4" name="info_compl" id="info_compl" style="width:100%;max-width:100%;"><?php echo $tpl->vars['TXT_INFO_COMPL']; ?></textarea></div>
					</div>
				</div>
				
				<div class="row" style="margin-top:20px;">
					<div class="col-xs-2 col-sm-2 col-md-1" style="padding-right:5px;text-align:center;">
						<input type="checkbox" id="opt_annulation" name="opt_annulation" />
					</div>
					<div class="col-xs-10 col-sm-10 col-md-11" style="padding:0;">
						<label for="opt_annulation"><?php echo $tpl->vars['OPTION_ANNUL']; ?> </label>
						<img onclick='$("#popup_optionAnnulation").dialog("open");' class="pointer" id="icone_aide_option_annul" src="images/icones/info-16.png" />
					</div>
				</div>
				
				<div class="row">
					<div class="col-xs-2 col-sm-2 col-md-1" style="padding-right:5px;text-align:center;">
						<input type="checkbox" id="accept_cgv" name="accept_cgv"/>
					</div>
					<div class="col-xs-10 col-sm-10 col-md-11" style="padding:0;">
						<label for="accept_cgv" style="font-weight:bold;"><?php echo $tpl->vars['TXT_ACCEPT_CGV']; ?></label>
					</div>
				</div>
				
				<input type="hidden" name="res_1" id="res_1" value="0" />

				<div class="row" style="text-align:center;margin-top:10px;margin-bottom:10px;">
					<input type="button" value="<?php echo $tpl->vars['BTN_RAZ']; ?>" id="btn_raz" style="text-transform:uppercase;"/>
					<input type="button" value="<?php echo $tpl->vars['BTN_ENVOYER']; ?>" id="btn_envoie_res" style="text-transform:uppercase;"/>
				</div>
			</form>	
			
			<span style="font-size:0.8em;"><sup class="rouge">*</sup> : <?php echo $tpl->vars['OBLIGATOIRE']; ?>
				<br />
				<sup class="rouge">**</sup> : <?php echo $tpl->vars['OBLIGATOIRE_2']; ?>
			</span>
		</div>
	</div>
	
	<div class="col-xs-12 col-sm-6 col-md-6">
<!--
		<?php include("block_droite.html.php"); ?>  INCLUDE ICI
-->
	</div>
	
	</div>

<script type="text/javascript" src="scripts/ajax.js"></script>
<script type="text/javascript" src="scripts/accueil.js"></script>
<script src="scripts/swfobject_modified.js" type="text/javascript"></script>
<style type="text/css" src="scripts/ajax.js"></style>

<div id="popup_optionAnnulation" title="<?php echo $tpl->vars['ALT_AIDE']; ?>">
	<img class="pointer" src="images/icones/info-16.png" /> <?php echo $tpl->vars['EXPLI_OPTION_ANNUL']; ?>
</div>
<div id="popup_aideFixe" title="<?php echo $tpl->vars['ALT_AIDE']; ?>">
	<img class="pointer" src="images/icones/info-16.png" /> <?php echo $tpl->vars['HOVER_AIDE_FIXE']; ?>
</div>
<div id="popup_aideDemande" title="<?php echo $tpl->vars['ALT_AIDE']; ?>">
	<img class="pointer" src="images/icones/info-16.png" /> <?php echo $tpl->vars['HOVER_AIDE']; ?>
</div>
<div id="popup_aideRassemblement" title="<?php echo $tpl->vars['ALT_AIDE']; ?>">
	<img class="pointer" src="images/icones/info-16.png" /> <?php echo $tpl->vars['AIDE_PT_RASSEMBLEMENT']; ?>
</div>
<div id="popup_aideVol" title="<?php echo $tpl->vars['ALT_AIDE']; ?>">
	<img class="pointer" src="images/icones/info-16.png" /> <?php echo $tpl->vars['AIDE_VOL']; ?>
</div>

<script type="text/javascript">
	$(function() {		
		$( "#popup_optionAnnulation" ).dialog({
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
		$( "#popup_aideFixe" ).dialog({
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
		$( "#popup_aideDemande" ).dialog({
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
		$( "#popup_aideRassemblement" ).dialog({
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
		$( "#popup_aideVol" ).dialog({
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

