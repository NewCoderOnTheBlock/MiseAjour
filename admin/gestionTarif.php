<?php
	include("verifAuth.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="style.css" rel="stylesheet" type="text/css" /> 
</head>
<body>
<?php 
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
	
	$res = mysql_query($req,$c);
	mysql_close($c);
	return $res;
}


function creationListeVille()
{
	$sql = 'select * from aeroport_lieu';
	$res = execution($sql);
	$lst="<option>- - - - -</option>";
	while($l=mysql_fetch_array($res))
	{
		$lst.="<option value='".$l['id_lieu']."'>".$l['nom']."</option>";
	}
	echo $lst;
}

function creationListeTarif()
{
	$req = "select * from aeroport_lieu";
	$res = execution($req);
	$lst = '';
	while($r = mysql_fetch_array($res))
	{ 
		$lst.="<option value='".$r['id_lieu']."'>".$r['nom']."</option>";
	}
	echo $lst;
}

function tableauHoraire()
{
	$sql = 'SELECT DISTINCT(f.id_lieu), l.nom FROM aeroport_fixe f, aeroport_lieu l WHERE f.id_lieu = l.id_lieu';
	$res = execution($sql);
	$total = "";
	while($l = mysql_fetch_array($res))
	{
		$t = "<table frame='all' rules='all' style='width:500px'><caption>".$l['nom']."</caption>";
		
		$sql = "SELECT DISTINCT depart, retour, type_horaire FROM aeroport_fixe WHERE id_lieu = '" . $l['id_lieu'] . "' order by depart";
		$res2 = execution($sql);
		while($l2 = mysql_fetch_array($res2))
		{
			$t .= "<tr>
				<td>".$l2['depart']."</td>
				<td>".$l2['retour']."</td>
				<td>".$l2['type_horaire']."</td>
				<td><img src='./images/modifier.png' title='Modifier' alt='Modifier' width='21' style='cursor:pointer' onclick='modifHoraire(\"".$l['nom']."\",\"".$l2['depart']."\",\"".$l2['retour']."\", \"".$l2['type_horaire']."\")' /></td>
				<td><img src='./images/croix.png' width='21' style='cursor:pointer' title='Supprimer' alt='Modifier' onclick='supprimerHoraire(\"".$l['id_lieu']."\",\"".$l2['depart']."\",\"".$l2['retour']."\")' /></td>
			</tr>";
		}
		
		$t .= "</table><br />";
		$total .= $t;
	}
	echo $total;
}
// KEMPF : Fonction qui retourne simplement toutes les villes (Sauf Strasbourg)
// Les horaires fixes sont donc applicables à toutes les destinations
function recupListeVille()
{
	$sql = "SELECT id_lieu, nom FROM aeroport_lieu WHERE id_lieu <> '100'";
	$res = execution($sql);
	$lst = "<select id='lstVilleHoraire' style='width:300px;'><option value=''></option>";
	while($l=mysql_fetch_array($res))
	{
		$lst.="<option value='".$l['id_lieu']."'>".$l['nom']."</option>";
	}
	$lst.="</select>";
	echo $lst;
}
// KEMPF : Fonction qui retourne les horaires été/hiver
function recupListeHorairesEteHiver()
{
	$sql = "SELECT id_lieu, nom, horaire_ete, horaire_hiver FROM aeroport_lieu WHERE id_lieu <> '100'";
	$res = execution($sql);
	$lst = "
		(Assurez vous de suivre le format jj-mm-aaaa)
		<br /><br />
		A noter qu'en ne spécifiant pas de date, le système se basera sur les dates de passage à heure d'été et heure d'hiver
		<br /><br />
		<table width='100%' style='border-spacing:0px 5px;'>
			<tr>
				<th>Lieu</th>
				<th>Horaire d'été</th>
				<th>Horaire d'hiver</th>
				<th>&nbsp;</th>
			</tr>";
	$bonus = "style='background-color:#DDD;'";
	while($l=mysql_fetch_array($res))
	{
		$lst .= "
			<tr ".$bonus.">
				<td style='text-align:left;'>
					<form action='modifHoraireEteHiver.php?id=".$l['id_lieu']."' method='post'>
					".$l['nom']."
				</td>
				<td style='text-align:left;'>
					<input name='date_ete' type='text' value='".$l['horaire_ete']."' />
				</td>
				<td style='text-align:left;'>
					<input name='date_hiver' type='text' value='".$l['horaire_hiver']."' />
				</td>
				<td style='text-align:left;'>
					<input type='submit'/>
					</form>
				</td>
			</tr>";
		$bonus = (empty($bonus)) ? "style='background-color:#DDD;'" : "";
	}
	$lst .= "</table>";
	
	echo $lst;
}

