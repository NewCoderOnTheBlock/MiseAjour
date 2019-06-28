<?php
	require_once('./includes/init_functions.php');

	set_reservation_gratuite($_SESSION['id_reserv']);
	ajouter_au_trajet($_SESSION['id_reserv'], $_SESSION['trajet']['id_trajet']);
?>

<html>
	<head>
		<title><?php echo $lang_titre_accueil.' :: '.$lang_titre_confirmation_paypal; ?></title>
		
		<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
		<meta name="Language" content="fr" />
		<meta name="viewport" content="width=device-width, initial-scale=1">	
		
		<link rel="stylesheet" type="text/css" href="styles/base.css" media="all" />
		<link rel="stylesheet" type="text/css" href="styles/style.css" media="screen" />
		<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
		
	</head> 
	<body> 
	
		<div id="global">
			<!-- On insère le header + le menu -->
			<?php require_once('./includes/include_entete_menu.php'); ?>
			
			<!-- Le contenu -->
			<div id="contenu" class="row">
			
				<!-- Titre de la page -->
				<h1><?php echo $lang_titre_confirmation_paypal; ?></h1>
				
				<div class="row" style="margin-top:20px;">
					<p class="vert" style="text-align:center;">Vous venez de confirmer une réservation gratuite en tant qu'administrateur !<br>
					<a href="index.php"><?php echo $lang_retour_accueil; ?></a></p>
				</div>
				
			</div>
			
			<!-- Le pied de page -->
			<?php require_once('./includes/include_pied_de_page.php'); ?>
		
		</div>
	</body>
</html>