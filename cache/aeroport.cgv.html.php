<?php $tpl->includeTpl('aeroport/include.html', false, 0); ?>
<!--
fichier AEROPORT.CGV.HMTL.PHP
-->
<div class="row" id="contenu">
    
    <div class="row pages_annexes">
		<h3 class="titre_pages_annexes"><?php echo $tpl->vars['TITRE']; ?></h3>
		<div class="col-xs-12 col-sm-6 col-md-6 div_pages_annexes" style="text-align:justify;">
		
			<?php echo $tpl->vars['CONTENU_1']; ?>
        
		</div>
		<div class="col-xs-12 col-sm-6 col-md-6 div_pages_annexes" style="text-align:justify;">
		
			<?php echo $tpl->vars['CONTENU_2']; ?>
        
		</div>
	</div>
	
</div>


<?php $tpl->includeTpl('footer.html', false, 0); ?>
