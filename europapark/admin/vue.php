
<br /><br /><br />

<?php
	include("verifAuth.php");
	// Chargement des fonctions 
	
	function get_nom_lieu($id){
		
		$query = '	SELECT nom_lieu_fr
					FROM europa_lieu
					WHERE id_lieu = "'.$id.'"
				';
						
		$result = mysql_query($query) or die (mysql_error());
		
		$r = @mysql_fetch_assoc($result);
		
		$value = $r['nom_lieu_fr'];
		
		return $value;
	}
	
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
	
	function get_nb_passagers($id) {
		$query = '	SELECT IFNULL(SUM(r.nb_pers),0) AS nb_passagers
					FROM europa_ligne_reserv l JOIN europa_reservation r ON l.code_reserv = r.id_reservation 
					JOIN europa_trajet e ON l.code_trajet = e.id_trajet
					WHERE e.id_trajet = "'.$id.'"
					AND r.mode_paiement != "ATTENTE"
				';
						
		$result = mysql_query($query) or die (mysql_error());
		
		$r = @mysql_fetch_assoc($result);
		
		$value = $r['nb_passagers'];
		
		return $value;
	}
	
	function get_nb_attente($id) {
		$query = '	SELECT IFNULL(SUM(r.nb_pers),0) AS nb_passagers
					FROM europa_ligne_reserv l JOIN europa_reservation r ON l.code_reserv = r.id_reservation 
					JOIN europa_trajet e ON l.code_trajet = e.id_trajet
					WHERE e.id_trajet = "'.$id.'"
					AND r.mode_paiement = "ATTENTE"
				';
						
		$result = mysql_query($query) or die (mysql_error());
		
		$r = @mysql_fetch_assoc($result);
		
		$value = $r['nb_passagers'];
		
		return $value;
	}
?>

<script type="text/javascript">

var ds_i_date = new Date();

<?php

	if(isset($_GET['action']) && $_GET['action']=="2")
	{
		$t_date = explode('-', $_POST['date']);

		if($_POST['type_cal'] == "jour")
		{
	?>
		ds_c_month = <?php echo $t_date[1]; ?>;
		ds_c_year = <?php echo $t_date[2]; ?>;
	<?php
		}
		else
		{
		?>
			ds_c_month = <?php echo intval($t_date[0]); ?>;
			ds_c_year = <?php echo $t_date[1]; ?>;
		<?php
		}
	}
	else
	{
	?>
		ds_c_month = ds_i_date.getMonth() + 1;
		ds_c_year = ds_i_date.getFullYear();
	<?php
	}
?>
</script>

<div style="width:100%;text-align:center;">
	<!-- DIV CONTENANT LE CALENDRIER -->
	<div style="width:50%;float:left;">
        <table class="ds_box" cellpadding="0" cellspacing="0" id="ds_conclass" style="display: none;">
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
    
	<br />
	
    <div style="width:50%;float:left;text-align:center;">
        <table border="border-collapse:collapse">
			<tr>
                <th>Légende des couleurs</th>
            </tr>
            <tr>
                <td style="background-color:#6DFFE1">Demande non payée</td>
            </tr>
            <tr>
                <td style="background-color:#00CC33">Demande payée</td>
            </tr>
        </table>
    </div>
</div>

<div style="height:2px;clear:both;"></div>


<!-- FORMULAIRE ENVOYE LORS D'UN CLIC SUR UN CHIFFRE DU CALENDRIER (voir les 6 dernières ligne de calendar.js) -->
<form id="form1" name="form1" action="index.php?p=1&amp;action=2" method="post" >
<!-- champ caché du formulaire contenant la date défini lors l'un clic sur un chiffre du calendrier -->
<input id ="date" name="date" type="hidden" value="" />
<input type="hidden" name="type_cal" id="type_cal" value="" />
</form>
<br />
  <?php

