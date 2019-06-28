

<?php $tpl->includeTpl('aeroport/include.html', false, 0); ?>

<!--
fichier:aeroport.reservation.index.html
updated:19/06/2019
-->
<div class="row" id="contenu">

	<div class="col-xs-12 col-sm-6 col-md-6 recap_reservation">
		<h4><?php echo $tpl->vars['RECAPITULATIF']; ?></h4>
		<div class="col-xs-12 col-sm-12 col-md-12 recap_reservation_form">
			
			<!-- Bloc de "Mon Trajet" -->
			<div class="row">
				<h4 class="recap_reservation_form_titre"><?php echo $tpl->vars['TITRE_MON_TRAJET']; ?></h4>
				<div class="row">
					<div class="col-xs-12 col-sm-4 col-md-4">
						<span><span style="font-weight:bold;"><?php echo $tpl->vars['TYPE_TRAJET']; ?> :</span> <?php echo $tpl->vars['TXT_TYPE_TRAJET']; ?></span>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-4">
						<span><span style="font-weight:bold;"><?php echo $tpl->vars['TRAJET_DEPART']; ?> :</span> <?php echo $tpl->vars['TXT_TRAJET_DEPART']; ?></span>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-4">
						<span><span style="font-weight:bold;"><?php echo $tpl->vars['TRAJET_ARRIVE']; ?> :</span> <?php echo $tpl->vars['TXT_TRAJET_ARRIVE']; ?></span>
					</div>

					 <?php if ($tpl->vars['TXT_INFO_COMPL'] != '') : ?>

						<div class="col-xs-12 col-sm-4 col-md-4">
							<span><span style="font-weight:bold;"><?php echo $tpl->vars['INFO_COMPL']; ?> :</span><br /> <?php echo $tpl->vars['TXT_INFO_COMPL']; ?></span>
						</div>
					<?php endif; ?>
				</div>
			</div>
			<!-- Fin Bloc de "Mon Trajet" -->
			
			<!-- Bloc de "Aller" -->
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12" style="text-align: center; font-weight: bold; color: black; border-bottom: 2px solid #00A0C3; margin-bottom: 10px;"><?php echo $tpl->vars['ALLER']; ?></div>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12">
						<span><span style="font-weight:bold;"><?php echo $tpl->vars['DATE_DEPART']; ?> :</span> <?php echo $tpl->vars['TXT_DATE_DEPART']; ?></span>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-12">
						<span><span style="font-weight:bold;"><?php echo $tpl->vars['HEURE_DEPART']; ?> :</span> <?php echo $tpl->vars['TXT_HEURE_DEPART']; ?></span>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-12">
						<span><span style="font-weight:bold;"><?php echo $tpl->vars['PT_RASSEMBLEMENT']; ?> :</span> <?php echo $tpl->vars['TXT_PT_RASS_ALLER']; ?></span>
					</div>

					<?php if ($tpl->vars['TXT_RASS_ADRESSE_ALLER'] != '') : ?>
						<ul>
							<div class="col-xs-12 col-sm-12 col-md-12">
								<li><span style="font-weight:bold;"><?php echo $tpl->vars['ADRESSE_CLIENT']; ?> :</span> <?php echo $tpl->vars['TXT_RASS_ADRESSE_ALLER']; ?></li>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12">
								<li><span style="font-weight:bold;"><?php echo $tpl->vars['CODE_POST_CLIENT']; ?> :</span> <?php echo $tpl->vars['TXT_RASS_CP_ALLER']; ?></li>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12">
								<li><span style="font-weight:bold;"><?php echo $tpl->vars['VILLE_CLIENT']; ?> :</span> <?php echo $tpl->vars['TXT_RASS_VILLE_ALLER']; ?></li>
							</div>
						</ul>
					<?php endif; ?>
					
					<div class="col-xs-12 col-sm-12 col-md-12">
						<span><span style="font-weight:bold;"><?php echo $tpl->vars['PASSAGER_ADULTE']; ?> :</span> <?php echo $tpl->vars['TXT_PASSAGER_ADULTE_ALLER']; ?></span>
					</div>

					<?php if ($tpl->vars['TXT_PASSAGER_ENFANT_ALLER'] > 0) : ?>
						<div class="col-xs-12 col-sm-12 col-md-12">
							<span><span style="font-weight:bold;"><?php echo $tpl->vars['PASSAGER_ENFANT']; ?> :</span> <?php echo $tpl->vars['TXT_PASSAGER_ENFANT_ALLER']; ?></span>
						</div>
					<?php endif; ?>
					
					<div class="col-xs-12 col-sm-12 col-md-12">
						<span><span style="font-weight:bold;"><?php echo $tpl->vars['INFO_VOL']; ?> :</span></span>
					</div>
					<ul>
						<div class="col-xs-12 col-sm-12 col-md-12">
							<li><span style="font-weight:bold;"><?php echo $tpl->vars['COMPAGNIE']; ?> : </span><?php echo $tpl->vars['COMPAGNIE_INFO_VOL_ALLER']; ?></li>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12">
							<li><span style="font-weight:bold;"><?php echo $tpl->vars['DEST_VOL']; ?> : </span><?php echo $tpl->vars['DEST_INFO_VOL_ALLER']; ?></li>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12	">
							<li><span style="font-weight:bold;"><?php echo $tpl->vars['HEURE_VOL']; ?> : </span><?php echo $tpl->vars['HEURE_INFO_VOL_ALLER']; ?></li>
						</div>
					</ul>
				</div>
			</div>
			
			<!-- Bloc de "Retour" -->
			<?php if ($tpl->vars['TRAJET'] == 0) : ?>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12" style="text-align: center; font-weight: bold; color: black; border-bottom: 2px solid #00A0C3; margin-bottom: 10px;"><?php echo $tpl->vars['RETOUR']; ?></div>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12">
						<span><span style="font-weight:bold;"><?php echo $tpl->vars['DATE_RETOUR']; ?> :</span> <?php echo $tpl->vars['TXT_DATE_RETOUR']; ?></span>
					</div>

					<div class="col-xs-12 col-sm-12 col-md-12">
						<span><span style="font-weight:bold;"><?php echo $tpl->vars['HEURE_RETOUR']; ?> :</span> <?php echo $tpl->vars['TXT_HEURE_RETOUR']; ?></span>
					</div>

					<div class="col-xs-12 col-sm-12 col-md-12">
						<span><span style="font-weight:bold;"><?php echo $tpl->vars['PT_RASSEMBLEMENT']; ?> :</span> <?php echo $tpl->vars['TXT_PT_RASS_RETOUR']; ?></span>
					</div>

					<?php if ($tpl->vars['TXT_RASS_ADRESSE_RETOUR'] != '') : ?>
						<ul>
							<div class="col-xs-12 col-sm-12 col-md-12">
								<li><span style="font-weight:bold;"><?php echo $tpl->vars['ADRESSE_CLIENT']; ?> :</span> <?php echo $tpl->vars['TXT_RASS_ADRESSE_RETOUR']; ?></li>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12">
								<li><span style="font-weight:bold;"><?php echo $tpl->vars['CODE_POST_CLIENT']; ?> :</span> <?php echo $tpl->vars['TXT_RASS_CP_RETOUR']; ?></li>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12">
								<li><span style="font-weight:bold;"><?php echo $tpl->vars['VILLE_CLIENT']; ?> :</span> <?php echo $tpl->vars['TXT_RASS_VILLE_RETOUR']; ?></li>
							</div>
						</ul>
					<?php endif; ?>

					<div class="col-xs-12 col-sm-12 col-md-12">
						<span><span style="font-weight:bold;"><?php echo $tpl->vars['PASSAGER_ADULTE']; ?> :</span> <?php echo $tpl->vars['TXT_PASSAGER_ADULTE_RETOUR']; ?></span>
					</div>

					<?php if ($tpl->vars['TXT_PASSAGER_ENFANT_RETOUR'] > 0) : ?>
						<div class="col-xs-12 col-sm-12 col-md-12">
							<span><span style="font-weight:bold;"><?php echo $tpl->vars['PASSAGER_ENFANT']; ?> :</span> <?php echo $tpl->vars['TXT_PASSAGER_ENFANT_RETOUR']; ?></span>
						</div>
					<?php endif; ?>

					<div class="col-xs-12 col-sm-12 col-md-12">
						<span><span style="font-weight:bold;"><?php echo $tpl->vars['INFO_VOL']; ?> :</span></span>
					</div>
					<ul>
						<div class="col-xs-12 col-sm-12 col-md-12">
							<li><span style="font-weight:bold;"><?php echo $tpl->vars['COMPAGNIE']; ?> : </span><?php echo $tpl->vars['COMPAGNIE_INFO_VOL_RETOUR']; ?></li>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12">
							<li><span style="font-weight:bold;"><?php echo $tpl->vars['DEST_VOL']; ?> : </span><?php echo $tpl->vars['DEST_INFO_VOL_RETOUR']; ?></li>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12">
							<li><span style="font-weight:bold;"><?php echo $tpl->vars['HEURE_VOL']; ?> : </span><?php echo $tpl->vars['HEURE_INFO_VOL_RETOUR']; ?></li>
						</div>
					</ul>
				</div>
			</div>
			<?php endif; ?>
			
			<!-- Bloc informations trajet -->
			<div class="row">
				<h4 class="recap_reservation_form_titre"><?php echo $tpl->vars['TARIFS']; ?></h4>
				<div class="row">						
					<?php if ($tpl->vars['TRAJET'] == 0) : ?> 
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12" style="text-align: center; font-weight: bold; color: black; border-bottom: 2px solid #00A0C3; margin-bottom: 10px;"><?php echo $tpl->vars['ALLER']; ?></div>
							
							<?php if (!$tpl->vars['FORFAIT_MINI_ALLER']) : ?>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<span><span style="font-weight:bold;"><?php echo $tpl->vars['TARIFS_XX_PERSONNE_ALLER']; ?> : </span><?php echo $tpl->vars['TXT_COUT_TRAJET_ALLER']; ?> € (<?php echo $tpl->vars['COUT_PAR_PERSONNE_ALLER']; ?> € / <?php echo $tpl->vars['PERSONNE']; ?>)</span>
								</div>
							<?php else : ?>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<span><span style="font-weight:bold;"><?php echo $tpl->vars['COUT_TRAJET_BASE']; ?> : </span><?php echo $tpl->vars['TXT_COUT_TRAJET_ALLER']; ?> € (<?php echo $tpl->vars['FORFAIT_MINI']; ?>)</span>
								</div>
							<?php endif; ?>
							
							<?php if ($tpl->vars['TXT_SURCOUT_ALLER'] != '') : ?>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<span><span style="font-weight:bold;"><?php echo $tpl->vars['SURCOUT_DEMANDE']; ?> : </span><?php echo $tpl->vars['TXT_SURCOUT_ALLER']; ?> €</span>
								</div>
							<?php endif; ?>
							
							<?php if ($tpl->vars['DOMICILE_ALLER']) : ?>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<span><span style="font-weight:bold;"><?php echo $tpl->vars['PRISE_DOMICILE']; ?> : </span><?php echo $tpl->vars['PRIX_PRISE_ALLER']; ?> €</span>
								</div>
							<?php endif; ?>
						
							<?php if ($tpl->vars['MAJ_NUIT_ALLER'] > 0) : ?>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<span><span style="font-weight:bold;"><?php echo $tpl->vars['HORAIRE_NUIT']; ?> : </span><?php echo $tpl->vars['MAJ_NUIT_ALLER']; ?> €</span>
								</div>
							<?php endif; ?>
							
							<?php if ($tpl->vars['MAJ_FERIE_ALLER'] > 0) : ?>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<span><span style="font-weight:bold;"><?php echo $tpl->vars['LIBELLE_MAJ_FERIE_ALLER']; ?> : </span><?php echo $tpl->vars['MAJ_FERIE_ALLER']; ?> €</span>
								</div>
							<?php endif; ?>
						</div>
						
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12" style="text-align: center; font-weight: bold; color: black; border-bottom: 2px solid #00A0C3; margin-bottom: 10px;"><?php echo $tpl->vars['RETOUR']; ?></div>
							
							<?php if (!$tpl->vars['FORFAIT_MINI_RETOUR']) : ?>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<span><span style="font-weight:bold;"><?php echo $tpl->vars['TARIFS_XX_PERSONNE_RETOUR']; ?> : </span><?php echo $tpl->vars['TXT_COUT_TRAJET_RETOUR']; ?> € (<?php echo $tpl->vars['COUT_PAR_PERSONNE_RETOUR']; ?> € / <?php echo $tpl->vars['PERSONNE']; ?>)</span>
								</div>
							<?php else : ?>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<span><span style="font-weight:bold;"><?php echo $tpl->vars['COUT_TRAJET_BASE']; ?> : </span><?php echo $tpl->vars['TXT_COUT_TRAJET_RETOUR']; ?> € (<?php echo $tpl->vars['FORFAIT_MINI']; ?>)</span>
								</div>
							<?php endif; ?>
							
							<?php if ($tpl->vars['TXT_SURCOUT_RETOUR'] != '') : ?>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<span><span style="font-weight:bold;"><?php echo $tpl->vars['SURCOUT_DEMANDE']; ?> : </span><?php echo $tpl->vars['TXT_SURCOUT_RETOUR']; ?> €</span>
								</div>	
							<?php endif; ?>
							
							<?php if ($tpl->vars['DOMICILE_RETOUR']) : ?>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<span><span style="font-weight:bold;"><?php echo $tpl->vars['DEPOSE_DOMICILE']; ?> : </span><?php echo $tpl->vars['PRIX_PRISE_RETOUR']; ?> €</span>
								</div>
							<?php endif; ?>
						
							<?php if ($tpl->vars['MAJ_NUIT_RETOUR'] > 0) : ?>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<span><span style="font-weight:bold;"><?php echo $tpl->vars['HORAIRE_NUIT']; ?> : </span><?php echo $tpl->vars['MAJ_NUIT_RETOUR']; ?> €</span>
								</div>
							<?php endif; ?>
							
							<?php if ($tpl->vars['MAJ_FERIE_RETOUR'] > 0) : ?>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<span><span style="font-weight:bold;"><?php echo $tpl->vars['LIBELLE_MAJ_FERIE_RETOUR']; ?> : </span><?php echo $tpl->vars['MAJ_FERIE_RETOUR']; ?> €</span>
								</div>
							<?php endif; ?>
						</div>
						
					<?php else : ?> 
					
						<?php if (!$tpl->vars['FORFAIT_MINI_ALLER']) : ?>
							<div class="col-xs-12 col-sm-12 col-md-12">
								<span><span style="font-weight:bold;"><?php echo $tpl->vars['TARIFS_XX_PERSONNE']; ?> : </span><?php echo $tpl->vars['TXT_COUT_TRAJET_ALLER']; ?> € (<?php echo $tpl->vars['COUT_PAR_PERSONNE_ALLER']; ?> € / <?php echo $tpl->vars['PERSONNE']; ?>)</span>
							</div>
						<?php else : ?>
							<div class="col-xs-12 col-sm-12 col-md-12">
								<span><span style="font-weight:bold;"><?php echo $tpl->vars['COUT_TRAJET_BASE']; ?> : </span><?php echo $tpl->vars['TXT_COUT_TRAJET_ALLER']; ?> € (<?php echo $tpl->vars['FORFAIT_MINI']; ?>)</span>
							</div>
						<?php endif; ?>
						
						<?php if ($tpl->vars['TXT_SURCOUT_ALLER'] != '') : ?>
							<div class="col-xs-12 col-sm-12 col-md-12">
								<span><span style="font-weight:bold;"><?php echo $tpl->vars['SURCOUT_DEMANDE']; ?> : </span><?php echo $tpl->vars['TXT_SURCOUT_ALLER']; ?> €</span>
							</div>	
						<?php endif; ?>
						
						<?php if ($tpl->vars['DOMICILE_ALLER']) : ?>
							<div class="col-xs-12 col-sm-12 col-md-12">
								<span><span style="font-weight:bold;"><?php echo $tpl->vars['PRISE_DOMICILE']; ?> : </span><?php echo $tpl->vars['PRIX_PRISE_ALLER']; ?> €</span>
							</div>
						<?php endif; ?>
					
						<?php if ($tpl->vars['MAJ_NUIT_ALLER'] > 0) : ?>
							<div class="col-xs-12 col-sm-12 col-md-12">
								<span><span style="font-weight:bold;"><?php echo $tpl->vars['HORAIRE_NUIT']; ?> : </span><?php echo $tpl->vars['MAJ_NUIT_ALLER']; ?> €</span>
							</div>
						<?php endif; ?>
						
						<?php if ($tpl->vars['MAJ_FERIE_ALLER'] > 0) : ?>
							<div class="col-xs-12 col-sm-12 col-md-12">
								<span><span style="font-weight:bold;"><?php echo $tpl->vars['LIBELLE_MAJ_FERIE_ALLER']; ?> : </span><?php echo $tpl->vars['MAJ_FERIE_ALLER']; ?> €</span>
							</div>
						<?php endif; ?>
						
					<?php endif; ?>
					
					<?php if ($tpl->vars['DERNIERE_MINUTE_72']) : ?>
						<div class="col-xs-12 col-sm-12 col-md-12">
							<span><span style="font-weight:bold;"><?php echo $tpl->vars['RES_DER_MIN_72']; ?> : </span><?php echo $tpl->vars['TXT_DER_MIN_72']; ?> €</span>
						</div>
					<?php elseif ($tpl->vars['DERNIERE_MINUTE_24']) : ?>
						<div class="col-xs-12 col-sm-12 col-md-12">
							<span><span style="font-weight:bold;"><?php echo $tpl->vars['RES_DER_MIN_24']; ?> : </span><?php echo $tpl->vars['TXT_DER_MIN_24']; ?> €</span>
						</div>
					<?php endif; ?>
					
					<?php if ($tpl->vars['OPT_ANNULATION']) : ?>
						<div class="col-xs-12 col-sm-12 col-md-12">
							<span><span style="font-weight:bold;"><?php echo $tpl->vars['TXT_OPTION_ANNULATION']; ?> : </span><?php echo $tpl->vars['MONTANT_OPTION_ANNULATION']; ?> €</span>
						</div>
					<?php endif; ?>
					
					<?php if ($tpl->vars['VALEUR_REMISE'] > 0) : ?>
						<div class="col-xs-12 col-sm-12 col-md-12">
							<span><span style="font-weight:bold;"><?php echo $tpl->vars['REMISE']; ?> : </span><?php echo $tpl->vars['VALEUR_REMISE']; ?> €</span>
						</div>
					<?php endif; ?>
				   
					<div class="col-xs-12 col-sm-12 col-md-12" style="margin-top:20px;">
						<span style="font-weight:bold;font-size:1.2em;text-decoration:underline;"><?php echo $tpl->vars['PRIX_TOTAL']; ?> : <?php echo $tpl->vars['TXT_PRIX_TOTAL']; ?> €</span>
					</div>					
					
					<?php if ($tpl->vars['ON_A_ATTENDU']) : ?>
						<div class="col-xs-12 col-sm-12 col-md-12">
							<span style="font-weight:bold;font-size:1.2em;text-decoration:underline;"><?php echo $tpl->vars['PRIX_A_PAYER']; ?> : <?php echo $tpl->vars['TXT_MNT_A_PAYER']; ?> €</span>
						</div>						
					<?php endif; ?>
					
				</div>
				
			</div>
			
			<!-- Bloc informations client -->
			<div class="row">
				<h4 class="recap_reservation_form_titre"><?php echo $tpl->vars['TITRE_CLIENT']; ?></h4>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12">
						<span><span style="font-weight:bold;"><?php echo $tpl->vars['CIVILITE']; ?> : </span><?php echo $tpl->vars['TXT_CIVILITE_CLIENT']; ?></span>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-12">
						<span><span style="font-weight:bold;"><?php echo $tpl->vars['NOM_CLIENT']; ?> : </span><?php echo $tpl->vars['TXT_NOM_CLIENT']; ?></span>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-12">
						<span><span style="font-weight:bold;"><?php echo $tpl->vars['PRENOM_CLIENT']; ?> : </span><?php echo $tpl->vars['TXT_PRENOM_CLIENT']; ?></span>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-12">
						<span><span style="font-weight:bold;"><?php echo $tpl->vars['EMAIL']; ?> : </span><?php echo $tpl->vars['TXT_MAIL_CLIENT']; ?></span>
					</div>
					<?php if ($tpl->vars['TXT_TEL_CLIENT'] != '') : ?>
						<div class="col-xs-12 col-sm-12 col-md-12">
							<span><span style="font-weight:bold;"><?php echo $tpl->vars['TEL_CLIENT']; ?> : </span><?php echo $tpl->vars['TXT_IND_FIXE'];  echo $tpl->vars['TXT_TEL_CLIENT']; ?></span>
						</div>
					<?php endif; ?>
					
					<?php if ($tpl->vars['TXT_PORT_CLIENT'] != '') : ?>
						<div class="col-xs-12 col-sm-12 col-md-12">
							<span><span style="font-weight:bold;"><?php echo $tpl->vars['PORT_CLIENT']; ?> : </span><?php echo $tpl->vars['TXT_IND_PORT'];  echo $tpl->vars['TXT_PORT_CLIENT']; ?></span>
						</div>
					<?php endif; ?>
					
					<div class="col-xs-12 col-sm-12 col-md-12">
						<span><span style="font-weight:bold;"><?php echo $tpl->vars['PAYS_CLIENT']; ?> : </span><?php echo $tpl->vars['TXT_PAYS_CLIENT']; ?></span>
					</div>
					
					<?php if ($tpl->vars['TXT_AUTRE_PASSAGER'] == 'oui' ) : ?>
					
						<div class="col-xs-12 col-sm-12 col-md-12">  			
							<span style="font-weight:bold;"><?php echo $tpl->vars['TITRE_AUTRE_PASSAGER']; ?> </span>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12">
							<span><span style="font-weight:bold;"><?php echo $tpl->vars['NOM_AUTRE_PASSAGER']; ?> : </span><?php echo $tpl->vars['TXT_NOM_AUTRE_PASSAGER']; ?></span>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12">
							<span><span style="font-weight:bold;"><?php echo $tpl->vars['INDICATIF_TEL_AUTRE_PASSAGER']; ?> : </span><?php echo $tpl->vars['TXT_INDICATIF_TEL_AUTRE_PASSAGER']; ?></span>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12">
							<span><span style="font-weight:bold;"><?php echo $tpl->vars['TEL_PORT_AUTRE_PASSAGER']; ?> : </span><?php echo $tpl->vars['TXT_TEL_PORT_AUTRE_PASSAGER']; ?></span>
						</div>
					
					<?php endif; ?>
					
				</div>
			</div>
			
			<!-- Validation -->
			<div style="clear:both;margin-top:20px;" class="row">
			
				<?php if ($tpl->vars['EST_ADMIN'] == '0') : ?>
				
					<div class="row">
						<span style="font-weight:bold;"><?php echo $tpl->vars['INFO_INCORRECT']; ?></span>
					</div>
										
					<?php if ($tpl->vars['ENCRYPTED'] != '') : ?>

						<?php if ($tpl->vars['ATTENDRE_ALLER']) : ?>
							<div class="row" style="margin-top:20px;">
								<span style="font-weight:bold;"><?php echo $tpl->vars['JAI_ATTENDU_ALLER']; ?></span>
							</div>
						<?php elseif ($tpl->vars['ATTENDRE_RETOUR']) : ?>
							<div class="row" style="margin-top:20px;">
								<span style="font-weight:bold;"><?php echo $tpl->vars['JAI_ATTENDU_RETOUR']; ?></span>
							</div>
						<?php endif; ?>

						<!-- Bloc du mode de paiement -->
						<div class="row">
							<h4 class="recap_reservation_form_titre"><?php echo $tpl->vars['MODE_DE_PAIEMENT']; ?></h4>
							<div class="row">
								<?php if ($tpl->vars['PROFESSIONNEL'] == 0) : ?>
									<div class="col-xs-12 col-sm-12 col-md-12" style="text-align:center;">
										<span style="font-weight:bold;"><?php echo $tpl->vars['INFO_MODE_PAIEMENT']; ?></span>
									</div>
									
									<div class="col-xs-12 col-sm-6 col-md-6" style="margin-top:20px;">
										
										<?php if ($tpl->vars['ACTIVE_CA']) : ?>
											<form action="reservation/envoie_ca.php" method="post">
												<div class="centre">
													<input type="hidden" name="paiement_ca" value="<?php echo $tpl->vars['ENCRYPTED_CA']; ?>" />
													<input type="image" src="images/paiement.png" style="width:80%;" alt="e-transaction" name="bouton_paiement" />
												</div>
											</form>
										<?php endif; ?>
																						
									</div>

									<div class="col-xs-12 col-sm-5 col-sm-offset-1 col-md-5 col-md-offset-1" style="margin-top:20px;">
											
										<?php if ($tpl->vars['ACTIVE_PAYPAL']) : ?>
											<form action="https://www.paypal.com/fr/cgi-bin/webscr" method="post">
												<div class="centre">
													<input type="hidden" name="cmd" value="_s-xclick" />
													<input type="hidden" name="encrypted" value="<?php echo $tpl->vars['ENCRYPTED']; ?>" />
													<input type="image" src="http://alsace-navette.com/europapark/images/paypal_logo.png" name="submit" alt="<?php echo $tpl->vars['ALT_PAYPAL']; ?>" />
												</div>
											</form>
										<?php endif; ?>
											
									</div>
									
								<?php else : ?>
								
									<div class="col-xs-12 col-sm-12 col-md-12" style="margin-top:10px;">
										<div class="col-xs-12 col-sm-12 col-md-12" style="text-align: center; font-weight: bold; color: black; border-bottom: 2px solid #00A0C3; margin-bottom: 10px;margin-top:20px;"><?php echo $tpl->vars['JESUISPRO']; ?></div>
										<form method="post" action="reservation/confirmation.php">
											<div class="col-xs-12 col-sm-12 col-md-12" style="margin-top:10px;text-align:center;">
												<input type="hidden" name="res_4" />
												<input type="submit" value="<?php echo $tpl->vars['BTN_CONFIRMATION']; ?>" class="btn_confirm_reservation"/>
											</div>
										</form>
									</div>
									
								<?php endif; ?>
								
							</div>
							
						</div>
						
						<div class="col-xs-12 col-sm-12 col-md-12" style="margin-top:10px;">
							<input type="button" id="btn_annuler_demande" value="<?php echo $tpl->vars['RETOUR']; ?>" onclick="" />
						</div>
						
					<?php else : ?>
					
						<?php if ($tpl->vars['IS_DER_MIN'] != '0') : ?>
							<div class="row" style="margin-top:20px;">
								<span style="font-weight:bold;"><?php echo $tpl->vars['TXT_DER_MIN']; ?></span>
							</div>
						<?php endif; ?>

						<?php if ($tpl->vars['ON_A_ATTENDU']) : ?>
							<div class="row" style="margin-top:20px;">
								<span style="font-weight:bold;"><?php echo $tpl->vars['JAI_ATTENDU']; ?></span>
							</div>
						<?php endif; ?>

						<?php if ($tpl->vars['PROFESSIONNEL'] != 0) : ?>
							 <div class="row" style="margin-top:20px;">
								<span style="font-weight:bold;"><?php echo $tpl->vars['JESUISPRO']; ?></span>
							 </div>
						<?php endif; ?>
					
						<!-- Bloc autre -->
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12" style="text-align: center; font-weight: bold; color: black; border-bottom: 2px solid #00A0C3; margin-bottom: 10px;margin-top:20px;"><?php echo $tpl->vars['CONFIRMATION_RESA']; ?></div>
							<div class="row">
								<form method="post" action="reservation/confirmation.php">
									<div class="col-xs-12 col-sm-12 col-md-12" style="margin-top:10px;text-align:center;">
										<input type="hidden" name="res_4" />
										<input type="submit" value="<?php echo $tpl->vars['BTN_CONFIRMATION']; ?>" class="btn_confirm_reservation" style="font-size:1.2em;"/>
									</div>
								</form>
							</div>
						</div>
						
					<?php endif; ?>

				<?php else : ?>
					
					<fieldset>
						<legend>Options pour la saisie manuelle</legend>
						
						<form method="post" action="reservation/res_manuelle.php">
						 
							<p>
								<input type="checkbox" name="avertir_client" id="avertir_client" checked="checked" />
								<label for="avertir_client">Envoyer les mails de réservation au client</label>
							</p>
							
							<p>
								<label for="type_client">Type du client : </label>
								<select name="type_client" id="type_client">
								
									<option value="">Aucun</option>
									<option value="Shuttle Service">Shuttle Service</option>
									
								</select>
							</p>
							
							<p>
								<label for="lst_der_min">Réservation de dernière minute : </label>
								<select name="lst_der_min" id="lst_der_min">
									
									<?php if ($tpl->vars['TYPE_RES_DER_MIN'] == '') : ?>
									
										<option value="" selected="selected">Non</option>
										<option value="24">- 24h</option>
										<option value="72">- 72h</option>
										
									<?php elseif ($tpl->vars['TYPE_RES_DER_MIN'] == '24') : ?>
									
										<option value="">Non</option>
										<option value="24" selected="selected">- 24h</option>
										<option value="72">- 72h</option>
									
									<?php else : ?>
									
										<option value="">Non</option>
										<option value="24">- 24h</option>
										<option value="72" selected="selected">- 72h</option>
										
									<?php endif; ?>
									
								</select>
							</p>
							
							<div style="width:50%;float:left">

								<span class="mev"><i><strong>Aller</strong></i></span>

								<p>
									<?php if ($tpl->vars['A_PAYER_ALLER']) : ?>
										<input type="checkbox" id="a_payer_aller" name="a_payer_aller" checked="checked" />
									<?php else : ?>
										<input type="checkbox" id="a_payer_aller" name="a_payer_aller" />
									<?php endif; ?>
									<label for="a_payer_aller">Considérer comme payé</label>
								</p>
								
									<p>
										<label for="mode_de_paiement">Mode de paiement  </label>
										<select name="mode_de_paiement" id="mode_de_paiement">
											
																	   
												<option value="Espece" selected="selected">Espece</option>
												<option value="Cheque" > Cheque </option>
												
									   
											
										</select>                
									</p>                    

								<p>
									<label for="nv_prix_aller">Changer le prix du trajet de l'<u>aller</u> : </label>
									<input type="text" name="nv_prix_aller" id="nv_prix_aller" value="<?php echo $tpl->vars['TXT_TOTAL_ALLER']; ?>" size="3" />
									€
								</p>
								
								<p>
									<label for="lst_nv_fixe_aller">Navette à la demande pour l'<u>aller</u> (+ <?php echo $tpl->vars['TARIF_MAJ_DEMANDE']; ?> €) ?</label>
									<select name="lst_nv_fixe_aller" id="lst_nv_fixe_aller">
										
										<?php if ($tpl->vars['TXT_SURCOUT_ALLER'] == '') : ?>
										
											<option value="0" selected="selected">Non</option>
											<option value="1">Oui</option>
										
										<?php else : ?>
										
											<option value="0">Non</option>
											<option value="1" selected="selected">Oui</option>
											
										<?php endif; ?>
										
									</select>                
								</p>
								
								<p>
									<label for="nv_supplement_aller">Changer le prix de la prise à domicile de l'<u>aller</u> : </label>
									<input type="text" id="nv_supplement_aller" name="nv_supplement_aller" value="<?php echo $tpl->vars['TXT_SUPPLEMENT_ALLER']; ?>" size="3" />
									€
								</p>
							
								<p>
									<label for="est_nuit_aller">Horaire de nuit Aller : </label>
									<select name="est_nuit_aller" id="est_nuit_aller">
									
										<?php if ($tpl->vars['MAJ_NUIT_ALLER'] <= 0) : ?>
											<option value="0" selected>Non</option>
											<option value="1">Oui</option>
										<?php else : ?>
											<option value="0">Non</option>
											<option value="1" selected>Oui</option>
										<?php endif; ?>
										
									</select>
								</p>
								
							</div>

							
							<?php if ($tpl->vars['TRAJET'] != 0) : ?>
							<div style="float:left;width:50%;visibility:hidden;">
							<?php else : ?>
							<div style="float:left;width:50%">
							<?php endif; ?>

								<span class="mev"><i><strong>Retour</strong></i></span>

								<p>
									<?php if ($tpl->vars['A_PAYER_RETOUR']) : ?>
										<input type="checkbox" id="a_payer_retour" name="a_payer_retour" checked="checked" />
									<?php else : ?>
										<input type="checkbox" id="a_payer_retour" name="a_payer_retour" />
									<?php endif; ?>
									<label for="a_payer_retour">Considérer comme payé</label>
								</p>

								<p>
									<label for="nv_prix_retour">Changer le prix du trajet du <u>retour</u> : </label>
									<input type="text" name="nv_prix_retour" id="nv_prix_retour" value="<?php echo $tpl->vars['TXT_TOTAL_RETOUR']; ?>" size="3" />
									€
								</p>


								<p>
									<label for="lst_nv_fixe_retour">Navette à la demande pour le <u>retour</u> (+ <?php echo $tpl->vars['TARIF_MAJ_DEMANDE']; ?> €) ?</label>
									<select name="lst_nv_fixe_retour" id="lst_nv_fixe_retour">

										<?php if ($tpl->vars['TXT_SURCOUT_RETOUR'] == '') : ?>

											<option value="0" selected="selected">Non</option>
											<option value="1">Oui</option>

										<?php else : ?>

											<option value="0">Non</option>
											<option value="1" selected="selected">Oui</option>

										<?php endif; ?>

									</select>
								</p>

								<p>
									<label for="nv_supplement_retour">Changer  le prix de la prise à domicile du <u>retour</u> : </label>
									<input type="text" id="nv_supplement_retour" name="nv_supplement_retour" value="<?php echo $tpl->vars['TXT_SUPPLEMENT_RETOUR']; ?>" size="3" />
									€
								</p>
							
								<p>
									<label for="est_nuit_retour">Horaire de nuit Retour : </label>
									<select name="est_nuit_retour" id="est_nuit_retour">
									
										<?php if ($tpl->vars['MAJ_NUIT_RETOUR'] <= 0) : ?>
											<option value="0" selected>Non</option>
											<option value="1">Oui</option>
										<?php else : ?>
											<option value="0">Non</option>
											<option value="1" selected>Oui</option>
										<?php endif; ?>
										
									</select>
								</p>
								
							</div>

							<p style="text-align:center">
								<input type="hidden" name="res_manuelle" />
								<input type="hidden" name="id_paypal" value="<?php echo $tpl->vars['ID_PAYPAL']; ?>" />
								<input type="submit" value="Confirmer" />
							</p>

						
						</form>
						
					</fieldset>
					
				<?php endif; ?>
			
			</div>
			
		<!-- 2 DIV du blog principal -->
		</div>
	</div>
	
	<div class="col-xs-12 col-sm-6 col-md-6">
		<?php include("block_droite.html.php") ?> 
	</div>
	
</div>

	<!-- KEMPF : Ajout de ajax.js pour pouvoir traiter les demandes annulées en cours de réservation -->
	<script type="text/javascript" src="scripts/ajax.js"></script>
    <form id="form_back" action="demande_reservation.php" method="post"></form>
	
<script type="text/javascript">
<!--
	// KEMPF : Gestion de l'annulation de la demande
	var func_cancel = function(){
		set_demande_annulee("<?php echo $tpl->vars['CIVILITE_CLIENT2']; ?> <?php echo $tpl->vars['NOM_CLIENT2']; ?> <?php echo $tpl->vars['PRENOM_CLIENT2']; ?>", "<?php echo $tpl->vars['EMAIL_CLIENT']; ?>", <?php echo $tpl->vars['ID_TRAJET_DEPART']; ?>, <?php echo $tpl->vars['ID_TRAJET_DEST']; ?>, "Confirmation paiement", <?php echo $tpl->vars['PRIX_TRAJET']; ?>, <?php echo $tpl->vars['TRAJET_EST_SIMPLE']; ?>);
	}
	document.getElementById('btn_annuler_demande').onclick = func_cancel;
	
	//
</script>

<?php $tpl->includeTpl('footer.html', false, 0); ?>
