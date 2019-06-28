/*

	Fonction executée lors de la submission du formulaire
	Permet de vérifier chaque valeur du formulaire, puis le valide.
	
*/
function verif_formulaire_client()
{
	// Expression régulière permettant de vérifier que l'email est conforme
	var reg = new RegExp('^[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*@[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*[\.]{1}[a-z]{2,6}$', 'i');
	var valide = true;
	
	var elem_nom = document.getElementById("txt_nom").value;
	var elem_prenom = document.getElementById("txt_prenom").value;
	var elem_ville = document.getElementById("txt_ville").value;
	var elem_tel_fixe = document.getElementById("txt_num_telephone_fixe").value;
	var elem_tel_port = document.getElementById("txt_num_telephone_port").value;
	var elem_email = document.getElementById("txt_email").value;
	var elem_verif_email = document.getElementById("txt_verif_email").value;
	
	var elem_accept_cgv = document.getElementById("accept_cgv");
	
	if (!elem_accept_cgv.checked)
	{
		valide = false;
		alert("Veuillez accepter les conditions générales de vente.");
	}
	else
	{
		if (elem_nom == "" || elem_prenom == "" || (elem_tel_fixe == "" && elem_tel_port == "") || elem_email == "")
		{
			alert("Veuillez remplir toutes vos données personnelles.");
			valide = false;
		}
		else if ((elem_tel_fixe != "" && isNaN(elem_tel_fixe.substr(0,1))) || (elem_tel_port != "" && isNaN(elem_tel_port.substr(0,1))))
		{
			alert("Veuillez saisir un numéro de téléphone valide.");
			valide = false;
		}
		else if(!reg.test(elem_email))
		{
			alert("Veuillez entrer une adresse e-mail valide.");
			valide = false;
		}
		else if(elem_verif_email != elem_email)
		{
			alert("Les adresses e-mail ne correspondent pas.");
			valide = false;
		}
		
		if (valide)
		{
			document.getElementById("form_reservation").submit();
		}
	}
}

function verif_formulaire()
{
	var valide = true;
	
	// Date de réservation
	var elem_jour = document.getElementById("jour").value;
		
	// Formule
	
	var select_formule = document.getElementById("select_formule");
		var elem_formule = select_formule.options[select_formule.selectedIndex].value;
		
	// Aller //
	
	var select_lieu_aller = document.getElementById("select_lieu_aller");
		var elem_lieu_aller = select_lieu_aller.options[select_lieu_aller.selectedIndex].value;
	
	var elem_ville_compl_aller = document.getElementById("txt_ville_compl_aller").value;
	var elem_cp_compl_aller = document.getElementById("txt_cp_compl_aller").value;
	var elem_adresse_compl_aller = document.getElementById("txt_adresse_compl_aller").value;
	
	// Retour (Même que Aller) //
	
	var elem_lieu_retour = elem_lieu_aller;
		
	var elem_ville_compl_retour = elem_ville_compl_aller;
	var elem_cp_compl_retour = elem_cp_compl_aller;
	var elem_adresse_compl_retour = elem_adresse_compl_aller;
	
	// Autre
	
	var select_nb_personnes = document.getElementById("select_nb_personnes");
		var elem_nb_personnes =  select_nb_personnes.options[select_nb_personnes.selectedIndex].value;
	
	
	if (elem_jour == ""){
		alert("Veuillez choisir une date.");
		valide = false;
	}
	else if ((elem_lieu_aller == 4 && (elem_ville_compl_aller == "" || elem_cp_compl_aller == "" || elem_adresse_compl_aller == "")))
	{
		alert("Veuillez remplir toutes les données sur le trajet.");
		valide = false;
	}
	
	if (valide)
	{
		document.getElementById("form_reservation").submit();
	}
}