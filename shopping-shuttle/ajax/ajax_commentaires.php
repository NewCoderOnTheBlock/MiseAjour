<?php
     header('Content-Type: text/html; charset: UTF-8');
     include("../conf/mysql.php");
	 include('../includes/init_functions.php');
     $date=$_GET['date'];
     $requete="SELECT * FROM europa_trajet 
				WHERE date_trajet='".$date." 07:00:00'
				AND type_trajet = 'ALLER'
				OR date_trajet='".$date." 08:00:00'
							AND type_trajet = 'ALLER'
				OR date_trajet='".$date." 09:00:00'
							AND type_trajet = 'ALLER'
				OR date_trajet='".$date." 10:00:00'
							AND type_trajet = 'ALLER'
				OR date_trajet='".$date." 11:00:00'
							AND type_trajet = 'ALLER'
				OR date_trajet='".$date." 12:00:00'
							AND type_trajet = 'ALLER'
				OR date_trajet='".$date." 13:00:00'
							AND type_trajet = 'ALLER'
				OR date_trajet='".$date." 14:00:00'
							AND type_trajet = 'ALLER'
				OR date_trajet='".$date." 15:00:00'
							AND type_trajet = 'ALLER'
				OR date_trajet='".$date." 16:00:00'
							AND type_trajet = 'ALLER'
				OR date_trajet='".$date." 17:00:00'
							AND type_trajet = 'ALLER'
				OR date_trajet='".$date." 18:00:00'
							AND type_trajet = 'ALLER'
				OR date_trajet='".$date." 19:00:00'
							AND type_trajet = 'ALLER'
				OR date_trajet='".$date." 20:00:00'
							AND type_trajet = 'ALLER'
				OR date_trajet='".$date." 21:00:00'
				AND type_trajet='ALLER'";
     $ress=mysql_query($requete);
     $retour='';
     if($ress){
               while($liste_evenements=mysql_fetch_assoc($ress)){
				$tab_date = explode('-', $liste_evenements[date_trajet]);
				$annee = $tab_date[0];
				$mois = $tab_date[1];
				$jour = $tab_date[2];
				$tab_date2 = explode(' ', $jour);
				$jour = $tab_date2[0];
				$heure = $tab_date2[1];
				$tab_date3 = explode(':', $heure);
				$heure = $tab_date3[0];
				$sql = "SELECT * FROM outlet_outlet WHERE libelle_outlet='".htmlentities($liste_evenements[service_trajet],ENT_QUOTES)."'";
				$req = mysql_query($sql);
				while($outlet = mysql_fetch_assoc($req))
				{
                  $retour.='
				  <h3><a href="#">'.htmlentities($liste_evenements[service_trajet],ENT_QUOTES).'</a></h3>
				  <table class="no-border-table">
				  <tr>
						<td style="width:100%;border:none;">					
							<table class="no-border-table">					
								<tr>
									<td style="width:50%;">
										<img style="vertical-align:middle;" src="images/icon_arrow_right.png" /> '.$jour.'-'.$mois.'-'.$annee.' '.$lang_a_heure_min.' '.$heure.'h
									</td>
									<td style="width:50%;">
										<input style="margin-top:10px;" type="button" value="'.$lang_choisir.'" onclick="toggle_fenetre_details('.htmlentities($liste_evenements[id_trajet]).')" />
									</td>
								</tr>						
							</table>
														<div id="details_'.htmlentities($liste_evenements[id_trajet]).'" style="display:none;">
														<form method="post" action="info_client.php">
															<input type="hidden" name="id_trajet" value="'.htmlentities($liste_evenements[id_trajet]).'" />
															<input type="hidden" name="id_outlet" value="'.htmlentities($outlet[id_outlet],ENT_QUOTES).'" />
															<table class="no-border-table">
																<tr>
																	<th style="width:30%;text-align:right;">'.$lang_nombre_personnes.'</th>
																	<td style="width:70%;text-align:left;">
																		<select name="select_nb_personnes"';
																
																			for ($i=0; $i <= (8-$liste_evenements[nb_pers]);$i++){
																				$retour .= '<option value="'.$i.'">'.$i.'</option>';
																			}
																		
																	$retour .= '	</select>
																	</td>
																</tr>
																<tr>
																	<th style="text-align:right;">'.$lang_lieu_aller.'</th>
																	<td style="text-align:left;">
																		<select name="select_lieu_aller" onchange="show_domicile_info(this, '.htmlentities($liste_evenements[id_trajet]).')">';
																
																			foreach (get_list_lieu() as $leLieu){
																				$retour .= '<option value="'.$leLieu['id_lieu'].'">'.$leLieu['nom_lieu'].'</option>';
																			}
																		
																		$retour .= '</select>
																	</td>
																</tr>
																<tr id="info_dom_'.htmlentities($liste_evenements[id_trajet]).'" style="display:none">
																	<th></th>
																	<td>
																		<table class="no-border-table">
																			<th style="text-align:left;" colspan="2">'.$lang_info_complementaires.'</th>
																			<tr>
																				<td><label for="txt_ville_compl_aller">'.$lang_ville.'</label></td>
																				<td><input class="dotted_input" type="text" name="txt_ville_compl_aller" /></td>
																			</tr>
																			<tr>
																				<td><label for="txt_cp_compl_aller">'.$lang_code_postal.'</label></td>
																				<td><input class="dotted_input" type="text" name="txt_cp_compl_aller" /></td>
																			</tr>
																			<tr>
																				<td><label for="txt_adresse_compl_aller">'.$lang_adresse.'</label></td>
																				<td><input class="dotted_input" type="text" name="txt_adresse_compl_aller" /></td>
																			</tr>
																		</table>
																	</td>
																</tr>
																
															</table>
															
															<input style="margin-top:10px;" type="submit" value="'.$lang_etape_suivante.'" />
														</form>
													</div>
													
												</td>
												
											</tr>
											</table>
											';
					}
               }
               //on affiche le retour dans la div dédiée à cet effet
               echo $retour;
     }
?>