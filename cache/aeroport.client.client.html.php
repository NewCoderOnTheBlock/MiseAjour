<?php $tpl->includeTpl('aeroport/include.html', false, 0); ?>
<!--
aeroport.client.client.html
updated 26/06/2019
-->

<div class="row" id="contenu">
    
     <?php if ($tpl->vars['ERREUR'] != '') : ?>
    
        <div class="<?php echo $tpl->vars['CLASS_ERREUR']; ?>">
            <strong><?php echo $tpl->vars['ERREUR']; ?></strong>
        </div>
	
    <?php endif; ?>
    
    <?php if ($tpl->vars['ERREUR_PASS'] != '') : ?>
    
        <div class="<?php echo $tpl->vars['CLASS_PASS']; ?>">
            <strong><?php echo $tpl->vars['ERREUR_PASS']; ?></strong>
        </div>
	
    <?php endif; ?>
    
    <div class="row pages_annexes">
		<h3 class="titre_pages_annexes"><?php echo $tpl->vars['DEJA_CLIENT_TXT']; ?></h3>
		<div class="col-xs-12 col-sm-12 col-md-12 div_pages_annexes">
		
			<form method="post" action="client/client.php?p=<?php echo $tpl->vars['PAGE']; ?>">
								
				<?php if ($tpl->vars['EST_ADMIN'] == '1') : ?>
					
					<div class="erreur">
						
						<strong>Connexion en tant que client tout en restant administrateur</strong>
						
					</div>
					
				<?php endif; ?>
				
				<p class="row"><?php echo $tpl->vars['EXPLICATION']; ?></p>
				
				<input type="hidden" name="deja_client" />
				
				<div class="row" id="sprytextfield_email" style="margin-top:20px;">
					<label for="mail" class="label_cote_4" style="text-transform:none;font-weight:bold;"><?php echo $tpl->vars['EMAIL']; ?> : </label><br>
					<input type="text" name="mail" id="mail" autofocus/>
					<span class="textfieldRequiredMsg"><?php echo $tpl->vars['SPRY_VIDE']; ?></span>
					<span class="textfieldInvalidFormatMsg"><?php echo $tpl->vars['SPRY_FORMAT']; ?></span>
				</div>
				
				<div class="row" id="sprypassword" style="margin-top:20px;">
					<label for="pass" class="label_cote_4" style="text-transform:none;font-weight:bold;"><?php echo $tpl->vars['PASSWD']; ?> : </label><br>
					<input type="password" name="pass" id="pass" />
					<span class="passwordRequiredMsg"><?php echo $tpl->vars['SPRY_VIDE']; ?></span>
				</div>
				
				<div class="row" style="margin-top:20px;"><a href="client/password.php?action=2"><?php echo $tpl->vars['MDP_OUBLIE']; ?></a></div>
				
				<div class="row" style="margin-top:20px;"><input type="submit" value="<?php echo $tpl->vars['BTN_ENVOYER']; ?>" id="btn_envoyer" style="font-size:1em;"/></div>
			
			</form>    
    
			<script src="../SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
			<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
			
			<script type="text/javascript">
			<!--
				window.addEventListener('load', function() {
					var sprypassword = new Spry.Widget.ValidationPassword("sprypassword", {validateOn:["blur"]});
					var sprytextfield_email = new Spry.Widget.ValidationTextField("sprytextfield_email", "email", {validateOn:["blur"]});
				});
			//-->
			</script>
			
		</div>
	</div>
			
</div>

<?php $tpl->includeTpl('footer.html', false, 0); ?>

