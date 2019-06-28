<?php
	/*
		KEMPF : Génération manuelle d'une facture
	*/
	include("verifAuth.php");
	require_once(dirname(__FILE__)."/../libs/db.php");
    require_once(dirname(__FILE__)."/../includes/fonctions.php");
?>

<div style="width:100%; text-align:center">
	<br />
    <h2>Recherche d'une facture</h2>
    <br />
	
	<form action="" method="post" style="font-size:0.9em;">
		La recherche se fait en fonction de l'adresse e-mail du client
		<br />
		<br />
		<input type="text" name="email" id="inputEmail" />
		<input type="submit" value="Rechercher" />
		
	</form>

	<script type="text/javascript">
	<!--
		document.getElementById('inputEmail').focus(); 
	//-->
	</script>
	
	<?php
		/* Gestion des valeurs envoyées en POST et affichage des factures trouvées */
		
		if (!empty($_POST['email'])){
			
			$email = trim($_POST['email']);
			
			$requete = query("	SELECT COUNT(*) 
								FROM aeroport_facture
								WHERE email = '".$email."'");
			
			if ($requete->fetchColumn() > 0) {
				
				$requete = query("	SELECT *
									FROM aeroport_facture
									WHERE email = '".$email."'");
				
				echo "
					<br />
					<h3>Facture(s) trouvée(s)</h3>
					<table style='margin:auto;'>";
				
				foreach ($requete as $row) {
					
					echo "
						<tr>
							<td>".$row['civilite']." ".$row['nom']." ".$row['prenom']." : ".$row['prix_total']." € [".$row['date_res']."]</td>
							<td><strong>Lien : </strong><a href='http://alsace-navette.com/aeroport/gen_facture_aeroport.php?f=".sha1($row['id_facture'])."'>Facture n°".$row['id_facture']."</a></td>
								<td>
									<form method=\"post\" action=\"index.php?p=28\">
									<input type=\"hidden\" name=\"id_facture\" value=\"".$row['id_facture']."\">
									<input type=\"hidden\" name=\"civilite\" value=\"".$row['civilite']."\">
									<input type=\"hidden\" name=\"nom\" value=\"".$row['nom']."\">
									<input type=\"hidden\" id=\"prenom\" name=\"prenom\" value=\"".$row['prenom']."\">
									<input type=\"hidden\" name=\"email\" value=\"".$row['email']."\">
									<input type=\"hidden\" name=\"adresse_facturation\" value=\"\">
									<input type=\"hidden\" name=\"prix_base_aller\" value=\"".$row['prix_aller']."\">
									<input type=\"hidden\" name=\"date_aller\" value=\"".$row['date_aller']."\">
									<input type=\"hidden\" name=\"lieu_depart\" value=\"".$row['lieu_1_aller']."\">
									<input type=\"hidden\" name=\"lieu_destination\" value=\"".$row['lieu_2_aller']."\">
									<input type=\"hidden\" name=\"nombre_personnes\" value=\"".$row['nb_pers_aller']."\">
									<input type=\"hidden\" name=\"majoration_horaire_aller\" value=\"".$row['horaire_demande_aller']."\">
									<input type=\"hidden\" name=\"majoration_domicile_aller\" value=\"".$row['maj_dom_aller']."\">
									<input type=\"hidden\" name=\"horaires_nuit\" value=\"".$row['nuit_aller']."\">
									";if($row['date_retour'] == '' || $row['date_retour'] == '//'  || $row['date_retour'] == '00-00-0000') {
									$estretour = false;
									echo "<input type=\"hidden\" name=\"est_retour\" value=\"0\"\">";
									}
									else {
									$estretour = false;
									$estretour = true;
									echo "<input type=\"hidden\" name=\"est_retour\" value=\"1\"\">";
									}
									if ($estretour) {
									echo "<input type=\"hidden\" name=\"prix_base_retour\" value=\"".$row['prix_retour']."\">
									<input type=\"hidden\" name=\"date_retour\" value=\"".$row['date_retour']."\">
									<input type=\"hidden\" name=\"nombre_personne_retour\" value=\"".$row['nb_pers_retour']."\">
									<input type=\"hidden\" name=\"majoration_horaire_retour\" value=\"".$row['horaire_demande_retour']."\">
									<input type=\"hidden\" name=\"majoration_domicile_retour\" value=\"".$row['maj_dom_retour']."\">
									<input type=\"hidden\" name=\"horaires_nuit_retour\" value=\"".$row['nuit_retour']."\">";
									}
									echo "<input type=\"hidden\" name=\"dernière_minute\" value=\"".$row['res_der_min']."\">
									<input type=\"hidden\" name=\"langue\" value=\"".$row['lang']."\">
									<input type=\"hidden\" name=\"prix_total\" value=\"".$row['prix_total']."\">
									<input type=\"hidden\" name=\"attente_aeroport\" value=\"".$row['supplement_attente']."\">

									
									<input type=\"submit\" value=\"Modifier la facture\"/>
									</form></td>
						</tr>";
					
				}
					
				echo "</table>";
				
			}
			
		}		

	?>
</div>