<?php $tpl->includeTpl('aeroport/include.html', false, 0); ?>

<!--
fichier:aeroport.news.html
updated:19/06/2019
-->
<div id="contenu">
	
	<!-- Si on affiche toutes les news -->
	<?php if ($tpl->vars['TYPE'] == 'TOUS') : ?>
		<!-- Bloc principal -->
		<div class="row news">
			<h3 class="titre_pages_annexes"><?php echo $tpl->vars['TITRE_PAGE']; ?></h3>
			<div class="col-xs-12 col-sm-12 col-md-12 neww_form">					
				<p class="centre row">

					Page :

					<?php if ($tpl->vars['PAGE'] > 1) : ?>

						<?php if ($tpl->vars['CAT_CHERCHER'] != '') : ?>
							<a href="news.php?page=<?php echo $tpl->vars['PRECEDENT']; ?>&cat=<?php echo $tpl->vars['CAT_CHERCHER']; ?>"><?php echo $tpl->vars['PAGE_PRECEDENT']; ?></a>
						<?php else : ?>
							<a href="news.php?page=<?php echo $tpl->vars['PRECEDENT']; ?>"><?php echo $tpl->vars['PAGE_PRECEDENT']; ?></a>
						<?php endif; ?>

					<?php endif; ?>

					<?php if ($tpl->getBlock('pagination')) : foreach ($tpl->getBlock('pagination') as $__tpl_blocs['pagination']){ ?>

						<?php if ($tpl->vars['PAGE'] == $__tpl_blocs['pagination']['PAGE']) : ?>

							<span class="page_on"><?php echo $__tpl_blocs['pagination']['PAGE']; ?></span>

						<?php elseif ($__tpl_blocs['pagination']['PAGE'] == '...') : ?>

							...

						<?php else : ?>

							<?php if ($tpl->vars['CAT_CHERCHER'] != '') : ?>
								<a href="news.php?page=<?php echo $__tpl_blocs['pagination']['PAGE']; ?>&cat=<?php echo $tpl->vars['CAT_CHERCHER']; ?>"><?php echo $__tpl_blocs['pagination']['PAGE']; ?></a>
							<?php else : ?>
								<a href="news.php?page=<?php echo $__tpl_blocs['pagination']['PAGE']; ?>"><?php echo $__tpl_blocs['pagination']['PAGE']; ?></a>
							<?php endif; ?>

						<?php endif; ?>

					<?php } endif; ?>

					<?php if ($tpl->vars['PAGE'] < $tpl->vars['NB_PAGE']) : ?>

						<?php if ($tpl->vars['CAT_CHERCHER'] != '') : ?>
							<a href="news.php?page=<?php echo $tpl->vars['SUIVANT']; ?>&cat=<?php echo $tpl->vars['CAT_CHERCHER']; ?>"><?php echo $tpl->vars['PAGE_SUIVANT']; ?></a>
						<?php else : ?>
							<a href="news.php?page=<?php echo $tpl->vars['SUIVANT']; ?>"><?php echo $tpl->vars['PAGE_SUIVANT']; ?></a>
						<?php endif; ?>

					<?php endif; ?>
				</p>
					
				<div class="row" style="text-align:center;">
					<label for="cat"><?php echo $tpl->vars['CHOIX_CAT']; ?> : </label><br>
					<form method="post" action="news.php">
					
						<select id="cat" name="cat" onchange="submit()">

							<?php foreach ($tpl->vars['LST_CAT'] as $__tpl_foreach_key['LST_CAT'] => $__tpl_foreach_value['LST_CAT']) : ?>

								<?php if ($__tpl_foreach_value['LST_CAT']['id_cat'] == $tpl->vars['CAT_CHERCHER']) : ?>

									<option value="<?php echo $__tpl_foreach_value['LST_CAT']['id_cat']; ?>" selected="selected"><?php echo $__tpl_foreach_value['LST_CAT']['nom']; ?></option>

								<?php else : ?>

									<option value="<?php echo $__tpl_foreach_value['LST_CAT']['id_cat']; ?>"><?php echo $__tpl_foreach_value['LST_CAT']['nom']; ?></option>

								<?php endif; ?>

							<?php endforeach; ?>

						</select>

					</form>
				</div>
			</div>
		
			<!-- Bloc des news -->
			<div class="col-xs-12 col-sm-12 col-md-12 liste_news" style="padding:0;">
				<?php if ($tpl->getBlock('news')) : foreach ($tpl->getBlock('news') as $__tpl_blocs['news']){ ?>
					
					<div class="col-xs-12 col-sm-12 col-md-12 new" style="padding:0;">
						<h4 style="margin:0;text-transform:none;"><?php echo $__tpl_blocs['news']['TITRE']; ?><span style="font-size:0.7em;"> - <?php echo $__tpl_blocs['news']['DATE']; ?></span></h4>
						<div class="col-xs-12 col-sm-12 col-md-12 contenu_new">
							<p>
								<?php echo $__tpl_blocs['news']['TEXTE']; ?><br>
								<span style="font-style:italic;color:black;border-top:2px solid #00A0C3;margin-bottom:10px;padding-top:5px;"><?php echo $__tpl_blocs['news']['CAT']; ?></span>
							</p>
						</div>
					</div>	
					
				<?php } endif; ?>
				
			</div>
			
		</div>
    <?php else : ?>

		<div class="col-xs-12 col-sm-12 col-md-12 liste_news" style="padding:0;">
			<div class="col-xs-12 col-sm-12 col-md-12 new" style="padding:0;">
				<h4 style="margin:0;text-transform:none;"><?php echo $tpl->vars['TITRE']; ?><span style="font-size:0.7em;"> - <?php echo $tpl->vars['DATE']; ?></span></h4>
				<div class="col-xs-12 col-sm-12 col-md-12 contenu_new">
					<p>
						<?php echo $tpl->vars['TEXTE']; ?><br>
						<span style="font-style:italic;color:black;border-top:2px solid #00A0C3;margin-bottom:10px;padding-top:5px;"><?php echo $tpl->vars['CAT']; ?></span>
					</p>
				</div>
			</div>	
		</div>	

    <?php endif; ?>

</div>

<?php $tpl->includeTpl('footer.html', false, 0); ?>
