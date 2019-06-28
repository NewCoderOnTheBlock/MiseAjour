
<?php $tpl->includeTpl('aeroport/include.html', false, 0); ?>
<!--
fichier:aeroport.CONTACT.CONTACT.HTML
updated 26/06/2019
-->
<div class="row">
    <h3 class="titre_contact"><?php echo $tpl->vars['TITRE_CONTACT']; ?></h3>
    <?php if ($tpl->vars['ERREUR'] != '') : ?>
    
        <div class="<?php echo $tpl->vars['CLASS_ERREUR']; ?>">
            <strong><?php echo $tpl->vars['ERREUR']; ?></strong>
        </div>
	
    <?php endif; ?>
	
	<!-- Partie gauche : raisons du contact et formulaire -->
	<div class="col-xs-12 col-sm-6 col-md-6 contact_gauche">
		<p>
			<?php echo $tpl->vars['TXT_CONTACT']; ?>
		</p>
		
		<ul>
			<?php if ($tpl->getBlock('contact')) : foreach ($tpl->getBlock('contact') as $__tpl_blocs['contact']){ ?>
				<li style="margin-top:10px;"><?php echo $__tpl_blocs['contact']['RAISON']; ?></li>
			<?php } endif; ?>
		</ul>
		<h4 style="margin-top:20px;margin-bottom:20px;"><?php echo $tpl->vars['TITRE_FORMULAIRE']; ?></h4>
		<form method="post" action="contact.html">		
			<div class="row">
				<label for="nom" class="col-xs-12 col-sm-4 col-md-3"><?php echo $tpl->vars['NOM_CONTACT']; ?> <sup class="rouge">*</sup> : </label>
				<input type="text" name="nom" id="nom" value="<?php echo $tpl->vars['TXT_NOM_CONTACT']; ?>" class="col-xs-12 col-sm-8 col-md-9"/>
			</div>
			
			<div class="row">
				<label for="prenom" class="col-xs-12 col-sm-4 col-md-3"><?php echo $tpl->vars['PRENOM_CONTACT']; ?> <sup class="rouge">*</sup> : </label>
				<input type="text" name="prenom" id="prenom" value="<?php echo $tpl->vars['TXT_PRENOM_CONTACT']; ?>" class="col-xs-12 col-sm-8 col-md-9"/>	
			</div>
			
			<div class="row">
				<label for="mail" class="col-xs-12 col-sm-4 col-md-3">Email <sup class="rouge">*</sup> : </label>
				<input type="text" name="mail" id="mail" value="<?php echo $tpl->vars['TXT_MAIL_CONTACT']; ?>" class="col-xs-12 col-sm-8 col-md-9"/>
			</div>
			
			<div class="row">
				<label for="raison" class="col-xs-12 col-sm-4 col-md-3"><?php echo $tpl->vars['RAISON_CONTACT']; ?> <sup class="rouge">*</sup> : </label>
				<select name="raison" id="raison" class="col-xs-12 col-sm-8 col-md-9">
					<?php if ($tpl->getBlock('raison')) : foreach ($tpl->getBlock('raison') as $__tpl_blocs['raison']){ ?>
						<?php if ($__tpl_blocs['raison']['CODE_RAISON'] == $tpl->vars['RAISON_CHERCHE']) : ?>
							<option value="<?php echo $__tpl_blocs['raison']['CODE_RAISON']; ?>" selected="selected"><?php echo $__tpl_blocs['raison']['RAISON']; ?></option>	
						<?php else : ?>
							<option value="<?php echo $__tpl_blocs['raison']['CODE_RAISON']; ?>"><?php echo $__tpl_blocs['raison']['RAISON']; ?></option>
						<?php endif; ?>
					<?php } endif; ?>
				</select>
			</div>
			
			<div class="row">
				<label for="message" class="col-xs-12 col-sm-4 col-md-3">Message <sup class="rouge">*</sup> : </label>			
				<textarea name="message" rows="5" id="message" class="col-xs-12 col-sm-8 col-md-9" style="max-width:100%;"><?php echo $tpl->vars['TXT_MESSAGE_CONTACT']; ?></textarea>
			</div>
			
			<div class="col-xs-12 col-sm-12 col-md-12" style="font-size:0.8em;text-align:center;"><sup class="rouge">*</sup> : <?php echo $tpl->vars['OBLIGATOIRE']; ?></div>
			
			<input type="hidden" name="contact" />
			<div class="col-xs-12 col-sm-12 col-md-12 centre" style="padding:0;">
				<input type="submit" value="<?php echo $tpl->vars['BTN_ENVOYER']; ?>" style="width:100px;height:30px;background-color:#00A0C3;border:1px solid white;color:white;"/>
			</div>
		</form>
	</div>

	<!-- Partie droite : moyens de contact et map google  -->
	<div class="col-xs-12 col-sm-6 col-md-6 contact_droite">
		<div class="row" style="margin:0;">
			<div class="col-xs-12 col-sm-12 col-md-6" style="padding:0;">
				<p>
					<?php echo $tpl->vars['MOYEN_CONTACT']; ?>
				</p>
				
				<ul style="margin-bottom:0;">
					<?php if ($tpl->getBlock('moyen')) : foreach ($tpl->getBlock('moyen') as $__tpl_blocs['moyen']){ ?>
						<li style="margin-top:10px;"><?php echo $__tpl_blocs['moyen']['CONTACT']; ?></li>						
					<?php } endif; ?>
				</ul>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 picto_contact">
				<img src="images/picto/picto_contact.png">
			</div>
		</div>
		<p class="row" style="margin:0;margin-top:20px;"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1319.7404263325516!2d7.740734737440971!3d48.58149120418793!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4796c84c82a23f99%3A0xdd7206aff0e739da!2sAssociation+Franco+Iranienne+d&#39;Alsace!5e0!3m2!1sfr!2sfr!4v1432733092685" width="600" height="260" frameborder="0" style="border:0;max-width:100%;"></iframe></p>
	</div>    
</div>


<?php $tpl->includeTpl('footer.html', false, 0); ?>
