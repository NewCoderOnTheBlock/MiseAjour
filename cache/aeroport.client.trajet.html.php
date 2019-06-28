<?php $tpl->includeTpl('aeroport/include.html', false, 0); ?>

<div class="row" id="contenu" style="margin:0;">
    
	<div class="row trajets"> 
		<h3 class="titre_trajets"><?php echo $tpl->vars['TITRE']; ?></h3>
		<div class="col-xs-12 col-sm-12 col-md-12 liste_trajets" style="padding:0;">
		
			<p class="row" style="margin-bottom:10px;text-align:center;"><?php echo $tpl->vars['EXPLICATION']; ?></p>
			
			<?php if ($tpl->vars['TRAJETS_EXISTANT']) : ?>
			
				<?php foreach ($tpl->vars['MES_TRAJETS'] as $__tpl_foreach_key['MES_TRAJETS'] => $__tpl_foreach_value['MES_TRAJETS']) : ?>
			
					<div id="CollapsiblePanel<?php echo $__tpl_foreach_value['MES_TRAJETS']['ID']; ?>" class="CollapsiblePanel row" style="margin-top:10px;">

						<div class="CollapsiblePanelTab <?php echo $__tpl_foreach_value['MES_TRAJETS']['CLASS']; ?> row" style="margin:0;font-size:0.9em;">
							<div class="col-xs-12 col-sm-6 col-md-6">
								<?php echo $tpl->vars['TRAJET_DU']; ?> <?php echo $__tpl_foreach_value['MES_TRAJETS']['DATE_LONG']; ?>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-6" style="text-align:right;">
								<?php echo $__tpl_foreach_value['MES_TRAJETS']['STATUS']; ?>
							</div>
						</div>

						<div class="CollapsiblePanelContent row">
						
							<div class="col-xs-12 col-sm-6 col-md-6" style="margin-top:10px;">
								<div class="row" style="text-align:center;font-weight:bold;color:black;border-bottom:2px solid #00A0C3;margin-bottom:10px;"><?php echo $tpl->vars['TITRE_TRAJET']; ?></div>
									
								<div class="row">
									<span style="font-weight:bold;"><?php echo $tpl->vars['TRAJET_DEPART']; ?> :</span> <?php echo $__tpl_foreach_value['MES_TRAJETS']['DEPART']; ?></span>
								</div>
								
								<div class="row">
									<span><span style="font-weight:bold;"><?php echo $tpl->vars['TRAJET_ARRIVE']; ?> :</span> <?php echo $__tpl_foreach_value['MES_TRAJETS']['DEST']; ?></span>
								</div>
								
								<div class="row">
									<span><span style="font-weight:bold;"><?php echo $tpl->vars['PT_RASSEMBLEMENT']; ?> :</span> <?php echo $__tpl_foreach_value['MES_TRAJETS']['RASSEMBLEMENT']; ?></span>
								</div>
								
								<?php if ($__tpl_foreach_value['MES_TRAJETS']['INFO_VOL'] != '') : ?>
									
									<div class="row">
										<span><span style="font-weight:bold;"><?php echo $tpl->vars['INFO_VOL']; ?> :</span> <br /><?php echo $__tpl_foreach_value['MES_TRAJETS']['INFO_VOL']; ?></span>
									</div>
									
								<?php endif; ?>
																
								<div class="row">
									<span><span style="font-weight:bold;"><?php echo $tpl->vars['HEURE_DEPART']; ?> :</span> <?php echo $__tpl_foreach_value['MES_TRAJETS']['HEURE']; ?></span>
								</div>
								
								<div class="row">
									<span><span style="font-weight:bold;"><?php echo $tpl->vars['PASSAGER_ADULTE']; ?> :</span> <?php echo $__tpl_foreach_value['MES_TRAJETS']['NB_PERS']; ?></span>
								</div>
								
								<?php if ($__tpl_foreach_value['MES_TRAJETS']['NB_ENFANT'] > 0) : ?>
								
									<div class="row">
										<span><span style="font-weight:bold;"><?php echo $tpl->vars['PASSAGER_ENFANT']; ?> :</span> <?php echo $__tpl_foreach_value['MES_TRAJETS']['NB_ENFANT']; ?></span>
									</div>
									
								<?php endif; ?>	

							</div>
							
							<div class="col-xs-12 col-sm-6 col-md-6" style="margin-top:10px;">
								<div class="row" style="text-align:center;font-weight:bold;color:black;border-bottom:2px solid #00A0C3;margin-bottom:10px;"><?php echo $tpl->vars['INFO_PRATIQUE']; ?></div>
								
								<?php if ($__tpl_foreach_value['MES_TRAJETS']['VALIDE']) : ?>
									
									<div class="row">	
										<span><span style="font-weight:bold;"><?php echo $tpl->vars['CHAUFFEUR_NOM']; ?> :</span> <?php echo $__tpl_foreach_value['MES_TRAJETS']['NOM_CHAUFFEUR']; ?></span>
									</div>
									
									<div class="row">	
										<span><span style="font-weight:bold;"><?php echo $tpl->vars['CHAUFFEUR_PRENOM']; ?> :</span> <?php echo $__tpl_foreach_value['MES_TRAJETS']['PRENOM_CHAUFFEUR']; ?></span>
									</div>
									
									<div class="row">	
										<span><span style="font-weight:bold;"><?php echo $tpl->vars['CHAUFFEUR_PORT']; ?> :</span> <?php echo $__tpl_foreach_value['MES_TRAJETS']['PORT_CHAUFFEUR']; ?></span>
									</div>
								<?php endif; ?>

								<div class="row" style="margin-top:30px;color:white;">	
									<span style="background-color:#00A0C3;display:inline-block;height:30px;line-height:30px;padding-left:10px;padding-right:10px;font-size:1.2em;"><span style="font-weight:bold;font-size:1.1em;"><?php echo $tpl->vars['TARIF']; ?> :</span> <?php echo $__tpl_foreach_value['MES_TRAJETS']['PRIX']; ?> €</span>
								</div>

								<?php if ($__tpl_foreach_value['MES_TRAJETS']['CLASS'] == 'bleu_attente') : ?>

									<div class="row">
										<?php echo $tpl->vars['POUR_PAYER']; ?>

										<a href="reservation/paiement-manuel.php?id_client=<?php echo $__tpl_foreach_value['MES_TRAJETS']['ID_CLIENT']; ?>&id_res=<?php echo $__tpl_foreach_value['MES_TRAJETS']['ID_RES']; ?>&id_trajet1=<?php echo $__tpl_foreach_value['MES_TRAJETS']['ID_TRAJET']; ?>&id_trajet2=0&id_ligne1=<?php echo $__tpl_foreach_value['MES_TRAJETS']['ID_LIGNE']; ?>&id_ligne2=0&ar=0&alea=<?php echo $__tpl_foreach_value['MES_TRAJETS']['CODE_CLI']; ?>">
											<input type="submit" value="<?php echo $tpl->vars['ALT_PAYER']; ?>" id="btn_payer"/>
										</a>
									</div>

								<?php endif; ?>
								
								<?php if ($__tpl_foreach_value['MES_TRAJETS']['EST_ANNULE'] == 0) : ?>
									
									<?php if ($__tpl_foreach_value['MES_TRAJETS']['EST_PAYE'] == 1 && $__tpl_foreach_value['MES_TRAJETS']['A_OPTION_ANNUL'] == 1) : ?>

										<div class="row">
											<form 	method="post" 
													action="client/annuler_reservation.php" 
													id="formulaire_annulation_<?php echo $__tpl_foreach_value['MES_TRAJETS']['ID']; ?>">
												
												<input type="hidden" name="id_c" value="<?php echo $__tpl_foreach_value['MES_TRAJETS']['ID_CLIENT']; ?>" />
												<input type="hidden" name="id_r" value="<?php echo $__tpl_foreach_value['MES_TRAJETS']['ID_RES']; ?>" />
												<input class="btn_annuler" type="button" value="<?php echo $tpl->vars['OPT_ANNULATION']; ?>" id="bouton_annuler_trajet_<?php echo $__tpl_foreach_value['MES_TRAJETS']['ID']; ?>"/>
												
											</form>
										</div>
										
										<script type="text/javascript">
											
											var b = document.getElementById("bouton_annuler_trajet_<?php echo $__tpl_foreach_value['MES_TRAJETS']['ID']; ?>");var f = document.getElementById("formulaire_annulation_<?php echo $__tpl_foreach_value['MES_TRAJETS']['ID']; ?>");b.onclick = function(){if (confirm("Voulez-vous vraiment annuler votre réservation ?")){f.submit();}};
											
										</script>
									
									<?php endif; ?>
									
								<?php else : ?>

									<div class="row">
										<?php echo $tpl->vars['TRAJET_ANNULE']; ?>
									</div>
									
								<?php endif; ?>
						
							</div>
						
						</div>
					
						<script type="text/javascript">
						<!--
							var CollapsiblePanel<?php echo $__tpl_foreach_value['MES_TRAJETS']['ID']; ?> = new Spry.Widget.CollapsiblePanel("CollapsiblePanel<?php echo $__tpl_foreach_value['MES_TRAJETS']['ID']; ?>", {contentIsOpen:false});
						//-->
						</script>
					
					</div>
			
				<?php endforeach; ?>    
				
			<?php else : ?>
			
				<div class="row"><?php echo $tpl->vars['PAS_DE_TRAJET']; ?> !</div>
			
			<?php endif; ?>
			
		</div>
		
	</div>    
    
</div>



<?php $tpl->includeTpl('footer.html', false, 0); ?>

