<?php $tpl->includeTpl('aeroport/include.html', false, 0); ?>

<!--
fichier:AEROPORT.AIDE.HTML.PHP
updated 27/06/2019
-->


<div class="row aide">
	<h3><?php echo $tpl->vars['TITRE_AIDE']; ?></h3>
	
	<div class="col-xs-12 col-sm-6 etape">
		<div class="col-xs-12 etape_haut">
			<img src="images/etapes/etape_1.png">
		</div>
		<div class="col-xs-12 etape_bas">
			<h4><?php echo $tpl->vars['TITRE_ETAPE_1']; ?></h4>
			<p><img src="images/etapes/securite.png"><br><?php echo $tpl->vars['TXT_ETAPE_1']; ?></p>
		</div>
	</div>
		
	<div class="col-xs-12 col-sm-6 etape">
		<div class="col-xs-12 etape_haut">
			<img src="images/etapes/etape_2.png">
		</div>
		<div class="col-xs-12 etape_bas">
			<h4><?php echo $tpl->vars['TITRE_ETAPE_2']; ?></h4>
			<p><img src="images/etapes/euro.png"><br><?php echo $tpl->vars['TXT_ETAPE_2']; ?></p>
		</div>
	</div>
	
	<div class="col-xs-12 col-sm-6 etape">	
		<div class="col-xs-12 etape_haut">
			<img src="images/etapes/etape_3.png">
		</div>
		<div class="col-xs-12 etape_bas">
			<h4><?php echo $tpl->vars['TITRE_ETAPE_3']; ?></h4>
			<p><img src="images/etapes/peuple.png" style="margin-right:15px;"><img src="images/etapes/mains.png"><br><?php echo $tpl->vars['TXT_ETAPE_3']; ?></p>				
		</div>
	</div>
		
	<div class="col-xs-12 col-sm-6 etape">	
		<div class="col-xs-12 etape_haut">
			<img src="images/etapes/etape_4.png">
		</div>
		<div class="col-xs-12 etape_bas">
			<h4><?php echo $tpl->vars['TITRE_ETAPE_4']; ?></h4>
			<p><img src="images/etapes/lock.png"><br></p>
			<p><img src="images/etapes/mastercard.png" style="width:55px;margin-right:15px;"><img src="images/etapes/visa.png" style="width:55px;"><br><img src="images/etapes/credit.png" style="width:55px;margin-right:15px;"><img src="images/etapes/paypal.png" style="width:55px;"></p>
		</div>
	</div>
		
	<div class="col-xs-12 col-sm-6 etape">
		<div class="col-xs-12 etape_haut">
			<img src="images/etapes/etape_5.png">
		</div>
		<div class="col-xs-12 etape_bas">
			<h4><?php echo $tpl->vars['TITRE_ETAPE_5']; ?></h4>
			<p><img src="images/etapes/check.png"><br><?php echo $tpl->vars['TXT_ETAPE_5']; ?></p>
		</div>
	</div>
	
	<div class="col-xs-12 col-sm-6 etape">
		<div class="col-xs-12 etape_haut">
			<img src="images/etapes/etape_6.png">
		</div>
		<div class="col-xs-12 etape_bas">
			<h4><?php echo $tpl->vars['TITRE_ETAPE_6']; ?></h4>
			<p class="col-xs-4 col-sm-4 col-md-4" style="margin:0;text-align:right;"><img src="images/etapes/id.png" style="margin:0;"></p><p style="text-align:left;padding:0;" class="col-xs-8 col-sm-8 col-md-8"><?php echo $tpl->vars['TXT_ETAPE_6_1']; ?></p>
			<p class="col-xs-4 col-sm-4 col-md-4" style="margin:0;text-align:right;"><img src="images/etapes/itinerairep.png" style="height:30px;margin:0;"></p><p style="text-align:left;padding:0;margin-bottom:20px;margin-top:10px;" class="col-xs-8 col-sm-8 col-md-8"><?php echo $tpl->vars['TXT_ETAPE_6_2']; ?></p>
			<p class="col-xs-4 col-sm-4 col-md-4" style="margin:0;text-align:right;"><img src="images/etapes/heure.png" style="height:30px;margin:0;"></p><p style="text-align:left;padding:0;margin-top:5px;" class="col-xs-8 col-sm-8 col-md-8"><?php echo $tpl->vars['TXT_ETAPE_6_3']; ?></p>
		</div>
	</div>
		
	<div class="col-xs-12 col-sm-6 etape">
		<div class="col-xs-12 etape_haut">
			<img src="images/etapes/etape_7.png">
		</div>
		<div class="col-xs-12 etape_bas">
			<h4><?php echo $tpl->vars['TITRE_ETAPE_7']; ?></h4>
			<p><img src="images/etapes/device.png"><br><?php echo $tpl->vars['TXT_ETAPE_7']; ?></p>
		</div>
	</div>
	
	<div class="col-xs-12 col-sm-6 etape">	
		<div class="col-xs-12 etape_haut">
			<img src="images/etapes/etape_8.png">
		</div>
		<div class="col-xs-12 etape_bas">
			<h4><?php echo $tpl->vars['TITRE_ETAPE_8']; ?></h4>
			<p><img src="images/etapes/voiture.png" style="width:25px;margin-right:15px;margin-bottom:5px;"><img src="images/etapes/homme.png" style="width:25px;margin-right:15px;margin-bottom:5px;"><img src="images/etapes/valise.png" style="width:25px;margin-bottom:5px;"></p>
			<p><?php echo $tpl->vars['TXT_ETAPE_8']; ?></p>
			<p style="font-size:12px;margin-bottom:0;"><a href="pratique.php"><?php echo $tpl->vars['ETAPE_8_LIEN_RASS']; ?></a></p>
			<p class="col-xs-12 col-sm-6 col-md-6" style="font-size:12px;margin-bottom:0;padding:0;"><a href="pratique.php#autre"><?php echo $tpl->vars['ETAPE_8_LIEN_RASS_AEROPORT']; ?></a></p>
			<p class="col-xs-12 col-sm-6 col-md-6" style="font-size:12px;padding:0;"><a href="pratique.php#strasbourg">Strasbourg</a></p>
		</div>
	</div>
		
	<div class="col-xs-12 col-sm-6 etape">	
		<div class="col-xs-12 etape_haut">
			<img src="images/etapes/etape_9.png">
		</div>
		<div class="col-xs-12 etape_bas">
			<h4><?php echo $tpl->vars['TITRE_ETAPE_9']; ?></h4>
			<p><img src="images/etapes/itineraire.png"><br><?php echo $tpl->vars['TXT_ETAPE_9']; ?></p>
		</div>
	</div>
		
	<div class="col-xs-12 col-sm-6 etape">
		<div class="col-xs-12 etape_haut">
			<img src="images/etapes/etape_10.png">
		</div>
		<div class="col-xs-12 etape_bas">
			<h4><?php echo $tpl->vars['TITRE_ETAPE_10']; ?></h4>
			<p><img src="images/etapes/maison.png" style="margin-right:15px;><img src="images/etapes/avion.png"><br><?php echo $tpl->vars['TXT_ETAPE_10']; ?></p>
			<p style="font-weight:bold;text-transform:uppercase;"><?php echo $tpl->vars['TXT_BON_VOYAGE']; ?></p>
		</div>
	</div>
</div>

<div class="row faq">
	<h3>FAQ</h3>
	<div class="faq_questions">
		<?php if ($tpl->getBlock('faq')) : foreach ($tpl->getBlock('faq') as $__tpl_blocs['faq']){ ?>
			<div class="faq_question">
				<h4 class="faq_num_question">QUESTION N°<?php echo $__tpl_blocs['faq']['NUM']; ?></h4>
				<p style="font-weight:bold;"><?php echo $__tpl_blocs['faq']['QUESTION']; ?></p>
				<p><?php echo $__tpl_blocs['faq']['REPONSE']; ?></p>
			</div>
		<?php } endif; ?>
	</div>
</div>

<?php $tpl->includeTpl('footer.html', false, 0); ?>
