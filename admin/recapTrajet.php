<?php 
// include("verifAuth.php");

function execution($req)
{	
	if($_SERVER["SERVER_ADDR"]=="192.168.3.2") // si localhost
	{
		$c = mysql_connect('localhost', 'root', '');
		mysql_select_db('a-n');
	}
	else
	{
		$c = mysql_connect('db922.1and1.fr', 'dbo206617947', 'D5ZEtV4h');
		mysql_select_db('db206617947');
	}
	
	mysql_query("SET NAMES 'utf8'");
	mysql_query('SET CHARACTER SET utf8');
	
	date_default_timezone_set ('Europe/Paris') ;
	 
	$res = mysql_query($req,$c);
	mysql_close($c);
	return $res;
}
?>

<br />
<form><!-- création d'un form juste pour le bouton reset -->
	<fieldset style='width:1300px;margin-left:auto;margin-right:auto;text-align:center;padding:20px;font-family:Arial,Verdana;font-size:11pt'>
		<legend id='lgdConducteur'>Compte rendu de mission pour le <span style='color:red;'><?php echo $_SESSION['date']; ?></span></legend>
		<?php 
			/*** Création de la liste des conducteurs **/
			$conducteur = '';
			$sqlConducteur = 'select * from chauffeur order by nom';
			$resConducteur = execution($sqlConducteur);
			while($lConducteur = mysql_fetch_array($resConducteur))
			{
				$conducteur.="<option value='".$lConducteur['idchauffeur']."'>".strtoupper($lConducteur['nom'])." ".ucfirst($lConducteur['prenom'])."</option>";
			}
			
			/*** Création de la liste des véhicules **/
			$vehicule = '';
			$sqlVehicule = 'select * from aeroport_vehicule order by libelle';
			$resVehicule = execution($sqlVehicule);
			while($lVehicule = mysql_fetch_array($resVehicule))
			{
				$vehicule.="<option value='".$lVehicule['id_vehicule']."'>".ucfirst($lVehicule['libelle'])."</option>";
			}
			
			/*** Création d'une lise allant de 0 à 8 **/
			$lstPlace8 = '';
			for($i=0;$i<=8;$i++)
			{
				$lstPlace8 .= "<option value='".$i."'>".$i."</option>";
			}
			
			/*** Création d'une lise allant de 0 à 9 **/
			$lstPlace9 = '';
			for($i=0;$i<=9;$i++)
			{
				$lstPlace9 .= "<option value='".$i."'>".$i."</option>";
			}
			
			/*** Création d'une lise allant de 0 à 10 **/
			$lstPlace10 = '';
			for($i=0;$i<=10;$i++)
			{
				$lstPlace10 .= "<option value='".$i."'>".$i."</option>";
			}
		?>
		<label for='txtConducteur' class='lblForm'>Conducteur : </label><select id='txtConducteur' class='txtForm'><?php echo $conducteur; ?></select>
		<br /><br />
		<label for='txtVehicule' class='lblForm'>Véhicule : </label><select id='txtVehicule' class='txtForm'><?php echo $vehicule; ?></select>
		<br /><br />
		
		<!-- GESTION DE L'ALLER -->
		<div style='float:left;width:635px;margin-right:40px;margin-bottom:20px'>
			<!-- GESTION DES PASSAGER POUR UN TRAJET ALLER -->
			<fieldset style='width:635px;margin-right:40px;margin-bottom:20px;'>
				<legend id='lgdConducteur'>Passager : <span style='color:red'>Trajet Aller</span></legend>
				<br />
				<label for='txtMontantPaye_aller' class='lblFormLong'>Montant payé au conducteur (en liquide) : </label><input type='text' id='txtMontantPaye_aller' class='txtForm' value='0' onfocus='this.value=""' onblur='if(this.value==""){this.value="0"}' />€
				<br /><br />
				<label for='txtPassagerReserve_aller' class='lblFormLong'>Passagers ayant réservés : </label><select id='txtPassagerReserve_aller' class='txtForm'><?php echo $lstPlace8; ?></select>
				<br /><br />
				<label for='txtPassagerNonReserve_aller' class='lblFormLong'>Passagers n'ayant pas réservés : </label><select id='txtPassagerNonReserve_aller' class='txtForm'><?php echo $lstPlace8; ?></select>
				<br /><br />
				<label for='txtNbGroupe_aller' class='lblFormLong'>Nombre de groupe : </label><select id='txtNbGroupe_aller' class='txtForm'><?php echo $lstPlace10; ?></select>
				<br /><br />
				<label class='lblFormLong' for='txtPassagerDomicile_aller'>Prise à domicile : </label><select id='txtPassagerDomicile_aller' class='txtForm'><?php echo $lstPlace8; ?></select>
				<br /><br />
				<label class='lblFormLong' for='txtPassagerPtRdv_aller'>Prise au point de rendez-vous : </label><select id='txtPassagerPtRdv_aller' class='txtForm'><?php echo $lstPlace8; ?></select>
			</fieldset>
			<!-- GESTION GENERALE POUR UN TRAJET ALLER -->
			<fieldset style='width:635px;text-align:left;'>
				<legend id='lgdConducteur'>Général : <span style='color:red'>Trajet Aller</span></legend>
				<h4 style='text-align:left;margin-bottom:0'>Départ</h4>
				<input type='radio' onclick='document.getElementById("hdDepart_aller").value="1"' checked='checked' name='radioDepartNavette_aller' id='txtDepartStrasbourg_aller' value='strasbourg_aller' onchange='modificationDepartAller("1_aller")' /><label for='txtDepartStrasbourg_aller'>Je venais de Strasbourg</label>
				<br />
				<input type='radio' onclick='document.getElementById("hdDepart_aller").value="2"' name='radioDepartNavette_aller' id='txtDepartCetAeroport_aller' value='cetAeroport_aller' onchange='modificationDepartAller("2_aller")' /><label for='txtDepartCetAeroport_aller'>J'étais déjà à cet aéroport</label>
				<br />
				<input type='radio' onclick='document.getElementById("hdDepart_aller").value="3"' name='radioDepartNavette_aller' id='autreAeroport_aller' value='autreAeroport_aller' onchange='modificationDepartAller("3_aller")' /><label for='autreAeroport_aller'>Je venais d'un autre aéroport</label>
				<input type='hidden' id='hdDepart_aller' value='1' />
				<br /><br />
				<div id='1_aller'>
					<label for='txtHeureDepart_aller' class='lblFormLong'>Heure de départ : </label>
					<select id='txtHeureDepart_aller' class='txtForm' style='width:40px'>
						<option value="00">00</option>
				        <option value="01">01</option>
				        <option value="02">02</option>
				        <option value="03">03</option>
				        <option value="04">04</option>
				        <option value="05">05</option>
				        <option value="06">06</option>
				        <option value="07">07</option>
				        <option value="08">08</option>
				        <option value="09">09</option>
				        <option value="10">10</option>
				        <option value="11">11</option>
				        <option value="12">12</option>
				        <option value="13">13</option>
				        <option value="14">14</option>
				        <option value="15">15</option>
				        <option value="16">16</option>
				        <option value="17">17</option>
				        <option value="18">18</option>
				        <option value="19">19</option>
				        <option value="20">20</option>
				        <option value="21">21</option>
				        <option value="22">22</option>
				        <option value="23">23</option>
					</select>
					<select id='txtMinuteDepart_aller' class='txtForm' style='width:40px'>
						<option value="00">00</option>
				        <option value="05">05</option>
				        <option value="10">10</option>
				        <option value="15">15</option>
				        <option value="20">20</option>
				        <option value="25">25</option>
				        <option value="30">30</option>
				        <option value="35">35</option>
				        <option value="40">40</option>
				        <option value="45">45</option>
				        <option value="50">50</option>
				        <option value="55">55</option>
					</select>
					<br /><br />
					<label for='txtHeureArrive_aller' class='lblFormLong'>Heure d'arrivée : </label>
					<select id='txtHeureArrive_aller' class='txtForm' style='width:40px'>
						<option value="00">00</option>
				        <option value="01">01</option>
				        <option value="02">02</option>
				        <option value="03">03</option>
				        <option value="04">04</option>
				        <option value="05">05</option>
				        <option value="06">06</option>
				        <option value="07">07</option>
				        <option value="08">08</option>
				        <option value="09">09</option>
				        <option value="10">10</option>
				        <option value="11">11</option>
				        <option value="12">12</option>
				        <option value="13">13</option>
				        <option value="14">14</option>
				        <option value="15">15</option>
				        <option value="16">16</option>
				        <option value="17">17</option>
				        <option value="18">18</option>
				        <option value="19">19</option>
				        <option value="20">20</option>
				        <option value="21">21</option>
				        <option value="22">22</option>
				        <option value="23">23</option>
					</select>
					<select id='txtMinuteArrive_aller' class='txtForm' style='width:40px'>
						<option value="00">00</option>
				        <option value="05">05</option>
				        <option value="10">10</option>
				        <option value="15">15</option>
				        <option value="20">20</option>
				        <option value="25">25</option>
				        <option value="30">30</option>
				        <option value="35">35</option>
				        <option value="40">40</option>
				        <option value="45">45</option>
				        <option value="50">50</option>
				        <option value="55">55</option>
					</select>
				</div>
				<div id='3_aller' style='display:none;'>
					<label for='txtHeureArrive_aller3' class='lblFormLong'>Heure d'arrivée : </label>
					<select id='txtHeureArrive_aller3' class='txtForm' style='width:40px'>
						<option value="00">00</option>
				        <option value="01">01</option>
				        <option value="02">02</option>
				        <option value="03">03</option>
				        <option value="04">04</option>
				        <option value="05">05</option>
				        <option value="06">06</option>
				        <option value="07">07</option>
				        <option value="08">08</option>
				        <option value="09">09</option>
				        <option value="10">10</option>
				        <option value="11">11</option>
				        <option value="12">12</option>
				        <option value="13">13</option>
				        <option value="14">14</option>
				        <option value="15">15</option>
				        <option value="16">16</option>
				        <option value="17">17</option>
				        <option value="18">18</option>
				        <option value="19">19</option>
				        <option value="20">20</option>
				        <option value="21">21</option>
				        <option value="22">22</option>
				        <option value="23">23</option>
					</select>
					<select id='txtMinuteArrive_aller3' class='txtForm' style='width:40px'>
						<option value="00">00</option>
				        <option value="05">05</option>
				        <option value="10">10</option>
				        <option value="15">15</option>
				        <option value="20">20</option>
				        <option value="25">25</option>
				        <option value="30">30</option>
				        <option value="35">35</option>
				        <option value="40">40</option>
				        <option value="45">45</option>
				        <option value="50">50</option>
				        <option value="55">55</option>
					</select>
				</div>
			</fieldset>
		</div>
	
		
		
		<!-- GESTION DU RETOUR -->
		<div style='float:left;width:635px;margin-right:40px'>
			<!-- GESTION DES PASSAGER POUR UN TRAJET RETOUR -->
			<fieldset style='width:635px;float:left;margin-bottom:20px'>
				<legend id='lgdConducteur'>Passager : <span style='color:red'>Trajet Retour</span></legend>
				<br />
				<label for='txtMontantPaye_retour' class='lblFormLong'>Montant payé au conducteur (en liquide) : </label><input type='text' id='txtMontantPaye_retour' class='txtForm' value='0' onfocus='this.value=""' onblur='if(this.value==""){this.value="0"}' />€
				<br /><br />
				<label for='txtPassagerReserve_retour' class='lblFormLong'>Passagers ayant réservés : </label><select id='txtPassagerReserve_retour' class='txtForm'><?php echo $lstPlace8; ?></select>
				<br /><br />
				<label for='txtPassagerNonReserve_retour' class='lblFormLong'>Passagers n'ayant pas réservés : </label><select id='txtPassagerNonReserve_retour' class='txtForm'><?php echo $lstPlace8; ?></select>
				<br /><br />
				<label for='txtNbGroupe_retour' class='lblFormLong'>Nombre de groupe : </label><select id='txtNbGroupe_retour' class='txtForm'><?php echo $lstPlace10; ?></select>
				<br /><br />
				<label class='lblFormLong' for='txtPassagerDomicile_retour'>Dépôt à domicile : </label><select id='txtPassagerDomicile_retour' class='txtForm'><?php echo $lstPlace8; ?></select>
				<br /><br />
				<label class='lblFormLong' for='txtPassagerPtRdv_retour'>Dépôt au point de rendez-vous : </label><select id='txtPassagerPtRdv_retour' class='txtForm'><?php echo $lstPlace8; ?></select>
			</fieldset>
			
			<!-- GESTION DES PASSAGER POUR UN TRAJET RETOUR -->
			<fieldset style='width:635px;float:left;margin-right:40px;text-align:left;'>
				<legend id='lgdConducteur'>Général : <span style='color:red'>Trajet Retour</span></legend>
				<h4 style='text-align:left;margin-bottom:0'>Départ</h4>
				<input type='radio' onclick='document.getElementById("hdDepart_retour").value="1"' checked='checked' name='radioDepartNavette_retour' id='txtDepartStrasbourg_retour' value='strasbourg_retour' onchange='modificationDepartRetour("1_retour")' /><label for='txtDepartStrasbourg_retour'>Je retournais à Strasbourg</label>
				<br />
				<input type='radio' onclick='document.getElementById("hdDepart_retour").value="2"' name='radioDepartNavette_retour' id='txtDepartCetAeroport_retour' value='cetAeroport_retour' onchange='modificationDepartRetour("2_retour")' /><label for='txtDepartCetAeroport_retour'>Je suis resté à cet aéroport pour une autre navette</label>
				<br />
				<input type='radio' onclick='document.getElementById("hdDepart_retour").value="3"' name='radioDepartNavette_retour' id='txtAutreAeroport_retour' value='autreAeroport_retour' onchange='modificationDepartRetour("3_retour")' /><label for='txtAutreAeroport_retour'>Je vais à un autre aéroport</label>
				<input type='hidden' id='hdDepart_retour' value='1' />
				<br /><br />
				<div id='1_retour'>
					<label for='txtHeureDepart_retour' class='lblFormLong'>Heure de départ (Aéroport) : </label>
					<select id='txtHeureDepart_retour' class='txtForm' style='width:40px'>
						<option value="00">00</option>
				        <option value="01">01</option>
				        <option value="02">02</option>
				        <option value="03">03</option>
				        <option value="04">04</option>
				        <option value="05">05</option>
				        <option value="06">06</option>
				        <option value="07">07</option>
				        <option value="08">08</option>
				        <option value="09">09</option>
				        <option value="10">10</option>
				        <option value="11">11</option>
				        <option value="12">12</option>
				        <option value="13">13</option>
				        <option value="14">14</option>
				        <option value="15">15</option>
				        <option value="16">16</option>
				        <option value="17">17</option>
				        <option value="18">18</option>
				        <option value="19">19</option>
				        <option value="20">20</option>
				        <option value="21">21</option>
				        <option value="22">22</option>
				        <option value="23">23</option>
					</select>
					<select id='txtMinuteDepart_retour' class='txtForm' style='width:40px'>
						<option value="00">00</option>
				        <option value="05">05</option>
				        <option value="10">10</option>
				        <option value="15">15</option>
				        <option value="20">20</option>
				        <option value="25">25</option>
				        <option value="30">30</option>
				        <option value="35">35</option>
				        <option value="40">40</option>
				        <option value="45">45</option>
				        <option value="50">50</option>
				        <option value="55">55</option>
					</select>
					<br /><br />
					<label for='txtHeureArrive_retour' class='lblFormLong'>Heure d'arrivée (Strasbourg) : </label>
					<select id='txtHeureArrive_retour' class='txtForm' style='width:40px'>
						<option value="00">00</option>
				        <option value="01">01</option>
				        <option value="02">02</option>
				        <option value="03">03</option>
				        <option value="04">04</option>
				        <option value="05">05</option>
				        <option value="06">06</option>
				        <option value="07">07</option>
				        <option value="08">08</option>
				        <option value="09">09</option>
				        <option value="10">10</option>
				        <option value="11">11</option>
				        <option value="12">12</option>
				        <option value="13">13</option>
				        <option value="14">14</option>
				        <option value="15">15</option>
				        <option value="16">16</option>
				        <option value="17">17</option>
				        <option value="18">18</option>
				        <option value="19">19</option>
				        <option value="20">20</option>
				        <option value="21">21</option>
				        <option value="22">22</option>
				        <option value="23">23</option>
					</select>
					<select id='txtMinuteArrive_retour' class='txtForm' style='width:40px'>
						<option value="00">00</option>
				        <option value="05">05</option>
				        <option value="10">10</option>
				        <option value="15">15</option>
				        <option value="20">20</option>
				        <option value="25">25</option>
				        <option value="30">30</option>
				        <option value="35">35</option>
				        <option value="40">40</option>
				        <option value="45">45</option>
				        <option value="50">50</option>
				        <option value="55">55</option>
					</select>
				</div>
				<div id='3_retour' style='display:none'>
					<label for='txtHeureDepart_retour3' class='lblFormLong'>Heure de départ (Aéroport) : </label>
					<select id='txtHeureDepart_retour3' class='txtForm' style='width:40px'>
						<option value="00">00</option>
				        <option value="01">01</option>
				        <option value="02">02</option>
				        <option value="03">03</option>
				        <option value="04">04</option>
				        <option value="05">05</option>
				        <option value="06">06</option>
				        <option value="07">07</option>
				        <option value="08">08</option>
				        <option value="09">09</option>
				        <option value="10">10</option>
				        <option value="11">11</option>
				        <option value="12">12</option>
				        <option value="13">13</option>
				        <option value="14">14</option>
				        <option value="15">15</option>
				        <option value="16">16</option>
				        <option value="17">17</option>
				        <option value="18">18</option>
				        <option value="19">19</option>
				        <option value="20">20</option>
				        <option value="21">21</option>
				        <option value="22">22</option>
				        <option value="23">23</option>
					</select>
					<select id='txtMinuteDepart_retour3' class='txtForm' style='width:40px'>
						<option value="00">00</option>
				        <option value="05">05</option>
				        <option value="10">10</option>
				        <option value="15">15</option>
				        <option value="20">20</option>
				        <option value="25">25</option>
				        <option value="30">30</option>
				        <option value="35">35</option>
				        <option value="40">40</option>
				        <option value="45">45</option>
				        <option value="50">50</option>
				        <option value="55">55</option>
					</select>
					<br /><br />
					<label for='txtHeureArrive_retour3' class='lblFormLong'>Heure d'arrivée (Autre aéroport) : </label>
					<select id='txtHeureArrive_retour3' class='txtForm' style='width:40px'>
						<option value="00">00</option>
				        <option value="01">01</option>
				        <option value="02">02</option>
				        <option value="03">03</option>
				        <option value="04">04</option>
				        <option value="05">05</option>
				        <option value="06">06</option>
				        <option value="07">07</option>
				        <option value="08">08</option>
				        <option value="09">09</option>
				        <option value="10">10</option>
				        <option value="11">11</option>
				        <option value="12">12</option>
				        <option value="13">13</option>
				        <option value="14">14</option>
				        <option value="15">15</option>
				        <option value="16">16</option>
				        <option value="17">17</option>
				        <option value="18">18</option>
				        <option value="19">19</option>
				        <option value="20">20</option>
				        <option value="21">21</option>
				        <option value="22">22</option>
				        <option value="23">23</option>
					</select>
					<select id='txtMinuteArrive_retour3' class='txtForm' style='width:40px'>
						<option value="00">00</option>
				        <option value="05">05</option>
				        <option value="10">10</option>
				        <option value="15">15</option>
				        <option value="20">20</option>
				        <option value="25">25</option>
				        <option value="30">30</option>
				        <option value="35">35</option>
				        <option value="40">40</option>
				        <option value="45">45</option>
				        <option value="50">50</option>
				        <option value="55">55</option>
					</select>
				</div>
			</fieldset>
		</div>
		
		<!--  INFORMATIONS GENERALES -->
		<fieldset style='width:1310px;float:left;margin-right:40px;text-align:left;'>
			<legend id='lgdConducteur'>Général : <span style='color:red'>Véhicule</span></legend>
			<br />
			<label for='txtNbKmDepart' class='lblFormLong'>Nombre de kilomètres au départ : </label><input type='text' id='txtNbKmDepart' class='txtForm' value='0' onfocus='this.value=""' onblur='if(this.value==""){this.value="0"}' />&nbsp;km
			<br /><br />
			<label for='txtNbKmArrive' class='lblFormLong'>Nombre de kilomètres à l'arrivée : </label><input type='text' id='txtNbKmArrive' class='txtForm' value='0' onfocus='this.value=""' onblur='if(this.value==""){this.value="0"}' />&nbsp;km
			<br /><br />
			<label for='txtNvCarburantDepart' class='lblFormLong'>Niveau du carburant au départ : </label><select id='txtNvCarburantDepart' class='txtForm'><?php echo $lstPlace9; ?></select>
			<br /><br />
			<label for='txtNvCarburantArrive' class='lblFormLong'>Niveau du carburant à l'arrivée : </label><select id='txtNvCarburantArrive' class='txtForm'><?php echo $lstPlace9; ?></select>
			<br /><br />
			<label for='txtEssenceAchete' class='lblFormLong'>Essence achetée (ex : 55.42) : </label><input type='text' id='txtEssenceAchete' class='txtForm' value='0' onfocus='this.value=""' onblur='if(this.value==""){this.value="0"}' />&nbsp;€
			<br /><br />
			<label for='txtConsoMoyenne' class='lblFormLong'>Consommation moyenne : </label><input type='text' id='txtConsoMoyenne' class='txtForm' value='0' onfocus='this.value=""' onblur='if(this.value==""){this.value="0"}' />&nbsp;litres
			<br /><br />
			<span class='lblFormLong'>Lavage extérieur : </span><label for='lavageExterieurOui' style='margin-left:40px;'>Oui</label><input type='radio' onclick='document.getElementById("hdLavageExt").value="1"' name='radioLavageExterieur' id='lavageExterieurOui' value='oui' /><label for='lavageExterieurNon' style='margin-left:50px'>Non</label><input type='radio' onclick='document.getElementById("hdLavageExt").value="0"' checked='checked' name='radioLavageExterieur' id='lavageExterieurNon' value='non' />
			<input type='hidden' id='hdLavageExt' value='0' />
			<br /><br />
			<span class='lblFormLong'>Lavage intérieur : </span><label for='lavageInterieurOui' style='margin-left:40px;'>Oui</label><input type='radio' onclick='document.getElementById("hdLavageInt").value="1"' name='radioLavageInterieur' id='lavageInterieurOui' value='oui' /><label for='lavageInterieurNon' style='margin-left:50px'>Non</label><input type='radio' onclick='document.getElementById("hdLavageInt").value="0"' checked='checked' name='radioLavageInterieur' id='lavageInterieurNon' value='non' />
			<input type='hidden' id='hdLavageInt' value='0' />
			<br /><br />
			<label for='txtNbUnite' class='lblFormLong'>Nombre d'unités : </label><input type='text' id='txtNbUnite' class='txtForm' value='0' onfocus='this.value=""' onblur='if(this.value==""){this.value="0"}' />
			<br /><br />
			<label for='txtLieuDepot' class='lblFormLong'>Lieu de dépôt du véhicule : </label><input type='text' id='txtLieuDepot' class='txtForm' />
			<br /><br />
			<label for='txtRaisonRetard' class='lblFormLong'>Si un retard important a été pris, merci d'en signaler la raison : </label><textarea type='text' id='txtRaisonRetard' class='txtForm' rows='10' style='width:400px'></textarea>
			<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
			<label for='txtRemarque' class='lblFormLong'>Remarque : </label><textarea id='txtRemarque' class='txtForm' rows='10' style='width:400px'></textarea>
		</fieldset>
	</fieldset>
		<br />
	    <input name="idcm" id="idcm" type="hidden" value="<?php echo $_POST['idcm']; ?>" />
	<div style='width:100%;text-align:center'>
		<input type='button' value='Valider' onclick='validerInformation()' />
		<input type='reset' value='Effacer' style='margin-left:40px' />
	</div>
