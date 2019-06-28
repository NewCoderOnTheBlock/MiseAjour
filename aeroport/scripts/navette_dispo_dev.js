
var form  = document.getElementById('form_navette_existant');

var btn_continuer = document.getElementById('btn_continuer');

var btn_radio = document.getElementsByName('rb_navette');

var pb_ressource = document.getElementById('pb_ressource');


var btn_deselectionner = document.getElementById('btn_deselectionner');


var navette_dispo = document.getElementById('navette_dispo');

var pb_adresse = document.getElementById("pb_adresse");

// navette existant (boolean)
var nav_existant = document.getElementById('nav');

//case "attendre"
try {
    var attendre = document.getElementById("attendre");
}
catch(e) { }


//var type_trajet = document.getElementById('type_trajet');


try {
	var chk_mini = document.getElementById('accept_forfait_mini');
}
catch (e) { }


try {
	var chk_sur_adresse = document.getElementById('chk_sur_adresse');
}
catch (e) { }



function ok()
{
	if(nav_existant.value != 0) // si ya des navettes disponible
	{
		if(navette_dispo.value == 1) // si on se rajoute sur une navette
			return true;
		else
		{
			if(chk_mini != null && chk_mini.checked)
				return true;
			else if(attendre != null && attendre.checked)
				return true;
			else
				return false;
		}
	}
	else
	{
		if(chk_mini != null && chk_mini.checked)
			return true;
		else if(attendre != null && attendre.checked)
			return true;
		else
			return false;
	}
}



function clk_attendre()
{
	navette_dispo.value = 0;

	try {
		for(var i = 0; i < btn_radio.length; i++)
			btn_radio[i].checked = false;
	}
    catch(e) { }

	try {
		btn_deselectionner.disabled = "disabled";
	}
    catch (e) { }


	if(pb_adresse.value != "1")
	{
		if(attendre.checked)
			btn_continuer.disabled = "";
		else
			btn_continuer.disabled = "disabled";
	}
	else
	{
		if(chk_sur_adresse.checked)
		{
			if(attendre.checked)
				btn_continuer.disabled = "";
			else
				btn_continuer.disabled = "disabled";
		}
	}

    try {
        chk_mini.checked = false;
    }
    catch (e) { }
}


function envoie()
{
    form.submit();
}


function clk_deselectionner()
{
	navette_dispo.value = 0;


	for(var i = 0; i < btn_radio.length; i++)
		btn_radio[i].checked = false;


	btn_deselectionner.disabled = "disabled";

	btn_continuer.disabled = "disabled";
}


function clk_forfait()
{
	try {
		for(var i = 0; i < btn_radio.length; i++)
			btn_radio[i].checked = false;
	}
    catch (e) {}


    try {
        attendre.checked = false;
    }
    catch (e) { }

	navette_dispo.value = 0;

	if(!chk_mini.checked)
		btn_continuer.disabled = "disabled";
	else
	{
		if(pb_adresse.value != "1")
			btn_continuer.disabled = "";
		else
		{
			if(chk_sur_adresse.checked)
				btn_continuer.disabled = "";
		}
	}


	try {
		btn_deselectionner.disabled = "disabled";
	}
    catch (e) { }
}


function clk_adresse()
{
    if(chk_sur_adresse.checked)
	{
		if(chk_mini != null && chk_mini.checked)
			btn_continuer.disabled = "";
		else
		{
			if(ok())
				btn_continuer.disabled = "";
			else
				btn_continuer.disabled = "disabled";
		}
	}
	else
		btn_continuer.disabled = "disabled";
}


function change()
{
	navette_dispo.value = 1;

	btn_deselectionner.disabled = "";

	btn_continuer.disabled = "disabled";

    try {
        attendre.checked = false;
    }
    catch(e) { }

	if(pb_adresse.value != "1")
	{
		if(ok())
			btn_continuer.disabled = "";
		else
			btn_continuer.disabled = "disabled";
	}
	else
	{
		if(chk_sur_adresse.checked)
		{
			if(ok())
				btn_continuer.disabled = "";
			else
				btn_continuer.disabled = "disabled";
		}
	}

	try {
		chk_mini.checked = false;
	}
    catch (e) { }
}


try {
    attendre.onclick = clk_attendre
}
catch(e) { }


btn_continuer.onclick = envoie;


try {
    btn_deselectionner.onclick = clk_deselectionner;
}
catch (e) {}


try {
	chk_mini.onclick = clk_forfait;
}
catch (e) { }


try {
	chk_sur_adresse.onclick = clk_adresse;
}
catch (e) { }


try {
	for(var i = 0; i < btn_radio.length; i++)
		btn_radio[i].onclick = change;
}
catch(e) { }

