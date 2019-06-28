
var form_res = document.getElementById("form_res");

var trajet_aller_simple = document.getElementById("trajet_aller_simple");
var trajet_aller_retour = document.getElementById("trajet_aller_retour");
var type_trajet = document.getElementsByName("type_trajet");
var lst_trajet_depart = document.getElementById("lst_trajet_depart");
var lst_trajet_arrive = document.getElementById("lst_trajet_arrive");
var pt_rassemblement_aller = document.getElementById("pt_rassemblement_aller");
var pt_rassemblement_retour = document.getElementById("pt_rassemblement_retour");
var jour_depart = document.getElementById("jour_depart");
var jour_retour = document.getElementById("jour_retour");
var lst_heure_depart = document.getElementById("lst_heure_depart");
var lst_heure_retour = document.getElementById("lst_heure_retour");
var lst_fixe_depart = document.getElementById('lst_fixe_depart');
var lst_fixe_retour = document.getElementById('lst_fixe_retour');
var lbl_jour_depart = document.getElementById('lbl_jour_depart');
var lbl_jour_retour = document.getElementById('lbl_jour_retour');
var jour_depart = document.getElementById('jour_depart');
var jour_retour = document.getElementById('jour_retour');
var jour_retour_long = document.getElementById('jour_retour_long');
var jour_depart_long = document.getElementById('jour_depart_long');
var rass_adresse_aller = document.getElementById('rass_adresse_aller');
var rass_cp_aller = document.getElementById('rass_cp_aller');
var rass_ville_aller = document.getElementById('rass_ville_aller');
var rass_adresse_retour = document.getElementById('rass_adresse_retour');
var rass_cp_retour = document.getElementById('rass_cp_retour');
var rass_ville_retour = document.getElementById('rass_ville_retour');
var rass_aller = document.getElementById('rass_aller');
var rass_retour = document.getElementById('rass_retour');
var heure_fixe_aller = document.getElementById('heure_fixe_aller');
var heure_fixe_retour = document.getElementById('heure_fixe_retour');
var info_compl = document.getElementById('info_compl');
var lst_passager_enfant_aller = document.getElementById('lst_passager_enfant_aller');
var lst_passager_enfant_retour = document.getElementById('lst_passager_enfant_retour');
var lst_passager_adulte_aller = document.getElementById('lst_passager_adulte_aller');
var lst_passager_adulte_retour = document.getElementById('lst_passager_adulte_retour');
var div_bebe_aller = document.getElementById('passager_aller_enfant');
var div_bebe_retour = document.getElementById('passager_retour_enfant');
var compagnie_depart_vol = document.getElementById('compagnie_depart_vol');
var provenance_depart_vol_1 = document.getElementById('provenance_depart_vol_1');
var provenance_depart_vol_2 = document.getElementById('provenance_depart_vol_2');
var heure_depart_vol = document.getElementById('heure_depart_vol');
var minute_depart_vol = document.getElementById('minute_depart_vol');
var compagnie_retour_vol = document.getElementById('compagnie_retour_vol');
var provenance_retour_vol_1 = document.getElementById('provenance_retour_vol_1');
var provenance_retour_vol_2 = document.getElementById('provenance_retour_vol_2');
var heure_retour_vol = document.getElementById('heure_retour_vol');
var minute_retour_vol = document.getElementById('minute_retour_vol');
var accept_cgv = document.getElementById("accept_cgv");



var res_1 = document.getElementById('res_1');

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

if(pt_rassemblement_aller.selectedIndex == pt_rassemblement_aller.length - 1)
	rass_aller.style.display = "block";
	
if(pt_rassemblement_retour.selectedIndex == pt_rassemblement_retour.length - 1)
	rass_retour.style.display = "block";
	
if(lst_passager_enfant_aller.selectedIndex != 0)
	div_bebe_aller.style.display = "block";
	
if(lst_passager_enfant_retour.selectedIndex != 0)
	div_bebe_retour.style.display = "block";

/*
	Ajout KEMPF : 
	Gestion Entzheim
	
	Le choix n'est que disponnible pour domicile
*/

function gestion_domicile_uniquement()
{
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
		pt_rassemblement_aller.selectedIndex = 0;
		pt_rassemblement_retour.selectedIndex = 0;
		
		affiche_info_prise("aller");
		affiche_info_prise("retour");
	}
}
gestion_domicile_uniquement();

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
	document.getElementById('div_rass_retour').style.display = "block";
	document.getElementById('passager_retour').style.display = "block";
	change_class("");
}

