<?php
	require_once('./includes/init_functions.php');
?>
<html>
	<head>
		<title><?php echo $lang_titre_tarifs.' :: '.$lang_titre_main; ?></title>
		
		<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
		<meta name="Language" content="fr" />		
		
		<link rel="stylesheet" type="text/css" href="styles/base.css" media="all" />
		<link rel="stylesheet" type="text/css" href="styles/style.css" media="screen" />
	</head> 
	<body> 

		<div id="global">
			<!-- On insère le header + le menu -->
			<?php require_once('./includes/include_entete_menu.php'); ?>
			
			<!-- Le contenu -->
			<div id="contenu">
				<!-- Titre de la page -->
				<h1><?php echo $lang_titre_tarifs; ?></h1>
				
				<?php
					// Contenu de la page
					echo '
					<div style="width:100%;text-align:center;">
						'.$lang_tarif_texte_prix.'
					</div>
					<br />
					'.$lang_tarif_info_compl.'
					';
				?>
			</div>
			
			<!-- Le pied de page -->
			<?php require_once('./includes/include_pied_de_page.php'); ?>
		</div>
		
	</body> 
</html>