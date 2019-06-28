<?php $tpl->includeTpl('aeroport/include.html', false, 0); ?>

<!--
fichier:aeroport.reservation.paiement-manuell.html.php
updated:19/06/2019
-->

<div class="row" id="contenu">

	<div class="col-xs-12 col-sm-6 col-md-6 recap_reservation">
		<h4><?php echo $tpl->vars['RECAPITULATIF']; ?></h4>
		<div class="col-xs-12 col-sm-12 col-md-12 recap_reservation_form">
			
			<?php if ($tpl->vars['CLASS_ERREUR'] != '') : ?>
			  
				<div class="erreur">
					<strong><?php echo $tpl->vars['ERREUR']; ?></strong>
				</div>
			
			<?php else : ?>
				<input type="hidden" name="id_paypal" value="<?php echo $tpl->vars['ID_PAYPAL']; ?>"/>
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
							<span><span style="font-weight:bold;"><?php echo $tpl->vars['INFO_VOL']; ?> :</span> <br />
								<?php echo $tpl->vars['INFO_VOL_ALLER']; ?>
							</span>
						</div>
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
									<li><span style="font-weight:bold;"><?php echo $tpl->vars['ADRESSE_CLIENT']; ?> :</span> <?php echo $tpl->vars['TXT_RASS_ADRESSE_RETOUR']; ?>></li>
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
							<span><span style="font-weight:bold;"><?php echo $tpl->vars['INFO_VOL']; ?> :</span> <br />
								<?php echo $tpl->vars['INFO_VOL_RETOUR']; ?>
							</span>
						</div>
						
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
							
								<?php if ($tpl->vars['TXT_NB_PASSAGER_ALLER'] >= $tpl->vars['TXT_FORFAIT_MINI_ALLER']) : ?>
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
						
								<?php if ($tpl->vars['MAJ_FERIE_ALLER'] > 0) : ?>
									<div class="col-xs-12 col-sm-12 col-md-12">
										<span><span style="font-weight:bold;"><?php echo $tpl->vars['LIBELLE_MAJ_FERIE_ALLER']; ?> : </span><?php echo $tpl->vars['MAJ_FERIE_ALLER']; ?> €</span>
									</div>
								<?php endif; ?>
							</div>
							
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12" style="text-align: center; font-weight: bold; color: black; border-bottom: 2px solid #00A0C3; margin-bottom: 10px;"><?php echo $tpl->vars['RETOUR']; ?></div>
							
								<?php if ($tpl->vars['TXT_NB_PASSAGER_RETOUR'] >= $tpl->vars['TXT_FORFAIT_MINI_RETOUR']) : ?>
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
						
							<?php if ($tpl->vars['TXT_NB_PASSAGER_TOT'] >= $tpl->vars['TXT_FORFAIT_MINI_ALLER']) : ?>
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
					   
						<div class="col-xs-12 col-sm-12 col-md-12" style="margin-top:20px;">
							<span style="font-size:1.2em;font-weight:bold;text-decoration:underline;"><?php echo $tpl->vars['PRIX_TOTAL']; ?> : <?php echo $tpl->vars['TXT_PRIX_TOTAL']; ?> €</span>
						</div>				
						
						<?php if ($tpl->vars['ON_A_ATTENDU']) : ?>
							<div class="col-xs-12 col-sm-12 col-md-12">
								<span style="font-size:1.2em;font-weight:bold;text-decoration:underline;"><?php echo $tpl->vars['PRIX_A_PAYER']; ?> : <?php echo $tpl->vars['TXT_MNT_A_PAYER']; ?> €</span>
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
								<span><span style="font-weight:bold;"><?php echo $tpl->vars['TITRE_AUTRE_PASSAGER']; ?> </span></span>
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
				<div style="clear:both;" class="row">

					<!-- Bloc du mode de paiement -->
					<div class="row">
						<h4 class="recap_reservation_form_titre"><?php echo $tpl->vars['MODE_DE_PAIEMENT']; ?></h4>
						<div class="row">
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
							
						</div>
						
					</div>
					
				</div>
				
			<?php endif; ?>
		<!-- Div de fin -->	
		</div>
		
	</div>
	
	<div class="col-xs-12 col-sm-6 col-md-6">
		<div class="bloc_droite">
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
