<?php $tpl->includeTpl('aeroport/include.html', false, 0); ?>
<!--
fichier:aeroport.aeroport.faq.html.php
updated:19/06/2019
-->
<div id="contenu_v2">
	
	<!-- Liste des aéroports  -->
	<div class='colonneDroite_2c'>
		<div class='titreColonne_2c'>
			<span class='txt_titre_colonne_2c'></span>
		</div>
		<div class='contenuBloc_2c_sansh'>
			<div style="text-align:center;">
				
				<?php if ($tpl->getBlock('liste_aero')) : foreach ($tpl->getBlock('liste_aero') as $__tpl_blocs['liste_aero']){ ?>
					<div>
						<div class="blocFondVioletTotal"><?php echo $__tpl_blocs['liste_aero']['TEXTE']; ?></div>
						
						<br /><br />
						
						<a href="<?php echo $__tpl_blocs['liste_aero']['LIEN']; ?>" target="_blank">
							<img src="images/<?php echo $__tpl_blocs['liste_aero']['IMAGE']; ?>" alt="<?php echo $__tpl_blocs['liste_aero']['TEXTE']; ?>" title="<?php echo $__tpl_blocs['liste_aero']['TEXTE']; ?>" style="max-width:100px;max-height:100px;" />
						</a>

						<br /><br />
					</div>
				<?php } endif; ?>
				
			</div>
			
		</div>
		
	</div>
	
	<!-- ENTETE -->
	<div class='colonneCentre_2c'>
		<div class='titreCentre_2c'>
			<span class='txt_titre_colonne_2c'><?php echo $tpl->vars['TITRE']; ?></span>
		</div>
		<div class='contenuCentre_2c_infini'>
			
			<div class='formulaire_2c'>
				
				<?php if ($tpl->getBlock('liste_faq')) : foreach ($tpl->getBlock('liste_faq') as $__tpl_blocs['liste_faq']){ ?>
					
					<fieldset>
						<legend style="font-weight:bold;"><u><?php echo $tpl->vars['TXT_QUESTION']; ?> n°<?php echo $__tpl_blocs['liste_faq']['NUMERO']; ?></u> : <?php echo $__tpl_blocs['liste_faq']['QUESTION']; ?></legend>

						<?php echo $__tpl_blocs['liste_faq']['REPONSE']; ?>
						
					</fieldset>
					<br />
					
				<?php } endif; ?>
				
			</div>
			
		</div>
		
	</div>
        
</div>

<?php $tpl->includeTpl('footer.html', false, 0); ?>
