<br />

<?php
	include("verifAuth.php");
	require_once('/homepages/3/d205267944/htdocs/royal-palace/config/config.php'); 
	require_once('/homepages/3/d205267944/htdocs/royal-palace/includes/connexion_bdd.php'); 
	require_once('/homepages/3/d205267944/htdocs/royal-palace/includes/fonctions.php'); 
	
	/* Réception des données recues du formulaire */
	if (isset($_POST['txt_nom'])){
		
		list($pays_client, $ind_tel_client) = split(':', $_POST['select_pays']);
		$nom_client = $_POST['txt_nom'];
		$prenom_client = $_POST['txt_prenom'];
		$ville_client = $_POST['txt_ville'];
		$tel_fixe_client = $_POST['txt_num_telephone_fixe'];
		$tel_port_client = $_POST['txt_num_telephone_port'];
		$mail_client = $_POST['txt_email'];
		
		$type_spectacle = $_POST['radio_type_spectacle'];
		$mode_paiement = $_POST['select_paiement'];
		
		$menu_spectacle = intval($_POST['radio_menu_spectacle']);
		$majoration_spectacle_only = ($menu_spectacle == 1) ? intval(get_value_of_option("maj_only_spectacle")) : 0;
		
		// Le prix est égal au nombre de personnes multiplié par le tarif min
		$nb_min_ar = intval(get_value_of_option("nb_forfait_min_aller_retour"));
		if ($_POST['select_nb_personnes'] < $nb_min_ar){
			$tarif_min = intval(get_value_of_option("tarif_min_aller_retour"));
			$prix = $nb_min_ar * $tarif_min;
			$prix += ($majoration_spectacle_only * $nb_min_ar);
		}else{
			$prix = get_value_of_option("tarif_min_aller_retour") * $_POST['select_nb_personnes'];
			$prix += ($majoration_spectacle_only * $_POST['select_nb_personnes']);
		}
		
		// Majoration si recherche à domicile
		if (($_POST['select_lieu_aller'] == 4 || $_POST['select_lieu_retour'] == 4))
		{
			$prix += get_value_of_option("maj_domicile");
		}
		$lieu_aller = $_POST['select_lieu_aller'];
		$lieu_retour = $_POST['select_lieu_aller'];
		$nb_personnes = $_POST['select_nb_personnes'];
		$jour_long = $_POST['jour_long'];
		$commentaire = $_POST['demande_particuliere'];
		
		// $_SESSION["trajet"][""] = ;
		$adresse_aller = ($_POST['select_lieu_aller'] == 4) ? $_POST['txt_adresse_compl_aller']."<br />".$_POST['txt_cp_compl_aller']."<br />".$_POST['txt_ville_compl_aller'] : "";
		$adresse_retour = ($_POST['select_lieu_aller'] == 4) ? $_POST['txt_adresse_compl_aller']."<br />".$_POST['txt_cp_compl_aller']."<br />".$_POST['txt_ville_compl_aller'] : "";
		
		// Date Aller
		$libelle_menu = ($menu_spectacle == 2) ? "" : "_spectacle";
		if ($_POST['radio_type_spectacle'] == "midi"){
			$tab_explode = explode(':', get_value_of_option("midi_aller".$libelle_menu));
			$h_aller = intval($tab_explode[0]);
			$m_aller = intval($tab_explode[1]);
		}else{
			$tab_explode = explode(':', get_value_of_option("soir_aller".$libelle_menu));
			$h_aller = intval($tab_explode[0]);
			$m_aller = intval($tab_explode[1]);
		}
		
		// On formate la date
		$d_explode = explode('-',$_POST['jour']);
		$date_aller = $d_explode[2]."-".$d_explode[1]."-".$d_explode[0]." ".sprintf('%02d', $h_aller).":".sprintf('%02d', $m_aller).":00";
		$heure_aller = sprintf('%02d', $h_aller)."h".sprintf('%02d', $m_aller);
		
		// Date Retour
		if ($type_spectacle == "midi"){
			$type_explode_retour = explode(':', get_value_of_option("midi_retour"));
			$h_retour = intval($type_explode_retour[0]);
			$m_retour = intval($type_explode_retour[1]);
		}else{
			$type_explode_retour = explode(':', get_value_of_option("soir_retour"));
			$h_retour = intval($type_explode_retour[0]);
			$m_retour = intval($type_explode_retour[1]);
		}
		
		// On formate la date
		$d_explode = explode('-',$_POST['jour']);
		if ($type_spectacle == "midi"){
			$date_retour = $d_explode[2]."-".$d_explode[1]."-".$d_explode[0]." ".sprintf('%02d', $h_retour).":".sprintf('%02d', $m_retour).":00";
		}else{
			// Le retour du spectacle du soir est le lendemain
			$date_retour = $d_explode[2]."-".$d_explode[1]."-".($d_explode[0]+1)." ".sprintf('%02d', $h_retour).":".sprintf('%02d', $m_retour).":00";
			$timestamp = mktime($h_retour, $m_retour, 0, intval($d_explode[1]), intval($d_explode[0]), intval($d_explode[2]));
			$timestamp = $timestamp + 24*3600;
			$date_retour = date("Y-m-d H:i:00", $timestamp);
		}
		$heure_retour = sprintf('%02d', $h_retour)."h".sprintf('%02d', $m_retour);
		
		// On ajoute les données dans la BDD
		
		ajouter_client($nom_client, $prenom_client, $ville_client, $tel_fixe_client, $tel_port_client, $mail_client, $pays_client);
		$id_client = get_id_client($mail_client);
		ajouter_reservation($id_client, $prix, $lieu_aller, $lieu_retour, $adresse_aller, $adresse_retour, $date_aller, $date_retour, $nb_personnes, $commentaire);
		$id_reserv = get_max_id_reserv();
		
		set_reservation_paye($id_reserv, 1);
		set_reservation_mode_paiement($id_reserv, $mode_paiement);
		
		$message_ = "<b>Ajout effectué avec succès !<b>";
	
	}
	
	
	
