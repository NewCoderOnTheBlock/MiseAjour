<?php
	/*
		Fichier de langage : Anglais
		
		Le fichier ?_lang est inclue dans les pages 
		en fonction de $_SESSION['lang'] (Qui lui peut etre modifié en fonction des cookies)
	*/
	
	/*
		Titre de pages
	*/
	
	$lang_titre_main = "Let yourself be driven to the outlets";
	$lang_titre_accueil = "Home";
	$lang_titre_informations = "Schedule";
	$lang_titre_tarifs = "Fares";
	$lang_titre_services = "Our services";
	$lang_titre_reservation = "Booking";
	$lang_titre_contact = "Contact";
	$lang_titre_validation = "Validating and payment";
	$lang_titre_annulation_paypal = "Cancellation of request";
	$lang_titre_confirmation_paypal = "Confirmation of the booking";
	$lang_titre_erreur_paiement = "Error while booking";
	$lang_titre_mentions = "Legal information";
	$lang_titre_conditions = "General terms of sale";
	$lang_titre_charte = "Quality charter";
	$lang_titre_choix_navette = "Choix de la navette";
	$lang_titre_plan_site = "Site map";
	
	/*
		Variables diverses
	*/	
	
	$lang_se_connecter = "Log in / Sign in";
	
	// Footer
	$lang_qui_sommes_nous = "Who are we?";
	$lang_alt_logo = "Alsace-navette.com";
	$lang_texte_licence = "License n°".get_num_licence()." for internal transport of passengers by road.";
	$lang_cgv = "General terms of sale";
	
	// Page d'accueil
	$lang_infos_pratiques = "Practicals";
	$lang_horaires = "Regular opening hours";
	$lang_adresse_centre = "Centre address";
	$lang_voir_map = "View on Google Map";
	$lang_services = "Services";
	$lang_a_partir_de = "from";
	$lang_texte_after_work = "From 4pm, enjoy 3 hours of shopping to relax and make good deals.";
	$lang_texte_shopping_day = "A one-day-trip and up to 5 hours of shopping, Shopping Day is the solution to enjoy peacefully and take your time.";
	$lang_texte_team_building = "For a friends outing or to reinforce the cohesion of a working team, nothing is better than shopping.";
	$lang_texte_soldes = "Special operations for sales and various punctual events in the outlet centres are available.";
	
	// Mail de paiement
	$lang_sujet_mail_paiement = "Paiement d'une navette pour le centre Outlet";
	$lang_contenu_mail_paiement_1 = "<html><head></head><body>Bonjour,<br /><br />Nous avons bien recu votre paiement de ";
	$lang_contenu_mail_paiement_2 = " €. Votre navette est donc confirmée.<br /><br />Vous pouvez télécharger votre facture ici : <a href='http://alsace-navette.com/outlet/gen_facture.php?f=";
	$lang_contenu_mail_paiement_3 = "'>Votre facture</a><br /><br />Alsace-navette vous souhaite un agréable voyage !</body></html>";
    
	// Page Réservation
	$lang_etape_1 = "Chose an available date in the calendar";
	$lang_etape_2 = "Complete with essential information";
	$lang_effectuez_reservation = "Request form<br /><br />Make your booking now!";
	$lang_vos_informations = "Your information";
	$lang_le_trajet = "The ride";
	$lang_date_trajet = "Date of the ride";
	$lang_formule = "Formule";
	$lang_domicile = "Your home";
	$lang_gare = "Strasbourg Train Station";
	
	$lang_nom = "Last name";
	$lang_prenom = "First name";
	$lang_adresse = "Address";
	$lang_ville = "City";
	$lang_code_postal = "Zip code";
	$lang_pays = "Country";
	$lang_num_telephone_fixe = "Phone number";
	$lang_num_telephone_port = "Cellphone number";
	$lang_email = "E-Mail";
	$lang_verif_email = "E-Mail confirmation";
	
	$lang_depart_trajet = "Departing from";
	$lang_destination_trajet = "Arriving at";
	$lang_date_aller = "Date de l'aller";
	$lang_date_retour = "Date du retour";
	$lang_heure_depart = "Departure time";
	$lang_heure_retour = "Return time";
	$lang_lieu_aller = "Lieu de prise";
	$lang_lieu_retour = "Lieu de dépot";
	$lang_info_complementaires = "Informations complémentaires";
	
	$lang_table_jour = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
	$lang_table_jour_court = array("Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat");
	$lang_table_mois = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "Décember");
	
	$lang_trajet_complet = "Full ride";
	
	$lang_aller = "Departure";
	$lang_retour = "Return";
	$lang_duree_estimee = "Estimated duration";
	$lang_minutes = "minutes";
	$lang_validation = "Validation";
	$lang_demande_particulière = "Demande particulière";
	$lang_valider = "Validate";
	$lang_etape_suivante = "Next step";
	$lang_lu_accepte_cgv = "I acknowledge that I have read, understood and agreed to <a href=\"conditions.php\" target=\"_blank\">the Terms and Conditions of sale</a>";
	$lang_nbre_passagers = "Number of passengers";
	$lang_nbre_passagers_enfants = "Including children passengers";
	
	$lang_champ_obligatoire = "Required field";
	$lang_champ_semi_obligatoire = "At least one field is required";
	
	$lang_horaire_fixe = "Horaires fixes";
	$lang_horaire_demande = "Horaires à la demande";
	$lang_majoration_horaire_demande = "Majoration de";
	
	$lang_cartes_acceptees = "Cartes de payement acceptées :";
	$lang_modes_de_paiement = "Système de paiement : ";
	
	$lang_modifier_mes_infos = "Modify my information";
	
	$lang_plus_de_navette_dispo = "Il n'y a plus de navette disponible.<br />Pour en savoir plus, n'hésitez pas à nous <a href='contact.php'>contacter</a>.";
	$lang_veuillez_choisir_une_navette = "Merci de choisir l'une des navettes disponibles.";
	$lang_navettes_disponibles = "Navettes disponibles";
	$lang_texte_info_accueil = "<span style='font-weight:bold;'>Shopping Shuttle</span> accompanies you from Strasbourg<br>to your favourite <span style='font-weight:bold;'>outlet centres</span>.";
	$lang_navette = "Navette";
	$lang_personnes = "passengers";
	$lang_choisir = "Choisir";
	
	// Page Tarifs
	$lang_aller_retour = "round trip";
	$lang_tarif_par_personne = "Per passenger";
	$lang_tarif_minimum = "Fare";
	$lang_tarif_est_de = "Le tarif est de ";
	$lang_tarif_soit = "Soit";
	$lang_tarif_pour_un_groupe_de = "Pour un groupe de";
	$lang_tarif_pour_trajet_aller_retour = " pour un trajet Aller-Retour";
	$lang_tarif_info_compl = "
		<ul>
			<li>Tout les départs se font depuis Strasbourg</li>";
	if (get_value_of_option('maj_domicile') > 0){
		$lang_tarif_info_compl .= "<li>La prise ou dépôt à domicile est majoré d'un montant de ".get_value_of_option('maj_domicile')." €.</li>";
	}
	$lang_tarif_info_compl .= '</ul>';
	
	// Page informations
	$lang_texte_info_compl = "
		<p>
			Tout les départs se font depuis Strasbourg.
			<br /><br />
			Il n'y a pas d'horaires fixes pour les navettes vers les centres Outlet.
			<br /><br />
			Il est uniquement possible de rejoindre les navettes proposées par nos services.
			<br /><br />
			Si toutefois vous ne parvenez pas à trouver un navette qui convienne à vos besoins, vous pouvez nous contacter au 03 88 22 22 71, de 9h00 à 12h00 et de 14h00 à 18h00.
		</p>
	";
	
	// Page contact
	$lang_texte_contact_gauche = "Before contacting us, please make sure you <span style='font-weight:bold;'>do not</span> fall into one of the following categories:<br /> 
	<ul>
		<li>To leave a comment on our services, please use our <a href='../aeroport/livreor.php'>guestbook</a>.</li>

		<li>All bookings have to be done online via the <a href='reservation.php'>booking form</a>.</li>
	</ul>
	";
	$lang_texte_contact_droite = "If you experience difficulties to book, do not hesitate to contact us.
	<ul>
		<li>By phone, from 9am to 12am and from 2pm to 5pm<br><span style='font-weight:bold;'>03 88 22 22 71</span></li>

		<li>In case of emergency<br><span style='font-weight:bold;'>06 27 18 12 52</span></li>
		
		<li>Espace Alsace-Navette<br>2 Rue du Coq<br>67000 Strasbourg FRANCE</li>
	</ul>
	";
	$lang_formulaire_contact = "Contact form";
	$lang_motif = "Reason";
	$lang_message = "Message";
	$lang_renseignement = "Information";
	$lang_probleme_technique = "Technical problem";
	$lang_partenariat = "Partnership";
	$lang_champs_requis = "Required fields";
	$lang_envoyer = "Send";
	$lang_donnees_incorrectes = "Incorrect data";
	$lang_erreur_champ_vide = "You have to fill in all fields!";
	$lang_contact_ok = "Your message has been successfully sent";
	$lang_contact_erreur = "An error occurred while sending the message";
	$lang_mail_invalide = "Non valid email address";
	
	// Page validation
	$lang_recap_commande = "Booking recap";
	$lang_nous_vous_cherchons_a = "We pick you at";
	$lang_a_heure_min = "at";
	$lang_et_vous_deposons_a = "And we drop you at";
	$lang_mode_paiement = "Payment methods";
	$lang_cout_du_trajet = "Price of the ride";
	$lang_majoration_domicile = "Pick-up at home";
	$lang_majoration_demande = "On request time";
	$lang_total = "Total";
	$lang_par_personne = "per passenger";
	$lang_nombre_personnes = "Number of passengers";
	$lang_dont = "including";
	$lang_enfants = "child(ren)";
	$lang_confirmation = "Your booking has been successfully sent and has been added to our waiting list!";
	$lang_explication_capacite = "There is no more room in this shuttle!";
	$lang_explication_confirmation = "But you can confirm your booking without paying.<br>If so, you will be on a waiting list and we will contact you again if seats become available.";
	$lang_retour_accueil = "Back to home";
	$lang_intro_erreur_ca = "An error has occured while you were booking";
	$lang_fin_erreur_ca = "Please try again.";
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
	$lang_validation_commande = "Thank you! Your booking has been validated!";
	$lang_dl_facture = "Download the invoice";
	$lang_commande_annulee = "Your booking has been cancelled!";
	
	// Page annulation
	$lang_vous_avez_annule = "Vous avez annulé votre demande";
	
	// Page "Nos services"
	$lang_reserver = "Book your day!";
	$lang_texte_metzingen = "On the French National Day, <span style='font-weight:bold;'>OUTLETCITY METZINGEN</span> and <span style='font-weight:bold;'>Shopping Shuttle</span> are waiting for you. Come and experience a shopping session on <span style='font-weight:bold;'>July 14<sup>th</sup> 2015</span>. Discounts are up to 50% at outlet prices. To welcome you, you will receive a glass of sparkling wine and a pretzel at Metzingen tourism office (presentation of a coupon is needed). We look forward to your visit!

		<ul>
			<li>More than 70 luxury brands</li>
			<li>Located 30 minutes from Stuttgart</li>
			<li>Wide range of products</li>
		</ul>
			
		<ul>
			<li>The hometown of Hugo Boss</li>
			<li>Award-winning architecture stores</li>
			<li>Extraordinary shopping experience with exclusive events</li>
		</ul>";
	$lang_after_work = "After Work";
	$lang_shopping_day = "Shopping Day";
	$lang_entre_amis = "Between friends";
	$lang_entre_collegues = "Between colleagues";
	$lang_cohesion_equipe = "Team building";
	$lang_horaires_tarifs = "Schedule & fares";
	$lang_depart = "Departure";
	$lang_soit_pour = "so for";
	$lang_supplement = "Extra";
		
	// Facture
	$lang_facture = "Invoice";
	$lang_facture_a = "Invoiced to:";
	$lang_a = "at";
	$lang_le = "on";
	$lang_le_maj = "On";
	$lang_vers = "to";
	$lang_description_trajet = "Ride description:";
	$lang_total_ht = "Total Excl. Tax";
	$lang_total_tva = "Tax";
	$lang_total_ttc = "Total Due";
	$lang_confiance = "Thank you for your trust!";
	
	// Page charte
	$lang_texte_charte = "We intend to provide you a service of quality by submitting to strict rules provided in our quality charter. These rules are specific to our organization and show to our customers the attention paid to their comfort.
		
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
		
	// Page mentions légales
	$lang_texte_mentions = "<strong>- This website is the property of the Franco-Iranian association of Alsace.</strong>
        <br />
    	<br />
        2 Rue du Coq
        <br />
        67000 Strasbourg
        <br />
        N° SIRET 47767406300037
        <br />
        Code NAF : 9499Z
        <br /><br />
        
        License number for passengers transport:
        <br />
        License n°".get_num_licence()."
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
        You have the right to access, modify and delete your personal data by sending an <a href=\"mailto:info@alsace-navette.com\">email</a>.<br> You will receive a reply within a month.
        
        <br />
        <br />
        In case of emergency, please call + 33 6 27 18 12 52.";
		
	// Page Conditions générales
	$lang_texte_conditions = "<strong>Cond. 1: Service </strong>         
		<br />     	
		Alsace shopping shuttle is a service offered by the franco-iranian association of Alsace to its members. Fares include the annual subscription to the assocation. 
		<br /><br />
		
   		<strong>Cond. 2: Booking </strong>
        <br />
    	You can ask for a booking online 24h/24 and 7d/7.
		You will receive an email confirming your trip details selon les informations fournies: date, time, vehicle type, duration and distance. Please check out those information on your confirmation email because it will prevail as transport contract.
        <br />
    	On request, a PDF-format bill could be sent to you. 
        
        <br /><br />
    	<strong>Cond. 3: Departure/arrival at home/office</strong>
        <br />
    	Departure and arrival at home or office schedules are made according to the trip planner. We will send you an email to confirm the departing time.
        <br />
    	This service will be invoiced ";

        $lang_texte_conditions_1 = " € per trip in Strasbourg and must be paid while booking. 
		
        <br /><br />
    	<strong>Cond. 4: Fares</strong>
        <br />
    	Fares include booking, transport, luggage and the membership to the association.
        <br />
    	Luggage is limited to a bag and a handbag per passenger. An extra charge of 3 euros for small luggage and 5 euros for big luggage is invoiced beyond luggage limit. The extra charges have to be paid to the driver.
        
        <br /><br />
    	<strong>Cond. 5: Delay</strong>
        <br />
    	On departing: Despite the care we take to ensure you a comfortable trip, delays may occur. 
        <br />
    	On arrival: Delay in boarding, involving awaiting shuttle, will be charged 20€ per hour. This amount will have to be paid directly to the driver while boarding. 
        
        <br /><br />
        <strong>Cond. 6: No show</strong>
        <br />
        The service is still charged in case of no show.
        
        <br /><br />
        <strong>Cond. 7: Cancellation</strong>
        <br />
        Bookings are final and cannot be refunded. Alsace navette reserves to propose a goodwill gesture for motivated cancellations made more than 10 days before the departure day.
        
        <br /><br />
        <strong>Cond. 8: Pets</strong>
        <br />
        Small pets (weight less than 6kgs / 13 lbs) should be transported in a carrier or a closed bag. Large-sized dogs must be muzzled and should not disturb other passengers. A 5 euros extra per animal are charged and should be paid directly to the driver at the departing.
        
        <br /><br />
        <strong>Cond. 9: Responsibility</strong>
        <br />
        In case of repayment, the amount cannot exceed the paid service.
        
        <br /><br />
        <strong>Cond. 10: Holidays and weekends</strong>
        <br />
        The shuttle runs on holidays and weekends.
		
        <br /><br /><br>

        <strong>In case of emergency, please call +33 6 27 18 12 52</strong>";
?>