<?php
	// include("verifAuth.php");
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

$sql = 'select * from aeroport_client where id_client='.$_GET['id'];
$res = execution($sql);
$l = mysql_fetch_array($res);

$sql2 = 'select * from aeroport_pays order by nom_pays';
$res2 = execution($sql2);
$lstFixe = '<option selected="selected"></option>';
$lstPort = '<option selected="selected"></option>';

while($l2 = mysql_fetch_array($res2))
{
	if($l['ind_fixe']!="0")
	{
		if($l2['id_pays']==$l['ind_fixe'])
			$lstFixe.='<option selected="selected" value="'.$l2['id_pays'].'">'.$l2['nom_pays'].' ('.$l2['identifiant_tel'].')</option>';
		else
			$lstFixe.='<option value="'.$l2['id_pays'].'">'.$l2['nom_pays'].' ('.$l2['identifiant_tel'].')</option>';
	}
	else
	{
		$lstFixe.='<option value="'.$l2['id_pays'].'">'.$l2['nom_pays'].' ('.$l2['identifiant_tel'].')</option>';
	}
	
	if($l['ind_port']!="0")
	{
		if($l2['id_pays']==$l['ind_port'])
			$lstPort.='<option selected="selected" value="'.$l2['id_pays'].'">'.$l2['nom_pays'].' ('.$l2['identifiant_tel'].')</option>';
		else
			$lstPort.='<option value="'.$l2['id_pays'].'">'.$l2['nom_pays'].' ('.$l2['identifiant_tel'].')</option>';
	}
	else
	{
		$lstPort.='<option value="'.$l2['id_pays'].'">'.$l2['nom_pays'].' ('.$l2['identifiant_tel'].')</option>';
	}
}
?>

<label class='lblForm'>Nom : </label><input type='text' value='<?php echo $l['nom']; ?>' id='txtNom' />
<br /><br />
<label class='lblForm'>Préom : </label><input type='text' value='<?php echo $l['prenom']; ?>' id='txtPrenom' />
<br /><br />
<label class='lblForm'>Adresse : </label><input type='text' value='<?php echo $l['adresse']; ?>' id='txtAdresse' />
<br /><br />
<label class='lblForm'>Code postal : </label><input type='text' value='<?php echo $l['code_postal']; ?>' id='txtCp' />
<br /><br />
<label class='lblForm'>Ville : </label><input type='text' value='<?php echo $l['ville']; ?>' id='txtVille' />
<br /><br />
<label class='lblForm'>Email : </label><input type='text' value='<?php echo $l['mail']; ?>' id='txtMail' />
<br /><br />
<label class='lblForm'>Indicatif fixe : </label><select id='txtIndicatifFixe'><?php echo $lstFixe; ?></select>
<br /><br />
<label class='lblForm'>Téléphone fixe : </label><input type='text' value='<?php echo $l['tel_fixe']; ?>' id='txtFixe' />
<br /><br />
<label class='lblForm'>Indicatif portable : </label><select id='txtIndicatifPort'><?php echo $lstPort; ?></select>
<br /><br />
<label class='lblForm'>Téléphone portable : </label><input type='text' value='<?php echo $l['tel_port']; ?>' id='txtPort' />
<br /><br />
<label class='lblForm'>&nbsp;</label><input type='button' value='Valider' onclick='validerInformation()' />

<script type='text/javascript'>
function validerInformation()
{
	var nom = document.getElementById('txtNom').value;
	var prenom = document.getElementById('txtPrenom').value;
	var adresse = document.getElementById('txtAdresse').value;
	var cp = document.getElementById('txtCp').value;
	var ville = document.getElementById('txtVille').value;
	var mail = document.getElementById('txtMail').value;
	var fixe = document.getElementById('txtFixe').value;
	var port = document.getElementById('txtPort').value;
	var indFixe = document.getElementById('txtIndicatifFixe').options[document.getElementById('txtIndicatifFixe').selectedIndex].value;
	var indPort = document.getElementById('txtIndicatifPort').options[document.getElementById('txtIndicatifPort').selectedIndex].value;
	
	param = 'action=modifClient&id=<?php echo $_GET['id']; ?>&nom='+nom+'&prenom='+prenom+'&adresse='+adresse+'&cp='+cp+'&ville='+ville+'&mail='+mail+'&fixe='+fixe+'&port='+port+'&indFixe='+indFixe+'&indPort='+indPort;
	alert(param)
	ajax('./php/traitementAjax.php',param,'modifClient');
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
			if(choix=='modifClient')
			{
				alert(httpRequest.responseText)
				window.close();
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