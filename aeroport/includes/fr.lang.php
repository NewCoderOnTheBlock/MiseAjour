<?php

	/* 
		KEMPF :
		Ajout des fonctions, principalement
		pour pouvoir utiliser les get_option() et ainsi
		éviter de découper les textes pour y inclure 
		des valeurs.
	*/		
	$dirname = dirname(__FILE__);
	
	require_once($dirname . "/../../libs/db.php");
	require_once($dirname . "/../../includes/fonctions.php");

	// footer + Ajout plan du site (KEMPF)
	$mentions = "Mentions légales";
	$cgv = "CGV";
	$cgv_long = "Condtions générales de vente";
	$charte = "Charte de qualité";
	$plan_du_site = "Plan du site";
	$contact = "Contact";
	$lien_qui_sommes_nous = "Qui sommes nous ?";
	$lien_services = "Nos services";
	$choix_navette	= "Choix de la navette";
	$tarif_navette  = "Tarifs navettes"; 
	$info = "Mes informations personnelles";
	$titre_trajet1 = "Mes trajets";
	$changer_pass = "Changer de mot de passe";
	$nouveau_pass = "Obtenir un nouveau de mot de passe";
	$info_client = "Informations client";
	$presentation_tarifs = "Nos tarifs";
	$presentation_horaires = "Nos horaires";
	$presentation_services = "Nos services & clients";
	$presentation_pratique = "Informations pratiques";
	$programme_fidelite = "Notre programme fidelité";
	$presentation_faq = "Foire Aux Questions";
	$fin_paiement = "Merci de votre confiance";

	// title de la page html
	$titre_page_accueil 		= "Bienvenue sur Alsace-navette.com | Alsace-navette.com Navette Strasbourg aéroport : Bale-Mulhouse Francfort Karlsruhe Baden Stuttgart";
	$titre_page_livreor 		= "Livre d'or | Alsace-navette.com Navette Strasbourg aéroport : Bale-Mulhouse Francfort Karlsruhe Baden Stuttgart";
	$titre_page_contact 		= "Formulaire de contact | Alsace-navette.com Navette Strasbourg aéroport : Bale-Mulhouse Francfort Karlsruhe Baden Stuttgart";
	$titre_page_res_recap 		= "Réservation : récapitulatif | Alsace-navette.com Navette Strasbourg aéroport : Bale-Mulhouse Francfort Karlsruhe Baden Stuttgart";
	$titre_page_client 			= "Espace client | Alsace-navette.com Navette Strasbourg aéroport : Bale-Mulhouse Francfort Karlsruhe Baden Stuttgart";
	$titre_page_changer_pass 	= $changer_pass . " | Alsace-navette.com Navette Strasbourg aéroport : Bale-Mulhouse Francfort Karlsruhe Baden Stuttgart";
	$titre_page_nouveau_pass 	= $nouveau_pass . " | Alsace-navette.com Navette Strasbourg aéroport : Bale-Mulhouse Francfort Karlsruhe Baden Stuttgart";
	$titre_info					= $info . " | Alsace-navette.com Navette Strasbourg aéroport : Bale-Mulhouse Francfort Karlsruhe Baden Stuttgart";
	$titre_page_trajet			= $titre_trajet1 . " | Alsace-navette.com Navette Strasbourg aéroport : Bale-Mulhouse Francfort Karlsruhe Baden Stuttgart";
	$titre_fin_paiement			= $fin_paiement . " | Alsace-navette.com Navette Strasbourg aéroport : Bale-Mulhouse Francfort Karlsruhe Baden Stuttgart";
	$titre_mention				= $mentions . ' | Alsace-navette.com Navette Strasbourg aéroport : Bale-Mulhouse Francfort Karlsruhe Baden Stuttgart';
	$titre_cgv					= $cgv_long . ' | Alsace-navette.com Navette Strasbourg aéroport : Bale-Mulhouse Francfort Karlsruhe Baden Stuttgart';
	$titre_charte				= $charte . ' | Alsace-navette.com Navette Strasbourg aéroport : Bale-Mulhouse Francfort Karlsruhe Baden Stuttgart';
	$titre_plan					= $plan_du_site . ' | Alsace-navette.com Navette Strasbourg aéroport : Bale-Mulhouse Francfort Karlsruhe Baden Stuttgart';
	$titre_choix_navette		= $choix_navette . ' | Alsace-navette.com Navette Strasbourg aéroport : Bale-Mulhouse Francfort Karlsruhe Baden Stuttgart';
	$titre_tarif_navette		= $tarif_navette . ' | Alsace-navette.com Strasbourg Shuttle airport : Bale-Mulhouse Francfort Karlsruhe Baden Stuttgart';
	$titre_info_client			= $info_client . ' | Alsace-navette.com Navette Strasbourg aéroport : Bale-Mulhouse Francfort Karlsruhe Baden Stuttgart';
	$titre_tarifs				= $presentation_tarifs . ' | Alsace-navette.com Navette Strasbourg aéroport : Bale-Mulhouse Francfort Karlsruhe Baden Stuttgart';
	$titre_horaires				= $presentation_horaires . ' | Alsace-navette.com Navette Strasbourg aéroport : Bale-Mulhouse Francfort Karlsruhe Baden Stuttgart';
	$titre_services				= $presentation_services . ' | Alsace-navette.com Navette Strasbourg aéroport : Bale-Mulhouse Francfort Karlsruhe Baden Stuttgart';
	$titre_pratique				= $presentation_pratique . ' | Alsace-navette.com Navette Strasbourg aéroport : Bale-Mulhouse Francfort Karlsruhe Baden Stuttgart';
	$titre_fidelite				= "Notre programme fidelité | Alsace-navette.com Navette Strasbourg aéroport : Bale-Mulhouse Francfort Karlsruhe Baden Stuttgart";
	$titre_faq					= "Foire Aux Questions | Alsace-navette.com Navette Strasbourg aéroport : Bale-Mulhouse Francfort Karlsruhe Baden Stuttgart";
	$titre_aide					= "Aide | Alsace-navette.com Strasbourg Shuttle airport : Bale-Mulhouse Francfort Karlsruhe Baden Stuttgart";
	
	
	$changer_pass = "Obtenir un nouveau mot de passe";
	$nos_partenaires = "Nos partenaires";
	$nos_clients = "Merci à tous ceux qui nous font confiance";
	
	$lang_se_connecter = "Espace client";
	$fermer = "Fermer";
	
	// drapeaux
	$alt_drapeau = "English language";
	$alt_aide = "Aide";
	$alt_paypal = "Effectuez vos paiements via PayPal : une solution rapide, gratuite et sécurisée";
	$alt_print = "Imprimer";
	$alt_texte = "Changer la taille du texte";
	
	$aeroport_str = "Aéroport de Strasbourg";
	$aeroport_baden = "Aéroport de Karlsruhe / Baden-Baden";
	$aeroport_bale = "Aéroport de Bâle / Mulhouse";
	$aeroport_fkh = "Aéroport de Frankfort Hahn";
	$aeroport_fkm = "Aéroport de Frankfort Main";
	$aeroport_zurich = "Aéroport de Zürich";
	$aeroport_stuttgart = "Aéroport de Stuttgart";
	$aeroport_entzheim = "Aéroport Entzheim (Strasbourg)";
	$aeroport_sarrebruck = "Aéroport Sarrebruck";
	$aeroport_bruxelles = "Aéroport Bruxelles";
	$aeroport_paris = "Aéroport Paris";
	$aeroport_luxembourg = "Aéroport du Luxembourg";
	$aeroport_zweibrucken = "Aéroport de Zweibrucken";
	$gare_sncf = "Gare SNCF";
	
	// Liste des aéroports
	$lang_liste_aero = array(
		array(
			"TEXTE" => $aeroport_baden,
			"IMAGE" => "aeroport_baden.png",
			"LIEN" => "http://www.baden-airpark.de/startseite.html?&L=2"
			),
		array(
			"TEXTE" => $aeroport_bale,
			"IMAGE" => "aeroport_bale.png",
			"LIEN" => "http://www.euroairport.com/FR/accueil.php"
			),
		array(
			"TEXTE" => $aeroport_fkh,
			"IMAGE" => "aeroport_frankfort_hahn.png",
			"LIEN" => "http://www.hahn-airport.de/Default.aspx?menu=passengers_visitors&cc=fr"
			),
		array(
			"TEXTE" => $aeroport_fkm,
			"IMAGE" => "aeroport_frankfort_main.png",
			"LIEN" => "http://www.frankfurt-airport.de"
			),
		array(
			"TEXTE" => $aeroport_zurich,
			"IMAGE" => "aeroport_zurich.gif",
			"LIEN" => "http://www.aeroport-de-zurich.com/desktopdefault.aspx"
			),
		array(
			"TEXTE" => $aeroport_stuttgart,
			"IMAGE" => "aeroport_stuttgart.gif",
			"LIEN" => "http://www.stuttgart-airport.com/sys/index.php?section_id=0&id=0&lang=1"
			),
		array(
			"TEXTE" => $aeroport_entzheim,
			"IMAGE" => "aeroport_entzheim.gif",
			"LIEN" => "http://www.strasbourg.aeroport.fr"
			),
		array(
			"TEXTE" => $aeroport_sarrebruck,
			"IMAGE" => "aeroport_saarebruck.png",
			"LIEN" => "http://www.flughafen-saarbruecken.de/index.php?id=1&L=2"
			),
		array(
			"TEXTE" => $aeroport_bruxelles,
			"IMAGE" => "aeroport_bruxelles.png",
			"LIEN" => "http://www.brusselsairport.be/fr/"
			),
		array(
			"TEXTE" => $aeroport_paris,
			"IMAGE" => "aeroport_paris.png",
			"LIEN" => "http://www.aeroportsdeparis.fr"
			),
		array(
			"TEXTE" => $aeroport_luxembourg,
			"IMAGE" => "aeroport_luxembourg.png",
			"LIEN" => "http://www.lux-airport.lu/"
			),
		array(
			"TEXTE" => $aeroport_zweibrucken,
			"IMAGE" => "aeroport_zweibrucken.png",
			"LIEN" => "http://www.flughafen-zweibruecken.de"
			),
		array(
			"TEXTE" => $gare_sncf,
			"IMAGE" => "logo_sncf.jpg",
			"LIEN" => "http://sncf.com"
			)
		);
		
	// Liste des compagnies aériennes
	$lang_titre_compagnies = "Compagnies aériennes";
	$lang_liste_compagnies = array(
		array(
			"TEXTE" => "RyanAir",
			"IMAGE" => "logo_ryanair.png",
			"LIEN" => "http://www.ryanair.com/fr"
			),
		array(
			"TEXTE" => "Air Berlin",
			"IMAGE" => "logo_airberlin.jpg",
			"LIEN" => "http://www.airberlin.com"
			),
		array(
			"TEXTE" => "EasyJet",
			"IMAGE" => "logo_easyjet.png",
			"LIEN" => "http://www.easyjet.com"
			),
		array(
			"TEXTE" => "Swiss",
			"IMAGE" => "logo_swiss.gif",
			"LIEN" => "http://www.swiss.com/web/FR/Pages/index.aspx?Country=FR"
			),
		array(
			"TEXTE" => "Lufthansa",
			"IMAGE" => "logo_luftansa.gif",
			"LIEN" => "http://www.lufthansa.com/online/portal/lh/fr/homepage"
			),
		array(
			"TEXTE" => "SunExpress",
			"IMAGE" => "logo_sunexpress.gif",
			"LIEN" => "http://www.sunexpress.com/"
			),
		array(
			"TEXTE" => "Austrian",
			"IMAGE" => "logo_austrian.gif",
			"LIEN" => "http://www.austrian.com/?cc=FR&sc_lang=fr"
			),
		array(
			"TEXTE" => "Pegasus",
			"IMAGE" => "logo_pegasus.gif",
			"LIEN" => "http://www.flypgs.com/fr/"
			),
		array(
			"TEXTE" => "Turkish Airlines",
			"IMAGE" => "logo_turkish.gif",
			"LIEN" => "http://www.turkishairlines.com/"
			),
		array(
			"TEXTE" => "AirFrance",
			"IMAGE" => "logo_airfrance.jpg",
			"LIEN" => "http://www.airfrance.fr"
			)
		);
	
	$alt_reseau_aeroport = "Choisir votre aéroport en fonction de votre destination";
	$alt_tourisme = "Visiter l'Alsace autrement";
	$alt_office_tourisme = "Office de tourisme de Strasbourg";
	$alt_sncf = "Services de train";
	$alt_lvc = "Service de transport à la demande, laissez-vous conduire tout simplement";
	$alt_conseil = "Renseignez-vous sur le pays de destination";
	$alt_canal_asso = "La vie associative en Alsace";
	
	$lang_licence = "Licence";
	$lang_texte_licence = "Licence n°".get_option("num_licence")." pour le transport intérieur de personnes par route.";
	
	$deja_client_question = "Etes-vous déjà client ?";
	
	$attention_der_min = "Vous avez effectué une réservation de dernière minute. Cela vous coûtera donc ";
    $attention_der_min_fin = " € supplémentaires.";
	$txt_der_min = "Vous avez effectué une réservation de dernière minute et ne pouvez effectuer un payement électronique automatiquement.<br />Votre demande a bien été enregistrée et sera traitée manuellement par notre opérateur.<br />Vous allez recevoir rapidement une réponse en fonction de nos disponibilités.";
	
	// fil d'ariane
	$ariane_debut   		= "Vous êtes ici";
	$ariane_accueil 		= "Accueil";
	$ariane_reserver 		= "Réservation";
	$ariane_livreor 		= "Livre d'or";
	$ariane_liste_livreor 	= "Liste des messages";
	$ariane_reservation_1 	= "Informations du trajet (étape 1 / 5)";
	$ariane_reservation_2 	= "Récapitulatif (étape 4 / 5)";
	$page_precedent 		= "Précédente";
	$page_suivant 			= "Suivante";
	$ariane_contact 		= "Formulaire de contact";
	$ariane_client 			= "Client";
	$ariane_authentification = "Connexion";
	$ariane_pass 			= "Mot de passe";
	$ariane_changement_pass = "Changement du mot de passe";
	$ariane_new_password 	= "Mot de passe perdu";
	$ariane_trajet			= "Mes trajets";
	$ariane_visu_trajet		= "Visualisation des trajets";
	$ariane_reservation_navette = "Choix de la navette (étape 3 / 5)";
	$ariane_info_perso 		= "Mes informations personnelles";
	$ariane_modif_info_perso = "Modification des informations personnelles";
	$ariane_fin_reservation	= "Fin de la réservation (étape 5 / 5)";
	$ariane_reservation_info_client = "Saisie des informations client (étape 2 / 5)";
	
	
	// speedbar
	$speed_accueil  = "Accueil";
	$speed_tarif    = "Tarifs";
	$speed_contact  = "Contact";
	$speed_livre_or = "Livre d'or";
	$speed_service  = "Nos services";
	$speed_reserver = "Réservation";
	$speed_pratique= "Infos pratiques";
	$speed_news = "Actualités";
	$speed_horaire = "Horaires";
	$speed_aide = "FAQ";
	
	// Bandeau réservation simplifiée
	$aide_reservation = "Aide à la réservation";
	$etape1 = "Remplir le fomulaire";
	$etape2 = "Choisir une offre";
	$etape3 = "Payer en ligne";
	$etape4 = "Une confirmation vous est envoyée";
	
	// Liens page d'accueil
	$horaires_navettes = "Horaires des navettes";
	$horaires_vols = "Horaires des vols";
	$infos = "Infos sur votre trajet";
	$points_prise = "Point de prise des navettes";
	
	// Slider page d'accueil
	$en_savoir_plus = "En savoir plus";
	$slide1 = "Services aéroport";
	$slide2 = "Un large choix d'horaires";
	$slide3 = "Des prix abordables";
	
	// Services
	$text_pratique_titre_strasbourg = "Points de rassemblement à Strasbourg";
	$text_pratique_titre_autre = "Points de rassemblement aux aéroports";
	
	// Page d'aide
	$aide = "Aide";
	$titre_etape_1 = "Demande de tarifs";
	$titre_etape_2 = "Offres tarifaires";
	$titre_etape_3 = "Choix et réservation";
	$titre_etape_4 = "Paiement sécurisé";
	$titre_etape_5 = "Confirmation par email";
	$titre_etape_6 = "Informations pratiques";
	$titre_etape_7 = "Rappel la veille du départ";
	$titre_etape_8 = "Rendez-vous au point de rassemblement";
	$titre_etape_9 = "Le voyage commence";
	$titre_etape_10 = "Merci et à bientôt";
	$txt_etape_1 = "Les informations que vous donnez restent confidentielles.";
	$txt_etape_2 = "Prix tout compris. Vous payez ce qui est affiché.";
	$txt_etape_3 = "Déjà plus de 40000 réservations depuis 2007.";
	$txt_etape_5 = "Votre réservation est bien enregistrée.";
	$txt_etape_6_1 = "Informations sur votre chauffeur";
	$txt_etape_6_2 = "Itinéraire";
	$txt_etape_6_3 = "Temps de trajet";
	$txt_etape_7 = "Vous recevez par mail et sms les informations essentielles de votre trajet.";
	$txt_etape_8 = "Pas besoin de billet, votre nom est sur la liste de notre chauffeur.";
	$etape_8_lien_rass = "Voir les points de rassemblement";
	$etape_8_lien_rass_aeroport = "Aéroports";
	$txt_etape_9 = "La destination est proche.";
	$txt_etape_10 = "Votre chauffeur vous dépose à destination au plus près de votre avion.";
	$txt_bon_voyage = "Bon voyage !";
	
	// Page infos pratiques
	$voir_plus = "Voir plus";
	$infos_tarif = "Informations tarifaires";
	$option = "Option :";
	$txt_option_demande = "Vous pouvez aussi choisir le service horaires à la demande lors de votre réservation.";
	$pt_rass = "Point de rassemblement";
	$txt_rass_bale = "Sortie rez de chaussée côté Français";
	$txt_rass_baden = "Sortie 4 (en face de l'hôtel B&B)";
	$txt_rass_stuttgart = "Terminal 2 Niveau départ Porte 2-3";
	$txt_rass_francfort_main = "Terminal 1 Niveau arrivées Porte B-3";
	$txt_rass_zurich = "Terminal 2 Niveau départ en face de <span style='font-style:italic;'>Prime Center 1</span>";
	$txt_google_map = "Voir sur Google Map";
	$trajet_simple = "Trajet simple <span style='font-weight:bold;'>Strasbourg > Aéroport</span> ou <span style='font-weight:bold;'>Aéroport > Strasbourg</span>";
	$points_rass_strasbourg = "Parking relais Palais des droits de l'homme - Hôtel Hilton - Gare centrale";
	$horaires_disponibles = "Horaires disponibles";
	$pts_rass = "Points de rassemblement";
	$txt_horaires_strasbourg = "Tenir compte des horaires indiqués pour chaque aéroport concernant Strasbourg Gare et ajouter le temps correspondant.";
	$hotel_hilton = "Hôtel Hilton";
	$palais_droits_hommes = "Palais des Droits de l'Homme";
	$txt_pts_rass_strasbourg = "Tous ces points de rassemblement à Strasbourg sont à votre disposition.<br>Cependant, la réservation reste obligatoire.";
	$adresse_palais_droits_hommes = "<span style='font-weight:bold;'>Parking relais Boecklin Palais des droits de l'homme</span><br>(En face sortie parking Palais des Droits de l'Homme)<br>Allée René Cassin<br />67000 Strasbourg";
	$adresse_hotel_hilton = "<span style='font-weight:bold;'>Hôtel Hilton</span><br>(Arrêt bus en face hotel Hilton)<br>1 rue Fritz Kieffer<br>67000 Strasbourg";
	$adresse_gare = "<span style='font-weight:bold;'>Strasbourg Gare</span><br>(En face du \"Crédit Agricole\")<br>3 Boulevard de Metz<br>67000 Strasbourg";
	$txt_horaires_vols = "Merci de consulter le";
	$site_aeroport = "site de l'aéroport";
	
	// livre d'or
	$intro_livreor 		= "Le service rendu vous a plu ? Alors laissez un commentaire !";
	$pseudo_livreor 	= "Votre prénom";
	$message_livreor 	= "Votre message";
	$txt_captcha 		= "Vous devez recopier les lettres que vous voyez dans l'image ci-dessous<br> pour que votre message soit validé.<br />Cette image contient 5 caractères.";
	$nouveau_captcha 	= "Changer l'image";
	$txt_nb_message 	= "Nombre de messages";
	$livreor_par		= "Par";
	$livreor_le	 		= "le";
	$aucun_message 		= "Il n'y a aucun message !";
	$valide_livreor 	= "Votre message a bien été ajouté";
	
	
	// erreur spry
	$spry_valeur_requise = "Valeur requise";
	$spry_format = "Erreur de format";
	$spry_correspondance = "Les valeurs ne correspondent pas";
	
	$btn_continuer = "Continuer";
	$erreur_flash = "Le contenu de cette page nécessite une version plus récente d’Adobe Flash Player";
	$visiter_alsace = "Visiter l'Alsace";
	$navette_vol = "Navette pour les vols";
	$choix_aeroport = "Choix de l'aéroport";
	$a_dest_de = "A destination de";
	$en_prov_de = "En provenance de";
	$meilleurs_prix = "Meilleurs prix au départ de Strasbourg";
	$photos = "Photos";
	
	// KEMPF: Amélioration de l'aide concernant les horaires fixes et à la demande
	$hover_aide_fixe = "Ces horaires fixes correspondent à des horaires les plus fréquemment demandés pour l'aéroport concerné (Départs ou Arrivées selon le cas).
	<br /><br />
	Avec les horaires fixes, vous aurez plus de chance de voir d'autres passagers se joindre à votre navette.";
	$hover_aide = "Ces horaires à la demande donnent plus de flexibilité à votre demande.
	<br /><br />
	Néanmoins, un supplément de ".get_option("maj_surcout_demande")." € sera appliqué.";	
	
	$explication_forfait_minimum = "Le forfait minimum est le prix à partir duquel la navette est sûre de partir";
	$remboursement_forfait = "Si d'autres personnes se joignent à votre navette, vous serez remboursé de la différence du tarif de base.";
	$label_chk_forfait_mini = "J'accepte de payer le forfait minimum";
	
	$cout_du_trajet = "Coût du trajet";
	
	$explication_nouveau_mot_de_passe = "Vous désirez changer votre mot de passe ?<br>Il vous suffit de renseigner celui actuellement utilisé ainsi que le nouveau.";
	$explication_mot_de_passe_perdu = "Vous avez oublié ou perdu votre mot de passe ?<br>Pas de panique, renseignez simplement votre adresse email, et nous vous en enverrons un nouveau à cette adresse.";
	$explication_connexion = "Vous avez déjà réservé chez nous ?<br>Si oui, vous pouvez avoir accès à l'historique de vos réservations, vos informations personnelles,...";
	$explication_donnees_perso = "Ici, vous pouvez modifier vos informations personnelles.";
	$explication_trajet = "Ici, vous avez un historique de vos trajets.";
	
    $duree 			= "Durée estimée du trajet :";
    $duree_s	 	= "Durée estimée des trajets";
    $aeroport 		= "Aéroport";
    $aeroports 		= "Aéroports";
	$horaire 		= "Horaires";
	$dep_str 		= "Départ Strasbourg Gare";
	$dep_str_gare	= "Départ Strasbourg Gare";
	$dep_aeroport 	= " Départ aéroport";
	$expli_duree_rass = "Hôtel Hilton : + 10 min<br />Palais Droits de L’Homme : + 15 min";
	
	// page de contact
	$txt_contact 		= "Avant de nous contacter, merci de vérifier que <span style='font-weight:bold;'>vous n'êtes pas</span> dans un des cas suivants :";
	$txt_raison_1 		= "Pour laisser votre avis sur notre service, merci d'utiliser le <a href=\"livreor.php\">livre d'or</a>.";
	$txt_raison_2 		= "Toutes les réservations s'effectuent en ligne via le <a href='index.php'>formulaire de réservation</a>.";
	$txt_raison_3		= "Les tarifs sont disponibles à la seconde étape du <a href='index.php'>formulaire de réservation</a> ou sur la <a href='tarifs-baden-karlsruhe-sttutgart-frankfurt-basel-mulhouse-entzheim.php'>page tarifs</a>.";
	$txt_raison_4		= "Néanmoins, si vous avez des difficultés à réserver, vous pouvez nous contacter via les moyens ci-dessous";
	$txt_moyen_courrier = "Espace Alsace-Navette<br>2 Rue du Coq<br>67000 Strasbourg - quartier Petite France</span>";
	$txt_moyen_tel 		= "Par téléphone, de 9h00 à 12h00 et de 14h00 à 17h00<br><span style='font-weight:bold;'>06 27 18 12 52</span>";
	$txt_moyen_port 	= "En cas d'urgence<br><span style='font-weight:bold;'>06 27 18 12 52</span>";
	$txt_moyen_mail 	= "Par email, à l'adresse <span style='font-weight:bold;'><a href=\"mailto:info@alsace-navette.com\">info@alsace-navette.com</a></span>";
	$txt_moyen_form 	= "Via le formulaire ci-dessous";
	$moyen_contact 		= "Si vous éprouvez des difficultés pour réserver, n'hésitez pas à nous contacter.";
	$raison_contact 	= "Motif";
	$raison_contact_0 	= "Renseignement";
	$raison_contact_1 	= "Problème technique";
	$raison_contact_2 	= "Partenariat";
	$contact_ok 		= "Votre message a bien été envoyé";
	$contact_erreur 	= "Une erreur est survenue pendant l'envoi de votre message";
	
	// menu de droite
	$titre_tourisme   = "Tourisme avec Alsace-navette";
	$contenu_tourisme = "Laissez vous séduire, Laissez vous conduire; empruntez les circuits conduits pour visiter l'alsace";
	
	
	$deja_client    = "Si vous êtes <strong>déjà</strong> client, <a href=\"client/client.php\">cliquez ici</a>";
	$alt_calendrier = "Calendrier";
	$obligatoire    = "Champs obligatoires";
	$obligatoire_2  = "Au moins l'un des deux champs doit être renseigné";
	$btn_raz 		= "Effacer";
	$btn_envoyer	= "Envoyer";
	$mail_invalide 	= "L'adresse email n'est pas valide";
	$selectionner_date_depart = "Jour de départ";
	$selectionner_date_retour = "Jour de retour";
	
	$erreur_champ_vide 	= "Vous devez remplir tous les champs !";
	$erreur_champ_vide2 	= "Vous devez remplir tous les champs !";
	$erreur_code 		= "Le code de vérification n'est pas correct !";
	$txt_pas_ressource_aller  = "Il n'y a malheureusement pas de ressources disponibles au moment de votre départ";
	$txt_pas_ressource_retour = "Il n'y a malheureusement pas de ressources disponibles au moment de votre retour";
	$txt_pas_ressource_a_r    = "Il n'y a malheureusement pas de ressources disponibles, ni pour l'aller, ni pour le retour";
	$txt_pas_ressource_forfait = "Cependant, vous pouvez vous rajouter sur une navette déjà existante, si disponible ci-dessus.";
	
	$deconnexion 	= "Déconnexion";
	$changer_pass 	= "Changer mot de passe";
	$trajet			= "Historique des trajets";
	$changer_info_perso = "Changer données perso";
	$erreur_date	= "La date de retour doit être au minimun le lendemain du départ";
	$aller			= "Aller";
	$retour			= "Retour";
	$mon_compte 	= "Mon compte";
	$pas_de_trajet  = "Il n'y a pas de trajets vous concernant";
	$choix_navette	= "Choix de la navette";
	$tarif_navette  = "Tarifs navettes";
	$txt_deja_client = "Au vu de votre adresse email, il semblerait que vous avez déjà passé une commande chez nous. Pour récupérer vos informations, <a href=\"client/client.php\">veuillez vous connecter</a> avec votre adresse email et votre mot de passe !";
	$sur_adresse_prise = "Nous n'avons pas pu localiser l'adresse fournie pour la prise à domicile : ";
	$sur_adresse_depose = "Nous n'avons pas pu localiser l'adresse fournie pour la dépose à domicile : ";
	$sur_adresse = "Mon adresse est correcte";

	// trajet
	$legend_trajet       = "Votre trajet";
	$trajet_type         = "Trajet";
	$trajet_aller_simple = "Aller simple";
	$trajet_aller_retour = "Aller-retour";
	$trajet_depart       = "Départ";
	$trajet_arrive       = "Destination";
	$date				 = "Date";
	$heure				 = "Heure";
	$date_depart         = "Date de départ";
	$date_retour         = "Date de retour";
	$heure_depart		 = "Horaires à la demande";
	$heure_retour		 = "Horaires à la demande";
	$passager_adulte	 = "Adultes";
	$passager_enfant	 = "Enfants (< 10 ans, si besoin de siège)";
	$legend_client	     = "Client";
	$civilite			 = "Civilité";
	$nom_client		     = "Nom";
	$prenom_client	     = "Prénom";
	$tel_client			= "Téléphone fixe";
	$port_client		= "Téléphone portable";
	$autres_infos		= "Autres informations";
	$eemail				= "Email";
	$verif_email		= "Vérification Email";
	$adresse_client		= "Adresse";
	$code_post_client 	= "Code postal";
	$ville_client		= "Ville";
	$pays_client		= "Pays";
	$france 			= "France";
	$allemagne			= "Allemagne";
	$suisse				= "Suisse";
	$luxembourg			= "Luxembourg";
	$belgique			= "Belgique";
	$info_vol			= "Informations sur le vol";
	$info_transport		= "Informations sur le transport";
	$info_confirmation	= "Confirmation";
	$info_compl 		= "Demandes particulières";
	$pt_rassemblement_aller 	= "Point de prise / dépose<br />sur Strasbourg (aller)";
	$pt_rassemblement_retour 	= "Point de prise / dépose<br />sur Strasbourg (retour)";
	$pt_rassemblement			= "Point de prise / dépose<br>sur Strasbourg";
	$txt_changer_info_perso = 'Pour changer vos informations personnelles, cliquez <a href="client/info.html">ici</a>';
	$depart_fixe 		= "Horaires fixes";
	$retour_fixe 		= "Horaires fixes";
	$nb_pers_forfait_mini = "Nombre de personnes du forfait minimum";
	$enfant_g0 = "- 10 kg ou -9 mois";
	$enfant_g1 = "9 à 18 kg ou -4 ans";
	$enfant_g2 = "15 à 25 kg ou -7 ans";
	$enfant_g3 = "22 à 36 kg ou -10 ans";
	$provenance_vol = "Provenance";
	$dest_vol = "Destination";
	$compagnie_vol = "Compagnie aérienne";
	$heure_vol = "Heure du vol";
	$nombre_passager = "Nombre de passagers";
	$mon_trajet = "Mon trajet";
	$title_reservation = "Formulaire de réservation";
	$title_demande = "Tarifs et réservation";
	$btn_afficher_tarifs = "Afficher les tarifs";
	$btn_reserver = "Poursuivre la réservation";
	$btn_annuler = "Annuler";
	$btn_derniere_etape = "Confirmer";
	$code_promo = "Code promotionnel";
	$horaire_choisi = "Horaire choisi";
	
	// réservation
	$recapitulatif 	= "Récapitulatif de votre demande";
	$titre_trajet 	= "Votre trajet";
	$titre_client	= "Vos informations";
	$info_incorrect = 'Si ces informations ne sont pas correctes, cliquez <a href="index.php">ici</a>';
	$btn_payer 		= "Payer";
	$remise_code_promo = "Remise";
	$navette_existant_aller = "Il y a déjà des navettes de prévues pour l'aller";
	$navette_existant_retour = "Il y a déjà des navettes de prévues pour le retour";
	$date_heure_navette 	= "Date et heure de départ";
	$nb_personne_navette 	= "Nombre de personnes<br />déjà sur la navette";
	$prix_navette 			= "Prix";
	$tarif 					= "Tarifs";
	$tarif_s				= "Tarif";
	$cout_trajet_base 		= "Tarif de base du trajet";
	$nb_passager 			= "Nombre de passagers";
	$prise_domicile			= "Prise à domicile";
	$depose_domicile		= "Dépose à domicile";
	$res_der_minute_72		= "Réservation à moins de 72h";
	$res_der_minute_24		= "Réservation à moins de 24h";
	$prix_total				= "Prix total";
	$personne				= "personne";
	$forfait_mini			= "Forfait minimun";
	$fin_res				= 'Vous pouvez retrouver les détails de votre réservation <a href="client/trajet.php">ici</a>, ainsi que les informations sur le chauffeur, une fois qu\'il aura été attribué';
	$fin_res_accueil		= "Revenir à l'accueil du site";
	$navette_individuelle	= "Navette individuelle";
	$txt_oui				= "Oui";
	$txt_non				= "Non";
	$joindre				= "Sélectionner";
	// KEMPF : Textes liés au remises
	$lang_remise			= "Remise";
	$lang_remise_8_pers		= "Remise pour 8 personnes";
	$lang_horaires_de_nuit	= "Horaires de nuit";
	$lang_opt_serenite		= "Option sérénité";
	// KEMPF : Textes liés au service annulation
	$lang_annuler_le_trajet = "Annuler le trajet";
	$lang_trajet_annule = "Trajet annulé";
	$lang_annulation = "Option Sérénité (Annulation)";
	$lang_option_annulation = "Ajouter l'option Sérénité (Annulation : + ".get_option("maj_annulation")." % du prix total)";
	$lang_expli_option_annulation = "
		Cette option coutera <strong>".get_option("maj_annulation")."% du prix total</strong> de la prestation et sera facturée à la réservation.
		<br /><br />
		Elle vous donne la possibilité d'annuler votre réservation en toutes circonstances.
		<br /><br />
		En cas d'annulation, un remboursement sera effectué. Le montant de ce remboursement varie selon les cas :
		<br />
		<ul>
			<li>Un <strong>remboursement total du prix</strong> sera effectué si la réservation est annulée <strong>7 jours avant le départ</strong></li>
			<li>Un <strong>remboursement de 60% du prix</strong> sera effectué si la réservation est annulée <strong>12 heures avant le départ</strong></li>
			<li>Un <strong>remboursement de 20% du prix</strong> sera appliqué si l'annulation est effectuée à <strong>moins de 12h avant le départ</strong></li>
		</ul>
		Aucun remboursement ne sera effectué après le départ.
		<br /><br />
		<strong>A noter</strong> : Le prix de l'option d'annulation n'est pas compris dans le remboursement.";
		
	// KEMPF: Ajout de l'aide sur les points de rassemblement
	$lang_aide_pt_rassemblement = "
		Ce sont les endroits où la navette vous cherchera ou vous déposera sur Strasbourg.
		<br /><br />
		Vous pouvez choisir un point de rassemblement à domicile, ce qui coutera ".get_option("maj_dom")." € supplémentaires, ou ".get_option("maj_dom_km")." € par kilomètres en dehors de Strasbourg.
		<br /><br />
		<strong>Attention :</strong>
		<br />
		<ul>
			<li>Pour le point de rassemblement « Palais des droits de l'homme », il faut compter <strong>10 minutes supplémentaires</strong> sur le temps de prise / dépose.</li>
			<li>Pour le point de rassemblement « Hôtel Hilton », il faut compter <strong>15 minutes supplémentaires</strong> sur le temps de prise / dépose.</li>
			<li>Pour le point de rassemblement « Domicile », le temps de prise / dépose peut <strong>varier selon le lieu demandé.</strong></li>
		</ul>";
	
	// KEMPF: Ajout de l'aide sur les inforamtions de vol
	$lang_aide_vol = "
		Ces informations concernant le vol nous permettent de mieux répondre à votre demande.
		<br /><br />
		Elles nous permettent également de vous suivre en cas de probleme quelconque.";
	$lang_aide_enfants = "
		Cette information permet de connaître le nombre de sièges pour enfants nécessaires lors du trajet.
		<br /><br />
		Cela n'a aucune incidence sur le montant du tarif.";
	
	/**
	 * Modif MARC
	 * 
	 * */			
	
	$titre_a_cocher_si_la_personne_est_autre = "A cocher si le passager n'est pas la personne réservant la navette.";
	$titre_autre_passager   = "( Renseignements du passager )";
	$nom_autre_passager     = "Nom";
	$indicatif_tel_autre_passager    = "Indicatif téléphone";
	$tel_port_autre_passager     = "Téléphone portable";
	
	
	// page client
	$deja_client_txt 	= "Déjà client ?";
	$email 				= "Adresse email";
	$passwd 			= "Mot de passe";
	$mdp_oublie 		= "J'ai oublié mon mot de passe...";
	$erreur_client_login = "Désolé, le couple adresse mail / mot de passe que vous avez donné n'existe pas !<br /><a href=\"client/password-a2.html\">Avez-vous oublié votre mot de passe ?</a>";
	$erreur_client_inexistant = "Aucun client n'a été trouvé avec l'adresse fournie";
	$valide_new_pass 	= "Un nouveau mot de passe a été envoyé à l'adresse fournie";
	$object_new_pass 	= "Alsace-navette.com : Nouveau mot de passe";
	$erreur_envoie_mail = "Une erreur est survenue lors de l'envoi du nouveau mot de passe. Celui-ci n'a pas été changé !";
	$debut_mail_pass 	= "Bonjour,<br /><br />Vous avez demandé un nouveau mot de passe, le voici : <strong>";
	$fin_mail_pass 		= "</strong><br /><br />A bientôt sur Alsace-navette.com";
	$ancien_mdp 		= "Mot de passe actuel";
	$new_pass 			= "Nouveau mot de passe";
	$new_pass_confirm 	= "Confirmer";
	$erreur_pass_correspondance = "La confirmation du nouveau mot de passe n'est pas bonne !";
	$valide_new_passwd 	= "Votre mot de passe à bien été changé.";
	$debut_mail_passwd 	= "Bonjour,<br /><br />Vous avez changé votre mot de passe, le voici : <strong>";
	$erreur_ancien_pass = "Votre ancien mot de passe ne correspond pas !";
	$valide_new_info 	= "Vos informations personnelles ont bien été enregistrées";
	$expli_email = 
		"Il n'est pas possible de modifier votre adresse e-mail dans votre espace personnel. 
		<br/>
		Si vous souhaitez modifier votre adresse e-mail, vous devez créer un autre compte.";
	

	
	// page des trajets
	$trajet_du = "Trajet du ";
	$table_mois = array("Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre");
	$table_jour = array("Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi");
	$info_pratique = "Informations pratiques";
	$chauffeur_nom = "Nom du chauffeur";
	$chauffeur_prenom = "Prénom du chauffeur";
	$chauffeur_mail = "Adresse mail du chauffeur";
	$chauffeur_port = "Téléphone du chauffeur";
	$status_valide = "Validé par nos services";
	$status_invalide = "En attente de désignation du conducteur";
    $statut_attente = "En attente de confirmation";
	
	$par_personne = "Par personne";
	$aucune_navette = "Il n'y a pas encore de navette prévue ce jour pour votre destination, mais le forfait minimum est possible";
	$navette_disponible = "Il existe déjà des navettes : vous pouvez en prendre une existante, ou bien demander une nouvelle et donc d'accepter de payer le forfait minimum ! Pour plus d'informations, reporter vous à la <a href='tarifs-baden-karlsruhe-sttutgart-frankfurt-basel-mulhouse-entzheim.php'>page des tarifs</a>";
	$facture = "Facture";
	$creer_facture = "Créer sa facture personnalisée";
	$changer_adresse = "Changer l'adresse de facturation";
	$modifier = "Modifier la facture";
	$voir = "Voir sa facture";
	$civilite = "Civilité";
	$nom = "Nom";
	$prenom = "Prénom";
	$adresse_postale = "Adresse postale";
	$ville = "Ville";
	$code_postal = "Code postal";
	$pays = "Pays";
	
	$text_cgv_1 = get_cgv("condition_1_fr").
				get_cgv("condition_2_fr").
				get_cgv("condition_3_fr").
				get_cgv("condition_4_fr").
				get_cgv("condition_5_fr");
	$text_cgv_2 = get_cgv("condition_6_fr").
				get_cgv("condition_7_fr").
				get_cgv("condition_8_fr").
				get_cgv("condition_9_fr").
				get_cgv("condition_10_fr");
		
	
	$text_mention = "<strong>- Le présent site est la propriété de l’Association franco iranienne d’Alsace</strong>
        <br />
    	<br />
        2 Rue du Coq
        <br />
        67000 Strasbourg
        <br />
        N° SIRET ".get_option("num_siret")."
        <br />
        Code NAF : 9499Z
        <br /><br />
        
        Numero de licence de transport de personnes :
        <br />
        Licence n°".get_option("num_licence")."
        <br /><br />
        
        Nom du site : <a href=\"http://www.alsace-navette.com\">www.alsace-navette.com</a>
        <br />
        <br />
        <strong>- L’hébergeur du site est :</strong>
        <br />
        <br />
        1and1 Internet SARL
        <br />
        7, place de la Gare
        <br />
        57200 Sarreguemines
        <br />
        Tel : 0825 080 020
        <br />
        Email : <a href=\"mailto:support@1and1.fr\">support@1and1.fr</a>
        <br />
        
        <br />
        <strong>- Droit d'accès aux données :</strong>
        <br />
        <br />
        Vous disposez d'un droit d'accès et de rectification de vos données personnelles.<br>Pour cela, vous pouvez nous adresser un <a href=\"mailto:info@alsace-navette.com\">courrier électronique</a>. Le délai sera d'environ un mois.
        
        <br />
        <br />
        En cas d'urgence, téléphonez au 06 27 18 12 52.";
	
	// Ajout Plan du site (KEMPF)
	$text_plan_site ='
		<a href="../index.php" title="Portail">Portail</a>
		
		<ul>
			<li><a href="index.php" title="'.$ariane_accueil.'">'.$ariane_accueil.'</a></li>
			<li><a href="demande_reservation.php" title="'.$speed_reserver.'">'.$speed_reserver.'</a></li>
			<li><a href="horaires-baden-karlsruhe-sttutgart-frankfurt-basel-mulhouse-entzheim.php" title="'.$speed_horaire.'">'.$speed_horaire.'</a></li>
			<li><a href="tarifs-baden-karlsruhe-sttutgart-frankfurt-basel-mulhouse-entzheim.php" title="'.$speed_tarif.'">'.$speed_tarif.'</a></li>
			<li><a href="news.php" title="'.$speed_news.'">'.$speed_news.'</a></li>
			<li><a href="aide-lufthansa-easyjet-ryanair-airberlin.php" title="'.$speed_aide.'">'.$speed_aide.'</a></li>
			<li><a href="livreor.php" title="'.$speed_livre_or.'">'.$speed_livre_or.'</a></li>
			<li><a href="../index.php" title="'.$speed_service.'">'.$speed_service.'</a></li>
			<li><a href="contact.php" title="'.$speed_contact.'">'.$speed_contact.'</a></li>
			<li><a href="../sondage/index.php" title="Sondage">Sondage</a></li>
			<li><a href="mentions.php" title="'.$mentions.'">'.$mentions.'</a></li>
			<li><a href="cgv.php" title="'.$cgv.'">'.$cgv.'</a></li>
			<li><a href="charte.php" title="'.$charte.'">'.$charte.'</a></li>
			<li><a href="plan_site.php" title="'.$plan_du_site.'">'.$plan_du_site.'</a></li>
		</ul>	
	';
	
	$text_charte = "Soucieux de vous fournir un service dont la qualité est irréprochable, nous nous soumettons à des règles très strictes constituant notre charte de qualité. Ces règles sont propres à notre structure et démontrent à nos clients voyageurs l'importance que nous accordons à leur bien-être.
		
       <br /><br />
       <strong>Charte 1 : Sécurité
       <br /><br />
       Charte 2 : Minimiser le temps d’attente :</strong>
       <br /><br />
       - Nous vous signalons le moindre retard par SMS.
       <br /><br />
       - L’attente au point de rendez-vous fixé ne dépassera pas les 15 minutes.
       <br /><br />
       
       <strong>
       Charte 3 : Facilité d’accès au service
       <br /><br />
       Charte 4 : Confort des personnes
       <br /><br />
       Charte 5 : Suivi de commande
       <br /><br />
       Charte 6 : Joignabilité de notre société
       <br /><br />
       Charte 7 : A l’écoute des besoins du client
       <br /><br />
       Charte 8 : Formation de nos employés
       <br /><br />
       Charte 9 : Le meilleur rapport qualité/prix
       <br /><br />
       Charte 10 : Exigences d’une économie sociale et solidaire
       <br /><br />
       Charte 11 : Respect de l’environnement
       <br /><br />
       Charte 12 : Service de proximité
       <br /><br />
       Alsace Navette participe à un <a href=\"http://www.solidaire.alsace-navette.com\">projet d'économie sociale et solidaire</a>.
		</strong>";
	
	/* Ajout KEMPF : Page service */
	$text_services = "<p><strong>Alsace Navette Aéroport</strong> propose <strong>7/7j</strong> et <strong>24/24h</strong> son service de transport lowcost vers les aéroport Karlsruhe-Baden, Stuttgart, Frankfurt-Main, Hahn , Bruxelles, Sarrebruck, Basel, Zurich et Strasbourg.
	<br /><br />
	Depuis 2007, qualité et fiabilité du service proposé ont fait qu’aujourd’hui Alsace Navette est le premier prestataire privé alsacien de navette aéroport et que 100% de ses clients ont pris à temps leur vol. <strong>Essayez la différence.</strong>
	<br /><br />
	Alsace-navette.com/aeroport +33388222271
	<br />
	<br />
	Nos véhicules, spacieux et confortables, disposent de 8 places assises, de la climatisation et d’un GPS.
	<br />
	<br />
	Nous assurons votre transport vers les principaux aéroports de la région.</p>";
	
	/* Modification par KEMPF : Séparation en 2 de la page pour ajouter les ancres
		Ajout des adresse et des liens StreetView
	*/	
	$text_pratique_stras = "
	Les trois points de rassemblement sur Strasbourg sont à votre disposition (veuillez noter que la réservation est obligatoire) :
	
	<div>
		<ul>
			<li>
				<a title='Lien vers la carte (GoogleMap)' target='blank_' href=\"http://maps.google.fr/maps?f=q&source=s_q&hl=fr&geocode=&q=Rue+Ren%C3%A9+Cassin+Strasbourg&sll=48.601928,7.745447&sspn=0.027471,0.077248&ie=UTF8&ll=48.59892,7.775552&spn=0.006528,0.019312&z=16\">Parking relais Palais des droits de l'homme</a> (En face sortie parking PDH)
				<br />
				Allée René Cassin
				<br />
				67000 Strasbourg
				<br />
				<a title='GoogleMaps' target='blank_' href=\"http://maps.google.fr/maps?f=q&source=s_q&hl=fr&geocode=&q=Rue+Ren%C3%A9+Cassin+Strasbourg&sll=48.601928,7.745447&sspn=0.027471,0.077248&ie=UTF8&ll=48.59892,7.775552&spn=0.006528,0.019312&z=16\"><img alt='GoogleMaps' src=\"images/icones/maps-16.gif\" /></a>
				
				<a title='StreetView' target='blank_' href=\"http://maps.google.fr/maps?q=Rue+Ren%C3%A9+Cassin+Strasbourg&hl=fr&ie=UTF8&ll=48.597955,7.775767&spn=0.007209,0.021136&sll=48.601928,7.745447&sspn=0.027471,0.077248&hnear=All%C3%A9e+Ren%C3%A9+Cassin,+67000+Strasbourg,+Bas-Rhin,+Alsace&t=m&z=16&layer=c&cbll=48.597852,7.775859&panoid=KR880iZN-cQbfSed4aABdg&cbp=12,47.49,,0,1.64\"><img alt='StreetView' src=\"images/icones/street-16.png\" /></a>
				<br /><br />
			</li>
			<li>
				<a title='Lien vers la carte (GoogleMap)' target='blank_' href=\"https://www.google.com/maps/place/1+Rue+Fritz+Kieffer/@48.5956782,7.754104,17z/data=!3m1!4b1!4m2!3m1!1s0x4796c85c8c9bb95d:0xf3c3c4ec5e6a34fa\">Hôtel Hilton</a> (Arrêt bus en face hotel Hilton)
				<br />
				1 rue Fritz Kieffer
				<br />				
				67000 Strasbourg
				<br />
				<a title='GoogleMaps' target='blank_' href=\"https://www.google.com/maps/place/1+Rue+Fritz+Kieffer/@48.5956782,7.754104,17z/data=!3m1!4b1!4m2!3m1!1s0x4796c85c8c9bb95d:0xf3c3c4ec5e6a34fa\"><img alt='GoogleMaps' src=\"images/icones/maps-16.gif\" /></a>
				
				<a title='StreetView' target='blank_' href=\"https://www.google.fr/maps/@48.596481,7.755625,3a,75y,262.93h,89.44t/data=!3m4!1e1!3m2!1siQZFzFaPnvHqFkHeHlu_hA!2e0?hl=fr\"><img alt='StreetView' src=\"images/icones/street-16.png\" /></a>
				<br /><br />
			</li>
			<li>
				<a title='Lien vers la carte (GoogleMap)' target='blank_' href=\"http://maps.google.fr/maps?f=q&amp;hl=fr&amp;geocode=&amp;time=&amp;date=&amp;ttype=&amp;q=strasbourg+3+bld+Metz&amp;sll=48.582172,7.732444&amp;sspn=0.010164,0.020084&amp;ie=UTF8&amp;ll=48.583634,7.733924&amp;spn=0.010163,0.020084&amp;z=16&amp;iwloc=addr&amp;om=1\">Strasbourg Gare</a> (En face du \"Crédit Agricole\")
				<br />
				3 Boulevard de Metz
				<br />
				67000 Strasbourg
				<br />
				<a title='GoogleMaps' target='blank_' href=\"http://maps.google.fr/maps?f=q&amp;hl=fr&amp;geocode=&amp;time=&amp;date=&amp;ttype=&amp;q=strasbourg+3+bld+Metz&amp;sll=48.582172,7.732444&amp;sspn=0.010164,0.020084&amp;ie=UTF8&amp;ll=48.583634,7.733924&amp;spn=0.010163,0.020084&amp;z=16&amp;iwloc=addr&amp;om=1\"><img alt='GoogleMaps' src=\"images/icones/maps-16.gif\" /></a>
				
				<a title='StreetView' target='blank_' href=\"http://maps.google.fr/maps?q=strasbourg+3+bld+Metz&hl=fr&ll=48.583751,7.734101&spn=0.002051,0.005681&sll=48.582172,7.732444&sspn=0.010164,0.020084&om=1&hnear=3+Boulevard+de+Metz,+67000+Strasbourg,+Bas-Rhin,+Alsace&t=m&z=18&vpsrc=6&layer=c&cbll=48.583845,7.734205&panoid=h1VVhtB65gJO5DwwESR_-Q&cbp=12,320.18,,0,5.18\"><img alt='StreetView' src=\"images/icones/street-16.png\" /></a>
			</li>
		</ul>
	</div>
	
	<br />
	
	Vous pouvez également être pris en charge à votre domicile ou au bureau. Cette demande vous sera facturée :
	<br />
	- sur Strasbourg : ".get_option("maj_dom")." €
	<br />
	- hors Strasbourg : demander devis (facturation ".get_option("maj_dom_km")." € / km à partir de Strasbourg Gare)";
	
	$text_pratique_autre = "
	<div class=\"centre\">
		<p>
			<span style='font-weight:bold;font-size:1.2em;'>Bâle/Mulhouse</span>
			<br />
			<br />
			<strong>Sortie rez de chaussée côté Français</strong>
			<br />
			<img src=\"images/sortie_bale.jpg\" alt=\"aéroport Bâle Mulhouse\" title=\"Aéroport Bâle Mulhouse, Sortie rez de chaussée côté Francais.\" />&nbsp;
			<a href=\"http://www.euroairport.com/FR/voyageurs.php?PAGEID=64&lang=FR\" target=_blank><img src=\"images/plan_bale.jpg\" alt=\"plan aéroport Bâle/Mulhouse\" title=\"Plan Aéroport Bâle/Mulhouse\"/></a>
			<br /><br />
			<a href='http://maps.google.fr/maps?q=47.599325,7.532699&hl=fr&num=1&t=h&z=18' target='blank_'><img alt='GoogleMaps' src=\"images/icones/maps-16.gif\" /> GoogleMap</a>
		</p>
	</div>
	
	<br />
	<br />
	
	<div class=\"centre\">
		<p>
			<span style='font-weight:bold;font-size:1.2em;'>Aéroport Karlsruhe / Baden-Baden</span>
			<br />
			<br />
			<strong>Sortie 4</strong>
			<br />
			<img src=\"images/sortie_baden.jpg\" alt=\"sortie aéroport Karlsruhe / Baden-Baden sortie 4\" title=\"Aéroport Karlsruhe / Baden-Baden sortie 4\"  />&nbsp;
			<a href=\"images/plan_baden_big.png\" target=_blank><img src=\"images/plan_baden.jpg\" alt=\"plan aéroport Karlsruhe / Baden-Baden\" title=\"Plan Aéroport Karlsruhe / Baden-Baden\"/></a>
			<br /><br />
			<a href='http://maps.google.fr/maps?q=48.778475,8.087358&hl=fr&num=1&t=h&z=18' target='blank_'><img alt='GoogleMaps' src=\"images/icones/maps-16.gif\" /> GoogleMap</a>
		</p>
	</div>
	
	<br />
	<br />
	
	<div class=\"centre\">
		<p>
			<span style='font-weight:bold;font-size:1.2em;'>Aéroport Frankfurt Main</span>
			<br />
			<br />
			<strong>Terminal 1 Niveau arrivés Porte B-3</strong>
			<br />
			<img src=\"images/sortie_fm.jpg\" alt=\"sortie aéroport Frankfurt Main\" title=\"Aéroport Frankfurt Main Terminal 1 Niveau arrivés Porte B-3\"  />&nbsp;
			<a href=\"http://www.frankfurt-airport.com/content/frankfurt_airport/en/directions_parking/airport_maps1/terminal_1_2.html\" target=_blank><img src=\"images/plan_fm.jpg\" alt=\"plan aéroport Frankfurt Main\" title=\"Plan Aéroport Frankfurt Main\"/></a>
		</p>
	</div>
	
	<br />
	<br />
	
	<div class=\"centre\">
		<p>
			<span style='font-weight:bold;font-size:1.2em;'>Aéroport de Stuttgart</span>
			<br />
			<br />
			<strong>Terminal 2 Niveau départ Porte 2-3</strong>
			<br />
			<img src=\"images/sortie_stuttgart.jpg\" alt=\"sortie aéroport Stuttgart\" title=\"Aéroport Stuttgart Terminal 2 Niveau départ Porte 2-3\"  />&nbsp;
			<a href=\"http://www.stuttgart-airport.com/sys/index.php?section_id=4&id=8&lang=1\" target=_blank><img src=\"images/plan_stutt.jpg\" alt=\"plan aéroport Stuttgart\" title=\"Plan Aéroport Stuttgart\"/></a>
			<br /><br />
			<a href='http://maps.google.fr/maps?q=48.690535,9.192787&hl=fr&ll=48.690465,9.191962&spn=0.004349,0.011362&num=1&t=h&z=17' target='blank_'><img alt='GoogleMaps' src=\"images/icones/maps-16.gif\" /> GoogleMap</a>
		</p>
	</div>
	
	<br />
	<br />
	
	<div class=\"centre\">
		<p>
			<span style='font-weight:bold;font-size:1.2em;'>Aéroport de Zurich</span>
			<br />
			<br />
			<strong>Terminal 2 Niveau départ en face de <i>Prime Center 1</i></strong>
			<br />
			<img src=\"images/sortie_zurich.jpg\" alt=\"sortie aéroport Zurich\" title=\"Aéroport Zurich Terminal 2 Niveau départ en face de Prime Center 1\"  />&nbsp;
			<a href=\"http://www.aeroport-de-zurich.com/desktopdefault.aspx/tabid-316/\" target=_blank><img src=\"images/plan_zurich.jpg\" alt=\"plan aéroport Zurich\" title=\"Plan Aéroport Zurich\"/></a>
			<br /><br />
			<a href='http://maps.google.fr/maps?q=48.778475,8.087358&hl=fr&num=1&t=h&z=18' target='blank_'><img alt='GoogleMaps' src=\"images/icones/maps-16.gif\" /> GoogleMap</a>
		</p>
	</div>
	
	<p>
	<br />
	
	Seul le transfert des clients ayant réservé leur place est assuré. De ce fait, la navette ne dessert pas systématiquement tous les arrêts.
	
	<br />
	<br />
	
	En cas d'urgence,téléphonez au 06 27 18 12 52.
	</p>";


	$text_tarifs = "
		<strong>Informations complémentaires :</strong>
		<br /><br />
	<ul>
		<li>Nous rappelons que les navettes Strasbourg - Karlsruhe / Baden-Baden sont assurées à partir de ".get_nb_personne_forfait(2)." personnes ou d'un forfait minimum</li>
		<li>Nous rappelons que les navettes Strasbourg - Bâle Mulhouse sont assurées à partir de ".get_nb_personne_forfait(1)." personnes ou d'un forfait minimum</li>
		<li>Nous rappelons que les navettes Strasbourg - Stuttgart et Strasbourg - Zürich sont assurées à partir de ".get_nb_personne_forfait(3)." personnes ou d'un forfait minimum</li>
		<li>Nous rappelons que les navettes  Strasbourg - Frankfurt Hahn, Strasbourg - Frankfurt am Main sont assurées à partir de ".get_nb_personne_forfait(4)." personnes ou d'un forfait minimum</li>
		<li>Aucun supplément ne sera demandé pour vos bagages. Toutefois les passagers devront se limiter à une valise et à un sac à main</li>
		<li>Vous pouvez également être pris en charge à votre domicile ou au bureau. Cette demande vous sera facturée :
			<ul>
				<li>sur Strasbourg : ".get_option("maj_dom")." €</li>
				<li>hors Strasbourg : demander devis (facturation ".get_option("maj_dom_km")." € / km à partir de Strasbourg Gare)</li>
			</ul>
		</li>
		<li>Une majoration de ".get_option("maj_horaire_nuit")." € est appliquée pour les trajets de nuit entre ".str_replace(":", "h", get_option("horaire_nuit_debut"))." et ".str_replace(":", "h", get_option("horaire_nuit_fin"))."</li>
		<li>Une remise est effectuée pour les réservations pour 8 personnes</li>
		<li>Veuillez noter que la majoration à domicile est incluse dans le tarif pour les navettes Entzheim.</li>
		<li>Un forfait de 5 euros sera demandé par animal</li>
		<li>Sur demande, vous pouvez réserver un mini-bus avec chauffeur. Le forfait se monte à 40 € l'heure de location ou 40 kms. Le km supplémentaire sera facturé 1 €</li>
	</ul>
	<br />
	";
	
	
	$erreur_400 = "Echec de l'analyse HTTP !";
	$erreur_401 = "Erreur de login / mot de passe pour l'accès à l'administration !";
	$erreur_403 = "Requête interdite !";
	$erreur_404 = "La page demandée n'existe pas !";
	$erreur_405 = "Méthode de requête non autorisée !";
	
	$erreur_500 = "Erreur interne du serveur !";
	$erreur_501 = "Fonctionnalité réclamée non supportée par le serveur !";
	$erreur_502 = "Mauvaise réponse envoyée à un serveur intermédiaire par un autre serveur !";
	$erreur_503 = "Service indisponible !";
	$erreur_504 = "Temps d'attente d'une réponse d'un serveur à un serveur intermédiaire écoulé !";
	$erreur_505 = "Version HTTP non gérée par le serveur !";
	
	$erreur_sql = "Une erreur du serveur SQL est survenue !";
	
	$erreur_defaut = "Une erreur inconnue est survenue !";
	
	$page_erreur = "Une erreur est survenue";
	
	$revenir = "Page précédente";
	
	$erreur = "Erreur";
	
	
	
	// pour mail paypal
	
	$sujet_nouveau_client = "Bienvenue sur Alsace-navette.com | Vos identifiants";
	$debut_nouveau_client = "Bonjour, vous avez effectué une réservation sur Alsace-navette.com !<br /><br />Vous faîtes désormais partie de nos clients. Vous avez donc accès à des informations personnalisées sur notre site.<br /><br />Pour y avoir accès, il vous faut votre adresse email : <strong>";
	$milieu_nouveau_client = "</strong> et votre mot de passe qui est : <strong>";
	$fin_nouveau_client = "</strong><br /><br />Depuis le site, vous pouvez le changer.<br /><br />Pour vous connecter, rendez-vous <a href=\"http://alsace-navette.com/aeroport/client/client.html\">sur la page de connexion</a>.<br /><br />Merci de votre confiance";
		
		
	$ajax_expli = "Les navettes suivantes correspondent aux navettes fixes.";
	$ajax_depart = "Départ à";
	
	
	$bonjour = "Bonjour";
	$demande_traite = "Votre demande a bien été enregistrée pour le(s) trajet(s) suivant(s) : ";
	$fin_demande = "Vous recevrez prochainement un mail avec les dernières informations concernant votre trajet (nom du conducteur, son numéro de portable). Vous pouvez également à tout moment retrouver ces informations sur <strong> <a href=\"http://alsace-navette.com/aeroport\"> Alsace-navette.com </a></strong> en vous connectant à l’aide de votre adresse e-mail et du mot de passe que vous avez reçu par courriel lors de votre première réservation. <br /><br /><br />Merci de votre confiance et à bientôt sur Alsace-Navette.com";
	$fin_demande_der_min = "Vous avez effectué une demande de réservation de dernière minute et vous n'avez donc pas payé. Une fois que votre demande sera traitée manuellement, vous recevrez un avis de paiement pour confirmer votre réservation <strong>dans la limite des disponibilités</strong>. <br /><br />Vous pouvez également à tout moment retrouver ces informations sur <strong> <a href=\"http://alsace-navette.com/aeroport\"> Alsace-navette.com </a></strong> en vous connectant à l’aide de votre adresse e-mail et du mot de passe que vous avez reçu par courriel lors de votre première réservation. <br /><br /><br />Merci de votre confiance et à bientôt sur Alsace-Navette.com";
	
	$titre_recap_mail_client = "Récapitulatif de votre demande";
	$meteo = "Météo";
	
	$surcout_demande = "Navette à la demande";
	
	$expli_attendre = "Si vous préférez attendre que d'autre personnes se joignent à votre navette, enregistrez votre demande, mais vous ne paierez pas maintenant, mais une fois que d'autres personnes auront rejoint la navette.<br /><br /><strong>Cela ne vous engage en rien : vous n'avez aucune obligation de paiement.</strong>";
	$label_attendre = "J'attends que d'autres personnes se joignent à ma navette";
	$mail_attendre = "<br />Vous avez décidé d'attendre que d'autres personnes se joignent à votre navette pour la confirmer. Dès que d'autres personnes joindront votre navette, vous serez prévenu par mail.<br /><br /><strong>Cette demande ne vous engage en rien : vous n'avez aucune obligation de paiement.</strong>";
	$jai_attendu = "Vous avez préféré attendre que d'autres personnes se joignent à votre navette. Vous ne payez donc rien maintenant, mais une fois que vous aurez confirmé votre navette.";
	
	$choix = "Choix ";
	$deselectionner = "Désélectionner";
	$plan = "Voir le plan";
	
	$accept_cgv = "J'ai lu et j'accepte les <a href=\"cgv.php\" target=\"_blank\">conditions générales de vente</a>";
	$erreur_accept_cgv = "Il faut accepter les <a href=\"cgv.php\" target=\"_blank\">conditions générales de vente</a> !";
	
	
	$accept_forfait_mini_aller = "J'accepte de payer le forfait minimum pour <u>l'aller</u>";
	$accept_forfait_mini_retour = "J'accepte de payer le forfait minimum pour <u>le retour</u>";
	$accept_forfait_mini_aller_retour = "J'accepte de payer le forfait minimum pour <u>l'aller et le retour</u>";
	
	$label_attendre_aller = "J'attends que d'autres personnes se joignent à ma navette pour <u>l'aller</u>";
	$label_attendre_retour = "J'attends que d'autres personnes se joignent à ma navette pour <u>le retour</u>";
	
	$prix_a_payer = "Prix à payer maintenant";
	
	$jai_attendu_aller = "Vous avez préféré attendre que d'autres personnes se joignent à votre navette pour <u>l'aller</u>. Vous ne payez donc pas ce trajet maintenant, mais une fois que vous aurez confirmé votre navette. Maintenant, vous ne payez que le trajet du retour.";
	$jai_attendu_retour = "Vous avez préféré attendre que d'autres personnes se joignent à votre navette pour <u>le retour</u>. Vous ne payez donc pas ce trajet maintenant, mais une fois que vous aurez confirmé votre navette. Maintenant, vous ne payez que le trajet de l'aller.";


	$client_existe_pas = "Ce client n'existe pas !";
	$code_incorect = "Le code de vérification est incorrect !";
	$res_pas_trouve = "Nous n'avons pas trouvé la réservation correspondante !";
	$res_pas_au_client = "Cette réservation ne correspond pas à ce client !";
	$trajet_introuvable = "Le trajet est introuvable !";
	$ligne_introuvable_aller = "La ligne de réservation pour le trajet de l'aller est introuvable !";
	$ligne_corr_trajet = "La ligne de réservation ne correspond pas au trajet !";
	$ligne_retour_payer = "Ce trajet (retour) est déjà payé !";
	$ligne_aller_payer = "Ce trajet (aller) est déjà payé !";
	
	$ariane_paiement_manuel = "Paiement différé d'une réservation";
	$ariane_paiement_manuel_titre = $ariane_paiement_manuel . ' | Alsace-navette.com';
	
	$confirmation_resa = "Pour nous envoyer votre demande, cliquez sur le bouton ci-dessous";
		
	$expli_hor_fixe = "Pour les aéroports ci-dessous, il existe des horaires fixes : ";
	//$expli_hor_demande = "Pour les aéroports de Bruxelles, Sarrebruck, Strasbourg-Entzheim, Paris, Stuttgart, Frankfurt, Hahn et Zurich les horaires sont libres.<br />Pour les aéroports de Karlsruhe-Baden et Bâle-Mulhouse, sont aussi proposées des horaires à la demande avec un supplément de ";
	$expli_hor_demande = "Vous avez le choix entre des horaires fixes et des horaires à la demande.";
	$expli_hor_demande_2 = "Tous les aéroports disposent d'horaires à la demande.";
	$explication_entzheim = "Pour l'aéroport de Entzheim (Strasbourg), il n'y a pas d'horaires fixes, uniquement des horaires à la demande. Ces horaires à la demande ne sont PAS facturés.";
	$explication_autre_aeroport = "Pour cet aéroport, il n'y a pas d'horaires fixes, uniquement des horaires à la demande.";
    $mail_derniere_minute = "(Dernière minute)";

    $label_nouvelle_navette = "Je désire une nouvelle navette";
    $label_nouvelle_navette_aller_retour = "Je désire une nouvelle navette pour <u>l'aller et le retour</u>";
    $label_nouvelle_navette_aller = "Je désire une nouvelle navette pour <u>l'aller</u>";
    $label_nouvelle_navette_retour = "Je désire une nouvelle navette pour <u>le retour</u>";

    $warning_tel = "Le fait de ne pas renseigner un numéro de téléphone valide peut vous être préjudiciable : en cas de changement de dernière minute, nous serions dans l'impossibilité de vous joindre !";


    $est_paye = "Payé";
    $non_paye = "Non payé";
    $sous_total = "Sous-total";


    $fin_demande2 = "Pour les navettes où vous avez choisi d'attendre, vous serez prévenu par mail si d'autres personnes se joignent à votre navette. Pour les trajets payés (s'il y en a), vous recevrez prochainement un mail avec les dernières informations concernant votre trajet (nom du conducteur, son numéro de portable). Vous pouvez également à tout moment retrouver ces informations sur <strong> <a href=\"http://alsace-navette.com/aeroport\"> Alsace-navette.com </a></strong> en vous connectant à l’aide de votre adresse e-mail et du mot de passe que vous avez reçu par courriel lors de votre première réservation. <br /><br /><br />Merci de votre confiance et à bientôt sur Alsace-Navette.com";

    $pour_payer = "Pour payer, cliquer ici :";

    $mode_de_paiement = "Modes de paiement";
    $erreur_paiement_ca = "Erreur lors du paiement | Alsace-navette.com";
    $ariane_erreur_paiement = "Erreur lors du paiement";
    $txt_erreur_ca_1 = "Erreur lors de la lecture des paramètres";
    $txt_erreur_ca_2 = "Erreur d'allocation de mémoire. Pas assez de mémoire disponible sur le serveur";
    $txt_erreur_ca_3 = "Erreur lors de la lecture des paramètres QUERY_STRING ou CONTENT_LENGTH";
    $txt_erreur_ca_4 = "PBX_RETOUR, PBX_ANNULE, PBX_REFUSE ou PBX_EFFECUTE sont trop longs";
    $txt_erreur_ca_5 = "Erreur d'ouverture de fichier (fichier local non trouvé ou erreur d'accès)";
    $txt_erreur_ca_6 = "Erreur de format de fichier (fichier local mal formé, vide ou ligne mal formatée)";
    $txt_erreur_ca_7 = "Il manque une variable obligatoire";
    $txt_erreur_ca_8 = "Une des variables numériques contient un caractère non numérique";
    $txt_erreur_ca_9 = "PBX_SITE contient un numéro de site qui ne contient pas exactement 7 caractères";
    $txt_erreur_ca_10 = "PBX_RANG contient un numéro de rang qui ne fait pas exactement 2 caractères";
    $txt_erreur_ca_11 = "PBX_TOTAL fait plus de 10 ou moins de 3 caractères numériques";
    $txt_erreur_ca_12 = "PBX_LANGUE ou PBX_DEVISE contient un code dont la longueur dépasse 250 caractères";
    $txt_erreur_ca_13 = "PBX_CMD est vide ou contient une référence dont la longueur dépasse 250 caractères";
    $txt_erreur_ca_16 = "PBX_PORTEUR ne contient pas une adresse courrier électronique valide";



    $intro_erreur_ca = "Une erreur est survenue lors de votre tentative de paiement";
    $fin_erreur_ca = "Merci de bien vouloir rééssayer.";

    $info_mode_paiement = "Les différents moyens de paiement mis à disposition sont parfaitement sécurisés.";

    $recherche_de_navette = "Demandes déjà enregistrées (à titre d'information)";
    $pas_de_navette = "Il n'y a pas encore de demande pour ce jour là vers votre destination !";

    $statut = "Statut";
    $en_attente_de_validation = "En attente de validation";
    $confirmee = "Confirmée";
    $en_attente_de_paiement = "En attente de paiement";

    $indicatif = "Indicatif";
    $expli_indicatif = "<a href=\"http://fr.wikipedia.org/wiki/Liste_des_indicatifs_t%C3%A9l%C3%A9phoniques_internationaux_par_pays\" target=\"_blank\">L'indicatif téléphonique international</a> de votre numéro de téléphone nous servira à vous envoyer par SMS les dernières informations concernant votre navette.<br />Le numéro ne devra <strong><u>PAS</u></strong> comporter cet indicatif.";

    $de = " de ";

    $btn_recherche = "Rechercher";

    $alt_sondage = "Sondage";

    $publie_le = "Publiée le ";

    $lire_suite = "Lire la suite";

    $lien_sondage = "Pour nous aider à améliorer nos services, nous avons mis en place un sondage, accessible <a href=\"http://alsace-navette.com/sondage/\">ici</a>.";

    $je_suis_pro = "Ayant un compte professionnel, je ne paie qu'à la fin du mois.";

    $lien = "Lien";

    $voir_le_detail = "Voir le détail";

    $fiche_partenaire = "Fiche client";

    $description = "Description";

    $dans = "Dans";

    $choix_categorie = "Trier sur la catégorie";

    $recapitulatif_pro = "Récapitulatif des trajets non payés";
    $titre_pro = "Paiement différé des navettes (professionnel)";

    $toutes_les_news = "Toutes les news";
	
	/*
		Ajout KEMPF : 
		Information nécessaire pour la traduction des factures
	*/
	
	$lang_facture = "Facture";
	$lang_fact_date = "Date";
	$lang_fact_objet = "Objet";
	$lang_fact_montant = "Montant";
	$lang_fact_transfert = "Transfert";
	$lang_fact_horaire_demande = "Horaires à la demande";
	$lang_fact_domicile = "Prise/Dépose à domicile";
	$lang_fact_res_der_min = "Demande dernière minute";
	$lang_fact_merci = "Merci de votre confiance !";
	$lang_fact_supplement = "Supplément";
	$lang_fact_attente = "Service attente aéroport";
	$lang_fact_erreur = "Une erreur s'est produite. Merci de réessayer ou de contacter nos services.";
	$lang_fact_personnes = "personnes";
	
	$lang_fact_tva = "TVA";
	$lang_fact_ttc = "TTC";
	$lang_fact_ht = "HT";
	$lang_fact_intracommunautaire = "intracommunautaire";
	
	// Info Barre
	$lang_info_barre = get_option("banderole_français");

	/*
		KEMPF : 
		Programme de fidelité
	*/
	$lang_texte_programme_fidelite = "Adhérez dès maintenant à notre programme de fidelité !
	<br />
	<br />
	Cumulez vos points de fidelité à chacune de vos réservation sur Alsace-Navette.com !
	<br />
	<br />
	Après un certain palier, vous aurez la possibilité de bénéficier d'une remise de <strong>".get_option("remise_fidelite")."%</strong> !
	<br />
	<br />
	N'attendez plus, et souscrivez à notre programme de fidelité :";
	
	$lang_conditions_fidelite = "<u>Conditions</u> :
	<br />
	Offre uniquement valable sur <a href='http://alsace-navette.com/aeroport/'>Alsace-navette.com/aeroport</a>.
	<br />
	Offre personnelle, non transmissible, non cumulable avec une autre offre.";
	
	$lang_jaccepte_conditions_fidelite = "J'accèpte les conditions du programme de fidelité.";
	$lang_souscrire = "Souscrire";
	$lang_adhesion_reussie = "Félicitation !";
	$lang_texte_adhesion_reussie = "Félicitation ! Vous pouvez désormais profiter pleinement de notre programme de fidelité.
	<br />
	<br />
	Votre solde de points de fidélité est visible dans le menu de votre compte, après vous être authentifié.
	<br />
	<br />
	Merci de votre confiance !";
	$lang_mes_point_fidelite = "Mes points fidelité";
	$lang_menu_fidelite_ = "Envie de gagner des remises sur vos trajets ?
	<br />
	<br />
	<strong>1 € = 1 point</strong>
	<br />
	<br />
	Alors participez à notre programme de fidelité sans plus tarder !
	<br />
	<br />
	<a href='http://alsace-navette.com/aeroport/client/fidelite.html'>Cliquez ici</a>";
	$lang_menu_fidelite = "Bientôt...<br /><br />Retrouvez ici votre futur programme de fidelité";
	
	$lang_texte_horaire_supp = get_option('alert_changement_horaire_fr');
	
	// KEMPF : Page Fiche Tarifs
	$lang_titre_fiche_tarif = "Fiche tarif";
	$tarif_base = "Tarif de base pour un trajet simple <span style='font-weight:bold;'>Strasbourg > Aéroport</span> ou <span style='font-weight:bold;'>Aéroport > Strasbourg</span>";
	$par_passager = "par passager et par trajet";
	$infos_pratiques = "Informations pratiques de l'aéroport";
	$options = "Options disponibles";
	$txt_prise_en_charge = "Prise en charge domicile<br> ou lieu de travail";
	$hors = "Hors";
	$txt_horaires_demande = "Horaires à la demande";
	$lien_horaires = "Voir les horaires fixes";
	$services = "Services";
	$txt_service_nuit = "Service trajets de nuit de 21h00 à 7h15";
	$txt_derniere_minute_72 = "Réservation dernière minute -72h avant le départ";
	$txt_derniere_minute_24 = "Réservation dernière minute -24h avant le départ";
	$txt_service_attente = "Service attente";
	$prix_aller_simple = "prix aller simple";
	$a_partir_de_strasbourg = "à partir de Strasbourg Gare";
	$infos_vols = "Informations sur les vols";
	$lang_titre_pt_rassemblement = "Lieux de rassemblement";
	$lang_titre_info_compl = "Informations complémentaires";
	$lang_points_rassemblement_fiche = "
	Les 3 points de rassemblement sur Strasbourg sont à votre disposition
	<br />
	(veuillez noter que la réservation est obligatoire) :
	
	<div style='text-align:left;'>
		<ul>
			<li>
				<a title='Lien vers la carte (GoogleMap)' target='blank_' href=\"http://maps.google.fr/maps?f=q&source=s_q&hl=fr&geocode=&q=Rue+Ren%C3%A9+Cassin+Strasbourg&sll=48.601928,7.745447&sspn=0.027471,0.077248&ie=UTF8&ll=48.59892,7.775552&spn=0.006528,0.019312&z=16\">Parking relais Palais des droits de l'homme</a> (En face sortie parking PDH)
				<br />
				Allée René Cassin
				<br />				
				67000 Strasbourg
				<br />
				<a title='GoogleMaps' target='blank_' href=\"http://maps.google.fr/maps?f=q&source=s_q&hl=fr&geocode=&q=Rue+Ren%C3%A9+Cassin+Strasbourg&sll=48.601928,7.745447&sspn=0.027471,0.077248&ie=UTF8&ll=48.59892,7.775552&spn=0.006528,0.019312&z=16\"><img alt='GoogleMaps' src=\"images/icones/maps-16.gif\" /></a>
				
				<a title='StreetView' target='blank_' href=\"http://maps.google.fr/maps?q=Rue+Ren%C3%A9+Cassin+Strasbourg&hl=fr&ie=UTF8&ll=48.597955,7.775767&spn=0.007209,0.021136&sll=48.601928,7.745447&sspn=0.027471,0.077248&hnear=All%C3%A9e+Ren%C3%A9+Cassin,+67000+Strasbourg,+Bas-Rhin,+Alsace&t=m&z=16&layer=c&cbll=48.597852,7.775859&panoid=KR880iZN-cQbfSed4aABdg&cbp=12,47.49,,0,1.64\"><img alt='StreetView' src=\"images/icones/street-16.png\" /></a>
				<br /><br />
			</li>
			<li>
				<a title='Lien vers la carte (GoogleMap)' target='blank_' href=\"https://www.google.com/maps/place/1+Rue+Fritz+Kieffer/@48.5956782,7.754104,17z/data=!3m1!4b1!4m2!3m1!1s0x4796c85c8c9bb95d:0xf3c3c4ec5e6a34fa\">Hôtel Hilton</a> (Arrêt bus en face hotel Hilton)
				<br />
				1 rue Fritz Kieffer
				<br />				
				67000 Strasbourg
				<br />
				<a title='GoogleMaps' target='blank_' href=\"https://www.google.com/maps/place/1+Rue+Fritz+Kieffer/@48.5956782,7.754104,17z/data=!3m1!4b1!4m2!3m1!1s0x4796c85c8c9bb95d:0xf3c3c4ec5e6a34fa\"><img alt='GoogleMaps' src=\"images/icones/maps-16.gif\" /></a>
				
				<a title='StreetView' target='blank_' href=\"https://www.google.fr/maps/@48.596481,7.755625,3a,75y,262.93h,89.44t/data=!3m4!1e1!3m2!1siQZFzFaPnvHqFkHeHlu_hA!2e0?hl=fr\"><img alt='StreetView' src=\"images/icones/street-16.png\" /></a>
				<br /><br />
			</li>
			<li>
				<a title='Lien vers la carte (GoogleMap)' target='blank_' href=\"http://maps.google.fr/maps?f=q&amp;hl=fr&amp;geocode=&amp;time=&amp;date=&amp;ttype=&amp;q=strasbourg+3+bld+Metz&amp;sll=48.582172,7.732444&amp;sspn=0.010164,0.020084&amp;ie=UTF8&amp;ll=48.583634,7.733924&amp;spn=0.010163,0.020084&amp;z=16&amp;iwloc=addr&amp;om=1\">Strasbourg Gare</a> (En face du \"Crédit Agricole\")
				<br />
				3 Boulevard de Metz
				<br />
				67000 Strasbourg
				<br />
				<a title='GoogleMaps' target='blank_' href=\"http://maps.google.fr/maps?f=q&amp;hl=fr&amp;geocode=&amp;time=&amp;date=&amp;ttype=&amp;q=strasbourg+3+bld+Metz&amp;sll=48.582172,7.732444&amp;sspn=0.010164,0.020084&amp;ie=UTF8&amp;ll=48.583634,7.733924&amp;spn=0.010163,0.020084&amp;z=16&amp;iwloc=addr&amp;om=1\"><img alt='GoogleMaps' src=\"images/icones/maps-16.gif\" /></a>
				
				<a title='StreetView' target='blank_' href=\"http://maps.google.fr/maps?q=strasbourg+3+bld+Metz&hl=fr&ll=48.583751,7.734101&spn=0.002051,0.005681&sll=48.582172,7.732444&sspn=0.010164,0.020084&om=1&hnear=3+Boulevard+de+Metz,+67000+Strasbourg,+Bas-Rhin,+Alsace&t=m&z=18&vpsrc=6&layer=c&cbll=48.583845,7.734205&panoid=h1VVhtB65gJO5DwwESR_-Q&cbp=12,320.18,,0,5.18\"><img alt='StreetView' src=\"images/icones/street-16.png\" /></a>
			</li>
		</ul>
	</div>";
	
	$lang_fiche_part_1 = "Si moins de ";
	$lang_fiche_part_2 = " personnes réservent";
	$domicile_obligatoire = "La prise ou dépôt à domicile est imposé";
	$lang_point_rass_aeroport = "Point de rassemblement à l'aeroport";
	
	$lang_fiche_a_partir_de = "à partir de";
	
	$lang_fiche_info_compl = "
	Réservation à <strong>moins de 24h</strong> : <strong>".get_option("maj_24")."€</strong> supplémentaires
	<br />
	Réservation à <strong>moins de 72h</strong> : <strong>".get_option("maj_72")."€</strong> supplémentaires
	<br />
	Prise ou dépôt <strong>à domicile</strong> : <strong>".get_option("maj_dom")."€</strong>
	<br />
	Trajet <strong>de nuit</strong> : <strong>".get_option("maj_horaire_nuit")."€</strong> supplémentaires (entre <strong>".str_replace(":", "h", get_option("horaire_nuit_debut"))."</strong> et <strong>".str_replace(":", "h", get_option("horaire_nuit_fin"))."</strong>)
	<br />
	Retard : 10€ / 30min ";
	
	/*
		KEMPF : Ajout du texte pour les horaires Ete - Hiver
	*/
	$lang_ete = "Eté";
	$lang_hiver = "Hiver";
	$lang_voir_duree_trajet = "Voir les durées des trajets";
	
	/*
		KEMPF : Page FAQ
	*/
	$lang_question = "Question";
	$lang_reponse = "Réponse";
	
?>