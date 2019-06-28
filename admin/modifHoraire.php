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
	$nom = $_GET['nom'];
	$dep = $_GET['dep'];
	$ret = $_GET['ret'];
	$type_h = $_GET['type'];
	
	$tabDep = explode(':',$dep);
	$tabRet = explode(':',$ret);
?>

	
	<label class='lblFormLong'>Aéroport : </label><div id='nom'><?php echo $nom; ?></div>
	<br />
	<label class='lblFormLong'>Départ de Strasbourg : </label>
	<input type='text' maxlength='2' value='<?php echo $tabDep[0]; ?>' id='depHeureStrasbourg' style='width:30px' /> : <input type='text' value='<?php echo $tabDep[1]; ?>' id='depMinuteStrasbourg' style='width:30px' maxlength='2' />
	<br /><br />
	<label class='lblFormLong'>Départ de l'aéroport : </label>
	<input type='text' maxlength='2' value='<?php echo $tabRet[0]; ?>' id='depHeureAero' style='width:30px' /> : <input type='text' value='<?php echo $tabRet[1]; ?>' id='depMinuteAero' style='width:30px' maxlength='2' />
	<br /><br />
	<label class='lblFormLong'>Type de l'Horaire : </label>
	<select size="1" id="lstTypeHoraire" style="width:300px;">
		<option <?=(($type_h == 'ETE') ? 'selected' : '') ?> value="ETE">Horaire d'été</option>
		<option <?=(($type_h == 'HIVER') ? 'selected' : '') ?> value="HIVER">Horaire d'hiver</option>
		<option <?=(($type_h == 'ANNEE') ? 'selected' : '') ?> value="ANNEE">Horaire annuel</option>
	</select>
	<br /><br />
	<label class='lblFormLong'>&nbsp;</label><input type='button' value='Valider' onclick='modificationHoraire()' />
	<input type='hidden' value='<?php echo $dep; ?>' id='ancienStg' />
	<input type='hidden' value='<?php echo $ret; ?>' id='ancienAero' />
	
<script type='text/javascript'>
function modificationHoraire()
{
	var depHeureStrasbourg = document.getElementById('depHeureStrasbourg').value;
	var depMinuteStrasbourg = document.getElementById('depMinuteStrasbourg').value;
	var depHeureAero = document.getElementById('depHeureAero').value;
	var depMinuteAero = document.getElementById('depMinuteAero').value;
	var ancienStg = document.getElementById('ancienStg').value;
	var ancienAero = document.getElementById('ancienAero').value;
	var nom = document.getElementById('nom').innerHTML;
	
	// KEMPF : Ajout du type de l'horaire (ETE, HIVER ou ANNEE)
	var lstType = document.getElementById('lstTypeHoraire');
	var typeHoraire = lstType.options[lstType.selectedIndex].value;

	if((!isNaN(depHeureStrasbourg)) && (depHeureStrasbourg>=0 && depHeureStrasbourg<24) && (!isNaN(depMinuteStrasbourg)) && (depMinuteStrasbourg>=0 && depMinuteStrasbourg<60) && (!isNaN(depHeureAero)) && (depHeureAero>=0 && depHeureAero<24) && (!isNaN(depMinuteAero)) && (depMinuteAero>=0 && depMinuteAero<60))
	{
		param = 'action=confirmationModifHoraire&nom='+nom+'&depHeureStrasbourg='+depHeureStrasbourg+'&depMinuteStrasbourg='+depMinuteStrasbourg+'&depHeureAero='+depHeureAero+'&depMinuteAero='+depMinuteAero+'&ancienStg='+ancienStg+'&ancienAero='+ancienAero+'&type='+typeHoraire;
		ajax('./php/traitementAjax.php',param,'confirmationModifHoraire');
	}
	else
	{
		alert("Entrez des valeurs horaires correctes.");
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
			window.close();
		}
		else{}
	}
	else
	{
	}
}
</script>
</body>
</html>