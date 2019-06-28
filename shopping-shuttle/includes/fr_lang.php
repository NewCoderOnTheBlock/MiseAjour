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
	$lang_titre_contact = "Contact";
	$lang_titre_validation = "Validation et paiement";
	$lang_titre_annulation_paypal = "Annulation de demande";
	$lang_titre_confirmation_paypal = "Confirmation de la réservation";
	$lang_titre_mentions = "Mentions légales";
	$lang_titre_conditions = "Conditions générales de ventes";
	$lang_titre_charte = "Charte de qualité";
	$lang_titre_choix_navette = "Choix de la navette";
	
	/*
		Variables diverses
	*/	
	
	// Mail de paiement
	$lang_sujet_mail_paiement = "Paiement d'une navette pour le centre Outlet";
	$lang_contenu_mail_paiement_1 = "<html><head></head><body>Bonjour,<br /><br />Nous avons bien recu votre paiement de ";
	$lang_contenu_mail_paiement_2 = " €. Votre navette est donc confirmée.<br /><br />Vous pouvez télécharger votre facture ici : <a href='http://alsace-navette.com/outlet/gen_facture.php?f=";
	$lang_contenu_mail_paiement_3 = "'>Votre facture</a><br /><br />Alsace-navette vous souhaite un agréable voyage !</body></html>";
    
	// Page Réservation
	$lang_effectuez_reservation = "Formulaire de demande<br /><br />Effectuez votre réservation dès maintenant !";
	$lang_vos_informations = "Vos informations";
	$lang_le_trajet = "Le trajet";
	$lang_date = "Date";
	$lang_formule = "Formule";
	
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
	
	$lang_date_aller = "Date de l'aller";
	$lang_date_retour = "Date du retour";
	$lang_heure_aller = "Heure de prise à Strasbourg (Ou domicile)";
	$lang_heure_retour = "Heure de prise au centre Outlet";
	$lang_lieu_aller = "Lieu de prise";
	$lang_lieu_retour = "Lieu de dépot";
	$lang_info_complementaires = "Informations complémentaires";
	
	$lang_table_jour = array("Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi");
	$lang_table_mois = array("Décembre","Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre");
	$lundi ="Lundi";
	$mardi = "Mardi";
	$mercredi = "Mercredi";
	$jeudi = "Jeudi";
	$vendredi = "Vendredi";
	$samedi = "Samedi";
	$dimanche = "Dimanche";
	
	$lang_aller = "Aller";
	$lang_retour = "Retour";
	$lang_duree_estimee = "Durée estimée";
	$lang_minutes = "minutes";
	$lang_validation = "Validation";
	$lang_demande_particulière = "Demande particulière";
	$lang_valider = "Valider";
	$lang_etape_suivante = "Etape suivante";
	$lang_lu_accepte_cgv = 'J\'ai lu et j\'accepte les <a href="conditions.php" target="_blank">conditions générales de ventes</a>';
	$lang_nombre_personnes = "Nombre de personnes";
	
	$lang_champ_obligatoire = "Champ obligatoire";
	$lang_champ_semi_obligatoire = "L'un des deux champ doit être rempli";
	
	$lang_horaire_fixe = "Horaires fixes";
	$lang_horaire_demande = "Horaires à la demande";
	$lang_majoration_horaire_demande = "Majoration de";
	
	$lang_cartes_acceptees = "Cartes de payement acceptées :";
	$lang_modes_de_paiement = "Système de paiement : ";
	
	$lang_modifier_mes_infos = "Modifier mes informations";
	
	$lang_plus_de_navette_dispo = "Il n'y a plus de navette disponible.<br />Pour en savoir plus, n'hésitez pas à nous <a href='contact.php'>contacter</a>.";
	$lang_veuillez_choisir_une_navette = "Merci de choisir l'une des navettes disponibles.";
	$lang_navettes_disponibles = "Navettes disponibles";
	$lang_texte_info_accueil = "Merci de choisir à l'aide du calendrier la date disponible de votre choix. Choisissez ensuite la navette correspondant à vos besoins";
	$lang_navette = "Navette";
	$lang_personnes = "personnes";
	$lang_choisir = "Choisir";
	
	// Page Tarifs
	$lang_aller_retour = "Aller - Retour";
	$lang_tarif_par_personne = "personnes";
	$lang_tarif_minimum = "Tarif";
	$lang_tarif_est_de = "Le tarif est de ";
	$lang_tarif_soit = "Soit";
	$lang_tarif_pour_un_groupe_de = "pour un groupe de";
	$lang_tarif_pour_trajet_aller_retour = " pour un trajet aller-retour";
	$lang_tarif_info_compl = "
		<ul>
			<li>Tous les départs se font depuis Strasbourg</li>";
	if (get_value_of_option('maj_domicile') > 0){
		$lang_tarif_info_compl .= "<li>La prise ou le dépôt à domicile est majoré d'un montant de ".get_value_of_option('maj_domicile')." €.</li>";
	}
	$lang_tarif_info_compl .= '</ul>';
	
	// Page informations
	$lang_texte_info_compl = "
		<p>
			Tous les départs se font depuis Strasbourg.
			<br /><br />
			Il n'y a pas d'horaires fixes pour les navettes vers les centres Outlet.
			<br /><br />
			Il est uniquement possible de rejoindre les navettes proposées par nos services.
			<br /><br />
			Si toutefois vous ne parvenez pas à trouver une navette qui convienne à vos besoins, vous pouvez nous contacter au 03 88 22 22 71, de 9h00 à 12h00 et de 14h00 à 17h00.
		</p>
	";
	
	// Page contact
	$_lang_texte_contact = "Pour nous contacter, il y a plusieurs possibilités, mais vérifiez bien que vous n'êtes pas dans un des cas suivant :<br /> 
	<ul>

		<li>Vous voulez réserver. Toutes les réservations se font en ligne, nous n'en effectuons pas par téléphone. Néanmoins, si vous avez des difficultés à réserver, vous pouvez nous contacter via les moyens ci-dessous.</li>
	</ul>
	Pour nous contacter, vous avez différents moyens à votre disposition :
	<ul>
		<li>Passez à nos bureaux : AFI Alsace 2, rue du Coq 67000 Strasbourg FRANCE</li>

		<li>Par téléphone, au 03 88 22 22 71, de 9h00 à 12h00 et de 14h00 à 17h00</li>

		<li>En cas d'urgence, au 06 27 18 12 52</li>

		<li>Par email, à l'adresse <a href=\"info@alsace-navette.com\">info@alsace-navette.com</a></li>
	</ul>