/* Gestion des horaires fixes */
// KEMPF : A savoir :	Les aéroports bénéficiants 
// 						d'horaires fixes sont ici gérés au cas par cas et non par depuis la BDD
if(	
	// Bale Mulhouse
	lst_trajet_depart.options[lst_trajet_depart.selectedIndex].value == 1 ||
	lst_trajet_arrive.options[lst_trajet_arrive.selectedIndex].value == 1 ||
	// Baden Baden 
	lst_trajet_depart.options[lst_trajet_depart.selectedIndex].value == 2 ||
	lst_trajet_arrive.options[lst_trajet_arrive.selectedIndex].value == 2 ||
	// Bruxelles
	lst_trajet_depart.options[lst_trajet_depart.selectedIndex].value == 9 ||
	lst_trajet_arrive.options[lst_trajet_arrive.selectedIndex].value == 9 
)
{
	if(!trajet_aller_retour.checked)
	{
		if(lst_trajet_depart.options[lst_trajet_depart.selectedIndex].value != 100)
			provenance_depart_vol_1.readOnly = "readOnly";
		else
			provenance_depart_vol_2.readOnly = "readOnly";
		
		
		lst_fixe_depart = document.getElementById('lst_fixe_depart');
		
		for(var i = lst_fixe_depart.length; i >= 0; i--)
			lst_fixe_depart.options[i] = null;
			
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
		
		sendRequest('lst_fixe_depart', "depart", type, heure_fixe_aller.value, id_lieu);
		
		lst_fixe_depart.selectedIndex = heure_fixe_aller.value;
		
		document.getElementById('horaire_fixe_aller').style.display = "block";
		document.getElementById('etoile_depart').style.display = "inline";
	}
	else
	{
		if(lst_trajet_depart.options[lst_trajet_depart.selectedIndex].value != 100)
		{
			provenance_depart_vol_1.readOnly = "readOnly";

			provenance_retour_vol_1.readOnly = "readOnly";
		}
		else
		{
			provenance_depart_vol_2.readOnly = "readOnly";

			provenance_retour_vol_2.readOnly = "readOnly";
		}
		
		
		lst_fixe_depart = document.getElementById('lst_fixe_depart');
			
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
			
		sendRequest('lst_fixe_depart', "depart", type, heure_fixe_aller.value, id_lieu);
		
		lst_fixe_retour = document.getElementById('lst_fixe_retour');
		
		for(var i = lst_fixe_retour.length; i >= 0; i--)
			lst_fixe_retour.options[i] = null;
			
		var id_lieu;
		
		if(lst_trajet_arrive.options[lst_trajet_arrive.selectedIndex].value == 100)
			id_lieu = lst_trajet_depart.options[lst_trajet_depart.selectedIndex].value
		else
			id_lieu = lst_trajet_arrive.options[lst_trajet_arrive.selectedIndex].value;
			
		var type = "";
		if(lst_trajet_depart.options[lst_trajet_depart.selectedIndex].value != 100)
			type = "depart";
		else
			type = "retour";
			
		sendRequest('lst_fixe_retour', "retour", type, heure_fixe_retour.value, id_lieu);
		
		document.getElementById('horaire_fixe_retour').style.display = "block";
		document.getElementById('etoile_retour').style.display = "inline";
		document.getElementById('horaire_fixe_aller').style.display = "block";
		document.getElementById('etoile_depart').style.display = "inline";
	}
}




var tab_input_rass_aller = new Array(rass_adresse_aller, rass_cp_aller, rass_ville_aller);
var tab_input_rass_retour = new Array(rass_adresse_retour, rass_cp_retour, rass_ville_retour);

var btn_raz = document.getElementById("btn_raz");
var btn_envoie = document.getElementById("btn_envoie");



var tab_lst_bebe_aller = new Array("lst_passager_enfant_aller_g0",
								   "lst_passager_enfant_aller_g1",
								   "lst_passager_enfant_aller_g2",
								   "lst_passager_enfant_aller_g3");


var tab_lst_bebe_retour = new Array("lst_passager_enfant_retour_g0",
								   "lst_passager_enfant_retour_g1",
								   "lst_passager_enfant_retour_g2",
								   "lst_passager_enfant_retour_g3");


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


