<?php
	require_once('./includes/init_functions.php');
	
	$_SESSION["service"] = "Outlet";
	
	if (!isset($_POST['id_trajet'])){ 
		header("Location: index.php");
		exit;
	}
	if ($_POST['id_trajet'] == '')
	{
		header('Location: reservation.php');
		exit();
	}
	
	// Cleaning de la BDD (Pseudo-CRON)
	//clear_reserv();
	
	// Si des valeurs de session existent, on les utilisera pour remplir le formulaire
	
	$nom_client = (isset($_SESSION["nom_client"])) ? $_SESSION["nom_client"] : "";
	$prenom_client = (isset($_SESSION["prenom_client"])) ? $_SESSION["prenom_client"] : "";
	$ville_client = (isset($_SESSION["ville_client"])) ? $_SESSION["ville_client"] : "";
	$tel_fixe_client = (isset($_SESSION["tel_fixe_client"])) ? $_SESSION["tel_fixe_client"] : "";
	$tel_port_client = (isset($_SESSION["tel_port_client"])) ? $_SESSION["tel_port_client"] : "";
	$mail_client = (isset($_SESSION["mail_client"])) ? $_SESSION["mail_client"] : "";
	
	// Récupération des valeurs des trajets
	$_SESSION["trajet"] = array();
	
	$_SESSION["trajet"]['id_trajet'] = $_POST['id_trajet'];
	$_SESSION["trajet"]["leTrajet_aller"] = get_le_trajet($_POST['id_trajet']);
	$_SESSION["trajet"]["leTrajet_retour"] = get_le_trajet($_POST['id_trajet']+1);
	
	$_SESSION["trajet"]["leOutlet"] = get_le_outlet($_POST['id_lieu']);

	
	/* 
		Calcul du prix
	*/
	// Le prix est égal au nombre de personnes multiplié par le tarif min
	if($_SESSION['trajet']['leTrajet_aller']['prix_trajet'] != NULL && $_SESSION['trajet']['leTrajet_aller']['prix_trajet'] != 0)
	{
		$prix = $_SESSION['trajet']['leTrajet_aller']['prix_trajet'] * $_POST['nbre_passagers'];
	}
	else
	{
		$prix = $_SESSION["trajet"]["leOutlet"]["tarif_outlet"] * $_POST['nbre_passagers'];
	}
	
	// Majoration si recherche à domicile
	if ($_POST['depart'] == 4)
	{
		$prix += get_value_of_option("maj_domicile");
	}
	
	$_SESSION["trajet"]["prix"] = $prix;
	$_SESSION["trajet"]["lieu_aller"] = $_POST['depart'];
	$_SESSION["trajet"]["lieu_retour"] = $_POST['depart'];
	$_SESSION["trajet"]["nb_personnes"] = $_POST['nbre_passagers'];
	$_SESSION['trajet']['nbre_passagers_enfants'] = $_POST['nbre_passagers_enfants'];
	$_SESSION["trajet"]["jour_long_aller"] = $lang_table_jour[$_SESSION["trajet"]["leTrajet_aller"]["num_jour_trajet"]]." ".$_SESSION["trajet"]["leTrajet_aller"]["jour_trajet"]." ".$lang_table_mois[$_SESSION["trajet"]["leTrajet_aller"]["num_mois_trajet"]-1];
	$_SESSION["trajet"]["jour_long_retour"] = $lang_table_jour[$_SESSION["trajet"]["leTrajet_retour"]["num_jour_trajet"]]." ".$_SESSION["trajet"]["leTrajet_retour"]["jour_trajet"]." ".$lang_table_mois[$_SESSION["trajet"]["leTrajet_retour"]["num_mois_trajet"]-1];
	
	// $_SESSION["trajet"][""] = ;
	$_SESSION["trajet"]["adresse_aller"] = ($_POST['depart'] == 4) ? $_POST['txt_adresse_compl_aller']."<br />".$_POST['txt_cp_compl_aller']."<br />".$_POST['txt_ville_compl_aller'] : "";
	$_SESSION["trajet"]["adresse_retour"] = ($_POST['depart'] == 4) ? $_POST['txt_adresse_compl_aller']."<br />".$_POST['txt_cp_compl_aller']."<br />".$_POST['txt_ville_compl_aller'] : "";
	
	// Date Aller 
	$_SESSION["trajet"]["date_aller"] = $_SESSION["trajet"]["leTrajet_aller"]["date_trajet"];
	$_SESSION["trajet"]["heure_aller"] = $_SESSION["trajet"]["leTrajet_aller"]["heure_trajet"];
	
	
	// Date Retour
	$heure_retour_strasbourg = date_create($_SESSION['trajet']['leTrajet_retour']['heure_trajet']);
	$duree_trajet = date_create($_SESSION['trajet']['leOutlet']['duree_trajet']);
	$interval = date_diff($heure_retour_strasbourg,$duree_trajet);

	$_SESSION["trajet"]["date_retour"] = $_SESSION["trajet"]["leTrajet_retour"]["date_trajet"];
	$_SESSION["trajet"]["heure_retour"] = $interval->format("%H:%I");
	$_SESSION['trajet']['heure_retour_strasbourg'] = $_SESSION['trajet']['leTrajet_retour']['heure_trajet'];
	
	
	// Fonction permettant de gérer l'affichage des petits 
	// panneau en fonction des champs déjà remplis
	function get_display($v, $d = null)
	{
		if (isset($d))
		{
			if ($v != '' || $d != '')
			{
				return "display:none;\"";
			}
			else
			{
				return "";
			}
		}
		else
		{
			if ($v != '')
			{
				return "display:none;\"";
			}
			else
			{
				return "";
			}
		}	
	}
	
