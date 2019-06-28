<?php
	include("verifAuth.php");
	// connexion à la bdd
	include_once("connection.php");
	include_once("/homepages/3/d205267944/htdocs/outlet/includes/connexion_bdd.php");
	include_once("/homepages/3/d205267944/htdocs/outlet/includes/fonctions.php");
?>
<br /><br />

<div style="width:100%;text-align:center;">
	<?php
		// Si un message est spécifié dans l'URL
		if (isset($_GET['err'])){
			switch($_GET['err']){
				case 0:
					echo "Ajout effectué avec succès.";
					break;
				case 1:
					echo "Erreur lors de l'ajout";
					break;
				case 2:
					echo "Erreur lors de la suppression";
					break;
				case 3:
					echo "Trajet supprimé";
					break;
			}
		}
	?>
	<h1>Liste des navettes pour Centre Outlet</h1>
	<table align="center" width="75%">
		<?php
			
			$query = "	SELECT e.*,
								DATE_FORMAT(e.date_trajet, '%d-%m%-%Y') as date,
								DATE_FORMAT(e.date_trajet, '%H:%i') as heure,(SELECT SUM(r.nb_pers) FROM europa_ligne_reserv l JOIN europa_reservation r ON l.code_reserv = r.id_reservation WHERE l.code_trajet = e.id_trajet AND r.mode_paiement != 'ATTENTE') AS nbre_inscrits
						FROM europa_trajet e
						WHERE e.service_trajet LIKE '%OUTLET%'
						AND e.type_trajet = 'ALLER'
						ORDER BY e.date_trajet ASC";
			
			
			$result = mysql_query($query) or die ("Erreur lors de la requete");

			while ($r = @mysql_fetch_assoc($result))
			{	
				if ($r['nbre_inscrits'] == '')
				{
					$nb_inscrits = 0;
				}
				else
				{
					$nb_inscrits = $r['nbre_inscrits'];
				}
				$bg_color = ($nb_inscrits == 0) ? "#6DFFE1" : "#0C3";
				
				echo '
					<tr style="background-color:'.$bg_color.';">
						<td width="75%">
							Navette du '.$r['date'].' à '.$r['heure'].' (Capacité : '.$r['nb_pers'].' personnes, Inscrites : '.$nb_inscrits.' personnes)
						</td>
						<td>';
							if ($nbre_inscrits == 0){
								echo '
								<form action="supprimer_navette_outlet.php" method="post">
									<input type="hidden" name="id_trajet" id="id_trajet" value="'.$r['id_trajet'].'" />
									<input type="submit" name="bt_submit" value="Supprimer la navette" />
								</form>
								';
							}else{
								echo "Navette confirmée";
							}
						echo '
						</td width="25%">
					</tr>
				';
			}
			
		?>
	</table>
	<h1>Ajouter une navette pour Centre Outlet</h1>
	<form action="ajouter_navette_outlet.php" method="post">
		<table align="center" width="75%" style="text-align:center;">
			<tr>
				<td style="align:center;">
					<script type="text/javascript">

						var ds_i_date = new Date();
						ds_c_month = ds_i_date.getMonth() + 1;
						ds_c_year = ds_i_date.getFullYear();
					
					</script>
					<!-- DIV CONTENANT LE CALENDRIER -->
					<div>
						Date de la navette : 
						<br />
						<table class="ds_box" cellpadding="0" cellspacing="0" id="ds_conclass" style="margin:auto;display:none;">
							<tr>
								<td id="ds_calclass"></td>
							</tr>
						</table>
					</div>
					
					<script src="scripts/calendar.js" type="text/javascript"></script>
					<script type="text/javascript">
					<!--
						ds_sh();
					//-->
					</script>
					<!-- champ caché du formulaire contenant la date défini lors l'un clic sur un chiffre du calendrier -->
					<br />
					<input id ="date" name="date" type="text" readonly value="" />
					<input type="hidden" name="type_cal" id="type_cal" value="" />

				</td>
			</tr>
			<tr>
				<td>
					<br />
					Heure aller :
					<select name="heure_aller">
					
					<?php
						for ($i=7;$i<=21;$i++){
							echo '<option value="'.sprintf("%1$02d", $i).'">'.sprintf("%1$02d", $i).'</option>';
						}
					?>
					</select>
					<select name="minute_aller">
					
					<?php
						for ($i=0;$i<=55;$i=$i+5){
							echo '<option value="'.sprintf("%1$02d", $i).'">'.sprintf("%1$02d", $i).'</option>';
						}
					?>
					</select>
				</td>
			</tr>
			<tr>
				<td>
					<br />
					Heure retour :
					<select name="heure_retour">
					
					<?php
						for ($i=7;$i<=21;$i++){
							echo '<option value="'.sprintf("%1$02d", $i).'">'.sprintf("%1$02d", $i).'</option>';
						}
					?>
					</select>
					<select name="minute_retour">
					
					<?php
						for ($i=0;$i<=55;$i=$i+5){
							echo '<option value="'.sprintf("%1$02d", $i).'">'.sprintf("%1$02d", $i).'</option>';
						}
					?>
					</select>
				</td>
			</tr>
			<tr>
				<td>
					<br />
					Choix du Centre Outlet : 
					<br />
					<select name="service_trajet">
					
					<?php
						foreach (get_list_outlet() as $leOutlet){
							echo '<option value="'.($leOutlet['libelle_outlet']).'">'.$leOutlet['libelle_outlet'].'</option>';
						}
					?>
					</select>
				</td>
			</tr>
			<tr>
				<td>
					<br><label for="capacite">Capacité de la navette : 
					<br><input type="number" name="capacite" id="capacite" min="1" value="8">
				</td>
			</tr>
			<tr>
				<td>
					<br />
					<input type="submit" value="Créer la navette" />
				</td>
			</tr>
		</table>
	</form>
	
</div>