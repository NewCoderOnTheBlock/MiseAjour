<?php
	require_once('./includes/init_functions.php');
?>
<html>
	<head>
		<title><?php echo $lang_titre_conditions.' :: '.$lang_titre_main; ?></title>
		
		<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
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
			<div id="contenu" style="margin-bottom:10px;">
				<!-- Titre de la page -->
				<h1><?php echo $lang_titre_conditions; ?></h1>
				
				<?php
					// Contenu de la page
					echo $lang_texte_conditions.get_value_of_option("maj_domicile").$lang_texte_conditions_1;
				?>
			</div>
			
			<!-- Le pied de page -->
			<?php require_once('./includes/include_pied_de_page.php'); ?>
		</div>
		
	</body> 
</html>