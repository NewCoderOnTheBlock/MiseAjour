<?php
/*
	Les fonctions présentent sur cette page
	permettent de retourner différentes
	valeures contneu dans la base de données.
*/

// Fonction retournant la valeur de l'option passée en parametre
function get_value_of_option($opt){
	global $bdd;
	
	$v = $bdd->query('	SELECT valeur_option
						FROM roppenheim_option
						WHERE nom_option = "'.$opt.'"
					');
					
	$r = $v->fetch();
	
	$value = $r['valeur_option'];
	
	$v->closeCursor();
	
	return $value;
}

function get_les_packs(){
	global $bdd;
	
	$v = $bdd->query('	SELECT 	id_pack, 
								TIME_FORMAT(heure_aller_pack, "%Hh%i") as heure_aller,
								TIME_FORMAT(heure_retour_pack, "%Hh%i") as heure_retour
						FROM roppenheim_pack
						ORDER BY heure_aller_pack ASC
					');
					
	$array = $v->fetchAll();
	
	$v->closeCursor();
	
	return $array;
}

function get_heure_pack($id_pack, $type){
	global $bdd;
	
	$value = "";
	
	if ($type == 'aller' || $type == 'retour'){
	
		$v = $bdd->query('	SELECT TIME_FORMAT(heure_'.$type.'_pack, "%H:%i") as heure_pack
							FROM roppenheim_pack
							WHERE id_pack = "'.$id_pack.'"
						');
						
		$r = $v->fetch();
		
		$value = $r['heure_pack'];
		
		$v->closeCursor();
		
	}
	
	return $value;
}

function get_list_horaires_fixes($type){
	global $bdd;
	
	$v = $bdd->query('	SELECT *
						FROM roppenheim_option
						WHERE type_fixe = "'.$type.'"
						ORDER BY id_fixe
					');
					
	$array = $v->fetchAll(PDO::FETCH_COLUMN, 2);
	
	$v->closeCursor();
	
	return $array;
}

function get_list_lieu(){
	global $bdd;
	
	$v = $bdd->query('	SELECT *
						FROM europa_lieu
						WHERE roppenheim = 1
						ORDER BY id_lieu
					');
	
	$array = $v->fetchAll();
	
	$v->closeCursor();
	
	return $array;
}

function get_nom_lieu($id){
	global $bdd;
	
	$v = $bdd->query('	SELECT nom_lieu
						FROM europa_lieu
						WHERE roppenheim = 1
						AND id_lieu = "'.$id.'"
					');
					
	$r = $v->fetch();
	
	$value = $r['nom_lieu'];
	
	$v->closeCursor();
	
	return $value;
}

function get_id_client($mail_client){
	global $bdd;
	
	$v = $bdd->query('	SELECT id_client
						FROM europa_client
						WHERE mail = "'.$mail_client.'"
					');
					
	$r = $v->fetch();
	
	$value = $r['id_client'];
	
	$v->closeCursor();
	
	return $value;
}

function get_max_id_reserv(){
	global $bdd;
	
	$v = $bdd->query("	SELECT MAX(id_reservation) as m
						FROM europa_reservation");
	
	$r = $v->fetch();
	
	$value = $r['m'];
	
	$v->closeCursor();
	
	return $value;
}

function get_est_paye_reserv($id){
	global $bdd;
	
	$v = $bdd->query("	SELECT est_paye
						FROM europa_reservation
						WHERE id_reservation = '".$id."'");
	
	$r = $v->fetch();
	
	$value = $r['est_paye'];
	
	$v->closeCursor();
	
	if ($value == 0){
		return false;
	}else{
		return true;
	}
}

function get_nb_pers_reserv($id){
	global $bdd;
	
	$v = $bdd->query("	SELECT nb_pers
						FROM europa_reservation
						WHERE id_reservation = '".$id."'");
	
	$r = $v->fetch();
	
	$value = $r['nb_pers'];
	
	$v->closeCursor();
	
	return $value;
}

function get_nb_pers_trajet($id){
	global $bdd;
	
	$v = $bdd->query("	SELECT nb_pers
						FROM europa_trajet
						WHERE id_trajet = '".$id."'");
	
	$r = $v->fetch();
	
	$value = $r['nb_pers'];
	
	$v->closeCursor();
	
	return $value;
}

function get_info_reserv($id){
	global $bdd;
	
	$v = $bdd->query('	SELECT c.nom, c.prenom, c.ville, c.tel_fixe, c.tel_port, c.mail, p.identifiant_tel, p.nom_pays, DATE_FORMAT(r.date_aller, "%d/%m/%Y %H:%i") as dateAll, DATE_FORMAT(r.date_retour, "%d/%m/%Y %H:%i") as dateRet, r.prix, r.nb_pers
						FROM europa_reservation r, europa_client c, aeroport_pays p
						WHERE r.id_reservation = '.$id.'
						AND r.id_client = c.id_client
						AND c.pays = p.id_pays
					');
	
	$array = $v->fetch();
	
	$v->closeCursor();
	
	return $array;
}

function creer_les_trajets_obligatoires($date){
	global $bdd;
	/* $date : dd-mm-yyyy */

	/*
		Création des navettes du samedi pour une date X
		avec vérification au préalable si c'est un Samedi.
		Ajout des trajets de chaque packs
	*/
	
	list($jour, $mois, $annee) = split("-", $date);
	
	$mktime_date = mktime(0, 0, 0, intval($mois), intval($jour), intval($annee));
	$jour_semaine = date("w", $mktime_date);
	$date_formatee = date("Y-m-d", $mktime_date);
	
	// Si c'est un samedi
	if ($jour_semaine == '6'){
		// On vérifie d'abord qu'il n'y a pas encore de trajets ce jour là
		$v = $bdd->query("	SELECT *
							FROM europa_trajet
							WHERE date_trajet BETWEEN '".$date_formatee." 00:00:00' AND '".$date_formatee." 23:59:59'
							AND service_trajet = 'ROPPENHEIM'");
		
		$count = $v->fetchColumn();
		
		$v->closeCursor();
		
		// Si il n'y a pas de trajets encore prévu ce jour là (Pour ne pas faire de doublons automatiques)
		if ($count == 0){
		
			$lesPacks = get_les_packs();
		
			foreach ($lesPacks as $lePack){
				
				$date_aller = $date_formatee." ".$lePack['heure_aller'].":00";
				$date_retour = $date_formatee." ".$lePack['heure_retour'].":00";
				
				// Le trajet Aller
				$bdd->exec("INSERT INTO europa_trajet(type_trajet, date_trajet, adresse, nb_pers, service_trajet, code_chauffeur, code_vehicule, estValide)
							VALUES (
								'ALLER',
								'".$date_aller."',
								'',
								'0',
								'ROPPENHEIM',
								'6',
								'8',
								'0'
							)");
				
				// Le trajet Retour
				$bdd->exec("INSERT INTO europa_trajet(type_trajet, date_trajet, adresse, nb_pers, service_trajet, code_chauffeur, code_vehicule, estValide)
							VALUES (
								'RETOUR',
								'".$date_retour."',
								'',
								'0',
								'ROPPENHEIM',
								'6',
								'8',
								'0'
							)");
		
			}
		
		}
		
	}
	
}

function clear_reserv(){
	global $bdd;
	
	$bdd->exec("DELETE FROM europa_reservation
				WHERE est_paye = 0
				AND date < DATE_SUB(NOW(), INTERVAL 5 HOUR)");
				
	$bdd->exec("DELETE FROM europa_ligne_reserv
				WHERE code_reserv NOT IN (	SELECT id_reservation
											FROM europa_reservation)");
	
	clear_trajets();
	
	/*$bdd->exec("DELETE FROM europa_trajet
				WHERE id_trajet NOT IN (	SELECT id_trajet
											FROM europa_ligne_reserv)");*/
												
}

function clear_trajets(){
	global $bdd;
		
	$bdd->exec("DELETE FROM europa_trajet
				WHERE date_trajet < DATE_SUB(NOW(), INTERVAL 5 HOUR)
				AND type_trajet = 'ALLER'
				AND nb_pers = 0");
				
	$bdd->exec("DELETE FROM europa_trajet
				WHERE date_trajet < NOW()
				AND type_trajet = 'RETOUR'
				AND nb_pers = 0");
												
}

function ajouter_client($nom_client, $prenom_client, $ville_client, $tel_fixe_client, $tel_port_client, $mail_client, $pays_client){
	global $bdd;
	
	$q = $bdd->query('	SELECT *
						FROM europa_client
						WHERE mail = "'.$mail_client.'"
					');
	
	// Test si le client existe déjà (Avec l'email)
	$b = false;
	
	while ($t = $q->fetch()){
		$b = true;
	}
	
	$q->closeCursor();
	
	if (!$b){
	
		$bdd->exec("INSERT INTO europa_client (nom, prenom, ville, pays, tel_fixe, tel_port, mail)
					VALUES (
							'" . $nom_client . "',
							'" . $prenom_client . "',
							'" . $ville_client . "',
							'" . $pays_client . "',
							'" . $tel_fixe_client . "',
							'" . $tel_port_client . "',
							'" . $mail_client . "'
							)");
	}
}

function get_les_trajets_dispo($date_trajet, $nb_personnes){
	global $bdd;
	
	$v = $bdd->query("	SELECT *
						FROM europa_trajet
						WHERE date_trajet = '".$date_trajet."'
						AND service_trajet = 'ROPPENHEIM'
						AND nb_pers + ".$nb_personnes." <= 8");
	
	$array = $v->fetchAll();
	
	$v->closeCursor();
	
	return $array;	
}

function ajouter_au_trajet($id_reserv, $id_trajet_aller){
	global $bdd;
	
	$nb_pers_res = get_nb_pers_reserv($id_reserv);
	$nb_pers_trajet = get_nb_pers_trajet($id_trajet_aller);
	$nb_pers_total = $nb_pers_res + $nb_pers_trajet;
	
	/*
		Les lignes de réservation (Le lien)
	*/
	// Le trajet Aller
	$bdd->exec("	INSERT INTO europa_ligne_reserv(code_trajet, code_reserv)
					VALUES (
						'" . $id_trajet_aller . "',
						'" . $id_reserv . "'
					)");
					
	$bdd->exec("UPDATE europa_trajet
				SET nb_pers = '".$nb_pers_total."'
				WHERE id_trajet = '".$id_trajet_aller."'");
				
				
	// Le trajet Retour
	
	$id_trajet_retour = $id_trajet_aller + 1;
	
	$bdd->exec("	INSERT INTO europa_ligne_reserv(code_trajet, code_reserv)
					VALUES (
						'" . $id_trajet_retour . "',
						'" . $id_reserv . "'
					)");
					
	$bdd->exec("UPDATE europa_trajet
				SET nb_pers = '".$nb_pers_total."'
				WHERE id_trajet = '".$id_trajet_retour."'");
	
}

function get_info_client_reserv($id_reserv){
	global $bdd;
	
	$v = $bdd->query("	SELECT *
						FROM europa_client
						WHERE id_client = (	SELECT id_client
											FROM europa_reservation
											WHERE id_reservation = ".$id_reserv."
											)");
	
	$array = $v->fetchAll();
	
	$v->closeCursor();
	
	return $array;	
}

function ajouter_reservation($id_client, $prix, $type_lieu_aller, $type_lieu_retour, $adresse_aller, $adresse_retour, $date_aller, $date_retour, $nb_pers){
	global $bdd;
	
	if ($type_lieu_retour != 0 && $type_lieu_aller != 0)
	{
		$bdd->query("	INSERT INTO europa_reservation(id_client, date, prix, type_lieu_aller, type_lieu_retour, adresse_aller, adresse_retour, date_aller, date_retour, nb_pers, est_paye, service)
						VALUES (
							'" . $id_client . "',
							NOW(),
							'" . $prix . "',
							'" . $type_lieu_aller . "',
							'" . $type_lieu_retour . "', 
							'" . $adresse_aller . "',
							'" . $adresse_retour . "',
							'" . $date_aller . "',
							'" . $date_retour . "',
							'" . $nb_pers . "',
							'0',
							'Roppenheim'
						)");
	}
}

function set_reservation_paye($id, $v){
	global $bdd;
	
	$bdd->exec("	UPDATE europa_reservation
					SET est_paye = '".$v."'
					WHERE id_reservation = '".$id."'");
}

function set_reservation_mode_paiement($id, $v){
	global $bdd;
	
	$bdd->exec("	UPDATE europa_reservation
					SET mode_paiement = '".$v."'
					WHERE id_reservation = '".$id."'");
}

function get_info_client($id_client){
	global $bdd;
	
	$v = $bdd->query('	SELECT *
						FROM europa_client
						WHERE id_client = "'.$id_client.'"
					');
	
	$r = $v->fetch();
	
	$v->closeCursor();
	
	return $r;
}

/* 
	Fonction envoyée après un payement effectué (Mail + Facture)
	A savoir : E-transaction ne renvoie qu'à un seul fichier, l'ipn_ca.php 
	d'Alsace-navette.com. 
	Le renvoie vers cette fonction est donc fait là bas
*/
function traitementPayement($custom){
	global $bdd, $lang_sujet_mail_paiement, $lang_contenu_mail_paiement_1, $lang_contenu_mail_paiement_2, $lang_contenu_mail_paiement_3;
	
	$custom_r = explode('|', $custom);
	
	$id_reserv = intval($custom_r[0]);
	$lang = $custom_r[1];
	$prix = $custom_r[2];
	$id_trajet = intval($custom_r[4]);
	$mode = $custom_r[5];
	
	// MaJ dans la base de données
	set_reservation_paye($id_reserv, 1);
	set_reservation_mode_paiement($id_reserv, $mode);
	ajouter_au_trajet($id_reserv, $id_trajet);
	
	$row = get_info_reserv($id_reserv);
	$mail_client = $row['mail'];
		
	require_once(dirname(__FILE__) . "/../../libs/Mail.php");
	
	// Envoi du mail
	
	$mailer = new Mail();
	
	$mailer->Subject = $lang_sujet_mail_paiement;
	
	$content_mail = $lang_contenu_mail_paiement_1.$prix.$lang_contenu_mail_paiement_2.sha1($id_reserv).$lang_contenu_mail_paiement_3;
    $mailer->Body = $content_mail;
	
	$mailer->AddAddress("info@alsace-navette.com");
	
	$mailer->AddAddress($mail_client);
	
	$res_mail = $mailer->Send();
	
	// Envoi du SMS 
	
	/*$row = get_info_reserv($id_reserv);
	
	$mobile_number = '3327181252';
	
	$num = (!empty($row['tel_port'])) ? $row['tel_port'] : $row['tel_fixe'];
	
	$msg = "EuropaPark : ".$row['nom']." ".$row['prenom']." (+".$row['identifiant_tel']." ".$num.") du ".$row['dateAll']." au ".$row['dateRet']." [".$row['prix']." €] ".$row['nb_pers']." pers.";
	
	$url_sms = "http://sms.beta.orange-api.net/sms/sendSMS.xml?id=aa99c837828&to=".$mobile_number."&content=".$msg."";
	
	file_get_contents($url_sms);*/
}

/** GESTION DES PAIEMENTS **/
//Cette fonction encrypte le formulaire pour paypal
function paypal_encrypt($hash){
 
	global $MY_KEY_FILE;
	global $MY_CERT_FILE;
	global $PAYPAL_CERT_FILE;
	global $OPENSSL;
 
	if (!file_exists($MY_KEY_FILE)) {
		echo "ERROR: MY_KEY_FILE $MY_KEY_FILE not found\n";
	}
	if (!file_exists($MY_CERT_FILE)) {
		echo "ERROR: MY_CERT_FILE $MY_CERT_FILE not found\n";
	}
	if (!file_exists($PAYPAL_CERT_FILE)) {
		echo "ERROR: PAYPAL_CERT_FILE $PAYPAL_CERT_FILE not found\n";
	}
	if (!file_exists($OPENSSL)) {
		echo "ERROR: OPENSSL $OPENSSL not found\n";
	}
 
	//Assign Build Notation for PayPal Support
	$hash['bn']= 'StellarWebSolutions.PHP_EWP';
 
	$openssl_cmd = "$OPENSSL smime -sign -signer $MY_CERT_FILE -inkey $MY_KEY_FILE " .
				"-outform der -nodetach -binary | $OPENSSL smime -encrypt " .
				"-des3 -binary -outform pem $PAYPAL_CERT_FILE";
	
	$descriptors = array(
			0 => array("pipe", "r"),
			1 => array("pipe", "w"),
	);
 
	$process = proc_open($openssl_cmd, $descriptors, $pipes);

	if (is_resource($process)) {
		foreach ($hash as $key => $value) {
			if ($value != "") {
				//echo "Adding to blob: $key=$value\n<br />";
				fwrite($pipes[0], "$key=$value\n");
			}
		}
		
		fflush($pipes[0]);
		fclose($pipes[0]);

		$output = "";
		while (!feof($pipes[1])) {
			$output .= fgets($pipes[1]);
		}
		//echo "outpout=".$output;
		fclose($pipes[1]); 
		$return_value = proc_close($process);
		return $output;
	}
	return "ERROR";
}

function form_paypal($somme, $desc, $custom, $lang)
{
    global $owner_paypal, $cert_id_paypal;
    
	$form = array(
				'cmd' => '_xclick',								//indique a paypal qu'il s'agit d'un bouton payer maintenant
				'business' => $owner_paypal,					//adresse du vendeur (qui doit recevoir le paiement)
				'cpp_header_image' => 'images/header.jpg',
				'item_name' => $desc, 							//nom de la commande
				'item_number' => '1',							//numero de la commande
				'currency_code' => 'EUR', 						//Devise
				'amount' => $somme, 							//montant a payer
				'lc' => $lang, 									//langue de l'interface paypal
				'cert_id' => $cert_id_paypal, 					//identifiant de certificat donné par paypal
				'custom' => $custom,									//variable permettant de recevoir diverses informations sur la page de retour
				'invoice' => mt_rand() . time(),				//valeur unique empechant les paiements accidentels (doit être differente pour chaque paiement)
				'charset' => 'utf-8',							//Definit le charset utilisez
				'no_shipping' => '1', 							//Le client n'est pas invite a rentrer son adresse
				'return' => 'http://alsace-navette.com/roppenheim/confirmationPaypal.php', 						//Adresse de retour lorsque l'utilisateur clique sur retouner à la boutique
				'cancel_return' => 'http://alsace-navette.com/roppenheim/annulationPaypal.php',	//Adresse de retour pour les annulations
				'no_note' => '1', 								//Empeche l'utilisateur de rajouter des commentaires a son paiement.
				'notify_url' => 'http://alsace-navette.com/roppenheim/ipn.php' 					//Url appelee par paypal lors du paiement, cette page permettra le traitement des commandes payees.
			);

	return paypal_encrypt($form);
}

// Crypteur pour Credit agricole

function crypter($need) {
	$key = "x9f5h1t8y9";
	$iv_size = mcrypt_get_iv_size(MCRYPT_XTEA, MCRYPT_MODE_ECB);
	$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
	return base64_encode(mcrypt_encrypt(MCRYPT_XTEA, $key, $need, MCRYPT_MODE_ECB, $iv));
}


?>