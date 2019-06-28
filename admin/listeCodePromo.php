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

<div style='text-align:center;width:1200px;margin-left:auto;margin-right:auto'>
	<br />
    <h2>Liste des codes promotions</h2>
    <br />
	
	<?php
		if(isset($_POST['id_promo']))
		{
			$sql = "DELETE FROM aeroport_code_promo WHERE id_promo='".$_POST['id_promo']."'";
			write($sql);
			echo "Le code promotionnel a été supprimé. <br />";
		}
	?>
	<table style='padding: 3px; width: 1180px;' frame='all' rules='all'>
		<tr>
			<th style="display:none;">
			</th>
			<th> Nom du code </th>
			<th>Date de début</th>
			<th>Date de fin</th>
			<th>Repetition</th>
			<th>Identifiant </th>
			<th>Effet</th>
			<th>Montant de l'effet</th>
			<th>Condition</th>
			<th>Supprimer</th>
			<th>Modifier</th>
		</tr>
		<?
		$requete = query("SELECT COUNT(*) FROM aeroport_code_promo");
		if ($requete->fetchColumn() > 0) {
				
		$requete = query("SELECT *
							FROM aeroport_code_promo
							");
		foreach ($requete as $row) {
					
		echo "	
		<tr>
			<form method=\"POST\" action=\"\">
			<td style=\"display:none;\"><input type=\"text\" value=\"".$row['id_promo']."\" name=\"id_promo\" style=\"display:none;\">".$row['id_promo']."</td>
			<td>".$row['nom_promo']."</td>
			<td>".$row['date_debut']."</td>
			<td>".$row['date_fin']."</td>";
			if($row['repetition'] == '1')
			{
				echo "<td>Oui</td>";
			}
			else
			{
				echo "<td>Non</td>";
			}
			if($row['identifiant'] == '1')
			{
				echo "<td>Oui</td>";
			}
			else
			{
				echo "<td>Non</td>";
			}
			echo "<td>".$row['effet']."</td>
			<td>".$row['montant']."</td>
			<td>".$row['condition']."</td>
			<td><input type=\"submit\" value=\"Supprimer le code\"></td>
			</form>
			<form method=\"POST\" action=\"http://alsace-navette.com/admin/index.php?p=256\">
			<td style=\"display:none;\"><input type=\"text\" value=\"".$row['id_promo']."\" name=\"id_promo\" style=\"display:none;\">".$row['id_promo']."</td>
			<td><input type=\"submit\" value=\"Modifier le code\"></td>
			</form>
		</tr>
	";
	}
	}
	?>
	</table>
</div>
				
		