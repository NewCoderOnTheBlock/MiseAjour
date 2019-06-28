<?php $tpl->includeTpl('aeroport/include.html', false, 0); ?>
<!--
AEROPORT.CIENT.password.html
updated 26/06/2019
-->

<div class="row" id="contenu">
    
    <?php if ($tpl->vars['ERREUR'] != '') : ?>
    
        <div class="<?php echo $tpl->vars['CLASS_ERREUR']; ?>">
            <strong><?php echo $tpl->vars['ERREUR']; ?></strong>
        </div>
        
        <!--<?php if ($tpl->vars['REDIRECTION']) : ?>
			<script type="text/javascript">
            function redirection(page)
              {window.location=page;}
            setTimeout('redirection("index.php"), 3000);
    
            </script>
        <?php endif; ?>-->
	
    <?php endif; ?>
    
	<div class="row pages_annexes">
		<h3 class="titre_pages_annexes"><?php echo $tpl->vars['TITRE_PASSWORD']; ?></h3>
		<div class="col-xs-12 col-sm-12 col-md-12 div_pages_annexes">
		
			<form method="post" action="client/password.php?action=<?php echo $tpl->vars['ACTION']; ?>">
			
				<p class="row"><?php echo $tpl->vars['EXPLICATION']; ?></p>
				<?php if ($tpl->vars['ACTION'] == 1) : ?> <!-- Nouveau mot de passe -->
				
					<div class="row" id="sprypassword_actuel" style="margin-top:20px;">
						<label for="anc_mdp" class="label_cote_4" style="text-transform:none;font-weight:bold;"><?php echo $tpl->vars['ANCIEN_MDP']; ?> : </label><br>
						<input type="password" name="anc_mdp" id="anc_mdp" />
						<span class="passwordRequiredMsg"><?php echo $tpl->vars['SPRY_VIDE']; ?></span>
					</div>
					
					<div class="row" id="sprypassword_new" style="margin-top:20px;">
						<label for="new_pass" class="label_cote_4" style="text-transform:none;font-weight:bold;"><?php echo $tpl->vars['NEW_PASS']; ?> : </label><br>
						<input type="password" name="new_pass" id="new_pass" />
						<span class="passwordRequiredMsg"><?php echo $tpl->vars['SPRY_VIDE']; ?></span>
					</div>
					
					<div class="row" id="spryconfirm" style="margin-top:20px;">
						<label for="new_pass_confirm" class="label_cote_4" style="text-transform:none;font-weight:bold;"><?php echo $tpl->vars['NEW_PASS_CONFIRM']; ?> : </label><br>
						<input type="password" name="new_pass_confirm" id="new_pass_confirm" />
						<span class="confirmRequiredMsg"><?php echo $tpl->vars['SPRY_VIDE']; ?></span>
						<span class="confirmInvalidMsg"><?php echo $tpl->vars['SPRY_CORRESPONDANCE']; ?></span>
					</div>
					
					<script type="text/javascript">
					<!--
						var sprypassword_actuel = new Spry.Widget.ValidationPassword("sprypassword_actuel", {validateOn:["blur"]});
						var sprypassword_new = new Spry.Widget.ValidationPassword("sprypassword_new", {validateOn:["blur"]});
						var spryconfirm = new Spry.Widget.ValidationConfirm("spryconfirm", "sprypassword_new", {validateOn:["blur"]});
					//-->
					</script>
				
				<?php else : ?> <!-- Mot de passe perdu -->
					
					<div class="row" id="sprytextfield_email" style="margin-top:20px;">
						<label for="adresse_mail" class="label_cote_4" style="text-transform:none;font-weight:bold;"><?php echo $tpl->vars['ADRESSE_MAIL']; ?> : </label><br>
						<input type="text" name="adresse_mail" id="adresse_mail" />
						<span class="textfieldRequiredMsg"><?php echo $tpl->vars['SPRY_VIDE']; ?></span>
						<span class="textfieldInvalidFormatMsg"><?php echo $tpl->vars['SPRY_FORMAT']; ?></span>
					</div>
					
					<script type="text/javascript">
					<!--
						var sprytextfield_email = new Spry.Widget.ValidationTextField("sprytextfield_email", "email", {validateOn:["blur"]});
					//-->
					</script>
					
				<?php endif; ?>
				
				<div class="row" style="margin-top:20px;">
					<input type="hidden" name="pass" />
					<input type="submit" value="<?php echo $tpl->vars['BTN_ENVOYER']; ?>" id="btn_envoyer" style="font-size:1em;"/>
				</div>
				
			</form>
			
		</div>
		
	</div>
	
</div>

<?php $tpl->includeTpl('footer.html', false, 0); ?>
