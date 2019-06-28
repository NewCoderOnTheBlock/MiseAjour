/* KEMPF :
	Version allégée du formulaire principal
	Celui ci ne contient que certaines fonctionnalités,
	afin de coller avec le nouveau formulaire 
	de la page d'accueil
 */

window.addEventListener('load', function() {
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
	//var lst_passager_enfant_aller = document.getElementById('lst_passager_enfant_aller');
	//var lst_passager_enfant_retour = document.getElementById('lst_passager_enfant_retour');
	var lst_passager_adulte_aller = document.getElementById('lst_passager_adulte_aller');
	var lst_passager_adulte_retour = lst_passager_adulte_aller;


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
	var provenance = document.getElementById('provenance_depart_vol_2');

	var btn_envoie = document.getElementById("btn_envoie");

	var tab_dep_org = copie(lst_trajet_depart);
	var tab_arr_org = copie(lst_trajet_arrive);

	if(lst_trajet_depart.selectedIndex == 0)
		lst_trajet_arrive.disabled = "disabled";
	else if(lst_trajet_depart.options[lst_trajet_depart.selectedIndex].value == 100)
	{
		var i = 0;
		var trouve = false;
		while (i < lst_trajet_arrive.length && !trouve)
		{
			if (lst_trajet_arrive.options[i].value == 100)
			{
				lst_trajet_arrive.options[i] = null;
				trouve = true;
			}
			else
			{
				i++;
			}
		}
	}	
	else
	{
		lst_trajet_arrive.innerHTML = "";
		var option = document.createElement('option');
		option.value = '100';
		option.innerHTML = 'Strasbourg';
		lst_trajet_arrive.appendChild(option);
	}


	if(trajet_aller_retour.checked)
	{
		document.getElementById('vol_retour').style.display = "block";
		//document.getElementById('passager_retour').style.display = "block";
		change_class("");
	}
	else if (trajet_aller_simple.checked)
	{
		document.getElementById('vol_retour').style.display = "none";
		change_class("none");
	}
	else
	{
		trajet_aller_retour.checked = true;
		document.getElementById('vol_retour').style.display = "block";
		change_class("");
	}

	if (btn_envoie)
	{
		btn_envoie.onclick = envoie;
	}

	type_trajet[0].onclick = active_a_r;
	type_trajet[1].onclick = active_a_r;

	var arrivee = lst_trajet_arrive.options[lst_trajet_arrive.options.selectedIndex].value;
	var depart = lst_trajet_depart.options[lst_trajet_depart.options.selectedIndex].value;
	var div_fixe_aller = document.getElementById('horaires_fixes_depart');
	var div_fixe_retour = document.getElementById('horaire_fixe_retour');

	if (depart == 7 || arrivee == 7)
	{
		if (div_fixe_aller)
			div_fixe_aller.style.display = 'none';
		if (div_fixe_retour)
			div_fixe_retour.style.display = 'none';
	}
	else
	{
		if (div_fixe_aller)
			div_fixe_aller.style.display = 'block';
		if (trajet_aller_retour.checked && div_fixe_retour)
		{
			div_fixe_retour.style.display = 'block';
		}
	}

	lst_trajet_arrive.onchange = function (){
		var arrivee = lst_trajet_arrive.options[lst_trajet_arrive.options.selectedIndex].value;
		var div_fixe_aller = document.getElementById('horaires_fixes_depart');
		var div_fixe_retour = document.getElementById('horaire_fixe_retour');
		if (arrivee == 7)
		{
			if (div_fixe_aller)
				div_fixe_aller.style.display = 'none';
			if (div_fixe_retour)
			div_fixe_retour.style.display = 'none';
		}
		else
		{
			if (div_fixe_aller)
				div_fixe_aller.style.display = 'block';
			if (trajet_aller_retour.checked && div_fixe_retour)
			{
				div_fixe_retour.style.display = 'block';
			}
		}
		AjoutOptionAuSelect(); 
	}
	lst_trajet_depart.onchange = function (){ 
		efface_dans_liste("lst_trajet_depart", "lst_trajet_arrive");
		var depart = lst_trajet_depart.options[lst_trajet_depart.options.selectedIndex].value;
		var div_fixe_aller = document.getElementById('horaires_fixes_depart');
		var div_fixe_retour = document.getElementById('horaire_fixe_retour');
		if (depart == 7)
		{
			if (div_fixe_aller)
				div_fixe_aller.style.display = 'none';
			if (div_fixe_retour)
				div_fixe_retour.style.display = 'none';
		}
		else
		{
			if (div_fixe_aller)
				div_fixe_aller.style.display = 'block';
			if (trajet_aller_retour.checked && div_fixe_retour)
			{
				div_fixe_retour.style.display = 'block';
			}
		}
	}

	parseStylesheets(); 
	AjoutOptionAuSelect();
	modifier();

	function change_class(display)
	{
		var t = document.getElementsByTagName('th');
		for(var i = 0; i < t.length; i++)
		{
			if(t[i].className == "header_tab")
				t[i].style.display = display;
		}
		
		t = document.getElementsByTagName('div');
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
		change_class("none");
		
		var dep = document.getElementById('lst_trajet_depart');
		var arr = document.getElementById('lst_trajet_arrive');
		var retour = document.getElementById('retour');
		
		if(type_trajet[1].checked) /* aller retour */
		{
			document.getElementById('vol_retour').style.display = "block";
			if (retour)
			{
				retour.style.display = "block";
			}
			//document.getElementById('passager_retour').style.display = "block";
			change_class("");
			//document.getElementById('aller').style.display = "block";
		}
		else
		{
			document.getElementById('vol_retour').style.display = "none";
			if (retour)
			{
				retour.style.display = "none";
			}
			//document.getElementById('passager_retour').style.display = "none";
			//document.getElementById('aller').style.display = "none";		
			change_class("none");
			for(var i = lst_fixe_retour.length; i >= 0; i--)
			{
				lst_fixe_retour.options[i] = null;
			}

			var opt21 = document.createElement('option');
			opt21.value = "0";
			opt21.innerHTML = "- - h - -";
			lst_fixe_retour.appendChild(opt21);
			var retour = document.getElementById('lbl_jour_retour');
			retour.innerHTML = tab_lang.jour_retour;
		}
	}

	function efface_dans_liste(id_dep, id_arr)
	{
		var dep = eval(id_dep);
		var arr = eval(id_arr);
		var liste_dep = document.getElementById('lst_trajet_depart');
		var liste_arr = document.getElementById('lst_trajet_arrive');
		
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
		var valdep = liste_dep.options[si_dep].value;
		var valarr = liste_arr.options[si_arr].value;

		if(si_dep && valdep != 100)
		{
			lst_trajet_arrive.innerHTML = "";
			var option = document.createElement('option');
			option.value = '100';
			option.innerHTML = 'Strasbourg';
			lst_trajet_arrive.appendChild(option);
		}
		if (si_dep && valdep == 100)
		{
			var i = 0;
			var trouve = false;
			while (i < lst_trajet_arrive.length && !trouve)
			{
				if (lst_trajet_arrive.options[i].value == 100)
				{
					lst_trajet_arrive.options[i] = null;
					trouve = true;
				}
				else
				{
					i++;
				}
			}
		}
		AjoutOptionAuSelect();	
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
		
		if(email_client && email_client.value.length <= 0)
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
				if(parseInt(lst_passager_adulte_aller.options[lst_passager_adulte_aller.selectedIndex].value) /*+ parseInt(lst_passager_enfant_aller.options[lst_passager_enfant_aller.selectedIndex].value)*/ > 8)
				{
					alert(tab_lang["alert_nb_passager_aller"]);
					isSubmited = false;
				}
				else
				{
					if(trajet_aller_retour.checked)
					{
						if(parseInt(lst_passager_adulte_retour.options[lst_passager_adulte_retour.selectedIndex].value) /*+ parseInt(lst_passager_enfant_retour.options[lst_passager_enfant_retour.selectedIndex].value)*/ > 8)
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
		
		
		function AjoutOptionAuSelect()
		{
					
			var lst_trajet_depart = document.getElementById("lst_trajet_depart");
			var lst_trajet_arrive = document.getElementById("lst_trajet_arrive");
			var lst_fixe_depart = document.getElementById('lst_fixe_depart');
			var lst_fixe_retour = document.getElementById('lst_fixe_retour');

			for(var i = lst_fixe_depart.length; i >= 0; i--)
			{
				lst_fixe_depart.options[i] = null;
			}
			var opt20 = document.createElement('option');
			opt20.value = "0";
			opt20.innerHTML = "- - h - -";
			lst_fixe_depart.appendChild(opt20);

			for(var i = lst_fixe_retour.length; i >= 0; i--)
			{
				lst_fixe_retour.options[i] = null;
			}

			var opt21 = document.createElement('option');
			opt21.value = "0";
			opt21.innerHTML = "- - h - -";
			lst_fixe_retour.appendChild(opt21);
				
			// Contenu de la fonction
			var choix1 = lst_trajet_arrive.selectedIndex;
			var valeur1 = lst_trajet_arrive.options[choix1].value;
			var choix = lst_trajet_depart.selectedIndex;
			var valeur = lst_trajet_depart.options[choix].value;
			var jour_depart = document.getElementById("jour_depart");
			var jour_retour = document.getElementById("jour_retour");
			var dateD = jour_depart.value;
			var dateR = jour_retour.value;
			if(valeur1 != 100)
			{
				var xhr = new XMLHttpRequest();
				xhr.open("POST","ajax.php",true);
				xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xhr.send("action=get_horaire_fixe_accueil&type=depart&lieu="+valeur1+"&date="+dateD);
				xhr.addEventListener('readystatechange', function () {
					if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status==0)) {
						ajouteOption(JSON.parse(xhr.responseText),"depart");
					}
				});
			
			}
			else
			{
				var xhr = new XMLHttpRequest();
				xhr.open("POST","ajax.php",true);
				xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xhr.send("action=get_horaire_fixe_accueil&type=retour&lieu="+valeur+"&date="+dateD);
				xhr.addEventListener('readystatechange', function () {
					if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status==0)) {
						ajouteOption(JSON.parse(xhr.responseText),"depart");
					}
				});

			}
			
			
			if(trajet_aller_retour.checked)
			{
				if(valeur1 != 100)
				{
					var xhr2 = new XMLHttpRequest();
					xhr2.open("POST","ajax.php",true);
					xhr2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					xhr2.send("action=get_horaire_fixe_accueil&type=retour&lieu="+valeur1+"&date="+dateR);
					xhr2.addEventListener('readystatechange', function () {
						if (xhr2.readyState == 4 && (xhr2.status == 200 || xhr2.status==0)) {
							ajouteOption(JSON.parse(xhr2.responseText),"retour");
						}
					});	
				}
				else
				{
					var xhr2 = new XMLHttpRequest();
					xhr2.open("POST","ajax.php",true);
					xhr2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					xhr2.send("action=get_horaire_fixe_accueil&type=depart&lieu="+valeur+"&date="+dateR);
					xhr2.addEventListener('readystatechange', function () {
						if (xhr2.readyState == 4 && (xhr2.status == 200 || xhr2.status==0)) {
							ajouteOption(JSON.parse(xhr2.responseText),"retour");
						}
					});
				}
			}
			
			if (lst_trajet_depart.options[lst_trajet_depart.selectedIndex].value == 7 || lst_trajet_arrive.options[lst_trajet_arrive.selectedIndex].value == 7)
			{
				pt_rassemblement_aller.disabled = true;
				pt_rassemblement_retour.disabled = true;
				pt_rassemblement_aller.selectedIndex = pt_rassemblement_aller.length - 1;
				pt_rassemblement_retour.selectedIndex = pt_rassemblement_aller.length - 1;
				modifier();		
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
		}
		
	function affiche_info_prise(block)
	{
		if(eval('pt_rassemblement_' + block).selectedIndex == eval('pt_rassemblement_' + block).length - 1)
		{
			eval('rass_' + block).style.display = "block";
		}
		else
		{
			eval('rass_' + block).style.display = "none";
		}
	}
});

