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

	// footer
	$mentions = "Legal notice";
	$cgv = "General terms of sale";
	$cgv_long = "General terms of sale";
	$charte = "Quality charter";
	$plan_du_site = "Site map";
	$contact = "Contact";
	$lien_qui_sommes_nous = "Who are we?";
	$lien_services = "Our services";
	$choix_navette	= "Shuttle choice";
	$tarif_navette  = "Shuttle prices";
	$info = "Personal information";
	$titre_trajet1 = "trips";
	$changer_pass = "Change password";
	$nouveau_pass = "Get a new password";
	$info_client = "Customer information";
	$presentation_tarifs = "Fares";
	$presentation_horaires = "Schedules";
	$presentation_pratique = "Practicals";
	$presentation_services = "Services & partners";
	$programme_fidelite = "Our fidelity program";
	$presentation_faq = "Frequently Asked Questions";
	$fin_paiement = "Thank you for choosing Alsace-Navette";

	// title de la page html
	$titre_page_accueil 		= "Welcome on Alsace-navette.com | Alsace-navette.com Strasbourg Shuttle airport : Bale-Mulhouse Francfort Karlsruhe Baden Stuttgart";
	$titre_page_livreor 		= "Guestbook | Alsace-navette.com Strasbourg Shuttle airport : Bale-Mulhouse Francfort Karlsruhe Baden Stuttgart";
	$titre_page_contact 		= "Contact form | Alsace-navette.com Strasbourg Shuttle airport : Bale-Mulhouse Francfort Karlsruhe Baden Stuttgart";
	$titre_page_res_recap 		= "Reservation : recap | Alsace-navette.com Strasbourg Shuttle airport : Bale-Mulhouse Francfort Karlsruhe Baden Stuttgart";
	$titre_page_client 			= "Customer space | Alsace-navette.com Strasbourg Shuttle airport : Bale-Mulhouse Francfort Karlsruhe Baden Stuttgart";
	$titre_page_changer_pass 	= $changer_pass . " | Alsace-navette.com Strasbourg Shuttle airport : Bale-Mulhouse Francfort Karlsruhe Baden Stuttgart";
	$titre_page_nouveau_pass 	= $nouveau_pass . " | Alsace-navette.com Strasbourg Shuttle airport : Bale-Mulhouse Francfort Karlsruhe Baden Stuttgart";
	$titre_info					= $info . " | Alsace-navette.com Strasbourg Shuttle airport : Bale-Mulhouse Francfort Karlsruhe Baden Stuttgart";
	$titre_page_trajet			= $titre_trajet1 . " | Alsace-navette.com Strasbourg Shuttle airport : Bale-Mulhouse Francfort Karlsruhe Baden Stuttgart";
	$titre_fin_paiement			= $fin_paiement . " | Alsace-navette.com Strasbourg Shuttle airport : Bale-Mulhouse Francfort Karlsruhe Baden Stuttgart";
	$titre_mention				= $mentions . ' | Alsace-navette.com Strasbourg Shuttle airport : Bale-Mulhouse Francfort Karlsruhe Baden Stuttgart';
	$titre_cgv					= $cgv . ' | Alsace-navette.com Strasbourg Shuttle airport : Bale-Mulhouse Francfort Karlsruhe Baden Stuttgart';
	$titre_plan					= $plan_du_site . ' | Alsace-navette.com Strasbourg Shuttle airport : Bale-Mulhouse Francfort Karlsruhe Baden Stuttgart';
	$titre_charte				= $charte . ' | Alsace-navette.com Strasbourg Shuttle airport : Bale-Mulhouse Francfort Karlsruhe Baden Stuttgart';
	$titre_choix_navette		= $choix_navette . ' | Alsace-navette.com Strasbourg Shuttle airport : Bale-Mulhouse Francfort Karlsruhe Baden Stuttgart';
	$titre_tarif_navette		= $tarif_navette . ' | Alsace-navette.com Strasbourg Shuttle airport : Bale-Mulhouse Francfort Karlsruhe Baden Stuttgart';
	$titre_info_client			= $info_client . ' | Alsace-navette.com Strasbourg Shuttle airport : Bale-Mulhouse Francfort Karlsruhe Baden Stuttgart';
	$titre_tarifs				= $presentation_tarifs . ' | Alsace-navette.com Strasbourg Shuttle airport : Bale-Mulhouse Francfort Karlsruhe Baden Stuttgart';
	$titre_horaires				= $presentation_horaires . ' | Alsace-navette.com Strasbourg Shuttle airport : Bale-Mulhouse Francfort Karlsruhe Baden Stuttgart';
	$titre_pratique				= $presentation_pratique . ' | Alsace-navette.com Strasbourg Shuttle airport : Bale-Mulhouse Francfort Karlsruhe Baden Stuttgart';
	$titre_services 			= $presentation_services . ' | Alsace-navette.com Strasbourg Shuttle airport : Bale-Mulhouse Francfort Karlsruhe Baden Stuttgart';
	$titre_fidelite				= "Our fidelity program | Alsace-navette.com Strasbourg Shuttle airport : Bale-Mulhouse Francfort Karlsruhe Baden Stuttgart";
	$titre_faq					= "Frequently Asked Questions | Alsace-navette.com Navette Strasbourg aéroport : Bale-Mulhouse Francfort Karlsruhe Baden Stuttgart";
	$titre_aide					= "Help | Alsace-navette.com Strasbourg Shuttle airport : Bale-Mulhouse Francfort Karlsruhe Baden Stuttgart";
	
	
	$changer_pass = "Get a new password";
	$nos_partenaires = "Partners";
	$nos_clients = "Thank you for choosing Alsace-Navette";
	
	$lang_se_connecter = "Log in";
	$fermer = "Close";
	
	// drapeaux
	$alt_drapeau = "English language";
	$alt_aide = "Help";
	$alt_paypal = "Make your payment via PayPal : a quick, free and secure way";
	$alt_print = "Print";
	$alt_texte = "Change text size";

	$aeroport_str = "Strasbourg Airport";
	$aeroport_baden = "Karlsruhe/Baden-Baden Airport";
	$aeroport_bale = "Basel-Mulhouse Airport";
	$aeroport_fkh = "Frankfurt-Hahn Airport";
	$aeroport_fkm = "Frankfurt Main Airport";
	$aeroport_zurich = "Zürich Airport";
	$aeroport_stuttgart = "Stuttgart Airport";
	$aeroport_entzheim = "Entzheim Airport (Strasbourg)";
	$aeroport_sarrebruck = "Sarrebruck Airport";
	$aeroport_bruxelles = "Brussels Airport";
	$aeroport_paris = "Paris Airport";
	$aeroport_luxembourg = "Luxembourg Airport";
	$aeroport_zweibrucken = "Zweibrucken Airport";
	$gare_sncf = "SNCF Train Station";
	
	// Liste des aéroports
	$lang_liste_aero = array(
		array(
			"TEXTE" => $aeroport_baden,
			"IMAGE" => "aeroport_baden.png",
			"LIEN" => "http://www.baden-airpark.de/startseite.html?&L=1"
			),
		array(
			"TEXTE" => $aeroport_bale,
			"IMAGE" => "aeroport_bale.png",
			"LIEN" => "http://www.euroairport.com/EN/accueil.php"
			),
		array(
			"TEXTE" => $aeroport_fkh,
			"IMAGE" => "aeroport_frankfort_hahn.png",
			"LIEN" => "http://www.hahn-airport.de/Default.aspx?menu=passengers_visitors&cc=en"
			),
		array(
			"TEXTE" => $aeroport_fkm,
			"IMAGE" => "aeroport_frankfort_main.png",
			"LIEN" => "http://www.frankfurt-airport.com/content/frankfurt_airport/en.html"
			),
		array(
			"TEXTE" => $aeroport_zurich,
			"IMAGE" => "aeroport_zurich.gif",
			"LIEN" => "http://www.zurich-airport.com/desktopdefault.aspx"
			),
		array(
			"TEXTE" => $aeroport_stuttgart,
			"IMAGE" => "aeroport_stuttgart.gif",
			"LIEN" => "http://www.stuttgart-airport.com/sys/index.php?section_id=0&id=0&lang=1"
			),
		array(
			"TEXTE" => $aeroport_entzheim,
			"IMAGE" => "aeroport_entzheim.gif",
			"LIEN" => "http://www.strasbourg.aeroport.fr/index.php/accueil?lang=E"
			),
		array(
			"TEXTE" => $aeroport_sarrebruck,
			"IMAGE" => "aeroport_saarebruck.png",
			"LIEN" => "http://www.flughafen-saarbruecken.de/index.php?id=1&L=1"
			),
		array(
			"TEXTE" => $aeroport_bruxelles,
			"IMAGE" => "aeroport_bruxelles.png",
			"LIEN" => "http://www.brusselsairport.be/en/"
			),
		array(
			"TEXTE" => $aeroport_paris,
			"IMAGE" => "aeroport_paris.png",
			"LIEN" => "http://www.aeroportsdeparis.fr/ADP/en-GB/Passagers/Home/"
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
			"LIEN" => "http://sncf.com/en_EN/flash/"
			)
		);
		
	// Liste des compagnies aériennes
	$lang_titre_compagnies = "Airlines";
	$lang_liste_compagnies = array(
		array(
			"TEXTE" => "RyanAir",
			"IMAGE" => "logo_ryanair.png",
			"LIEN" => "http://www.ryanair.com/en"
			),
		array(
			"TEXTE" => "Air Berlin",
			"IMAGE" => "logo_airberlin.jpg",
			"LIEN" => "http://www.airberlin.com"
			),
		array(
			"TEXTE" => "EasyJet",
			"IMAGE" => "logo_easyjet.png",
			"LIEN" => "http://www.easyjet.com/en"
			),
		array(
			"TEXTE" => "Swiss",
			"IMAGE" => "logo_swiss.gif",
			"LIEN" => "http://www.swiss.com/web/EN/Pages/index.aspx"
			),
		array(
			"TEXTE" => "Lufthansa",
			"IMAGE" => "logo_luftansa.gif",
			"LIEN" => "http://www.lufthansa.com/fr/en/Homepage"
			),
		array(
			"TEXTE" => "SunExpress",
			"IMAGE" => "logo_sunexpress.gif",
			"LIEN" => "http://www.sunexpress.com/"
			),
		array(
			"TEXTE" => "Austrian",
			"IMAGE" => "logo_austrian.gif",
			"LIEN" => "http://www.austrian.com/?sc_lang=en"
			),
		array(
			"TEXTE" => "Pegasus",
			"IMAGE" => "logo_pegasus.gif",
			"LIEN" => "http://www.flypgs.com/en/"
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
	
	$alt_reseau_aeroport = "Select the airport of your destination";
	$alt_tourisme = "Visit Alsace differently";
	$alt_office_tourisme = "Tourist information office of Strasbourg";
	$alt_sncf = "Train services";
	$alt_lvc = "Transport services on request, enjoy the drive";
	$alt_conseil = "Ask about your destination country";
	$alt_canal_asso = "Community life in Alsace";
	
	$lang_licence = "License";
	$lang_texte_licence = "License n°".get_option("num_licence")." for internal transport of passengers by road.";
	
	$deja_client_question = "Are you a customer?";
	
	$attention_der_min = "You have made a last-minute reservation, this request will be charged ";
    $attention_der_min_fin = " extra euros.";
	$txt_der_min = "If you have made a last-minute reservation, you will pay once your request has been manually processed. You will soon get a reply.";
	
	// fil d'ariane
	$ariane_debut   		= "You are here";
	$ariane_accueil 		= "Home";
	$ariane_reserver 		= "Reservation";
	$ariane_livreor 		= "Guestbook";
	$ariane_liste_livreor 	= "Message list";
	$ariane_reservation_1 	= "Trip information (step 1 / 5)";
	$ariane_reservation_2 	= "Recap (step 4 / 5)";
	$page_precedent 		= "Previous";
	$page_suivant 			= "Next";
	$ariane_contact 		= "Contact form";
	$ariane_client 			= "Customer";
	$ariane_authentification = "Log in";
	$ariane_pass 			= "Password";
	$ariane_changement_pass = "Change password";
	$ariane_new_password 	= "Lost password";
	$ariane_trajet			= "Trips";
	$ariane_visu_trajet		= "Trip overview";
	$ariane_reservation_navette = "Shuttle choice (step 3 / 5)";
	$ariane_info_perso 		= "Personal information";
	$ariane_modif_info_perso = "Change personal information";
	$ariane_fin_reservation	= "End of reservation (step 5 / 5)";
	$ariane_reservation_info_client = "Data capture (step 2 / 5)";
	
	
	// speedbar
	$speed_accueil  = "Home";
	$speed_tarif    = "Fares";
	$speed_contact  = "Contact us";
	$speed_livre_or = "Guestbook";
	$speed_service  = "Our services";
	$speed_reserver = "Booking";
	$speed_pratique = "Practicals";
	$speed_news = "News";
	$speed_horaire = "Schedule";
	$speed_aide = "FAQ";
	
	// Bandeau réservation simplifiée
	$aide_reservation = "Help with booking";
	$etape1 = "Fill in the form";
	$etape2 = "Choose an offer";
	$etape3 = "Pay online";
	$etape4 = "A confirmation is sent to you";
	
	// Liens page d'accueil
	$horaires_navettes = "Shuttles schedule";
	$horaires_vols = "Flights schedule";
	$infos = "Information about your ride";
	$points_prise = "Shuttles pick-up places";
	
	// Slider page d'accueil
	$en_savoir_plus = "Read more";
	$slide1 = "Airport services";
	$slide2 = "A wide schedule";
	$slide3 = "Affordable prices";
	
	// Services
	$text_pratique_titre_strasbourg = "Meeting points in Strasbourg";
	$text_pratique_titre_autre = "The meeting point in the other Airports";
	
	// Page d'aide
	$aide = "Help";
	$titre_etape_1 = "Fares request";
	$titre_etape_2 = "Fares offers";
	$titre_etape_3 = "Choice and booking";
	$titre_etape_4 = "Secured payment";
	$titre_etape_5 = "Confirmation by email";
	$titre_etape_6 = "Practicals";
	$titre_etape_7 = "Reminder the day before departure";
	$titre_etape_8 = "Go to the meeting point";
	$titre_etape_9 = "The trip begins";
	$titre_etape_10 = "Thank you and see you soon";
	$txt_etape_1 = "The given information stay confidential.";
	$txt_etape_2 = "All inclusive price. You pay what is displayed.";
	$txt_etape_3 = "Already more than 40,000 bookings since 2007.";
	$txt_etape_5 = "Your booking is successfully registered.";
	$txt_etape_6_1 = "Information about your driver";
	$txt_etape_6_2 = "Itinerary";
	$txt_etape_6_3 = "Trip duration";
	$txt_etape_7 = "You receive by email or sms the essential information about your ride.";
	$txt_etape_8 = "You don't need any ticket, your name is on our driver's list.";
	$etape_8_lien_rass = "View the meeting points";
	$etape_8_lien_rass_aeroport = "Airports";
	$txt_etape_9 = "The destination is close.";
	$txt_etape_10 = "Your driver drop you off at the destination as closely as possible to your plane.";
	$txt_bon_voyage = "Have a nice trip!";
	
	// Page infos pratiques
	$voir_plus = "View more";
	$infos_tarif = "Fares information";
	$option = "Option:";
	$txt_option_demande = "You can also choose the on-request-time-service when you are booking.";
	$pt_rass = "Meeting point";
	$txt_rass_bale = "From the French exit on the ground floor";
	$txt_rass_baden = "Exit 4 (in front of the B&B hotel)";
	$txt_rass_stuttgart = "Terminal 2 Departure Door 2-3";
	$txt_rass_francfort_main = "Terminal 1 Arrivals Door B-3";
	$txt_rass_zurich = "Terminal 2 Departure in front of <span style='font-style:italic;'>Prime Center 1</span>";
	$txt_google_map = "View on Google Map";
	$trajet_simple = "Single ride <span style='font-weight:bold;'>Strasbourg > Airport</span> or <span style='font-weight:bold;'>Airport > Strasbourg</span>";
	$points_rass_strasbourg = "Parking relay Human Rights Council - Hilton Hotel - Train station";
	$horaires_disponibles = "Available schedule";
	$pts_rass = "Meeting points";
	$txt_horaires_strasbourg = "Take into account the indicated schedule for each airport regarding Strasbourg's Train Station and add the corresponding duration.";
	$hotel_hilton = "Hilton Hotel";
	$palais_droits_hommes = "Human Rights Council";
	$txt_pts_rass_strasbourg = "All these meeting points in Strasbourg are at your disposal.<br>However, the booking remains obligatory.";
	$adresse_palais_droits_hommes = "<span style='font-weight:bold;'>Parking relay Boecklin Human Rights Council</span><br>(In front of the Human Rights Council parking exit)<br>Allée René Cassin<br />67000 Strasbourg";
	$adresse_hotel_hilton = "<span style='font-weight:bold;'>Hilton Hotel</span><br>(Bus stop in front of the Hilton Hotel)<br>1 rue Fritz Kieffer<br>67000 Strasbourg";
	$adresse_gare = "<span style='font-weight:bold;'>Strasbourg Train Station</span><br>(In front of \"Crédit Agricole\")<br>3 Boulevard de Metz<br>67000 Strasbourg";
	$txt_horaires_vols = "Please visit the";
	$site_aeroport = "airport website";
	
	// livre d'or
	$intro_livreor 		= "Satisfied with our service? Leave a comment !";
	$pseudo_livreor 	= "Your name";
	$message_livreor 	= "Your comment";
	$txt_captcha 		= "Type the characters shown in the picture below<br> to confirm your comment. <br />The picture contains 5 characters.";
	$nouveau_captcha 	= "Change the picture";
	$txt_nb_message 	= "Number of messages";
	$livreor_par		= "By";
	$livreor_le	 		= "";
	$aucun_message 		= "There's no comment !";
	$valide_livreor 	= "Your comment has been added";
	
	
	// erreur spry
	$spry_valeur_requise = "Required value";
	$spry_format = "Format error";
	$spry_correspondance = "Non-matching values";
	
	$btn_continuer = "Continue";
	$erreur_flash = "The content of this page requires a most recent version of Adobe Flash Player";
	$visiter_alsace = "Visit Alsace";
	$navette_vol = "Flight shuttles";
	$choix_aeroport = "Airport Choice";
	$a_dest_de = "To";
	$en_prov_de = "From";
	$meilleurs_prix = "Best fares from Strasbourg";
	$photos = "Photos";
	
	$hover_aide_fixe = "Most requested departure time.";
	$hover_aide = "Time of depart on request (an extra of ".get_option("maj_surcout_demande")." €)";	
	// KEMPF: Amélioration de l'aide concernant les horaires fixes et à la demande
	$hover_aide_fixe = "These schedules match with some flights in the airport. (Departure or Arrival).
	<br /><br />
	Chances are that you will have to share the same shuttle with other customers.";
	$hover_aide = "These schedules on request gives you more flexibility in your request.
	<br /><br />
	However, you will be charged an extra ".get_option("maj_surcout_demande")." € fee.";
	
	$explication_forfait_minimum = "The minimum package is the price at which the shuttle is certain to leave";
	$remboursement_forfait = "If more customers join the shuttle, you will be repaid.";
	$label_chk_forfait_mini = "I agree to pay the minimum package";
	
	$cout_du_trajet = "Cost of the trip";
	
	$explication_nouveau_mot_de_passe = "Do you want to change your password?<br> Fill in the current password and then type the second one.";
	$explication_mot_de_passe_perdu = "Lost your password?<br> Don't panic! Fill in your email address and we will email you a new password.";
	$explication_connexion = "Have you already made a reservation on our website?<br>If so, you can go on your reservations browser history, your personal information...";
	$explication_donnees_perso = "Here you can change personal information.";
	$explication_trajet = "Here you can see your trips history browser.";
	
    $duree = "Estimated trip duration:";
    $duree_s = "Estimated trips duration";
    $aeroport = "Airport";
    $aeroports = "Airports";
	$horaire = "Schedule";
	$dep_str = " Departs from Strasbourg Train Station";
	$dep_str_gare	= "Departs from Strasbourg train station";
	$dep_aeroport = "Departs from the airport";
	$expli_duree_rass = "Hilton Hotel : + 10 min<br />Human Right Building : + 15 min";
	
	// page de contact
	$txt_contact 		= "Before contacting us, please make sure you <span style='font-weight:bold;'>do not</span> fall into one of the following categories:";
	$txt_raison_1 		= "To leave a comment on our service, please use our <a href=\"livreor.php\">guestbook</a>.";
	$txt_raison_2 		= "All bookings have to be done via the <a href='index.php'>booking form</a>.";
	$txt_raison_3		= "The fares are available at the second step of the <a href='index.php'>booking form</a> or on the <a href='tarifs-baden-karlsruhe-sttutgart-frankfurt-basel-mulhouse-entzheim.php'>fares page</a>.";
	$txt_raison_4		= "Yet if difficulties occurred, please contact us via the means below";
	$txt_moyen_courrier = "Espace Alsace-Navette<br>2, Rue du Coq<br>67000 Strasbourg - Petite France neighbourhood</span>";
	$txt_moyen_tel 		= "By phone, from 9am to 12am and from 2pm to 5pm<br><span style='font-weight:bold;'>03 88 22 22 71</span>";
	$txt_moyen_port 	= "In case of emergency<br><span style='font-weight:bold;'>06 27 18 12 52</span>";
	$txt_moyen_mail 	= "By email : <span style='font-weight:bold;'><a href=\"mailto:info@alsace-navette.com\">info@alsace-navette.com</a></span>";
	$txt_moyen_form 	= "Via the form below";
	$moyen_contact 		= "If you experience difficulties to book, do not hesitate to contact us.";
	$raison_contact 	= "Reason";
	$raison_contact_0 	= "Information";
	$raison_contact_1 	= "Technical problem";
	$raison_contact_2 	= "Partnership";
	$contact_ok 		= "Your message has been sent";
	$contact_erreur 	= "Error occurred while sending message";
	
	// menu de droite
	$titre_tourisme   = "Tourism with Alsace-navette";
	$contenu_tourisme = "Enjoy the drive, take organized tours and visit Alsace";

	
	$deja_client    = "If you are <strong>already</strong> a client, <a href=\"client/client.php\">click here</a>";
	$alt_calendrier = "Calendar";
	$obligatoire    = "Required fields";
	$obligatoire_2  = "At least one field is required";
	$btn_raz 		= "Delete";
	$btn_envoyer	= "Send";
	$mail_invalide 	= "Non valid email address";
	$selectionner_date_depart = "Outward";
	$selectionner_date_retour = "Inward";
	
	$erreur_champ_vide 	= "All fields required!";
	$erreur_code 		= "Wrong checkout code!";
	$txt_pas_ressource_aller  = "No available resources at the moment for this depart";
	$txt_pas_ressource_retour = "No available resources at the moment for this return";
	$txt_pas_ressource_a_r    = "No available resources for this roundtrip";
	$txt_pas_ressource_forfait = "Yet you can register in an existing shuttle, if available above.";
	
	$deconnexion 	= "Logout";
	$changer_pass 	= "Change password";
	$trajet			= "Trip history browser";
	$changer_info_perso = "Change personal information";
	$erreur_date	= "Return day must be at least one day after depart";
	$aller			= "Depart";
	$retour			= "Return";
	$mon_compte 	= "My account";
	$pas_de_trajet  = "There is no trip for you";
	$choix_navette	= "Shuttle choice";
	$tarif_navette  = "Shuttle prices";
	$txt_deja_client = "Considering your email address, you might have already made a reservation. To get back your information, please <a href=\"client/client.php\">log in here</a> with your email address and your password !";
	$sur_adresse_prise = "Your pick-up address cannot be located: ";
	$sur_adresse_depose = "Your drop-off address cannot be located: ";
	$sur_adresse = "My address is correct";

	// trajet
	$legend_trajet       = "Your trip";
	$trajet_type         = "Trip";
	$trajet_aller_simple = "Single";
	$trajet_aller_retour = "Roundtrip";
	$trajet_depart       = "Departure";
	$trajet_arrive       = "Destination";
	$date				 = "Date";
	$heure				 = "Time";
	$date_depart         = "Departure day";
	$date_retour         = "Return day";
	$heure_depart		 = "On request time";
	$heure_retour		 = "On request time";
	$passager_adulte	 = "Adults";
	$passager_enfant	 = "Children (< 10 years, child safety seat if necessary)";
	$legend_client	     = "Customer";
	$civilite			 = "Title";
	$nom_client		     = "Last name";
	$prenom_client	     = "First name";
	$tel_client			= "Phone number";
	$port_client		= "Cellphone number";
	$autres_infos		= "Other information";
	$eemail				= "Email";
	$verif_email		= "Email verification";
	$adresse_client		= "Address";
	$code_post_client 	= "Zip code";
	$ville_client		= "City";
	$pays_client		= "Country";
	$france 			= "France";
	$allemagne			= "Germany";
	$suisse				= "Switzerland";
	$luxembourg			= "Luxembourg";
	$belgique			= "Belgium";
	$info_vol			= "Flight information";
	$info_transport		= "Information about transport";
	$info_confirmation	= "Confirmation";
	$info_compl 		= "Specific requests";
	$pt_rassemblement_aller 	= "Pick-up / Drop-off<br />in Strasbourg (outward)";
	$pt_rassemblement_retour 	= "Pick-up / Drop-off<br />in Strasbourg (inward)";
	$pt_rassemblement			= "Pick-up / Drop-off<br>in Strasbourg";
	$txt_changer_info_perso = 'To change your personal information, please <a href="client/info.html">click here</a>';
	$depart_fixe 		= "Permanent schedule";
	$retour_fixe 		= "Permanent schedule";
	$nb_pers_forfait_mini = "Number of people on minimum package";
	$enfant_g0 = "-10 kg or -9 months";
	$enfant_g1 = "9 to 18 kg or -4 years";
	$enfant_g2 = "15 to 25 kg or -7 years";
	$enfant_g3 = "22 to 36 kg or -10 years";
	$provenance_vol = "From";
	$dest_vol = "To";
	$compagnie_vol = "Airline company";
	$heure_vol = "Flight time";
	$nombre_passager = "Passengers";
	$mon_trajet = "My trip";
	$title_reservation = "Booking form";
	$title_demande = "Fares and booking";
	$btn_afficher_tarifs = "Show the fares";
	$btn_reserver = "Proceed book";
	$btn_annuler = "Cancel";
	$btn_derniere_etape = "Confirm";
	$code_promo = "Promotional code";
	$horaire_choisi = "Chosen time";
	
	// réservation
	$recapitulatif 	= "Recap of your request";
	$titre_trajet 	= "Your trip";
	$titre_client	= "Personal information";
	$info_incorrect = 'If this information is wrong, please <a href="index.php">click here</a>';
	$btn_payer 		= "Pay";
	$remise_code_promo = "Discount";
	$navette_existant_aller = "Depart shuttles are already planned";
	$navette_existant_retour = "Return shuttles are already planned";
	$date_heure_navette 	= "Date and time of depart";
	$nb_personne_navette 	= "Number of people <br />already registered";
	$prix_navette 			= "Price";
	$tarif 					= "Fares";
	$tarif_s				= "Fare";
	$cout_trajet_base 		= "Base fare of the trip";
	$nb_passager 			= "Passengers";
	$prise_domicile			= "Pick-up at home";
	$depose_domicile		= "Drop-off at home";
	$res_der_minute_72		= "Last minute booking (-72 hours)";
	$res_der_minute_24		= "Last minute booking (-24 hours)";
	$prix_total				= "Total price";
	$personne				= "person";
	$forfait_mini			= "Minimum package";
	$fin_res				= 'You can get back your reservation details <a href="client/trajet.php">here</a> and also information about the driver, once chosen';
	$fin_res_accueil		= "Back Home";
	$navette_individuelle	= "Individual shuttle";
	$txt_oui				= "Yes";
	$txt_non				= "No";
	$joindre				= "Join";
	// KEMPF : Textes liés au remises
	$lang_remise			= "Discount";
	$lang_remise_8_pers		= "Discount for 8 people";
	$lang_horaires_de_nuit	= "Night hours";
	// KEMPF : Textes liés au service annulation
	$lang_annuler_le_trajet = "Cancel the shuttle";
	$lang_trajet_annule = "Shuttle canceled";
	$lang_annulation = "Serenity option (Cancelation)";
	$lang_option_annulation = "Sign up for the Serenity option (+ ".get_option("maj_annulation")." % of total price)";
	$lang_expli_option_annulation = "
		This option will cost <strong>".get_option("maj_annulation")."% of the total price</strong> of the service.
		<br /><br />
		It gives you the possibility to cancel your booking in any circumstances.
		<br /><br />
		You will be granted a refund if you cancel your trip. The amount of the refund varies according to circumstances :
		<br />
		<ul>
			<li>A <strong>100% refund</strong> will be granted if you cancel your reservation <strong>at least 7 days before the departure</strong></li>
			<li>A <strong>60% refund of the price</strong> will be granted if you cancel your reservation <strong>at least 12 hours before the departure</strong></li>
			<li>A <strong>20% refund of the price</strong> will be granted if you cancel your reservation <strong>less than 12 hours before the departure</strong></li>
		</ul>
		No refund will be done after the departure.
		<br /><br />
		<strong>Please notice</strong> : The price of the cancellation option is not included in the refund.";
	
	// KEMPF: Ajout de l'aide sur les points de rassemblement
	$lang_aide_pt_rassemblement = "
		These are the places where the shuttle will pick you up or drop you off in Strasbourg.
		<br /><br />
		You can choose a meeting point at home, which will cost ".get_option("maj_dom")." € more, or ".get_option("maj_dom_km")." € for each kilometer outside of Strasbourg.
		<strong>Look out :</strong>
		<br />
		<ul>
			<li>For the meeting point « Palais des droits de l'homme », please count <strong>10 minutes more</strong> on the time of pick-up / drop-off.</li>
			<li>For the meeting point « Hôtel Hilton », please count <strong>15 minutes more</strong> on the time of pick-up / drop-off.</li>
			<li>For the meeting point « At home », the estimated time differs depending <strong>on the chosen location.</strong></li>
		</ul>";
	
	// KEMPF: Ajout de l'aide sur les inforamtions de vol
	$lang_aide_vol = "
		These informations about your flight allow us to answer to your request much better.
		<br /><br />
		They also allow us to follow you in case of problem.";
	$lang_aide_enfants = 
		"This information lets us know how many child seats would be necessary for the trip.
		<br /> <br /> 
		The amount has no impact on the total cost.";
	
	/**
	 * Modif MARC
	 * 
	 * */			
	
	$titre_a_cocher_si_la_personne_est_autre = "If the passenger is not the person booking the shuttle.";
	$titre_autre_passager   = "( Passenger Information )";
	$nom_autre_passager     = "Last Name";
	$indicatif_tel_autre_passager    = "Phone code";
	$tel_port_autre_passager     = "Mobile number";
	
	
	// page client
	$deja_client_txt 	= "Are you already a customer ?";
	$email 				= "Email address";
	$passwd 			= "Password";
	$mdp_oublie 		= "Forgot your password?";
	$erreur_client_login = "Provided email address / password don't exist!<br /><a href=\"client/password-a2.html\">Lost password?</a>";
	$erreur_client_inexistant = "No customer registred with the provided address";
	$valide_new_pass 	= "A new password has been sent to the provided email address";
	$object_new_pass 	= "Alsace-navette.com : New password";
	$erreur_envoie_mail = "Error occurred while sending new password. It has not been changed!";
	$debut_mail_pass 	= "Hello,<br /><br />You asked for a new password. Here it is: <strong>";
	$fin_mail_pass 		= "</strong><br /><br />See you soon on Alsace-navette.com";
	$ancien_mdp 		= "Current password";
	$new_pass 			= "New password";
	$new_pass_confirm 	= "Confirm";
	$erreur_pass_correspondance = "Password has not beeen confirmed !";
	$valide_new_passwd 	= "Your password has been changed.";
	$debut_mail_passwd 	= "Hello,<br /><br />You have changed your password. Here it is: <strong>";
	$erreur_ancien_pass = "Your previous password does not match!";
	$valide_new_info 	= "Your personal information have been registred";
	$expli_email = "It is not possible to change your e-mail address in your personal space. 
		<br/>
		If you want to change your e-mail address, you need to create another account.";
	

	
	// page des trajets
	$trajet_du = "Trip of ";
	$table_mois = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
	$table_jour = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
	$info_pratique = "Practical information";
	$chauffeur_nom = "Driver's last name";
	$chauffeur_prenom = "Driver's first name";
	$chauffeur_mail = "Driver's email address";
	$chauffeur_port = "Driver's phone number";
	$status_valide = "Confirmed by our services";
	$status_invalide = "The driver isn't already choosen";
    $statut_attente = "Confirmation pending";
	
	$par_personne = "Per person";
	$aucune_navette = "No shuttle has been planned yet for this destination and for this day, but minimum package is possible";
	$navette_disponible = "Shuttles already planned : you can take a planned shuttle, or ask for a new one and then pay the minimum package ! For more information, please go on <a href='tarifs-baden-karlsruhe-sttutgart-frankfurt-basel-mulhouse-entzheim.php'>fares page</a>";
	$facture = "Invoice";
	$creer_facture = "Create a custom invoice";
	$changer_adresse = "Change the billing address";
	$modifier = "Edit the invoice";
	$voir = "See your invoice";
	$civilite = "Civility";
	$nom = "Name";
	$prenom = "First name";
	$adresse_postale = "Mailing address";
	$ville = "City";
	$code_postal = "Postcode";
	$pays = "Country";
	
	$text_cgv_1 = get_cgv("condition_1_en").
				get_cgv("condition_2_en").
				get_cgv("condition_3_en").
				get_cgv("condition_4_en").
				get_cgv("condition_5_en");
	$text_cgv_2 = get_cgv("condition_6_en").
				get_cgv("condition_7_en").
				get_cgv("condition_8_en").
				get_cgv("condition_9_en").
				get_cgv("condition_10_en");
		
	
	$text_mention = "<strong>- This website is the property of the Franco-Iranian association of Alsace.</strong>
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
        
        License number for passengers transport:
        <br />
        License n°".get_option("num_licence")."
        <br /><br />
        
        Website's name: <a href=\"http://www.alsace-navette.com\">www.alsace-navette.com</a>
        <br />
        <br />
        <strong>- Website hosted by:</strong>
        <br />
        <br />
        1and1 Internet LLC
        <br />
        7, place de la Gare
        <br />
        57200 Sarreguemines
        <br />
        Tel: 0825 080 020
        <br />
        Email: <a href=\"mailto:support@1and1.fr\">support@1and1.fr</a>
        <br />
        
        <br />
        <strong>- Right to access data:</strong>
        <br />
        <br />
		
		You have the right to access, modify and delete your personal data by sending an <a href=\"mailto:info@alsace-navette.com\">email</a>.<br>You will receive a reply within a month.
                
        <br />
        <br />
        In case of emergency, please call + 33 6 27 18 12 52.";
	
	// Ajout Plan du site (KEMPF)
	$text_plan_site ='
		<a href="../index.php" title="Portal">Portal</a>
		
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
			<li><a href="../sondage/index.php?lang=en" title="Survey">Survey</a></li>
			<li><a href="mentions.php" title="'.$mentions.'">'.$mentions.'</a></li>
			<li><a href="cgv.php" title="'.$cgv.'">'.$cgv.'</a></li>
			<li><a href="charte.php" title="'.$charte.'">'.$charte.'</a></li>
			<li><a href="plan_site.php" title="'.$plan_du_site.'">'.$plan_du_site.'</a></li>
		</ul>	
	';
		
	
	$text_charte = "We intend to provide you a service of quality by submitting to strict rules provided in our quality charter. These rules are specific to our organization and show to our customers the attention paid to their comfort.
		
       <br /><br />
       <strong>Charter 1 : Security
       <br /><br />
       Charte 2 : Minimize the waiting time :</strong>
       <br /><br />
       - We report you any delay by text.
       <br /><br />
       - The waiting time does not exceed 15 minutes.
       <br /><br />
       
       <strong>
       Charter 3 : Ease of access to services
       <br /><br />
       Charter 4 : Comfort of passengers
       <br /><br />
       Charter 5 : Order follow-up
       <br /><br />
       Charter 6 : Availibility of our company
       <br /><br />
       Charter 7 : Listening to the needs of our customers
       <br /><br />
       Charter 8 : Employee training
       <br /><br />
       Charter 9 : The best value for money
       <br /><br />
       Charter 10 : Demand of solidarity economy
       <br /><br />
       Charter 11 : Respect for the environment
       <br /><br />
       Charter 12 : Local service
       <br /><br />
       Alsace Navette contributes to a <a href=\"http://www.solidaire.alsace-navette.com\">project of social economy</a>.
		</strong>";
	
	/* Ajout KEMPF : Page service */
	$text_services = "<p><strong>Alsace Airport Shuttle</strong> offers low cost service 24/24h 7/7d to the airports of Karlsruhe-Baden, Stuttgart, Frankfurt Main, Hahn, Brussels, Saarbrücken, Basel, Zurich and Strasbourg.
	<br /><br />
	The success of Alsace Navette is guaranteed due to the quality and reliability of our service which successfully made Alsace Airport Shuttle the leading Alsatian private provider of airport shuttles since 2007. <strong>Give it a try!</strong>
	<br /><br />
	Alsace-navette.com/aeroport +33388222271
	<br />
	<br />
	Our spacious and comfortable vehicles are equipped with 8 seats, air-conditioning and GPS.
	<br />
	<br />
	We ensure a safe travel to the main airports of the region.</p>";
	
	/* Modification par KEMPF : Séparation en 2 de la page pour ajouter les ancres */
	$text_pratique_stras = "
	The three meeting points in Strasbourg are at your disposal (please note that reservations are compulsory)
		
	<div>
		<ul>
			<li>
				<a title='Link to the map (GoogleMap)' target='blank_' href=\"http://maps.google.fr/maps?f=q&source=s_q&hl=fr&geocode=&q=Rue+Ren%C3%A9+Cassin+Strasbourg&sll=48.601928,7.745447&sspn=0.027471,0.077248&ie=UTF8&ll=48.59892,7.775552&spn=0.006528,0.019312&z=16\">Parking relay Human Rights Council</a> (In front of HRC exit parking)
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
				<a title='Link to the map (GoogleMap)' target='blank_' href=\"https://www.google.com/maps/place/1+Rue+Fritz+Kieffer/@48.5956782,7.754104,17z/data=!3m1!4b1!4m2!3m1!1s0x4796c85c8c9bb95d:0xf3c3c4ec5e6a34fa\">Hôtel Hilton</a> (Bus stop in front of Hilton Hotel)
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
				<a title='Link to the map (GoogleMap)' target='blank_' href=\"http://maps.google.fr/maps?f=q&amp;hl=fr&amp;geocode=&amp;time=&amp;date=&amp;ttype=&amp;q=strasbourg+3+bld+Metz&amp;sll=48.582172,7.732444&amp;sspn=0.010164,0.020084&amp;ie=UTF8&amp;ll=48.583634,7.733924&amp;spn=0.010163,0.020084&amp;z=16&amp;iwloc=addr&amp;om=1\">Strasbourg Gare</a> (In front of \"Crédit Agricole\" bank)
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
	
	We may also pick you up at your home or office. This request is charged : 
	<br />
	- In Strasbourg : ".get_option("maj_dom")." €
	<br />
	- Out of Strasbourg : ask for an estimate (invoicing ".get_option("maj_dom_km")." € per km from Strasbourg station)";
	
	$text_pratique_autre = "
	<div class=\"centre\">
		<p>
			<span style='font-weight:bold;font-size:1.2em;'>Basel-Mulhouse Airport</span>
			<br />
			<br />
			<strong>From the French exit on the ground floor</strong>
			<br />
			<img src=\"images/sortie_bale.jpg\" alt=\"Basel Mulhouse Airport\" title=\"Basel Mulhouse Airport, by the French exit on the ground floor.\" />&nbsp;
			<a href=\"http://www.euroairport.com/FR/voyageurs.php?PAGEID=64&lang=FR\" target=_blank><img src=\"images/plan_bale.jpg\" alt=\"plan aéroport Bâle/Mulhouse\" title=\"Plan Aéroport Bâle/Mulhouse\"/></a>
			<br /><br />
			<a href='http://maps.google.fr/maps?q=47.599325,7.532699&hl=fr&num=1&t=h&z=18' target='blank_'><img alt='GoogleMaps' src=\"images/icones/maps-16.gif\" /> GoogleMap</a>
		</p>
	</div>
	
	<br />
	
	<br />
	
	<div class=\"centre\">
		<p>
			<span style='font-weight:bold;font-size:1.2em;'>Karlsruhe / Baden-Baden Airport</span>
			<br />
			<br />
			<strong>Exit 4</strong>
			<br />
			<img src=\"images/sortie_baden.jpg\" alt=\"Baden Baden Airport Exit4\" title=\"Baden Baden Airport Exit 4\"  />&nbsp;
			<a href=\"images/plan_baden_big.png\" target=_blank><img src=\"images/plan_baden.jpg\" alt=\"plan aéroport Karlsruhe / Baden-Baden\" title=\"Plan Aéroport Karlsruhe / Baden-Baden\"/></a>
			<br /><br />
			<a href='http://maps.google.fr/maps?q=48.778475,8.087358&hl=fr&num=1&t=h&z=18' target='blank_'><img alt='GoogleMaps' src=\"images/icones/maps-16.gif\" /> GoogleMap</a>
		</p>	
	</div>
	
	<br />
	<br />
	
	<div class=\"centre\">
		<p>
			<span style='font-weight:bold;font-size:1.2em;'>Frankfurt Main Airport</span>
			<br />
			<br />
			<strong>Terminal 1 Arrivals Door B-3</strong>
			<br />
			<img src=\"images/sortie_fm.jpg\" alt=\"sortie aéroport Frankfurt Main\" title=\"Frankfurt Main Airport Terminal 1 Arrivals Door B-3\"  />&nbsp;
			<a href=\"http://www.frankfurt-airport.com/content/frankfurt_airport/en/directions_parking/airport_maps1/terminal_1_2.html\" target=_blank><img src=\"images/plan_fm.jpg\" alt=\"plan aéroport Frankfurt Main\" title=\"Plan Aéroport Frankfurt Main\"/></a>
		</p>
	</div>
	
	<br />
	<br />
	
	<div class=\"centre\">
		<p>
			<span style='font-weight:bold;font-size:1.2em;'>Stuttgart Airport</span>
			<br />
			<br />
			<strong>Terminal 2 Departure Door 2-3</strong>
			<br />
			<img src=\"images/sortie_stuttgart.jpg\" alt=\"sortie aéroport Stuttgart\" title=\"Stuttgart Airport Terminal 2 Departure Door 2-3\"  />&nbsp;
			<a href=\"http://www.stuttgart-airport.com/sys/index.php?section_id=4&id=8&lang=1\" target=_blank><img src=\"images/plan_stutt.jpg\" alt=\"plan aéroport Stuttgart\" title=\"Plan Aéroport Stuttgart\"/></a>
			<br /><br />
			<a href='http://maps.google.fr/maps?q=48.690535,9.192787&hl=fr&ll=48.690465,9.191962&spn=0.004349,0.011362&num=1&t=h&z=17' target='blank_'><img alt='GoogleMaps' src=\"images/icones/maps-16.gif\" /> GoogleMap</a>
		</p>
	</div>
	
	<br />
	<br />
	
	<div class=\"centre\">
		<p>
			<span style='font-weight:bold;font-size:1.2em;'>Zurich Airport</span>
			<br />
			<br />
			<strong>Terminal 2 Departure in front of <i>Prime Center 1</i></strong>
			<br />
			<img src=\"images/sortie_zurich.jpg\" alt=\"sortie aéroport Zurich\" title=\"Aéroport Zurich Terminal 2 Departure in front of Prime Center 1\"  />&nbsp;
			<a href=\"http://www.aeroport-de-zurich.com/desktopdefault.aspx/tabid-316/\" target=_blank><img src=\"images/plan_zurich.jpg\" alt=\"plan aéroport Zurich\" title=\"Plan Aéroport Zurich\"/></a>
			<br /><br />
			<a href='http://maps.google.fr/maps?q=48.778475,8.087358&hl=fr&num=1&t=h&z=18' target='blank_'><img alt='GoogleMaps' src=\"images/icones/maps-16.gif\" /> GoogleMap</a>
		</p>
	</div>
	
	<p>
	<br />
	
	Only booked passengers have their trip ensured. Thus the shuttle does not serve all the stops.
	
	<br />
	<br />

	In case of emergency, please call +33 6 27 18 12 52.
	</p>";


	$text_tarifs = "
		<strong>Further information :</strong>
		<br /><br />
	<ul>
		<li>Strabourg - Karlsruhe / Baden-Baden shuttles are carried out from ".get_nb_personne_forfait(2)." people or a minimum package</li>
		<li>Strasbourg - Basel Mulhouse shuttles are carried out from ".get_nb_personne_forfait(1)." people or a minimum package</li>
		<li>Strasbourg - Stuttgart and Strasbourg - Zürich shuttles are carried out from ".get_nb_personne_forfait(3)." people or a minimum package</li>
		<li>Strasbourg - Frankfurt Hahn, Strasbourg - Main Frankfurt shuttles are carried out from ".get_nb_personne_forfait(4)." people ou a minimum package</li>
		<li>No extra charges are added for your luggage. Yet pessengers are limited to one bag and one handbag</li>
		<li>You can be picked up at your home or office. This request is charged :
			<ul>
				<li>in Strasbourg : ".get_option("maj_dom")." €</li>
				<li>out of Strasbourg : ask for an estimate (invoicing ".get_option("maj_dom_km")." € / km from Strasbourg Station)</li>
			</ul>
		</li>
		<li>An additional cost of ".get_option("maj_horaire_nuit")." € is applied for night shuttle between ".get_option("horaire_nuit_debut")." PM and ".get_option("horaire_nuit_fin")." AM</li>
		<li>There is a discount for the booking with 8 people</li>
		<li>Please note that the home or office charge is included in the fare for Entzheim shuttles.</li>
		<li>A 5 euro fee is charged per animal</li>
		<li>You may book a minibus with driver on request. The package amounts to € 40 per hour or a rental for 40 kms. Every additional km will be charged €1.</li>
	</ul>
	<br />
	";
	
	
	$erreur_400 = "HTTP Failure Analysis!";
	$erreur_401 = "Login / Password Error!";
	$erreur_403 = "Prohibited request!";
	$erreur_404 = "The requested page does not exist!";
	$erreur_405 = "This request method is unauthorized!";
	
	$erreur_500 = "Internal Server Error!";
	$erreur_501 = "Unsupported functionality!";
	$erreur_502 = "Bad reply sent to an intermediate server by another server!";
	$erreur_503 = "Service Unavailable!";
	$erreur_504 = "Waiting time expired!";
	$erreur_505 = "HTTP version not managed by the server!";
	
	$erreur_sql = "A SQL Server Error occurred!";
	
	$erreur_defaut = "An unkown error occurred!";
	
	$page_erreur = "An error occurred";
	
	$revenir = "Previous Page";
	
	$erreur = "Error";
	
	
	
	// pour mail paypal
	
	$sujet_nouveau_client = "Welcome on Alsace-navette.com | Your username";
	$debut_nouveau_client = "Hello, you  have made a reservation on Alsace-navette.com !<br /><br />You are now a customer. Thus you have the right to access to personlized information on our website.<br /><br />To access to it, you need you email address : <strong>";
	$milieu_nouveau_client = "</strong> and the following password : <strong>";
	$fin_nouveau_client = "</strong><br /><br />Password can be changed on the website.<br /><br />To login, please go on <a href=\"http://alsace-navette.com/aeroport/client/client.html\">on the logon page</a>.<br /><br />Thank you for choosing Alsace-Navette.";
		
		
	$ajax_expli = "These shuttles are permanent.";
	$ajax_depart = "Depart at";
	
	
	$bonjour = "Dear";
	$demande_traite = "Your request is made for the following trip(s): ";
	$fin_demande = "You will soon get an email with the last information about your trip(driver's name and his phone number). You can find these information on<strong> <a href=\"http://alsace-navette.com/aeroport\"> Alsace-navette.com </a></strong>. You can log in with your email address and password provided by email at your first reservation.<br /><br /><br />Thank you for choosing Alsace-Navette and see you soon on Alsace-Navette.com";
	$fin_demande_der_min = "You made a last minute reservation, thus you have not paid yet. Once your request has been successfully processed, you will receive a payment advice that will confirm your reservation. <br /><br />You may also find these information on <strong><a href=\"http://alsace-navette.com/aeroport\"> Alsace-navette.com</a></strong> by signing in with your e-mail address and password. <br /><br /><br />Thank you for choosing Alsace Navette";
	
	$titre_recap_mail_client = "Your request recap";
	$meteo = "Weather";
	
	$surcout_demande = "Shuttle on request";
	
	$expli_attendre = "If you prefer to wait for other customers to join the shuttle, you will not pay immediately, but once you have confirmed the shuttle.<br /><br /><strong>It doesn't engage you in any way: you have no obligation to pay.</strong>";
	$label_attendre = "I'll wait for other customers join this shuttle";
	$mail_attendre = "<br />You decided to wait for other customers to join your shuttle. When they will, we will be inform you by email.<br /><br /><strong>This request doesn't engage you in any way: you have no obligation to pay.</strong>";
	$jai_attendu = "You decided to wait for other customers to join the shuttle. You do not pay immediately but once you have confirmed this shuttle.";
	
	$choix = "Choice ";
	$deselectionner = "Deselect";
	$plan = "See map";
	
	$accept_cgv = " I acknowledge that I have read, understood and agreed to <a href=\"cgv.php\" target=\"_blank\">the Terms and Conditions of sale</a>";
	$erreur_accept_cgv = "You have to agree to the <a href=\"cgv.php\" target=\"_blank\">general terms of sale</a> !";
	
	
	$accept_forfait_mini_aller = "I agree to pay the minimum package for <u>the outward trip</u>";
	$accept_forfait_mini_retour = "I agree to pay the minimum package for <u>the return</u>";
	$accept_forfait_mini_aller_retour = "I agree to pay the minimum package for <u>a roundtrip</u>";
	
	$label_attendre_aller = "I decided to wait for other customers to join the shuttle for <u>the outward trip</u>";
	$label_attendre_retour = "I decided to wait for other customers to join the shuttle for <u>the return</u>";
	
	$prix_a_payer = "The price you pay now";
	
	$jai_attendu_aller = "You decided to wait for other customers to join your shuttle for the <u>outward trip</u>. You don't pay immediately but once you have confirmed this shuttle. Now you just pay the return trip.";
	$jai_attendu_retour = "You decided to wait for other custumers to join the shuttle for <u>the return</u>. You don't pay immediately baut once you have confirmed this shuttle. Now you just pay the depart trip.";


	$client_existe_pas = "This customer does not exist!";
	$code_incorect = "Verification code is incorrect!";
	$res_pas_trouve = "No corresponding reservation!";
	$res_pas_au_client = "This reservation does not correspond to this customer!";
	$trajet_introuvable = "Unobtainable trip!";
	$ligne_introuvable_aller = "Unobtainable reservation service for outward!";
	$ligne_corr_trajet = "Reservation service does not correspond to the trip!";
	$ligne_retour_payer = "This trip (return) has already been paid!";
	$ligne_aller_payer = "This outward trip has already been paid!";
	
	$ariane_paiement_manuel = "Paiement différé d'une réservation";
	$ariane_paiement_manuel_titre = $ariane_paiement_manuel . ' | Alsace-navette.com';
	
	$confirmation_resa = "To send us your request, please click on the button below";
		
	$expli_hor_fixe = "There are regular shuttles for the airports below : ";
	//$expli_hor_demande = "There are free schedules for Bruxelles, Sarrebruck, Strasbourg-Entzheim, Paris, Stuttgart, Frankfurt, Hahn and Zurich airports.<br />For Karlsruhe-Baden and Basel-Mulhouse airports shuttles times on request are also offered for an extra charge of ";
	$expli_hor_demande = "You can choose between permanent schedules or schedules on request";
	$expli_hor_demande_2 = "You can choose schedules on request for every airports.";
	$explication_entzheim = "For the Entzheim airport (Strasbourg), there is no permanent schedules, only schedules on request. There is NO additional cost for these schedules on request.";
	$explication_autre_aeroport = "For this airport, there is no permanent schedules, only schedules on request.";
	
	$mail_derniere_minute = "(Last minute)";

	$label_nouvelle_navette = "I want a new shuttle";
	$label_nouvelle_navette_aller_retour = "I want a new shuttle for <u>a roundtri</u>";
    $label_nouvelle_navette_aller = "I want a new shuttle for <u>the depart</u>";
    $label_nouvelle_navette_retour = "I want a new shuttle for <u>the return</u>";

    $warning_tel = "Please provide a valid phone number. Otherwise you cannot be notified in case of last minute change.";


    $est_paye = "Paid";
    $non_paye = "Non paid";
    $sous_total = "Subtotal";


    $fin_demande2 = "For shuttles where you decided to wait, we will inform you by email if other customers join in. For other paid trips (if any), you will soon get an email with the last information about the journey (driver’s name and his phone number). You may also see this information on <strong> <a href=\"http://alsace-navette.com/aeroport\"> Alsace-navette.com</a></strong> You can log in with your email address and password provided by email at your first reservation. <br /><br /><br />Thank you for choosing Alsace-Navette and see you soon on Alsace-Navette.com";

    $pour_payer = "To pay, click here:";

    $mode_de_paiement = "Payment methods";
    $erreur_paiement_ca = "Error while payment | Alsace-navette.com";
    $ariane_erreur_paiement = "Error while payment";
    $txt_erreur_ca_1 = "Error while reading parameters";
    $txt_erreur_ca_2 = "Memory Allocation Error. Not enough available memory in the server";
    $txt_erreur_ca_3 = "Error while reading the parameters QUERY_STRING or CONTENT_LENGTH";
    $txt_erreur_ca_4 = "PBX_RETOUR, PBX_ANNULE, PBX_REFUSE or PBX_EFFECUTE are too long";
    $txt_erreur_ca_5 = "Error opening file (local file not found or access error)";
    $txt_erreur_ca_6 = "Error File Format (local ill-format file, empty or ill-formated line)";
    $txt_erreur_ca_7 = "Variable binding is missing";
    $txt_erreur_ca_8 = "One of the digital variables contains a non digital character";
    $txt_erreur_ca_9 = "PBX_SITE contains a non 7 character website number";
    $txt_erreur_ca_10 = "PBX_RANG contains a number of ranking whiwh is not exactly 2 characters";
    $txt_erreur_ca_11 = "PBX_TOTAL is more than 10 or less than 3 digital characters";
    $txt_erreur_ca_12 = "PBX_LANGUE or PBX_DEVISE contains a code that is more than 250 characters";
    $txt_erreur_ca_13 = "PBX_CMD is empty or contains reference of 250 or more characters";
    $txt_erreur_ca_16 = "PBX_PORTEUR does not contain a valid email address";



    $intro_erreur_ca = "Error occurred while your payment attempt";
    $fin_erreur_ca = "Please try again.";

    $info_mode_paiement = "All available payment methods are safe.";

    $recherche_de_navette = "Request already registered (for your information)";
    $pas_de_navette = "No request for this shuttle at the moment !";

    $statut = "Status";
    $en_attente_de_validation = "Pending validation";
    $confirmee = "Confirmed";
    $en_attente_de_paiement = "Pending payment";

    $indicatif = "Calling code";
    $expli_indicatif = "<a href=\"http://en.wikipedia.org/wiki/List_of_country_calling_codes\" target=\"_blank\">The international country calling code</a> of your phone will help us send you a text with the last information about your shuttle.<br />Your number should <strong><u>NOT</u></strong> contain a calling code.";

    $de = " of ";

    $btn_recherche = "Search";

    $alt_sondage = "Survey";

    $publie_le = "Published on ";

    $lire_suite = "Read more";

    $lien_sondage = "To help us improve our services, we implemented a survey, available <a href=\"http://alsace-navette.com/sondage/\">here</a>.";

    $je_suis_pro = "Having a professional account, I pay at the end of the month.";

    $lien = "Link";

    $voir_le_detail = "See details";

    $fiche_partenaire = "Customer card";

    $description = "Description";

    $dans = "in";

    $choix_categorie = "Sort by category";

    $recapitulatif_pro = "Summary of non-paid trips";
    $titre_pro = "Deferred payment of shuttles (professional)";

    $toutes_les_news = "All news";
	
	/*
		Ajout KEMPF : 
		Information nécessaire pour la traduction des factures
	*/
	
	$lang_facture = "Invoice";
	$lang_fact_date = "Date";
	$lang_fact_objet = "Item";
	$lang_fact_montant = "Amount";
	$lang_fact_transfert = "Shuttle";
	$lang_fact_horaire_demande = "Schedules on request";
	$lang_fact_domicile = "Home additional cost";
	$lang_fact_res_der_min = "Last minute additional cost";
	$lang_fact_merci = "Thank you for your trust!";
	$lang_fact_supplement = "Extra";
	$lang_fact_attente = "Airport waiting service";
	$lang_fact_erreur = "An error has occured. Please try again or contact our services.";
	$lang_fact_personnes = "passengers";
	
	$lang_fact_tva = "VAT";
	$lang_fact_ttc = "ATI";
	$lang_fact_ht = "ATE";
	$lang_fact_intracommunautaire = "intercommunity";
	
	// Info Barre
	$lang_info_barre = get_option("banderole_anglais");
	
	/*
		KEMPF : 
		Programme de fidelité
	*/
	$lang_texte_programme_fidelite = "Join now to our fidelity program!
	<br />
	<br />
	Earn your fidelity points every time you book on Alsace-Navette.com!
	<br />
	<br />
	After a certain level, you'll be able to get a discount of <strong>".get_option("remise_fidelite")."%</strong>!
	<br />
	<br />
	Don't wait anymore, and subscribe to our fidelity program :";
	
	$lang_conditions_fidelite = "<u>Conditions</u> : 
	<br />
	Offer valid only on <a href='http://alsace-navette.com/aeroport/'>Alsace-navette.com/aeroport</a>. 
	<br />
	This offer is personal, non-transferable, and can not be combined with any other offer.";
	
	$lang_jaccepte_conditions_fidelite = "I accept the terms of the fidelity program.";
	$lang_souscrire = "Subscribe";
	$lang_adhesion_reussie = "Congratulation !";
	$lang_texte_adhesion_reussie = "Congratulation ! You can now take full advantage of our fidelity program.
	<br />
	<br />
	Your balance of fidelity points is visible in the account menu, after you log in.
	<br />
	<br />
	Thank you for choosing Alsace-Navette !";
	$lang_mes_point_fidelite = "My fidelity points";
	$lang_menu_fidelite_ = "Want to earn discounts on your trips?
	<br />
	<br />
	<strong>1 € = 1 point</strong>
	<br />
	<br />
	So join our fidelity program without delay!
	<br />
	<br />
	<a href='http://alsace-navette.com/aeroport/client/fidelite.html'>Clic here</a>";
	$lang_menu_fidelite = "Soon...<br /><br />Find here your next fidelity program";
	
	$lang_texte_horaire_supp = get_option('alert_changement_horaire_en');
	
	
	// KEMPF : Page Fiche Tarifs
	$lang_titre_fiche_tarif = "Price card";
	$tarif_base = "Base fare for a single ride <span style='font-weight:bold;'>Strasbourg > Airport</span> or <span style='font-weight:bold;'>Airport > Strasbourg</span>";
	$par_passager = "per passenger and per ride";
	$infos_pratiques = "Practicals about the airport";
	$options = "Available options";
	$txt_prise_en_charge = "Pick-up at home <br>or at your office";
	$hors = "Out of";
	$txt_horaires_demande = "Time on request";
	$lien_horaires = "View the schedule";
	$services = "Services";
	$txt_service_nuit = "Night shuttle service from 9:00pm to 7:15am";
	$txt_derniere_minute_72 = "Last minute booking -72h before departure";
	$txt_derniere_minute_24 = "Last minute booking -24h before departure";
	$txt_service_attente = "Waiting service";
	$prix_aller_simple = "single ride price";
	$a_partir_de_strasbourg = "from Strasbourg's station";
	$infos_vols = "Information about the flights";
	$lang_titre_pt_rassemblement = "Meeting Points";
	$lang_titre_info_compl = "Extra informations";
	$lang_points_rassemblement_fiche = "
	The three meeting points on Strasbourg are available
	<br />
	(Please note that the booking is needed) :
	
	<div style='text-align:left;'>
		<ul>
			<li>
				<a title='Link to the map (GoogleMap)' target='blank_' href=\"http://maps.google.fr/maps?f=q&source=s_q&hl=fr&geocode=&q=Rue+Ren%C3%A9+Cassin+Strasbourg&sll=48.601928,7.745447&sspn=0.027471,0.077248&ie=UTF8&ll=48.59892,7.775552&spn=0.006528,0.019312&z=16\">Parking relay Human Rights Council</a> (In front of HRC exit parking) 
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
				<a title='Link to the map (GoogleMap)' target='blank_' href=\"https://www.google.com/maps/place/1+Rue+Fritz+Kieffer/@48.5956782,7.754104,17z/data=!3m1!4b1!4m2!3m1!1s0x4796c85c8c9bb95d:0xf3c3c4ec5e6a34fa\">Hôtel Hilton</a> (Bus stop in front of Hilton Hotel) 
				<br />
				6 rue Fritz Kieffer
				<br />				
				67000 Strasbourg
				<br />
				<a title='GoogleMaps' target='blank_' href=\"https://www.google.com/maps/place/1+Rue+Fritz+Kieffer/@48.5956782,7.754104,17z/data=!3m1!4b1!4m2!3m1!1s0x4796c85c8c9bb95d:0xf3c3c4ec5e6a34fa\"><img alt='GoogleMaps' src=\"images/icones/maps-16.gif\" /></a>
				
				<a title='StreetView' target='blank_' href=\"https://www.google.fr/maps/@48.596481,7.755625,3a,75y,262.93h,89.44t/data=!3m4!1e1!3m2!1siQZFzFaPnvHqFkHeHlu_hA!2e0?hl=fr\"><img alt='StreetView' src=\"images/icones/street-16.png\" /></a>
				<br /><br />
			</li>
			<li>
				<a title='Link to the map (GoogleMap)' target='blank_' href=\"http://maps.google.fr/maps?f=q&amp;hl=fr&amp;geocode=&amp;time=&amp;date=&amp;ttype=&amp;q=strasbourg+3+bld+Metz&amp;sll=48.582172,7.732444&amp;sspn=0.010164,0.020084&amp;ie=UTF8&amp;ll=48.583634,7.733924&amp;spn=0.010163,0.020084&amp;z=16&amp;iwloc=addr&amp;om=1\">Strasbourg Gare</a> (In front of \"Crédit Agricole\" bank)
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
	
	$lang_fiche_part_1 = "If less than ";
	$lang_fiche_part_2 = " people are booking";
	$domicile_obligatoire = "Home service is imposed";
	$lang_point_rass_aeroport = "Meeting point at the airport";
	
	$lang_fiche_a_partir_de = "from";
	
	$lang_fiche_info_compl = "
	<strong>Less than 24h</strong> booking : <strong>".get_option("maj_24")."€</strong> extra
	<br />
	<strong>Less than 72h</strong> booking : <strong>".get_option("maj_72")."€</strong> extra
	<br />
	<strong>Home service</strong> : <strong>".get_option("maj_dom")."€</strong> extra
	<br />
	<strong>Night hours</strong> : <strong>".get_option("maj_horaire_nuit")."€</strong> extra (between <strong>".get_option("horaire_nuit_debut")." PM</strong> and <strong>".get_option("horaire_nuit_fin")." AM</strong>)
	<br />
	Delay : 10€ / 30min ";
	
	/*
		KEMPF : Ajout du texte pour les horaires Ete - Hiver
	*/
	$lang_ete = "Summer";
	$lang_hiver = "Winter";
	$lang_voir_duree_trajet = "Look the shuttles duration";
	
	/*
		KEMPF : Page FAQ
	*/
	$lang_question = "Question";
	$lang_reponse = "Answer";
?>
