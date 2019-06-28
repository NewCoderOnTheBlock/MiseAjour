<?php 
	include("verifAuth.php");
	// connexion à la bdd
	include("connection.php");
	
	$listeMois = array("Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Décembre");
?>

<div style="width:100%;text-align:center">
	<h2>Statistiques par année</h2>
	
	<br />
	
	<form method="POST" action="">
		<label for="annee">Saisissez une année :</label>
		<select name="annee" />
			<?php
			$act_date = intval(date('Y'));
			for($i=2009;$i<=$act_date;$i++){
				$bonus = ($i == $act_date) ? "selected" : "";
				echo '<option value="'.$i.'" '.$bonus.'>'.$i.'</option>';
			}
			?>
		</select>
		<br />
		<input type="submit" />
	</form>
	
	<br />
	
	<h2>Statistiques par mois</h2>
	
	<br />
	
	<form method="POST" action="">
		<label for="mois">Saisissez un mois :</label>
		<select name="mois" >
			<?php
			for($i=1;$i<=12;$i++){
				echo '<option value="'.$i.'">'.$listeMois[$i-1].'</option>';
			}
			?>
		</select>
		
		<br />
		
		<label for="annee">Saisissez une année :</label>
		<select name="annee" >
			<?php
			$act_date = intval(date('Y'));
			for($i=2009;$i<=$act_date;$i++){
				$bonus = ($i == $act_date) ? "selected" : "";
				echo '<option value="'.$i.'" '.$bonus.'>'.$i.'</option>';
			}
			?>
		</select>
		<br />
		<input type="submit" />
	</form>
	
	<div>
	
	<?php
	
		if (isset($_POST['annee'])){
			
			$annee = $_POST['annee'];
			
			$date_like = (isset($_POST['mois'])) ? date("Y-m", mktime(0, 0, 0, $_POST['mois'], 1, $annee)) : date("Y", mktime(0, 0, 0, 1, 1, $annee));
			
			$date_titre = (isset($_POST['mois'])) ? $listeMois[$_POST['mois']-1]." ".$annee : $annee;
			
			echo "<hr /><h1>Statistiques de ".$date_titre."</h1>";

			/* 
				Stat' lieu de départ
			*/
				// Nombre total
			$query = "	SELECT 	*,
								COUNT(ligne.id_pt_rass) as nb_lieu_depart
									
						FROM aeroport_reservation res, aeroport_ligne_resa ligne, aeroport_trajet trajet
						WHERE res.id_res = ligne.id_res
						AND trajet.id_trajet = ligne.id_trajet
						AND ligne.est_paye = 1
						AND trajet.id_lieu_depart <> 100
						AND res.date LIKE '".$date_like."%'";
						
			$result = mysql_query($query) or die (mysql_error());			
			while ($r = @mysql_fetch_assoc($result))
			{
				$somme_trajets_depart = $r["nb_lieu_depart"];
			}
			
				// Nombres spécifiques aux aéroports
			$query = "	SELECT 	*,
								COUNT(ligne.id_pt_rass) as nb_lieu_depart
									
						FROM aeroport_reservation res, aeroport_ligne_resa ligne, aeroport_rassemblement rassemblement, aeroport_trajet trajet
						WHERE res.id_res = ligne.id_res
						AND trajet.id_trajet = ligne.id_trajet
						AND ligne.id_pt_rass = rassemblement.id_pt
						AND ligne.est_paye = 1
						AND trajet.id_lieu_depart <> 100
						AND res.date LIKE '".$date_like."%'
						GROUP BY ligne.id_pt_rass
						ORDER BY rassemblement.fr DESC";

			$result = mysql_query($query) or die (mysql_error());
			
			echo "
				<h2>Point de dépose (Aéroport -> Strasbourg)</h2>
				<table width='50%' align=center style='text-align:left;'>
					<tr>
						<th width='50%' style='text-align:right'>Rassemblement</th>
						<th width='50%' style='text-align:center'>Nombre</th>
					</tr>";
			
			while ($r = @mysql_fetch_assoc($result))
			{
				echo "
					<tr>
						<td style='text-align:right;'>".$r['fr']."</td>
						<td style='text-align:center;'>".$r['nb_lieu_depart']." [".number_format(($r['nb_lieu_depart']/$somme_trajets_depart*100), 2)."%]</td>
					</tr>";
			}
			
			echo "
					<tr>
						<th style='text-align:right;color:red;'>Total</th>
						<th style='text-align:center;color:red;'>".$somme_trajets_depart."</th>
					</tr>
					
				</table>";
			
			/* 
				Stat' lieu de destination
			*/
				// Nombre total
			$query = "	SELECT 	*,
								COUNT(ligne.id_pt_rass) as nb_lieu_dest
									
						FROM aeroport_reservation res, aeroport_ligne_resa ligne, aeroport_trajet trajet
						WHERE res.id_res = ligne.id_res
						AND trajet.id_trajet = ligne.id_trajet
						AND ligne.est_paye = 1
						AND trajet.id_lieu_dest <> 100
						AND res.date LIKE '".$date_like."%'";
						
			$result = mysql_query($query) or die (mysql_error());			
			while ($r = @mysql_fetch_assoc($result))
			{
				$somme_trajets_dest = $r["nb_lieu_dest"];
			}
			
				// Nombres spécifiques aux aéroports
			$query = "	SELECT 	*,
								COUNT(ligne.id_pt_rass) as nb_lieu_dest
									
						FROM aeroport_reservation res, aeroport_ligne_resa ligne, aeroport_rassemblement rassemblement, aeroport_trajet trajet
						WHERE res.id_res = ligne.id_res
						AND trajet.id_trajet = ligne.id_trajet
						AND ligne.id_pt_rass = rassemblement.id_pt
						AND ligne.est_paye = 1
						AND trajet.id_lieu_dest <> 100
						AND res.date LIKE '".$date_like."%'
						GROUP BY ligne.id_pt_rass
						ORDER BY rassemblement.fr DESC";

			$result = mysql_query($query) or die (mysql_error());
			
			echo "
				<br />
				<h2>Point de prise (Strasbourg -> Aéroport)</h2>
				<table width='50%' align=center style='text-align:left;'>
					<tr>
						<th width='50%' style='text-align:right'>Rassemblement</th>
						<th width='50%' style='text-align:center'>Nombre</th>
					</tr>";
			
			while ($r = @mysql_fetch_assoc($result))
			{
				echo "
					<tr>
						<td style='text-align:right;'>".$r['fr']."</td>
						<td style='text-align:center;'>".$r['nb_lieu_dest']." [".number_format(($r['nb_lieu_dest']/$somme_trajets_dest*100), 2)."%]</td>
					</tr>";
			}
			echo "
					<tr>
						<th style='text-align:right;color:red;'>Total</th>
						<th style='text-align:center;color:red;'>".$somme_trajets_dest."</th>
					</tr>
					
				</table>";
			
		}
	
	?>	
	
	</div>
	
</div>