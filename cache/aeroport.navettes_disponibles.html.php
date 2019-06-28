<?php $tpl->includeTpl('aeroport/include.html', false, 0); ?>
<!--
fichier:aeroport.navette_disponible.html
updated:19/06/2019
-->        
<!-- Bloc englobant toute la page -->
<div class="row">

	<h3 class="titre_navettes_dispos"><?php echo $tpl->vars['CHOIX_NAVETTE']; ?></h3>
		
	<div class="navettes_dispos row" style="padding:10px;text-align:center;">

		<!-- Bloc de "Mon Trajet" -->
		<div class="col-xs-12 col-sm-12 col-md-12 navettes_dispos_trajet" style="margin:0;">
			<div class="col-xs-12 col-sm-12 col-md-12 navettes_dispos_titre_bloc">
				<h4><?php echo $tpl->vars['TITRE_MON_TRAJET']; ?></h4>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12" style="padding:10px;">
				<div class="col-xs-12 col-sm-4 col-md-4">
					<span style="font-weight:bold;"><?php echo $tpl->vars['TYPE_TRAJET']; ?> :</span> <?php echo $tpl->vars['TXT_TYPE_TRAJET']; ?>
				</div>
				<div class="col-xs-12 col-sm-4 col-md-4">
					<span style="font-weight:bold;"><?php echo $tpl->vars['TRAJET_DEPART']; ?> :</span> <?php echo $tpl->vars['TXT_TRAJET_DEPART']; ?>
				</div>
				<div class="col-xs-12 col-sm-4 col-md-4">
					<span style="font-weight:bold;"><?php echo $tpl->vars['TRAJET_ARRIVE']; ?> :</span> <?php echo $tpl->vars['TXT_TRAJET_ARRIVE']; ?>
				</div>

				 <?php if ($tpl->vars['TXT_INFO_COMPL'] != '') : ?>
					<div class="col-xs-12 col-sm-12 col-md-12">
						<span style="font-weight:bold;"> <?php echo $tpl->vars['INFO_COMPL']; ?> :</span><br /> <?php echo $tpl->vars['TXT_INFO_COMPL']; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>	
		<!-- Fin Bloc de "Mon Trajet" -->
		
		<!-- Bloc de "Aller" -->
		<div class="col-xs-12 col-sm-6 col-md-6" style="padding:0;border-right:15px solid white;">
			<div class="col-xs-12 col-sm-12 col-md-12 navettes_dispos_titre_bloc">
				<h4><?php echo $tpl->vars['ALLER']; ?></h4>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12">
				<div class="col-xs-12 col-sm-12 col-md-12">
					<span style="font-weight:bold;"><?php echo $tpl->vars['DATE_DEPART']; ?> :</span> <?php echo $tpl->vars['TXT_DATE_DEPART']; ?>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12">
					<span style="font-weight:bold;"><?php echo $tpl->vars['HEURE_DEPART']; ?> :</span> <?php echo $tpl->vars['TXT_HEURE_DEPART']; ?>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12">
					<span style="font-weight:bold;"><?php echo $tpl->vars['PT_RASSEMBLEMENT']; ?> :</span> <?php echo $tpl->vars['TXT_PT_RASS_ALLER']; ?>
				</div>
				<?php if ($tpl->vars['TXT_RASS_ADRESSE_ALLER'] != '') : ?>
					<div class="col-xs-12 col-sm-12 col-md-12">
						<span style="font-weight:bold;"><?php echo $tpl->vars['ADRESSE_CLIENT']; ?> :</span> <?php echo $tpl->vars['TXT_RASS_ADRESSE_ALLER']; ?>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-12">
						<span style="font-weight:bold;"><?php echo $tpl->vars['CODE_POST_CLIENT']; ?> :</span> <?php echo $tpl->vars['TXT_RASS_CP_ALLER']; ?>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-12">
						<span style="font-weight:bold;"><?php echo $tpl->vars['VILLE_CLIENT']; ?> :</span> <?php echo $tpl->vars['TXT_RASS_VILLE_ALLER']; ?>
					</div>
				<?php endif; ?>
				<div class="col-xs-12 col-sm-12 col-md-12">
					<span style="font-weight:bold;"><?php echo $tpl->vars['PASSAGER_ADULTE']; ?> :</span> <?php echo $tpl->vars['TXT_PASSAGER_ADULTE_ALLER']; ?>
				</div>
				<?php if ($tpl->vars['TXT_PASSAGER_ENFANT_ALLER'] > 0) : ?>
					<div class="col-xs-12 col-sm-12 col-md-12">
						<span style="font-weight:bold;"><?php echo $tpl->vars['PASSAGER_ENFANT']; ?> :</span> <?php echo $tpl->vars['TXT_PASSAGER_ENFANT_ALLER']; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
		
		<!-- Bloc de "Retour" -->
		<?php if ($tpl->vars['TRAJET'] == 0) : ?>
			<div class="col-xs-12 col-sm-6 col-md-6" style="padding:0;border-left:15px solid white;">
				<div class="col-xs-12 col-sm-12 col-md-12 navettes_dispos_titre_bloc">
					<h4><?php echo $tpl->vars['RETOUR']; ?></h4>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12">
					<div class="col-xs-12 col-sm-12 col-md-12">
						<span style="font-weight:bold;"><?php echo $tpl->vars['DATE_RETOUR']; ?> :</span> <?php echo $tpl->vars['TXT_DATE_RETOUR']; ?>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-12">
						<span style="font-weight:bold;"><?php echo $tpl->vars['HEURE_RETOUR']; ?> :</span> <?php echo $tpl->vars['TXT_HEURE_RETOUR']; ?>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-12">
						<span style="font-weight:bold;"><?php echo $tpl->vars['PT_RASSEMBLEMENT']; ?> :</span> <?php echo $tpl->vars['TXT_PT_RASS_RETOUR']; ?>
					</div>
					<?php if ($tpl->vars['TXT_RASS_ADRESSE_RETOUR'] != '') : ?>
						<div class="col-xs-12 col-sm-12 col-md-12">
							<span style="font-weight:bold;"><?php echo $tpl->vars['ADRESSE_CLIENT']; ?> :</span> <?php echo $tpl->vars['TXT_RASS_ADRESSE_RETOUR']; ?>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12">
							<span style="font-weight:bold;"><?php echo $tpl->vars['CODE_POST_CLIENT']; ?> :</span> <?php echo $tpl->vars['TXT_RASS_CP_RETOUR']; ?>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12">
							<span style="font-weight:bold;"><?php echo $tpl->vars['VILLE_CLIENT']; ?> :</span> <?php echo $tpl->vars['TXT_RASS_VILLE_RETOUR']; ?>
						</div>
					<?php endif; ?>
					<div class="col-xs-12 col-sm-12 col-md-12">
						<span style="font-weight:bold;"><?php echo $tpl->vars['PASSAGER_ADULTE']; ?> :</span> <?php echo $tpl->vars['TXT_PASSAGER_ADULTE_ALLER']; ?>
					</div>
					<?php if ($tpl->vars['TXT_PASSAGER_ENFANT_RETOUR'] > 0) : ?>
						<div class="col-xs-12 col-sm-12 col-md-12">
							<span style="font-weight:bold;"><?php echo $tpl->vars['PASSAGER_ENFANT']; ?> :</span> <?php echo $tpl->vars['TXT_PASSAGER_ENFANT_RETOUR']; ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		<?php endif; ?>
		
		<?php if ($tpl->vars['TRAJET'] == 0) : ?>
			<input type="hidden" name="res_2_2" />
		<?php else : ?>
			<input type="hidden" name="res_3" />
		<?php endif; ?>
				
		<form method="post" action="demande_reservation.php">
			<!-- Possibilite de selectionner un passager différent by Alexandre 
			input checkbox a value est prise en compte que si elle est coche
			ce n'est pas une valeur pas defaut
			-->
				<div class="col-xs-12 col-sm-12 col-md-12">
					<input name='chckPassagerDifferent' type='checkbox' id='chckPassagerDifferent' onclick='verificationSiAutrePassager()' value='oui' />
					<label style='cursor:pointer;font-size:17px;' for='chckPassagerDifferent'><span style="font-weight:bold;"><?php echo $tpl->vars['TITRE_A_COCHER_SI_LA_PERSONNE_EST_AUTRE']; ?></span></label>
					<div class="col-xs-12 col-sm-12 col-md-12" style="height:auto;" id='chpPortable'></div>
				</div>
			<!-- Fin possibilite de selectionner un passager différent by Alexandre -->
			<?php if ($tpl->vars['NAVETTE_ALLER']) : ?>
			
				<!-- Bloc du choix 1 -->
				<div class="col-xs-12 col-sm-12 col-md-12">
					<div class="col-xs-12 col-sm-12 col-md-12 navettes_dispos_titre_bloc">
						<h4><?php echo $tpl->vars['CHOIX_1_ALLER']; ?></h4>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-12">			
						
						<?php if ($tpl->vars['NAVETTE_ALLER']) : ?>
						
							<span><?php echo $tpl->vars['NAVETTE_EXISTANT_ALLER']; ?> : </span>
							<br /><br />

							<?php foreach ($tpl->vars['TAB_NAVETTE_DISPO_ALLER'] as $__tpl_foreach_key['TAB_NAV_DISPO_ALLER'] => $__tpl_foreach_value['TAB_NAV_DISPO_ALLER']) : ?>
								<div class="col-xs-12 col-sm-12 col-md-12" style="margin-bottom:20px;">
									<?php if ($tpl->getBlock('tab_header')) : foreach ($tpl->getBlock('tab_header') as $__tpl_blocs['tab_header']){ ?>
										<div class="col-xs-12 col-sm-2 col-md-2 navettes_dispos_tab">
											<div class="navettes_dispos_en_tete_tab col-xs-6 col-sm-12 col-md-12"><?php echo $__tpl_blocs['tab_header']['TXT']; ?></div>
											<?php if ($__tpl_blocs['tab_header']['NUM'] == 1) : ?>
												<div class="navettes_dispos_case_tab col-xs-6 col-sm-12 col-md-12 navettes_dispos_case_tab_radio"><input type="radio" name="rb_navette_aller" value="<?php echo $__tpl_foreach_value['TAB_NAV_DISPO_ALLER']['ID']; ?>" /></div>
											<?php elseif ($__tpl_blocs['tab_header']['NUM'] == 2) : ?>
												<div class="navettes_dispos_case_tab col-xs-6 col-sm-12 col-md-12"><?php echo $__tpl_foreach_value['TAB_NAV_DISPO_ALLER']['NAVETTE'][0]; ?></div>
											<?php elseif ($__tpl_blocs['tab_header']['NUM'] == 3) : ?>
												<div class="navettes_dispos_case_tab col-xs-6 col-sm-12 col-md-12"><?php echo $__tpl_foreach_value['TAB_NAV_DISPO_ALLER']['NAVETTE'][1]; ?></div>
											<?php elseif ($__tpl_blocs['tab_header']['NUM'] == 4) : ?>
												<div class="navettes_dispos_case_tab col-xs-6 col-sm-12 col-md-12"><?php echo $__tpl_foreach_value['TAB_NAV_DISPO_ALLER']['NAVETTE'][2]; ?></div>
											<?php elseif ($__tpl_blocs['tab_header']['NUM'] == 5) : ?>
												<div class="navettes_dispos_case_tab col-xs-6 col-sm-12 col-md-12"><?php echo $__tpl_foreach_value['TAB_NAV_DISPO_ALLER']['NAVETTE'][3]; ?></div>
											<?php else : ?>
												<div class="navettes_dispos_case_tab col-xs-6 col-sm-12 col-md-12"><?php echo $__tpl_foreach_value['TAB_NAV_DISPO_ALLER']['NAVETTE'][4]; ?></div>
											<?php endif; ?>
										</div>
									<?php } endif; ?>
								</div>
							<?php endforeach; ?>
							
						 <?php else : ?>

							<span><?php echo $tpl->vars['AUCUNE_NAVETTE']; ?>.</span>
							<br />
							<br />

						<?php endif; ?>
					</div>
				</div>
			<?php endif; ?>

			<input type="hidden" name="navette_dispo" id="navette_dispo" value="<?php echo $tpl->vars['NAVETTE_DISPONIBLE']; ?>" />
			<input type="hidden" id="type_trajet" value="<?php echo $tpl->vars['TRAJET']; ?>" />

			<input type="hidden" id="nav" value="<?php echo $tpl->vars['BOOL_NAV']; ?>" />
			<input type="hidden" id="ressource" />

					
			<?php if (!$tpl->vars['MEME_HEURE_ALLER']) : ?>
			
				<!-- Bloc du choix 2 -->
				<div class="col-xs-12 col-sm-12 col-md-12">
					<div class="col-xs-12 col-sm-12 col-md-12 navettes_dispos_titre_bloc">
						<h4><?php echo $tpl->vars['CHOIX_2_ALLER']; ?></h4>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-12" style="padding-left:30px;padding-right:30px;">					
						<?php if (!$tpl->vars['RESS']) : ?>

							<span><?php echo $tpl->vars['TXT_PAS_RESSOURCE']; ?> !</span>

							<br />

						<?php else : ?>
							
							<?php if ($tpl->getBlock('tab_header')) : foreach ($tpl->getBlock('tab_header') as $__tpl_blocs['tab_header']){ ?>
								<div class="col-xs-12 col-sm-2 col-md-2 navettes_dispos_tab">
									<div class="navettes_dispos_en_tete_tab col-xs-6 col-sm-12 col-md-12"><?php echo $__tpl_blocs['tab_header']['TXT']; ?></div>
									<?php if ($__tpl_blocs['tab_header']['NUM'] == 1) : ?>
										<div class="navettes_dispos_case_tab col-xs-6 col-sm-12 col-md-12 navettes_dispos_case_tab_radio"><input type="checkbox" id="accept_forfait_mini" name="accept_forfait_mini" value="on" /></div>
									<?php elseif ($__tpl_blocs['tab_header']['NUM'] == 2) : ?>
										<div class="navettes_dispos_case_tab col-xs-6 col-sm-12 col-md-12"><?php echo $tpl->vars['TXT_TRAJET_DEPART']; ?></div>
									<?php elseif ($__tpl_blocs['tab_header']['NUM'] == 3) : ?>
										<div class="navettes_dispos_case_tab col-xs-6 col-sm-12 col-md-12"><?php echo $tpl->vars['TXT_TRAJET_ARRIVE']; ?></div>
									<?php elseif ($__tpl_blocs['tab_header']['NUM'] == 4) : ?>
										<div class="navettes_dispos_case_tab col-xs-6 col-sm-12 col-md-12"><?php echo $tpl->vars['TXT_DATE_DEPART_COURT']; ?> <?php echo $tpl->vars['TXT_HEURE_DEPART']; ?></div>
									<?php elseif ($__tpl_blocs['tab_header']['NUM'] == 5) : ?>
										<div class="navettes_dispos_case_tab col-xs-6 col-sm-12 col-md-12">0</div>
									<?php else : ?>
										<div class="navettes_dispos_case_tab col-xs-6 col-sm-12 col-md-12"><?php echo $tpl->vars['LBL_TARIF_TRAJET']; ?> €</div>
									<?php endif; ?>
								</div>
							<?php } endif; ?>
							<span class="col-xs-12 col-sm-12 col-md-12" style="margin-top:10px;padding:0;"><?php echo $tpl->vars['EXPLICATION_FORFAIT_MINI']; ?>. <?php echo $tpl->vars['REMBOURSEMENT_FORFAIT']; ?></span>

						<?php endif; ?>
						
					</div>
					
				</div>

				<?php if ($tpl->vars['TXT_PASSAGER_ADULTE_ALLER'] < $tpl->vars['NB_PERS_FORFAIT']) : ?>
					<!-- Bloc du choix 3 -->
					<div class="col-xs-12 col-sm-12 col-md-12">
						<div class="col-xs-12 col-sm-12 col-md-12 navettes_dispos_titre_bloc">
							<h4><?php echo $tpl->vars['CHOIX_3_ALLER']; ?></h4>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12">
							
							<span><?php echo $tpl->vars['EXPLI_ATTENDRE']; ?></span>
							<br /><br />	
							
							<input type="checkbox" id="attendre" name="attendre" />
							<label for="attendre"><?php echo $tpl->vars['LABEL_ATTENDRE']; ?></label>	
							
						</div>
					</div>
				<?php endif; ?>

			<?php endif; ?>

			<input type="hidden" id="pb_adresse" value="0" />

			<?php if ($tpl->vars['TYPE'] == 'DOM') : ?>

				<input type="hidden" name="decalage" id="decalage" />
				<input type="hidden" name="distance" id="distance" />


				<div class="col-xs-12 col-sm-12 col-md-12" id="sur_adresse" style="display:none;">
					<br />
					<span><img src="images/warning_red.gif" alt="" /> <?php echo $tpl->vars['PB_ADRESSE']; ?></span>
					<br />
					<input type="checkbox" name="chk_sur_adresse" id="chk_sur_adresse" />
					<label for="chk_sur_adresse"><?php echo $tpl->vars['SUR_ADRESSE']; ?></label>
					<br />
				</div>

			<?php endif; ?>

			<?php if ($tpl->vars['IS_DER_MIN'] == '1') : ?>
				<div class="col-xs-12 col-sm-12 col-md-12" style="font-weight:bold;margin-top:20px;margin-bottom:40px;background-color:white;padding:0 20px;"><?php echo $tpl->vars['ATTENTION']; ?></div>
			<?php endif; ?>
				
			<?php if ($tpl->vars['TRAJET'] == 0) : ?>

				<?php if ($tpl->vars['NAVETTE']) : ?>
					<!-- Bloc du choix 1 -->
					<div class="col-xs-12 col-sm-12 col-md-12">
						<div class="col-xs-12 col-sm-12 col-md-12 navettes_dispos_titre_bloc">
							<h4><?php echo $tpl->vars['CHOIX_1_RETOUR']; ?></h4>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12">
							<?php if ($tpl->vars['NAVETTE']) : ?>

								<span><?php echo $tpl->vars['NAVETTE_EXISTANT']; ?> : </span>
								<br /><br />
								
								<?php foreach ($tpl->vars['TAB_NAVETTE_DISPO'] as $__tpl_foreach_key['TAB_NAV_DISPO'] => $__tpl_foreach_value['TAB_NAV_DISPO']) : ?>
									<div class="col-xs-12 col-sm-12 col-md-12" style="margin-bottom:20px;">
										<?php if ($tpl->getBlock('tab_header')) : foreach ($tpl->getBlock('tab_header') as $__tpl_blocs['tab_header']){ ?>
											<div class="col-xs-12 col-sm-2 col-md-2 navettes_dispos_tab">
												<div class="navettes_dispos_en_tete_tab col-xs-6 col-sm-12 col-md-12"><?php echo $__tpl_blocs['tab_header']['TXT']; ?></div>
												<?php if ($__tpl_blocs['tab_header']['NUM'] == 1) : ?>
													<div class="navettes_dispos_case_tab col-xs-6 col-sm-12 col-md-12 navettes_dispos_case_tab_radio"><input type="radio" name="rb_navette_retour" value="<?php echo $__tpl_foreach_value['TAB_NAV_DISPO']['ID']; ?>" /></div>
												<?php elseif ($__tpl_blocs['tab_header']['NUM'] == 2) : ?>
													<div class="navettes_dispos_case_tab col-xs-6 col-sm-12 col-md-12"><?php echo $__tpl_foreach_value['TAB_NAV_DISPO']['NAVETTE'][0]; ?></div>
												<?php elseif ($__tpl_blocs['tab_header']['NUM'] == 3) : ?>
													<div class="navettes_dispos_case_tab col-xs-6 col-sm-12 col-md-12"><?php echo $__tpl_foreach_value['TAB_NAV_DISPO']['NAVETTE'][1]; ?></div>
												<?php elseif ($__tpl_blocs['tab_header']['NUM'] == 4) : ?>
													<div class="navettes_dispos_case_tab col-xs-6 col-sm-12 col-md-12"><?php echo $__tpl_foreach_value['TAB_NAV_DISPO']['NAVETTE'][2]; ?></div>
												<?php elseif ($__tpl_blocs['tab_header']['NUM'] == 5) : ?>
													<div class="navettes_dispos_case_tab col-xs-6 col-sm-12 col-md-12"><?php echo $__tpl_foreach_value['TAB_NAV_DISPO']['NAVETTE'][3]; ?></div>
												<?php else : ?>
													<div class="navettes_dispos_case_tab col-xs-6 col-sm-12 col-md-12"><?php echo $__tpl_foreach_value['TAB_NAV_DISPO']['NAVETTE'][4]; ?></div>
												<?php endif; ?>
											</div>
										<?php } endif; ?>
									</div>
								<?php endforeach; ?>

							 <?php else : ?>

								<span><?php echo $tpl->vars['AUCUNE_NAVETTE']; ?>.</span>
								<br /><br />

							<?php endif; ?>	
						</div>
					</div>
					
				<?php endif; ?>

				<input type="hidden" name="navette_dispo" id="navette_dispo" value="<?php echo $tpl->vars['NAVETTE_DISPONIBLE']; ?>" />
				<input type="hidden" id="type_trajet" value="<?php echo $tpl->vars['TRAJET']; ?>" />

				<input type="hidden" id="nav" value="<?php echo $tpl->vars['BOOL_NAV']; ?>" />
				<input type="hidden" id="ressource" />

				<?php if (!$tpl->vars['MEME_HEURE']) : ?>
					<!-- Bloc du choix 2 -->
					<div class="col-xs-12 col-sm-12 col-md-12">
						<div class="col-xs-12 col-sm-12 col-md-12 navettes_dispos_titre_bloc">
							<h4><?php echo $tpl->vars['CHOIX_2_RETOUR']; ?></h4>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12" style="padding-left:30px;padding-right:30px;">
							<?php if (!$tpl->vars['RESS_RETOUR']) : ?>

								<span><?php echo $tpl->vars['TXT_PAS_RESSOURCE']; ?> !</span>
								<br />

							<?php else : ?>

								<?php if ($tpl->getBlock('tab_header')) : foreach ($tpl->getBlock('tab_header') as $__tpl_blocs['tab_header']){ ?>
									<div class="col-xs-12 col-sm-2 col-md-2 navettes_dispos_tab">
										<div class="navettes_dispos_en_tete_tab col-xs-6 col-sm-12 col-md-12"><?php echo $__tpl_blocs['tab_header']['TXT']; ?></div>
										<?php if ($__tpl_blocs['tab_header']['NUM'] == 1) : ?>
											<div class="navettes_dispos_case_tab col-xs-6 col-sm-12 col-md-12 navettes_dispos_case_tab_radio"><input type="checkbox" id="accept_forfait_mini" name="accept_forfait_mini" value="on" /></div>
										<?php elseif ($__tpl_blocs['tab_header']['NUM'] == 2) : ?>
											<div class="navettes_dispos_case_tab col-xs-6 col-sm-12 col-md-12"><?php echo $tpl->vars['TXT_TRAJET_ARRIVE']; ?></div>
										<?php elseif ($__tpl_blocs['tab_header']['NUM'] == 3) : ?>
											<div class="navettes_dispos_case_tab col-xs-6 col-sm-12 col-md-12"><?php echo $tpl->vars['TXT_TRAJET_DEPART']; ?></div>
										<?php elseif ($__tpl_blocs['tab_header']['NUM'] == 4) : ?>
											<div class="navettes_dispos_case_tab col-xs-6 col-sm-12 col-md-12"><?php echo $tpl->vars['TXT_DATE_RETOUR_COURT']; ?> <?php echo $tpl->vars['TXT_HEURE_RETOUR']; ?></div>
										<?php elseif ($__tpl_blocs['tab_header']['NUM'] == 5) : ?>
											<div class="navettes_dispos_case_tab col-xs-6 col-sm-12 col-md-12">0</div>
										<?php else : ?>
											<div class="navettes_dispos_case_tab col-xs-6 col-sm-12 col-md-12"><?php echo $tpl->vars['LBL_TARIF_TRAJET1']; ?> €</div>
										<?php endif; ?>
									</div>
								<?php } endif; ?>

								<span class="col-xs-12 col-sm-12 col-md-12" style="margin-top:10px;padding:0;"><?php echo $tpl->vars['EXPLICATION_FORFAIT_MINI']; ?>. <?php echo $tpl->vars['REMBOURSEMENT_FORFAIT']; ?></span>
							<?php endif; ?>
						</div>
					</div>
					<?php if ($tpl->vars['TXT_PASSAGER_ADULTE_ALLER'] < $tpl->vars['NB_PERS_FORFAIT']) : ?>
						<!-- Bloc du choix 3 -->
						<div class="col-xs-12 col-sm-12 col-md-12">
							<div class="col-xs-12 col-sm-12 col-md-12 navettes_dispos_titre_bloc">
								<h4><?php echo $tpl->vars['CHOIX_3_RETOUR']; ?></h4>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12">
								
								<span><?php echo $tpl->vars['EXPLI_ATTENDRE']; ?></span>
								<br /><br />	
								
								<input type="checkbox" id="attendre_retour" name="attendre" />
								<label for="attendre_retour"><?php echo $tpl->vars['LABEL_ATTENDRE']; ?></label>	
								
							</div>
						</div>
					<?php endif; ?>
					
				<?php endif; ?>

				<input type="hidden" id="pb_adresse" value="0" />

				<?php if ($tpl->vars['TYPE'] == 'DOM') : ?>

					<input type="text" name="decalage" id="decalage" />
					<input type="text" name="distance" id="distance" />

					<div id="sur_adresse" style="display:none;">
						<br />
						<span><img src="images/warning_red.gif" alt="" /> <?php echo $tpl->vars['PB_ADRESSE']; ?></span>
						<br />
						<input type="checkbox" name="chk_sur_adresse" id="chk_sur_adresse" />
						<label for="chk_sur_adresse"><?php echo $tpl->vars['SUR_ADRESSE']; ?></label>
						<br />
					</div>

				<?php endif; ?>

			<?php endif; ?>

			<div class="col-xs-12 col-sm-12 col-md-12 centre" style="margin-top:20px;background-color:white;">
				<input type="button" id="retour" value="<?php echo $tpl->vars['BTN_ANNULER']; ?>" tabindex="10" onclick="history.back();" style="font-size:1em;"/>
				<input type="hidden" id="id_demande_annulee" name="id_demande_annulee" value="16804" />
				<input type="submit" value="<?php echo $tpl->vars['BTN_CONTINUER']; ?>" name="nouvelle_navette" tabindex="11" id="btn_continuer" style="font-size:1em;" />
				<input type="hidden" name="res_3" />
				<input type="hidden" id="pb_ressource" value="<?php echo $tpl->vars['PB_RESSOURCE']; ?>" />
			</div>

		</form>

	</div>
	
