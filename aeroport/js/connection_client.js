var txtMailConnection = document.getElementById('txtMailConnection');
var txtMdpConnection = document.getElementById('txtMdpConnection');
var boutonEnvoyer = document.getElementById('boutonEnvoyer');
var txtCivilite = document.getElementById('txtCivilite');
var txtNom = document.getElementById('txtNom');
var txtPrenom = document.getElementById('txtPrenom');
var txtTelephone = document.getElementById('txtTelephone');
var txtPortable = document.getElementById('txtPortable');
var txtMail = document.getElementById('txtMail');
var txtConfirmationMail = document.getElementById('txtConfirmationMail');
var txtMdp = document.getElementById('txtMdp');
var txtConfirmationMdp = document.getElementById('txtConfirmationMdp');
var txtadresse = document.getElementById('txtadresse');
var txtCodePostal = document.getElementById('txtCodePostal');
var txtVille = document.getElementById('txtVille');
var txtPays = document.getElementById('txtPays');
var boutonEtapeSuivante = document.getElementById('boutonEtapeSuivante');

function connection_deja_client()
{
	if(txtMailConnection.value!="" && txtMailConnection.value!=null && txtMdpConnection.value!="" && txtMdpConnection.value!=null)
	{
		param = "action=connectionClient&mail="+txtMailConnection.value+"&mdp="+txtMdpConnection.value;
		ajax("./php/traitementAjax.php",param,"connectionClient");
	}
}

function connection_nouveau_client()
{
	if(txtNom.value!="" && txtNom.value!=null && txtPrenom.value!="" && txtPrenom.value!=null && txtTelephone.value!="" && txtTelephone.value!=null && txtPortable.value!="" && txtPortable.value!=null && txtMail.value!="" && txtMail.value!=null && txtConfirmationMail.value!="" && txtConfirmationMail.value!=null && txtMdp.value!="" && txtMdp.value!=null && txtConfirmationMdp.value!="" && txtConfirmationMdp.value!=null && txtadresse.value!="" && txtadresse.value!=null && txtCodePostal.value!="" && txtCodePostal.value!=null && txtVille.value!="" && txtVille.value!=null && txtPays.options[txtPays.selectedIndex].value!=0)
	{
		if(txtMail.value==txtConfirmationMail.value && txtMdp.value==txtConfirmationMdp.value)
		{
			param = "action=nouveauClient&civilite="+txtCivilite.options[txtCivilite.selectedIndex].text+"&nom="+txtNom.value+"&prenom="+txtPrenom.value+"&telephone="+txtTelephone.value+"&portable="+txtPortable.value+"&mail="+txtMail.value+"&adresse="+txtadresse.value+"&cp="+txtCodePostal.value+"&ville="+txtVille.value+"&pays="+txtPays.options[txtPays.selectedIndex].value+"&mdp="+txtMdp.value;
			ajax("./php/traitementAjax.php",param,"nouveauClient");
		}
	}
}

/** FONCTION AJAX **/
function ajax(url,param,choix)
{
	var httpRequest = false;
	
	if (window.XMLHttpRequest) {
		httpRequest = new XMLHttpRequest();
		if (httpRequest.overrideMimeType)
			httpRequest.overrideMimeType('text/xml');
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

function traiter(xhr,choix)
{
	if (xhr.readyState == 4)
	{
		if (xhr.status == 200) 
		{
			if(xhr.responseText) // si tout est ok : soit nouveau client, soit connexion déjà existant
			{
				window.location.href='./selection_navette.php';
			}
		}
		else{}
	}
	else
	{
	}
}
/** FIN FONCTION AJAX **/

boutonEnvoyer.onclick = connection_deja_client
boutonEtapeSuivante.onclick = connection_nouveau_client