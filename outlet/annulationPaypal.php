<?php
	require_once('./includes/init_functions.php');
?>
<html>
	<head>
		<title><?php echo $lang_titre_accueil.' :: '.$lang_titre_annulation_paypal; ?></title>
		
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
			<div id="contenu" class="row" style="margin-top:20px;margin-bottom:20px;text-align:center;">
				<!-- Titre de la page -->
				<h1><?php echo $lang_titre_annulation_paypal; ?></h1>
				
				<?php echo $lang_commande_annulee; ?>
				
				<?php
					// On retire la réservation de la base
					if (!empty($_SESSION["id_reserv"]) && !get_est_paye_reserv($_SESSION["id_reserv"])){
						$bdd->exec("DELETE FROM europa_reservation
									WHERE id_reservation = '".$_SESSION["id_reserv"]."'");
					}
				?>
			</div>
			
			<!-- Le pied de page -->
			<?php require_once('./includes/include_pied_de_page.php'); ?>
		</div>
		
	</body> 
</html>