</div>

<?php if ($tpl->vars['TYPE'] == 'DOM') : ?>
    <script src="http://maps.googleapis.com/maps/api/js?key=<?php echo $tpl->vars['GOOGLE_MAPS']; ?>&sensor=false" type="text/javascript"></script>
<?php endif; ?>

<script type="text/javascript">
<!--

	//

	var inp = document.getElementById('decalage');
    var dist = document.getElementById('distance');
	
	function verificationSiAutrePassager()
	{
		var ck = document.getElementById('chckPassagerDifferent');
		if(ck.checked)
		{
			document.getElementById('chpPortable').innerHTML = "<br /><?php echo $tpl->vars['TXT_NOM_PASSAGER']; ?> :<br><input type='text' id='txtNom' name='txtNom' /><br /><?php echo $tpl->vars['LABEL_INDICATIF_TELEPHONE']; ?> :<br><?php echo $tpl->vars['INDICATIF_TELEPHONE']; ?> <br /><?php echo $tpl->vars['LABEL_TELEPHONE']; ?> : <br><input type='text' id='txtPortable' name='txtPortable' />";
			document.getElementById('txtNom').focus();
		}
		else
			document.getElementById('chpPortable').innerHTML = "";
	}


	
	var origine = "<?php echo $tpl->vars['TXT_ADRESSE_ALLER']; ?>";
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

</script>

<?php $tpl->includeTpl('footer.html', false, 0); ?>
