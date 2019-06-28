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
