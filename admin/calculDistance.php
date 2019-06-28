<?php 
	require_once("verifAuth.php");

?>

<div style="width:100%;text-align:center">
	<br /><br />
	
	<h1>Calculateur de distance et temps entre deux points</h1>
	
	Départ : 
	<input type="text" id="origine" size="75" />
	<br /><br />
	
	Arrivée : 
	<input type="text" id="destination" size="75" />
	<br /><br />
	
	Moyen de déplacement : 
	<select id="moyenDeDeplacement">
		
		<option value="voiture" >En voiture</option>
		<option value="velo" >A vélo</option>
		<option value="pied" >A pied</option>
		
	</select>
	<br /><br />
	
	<input type="button" onclick="calculerDistance();" value="Calculer" />
	<br /><br />
	
	<div id="resultatCalcul"></div>
	
</div>



<script type="text/javascript"
	src="http://maps.googleapis.com/maps/api/js?key=AIzaSyB7P6dmOYSXqZq9IWZUnr5NGyqXJTvBM5w&sensor=false">
</script>


<script type="text/javascript">	
	document.getElementById('origine').focus();
	// Fonction permettant de calculer la distance grace à la librairie GoogleMaps API
	function calculerDistance(){
		var origine = document.getElementById("origine").value;
		var destination = document.getElementById("destination").value;
		var moyenDeDeplacement;
		
		switch (document.getElementById("moyenDeDeplacement").value) {
			case "voiture":
				moyenDeDeplacement = google.maps.TravelMode.DRIVING;
				break;
			case "velo":
				moyenDeDeplacement = google.maps.TravelMode.BICYCLING;
				break;
			case "pied":
				moyenDeDeplacement = google.maps.TravelMode.WALKING;
				break;
		}
		
		var service = new google.maps.DistanceMatrixService();
		service.getDistanceMatrix(
		{
			origins: [origine],
			destinations: [destination],
			travelMode: moyenDeDeplacement,
			avoidHighways: false,
			avoidTolls: false
		}, callback);
	}
	
	// Fonction qui va traiter les résultats envoyés par la fonction de calcul (Affichage sur la page)
	function callback(response, status){
		if (status == google.maps.DistanceMatrixStatus.OK) {
			var origins = response.originAddresses;
			var destinations = response.destinationAddresses;
			document.getElementById("resultatCalcul").innerHTML = "Résultats :<br />";
			
			for (var i = 0; i < origins.length; i++) {
				var results = response.rows[i].elements;
				
				for (var j = 0; j < results.length; j++) {
					var element = results[j];
					var dis = element.distance;
					var dur = element.duration;
					var from = origins[i];
					var to = destinations[j];
					
					document.getElementById("resultatCalcul").innerHTML += "<strong>De</strong><i> " + origins[i] + "</i><br /><strong> à</strong><i> " + destinations[j] + "</i><div style='padding-left=20px;color:red;font-weight:bold;'>" + results[j].distance.text + " en " + results[j].duration.text + "</div>(" + results[j].distance.value + " mètres / " + results[j].duration.value + " secondes)<br /><br />";
				}
			}
		}else{
			alert('Error was: ' + status);
		}
	}
</script>