function ajouteOption(tab,type) {
	var lst_fixe_depart = document.getElementById('lst_fixe_depart');
	var lst_fixe_retour = document.getElementById('lst_fixe_retour');
	var input_heure_depart = document.getElementById('heure_depart_cherche');
	var input_heure_retour = document.getElementById('heure_retour_cherche');
	if (input_heure_depart && input_heure_retour)
	{
		heure_depart = input_heure_depart.value.replace(':','h');
		heure_retour = input_heure_retour.value.replace(':','h');
	}

	for (var i = 0; i < tab.length; i++)
	{
		var elem = tab[i];
		var opt = document.createElement('option');
		opt.value = elem['id_fixe'];
		opt.innerHTML = elem['heure'];
		if ((input_heure_depart && opt.innerHTML == heure_depart) || (input_heure_retour && opt.innerHTML== heure_retour))
		{
			opt.selected = "selected";
		}
		if (type == "depart")
		{
			lst_fixe_depart.appendChild(opt);
		}
		else
		{
			lst_fixe_retour.appendChild(opt);
		}
	}
}

function modifier()
{
	var calendrier1 = document.getElementById('ds_conclass1');
	var calendrier2 = document.getElementById('ds_conclass2');
	calendrier1.style.display = 'none';
	calendrier2.style.display = 'none';

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
	var rass_aller = document.getElementById('rass_aller');
	var rass_retour = document.getElementById('rass_retour');

	var bloc_reservation = document.querySelector('#contenu div.reservation');
	var bloc_droite = document.querySelector('#contenu div.bloc_droite');

	if (bloc_reservation && bloc_droite)
	{
		if (rass_aller.style.display == 'block' || rass_retour.style.display == 'block')
		{
			if (window.outerWidth > 991)
			{
				bloc_reservation.style.height = "700px";
				bloc_droite.style.height = "700px";
			}
			else if(window.outerWidth > 767)
			{
				bloc_reservation.style.height = "860px";
				bloc_droite.style.height = "860px";
			}
		}
		else
		{
			if (window.outerWidth > 991)
			{
				bloc_reservation.style.height = "550px";
				bloc_droite.style.height = "550px";
			}
			else if(window.outerWidth > 767)
			{
				bloc_reservation.style.height = "700px";
				bloc_droite.style.height = "700px";
			}
		}
	}
}