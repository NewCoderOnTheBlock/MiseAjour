<?php 
	require_once("verifAuth.php");
	require_once("../includes/fonctions.php");
	require_once("../libs/db.php");
	
	$listeMois = array("Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Décembre");
?>

<div style="width:100%;text-align:center">
	<h2>Total horaire d'un conducteur</h2>
	
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
		
		<label for="conducteur">Saisissez conducteur :</label>
		<select name="conducteur" >
			<?php
			$req = query("	SELECT * 
							FROM chauffeur 
							WHERE idchauffeur != 0 
							AND idchauffeur NOT IN (SELECT id_chauffeur 
													FROM aeroport_conducteurs_exclus)
							ORDER BY idchauffeur ASC");
													
			while($r = $req->fetch()){
				
				echo "<option value='".$r['idchauffeur']."'>".$r['nom']." ".$r['prenom']."</option>";
				
			}
			$req->closeCursor();
			?>
		</select>
		
		<br />
		
		<input type="submit" />
	</form>
	
	<?php
	if (isset($_POST['conducteur'])){
		$id_conducteur = $_POST['conducteur'];
		$mois = sprintf("%02d", $_POST['mois']);
		$annee = $_POST['annee'];
		$somme_duree = 0;
		
		$req = query("	SELECT 	trajet.id_trajet as id_trajet,
								lieu.duree as duree,
								conducteur.nom as nom_c,
								conducteur.prenom as prenom_c,
								DATE_FORMAT(trajet.date, '%d-%m-%Y %H:%i') as date_trajet,
								lieu.nom as libelle_lieu
						FROM 	aeroport_lieu lieu,
								aeroport_trajet trajet,
								agenda_agenda agenda,
								agenda_agenda_concerne concerne,
								chauffeur conducteur
						WHERE ((lieu.id_lieu = trajet.id_lieu_depart AND trajet.id_lieu_dest = 100) OR (lieu.id_lieu = trajet.id_lieu_dest AND trajet.id_lieu_depart = 100)) 
						AND trajet.id_trajet = agenda.id_trajet
						AND agenda.age_id = concerne.aco_age_id
						AND concerne.aco_util_id = conducteur.idchauffeur
						AND concerne.aco_util_id = '".$id_conducteur."'
						AND DATE_FORMAT(trajet.date, '%m') = '".$mois."'
						AND DATE_FORMAT(trajet.date, '%Y') = '".$annee."'
						ORDER BY trajet.date ASC");
		
		$r = $req->fetch();
		
		if (isset($r['date_trajet'])){
		
			echo "Horaires de ".$r['nom_c']." ".$r['prenom_c']."<br /><br />";
			
			do{ 
				echo $r['libelle_lieu']." -> ".$r['date_trajet']."<br />";
				$somme_duree += $r['duree'];
			}while($r = $req->fetch());
		
		}
		
		$req->closeCursor();
		
		// Horaires spécial Royal-Palace et autres
		$req = query("	SELECT 	trajet.id_trajet as id_trajet,
								DATE_FORMAT(trajet.date_trajet, '%d-%m-%Y %H:%i') as date_trajet,
								trajet.service_trajet as libelle_lieu
						FROM 	europa_trajet trajet,
								agenda_agenda agenda,
								agenda_agenda_concerne concerne
						WHERE  	agenda.id_trajet < 7600
						AND trajet.id_trajet = agenda.id_trajet
						AND agenda.age_id = concerne.aco_age_id
						AND concerne.aco_util_id = '".$id_conducteur."'
						AND DATE_FORMAT(trajet.date_trajet, '%m') = '".$mois."'
						AND DATE_FORMAT(trajet.date_trajet, '%Y') = '".$annee."'
						ORDER BY trajet.date_trajet ASC");
		
		$r = $req->fetch();	
		
		if (isset($r['date_trajet'])){
		
			echo "<br />";
			do{ 
				echo $r['libelle_lieu']." -> ".$r['date_trajet']."<br />";
				$somme_duree += 2700;
			}while($r = $req->fetch());
			
		}
		
		$req->closeCursor();
		
		
		echo "<br /><strong>Somme totale en heure : ".($somme_duree/3600)."</strong>";
		
	}
	?>
</div>