// connexion à la bdd
include("connection.php");

	//SI L'UTILISATEUR N'A PAS CHOISI DE DATE DANS LE CALENDRIER
	if($_GET['action']==1){
		//il n'y aura pas de complément dans la requete
		$msg = " AND t.date_trajet >= NOW()";
	}
	//SI L'UTILISATEUR A CHOISI UNE DATE
	elseif($_GET['action']=="2"){
		//on récupère la date en question
		$date = $_POST['date'];
		$type_cal = $_POST['type_cal'];
		
		if($type_cal == "jour")
		{
			//et on complète la requète pour prendra la date en compte
			$msg = " AND (DATE_FORMAT(t.date_trajet, '%d-%m-%Y' ) ='".$date."')";
		}
		else
		{
			//et on complète la requète pour prendra la date en compte (seulement le mois
			$msg = " AND (DATE_FORMAT(t.date_trajet, '%m-%Y' ) ='".$date."')";
		}
	}
			  
	$query = "	SELECT *, r.nb_pers AS nb_pers_reservation,
					DATE_FORMAT(t.date_trajet, '%w' ) as jour_trajet,
					DATE_FORMAT(t.date_trajet, '%d-%m-%Y' ) as date_trajet,
					DATE_FORMAT(t.date_trajet, '%Hh%i' ) as heure_trajet,
					DATE_FORMAT(r.date, '%d-%m-%Y %Hh%i' ) as date_reserv
				FROM europa_reservation r,
					europa_client c, 
					europa_lieu l,
					europa_trajet t,
					europa_ligne_reserv ligne
				WHERE r.id_client = c.id_client
				AND ligne.code_reserv = r.id_reservation
				AND ligne.code_trajet = t.id_trajet 
				".$msg." 
				GROUP BY ligne.id_ligne
				ORDER BY t.date_trajet ASC";
				  
	$result = mysql_query($query) or die (mysql_error());
	
	$nbreq = mysql_num_rows($result);
	
	if(isset($_POST['type_cal']) && $_POST['type_cal'] != "jour")
	{
		$date = explode('-', $_POST['date']);

		$tab_mois = array("Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre");
		
	?>
		<h2 style="text-align:center;">Mois de <?php echo $tab_mois[intval($date[0])-1] . " " . intval($date[1]); ?></h2>
		<br />
	
	<?php
	}
	
	//teste de la présence de trajet à cette date
	if ($nbreq == "0"){
		echo "Il n'y a pas de réservation à cette date";
	}
	else
	{
		$oldDate = "";
		
		// id pour la modification du prix
		$id_affiche = 0;
		
		$id_prev_trajet = 0;
		$new_trajet = false;
		
		while ($r = @mysql_fetch_assoc($result))
		{		
			//récupération des données
			$id_reserv = $r["id_reservation"];
			
			$id_trajet = $r["id_trajet"];
			// Regroupement des trajets
			if ($id_prev_trajet != $id_trajet){
				$id_prev_trajet = $id_trajet;
				$new_trajet = true;
			}else{
				$new_trajet = false;
			}
			
			$service_reserv = $r["service"];
			
			$date_reserv = $r["date_reserv"];
			
			$id_client = $r["id_client"];
			$prenom = $r["prenom"];
			$nom = $r["nom"];
			$mail = $r["mail"];
			$tel_port = $r["tel_port"];
			$tel_fixe = $r["tel_fixe"];
			$indice_tel = get_indice($r["pays"]);
			
			$date_trajet = $r["date_trajet"];
			$heure_trajet = $r["heure_trajet"];
			$jour_trajet = $r["jour_trajet"];
			
			$prix = $r["prix"];
			$nb_passagers = get_nb_passagers($r['id_trajet']);
			$nb_attente = get_nb_attente($r['id_trajet']);
			$estPaye = $r["est_paye"];
			$txt_paye = ($estPaye == 1) ? "Payé : ".$prix." €" : "Non payé";
			
			$type_trajet = $r["type_trajet"];
			$lieu_trajet = ($type_trajet == "ALLER") ? $r["type_lieu_aller"] : $r["type_lieu_retour"];
			$domicile_trajet = $r["adresse"];
			
			//écriture de la date si nouveau jour
			if($date_trajet != $oldDate){
				$oldDate = $date_trajet;
				switch($jour_trajet){
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
                <h3 style="text-align:center;"><?php echo $day."le ".$date_trajet; ?></h3>
             
                <?php
				}
					if ($new_trajet){
				?>
                   	<!-- BARRE SUPERIEUR (résumé du trajet) -->
					<br />
					<div width="100%" id="barre<?php echo $id_reserv; ?>" style="border:solid black 1px;background-color:#0C3;font-size:12px;">

						<table class="table_info_reserv" id="tbl<?php echo $id_reserv; ?>" width="100%">
							<tr>
								<th style="width:10%;"><?php echo $id_trajet; ?></th>
								<th style="width:20%;"><?php echo $service_reserv; ?></th>
								<th style="width:25%;"><?php echo $type_trajet." : Départ le ".$date_trajet." à ".$heure_trajet.""; ?></th>
								<th style="width:25%;"><?php echo 'Capacité : '.$r['nb_pers'].' passagers'; ?></th>
								<th style="width:10%;"><?php echo $nb_passagers; ?> Passagers</th>
								<th style="width:10%;"><?php echo $nb_attente; ?> pers. en attente</th>
							</tr>
						</table>
					</div>
				<?php
					}
				?>
				
					<!-- Informations spécifiques à chaque client du trajet -->
					<div width="100%" class="div_info_trajet">
						<table class="table_info_trajet" width="100%">
							<tr>
								<th style="width:10%;background-color:#DDD;">ID</th>
								<th style="width:20%;background-color:#DDD;">Client</th>
								<th style="width:50%;background-color:#DDD;">Rassemblement</th>
								<th style="width:10%;background-color:#DDD;">Date de la réservation</th>
								<th style="width:10%;background-color:#DDD;">Nb personnes</th>
							</tr>
							<tr style="text-align:center">
								<td><?php echo $id_reserv; ?></td>
								<td><a href="index.php?p=3&id=<?php echo $id_client; ?>"><?php echo $nom." ".$prenom; ?></a></td>
								<td>
								<?php 
									echo "<b>".get_nom_lieu($lieu_trajet)."</b>";
									
									// Si à domicile, on l'affiche
									if ($lieu_trajet == 4){
										echo "<br />".$domicile_trajet;
									}
								?>
								</td>
								<td><?php echo $date_reserv."<br />(".$prix." € - ".$r['mode_paiement'].")"; ?></td>
								<td><?php echo $r['nb_pers_reservation']; ?></td>
							</tr>
						</table>
					</div>
					
					<br>
					<a href="liste_passagers.php?id_trajet=<?php echo $r['id_trajet']; ?>"><button value="Télécharger la liste des passagers"></a>
			  <?php
		}
	}
?>