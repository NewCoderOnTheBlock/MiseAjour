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
	<h1>Modification des options : <?php echo strtoupper($table); ?></h1>
	<div>Attention à bien respecter le format des options<br/> (Notamment pour les horaires de nuit)<br /><br /></div>
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
						FROM aeroport_options
						WHERE libelle_option <> "--"';
			
			
			$result = mysql_query($query) or die ("La table spécifiée n'existe pas.");

			while ($r = @mysql_fetch_assoc($result))
			{	
				echo '
					<form method="post" action="modifer_option.php">
						<fieldset>
							<legend>'.$r['libelle_option'].'</legend>
						<table width="100%">
							<tr>
								<td>
									<input type="hidden" name="opt" value="'.$r['id_option'].'" />';
									
									// On met un textarea si la taille de l'option est trop longue pour un textfield
									if (strlen($r['val_option']) > 10){
										echo '<textarea cols="30" rows="3" name="val">'.$r['val_option'].'</textarea>';
									}else{
										echo '<input type="text" name="val" value="'.$r['val_option'].'" />';
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