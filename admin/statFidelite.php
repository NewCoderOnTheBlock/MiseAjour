<?php 
	require_once("verifAuth.php");
	require_once("../includes/fonctions.php");
	require_once("../libs/db.php");

?>

<div style="width:100%;text-align:center">
	<br /><br />
	
	<h1>Liste des clients ayant souscris au programme de fidelité</h1>
	
	<?php		
		$req = query("	SELECT *, DATE_FORMAT(date_souscription, '%d-%m-%Y %H:%i') as date_spt
						FROM aeroport_client c, aeroport_fidelite f
						WHERE c.id_client = f.id_client
						ORDER BY nom asc");
		
		echo "
		<div style='text-align:center;width:1100px;margin-left:auto;margin-right:auto'>
			<table style='padding: 3px; width: 1080px;' frame='all' rules='all'> 
				<tr>
					<th>Client</th>
					<th>Nombre de points</th>
					<th>Date de souscription</th>
				</tr>
		";
		
		while ($r = $req->fetch()){ 
		
			echo "
				<tr>
					<td>".$r['civilite']." ".$r['nom']." ".$r['prenom']."</td>
					<td>".$r['solde']." pts</td>
					<td>".$r['date_spt']."</td>
				</tr>
			
			";
		}
		
		echo "</table>
		</div>";
		
		$req->closeCursor();

	?>
</div>