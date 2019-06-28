<!-- Fomrulaire d'envoi de SMS : Amélioré par KEMPF -->

<script>
	var max_char_length = 160;
	
	// Fonction permettant de limiter le nombre de caractères dans la textarea
	function limiteur(){
		champ = document.getElementById('message');
		indicateur = document.getElementById('indicateur');

		if (champ.value.length > max_char_length)
		  champ.value = champ.value.substring(0, max_char_length);
		else
		  indicateur.innerHTML = max_char_length - champ.value.length;
	}
	
	// Fonction permettant de valider le formulaire d'envoi
    function valider(){
		var leFormulaire = document.formulaire;
		var erreur = "";
		
		var text_message = document.getElementById('message');
		var text_mobile_number = document.getElementById('mobile_number');
		
		// Gestion de l'erreur sur la longueur du message
		if (text_message.value.length == 0 || text_message.value.length > max_char_length){
			erreur += "\nLa longueur du message est erronée";
		}
		
		// Gestion de l'erreur sur le numero de telephone
		if (text_mobile_number.value.length == 0){
			erreur += "\nIl n'y a pas de numéro de telephone saisie."; 			
		}
		
		// Gestion de l'erreur sur le numero de telephone (Format -> Est un nombre ?)
		if (isNaN(text_mobile_number.value)){
			erreur += "\nLe format du numéro n'est pas correct."; 	
		}
		
		// S'il n'y a pas d'erreur, on envoie le formulaire
		if(erreur == ""){
			leFormulaire.submit();
		// Sinon, on affiche toutes les erreurs répertoriées
		}else{
			alert("Il y a eu des erreurs lors de l'envoi du SMS : "+erreur);
			return false;
		}
	}
</script>

<br />
<div style="width:100%;">
	<div style="text-align:center;width:50%;margin:auto;">
		<h2><u>Envoyer un sms</u></h2>
		
		<!-- Gestion de la réponse du formulaire -->
		<?php
		if(!empty($_POST['mobile_number'])){
			file_get_contents("http://run.orangeapi.com/sms/sendSMS.xml?id=aa99c837828&to=".trim($_POST['mobile_number'])."&content=".urlencode($_POST['message']));
			echo "SMS envoyé";
		}
		?>
		
		<!-- Initialisation de la variable $num : Remplissage auto du champs si on viens d'une fiche client -->
		<?php
		if(isset($_GET['num'])){
			$num = $_GET['num'];
		}else{
			$num = "";
		}
		?>
		
		<form name="formulaire" action="#" method="post" >
			<label>Numéro au format internationnal (ex : 33636757575 pour la france)</label>
			<br />
			<input type="texte" id="mobile_number" name="mobile_number" value="<?php echo $num; ?>" size="15" />
			<br /><br />
			
			Contenu du sms
			<br />
			(Il reste <span style="color:red;font-weight:bold;" id="indicateur"></span> caractères)
			<br />
			<textarea id="message" name="message" cols="30" rows="5" onKeyDown="limiteur();" onChange="limiteur();" onKeyUp="limiteur();"></textarea>
			
			<br /><br />
			<input type="button" value="Envoyer" onClick="valider();" />
		</form>
	</div>
</div>

<script type="text/javascript">
	document.getElementById('indicateur').innerHTML=max_char_length;
	document.getElementById('mobile_number').focus();
</script>