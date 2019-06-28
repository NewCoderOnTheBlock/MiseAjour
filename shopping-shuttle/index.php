<?php
	require_once('./includes/init_functions.php');
	include("./conf/mysql.php");
	// Fonction permettant de gérer l'affichage des petits 
	// panneau en fonction des champs déjà remplis
	function get_display($v)
	{
		if (!empty($v))
		{
			return "style=\"display:none;\"";
		}
		else
		{
			return "";
		}
	}
	
?>
<html>
	<head>
		<title><?php echo $lang_titre_accueil.' :: '.$lang_titre_main; ?></title>
		<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
		<meta name="Language" content="fr" />		
		
		<link rel="stylesheet" type="text/css" href="styles/base.css" media="all" />
		<link rel="stylesheet" type="text/css" href="styles/style.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="styles/calendrier.css" media="screen" />
		<script type="text/javascript" src="scripts/charger_tableaux_trajets.js"></script>
		<script type="text/javascript" src="scripts/calendrier_restriction.js"></script>
		<script type="text/javascript" src="scripts/verification_formulaire.js"></script>
		<script type="text/javascript" src="scripts/calendrier_restriction.js"></script>
		
		<!-- Chargement de JQuery et Jquery UI depuis Google API -->
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
		<link rel="stylesheet" type="text/css" href="styles/ui-lightness/jquery-ui.css" media="all" />
		<!-- Calendrier -->
		  <!-- Feuille de style -->
		  <link rel="stylesheet" type="text/css" href="./css/calendrier.css">

		  <!-- On inclut la librairie openrico / prototype -->
		  <script src="./js/rico/src/prototype.js" type="text/javascript"></script>
		  <!-- script pour gérer les bords arrondis et le panel déroulant -->
		  <script src="./js/rico/src/rico.js" type="text/javascript"></script>
		  <script src="./js/rico/src/ricoStyles.js" type="text/javascript"></script>
		  <script src="./js/rico/src/ricoEffects.js" type="text/javascript"></script>
		  <script src="./js/function.js" type="text/javascript"></script>
		  <script src="./js/rico/src/ricoComponents.js" type="text/javascript"></script>
	
	  
		<!-- Gestion de l'affichage des données supplémentaires liées au lieu domicile ou non -->
		<script type="text/javascript">
			
			function toggle_fenetre_details(id_trajet){
				var element = document.getElementById("details_"+id_trajet);
				
				if (element.style.display == "block"){
					element.style.display = "none";
				}else{
					element.style.display = "block";
				}
			}
			
			function show_domicile_info(elem, id){
				var select = elem;
				var div = document.getElementById("info_dom_" + id);
				
				if (select.options[select.selectedIndex].value == 4){
					div.style.display = '';
				}else{
					div.style.display = 'none';
				}
				
			}
			
			/* JQuery : UI */
			$(function() {
				$( "#liste_outlet" ).accordion({ autoHeight: false, clearStyle: true });
			});
			
			  function roundMe() {
				 $$('div.conteneur').each(function(e){Rico.Corner.round(e)});
			 }
		</script>
		
	</head> 
	<body> 
	
		<div id="global">
			<!-- On insère le header + le menu -->
			<?php require_once('./includes/include_entete_menu.php'); ?>
			
			<!-- Le contenu -->
			<div id="contenu">
				<!-- Titre de la page -->
				<h1><?php echo $lang_titre_accueil; ?></h1>
				
				<strong><?=$lang_texte_info_accueil?> : </strong>
				<br /><br />
      <!-- on crée l'élément "calendrier" dans lequel va s'afficher dynamiquement le calendrier-->

      <script>tableau(<?php echo date("m");?>,<?php echo date("Y");?>);</script>
      <div id="calendrier" class="conteneur calendrier" style="width:660px" align="center">
      <table class="tab_calendrier" align="center">
             <tr><td class="titre_calendrier" colspan="7" width="100%"><a id="link_precedent" href="#"><img src="./images/previous.png"></a> <a id="link_suivant" href="#"><img src="./images/next.png"></a> <span id="titre"></span> </td></tr>
             <tr>
                 <td  class="cell_calendrier_jour" >
                 <? echo $lundi;?>
                 </td>
                 <td  class="cell_calendrier_jour" >
                 <? echo $mardi;?>
                 </td>
                 <td  class="cell_calendrier_jour">
                 <? echo $mercredi;?>
                 </td>
                 <td  class="cell_calendrier_jour">
                 <? echo $jeudi;?>
                 </td>
                 <td  class="cell_calendrier_jour" >
                 <? echo $vendredi;?>
                 </td>
                 <td  class="cell_calendrier_jour">
                 <? echo $samedi;?>
                 </td>
                 <td  class="cell_calendrier_jour">
                 <? echo $dimanche;?>
                 </td>

             </tr>
             <?php
             $compteur_lignes=0;
             $total=1;
             while($compteur_lignes<6){
                echo '<tr>';
                $compteur_colonnes=0;
                while($compteur_colonnes<7){
                   echo '<td id="'.$total.'" class="cell_calendrier" >';
                   echo '</td>';
                   $compteur_colonnes++;
                   $total++;
                }
                echo '</tr>';
                $compteur_lignes++;
             }
             ?>
      </table>
      </div>



	<div id="navettes_dispo">
	</div>



      <!-- Appel de la fonction qui va arrondir le conteneur du calendrier et des évènements pour le panel déroulant -->
      <script>
              javascript:roundMe()
              Event.observe(window, 'load', function(){
                   PullDown.panel = Rico.SlidingPanel.top( $('outer_panel'), $('inner_panel'));
              })
              var PullDown = {};
      </script>
	  
		<!--<div id="liste_outlet">
					<?php
				/*$lesOutlet = get_list_outlet();
					foreach ($lesOutlet as $leOutlet){*/
					?>
				<h3><a href="#" style="color:#<?=$leOutlet["couleur_outlet"]?>;"><img src="images/icon_outlet_<?=$leOutlet["id_outlet"]?>.png" /> <?=$leOutlet["libelle_outlet"]?></a></h3>
				<div>
							<?php 
						/*$lesTrajets = get_les_trajets_dispo($leOutlet["code_outlet"]);
								if (count($lesTrajets) > 0){
									echo "
										<table class='no-border-table'>";
									
									foreach ($lesTrajets as $leTrajet){
										
										echo "
											<tr>
												<td style='width:100%;border:none;'>
													
													<table class='no-border-table'>
													
														<tr>
															<td style='width:50%;'>
																<img style='vertical-align:middle;' src='images/icon_arrow_right.png' /> ".$leTrajet['date_'.$_SESSION['lang']]." : ".$leTrajet['nb_pers']."/".$leTrajet['capacite']." ".$lang_personnes."
															</td>
															<td style='width:50%;'>
																<input style='margin-top:10px;' type='button' value='".$lang_choisir."' onclick='toggle_fenetre_details(".$leTrajet['id_trajet'].")' />
															</td>
														</tr>
														
													</table>
													
													<div id='details_".$leTrajet['id_trajet']."' style='display:none;'>
														<form method='post' action='info_client.php'>
															<input type='hidden' name='id_trajet' value='".$leTrajet['id_trajet']."' />
															<input type='hidden' name='id_outlet' value='".$leOutlet["id_outlet"]."' />
															<table class='no-border-table'>
																<tr>
																	<th style='width:30%;text-align:right;'>".$lang_nombre_personnes."</th>
																	<td style='width:70%;text-align:left;'>
																		<select name='select_nb_personnes'>";
																
																			for ($i=1; $i <= ($leTrajet['capacite']-$leTrajet['nb_pers']);$i++){
																				echo "<option value='".$i."'>".$i."</option>";
																			}
																		
																		echo "
																		</select>
																	</td>
																</tr>
																<tr>
																	<th style='text-align:right;'>".$lang_lieu_aller."</th>
																	<td style='text-align:left;'>
																		<select name='select_lieu_aller' onchange='show_domicile_info(this, ".$leTrajet['id_trajet'].")'>";
																
																			foreach (get_list_lieu() as $leLieu){
																				echo "<option value='".$leLieu['id_lieu']."'>".$leLieu['nom_lieu']."</option>";
																			}
																		
																		echo "
																		</select>
																	</td>
																</tr>
																<tr id='info_dom_".$leTrajet['id_trajet']."' style='display:none'>
																	<th></th>
																	<td>
																		<table class='no-border-table'>
																			<th style='text-align:left;' colspan='2'>".$lang_info_complementaires."</th>
																			<tr>
																				<td><label for='txt_ville_compl_aller'>".$lang_ville."</label></td>
																				<td><input class='dotted_input' type='text' name='txt_ville_compl_aller' /></td>
																			</tr>
																			<tr>
																				<td><label for='txt_cp_compl_aller'>".$lang_code_postal."</label></td>
																				<td><input class='dotted_input' type='text' name='txt_cp_compl_aller' /></td>
																			</tr>
																			<tr>
																				<td><label for='txt_adresse_compl_aller'>".$lang_adresse."</label></td>
																				<td><input class='dotted_input' type='text' name='txt_adresse_compl_aller' /></td>
																			</tr>
																		</table>
																	</td>
																</tr>
																
															</table>
															
															<input style='margin-top:10px;' type='submit' value='".$lang_etape_suivante."' />
														</form>
													</div>
													
												</td>
												
											</tr>";
										
									}
									echo "</table>";
								}else{
									echo "<strong>".$lang_plus_de_navette_dispo."</strong>";
								}*/
							?>
					</div>
					<?php/*
					}*/?>
					
				</div>-->
				
			
			<!-- Le pied de page -->
			<?php require_once('./includes/include_pied_de_page.php'); ?>
		</div>
		
	</body> 
</html>