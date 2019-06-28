<?php
	include("verifAuth.php");
?>
<style type='text/css'>
#fsAjoutVehicule{
	margin-top:40px;
	width:550px;
	padding: 30px;
	margin-left:auto;
	margin-right:auto;
	border:1px dashes #777;
	font-family:Arial;
}

#lgtAjoutVehicule{
	border : 1px outset #AAA;
	padding:5px;
	font-size:10pt;
	font-weight:bold;
}

#msgConfirmation{
font-size:10pt;
}

.lblFormulaire{
	display:block;
	float:left;
	width:250px;

}

.txtFormulaire{
	float:left;
	width:250px;
}
</style>

<fieldset id='fsAjoutVehicule'>
	<legend id='lgtAjoutVehicule'>Ajout d'un véhicule</legend>
	<div id='msgConfirmation'></div>
	<br /><br />
	<label for='txtType' id='lblTxtType' class='lblFormulaire'>Type du véhicule</label><input type='text' class='txtFormulaire' id='txtType' />
	<br /><br />
	<label for='txtCapacite' id='lblTxtCapacite' class='lblFormulaire'>Capacité du véhicule</label><input type='text' class='txtFormulaire' id='txtCapacite' />
	<br /><br />
	<label class='lblFormulaire'>&nbsp;</label><input type='button' class='txtFormulaire' id='btnValider' value="Valider" onclick='ajoutVehicule()' />
	<br /><br />
</fieldset>


<script type='text/javascript'>
function ajoutVehicule()
{
	var type = document.getElementById('txtType').value;
	var capacite = document.getElementById('txtCapacite').value;

	if(isNaN(capacite))
	{
		document.getElementById('msgConfirmation').innerHTML = "<label class='lblFormulaire'>&nbsp;</label><div class='txtFormulaire' style='color:red;width:300px;'>Le champ capacité doit contenir un nombre..</div>";
		document.getElementById('txtCapacite').value="";
		document.getElementById('txtCapacite').focus();
	}
	else if(type=='')
	{
		document.getElementById('msgConfirmation').innerHTML = "<label class='lblFormulaire'>&nbsp;</label><div class='txtFormulaire' style='color:red;width:300px;'>Le type du véhicule doit être signalé..</div>";
	}
	else if(capacite=='')
	{
		document.getElementById('msgConfirmation').innerHTML = "<label class='lblFormulaire'>&nbsp;</label><div class='txtFormulaire' style='color:red;width:300px;'>La capacité du véhicule doit être signalée..</div>";
	}
	else
	{
		param = "action=ajoutVehicule&type="+type+"&capacite="+capacite;
		ajax("./php/traitementAjax.php",param,"POST",true,"ajoutVehicule");
	}
}

/** FONCTION AJAX **/
function ajax(url,param,methode,mode,choix)
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
	httpRequest.open(methode,url,mode);
	httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=iso-8859-15');
	httpRequest.send(param);
}

function traiter(httpRequest,choix)
{
	if (httpRequest.readyState == 4)
	{
		if (httpRequest.status == 200) 
		{
			if(httpRequest.responseText=="")
			{
				document.getElementById('msgConfirmation').innerHTML = "<label class='lblFormulaire'>&nbsp;</label><div class='txtFormulaire' style='color:green'>Opération réussie.</div>";
				document.getElementById('txtCapacite').value="";
				document.getElementById('txtType').value="";
			}
			else
			{
				document.getElementById('msgConfirmation').innerHTML = "<label class='lblFormulaire'>&nbsp;</label><div class='txtFormulaire' style='color:red'>Opération échouée.</div>";
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

