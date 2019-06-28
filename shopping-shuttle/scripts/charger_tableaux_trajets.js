/* 
	KEMPF : Ajout de l'AJAX
	Il va permettre de savoir depuis la 
	BDD quels sont les trajets qui sont 
	déjà "crées", afin de pouvoir les rendre
	disponnibles dans le calendrier
 */
var leTableauDesTrajets = new Array();
 
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
		alert("Erreur AJAX");
		return;
	}

	return xhr;
}
function get_trajets_xhr(mois, annee)
{
	var xhr = get_xhr();
	
	xhr.onreadystatechange = function(){
		if(xhr.readyState == 4)
		{
			traiter_informations_ajax(xhr.responseText, mois);
		}
	}
	
	var mois_formate = (mois < 10) ? '0'+mois : mois.toString();
	var param = "mois=" + mois_formate + "&annee=" + annee;
		
	xhr.open("POST", "./scripts/get_les_jours_avec_trajet.php", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send(param);
}
function traiter_informations_ajax(donnees, mois){
	
	// leTableau = xhr.responseText.split('-');
	// leTableau = xhr.responseText;
	// alert("Données : "+donnees);
	leTableauDesTrajets[mois] = donnees.split('-');
}

// Ajout KEMPF : Le tableau contenant les jours de trajets
var actual_month = new Date().getMonth()+1;
var actual_year = new Date().getFullYear();

for (var i = actual_month;i<=actual_month+6;i++){
	if (i > 12){
		get_trajets_xhr(i-12, actual_year);
	}else{
		get_trajets_xhr(i, actual_year);
	}
}


	