<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<!--
fichier:cache/HEADER.HTML
updated 27/06/2019
-->
<?php if(isset($_SESSION['alert'])){ 
		echo $_SESSION['alert'];
		 unset($_SESSION['alert']);
	} ?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
	<head>
		<title><?php echo $tpl->vars['TITRE_PAGE']; ?></title>
		
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

		<meta name="description" content="Alsace-navette aéroport : Réservation en ligne entre les liaisons ville de Strasbourg et les aéroports de Bale-Mulhouse, Karlsruhe Baden Baden, Stuttgart, Francfort, Zurich et bien d'autres !" />
		<meta name="Category" content="Navette, Tourisme, Voyage, Transfert aéroport, Loisirs, Avions" />
		<meta name="Language" content="fr" />
		
		<meta name="Keywords" content="navette, navettes, navette aéroport, navettes aéroport, taxi navette, navette aeroport, navettes aeroport, navette gare, navettes gare, tarif navette, tarifs navette, horaire navette, horaires navettes, navette bus, navette strasbourg, navettes strasbourg, location navette,navette gare aeroport, navette gare aéroport, horaires navette aéroport, horaires navette aeroport, taxi navette aeroport, tarif navette aeroport, tarif navette aéroport, navette aeroport bale mulhouse, navette bus aéroport, aeroport, aéroport, aeroport de, gare routière,transport, tarif, alsace, tourisme alsace, location alsace, region alsace, strasbourg alsace, aeroports, aéroports, aeroport strasbourg, aeroport baden-baden, aéroport bâle mulhouse, aeroport bale-mulhouse, aeroport francfort, aeroport stuttgart, kahn, main, bas-rhin, aeroport karlsruhe, transport aeroport, correspondence, correspondence alsace, correspondence navette, correspondence minibus, transport correspondence,transport, transports, transport routier, transport navette, transport navette aeroport, transportation, transporteur, transport voyageurs, transport personne, transport collectif, transport route, transport aeroport, transport voiture, transport de, transport de personnes, des transports, véhicule, vehicule, location vehicule, transport par vehicule, domicile, transport domicile, liaison aeroport, liaison aéroport, minibus, minibuses, location minibus, reservation minibus, réservation, reservations, reservation, transfert, transferts, transfert aeroport, transfert aeroports, transfert aéroport, entzheim, navette entzheim, navette aeroport entzheim, navette strasbourg frankfurt, francfort strasbourg, strasbourg frankfurt bus, aéroport basel mulhouse, baden karlsruhe airport, taxi navette aéroport" />
		<meta name="revisit-after" content="3 days">

		<meta name="Robots" content="all, index" />
		
		<base href="<?php echo $tpl->vars['BASEURL']; ?>" />
		
		<link rel="icon" type="icon" href="images/favicon.bmp" />
		
		<!-- Fichiers de la nouvelle interface 	-->
		
		<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script>
		<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
		<!--		-->							
		
		<link href="styles/commun.css" rel="stylesheet" 			type="text/css" media="all" />
		<link href="styles/normal.css" rel="stylesheet"			 	type="text/css" media="all" title="A" />
		<link href="styles/medium.css" rel="alternate stylesheet"	type="text/css" media="all" title="A+" />	
		
		<link href="../styles/SpryAssets/SpryCollapsiblePanel.css"		rel="stylesheet" type="text/css" />
		<link href="../styles/SpryAssets/SpryValidationTextField.css"	rel="stylesheet" type="text/css" />
		<link href="../styles/SpryAssets/SpryValidationSelect.css"		rel="stylesheet" type="text/css" />
		<link href="../styles/SpryAssets/SpryValidationPassword.css"	rel="stylesheet" type="text/css" />
		<link href="../styles/SpryAssets/SpryValidationConfirm.css"		rel="stylesheet" type="text/css" />
		
		<link href="lightbox-fr/lightbox-form.css"						rel="stylesheet" />
		<link href="styles/style.css" 									rel="stylesheet" type="text/css"  />
		
		<script src="../styles/SpryAssets/SpryCollapsiblePanel.js"		type="text/javascript"></script>
		<script src="../styles/SpryAssets/SpryValidationTextField.js"	type="text/javascript"></script>
		<script src="../styles/SpryAssets/SpryValidationSelect.js"		type="text/javascript"></script>
		<script src="../styles/SpryAssets/SpryValidationPassword.js"	type="text/javascript"></script>
		<script src="../styles/SpryAssets/SpryValidationConfirm.js"		type="text/javascript"></script>
		
		
		
		<script src="scripts/police.js" type="text/javascript"></script>
		<script src="js/index.js"		type="text/javascript" ></script>
		<script src="lightbox-fr/lightbox-form.js"></script>

		<!-- 																 -->
		<!-- Modification 27-01-2010 Rajout des balises META				 -->
		<!-- Aux agents Proxy: ne pas sauvegarder sur les serveurs Proxy!	 -->
		<!-- 																 -->
		<meta http-equiv="pragma" content="no-cache" />
		
		<!-- Mention pour le navigateur Netscape: ne pas utiliser le cache normal mais charger de la page originale.-->
		<meta http-equiv="cache-control" content="no-cache" />
		
		<meta http-equiv="Cache" content="no store" />
		
		<meta http-equiv="Expires" content="0" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<script type="text/javascript">
			window.addEventListener('load',function() {
				$(function() {
					$("body").click(function(e) {
						var box = document.getElementById("box");
						if (e.target.id != "box" && !$(e.target).parents("#box").size() && box.style.display == 'block' && e.target.id != "co") { 
							closebox();
						}
					});
				})
			});
		</script>
		
	</head>
<body>
