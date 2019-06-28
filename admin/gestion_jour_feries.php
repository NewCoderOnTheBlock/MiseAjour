<?php
	include("verifAuth.php");
    include("connection.php");
	
	/*
		KEMPF
		Permet l'ajout et la suppression des jours majorés
	*/
	
	if (isset($_POST['action'])){
	
		if ($_POST['action'] == 'supprimer'){
			
			$query = '	DELETE FROM aeroport_jour_majore
							WHERE id_majoration = "'.$_POST['id_majoration'].'"';
		
		
			$result = mysql_query($query) or die ("Erreur sur la requete.");
			
		}else if ($_POST['action'] == 'ajouter'){
			
			if (!empty($_POST['montant_m']) && !empty($_POST['libelle_fr_m']) && !empty($_POST['libelle_en_m'])){
			
				$debut_m = $_POST['annee_debut_m']."-".$_POST['mois_debut_m']."-".$_POST['jour_debut_m']." ".$_POST['heure_debut_m'].":".$_POST['minute_debut_m'].":00";
				$fin_m = $_POST['annee_fin_m']."-".$_POST['mois_fin_m']."-".$_POST['jour_fin_m']." ".$_POST['heure_fin_m'].":".$_POST['minute_fin_m'].":00";
				
				$query = '	INSERT INTO aeroport_jour_majore (debut_majoration, fin_majoration, montant_majoration, libelle_fr_majoration, libelle_en_majoration)
								VALUES ("'.$debut_m.'",
										"'.$fin_m.'",
										"'.$_POST['montant_m'].'",
										"'.$_POST['libelle_fr_m'].'",
										"'.$_POST['libelle_en_m'].'"
										)';
		
				$result = mysql_query($query) or die ("Erreur sur la requete.");
				
			}
			
		}
		
	}
	
?>

<div style="width:100%;text-align:center;">
	<h1>Modification des jours majorés</h1>
	
	<table align="center">
	<?php
		
		$query = '	SELECT *,
							DATE_FORMAT(debut_majoration, "%d-%m-%Y %Hh%i") as debut_m,
							DATE_FORMAT(fin_majoration, "%d-%m-%Y %Hh%i") as fin_m
					FROM aeroport_jour_majore
					ORDER BY debut_majoration ASC';
		
		
		$result = mysql_query($query) or die ("Erreur sur la requete.");

		while ($r = @mysql_fetch_assoc($result))
		{	
			echo '
				<tr>
					<td>
						<form method="post" action="">
							<input type="hidden" name="id_majoration" value="'.$r['id_majoration'].'" />
							<input type="hidden" name="action" value="supprimer" />
							'.$r['debut_m'].' -> '.$r['fin_m'].' : '.$r['libelle_fr_majoration'].' / '.$r['libelle_en_majoration'].' [ '.$r['montant_majoration'].' € ] 
							<input type="submit" value="Supprimer" />
						</form>
					</td>
				</tr>
			';
		}
		
	?>
	</table>
	
	<h1>Ajout d'un jour majoré</h1>
	
	<table align="center">
		<tr>
			<td style="text-align:left;">
				<form method="post" action="">
					<input type="hidden" name="action" value="ajouter" />
					
					Date début : 
					<select name="jour_debut_m" >
						<?php
							for ($i=1;$i<=31;$i++){
								echo "<option value='".sprintf("%1$02d", $i)."'>".sprintf("%1$02d", $i)."</option>";
							}
						?>
					</select>
					<select name="mois_debut_m" >
						<?php
							for ($i=1;$i<=12;$i++){
								echo "<option value='".sprintf("%1$02d", $i)."'>".sprintf("%1$02d", $i)."</option>";
							}
						?>
					</select>
					<select name="annee_debut_m" >
						<?php
							for ($i=date("Y");$i<=(date("Y")+2);$i++){
								echo "<option value='".$i."'>".$i."</option>";
							}
						?>
					</select>
					
					 à 
					 
					<select name="heure_debut_m" >
						<?php
							for ($i=0;$i<=23;$i++){
								echo "<option value='".sprintf("%1$02d", $i)."'>".sprintf("%1$02d", $i)."</option>";
							}
						?>
					</select>
					<select name="minute_debut_m" >
						<?php
							for ($i=0;$i<=55;$i=$i+5){
								echo "<option value='".sprintf("%1$02d", $i)."'>".sprintf("%1$02d", $i)."</option>";
							}
						?>
					</select>
					
					<br /><br />
					
					Date fin : 
					<select name="jour_fin_m" >
						<?php
							for ($i=1;$i<=31;$i++){
								echo "<option value='".sprintf("%1$02d", $i)."'>".sprintf("%1$02d", $i)."</option>";
							}
						?>
					</select>
					<select name="mois_fin_m" >
						<?php
							for ($i=1;$i<=12;$i++){
								echo "<option value='".sprintf("%1$02d", $i)."'>".sprintf("%1$02d", $i)."</option>";
							}
						?>
					</select>
					<select name="annee_fin_m" >
						<?php
							for ($i=date("Y");$i<=(date("Y")+2);$i++){
								echo "<option value='".$i."'>".$i."</option>";
							}
						?>
					</select>
					
					 à 
					 
					<select name="heure_fin_m" >
						<?php
							for ($i=0;$i<=23;$i++){
								echo "<option value='".sprintf("%1$02d", $i)."'>".sprintf("%1$02d", $i)."</option>";
							}
						?>
					</select>
					<select name="minute_fin_m" >
						<?php
							for ($i=0;$i<=55;$i=$i+5){
								echo "<option value='".sprintf("%1$02d", $i)."'>".sprintf("%1$02d", $i)."</option>";
							}
						?>
					</select>
					
					<br /><br />
					
					Montant : 
					<input type="text" name="montant_m" size="4" /> €
					
					<br /><br />
					
					Libellé (Français) : 
					<input type="text" name="libelle_fr_m" />
					
					<br /><br />
					
					Libellé (Anglais) : 
					<input type="text" name="libelle_en_m" />
					
					<br /><br />
					<input type="submit" value="Ajouter" />
				</form>
			</td>
		</tr>
	</table>
</div>