function raz()
{
	if(confirm(tab_lang["confirm_raz"]))
	{
		restaure_dep();
		restaure_arr();
		remove_image();
		lbl_jour_depart.innerHTML = tab_lang["choix_jour_depart"];
		lbl_jour_retour.innerHTML = tab_lang["choix_jour_retour"] 
		jour_depart.value = "";
		jour_retour.value = "";
		jour_retour_long.value = "";
		jour_depart_long.value = "";
			
		type_trajet[0].checked = false;
		type_trajet[1].checked = false;
		
		pt_rassemblement_aller.disabled = false;
		pt_rassemblement_retour.disabled = false;

		rass_aller.style.display = "none";
		rass_retour.style.display = "none";
		rass_adresse_aller.value = "";
		rass_cp_aller.value = "";
		rass_ville_aller.value = "";
		rass_adresse_retour.value = "";
		rass_cp_retour.value = "";
		rass_ville_retour.value = "";
		info_compl.value = "";
		compagnie_depart_vol.value = "";
		provenance_depart_vol_1.value = "";
		provenance_depart_vol_2.value = "";
		heure_depart_vol.value = "";
		compagnie_retour_vol.value = "";
		provenance_retour_vol_1.value = "";
		provenance_retour_vol_2.value = "";
		heure_retour_vol.value = "";
		document.getElementById('etoile_retour').style.display = "none";
		document.getElementById('horaire_fixe_retour').style.display = "none";
		document.getElementById('horaire_fixe_aller').style.display = "none";
		document.getElementById('etoile_depart').style.display = "none";
		
		var lsts = document.getElementsByTagName('select');
		for(var i = 0; i < lsts.length; i++)
			lsts[i].selectedIndex = 0;
	}
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
		
		
		if(dep.options[dep.selectedIndex].value == 2 || arr.options[arr.selectedIndex].value == 2 || dep.options[dep.selectedIndex].value == 1 || arr.options[arr.selectedIndex].value == 1)
		{
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
				
			sendRequest('lst_fixe_depart', "depart", type, '', id_lieu);
			
			if(lst_trajet_arrive.options[lst_trajet_arrive.selectedIndex].value == 100)
				id_lieu = lst_trajet_depart.options[lst_trajet_depart.selectedIndex].value
			else
				id_lieu = lst_trajet_arrive.options[lst_trajet_arrive.selectedIndex].value;
				
			var type = "";
			if(lst_trajet_depart.options[lst_trajet_depart.selectedIndex].value != 100)
				type = "depart";
			else
				type = "retour";
	
			sendRequest('lst_fixe_retour', "retour", type, '', id_lieu);	
			
			document.getElementById('horaire_fixe_retour').style.display = "block";
			document.getElementById('etoile_retour').style.display = "inline";
			document.getElementById('horaire_fixe_aller').style.display = "block";
			document.getElementById('etoile_depart').style.display = "inline";
		}
	}
	else
	{
		document.getElementById('div_rass_retour').style.display = "none";
		document.getElementById("retour").style.display = "none";
		document.getElementById('vol_retour').style.display = "none";
		document.getElementById('passager_retour').style.display = "none";
		change_class("none");

		if(dep.options[dep.selectedIndex].value == 2 || arr.options[arr.selectedIndex].value == 2 || dep.options[dep.selectedIndex].value == 1 || arr.options[arr.selectedIndex].value == 1)
		{
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
			
			sendRequest('lst_fixe_depart', "depart", type, '', id_lieu);	
			
			document.getElementById('horaire_fixe_aller').style.display = "block";
			document.getElementById('etoile_depart').style.display = "inline";
		}
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
	
	document.getElementById('etoile_depart').style.display = "none";
	document.getElementById('horaire_fixe_aller').style.display = "none";
	document.getElementById('etoile_retour').style.display = "none";
	document.getElementById('horaire_fixe_retour').style.display = "none";
	
	
	provenance_depart_vol_1.readOnly = "";
	provenance_depart_vol_1.value = "";
	
	provenance_retour_vol_1.readOnly = "";
	provenance_retour_vol_1.value = "";
	
	provenance_depart_vol_2.readOnly= "";
	provenance_depart_vol_2.value = "";

	provenance_retour_vol_2.readOnly = "";
	provenance_retour_vol_2.value = "";
	
	
	if(!trajet_aller_retour.checked)
	{
		/* gestion des destinations / provenance */
		
		if(dep.options[dep.selectedIndex].value != 100)
		{
			provenance_depart_vol_1.value = dep.options[dep.selectedIndex].text;
			provenance_depart_vol_1.readOnly = "readonly";
		}
		
		
		if(dep.options[dep.selectedIndex].value == 2 || arr.options[arr.selectedIndex].value == 2 || dep.options[dep.selectedIndex].value == 1 || arr.options[arr.selectedIndex].value == 1)
		{
			lst_fixe_depart = document.getElementById('lst_fixe_depart');
		
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
			
			sendRequest('lst_fixe_depart', "depart", type, '', id_lieu);	
			
			document.getElementById('horaire_fixe_aller').style.display = "block";
			document.getElementById('etoile_depart').style.display = "inline";
		}
	}
	else
	{
		if(dep.options[dep.selectedIndex].value != 100)
		{
			provenance_depart_vol_1.value = dep.options[dep.selectedIndex].text;
			provenance_depart_vol_1.readOnly = "readOnly";
			
			provenance_retour_vol_1.value = dep.options[dep.selectedIndex].text;
			provenance_retour_vol_1.readOnly = "readOnly";
		}
		
		
		if(dep.options[dep.selectedIndex].value == 2 || arr.options[arr.selectedIndex].value == 2 || dep.options[dep.selectedIndex].value == 1 || arr.options[arr.selectedIndex].value == 1)
		{
			lst_fixe_depart = document.getElementById('lst_fixe_depart');
			
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
				
			sendRequest('lst_fixe_depart', "depart", type, '', id_lieu);
			
			lst_fixe_retour = document.getElementById('lst_fixe_retour');
			
			for(var i = lst_fixe_retour.length; i >= 0; i--)
				lst_fixe_retour.options[i] = null;
				
			var id_lieu;
		
			if(lst_trajet_arrive.options[lst_trajet_arrive.selectedIndex].value == 100)
				id_lieu = lst_trajet_depart.options[lst_trajet_depart.selectedIndex].value
			else
				id_lieu = lst_trajet_arrive.options[lst_trajet_arrive.selectedIndex].value;
				
			var type = "";
			if(lst_trajet_depart.options[lst_trajet_depart.selectedIndex].value != 100)
				type = "depart";
			else
				type = "retour";
					
			sendRequest('lst_fixe_retour', "retour", type, '', id_lieu);	
			
			document.getElementById('horaire_fixe_retour').style.display = "block";
			document.getElementById('etoile_retour').style.display = "inline";
			document.getElementById('horaire_fixe_aller').style.display = "block";
			document.getElementById('etoile_depart').style.display = "inline";
		}
	}
	
	/*
		Ajout KEMPF : 
		Gestion Entzheim
		
		Le choix n'est que disponnible pour domicile
	*/
	gestion_domicile_uniquement();
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
						lst_trajet_arrive,
						pt_rassemblement_aller
						);
	
	if(lst_heure_depart.selectedIndex == 0 && document.getElementById('lst_fixe_depart').selectedIndex == 0)
	{
		res = false;
		lst_heure_depart.parentNode.appendChild(get_image());
		document.getElementById('lst_fixe_depart').parentNode.appendChild(get_image());
	}
	
	
	
	if(trajet_aller_retour.checked)
	{
		if(lst_heure_retour.selectedIndex == 0 && document.getElementById('lst_fixe_retour').selectedIndex == 0)
		{
			res = false;
			lst_heure_retour.parentNode.appendChild(get_image());
			document.getElementById('lst_fixe_retour').parentNode.appendChild(get_image());
		}
	}
	
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
	
	if(trajet_aller_retour.checked)
	{
		if(pt_rassemblement_retour.selectedIndex <= 0)
		{
			res = false;
			pt_rassemblement_retour.parentNode.appendChild(get_image());
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

	
	if(pt_rassemblement_aller.selectedIndex == pt_rassemblement_aller.length - 1)
	{
		for(var i = 0; i < tab_input_rass_aller.length; i++)
		{
			if(tab_input_rass_aller[i].value == "")
			{
				res = false;
				tab_input_rass_aller[i].parentNode.appendChild(get_image());
			}
		}
	}
	
	if(trajet_aller_retour.checked)
	{
		if(pt_rassemblement_retour.selectedIndex == pt_rassemblement_retour.length - 1)
		{
			for(var i = 0; i < tab_input_rass_retour.length; i++)
			{
				if(tab_input_rass_retour[i].value == "")
				{
					res = false;
					tab_input_rass_retour[i].parentNode.appendChild(get_image());
				}
			}
		}

		var tab = new Array(compagnie_retour_vol, provenance_retour_vol_1,  provenance_retour_vol_2);
	
		for(var i = 0; i < tab.length; i++)
		{
			if(tab[i].value == "")
			{
				res = false;
				tab[i].parentNode.appendChild(get_image());
			}
		}

		if(heure_retour_vol.selectedIndex == 0)
		{
			res = false;
			heure_retour_vol.parentNode.appendChild(get_image());
		}
		
		if(minute_retour_vol.selectedIndex == 0)
		{
			res = false;
			minute_retour_vol.parentNode.appendChild(get_image());
		}
	}
	
	var tab = new Array(compagnie_depart_vol, provenance_depart_vol_1, provenance_depart_vol_2);
	
	for(var i = 0; i < tab.length; i++)
	{
		if(tab[i].value == "")
		{
			res = false;
			tab[i].parentNode.appendChild(get_image());
		}
	}
	
	if(heure_depart_vol.selectedIndex == 0)
	{
		res = false;
		heure_depart_vol.parentNode.appendChild(get_image());
	}
	
	if(minute_depart_vol.selectedIndex == 0)
	{
		res = false;
		minute_depart_vol.parentNode.appendChild(get_image());
	}
	
	
	if(lst_passager_enfant_aller.options[lst_passager_enfant_aller.selectedIndex].value != 0)
	{
		var r = false;
		for(var i = 0; i < tab_lst_bebe_aller.length && !r; i++)
		{
			var lst = document.getElementById(tab_lst_bebe_aller[i]);
			
			if(lst.selectedIndex != 0)
				r = true;
		}
		
		if(!r)
		{
			res = false;
			
			for(var i = 0; i < tab_lst_bebe_aller.length; i++)
			{
				var lst = document.getElementById(tab_lst_bebe_aller[i]);
				
				lst.parentNode.appendChild(get_image());
			}
		}
	}
	
	
	if(lst_passager_enfant_retour.options[lst_passager_enfant_retour.selectedIndex].value != 0)
	{
		var r = false;
		
		for(var i = 0; i < tab_lst_bebe_retour.length && !r; i++)
		{
			var lst = document.getElementById(tab_lst_bebe_retour[i]);
			
			if(lst.selectedIndex != 0)
				r = true;
		}
		
		if(!r)
		{
			res = false;
			
			for(var i = 0; i < tab_lst_bebe_retour.length; i++)
			{
				var lst = document.getElementById(tab_lst_bebe_retour[i]);
				
				lst.parentNode.appendChild(get_image());
			}
		}
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
	}

	return res;
}


function verif_mail()
{
	var regexMail = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;

	if(regexMail.test(email_client.value))
		return true;
	else
	{
		email_client.parentNode.appendChild(get_image());
		return false;
	}
}



function envoie()
{
	var isSubmited = true;
	pt_rassemblement_aller.disabled = false;
	pt_rassemblement_retour.disabled = false;
	
	if(verif())
	{
		var r = true;
		if(lst_trajet_depart.options[lst_trajet_depart.selectedIndex].value == 2 || lst_trajet_arrive.options[lst_trajet_arrive.selectedIndex].value == 2)
		{
			if(lst_heure_depart.selectedIndex != 0 && document.getElementById('lst_fixe_depart').selectedIndex != 0)
			{
				r = false;
				lst_heure_depart.parentNode.appendChild(get_image());
				document.getElementById('lst_fixe_depart').parentNode.appendChild(get_image());
			}
			
			if(trajet_aller_retour.checked)
			{
				if(lst_heure_retour.selectedIndex != 0 && document.getElementById('lst_fixe_retour').selectedIndex != 0)
				{
					r = false;
					lst_heure_retour.parentNode.appendChild(get_image());
					document.getElementById('lst_fixe_retour').parentNode.appendChild(get_image());
				}
			}
		}
		
		var r2 = true
		if(lst_passager_enfant_aller.options[lst_passager_enfant_aller.selectedIndex].value != 0)
		{
			var somme = 0;
			for(var i = 0; i < tab_lst_bebe_aller.length; i++)
			{
				var lst = document.getElementById(tab_lst_bebe_aller[i]);

				somme += lst.selectedIndex;
			}
			
			if(somme != lst_passager_enfant_aller.options[lst_passager_enfant_aller.selectedIndex].value)
			{
				for(var i = 0; i < tab_lst_bebe_aller.length; i++)
				{
					var lst = document.getElementById(tab_lst_bebe_aller[i]);
	
					lst.parentNode.appendChild(get_image());
				}
				
				r2 = false;
			}
		}
		
		if(lst_passager_enfant_retour.options[lst_passager_enfant_retour.selectedIndex].value != 0)
		{
			var somme = 0;
			for(var i = 0; i < tab_lst_bebe_retour.length; i++)
			{
				var lst = document.getElementById(tab_lst_bebe_retour[i]);

				somme += lst.selectedIndex;
			}
			
			if(somme != lst_passager_enfant_retour.options[lst_passager_enfant_retour.selectedIndex].value)
			{
				for(var i = 0; i < tab_lst_bebe_retour.length; i++)
				{
					var lst = document.getElementById(tab_lst_bebe_retour[i]);
	
					lst.parentNode.appendChild(get_image());
				}
				
				r2 = false;
			}
		}
		
		
		if(r)
		{
			if(verif_date())
			{
				if(r2)
				{
					if(accept_cgv.checked)
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
									res_1.value = 1;
									form_res.submit();
								}
							}
							else
							{
								res_1.value = 1;
								form_res.submit();
							}
						}
					}
					else
					{
						isSubmited = false;
						accept_cgv.parentNode.appendChild(get_image());
						alert(tab_lang["alert_accept_cgv"]);
					}
				}
				else
				{
					isSubmited = false;
					alert(tab_lang["alert_bebe"]);
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
			alert(tab_lang["alert_heure"]);
		}
	}
	else
	{
		isSubmited = false;
		alert(tab_lang["alert_champ_vide"]);
	}
	
	if (!isSubmited)
	{
		gestion_domicile_uniquement();
	}
}



