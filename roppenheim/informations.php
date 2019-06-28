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
					echo '<h2 align=center>'.$lang_titre_horaire_ouverture.'</h2>
					<br />
					<div style="text-align:center;width:100%;">
						'.$lang_info_ouverture_tso.'
						<br />
						<br />
						'.$lang_plus_d_info.'
					</div>';
					
					echo '<h2 align=center>'.$lang_titre_formule_horaire.'</h2>';
					echo '<div class="no-border-table"><table>';
					
					$i = 1;
					foreach (get_les_packs() as $lePack){
						
						echo '
							<tr>
								<th colspan="2">Pack n°'.$i.'</th>
							</tr>
							<tr>
								<td>'.$lang_heure_aller.'</td>
								<td><strong>'.$lePack['heure_aller'].'</strong></td>
							</tr>
							<tr>
								<td>'.$lang_heure_retour.'</td>
								<td><strong>'.$lePack['heure_retour'].'</strong></td>
							</tr>
						';
						
						$i++;
					}
					
					echo '
					</div></table>
					
					<h2 align=center>'.$lang_informations_complementaires.'</h2>
					
					<p align=left>'.$lang_texte_info_compl.'</p>
					';
				?>
			</div>
			
			<!-- Le pied de page -->
			<?php require_once('./includes/include_pied_de_page.php'); ?>
		</div>
		
	</body> 
</html>