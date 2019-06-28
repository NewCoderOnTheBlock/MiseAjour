<!--
fichier:bloc_droite.html.php
updated 27/06/2019
-->
<!DOCTYPE html>
<html xml:lang="fr">
	<body>
		<div class="bloc_droite">
			<a href="aide.php" style="text-decoration:none;">
				<div class="row info_reservation" style="background-color:#00A0C3;">
					<h4 style="text-transform:uppercase;color:white;font-size:1.1em;margin-bottom:20px;"><?php echo $tpl->vars['AIDE_RESERVATION']; ?></h4>
					<div class="col-xs-12 col-sm-6 col-md-3">
						<img src="images/etape1.png" class="image_etape"><br>
						<p class="image_hover"><span><?php echo $tpl->vars['ETAPE_1']; ?></span></p>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-3">
						<img src="images/etape2.png" class="image_etape"><br>
						<p class="image_hover"><span><?php echo $tpl->vars['ETAPE_2']; ?></span></p>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-3">
						<img src="images/etape3.png" class="image_etape"><br>
						<p class="image_hover"><span><?php echo $tpl->vars['ETAPE_3']; ?></span></p>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-3">
						<img src="images/etape4.png" class="image_etape"><br>
						<p class="image_hover"><span><?php echo $tpl->vars['ETAPE_4']; ?></span></p>
					</div>
				</div>
			</a>
			<div class="row liens_accueil">
				<a href="pratique.php">
					<div class="col-xs-12 col-sm-6 col-md-6 gauche" style="background-color:#2C9EB4;">
						<img src="images/Horaires_navettes.png">
						<h4><?php echo $tpl->vars['HORAIRES_NAVETTES']; ?></h4>
					</div>
				</a>
				<a href="pratique.php">
					<div class="col-xs-12 col-sm-6 col-md-6 droite" style="background-color:#45B3C8;">
						<img src="images/horaires_vols.png">
						<h4><?php echo $tpl->vars['HORAIRES_VOLS']; ?></h4>
					</div>
				</a>
			</div>
			<div class="row liens_accueil">
				<a href="aide.php">
					<div class="col-xs-12 col-sm-6 col-md-6 gauche" style="background-color:#45B3C8;">
						<img src="images/infos_trajet.png">
						<h4><?php echo $tpl->vars['INFOS']; ?></h4>
					</div>
				</a>
				<a href="pratique.php">
					<div class="col-xs-12 col-sm-6 col-md-6 droite" style="background-color:#2C9EB4;">
						<img src="images/point_prise.png">
						<h4><?php echo $tpl->vars['POINTS_PRISE']; ?></h4>
					</div>
				</a>
			</div>
		</div>
	</body>
</html>
