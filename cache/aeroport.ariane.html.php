<!--
FICHIER AEROPORT.ARIANE.HMTL.PHP
updated 27/06/2019
-->
<div id="fil_ariane">

	<span style="text-align:left; float:left">
    
    	<?php echo $tpl->vars['ARIANE_DEBUT']; ?> : 
        
        <?php if ($tpl->getBlock('fil')) : foreach ($tpl->getBlock('fil') as $__tpl_blocs['fil']){ ?>
            
            <?php if ($__tpl_blocs['fil']['LIEN'] != '') : ?>
            
                <a href="<?php echo $__tpl_blocs['fil']['LIEN']; ?>"><?php echo $__tpl_blocs['fil']['ARIANE']; ?></a>
                
            <?php else : ?>
            
                <?php echo $__tpl_blocs['fil']['ARIANE']; ?>
                
            <?php endif; ?>
                
            <?php if ($__tpl_blocs['fil']['CURRENT'] < $__tpl_blocs['fil']['SIZE_OF']) : ?>
            
                 > 
                 
            <?php endif; ?>
            
        <?php } endif; ?>
        
         
    </span>
   
</div>


<?php if ($tpl->vars['EST_ADMIN'] == '1') : ?>

    <div class="erreur">
        <strong>
        Connecté en tant qu'administrateur !
        <br />
        A n'utiliser que pour la saisie manuelle d'une réservation
        </strong>
    </div>
    <br />
    
    <?php if ($tpl->vars['EST_ADMIN_CLIENT'] == '1') : ?>
    	
        <br />
        
    	<div class="erreur">
    		<strong>Connecté sous le compte de <?php echo $tpl->vars['ADMIN_NOM']; ?> <?php echo $tpl->vars['ADMIN_PRENOM']; ?> (<?php echo $tpl->vars['ADMIN_MAIL']; ?>)<br />
            N'oublier pas de vous <a href="deconnexion.html">déconnecter</a> à la fin de la saisie !!</strong>
        </div>
        
        <br />
        
    <?php endif; ?>

<?php endif; ?>
