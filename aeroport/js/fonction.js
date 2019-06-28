var lang = document.getElementById('hd_lang');

function menuOver(id) // fonction gérant l'affichage des onglets du menu lorsque le curseur survole
{
	if(document.getElementById(id).className != 'selectionnee')
		document.getElementById(id).className = 'currentMenu';
}

function menuOut(id) // fonction gérant l'affichage des onglets du menu lorsque le curseur quitte
{
	if(document.getElementById(id).className != 'selectionnee')
		document.getElementById(id).className ='btnNormal';
}

function btnOver(id)
{
	document.getElementById(id).src='./images/bouton/'+id+"Hover_"+document.getElementById('hd_lang').value+'.png';
}

function btnOut(id)
{
	document.getElementById(id).src='./images/bouton/'+id+"_"+document.getElementById('hd_lang').value+'.png';
}

function overOngletCentre(id)
{
	if(document.getElementById(id).className != 'sousMenuCourantTarifForm')
		document.getElementById(id).style.background = "url('./images/bloc/3c_titre_bloc_centre_actif.png')";
}

function outOngletCentre(id)
{
	if(document.getElementById(id).className != 'sousMenuCourantTarifForm')
		document.getElementById(id).style.background = "url('./images/bloc/3c_titre_bloc_centre_inactif.png')";
}

function affichageTarif(id)
{
	if(id=="titreGaucheCelluleCentrale")
	{
		document.getElementById('formulaire_reservation').style.display="block";
		document.getElementById('zone_tarif').style.display="none";
		document.getElementById('titreGaucheCelluleCentrale').className = "sousMenuCourantTarifForm";
		document.getElementById('titreDroiteCelluleCentrale').className = "";
		document.getElementById('titreDroiteCelluleCentrale').style.background = "url('./images/bloc/3c_titre_bloc_centre_inactif.png')";
		document.getElementById('titreGaucheCelluleCentrale').style.background = "url('./images/bloc/3c_titre_bloc_centre_actif.png')";
	}
	else if(id=="titreDroiteCelluleCentrale")
	{
		document.getElementById('formulaire_reservation').style.display="none";
		document.getElementById('zone_tarif').style.display="block";
		document.getElementById('titreDroiteCelluleCentrale').className = "sousMenuCourantTarifForm";
		document.getElementById('titreGaucheCelluleCentrale').className = "";
		document.getElementById('titreDroiteCelluleCentrale').style.background = "url('./images/bloc/3c_titre_bloc_centre_actif.png')";
		document.getElementById('titreGaucheCelluleCentrale').style.background = "url('./images/bloc/3c_titre_bloc_centre_inactif.png')";
	}
}

function affichageDuree(id)
{
	if(id=="titreGaucheCelluleCentrale")
	{
		document.getElementById('div_horaire').style.display="block";
		document.getElementById('div_duree').style.display="none";
		document.getElementById('titreGaucheCelluleCentrale').className = "sousMenuCourantTarifForm";
		document.getElementById('titreDroiteCelluleCentrale').className = "";
		document.getElementById('titreDroiteCelluleCentrale').style.background = "url('./images/bloc/3c_titre_bloc_centre_inactif.png')";
		document.getElementById('titreGaucheCelluleCentrale').style.background = "url('./images/bloc/3c_titre_bloc_centre_actif.png')";
	}
	else if(id=="titreDroiteCelluleCentrale")
	{
		document.getElementById('div_horaire').style.display="none";
		document.getElementById('div_duree').style.display="block";
		document.getElementById('titreDroiteCelluleCentrale').className = "sousMenuCourantTarifForm";
		document.getElementById('titreGaucheCelluleCentrale').className = "";
		document.getElementById('titreDroiteCelluleCentrale').style.background = "url('./images/bloc/3c_titre_bloc_centre_actif.png')";
		document.getElementById('titreGaucheCelluleCentrale').style.background = "url('./images/bloc/3c_titre_bloc_centre_inactif.png')";
	}
}

