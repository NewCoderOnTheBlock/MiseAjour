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
    <h2>Création de facture manuellement</h2>
    <br />
	
	
	<?php
		/* Gestion des valeurs envoyées en POST */
		
		if (isset($_POST['est_simple'])){
			
			$valide = true;
			
			// Client
			if (empty($_POST['nom_client']) || empty($_POST['prenom_client']) || empty($_POST['email_client'])){
				$valide = false;
			}
			
			// Trajet aller
			if (empty($_POST['prix_base_aller']) || !is_numeric($_POST['prix_base_aller']) || empty($_POST['jour_depart'])){
				$valide = false;
			}
			if (empty($_POST['depart_aller']) || empty($_POST['destination_aller'])){
				$valide = false;
			}
			
			// Trajet retour
			if ($_POST['est_simple'] == 0){
				if (empty($_POST['prix_base_retour']) || !is_numeric($_POST['prix_base_retour']) || empty($_POST['jour_retour'])){
					$valide = false;
				}
			}
			
			if (empty($_POST['prix_total']) || !is_numeric($_POST['prix_total'])){
				$valide = false;
			}
			
			if ($valide){
				if( $_POST['id_facture2'] == '')			//Dans le cas où on créer une nouvelle facture
				{
					// On récupère l'ID de la facture et on le remet à jour
					$id_facture = intval(get_option("id_max_facture"));
					set_option("id_max_facture", ($id_facture + 1));
					
					// TVA
					$fac_tva = intval(get_option("tva"));
					
					// Adresse de facturation facultative
					$adresse_facturation = empty($_POST["adresse_client"]) ? "" : nl2br($_POST["adresse_client"]);
					
					// Création de la facture
					$sql = "INSERT INTO
						aeroport_facture
					VALUES (
						'" . $id_facture . "',
						'" . $_POST['civilite_client'] . "', 
						'" . $_POST['nom_client'] . "', 
						'" . $_POST['prenom_client'] . "', 
						'" . $_POST['email_client'] . "', 
						'" . $_POST['prix_total'] . "',
						'" . $fac_tva . "',
						'" . $_POST['jour_depart'] . "',
						'" . $_POST['prix_base_aller'] . "',
						'" . $_POST['depart_aller'] . "',
						'" . $_POST['destination_aller'] . "',
						'" . $_POST['horaire_demande_aller'] . "',
						'" . $_POST['domicile_aller'] . "',
						'" . $_POST['jour_retour'] . "',
						'" . $_POST['prix_base_retour'] . "',
						'" . $_POST['destination_aller'] . "',
						'" . $_POST['depart_aller'] . "',
						'" . $_POST['horaire_demande_retour'] . "',
						'" . $_POST['domicile_retour'] . "',
						'" . $_POST['der_min'] . "',
						'" . date('d-m-Y') . "',
						'" . $_POST['nb_pers_aller'] . "',
						'" . $_POST['nb_pers_retour'] . "',
						'" . $_POST['nuit_aller'] . "',
						'" . $_POST['nuit_retour'] . "',
						'" . $_POST['lang'] . "',
						'" . $adresse_facturation . "',
						'1',
						'".$_POST['service_attente']."')";
						
					write($sql);
					
					$lien_facture = "http://alsace-navette.com/aeroport/gen_facture_aeroport.php?f=".sha1($id_facture)."";
					
					echo "<a href='".$lien_facture."'>".$lien_facture."</a>";
				}
				else {					//Dans le cas où on modifie une facture déjà existante
					$id_facture = $_POST['id_facture2'];
					// TVA
					$fac_tva = intval(get_option("tva"));
					
					// Adresse de facturation facultative
					$adresse_facturation = empty($_POST["adresse_client"]) ? "" : nl2br($_POST["adresse_client"]);
					
					// Création de la facture
					$sql =
					"UPDATE aeroport_facture 
					SET 
					civilite='".$_POST['civilite_client']."', 
					nom='".$_POST['nom_client']."',prenom='".$_POST['prenom_client']."', email=
						'".$_POST['email_client']."', 
						prix_total=
						".$_POST['prix_total'].",
						tva=
						'".$fac_tva."',
						date_aller=
						'".$_POST['jour_depart']."',
						prix_aller=
						".$_POST['prix_base_aller'].",
						lieu_1_aller=
						'".$_POST['depart_aller']."',
						lieu_2_aller=
						'".$_POST['destination_aller']."',
						horaire_demande_aller=
						".$_POST['horaire_demande_aller'].",
						maj_dom_aller=
						".$_POST['domicile_aller'].",
						date_retour=
						'".$_POST['jour_retour']."',
						prix_retour=
						".$_POST['prix_base_retour'].",
						lieu_1_retour=
						'".$_POST['destination_aller']."',
						lieu_2_retour=
						'".$_POST['depart_aller']."',
						horaire_demande_retour=
						".$_POST['horaire_demande_retour'].",
						maj_dom_retour=
						".$_POST['domicile_retour'].",
						res_der_min=
						".$_POST['der_min'].",
						date_res=
						'".date('d-m-Y')."',
						nb_pers_aller=
						".$_POST['nb_pers_aller'].",
						nb_pers_retour=
						".$_POST['nb_pers_retour'].",
						nuit_aller=
						'".$_POST['nuit_aller']."',
						nuit_retour=
						'".$_POST['nuit_retour']."',
						lang=
						'".$_POST['lang']."',
						adresse_facture=
						'".$adresse_facturation."',
						valide=
						'1',
						supplement_attente=
						'".$_POST['service_attente']."'
						WHERE id_facture='".$id_facture."'";
						
					write($sql);
					
					$lien_facture = "http://alsace-navette.com/aeroport/gen_facture_aeroport.php?f=".sha1($id_facture)."";
					
					echo "<a href='".$lien_facture."'>".$lien_facture."</a>";
				}
			}else{
				echo "Erreur lors de la génération<br/>Merci de remplir tout les champs et de vérifier leur contenu";
			}
			
		}		

	?>
	
	<form action="" method="post" style="font-size:0.9em;">
		
		<!-- Client -->
		<fieldset style='width:600px;margin:auto;'>
			<legend>Client</legend>
			
			<table width="100%" style="border-spacing:0px 5px;">
				<input type="hidden" name="id_facture2" value="<?echo $_POST['id_facture']?>"\">
				<tr style="background-color:#DDD;">
					<td width="50%" style="text-align:left;">
						<label for="civilite_client">Civilité</label>
					</td>
					<td width="50%" style="text-align:left;">
						<select name="civilite_client" >
						<?	if( isset($_POST['civilite']) && $_POST['civilite'] == 'Mme')
							{	?>
							<option value="Mme">Madame</option>
							<option value="Mr">Monsieur</option>
							<option value="Mlle">Mademoiselle</option>
						<?	}
							elseif(isset($_POST['civilite']) && $_POST['civilite'] == 'Mlle')
							{	?>
							<option value="Mlle">Mademoiselle</option>
							<option value="Mr">Monsieur</option>
							<option value="Mme">Madame</option>							
						<?	}
							else 
							{	?>
							<option value="Mr">Monsieur</option>
							<option value="Mme">Madame</option>
							<option value="Mlle">Mademoiselle</option>							
						<?	}	?>
						</select>
					</td>
				</tr>
				<tr>
					<td style="text-align:left;">
						<label for="nom_client">Nom</label>
					</td>
					<td style="text-align:left;">
						<input id="inputNom" type="text" name="nom_client" value="<?echo $_POST['nom']?>" />
					</td>
				</tr>
				<tr style="background-color:#DDD;">
					<td style="text-align:left;">
						<label for="prenom_client">Prénom</label>
					</td>
					<td style="text-align:left;">
						<input type="text" name="prenom_client" value="<?echo $_POST['prenom']?>"/>
					</td>
				</tr>
				<tr>
					<td style="text-align:left;">
						<label for="email_client">E-Mail</label>
					</td>
					<td style="text-align:left;">
						<input type="text" name="email_client" value="<?echo $_POST['email']?>"/>
					</td>
				</tr>
				<tr>
					<td style="text-align:left;">
						<label for="adresse_client">Adresse de facturation</label>
					</td>
					<td style="text-align:left;">
						<textarea name="adresse_client" ></textarea>
					</td>
				</tr>
				
			</table>
			
		</fieldset>
		<br />
		
		<!-- Trajet Aller -->
		<fieldset style='width:600px;margin:auto;'>
			<legend>Trajet Aller</legend>
			
			<table width="100%" style="border-spacing:0px 5px;">
			
				<tr style="background-color:#DDD;">
					<td width="50%" style="text-align:left;">
						<label for="prix_base_aller">Prix de base</label>
					</td>
					<td width="50%" style="text-align:left;">
						<input type="text" name="prix_base_aller" value="<?echo $_POST['prix_base_aller']?>"/> €
					</td>
				</tr>
				<tr>
					<td style="text-align:left;">
						<label for="jour_depart">Date</label>
					</td>
					<td style="text-align:left;">
						<span id="lbl_jour_depart" style="background-color:#FFF;cursor:pointer;" onclick="document.getElementById('ds_conclass2').style.display='none';ds_sh('lbl_jour_depart', 'ds_conclass1', 'ds_calclass1', '1');">Date aller</span>

						<span>
							<input type="hidden" name="jour_depart" id="jour_depart" value="<?echo $_POST['date_aller']?>" />
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
				<tr style="background-color:#DDD;">
					<td style="text-align:left;">
						<label for="depart_aller">Lieu départ</label>
					</td>
					<td style="text-align:left;">
						<select name="depart_aller" value="<? echo $_POST['lieu_depart']?>">
							<?php
								foreach (get_liste_aeroport() as $aeroport){
									if( isset($_POST['lieu_depart']) && $_POST['lieu_depart'] == $aeroport['nom'])
									{
										echo "<option selected value='".$aeroport['nom']."'>".$aeroport['nom']."</option>";
									}
									else {
										echo "<option value='".$aeroport['nom']."'>".$aeroport['nom']."</option>";
									}
								}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td style="text-align:left;">
						<label for="destination_aller">Lieu destination</label>
					</td>
					<td style="text-align:left;">
						<select name="destination_aller" value="<?echo $_POST['lieu_destination']?>">
							<?php
								foreach (get_liste_aeroport() as $aeroport){
									if( isset($_POST['lieu_destination']) && $_POST['lieu_destination'] == $aeroport['nom'])
									{
										echo "<option selected value='".$aeroport['nom']."'>".$aeroport['nom']."</option>";
									}
									else {
										echo "<option value='".$aeroport['nom']."'>".$aeroport['nom']."</option>";
									}
								}
							?>
						</select>
					</td>
				</tr>
				<tr style="background-color:#DDD;">
					<td style="text-align:left;">
						<label for="nb_pers_aller">Nombre de personnes</label>
					</td>
					<td style="text-align:left;">
						<select name="nb_pers_aller" value="<?echo $_POST['nombre_personnes']?>">
							<?php
								for($i=1;$i<9;$i++){
									if( isset($_POST['nombre_personnes']) && $_POST['nombre_personnes'] == $i)
									{
										echo "<option selected value='".$i."'>".$i."</option>";
									}
									else {
										echo "<option value='".$i."'>".$i."</option>";
									}
								}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td style="text-align:left;">
						<label for="horaire_demande_aller">Majoration Horaire à la demande (<?=intval(get_option('maj_surcout_demande')) ?> €)</label>
					</td>
					<td style="text-align:left;">
						<select name="horaire_demande_aller" >
						<?
							if(isset($_POST['majoration_horaire_aller']) && $_POST['majoration_horaire_aller'] != '0')
							{ ?>
								<option value="<?=intval(get_option('maj_surcout_demande')) ?>">Oui</option>
								<option value="0">Non</option>
						<?	}
							else
							{ ?>
								<option value="0">Non</option>
								<option value="<?=intval(get_option('maj_surcout_demande')) ?>">Oui</option>
						<?	} ?>
						</select>
					</td>
				</tr>
				<tr style="background-color:#DDD;">
					<td style="text-align:left;">
						<label for="domicile_aller">Majoration Domicile (<?=intval(get_option('maj_dom')) ?> €)</label>
					</td>
					<td style="text-align:left;">
						<select name="domicile_aller" >
						<?
							if(isset($_POST['majoration_domicile_aller']) && $_POST['majoration_domicile_aller'] != '0')
							{ ?>
							<option value="<?=intval(get_option('maj_dom')) ?>">Oui</option>
							<option value="0">Non</option>
						<?	}
							else
							{ ?>
							<option value="0">Non</option>
							<option value="<?=intval(get_option('maj_dom')) ?>">Oui</option>
						<?	} ?>
						</select>
					</td>
				</tr>
				<tr>
					<td style="text-align:left;">
						<label for="nuit_aller">Horaires de nuit (<?=intval(get_option('maj_horaire_nuit')) ?> €)</label>
					</td>
					<td style="text-align:left;">
						<select name="nuit_aller" >
						<?
							if(isset($_POST['horaires_nuit']) && $_POST['horaires_nuit'] != '0')
							{ ?>
							<option value="1">Oui</option>
							<option value="0">Non</option>	
						<?	}
							else
							{ ?>
							<option value="0">Non</option>
							<option value="1">Oui</option>
						<?	} ?>
						</select>
					</td>
				</tr>
				
			</table>
			
		</fieldset>
		<br />
		
		<!-- Aller - retour ? -->
		<fieldset style='width:600px;margin:auto;'>
			<legend>Type du trajet</legend>
			
			<table width="100%" style="border-spacing:0px 5px;">
			
				<tr style="background-color:#DDD;">
					<td colspan="2" style="text-align:center;">
						<select name="est_simple" id="est_simple" onchange="showfieldset_retour();">
						<? if(isset($_POST['est_retour']) && $_POST['est_retour'] == '1') { ?>
							<option value="0">Trajet Aller-Retour</option>
							<option value="1">Trajet Simple</option>
						<?
						}
						else { ?>
							<option value="1">Trajet Simple</option>
							<option value="0">Trajet Aller-Retour</option>
						<?} ?>
						</select>
					</td>
				</tr>				
			</table>
			
		</fieldset>
		<br />
		
		<!-- Trajet Retour -->
		<fieldset id="fieldset_retour" style='width:600px;margin:auto;display:none;'>
			<legend>Trajet Retour</legend>
			
			<table width="100%" style="border-spacing:0px 5px;">
			
				<tr style="background-color:#DDD;">
					<td width="50%" style="text-align:left;">
						<label for="prix_base_retour">Prix de base</label>
					</td>
					<td width="50%" style="text-align:left;">
					<? if($_POST['prix_base_retour'] != '') { ?>
						<input type="text" name="prix_base_retour" value="<?echo $_POST['prix_base_retour']?>"/> €
					<? } else { ?>
						<input type="text" name="prix_base_retour" value="0"/> €
					<? } ?>
					</td>
				</tr>
				<tr>
					<td style="text-align:left;">
						<label for="jour_retour">Date</label>
					</td>
					<td style="text-align:left;">
						<span id="lbl_jour_retour" style="background-color:#FFF;cursor:pointer;" onclick="document.getElementById('ds_conclass1').style.display='none';ds_sh('lbl_jour_retour', 'ds_conclass2', 'ds_calclass3', '1');">Date retour</span>

						<span>
							<input type="hidden" name="jour_retour" id="jour_retour" value="<?echo $_POST['date_retour']?>" />
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
						<label for="nb_pers_retour">Nombre de personnes</label>
					</td>
					<td style="text-align:left;">
						<select name="nb_pers_retour" value="<?echo $_POST['nombre_personnes_retour']?>">
							<?php
								for($i=1;$i<9;$i++){
									if( isset($_POST['nombre_personne_retour']) && $_POST['nombre_personnes'] == $i)
									{
										echo "<option selected value='".$i."'>".$i."</option>";
									}
									else {
										echo "<option value='".$i."'>".$i."</option>";									
									}
								}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td style="text-align:left;">
						<label for="horaire_demande_retour">Majoration Horaire à la demande (<?=intval(get_option('maj_surcout_demande')) ?> €)</label>
					</td>
					<td style="text-align:left;">
						<select name="horaire_demande_retour" >
						<?
							if(isset($_POST['majoration_horaire_retour']) && $_POST['majoration_horaire_retour'] != '0')
							{ ?>
								<option value="<?=intval(get_option('maj_surcout_demande')) ?>">Oui</option>
								<option value="0">Non</option>
						<?	}
							else
							{ ?>
								<option value="0">Non</option>
								<option value="<?=intval(get_option('maj_surcout_demande')) ?>">Oui</option>
						<?	} ?>	
						</select>
					</td>
				</tr>
				<tr style="background-color:#DDD;">
					<td style="text-align:left;">
						<label for="domicile_retour">Majoration Domicile (<?=intval(get_option('maj_dom')) ?> €)</label>
					</td>
					<td style="text-align:left;">
						<select name="domicile_retour" >	
						<?
							if(isset($_POST['majoration_domicile_retour']) && $_POST['majoration_domicile_retour'] != '0')
							{ ?>
							<option value="<?=intval(get_option('maj_dom')) ?>">Oui</option>
							<option value="0">Non</option>
						<?	}
							else
							{ ?>
							<option value="0">Non</option>
							<option value="<?=intval(get_option('maj_dom')) ?>">Oui</option>
						<?	} ?>
						
						</select>
					</td>
				</tr>
				<tr>
					<td style="text-align:left;">
						<label for="nuit_retour">Horaires de nuit (<?=intval(get_option('maj_horaire_nuit')) ?> €)</label>
					</td>
					<td style="text-align:left;">
						<select name="nuit_retour" >
						<?
							if(isset($_POST['horaires_nuit_retour']) && $_POST['horaires_nuit_retour'] != '0')
							{ ?>
							<option value="1">Oui</option>
							<option value="0">Non</option>
						<?	}
							else
							{ ?>
							<option value="0">Non</option>
							<option value="1">Oui</option>
						<?	} ?>		
						</select>
					</td>
				</tr>
				
			</table>
			
		</fieldset>
		<br />
		
		<!-- Autre -->
		<fieldset style='width:600px;margin:auto;'>
			<legend>Autre</legend>
			
			<table width="100%" style="border-spacing:0px 5px;">
				<tr>	
					<td width="50%" style="text-align:left;">
						<label for="service_attente">Service attente aéroport</label>
					</td>
					<td width="50%" style="text-align:left;">
						<? 	if(isset($_POST['attente_aeroport']) && $_POST['attente_aeroport'] != '')
							{ ?>
						<input type="text" name="service_attente" value="<?echo $_POST['attente_aeroport']?>"/> €
						<? }
							else { ?>
						<input type="text" name="service_attente" value="0"/> €
						<? } ?>
					</td>
				</tr>	
				<tr style="background-color:#DDD;">
					<td style="text-align:left;">
						<label for="der_min">Dernière minute</label>
					</td>
					<td style="text-align:left;">
						<select name="der_min" >
						<? 	if(isset($_POST['dernière_minute']) && $_POST['dernière_minute'] =='14')
							{ ?>
								<option value="<?=intval(get_option('maj_24')) ?>">- 24h (<?=intval(get_option('maj_24')) ?> €)</option>
								<option value="<?=intval(get_option('maj_72')) ?>">- 72h (<?=intval(get_option('maj_72')) ?> €)</option>
								<option value="0">Non</option>
						<?	}
							elseif (isset($_POST['dernière_minute']) && $_POST['dernière_minute'] =='7')
							{	?>
								<option value="<?=intval(get_option('maj_72')) ?>">- 72h (<?=intval(get_option('maj_72')) ?> €)</option>
								<option value="<?=intval(get_option('maj_24')) ?>">- 24h (<?=intval(get_option('maj_24')) ?> €)</option>
								<option value="0">Non</option>
						<? }
							else
							{	?>
								<option value="0">Non</option>
								<option value="<?=intval(get_option('maj_24')) ?>">- 24h (<?=intval(get_option('maj_24')) ?> €)</option>
								<option value="<?=intval(get_option('maj_72')) ?>">- 72h (<?=intval(get_option('maj_72')) ?> €)</option>
						<?	}	?>
						</select>
					</td>
				</tr>
				<tr>			
					<td style="text-align:left;">
						<label for="lang">Langue</label>
					</td>
					<td style="text-align:left;">
						<select name="lang" > <?
						if(isset($_POST['langue']) && $_POST['langue'] !='fr')
						{ ?>
							<option value="en">Anglais</option>
							<option value="fr">Français</option>

						<?
						}
						else {?>
							<option value="fr">Français</option>
							<option value="en">Anglais</option>
						<? } ?>
						</select>
					</td>
				</tr>
				<tr style="background-color:#DDD;">
					<td width="50%" style="text-align:left;">
						<label for="prix_total">Prix total</label>
					</td>
					<td width="50%" style="text-align:left;">
						<input type="text" name="prix_total" value="<?echo $_POST['prix_total']?>"/> €
					</td>
				</tr>
				
			</table>
			
		</fieldset>
		<br />
		<input type="submit" value="Générer"/>
		
	</form>
	
</div>

<script type="text/javascript">
window.onload = showfieldset_retour();

	function showfieldset_retour(){
		var select = document.getElementById('est_simple');
		
		if (select.options[select.selectedIndex].value == 1){
			document.getElementById('fieldset_retour').style.display = 'none';
		}else{
			document.getElementById('fieldset_retour').style.display = 'block';
		}
		
	}
	
	document.getElementById('inputNom').focus(); 
</script>