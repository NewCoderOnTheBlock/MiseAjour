<?php
	include("verifAuth.php");

	// connexion à la bdd
	include("connection.php");
	
	if (empty($_GET["id"]))
	{
		header("Location: index.php?p=1");
	}
	
	// Chargement des fonctions 
	
	function get_indice($id){
		
		$query = '	SELECT identifiant_tel
					FROM aeroport_pays
					WHERE id_pays = "'.$id.'"
				';
						
		$result = mysql_query($query) or die (mysql_error());
		
		$r = @mysql_fetch_assoc($result);
		
		$value = $r['identifiant_tel'];
		
		return $value;
	}
	
	function get_nom_pays($id){
	
		$query = '	SELECT nom_pays
					FROM aeroport_pays
					WHERE id_pays = "'.$id.'"
				';
						
		$result = mysql_query($query) or die (mysql_error());
		
		$r = @mysql_fetch_assoc($result);
		
		$value = $r['nom_pays'];
		
		return $value;
	}
	
	function get_nom_lieu($id){
		
		$query = '	SELECT nom_lieu
					FROM europa_lieu
					WHERE id_lieu = "'.$id.'"
				';
						
		$result = mysql_query($query) or die (mysql_error());
		
		$r = @mysql_fetch_assoc($result);
		
		$value = $r['nom_lieu'];
		
		return $value;
	}
	
?>
<br /><br />