</form>

	
<script type='text/javascript'>
var radioDepart_aller = document.getElementsByName('radioDepartNavette_aller');
var radioDepart_retour = document.getElementsByName('radioDepartNavette_retour');
var div_aller = document.getElementById('selectionHoraire_aller');
var div_retour = document.getElementById('selectionHoraire_retour');

function modificationDepartAller(dep)
{
	if(dep=='1_aller')
	{
		document.getElementById('3_aller').style.display='none';
		document.getElementById('1_aller').style.display='block';
	}
	else if(dep=='2_aller')
	{
		document.getElementById('3_aller').style.display='none';
		document.getElementById('1_aller').style.display='none';
	}
	else if(dep=='3_aller')
	{
		document.getElementById('3_aller').style.display='block';
		document.getElementById('1_aller').style.display='none';
	}
}

function modificationDepartRetour(ret)
{
	if(ret=='1_retour')
	{
		document.getElementById('3_retour').style.display='none';
		document.getElementById('1_retour').style.display='block';
	}
	else if(ret=='2_retour')
	{
		document.getElementById('3_retour').style.display='none';
		document.getElementById('1_retour').style.display='none';
	}
	else if(ret=='3_retour')
	{
		document.getElementById('3_retour').style.display='block';
		document.getElementById('1_retour').style.display='none';
	}
}

