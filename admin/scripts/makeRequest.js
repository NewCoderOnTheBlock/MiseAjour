function makeRequest(idcm, heureD_str, minuteD_str, heureA_str, minuteA_str, heureA_aero, minuteA_aero, heureD_aero, minuteD_aero) {

	var httpRequest = false;
	var url = "index2.php";

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
	httpRequest.send("p=4&idcm="+idcm+"&heureD_str="+ heureD_str+"&minuteD_str="+ minuteD_str+"&heureA_str="+ heureA_str+"&minuteA_str="+ minuteA_str+"&heureA_aero="+ heureA_aero+"&minuteA_aero="+ minuteA_aero+"&heureD_aero="+ heureD_aero+"&minuteD_aero="+ minuteD_aero);

}

function alertContents(httpRequest) {

	if (httpRequest.readyState == 4) {
		//alert(httpRequest.responseText);
		eval(httpRequest.responseText);
		if (httpRequest.status == 200) {
		} 
		else {
			//alert('toto'+httpRequest.statusText);
			alert('Un problème est survenu avec la requête.');
		}
	}

}
function returnation(booleen){
	if(booleen){
		document.getElementById('formulaire').submit();
	}
}