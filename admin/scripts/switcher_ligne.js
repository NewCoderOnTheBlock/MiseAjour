// JavaScript Document
//window.onerror = erreur;
function switcher_ligne(idLigne, idTrajet, idC, idV){
	
	var trajetDest = parseInt(prompt("Identifiant du trajet de destination"));

	if(!isNaN(trajetDest))
	{
		var estValid = document.getElementById('estValide_'+idTrajet).value;
		makeRequest2("index.php",idLigne, idTrajet, idC, idV, estValid, trajetDest);	
	}
}

function makeRequest2(url,id, numTrajet, idC, idV, estValid, trajetDest) {

	var httpRequest = false;

	if (window.XMLHttpRequest) { // Mozilla, Safari,...
		httpRequest = new XMLHttpRequest();
		if (httpRequest.overrideMimeType) {
			httpRequest.overrideMimeType('text/xml');
			// Voir la note ci-dessous à propos de cette ligne
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
		alert('Abandon :( Impossible de créer une instance XMLHTTP');
		return false;
	}
	httpRequest.onreadystatechange = function() { alertContents2(httpRequest); };
	httpRequest.open('POST', url, true);
	httpRequest.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	httpRequest.send("p=8&ligneResa="+id+"&numTrajet="+numTrajet+"&idC="+idC+"&idV="+idV+"&estValid="+estValid+"&trajetDest="+trajetDest);

}

function alertContents2(httpRequest) {

	if (httpRequest.readyState == 4) {
		if (httpRequest.status == 200) {
			eval(httpRequest.responseText);
		} else {
			alert('Un problème est survenu avec la requête.');
		}
	}

}



function erreur(){
	alert("saisissez uniquement un nombre");
	return true;	
}