<div style="width:100%;text-align:center;">
	<h1>Informations client</h1>
	<table align="center">
		<tr>
			<td>
		<?php
			$query = '	SELECT *
						FROM europa_client
						WHERE id_client = '.$_GET["id"].'';
							
			$result = mysql_query($query) or die (mysql_error());
			
			$r = @mysql_fetch_assoc($result);
			
			$id_client = $r["id_client"];
			$prenom_client = $r["prenom"];
			$nom_client = $r["nom"];
			$ville_client = $r["ville"];
			$id_pays_client = $r["pays"];
			$pays_client = get_nom_pays($id_pays_client);
			$mail_client = $r["mail"];
			$tel_port_client = $r["tel_port"];
			$tel_fixe_client = $r["tel_fixe"];
			$indice_tel_client = get_indice($r["pays"]);
			
			echo '
				<table>
					<tr>
						<th>ID : </th>
						<td>'.$id_client.'</td>
					</tr>
					<tr>
						<th>Nom : </th>
						<td>'.$nom_client.'</td>
					</tr>
					<tr>
						<th>Prénom : </th>
						<td>'.$prenom_client.'</td>
					</tr>
					<tr>
						<th>Ville : </th>
						<td>'.$ville_client.'</td>
					</tr>
					<tr>
						<th>Pays : </th>
						<td>'.$pays_client.'</td>
					</tr>
					<tr>
						<th>E-Mail : </th>
						<td>'.$mail_client.'</td>
					</tr>';
					if (!empty($tel_port_client)){
						echo "
						<tr>
							<th>Téléphone Portable : </th>
							<td>(".$indice_tel_client.") ".$tel_port_client."</td>
						</tr>";
					}
					if (!empty($tel_fixe_client)){
						echo "
						<tr>
							<th>Téléphone Fixe : </th>
							<td>(".$indice_tel_client.") ".$tel_fixe_client."</td>
						</tr>";
					}
			echo '
				</table>
			';
		
		?>
			</td>
		</tr>
	</table>
	
	<br /><br />
	<h1>Réservations du client</h1>
	
	<?php
	// Affichage des trajets effectués par la personne
	
	$query = "SELECT *,
					DATE_FORMAT(date_aller, '%w' ) as jour_aller,
					DATE_FORMAT(date_retour, '%w' ) as jour_retour,
					DATE_FORMAT(date, '%d-%m-%Y' ) as date_reserv,
					DATE_FORMAT(date_aller, '%d-%m-%Y' ) as date_all,
					DATE_FORMAT(date_retour, '%d-%m-%Y' ) as date_ret,
					DATE_FORMAT(date_aller, '%Hh%i' ) as heure_all,
					DATE_FORMAT(date_retour, '%Hh%i' ) as heure_ret
			  FROM 	europa_reservation r, 
					europa_client c, 
					europa_lieu l
			  WHERE r.id_client = c.id_client
			  AND l.id_lieu = r.type_lieu_aller
			  AND l.id_lieu = r.type_lieu_retour
			  AND c.id_client = ".$id_client."
			  ORDER BY date_aller ASC";
				  
				  
	$result = mysql_query($query) or die (mysql_error());
	
	$nbreq = mysql_num_rows($result);
	
	//teste de la présence de trajet à cette date
	if ($nbreq == "0"){
		echo "Il n'y a pas de réservation pour ce client";
	}
	else
	{
		$oldDate = "";
			
		// id pour la modification du prix
		$id_affiche = 0;

		while ($r = @mysql_fetch_assoc($result))
		{		
			//récupération des données
			$id_reserv = $r["id_reservation"];
			$date_reserv = $r["date_reserv"];
			
			$id_client = $r["id_client"];
			$prenom = $r["prenom"];
			$nom = $r["nom"];
			$mail = $r["mail"];
			$tel_port = $r["tel_port"];
			$tel_fixe = $r["tel_fixe"];
			$indice_tel = get_indice($r["pays"]);
			
			$date_aller = $r["date_all"];
			$heure_aller = $r["heure_all"];
			$date_retour = $r["date_ret"];
			$heure_retour = $r["heure_ret"];
			$jour_aller = $r["jour_aller"];
			$jour_retour = $r["jour_retour"];
			
			$prix = $r["prix"];
			$nb_passagers = $r["nb_pers"];
			$estPaye = $r["est_paye"];
			$txt_paye = ($estPaye == 1) ? "Payé : ".$prix." €" : "Non payé";
			
			$lieu_aller = $r["type_lieu_aller"];
			$domicile_aller = $r["adresse_aller"];
			$lieu_retour = $r["type_lieu_retour"];
			$domicile_retour = $r["adresse_retour"];
			
			//Ecriture de la date si nouveau jour
			if($date_aller != $oldDate){
				$oldDate = $date_aller;
				switch($jour_aller){
					case 0:
						$day ="Dimanche ";
						break;
					case 1:
						$day ="Lundi ";
						break;
					case 2:
						$day ="Mardi ";
						break;
					case 3:
						$day ="Mercredi ";
						break;
					case 4:
						$day ="Jeudi ";
						break;
					case 5:
						$day ="Vendredi ";
						break;
					case 6:
						$day ="Samedi ";
						break;
				}
				?>
				<h3 style="text-align:center;"><?php echo $day."le ".$date_aller; ?></h3>
			 
				<?php
				}
				?>
				
						<div id="barre<?php echo $id_reserv; ?>"  
							<?php 	
								if($estPaye == 0){
									echo"style=\"background-color:#6DFFE1;font-size:0.9em;\"";
								}
								else 
								{
									echo"style=\"background-color:#0C3;font-size:0.8em;\"";
								}
							?>
						>
							<table id="tbl<?php echo $id_reserv; ?>" border="1" width="100%" cellpadding="1" style="font-family:Verdana, Geneva, sans-serif;">
								<tr>
									<th style="width:10%;"><?php echo $id_reserv; ?></th>
									<th style="width:60%;"><?php echo $date_aller." à ".$heure_aller." -> ".$date_retour." à ".$heure_retour; ?></th>
									<th style="width:20%;"><?php echo $txt_paye; ?></th>
									<th style="width:10%;"><?php echo $nb_passagers; ?> Passagers</th>
								</tr>
							</table>
						</div>
						<div width="100%">
							<table border="1" width="100%" >
								<tr>
									<th style="width:5%;">ID</th>
									<th style="width:15%;">Client</th>
									<th style="width:20%;">Aller</th>
									<th style="width:20%;">Retour</th>
									<th style="width:10%;">Date de la réservation</th>
								</tr>
								<tr style="text-align:center">
									<td><?php echo $id_client; ?></td>
									<td><a href="index.php?p=3&id=<?php echo $id_client; ?>"><?php echo $nom." ".$prenom; ?></a></td>
									<td>
									<?php 
										echo "Départ le ".$date_aller." à ".$heure_aller."<br />";
										echo "<b>".get_nom_lieu($lieu_aller)."</b>"; 
										// Si à domicile, on l'affiche
										if ($lieu_aller == 4){
											echo "<br />".$domicile_aller;
										}
									?>
									</td>
									<td>
									<?php 
										echo "Retour le ".$date_retour." à ".$heure_retour."<br />";
										echo "<b>".get_nom_lieu($lieu_retour)."</b>"; 
										// Si à domicile, on l'affiche
										if ($lieu_retour == 4){
											echo "<br />".$domicile_retour;
										}
									?>
									</td>
									<td><?php echo $date_reserv; ?></td>
								</tr>
							</table>
						</div>
						<br />
			  <?php
		}
	}
	?>
	
	
</div>