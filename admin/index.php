<?php 
	session_start();
	include("verifAuth.php");

	if(isset($_GET['p']) && $_GET['p'] == 2)	
	{
		require("valid.php");
		
		exit();
	}
	if(isset($_POST['p']) && $_POST['p'] == 7)	
	{
		require("suprLigne.php");
		
		exit();
	}
	if(isset($_POST['p']) && $_POST['p'] == 8)	
	{
		require("bougerLigne.php");
		
		exit();
	}
	if (isset($_GET['p']) && $_GET['p'] == 70){
		header('Location: http://alsace-navette.com/europapark/admin/index.php?p=1&action=1');
	}
	if (isset($_GET['p']) && $_GET['p'] == 71){
		header('Location: http://alsace-navette.com/europapark/admin/index.php?p=5');
	}
	if (isset($_GET['p']) && $_GET['p'] == 72){
		header('Location: http://alsace-navette.com/europapark/admin/index.php?p=4');
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href="style.css" rel="stylesheet" type="text/css" /> 
		<title>Interface d'administration</title>
		<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
		<script src="scripts/maj_note.js" type="text/javascript"></script>
		<script src="scripts/redirectionKey.js" type="text/javascript"></script>
		<meta name="robots" content="noindex" />
		<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />


		<script type="text/javascript">

		/* Utilisé pour spécifier un nombre maximal de caractères dans un fckeditor */

		function FCKeditor_OnComplete(editorInstance) {
			if(editorInstance.Name == "texte_fr" || editorInstance.Name == "texte_en" || editorInstance.Name == "texte_ger") {
				editorInstance.Events.AttachEvent('OnSelectionChange', CheckLength);
				editorInstance.Events.AttachEvent('OnPaste', CheckLength);
			}
		}

		function CheckLength(editorInstance) {
			var text = StripHTML(editorInstance.GetHTML());

			while(text.length > 1000)
				{
					text = text.substr(0, text.length - 1);
					editorInstance.SetData(text, false);
					editorInstance.Focus();
				}
		}

		function StripHTML(html)
		{
		   var tmp = document.createElement("DIV");
		   tmp.innerHTML = html;
		   return tmp.textContent||tmp.innerText;
		}		
		</script>

	</head>

	<body>
	
		<div id="corps">

			<div id="menu">
			
				<ul id="MenuBar1" class="MenuBarHorizontal" style='float:left;'>
					<li><a href="index.php?p=10">Déconnexion</a></li>
					<li><a href="index.php?p=1&amp;action=1" class="MenuBarItemSubmenu">Navettes</a>
					  <ul>
							<li><a href="../aeroport/client/client.html">Saisie manuelle</a></li>
							<li><a href="index.php?p=7">Saisir un trajet</a></li>
							<li><a class="MenuBarItemSubmenu" href="#">Services annexes</a>
								<ul>
									<li><a href="index.php?p=70" target="_blank">Accéder</a></li>
									<li><a class="MenuBarItemSubmenu" href="#">Royal Palace</a>
										<ul>
											<li><a href="index.php?p=71" target="_blank">Saisie manuelle</a></li>
										</ul>
									</li>
									<li><a class="MenuBarItemSubmenu" href="#">Centres Outlet</a>
										<ul>
											<li><a href="index.php?p=72" target="_blank">Saisir une navette</a></li>
										</ul>
									</li>
								</ul>
							</li>
							<li><a href="index.php?p=112">Shuttle Service</a></li>
							<li><a href="index.php?p=111&amp;action=1">Ancienne Version</a></li>
						</ul>
					</li>
					<li><a class="MenuBarItemSubmenu">Clients</a>
						<ul>
							<li><a href="index.php?p=11">Rechercher</a></li>
							<li><a href="index.php?p=25">Professionnels</a></li>
						</ul>
					</li>
					<li><a class="MenuBarItemSubmenu" href="#">Ressources</a>
					  <ul>
							<li><a class="MenuBarItemSubmenu" href="#">Véhicules</a>
								<ul>
									<li><a href="index.php?p=13">Voir un véhicule</a></li>
									<li><a href="index.php?p=131">Ajouter un véhicule</a></li>
									<li><a href="index.php?p=132">Statistiques</a></li>
								</ul>
							</li>
							<li><a href="#" class="MenuBarItemSubmenu">Conducteurs</a>
							  <ul>
								<li><a href="index.php?p=3">Voir un conducteur</a></li>
								<li><a href="index.php?p=35">Total horaire conducteur</a></li>
								<li><a href="index.php?p=26">Gestion conducteur</a></li>
								<li><a href='index.php?p=27'>Statistiques</a></li>
							  </ul>
							</li>
							<li><a class="MenuBarItemSubmenu" href="#">Statistiques</a>
								<ul>
									<li><a href="index.php?p=40">Recettes (Excel)</a></li>
									<li><a href="index.php?p=32">Recettes</a></li>
									<li><a href="index.php?p=33">Aéroports</a></li>
									<li><a href="index.php?p=253">Clients Aéroports</a></li>
									<li><a href="index.php?p=252">Navettes Aéroport</a></li>
									<li><a href="index.php?p=250">Rassemblements</a></li>
									<li><a href="index.php?p=251">Rassemblements Diff.</a></li>
									<li><a href="index.php?p=34">Programme fidelité</a></li>
									<li><a href="index.php?p=30">Demandes annulées</a></li>
									<li><a href="index.php?p=31">Demandes non finalisées</a></li>
								</ul>
							</li>
							<li><a class="MenuBarItemSubmenu" href="#">Factures</a>
								<ul>
									<li><a href="index.php?p=28">Créer une facture</a></li>
									<li><a href="index.php?p=29">Rechercher une facture</a></li>
								</ul>
							</li>
							<li><a class="MenuBarItemSubmenu" href="#">Code Promo</a>
								<ul>
									<li><a href="index.php?p=254">Créer un code promo</a></li>
									<li><a href="index.php?p=255">Voir un code promo</a></li>
								</ul>
							</li>
							<li><a class="MenuBarItemSubmenu" href="#">Autres</a>
								<ul>
									<li><a href="index.php?p=57">SMS</a></li>
									<li><a href="index.php?p=21">stagiaire</a></li>
								</ul>
							</li>
							<li><a href="index.php?p=41">Calcul de distances</a></li>
					  </ul>
					</li>
					<li><a href="#">Le site</a>
					  <ul>
							<li><a class="MenuBarItemSubmenu" href="#">Gestion</a>
								<ul>
									<li><a href="index.php?p=12">Tarifs & Horaires</a></li>
									<li><a href="index.php?p=173">FAQ</a></li>
									<li><a href="index.php?p=172">Options</a></li>
									<li><a href="index.php?p=257">Conditions Générales</a></li>
									<li><a href="index.php?p=174">Jours majorés</a></li>
									<li><a href="index.php?p=24">Clients</a></li>
									<li><a href="index.php?p=15">Partenaires</a></li>
									<li><a href="index.php?p=20">News</a></li>
									<li><a href="http://alsace-navette.com/sondage/resultats/result_sondage.php">Sondage</a></li>
								</ul>
							</li>
							<li><a href="index.php?p=4">Configuration</a></li>
							<li><a href="index.php?p=9">Log SQL</a></li>
							<li><a href="index.php?p=69">Sauvegarde Bdd</a></li>
						</ul>
					</li>
					<li><a href="../phenix">Agenda</a></li>
					<li><a class="MenuBarItemSubmenu" href="#">Administration</a>
						<ul>
							<li><a href="index.php?p=171">Personnel</a></li>
						</ul>
					</li>
				  </ul>
				  
				  <div id='divChargement' style='margin-left:10px;float:left;display:none'>
					<img src='images/chargement.gif' width='30' />
				  </div>
			
				<script type="text/javascript">

				var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
			
				</script>
				
			</div>
			
			<div id="contenu">
				
				<!-- Zone d'info en haut -->
				<br />
				Le système gérant les crénaux des jours majorés est terminé : Site -> Gestion -> Jours majorés
				<br />
				Un calculateur de distance/temps est disponible dans la section "Ressources -> Calcul de distances", si la stagiaire n'arrive pas à bout.
				
				
				<!-- /// -->
				
			<?php 
			if($_SESSION['user_type']!="a"){
				session_unset();
				session_destroy();
				require("log.php");
			}
			else{
			
				switch ($_GET['p']) {	
							case 1:
								require("vue_v2.php");
								break;
							case 111:
								require("vue.php");
								break;
							case 112:
								require("afficherNavettesShuttleService.php");
								break;
							case 3:
								require("seeDriver.php");
								break;
							case 4:
								require("gestion_site.php");
								break;
							case 5:
								require("voirClient.php");
								break;
							case 6:
								require("saisie_manuelle.php");
								break;
							case 7:	
								require("saisie_trajet.php");
								break;
							case 9:
								require("log_sql.php");
								break;
							case 10:
								session_unset();  
								session_destroy();
								require("log.php");
								break;
							case 11:
								require("findCustomer.php");
								break;
							case 12:
								require("gestionTarif.php");
								break;
							case 13:
								require("seeVehicle.php");
								break;
							case 131 : // si c'est pour ajouter un véhicule
								require("ajoutVehicule.php");
								break;
							case 132 : // si c'est pour voir l'historique d'un véhicule
								require("historiqueVehicule.php");
								break;
							case 14:
								require("gestion.php");
								break;
							case 15:
								require("partenaire.php");
								break;
							case 16:
								require("partenaire_action.php");
								break;	
							case 171:
								require("gestion_perso.php");
								break;
							// KEMPF : Gestion des options, de la FAQ et des jours majorés
							case 172:
								require("gestion_options.php");
								break;
							case 173:
								require("gestion_faq.php");
								break;
							case 174:
								require("gestion_jour_feries.php");
								break;
							case 18:
								require("gestion_perso_final.php");
								break;
							case 19:
								require("gestion_retirer_personnel.php");
								break;
							case 20:
								require("manage_news.php");
								break;
							case 21:
								require("manage_stagiaires.php");
								break;
							case 22:
								require("manage_cat_news.php");
								break;
							case 23:
								require("modifRecap.php");
								break;
							case 24:
								require('gestionClient.php');
								break;
							case 25:
								require("see_pro.php");
								break;
							case 26:
								require("gestionConducteur.php");
								break;
							case 27:
								require("statistiqueConducteur.php");
								break;
							/* Ajout KEMPF : Gestion Facture -> Création d'une facture manuellement */
							case 28:
								require("gestionFacture.php");
								break;
							/* Ajout KEMPF : Recherche Facture -> Recherche par email */
							case 29:
								require("rechercheFacture.php");
								break;
							/* Ajout KEMPF : Demandes annulées, demandes non finalisées, calcul du CA et statistiques des recettes et aéroport, fidelité */
							case 30:
								require("statistiqueDemandesAnnulees.php");
								break;
							case 31:
								require("demandesNonFinalisees.php");
								break;
							case 32:
								require("statistiqueRecettes.php");
								break;
							case 33:
								require("statistiqueAeroports.php");
								break;
							case 34:
								require("statFidelite.php");
								break;
							case 35:
								require("heuresConducteur.php");
								break;
							case 40:
								require("calculCA.php");
								break;
							case 41:
								require("calculDistance.php");
								break;
							case 57:
								require("SMS.php");
								break;
							case 69:
								require("sauvegarde.php");
								break;
							case 250:
								require("statistiqueRassemblements.php");
								break;
								case 251:
								require("statistiqueRassemblementsDifférents.php");
								break;
								case 252:
								require("statistiqueNavetteAéroport.php");
								break;
								case 253:
								require("statistiqueClientsAeroports.php");
								break;
								case 254:
								require("ajoutCodePromo.php");
								break;
								case 255:
								require("listeCodePromo.php");
								break;
								case 256:
								require("modif_code_promo.php");
								break;
								case 257:
								require("gestion_conditions.php");
								break;
							default:
								echo "<br /><br /><div style=\"width:100%; text-align:center;\">Bienvenue dans l'interface de gestion de Alsace-Navette.com !</div>";
								break;
							
				}
			}

			?>
			
			
			</div>
			
		</div>

	</body>

</html>
