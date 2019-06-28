<?php
	include("verifAuth.php");
    include("connection.php");
	
	/*
		KEMPF
		Permet de gérer les différentes Q & A du site
	*/
?>

<div style="width:100%;text-align:center;">
	<h1>Gestion des questions / réponses</h1>
	<?php
		if (isset($_GET["msg"])){
			if ($_GET["msg"] == "1"){
				echo "<strong style='color:green;'>Modification effectuée</strong><br /><br />";
			}else{
				echo "<strong style='color:red;'>Erreur lors du traitement</strong><br /><br />";
			}
		}
	?>
	
	<table align="center">
		<tr>
			<td><h2>Modification</h2></td>
		</tr>
		<tr>
			<td>
		<?php
			
			$query = '	SELECT *
						FROM aeroport_faq
						ORDER BY langue_faq, id_faq';
			
			$result = mysql_query($query) or die ("La table spécifiée n'existe pas.");
			
			$count = 1;
			
			while ($r = @mysql_fetch_assoc($result))
			{	
				
				echo '
					<form method="post" action="modifer_faq.php">
						<input type="hidden" name="type_modif" value="update"/>
						<input type="hidden" name="id" value="'.$r['id_faq'].'"/>
						<fieldset>
							<legend>Question/Réponse n°'.$count.'</legend>
							<table width="100%">
								<tr>
									<td style="text-align:left;">
										Langue :
										<br />
										<select name="langue">
											<option value="fr" '.(($r['question_faq'] == "fr") ? "selected" : "").'>Francais</option>
											<option value="en" '.(($r['question_faq'] == "en") ? "selected" : "").'>Anglais</option>
										</select>
									</td>
								</tr>
								<tr>
									<td style="text-align:left;">
										Question :
										<br />
										<textarea cols="90" rows="2" name="question">'.htmlentities($r['question_faq']).'</textarea>
									</td>
								</tr>
								<tr>
									<td style="text-align:left;">
										Réponse :
										<br />
										<textarea cols="90" rows="4" name="reponse">'.$r['reponse_faq'].'</textarea>
									</td>
								</tr>
								</tr>
									<td style="text-align:right;">
										<input type="submit" name="bt_submit" value="Modifier" />
									</td>
								</tr>
							</table>
						</fieldset>
					</form>
					<br />
				';
				$count += 1;
			}
			
		?>
			</td>
		</tr>
		<tr>
			<th>&nbsp;</th>
		</tr>
		<tr>
			<td><h2>Ajout</h2></td>
		</tr>
		<tr>
			<td>
				<form method="post" action="modifer_faq.php">
					<input type="hidden" name="type_modif" value="ajout"/>
					<fieldset>
						<table width="100%">
							<tr>
								<td style="text-align:left;">
									Langue :
									<br />
									<select name="langue">
										<option value="fr">Francais</option>
										<option value="en">Anglais</option>
									</select>
								</td>
							</tr>
							<tr>
								<td style="text-align:left;">
									Question :
									<br />
									<textarea cols="90" rows="2" name="question"></textarea>
								</td>
							</tr>
							<tr>
								<td style="text-align:left;">
									Réponse :
									<br />
									<textarea cols="90" rows="4" name="reponse"></textarea>
								</td>
							</tr>
							</tr>
								<td style="text-align:right;">
									<input type="submit" name="bt_submit" value="Ajouter" />
								</td>
							</tr>
						</table>
					</fieldset>
				</form>
			</td>
		</tr>
	</table>
</div>