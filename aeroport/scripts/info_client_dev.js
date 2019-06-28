var nom_client = document.getElementById('nom_client');
var prenom_client = document.getElementById('prenom_client');
var email_client = document.getElementById('email_client');
var verif_email_client = document.getElementById('verif_email_client');
var tel_fixe = document.getElementById('tel_client');
var tel_port = document.getElementById('port_client');
var ville_client = document.getElementById('ville_client');
var ind_port = document.getElementById("indicatif_port");
var ind_fixe = document.getElementById("indicatif_fixe");

var btn_continuer = document.getElementById('btn_envoie');
var btn_raz = document.getElementById('raz');

var form = document.getElementById('form_info_client');


function raz()
{
	if(confirm(tab_lang["confirm_raz"]))
	{
		tel_fixe.value = "";
		tel_port.value = "";
		nom_client.value = "";
		prenom_client.value = "";
		email_client.value = "";
		document.getElementById("adresse_client").value = "";
		document.getElementById("code_post_client").value = "";
		ville_client.value = "";
	}
}


function remove_image()
{
	var fld = document.getElementById("form_info_client");
	
	try {
		var pic = fld.getElementsByTagName("img");

		for(var i = pic.length; i > 0; i--)
			if(pic[i-1].className != "pointer")
				pic[i-1].parentNode.removeChild(pic[i-1]);
	}
	catch (e) {}

    document.getElementById("img_fixe").style.visibility = "hidden";
    document.getElementById("img_port").style.visibility = "hidden";
}



function get_image()
{
	var img = document.createElement('img');
	img.setAttribute('src', 'images/error.png');
	img.setAttribute('alt', 'Attention');

	return img;
}


function affiche_attention(type)
{
    document.getElementById("img_" + type).style.visibility = "";
}


function verif_tel()
{
	remove_image();
	
	var reg =new RegExp("^[0-9]+$","g");
	var res = true;

	if(tel_fixe.value != "")
	{
		if(!reg.test(tel_fixe.value))
		{
			tel_fixe.parentNode.appendChild(get_image());
			res = false;
		}
	}

	if(tel_port.value != "")
	{
        var reg2 =new RegExp("^[0-9]+$","g");

		if(!reg2.test(tel_port.value))
		{
			tel_port.parentNode.appendChild(get_image());
			res = false;
		}
	}

	return res;
}


function verif_ind()
{
    var res = true;

    if(ind_fixe.selectedIndex == 0 && tel_fixe.value != "")
    {
        affiche_attention("fixe");
        res = false;
    }

    if(ind_port.selectedIndex == 0 && tel_port.value != "")
    {
        affiche_attention("port");
        res = false;
    }

    return res;
}


function verif_mail()
{
	var regexMail = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-zA-Z]{2,4}$/;

	if(regexMail.test(email_client.value) && verif_email_client.value == email_client.value)
		return true;
	else
	{
		email_client.parentNode.appendChild(get_image());
		verif_email_client.parentNode.appendChild(get_image());
		return false;
	}
}


function verif()
{
	var tab_input = new Array(nom_client,
							prenom_client,
							email_client,
							ville_client
							);
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

    if(ind_fixe.selectedIndex == 0 && tel_fixe.value != "")
        affiche_attention("fixe");

    if(ind_port.selectedIndex == 0 && tel_port.value != "")
        affiche_attention("port");
	
	return res;
}


function envoie()
{
	remove_image();
	
	if(verif())
	{
		if(verif_tel())
		{
            if(verif_ind())
            {
                if(verif_mail())
                    form.submit();
                else
                    alert(tab_lang["alert_mail"]);
            }
            else
                alert(tab_lang["alert_ind"]);
		}
		else
			alert(tab_lang["alert_telephone"]);
	}					
	else
		alert(tab_lang["alert_champ_vide"]);
}


function indicatif(type)
{
    if(type == "fixe")
        document.getElementById("ind_fixe").value = "(+" + ind_fixe.options[ind_fixe.selectedIndex].text.replace(/.*- /g, '') + ")";
    else
        document.getElementById("ind_port").value = "(+" + ind_port.options[ind_port.selectedIndex].text.replace(/.*- /g, '') + ")";
}


function ind()
{
    if(ind_fixe.selectedIndex != 0)
        document.getElementById("ind_fixe").value = "(+" + ind_fixe.options[ind_fixe.selectedIndex].text.replace(/.*- /g, '') + ")";

    if(ind_port.selectedIndex != 0)
        document.getElementById("ind_port").value = "(+" + ind_port.options[ind_port.selectedIndex].text.replace(/.*- /g, '') + ")";
}


ind_port.onchange = function() { indicatif("port"); };
ind_fixe.onchange = function() { indicatif("fixe"); };


btn_continuer.onclick = envoie;
btn_raz.onclick = raz;

window.onload = ind;
