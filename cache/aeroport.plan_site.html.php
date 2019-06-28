<?php $tpl->includeTpl('aeroport/include.html', false, 0); ?>
<!--
fichier:aeroport.plan_site.html
updated:19/06/2019
-->

<div class="row" id="contenu">
    
    <div class="row pages_annexes">
		<h3 class="titre_pages_annexes"><?php echo $tpl->vars['TITRE']; ?></h3>
		<div class="col-xs-12 col-sm-12 col-md-12 div_pages_annexes" style="text-align:left;">
		
			<?php echo $tpl->vars['CONTENU']; ?>
        
		</div>
	</div>
	
</div>


<?php $tpl->includeTpl('footer.html', false, 0); ?>
