
<?php $tpl->includeTpl('aeroport/include.html', false, 0); ?>
<!--
fichier:aeroport.livreor.livreor.html
updated:19/06/2019
-->

<div class="row" id="contenu">
    
    <?php if ($tpl->vars['ERREUR'] != '') : ?>
    
        <div class="<?php echo $tpl->vars['CLASS_ERREUR']; ?>">
            <strong><?php echo $tpl->vars['ERREUR']; ?></strong>
        </div>
	
    <?php endif; ?>
	
	<div class="row livre_or">
		<h3 class="titre_livre_or"><?php echo $tpl->vars['TITRE_LIVREOR']; ?></h3>
		
		<!-- Bloc envoi de message -->
		
		<div class="col-xs-12 col-sm-12 col-md-12 livre_or_form" style="padding-top:10px;padding-bottom:10px;">				
			<p id="presentation_livreor"><?php echo $tpl->vars['INTRO']; ?></p>
			
			<form method="post" action="livreor.php" id="form_livreor">
				
				<div class="row">
					<label for="pseudo"><?php echo $tpl->vars['PSEUDO_LIVREOR']; ?> : </label>
					<br />
					<input type="text" name="pseudo" id="pseudo" value="<?php echo $tpl->vars['PSEUDO']; ?>" maxlength="50" />
				</div>
				
				<div class="row">
					<label for="message"><?php echo $tpl->vars['MESSAGE_LIVREOR']; ?> : </label>
					<br />
					<textarea name="message" id="message" cols="40" rows="4" style="max-width:100%;"><?php echo $tpl->vars['MESSAGE']; ?></textarea>
				</div>
				
				<div class="row" style="margin-top:10px;">
					<?php echo $tpl->vars['TXT_CAPTCHA']; ?>
				</div>
				
				<div class="row">
				
					<img src="captcha.php?sessid=<?php echo $tpl->vars['SESSID']; ?>" alt="Captcha" id="captcha" />
					<br />
					<input type="button" id="btn_captcha" style="margin-top:5px;" value="<?php echo $tpl->vars['NOUVEAU_CAPTCHA']; ?>" onclick="document.getElementById('captcha').src='captcha.php?sessid=<?php echo $tpl->vars['SESSID']; ?>&amp;'+(Math.random()*10000000000000000000);" />
				
				</div>
				
				<div class="row" style="margin-top:10px;">
					<label for="code">Code : </label><br>
					<input type="text" name="code" id="code" />
				</div>
				
				<div class="row" style="margin-top:10px;">
					<input type="hidden" name="livreor" />
					<input type="submit" id="btn_envoyer" style="font-size:1em;" value="<?php echo $tpl->vars['BTN_ENVOYER']; ?>" />
				</div>
				
			</form>
			
		</div>
    
		<!-- Bloc de la liste des messages -->
		
		<div class="col-xs-12 col-sm-12 col-md-12 livre_or_messages" style="padding:0;">
			<p class="row">
				<?php echo $tpl->vars['TXT_NB_MESSAGE']; ?> : <span style="font-weight:bold;"><?php echo $tpl->vars['NB_MESSAGE']; ?></span>
				<br />
				Page : 
				
				<?php if ($tpl->vars['PAGE'] > 1) : ?>
					
					<a href="livreor.php?page=<?php echo $tpl->vars['PRECEDENT']; ?>"><?php echo $tpl->vars['PAGE_PRECEDENT']; ?></a>
						
				<?php endif; ?>
				
				<?php if ($tpl->getBlock('pagination')) : foreach ($tpl->getBlock('pagination') as $__tpl_blocs['pagination']){ ?>
				
					<?php if ($tpl->vars['PAGE'] == $__tpl_blocs['pagination']['PAGE']) : ?>
							
						<span class="page_on"><?php echo $__tpl_blocs['pagination']['PAGE']; ?></span>
							
					<?php elseif ($__tpl_blocs['pagination']['PAGE'] == '...') : ?>
						
						...
						
					<?php else : ?>
					
						<a href="livreor.php?page=<?php echo $__tpl_blocs['pagination']['PAGE']; ?>"><?php echo $__tpl_blocs['pagination']['PAGE']; ?></a>
							
					<?php endif; ?>
					
				<?php } endif; ?>
				
				<?php if ($tpl->vars['PAGE'] < $tpl->vars['NB_PAGE']) : ?>
					
					<a href="livreor.php?page=<?php echo $tpl->vars['SUIVANT']; ?>"><?php echo $tpl->vars['PAGE_SUIVANT']; ?></a>
						
				<?php endif; ?>
				
			</p>
				
			<!-- Messages -->
			
			<?php if ($tpl->getBlock('message')) : foreach ($tpl->getBlock('message') as $__tpl_blocs['message']){ ?>
			
				<div class="row livre_or_message">
					<h4 class="livre_or_message_auteur" style="text-align:left;text-transform:none;border-bottom:2px solid #00A0C3;padding-bottom:3px;"><?php echo $__tpl_blocs['message']['PSEUDO']; ?></h4>
					<p style="font-weight:bold;"><?php echo $__tpl_blocs['message']['DATE']; ?></p>
					<p class="livre_or_message_contenu">
						<?php echo $__tpl_blocs['message']['MESSAGE']; ?>
					</p>

				</div>
				
				<?php } else : if (true) { ?>

					<div class="row"><?php echo $tpl->vars['AUCUN_MESSAGE']; ?></div>

			<?php } endif; ?>
		
		</div>
	</div>   
</div>

<?php $tpl->includeTpl('footer.html', false, 0); ?>
