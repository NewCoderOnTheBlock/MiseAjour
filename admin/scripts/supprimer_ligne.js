function supprimer_ligne(id, numTrajet, idC, idV){
	if(confirm("Voulez vous vraiment supprimer cette ligne de réservation ? (toute supression est permanente et irréversible !)")){
		
		var estValid = document.getElementById('estValide_'+numTrajet).value;

		makeRequest("index.php",id, numTrajet, idC, idV, estValid);	
		document.getElementById("ligne"+id).style.display="none";
	}
	
}


function makeRequest(url,id, numTrajet, idC, idV, estValid) {

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
	httpRequest.onreadystatechange = function() { alertContents(httpRequest); };
	httpRequest.open('POST', url, true);
	httpRequest.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	httpRequest.send("p=7&ligneResa="+id+"&numTrajet="+numTrajet+"&idC="+idC+"&idV="+idV+"&estValid="+estValid);

}

function alertContents(httpRequest) {

	if (httpRequest.readyState == 4) {
		eval(httpRequest.responseText);
		if (httpRequest.status == 200) {
		} else {
			alert('Un problème est survenu avec la requête.');
		}
	}

}
