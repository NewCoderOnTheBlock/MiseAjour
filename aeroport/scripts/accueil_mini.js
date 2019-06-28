/* KEMPF :
	Version allégée du formulaire principal
	Celui ci ne contient que certaines fonctionnalités,
	afin de coller avec le nouveau formulaire 
	de la page d'accueil
 */
var form_res = document.getElementById("form_res");

var trajet_aller_simple = document.getElementById("trajet_aller_simple");
var trajet_aller_retour = document.getElementById("trajet_aller_retour");
var type_trajet = document.getElementsByName("type_trajet");
var lst_trajet_depart = document.getElementById("lst_trajet_depart");
var lst_trajet_arrive = document.getElementById("lst_trajet_arrive");
var jour_depart = document.getElementById("jour_depart");
var jour_retour = document.getElementById("jour_retour");
var lbl_jour_depart = document.getElementById('lbl_jour_depart');
var lbl_jour_retour = document.getElementById('lbl_jour_retour');
var jour_retour_long = document.getElementById('jour_retour_long');
var jour_depart_long = document.getElementById('jour_depart_long');
var lst_passager_enfant_aller = document.getElementById('lst_passager_enfant_aller');
var lst_passager_enfant_retour = document.getElementById('lst_passager_enfant_retour');
var lst_passager_adulte_aller = document.getElementById('lst_passager_adulte_aller');
var lst_passager_adulte_retour = document.getElementById('lst_passager_adulte_retour');


	var lst_trajet_depart = document.getElementById("lst_trajet_depart");
	var lst_trajet_arrive = document.getElementById("lst_trajet_arrive");
	var lst_fixe_depart = document.getElementById('lst_fixe_depart');
	var lst_fixe_retour = document.getElementById('lst_fixe_retour');
		var pt_rassemblement_aller = document.getElementById('pt_rassemblement_aller');	
		var pt_rassemblement_retour = document.getElementById('pt_rassemblement_retour');
	var rass_adresse_aller = document.getElementById('rass_adresse_aller');
	var rass_cp_aller = document.getElementById('rass_cp_aller');
	var rass_ville_aller = document.getElementById('rass_ville_aller');
	var rass_adresse_retour = document.getElementById('rass_adresse_retour');
	var rass_cp_retour = document.getElementById('rass_cp_retour');
	var rass_ville_retour = document.getElementById('rass_ville_retour');
	var lst_heure_depart = document.getElementById('lst_heure_depart');
	var lst_heure_retour = document.getElementById('lst_heure_retour');
	var email_client = document.getElementById('email');

var btn_envoie = document.getElementById("btn_envoie");

var tab_dep_org = copie(lst_trajet_depart);
var tab_arr_org = copie(lst_trajet_arrive);

if(lst_trajet_depart.selectedIndex == 0)
	lst_trajet_arrive.disabled = "disabled";
else if(lst_trajet_depart.selectedIndex == lst_trajet_depart.length - 1)
	lst_trajet_arrive.options[lst_trajet_arrive.length - 1] = null;
else
{
	for(var i = lst_trajet_arrive.length - 2; i >= 0; i--)
		lst_trajet_arrive[i] = null;
}

function change_class(display)
{
	var t = document.getElementsByTagName('th');
	for(var i = 0; i < t.length; i++)
	{
		if(t[i].className == "header_tab")
			t[i].style.display = display;
	}
	
	t = document.getElementsByTagName('span');
	for(var i = 0; i < t.length; i++)
	{
		if(t[i].className == "header_tab")
		{
			if(display == "")
				t[i].style.display = "block";
			else
				t[i].style.display = display;
		}
	}
}
	
if(trajet_aller_retour.checked)
{
	document.getElementById('vol_retour').style.display = "block";
	document.getElementById('passager_retour').style.display = "block";
	change_class("");
}

function copie(elt)
{
	var res = new Array();
	res[0] = new Array();
	res[1] = new Array();
	
	for(var i = 0; i < elt.length; i++)
	{
		res[0][i] = elt.options[i].value;
		res[1][i] = elt.options[i].text;
	}
	
	return res;
}


function restaure_dep()
{
	for(var i = 0; i < tab_dep_org[0].length; i++)
		lst_trajet_depart.options[i] = new Option(tab_dep_org[1][i], tab_dep_org[0][i]);
}