function recupVillePourHoraire()
{
	$sql = 'SELECT DISTINCT(f.id_lieu), l.nom FROM aeroport_fixe f, aeroport_lieu l WHERE f.id_lieu = l.id_lieu';
	$res = execution($sql);
	$lst = "<select id='lstVilleHoraire' style='width:300px;'><option value=''></option>";
	while($l=mysql_fetch_array($res))
	{
		$lst.="<option value='".$l['id_lieu']."'>".$l['nom']."</option>";
	}
	$lst.="</select>";
	echo $lst;
}
?>
<div style="width:100%; text-align:center">
	<br />
    <span style="font-family:Verdana, Geneva, sans-serif; font-size:16px; font-weight:bold;">Gestion du des tarifs</span>
          <br />
      <fieldset class="conducteur" style='width:600px'>
      	<legend id='lgdConducteur'>Modifier un tarif</legend>
        <select size="1" id="lstTarifModification" style="width:300px;" onchange='ouvertureModifTarif()'>
        	<option>- - - - - -</option>
			<?php echo creationListeTarif(); ?>
        </select>
        <br /><br />
        	<div id='modifTarif' style='display:none;'></div>
        <input type="button" value="Modifer le tarif" onclick='modifierTarif()' />
      </fieldset>
    <br />
      <fieldset class="conducteur" style='width:600px'>
      	<legend id='lgdConducteur'>Supprimer un tarif</legend>
        <select size="1" id="lstTarif" style="width:300px;">
        	<option>- - - - - -</option>
			<?php echo creationListeTarif(); ?>
        </select>
        <br /><br />
        <input type="button" value="Supprimer le tarif" onclick='supprimerTarif()' />
      </fieldset>
</div>

<div style="width:100%; text-align:center">
	<br />
    <span style="font-family:Verdana, Geneva, sans-serif; font-size:16px; font-weight:bold;">Gestion des horaires</span>
	<br />
	<fieldset class="conducteur" style='width:600px'>
		<legend id='lgdConducteur'>Modifier les horaires été/hiver</legend>
		<?php recupListeHorairesEteHiver(); ?>
	</fieldset>
    <br />
	<fieldset class="conducteur" style='width:600px'>
		<legend id='lgdConducteur'>Ajouter un horaire</legend>
		<table width="100%">
			<tr>
				<td style="width:25%;">&nbsp;</td>
				<td style="width:75%;text-align:left;"><?php echo recupListeVille(); ?></td>
			</tr>
			
			<tr>
				<td style="text-align:left;">
					<label for='txtNvHeureDepart'>Départ : </label>
				</td>
				<td style="text-align:left;">
					<input size='2' maxlength='2' type='text' id='txtNvHeureDepart' /> : <input size='2' maxlength='2' type='text' id='txtNvMinuteDepart' /> : <input size='2' maxlength='2' type='text' id='txtNvSecondeDepart' value='00' />
				</td>
			</tr>
			
			<tr>
				<td style="text-align:left;">
					<label for='txtNvHeureArrive'>Retour : </label>
				</td>
				<td style="text-align:left;">
					<input size='2' maxlength='2' type='text' id='txtNvHeureArrive' /> : <input size='2' maxlength='2' type='text' id='txtNvMinuteArrive' /> : <input size='2' maxlength='2' type='text' id='txtNvSecondeArrive' value='00' />
				</td>
			</tr>
			
			<tr>
				<td style="text-align:left;">
					<label>Type de l'horaire</label>
				</td>
				<td style="text-align:left;">
					<select size="1" id="lstTypeHoraire" style="width:300px;">
						<option value="ETE">Horaire d'été</option>
						<option value="HIVER">Horaire d'hiver</option>
						<option value="ANNEE" selected>Horaire annuel</option>
					</select>
				</td>
			</tr>
			
			<tr>
				<td colspan="2">
					<input type="button" value="Ajouter l'horaire" onclick='ajoutHoraire()' />
				</td>
			</tr>
			
		</table>
	</fieldset>
	<br />
	<fieldset class="conducteur" style='width:600px'>
		<legend id='lgdConducteur'>Modifier un horaire</legend>
		<?php echo tableauHoraire()?>
	</fieldset>
</div>

<script type='text/javascript'>
function supprimerTarif()
{
	if(confirm("Voulez-vous supprimer le tarif ?"))
	{
		var id = document.getElementById('lstTarif').options[document.getElementById('lstTarif').selectedIndex].value;
		param='action=supprimerTarif&id='+id;
		ajax('./php/traitementAjax.php',param,'supprimerTarif');
	}
}

