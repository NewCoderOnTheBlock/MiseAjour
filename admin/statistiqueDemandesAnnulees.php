<?php 
	require_once("verifAuth.php");
	require_once("../includes/fonctions.php");
	require_once("../libs/db.php");

?>

<div style="width:100%;text-align:center" id='div_demande'>
	<br /><br />
	
	<?php	

		function nombre_aeroport($id)
		{
			$c = mysql_connect('db922.1and1.fr', 'dbo206617947', 'D5ZEtV4h');
			mysql_select_db('db206617947');
			
			mysql_query("SET NAMES 'utf8'");
			mysql_query('SET CHARACTER SET utf8');
			$id = intval(trim($id));
			$req = "select *
			from aeroport_demande_annulee
						WHERE id_lieu_depart = '".$id."' OR id_lieu_dest = '".$id."'";
			
			$res = mysql_query($req);
			$nombre = mysql_num_rows($res);
			mysql_close($c); 
			return $nombre;
		}
		
		function nombre_pt_rassemblement($id)
		{
			$c = mysql_connect('db922.1and1.fr', 'dbo206617947', 'D5ZEtV4h');
			mysql_select_db('db206617947');
			
			mysql_query("SET NAMES 'utf8'");
			mysql_query('SET CHARACTER SET utf8');
			$id = intval(trim($id));
			$req = "select *
			from aeroport_demande_annulee
						WHERE pt_rass_aller = '".$id."' OR pt_rass_retour = '".$id."'";
			
			$res = mysql_query($req);
			$nombre = mysql_num_rows($res);
			mysql_close($c); 
			return $nombre;		
		}




		$req = query("select *, DATE_FORMAT(date, '%d/%m/%Y %Hh%i') as dateF
					from aeroport_demande_annulee
					order by date desc");
				
		echo "
		<div style='text-align:center;width:1200px;margin-left:auto;margin-right:auto'>
			<table style='padding: 3px; width: 1180px;' frame='all' rules='all'> 
				<tr>
					<th colspan=\"4\">Statistiques sur les points de rassemblements</th>
				</tr>
				<tr>
					<th>Palais des droits de l'homme</th>
					<th>Hotel Hilton</th>
					<th>Gare Centrale</th>
					<th>Domicile</th>
				</tr>
				<tr>
					<th>".nombre_pt_rassemblement(1)."</th>
					<th>".nombre_pt_rassemblement(2)."</th>
					<th>".nombre_pt_rassemblement(3)."</th>
					<th>".nombre_pt_rassemblement(4)."</th>
				</tr>
			</table>
		</div>
		<br />
		";
		
		echo "
		<div style='text-align:center;width:1200px;margin-left:auto;margin-right:auto'>
			<table style='padding: 3px; width: 1180px;' frame='all' rules='all'> 
				<tr>
					<th colspan=\"12\">Statistiques sur les aéroports choisis</th>
				</tr>
				<tr>
					<th>Bâle-Mulhouse</th>
					<th>Karslruhe</th>
					<th>Stuttgart</th>
					<th>Francfort Hahn</th>
					<th>Francfort Main</th>
					<th>Zurich</th>
					<th>Entzheim</th>
					<th>Sarrebruck</th>
					<th>Bruxelles</th>
					<th>Paris Orly</th>
					<th>Luxembourg</th>
					<th>Zweibrucken</th>
				</tr>
				<tr>
					<th>".nombre_aeroport(1)."</th>
					<th>".nombre_aeroport(2)."</th>
					<th>".nombre_aeroport(3)."</th>
					<th>".nombre_aeroport(4)."</th>
					<th>".nombre_aeroport(5)."</th>
					<th>".nombre_aeroport(6)."</th>
					<th>".nombre_aeroport(7)."</th>
					<th>".nombre_aeroport(8)."</th>
					<th>".nombre_aeroport(9)."</th>
					<th>".nombre_aeroport(10)."</th>
					<th>".nombre_aeroport(11)."</th>
					<th>".nombre_aeroport(12)."</th>

				</tr>
			</table>
		</div>";
		
		
echo "
		<br />
		<br />
		
		<div style='text-align:center;width:1200px;margin-left:auto;margin-right:auto'>
			<table style='padding: 3px; width: 1180px;' frame='all' rules='all'> 
				<tr>
					<th>Date</th>
					<th>Prospect</th>
					<th>Email</th>
					<th>Trajet</th>
					<th>Point de prise/dépose - Aller</th>
					<th>Point de prise/dépose - Retour</th>
					<th>Etape</th>
					<th>Prix</th>
				</tr>
		";
		
		while ($r = $req->fetch()){ 
			$trajet = "";
			$trajet .= ($r['estSimple'] == 1) ? "Aller" : "Aller-Retour";
			$trajet .= "<br />";
			$trajet .= get_lieu($r['id_lieu_depart']);
			$trajet .= ($r['estSimple'] == 1) ? " -> " : " <-> ";
			$trajet .= get_lieu($r['id_lieu_dest']);
			$pt_rass_aller = get_pt_rassemblement_par_id($r['pt_rass_aller']);
			$pt_rass_retour = get_pt_rassemblement_par_id($r['pt_rass_retour']);
			echo "
				<tr>
					<td>".$r['dateF']."</td>
					<td>".$r['nom']."</td>
					<td><a href=\"mailto:".$r['email']."\">".$r['email']."</a></td>
					<td>".$trajet."</td>
					<td>".$pt_rass_aller."</td>";
					if($r['estSimple'] == 1)
					{
						echo "<td></td>";
					}
					else
					{
						echo "<td>".$pt_rass_retour."</td>";
					}
					echo "<td>S'est arrêté à <br />[".$r['etape_arret']."]</td>
					<td>".$r['prix']." €</td>
				</tr>
			
			";
		}
		
		echo "</table>
		</div>";
		
		$req->closeCursor();

	?>
</div>