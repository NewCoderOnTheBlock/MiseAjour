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
			
			$nombre_trajet = 0;
			$chiffre_affaire_total = 0;
			$somme_totale_res = 0;
			$nombre_paypal = 0;
			$nombre_ca = 0;
			$nombre_autre = 0;
			$somme_nombre_passagers = 0;
			
			echo "<hr /><h1>Statistiques de ".$date_titre."</h1>";
			
			/* Nombre de trajets */
			$query = "	SELECT 	COUNT(DISTINCT vue_trajet.id) as nb_trajet
						FROM 	(	SELECT ligne.id_trajet as id
									FROM aeroport_reservation res, aeroport_ligne_resa ligne
									WHERE res.id_res = ligne.id_res
									AND ligne.est_paye = 1
									AND res.date LIKE '".$date_like."%'
								) as vue_trajet";

			$result = mysql_query($query) or die (mysql_error());

			while ($r = @mysql_fetch_assoc($result))
			{ 
				$nombre_trajet = $r['nb_trajet'];
			}
			
			/* Autres variables */
			$query = "	SELECT 	*, 
								SUM(ligne.prix) as somme_prix,
								SUM(ligne.nb_pers) as somme_pers,
								COUNT(ligne.id_res) as somme_total_res,
								(SELECT COUNT(ligne.id_res)
										FROM aeroport_reservation res, aeroport_ligne_resa ligne
										WHERE res.id_res = ligne.id_res
										AND ligne.est_paye = 1
										AND ligne.methode_paiement LIKE 'PayPal'
										AND res.date LIKE '".$date_like."%') as nombre_paypal,
										
								(SELECT COUNT(ligne.id_res)
										FROM aeroport_reservation res, aeroport_ligne_resa ligne
										WHERE res.id_res = ligne.id_res
										AND ligne.est_paye = 1
										AND ligne.methode_paiement LIKE 'e-transaction'
										AND res.date LIKE '".$date_like."%') as nombre_ca,
										
								(SELECT COUNT(ligne.id_res)
										FROM aeroport_reservation res, aeroport_ligne_resa ligne
										WHERE res.id_res = ligne.id_res
										AND ligne.est_paye = 1
										AND ligne.methode_paiement LIKE ''
										AND res.date LIKE '".$date_like."%') as nombre_autre
						FROM aeroport_reservation res, aeroport_ligne_resa ligne
						WHERE res.id_res = ligne.id_res
						AND ligne.est_paye = 1
						AND res.date LIKE '".$date_like."%'";

			$result = mysql_query($query) or die (mysql_error());

			while ($r = @mysql_fetch_assoc($result))
			{
				$nombre_paypal = $r['nombre_paypal'];
				$nombre_ca = $r['nombre_ca'];
				$nombre_autre = $r['nombre_autre'];
				$chiffre_affaire_total = $r['somme_prix'];
				$somme_totale_res = $r['somme_total_res'];
				$somme_nombre_passagers = $r['somme_pers'];
			}
			
			/*
				Affichage des informations
			*/
			
			echo "
				<table width='50%' align=center style='text-align:left;'>
					<tr>
						<td width='50%'>Chiffre d'affaire</td>
						<td width='50%' style='font-weight:bold'>".number_format($chiffre_affaire_total, 2, ',', ' ')." €</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>Nombre de trajets</td>
						<td style='font-weight:bold'>".$nombre_trajet."</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>Nombre de passagers</td>
						<td style='font-weight:bold'>".$somme_nombre_passagers."</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>Moyenne passagers par navette</td>
						<td style='font-weight:bold'>";
							if ($nombre_trajet > 0){
								echo number_format(($somme_nombre_passagers/$nombre_trajet), 2, ',', ' ');
							}else{
								echo 0;
							}						
						echo "</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>Nombre de paiements PayPal</td>
						<td>".$nombre_paypal."</span> [";
							if ($somme_totale_res > 0){
								echo number_format(($nombre_paypal/$somme_totale_res)*100, 2);
							}else{
								echo 0;
							}						
						echo "%]</td>
					</tr>
					<tr>
						<td>Nombre de paiements E-Transaction</td>
						<td>".$nombre_ca." [";
							if ($somme_totale_res > 0){
								echo number_format(($nombre_ca/$somme_totale_res)*100, 2);
							}else{
								echo 0;
							}						
						echo "%]</td>
					</tr>
					<tr>
						<td>Nombre de paiements \"Autre\"</td>
						<td>".$nombre_autre." [";
							if ($somme_totale_res > 0){
								echo number_format(($nombre_autre/$somme_totale_res)*100, 2);
							}else{
								echo 0;
							}						
						echo "%]</td>
					</tr>
					<tr>
						<th style='color:red;'>Nombre total de paiements</th>
						<th style='color:red;'>".$somme_totale_res."</th>
					</tr>
				</table>
			";
			
		}
	
	?>	
	
	</div>
	
</div>