<?php
	/*
		Fichier de langage : Francais
		
		Le fichier ?_lang est inclue dans les pages 
		en fonction de $_SESSION['lang'] (Qui lui peut etre modifié en fonction des cookies)
	*/
	
	/*
		Titre de pages
	*/
	
	$lang_titre_main = "Laissez vous conduire aux Outlets : Marques Avenue Talange, Outlet City Metzingen, TheStyleOutlet Roppenheim";
	$lang_titre_accueil = "Accueil";
	$lang_titre_informations = "Horaires";
	$lang_titre_tarifs = "Tarifs";
	$lang_titre_services = "Nos services";
	$lang_titre_reservation = "Réservation";
	$lang_titre_contact = "Contact";
	$lang_titre_validation = "Validation et paiement";
	$lang_titre_annulation_paypal = "Annulation de demande";
	$lang_titre_confirmation_paypal = "Confirmation de la réservation";
	$lang_titre_erreur_paiement = "Erreur lors du paiement";
	$lang_titre_mentions = "Mentions légales";
	$lang_titre_conditions = "Conditions générales de ventes";
	$lang_titre_charte = "Charte de qualité";
	$lang_titre_choix_navette = "Choix de la navette";
	$lang_titre_plan_site = "Plan du site";
	
	/*
		Variables diverses
	*/	
	
	$lang_se_connecter = "Se connecter / S'inscrire";
	
	// Footer
	$lang_qui_sommes_nous = "Qui sommes-nous ?";
	$lang_alt_logo = "Alsace-navette.com";
	$lang_texte_licence = "Licence n°".get_num_licence()." pour le transport intérieur de personnes par route.";
	$lang_cgv = "CGV";
	
	// Page d'accueil
	$lang_infos_pratiques = "Informations pratiques";
	$lang_horaires = "Horaires d'ouverture réguliers";
	$lang_adresse_centre = "Adresse du centre";
	$lang_voir_map = "Voir sur Google Map";
	$lang_services = "Services";
	$lang_a_partir_de = "à partir de";
	$lang_texte_after_work = "A partir de 16h00, profitez de 3 heures de shopping pour vous détendre et faire de bonnes affaires.";
	$lang_texte_shopping_day = "Un voyage d’une journée et jusqu’à 5 heures de shopping, Shopping Day est la solution pour profiter sereinement et prendre son temps.";
	$lang_texte_team_building = "Pour une sortie entre amis ou pour renforcer la cohésion d’une équipe de travail, rien ne vaut un peu de shopping.";
	$lang_texte_soldes = "Des opérations spéciales pour les soldes et différents événements ponctuels dans les centres outlet vous sont proposés.";
	
	// Mail de paiement
	$lang_sujet_mail_paiement = "Paiement d'une navette pour le centre Outlet";
	$lang_contenu_mail_paiement_1 = "<html><head></head><body>Bonjour,<br /><br />Nous avons bien recu votre paiement de ";
	$lang_contenu_mail_paiement_2 = " €. Votre navette est donc confirmée.<br /><br />Vous pouvez télécharger votre facture ici : <a href='http://alsace-navette.com/outlet/gen_facture.php?f=";
	$lang_contenu_mail_paiement_3 = "'>Votre facture</a><br /><br />Alsace-navette vous souhaite un agréable voyage !</body></html>";
    
	// Page Réservation
	$lang_etape_1 = "Choisissez une date disponible dans le calendrier";
	$lang_etape_2 = "Complétez avec des informations essentielles";
	$lang_effectuez_reservation = "Formulaire de demande<br /><br />Effectuez votre réservation dès maintenant !";
	$lang_vos_informations = "Vos informations";
	$lang_le_trajet = "Le trajet";
	$lang_date_trajet = "Date du trajet";
	$lang_formule = "Formule";
	$lang_domicile = "Votre domicile";
	$lang_gare = "Gare de Strasbourg";
	
	$lang_nom = "Nom";
	$lang_prenom = "Prenom";
	$lang_adresse = "Adresse";
	$lang_ville = "Ville";
	$lang_code_postal = "Code postal";
	$lang_pays = "Pays";
	$lang_num_telephone_fixe = "Téléphone fixe";
	$lang_num_telephone_port = "Téléphone portable";
	$lang_email = "E-Mail";
	$lang_verif_email = "Confirmation E-Mail";
	
	$lang_depart_trajet = "Au départ de";
	$lang_destination_trajet = "À destination de";
	$lang_date_aller = "Date de l'aller";
	$lang_date_retour = "Date du retour";
	$lang_heure_depart = "Heure de départ";
	$lang_heure_retour = "Heure de retour";
	$lang_lieu_aller = "Lieu de prise";
	$lang_lieu_retour = "Lieu de dépot";
	$lang_info_complementaires = "Informations complémentaires";
	
	$lang_table_jour = array("Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi");
	$lang_table_jour_court = array("Dim", "Lun", "Mar", "Me", "Jeu", "Ven", "Sam");
	$lang_table_mois = array("Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Décembre");

	$lang_trajet_complet = "Trajet complet";
	
	$lang_aller = "Aller";
	$lang_retour = "Retour";
	$lang_duree_estimee = "Durée estimée";
	$lang_minutes = "minutes";
	$lang_validation = "Validation";
	$lang_demande_particulière = "Demande particulière";
	$lang_valider = "Valider";
	$lang_etape_suivante = "Étape suivante";
	$lang_lu_accepte_cgv = 'J\'ai lu et j\'accepte les <a href="conditions.php" target="_blank">conditions générales de ventes</a>';
	$lang_nbre_passagers = "Nombre de passagers";
	$lang_nbre_passagers_enfants = "Dont passagers enfants";
	
	$lang_champ_obligatoire = "Champ obligatoire";
	$lang_champ_semi_obligatoire = "L'un des deux champs doit être rempli";
	
	$lang_horaire_fixe = "Horaires fixes";
	$lang_horaire_demande = "Horaires à la demande";
	$lang_majoration_horaire_demande = "Majoration de";
	
	$lang_cartes_acceptees = "Cartes de paiement acceptées :";
	$lang_modes_de_paiement = "Système de paiement : ";
	
	$lang_modifier_mes_infos = "Modifier mes informations";
	
	$lang_plus_de_navette_dispo = "Il n'y a plus de navette disponible.<br />Pour en savoir plus, n'hésitez pas à nous <a href='contact.php'>contacter</a>.";
	$lang_veuillez_choisir_une_navette = "Merci de choisir l'une des navettes disponibles.";
	$lang_navettes_disponibles = "Navettes disponibles";
	$lang_texte_info_accueil = "<span style='font-weight:bold;'>Shopping Shuttle</span> vous accompagne depuis Strasbourg<br>jusqu'à vos <span style='font-weight:bold;'>centres outlet</span> préférés.";
	$lang_navette = "Navette";
	$lang_personnes = "personnes";
	$lang_choisir = "Choisir";
	
	// Page Tarifs
	$lang_aller_retour = "aller-retour";
	$lang_tarif_par_personne = "Par personne";
	$lang_tarif_minimum = "Tarif";
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
	$lang_texte_contact_gauche = "Avant de nous contacter, merci de vérifier que <span style='font-weight:bold;'>vous n'êtes pas</span> dans un des cas suivants :<br /> 
	<ul>
		<li>Pour laisser votre avis sur notre service, il y a le <a href='../aeroport/livreor.php'>livre d'or</a>.</li>

		<li>Toutes les réservations s'effectuent en ligne via le <a href='reservation.php'>formulaire de réservation</a>.</li>
	</ul>
	";
	$lang_texte_contact_droite = "Si vous éprouvez des difficultés pour réserver, n'hésitez pas à nous contacter.
	<ul>
		<li>Par téléphone, de 9h00 à 12h00 et de 14h00 à 17h00<br><span style='font-weight:bold;'>03 88 22 22 71</span></li>

		<li>En cas d'urgence<br><span style='font-weight:bold;'>06 27 18 12 52</span></li>
		
		<li>Espace Alsace-Navette<br>2 Rue du Coq<br>67000 Strasbourg FRANCE</li>
	</ul>
	";
	$lang_formulaire_contact = "Formulaire de contact";
	$lang_motif = "Motif";
	$lang_message = "Message";
	$lang_renseignement = "Renseignement";
	$lang_probleme_technique = "Problème technique";
	$lang_partenariat = "Partenariat";
	$lang_champs_requis = "Champs obligatoires";
	$lang_envoyer = "Envoyer";
	$lang_donnees_incorrectes = "Données incorrectes";
	$lang_erreur_champ_vide = "Vous devez remplir tous les champs !";
	$lang_contact_ok = "Votre message a bien été envoyé";
	$lang_contact_erreur = "Une erreur est survenue pendant l'envoi de votre message";
	$lang_mail_invalide = "L'adresse email n'est pas valide";

	// Page validation
	$lang_recap_commande = "Récapitulatif de la commande";
	$lang_nous_vous_cherchons_a = "Nous vous cherchons à";
	$lang_a_heure_min = "à";
	$lang_et_vous_deposons_a = "Et vous déposons à";
	$lang_mode_paiement = "Modes de paiement";
	$lang_cout_du_trajet = "Coût du trajet";
	$lang_majoration_domicile = "Majoration domicile";
	$lang_majoration_demande = "Majoration horaires à la demande";
	$lang_total = "Total";
	$lang_par_personne = "par personne";
	$lang_nombre_personnes = "Nombre de personnes";
	$lang_dont = "dont";
	$lang_enfants = "enfant(s)";
	$lang_confirmation = "Votre réservation a bien été prise en compte et a été ajoutée à notre liste d'attente !";
	$lang_explication_capacite = "Il n'y a plus de places dans cette navette !";
	$lang_explication_confirmation = "Mais vous pouvez confirmer votre réservation sans payer.<br>Vous serez ainsi sur liste d'attente et nous vous recontacterons si des places se libèrent.";
	$lang_retour_accueil = "Revenir à l'accueil";
	$lang_intro_erreur_ca = "Une erreur est survenue lors de votre tentative de paiement";
	$lang_fin_erreur_ca = "Merci de bien vouloir rééssayer.";
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
	$lang_validation_commande = "Merci ! Votre commande a été validée !";
	$lang_dl_facture = "Télécharger la facture";
	$lang_commande_annulee = "Votre commande a été annulée !";
	
	// Page annulation
	$lang_vous_avez_annule = "Vous avez annulé votre demande";
	
	// Page "Nos services"
	$lang_reserver = "Réservez votre journée !";
	$lang_texte_metzingen = "A l’occasion de la Fête Nationale, <span style='font-weight:bold;'>OUTLETCITY METZINGEN</span> et <span style='font-weight:bold;'>Shopping Shuttle</span> s’associent. Ils vous attendent pour une séance de shopping le <span style='font-weight:bold;'>14 juillet 2015</span> avec des remises jusqu’à 50 % au prix outlet. Pour vous souhaiter la bienvenue, vous recevrez un verre de vin mousseux et un bretzel à l’office du tourisme de Metzingen (sous présentation d’un coupon). Nous nous réjouissons de votre visite ! 

		<ul>
			<li>Plus de 70 marques haut de gamme et de luxe</li>
			<li>Situé à seulement 30 minutes de Stuttgart</li>
			<li>Très large gamme de produits</li>
		</ul>

		<ul>
			<li>Ville natale de Hugo Boss</li>
			<li>Outlets phares à l’architecture primée</li>
			<li>Expérience shopping extraordinaire avec des événements exclusifs</li>
		</ul>";
	$lang_after_work = "After Work";
	$lang_shopping_day = "Shopping Day";
	$lang_entre_amis = "Entre amis";
	$lang_entre_collegues = "Entre collègues";
	$lang_cohesion_equipe = "Cohésion d'équipe";
	$lang_horaires_tarifs = "Horaires & tarifs";
	$lang_depart = "Départ";
	$lang_soit_pour = "soit pour";
	$lang_supplement = "Supplément";
	
	// Facture
	$lang_facture = "Facture";
	$lang_facture_a = "Facturé a :";
	$lang_a = "à";
	$lang_le = "le";
	$lang_le_maj = "Le";
	$lang_vers = "vers";
	$lang_description_trajet = "Description du trajet :";
	$lang_total_ht = "Total HT";
	$lang_total_tva = "Total TVA";
	$lang_total_ttc = "Total TTC";
	$lang_confiance = "Merci de votre confiance !";
	
	// Page charte
	$lang_texte_charte = "Soucieux de vous fournir un service dont la qualité est irréprochable, nous nous soumettons à des règles très strictes constituants notre charte de qualité. Ces règles sont propres à notre structure et démontrent à nos clients voyageurs l'importance que nous accordons à leur bien-être.
		
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
		
	// Page mentions légales
	$lang_texte_mentions = "<strong>- Le présent site est la propriété de l’Association franco iranienne d’Alsace.</strong>
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
        
        Numero de licence de transport de personnes :
        <br />
        Licence n°".get_num_licence()."
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
		
	// Page Conditions générales
	$lang_texte_conditions = "<strong>Cond. 1 : Service </strong>
        <br />
    	Alsace navette shopping est un service proposé par l’association franco iranienne d’Alsace, à ses adhérents. Les tarifs incluent donc la cotisation annuelle de l’association. 
        
        <br /><br />
   		<strong>Cond. 2 : Réservation </strong>
        <br />
    	Vous pouvez effectuer votre demande de réservation en ligne 24h/24 et 7j/7.
		Un mail vous sera alors adressé pour confirmer votre trajet : date, heure, type de véhicule, durée et distance.  Vous devrez vérifier les informations figurant sur le mail de confirmation qui prévaudra comme contrat de transport.
        <br />
    	Sur demande, une facture au format PDF pourra vous être envoyée. 
        
        <br /><br />
    	<strong>Cond. 3 : Départ/arrivée au domicile/bureau</strong>
        <br />
    	Les horaires de départs ou d’arrivées au domicile ou au bureau se font selon le planning de la tournée. Un mail vous confirmera l’heure de passage de la navette.
        <br />
    	Le service sera facturée ";

        $lang_texte_conditions_1 = " € par trajet sur Strasbourg et devra être payé à la réservation. 
		
        <br /><br />
    	<strong>Cond. 4 : Tarifs</strong>
        <br />
    	Les tarifs comprennent la réservation, le transport, la prise en charge de vos bagages et l'adhésion à l'association.
        <br />
    	Les bagages sont limités à une valise et un bagage à main par passager. Au-delà, un supplément de 3 € par petits et 5 € par grands bagages sera facturé. Ce supplément devra être régler directement au chauffeur lors de la prise en charge.
        
        <br /><br />
    	<strong>Cond. 5 : Retard</strong>
        <br />
    	Au départ : Malgré tous les soins apportés par nos services afin de vous assurer un voyage confortable et agréable, il se peut que des causes indépendantes de notre volonté puissent causer un retard.
        <br />
    	A l’arrivée : Tout retard à l'embarquement sur la navette, impliquant l’attente de la navette, vous sera facturé 20 € l’heure. Cette somme devra être réglée directement au chauffeur lors de la prise en charge. 
        
        <br /><br />
        <strong>Cond. 6 : Absence</strong>
        <br />
        En cas d’absence des passagers au lieu indiqué, la prestation restera facturée.
        
        <br /><br />
        <strong>Cond. 7 : Annulation</strong>
        <br />
        La réservation est définitive et ne donne droit à aucun remboursement. Alsace navette se réserve le droit de proposer un geste commercial pour les annulations motivées effectuées plus de 10 jours avant la date de départ.
        
        <br /><br />
        <strong>Cond. 8 : Animaux</strong>
        <br />
        Les animaux domestiques de petite taille (poids inférieur à 6 kg) devront être transportés dans un panier ou un sac fermé. Pour les chiens de grande taille, ils devront être muselés et ne doivent pas gêner les autres passagers. Un supplément de 5 € par animal sera facturé et devra être réglé directement au chauffeur lors de la prise en charge. 
        
        <br /><br />
        <strong>Cond. 9 : Responsabilité</strong>
        <br />
        La responsabilité du transporteur ne peut dépasser le remboursement du transport payé.
        
        <br /><br />
        <strong>Cond. 10 : Jours fériés et week-ends</strong>
        <br />
        La navette circule les week-ends et jours fériés. 
		
        <br /><br /><br>

        <strong>En cas d'urgence, téléphonez au 06 27 18 12 52</strong>";
?>