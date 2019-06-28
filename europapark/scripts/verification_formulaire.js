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
	else if (elem_nom == "" || elem_prenom == "" || (elem_tel_fixe == "" && elem_tel_port == "") || elem_email == "")
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

function verif_formulaire()
{
	var valide = true;
	
	var elem_jour_aller = document.getElementById("jour_aller").value;
	var select_lieu_aller = document.getElementById("select_lieu_aller");
		var elem_lieu_aller = select_lieu_aller.options[select_lieu_aller.selectedIndex].value;
		
	// Horaire aller //
	var radio_heure_aller = document.form_reserv.radio_heure_aller;
	var type_horaire_aller = "";
	
	for (var i=0; i<radio_heure_aller.length;i++) {
		if (radio_heure_aller[i].checked) {
			type_horaire_aller = radio_heure_aller[i].value;
		}
	}
	
	if (type_horaire_aller == "fixe")
	{
		var select_heure_aller_fixe = document.getElementById("select_heure_aller_fixe");
			var elem_horaire_aller = select_heure_aller_fixe.options[select_heure_aller_fixe.selectedIndex].value;
		var array = elem_horaire_aller.split(':');
		var elem_heure_aller = array[0];
		var elem_minute_aller = array[1];
	}
	else
	{
		var select_heure_aller_demande = document.getElementById("select_heure_aller_demande");
			var elem_heure_aller = select_heure_aller_demande.options[select_heure_aller_demande.selectedIndex].value;
		var select_minute_aller_demande = document.getElementById("select_minute_aller_demande");
			var elem_minute_aller = select_minute_aller_demande.options[select_minute_aller_demande.selectedIndex].value;
	}
	// ***** //
	
	var elem_ville_compl_aller = document.getElementById("txt_ville_compl_aller").value;
	var elem_cp_compl_aller = document.getElementById("txt_cp_compl_aller").value;
	var elem_adresse_compl_aller = document.getElementById("txt_adresse_compl_aller").value;
	
	var elem_jour_retour = document.getElementById("jour_retour").value;
	var select_lieu_retour = document.getElementById("select_lieu_retour");
		var elem_lieu_retour = select_lieu_retour.options[select_lieu_retour.selectedIndex].value;
	
	// Horaire retour //
	var radio_heure_retour = document.form_reserv.radio_heure_retour;
	var type_horaire_retour = "";
	
	for (var i=0; i<radio_heure_retour.length;i++) {
		if (radio_heure_retour[i].checked) {
			type_horaire_retour = radio_heure_retour[i].value;
		}
	}
	
	if (type_horaire_retour == "fixe")
	{
		var select_heure_retour_fixe = document.getElementById("select_heure_retour_fixe");
			var elem_horaire_retour = select_heure_retour_fixe.options[select_heure_retour_fixe.selectedIndex].value;
		var array = elem_horaire_retour.split(':');
		var elem_heure_retour = array[0];
		var elem_minute_retour = array[1];
	}
	else
	{
		var select_heure_retour_demande = document.getElementById("select_heure_retour_demande");
			var elem_heure_retour = select_heure_retour_demande.options[select_heure_retour_demande.selectedIndex].value;
		var select_minute_retour_demande = document.getElementById("select_minute_retour_demande");
			var elem_minute_retour = select_minute_retour_demande.options[select_minute_retour_demande.selectedIndex].value;
	}
	// ***** //	
	
	var elem_ville_compl_retour = document.getElementById("txt_ville_compl_retour").value;
	var elem_cp_compl_retour= document.getElementById("txt_cp_compl_retour").value;
	var elem_adresse_compl_retour = document.getElementById("txt_adresse_compl_retour").value;
	
	var elem_commentaire = document.getElementById("commentaire").value;
	var select_nb_personnes = document.getElementById("select_nb_personnes");
		var elem_nb_personnes =  select_nb_personnes.options[select_nb_personnes.selectedIndex].value;
	var elem_accept_cgv = document.getElementById("accept_cgv");
	
	
	if (elem_jour_aller == "" || (elem_lieu_aller == 4 && (elem_ville_compl_aller == "" || elem_cp_compl_aller == "" || elem_adresse_compl_aller == "")))
	{
		alert("Veuillez remplir toutes les données sur le trajet Aller.");
		valide = false;
	}
	else if (elem_jour_retour == "" || (elem_lieu_retour == 4 && (elem_ville_compl_retour == "" || elem_cp_compl_retour == "" || elem_adresse_compl_retour == "")))
	{
		alert("Veuillez remplir toutes les données sur le trajet Retour.");
		valide = false;
	}
	else
	{
		/* 
			Date Aller doit etre inférieur ou égale à date retour 
			On découpe les chaines pour les comparer
		*/
		var elem = elem_jour_aller.split('-');
		jourA = elem[0];
		moisA = elem[1];
		anneeA = elem[2];
		var dateAller = new Date(anneeA, moisA, jourA, elem_heure_aller, elem_minute_aller, 0);
		
		var elem = elem_jour_retour.split('-');
		jourR = elem[0];
		moisR = elem[1];
		anneeR = elem[2];
		var dateRetour = new Date(anneeR, moisR, jourR, elem_heure_retour, elem_minute_retour, 0);
		
		/* Le fait de les parser retourne un timestamp */
		if (Date.parse(dateRetour) - Date.parse(dateAller) < 0)
		{
			alert("Vous devez spécifier une date de retour correcte !");
			valide = false;
		}
	}
	
	if (valide)
	{
		document.getElementById("form_reservation").submit();
	}
}