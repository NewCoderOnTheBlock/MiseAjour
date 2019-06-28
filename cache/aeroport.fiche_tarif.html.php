<?php $tpl->includeTpl('aeroport/include.html', false, 0); ?>

<!--
fichier:aeroport.reservation.fich_tarif.html.php
updated:19/06/2019
-->
<div id="contenu_v2">
	<!-- Liste des compagnies aériennes  -->
	
	<div class='colonneDroite_2c'>
		<div class='titreColonne_2c'>
			<span class='txt_titre_colonne_2c'><?php echo $tpl->vars['TITRE_COMPAGNIE']; ?></span>
		</div>
		<div class='contenuBloc_2c_sansh'>
			<div style="text-align:center;">
				
				<?php if ($tpl->getBlock('liste_compagnies')) : foreach ($tpl->getBlock('liste_compagnies') as $__tpl_blocs['liste_compagnies']){ ?>
					<div>
						<div class="blocFondVioletTotal"><?php echo $__tpl_blocs['liste_compagnies']['TEXTE']; ?></div>
						
						<br /><br />
						
						<a href="<?php echo $__tpl_blocs['liste_compagnies']['LIEN']; ?>" target="_blank">
							<img src="images/<?php echo $__tpl_blocs['liste_compagnies']['IMAGE']; ?>" alt="<?php echo $__tpl_blocs['liste_compagnies']['TEXTE']; ?>" title="<?php echo $__tpl_blocs['liste_compagnies']['TEXTE']; ?>" style="max-width:150px;max-height:100px;" />
						</a>

						<br /><br />
					</div>
				<?php } endif; ?>
				
			</div>
		</div>
	</div>
	
	<!-- TARIFS -->
	
	<div class='colonneCentre_2c'>
		<div class='titreCentre_2c'>
			<span class='txt_titre_colonne_2c'><div id="tarifs"><?php echo $tpl->vars['TITRE_TARIF']; ?></div></span>
		</div>
		<div class='contenuCentre_2c_infini'>
		
			<div style='font-size:12pt;'>
			
				<div class='formulaire_2c'>
					<div id='pastilleTarif' onclick='window.location.href="./tarifs.php"'><img src='./images/autre/pastilleOrange.png' width='130' /></div>

					<div class='titreTarif'>
						<?php echo $tpl->vars['NOM_TARIF']; ?>
					</div>
				</div>
				
				<br />
				
				<div class='blocFondViolet' style='width:100%;'><?php echo $tpl->vars['TARIF']; ?></div>
				<br />
				<div class='formulaire_2c' style='font-size:14px;text-align:center;'>
					<?php echo $tpl->vars['ALLER_SIMPLE']; ?> : <span class='grasOrange'><?php echo $tpl->vars['PRIX_PAR_PERS_TARIF']; ?> &euro;/pers</span>
					<br />
					<?php echo $tpl->vars['EXPLI_FORFAIT_MIN_1'];  echo $tpl->vars['PERSONNE_TARIF'];  echo $tpl->vars['EXPLI_FORFAIT_MIN_2']; ?><strong><?php echo $tpl->vars['FORFAIT_TARIF']; ?> &euro;</strong>
				</div>
				
				<br />
				
				<div class='blocFondViolet' style='width:100%;'><?php echo $tpl->vars['TITRE_RASSEMBLEMENT']; ?></div>
				<br />
				<div class='formulaire_2c' style='font-size:14px;text-align:center;'>
					<?php echo $tpl->vars['EXPLI_PT_RASSEMBLEMENT']; ?>
				</div>
				
				
				<?php if ($tpl->vars['LIBELLE_SORTIE'] != '') : ?>
					<br />
					
					<div class='blocFondViolet' style='width:100%;'><?php echo $tpl->vars['TITRE_RASSEMBLEMENT_AEROPORT']; ?></div>
					
					<div class='formulaire_2c' style='font-size:14px;text-align:center;'>
						<br />
						<strong><?php echo $tpl->vars['LIBELLE_SORTIE']; ?></strong>
						<br />
						<img src="<?php echo $tpl->vars['PHOTO_SORTIE']; ?>" title="<?php echo $tpl->vars['NOM_TARIF']; ?>" />
						<a target="blank_" href="<?php echo $tpl->vars['LIEN_PLAN_SORTIE']; ?>"><img src="<?php echo $tpl->vars['PLAN_SORTIE']; ?>" title="<?php echo $tpl->vars['NOM_TARIF']; ?>" /></a>
					</div>
				<?php endif; ?>
				
				<br />
				
				<div class='blocFondViolet' style='width:100%;'><?php echo $tpl->vars['TITRE_INFO_COMPL']; ?></div>
				<br />
				<div class='formulaire_2c' style='font-size:14px;text-align:center;'>
					<?php echo $tpl->vars['EXPLI_INFO_COMPL']; ?>
					<br />
					<br />
				</div>
				
			</div>
			
		</div>
		
	</div>

</div>


<?php $tpl->includeTpl('footer.html', false, 0); ?>
