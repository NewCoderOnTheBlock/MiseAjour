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
					<p align=center>'.$lang_nb_personne_forfait_min.' : '.get_value_of_option("nb_forfait_min_aller_retour").'</p>
					<table align="center" class="table_spec">
						<tr>
							<th></th>
							<th>'.$lang_par_personne.'</th>
							<th>'.$lang_tarif_minimum.'</th>
						</tr>
						<tr>
							<th>'.$lang_aller.'<br /></th>
							<td>'.get_value_of_option("tarif_min_aller")/get_value_of_option("nb_forfait_min_aller_retour").'</td>
							<td>'.get_value_of_option("tarif_min_aller").'</td>
						</tr>							
						<tr>
							<th>'.$lang_aller_retour.'<br />('.$lang_meme_jour.')</th>
							<td>'.get_value_of_option("tarif_min_aller_retour")/get_value_of_option("nb_forfait_min_aller_retour").'</td>
							<td>'.get_value_of_option("tarif_min_aller_retour").'</td>
						</tr>
						<tr>
							<th>'.$lang_aller_retour.'<br />('.$lang_jour_different.')</th>
							<td>'.(get_value_of_option("tarif_min_aller_retour")+get_value_of_option("supplement_differe"))/get_value_of_option("nb_forfait_min_aller_retour").'</td>
							<td>'.(get_value_of_option("tarif_min_aller_retour")+get_value_of_option("supplement_differe")).'</td>
						</tr>
					</table>';
				?>
			</div>
			
			<!-- Le pied de page -->
			<?php require_once('./includes/include_pied_de_page.php'); ?>
		</div>
		
	</body> 
</html>