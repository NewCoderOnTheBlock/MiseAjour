<?php
	include("verifAuth.php");
?>

<?php	
	
include("connection.php");
$idChauffeur = $_POST["idChauffeur"];
$numTrajet = $_POST["idTrajet"];
$idVehicule = $_POST["idVehicule"];


$query69 = "SELECT * FROM aeroport_vehicule l WHERE id_vehicule = ".$idVehicule;

$result69 = mysql_query($query69) or die (mysql_error());
$r69 = @mysql_fetch_assoc($result69);
$libelle_vehicule = $r69["libelle"];

$query_chauff = "select * from chauffeur where idchauffeur= ".$idChauffeur;
$result_chauff = mysql_query($query_chauff)or die(mysql_error());
$r21 = @mysql_fetch_assoc($result_chauff);
$nomChauffeur = $r21['nom']." ".$r21['prenom'];


$query = "UPDATE aeroport_trajet set id_chauffeur = '$idChauffeur', id_vehicule = '$idVehicule' where id_trajet = '$numTrajet'";
mysql_query($query)or die(mysql_error());

mysql_query("UPDATE aeroport_gestion_planning SET id_chauffeur = '" . $idChauffeur . "', id_vehicule = '" . $idVehicule . "' WHERE id_trajet = '" . $numTrajet . "'") or die(mysql_error());


$query_cherche_corr = "SELECT id_com FROM aeroport_gestion_planning WHERE id_trajet = '" . $numTrajet . "'";
			
$ret_cherche_corr = mysql_query($query_cherche_corr) or die(mysql_error());

$row_com = mysql_fetch_assoc($ret_cherche_corr);
$query_cherche_corr = "SELECT id_trajet FROM aeroport_gestion_planning WHERE id_com = '" . $row_com['id_com'] . "'";

$ret_cherche_corr = mysql_query($query_cherche_corr) or die(mysql_error());
	
if(mysql_num_rows($ret_cherche_corr) == 2)
{
	echo "ret_cherche_corr = 2 <br />";
	while($row = mysql_fetch_assoc($ret_cherche_corr))
	{
		if($row['id_trajet'] != $numTrajet)
		{
			echo "id_trajet != numTrajet <br />";
			mysql_query("UPDATE aeroport_gestion_planning SET id_chauffeur = '" . $idChauffeur . "', id_vehicule = '" . $idVehicule . "' WHERE id_trajet = '" . $row['id_trajet'] . "'") or die(mysql_error());
			mysql_query("UPDATE aeroport_trajet t, aeroport_gestion_planning g SET t.id_vehicule = g.id_vehicule, t.id_chauffeur = g.id_chauffeur WHERE t.id_trajet = g.id_trajet AND t.id_trajet = '" . $row['id_trajet'] . "'") or die(mysql_error());
			
			
			// on change la note de personne dans l'agenda
			$maj_agenda = mysql_query("SELECT estValide, id_note FROM aeroport_trajet WHERE id_trajet = '" . $row['id_trajet'] . "'") or die(mysql_error());
			$row_maj_agenda = mysql_fetch_assoc($maj_agenda);
			
			if($row_maj_agenda['estValide'] == 1)
			{
				$id_note = $row_maj_agenda['id_note'];
				echo "Update agenda";
				mysql_query("UPDATE agenda_agenda_concerne SET aco_util_id = '" . $idChauffeur . "' WHERE aco_age_id = '" . $id_note . "'") or die(mysql_error());
			}
		}
	}
}

/*
	KEMPF :
	Ajout suite à la demande de pouvoir modifier le chauffeur / vehicule n'importe quand
	On va vérifier si le trajet est valide.
	Si c'est le cas, il va falloir également modifier dans l'agenda
*/
$requete_trajet = mysql_query("	SELECT estValide, id_note, libelle
								FROM aeroport_trajet, aeroport_vehicule
								WHERE id_trajet = '" . $numTrajet . "'
								AND aeroport_trajet.id_vehicule = aeroport_vehicule.id_vehicule") or die(mysql_error());
$resultat_trajet = mysql_fetch_assoc($requete_trajet);
			
if($resultat_trajet['estValide'] == 1 && !empty($resultat_trajet['id_note'])){
	
	$id_note = $resultat_trajet['id_note'];
	$libelle_vehicule = $resultat_trajet['libelle'];
	
	/*
		On récupère les détails de la note de l'agenda 
		(C'est là où figure le nombre de la voiture utilisé, en texte brut)
		Il faut donc utiliser les RegEx pour modifier la partie du texte qui
		nous intéresse (Donc le nom de la voiture)
		
	*/
	$requete_agenda = mysql_query("SELECT age_detail FROM agenda_agenda WHERE age_id = '" . $id_note . "'") or die(mysql_error());
	$resultat_agenda = mysql_fetch_assoc($requete_agenda);
	
	$detail = $resultat_agenda['age_detail'];
	
	$nouveau_detail = preg_replace('/([^.]+Voiture : )([^.]+)(\n\nPRENDRE[^.]+)/', "$1 ".$libelle_vehicule." $3", $detail);
	
	// Puis on met à jour les deux tables selon les nouveaux parametres
	mysql_query("UPDATE agenda_agenda_concerne 
				SET aco_util_id = '" . $idChauffeur . "'
				WHERE aco_age_id = '" . $id_note . "'") or die(mysql_error());
				
	mysql_query("UPDATE agenda_agenda 
				SET age_detail = '" . $nouveau_detail . "'
				WHERE age_id = '" . $id_note . "'") or die(mysql_error());
	
}


?>
<script language="javascript" type="text/javascript">
<!--
	window.location.replace("index.php?p=1&action=1");
-->
</script>

