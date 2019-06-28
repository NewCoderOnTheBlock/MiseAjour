<!--
fichier:aeroport.menu.speedbar.html.php
updated 26/06/2019
-->
<script>
	//~ function googleTranslateElementInit() {
		//~ new google.translate.TranslateElement({
			//~ pageLanguage: '<?php echo $tpl->vars['LANGUE']; ?>',
			//~ includedLanguages: 'de,es,it,ru,tr',
			//~ layout: google.translate.TranslateElement.InlineLayout.SIMPLE
		//~ },'google_translate_element');
	//~ }
</script>
<script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
	
<div id="entete" class="row">

	<div id='divDrapeau'>
		<table align="right">
			<tr>
				<td class="lien_espace_an">
					<a href="#">
						Espace Alsace-Navette
					</a>
				</td>
				<td>
					<a href="<?php echo $tpl->vars['URI']; ?>?lang=fr">
						<img src='images/drapeau_fr.png' class='imgDrapeau' id='drapFR' />
					</a>
				</td>
				<td>
					<a href="<?php echo $tpl->vars['URI']; ?>?lang=en">
						<img src='images/drapeau_en.png' class='imgDrapeau' id='drapEN' style="margin-left:5px;" />
					</a>
				</td>
				<td style="padding-left:5px;">
					<span id="google_translate_element"></span>
				</td>
			</tr>
		</table>
	</div>
	
	<div id='menu' class="row">
		<ul id='listeMenu' class="row">
			<div class="col-xs-12 col-sm-1 col-md-1">
				<a href="index.php"><img src="../images/airport-logo.png"></a>
			</div>
			<div class="col-xs-12 col-sm-11 col-md-11">
				<?php if ($tpl->getBlock('speed')) : foreach ($tpl->getBlock('speed') as $__tpl_blocs['speed']){ ?>
					<div class="col-xs-6 col-sm-4 col-md-2">
					<?php if ($tpl->vars['INFO_PAGE'] == $__tpl_blocs['speed']['LIEN']) : ?>
						<li class="selectionnee">
					<?php else : ?>
						<li class="btnNormal" id="bt<?php echo $__tpl_blocs['speed']['ITEM']; ?>">
					<?php endif; ?>
					
							<a href="<?php echo $__tpl_blocs['speed']['LIEN']; ?>"><span><img src="<?php echo $__tpl_blocs['speed']['IMAGE']; ?>" class="picto"><?php echo $__tpl_blocs['speed']['ITEM']; ?></span></a>
						
						</li>
					</div>
					
				<?php } endif; ?>
				<div class="col-xs-6 col-sm-4 col-md-2" style="position:relative;">
					<?php if ($tpl->vars['LOGGER']) : ?>
						<span id="compte" onclick="menuCompte();"><img src="images/picto/menu/identifier.png">
						<?php echo $tpl->vars['MON_COMPTE']; ?></span>
						<div id="menu_compte">
							<?php if ($tpl->vars['EST_FIDELE']) : ?>	
								
								<div class="col-xs-12 col-sm-12 col-md-12" style="text-align:right;padding:0;"><?php echo $tpl->vars['MES_POINTS_FIDELITE']; ?> : <?php echo $tpl->vars['NOMBRE_POINTS']; ?>/<?php echo $tpl->vars['PALIER_POINTS']; ?></div>
							
							<?php endif; ?>
							
							<?php if ($tpl->vars['INFO_PAGE'] == 'password.php') : ?>
								<div class="col-xs-12 col-sm-12 col-md-12 compte_selectionne" style="text-align:right;padding:0;"><a href="client/password.php?action=1"><?php echo $tpl->vars['CHANGER_PASS']; ?></a></div>
							<?php else : ?>
								<div class="col-xs-12 col-sm-12 col-md-12" style="text-align:right;padding:0;"><a href="client/password.php?action=1"><?php echo $tpl->vars['CHANGER_PASS']; ?></a></div>
							<?php endif; ?>
							<?php if ($tpl->vars['INFO_PAGE'] == 'trajet.php') : ?>
								<div class="col-xs-12 col-sm-12 col-md-12 compte_selectionne" style="text-align:right;padding:0;"><a href="client/trajet.php"><?php echo $tpl->vars['MES_TRAJET']; ?></a></div>
							<?php else : ?>
								<div class="col-xs-12 col-sm-12 col-md-12" style="text-align:right;padding:0;"><a href="client/trajet.php"><?php echo $tpl->vars['MES_TRAJET']; ?></a></div>
							<?php endif; ?>
							<?php if ($tpl->vars['INFO_PAGE'] == 'info.php') : ?>
								<div class="col-xs-12 col-sm-12 col-md-12 compte_selectionne" style="text-align:right;padding:0;"><a href="client/info.php"><?php echo $tpl->vars['CHANGER_INFO_PERSO']; ?></a></div>
							<?php else : ?>
								<div class="col-xs-12 col-sm-12 col-md-12" style="text-align:right;padding:0;"><a href="client/info.php"><?php echo $tpl->vars['CHANGER_INFO_PERSO']; ?></a></div>
							<?php endif; ?>
							<div class="col-xs-12 col-sm-12 col-md-12" style="text-align:right;padding:0;"><a href="deconnexion.php"><?php echo $tpl->vars['DECONNEXION']; ?></a></div>
						</div>
						
					<?php else : ?>
					
						<a href="<?php echo $tpl->vars['URI']; ?>#" onclick="openbox('Se connecter',0);" id="co"><span><img src="images/picto/menu/identifier.png">
						<?php echo $tpl->vars['SE_CONNECTER']; ?></span></a>
						
					<?php endif; ?>
				</div>
			</div>
		</ul>
	</div>
	
	<div id="shadowing"></div>
	<div id="box">
		<span id="boxtitle"></span>
		<form method="post" action="client/client.php?p=<?php echo $tpl->vars['URI']; ?>" style="text-align:center;">			
			<br />
			<input type="hidden" name="deja_client" />
			<label for="mail"><?php echo $tpl->vars['EMAIL']; ?> : </label>
			<br />
			<input type="email" name="mail" id="mail" />
			<br />
			<br />
			<label for="pass"><?php echo $tpl->vars['PASSWD']; ?> : </label>
			<br />
			<input type="password" name="pass" id="pass" />
			<br /><br>
			<a href="client/password.php?action=2"><?php echo $tpl->vars['MDP_OUBLIE']; ?></a>
			<br /><br>
			<input type="submit" value="<?php echo $tpl->vars['BTN_ENVOYER']; ?>" onclick="closebox();" class="btn_envoie" style="font-size:1em;"/>
		</form>
		<div style="text-align:center;margin-top:10px;"><a href="<?php echo $tpl->vars['URI']; ?>#" onclick="closebox();">[<?php echo $tpl->vars['FERMER']; ?>]</a></div>
	</div>
</div>

<script type="text/javascript">
	var elem_menu_selectionne = document.querySelector('#menu #menu_compte .compte_selectionne');
	if (elem_menu_selectionne)
	{
		var span_compte = document.getElementById('compte');
		span_compte.className = 'compte_selectionne';
	}
	function menuCompte() {
		var span_compte = document.getElementById('compte');
		var menu_compte = document.getElementById('menu_compte');
		if (menu_compte.style.display == 'block')
		{
			menu_compte.style.display = 'none';
			var elem_menu_selectionne = document.querySelector('#menu #menu_compte .compte_selectionne');
			if (!elem_menu_selectionne)
			{
				span_compte.className = '';
			}
		}
		else
		{
			menu_compte.style.display = 'block';
			span_compte.className = 'compte_selectionne';
		}
	}
</script>
<!--
fin du fichier:aeroport.menu.speedbar.html.php
updated 27/06/2019
-->
