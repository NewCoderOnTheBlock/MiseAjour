<!--
	KEMPF Pierre-Louis :
	Formulaire de la page genererBilanCA.php
-->

<?php 
	include("verifAuth.php");
	
	$listeMois = array("Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Décembre");
?>

<div style="width:100%;text-align:center">
	<h2>Génération d'un fichier Excel (.csv) de l'année complète</h2>
	
	<br />
	
	<form method="POST" action="genererBilanCA.php">
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
	
	<h2>Génération d'un fichier Excel (.csv) d'un mois</h2>
	
	<br />
	
	<form method="POST" action="genererBilanCA.php">
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
</div>