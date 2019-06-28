<?php
	include("verifAuth.php");
    include("connection.php");
	
	/*
		KEMPF
		Permet la modification des options se trouvant 
		dans la BDD (aeroport_options)
	*/
?>

<div style="width:100%;text-align:center;">
	<h1>Modification des conditions générales de ventes : <?php echo strtoupper($table); ?></h1>
	<?php
		if (isset($_GET["msg"])){
			if ($_GET["msg"] == "1"){
				echo "<strong>Modification effectuée</strong><br /><br />";
			}else{
				echo "<strong>Erreur lors du traitement</strong><br /><br />";
			}
		}
	?>
	
	<table align="center">
		<tr>
			<td>
		<?php
			
			$query = '	SELECT *
						FROM aeroport_cgv
						WHERE libelle_cgv <> "--"';
			
			
			$result = mysql_query($query) or die ("La table spécifiée n'existe pas.");

			while ($r = @mysql_fetch_assoc($result))
			{	
				echo '
					<form method="post" action="modifier_conditions.php">
						<fieldset>
							<legend>'.$r['libelle_cgv'].'</legend>
						<table width="100%">
							<tr>
								<td>
									<input type="hidden" name="opt" value="'.$r['id_cgv'].'" />';
									
									// On met un textarea si la taille de l'option est trop longue pour un textfield
									if (strlen($r['val_cgv']) > 10){
										echo '<textarea cols="70" rows="10" name="val">'.$r['val_cgv'].'</textarea>';
									}else{
										echo '<input type="text" name="val" value="'.$r['val_cgv'].'" />';
									}
									
									echo '
								</td>
								<td style="text-align:right;"><input type="submit" name="bt_submit" value="Modifier" /></td>
							</tr>
						</table>
						</fieldset>
					</form>
					<br />
				';
			}
			
		?>
			</td>
		</tr>
	</table>
</div>