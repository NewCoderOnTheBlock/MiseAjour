<?php
	require_once('./includes/init_functions.php');
?>

<html>
	<head>
		<title><?php echo $lang_titre_accueil.' :: '.$lang_titre_plan_site; ?></title>
		
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
				<h1><?php echo $lang_titre_plan_site; ?></h1>
				
				<div class="row" style="margin-top:20px;">
					<ul>
						<li><a href="index.php"><?php echo $lang_titre_accueil;?></a></li>
						<li><a href="services.php"><?php echo $lang_titre_services;?></a></li>
						<li><a href="reservation.php"><?php echo $lang_titre_reservation;?></a></li>
						<li><a href="contact.php"><?php echo $lang_titre_contact;?></a></li>
						<li><a href="mentions.php"><?php echo $lang_titre_mentions;?></a></li>
						<li><a href="conditions.php"><?php echo $lang_titre_conditions;?></a></li>
						<li><a href="charte.php"><?php echo $lang_titre_charte;?></a></li>
					</ul>
				</div>
				
			</div>
			
			<!-- Le pied de page -->
			<?php require_once('./includes/include_pied_de_page.php'); ?>
		
		</div>
		
	</body>
</html>