?>
<style type="text/css">
	.dotted_input{
		width:250px;
		background:none;
		border:none;
		font-size:1.1em;
		border-bottom:dotted black 1px;
	}
	.table_saisie{
		margin:auto;
		width:100%;
	}
	.table_saisie tr td{
		text-align:left;
	}
	.table_saisie tr th{
		text-align:left;
	}
</style>

<script type="text/javascript" src="../../royal-palace/scripts/calendrier.js"></script>

<script type="text/javascript">
	
	var type_spectacle = 'midi';
	var menu_spectacle = 2;
	
	function setTypeSpectacle(type){
		type_spectacle = type;
		actualizeInfoPrise();
	}
	
	function setMenuSpectacle(menu){
		menu_spectacle = menu;
		actualizeInfoPrise();
	}
	
	function actualizeInfoPrise(){
		var type_block = type_spectacle;
		var type_none = (type_spectacle == "midi") ? "soir" : "midi";
		var menu_block = menu_spectacle;
		var menu_none = (menu_spectacle == 1) ? 2 : 1;
		
		document.getElementById('div_horaire_aller_'+type_block+'_'+menu_block).style.display = 'block';
		document.getElementById('div_horaire_aller_'+type_block+'_'+menu_none).style.display = 'none';
		document.getElementById('div_horaire_aller_'+type_none+'_'+menu_block).style.display = 'none';
		document.getElementById('div_horaire_aller_'+type_none+'_'+menu_none).style.display = 'none';
		
		document.getElementById('div_horaire_retour_'+type_block).style.display = 'block';
		document.getElementById('div_horaire_retour_'+type_none).style.display = 'none';
	}
	
	function show_identifiant_tel(){
		var select_pays = document.getElementById("select_pays");
		var value_select_pays = select_pays.options[select_pays.selectedIndex].value;
		var array = value_select_pays.split(":")
		var ident = array[1];
		
		document.getElementById('identifiant_fixe').innerHTML = '(+'+ident+')';
		document.getElementById('identifiant_port').innerHTML = '(+'+ident+')';
	}
	
	function verif_email(){
		var txt_verif_email = document.getElementById("txt_verif_email").value;
		var txt_email = document.getElementById("txt_email").value;
		var span_verif_mail = document.getElementById("error_verif_mail");
		
		if(txt_verif_email != txt_email){
			span_verif_mail.style.display = '';
		}else{
			span_verif_mail.style.display = 'none';
		}
	}
	
	function verif_telephone(){
		var txt_num_telephone_fixe = document.getElementById("txt_num_telephone_fixe").value;
		var txt_num_telephone_port = document.getElementById("txt_num_telephone_port").value;
		var span_fixe = document.getElementById("error_tel_fixe");
		var span_port = document.getElementById("error_tel_port");
		
		if(txt_num_telephone_fixe == "" && txt_num_telephone_port == "")
		{
			span_fixe.style.display = '';
			span_port.style.display = '';
		}
		else if((txt_num_telephone_fixe != "" && isNaN(txt_num_telephone_fixe.substr(0,1))) || (txt_num_telephone_port != "" && isNaN(txt_num_telephone_port.substr(0,1))))
		{
			span_fixe.style.display = '';
			span_port.style.display = '';
		}
		else
		{
			span_fixe.style.display = 'none';
			span_port.style.display = 'none';
		}
	}
	
	function verif_champ_vide(id){
		var champ = document.getElementById(id).value;
		var span = document.getElementById("error_"+id);
		
		if(champ == ""){
			span.style.display = '';
		}else{
			span.style.display = 'none';
		}
	}
	
	function verif_mail_exp()
	{
		var mail = document.getElementById('txt_email').value;
		var span = document.getElementById("error_txt_email");
		var reg = new RegExp('^[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*@[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*[\.]{1}[a-z]{2,6}$', 'i');

		if(!reg.test(mail)){
			span.style.display = '';
		}else{
			span.style.display = 'none';
		}
	}
	
	function show_domicile_info(type){
		var select = document.getElementById("select_lieu_" + type);
		var div = document.getElementById("info_dom_" + type);
		
		if (select.options[select.selectedIndex].value == 4){
			div.style.display = '';
		}else{
			div.style.display = 'none';
		}
		
	}
	
	function show_div_horaire_aller(type){
		var select_fixe = document.getElementById("div_horaire_fixe_aller");
		var select_demande = document.getElementById("div_horaire_demande_aller");
		
		if (type == "fixe"){
			select_fixe.style.display = '';
			select_demande.style.display = 'none';
		}else{
			select_fixe.style.display = 'none';
			select_demande.style.display = '';
		}
		
	}
	
	function show_div_horaire_retour(type){
		var select_fixe = document.getElementById("div_horaire_fixe_retour");
		var select_demande = document.getElementById("div_horaire_demande_retour");
		
		if (type == "fixe"){
			select_fixe.style.display = '';
			select_demande.style.display = 'none';
		}else{
			select_fixe.style.display = 'none';
			select_demande.style.display = '';
		}
		
	}
	
	// Verification du formulaire
	function verif_formulaire(){
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
			
		// Date de réservation
		var elem_jour = document.getElementById("jour").value;
			
		// Type du spectacle
		
		var radio_type_spectacle = document.form_reserv.radio_type_spectacle;
		var type_spectacle = "";
		
		for (var i=0; i<radio_type_spectacle.length;i++) {
			if (radio_type_spectacle[i].checked) {
				type_spectacle = radio_type_spectacle[i].value;
			}
		}
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
		}else if (elem_jour == ""){
			alert("Veuillez choisir une date.");
			valide = false;
		}
		else if ((elem_lieu_aller == 4 && (elem_ville_compl_aller == "" || elem_cp_compl_aller == "" || elem_adresse_compl_aller == "")))
		{
			alert("Veuillez remplir toutes les données sur le trajet Aller.");
			valide = false;
		}
		
		if (valide)
		{
			document.getElementById("form_reservation").submit();
		}
	}
	
