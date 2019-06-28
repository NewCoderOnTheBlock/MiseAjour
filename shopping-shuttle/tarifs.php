<?php
	require_once('./includes/init_functions.php');
?>
<html>
	<head>
		<title><?php echo $lang_titre_tarifs.' :: '.$lang_titre_main; ?></title>
		
		<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
		<meta name="Language" content="fr" />		
		
		<link rel="stylesheet" type="text/css" href="styles/base.css" media="all" />
		<link rel="stylesheet" type="text/css" href="styles/style.css" media="screen" />
		
		<!-- Chargement de JQuery et Jquery UI depuis Google API -->
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
		<link rel="stylesheet" type="text/css" href="styles/ui-lightness/jquery-ui.css" media="all" />
		
		<script type="text/javascript">
			
			// JQuery
			$(function() {
				$( "#tabs_outlet" ).tabs();
			});

			
		</script>
	</head> 
	<body> 

		<div id="global">
			<!-- On insère le header + le menu -->
			<?php require_once('./includes/include_entete_menu.php'); ?>
			
			<!-- Le contenu -->
			<div id="contenu">
				<!-- Titre de la page -->
				<h1><?php echo $lang_titre_tarifs; ?></h1>
					<div id="tabs_outlet">
						<ul>
					<?php
						// Contenu de la page
						$lesOutlet = get_list_outlet();
						foreach ($lesOutlet as $leOutlet){
							echo "
							<li>
								<a href='#tabs_outlet-".$leOutlet['id_outlet']."' style='color:#".$leOutlet['couleur_outlet'].";'><img style='vertical-align:middle;' src='images/icon_outlet_".$leOutlet['id_outlet'].".png' /> ".$leOutlet['libelle_outlet']."</a>
							</li>";
						}
						echo "</ul>";
						
						$lesOutlet = get_list_outlet();
						foreach ($lesOutlet as $leOutlet){
							echo "
							<div id='tabs_outlet-".$leOutlet['id_outlet']."'>
								
								<p>
									<div style='width:100%;text-align:center;'>
										<a href='http://".$leOutlet['lien_outlet']."' target='_blank'>
											<img src='images/outlet_".$leOutlet['id_outlet']."' />
										</a>
									</div>
									
									<br />
									
									".$lang_tarif_est_de." ".$leOutlet['tarif_outlet']." € ".$lang_par_personne." ".$lang_tarif_pour_trajet_aller_retour."
									<br /><br />
									".$lang_tarif_soit." : 
									<ul>
										<li>".($leOutlet['tarif_outlet']*4)." € ".$lang_tarif_pour_un_groupe_de." 4 ".$lang_personnes."</li>
										<li>".($leOutlet['tarif_outlet']*8)." € ".$lang_tarif_pour_un_groupe_de." 8 ".$lang_personnes."</li>
									</ul>
								</p>
								
							</div>";
						}					
					echo '
					</div>
					<br />
					'.$lang_tarif_info_compl;
				?>
			</div>
			
			<!-- Le pied de page -->
			<?php require_once('./includes/include_pied_de_page.php'); ?>
		</div>
		
	</body> 
</html>