function restaure_arr()
{
	for(var i = 0; i < tab_arr_org[0].length; i++)
		lst_trajet_arrive.options[i] = new Option(tab_arr_org[1][i], tab_arr_org[0][i]);
}

function active_a_r()
{
	document.getElementById('etoile_retour').style.display = "none";
	document.getElementById('horaire_fixe_retour').style.display = "none";
	document.getElementById('horaire_fixe_aller').style.display = "none";
	document.getElementById('etoile_depart').style.display = "none";
	change_class("none");
	
	var dep = document.getElementById('lst_trajet_depart');
	var arr = document.getElementById('lst_trajet_arrive');
	
	
	if(dep.options[dep.selectedIndex].value != 100)
	{
		elem_text_heure_vol_1.innerHTML = text_arrivee_vol;
		elem_text_heure_vol_2.innerHTML = text_depart_vol;
		elem_text_rassemblement_aller.innerHTML = text_depose_strasbourg;
		elem_text_rassemblement_retour.innerHTML = text_prise_strasbourg;
	}else{
		elem_text_heure_vol_1.innerHTML = text_depart_vol;
		elem_text_heure_vol_2.innerHTML = text_arrivee_vol;
		elem_text_rassemblement_aller.innerHTML = text_prise_strasbourg;
		elem_text_rassemblement_retour.innerHTML = text_depose_strasbourg;
	}
	
	if(type_trajet[1].checked) /* aller retour */
	{
		document.getElementById('div_rass_retour').style.display = "block";
		document.getElementById("retour").style.display = "block";
		document.getElementById('vol_retour').style.display = "block";
		document.getElementById('passager_retour').style.display = "block";
		change_class("");
		
		
		/* gestion destinations / provenances */
		

		provenance_retour_vol_1.value = provenance_depart_vol_1.value;
		provenance_retour_vol_1.readOnly = provenance_depart_vol_1.readOnly;
		provenance_retour_vol_2.value = provenance_depart_vol_2.value;
		provenance_retour_vol_2.readOnly = provenance_depart_vol_2.readOnly;
				
		lst_fixe_depart = document.getElementById('lst_fixe_depart');
		lst_fixe_retour = document.getElementById('lst_fixe_retour');
		
		for(var i = lst_fixe_retour.length; i >= 0; i--)
			lst_fixe_retour.options[i] = null;
		
		for(var i = lst_fixe_depart.length; i >= 0; i--)
			lst_fixe_depart.options[i] = null;
			
		var id_lieu;
	
		if(lst_trajet_depart.options[lst_trajet_depart.selectedIndex].value == 100)
			id_lieu = lst_trajet_arrive.options[lst_trajet_arrive.selectedIndex].value
		else
			id_lieu = lst_trajet_depart.options[lst_trajet_depart.selectedIndex].value;
			
		var type = "";
		if(lst_trajet_depart.options[lst_trajet_depart.selectedIndex].value == 100)
			type = "depart";
		else
			type = "retour";
		
		var date_demande = document.getElementById('jour_depart').value;
			
		sendRequest('lst_fixe_depart', "depart", type, '', id_lieu, date_demande);
		
		if(lst_trajet_arrive.options[lst_trajet_arrive.selectedIndex].value == 100)
			id_lieu = lst_trajet_depart.options[lst_trajet_depart.selectedIndex].value
		else
			id_lieu = lst_trajet_arrive.options[lst_trajet_arrive.selectedIndex].value;
			
		var type = "";
		if(lst_trajet_depart.options[lst_trajet_depart.selectedIndex].value != 100)
			type = "depart";
		else
			type = "retour";
		
		var date_demande = document.getElementById('jour_retour').value;

		sendRequest('lst_fixe_retour', "retour", type, '', id_lieu, date_demande);	
		
		document.getElementById('horaire_fixe_retour').style.display = "block";
		document.getElementById('etoile_retour').style.display = "inline";
		document.getElementById('horaire_fixe_aller').style.display = "block";
		document.getElementById('etoile_depart').style.display = "inline";
	}
	else
	{
		document.getElementById('div_rass_retour').style.display = "none";
		document.getElementById("retour").style.display = "none";
		document.getElementById('vol_retour').style.display = "none";
		document.getElementById('passager_retour').style.display = "none";
		change_class("none");

		lst_fixe_depart = document.getElementById('lst_fixe_depart');
	
		for(var i = lst_fixe_depart.length; i >= 0; i--)
			lst_fixe_depart.options[i] = null;
			
		if(lst_trajet_depart.options[lst_trajet_depart.selectedIndex].value == 100)
			id_lieu = lst_trajet_arrive.options[lst_trajet_arrive.selectedIndex].value
		else
			id_lieu = lst_trajet_depart.options[lst_trajet_depart.selectedIndex].value;

		var type = "";
		if(lst_trajet_depart.options[lst_trajet_depart.selectedIndex].value == 100)
			type = "depart";
		else
			type = "retour";
		
		var date_demande = document.getElementById('jour_depart').value;
		
		sendRequest('lst_fixe_depart', "depart", type, '', id_lieu, date_demande);	
		
		document.getElementById('horaire_fixe_aller').style.display = "block";
		document.getElementById('etoile_depart').style.display = "inline";
	}
}

