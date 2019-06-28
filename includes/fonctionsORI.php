<?php


function stripslashes_r($var)
{
	if(get_magic_quotes_gpc())
	{
		if(is_array($var))
			return array_map('stripslashes_r', $var);
		else
			return stripslashes($var);
	}
	else
		return $var;
}



function quote()
{
	global $_GET, $_POST, $_COOKIE;
	
	$_GET = stripslashes_r($_GET);
	$_POST = stripslashes_r($_POST);
	$_COOKIE = stripslashes_r($_COOKIE);
}


function get_langue_defaut()
{
	// langues acceptés par le navigateur
	$langue = explode(",", $_SERVER['HTTP_ACCEPT_LANGUAGE'], 2);
	$langue = strtolower(substr(chop($langue[0]), 0, 2));
	$langue=trim($langue);
	
	if( ($langue != "fr") && ($langue != "ru") && ($lang != "tr") && ($lang != "de") && ($lang != "en") ) {
		$langue = "en";
	}
	
	
	/** Il n'y aura plus besoin de ces lignes si on change dans la bdd la table 
	 * aeroport_news_categorie et tous les fichiers se trouvant s'appellant 
	 * ger.lang.php par exemple.
	 * accueil_ger.php
	 * etc...
	 * 	 * **/
	if($langue=="ru") $langue="rus";	
	if($langue=="tr") $langue="tur";	
	if($langue=="de") $langue="ger";	


	
	
	return $langue;
}


function langue()
{
	if( !isset($_SESSION['lang']) ){
		$langue = "";

		/**
		 * Ici quand on rentre sur la page d'accueil il n'y a que 3 langues
		 * disponibles car il manque le russe et le turque avec les drapeaux
		 */
		if(!isset($_GET['lang']) || 	( $_GET['lang'] != 'fr' && 
										  $_GET['lang'] != 'ger' && 
										  $_GET['lang'] != 'en' 
										) 
		                                ){
			$langue = get_langue_defaut();
		}
		else
			$langue = $_GET['lang'];
		
			$_GET['lang']= $langue;

			
	 }	
			
					
	if( isset($_GET['lang']) ){
		 	
		// langue courante
		$_SESSION['lang'] = $_GET['lang'];
		
		// les autres langues pour l'affichage du bon drapeau
		//die($langue);
		switch($_SESSION['lang']){
			case "fr" :
				$_SESSION['lang_autre_1'] = "rus";
				$_SESSION['lang_autre_2'] = "tur";
	            $_SESSION['lang_autre_3'] = "ger";
	            $_SESSION['lang_autre_4'] = "en";
	          break;
			
			case "rus" :
				$_SESSION['lang_autre_1'] = "fr";
				$_SESSION['lang_autre_2'] = "tur";
	            $_SESSION['lang_autre_3'] = "ger";
	            $_SESSION['lang_autre_4'] = "en";
	         break;
			
			case "tur" :
				$_SESSION['lang_autre_1'] = "fr";
				$_SESSION['lang_autre_2'] = "rus";
	            $_SESSION['lang_autre_3'] = "ger";
	            $_SESSION['lang_autre_4'] = "en";
	        break;
			
			case "ger" :
	            $_SESSION['lang_autre_1'] = "fr";
				$_SESSION['lang_autre_2'] = "rus";
	            $_SESSION['lang_autre_3'] = "tur";
	            $_SESSION['lang_autre_4'] = "en";
	        break;
	        
			case "en" :
	        /*die($langue);*/
	            $_SESSION['lang_autre_1'] = "fr";
				$_SESSION['lang_autre_2'] = "rus";
	            $_SESSION['lang_autre_3'] = "tur";
	            $_SESSION['lang_autre_4'] = "ger";
	        break;
	                
	       default :
	            $_SESSION['lang_autre_1'] = "fr";
				$_SESSION['lang_autre_2'] = "rus";
	            $_SESSION['lang_autre_3'] = "tur";
	            $_SESSION['lang_autre_4'] = "ger";
	        break;
	}
	}
}


function set_menu_droite()
{
	global $aeroport_str, $aeroport_baden, $aeroport_bale, $aeroport_fkh, $aeroport_fkm, $aeroport_zurich, $aeroport_stuttgart, $alt_sncf, $alt_conseil, $alt_sondage;
	$res = array(
                array(
					"LIEN" => "http://www.alsace-navette.com/sondage/",
					"IMAGE" => "sondage.gif",
					"TEXTE" => $alt_sondage
					),
				array(
					"TEXTE" => $aeroport_str,
					"IMAGE" => "aeroport_strasbourg.png",
					"LIEN" => "http://www.strasbourg.aeroport.fr"
					),
				array(
					"TEXTE" => $aeroport_baden,
					"IMAGE" => "aeroport_baden.png",
					"LIEN" => "http://www.badenairpark.de/index.html"
					),
				array(
					"TEXTE" => $aeroport_bale,
					"IMAGE" => "aeroport_bale.png",
					"LIEN" => "http://www.euroairport.com/FR/accueil.php"
					),
				array(
					"TEXTE" => $aeroport_fkh,
					"IMAGE" => "aeroport_frankfort_hahn.png",
					"LIEN" => "http://www.hahn-airport.de"
					),
				array(
					"TEXTE" => $aeroport_fkm,
					"IMAGE" => "aeroport_frankfort_main.png",
					"LIEN" => "http://www.frankfurt-airport.de"
					),
				array(
					"TEXTE" => $aeroport_zurich,
					"IMAGE" => "aeroport_zurich.gif",
					"LIEN" => "http://www.flughafen-zuerich.ch/ZRH/default.asp?ID_site=1&amp;sp=fr&amp;hp=1"
					),
				array(
					"TEXTE" => $aeroport_stuttgart,
					"IMAGE" => "aeroport_stuttgart.gif",
					"LIEN" => "http://www.flughafen-stuttgart.de"
					),
                array(
					"LIEN" => "http://voyages-sncf.com",
					"IMAGE" => "sncf.gif",
					"TEXTE" => $alt_sncf
					),
                array(
					"LIEN" => "http://www.diplomatie.gouv.fr/fr/cav-fiche-pays.php3",
					"IMAGE" => "conseil_voyageur.png",
					"TEXTE" => $alt_conseil
					)
				);
			
	return $res;
}


function set_speed_bar()
{
	global $speed_accueil, $speed_tarif, $speed_livre_or, $speed_contact, $speed_service, $speed_reserver, $speed_partenaire, $speed_news;
	
	$res = array(
				array(
					"ITEM" => $speed_accueil,
					"LIEN" => "index.html"
					),
				array(
					"ITEM" => $speed_tarif,
					"LIEN" => "tarifs.html"
					),
				array(
					"ITEM" => $speed_service,
					"LIEN" =>"services.html"
					),
				array(
					 "ITEM" => $speed_partenaire,
					 "LIEN" => "partenaires.html"
					  ),
				array(
					 "ITEM" => $speed_news,
					 "LIEN" => "news.html"
					  ),
				array(
					"ITEM" => "Forum",
					"LIEN" => "../forum/index.php"
					  ),
				array(
					"ITEM" => $speed_livre_or,
					"LIEN" => "livreor.html"
					),
				array(
					"ITEM" => $speed_contact,
					"LIEN" => "contact.html"
					)
				);
	
	return $res;
}


function set_menu_gauche()
{
	global $alt_reseau_aeroport, $alt_tourisme, $alt_office_tourisme, $alt_lvc, $alt_canal_asso;
	$res = array(
				array(
					"LIEN" => "http://reseau-aeroports.com",
					"IMAGE" => "reseau_aeroport.png",
					"TEXT" => $alt_reseau_aeroport
					),
				array(
					"LIEN" => "http://tourisme.alsace-navette.com",
					"IMAGE" => "tourisme_alsace_navette.png",
					"TEXT" => $alt_tourisme
					),
				/*
				 * Appararition OUI ou NON du logo  OFFICE DU TOURISME 
				 * 
				 * 
				 * * array(
					"LIEN" => "http://www.otstrasbourg.fr",
					"IMAGE" => "office_tourisme.png",
					"TEXT" => $alt_office_tourisme
					),
				*/
				array(
					"LIEN" => "http://laissezvousconduire.com",
					"IMAGE" => "lvc.png",
					"TEXT" => $alt_lvc
					),
				array(
					  "LIEN" => "http://canal-asso.com",
					  "IMAGE" => "canal_asso.png",
					  "TEXT" => $alt_canal_asso
					  ),
                array(
                     "LIEN" => "http://www.rfm.fr",
					 "IMAGE" => "RFM.jpg",
					 "TEXT" => ""
                    )
				);
	
	return $res;
}