</script>

<div style="width:50%;text-align:center;margin:auto;">
	<h2>Saisie manuelle d'une réservation pour Royal-Palace</h2>
	
	<?php
		echo (isset($message_)) ? $message_ : "";
	?>
	
	<form action="#" method="post" id="form_reservation" name="form_reserv">
		<input type="hidden" id="cal_admin" name="cal_admin" value="1" />
		<fieldset>
			<legend>Client</legend>
			<?php
			echo '
			<table class="table_saisie">
					
				<tr>
					<th width="30%"><label for="txt_nom">Nom *</label></th>
					<td width="70%"><input class="dotted_input" type="text" value="" id="txt_nom" name="txt_nom" onchange="verif_champ_vide(\'txt_nom\')" onkeyup="verif_champ_vide(\'txt_nom\')" /><span id="error_txt_nom" ><img src="http://alsace-navette.com/aeroport/images/error.png" /></span></td>
				</tr>
				
				<tr>
					<th><label for="txt_prenom">Prenom *</label></th>
					<td><input class="dotted_input" type="text" value="" id="txt_prenom" name="txt_prenom" onchange="verif_champ_vide(\'txt_prenom\')" onkeyup="verif_champ_vide(\'txt_prenom\')" /><span id="error_txt_prenom" ><img src="http://alsace-navette.com/aeroport/images/error.png" /></span></td>
				</tr>
				
				<tr>
					<th><label for="txt_ville">Ville</label></th>
					<td><input class="dotted_input" type="text" value="" id="txt_ville" name="txt_ville" /></td>
				</tr>
				
				<tr>
					<th><label for="combo_pays">Pays *</label></th>
					<td>
						<select name="select_pays" id="select_pays" onchange="show_identifiant_tel()"';
							
							$q = $bdd->query('	SELECT *
												FROM aeroport_pays
												ORDER BY nom_pays
											');
											
							while ($r = $q->fetch()){
								// On sélectionne la France par défaut
								$bonus = ($r['id_pays'] == 66) ? "selected" : "";
								
								echo '<option value="'.$r['id_pays'].':'.$r['identifiant_tel'].'" '.$bonus.'>'.$r['nom_pays'].'</option>';
							}
							
							echo '
						</select>
					</td>
				</tr>
				
				<tr>
					<th><label for="txt_num_telephone_fixe">Téléphone fixe **</label></th>
					<td><span id="identifiant_fixe">(+33)</span><input class="dotted_input" type="text" value="" id="txt_num_telephone_fixe" name="txt_num_telephone_fixe" onchange="verif_telephone()" onkeyup="verif_telephone()" /><span id="error_tel_fixe" ><img src="http://alsace-navette.com/aeroport/images/error.png" /></span></td>
				</tr>
				
				<tr>
					<th><label for="txt_num_telephone_port">Téléphone portable **</label></th>
					<td><span id="identifiant_port">(+33)</span><input class="dotted_input" type="text" value="" id="txt_num_telephone_port" name="txt_num_telephone_port" onchange="verif_telephone()" onkeyup="verif_telephone()" /><span id="error_tel_port" ><img src="http://alsace-navette.com/aeroport/images/error.png" /></span></td>
				</tr>
				
				<tr>
					<th><label for="txt_email">E-Mail *</label></th>
					<td><input class="dotted_input" type="text" value="" id="txt_email" name="txt_email" onchange="verif_mail_exp()" onkeyup="verif_mail_exp()" /><span id="error_txt_email" ><img src="http://alsace-navette.com/aeroport/images/error.png" /></span></td>
				</tr>
				<tr>
					<th><label for="txt_verif_email">Vérification E-Mail *</label></th>
					<td><input class="dotted_input" type="text" value="" id="txt_verif_email" name="txt_verif_email" onchange="verif_email()" onkeyup="verif_email()" /><span id="error_verif_mail" style="display:none"><img src="http://alsace-navette.com/aeroport/images/error.png" /></span></td>
				</tr>
				
			</table>';
			?>
		</fieldset>
		
		<fieldset class="spaced_fieldset">
			<legend>Spectacle</legend>
			<?php
			echo '
			<table class="table_saisie">
			
				<tr>
					<th width="30%"><label for="lbl_jour">Date</label></th>
					<td width="70%">
						<input type="button" id="lbl_jour" style="background-color:#FFF" value="Sélectionner une date" class="pointer" onclick="ds_sh(\'lbl_jour\', \'ds_conclass1\', \'ds_calclass1\', \'1\', \'fr\');ds_sh(\'lbl_jour\', \'ds_conclass1\', \'ds_calclass2\', \'2\', \'fr\');" />
						<input type="button" id="lbl_jour" style="background:none;border:none;background-image:url(\'http://alsace-navette.com/aeroport/images/calendar.png\');width:16px;height:16px;" class="pointer" onclick="ds_sh(\'lbl_jour\', \'ds_conclass1\', \'ds_calclass1\', \'1\', \'fr\');ds_sh(\'lbl_jour\', \'ds_conclass1\', \'ds_calclass2\', \'2\', \'fr\');" />

						<!-- Valeurs à récupérer -->
						
						<input type="hidden" name="jour" id="jour" value="" />
						<input type="hidden" name="jour_long" id="jour_long" value="" />


						<table class="ds_box" cellpadding="0" cellspacing="0" id="ds_conclass1" style="display: none;">
							<tr>
								<td id="ds_calclass1" valign="top"></td>
								<td id="ds_calclass2" valign="top"></td>
							</tr>
						</table>
						
					</td>
				</tr>
				<tr>
					<th><label for="radio_type_spectacle">Le spectacle</label></th>
					<td>
						<input type="radio" name="radio_type_spectacle" value="midi" checked onclick="setTypeSpectacle(\'midi\');">Du midi</input>
						<input type="radio" name="radio_type_spectacle" value="soir" onclick="setTypeSpectacle(\'soir\');">Du soir</input>
						<br />
						<input type="radio" name="radio_menu_spectacle" value="2" checked onclick="setMenuSpectacle(2);">Repas + Spectacle</input>
						<input type="radio" name="radio_menu_spectacle" value="1" onclick="setMenuSpectacle(1);">Uniquement spectacle</input>
						<br /><br />
						<div id="div_horaire_aller_midi_1" style="display:none;">
							Nous vous cherchons à '.get_value_of_option("midi_aller_spectacle").' pour aller au Royal Palace
							<br />
						</div>
						
						<div id="div_horaire_aller_soir_1" style="display:none;">
							Nous vous cherchons à '.get_value_of_option("soir_aller_spectacle").' pour aller au Royal Palace
							<br />
						</div>
						
						<div id="div_horaire_aller_midi_2">
							Nous vous cherchons à '.get_value_of_option("midi_aller").' pour aller au Royal Palace
							<br />
						</div>
						
						<div id="div_horaire_aller_soir_2" style="display:none;">
							Nous vous cherchons à '.get_value_of_option("soir_aller").' pour aller au Royal Palace
							<br />
						</div>
						
						<div id="div_horaire_retour_midi">
							Nous vous recherchons à '.get_value_of_option("midi_retour").' au Royal Palace
							<br /><br />
						</div>
						
						<div id="div_horaire_retour_soir" style="display:none;">
							Nous vous recherchons à '.get_value_of_option("soir_retour").' au Royal Palace
							<br /><br />
						</div>
						
					</td>
				</tr>
				<tr>
					<th><label for="txt_lieu_aller">Lieu de prise/dépot</label></th>
					<td>						
						<select name="select_lieu_aller" id="select_lieu_aller" onchange="show_domicile_info(\'aller\')">';
						
						$lst_lieu = get_list_lieu();
						foreach ($lst_lieu as $v) {
							echo '<option value="'.($v['id_lieu']).'">'.$v['nom_lieu'].'</option>';
						}
						
						echo '
						</select>
					</td>
				</tr>
				
				<tr id="info_dom_aller" style="display:none">
					<th></th>
					
					<td>
						<table>
							<th style="text-align:left;" colspan="2">Informations complémentaires</th>
							<tr>
								<td><label for="txt_ville_compl_aller">Ville</label></td>
								<td><input class="dotted_input" type="text" id="txt_ville_compl_aller" name="txt_ville_compl_aller" /></td>
							</tr>
							<tr>
								<td><label for="txt_cp_compl_aller">Code postal</label></td>
								<td><input class="dotted_input" type="text" id="txt_cp_compl_aller" name="txt_cp_compl_aller" /></td>
							</tr>
							<tr>
								<td><label for="txt_adresse_compl_aller">Adresse</label></td>
								<td><input class="dotted_input" type="text" id="txt_adresse_compl_aller" name="txt_adresse_compl_aller" /></td>
							</tr>
						</table>
					</td>
				</tr>
				
				<tr>
					<th><label for="select_nb_personnes">Nombre de personnes</label></th>
					<td>
						<select name="select_nb_personnes" id="select_nb_personnes">';
						
						for ($i=1;$i<9;$i++){
							echo '<option value="'.$i.'">'.$i.'</option>';
						}
						
					echo '	
						</select>
					
					</td>
				</tr>
				
				<tr>
					<th><label for="demande_particuliere">Commentaire</label></th>
					<td>
						<textarea name="demande_particuliere" id="demande_particuliere"></textarea>
					</td>
				</tr>
								
				<tr>
					<th><label for="select_paiement">Mode de paiement</label></th>
					<td>
						<select name="select_paiement" id="select_paiement">
							<option value="PayPal">PayPal</option>
							<option value="e-transaction">e-transaction</option>
							<option value="Compte">Compte</option>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="2" style="text-align:center;">
						<br />
						<input type="button" id="bt_valider" name="bt_valider" value="Valider" onclick="verif_formulaire();"/>
					</td>
				</tr>
				
				
			</table>';
			?>
		</fieldset>
		
	</form>
</div>