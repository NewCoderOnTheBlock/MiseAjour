var selectionChoixNavette_aller = document.getElementsByName('selectionChoixNavette_aller');
var selectionChoixNavette_retour = document.getElementsByName('selectionChoixNavette_retour');
var hd_aller_retour = document.getElementById('hd_aller_retour'); // champs cachés si aller retour ou non
var boutonEtapeSuivante = document.getElementById('boutonEtapeSuivante');
var chk_autre_passager = document.getElementById('chk_autre_passager');

function recup_radio(type) // fonction recupérant la valeur du radio sélectionné 
{
	if(type=="aller")
	{
		for(var i=0;i<selectionChoixNavette_aller.length;i++)
		{
			if(selectionChoixNavette_aller[i].checked==true)
			{
				return selectionChoixNavette_aller[i].value;
			}
		}
	}
	else if(type=="retour")
	{
		for(var i=0;i<selectionChoixNavette_retour.length;i++)
		{
			if(selectionChoixNavette_retour[i].checked==true)
			{	
				return selectionChoixNavette_retour[i].value;
			}
		}
	}
}

function validation_selection_navette()
{
	var booleanVerif = false;
	// gestion de l'aller
	var rad_aller = recup_radio("aller");
	if(rad_aller!="" && rad_aller!=null && rad_aller!=0) // si il a selectionner une navette aller
	{
		if(chk_autre_passager.checked) // si c'est un autre passager
		{
			if(document.getElementById('txtNom').value!="" && document.getElementById('txtNom').value!=null && document.getElementById('txtMail').value!="" && document.getElementById('txtMail').value!=null && document.getElementById('txtPortable').value!="" && document.getElementById('txtPortable').value!=null && document.getElementById('txtPays').options[document.getElementById('txtPays').selectedIndex].value!=0)
			{
				if(rad_aller!="attend_aller")
					var id_horaire_aller = document.getElementById(rad_aller+"_id_horaire").value;
				else
					id_horaire_aller = rad_aller;
					
				param = "action=selectionNavette_aller&nouvel_horaire_aller="+id_horaire_aller+"&autre_passager=1&nom="+document.getElementById('txtNom').value+"&mail="+document.getElementById('txtMail').value+"&portable="+document.getElementById('txtPortable').value+"&pays="+document.getElementById('txtPays').options[document.getElementById('txtPays').selectedIndex].value;
			}
			else // s'il n'a pas rempli les infos de l'autre passager
			{
				alert('Informations sur l\'autre passager');
				booleanVerif=true;
			}
		}
		else
		{
			if(rad_aller!="attend_aller")
				var id_horaire_aller = document.getElementById(rad_aller+"_id_horaire").value;
			else
				id_horaire_aller = rad_aller;
				
			param = "action=selectionNavette_aller&nouvel_horaire_aller="+id_horaire_aller+"&autre_passager=0";
		}
	}
	else 
	{
		alert('Merci de sélectionner une navette pour l\'aller.');
		booleanVerif=true;
	}
	
	if(hd_aller_retour.value==1 || hd_aller_retour.value=="Aller-retour")
	{
		// gestion du retour
		var rad_retour = recup_radio("retour");
		if(rad_retour!="" && rad_retour!=null && rad_retour!=0) // si il a selectionner une navette retour
		{
			if(chk_autre_passager.checked) // si c'est un autre passager
			{
				if(document.getElementById('txtNom').value!="" && document.getElementById('txtNom').value!=null && document.getElementById('txtMail').value!="" && document.getElementById('txtMail').value!=null && document.getElementById('txtPortable').value!="" && document.getElementById('txtPortable').value!=null && document.getElementById('txtPays').options[document.getElementById('txtPays').selectedIndex].value!=0)
				{
					if(rad_retour!="attend_retour")
						var id_horaire_retour = document.getElementById(rad_retour+"_id_horaire").value;
					else
						id_horaire_retour = rad_retour;
						
					param += "&actionretour=selectionNavette_retour&nouvel_horaire_retour="+id_horaire_retour+"&autre_passager=1&nom="+document.getElementById('txtNom').value+"&mail="+document.getElementById('txtMail').value+"&portable="+document.getElementById('txtPortable').value+"&pays="+document.getElementById('txtPays').options[document.getElementById('txtPays').selectedIndex].value;
				}
				else // s'il n'a pas rempli les infos de l'autre passager
				{
					alert('Informations sur l\'autre passager');
					booleanVerif=true;
				}
			}
			else
			{
				if(rad_retour!="attend_retour")
					var id_horaire_retour = document.getElementById(rad_retour+"_id_horaire").value;
				else
					id_horaire_retour = rad_retour;
				param += "&actionretour=selectionNavette_retour&nouvel_horaire_retour="+id_horaire_retour+"&autre_passager=0";
			}
		}
		else 
		{
			alert('Merci de sélectionner une navette pour le retour.');
			booleanVerif=true;
		}
	}
	if(!booleanVerif)
	{
		ajax("./php/traitementAjax.php",param,"selectionNavette");
	}
}

function selection_autre_passager()
{
	if(chk_autre_passager.checked)
	{
		document.getElementById('txtNom').disabled=false;
		document.getElementById('txtMail').disabled=false;
		document.getElementById('txtPortable').disabled=false;
		document.getElementById('txtPays').disabled=false;
	}
	else
	{
		document.getElementById('txtNom').disabled=true;
		document.getElementById('txtMail').disabled=true;
		document.getElementById('txtPortable').disabled=true;
		document.getElementById('txtPays').disabled=true;
		document.getElementById('txtNom').value='';
		document.getElementById('txtMail').value='';
		document.getElementById('txtPortable').value='';
		document.getElementById('txtPays').selectedIndex=0;
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
			if(xhr.responseText)
			{
				window.location.href="./confirmation.php";
			}
			else
			{
			
			}
		}
		else{}
	}
	else
	{
	}
}
/** FIN FONCTION AJAX **/

boutonEtapeSuivante.onclick = validation_selection_navette
chk_autre_passager.onchange = selection_autre_passager