function set_footer()
{
	global $cgv, $charte, $mentions;
	
	$res = array(
				array(
					"LIEN" => "mentions-legales.html",
					"TEXT" => $mentions
					),
				array(
					 "LIEN" => "conditions-generales-de-vente.html",
					 "TEXT" => $cgv
					 ),
				array(
					 "LIEN" => "charte-de-qualite.html",
					 "TEXT" => $charte
					 )
				);
	
	return $res;
}


function tpl_base()
{
	global $baseurl, $alt_bandeau, $alt_drapeau, $ariane_debut, $ariane_accueil, $deja_client, $deconnexion, $changer_pass, $trajet, $changer_info_perso, $mon_compte, $alt_texte, $alt_print;
	
	$info = pathinfo($_SERVER['PHP_SELF']);

	$res = array(
				"BASEURL"=> $baseurl,
				"ALT_BANDEAU" => $alt_bandeau,
				"ALT_DRAPEAU" => $alt_drapeau,
				"LIEN_DRAPEAU" => $_SERVER['PHP_SELF'],
				"LANG" => $_SESSION['lang'],
				"LANG_AUTRE_1" => $_SESSION['lang_autre_1'],
				"LANG_AUTRE_2" => $_SESSION['lang_autre_2'],
                "LANG_AUTRE_3" => $_SESSION['lang_autre_3'],
                "LANG_AUTRE_4" => $_SESSION['lang_autre_4'],
				"ARIANE_DEBUT" => $ariane_debut,
				"DEJA_CLIENT" => $deja_client,
				"LOGGER" => $_SESSION['logger'],
				"DECONNEXION" => $deconnexion,
				"CHANGER_PASS" => $changer_pass,
				"MES_TRAJET" => $trajet,
				"CHANGER_INFO_PERSO" => $changer_info_perso,
				"MON_COMPTE" => $mon_compte,
				"INFO_PAGE" => $info['filename']. '.html',
				"ALT_PRINT" => $alt_print,
				"ALT_TEXT" => $alt_texte,
				"MODE" => $_SESSION['mode'],
				"TXT_MAINTENANCE" => $_SESSION['txt_maintenance'],
				"EST_ADMIN" => $_SESSION['client']['est_admin'],
				"EST_ADMIN_CLIENT" => $_SESSION['est_admin_client'],
				"ADMIN_NOM" => $_SESSION['client']['nom'],
				"ADMIN_PRENOM" => $_SESSION['client']['prenom'],
				"ADMIN_MAIL" => $_SESSION['client']['mail']
				);
	
	return $res;
}


function get_nb_message_livreor()
{
	$ret = query("SELECT COUNT(*) as nb FROM aeroport_livreor");
	
	$tmp = $ret->fetch();
	
	$res = $tmp['nb'];
	
	$ret->closeCursor();
	
	return $res;
}


function get_message_livreor($deb, $fin)
{
	$sql = "SELECT
				login,
				message,
				DATE_FORMAT(date, '%d/%m/%Y %Hh%im%ss') as date
			FROM
				aeroport_livreor
			ORDER BY id_message DESC
			LIMIT " . $deb. ", " . $fin 
			;

	$ret = query($sql);
	
	$res = array();
	while($row = $ret->fetch())
	{
		array_push($res, array(
							'LOGIN' => $row['login'],
							'MESSAGE' => $row['message'],
							'DATE' => $row['date']
							)
				);
	}
	
	return $res;
}


function get_ip()
{
	if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	elseif(isset($_SERVER['HTTP_CLIENT_IP']))
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	else
		$ip = $_SERVER['REMOTE_ADDR'];
		
	return $ip;
}


function is_mail_valide($mail)
{
	if(preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $mail))
		return true;
	else
		return false;
}