?>
<html>
	<head>
		<title><?php echo $lang_titre_accueil.' :: '.$lang_titre_main; ?></title>
		
		<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
		<meta name="Language" content="fr" />
		<meta name="viewport" content="width=device-width, initial-scale=1">			
		
		<link rel="stylesheet" type="text/css" href="styles/base.css" media="all" />
		<link rel="stylesheet" type="text/css" href="styles/style.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="styles/calendrier.css" media="screen" />
		<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
		<script type="text/javascript">var lang = '<?php echo $_SESSION['lang'] ;?>'; </script>
		<script type="text/javascript" src="scripts/verification_formulaire.js"></script>
		<!-- Gestion de l'affichage des données supplémentaires liées au lieu domicile ou non -->
		<script type="text/javascript">
			
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
			
		</script>
		
	</head> 
	<body> 
	
		<div id="global">
			<!-- On insère le header + le menu -->
			<?php require_once('./includes/include_entete_menu.php'); ?>
			
			<!-- Le contenu -->
			<div id="contenu" class="row">
				<!-- Titre de la page -->
				<h1><?php echo $lang_vos_informations; ?></h1>
				
				<?php
					// Contenu de la page
					echo '
					<form name="form_reserv" method="post" action="validation.php" id="form_reservation" class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2">
						<fieldset>
							<legend>'.$lang_vos_informations.'</legend>
							<div class="row">
								<label for="txt_nom" class="col-xs-12 col-sm-6 col-md-4">'.$lang_nom.' <sup class="rouge">*</sup></label>
								<input class="col-xs-10 col-sm-5 col-md-4" type="text" value="'.$nom_client.'" id="txt_nom" name="txt_nom" onchange="verif_champ_vide(\'txt_nom\')" onkeyup="verif_champ_vide(\'txt_nom\')" />
								<span style="margin-left:5px;'.get_display($nom_client).'" id="error_txt_nom"><img src="http://alsace-navette.com/aeroport/images/error.png" /></span>
							</div>
								
							<div class="row">
								<label for="txt_prenom" class="col-xs-12 col-sm-6 col-md-4">'.$lang_prenom.' <sup class="rouge">*</sup></label>
								<input class="col-xs-10 col-sm-5 col-md-4" type="text" value="'.$prenom_client.'" id="txt_prenom" name="txt_prenom" onchange="verif_champ_vide(\'txt_prenom\')" onkeyup="verif_champ_vide(\'txt_prenom\')" />
								<span style="margin-left:5px;'.get_display($prenom_client).'" id="error_txt_prenom"><img src="http://alsace-navette.com/aeroport/images/error.png" /></span>
							</div>
								
							<div class="row">
								<label for="txt_ville" class="col-xs-12 col-sm-6 col-md-4">'.$lang_ville.'</label>
								<input class="col-xs-10 col-sm-5 col-md-4" type="text" value="'.$ville_client.'" id="txt_ville" name="txt_ville" />
							</div>
								
							<div class="row">
								<label for="combo_pays" class="col-xs-12 col-sm-6 col-md-4">'.$lang_pays.' <sup class="rouge">*</sup></label>
									<select class="col-xs-10 col-sm-5 col-md-4" name="select_pays" id="select_pays" onchange="show_identifiant_tel()"';
										
										$q = $bdd->query('	SELECT *
															FROM aeroport_pays
															ORDER BY nom_pays
														');
														
										while ($r = $q->fetch()){
											// On sélectionne la France par défaut
											$bonus = ($r['id_pays'] == 66) ? "selected" : "";
											
											echo '<option value="'.$r['id_pays'].':'.$r['identifiant_tel'].'" '.$bonus.'>'.utf8_encode($r['nom_pays']).'</option>';
										}
										
										echo '
									</select>
							</div>
								
							<div class="row">
								<label for="txt_num_telephone_fixe" class="col-xs-12 col-sm-6 col-md-4">'.$lang_num_telephone_fixe.' <sup class="rouge">**</sup></label>
								<div class="col-xs-10 col-sm-5 col-md-4" style="padding:0;">
									<span id="identifiant_fixe" class="col-xs-3 col-sm-3 col-md-3" style="padding:0;text-align:center;">(+33)</span>
									<input class="col-xs-9 col-sm-9 col-md-9" type="tel" value="'.$tel_fixe_client.'" id="txt_num_telephone_fixe" name="txt_num_telephone_fixe" onchange="verif_telephone()" onkeyup="verif_telephone()" />
								</div>
								<span style="margin-left:5px;'.get_display($tel_fixe_client, $tel_port_client).'" id="error_tel_fixe"><img src="http://alsace-navette.com/aeroport/images/error.png" /></span>
							</div>
							
							<div class="row">
								<label for="txt_num_telephone_port" class="col-xs-12 col-sm-6 col-md-4">'.$lang_num_telephone_port.' <sup class="rouge">**</sup></label>
								<div class="col-xs-10 col-sm-5 col-md-4" style="padding:0;">
									<span id="identifiant_port" class="col-xs-3 col-sm-3 col-md-3" style="padding:0;text-align:center;">(+33)</span>
									<input class="col-xs-9 col-sm-9 col-md-9" type="tel" value="'.$tel_port_client.'" id="txt_num_telephone_port" name="txt_num_telephone_port" onchange="verif_telephone()" onkeyup="verif_telephone()" />
								</div>
								<span style="margin-left:5px;'.get_display($tel_port_client, $tel_fixe_client).'" id="error_tel_port"><img src="http://alsace-navette.com/aeroport/images/error.png" /></span>
							</div>
							
							<div class="row">
								<label for="txt_email" class="col-xs-12 col-sm-6 col-md-4">'.$lang_email.' <sup class="rouge">*</sup></label>
								<input class="col-xs-10 col-sm-5 col-md-4" type="email" value="'.$mail_client.'" id="txt_email" name="txt_email" onchange="verif_mail_exp()" onkeyup="verif_mail_exp()" />
								<span style="margin-left:5px;'.get_display($mail_client).'" id="error_txt_email"><img src="http://alsace-navette.com/aeroport/images/error.png" /></span>
							</div>
							
							<div class="row">
								<label for="txt_verif_email" class="col-xs-12 col-sm-6 col-md-4">'.$lang_verif_email.' <sup class="rouge">*</sup></label>
								<input class="col-xs-10 col-sm-5 col-md-4" type="email" value="'.$mail_client.'" id="txt_verif_email" name="txt_verif_email" onchange="verif_email()" onkeyup="verif_email()" />
								<span id="error_verif_mail" style="display:none;margin-left:5px;"><img src="http://alsace-navette.com/aeroport/images/error.png" /></span>
							</div>
								
						</fieldset>
						
						<fieldset style="margin-top:20px;">
							<legend>'.$lang_validation.'</legend>
							
							<div class="row">
								<div class="col-xs-2 col-sm-1 col-md-1" style="text-align:right;">
									<input type="checkbox" id="accept_cgv" name="accept_cgv"/>
								</div>
								<label class="col-xs-10 col-sm-11 col-md-11" for="accept_cgv" style="text-align:left;padding:0;">'.$lang_lu_accepte_cgv.'</label>
							</div>
							
							<div class="row" style="text-align:center;margin-top:20px;">
								<input type="button" id="bt_valider" name="bt_valider" value="'.$lang_valider.'"/>
							</div>
							
						</fieldset>
						<div class="row" style="margin-top:20px;font-size:12px;">
							<sup class="rouge">*</sup> : '.$lang_champ_obligatoire.'<br>
							<sup class="rouge">**</sup> : '.$lang_champ_semi_obligatoire.'
						</div>
					</form>';
				?>
			</div>
			
			<!-- Le pied de page -->
			<?php require_once('./includes/include_pied_de_page.php'); ?>
		</div>
		
	</body> 
</html>