function validerInformation()
{
	 var idcm = document.getElementById('idcm').value;
	 var lstConducteur = document.getElementById('txtConducteur');
	 var conducteur = lstConducteur.options[lstConducteur.selectedIndex].value; 
	 var lstVehicule = document.getElementById('txtVehicule');
	 var vehicule = lstVehicule.options[lstVehicule.selectedIndex].value;
	 
	 // informations concernant l'aller
	 var montantPaye_a = document.getElementById('txtMontantPaye_aller').value;
	 var lstPassagerReserve_a = document.getElementById('txtPassagerReserve_aller');
	 var passagerReserve_a = lstPassagerReserve_a.options[lstPassagerReserve_a.selectedIndex].value; 
	 var lstPassagerNonReserve_a = document.getElementById('txtPassagerNonReserve_aller');
	 var passagerNonReserve_a = lstPassagerNonReserve_a.options[lstPassagerNonReserve_a.selectedIndex].value;
	 var lstNbGroupe_a = document.getElementById('txtNbGroupe_aller');
	 var nbGroupe_a = lstNbGroupe_a.options[lstNbGroupe_a.selectedIndex].value;
	 var txtPassagerPtRdv_a = document.getElementById('txtPassagerPtRdv_aller').options[document.getElementById('txtPassagerPtRdv_aller').selectedIndex].value;
	 var txtPassagerDomicile_a = document.getElementById('txtPassagerDomicile_aller').options[document.getElementById('txtPassagerDomicile_aller').selectedIndex].value;

	 // liste des horaires aller
	 var hdDepart_a = document.getElementById('hdDepart_aller').value;
	 if(hdDepart_a=="1")
	 {
		var lstHeureDepart_a = document.getElementById('txtHeureDepart_aller');
		var heureDepart_a = lstHeureDepart_a.options[lstHeureDepart_a.selectedIndex].value; 
		var lstMinuteDepart_a = document.getElementById('txtMinuteDepart_aller');
		var minuteDepart_a = lstMinuteDepart_a.options[lstMinuteDepart_a.selectedIndex].value; 
		var lstHeureArrive_a = document.getElementById('txtHeureArrive_aller');
		var heureArrive_a = lstHeureArrive_a.options[lstHeureArrive_a.selectedIndex].value; 
		var lstMinuteArrive_a = document.getElementById('txtMinuteArrive_aller');
		var minuteArrive_a = lstMinuteArrive_a.options[lstMinuteArrive_a.selectedIndex].value;

	 }
	 else if(hdDepart_a=="3")
	 {
		var lstHeureArrive_a = document.getElementById('txtHeureArrive_aller3');
		var heureArrive_a = lstHeureArrive_a.options[lstHeureArrive_a.selectedIndex].value; 
		var lstMinuteArrive_a = document.getElementById('txtMinuteArrive_aller3');
		var minuteArrive_a = lstMinuteArrive_a.options[lstMinuteArrive_a.selectedIndex].value;
	 }

	 // informations concernant le retour
	 var montantPaye_r = document.getElementById('txtMontantPaye_retour').value;
	 var lstPassagerReserve_r = document.getElementById('txtPassagerReserve_retour');
	 var passagerReserve_r = lstPassagerReserve_r.options[lstPassagerReserve_r.selectedIndex].value; 
	 var lstPassagerNonReserve_r = document.getElementById('txtPassagerNonReserve_retour');
	 var passagerNonReserve_r = lstPassagerNonReserve_r.options[lstPassagerNonReserve_r.selectedIndex].value; 
	 var lstNbGroupe_r = document.getElementById('txtNbGroupe_retour');
	 var nbGroupe_r = lstPassagerReserve_a.options[lstNbGroupe_r.selectedIndex].value; 
	 var txtPassagerPtRdv_r = document.getElementById('txtPassagerPtRdv_retour').options[document.getElementById('txtPassagerPtRdv_retour').selectedIndex].value;
	 var txtPassagerDomicile_r = document.getElementById('txtPassagerDomicile_retour').options[document.getElementById('txtPassagerDomicile_retour').selectedIndex].value;

	 // liste Horaire retour
	 var hdDepart_r = document.getElementById('hdDepart_retour').value;
	 if(hdDepart_r=="1")
	 {
			var lstHeureDepart_r = document.getElementById('txtHeureDepart_retour');
			var heureDepart_r = lstHeureDepart_r.options[lstHeureDepart_r.selectedIndex].value; 
			
			var lstMinuteDepart_r = document.getElementById('txtMinuteDepart_retour');
			var minuteDepart_r = lstMinuteDepart_r.options[lstMinuteDepart_r.selectedIndex].value; 
			
			var lstHeureArrive_r = document.getElementById('txtHeureArrive_retour');
			var heureArrive_r = lstHeureArrive_r.options[lstHeureArrive_r.selectedIndex].value; 
			
			var lstMinuteArrive_r = document.getElementById('txtMinuteArrive_retour');
			var minuteArrive_r = lstMinuteArrive_r.options[lstMinuteArrive_r.selectedIndex].value;

	 }
	 else if(hdDepart_r=="3")
	 {
			var lstHeureDepart_r = document.getElementById('txtHeureDepart_retour3');
			var heureDepart_r = lstHeureDepart_r.options[lstHeureDepart_r.selectedIndex].value; 
			
			var lstMinuteDepart_r = document.getElementById('txtMinuteDepart_retour3');
			var minuteDepart_r = lstMinuteDepart_r.options[lstMinuteDepart_r.selectedIndex].value; 
			
			var lstHeureArrive_r = document.getElementById('txtHeureArrive_retour3');
			var heureArrive_r = lstHeureArrive_r.options[lstHeureArrive_r.selectedIndex].value; 
			
			var lstMinuteArrive_r = document.getElementById('txtMinuteArrive_retour3');
			var minuteArrive_r = lstMinuteArrive_r.options[lstMinuteArrive_r.selectedIndex].value;
	 }

	 // Véhicule
	 var nbKmDepart = document.getElementById('txtNbKmDepart').value;
	 var nbKmArrive = document.getElementById('txtNbKmArrive').value;
	 var lstNvCarburantDepart = document.getElementById('txtNvCarburantDepart');
	 var nvCarburantDepart = lstNvCarburantDepart.options[lstNvCarburantDepart.selectedIndex].value;
	 var lstNvCarburantArrive = document.getElementById('txtNvCarburantArrive');
	 var nvCarburantArrive = lstNvCarburantArrive.options[lstNvCarburantArrive.selectedIndex].value;
	 var essenceAchete = document.getElementById('txtEssenceAchete').value;
	 var consoMoyenne = document.getElementById('txtConsoMoyenne').value;
	 var lavageExt = document.getElementById('hdLavageExt').value;
	 var lavageInt = document.getElementById('hdLavageInt').value;
	 var nbUnite = document.getElementById('txtNbUnite').value;
	 var lieuDepot = document.getElementById('txtLieuDepot').value;
	 var raisonRetard = document.getElementById('txtRaisonRetard').value;
	 var remarque = document.getElementById('txtRemarque').value;

	 // on recupere les premieres valeurs (conducteur, vehicule, passager aller, passager retour) 
	 param = "action=validerCompteRendu&date=<?php echo $_SESSION['date']; ?>&idcm=<?php echo $_POST['idcm']; ?>&conducteur="+conducteur+"&vehicule="+vehicule+"&montantPaye_a="+montantPaye_a+"&passagerReserve_a="+passagerReserve_a+"&passagerNonReserve_a="+passagerNonReserve_a+"&nbGroupe_a="+nbGroupe_a+"&passagerDomicile_a="+txtPassagerDomicile_a+"&passagerPtRdv_a="+txtPassagerPtRdv_a+"&montantPaye_r="+montantPaye_r+"&passagerReserve_r="+passagerReserve_r+"&passagerNonReserve_r="+passagerNonReserve_r+"&nbGroupe_r="+nbGroupe_r+"&passagerDomicile_r="+txtPassagerDomicile_r+"&passagerPtRdv_r="+txtPassagerPtRdv_r;

	 // on recupere les horaires aller
	 if(hdDepart_a=="1")
	 {
		param+="&hdDepart_a=1&heureDepart_a="+heureDepart_a+"&minuteDepart_a="+minuteDepart_a+"&heureArrive_a="+heureArrive_a+"&minuteArrive_a="+minuteArrive_a;
	 }
	 else if(hdDepart_a=="3")
	 {
		 param+="&hdDepart_a=3&heureArrive_a="+heureArrive_a+"&minuteArrive_a="+minuteArrive_a;
	 }

	 // horaire retour
	 param+="&hdDepart_r="+hdDepart_r+"&heureDepart_r="+heureDepart_r+"&minuteDepart_r="+minuteDepart_r+"&heureArrive_r="+heureArrive_r+"&minuteArrive_r="+minuteArrive_r;

	 // reste
	 param+="&nbKmDepart="+nbKmDepart+"&nbKmArrive="+nbKmArrive+"&nvCarburantDepart="+nvCarburantDepart+"&nvCarburantArrive="+nvCarburantArrive+"&essenceAchete="+essenceAchete+"&consoMoyenne="+consoMoyenne+"&lavageExt="+lavageExt+"&lavageInt="+lavageInt+"&nbUnite="+nbUnite+"&lieuDepot="+lieuDepot+"&raisonRetard="+raisonRetard+"&remarque="+remarque+"&idcm="+idcm;
	 ajax("./php/traitementAjax.php",param,"validerCompteRendu");
}


/** FONCTION AJAX **/
function ajax(url,param,choix)
{
	var httpRequest = false;
	
	if (window.XMLHttpRequest) {
		httpRequest = new XMLHttpRequest();
		if (httpRequest.overrideMimeType) {
			httpRequest.overrideMimeType('text/xml');
		}
	}
	else if (window.ActiveXObject) { // IE
		try {
			httpRequest = new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch (e) {
			try {
				httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e) {}
		}
	}
	
	if (!httpRequest) {
		alert('Abandon :( Impossible de creer une instance XMLHTTP');
		return false;
	}
	httpRequest.onreadystatechange = function() { traiter(httpRequest,choix); };
	httpRequest.open("POST",url,true);
	httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=iso-8859-15');
	httpRequest.send(param);
}

function traiter(httpRequest,choix)
{
	
	if (httpRequest.readyState == 4)
	{
		if (httpRequest.status == 200) 
		{
			if(httpRequest.responseText=="1")
				alert('Récapitulatif enregistré.');
		}
		else
		{
		}
	}
	else
	{

	}
}
/** FIN FONCTION AJAX **/
</script>