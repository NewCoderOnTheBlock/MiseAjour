<?php $tpl->includeTpl('aeroport/include.html', false, 0); ?>

<!--
fichier:aeroport.services.html.php
updated:27/06/2019
-->

<div id="contenu_v2">
    
	<!-- Publicité  -->
	<div class='colonneDroite_2c'>
		<div class='titreColonne_2c'>
			<span class='txt_titre_colonne_2c'>...</span>
		</div>
		<div class='contenuBloc_2c_h400'>
			<div class='formulaire_2c_petit'>
			 
			</div>
		</div>
	</div>
	
	<!-- CONTENU -->
	
	<div class='colonneCentre_2c'>
		<div class='titreCentre_2c'>
			<span class='txt_titre_colonne_2c'><?php echo $tpl->vars['TITRE']; ?></span>
		</div>
		<div class='contenuCentre_2c_infini'>
				
			<?php if ($tpl->vars['TYPE'] == 'TOUS') : ?>
				
				<div style="padding:5px 5px 15px 20px;"><?php echo $tpl->vars['CONTENU']; ?></div>

					<?php if ($tpl->getBlock('tab_partner')) : foreach ($tpl->getBlock('tab_partner') as $__tpl_blocs['tab_partner']){ ?>
						
						<div>
							<div class="blocFondVioletTotal"><?php echo $__tpl_blocs['tab_partner']['TITRE']; ?></div>
							
							<br /><br />
							
							<table style="border:none;width:100%;">
							
								<tr>
									<td style="width:50%;text-align:center;">
										<a href="<?php echo $__tpl_blocs['tab_partner']['LIEN']; ?>"><img src="images/<?php echo $__tpl_blocs['tab_partner']['IMAGE']; ?>" alt="" style="height:60px" /></a>
									</td>
									<td style="width:50%;">
										<strong><a href="<?php echo $__tpl_blocs['tab_partner']['LIEN']; ?>"><?php echo $__tpl_blocs['tab_partner']['LIEN']; ?></a></strong>
										<br /><br />
										<a href="partenaires-p<?php echo $__tpl_blocs['tab_partner']['ID']; ?>.html"><?php echo $tpl->vars['VOIR_LE_DETAIL']; ?></a>
									</td>
								</tr>
								
							</table>
							
							<br /><br />
							
						</div>

					<?php } endif; ?>

			<?php else : ?>

				<span style="float:right"><a href="partenaires-p<?php echo $tpl->vars['PARTNER_SUIVANT']; ?>.html"><?php echo $tpl->vars['SUIVANT']; ?></a></span>
				<span><a href="partenaires-p<?php echo $tpl->vars['PARTNER_PRECEDENT']; ?>.html"><?php echo $tpl->vars['PRECEDENT']; ?></a></span>

				<br />
				<br />
				<p>
					<strong><?php echo $tpl->vars['NOM']; ?> :</strong> <?php echo $tpl->vars['TITREE']; ?>
				</p>

				<p>
					<strong><?php echo $tpl->vars['LIEN']; ?> :</strong> <a href="<?php echo $tpl->vars['LIENN']; ?>"><?php echo $tpl->vars['LIENN']; ?></a>
				</p>

				<p>
					<strong><?php echo $tpl->vars['DESCRIPTION']; ?> :</strong> <?php echo $tpl->vars['TEXT']; ?>
				</p>

				<br />
				<p style="text-align:center">
					<img src="images/<?php echo $tpl->vars['IMAGE']; ?>" alt="" />
				</p>


			<?php endif; ?>
			
			<br />
			
		</div>
		
	</div>
        
</div>


<?php $tpl->includeTpl('footer.html', false, 0); ?>
