<?php
	/*
		Fichier de langage : Anglais
		
		Le fichier ?_lang est inclue dans les pages 
		en fonction de $_SESSION['lang'] (Qui lui peut etre modifié en fonction des cookies)
	*/
	
	/*
		Titre de pages
	*/
	
	$lang_titre_main = "Let yourself be driven at outlet : Marques Avenue Talange, Outlet City Metzingen, TheStyleOutlet Roppenheim";
	$lang_titre_accueil = "Home";
	$lang_titre_informations = "Schedules";
	$lang_titre_tarifs = "Price information";
	$lang_titre_contact = "Contact";
	$lang_titre_validation = "Payment";
	$lang_titre_annulation_paypal = "Cancel a trip";
	$lang_titre_confirmation_paypal = "Confirm";
	$lang_titre_mentions = "Legal notices";
	$lang_titre_conditions = "General terms of sale";
	$lang_titre_charte = "Quality charter";
	
	/*
		Variables diverses
	*/	
	
	/*
		Page d'accueil
	*/
	$lang_texte_info_accueil = "Please click on an available date on the calendar, then select the most approriate shuttle";
	$lang_choisir = "Choose";
	// Mail de paiement
	$lang_sujet_mail_paiement = "Paiement d'une navette pour Royal Palace";
	$lang_contenu_mail_paiement_1 = "<html><head></head><body>Bonjour,<br /><br />Nous avons bien recu votre paiement de ";
	$lang_contenu_mail_paiement_2 = " €. Votre navette est donc confirmée.<br /><br />Vous pouvez télécharger votre facture ici : <a href='http://alsace-navette.com/royal-palace/gen_facture.php?f=";
	$lang_contenu_mail_paiement_3 = "'>Votre facture</a><br /><br />Alsace-navette vous souhaite un agréable voyage !</body></html>";
    
	// Page Réservation
	$lang_effectuez_reservation = "Booking form <br /><br />Don't waste any time! Book now!";
	$lang_vos_informations = "Your informations";
	$lang_le_trajet = "Trip";
	$lang_le_spectacle = "Le spectacle";
	$lang_date = "Date";
	
	$lang_nom = "Name";
	$lang_prenom = "Surname";
	$lang_adresse = "Address";
	$lang_ville = "City";
	$lang_code_postal = "ZIP Code";
	$lang_pays = "Country";
	$lang_num_telephone_fixe = "Fixed phone";
	$lang_num_telephone_port = "Mobile phone";
	$lang_email = "E-Mail";
	$lang_verif_email = "E-mail confirmation";
	
	$lang_date_aller = "Departure date";
	$lang_date_retour = "Return date";
	$lang_heure_aller = "Pickup in Strasbourg (or at home)";
	$lang_heure_retour = "Pickup at Royal Palace";
	$lang_lieu_aller = "Pickup point";
	$lang_lieu_retour = "Dropoff location";
	$lang_info_complementaires = "Additional information";

	$lang_table_jour = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
	$lang_table_mois = array("December", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November");
	$lundi ="Monday";
	$mardi = "Tuesday";
	$mercredi = "Wednesday";
	$jeudi = "Thursday";
	$vendredi = "Friday";
	$samedi = "Saturday";
	$dimanche = "Sunday";
	
	$lang_div_info_prise = '
		<div id="div_horaire_aller_midi">
			We will pick you up at '.get_value_of_option("midi_aller").' pour aller at Royal Palace
			<br />
		</div>
		
		<div id="div_horaire_aller_soir" style="display:none;">
			We will pick you up at '.get_value_of_option("soir_aller").' pour aller at Royal Palace
			<br />
		</div>
		
		<div id="div_horaire_retour_midi">
			Nous vous recherchons à '.get_value_of_option("midi_retour").' at Royal Palace
			<br /><br />
		</div>
		
		<div id="div_horaire_retour_soir" style="display:none;">
			Nous vous recherchons à '.get_value_of_option("soir_retour").' at Royal Palace
			<br /><br />
		</div>
	';
	
	$lang_aller = "Outbound";
	$lang_retour = "Return";
	$lang_duree_estimee = "Estimated time";
	$lang_minutes = "minutes";
	$lang_validation = "Validation";
	$lang_demande_particulière = "Specific request";
	$lang_valider = "Validate";
	$lang_etape_suivante = "Next step";
	$lang_lu_accepte_cgv = 'I acknowledge that I have read, understood and agreed to <a href="conditions.php" target="_blank">the general terms of sale</a>';
	$lang_nombre_personnes = "Number of passengers";
	
	$lang_champ_obligatoire = "Mandatory fielde";
	$lang_champ_semi_obligatoire = "At least one field has to be filled in/informed";
	
	$lang_horaire_fixe = "Permanent schedules";
	$lang_horaire_demande = "Schedules on request";
	$lang_majoration_horaire_demande = "An extra";
	
	$lang_cartes_acceptees = "Accepted credit cards:";
	$lang_modes_de_paiement = "Payment method: ";
	
	$lang_modifier_mes_infos = "Edit information";
	
	// Page Tarifs
	$lang_aller_retour = "Round trip";
	$lang_tarif_par_personne = "Per person";
	$lang_tarif_minimum = "Cost";
	$lang_tarif_info_compl = "The total cost varies depending on the number of passengers.";
	
	
	// Page informations 
	$lang_titre_spectacles = "Spectacles au Royal Palace";
	$lang_titre_midi = "Spectacle du midi";
	$lang_titre_soir = "Spectacle du soir";
	
	$lang_spectacle_midi = "
	Départ de Strasbourg à ".get_value_of_option("midi_aller")."<br />
	Retour à ".get_value_of_option("midi_retour")."<br /><br />
	Déjeuner de 12h à 15h45<br />
	Spectacle à 15h45<br />
	Mercredi, Jeudi, Samedi et Dimanche<br />";
	
	$lang_spectacle_soir = "
	Départ de Strasbourg à ".get_value_of_option("soir_aller")."<br />
	Retour à ".get_value_of_option("soir_retour")."<br /><br />
	Diner de 19h30 à 22h<br />
	Spectacle à 22h<br />
	Danse avec orchestre après le spectacle<br />
	Jeudi, Vendredi et Samedi<br />";
	
	$lang_plus_d_info = "More info on, <a target=\"blank_\" href=\"http://www.royal-palace.com/menus-tarifs.html\">cliquez ici</a>";
	$lang_informations_complementaires = "Informations complémentaires";
	$lang_texte_info_compl = "
	<ul>
		<li>It is estimated at 45 minutes from Strasbourg.</li>";
		if (get_value_of_option('maj_domicile') > 0){
			$lang_texte_info_compl .= "<li>Picking you up or dropping you off will be charged an extra ".get_value_of_option('maj_domicile')." €.</li>";
		}
		if (get_value_of_option('maj_hors_stras_par_km') > 0){
			$lang_texte_info_compl .= "<li>La prise ou dépôt à domicile hors Strasbourg est majoré d'un montant de ".get_value_of_option('maj_hors_stras_par_km')." €.</li>";
		}
		$lang_texte_info_compl .= "
		<li>The total cost varies depending on the number of passengers.</li>
	</ul>
	";
	$lang_tarif_soit = "Equals";
	$lang_tarif_pour_un_groupe_de = "for a group of";
	$lang_personnes = "people.";
	// Page contact
	$_lang_texte_contact = "You can contact us in a variety of ways. However, please make sure you do not fall into one of the following categories before reaching us:<br /> 
	<ul>

		<li>You want to make a reservation. All reservations are made online, we don't make any reservation by phone. Yet if difficulties occurred, please contact us via the means below.</li>
	</ul>
	Several means are available for contacting us:
	<ul>
		<li>Come to our office: AFI Alsace 2, Rue du Coq 67000 Strasbourg FRANCE</li>

		<li>By phone: 03 88 22 22 71, from 9am to 12am and from 2pm to 5pm</li>

		<li>In case of emerengcy, please call 06 27 18 12 52</li>

		<li>By email: <a href=\"info@alsace-navette.com\">info@alsace-navette.com</a></li>
	</ul>
";
	
	
	// Page validation
	$lang_recap_commande = "Details";
	$lang_nous_vous_cherchons_a = "We will pick you up at";
	$lang_a_heure_min = "at";
	$lang_et_vous_deposons_a = "And drop you off at";
	$lang_mode_paiement = "Payment methods";
	$lang_cout_du_trajet = "Travel cost";
	$lang_majoration_domicile = "Majoration domicile";
	$lang_majoration_demande = "Majoration horaires à la demande";
	$lang_total = "Total";
	$lang_par_personne = "per person";
	
	// Page annulation
	$lang_vous_avez_annule = "You have just canceled your booking";
	
	// Page charte
	$lang_texte_charte = "We intend to provide you a service of quality by submitting to strict rules provided in our quality charter. These rules are specific to our organization and show to our customers the attention paid to their comforts.
		
       <br /><br />
       <strong>Chapter 1 : Security
       <br /><br />
       Chapter 2: Optimizing waiting time:</strong>
       <br /><br />
       - We will report any delay via SMS.
       <br /><br />
       - Waiting time will not exceed 15 minutes at the meeting point.
       <br /><br />
       
       <strong>
       Chapter 3: Accessibility
       <br /><br />
       Chapter 4: Comfort
       <br /><br />
       Chapter 5: Tracking 
       <br /><br />
       Chapter 6 : Availibility of our company
       <br /><br />
       Chapter 7 : Listening to the needs of our customers 
       <br /><br />
       Chapter 8 : Employee training
       <br /><br />
       Chapter 9 : The best value for money
       <br /><br />
       Chapter 10 : Demand of solidarity economy
       <br /><br />
       Chapter 11 : Respect for the environment
       <br /><br />
       Chapter 12 : Local service
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
        
        Licence number for people's transportantion:
        <br />
        License n°2007/42/0000784
        <br /><br />
        
        Website's name: <a href=\"http://www.alsace-navette.com\">www.alsace-navette.com</a>
        <br />
        <br />
        <strong>- Website hosted by:</strong>
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
        <strong>- Right data access:</strong>
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
   		<strong>Cond. 2 : Réservation </strong>
        <br />
    	Vous pouvez effectuer votre demande de réservation en ligne 24h/24 et 7j/7.
		Un mail vous sera alors adressé pour confirmer votre trajet selon les informations fournies : date, heure, type de véhicule, durée et distance. .Vous devrez vérifier les informations figurant sur le mail de confirmation qui prévaudra comme contrat de transport.
        <br />
    	Sur demande, une facture au format PDF pourra vous être envoyée. 
        
        <br /><br />
    	<strong>Cond. 3 : Departure/Arrival at home/office</strong>
        <br />
    	    	Departure and arrival schedules are made according to the trip planner. We will send you an email to confirm the departing time. 
				<br />
    	This service will be invoiced ";

        $lang_texte_conditions_1 = " € per trip in Strasbourg and must be paid while the reservation.
		
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
    	On arrival: Delay in boarding the shuttle resulting in a wait by the shuttle will be charged 10€/30 min. It must be paid to the driver at the departing. An invoice will be provided so that you can present it to you airline or insurance company for refund
        
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