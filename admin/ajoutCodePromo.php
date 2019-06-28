<?php
	/*
		KEMPF : Génération manuelle d'une facture
	*/
	include("verifAuth.php");
	require_once(dirname(__FILE__)."/../libs/db.php");
    require_once(dirname(__FILE__)."/../includes/fonctions.php");
?>

<input type="hidden" value="fr" id="page_lang" />
<script src="../aeroport/scripts/calendrier.js" type="text/javascript"></script>
<script type="text/javascript">
	// On enlève la restriction sur les jours passés
	restriction = false;
</script>

<div style="width:100%; text-align:center">
	<br />
    <h2>Création de code promotion</h2>
    <br />
	
	
	<?php
		/* Gestion des valeurs envoyées en POST */
		
		if (isset($_POST['nom_promo'])){
			
			$valide = true;
			
			// Client
			if (empty($_POST['nom_promo']) || empty($_POST['jour_depart']) || empty($_POST['jour_retour'])){
				$valide = false;
			}
			
			
			if ($valide){
			
				$tab_date_debut = explode('-', $_POST['jour_depart']);
				$annee_debut = intval($tab_date_debut[2]);
				$mois_debut = intval($tab_date_debut[1]);
				$jour_debut = intval($tab_date_debut[0]);

				$format_date_debut = "" . $annee_debut . "-" . $mois_debut . "-" . $jour_debut . " 00:00:00";

				$tab_date_fin = explode('-', $_POST['jour_retour']);
				$annee_fin = intval($tab_date_fin[2]);
				$mois_fin = intval($tab_date_fin[1]);
				$jour_fin = intval($tab_date_fin[0]);

				$format_date_fin = "" . $annee_fin . "-" . $mois_fin . "-" . $jour_fin . " 00:00:00";


					// Création du code promo
					$sql = "INSERT INTO
						aeroport_code_promo
					VALUES (
						'',
						'" . $_POST['nom_promo'] . "', 
						'" . $format_date_debut . "', 
						'" . $format_date_fin . "', 
						'" .  $_POST['repetition'] ."',
						'0',
						'" . $_POST['identifiant'] . "',
						'" . $_POST['email'] . "',
						'" . $_POST['effet'] . "',
						'" . $_POST['montant'] . "',
						'" . $_POST['condition'] . "'
						)";
						
					write($sql);

			}else{
				echo "Erreur lors de la génération<br/>Merci de remplir tout les champs et de vérifier leur contenu";
			}
			
		}		

	?>
	
	<form action="" method="post" style="font-size:0.9em;">
		
		<!-- Promotion -->
		<fieldset style='width:600px;margin:auto;'>
			<legend>Promotion</legend>
			
			<table width="100%" style="border-spacing:0px 5px;">
				<tr>
					<td style="text-align:left;">
						<label for="nom_promo">Code de la promotion </label>
					</td>
					<td style="text-align:left;">
						<input id="nom_promo" type="text" name="nom_promo" />
					</td>
				</tr>
				<tr style="background-color:#DDD;">
					<td style="text-align:left;">
						<label for="jour_depart">Date de début</label>
					</td>
					<td style="text-align:left;">
						<span id="lbl_jour_depart" style="background-color:#FFF;cursor:pointer;" onclick="document.getElementById('ds_conclass2').style.display='none';ds_sh('lbl_jour_depart', 'ds_conclass1', 'ds_calclass1', '1');"></span>

						<span>
							<input type="hidden" name="jour_depart" id="jour_depart" />
							<input type="hidden" name="jour_depart_long" id="jour_depart_long" value="" />

							<input type="button" onfocus="ds_sh('lbl_jour_depart', 'ds_conclass1', 'ds_calclass1', '1');" onclick="ds_sh('lbl_jour_depart', 'ds_conclass1', 'ds_calclass1', '1');" style="background-image:url(../aeroport/images/calendar.png); height:16px; width:16px;padding:0;margin:0;border:0;cursor:pointer;" />

						</span>

						<table class="ds_box" cellpadding="0" cellspacing="0" id="ds_conclass1" style="display:none;margin:auto;text-align:center;">
							<tr>
								<td id="ds_calclass1" valign="top"><br /></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td style="text-align:left;">
						<label for="jour_retour">Date de fin</label>
					</td>
					<td style="text-align:left;">
						<span id="lbl_jour_retour" style="background-color:#FFF;cursor:pointer;" onclick="document.getElementById('ds_conclass1').style.display='none';ds_sh('lbl_jour_retour', 'ds_conclass2', 'ds_calclass3', '1');"></span>

						<span>
							<input type="hidden" name="jour_retour" id="jour_retour" />
							<input type="hidden" name="jour_retour_long" id="jour_retour_long" value="" />

							<input type="button" onfocus="ds_sh('lbl_jour_retour', 'ds_conclass2', 'ds_calclass3', '1');" onclick="ds_sh('lbl_jour_retour', 'ds_conclass2', 'ds_calclass3', '1');" style="background-image:url(../aeroport/images/calendar.png); height:16px; width:16px;padding:0;margin:0;border:0;cursor:pointer;" />

						</span>

						<table class="ds_box" cellpadding="0" cellspacing="0" id="ds_conclass2" style="display:none;margin:auto;text-align:center;">
							<tr>
								<td id="ds_calclass3" valign="top"><br /></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr style="background-color:#DDD;">
					<td style="text-align:left;">
						<label for="repetition">Repetition</label>
					</td>
					<td style="text-align:left;">
						<select name="repetition" >
							<option value="1">Oui</option>
							<option value="0">Non</option>	
						</select>
					</td>
				</tr>
				<tr>
					<td style="text-align:left;">
						<label for="identifiant">Identifiant</label>
					</td>
					<td style="text-align:left;">
						<select name="identifiant" >
							<option value="1">Oui</option>
							<option value="0">Non</option>	
						</select>
					</td>
				</tr>
				<tr style="background-color:#DDD;">
					<td style="text-align:left;">
						<label for="email">E-Mail</label>
					</td>
					<td style="text-align:left;">
						<input type="text" name="email"/>
					</td>
				</tr>
				<tr>
					<td style="text-align:left;">
						<label for="effet">Effet</label>
					</td>
					<td style="text-align:left;">
						<select name="effet" >
							<option value="remise">Remise</option>
							<option value="pourcentage">Pourcentage</option>	
						</select>
					</td>
				</tr>
				<tr style="background-color:#DDD;">
					<td style="text-align:left;">
						<label for="montant">Montant de l'effet</label>
					</td>
					<td style="text-align:left;">
						<input type="text" name="montant"/>
					</td>
				</tr>
				<tr>
					<td style="text-align:left;">
						<label for="condition">Condition</label>
					</td>
					<td style="text-align:left;">
						<select name="condition" >
							<option value="trajet">Trajet</option>
							<option value="res_der_24">Réservation de dernière minute 24h</option>	
							<option value="res_der_72">Réservation de dernière minute 72h</option>	
							<option value="hor_demande">Horaires à la demande</option>	
							<option value="hor_nuit">Horaires de nuit</option>	
							<option value="prise_domicile">Prise à domicile</option>	
						</select>
					</td>
				</tr>
				
			</table>
			
		</fieldset>
		<br />

		<input type="submit" value="Générer"/>
		
	</form>
	
</div>

