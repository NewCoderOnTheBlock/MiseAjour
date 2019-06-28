


<?php $tpl->includeTpl('aeroport/include.html', false, 0); ?>
<!--
fichier:aeroport.reservation.navette_dispo_aller
updated:19/06/2019
-->

<div id="contenu_v2">
	
	<!-- Bloc englobant toute la page -->
	<div class='blocTotal'>
		<div class='titreBlocTotal'>
			<span class='txt_titre_colonne_3c'><?php echo $tpl->vars['CHOIX_NAVETTE']; ?></span>
		</div>
		<div class='contenuBlocTotal' style="padding:10px;text-align:center;">

			<form id="form_back" action="index.html" method="post"></form>
				
			<!-- Bloc de "Mon Trajet" -->
			<div class='blocTotal_750'>
				<div class='titreBlocTotal_750'>
					<span class='txt_titre_centre_gauche_3c'><?php echo $tpl->vars['TITRE_MON_TRAJET']; ?></span>
				</div>
				<div class='contenuBlocTotal_750' style="padding:10px;">
					<table style="margin-left:37px" cellpadding="0" cellspacing="0">
						<tr>
							<td style="width:231px;padding:3px 0 3px 10px;">
								<span><strong><?php echo $tpl->vars['TYPE_TRAJET']; ?> :</strong> <?php echo $tpl->vars['TXT_TYPE_TRAJET']; ?></span>
							</td>
							<td style="width:232px;padding:3px 0 3px 0;">
								<span><strong><?php echo $tpl->vars['TRAJET_DEPART']; ?> :</strong> <?php echo $tpl->vars['TXT_TRAJET_DEPART']; ?></span>
							</td>
							<td style="width:231px;padding:3px 3px 3px 0;">
								<span><strong><?php echo $tpl->vars['TRAJET_ARRIVE']; ?> :</strong> <?php echo $tpl->vars['TXT_TRAJET_ARRIVE']; ?></span>
							</td>
						</tr>

					 <?php if ($tpl->vars['TXT_INFO_COMPL'] != '') : ?>

						<tr >
							<td colspan="3" style="padding:3px 0 3px 10px;">
								<span><strong><?php echo $tpl->vars['INFO_COMPL']; ?> :</strong><br /> <?php echo $tpl->vars['TXT_INFO_COMPL']; ?></span>
							</td>
						</tr>
					<?php endif; ?>

					</table>
				</div>
			</div>
			<!-- Fin Bloc de "Mon Trajet" -->
			
			<br />

			<!-- Bloc de "Retour" -->
			<?php if ($tpl->vars['TRAJET'] == 0) : ?>
			<div class='colonneDroite_2c_eq'>
				<div class='titreColonne_2c_eq' >
					<span class='txt_titre_colonne_2c_eq' style="text-align:center;color:#878787;"><?php echo $tpl->vars['RETOUR']; ?></span>
				</div>
				<div class='contenuCentre_2c_eq_infini' style="padding:10px;text-align:left;">
					<table style="margin-left:37px;" cellpadding="0" cellspacing="0">
						<tr>
							<td class="contenu_grise">

								<br />
								<span><strong><?php echo $tpl->vars['DATE_RETOUR']; ?> :</strong> <?php echo $tpl->vars['TXT_DATE_RETOUR']; ?></span>

								<br />
								<span><strong><?php echo $tpl->vars['HEURE_RETOUR']; ?> :</strong> <?php echo $tpl->vars['TXT_HEURE_RETOUR']; ?></span>

								<br />
								<span><strong><?php echo $tpl->vars['PT_RASSEMBLEMENT']; ?> :</strong> <?php echo $tpl->vars['TXT_PT_RASS_RETOUR']; ?></span>

								<?php if ($tpl->vars['TXT_RASS_ADRESSE_RETOUR'] != '') : ?>
									<br />
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span><strong><?php echo $tpl->vars['ADRESSE_CLIENT']; ?> :</strong> <?php echo $tpl->vars['TXT_RASS_ADRESSE_RETOUR']; ?></span>
									<br />
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span><strong><?php echo $tpl->vars['CODE_POST_CLIENT']; ?> :</strong> <?php echo $tpl->vars['TXT_RASS_CP_RETOUR']; ?></span>
									<br />
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span><strong><?php echo $tpl->vars['VILLE_CLIENT']; ?> :</strong> <?php echo $tpl->vars['TXT_RASS_VILLE_RETOUR']; ?></span>
								<?php endif; ?>

								<br />
								<span><strong><?php echo $tpl->vars['PASSAGER_ADULTE']; ?> :</strong> <?php echo $tpl->vars['TXT_PASSAGER_ADULTE_RETOUR']; ?></span>

								<?php if ($tpl->vars['TXT_PASSAGER_ENFANT_RETOUR'] > 0) : ?>

									<br />
									<span><strong><?php echo $tpl->vars['PASSAGER_ENFANT']; ?> :</strong> <?php echo $tpl->vars['TXT_PASSAGER_ENFANT_RETOUR']; ?></span>

								<?php endif; ?>

								<br />
								<span><strong><?php echo $tpl->vars['INFO_VOL']; ?> :</strong> <br />
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong><?php echo $tpl->vars['COMPAGNIE']; ?> : </strong><?php echo $tpl->vars['COMPAGNIE_INFO_VOL_RETOUR']; ?>
									<br />
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong><?php echo $tpl->vars['DEST_VOL']; ?> : </strong><?php echo $tpl->vars['DEST_INFO_VOL_RETOUR']; ?>
									<br />
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong><?php echo $tpl->vars['HEURE_VOL']; ?> : </strong><?php echo $tpl->vars['HEURE_INFO_VOL_RETOUR']; ?>
								</span>

							</td>
						</tr>
					</table>
				</div>
			</div>
			<?php endif; ?>
			
			<!-- Bloc de "Aller" -->
			<div class='colonneGauche_2c_eq'>
				<div class='titreColonne_2c_eq'>
					<span class='txt_titre_colonne_2c_eq' style="text-align:center;"><?php echo $tpl->vars['ALLER']; ?></span>
				</div>
				<div class='contenuCentre_2c_eq_infini' style="padding:10px;text-align:left;">
					<table style="margin-left:37px;" cellpadding="0" cellspacing="0">
						<tr>
							<td >
								<br />
								<span><strong><?php echo $tpl->vars['DATE_DEPART']; ?> :</strong> <?php echo $tpl->vars['TXT_DATE_DEPART']; ?></span>

								<br />
								<span><strong><?php echo $tpl->vars['HEURE_DEPART']; ?> :</strong> <?php echo $tpl->vars['TXT_HEURE_DEPART']; ?></span>

								<br />
								<span><strong><?php echo $tpl->vars['PT_RASSEMBLEMENT']; ?> :</strong> <?php echo $tpl->vars['TXT_PT_RASS_ALLER']; ?></span>

								<?php if ($tpl->vars['TXT_RASS_ADRESSE_ALLER'] != '') : ?>
									<br />
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span><strong><?php echo $tpl->vars['ADRESSE_CLIENT']; ?> :</strong> <?php echo $tpl->vars['TXT_RASS_ADRESSE_ALLER']; ?></span>
									<br />
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span><strong><?php echo $tpl->vars['CODE_POST_CLIENT']; ?> :</strong> <?php echo $tpl->vars['TXT_RASS_CP_ALLER']; ?></span>
									<br />
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span><strong><?php echo $tpl->vars['VILLE_CLIENT']; ?> :</strong> <?php echo $tpl->vars['TXT_RASS_VILLE_ALLER']; ?></span>
								<?php endif; ?>

								<br />
								<span><strong><?php echo $tpl->vars['PASSAGER_ADULTE']; ?> :</strong> <?php echo $tpl->vars['TXT_PASSAGER_ADULTE_ALLER']; ?></span>

								<?php if ($tpl->vars['TXT_PASSAGER_ENFANT_ALLER'] > 0) : ?>

									<br />
									<span><strong><?php echo $tpl->vars['PASSAGER_ENFANT']; ?> :</strong> <?php echo $tpl->vars['TXT_PASSAGER_ENFANT_ALLER']; ?></span>

								<?php endif; ?>

								<br />
								<span><strong><?php echo $tpl->vars['INFO_VOL']; ?> :</strong> <br />
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong><?php echo $tpl->vars['COMPAGNIE']; ?> : </strong><?php echo $tpl->vars['COMPAGNIE_INFO_VOL_ALLER']; ?>
									<br />
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong><?php echo $tpl->vars['DEST_VOL']; ?> : </strong><?php echo $tpl->vars['DEST_INFO_VOL_ALLER']; ?>
									<br />
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong><?php echo $tpl->vars['HEURE_VOL']; ?> : </strong><?php echo $tpl->vars['HEURE_INFO_VOL_ALLER']; ?>
								</span>

							</td>
						</tr>
					</table>
				</div>
			</div>
			
			
			
			<br /><br />
			
		<?php if ($tpl->vars['TRAJET'] == 0) : ?>
			<form method="post" action="reservation/choix-navette_retour.php" id="form_navette_existant">
		<?php else : ?>
			<form method="post" action="demande_reservation.php" id="form_navette_existant">
		<?php endif; ?>



			<!-- Possibilite de selectionner un passager différent by Alexandre 
			input checkbox a value est prise en compte que si elle est coche
			ce n'est pas une valeur pas defaut
			-->
				<br />

				<div class='blocFondVioletTotal'>
					<input name='chckPassagerDifferent' type='checkbox' id='chckPassagerDifferent' onclick='verificationSiAutrePassager()' value='oui' style='margin-right:10px;margin-left:40px;' />
					<label style='cursor:pointer;font-size:14px;' for='chckPassagerDifferent'><strong><?php echo $tpl->vars['TITRE_A_COCHER_SI_LA_PERSONNE_EST_AUTRE']; ?></strong></label>
					<br />
					<div style='text-align:left;margin-left:40px;' id='chpPortable'></div>
				</div>
			<!-- Fin possibilite de selectionner un passager différent by Alexandre -->
			
					<br /><br />

					<?php if ($tpl->vars['TRAJET'] == 0) : ?>
						<input type="hidden" name="res_2_2" />
					<?php else : ?>
						<input type="hidden" name="res_3" />
					<?php endif; ?>
					
				<?php if ($tpl->vars['NAVETTE']) : ?>

					<!-- Bloc du choix 1 -->
					<div class='blocTotal_750'>
						<div class='titreBlocTotal_750'>
							<span class='txt_titre_centre_gauche_3c'><?php echo $tpl->vars['CHOIX_1']; ?></span>
						</div>
						<div class='contenuBlocTotal_750' style="padding:10px;">
							
							<?php if ($tpl->vars['NAVETTE']) : ?>

								<span><?php echo $tpl->vars['NAVETTE_EXISTANT']; ?> : </span>
								<br /><br />

								<table class="tab_nav_existant" style="margin:auto">
									<tr>

										<?php foreach ($tpl->vars['TAB_HEADER'] as $__tpl_foreach_key['TAB_HEADER'] => $__tpl_foreach_value['TAB_HEADER']) : ?>

											<th><?php echo $__tpl_foreach_value['TAB_HEADER']; ?></th>

										<?php endforeach; ?>

									</tr>

									<?php foreach ($tpl->vars['TAB_NAVETTE_DISPO'] as $__tpl_foreach_key['TAB_NAV_DISPO'] => $__tpl_foreach_value['TAB_NAV_DISPO']) : ?>

										<tr>

											 <td><input type="radio" name="rb_navette" value="<?php echo $__tpl_foreach_value['TAB_NAV_DISPO']['ID']; ?>" /></td>

											<?php foreach ($__tpl_foreach_value['TAB_NAV_DISPO']['NAVETTE'] as $__tpl_foreach_key['TNDA'] => $__tpl_foreach_value['TNDA']) : ?>

												<td><?php echo $__tpl_foreach_value['TNDA']; ?></td>

											<?php endforeach; ?>

										</tr>

									<?php endforeach; ?>

								</table>

							 <?php else : ?>

								<span><?php echo $tpl->vars['AUCUNE_NAVETTE']; ?>.</span>
								<br />
								<br />

							<?php endif; ?>
						</div>
					</div>
				<?php endif; ?>

				<input type="hidden" name="navette_dispo" id="navette_dispo" value="0" />
				<input type="hidden" id="type_trajet" value="<?php echo $tpl->vars['TRAJET']; ?>" />

				<input type="hidden" id="nav" value="<?php echo $tpl->vars['BOOL_NAV']; ?>" />
				<input type="hidden" id="ressource" />


					<?php if ($tpl->vars['MEME_HEURE'] == '0') : ?>
					
						<?php if ($tpl->vars['RESS']) : ?>
							<br />
							<!-- Bloc du choix 2 -->
							<div class='blocTotal_750'>
								<div class='titreBlocTotal_750'>
									<span class='txt_titre_centre_gauche_3c'><?php echo $tpl->vars['CHOIX_2']; ?></span>
								</div>
								<div class='contenuBlocTotal_750' style="padding:10px;">
							
									
									<?php if (!$tpl->vars['RESS']) : ?>

										<span><?php echo $tpl->vars['TXT_PAS_RESSOURCE']; ?> !</span>

										<br />

									<?php else : ?>

										<table class="tab_nav_existant" style="margin:auto">
											<tr>

												<?php foreach ($tpl->vars['TAB_HEADER'] as $__tpl_foreach_key['TAB_HEADER'] => $__tpl_foreach_value['TAB_HEADER']) : ?>

													<th><?php echo $__tpl_foreach_value['TAB_HEADER']; ?></th>

												<?php endforeach; ?>

											</tr>

											<tr>
												<td>

													<?php if ($tpl->vars['NB_PASS_MINI'] <= $tpl->vars['NB_PASS']) : ?>

														<input type="checkbox" id="accept_forfait_mini" name="accept_forfait_mini" value="on" />
													
													<?php else : ?>
														<input type="checkbox" id="accept_forfait_mini" name="accept_forfait_mini" value="on" />
													
													<?php endif; ?>


												</td>
												<td>
													<?php echo $tpl->vars['TXT_TRAJET_DEPART']; ?>
												</td>
												<td>
													<?php echo $tpl->vars['TXT_TRAJET_ARRIVE']; ?>
												</td>
												<td>
													<?php echo $tpl->vars['TXT_DATE_DEPART_COURT']; ?> <?php echo $tpl->vars['TXT_HEURE_DEPART']; ?>m
												</td>
												<td>
													0
												</td>
												<td>
													<?php echo $tpl->vars['LBL_TARIF_TRAJET']; ?> â‚¬
												</td>

											</tr>

										</table>

									<br />
									<span><?php echo $tpl->vars['EXPLICATION_FORFAIT_MINI']; ?>. <?php echo $tpl->vars['REMBOURSEMENT_FORFAIT']; ?></span>
		
									<?php endif; ?>
									
								</div>
								
							</div>

						<?php endif; ?>


						 
						<?php if ($tpl->vars['NB_PASS_MINI'] > $tpl->vars['NB_PASS']) : ?>
							<br />
							
							<!-- Bloc du choix 3 -->
							<div class='blocTotal_750'>
								<div class='titreBlocTotal_750'>
									<span class='txt_titre_centre_gauche_3c'><?php echo $tpl->vars['CHOIX_3']; ?></span>
								</div>
								<div class='contenuBlocTotal_750' style="padding:10px;">
									<span><?php echo $tpl->vars['EXPLI_ATTENDRE']; ?></span>
									<br /><br />

									<input type="checkbox" id="attendre" name="attendre" />
									<label for="attendre"><strong><?php echo $tpl->vars['LABEL_ATTENDRE']; ?></strong></label>
									
								</div>
								
							</div>
							
						 <?php endif; ?>

					<?php endif; ?>

					<br />



					

					<input type="hidden" id="pb_adresse" value="0" />

					<?php if ($tpl->vars['TYPE'] == 'DOM') : ?>


						<input type="hidden" name="decalage" id="decalage" />
						<input type="hidden" name="distance" id="distance" />


						<div id="sur_adresse" style="display:none;">
							<br />
							<span><img src="images/warning_red.gif" alt="" /> <?php echo $tpl->vars['PB_ADRESSE']; ?></span>
							<br />
							<input type="checkbox" name="chk_sur_adresse" id="chk_sur_adresse" />
							<label for="chk_sur_adresse"><?php echo $tpl->vars['SUR_ADRESSE']; ?></label>
							<br />
						</div>

					<?php endif; ?>

					<?php if ($tpl->vars['IS_DER_MIN'] == '1') : ?>

						<br />
						<strong><?php echo $tpl->vars['ATTENTION']; ?></strong>
						<br />
						<br />

					<?php endif; ?>


					<div class="centre">

						<br />
						<input type="button" id="btn_annuler_demande" value="<?php echo $tpl->vars['RETOUR']; ?>" onclick="" />
						&nbsp;&nbsp;
						<input type="button" value="<?php echo $tpl->vars['BTN_CONTINUER']; ?>" name="nouvelle_navette" id="btn_continuer" disabled="disabled" />

						<?php if ($tpl->vars['NAVETTE']) : ?>
							&nbsp;&nbsp;
							<input type="button" id="btn_deselectionner" value="DÃ©-sÃ©lectionner" disabled="disabled" />
						<?php endif; ?>

						<input type="hidden" id="pb_ressource" value="<?php echo $tpl->vars['PB_RESSOURCE']; ?>" />

					</div>

			</form>
			
		</div>
		
	</div>

	<br /><br />

	<script type="text/javascript" src="scripts/navette_dispo.js"></script>
	<!-- KEMPF : Ajout de ajax.js pour pouvoir traiter les demandes annulées en cours de réservation -->
	<script type="text/javascript" src="scripts/ajax.js"></script>

