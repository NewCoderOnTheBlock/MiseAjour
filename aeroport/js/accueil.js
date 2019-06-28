var txtDepart = document.getElementById('txtDepart'); // lieu de depart
var txtDestination = document.getElementById('txtDestination'); // lieu de destination
var trajet_aller_simple = document.getElementById('trajet_aller_simple'); // radio aller simple
var trajet_aller_retour = document.getElementById('trajet_aller_retour'); // radio aller retour
var txtDateAller = document.getElementById('txtDateAller'); // date aller
var txtDateRetour = document.getElementById('txtDateRetour'); // date aller
var txtAdulteAller = document.getElementById('txtAdulteAller'); // adulte aller
var txtEnfantAller = document.getElementById('txtEnfantAller'); // enfant aller
var txtAdulteRetour = document.getElementById('txtAdulteRetour'); // adulte Retour
var txtEnfantRetour = document.getElementById('txtEnfantRetour'); // enfant Retour
var copie_txtDepart = copie_liste(txtDepart); // copie de la liste d'aeroport du depart
var copie_txtDestination = copie_liste(txtDestination); // copie de la liste d'aeroport de la destination
txtDestination.disabled=true;
var boutonEtapeSuivante = document.getElementById('boutonEtapeSuivante');


function gestion_liste_a_r()
{
	if(txtDepart.value!=0) // si le depart est selectionne
	{
		txtDestination.disabled=false; // on reactive la liste destination
		if(txtDepart.value==1) // si depart = strasbourg
		{
			for(var i=0;i<txtDestination.options.length;i++)
			{
				if(txtDestination.options[i].value==1)
				{
					txtDestination.options[i]=null;
				}
			}
		}
		else // sinon
		{
			restaure_destination();
			for(var i=0;i<txtDestination.options.length;i++)
			{
				if(txtDestination.options[i].value==1)
				{
					txtDestination.options[i].selected="selected";	
					txtDestination.disabled=true;
				}
			}
		}
	}
	else
	{
		txtDestination.disabled=true; // on reactive la liste destination
	}
}

function gestion_formulaire_aller_retour()
{
	if(this.id=="trajet_aller_simple") // si c'est un aller simple, on cache le retour
	{
		txtAdulteRetour.disabled=true;
		txtAdulteRetour.selectedIndex=0;
		txtEnfantRetour.disabled=true;
		txtEnfantRetour.selectedIndex=0;
		txtDateRetour.disabled=true;
		txtDateRetour.value='';
	}
	else // si c'est aller retour
	{
		txtAdulteRetour.disabled=false;
		txtEnfantRetour.disabled=false;
		txtDateRetour.disabled=false;
	}
}


function copie_liste(a) // permet de faire une copie d'une liste
{
	var c=new Array();
	c[0]=new Array();
	c[1]=new Array();
	for(var b=0;b<a.length;b++)
	{
		c[0][b]=a.options[b].value;
		c[1][b]=a.options[b].text;
	}
	return c;
}

function restaure_depart() // restaure la liste des trajets de depart
{
	for(var a=0;a<copie_txtDepart[0].length;a++)
		txtDepart.options[a]=new Option(copie_txtDepart[1][a],copie_txtDepart[0][a]);
}

function restaure_destination() // restaure la liste des trajets de arrive
{
	for(var a=0;a<copie_txtDestination[0].length;a++)
	{
		txtDestination.options[a]=new Option(copie_txtDestination[1][a],copie_txtDestination[0][a]);
	}
}

function validation_formulaire_index()
{
	if(trajet_aller_simple.checked)
		var aller_retour=0;
	else
		var aller_retour=1;
		
	param = 'action=validationIndex&aller_retour='+aller_retour+'&txtDepart='+txtDepart.options[txtDepart.selectedIndex].value+"&index_txtDestination="+txtDestination.options[txtDestination.selectedIndex].value+"&txtDateAller="+txtDateAller.value+"&txtDateRetour="+txtDateRetour.value+"&txtAdulteAller="+txtAdulteAller.options[txtAdulteAller.selectedIndex].value+"&txtEnfantAller="+txtEnfantAller.options[txtEnfantAller.selectedIndex].value+"&txtAdulteRetour="+txtAdulteRetour.options[txtAdulteRetour.selectedIndex].value+"&txtEnfantRetour="+txtEnfantRetour.options[txtEnfantRetour.selectedIndex].value;
	ajax('./php/traitementAjax.php',param,"validationIndex");
}

function connection()
{
	var email = document.getElementById('email').value;
	var pass = document.getElementById('pass').value;
	param = 'action=connectionClient&mail='+email+"&mdp="+pass;
	ajax('./php/traitementAjax.php',param,"connectionClient");
}

function deconnexion()
{
	param = 'action=deconnexion';
	ajax('./php/traitementAjax.php',param,"deconnexion");
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
			if(choix=="validationIndex")
			{
				window.location.href='./reservation.php';
			}
			else if(choix=="connectionClient")
			{
				if(xhr.responseText) // si la connection est ok
				{
					window.location.reload();
				}
			}
			else if(choix=="deconnexion")
			{
				window.location.href="./index.php";
			}
		}
		else{}
	}
	else
	{
	}
}
/** FIN FONCTION AJAX **/

trajet_aller_simple.onclick = gestion_formulaire_aller_retour;
trajet_aller_retour.onclick = gestion_formulaire_aller_retour;
txtDepart.onchange = gestion_liste_a_r;
txtDestination.onchange = gestion_liste_a_r;
boutonEtapeSuivante.onclick = validation_formulaire_index;