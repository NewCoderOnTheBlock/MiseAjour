
<!-- 
	Site créé par KEMPF Pierre-Louis
	01-2012
	Refonte complète par MICLO Brice
	06-2015
 -->

<!-- Le header -->
<header>
	<div class="header row">
		<!-- Drapeaux de langue -->
		<div class="col-xs-12 col-sm-3 col-md-3" style="padding:0;">
			<a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?lang=fr"><img src="images/drapeau_fr.png" width="20" height="15"/></a>
			<a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?lang=en"><img src="images/drapeau_en.png" width="20" height="15"/></a>
		</div>
		
		<div class="col-xs-12 col-sm-6 col-md-6">
			<a href="index.php"><img src="images/shopping-logo.png" style="width:150px;"></a>
		</div>
		
		<div class="col-xs-12 col-sm-3 col-md-3" style="padding:0;">
			<a href=""><?php echo $lang_se_connecter; ?><img src="images/identifier.png" style="margin-left:5px;margin-bottom:3px;"></a>
		</div>
	</div>

	<!-- La barre de navigation -->
	<div id="navigation" class="row">
		<div class="col-xs-6 col-sm-1 col-md-1 col-sm-offset-3 col-md-offset-3">
			<a href="index.php"><?php echo $lang_titre_accueil; ?></a>
		</div>
		<div class="col-xs-6 col-sm-2 col-md-2">
			<a href="services.php"><?php echo $lang_titre_services; ?></a>
		</div>
		<div class="col-xs-6 col-sm-2 col-md-2">
			<a href="reservation.php"><?php echo $lang_titre_reservation; ?></a>
		</div>
		<div class="col-xs-6 col-sm-1 col-md-1">
			<a href="contact.php"><?php echo $lang_titre_contact; ?></a>
		</div>
	</div>
</header>