</div>


<?php if ($tpl->vars['TYPE'] == 'DOM') : ?>
    <script src="http://maps.googleapis.com/maps/api/js?key=<?php echo $tpl->vars['GOOGLE_MAPS']; ?>&sensor=false" type="text/javascript"></script>
<?php endif; ?>


<script type="text/javascript">
<!--
	// KEMPF : Gestion de l'annulation de la demande
	var func_cancel = function(){
		set_demande_annulee("<?php echo $tpl->vars['CIVILITE_CLIENT']; ?> <?php echo $tpl->vars['NOM_CLIENT']; ?> <?php echo $tpl->vars['PRENOM_CLIENT']; ?>", "<?php echo $tpl->vars['EMAIL_CLIENT']; ?>", <?php echo $tpl->vars['ID_TRAJET_DEPART']; ?>, <?php echo $tpl->vars['ID_TRAJET_DEST']; ?>, "Choix navette aller", <?php echo $tpl->vars['PRIX_TRAJET']; ?>, <?php echo $tpl->vars['TRAJET_EST_SIMPLE']; ?>);
	}
	document.getElementById('btn_annuler_demande').onclick = func_cancel;
	
	//

    var inp = document.getElementById('decalage');
    var dist = document.getElementById('distance');

    <?php if ($tpl->vars['TYPE'] == 'DOM') : ?>

        // KEMPF : Ajout de l'API 3.0 de GoogleMaps
		var origine = "<?php echo $tpl->vars['ADDR']; ?>";
		var destination = new google.maps.LatLng(48.5844857, 7.7342248);
		
		var service = new google.maps.DistanceMatrixService();
		
		service.getDistanceMatrix(
		  {
			origins: [origine],
			destinations: [destination],
			travelMode: google.maps.TravelMode.DRIVING,
			avoidHighways: false,
			avoidTolls: false
		  }, callback);
		
		function callback(response, status){
		
			if (status == google.maps.DistanceMatrixStatus.OK) {
				var origins = response.originAddresses;
				var destinations = response.destinationAddresses;
				var trouve = false;
				
				for (var i = 0; i < origins.length; i++) {
					var results = response.rows[i].elements;
					for (var j = 0; j < results.length; j++) {
						if (origins[i] != ""){
							var element = results[j];
							var dis = element.distance;
							var dur = element.duration;
							
							inp.value = dur.value;
							dist.value = dis.value;
							trouve = true;
						}
					}
				}
				
				if (!trouve){
					var sur = document.getElementById('sur_adresse');

					document.getElementById('pb_adresse').value = "1";

					sur.style.display = "block";
				}
				
			}else{
				var sur = document.getElementById('sur_adresse');

				document.getElementById('pb_adresse').value = "1";

				sur.style.display = "block";
			}
		}
		
    <?php endif; ?>

//-->

function verificationSiAutrePassager()
{
	var ck = document.getElementById('chckPassagerDifferent');
	if(ck.checked)
	{
		document.getElementById('chpPortable').innerHTML = "<br /><?php echo $tpl->vars['TXT_NOM_PASSAGER']; ?> : <input type='text' id='txtNom' name='txtNom' /><br /><?php echo $tpl->vars['LABEL_INDICATIF_TELEPHONE']; ?> : <?php echo $tpl->vars['INDICATIF_TELEPHONE']; ?> <br /><?php echo $tpl->vars['LABEL_TELEPHONE']; ?> : <input type='text' id='txtPortable' name='txtPortable' />";
		document.getElementById('txtNom').focus();
	}
	else
		document.getElementById('chpPortable').innerHTML = "";
}
</script>

<?php $tpl->includeTpl('footer.html', false, 0); ?>
