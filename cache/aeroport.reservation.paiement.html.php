<?php $tpl->includeTpl('aeroport/include.html', false, 0); ?>

<!--
fichier aeroport.reservation.paiement.html
updated:19/06/2019
-->

<div id="contenu" class="row">
	<div class="row pages_annexes">
		<h3 class="titre_pages_annexes"><?php echo $tpl->vars['TITRE']; ?></h3>
		<div class="col-xs-12 col-sm-12 col-md-12 div_pages_annexes">
			
			<p><?php echo $tpl->vars['FIN_RES']; ?></p>

			<p><?php echo $tpl->vars['SONDAGE']; ?></p>
			
			<p><a href="index.php"><?php echo $tpl->vars['REVENIR_ACCUEIL']; ?></a></p>  
			
		</div>
	</div>
</div>

<?php $tpl->includeTpl('footer.html', false, 0); ?>
