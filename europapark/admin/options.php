<?php 
	include("verifAuth.php");
	// connexion à la bdd
	include("connection.php");
	if (!isset($_GET['t'])){
		echo "Merci de spécifier une table valide.";
		exit;
	}else{
		$table = $_GET['t'];
	}
?>
<br /><br />

<div style="width:100%;text-align:center;">
	<?php
		// Si un message est spécifié dans l'URL
		if (isset($_GET['msg'])){
			$msg = ($_GET['msg'] == 1) ? "Modification effectuée avec succès." : "Erreur lors de la modification";
			echo $msg;
		}
	?>
	<h1>Modification des options : <?php echo strtoupper($table); ?></h1>
	<table align="center">
		<tr>
			<td>
		<?php
			
			$query = '	SELECT *
						FROM '.$table.'_option';
			
			
			$result = mysql_query($query) or die ("La table spécifiée n'existe pas.");

			while ($r = @mysql_fetch_assoc($result))
			{	
				echo '
					<form method="post" action="modify_option.php">
						<fieldset>
							<legend>'.$r['libelle_option'].'</legend>
						<table>
							<tr>
								<td>
									<input type="hidden" name="opt" value="'.$r['id_option'].'" />
									<input type="hidden" name="table" value="'.$table.'" />
									<input type="text" name="val" value="'.$r['valeur_option'].'" />
								</td>
								<td><input type="submit" name="bt_submit" value="Modifier" /></td>
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
		<tr>
			<td>		
		<?php
			
			$query = '	SELECT *
						FROM '.$table.'_outlet';
			
			
			$result = mysql_query($query) or die ("La table spécifiée n'existe pas.");

			while ($r = @mysql_fetch_assoc($result))
			{	
				echo '
					<form method="post" action="modify_option.php">
						<fieldset>
							<legend>'.$r['libelle_outlet'].'</legend>
						<table>
							<tr>
								<td>
									<input type="hidden" name="opt" value="'.$r['id_outlet'].'" />
									<input type="hidden" name="table" value="'.$table.'" />
									<input type="hidden" name="outlet" value="outlet" />
									<input type="text" name="val" value="'.$r['tarif_outlet'].'" />
								</td>
								<td><input type="submit" name="bt_submit" value="Modifier" /></td>
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