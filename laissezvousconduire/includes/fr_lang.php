<?php
	/*
		Fichier de langage : Francais
		
		Le fichier ?_lang est inclue dans les pages 
		en fonction de $_SESSION['lang'] (Qui lui peut etre modifi� en fonction des cookies)
	*/
	
	/*
		Titre de pages
	*/
	
	$lang_titre_main = "Laissez vous conduire";
	$lang_titre_accueil = "Accueil";
	$lang_titre_informations = "Informations";
	$lang_titre_tarifs = "Tarifs";
	$lang_titre_contact = "Contact";
	$lang_titre_validation = "Validation et paiement";
	$lang_titre_annulation_paypal = "Annulation de demande";
	$lang_titre_confirmation_paypal = "Confirmation de la r�servation";
	$lang_titre_mentions = "Mentions l�gales";
	$lang_titre_conditions = "Conditions g�n�rales de ventes";
	$lang_titre_charte = "Charte de qualit�";
	
	/*
		Variables diverses
	*/	
	
	// Mail de paiement
	$lang_sujet_mail_paiement = "Paiement d'une navette pour LaissezVousConduire";
	$lang_contenu_mail_paiement_1 = "<html><head></head><body>Bonjour,<br /><br />Nous avons bien recu votre paiement de ";
	$lang_contenu_mail_paiement_2 = " �. Votre navette est donc confirm�e.<br /><br />Vous pouvez t�l�charger votre facture ici : <a href='http://alsace-navette.com/laissezvousconduire/gen_facture.php?f=";
	$lang_contenu_mail_paiement_3 = "'>Votre facture</a><br /><br />Alsace-navette vous souhaite un agr�able voyage !</body></html>";
    
	// Page R�servation
	$lang_effectuez_reservation = "Formulaire de demande<br /><br />Effectuez votre r�servation d�s maintenant !";
	$lang_vos_informations = "Vos informations";
	$lang_le_trajet = "Le trajet";
	
	$lang_nom = "Nom";
	$lang_prenom = "Prenom";
	$lang_adresse = "Adresse";
	$lang_ville = "Ville";
	$lang_code_postal = "Code postal";
	$lang_pays = "Pays";
	$lang_num_telephone_fixe = "T�l�phone fixe";
	$lang_num_telephone_port = "T�l�phone portable";
	$lang_email = "E-Mail";
	$lang_verif_email = "Confirmation E-Mail";
	
	$lang_date = "Date";
	$lang_date_aller = "Date de l'aller";
	$lang_date_retour = "Date du retour";
	$lang_heure_aller = "Heure de prise � Strasbourg (Ou domicile)";
	$lang_heure_retour = "Heure de prise";
	$lang_lieu_aller = "Lieu de prise";
	$lang_lieu_retour = "Lieu de d�pot";
	$lang_info_complementaires = "Informations compl�mentaires";
	
	$lang_type_vehicule = "Type de v�hicule";
	$lang_places = "places";
	
	$lang_aller = "Aller";
	$lang_retour = "Retour";
	$lang_duree_estimee = "Dur�e estim�e";
	$lang_minutes = "minutes";
	$lang_validation = "Validation";
	$lang_demande_particuli�re = "Demande particuli�re";
	$lang_valider = "Valider";
	$lang_verifier = "V�rifier";
	$lang_etape_suivante = "Etape suivante";
	$lang_lu_accepte_cgv = 'J\'ai lu et j\'accepte les <a href="conditions.php" target="_blank">conditions g�n�rales de ventes</a>';
	$lang_nombre_personnes = "Nombre de personnes";
	
	$lang_champ_obligatoire = "Champ obligatoire";
	$lang_champ_semi_obligatoire = "L'un des deux champ doit �tre rempli";
	
	$lang_horaire_fixe = "Horaires fixes";
	$lang_horaire_demande = "Horaires � la demande";
	$lang_majoration_horaire_demande = "Majoration de";
	
	$lang_cartes_acceptees = "Cartes de payement accept�es :";
	$lang_modes_de_paiement = "Syst�me de paiement : ";
	
	$lang_modifier_mes_infos = "Modifier mes informations";
	
	// Page Tarifs
	$lang_nb_personne_forfait_min = "Nombre de personnes du forfait minimum";
	$lang_par_personne = "Par personne";
	$lang_tarif_minimum = "Tarif minimum";
	$lang_aller_retour = $lang_aller."-".$lang_retour;
	$lang_meme_jour = "M�me jour";
	$lang_jour_different = "Jours diff�rents";
	
	// Page informations 
	$lang_horaires_ouverture = "Horaires d'ouverture d'Europa Park";
	$lang_saison_estivale = "Saison estivale";
	$lang_saison_hivernale = "Saison hivernale";
	
	$lang_horaire_estivale = "
	Saison estivale 2012: <br />
	Horaires d'ouverture �t� 2012:<br />
	31.03.2012 - 04.11.2012<br />
	tous les jours de 09h00 � 18h00<br />
	horaire prolong� pendant la haute saison) ";
	
	$lang_horaire_hivernale = "
	Saison hivernale 2012/13:<br />
	Horaires d'ouverture hiver :<br />
	24.11.2012 - 06.01.2013<br />
	tous les jours de 11h00 � 19h00<br />
	(horaire prolong� pendant les week-ends et les vacances)<br />
	Ferm� le 24 + 25.12.2012 ";
	
	$lang_plus_d_info = "Pour plus d'informations, <a target=\"blank_\" href=\"http://www.europapark.com/lang-fr/Infos-et-services/Dates-horaires-douverture/c270.html\">cliquez ici</a>";
	$lang_informations_complementaires = "Informations compl�mentaires";
	$lang_texte_info_compl = "
	<ul>
		<li>Le temps de trajet est estim� � 45 minutes depuis le centre de Strasbourg.</li>";
		if (get_value_of_option('maj_domicile') > 0){
			$lang_texte_info_compl .= "<li>La prise ou d�p�t � domicile est major� d'un montant de ".get_value_of_option('maj_domicile')." �.</li>";
		}
		if (get_value_of_option('maj_hors_stras_par_km') > 0){
			$lang_texte_info_compl .= "<li>La prise ou d�p�t � domicile hors Strasbourg est major� d'un montant de ".get_value_of_option('maj_hors_stras_par_km')." �.</li>";
		}
		if (get_value_of_option('supplement_differe') > 0){
			$lang_texte_info_compl .= "<li>Une majoration d'un montant de ".get_value_of_option('supplement_differe')." � est effectu�e si la date de Retour s'effectue une jour diff�rent que la date d'Aller.</li>";
		}
		$lang_texte_info_compl .= "
	</ul>
	";
	
	// Page contact
	$_lang_texte_contact = "Pour nous contacter, il y a plusieurs possibilit�s, mais v�rifiez bien que vous n'�tes pas dans un des cas suivant :<br /> 
	<ul>
		<li>Notre service vous pla�t, et vous souhaitez nous remercier. Dans ce cas, il y a le livre d'or.</li>

		<li>Vous voulez r�server. Toutes les r�servations se font en ligne, nous n'en effectuons pas par t�l�phone. N�anmoins, si vous avez des difficult�s � r�server, si vous n'avez pas d'acc�s � internet, vous pouvez nous contacter via les moyens ci-dessous.</li>
	</ul>
	Pour nous contacter, vous avez diff�rents moyens � votre disposition :
	<ul>
		<li>Passer � nos bureaux : AFI Alsace 2, Rue du Coq 67000 Strasbourg FRANCE</li>

		<li>Par t�l�phone, au 03 88 22 22 71, de 9h00 � 12h00 et de 14h00 � 18h00</li>

		<li>En cas d'urgence, au 06 27 18 12 52</li>

		<li>Par email, � l'adresse <a href=\"info@alsace-navette.com\">info@alsace-navette.com</a></li>
	</ul>