function efface_dans_liste(id_dep, id_arr)
{
	var dep = eval(id_dep);
	var arr = eval(id_arr);
	
	var si_dep = dep.options.selectedIndex;
	var si_arr = arr.options.selectedIndex;
	
	if(si_dep == 0)
	{
		restaure_arr();
		arr.disabled = "disabled";
	}
	else	
		arr.disabled = "";
	
	restaure_arr();
	
	dep.options.selectedIndex = si_dep;
	arr.options.selectedIndex = si_arr;	

	if(si_dep == dep.options.length - 1)
		arr.options[arr.options.length - 1] = null;
	else
	{
		for(var i = arr.length - 2; i >= 0; i--)
			arr.options[i] = null;
	}
}



function remove_image()
{
	var fld = document.getElementById("form_res");
	
	try {
		var pic = fld.getElementsByTagName("img");

		for(var i = pic.length; i > 0; i--)
			if(pic[i-1].className != "pointer")
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



function verif()
{
	remove_image();
	
	var res = true;
	
	var lst = new Array(lst_trajet_depart,
						lst_trajet_arrive
						);
		
	if(!trajet_aller_simple.checked && !trajet_aller_retour.checked)
	{
		res = false;
		trajet_aller_simple.parentNode.appendChild(get_image());
	}
	
	for(var i = 0; i < lst.length; i++)	
	{
		if(lst[i].options[lst[i].options.selectedIndex].value == "")
		{
			res = false;
			lst[i].parentNode.appendChild(get_image());
		}
	}
	
	if(lst_heure_depart.selectedIndex == 0)
	{
		if(lst_fixe_depart.selectedIndex == 0)
		{
			res = false;
			lst_heure_depart.parentNode.appendChild(get_image());
		}
	}
	
	if(pt_rassemblement_aller.selectedIndex == 0)
	{
		res = false;
		pt_rassemblement_aller.parentNode.appendChild(get_image());
	}
	
	if(pt_rassemblement_aller.selectedIndex == 4)
	{
		if(rass_adresse_aller.value.length <= 0)
		{
			res = false;
			rass_adresse_aller.parentNode.appendChild(get_image());
		}
		if(rass_cp_aller.value.length <= 0)
		{
			res = false;
			rass_cp_aller.parentNode.appendChild(get_image());
		}
		if(rass_ville_aller.value.length <= 0)
		{
			res = false;
			rass_ville_aller.parentNode.appendChild(get_image());
		}			
	}
	
	if(trajet_aller_retour.checked)
	{
		if(pt_rassemblement_retour.selectedIndex == 0)
		{
			res = false;
			pt_rassemblement_retour.parentNode.appendChild(get_image());
		}
		if(lst_heure_retour.selectedIndex == 0)
		{
			if(lst_fixe_retour.selectedIndex == 0)
			{
				res = false;
				lst_heure_retour.parentNode.appendChild(get_image());
			}
		}
		if(pt_rassemblement_retour.selectedIndex == 4)
		{
			if(rass_adresse_retour.value.length <= 0)
			{
				res = false;
				rass_adresse_retour.parentNode.appendChild(get_image());
			}
			if(rass_cp_retour.value.length <= 0)
			{
				res = false;
				rass_cp_retour.parentNode.appendChild(get_image());
			}
			if(rass_ville_retour.value.length <= 0)
			{
				res = false;
				rass_ville_retour.parentNode.appendChild(get_image());
			}			
		}
	}
	
	if(jour_depart.value.length <= 0)
	{
		res = false;
		jour_depart.parentNode.appendChild(get_image());
	}
	
	if(jour_retour.value.length <= 0 && type_trajet[1].checked)
	{
		res = false;
		jour_retour.parentNode.appendChild(get_image());
	}
	
	if(email_client.value.length <= 0)
	{
		res = false;
		email_client.parentNode.appendChild(get_image());
	}
		
	return res;
}


function verif_date()
{
	var res = true;
	
	if(trajet_aller_retour.checked)
	{
		var tab_aller = jour_depart.value.split('-');
		var j_aller = tab_aller[0];
		var m_aller = tab_aller[1];
		var a_aller = tab_aller[2];
	
		var d_aller = new Date(parseInt(a_aller, 10), (parseInt(m_aller, 10) - 1), parseInt(j_aller, 10));

		var tab_retour = jour_retour.value.split('-');
		var j_retour = tab_retour[0];
		var m_retour = tab_retour[1];
		var a_retour = tab_retour[2];
	
		var d_retour = new Date(parseInt(a_retour, 10), (parseInt(m_retour, 10) - 1), parseInt(j_retour, 10));

		if(d_retour.getTime() - d_aller.getTime() <= (3600 * 24))
			res = false;
	}
	
	return res;
}

function envoie()
{
	var isSubmited = true;
	
	if(verif())
	{
		if(verif_date())
		{
			if(parseInt(lst_passager_adulte_aller.options[lst_passager_adulte_aller.selectedIndex].value) + parseInt(lst_passager_enfant_aller.options[lst_passager_enfant_aller.selectedIndex].value) > 8)
			{
				alert(tab_lang["alert_nb_passager_aller"]);
				isSubmited = false;
			}
			else
			{
				if(trajet_aller_retour.checked)
				{
					if(parseInt(lst_passager_adulte_retour.options[lst_passager_adulte_retour.selectedIndex].value) + parseInt(lst_passager_enfant_retour.options[lst_passager_enfant_retour.selectedIndex].value) > 8)
					{	
						alert(tab_lang["alert_nb_passager_retour"]);
						isSubmited = false;
					}
					else
					{
						form_res.submit();
					}
				}
				else
				{
					form_res.submit();
				}
			}
		}
		else
		{
			isSubmited = false;
			alert(tab_lang["alert_date"]);
		}
	}
	else
	{
		isSubmited = false;
		alert(tab_lang["alert_champ_vide"]);
	}
}


function exclusion(id)
{
	eval(id).selectedIndex = 0;	
}


	function modifier()
	{
		var aller = document.getElementById('pt_rassemblement_aller');
		var choix = aller.selectedIndex;
		var valeur = aller.options[choix].value;
		
		var retour = document.getElementById('pt_rassemblement_retour');
		var choix1 = retour.selectedIndex;
		var valeur1 = retour.options[choix1].value;
		
		if(valeur == 4)
		{
			document.getElementById("rass_aller").style.display='block';
			if(valeur1 == 4)
			{
				document.getElementById("rass_retour").style.display='block';
			}
			else
			{
				document.getElementById("rass_retour").style.display='none';
			}
		}
		else
		{
			document.getElementById("rass_aller").style.display='none';
			if(valeur1 == 4)
			{
				document.getElementById("rass_retour").style.display='block';
			}
			else
			{
				document.getElementById("rass_retour").style.display='none';
			}
		}
	}
	
	
		
	if (lst_trajet_depart.options[lst_trajet_depart.selectedIndex].value == 7 || lst_trajet_arrive.options[lst_trajet_arrive.selectedIndex].value == 7)
	{
		pt_rassemblement_aller.disabled = true;
		pt_rassemblement_retour.disabled = true;
		pt_rassemblement_aller.selectedIndex = pt_rassemblement_aller.length - 1;
		pt_rassemblement_retour.selectedIndex = pt_rassemblement_aller.length - 1;
		
		affiche_info_prise("aller");
		affiche_info_prise("retour");
	}
	else
	{
		pt_rassemblement_aller.disabled = false;
		pt_rassemblement_retour.disabled = false;
		
		affiche_info_prise("aller");
		affiche_info_prise("retour");
	}
	
	function horaire_fixe_retour()
{
	document.getElementById('etoile_retour').style.display = "none";
	document.getElementById('horaire_fixe_retour').style.display = "none";
	document.getElementById('horaire_fixe_aller').style.display = "none";
	document.getElementById('etoile_depart').style.display = "none";
	
	/*
		Ajout KEMPF : 
		Gestion Entzheim
		
		Le choix n'est que disponnible pour domicile
	*/
	gestion_domicile_uniquement();
	
	if(!trajet_aller_retour.checked)
	{
		var id_lieu;
	
		if(lst_trajet_depart.options[lst_trajet_depart.selectedIndex].value == 100)
			id_lieu = lst_trajet_arrive.options[lst_trajet_arrive.selectedIndex].value
		else
			id_lieu = lst_trajet_depart.options[lst_trajet_depart.selectedIndex].value;
			
		var type = "";
		if(lst_trajet_depart.options[lst_trajet_depart.selectedIndex].value == 100)
			type = "depart";
		else
			type = "retour";
		
		var date_demande = document.getElementById('jour_depart').value;
	
		sendRequest('lst_fixe_depart', "depart", type, '', id_lieu, date_demande);	
		
		document.getElementById('horaire_fixe_aller').style.display = "block";
		document.getElementById('etoile_depart').style.display = "inline";
	}
	else
	{					
		var id_lieu;
	
		if(lst_trajet_depart.options[lst_trajet_depart.selectedIndex].value == 100)
			id_lieu = lst_trajet_arrive.options[lst_trajet_arrive.selectedIndex].value;
		else
			id_lieu = lst_trajet_depart.options[lst_trajet_depart.selectedIndex].value;
			
		var type = "";
		if(lst_trajet_depart.options[lst_trajet_depart.selectedIndex].value == 100)
			type = "depart";
		else
			type = "retour";
			
		var date_demande = document.getElementById('jour_depart').value;
		
		sendRequest('lst_fixe_depart', "depart", type, '', id_lieu, date_demande);
	
		if(lst_trajet_arrive.options[lst_trajet_arrive.selectedIndex].value == 100)
			id_lieu = lst_trajet_depart.options[lst_trajet_depart.selectedIndex].value;
		else
			id_lieu = lst_trajet_arrive.options[lst_trajet_arrive.selectedIndex].value;
			
		var type = "";
		if(lst_trajet_depart.options[lst_trajet_depart.selectedIndex].value != 100)
			type = "depart";
		else
			type = "retour";

		date_demande = document.getElementById('jour_retour').value;
		
		sendRequest('lst_fixe_retour', "retour", type, '', id_lieu, date_demande);	
		
		document.getElementById('horaire_fixe_retour').style.display = "block";
		document.getElementById('etoile_retour').style.display = "inline";
		document.getElementById('horaire_fixe_aller').style.display = "block";
		document.getElementById('etoile_depart').style.display = "inline";

	}
}

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
			alert(tab_lang["alert_xhr"]);
			return;
	}

	return xhr;
}