function affiche_info_prise(block)
{
	if(eval('pt_rassemblement_' + block).selectedIndex == eval('pt_rassemblement_' + block).length - 1)
		eval('rass_' + block).style.display = "block";
	else
		eval('rass_' + block).style.display = "none";
}


function horaire_fixe_retour()
{
	document.getElementById('etoile_retour').style.display = "none";
	document.getElementById('horaire_fixe_retour').style.display = "none";
	document.getElementById('horaire_fixe_aller').style.display = "none";
	document.getElementById('etoile_depart').style.display = "none";
	
	var dep = document.getElementById('lst_trajet_depart');
	var arr = document.getElementById('lst_trajet_arrive');
	
	
	provenance_depart_vol_2.readOnly = "";
	provenance_depart_vol_2.value = "";
	
	provenance_depart_vol_1.readOnly = "";
	provenance_depart_vol_1.value = "";
	
	provenance_retour_vol_2.readOnly = "";
	provenance_retour_vol_2.value = "";
	
	provenance_retour_vol_1.readOnly = "";
	provenance_retour_vol_1.value = "";
	
	/*
		Ajout KEMPF : 
		Gestion Entzheim
		
		Le choix n'est que disponnible pour domicile
	*/
	gestion_domicile_uniquement();
	
	if(!trajet_aller_retour.checked)
	{
		/* gestion des destinations / provenance */
		
		if(dep.options[dep.selectedIndex].value == 100)
		{
			provenance_depart_vol_2.value = arr.options[arr.selectedIndex].text;
			provenance_depart_vol_2.readOnly = "readOnly";
		}
		
		
		if(dep.options[dep.selectedIndex].value == 2 || arr.options[arr.selectedIndex].value == 2 || dep.options[dep.selectedIndex].value == 1 || arr.options[arr.selectedIndex].value == 1)
		{
			lst_fixe_depart = document.getElementById('lst_fixe_depart');
		
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
			
			sendRequest('lst_fixe_depart', "depart", type, '', id_lieu);	
			
			document.getElementById('horaire_fixe_aller').style.display = "block";
			document.getElementById('etoile_depart').style.display = "inline";
		}
	}
	else
	{
		
		/* gestion des destinations / provenances */

		
		if(dep.options[dep.selectedIndex].value == 100)
		{
			provenance_depart_vol_2.value = arr.options[arr.selectedIndex].text;
			provenance_depart_vol_2.readOnly = "readOnly";
			
			provenance_retour_vol_2.value = arr.options[arr.selectedIndex].text;
			provenance_retour_vol_2.readOnly = "readOnly";
		}
		
		
		if(dep.options[dep.selectedIndex].value == 2 || arr.options[arr.selectedIndex].value == 2 || dep.options[dep.selectedIndex].value == 1 || arr.options[arr.selectedIndex].value == 1)
		{
			lst_fixe_depart = document.getElementById('lst_fixe_depart');
			lst_fixe_retour = document.getElementById('lst_fixe_retour');
			
			for(var i = lst_fixe_retour.length; i >= 0; i--)
				lst_fixe_retour.options[i] = null;
			
			for(var i = lst_fixe_depart.length; i >= 0; i--)
				lst_fixe_depart.options[i] = null;
				
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
				
			sendRequest('lst_fixe_depart', "depart", type, '', id_lieu);
		
			if(lst_trajet_arrive.options[lst_trajet_arrive.selectedIndex].value == 100)
				id_lieu = lst_trajet_depart.options[lst_trajet_depart.selectedIndex].value;
			else
				id_lieu = lst_trajet_arrive.options[lst_trajet_arrive.selectedIndex].value;
				
			var type = "";
			if(lst_trajet_depart.options[lst_trajet_depart.selectedIndex].value != 100)
				type = "depart";
			else
				type = "retour";
	
			sendRequest('lst_fixe_retour', "retour", type, '', id_lieu);	
			
			document.getElementById('horaire_fixe_retour').style.display = "block";
			document.getElementById('etoile_retour').style.display = "inline";
			document.getElementById('horaire_fixe_aller').style.display = "block";
			document.getElementById('etoile_depart').style.display = "inline";
		}
	}
}