";
	
	
	// Page validation
	$lang_recap_commande = "R�capitulatif de la commande";
	$lang_nous_vous_cherchons_a = "Nous vous cherchons �";
	$lang_a_heure_min = "�";
	$lang_soit = "soit";
	$lang_et_vous_deposons_a = "Et vous d�ponsons �";
	$lang_mode_paiement = "Mode de paiement";
	$lang_cout_du_trajet = "Co�t du trajet";
	$lang_majoration_jour_different = "Majoration jours diff�rents";
	$lang_majoration_domicile = "Majoration domicile";
	$lang_majoration_demande = "Majoration horaires � la demande";
	$lang_total = "Total";
	$lang_taille_du_vehicule = "Taille du v�hicule";
	$lang_places = "places";
	$lang_par_personne = "par personne";
	
	// Page annulation
	$lang_vous_avez_annule = "Vous avez annul� votre demande";
	
	// Page charte
	$lang_texte_charte = "Soucieux de vous fournir un service dont la qualit� est irr�prochable, nous nous soumettons � des r�gles tr�s strictes constituants notre charte de qualit�. Ces r�gles sont propres � notre structure et d�montrent � nos clients voyageurs l'importance que nous accordons � leur bien-�tre.
		
       <br /><br />
       <strong>Charte 1 : S�curit�
       <br /><br />
       Charte 2 : Minimiser le temps d�attente :</strong>
       <br /><br />
       - Nous vous signalons le moindre retard par SMS.
       <br /><br />
       - L�attente au point de rendez-vous fix� ne d�passera pas les 15 minutes.
       <br /><br />
       
       <strong>
       Charte 3 : Facilit� d�acc�s au service
       <br /><br />
       Charte 4 : Confort des personnes
       <br /><br />
       Charte 5 : Suivi de commande
       <br /><br />
       Charte 6 : Joignabilit� de notre soci�t�
       <br /><br />
       Charte 7 : A l��coute des besoins du client
       <br /><br />
       Charte 8 : Formation de nos employ�s
       <br /><br />
       Charte 9 : Le meilleur rapport qualit�/prix
       <br /><br />
       Charte 10 : Exigences d�une �conomie sociale et solidaire
       <br /><br />
       Charte 11 : Respect de l�environnement
       <br /><br />
       Charte 12 : Service de proximit�
       <br /><br />
       Alsace Navette participe � un <a href=\"http://www.solidaire.alsace-navette.com\">projet d'�conomie sociale et solidaire</a>.
		</strong>";
		
	// Page mentions l�gales
	$lang_texte_mentions = "<strong>- Le pr�sent site est la propri�t� de l�Association franco iranienne d�Alsace</strong>
        <br />
    	<br />
        2 Rue du Coq
        <br />
        67000 Strasbourg
        <br />
        N� SIRET 47767406300037
        <br />
        Code NAF : 9499Z
        <br /><br />
        
        Numero de licence de transport de personnes :
        <br />
        Licence n�2007/42/0000784
        <br /><br />
        
        Nom du site : <a href=\"http://www.alsace-navette.com\">www.alsace-navette.com</a>
        <br />
        <br />
        <strong>- L�h�bergeur du site est :</strong>
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
        <strong>- Droit d'acc�s aux donn�es :</strong>
        <br />
        <br />
        Vous disposez d'un droit d'acc�s et de rectification de vos donn�es personnelles. Ceci en nous adressant un <a href=\"mailto:info@alsace-navette.com\">courrier �lectronique</a>. Le d�lai sera d'environ un mois.
        
        <br />
        <br />
        En cas d'urgence, t�l�phonez au 06 27 18 12 52.";
		
	// Page Conditions g�n�rales
	$lang_texte_conditions = "<strong>Cond. 1 : Service </strong>
        <br />
    	Alsace navette a�roport est un service propos� par l�association franco iranienne d�Alsace, � ses adh�rents. Les tarifs incluent donc la cotisation annuelle de l�association. 
        
        <br /><br />
   		<strong>Cond. 2 : R�servation </strong>
        <br />
    	Vous pouvez effectuer votre demande de r�servation en ligne 24h/24 et 7j/7.
		Un mail vous sera alors adress� pour confirmer votre trajet selon les informations fournies : date, heure, type de v�hicule, dur�e et distance. .Vous devrez v�rifier les informations figurant sur le mail de confirmation qui pr�vaudra comme contrat de transport.
        <br />
    	Sur demande, une facture au format PDF pourra vous �tre envoy�e. 
        
        <br /><br />
    	<strong>Cond. 3 : D�part/arriv�e au domicile/bureau</strong>
        <br />
    	Les horaires de d�parts ou d�arriv�es au domicile ou au bureau se font selon le planning de la tourn�e. Un mail vous confirmera l�heure de passage de la navette.
        <br />
    	Le service sera factur�e ";

        $lang_texte_conditions_1 = " � par trajet sur Strasbourg et devra �tre pay� � la r�servation. 
		
        <br /><br />
    	<strong>Cond. 4 : Tarifs</strong>
        <br />
    	Les tarifs comprennent la r�servation, le transport, la prise en charge de vos bagages et l'adh�sion � l'association.
        <br />
    	Les bagages sont limit�s � une valise et un bagage � main par passager. Au-del�, un suppl�ment de 3 � par petits et 5 � par grands bagages sera factur�. Ce suppl�ment devra �tre r�gler directement au chauffeur lors de la prise en charge.
        
        <br /><br />
    	<strong>Cond. 5 : Retard</strong>
        <br />
    	Au d�part : Malgr� tous les soins apport�s par nos services afin de vous assurer un voyage confortable et agr�able, il se peut que des causes ind�pendantes de notre volont� puissent causer un retard. De ce fait, nous vous rappelons qu�il est n�cessaire de pr�voir votre arriv�e � l�a�roport au moins 3 heures avant votre d�collage, pour pouvoir effectuer l�ensemble des formalit�s d�enregistrement et d�embarquement. Nous vous conseillons aussi de souscrire une assurance voyage car, en cas de retard, nous d�clinons toutes responsabilit�s. 
        <br />
    	A l�arriv�e : Tout retard � l'embarquement sur la navette, impliquant l�attente de la navette, vous sera factur� 20 � l�heure. Il devra �tre r�gler directement au chauffeur lors de la prise en charge. Une facture vous sera fournie, afin que vous puissiez la pr�senter � votre compagnie a�rienne ou assureur pour remboursement. 
        
        <br /><br />
        <strong>Cond. 6 : Absence</strong>
        <br />
        En cas d�absence des passagers au lieu indiqu�, la prestation restera factur�e.
        
        <br /><br />
        <strong>Cond. 7 : Annulation</strong>
        <br />
        La r�servation est d�finitive et ne donne droit � aucun remboursement. Alsace navette se r�serve pour les annulations motiv�es effectu�es � plus de 10 jours avant la date de d�part de proposer un geste commercial.
        
        <br /><br />
        <strong>Cond. 8 : Animaux</strong>
        <br />
        Les animaux domestiques de petite taille (poids inf�rieur � 6 kg) devront �tre transport�s dans un panier ou un sac ferm�. Pour les chiens de grande taille, ils devront �tre musel�s et ne doivent pas g�ner les autres passagers. Un suppl�ment de 5 � par animal sera factur� et devra �tre r�gl� directement au chauffeur lors de la prise en charge. 
        
        <br /><br />
        <strong>Cond. 9 : Responsabilit�</strong>
        <br />
        La responsabilit� du transporteur ne peut d�passer le remboursement du transport pay� .
        
        <br /><br />
        <strong>Cond. 10 : Jours f�ri�s et week-ends</strong>
        <br />
        La navette circule les week-ends et jours f�ri�s. 
		
        <br /><br />
		<strong>Cond. 11 : Annulation</strong>
		<br />
		La r�servation est d�finitive et ne donne droit � aucun remboursement. Alsace navette se r�serve pour les annulations motiv�es effectu�es � plus de 10 jours avant la date de d�part de proposer un geste commercial. 
		
        <br /><br /><br />
        <strong>En cas d'urgence, t�l�phonez au 06 27 18 12 52</strong>";
?>