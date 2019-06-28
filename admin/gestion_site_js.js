
// renvoi un objet XMLHttpRequest
function get_xhr()
{
	var xhr;
	if(window.XMLHttpRequest || window.ActiveXObject) {
			if(window.XMLHttpRequest) {
					xhr = new XMLHttpRequest();
			} 
			else {
					try {
							xhr = new ActiveXObject("Msxml2.XMLHTTP");
					} catch(e) {
							xhr = new ActiveXObject("Microsoft.XMLHTTP");
					}
			}
	}
	else {
			alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest...");
			return;
	}

	
	return xhr;
}



// function qui appel du coté php la fonction de redimension d'une image
function redimensionner()
{
	var xhr = get_xhr();
	
	var loader = document.getElementById("loader");
	
	xhr.onreadystatechange = function(){

		if(xhr.readyState == 4)
			eval(xhr.responseText);
		else
			loader.innerHTML = '<img src="images/loader.gif" alt="" />';
			
	}
	
	xhr.open("POST", "redim_image.php", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send(null);
}



// change le mode (online/offline) pour la modification de la configuration
function change_mode(value)
{
	var mode_online = document.getElementById('online');
	var mode_offline = document.getElementById('offline');

	if(value == "online")
	{
		mode_online.style.display = "block";
		mode_offline.style.display = "none";
	}
	else
	{
		mode_online.style.display = "none";
		mode_offline.style.display = "block";
	}
}