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

if(!isset($_GET['id']))
{
?>
<div style="width:100%; text-align:center" id='conducteur'>
	<br />
    <span style="font-family:Verdana, Geneva, sans-serif; font-size:16px; font-weight:bold;">Gestion des clients</span>
    <br /><br />
    	<input type='text' id='txtRecherche' />&nbsp;&nbsp;&nbsp;<input type='button' value='Rechercher' onclick='lancerRecherche()' />&nbsp; : &nbsp; <span style='font-style:italic'>(nom,prénom,adresse,ville,pays,email...)</span> 
    <br />
    <div id='contenuTable'>
 
    </div>      
</div>
<?php 
}
else
{
?>

<?php 
}
?>
<script type='text/javascript'>
function lancerRecherche()
{	
	var rech = document.getElementById('txtRecherche').value;
	param = 'action=rechercheClient&critere='+rech;
	ajax('./php/traitementAjax.php',param,'rechercheClient');
}

function modifClient(id)
{
	//param = "action=modifClient&id="+id;
	//ajax('./php/traitementAjax.php',param,'modifClient');

	window.open ('modifClient.php?id='+id, 'Modification des clients', config='height=500, width=600, toolbar=no, menubar=no, scrollbars=no, resizable=no, location=no, directories=no, status=no')
}

function supprimerClient(id)
{
	if(confirm("Êtes-vous sûre de vouloir supprimer le client ?"))
	{
		param = "action=supprimerClient&id="+id;
		ajax('./php/traitementAjax.php',param,'supprimerClient');
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
			if(choix=='rechercheClient')
			{
				document.getElementById('contenuTable').innerHTML = httpRequest.responseText;	
			}
			else if(choix='supprimerClient')
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