<?php
	/*
		Fichier de langage : Francais
		
		Le fichier ?_lang est inclue dans les pages 
		en fonction de $_SESSION['lang'] (Qui lui peut etre modifié en fonction des cookies)
	*/
	
	/*
		Titre de pages
	*/
	
	$lang_titre_main = "Let you drive at Royal Palace";
	$lang_titre_accueil = "Home";
	$lang_titre_informations = "Schedules";
	$lang_titre_tarifs = "Fares";
	$lang_titre_contact = "Contact";
	$lang_titre_validation = "Validation and payment";
	$lang_titre_annulation_paypal = "Booking canceled";
	$lang_titre_confirmation_paypal = "Booking confirmed";
	$lang_titre_mentions = "Legal Notices";
	$lang_titre_conditions = "Terms of sale";
	$lang_titre_charte = "Quality chart";
	
	/*
		Variables diverses
	*/	
	
	// Mail de paiement
	$lang_sujet_mail_paiement = "Payment of a shuttle to Royal Palace";
	$lang_contenu_mail_paiement_1 = "<html><head></head><body>Hi,<br /><br />We have received your payment of ";
	$lang_contenu_mail_paiement_2 = " €. Your shuttle is confirmed.<br /><br />You can download your invoice here : <a href='http://alsace-navette.com/royal-palace/gen_facture.php?f=";
	$lang_contenu_mail_paiement_3 = "'>Your invoice</a><br /><br />Alsace-navette wishes you a pleasant trip !</body></html>";
    
	// Page Réservation
	$lang_effectuez_reservation = "Request form<br /><br />Make your reservation now !";
	$lang_vos_informations = "Your informations";
	$lang_le_trajet = "The trip";
	$lang_le_spectacle = "The show";
	$lang_date = "Date";
	
	$lang_nom = "Name";
	$lang_prenom = "First name";
	$lang_adresse = "Adress";
	$lang_ville = "City";
	$lang_code_postal = "Zip code";
	$lang_pays = "Country";
	$lang_num_telephone_fixe = "Phone";
	$lang_num_telephone_port = "Cellphone";
	$lang_email = "E-Mail";
	$lang_verif_email = "E-Mail confirmation";
	
	$lang_date_aller = "Date of outward";
	$lang_date_retour = "Date of return";
	$lang_heure_aller = "Taking time at Strasbourg (Or your home)";
	$lang_heure_retour = "Taking time at Royal Palace";
	$lang_lieu_aller = "Pick-up place";
	$lang_lieu_retour = "Drop-off place";
	$lang_info_complementaires = "Additional informations";
	
	$lang_option_du_midi = "Noon show";
	$lang_option_du_soir = "Evening show";
	$lang_option_repas_spectacle = "Meal + show";
	$lang_option_spectacle = "Only the show";
	
	$lang_div_info_prise = '
		<div id="div_horaire_aller_midi_1" style="display:none;">
			We pick you up at '.get_value_of_option("midi_aller_spectacle").' to go to the Royal Palace
			<br />
		</div>
		
		<div id="div_horaire_aller_soir_1" style="display:none;">
			We pick you up at '.get_value_of_option("soir_aller_spectacle").' to go to the Royal Palace
			<br />
		</div>
		
		<div id="div_horaire_aller_midi_2">
			We pick you up at '.get_value_of_option("midi_aller").' to go to the Royal Palace
			<br />
		</div>
		
		<div id="div_horaire_aller_soir_2" style="display:none;">
			We pick you up at '.get_value_of_option("soir_aller").' to go to the Royal Palace
			<br />
		</div>
		
		<div id="div_horaire_retour_midi">
			We pick you up at '.get_value_of_option("midi_retour").' at the Royal Palace
			<br /><br />
		</div>
		
		<div id="div_horaire_retour_soir" style="display:none;">
			We pick you up at '.get_value_of_option("soir_retour").' at the Royal Palace
			<br /><br />
		</div>
	';
	
	$lang_aller = "Depart";
	$lang_retour = "Return";
	$lang_duree_estimee = "Estimated time";
	$lang_minutes = "minutes";
	$lang_validation = "Confirmation";
	$lang_demande_particuliere = "Special request";
	$lang_valider = "Validate";
	$lang_etape_suivante = "Next step";
	$lang_lu_accepte_cgv = "I have read and I accept the <a href='conditions.php' target='_blank'>terms of sale</a>";
	$lang_nombre_personnes = "Number of passengers";
	
	$lang_champ_obligatoire = "Required field";
	$lang_champ_semi_obligatoire = "One of the two field must be filled";
	
	$lang_horaire_fixe = "Horaires fixes";
	$lang_horaire_demande = "Time on request";
	$lang_majoration_horaire_demande = "Extra of";
	
	$lang_cartes_acceptees = "Payment card accepted :";
	$lang_modes_de_paiement = "Way of payment : ";
	
	$lang_modifier_mes_infos = "Change my informations";
	
	// Page Tarifs
	$lang_aller_retour = "Depart - Return";
	$lang_tarif_par_personne = "Per passenger";
	$lang_tarif_minimum = "Minimum package";
	$lang_tarif_info_compl = "The total price is calculated depending on the number of passengers.
	<br />
	<ul>";
		if (get_value_of_option('maj_domicile') > 0){
			$lang_tarif_info_compl .= "<li>The pick up or drop off at home has an extra of ".get_value_of_option('maj_domicile')." €.</li>";
		}
		if (get_value_of_option('maj_hors_stras_par_km') > 0){
			$lang_tarif_info_compl .= "<li>The pick up or drop off at home out of Strasbourg has an extra of ".get_value_of_option('maj_hors_stras_par_km')." €.</li>";
		}
		if (get_value_of_option('maj_only_spectacle') > 0){
			$lang_tarif_info_compl .= "<li>Choosing a trip for the show only has a extra of ".get_value_of_option('maj_only_spectacle')." € per passenger.</li>";
		}
		$lang_tarif_info_compl .= "
	</ul>";
	
	
	// Page informations 
	$lang_titre_spectacles = "Royal Palace Shows";
	$lang_titre_midi = "Noon Show";
	$lang_titre_soir = "Evening Show";
	
	$lang_spectacle_midi = "
	Departure from Strasbourg at ".get_value_of_option("midi_aller")."<br />
	Return at ".get_value_of_option("midi_retour")."<br /><br />
	Meal from 12:00AM to 15:45PM<br />
	Show at 15:45PM<br />
	Wednesday, Thurdsay, Saturday et Sunday<br />";
	
	$lang_spectacle_soir = "
	Departure from Strasbourg at ".get_value_of_option("soir_aller")."<br />
	Return at ".get_value_of_option("soir_retour")."<br /><br />
	Meal from 19:30PM to 22:00PM<br />
	Show at 22:00PM<br />
	Dance with an orchestra after the show<br />
	Thurdsay, Friday and Saturday<br />";
	
	$lang_plus_d_info = "For more informations, <a target=\"blank_\" href=\"http://www.royal-palace.com/menus-tarifs.html\">clic here</a>";
	$lang_informations_complementaires = "Additional informations";
	$lang_texte_info_compl = "
	<ul>
		<li>It is possible to choose a shuttle for the show only.</li>
		<li>The time of travel is estimated at 45 minutes from the Strasbourg train station.</li>";
		if (get_value_of_option('maj_domicile') > 0){
			$lang_texte_info_compl .= "<li>The pick up or drop off at home has an extra of ".get_value_of_option('maj_domicile')." €.</li>";
		}
		if (get_value_of_option('maj_hors_stras_par_km') > 0){
			$lang_texte_info_compl .= "<li>The pick up or drop off at home out of Strasbourg has an extra of ".get_value_of_option('maj_hors_stras_par_km')." €.</li>";
		}
		if (get_value_of_option('maj_only_spectacle') > 0){
			$lang_texte_info_compl .= "<li>Choosing a trip for the show only has a extra of ".get_value_of_option('maj_only_spectacle')." € per passenger.</li>";
		}
		$lang_texte_info_compl .= "
		<li>The total price is calculated depending on the number of passengers.</li>
	</ul>
	";
	
	// Page contact
	$_lang_texte_contact = "Several means are available to contact us but first please make sure you do not fall into one of these categories :<br /> 
	<ul>
		<li>You are satisfied with our service, and you want to make a comment . In this case, there is a guestbook.</li>

		<li>You want to make a reservation. All reservations are made online, we don't make any reservation by phone. Yet if difficulties occurred or if you don't have an internet access, please contact us via the means below.</li>
	</ul>
	Several ways are available to contact us : 
	<ul>
		<li>Come to our office : AFI Alsace 2, Rue du Coq 67000 Strasbourg FRANCE</li>

		<li>By phone : 03 88 22 22 71, from 9am to 12am and from 2pm to 6pm</li>

		<li>In case of emerengcy, please call 06 27 18 12 52</li>

		<li>PBy email : <a href=\"info@alsace-navette.com\">info@alsace-navette.com</a></li>
	</ul>