function dimension_textarea(event)
{
	if(window.event)
		event = window.event;

	var reg = /\n/g;

	this.rows = Math.ceil((((this.value).length) / 49));
	
	var tab;
	if(tab = (this.value).match(reg))
		this.rows += tab.length;
}


function dimension_textarea2(id)
{
	if(window.event)
		event = window.event;

	var reg = /\n/g;
	var nb_lig = Math.ceil((((id.value).length) / 49));

	if(nb_lig == 0)
		nb_lig = 2;
		
	id.rows = nb_lig;
	
	var tab;
	if(tab = (id.value).match(reg))
		id.rows += tab.length;
}


function bebe(type)
{
	var lst = eval('lst_passager_enfant_' + type);
	var style;
	
	if(lst.options[lst.selectedIndex].value != 0)
	{
		for(var i = 0; i < eval('tab_lst_bebe_' + type).length; i++)
		{
			for(var k = 0; k < lst.options.length; k++)
				document.getElementById(eval('tab_lst_bebe_' + type)[i]).options[k] = new Option(lst.options[k].text, lst.options[k].value);
			
			for(var j = lst.options.length; j > lst.options[lst.selectedIndex].value; j--)
				document.getElementById(eval('tab_lst_bebe_' + type)[i]).options[j] = null;
		}
		
		style = "block";
	}
	else
		style = "none";
	
	eval('div_bebe_' + type).style.display = style;
}


function exclusion(id)
{
	eval(id).selectedIndex = 0;	
}





info_compl.onkeyup = dimension_textarea;


dimension_textarea2(info_compl);

btn_raz.onclick = raz;
btn_envoie.onclick = envoie;

type_trajet[0].onclick = active_a_r;
type_trajet[1].onclick = active_a_r;

lst_trajet_depart.onchange = function (){ efface_dans_liste("lst_trajet_depart", "lst_trajet_arrive");}
lst_trajet_arrive.onchange = horaire_fixe_retour;

lst_fixe_depart.onchange = function() { exclusion("lst_heure_depart"); }
lst_fixe_retour.onchange = function() { exclusion("lst_heure_retour"); }

lst_heure_depart.onchange = function() { exclusion("lst_fixe_depart"); }
lst_heure_retour.onchange = function() { exclusion("lst_fixe_retour"); }

pt_rassemblement_aller.onchange = function() { affiche_info_prise("aller"); }
pt_rassemblement_retour.onchange = function() { affiche_info_prise("retour"); }



lst_passager_enfant_aller.onchange = function() { bebe('aller'); }
lst_passager_enfant_retour.onchange = function() { bebe('retour'); }


window.onload = function() { parseStylesheets(); }