function sendRequest(lst, type, type2, action, lieu, date)
{
	if(type == "depart")
	{
		xhr = get_xhr();
		xhr.onreadystatechange = function(){

			if(xhr.readyState == 4){
				var lst_fixe_depart = document.getElementById('lst_fixe_depart');
				
				for(var i = lst_fixe_depart.length; i >= 0; i--){
					lst_fixe_depart.options[i] = null;
				}
			
				eval(xhr.responseText);
				
				try {

					var trouve = false;
					var lst = document.getElementById('lst_fixe_' + type);

					for(var i = 0; i < lst.length && !trouve; i++)
					{
						if(lst.options[i].value == action)
						{
							trouve = true;
							lst.options[i].selected = true;
						}
					}

				} catch(e) {}
			}
		}
		
		var param = "action=get_horaire_fixe&lst=" + lst + "&type=" + type + "&lieu=" + lieu + "&type2=" + type2 + "&date=" + date;
		
		xhr.open("POST", "ajax.php", true);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send(param);
	}
	else
	{
		xhr2 = get_xhr();
		xhr2.onreadystatechange = function(){

			if(xhr2.readyState == 4){
				var lst_fixe_retour = document.getElementById('lst_fixe_retour');
		
				for(var i = lst_fixe_retour.length; i >= 0; i--){
					lst_fixe_retour.options[i] = null;
				}
				
				eval(xhr2.responseText);
			
				try {
					var trouve = false;
					var lst = document.getElementById('lst_fixe_' + type);
				
					for(var i = 0; i < lst.length && !trouve; i++)
					{
						if(lst.options[i].value == action)
						{
							trouve = true;
							lst.options[i].selected = true;
						}
					}
				} catch(e) { }
			}
		}
		
		var param = "action=get_horaire_fixe&lst=" + lst + "&type=" + type + "&lieu=" + lieu + "&type2=" + type2 + "&date=" + date;
		
		xhr2.open("POST", "ajax.php", true);
		xhr2.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr2.send(param);
	}
	
}