function ouvertureModifTarif()
{
	var lst = document.getElementById('lstTarifModification');
	var sel = lst.options[lst.selectedIndex].value;

	param = 'action=recupInfoModifTarif&id='+sel;
	ajax('./php/traitementAjax.php',param,'recupInfoModifTarif');
}

function modifierTarif()
{
	var lst = document.getElementById('lstTarifModification');
	var nom = lst.options[lst.selectedIndex].text;
	var sel = lst.options[lst.selectedIndex].value;

	var forfait_minimum = document.getElementById('forfait_minimumModif').value;
	var nombre_personne = document.getElementById('nombre_personneModif').value;

	param='action=modifTarif&nom='+nom+'&id='+sel+'&forfait_minimum='+forfait_minimum+'&nombre_personne='+nombre_personne;
	ajax('./php/traitementAjax.php',param,'modifTarif');
}

function modifHoraire(nom,dep,ret, type)
{
	window.open ('modifHoraire.php?nom='+nom+'&dep='+dep+"&ret="+ret+"&type="+type, 'Modification des horaires', config='height=500, width=600, toolbar=no, menubar=no, scrollbars=no, resizable=no, location=no, directories=no, status=no')
}

function supprimerHoraire(id,dep,ret)
{
	if(confirm("Confirmer la suppression de l'horaire"))
	{
		param='action=suppressionHoraire&id='+id+'&dep='+dep+'&ret='+ret;
		ajax('./php/traitementAjax.php',param,'suppressionHoraire');
	}
}

function ajoutHoraire()
{
	var lst = document.getElementById('lstVilleHoraire');
	var dest = lst.options[lst.selectedIndex].value;
	
	var txtNvHeureDepart = document.getElementById('txtNvHeureDepart').value;
	var txtNvMinuteDepart = document.getElementById('txtNvMinuteDepart').value;
	var txtNvSecondeDepart = document.getElementById('txtNvSecondeDepart').value;

	var txtNvHeureArrive = document.getElementById('txtNvHeureArrive').value;
	var txtNvMinuteArrive = document.getElementById('txtNvMinuteArrive').value;
	var txtNvSecondeArrive = document.getElementById('txtNvSecondeArrive').value;
	
	// KEMPF : Ajout du type de l'horaire (ETE, HIVER ou ANNEE)
	var lstType = document.getElementById('lstTypeHoraire');
	var typeHoraire = lstType.options[lstType.selectedIndex].value;

	
	if((dest!="" || dest!="0") && (txtNvHeureDepart!="" && txtNvMinuteDepart!="" && txtNvSecondeDepart!="") && (txtNvHeureArrive!="" && txtNvMinuteArrive!="" && txtNvSecondeArrive!=""))
	{
		param = 'action=ajoutHoraire&dest='+dest+'&hd='+txtNvHeureDepart+'&md='+txtNvMinuteDepart+'&sd='+txtNvSecondeDepart+'&ha='+txtNvHeureArrive+'&ma='+txtNvMinuteArrive+'&sa='+txtNvSecondeArrive+'&type='+typeHoraire;
		ajax('./php/traitementAjax.php',param,'ajoutHoraire');
	}
	else
	{
		alert("Merci de remplir tous les champs.");
	}
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
			if(choix=='supprimerTarif')
				window.location.reload();
			else if(choix=='recupInfoModifTarif')
			{
				document.getElementById('modifTarif').style.display='block';
				var tab = httpRequest.responseText.split("|||");
				
				document.getElementById('modifTarif').innerHTML = "<label for='forfait_minimumModif' class='lblFormLong'>Forfait minimum : </label><input maxlength='5' value='"+tab[1]+"' name='forfait_minimumModif' type='text' size='15' maxlength='40' id='forfait_minimumModif' class='txtForm' />€<br/><br/><label for='nombre_personneModif' class='lblFormLong'>Nombre minimum de personne : </label><input name='nombre_personneModif' value='"+tab[2]+"' type='text' size='15' maxlength='40' id='nombre_personneModif' class='txtForm' /><br/><br/>";
			}
			else if(choix=='modifTarif')
			{
				window.location.reload();
			}
			else if(choix=='ajoutHoraire')
			{
				window.location.reload();
			}
			else if(choix=='suppressionHoraire')
			{
				window.location.reload();
			}
		}
		else{}
	}
	else
	{
	}
}
/** FIN FONCTION AJAX **/
</script>
</body>
</html>