";
	
	
	// Page validation
	$lang_recap_commande = "Summary of the order";
	$lang_nous_vous_cherchons_a = "We will pick you at";
	$lang_a_heure_min = "at";
	$lang_et_vous_deposons_a = "And drop you at";
	$lang_mode_paiement = "Paiement method";
	$lang_cout_du_trajet = "Trip cost";
	$lang_majoration_domicile = "Home extra";
	$lang_majoration_demande = "Time on request extra";
	$lang_majoration_spectacle_only = "Show only extra";
	$lang_total = "Total price";
	$lang_par_personne = "per passenger";
	
	// Page annulation
	$lang_vous_avez_annule = "You have canceled your request";
	
	// Page charte
	$lang_texte_charte = "We intend to provide you a service of quality by submitting to strict rules provided in our quality charter. These rules are specific to our organization and show to our customers the attention paid to their comforts.
		
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
        
        Licence number for people's transportantion :
        <br />
        Licence n°2007/42/0000784
        <br /><br />
        
        Website's name : <a href=\"http://www.alsace-navette.com\">www.alsace-navette.com</a>
        <br />
        <br />
        <strong>- Website hosted by :</strong>
        <br />
        <br />
        1and1 Internet LLC
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
        <strong>- Right data access :</strong>
        <br />
        <br />
		
		You have the right to access, modify and delete your personal data by sending an <a href=\"mailto:info@alsace-navette.com\">email</a> within a month.
                
        <br />
        <br />
        In case of emergency, please call + 33 6 27 18 12 52.";
		
	// Page Conditions générales
	$lang_texte_conditions = "<strong>Cond. 1 : Service </strong>
        <br />
    	Alsace airport shuttle is a service offered by the franco-iranian association of Alsace to its members. Fares include the annual subscription to the assocation. 
        
        <br /><br />
   		<strong>Cond. 2 : Reservation </strong>
        <br />
    	Reservation should be made at least 72 hours before the departing day. You will receive an email confirming your trip details (date, time, cost and shuttle’s availability), which must be shown to the driver. Please check out those information on your confirmation email.
    	
		<br /><br />
    	<strong>Cond. 3 : Departure/Arrival</strong>
        <br />
    	Departure and arrival schedules are made according to the trip planner. We will send you an email to confirm the departing time.
        <br />
    	This service will be invoiced ";

        $lang_texte_conditions_1 = " € per trip in Strasbourg and must be paid while the reservation. For other points of departure and arrival, please ask for an estimate in the section \"specific requests\". 
		
		
        <br /><br />
    	<strong>Cond. 4 : Fares</strong>
        <br />
    	Fares include reservation, transport, luggage and the membership to the association.
        <br />
    	Luggage is limited to a bag and handbag per passenger. An extra charge of 3 euros for small luggage and 5 euros for big luggage is invoiced beyond luggage limit. The extra charges are to be paid to the driver.
        
        <br /><br />
    	<strong>Cond. 5 : Delay</strong>
        <br />
    	On departing: Despite the care we take to ensure you a comfortable trip, delays may occur. We recommend that you to plan your airport arrival time at least 3 hours before the takeoff, to perform all check-in and boarding formalities. We also advice you to take out travel insurance; we disclaim any responsibility and liability in case of delay.
        <br />
    	On arrival: Delay in boarding the shuttle resulting in a wait by the shuttle will be charged 20 € per hour. It must be paid to the driver at the departing. An invoice will be provided so that you can present it to you airline or insurance company for refund
        
        <br /><br />
        <strong>Cond. 6 : No show</strong>
        <br />
        The service is still charged in case of no show.
        
        <br /><br />
        <strong>Cond. 7 : Cancellation</strong>
        <br />
        Reservations are final and cannot be refunded. 
        <br /><br />
		
        <strong>Cond. 8 : Pets</strong>
        <br />
        Small pets (weight less that 6kg / 13 lb) should be transported in a carrier or a closed bag. Large-sized dogs must be muzzled and should not disturb other passengers. A 5 extra euro per animal are charged and should be paid directly to the driver at the departing. 
        
        <br /><br />
        <strong>Cond. 9 : Responsibility</strong>
        <br />
        In case of repayment, the amount cannot exceed the paid service.
        
        <br /><br />
        <strong>Cond. 10 : Holidays and weekends</strong>
        <br />
        The shuttle runs on holidays and weekends. 
        
        <br /><br /><br />
        <strong>In case of emergency, please call +33 6 27 18 12 52</strong>";
?>