";
	
	
	// Page validation
	$lang_recap_commande = "Récapitulatif de la commande";
	$lang_nous_vous_cherchons_a = "Nous vous cherchons à";
	$lang_a_heure_min = "à";
	$lang_et_vous_deposons_a = "Et vous déposons à";
	$lang_mode_paiement = "Mode de paiement";
	$lang_cout_du_trajet = "Coût du trajet";
	$lang_majoration_domicile = "Majoration domicile";
	$lang_majoration_demande = "Majoration horaires à la demande";
	$lang_total = "Total";
	$lang_par_personne = "par personne";
	
	// Page annulation
	$lang_vous_avez_annule = "Vous avez annulé votre demande";
	
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
	$lang_texte_mentions = "<strong>- Le présent site est la propriété de l’Association franco iranienne d’Alsace</strong>
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
        Licence n°2007/42/0000784
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
        Vous disposez d'un droit d'accès et de rectification de vos données personnelles. Ceci en nous adressant un <a href=\"mailto:info@alsace-navette.com\">courrier électronique</a>. Le délai sera d'environ un mois.
        
        <br />
        <br />
        En cas d'urgence, téléphonez au 06 27 18 12 52.";
		
	// Page Conditions générales
	$lang_texte_conditions = "<strong>Cond. 1 : Service </strong>
        <br />
    	Alsace navette aéroport est un service proposé par l’association franco iranienne d’Alsace, à ses adhérents. Les tarifs incluent donc la cotisation annuelle de l’association. 
        
        <br /><br />
   		<strong>Cond. 2 : Réservation </strong>
        <br />
    	Vous pouvez effectuer votre demande de réservation en ligne 24h/24 et 7j/7.
		Un mail vous sera alors adressé pour confirmer votre trajet selon les informations fournies : date, heure, type de véhicule, durée et distance. .Vous devrez vérifier les informations figurant sur le mail de confirmation qui prévaudra comme contrat de transport.
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
    	Au départ : Malgré tous les soins apportés par nos services afin de vous assurer un voyage confortable et agréable, il se peut que des causes indépendantes de notre volonté puissent causer un retard. De ce fait, nous vous rappelons qu’il est nécessaire de prévoir votre arrivée à l’aéroport au moins 3 heures avant votre décollage, pour pouvoir effectuer l’ensemble des formalités d’enregistrement et d’embarquement. Nous vous conseillons aussi de souscrire une assurance voyage car, en cas de retard, nous déclinons toutes responsabilités. 
        <br />
    	A l’arrivée : Tout retard à l'embarquement sur la navette, impliquant l’attente de la navette, vous sera facturé 20 € l’heure. Il devra être régler directement au chauffeur lors de la prise en charge. Une facture vous sera fournie, afin que vous puissiez la présenter à votre compagnie aérienne ou assureur pour remboursement. 
        
        <br /><br />
        <strong>Cond. 6 : Absence</strong>
        <br />
        En cas d’absence des passagers au lieu indiqué, la prestation restera facturée.
        
        <br /><br />
        <strong>Cond. 7 : Annulation</strong>
        <br />
        La réservation est définitive et ne donne droit à aucun remboursement. Alsace navette se réserve pour les annulations motivées effectuées à plus de 10 jours avant la date de départ de proposer un geste commercial.
        
        <br /><br />
        <strong>Cond. 8 : Animaux</strong>
        <br />
        Les animaux domestiques de petite taille (poids inférieur à 6 kg) devront être transportés dans un panier ou un sac fermé. Pour les chiens de grande taille, ils devront être muselés et ne doivent pas gêner les autres passagers. Un supplément de 5 € par animal sera facturé et devra être réglé directement au chauffeur lors de la prise en charge. 
        
        <br /><br />
        <strong>Cond. 9 : Responsabilité</strong>
        <br />
        La responsabilité du transporteur ne peut dépasser le remboursement du transport payé .
        
        <br /><br />
        <strong>Cond. 10 : Jours fériés et week-ends</strong>
        <br />
        La navette circule les week-ends et jours fériés. 
		
        <br /><br />
		<strong>Cond. 11 : Annulation</strong>
		<br />
		La réservation est définitive et ne donne droit à aucun remboursement. Alsace navette se réserve pour les annulations motivées effectuées à plus de 10 jours avant la date de départ de proposer un geste commercial. 
		
        <br /><br /><br />
        <strong>En cas d'urgence, téléphonez au 06 27 18 12 52</strong>";
?>