function get_navette_xhr(id_aeroport, id_dest, type)
{
	var xhr = get_xhr();
	
	xhr.onreadystatechange = function(){
		if(xhr.readyState == 4)
		{
			eval(xhr.responseText);
			span_gif.innerHTML = "";
		}
		else
			span_gif.innerHTML = '<img src="images/loader.gif" alt="" />';
	}
	
	var param = "action=get_navette&id_lieu=" + id_aeroport + "&id_dest=" + id_dest + "&type=" + encodeURIComponent(type);
		
	xhr.open("POST", "ajax.php", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send(param);
}


function get_aeroport(id)
{
	var xhr = get_xhr();
	
	xhr.onreadystatechange = function(){
		if(xhr.readyState == 4)
		{
			for(var i = fixe_dest.options.length; i >= 0; i--)
				fixe_dest.options[i] = null;
				
			eval(xhr.responseText);
		}
	}
	
	var param = "action=get_aeroport&id_lieu=" + id;
		
	xhr.open("POST", "ajax.php", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send(param);
}


function get_aeroport_type(type, id_lieu)
{
	var xhr = get_xhr();
	
	xhr.onreadystatechange = function(){
		if(xhr.readyState == 4)
		{
			for(var i = fixe_dest.options.length; i >= 0; i--)
				fixe_dest.options[i] = null;
				
			eval(xhr.responseText);
		}
	}
	
	var param = "action=get_aeroport_type&id_lieu=" + id_lieu + "&type=" + type;
		
	xhr.open("POST", "ajax.php", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send(param);
}


function get_navette_recherche(dep, arr, date)
{
    var xhr = get_xhr();


    xhr.onreadystatechange = function() {
        if(xhr.readyState == 4)
        {

            document.getElementById("loader").style.display = "none";

            var res_recherche_top = document.getElementById("res_recherche_top");

            eval(xhr.responseText);
        }
    }

    var param = "action=get_navette_recherche&dep=" + dep + "&arr=" + arr + "&date=" + date;

    xhr.open("POST", "ajax.php", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send(param);
}

function set_demande_annulee(nom, email, lieu_dep, lieu_dest, etape, prix, simple)
{
    var xhr = get_xhr();

    xhr.onreadystatechange = function() {
        if(xhr.readyState == 4)
        {
			document.getElementById('form_back').submit();
        }
    }

    var param = "action=set_demande_annulee&nom=" + nom + "&email=" + email + "&lieu_dep=" + lieu_dep + "&lieu_dest=" + lieu_dest + "&etape=" + etape + "&prix=" + prix + "&simple=" + simple;

    xhr.open("POST", "ajax.php", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send(param);
}

	
	function affiche_info_prise(block)
{
	if(eval('pt_rassemblement_' + block).selectedIndex == eval('pt_rassemblement_' + block).length - 1)
		eval('rass_' + block).style.display = "block";
	else
		eval('rass_' + block).style.display = "none";
}


btn_envoie.onclick = envoie;

type_trajet[0].onclick = active_a_r;
type_trajet[1].onclick = active_a_r;

lst_trajet_depart.onchange = function () {horaire_fixe_retour(); }
lst_trajet_arrive.onchange = function (){horaire_fixe_retour(); }
lst_trajet_depart.onchange = function (){ efface_dans_liste("lst_trajet_depart", "lst_trajet_arrive");}

window.onload = function() { parseStylesheets(); horaire_fixe_retour(); modifier();}