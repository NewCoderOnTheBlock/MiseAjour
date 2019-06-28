function deconnexion()
{
	param = 'action=deconnexion';
	ajax('./php/traitementAjax.php',param,"deconnexion");
}

function modifier_info_compte() // modifier les informations du profil du client
{
	var txtCivilite = document.getElementById('txtCivilite');
	var txtNom = document.getElementById('txtNom');
	var txtPrenom = document.getElementById('txtPrenom');
	var txtTelephone = document.getElementById('txtTelephone');
	var txtPortable = document.getElementById('txtPortable');
	var txtadresse = document.getElementById('txtadresse');
	var txtCodePostal = document.getElementById('txtCodePostal');
	var txtVille = document.getElementById('txtVille');
	var txtPays = document.getElementById('txtPays');

	if(txtNom.value!="" && txtNom.value!=null && txtPrenom.value!="" && txtPrenom.value!=null && txtTelephone.value!="" && txtTelephone.value!=null && txtPortable.value!="" && txtPortable.value!=null && txtadresse.value!="" && txtadresse.value!=null && txtCodePostal.value!="" && txtCodePostal.value!=null && txtVille.value!="" && txtVille.value!=null && txtPays.options[txtPays.selectedIndex].value!=0)
	{
			param = "action=modificationClient&civilite="+txtCivilite.options[txtCivilite.selectedIndex].text+"&nom="+txtNom.value+"&prenom="+txtPrenom.value+"&telephone="+txtTelephone.value+"&portable="+txtPortable.value+"&adresse="+txtadresse.value+"&cp="+txtCodePostal.value+"&ville="+txtVille.value+"&pays="+txtPays.options[txtPays.selectedIndex].value;
			ajax("./php/traitementAjax.php",param,"modificationClient");
	}
}

function modifier_identifiants()
{	
	var txtAncienMail = document.getElementById('txtAncienMail');
	var txtMail = document.getElementById('txtMail');
	var txtConfirmationMail = document.getElementById('txtConfirmationMail');
	
	var txtAncienMdp = document.getElementById('txtAncienMdp');
	var txtMdp = document.getElementById('txtMdp');
	var txtConfirmationMdp = document.getElementById('txtConfirmationMdp');
		
	if(txtAncienMail.value!="" && txtAncienMail.value!=null && txtMail.value!="" && txtMail.value!=null && txtConfirmationMail.value!="" && txtConfirmationMail.value!=null && txtMdp.value!="" && txtMdp.value!=null && txtConfirmationMdp.value!="" && txtConfirmationMdp.value!=null && txtAncienMdp.value!="" && txtAncienMdp!=null)
	{
		if(txtMail.value==txtConfirmationMail.value && txtMdp.value==txtConfirmationMdp.value)
		{
			param = "action=modificationIdentifiant&ancienMail="+txtAncienMail.value+"&mail="+txtMail.value+"&mdp="+txtMdp.value+"&ancienMdp="+txtAncienMdp.value;
			ajax("./php/traitementAjax.php",param,"modificationIdentifiant");
		}
	}
}

function affichage_reservation(id)
{
	// on multiplie l'id par 31 pour ne pas pouvoir modifier les infos
	var lst_reservation = document.getElementsByName('liste_reservation');
	
	if(document.getElementById('reservation'+id).style.display=='block')
		document.getElementById('reservation'+id).style.display='none';
	else if(document.getElementById('reservation'+id).style.display=='none')
	{
		for(var i=0;i<lst_reservation.length;i++)
		{
			lst_reservation[i].style.display='none';
		}
		document.getElementById('reservation'+id).style.display='block';
	}
	//alert(id)
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
			if(choix=="deconnexion")
			{
				window.location.href="./index.php";
			}
			else if(choix=="modificationClient")
			{
				if(xhr.responseText)
				{
					window.location.reload();
				}
			}
			else if(choix=="modificationIdentifiant")
			{
				if(xhr.responseText)
				{
					window.location.href="./index.php";
				}
				else
				{
					alert(xhr.responseText)
				}
			}
		}
		else{}
	}
	else
	{
	}
}
/** FIN FONCTION AJAX **/