function get_tab_pays()
{
	$res = array();
	
	$ret = query("SELECT
				 		id_pays, 
						nom_pays
					FROM
						aeroport_pays
					ORDER BY id_pays");
	
	while($row = $ret->fetch())
		array_push($res, array("code_pays" => $row['id_pays'], "nom_pays" => $row['nom_pays']));
		
	$ret->closeCursor();
	
	return $res;
}

function get_tab_ind()
{
	$res = array();

	$ret = query("SELECT
				 		id_pays,
						nom_pays,
                        identifiant_tel
					FROM
						aeroport_pays
					ORDER BY id_pays");

    array_push($res, array("code_pays" => "", "nom_pays" => "", "indicatif" => "0"));

	while($row = $ret->fetch())
		array_push($res, array("code_pays" => $row['id_pays'], "nom_pays" => $row['nom_pays'], "indicatif" => $row['identifiant_tel']));

	$ret->closeCursor();

	return $res;
}


function get_indicatif($id_pays)
{
    $ret = query_prepare("SELECT identifiant_tel FROM aeroport_pays WHERE id_pays = :id_pays", array(':id_pays' => $id_pays), "get_indicatif");

	$row = $ret->fetch();

	$res = $row['identifiant_tel'];

	$ret->closeCursor();

	return $res;
}



function get_liste_rassemblement()
{
	$res = array();
	
	$ret = query("SELECT
				 		id_pt,
						" . strtolower($_SESSION['lang']) . " as nom
					FROM
						aeroport_rassemblement
					ORDER BY id_pt");
	
	array_push($res, array("id_pt" => "", "nom" => ""));
	
	while($row = $ret->fetch())
		array_push($res, array("id_pt" => $row['id_pt'], "nom" => $row['nom']));
		
	$ret->closeCursor();
	
	return $res;
}



function get_prix_forfait($id_lieu)
{
	$ret = query_prepare("SELECT prix_forfait FROM aeroport_lieu WHERE id_lieu = :id_lieu", array(':id_lieu' => $id_lieu), "get_prix_forfait");
	
	$row = $ret->fetch();
	
	$res = $row['prix_forfait'];
	
	$ret->closeCursor();
	
	return $res;
}



function get_liste_aeroport()
{
	$res = array();
	
	$ret = query("SELECT
				 		id_lieu,
						nom
					FROM
						aeroport_lieu
					ORDER BY
						id_lieu
					");
	
	array_push($res, array("id_lieu" => "", "nom" => ""));
	
	while($row = $ret->fetch())
		array_push($res, array("id_lieu" => $row['id_lieu'], "nom" => $row['nom']));
		
	$ret->closeCursor();
	
	return $res;
}



function get_max_id($table, $champ)
{
	$ret = query("SELECT MAX(" . $champ . ") as nb FROM " . $table);
	
	$row = $ret->fetch();
	
	$res = $row['nb'];
	
	$ret->closeCursor();
	
	return $res;
}


function get_lieu($id)
{
	$ret = query_prepare("SELECT nom FROM aeroport_lieu WHERE id_lieu = :id", array(':id' => $id), "get_lieu");
	
	$row = $ret->fetch();
	
	$res = $row['nom'];
	
	$ret->closeCursor();
	
	return $res;
}


function get_short_lieu($id)
{
	$ret = query_prepare("SELECT code FROM aeroport_lieu WHERE id_lieu = :id", array(':id' => $id), "get_short_lieu");

	$row = $ret->fetch();

	$res = $row['code'];

	$ret->closeCursor();

	return $res;
}


function get_pt_rass($id)
{
	$ret = query_prepare("SELECT " . strtolower($_SESSION['lang']) . " AS lang FROM aeroport_rassemblement WHERE id_pt = :id", array(':id' => $id), "get_pt_rass");
	
	$row = $ret->fetch();
	
	$res = $row['lang'];
	
	$ret->closeCursor();
	
	return $res;
}


function get_pt_rass2($id, $lang)
{
	$ret = query_prepare("SELECT " . strtolower($lang) . " AS lang FROM aeroport_rassemblement WHERE id_pt = :id", array(':id' => $id), "get_pt_rass2");
	
	$row = $ret->fetch();
	
	$res = $row['lang'];
	
	$ret->closeCursor();
	
	return $res;
}


function get_pays($id)
{
	$ret = query_prepare("SELECT nom_pays as nom FROM aeroport_pays WHERE id_pays = :id", array(':id' => $id), "get_pays");
	
	$row = $ret->fetch();
	
	$res = $row['nom'];
	
	$ret->closeCursor();
	
	return $res;
}


function tab_prix()
{
	$ret = query("SELECT prix_forfait, nb_personne, nom
				 FROM aeroport_lieu
				 WHERE prix_forfait != 0");
	
	$res = array();
	
	while($row = $ret->fetch())
	{
		array_push($res, array('NOM' => $row['nom'],
								'PRIX' => ($row['prix_forfait'] / $row['nb_personne'])
							)
				  );
	}
	
	$ret->closeCursor();

	return $res;
}



function get_new_pass()
{
	$code = "";
	
	$lettre = array('a', 'b', 'c', 'd', 'e','f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 1, 2, 3, 4, 5, 6, 7, 8, 9);
	
	
	for($i = 0; $i < 8; $i++)
		$code .= $lettre[mt_rand(0, count($lettre))];

	return $code;
}


function get_tab_navette_existant()
{
	global $trajet_depart, $trajet_arrive, $date_heure_navette, $nb_personne_navette, $joindre, $cout_du_trajet;
	
	return array($joindre, $trajet_depart, $trajet_arrive, $date_heure_navette, $nb_personne_navette, $cout_du_trajet);
}


function get_navette_dispo($date, $depart, $dest, $nb_pers)
{

	$param = array(
				   ':date' => $date,
				   ':dest' => $dest,
				   ':depart' => $depart,
				   ':nb_pers' => $nb_pers
				   );
                   
	return query_prepare("SELECT t.id_trajet, t.id_lieu_dest, t.id_lieu_depart, DATE_FORMAT(t.date, '%d/%m/%Y %Hh%im') as date, DATE_FORMAT(t.date, '%d/%m/%Y %H:%i') as date2, SUM(l.nb_pers) AS nb_pers, SUM(l.nb_enfant) AS nb_enfant
				FROM aeroport_trajet t
				LEFT JOIN aeroport_ligne_resa l ON l.id_res
				LEFT JOIN aeroport_reservation r ON r.id_res
				LEFT JOIN aeroport_vehicule v ON v.id_vehicule
				WHERE DATE_FORMAT(t.date, '%d-%m-%Y') = :date
                AND t.date > NOW()
				AND t.id_lieu_dest = :dest
				AND t.id_lieu_depart = :depart
				AND l.id_res = r.id_res
				AND t.id_trajet = l.id_trajet
				AND v.id_vehicule = t.id_vehicule
				AND t.est_paye = 1
				AND (SELECT SUM(tt.nb_pers)+SUM(tt.nb_enfant)
						FROM aeroport_ligne_resa tt
						WHERE tt.id_trajet = t.id_trajet
					)+:nb_pers <= v.capacite
				GROUP BY t.id_trajet", $param, "get_navette_dispo");
}



function get_tab_vehicule_roule_pas($format_date_aller, $place)
{
	$res = array();

	$ret = query("SELECT v.id_vehicule as id
				FROM aeroport_vehicule v
				WHERE v.id_vehicule NOT IN (SELECT DISTINCT(t.id_vehicule)
											FROM aeroport_trajet t
											WHERE DATEDIFF(" . $format_date_aller . ", DATE_FORMAT(t.date,'%Y-%m-%d')) = 0
											AND t.est_paye = 1
											)
				AND capacite >= '" . $place . "'
				AND v.id_vehicule != 3"
				);
	
	/*echo "SELECT v.id_vehicule as id
				FROM aeroport_vehicule v
				WHERE v.id_vehicule NOT IN (SELECT DISTINCT(t.id_vehicule)
											FROM aeroport_trajet t
											WHERE DATEDIFF(" . $format_date_aller . ", DATE_FORMAT(t.date,'%Y-%m-%d')) = 0
											AND t.est_paye = 1
											)
				AND capacite >= '" . $place . "'
				AND v.id_vehicule != 3";*/

	while($row = $ret->fetch())
		$res[] = $row['id'];
		
	$ret->closeCursor();
	
	return $res;
}



function get_id_vehicule($place)
{
	$res = array();
	
	$ret = query("SELECT id_vehicule FROM aeroport_vehicule WHERE capacite >= '" . $place . "' AND id_vehicule != 3");
	
	while($row = $ret->fetch())
		$res[] = $row['id_vehicule'];
		
	$ret->closeCursor();
	
	return $res;
}



function get_info_navette($id, $date)
{
	$res = array();		

	$ret = query("SELECT
					DATE_FORMAT(t.date, '%H:%i:%s') AS heure,
					r.estSimple AS type,
					t.id_trajet AS id_trajet,
					t.id_lieu_dest,
					t.id_lieu_depart
				FROM aeroport_trajet t
				LEFT JOIN aeroport_reservation r ON r.id_res
				LEFT JOIN aeroport_ligne_resa l ON l.id_ligne
				WHERE r.id_res = l.id_res
				AND l.id_trajet = t.id_trajet
				AND DATE_FORMAT(t.date, '%d-%m-%Y') = '" . $date . "'
				AND t.id_vehicule = '" . $id . "'
				AND t.est_paye = 1
				GROUP BY t.id_trajet");

	
	/*echo "SELECT
					DATE_FORMAT(t.date, '%H:%i:%s') AS heure,
					r.estSimple AS type,
					t.id_trajet AS id_trajet,
					t.id_lieu_dest,
					t.id_lieu_depart
				FROM aeroport_trajet t
				LEFT JOIN aeroport_reservation r ON r.id_res
				LEFT JOIN aeroport_ligne_resa l ON l.id_ligne
				WHERE r.id_res = l.id_res
				AND l.id_trajet = t.id_trajet
				AND DATE_FORMAT(t.date, '%d-%m-%Y') = '" . $date . "'
				AND t.id_vehicule = '" . $id . "'
				AND t.est_paye = 1
				GROUP BY t.id_trajet";*/

				
	while($row = $ret->fetch())
	{
		$duree = get_duree(($row['id_lieu_dest'] == 100) ? $row['id_lieu_depart'] : $row['id_lieu_dest']);

		array_push($res, $row['heure'] . '/' . $duree . '/' . $row['type'] . '/' . $row['id_trajet'] . '/' . $row['id_lieu_dest'] . '/' . $row['id_lieu_depart']);
	}

	$ret->closeCursor();

	return $res;
}


// ID_TRAJET_AVANT - TPS_AVANT - DUREE - HEURE_DEPART - TYPE_TRAJET
function get_premier_dernier($id, $heure_dep_navette, $date_dep_navette)
{
	$tmp = get_info_navette($id, $date_dep_navette);

	$id_avant = 0;
	$tps_avant = time(); // tps entre les deux départs
	$duree_avant = 0;
	$type_avant = 0;
	$heure_dep_avant = 0;
	$dest_avant = 0;
	$depart_avant = 0;
	
	$id_apres = 0;
	$tps_apres = time();
	$duree_apres = 0;
	$type_apres = 0;
	$heure_dep_apres = 0;
	$dest_apres = 0;
	$depart_apres = 0;
	
	for($i = 0; $i < count($tmp); $i++)
	{
		$tab = explode("/", $tmp[$i]);
		$id_trajet = $tab[3];
		
		$tab2 = explode(":", $tab[0]);
		$heure = $tab2[0];
		$minute = $tab2[1];

		$tps = mktime($heure, $minute); // tps navette courante
	
		$tab3 = explode(":", $heure_dep_navette);
		$heure2 = $tab3[0];
		$minute2 = $tab3[1];
		
		$tps2 = mktime($heure2, $minute2); // tps de la navette	

		$diff = $tps - $tps2;

		// si diff < 0 -> navette avant
		if($diff < 0)
		{		
			if(abs($tps_avant) > abs($diff))
			{
				$id_avant = $id_trajet;
				$tps_avant = $diff;
				$duree_avant = $tab[1];
				$type_avant = $tab[2];
				$heure_dep_avant = $tab[0];
				$dest_avant = $tab[4];
				$depart_avant = $tab[5];
			}
		}
		elseif($diff > 0) // navette après
		{
			if($tps_apres > $diff)
			{
				$id_apres = $id_trajet;
				$tps_apres = $diff;
				$duree_apres = $tab[1];
				$type_apres = $tab[2];
				$heure_dep_apres = $tab[0];
				$dest_apres = $tab[4];
				$depart_apres = $tab[5];
			}
		}
		else // navette au même moment, on ne peux pas prendre cette voiture
		{
			return false;
		}
	}
	
	$tps_apres = ($id_apres == 0) ? 0 : $tps_apres;
	$tps_avant = ($id_avant == 0) ? 0 : $tps_avant;

	return array(
				 array($id_avant, $tps_avant, $duree_avant, $heure_dep_avant, $type_avant, $dest_avant, $depart_avant),
				 array($id_apres, $tps_apres, $duree_apres, $heure_dep_apres, $type_apres, $dest_apres, $depart_apres)
				 );
}


function get_duree($id)
{
	$ret = query_prepare("SELECT duree FROM aeroport_lieu WHERE id_lieu = :id", array(':id' => $id), "get_duree");
	
	$row = $ret->fetch();
	
	$res = $row['duree'];
		
	$ret->closeCursor();

	return $res;
}


function type_navette($id_trajet)
{
	$ret = query_prepare("SELECT id_lieu_dest FROM aeroport_trajet WHERE id_trajet = :id", array(':id' => $id_trajet), "type_navette");
	
	$row = $ret->fetch();
	
	$res = ($row['id_lieu_dest'] == 100) ? 1 : 0;
	
	$ret->closeCursor();

	return $res;	
}


function get_duree_depuis_trajet($id_lieu)
{
	$ret = query_prepare("SELECT l.duree AS duree
				 FROM aeroport_lieu l
				 WHERE l.id_lieu = :id", array(':id' => $id_lieu), "get_duree_depuis_trajet");
	
	$row = $ret->fetch();
	
	$res = $row['duree'];

	$ret->closeCursor();
	
	return $res;	
}




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




function get_navette($id_trajet)
{
	$ret = query("SELECT DATE_FORMAT(t.date, '%H:%i') AS date, t.id_vehicule AS vehicule, t.id_chauffeur AS chauffeur
				 FROM aeroport_trajet t
				 WHERE t.id_trajet = '" . $id_trajet . "'");
	
	$row = $ret->fetch();
	
	$res['date'] = $row['date'];
	$res['vehicule'] = $row['vehicule'];
    $res['chauffeur'] = $row['chauffeur'];
	
	$ret->closeCursor();
	
	return $res;
}


function get_date_long($date)
{
	$tab = explode('-', $date);
	
	global $table_mois, $table_jour;
	
	$jour = $tab[0];
	$mois = $tab[1];
	$annee = $tab[2];
	
	$new_date = mktime(0, 0, 0, $mois, $jour, $annee);

	$res = $table_jour[date('w', $new_date)] . ' ' . $jour . ' ' . $table_mois[$mois - 1] . ' ' . $annee;

	return $res;
}


function get_chauffeur($id)
{
	$ret = query("SELECT nom, prenom, telephone, portable, mail FROM chauffeur WHERE idchauffeur = '" . $id . "'");
	
	$row = $ret->fetch();
	
	$res = array(
				'nom' => $row['nom'],
				'prenom' => $row['prenom'],
				'portable' => $row['portable'],
				'mail' => $row['mail']
				);
	
	$ret->closeCursor();
	
	return $res;
}



function get_nb_trajet_moi()
{
	$sql = "SELECT t.id_trajet
			FROM aeroport_trajet t
			LEFT JOIN aeroport_reservation r ON r.id_res
			LEFT JOIN aeroport_ligne_resa l ON l.id_ligne
			WHERE r.id_client = '" . $_SESSION['client']['id_client'] . "'
			AND t.id_trajet = l.id_trajet
			AND l.id_res = r.id_res";
			
	$ret = query($sql);
	
	$res = $ret->rowCount();
	
	$ret->closeCursor();
	
	return $res;
}



function get_tab_mes_trajet()
{
	$sql = "SELECT t.id_lieu_dest, t.id_lieu_depart, DATE_FORMAT(t.date, '%d-%m-%Y') AS date_long, t.date, l.id_pt_rass, l.rassemblement, DATE_FORMAT(l.heure, '%Hh%i') AS heure, l.nb_pers, l.nb_enfant, l.info_vol, r.commentaire, t.id_chauffeur, t.estValide, l.est_paye, r.id_res, l.id_ligne, t.id_trajet
			FROM aeroport_trajet t
			LEFT JOIN aeroport_reservation r ON r.id_res
			LEFT JOIN aeroport_ligne_resa l ON l.id_ligne
			WHERE r.id_client = '" . $_SESSION['client']['id_client'] . "'
			AND t.id_trajet = l.id_trajet
			AND l.id_res = r.id_res
			ORDER BY t.date DESC";
			
	global $status_valide, $status_invalide, $statut_attente;

	$res = array();
	
	$ret = query($sql);
	
	$i = 0;
	
	while($row = $ret->fetch())
	{
		$chauffeur = get_chauffeur($row['id_chauffeur']);

		$res[] = array('DEST' => get_lieu($row['id_lieu_dest']),
						'DEPART' => get_lieu($row['id_lieu_depart']),
						'DATE_LONG' => get_date_long($row['date_long']),
						'DATE_COURT' => $row['date'],
						'ID' => ($i++),
						'RASSEMBLEMENT' => ($row['id_pt_rass'] == 4) ? $row['rassemblement'] : get_pt_rass($row['id_pt_rass']),
						'HEURE' => $row['heure'],
						'NB_PERS' => $row['nb_pers'],
						'NB_ENFANT' => $row['nb_enfant'],
						'INFO_VOL' => nl2br($row['info_vol']),
						'INFO_COMPL' => wordwrap($row['commentaire'], 100, '<br />', true),
						'NOM_CHAUFFEUR' => $chauffeur['nom'],
						'PRENOM_CHAUFFEUR' => $chauffeur['prenom'],
						'PORT_CHAUFFEUR' => $chauffeur['portable'],
						'MAIL_CHAUFFEUR' => $chauffeur['mail'],
						'STATUS' => ($row['est_paye'] == '0') ? $statut_attente : (($row['estValide'] == 1) ? $status_valide : $status_invalide),
                        'CLASS' => ($row['est_paye'] == '0') ? 'bleu_attente' : (($row['estValide'] == 1) ? "valid" : ''),
						'VALIDE' => $row['estValide'],
                        'PRIX' => get_prix($row['id_ligne'], "prix"),
                        'ID_CLIENT' => $_SESSION['client']['id_client'],
                        'ID_RES' => $row['id_res'],
                        'ID_TRAJET' => $row['id_trajet'],
                        'ID_LIGNE' => $row['id_ligne'],
                        'CODE_CLI' => $_SESSION['client']['nb_alea']
						);
	}
		
	$ret->closeCursor();
	
	return $res;
}



function get_tps_rass($id)
{
	$res = "";
	
	$ret = query_prepare("SELECT decalage FROM aeroport_rassemblement WHERE id_pt = :id", array(':id' => $id), "get_tps_rass");
	
	$row = $ret->fetch();
	
	$res = $row['decalage'];
	
	$ret->closeCursor();
	
	return $res;
}



function get_heure($id, $champs)
{
	$res = "";

	$ret = query("SELECT DATE_FORMAT(" . $champs . ", '%H:%i') AS heure FROM aeroport_fixe WHERE id_fixe = '" . $id . "'");

	$row = $ret->fetch();
	
	$res = $row['heure'];

	$ret->closeCursor();
	
	return $res;
}


function tab_fixe()
{
	$res = array();
	
	$ret = query("SELECT d.destination, f.id_fixe FROM aeroport_fixe f, aeroport_destination d WHERE f.id_dest = d.id_dest GROUP BY f.id_dest");
	
	while($row = $ret->fetch())
	{	
		$res[] = array('nom_dest' => $row['destination'],
						'id_fixe' => $row['id_fixe']
						);
	}
	
	$ret->closeCursor();
	
	return $res;	
}


// renvoie les chauffeurs qui sont disponible à cette heure
function get_chauffeur_pas_conge($jour, $heure_depart)
{
	$tab = explode(':', $heure_depart);
	$hr = $tab[0];
	$mn = ($tab[1] * 100) / 60;

    $tab_date = explode("-", $jour);

    $utc = date("I", mktime(2, 0, 0, $tab_date[1], $tab_date[0], $tab_date[2]));

    if(strlen($mn) < 2)
        $mn = "0". $mn;

    if($utc == 0)
        $deb_px = ($hr) . "." . $mn;
    else
        $deb_px = ($hr) . "." . $mn;



	$param = array(':jour' => $jour,
                    ':deb' => $deb_px);

    

    if($utc == 0)// heure d'hiver
    {
        $ret = query_prepare("SELECT ch.idchauffeur AS id
                             FROM chauffeur ch
                             WHERE ch.idchauffeur NOT IN (SELECT DISTINCT c.aco_util_id
                                                         FROM agenda_agenda_concerne c
                                                         WHERE c.aco_age_id IN (SELECT a.age_id
                                                                                   FROM agenda_agenda a
                                                                                   WHERE a.age_couleur = 'green'
                                                                                   AND DATE_FORMAT(a.age_date, '%d-%m-%Y') = :jour
                                                                                   AND :deb BETWEEN (IF(a.age_heure_debut > a.age_heure_fin, a.age_heure_debut-24, a.age_heure_debut))+1 AND a.age_heure_fin+1
                                                                                   ))
                             AND ch.idchauffeur != 0
                             AND ch.idchauffeur NOT IN (SELECT id_chauffeur FROM aeroport_conducteurs_exclus)
                             AND ch.idchauffeur != 6", $param, "get_chauffeur_pas_conge");
    }
    else
    {
        $ret = query_prepare("SELECT ch.idchauffeur AS id
                             FROM chauffeur ch
                             WHERE ch.idchauffeur NOT IN (SELECT DISTINCT c.aco_util_id
                                                         FROM agenda_agenda_concerne c
                                                         WHERE c.aco_age_id IN (SELECT a.age_id
                                                                                   FROM agenda_agenda a
                                                                                   WHERE a.age_couleur = 'green'
                                                                                   AND DATE_FORMAT(a.age_date, '%d-%m-%Y') = :jour
                                                                                   AND :deb BETWEEN (IF(a.age_heure_debut > a.age_heure_fin, a.age_heure_debut-24, a.age_heure_debut))+2 AND a.age_heure_fin+2
                                                                                   ))
                             AND ch.idchauffeur != 0
                             AND ch.idchauffeur NOT IN (SELECT id_chauffeur FROM aeroport_conducteurs_exclus)
                             AND ch.idchauffeur != 6", $param, "get_chauffeur_pas_conge");
    }


/*echo "SELECT ch.idchauffeur AS id
				 FROM chauffeur ch
				 WHERE ch.idchauffeur NOT IN (SELECT DISTINCT c.aco_util_id
											 FROM agenda_agenda_concerne c
											 WHERE c.aco_age_id IN (SELECT a.age_id
																	   FROM agenda_agenda a
																	   WHERE a.age_couleur = 'green'
																	   AND DATE_FORMAT(a.age_date, '%d-%m-%Y') = '" . $jour . "'
																	   AND :deb BETWEEN (IF(a.age_heure_debut > a.age_heure_fin, a.age_heure_debut-24, a.age_heure_debut))+2 AND a.age_heure_fin+2
																	   ))
				 AND ch.idchauffeur != 0
				 AND ch.idchauffeur NOT IN (SELECT id_chauffeur FROM aeroport_conducteurs_exclus)
				 AND ch.idchauffeur != 6";*/


	$res = array();
	
	while($row = $ret->fetch())
		$res[] = $row['id'];
		
	$ret->closeCursor();
	
	// rajout de pacha si un chauffeur en congé

    if($utc == 0) // heure d'hiver
    {
        $chauff = query_prepare("SELECT *
                         FROM agenda_agenda_concerne c
                         WHERE c.aco_age_id IN (SELECT a.age_id
                                               FROM agenda_agenda a
                                               WHERE a.age_couleur = 'green'
                                               AND DATE_FORMAT(a.age_date, '%d-%m-%Y') = :jour
                                               AND :deb BETWEEN (IF(a.age_heure_debut > a.age_heure_fin, a.age_heure_debut-24, a.age_heure_debut))+1 AND a.age_heure_fin+1
                        )
                         AND c.aco_util_id != '6'
                         AND c.aco_util_id NOT IN (SELECT id_chauffeur FROM aeroport_conducteurs_exclus)
                         AND c.aco_util_id != '0'", $param, "get_pacha");
    }
    else
    {
        $chauff = query_prepare("SELECT *
                         FROM agenda_agenda_concerne c
                         WHERE c.aco_age_id IN (SELECT a.age_id
                                               FROM agenda_agenda a
                                               WHERE a.age_couleur = 'green'
                                               AND DATE_FORMAT(a.age_date, '%d-%m-%Y') = :jour
                                               AND :deb BETWEEN (IF(a.age_heure_debut > a.age_heure_fin, a.age_heure_debut-24, a.age_heure_debut))+2 AND a.age_heure_fin+2
                                               )
                         AND c.aco_util_id != '6'
                         AND c.aco_util_id NOT IN (SELECT id_chauffeur FROM aeroport_conducteurs_exclus)
                         AND c.aco_util_id != '0'", $param, "get_pacha");
    }
	
	
	if($chauff->rowCount() > 0)
		$res[] = "6";

	$chauff->closeCursor();


	return $res;
  
}



function tab_chauffeur_roule_pas($date, $heure_retour)
{
	$tab = explode(':', $heure_retour);
	$hr = $tab[0];
	$mn = $tab[1] / 60;
	
	$param = array(
				   ':jour' => $date,
				   ':hr' => ($hr + $mn)
				   );


    $tab_date = explode("-", $date);

    $utc = date("I", mktime(2, 0, 0, $tab_date[1], $tab_date[0], $tab_date[2]));


    if($utc == 0)// heure d'été
    {
        $ret = query_prepare("SELECT ch.idchauffeur
                     FROM chauffeur ch
                     WHERE ch.idchauffeur NOT IN (SELECT t.id_chauffeur
                                                 FROM aeroport_trajet t
                                                 WHERE DATE_FORMAT(t.date, '%d-%m-%Y') = :jour
                                                 AND t.est_paye = 1
                                                 )
                     AND ch.idchauffeur NOT IN (SELECT DISTINCT c.aco_util_id
                                                 FROM agenda_agenda_concerne c
                                                 WHERE c.aco_age_id IN (SELECT a.age_id
                                                                           FROM agenda_agenda a
                                                                           WHERE a.age_couleur = 'green'
                                                                           AND DATE_FORMAT(a.age_date, '%d-%m-%Y') = :jour
                                                                           AND a.age_heure_debut+1 - :hr <= 0
                                                                           ))
                     AND ch.idchauffeur != 0
                     AND ch.idchauffeur NOT IN (SELECT id_chauffeur FROM aeroport_conducteurs_exclus)
                     AND ch.idchauffeur != 6", $param, "tab_chauffeur_roule_pas");
    }
    else
    {
        $ret = query_prepare("SELECT ch.idchauffeur
                     FROM chauffeur ch
                     WHERE ch.idchauffeur NOT IN (SELECT t.id_chauffeur
                                                 FROM aeroport_trajet t
                                                 WHERE DATE_FORMAT(t.date, '%d-%m-%Y') = :jour
                                                 AND t.est_paye = 1
                                                 )
                     AND ch.idchauffeur NOT IN (SELECT DISTINCT c.aco_util_id
                                                 FROM agenda_agenda_concerne c
                                                 WHERE c.aco_age_id IN (SELECT a.age_id
                                                                           FROM agenda_agenda a
                                                                           WHERE a.age_couleur = 'green'
                                                                           AND DATE_FORMAT(a.age_date, '%d-%m-%Y') = :jour
                                                                           AND a.age_heure_debut+2 - :hr <= 0
                                                                           ))
                     AND ch.idchauffeur != 0
                     AND ch.idchauffeur NOT IN (SELECT id_chauffeur FROM aeroport_conducteurs_exclus)
                     AND ch.idchauffeur != 6", $param, "tab_chauffeur_roule_pas");
    }


			/*echo "SELECT ch.idchauffeur
				 FROM chauffeur ch
				 WHERE ch.idchauffeur NOT IN (SELECT t.id_chauffeur
											 FROM aeroport_trajet t
											 WHERE DATE_FORMAT(t.date, '%d-%m-%Y') = '" . $date . "'
											 AND t.est_paye = 1
											 )
				 AND ch.idchauffeur NOT IN (SELECT DISTINCT c.aco_util_id
											 FROM agenda_agenda_concerne c
											 WHERE c.aco_age_id IN (SELECT a.age_id
																	   FROM agenda_agenda a
																	   WHERE a.age_couleur = 'green'
																	   AND DATE_FORMAT(a.age_date, '%d-%m-%Y') = '" . $date . "'
																	   AND a.age_heure_debut+1 - " . ($hr + $mn) . " <= 0
																	   ))
				 AND ch.idchauffeur != 0
				 AND ch.idchauffeur NOT IN (SELECT id_chauffeur FROM aeroport_conducteurs_exclus)
				 AND ch.idchauffeur != 6";*/

	
	// AND t.estValide = 1
	
	$res = array();
	
	while($row = $ret->fetch())
		$res[] = $row['idchauffeur'];
		
	$ret->closeCursor();
	
	return $res;
}


function get_info_chauffeur($id, $date_dep_navette)
{
	$res = array();		
				
	$param = array(
				   ':date' => $date_dep_navette,
				   ':id' => $id
				   );
	
	$ret = query_prepare("SELECT
					DATE_FORMAT(t.date, '%H:%i:%s') AS heure,
					r.estSimple AS type,
					t.id_trajet AS id_trajet,
					t.id_lieu_dest,
					t.id_lieu_depart
				FROM aeroport_trajet t
				LEFT JOIN aeroport_reservation r ON r.id_res
				LEFT JOIN aeroport_ligne_resa l ON l.id_ligne
				WHERE r.id_res = l.id_res
				AND l.id_trajet = t.id_trajet
				AND DATE_FORMAT(t.date, '%d-%m-%Y') = :date
				AND t.id_chauffeur = :id
				AND t.est_paye = 1
				GROUP BY t.id_trajet", $param, "get_info_chauffeur");
	
	/*echo "SELECT
					DATE_FORMAT(t.date, '%H:%i:%s') AS heure,
					r.estSimple AS type,
					t.id_trajet AS id_trajet,
					t.id_lieu_dest,
					t.id_lieu_depart
				FROM aeroport_trajet t
				LEFT JOIN aeroport_reservation r ON r.id_res
				LEFT JOIN aeroport_ligne_resa l ON l.id_ligne
				WHERE r.id_res = l.id_res
				AND l.id_trajet = t.id_trajet
				AND DATE_FORMAT(t.date, '%d-%m-%Y') = '" . $date_dep_navette . "'
				AND t.id_chauffeur = '" . $id . "'
				AND t.est_paye = 1
				GROUP BY t.id_trajet";*/



	while($row = $ret->fetch())
	{
		$duree = get_duree(($row['id_lieu_dest'] == 100) ? $row['id_lieu_depart'] : $row['id_lieu_dest']);

		array_push($res, $row['heure'] . '/' . $duree . '/' . $row['type'] . '/' . $row['id_trajet'] . '/' . $row['id_lieu_dest'] . '/' . $row['id_lieu_depart']);
	}

	$ret->closeCursor();

	return $res;
}


// ID_TRAJET_AVANT - TPS_AVANT - DUREE - HEURE_DEPART - TYPE_TRAJET
function get_premier_dernier2($id, $heure_dep_navette, $date_dep_navette)
{
	$tmp = get_info_chauffeur($id, $date_dep_navette);

	$id_avant = 0;
	$tps_avant = time(); // tps entre les deux départs
	$duree_avant = 0;
	$type_avant = 0;
	$heure_dep_avant = 0;
	$dest_avant = 0;
	$depart_avant = 0;
	
	$id_apres = 0;
	$tps_apres = time();
	$duree_apres = 0;
	$type_apres = 0;
	$heure_dep_apres = 0;
	$dest_apres = 0;
	$depart_apres = 0;
	
	for($i = 0; $i < count($tmp); $i++)
	{
		$tab = explode("/", $tmp[$i]);
		$tab2 = explode(":", $tab[0]);
		$heure = $tab2[0];
		$minute = $tab2[1];
		$id_trajet = $tab[3];

		$tps = mktime($heure, $minute); // tps navette courante

		$tab3 = explode(":", $heure_dep_navette);
		$heure2 = $tab3[0];
		$minute2 = $tab3[1];
		
		$tps2 = mktime($heure2, $minute2); // tps de la navette	

		$diff = $tps - $tps2;

		// si diff < 0 -> navette avant
		if($diff < 0)
		{		
			if(abs($tps_avant) > abs($diff))
			{
				$id_avant = $id_trajet;
				$tps_avant = $diff;
				$duree_avant = $tab[1];
				$type_avant = $tab[2];
				$heure_dep_avant = $tab[0];
				$dest_avant = $tab[4];
				$depart_avant = $tab[5];
			}
		}
		elseif($diff > 0) // navette après
		{
			if($tps_apres > $diff)
			{
				$id_apres = $id_trajet;
				$tps_apres = $diff;
				$duree_apres = $tab[1];
				$type_apres = $tab[2];
				$heure_dep_apres = $tab[0];
				$dest_apres = $tab[4];
				$depart_apres = $tab[5];
			}
		}
		else  // navette en même temps
		{
			return false;
		}
	}
	
	$tps_apres = ($id_apres == 0) ? 0 : $tps_apres;
	$tps_avant = ($id_avant == 0) ? 0 : $tps_avant;


	return array(
				 array($id_avant, $tps_avant, $duree_avant, $heure_dep_avant, $type_avant, $dest_avant, $depart_avant),
				 array($id_apres, $tps_apres, $duree_apres, $heure_dep_apres, $type_apres, $dest_apres, $depart_apres)
				 );
}



function get_nb_partner()
{
	$ret = query("SELECT id_partner FROM aeroport_partenaire");
	
	$res = $ret->rowCount();
	
	$ret->closeCursor();
	
	return $res;
}


function get_prix_personne($id_lieu)
{
	$ret = query_prepare("SELECT prix_forfait, nb_personne FROM aeroport_lieu WHERE id_lieu = :id", array(':id' => $id_lieu), "get_prix_personne");
	
	$row = $ret->fetch();
	
	$res = round(($row['prix_forfait'] / $row['nb_personne']), 2);

	$ret->closeCursor();
	
	return $res;
}



function get_lieu_fixe()
{
	$ret = query("SELECT DISTINCT id_lieu FROM aeroport_fixe");
	
	$res = array();
	
	while($row = $ret->fetch())
		$res[] = $row['id_lieu'];
		
	$ret->closeCursor();
	
	return $res;
}


function trouve($mail)
{
	$ret = query("SELECT id_client FROM aeroport_client WHERE mail = '" . $mail . "'");
	
	$res = ($ret->rowCount() == 0) ? false : true;
	
	$ret->closeCursor();
	
	return $res;
}






function get_tarifs()
{
	$ret = query("SELECT nom, prix_forfait, nb_personne, duree FROM aeroport_lieu WHERE id_lieu != 100 ORDER BY nb_personne");
	
	$res = array();

	while($row = $ret->fetch())
	{
		$res[] = array(
					   "NOM" => $row['nom'],
					   "FORFAIT" => $row['prix_forfait'],
					   "PERSONNE" => $row['nb_personne'],
                       "DUREE" => gmdate('H\hi\m', $row['duree'])
					   );
	}
	
	$ret->closeCursor();
	
	return $res;
}


function set_partner_client($type)
{
	$ret = query_prepare("SELECT id_partner, nom_image, description_" . $_SESSION['lang'] . " AS description, titre_" . $_SESSION['lang'] . " AS titre, lien FROM aeroport_partenaire WHERE type = :type", array(':type' => $type), "set_partner_client");

	$res = array();
	
	while($row = $ret->fetch())
	{
		
		/*
		 * 
		 * 		Suppression du logo id_partner
		 * 		numero du logo numero 3
		 * 		se conférer sur la base de donnees 
		 * 		la table aeroport_partenaire 
		 * 		le champ id_partner y est présent  
		 * 
		 * **/
		if($row['id_partner']!='3'){
			
		$res[] = array(
					   "image" => $row['nom_image'],
					   "lien" => $row['lien'],
					   "titre" => $row['titre'],
					   "text" => $row['description'],
                       "id" => $row['id_partner']
					   );
		}
	}
	
	$ret->closeCursor();
	
	return $res;
}


function get_un_partner($id)
{
    $ret = query("SELECT nom_image, description_" . $_SESSION['lang'] . " AS description, titre_" . $_SESSION['lang'] . " AS titre, lien FROM aeroport_partenaire WHERE id_partner = " . $id);

    $res;
    
	$row = $ret->fetch();
    
    $res = array(
                   "image" => $row['nom_image'],
                   "lien" => $row['lien'],
                   "titre" => $row['titre'],
                   "text" => $row['description'],
                   );

	$ret->closeCursor();

	return $res;
}



function get_id_partner()
{
    $ret = query("SELECT id_partner FROM aeroport_partenaire");

    $res;

	while($row = $ret->fetch())
        $res[] = $row['id_partner'];

	$ret->closeCursor();

	return $res;
}



function list_dir($chemin, $corr = "")
{
	$tab = array();
	
	if($list = opendir($chemin))
	{
		while(false !== ($fichier = readdir($list)))
		{
			if($fichier != '.' && $fichier != '..')
			{
				if($corr != "")
				{
					if(strpos($fichier, $corr) !== FALSE)
						$tab[] = $fichier;
				}
				else
					$tab[] = $fichier;
			}
		}
		
		closedir($list);
	}
		
	return $tab;
}


/**
*	Renvoie un tableau de pagination
*	@param int $page : la page courrante
*	@param int $nb_page : le nombre de pages totales
*	@param int $nb : le nombre de pages à afficher avant et après les ...
*	@return array(int)
*/
function pagination($page, $nb_page, $nb = 4)
{
	$list_page = array();
	
	for ($i = 1; $i <= $nb_page; $i++)
	{
		if (($i < $nb) || ($i > $nb_page - $nb) || (($i < $page + $nb) && ($i > $page - $nb)))
			$list_page[] = $i;
		else
		{
			if ($i >= $nb && $i <= ($page - $nb))
				$i = $page - $nb;
			elseif ($i >= ($page + $nb) && $i <= ($nb_page - $nb))
				$i = $nb_page - $nb;
				
			$list_page[] = '...';
		}
	}
	
	return $list_page;
}



function header_mail()
{
	$headerMail = "From: \"Alsace-navette.com\" <info@alsace-navette.com>\n";
	$headerMail .= "Reply-to: \"Alsace-navette.com\" <info@alsace-navette.com>\n";
	$headerMail .= "MIME-Version: 1.0\n";
	$headerMail .= "Content-Type: text/html; charset=utf-8\n";
	$headerMail .= "X-Mailer: PHP/" . phpversion();
	
	return $headerMail;
}




function ligne_resa($type, $id_res, $id_trajet, $row, $langue, $rajout, $a_payer, $type_paiement)
{
	if($langue == "fr")
	{
		$enfant_g0 = "- 10 kg ou -9 mois";
		$enfant_g1 = "9 à 18 kg ou -4 ans";
		$enfant_g2 = "15 à 25 kg ou -7 ans";
		$enfant_g3 = "22 à 36 kg ou -10 ans";
	}
	else
	{
		$enfant_g0 = "- 10 kg or -9 month";
		$enfant_g1 = "9 to 18 kg or -4 year";
		$enfant_g2 = "15 to 25 kg or -7 year";
		$enfant_g3 = "22 to 36 kg or -10 year";
	}
	
	$tab_bebe = explode('|', $row['bebe_' . $type]);
	
	$bebe = "Enfants : \n";
	$bool_enfant = false;
	
	for($i = 0; $i < count($tab_bebe); $i++)
	{
		if($tab_bebe[$i] != "0")
		{
			$bool_enfant = true;
			$enfant = "enfant_g" . $i;
			$bebe .= $$enfant . " : " . $tab_bebe[$i] . "\n";
		}			
	}
	
	$type2 = ($type == "aller") ? "depart" : "retour";
	

	if($row[$type2 . '_fixe'] == "0") // a la demande
		$mnt_fixe = 15;
	else
		$mnt_fixe = 0;
	
	
	$var_info_compl = $row['info_compl'];
	
	$ligne_resa_1 = "INSERT INTO aeroport_ligne_resa (id_res, id_trajet, id_pt_rass, rassemblement, info_vol, nb_pers, nb_enfant, bebe, comm_bis, heure, prix, estFixe, supplement, prix_base, rajout, est_paye, type_trajet, prov_dest, methode_paiement)
					VALUES (
							'" . intval($id_res) . "',
							'" . intval($id_trajet) . "',
							'" . intval($row['id_pt_rass_' . $type]) . "',
							'" . addslashes($row['rass_adresse_' . $type]) . ' ' . addslashes($row['rass_cp_' . $type]) . ' ' . addslashes($row['rass_ville_' . $type]) . "',
							'" . addslashes($row['info_vol_' . $type]) . "',
							'" . $row['passager_adulte_' . $type] . "',
							'" . $row['passager_enfant_' . $type] . "',
							'" . (($bool_enfant) ? addslashes($bebe) : "") . "',
							'" . addslashes($var_info_compl) . (($bool_enfant) ? addslashes("\n" . $bebe) : "") . "',
							'" . $row['heure_reel_' . $type] . "',
							'" . ($row['prix_' . $type] + $row['supplement_' . $type] + $mnt_fixe) . "',
							'" . $row[$type2 . '_fixe'] . "',
							'" . $row['supplement_' . $type] . "',
							'" . $row['prix_' . $type] . "',
							'" . $rajout . "',
							'" . (($a_payer) ? "1" : "0") . "',
							'" . strtoupper($type) . "',
                            '" . $row['prov_dest_' . $type] . "',
                            '" . $type_paiement . "'
							)";
	
	$update_trajet = "UPDATE aeroport_trajet SET emedm = 1 WHERE id_trajet = '" . intval($id_trajet) . "' AND estValide = 1";
	
	write($update_trajet);
	
	return write2($ligne_resa_1);
}


function trajet($row, $id_chauffeur, $id_vehicule, $type, $d1, $d2, $a_payer, $id_init)
{
	$trajet1 = "INSERT INTO aeroport_trajet (id_chauffeur, id_vehicule, id_lieu_depart, id_lieu_dest, date, estValide, estFixe, est_paye, id_initiateur)
				VALUES (
						'" . intval($id_chauffeur) . "',
						'" . intval($id_vehicule) . "',
						'" . intval($d1) . "',
						'" . intval($d2) . "',
						'" . $row['date_' . $type] . "',
						'0', 
						'" . $row[$type . '_fixe'] . "',
						'" . (($a_payer) ? "1" : "0") . "',
                        '" . $id_init . "'
						)";
				
	return write2($trajet1);
}


function gestion_planning($id_com, $id_chauffeur, $id_vehicule, $type, $id_trajet, $id_dest)
{
	$planning = "INSERT INTO aeroport_gestion_planning (id_com, id_chauffeur, id_vehicule, type, id_lieu, id_trajet) 
				VALUES (
						'" . $id_com . "',
						'" . $id_chauffeur . "',
						'" . $id_vehicule . "',
						'" . $type . "',
						'" . $id_dest . "',
						'" . $id_trajet . "'
						)";
				
	write($planning);
}



function form_paypal($somme, $desc, $custom, $lang)
{
    global $owner_paypal, $cert_id_paypal;
    
	$form = array(
				'cmd' => '_xclick',//indique a paypal qu'il s'agit d'un bouton payer maintenant
				'business' => $owner_paypal,//adresse du vendeur (qui doit recevoir le paiement)
				'cpp_header_image' => 'http://alsace-navette.com/aeroport/images/bandeau_an_paypal.jpg',
				'item_name' => $desc,  //nom de la commande
				'item_number' => '1', //numero de la commande
				'currency_code' => 'EUR', //Devise
				'amount' => $somme, //montant a payer
				'lc' => $lang, //langue de l'interface paypal
				'cert_id' => $cert_id_paypal, //identifiant de certificat donné par paypal
				'custom' => $custom,//variable permettant de recevoir diverses informations sur la page de retour
				'invoice' => mt_rand() . time(),//valeur unique empechant les paiements accidentels (doit être differente pour chaque paiement)
				'charset' => 'utf-8',//Definit le charset utilisez
				'no_shipping' => '1', //Le client n'est pas invite a rentrer son adresse
				'return' => 'http://alsace-navette.com/aeroport/reservation/pdt.php',//Adresse de retour lorsque l'utilisateur clique sur retouner à la boutique
				'cancel_return' => 'http://alsace-navette.com/aeroport/index.html',//Adresse de retour pour les annulations
				'no_note' => '1',//Empeche l'utilisateur de rajouter des commentaires a son paiement.
				'notify_url' => 'http://alsace-navette.com/aeroport/reservation/ipn.php'//Url appelee par paypal lors du paiement, cette page permettra le traitement des commandes payees.
			);

	return paypal_encrypt($form);
}



function est_valide($id_trajet)
{
	$ret = query("SELECT estValide FROM aeroport_trajet WHERE id_trajet = '" . $id_trajet . "'");
	$rett = $ret->fetch();
	
	$res = $rett['estValide'];
	
	$ret->closeCursor();

	return ($res == 1) ? true : false;
}



function get_horaire($id_lieu)
{
	$res = array();
	
	$ret = query("SELECT DISTINCT depart, retour FROM aeroport_fixe WHERE id_lieu = '" . $id_lieu . "'");
	
	while($row = $ret->fetch())			
		$res[] = array('depart' => $row['depart'], 'retour' => $row['retour']);
		
	$ret->closeCursor();

	return $res;
}



function aeroport_fixe()
{
	$ret = query("SELECT DISTINCT(f.id_lieu), l.nom FROM aeroport_fixe f, aeroport_lieu l WHERE f.id_lieu = l.id_lieu");
	
	$res = array();
	while($row = $ret->fetch())
		$res[] = array('id' => $row['id_lieu'], 'nom' => $row['nom']);
		
	$ret->closeCursor();

	return $res;
}


function get_option($type)
{
    $ret = query_prepare("SELECT val_option opt FROM aeroport_options WHERE nom_option = :opt", array(":opt" => $type), "get_option");

    $row = $ret->fetch();

    $res = $row['opt'];

    $ret->closeCursor();

    return $res;
}


function get_nb_personne_forfait($id_lieu)
{
	$ret = query_prepare("SELECT nb_personne FROM aeroport_lieu WHERE id_lieu = :id", array(':id' => $id_lieu), "get_nb_personne_forfait");

	$row = $ret->fetch();

	$res = $row['nb_personne'];

	$ret->closeCursor();

	return $res;
}


function maj_der_min($id_ligne)
{
    $ret = query("SELECT r.supplement FROM aeroport_reservation r, aeroport_ligne_resa l WHERE l.id_ligne = '" . $id_ligne . "' AND l.id_res = r.id_res");

    $row = $ret->fetch();

    $res = $row['supplement'];

    $ret->closeCursor();

    return $res;
}


function get_prix($id_ligne, $champs)
{
    $ret = query_prepare("SELECT prix, est_paye, type_trajet FROM aeroport_ligne_resa WHERE id_ligne = :id", array(':id' => $id_ligne), "get_prix");

    $row = $ret->fetch();

    if($champs == "prix" && $row['type_trajet'] == 'ALLER')
        $res = $row[$champs] + maj_der_min($id_ligne);
    else
        $res = $row[$champs];

    $ret->closeCursor();

    return $res;
}



function crypter($need) {
	$key = "x9f5h1t8y9";
	$iv_size = mcrypt_get_iv_size(MCRYPT_XTEA, MCRYPT_MODE_ECB);
	$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
	return base64_encode(mcrypt_encrypt(MCRYPT_XTEA, $key, $need, MCRYPT_MODE_ECB, $iv));
}



function get_news($deb, $fin, $cat)
{
    $lang = $_SESSION['lang'];
    if($lang != "fr" && $lang != "en" && $lang != "ger")
        $lang = "en";

    $sql = "SELECT
				n.id,
                n.titre_" . $lang . " AS titre,
                n.texte_" . $lang . " AS texte,
				DATE_FORMAT(n.date, '%d/%m/%Y') as date,
                n.id_cat,
                t.cat_" . $lang . " AS cat
			FROM
				aeroport_news AS n, aeroport_news_cat AS t
            WHERE t.id_cat = n.id_cat AND n.public = '1'";

    if($cat != "")
        $sql .= " AND n.id_cat = " . $cat;

    $sql .= " ORDER BY n.id DESC
			LIMIT " . $deb. ", " . $fin
			;
echo $sql;
	$ret = query($sql);

	$res = array();
	while($row = $ret->fetch())
	{
		array_push($res, array(
							'ID' => $row['id'],
							'TITRE' => stripslashes($row['titre']),
                            'TEXTE' => stripslashes($row['texte']),
							'DATE' => $row['date'],
                            'ID_CAT' => $row['id_cat'],
                            'CAT' => $row['cat']
							)
				);
	}

	return $res;
}


function get_nb_news($cat)
{
	$ret = query("SELECT COUNT(*) as nb FROM aeroport_news WHERE public = '1'" . (($cat != "") ? (" AND id_cat = " . $cat) : ""));

	$tmp = $ret->fetch();

	$res = $tmp['nb'];

	$ret->closeCursor();

	return $res;
}


function get_alea_news()
{
    $nb_news = get_nb_news("");

    $lang = $_SESSION['lang'];
    if($lang != "fr" && $lang != "en" && $lang != "ger")
        $lang = "en";

    do
    {
        $nb_alea = mt_rand(1, $nb_news);
        
        $sql = "SELECT n.id,
                    n.titre_" . $lang . " AS titre,
                    n.texte_" . $lang . " AS texte,
                    DATE_FORMAT(n.date, '%d/%m/%Y') as date,
                    t.cat_" . $lang . " AS cat,
                    n.id_cat AS id_cat
                FROM aeroport_news n, aeroport_news_cat t
                WHERE n.id_cat = t.id_cat
                AND n.public = '1'
                AND n.id = " . $nb_alea;

        $ret = query($sql);
    }
    while($ret->rowCount() != 1);


    $row = $ret->fetch();


    global $publie_le, $lire_suite, $dans, $toutes_les_news;

    $lire_la_suite = '<a href="news-n' . $nb_alea . '.html">' . $lire_suite . '</a>';

    return '<h3 style="margin-bottom:5px">' . $row['titre'] . '</h3><span>' . $publie_le . " " . $row['date'] . ' ' . $dans . ' ' . $row['cat'] . '</span><br /><br /><p>' . substr($row['texte'], 0, 500) . '....</p><br /><span style="margin:10px"><span style="float:right"><a href="news.html">'.$toutes_les_news.'</a></span>' . $lire_la_suite ."</span>";
}


function get_une_news($id)
{
    $lang = $_SESSION['lang'];
    if($lang != "fr" && $lang != "en" && $lang != "ger")
        $lang = "en";
        
     $sql = "SELECT n.id,
                    n.titre_" . $lang . " AS titre,
                    n.texte_" . $lang . " AS texte,
                    DATE_FORMAT(n.date, '%d/%m/%Y') as date,
                    t.cat_" . $lang . " AS cat,
                    n.id_cat AS id_cat
                FROM aeroport_news n, aeroport_news_cat t
                WHERE n.id_cat = t.id_cat
                AND n.id = " . $id;

    $ret = query($sql);

    $row = $ret->fetch();

    return array("TITRE" => $row['titre'], "TEXTE" => $row['texte'], "DATE" => $row['date'], "CAT" => $row['cat'], "ID_CAT" => $row['id_cat']);

}


function get_lst_cat()
{
    $lang = $_SESSION['lang'];
    if($lang != "fr" && $lang != "en" && $lang != "ger")
        $lang = "en";

    $sql = "SELECT id_cat, cat_" . $lang . " AS cat FROM aeroport_news_cat";
    $ret = query($sql);

    $tab = array();
    $tab[] = array("id_cat" => "", "nom" => "");
    
    while($row = $ret->fetch())
        $tab[] = array("id_cat" => $row['id_cat'], "nom" => $row['cat']);

    $ret->closeCursor();

    return $tab;
}


?>
