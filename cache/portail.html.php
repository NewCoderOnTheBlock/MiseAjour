<!--
fichier:portail.html.php
updated 27/06/2019
-->
<!DOCTYPE html>
<html xml:lang="fr">
	<head>
		<title><?php echo $tpl->vars['TITRE_PAGE']; ?></title>
		
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		
		<meta name="description"content="<?php echo $tpl->vars['DESCRIPTION']; ?>" />
		<meta name="Category"	content="Tourisme, Voyage, Transfert aroport, Loisirs, Avions" />
		<meta name="Language"	content="fr" />
		
		<meta name="Keywords"	content="navette, navettes, navette aéroport, navettes aéroport, taxi navette, navette aeroport, navettes aeroport, navette gare, navettes gare, tarif navette, tarifs navette, horaire navette, horaires navettes, navette bus, navette strasbourg, navettes strasbourg, location navette,navette gare aeroport, navette gare aéroport, horaires navette aéroport, horaires navette aeroport, taxi navette aeroport, tarif navette aeroport, tarif navette aéroport, navette aeroport bale mulhouse, navette bus aéroport, aeroport, aéroport, aeroport de, gare routière,transport, tarif, alsace, tourisme alsace, location alsace, region alsace, strasbourg alsace,soufflenheim, kaysersberg, bergheim, haguenau, aeroports, aéroports, aeroport strasbourg, aeroport baden-baden, aéroport bâle mulhouse, aeroport bale-mulhouse, aeroport francfort, aeroport stuttgart, kahn, main, bas-rhin, aeroport karlsruhe, transport aeroport, correspondence, correspondence alsace, correspondence navette, correspondence minibus, transport correspondence,transport, transports, transport routier, transport navette, transport navette aeroport, transportation, transporteur, transport voyageurs, transport personne, transport collectif, transport route, transport aeroport, transport voiture, transport de, transport de personnes, des transports, véhicule, vehicule, location vehicule, transport par vehicule, domicile, transport domicile, liaison aeroport, liaison aéroport, minibus, minibuses, location minibus, reservation minibus, réservation, reservations, reservation, transfert, transferts, transfert aeroport, transfert aeroports, transfert aéroport, viste, visiter,visite ville, visite alsace, visite strasbourg, visite musée, visite musee, visite à, voyage visite, visite tourisme, vol, vols, vol alsace, vol strasbourg, vol baden-baden, vols mulhouse, vol mulhouse, taxi, taxi aeroport, taxi aéroport,  archeologie, art, modern, contemporain, estampe,dessin, histoire, historique, notre-dame, zoologique, electropolis, optique, jouet, train, textil, taxi, visite,trajet, village, vosge, baroque, gastronomie, route des vins, ebersmunter, kochersberg, bien etre, cuisine, spa, nature, detente, cueillette, thermes, vin, patrimoine, barr, couronne d'or, zen, beaute, bio, noel, geispolsheim, gertwiller, cite medievale, brasserie, tarte flambée, choucroute, ferme, Soufflenheim, Drusenheim, Gambsheim, cave, entzheim, navette entzheim, navette strasbourg frankfurt, francfort strasbourg, strasbourg frankfurt bus, aéroport basel mulhouse, baden karlsruhe airport, taxi navette aéroport" />
		<meta name="viewport"	content="width=device-width, initial-scale=1">
		<meta name="verify-v1"	content="AXDwNhykIpEhU/gAJtF8gWFhS5gWcf2Zeuq62SQx8Jc=" />
		<meta name="Robots"		content="all, index" />
		
		<base href="<?php echo $tpl->vars['BASEURL']; ?>" />
		<link href="styles/design.css" 				rel="stylesheet" type="text/css" media="all" />
		<link href="images/favicon.bmp" 			rel="icon"		 type="icon" />
		<link href="bootstrap/css/bootstrap.min.css"rel="stylesheet">

		<!-- 																 -->
		<!-- Modification 27-01-2010 Rajout des balises META				 -->
		<!-- Aux agents Proxy: ne pas sauvegarder sur les serveurs Proxy!	 -->
		<!-- 																 -->
		<meta http-equiv="pragma" content="no-cache" />
		
		<!-- Mention pour le navigateur Netscape: ne pas utiliser le cache normal mais charger de la page originale.-->
		<meta http-equiv="cache-control" content="no-cache" />    		
		<meta http-equiv="Cache" content="no store" />
		<meta http-equiv="Expires" content="0" />

	</head>
    
	<body>
		<div id="div_service" style="background-image:url('images/photo-fond.jpg');background-size:cover;">
		
			<main class="row">
				<div class="row">
					<a href="aeroport"><div class="col-xs-12 col-sm-6 col-md-6 airport">
						<div class="col-xs-12 col-sm-12 col-md-12">
							<img src="images/airport-logo.png">
						</div>
						<img src="images/photo-1.png" style="width:100%;">
						<div class="col-xs-12 col-sm-12 col-md-12">
							<h3>Airport Shuttle</h3>
							<p><?php echo $tpl->vars['EXPLI_AIRPORT_SHUTTLE']; ?></p>
							<p><?php echo $tpl->vars['LIEN_DECOUVRIR']; ?></p>
						</div>
					</div></a>
						
					<a href="shopping-shuttle"><div class="col-xs-12 col-sm-6 col-md-6 shopping">
						<div class="col-xs-12 col-sm-12 col-md-12">
							<img src="images/shopping-logo.png">
						</div>
						<img src="images/photo-2.png" style="width:100%;">
						<div class="col-xs-12 col-sm-12 col-md-12" style="background-size:cover;">
							<h3>Shopping Shuttle</h3>
							<p><?php echo $tpl->vars['EXPLI_SHOPPING_SHUTTLE']; ?></p>
							<p><?php echo $tpl->vars['LIEN_DECOUVRIR']; ?></p>
						</div>
					</div></a>
				</div>
				
				<div class="row services">
					<a href="laissezvousconduire"><div class="col-xs-12 col-sm-3 col-md-3">
						<div><img src="images/laissez-vous.png"></div>
						<p><?php echo $tpl->vars['ALT_LVC']; ?></p>
					</div></a>
					<a href="tourisme"><div class="col-xs-12 col-sm-3 col-md-3">
						<div><img src="images/Alsace.png"></div>
						<p><?php echo $tpl->vars['ALT_TOURISME']; ?></p>
					</div></a>
					<a href="europapark"><div class="col-xs-12 col-sm-3 col-md-3">
						<div><img src="images/europapark.png"></div>
						<p><?php echo $tpl->vars['ALT_EUROPAPARK']; ?></p>
					</div></a>
					<a href="royal-palace"><div class="col-xs-12 col-sm-3 col-md-3">
						<div><img src="images/royalepalace.png"></div>
						<p style="left:30%;">Royal Palace</p>
					</div></a>
				</div>
			</main>

<?php if ($tpl->vars['MODE'] == 'online') : ?>

	<script type="text/javascript">
        var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
        document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
        </script>
        <script type="text/javascript">
        try {
        var pageTracker = _gat._getTracker("UA-7302589-1");
        pageTracker._trackPageview();
        } catch(err) {}
    </script>
	
<?php endif; ?>

<?php $tpl->includeTpl('footer.html', false, 0); ?>

	</body>
</html>
