var nom_client = document.getElementById('nom_client');
var prenom_client = document.getElementById('prenom_client');
var email_client = document.getElementById('email_client');
var tel_fixe = document.getElementById('tel_client');
var tel_port = document.getElementById('port_client');
var ville_client = document.getElementById('ville_client');
var adresse_client = document.getElementById('adresse_client');
var cp_client = document.getElementById('code_post_client');
var ville_client = document.getElementById('ville_client');
var form_res = document.getElementById("form_res");
var lst_pays = document.getElementById('pays_client');

var tab_input = new Array(nom_client,
				prenom_client,
				email_client,
				ville_client);

var btn_raz = document.getElementById("raz");
var btn_envoie = document.getElementById("btn_envoie");


btn_raz.onclick = raz;
btn_envoie.onclick = envoie;


function remove_image()
{
	var fld = document.getElementById("form_res");
	
	try {
		var pic = fld.getElementsByTagName("img");

		for(var i = pic.length; i > 0; i--)
				pic[i-1].parentNode.removeChild(pic[i-1]);
	}
	catch (e) {}
}



function get_image()
{
	var img = document.createElement('img');
	img.setAttribute('src', 'images/error.png');
	img.setAttribute('alt', 'Attention');

	return img;
}


function valid_mail(mail)
{
	var regexMail = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-zA-Z]{2,4}$/;
	
	if(regexMail.test(mail))
		return true;
	else
		return false;
}


function verif_tel()
{
	remove_image();
	var reg = /[ _.-]+/g;
	
	var res = true;

	if(tel_fixe.value != "")
	{
		if(reg.test(tel_fixe.value))
		{
			tel_fixe.parentNode.appendChild(get_image());
			res = false;
		}
	}
	
	if(tel_port.value != "")
	{
		if(reg.test(tel_port.value))
		{
			tel_port.parentNode.appendChild(get_image());
			res = false;
		}
		else
		{
			if(res)
				res = true;
		}
	}

	return res;
}


function verif()
{
	remove_image();
	
	var res = true;
		
	for(var i = 0; i < tab_input.length; i++)
	{
		if(tab_input[i].value == "")
		{
			res = false;
			tab_input[i].parentNode.appendChild(get_image());
		}
	}
	
	if(tel_fixe.value == "" && tel_port.value == "")
	{
		res = false;
		
		tel_fixe.parentNode.appendChild(get_image());
		tel_port.parentNode.appendChild(get_image());
	}
	
	
	/*
	if(tel_fixe.value != "" && !verif_tel())
		res = false;
		
	if(tel_port.value != "" && !verif_tel())
		res = false;
	*/
	
	if(!valid_mail(email_client.value))
		res = false;
	
	if(lst_pays.selectedIndex == 0)
	{
		res = false;
		//lst_pays.parentNode.appendChild(get_image());
	}

	return res;
}


function raz()
{
	if(confirm(tab_lang["confirm_raz"]))
	{
		remove_image();
		
		for(var i = 0; i < tab_input.length; i++)
			tab_input[i].value = "";
			
		lst_pays.selectedIndex = 0;
		document.getElementById('lst_civ').selectedIndex = 0;
		tel_fixe.value = "";
		tel_port.value = "";
			
		cp_client.value = "";
		adresse_client.value = "";
	}
}



function envoie()
{
	if(verif())
	{
		if(verif_tel())
			form_res.submit();		
		else
			alert(tab_lang["alert_telephone"]);
	}
	//else
		//alert(tab_lang["alert_champ_vide"]);
}