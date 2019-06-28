
<script type="text/javascript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>

<center>
  <h1>Compte rendu de mission</h1>
</center>
<br>
<br>
<br>
<script type="text/javascript">

var ds_i_date = new Date();

<?php 
	if(isset($_POST['date']))
	{
		$t_date = explode('-', $_POST['date']);

		if($_POST['type_cal'] == "jour")
		{
		?>
			ds_c_month = <?php echo $t_date[1]; ?>;
			ds_c_year = <?php echo $t_date[2]; ?>;
		<?php
		}
	}
	else
	{
	?>
		ds_c_month = ds_i_date.getMonth() + 1;
		ds_c_year = ds_i_date.getFullYear();
	<?php
	}
?>

</script>


<!-- DIV CONTENANT LE CALENDRIER -->
<table class="ds_box" cellpadding="0" cellspacing="0" id="ds_conclass" style="display: none;">
  <tr>
    <td id="ds_calclass"></td>
  </tr>
</table>
<form id="form1" name="form1" action="index2.php?p=1&action=2" method="post" >
  <!-- champ caché du formulaire contenant la date défini lors l'un clic sur un chiffre du calendrier -->
  <input id ="date" name="date" type="hidden" value="" />
  <input type="hidden" name="type_cal" id="type_cal" value="" />
</form>
<center><h1><?php echo $_POST['date']; ?> </h1></center>
<form action="" method="post">
	
	<input name="date" type="hidden" value="<?php echo $_POST['date']; ?>" />
	Trier par : <select name="trie" size="1">
    	<option value="id_chauffeur">Conducteur</option>
    	<option value="id_vehicule">Vehicule</option>
        <option value="id_lieu">Aeroport</option>
    </select>
    <input name="" type="submit" />
</form>
<br />
<br />
<?php 

	if($_GET['action']==2){
		$trie = $_POST['trie'];
		if ($trie == ""){
			$trie = "t.date ASC, g.id_chauffeur";
		}
		include("connection.php");
		//sélection des trajets par pair (aller + retour) d'après la table gestion_planning
		$query="SELECT g.id_com, g.id_lieu, g.id_chauffeur, g.id_vehicule FROM aeroport_gestion_planning g, aeroport_trajet t
				WHERE g.estComment = '0' AND t.id_trajet = g.id_trajet
				AND g.id_trajet in (SELECT id_trajet FROM aeroport_trajet
								  WHERE DATE_FORMAT(date, '%d-%m-%Y' ) ='".$_POST['date']."'
								  AND estValide = '1'
								  )
				ORDER BY ".$trie;
		
		$result = mysql_query($query) or die (mysql_error());
		 // tableau pour éviter les doublons
  		$com = array();
		while ($r = @mysql_fetch_assoc($result))
				
				{
					//on vérifie si id_com est déjà dans le tableau, pour éviter les doublons d'affichage
				if (!in_array($r["id_com"], $com)) {
						
						
					$com[] = $r["id_com"];
					
					
					// sélection du nom du chauffeur
					$query5 = "SELECT nom, prenom from chauffeur
					WHERE idchauffeur = '".$r["id_chauffeur"]."'";
					$result5 = mysql_query($query5) or die (mysql_error());
			
					$r5 = @mysql_fetch_assoc($result5);
					$prenomChauff = $r5["prenom"];
					$nomChauff = $r5["nom"];
					
					// sélection du libéllé du véhicule
					$query6 = "SELECT libelle from aeroport_vehicule
					WHERE id_vehicule = '".$r["id_vehicule"]."'";
					$result6 = mysql_query($query6) or die (mysql_error());
			
					$r6 = @mysql_fetch_assoc($result6);
					$libelle = $r6["libelle"];
					
					
					//sélection des info générales du trajet pour permettre au conducteur de choisir rapidement le trajet dont il veut faire le compte rendu
					$query2 = "SELECT *,DATE_FORMAT(aeroport_trajet.date, '%Hh%i') as heureDep  from aeroport_trajet
								WHERE id_trajet in (SELECT id_trajet from aeroport_gestion_planning where id_com = '".$r["id_com"]."')
								ORDER BY date";
					$result2 = mysql_query($query2) or die (mysql_error());
					//s'il n'y a qu'un résultat
					
					$r2 = @mysql_fetch_assoc($result2);
						$id_trajet = $r2["id_trajet"];
						$heureDep = $r2["heureDep"];
						$date = $r2["date"];
						$id_lieu_dest = $r2["id_lieu_dest"];
						
					$r2 = @mysql_fetch_assoc($result2);
						$id_trajet2 = $r2["id_trajet"];
						$heureDep2 = $r2["heureDep"];
						$date2 = $r2["date"];
						$id_lieu_dest2 = $r2["id_lieu_dest"];
						
					?>
					<div style="border: #000 1px solid;">
						<form action="index2.php?p=2" method="post" name="FormTrajet">
							<input name="idcm" type="hidden" value="<? echo $r['id_com']; ?>" />
							<?php
							
							echo "Prévu pour ".$prenomChauff." ".$nomChauff." avec ".$libelle."<br>"; 
							//si la destination n'est pas strasbourg ou pas de destination ( pour récupérer le nom de l'aeroport
							if($id_lieu_dest != 100 && $id_lieu_dest != ""){
								
								$query3 = "SELECT nom from aeroport_lieu
								WHERE id_lieu = '".$id_lieu_dest."'";
								$result3 = mysql_query($query3) or die (mysql_error());
						
								$r3 = @mysql_fetch_assoc($result3);
								
											
								if($heureDep!=""){
									echo $heureDep." - Départ de STRASBOURG";
									echo "<br />";
								}
								if($heureDep2!=""){
									echo $heureDep2." - Départ de ".strtoupper($r3["nom"]);
									echo "<br />";
								}
								else{
									echo "Vers ".strtoupper($r3["nom"]);
								}
							}
							else{
								$query3 = "SELECT nom from aeroport_lieu
								WHERE id_lieu = '".$r["id_lieu"]."'";
								$result3 = mysql_query($query3) or die (mysql_error());
						
								$r3 = @mysql_fetch_assoc($result3);
								
								if($heureDep2!=""){
									echo $heureDep2." - Départ de STRASBOURG";
									echo "<br />";
								}
								if($heureDep!=""){
									echo $heureDep." - Départ de ".strtoupper($r3["nom"]);
									echo "<br />";
								}
								
							}
							?>
							<br />
							<input name="" value="Choisir" type="submit" />
						</form>
					</div>
					<?php
				}
		}
			
			
				
	}

?>

<script src="scripts/calendar2.js" type="text/javascript"></script>
<script type="text/javascript">
	window.onload=ds_sh();
</script>
