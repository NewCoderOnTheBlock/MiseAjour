<?php
	require_once('./includes/init_functions.php');
?>
<html>
	<head>
		<title><?php echo $lang_titre_informations.' :: '.$lang_titre_main; ?></title>
		
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
				<h1><?php echo $lang_titre_informations; ?></h1>
				
				<?php
					// Contenu de la page
					echo '
					<h2 align=center>'.$lang_horaires_ouverture.'</h2>
					
					<hr style="border:solid white 1px;width:75%;" />
					
					<h3 style="color:#F9D24F;" align=center>'.$lang_saison_estivale.'</h3>
					<p align=center>'.$lang_horaire_estivale.'</p>
					
					<hr style="border:solid white 1px;width:75%;" />						
						
					<h3 style="color:#F9D24F;" align=center>'.$lang_saison_hivernale.'</h3>
					<p align=center>'.$lang_horaire_hivernale.'</p>
					
					<hr style="border:solid white 1px;width:75%;" />
					
					<br /><br />
					'.$lang_plus_d_info.'
					
					<br /><br />
					<h2 align=center>'.$lang_informations_complementaires.'</h2>
					
					<p>'.$lang_texte_info_compl.'</p>
					';
				?>
			</div>
			
			<!-- Le pied de page -->
			<?php require_once('./includes/include_pied_de_page.php'); ?>
		</div>
		
	</body> 
</html>