function changementSousMenuRecap(id)
{
	
	if(id=="navettePourLesvols")
	{
		document.getElementById("navettePourLesvols").className='menuDeroulantSelection';
		document.getElementById("horaireVersBaden").className='menuDeroulantNonSelection';
		document.getElementById("horaireVersBale").className='menuDeroulantNonSelection';
		document.getElementById("horaireAlaDemande").className='menuDeroulantNonSelection';
		
		document.getElementById('contenuInfoBlocDeroulantNavette').style.display = "block";
		document.getElementById('contenuInfoBlocDeroulantKar_Bad').style.display = "none";
		document.getElementById('contenuInfoBlocDeroulantBal_Mul').style.display = "none";
		document.getElementById('contenuInfoBlocDeroulantDemande').style.display = "none";
		
	}
	else if(id=="horaireVersBaden")
	{
		document.getElementById("navettePourLesvols").className='menuDeroulantNonSelection';
		document.getElementById("horaireVersBaden").className='menuDeroulantSelection';
		document.getElementById("horaireVersBale").className='menuDeroulantNonSelection';
		document.getElementById("horaireAlaDemande").className='menuDeroulantNonSelection';
		
		document.getElementById('contenuInfoBlocDeroulantNavette').style.display = "none";
		document.getElementById('contenuInfoBlocDeroulantKar_Bad').style.display = "block";
		document.getElementById('contenuInfoBlocDeroulantBal_Mul').style.display = "none";
		document.getElementById('contenuInfoBlocDeroulantDemande').style.display = "none";
		
	}
	else if(id=="horaireVersBale")
	{
		document.getElementById("navettePourLesvols").className='menuDeroulantNonSelection';
		document.getElementById("horaireVersBaden").className='menuDeroulantNonSelection';
		document.getElementById("horaireVersBale").className='menuDeroulantSelection';
		document.getElementById("horaireAlaDemande").className='menuDeroulantNonSelection';
		
		document.getElementById('contenuInfoBlocDeroulantNavette').style.display = "none";
		document.getElementById('contenuInfoBlocDeroulantKar_Bad').style.display = "none";
		document.getElementById('contenuInfoBlocDeroulantBal_Mul').style.display = "block";
		document.getElementById('contenuInfoBlocDeroulantDemande').style.display = "none";
	}
	else if(id=="horaireAlaDemande")
	{
		document.getElementById("navettePourLesvols").className='menuDeroulantNonSelection';
		document.getElementById("horaireVersBaden").className='menuDeroulantNonSelection';
		document.getElementById("horaireVersBale").className='menuDeroulantNonSelection';
		document.getElementById("horaireAlaDemande").className='menuDeroulantSelection';

		document.getElementById('contenuInfoBlocDeroulantNavette').style.display = "none";
		document.getElementById('contenuInfoBlocDeroulantKar_Bad').style.display = "none";
		document.getElementById('contenuInfoBlocDeroulantBal_Mul').style.display = "none";
		document.getElementById('contenuInfoBlocDeroulantDemande').style.display = "block";
	}
}

function localisation_google_map(addr)
{
	var inp_aller = "";
	var dist_aller = "";
	var adresse = addr;
	var geocoder = new GClientGeocoder();
	var gps_gare = "48.5844857, 7.7342248";
	geocoder.getLatLng(adresse, function(point)
	{
		if(!point)
		{
			inp_aller=0;
			dist_aller=0;
			adresse_aller=0;
		}
		else
		{
			var directions = new GDirections();
			directions.load("from:" + point.toString().substring(1, point.toString().length-1) + " to:" + gps_gare);

			GEvent.addListener(directions, "load", function(){
					inp_aller = directions.getDuration().seconds;
					dist_aller = directions.getDistance().meters;
					return inp_aller+"||"+dist_aller;
				}
			);
		}
	});
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
		}
		else{}
	}
	else
	{
	}
}