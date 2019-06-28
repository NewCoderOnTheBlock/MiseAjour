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
	var elem_jour = document.getElementById("jour_trajet").value;
	
	// Provenance
	var select_lieu_provenance = document.getElementById("select_lieu_provenance");
		var elem_lieu_provenance = select_lieu_provenance.options[select_lieu_provenance.selectedIndex].value;
	
	var elem_ville_compl_provenance = document.getElementById("txt_ville_compl_provenance").value;
	var elem_cp_compl_provenance = document.getElementById("txt_cp_compl_provenance").value;
	var elem_adresse_compl_provenance = document.getElementById("txt_adresse_compl_provenance").value;
	
	// Destination
	var select_lieu_destination = document.getElementById("select_lieu_destination");
		var elem_lieu_destination = select_lieu_destination.options[select_lieu_destination.selectedIndex].value;
	
	var elem_ville_compl_destination = document.getElementById("txt_ville_compl_destination").value;
	var elem_cp_compl_destination = document.getElementById("txt_cp_compl_destination").value;
	var elem_adresse_compl_destination = document.getElementById("txt_adresse_compl_destination").value;
	
	// Autre
	
	var select_type_vehicule = document.getElementById("select_type_vehicule");
		var elem_type_vehicule =  select_type_vehicule.options[select_type_vehicule.selectedIndex].value;
	
	if (elem_jour == ""){
		alert("Veuillez choisir une date.");
		valide = false;
	}
	else if ((elem_lieu_provenance == 4 && (elem_ville_compl_provenance == "" || elem_cp_compl_provenance == "" || elem_adresse_compl_provenance == "")))
	{
		alert("Veuillez remplir toutes les données concernant la provenance.");
		valide = false;
	}
	else if ((elem_lieu_destination == 4 && (elem_ville_compl_destination == "" || elem_cp_compl_destination == "" || elem_adresse_compl_destination == "")))
	{
		alert("Veuillez remplir toutes les données concernant la destination.");
		valide = false;
	}
	else if (elem_lieu_provenance != 4 && elem_lieu_destination != 4)
	{
		alert("Vous devez choisir au moins un lieu en dehors de Strasbourg.");
		valide = false;
	}
	
	if (valide){
		calculerDistance();
	}
}

function calculerDistance(){
	var locGare = new google.maps.LatLng(48.583975, 7.733921);
	var origine = new Array();
	var destination = new Array();
	var valide = true;
	
	// Provenance
	var select_lieu_provenance = document.getElementById("select_lieu_provenance");
		var elem_lieu_provenance = select_lieu_provenance.options[select_lieu_provenance.selectedIndex].value;
	
	var elem_ville_compl_provenance = document.getElementById("txt_ville_compl_provenance").value;
	var elem_cp_compl_provenance = document.getElementById("txt_cp_compl_provenance").value;
	var elem_adresse_compl_provenance = document.getElementById("txt_adresse_compl_provenance").value;
	
	// Destination
	var select_lieu_destination = document.getElementById("select_lieu_destination");
		var elem_lieu_destination = select_lieu_destination.options[select_lieu_destination.selectedIndex].value;
	
	var elem_ville_compl_destination = document.getElementById("txt_ville_compl_destination").value;
	var elem_cp_compl_destination = document.getElementById("txt_cp_compl_destination").value;
	var elem_adresse_compl_destination = document.getElementById("txt_adresse_compl_destination").value;
		
	if (elem_lieu_provenance == 4){
		if (elem_adresse_compl_destination != "" && elem_cp_compl_destination != "" && elem_ville_compl_destination != ""){
			origine.push(locGare);
			origine.push(elem_adresse_compl_provenance+" "+elem_cp_compl_provenance+" "+elem_ville_compl_provenance);
			
			destination.push(elem_adresse_compl_provenance+" "+elem_cp_compl_provenance+" "+elem_ville_compl_provenance);
		}else{
			valide = false;
		}
	}else{
		origine.push(locGare);
	}
	
	if (elem_lieu_destination == 4){
		if (elem_adresse_compl_destination != "" && elem_cp_compl_destination != "" && elem_ville_compl_destination != ""){
			destination.push(elem_adresse_compl_destination+" "+elem_cp_compl_destination+" "+elem_ville_compl_destination);
		}else{
			valide = false;
		}
	}else{
		destination.push(locGare);
	}
	
	if (valide){
		checkDistance(origine, destination);
	}else{
		alert("Merci de saisir une adresse valide.");
	}
}

// Calcul avec Google Maps
function checkDistance(origine, destination){
	var moyenDeDeplacement = google.maps.TravelMode.DRIVING;
	var service = new google.maps.DistanceMatrixService();

	service.getDistanceMatrix(
	{
		origins: origine,
		destinations: destination,
		travelMode: moyenDeDeplacement,
		avoidHighways: false,
		avoidTolls: false
	}, callback);
}
// Fonction qui va traiter les résultats envoyés par la fonction de calcul
function callback(response, status){
	var trouve = false;
	
	if (status == google.maps.DistanceMatrixStatus.OK) {
		var origins = response.originAddresses;
		var destinations = response.destinationAddresses;
		var distanceEnMetre = 0;
		var dureeEnMillisecondes = 0;
		
		// On ne part pas de Strasbourg
		if (origins.length > 1){
			// Gare à départ client
			var results = response.rows[0].elements;
			if (results.length > 0){
				var dis = parseInt(results[0].distance.value);
				var dur = parseInt(results[0].duration.value*1000);
				distanceEnMetre = distanceEnMetre + dis;
				dureeEnMillisecondes = dureeEnMillisecondes + dur;
				
				// Du départ client à la destination client
				results = response.rows[1].elements;
				if (results.length > 0){
					dis = parseInt(results[1].distance.value);
					dur = parseInt(results[1].duration.value*1000);
					
					distanceEnMetre = distanceEnMetre + dis;
					dureeEnMillisecondes = dureeEnMillisecondes + dur;
					
					trouve = true;
				}
			}
		}else{
			var results = response.rows[0].elements;
			if (results.length > 0){
				var dis = parseInt(results[0].distance.value);
				var dur = parseInt(results[0].duration.value*1000);
				
				distanceEnMetre = distanceEnMetre + dis;
				dureeEnMillisecondes = dureeEnMillisecondes + dur;
				
				trouve = true;
			}
		}
		
	}else{
		alert("Erreur !");
	}	
	
	if (!trouve){
		alert("Merci de saisir des adresses valides.");
	}else{

		document.getElementById("distance").value = distanceEnMetre;
		document.getElementById("duree").value = dureeEnMillisecondes;
		
		document.getElementById("form_reservation").submit();
	}
}