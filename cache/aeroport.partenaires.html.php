<?php $tpl->includeTpl('aeroport/include.html', false, 0); ?>

<!--
fichier:partenaire.html.php
updated:19/06/2019
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
			<div class='formulaire_2c'>
				
				<?php if ($tpl->vars['TYPE'] == 'TOUS') : ?>

					<table style="border:1px solid black; border-collapse:collapse; margin-left:auto;margin-right:auto;text-align:center">

						<?php if ($tpl->getBlock('tab_partner')) : foreach ($tpl->getBlock('tab_partner') as $__tpl_blocs['tab_partner']){ ?>

							<tr>
								<td style="border:1px solid black; padding:5px;"><img src="images/<?php echo $__tpl_blocs['tab_partner']['IMAGE']; ?>" alt="" style="height:60px" /></td>
								<td style="border:1px solid black; padding:5px">
									<strong><?php echo $tpl->vars['NOM']; ?> :</strong> <?php echo $__tpl_blocs['tab_partner']['TITRE']; ?>
									<br />
									<strong><?php echo $tpl->vars['LIEN']; ?> :</strong> <a href="<?php echo $__tpl_blocs['tab_partner']['LIEN']; ?>"><?php echo $__tpl_blocs['tab_partner']['LIEN']; ?></a>
									<br /><br />
									<a href="partenaires-p<?php echo $__tpl_blocs['tab_partner']['ID']; ?>.html">-> <?php echo $tpl->vars['VOIR_LE_DETAIL']; ?> <-</a>
								</td>
							</tr>

						<?php } endif; ?>

					</table>

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
				
			</div>
			<br />
		</div>
	</div>
        
</div>


<?php $tpl->includeTpl('footer.html', false, 0); ?>
