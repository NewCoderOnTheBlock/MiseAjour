<?php


require_once(dirname(__FILE__) . "/../../../includes/fonctions.php");
require_once(dirname(__FILE__) . "/../../../libs/db.php");


/*$sql_tous_les_trajets = query("SELECT DATE_FORMAT(l.heure, '%Hh%i') AS heure, (SELECT identifiant_tel FROM aeroport_pays WHERE id_pays = c.ind_port) AS ind_port, c.tel_port, c.id_pays,
                                h.nom AS nomChauffeur, h.prenom AS prenomChauffeur, h.portable
                            FROM aeroport_trajet t, aeroport_ligne_resa l, aeroport_client c, aeroport_reservation r, chauffeur h
                            WHERE DATE_FORMAT(t.date, '%d-%m-%Y') = DATE_FORMAT(DATE_ADD(NOW(), INTERVAL 1 DAY), '%d-%m-%Y')
                            AND l.id_res = r.id_res
                            AND r.id_client = c.id_client
                            AND l.id_trajet = t.id_trajet
                            AND h.idchauffeur = t.id_chauffeur
                            AND t.estValide = 1
                            ");
*/
/**
 * 
 * Prise en compte de la langue lors de la redaction du formulaire
 * pour l'envoie du sms dans la meme langue grace a la variable
 * r.session_lang.
 *  
 * Modification Marc
 * **/
$sql_tous_les_trajets = query("SELECT DATE_FORMAT(l.heure, '%Hh%i') AS heure, (SELECT identifiant_tel FROM aeroport_pays WHERE id_pays = c.ind_port) AS ind_port, c.tel_port, c.id_pays,
                                h.nom AS nomChauffeur, h.prenom AS prenomChauffeur, h.portable,r.session_lang
                            FROM aeroport_trajet t, aeroport_ligne_resa l, aeroport_client c, aeroport_reservation r, chauffeur h
                            WHERE DATE_FORMAT(t.date, '%d-%m-%Y') = DATE_FORMAT(DATE_ADD(NOW(), INTERVAL 1 DAY), '%d-%m-%Y')
                            AND l.id_res = r.id_res
                            AND r.id_client = c.id_client
                            AND l.id_trajet = t.id_trajet
                            AND h.idchauffeur = t.id_chauffeur
                            AND t.estValide = 1
                            ");
/* requete a garder et taper dans phpmysql en pensant en changeant la date
							$sql_tous_les_trajets = query("SELECT DATE_FORMAT(l.heure, '%Hh%i') AS heure, (SELECT identifiant_tel FROM aeroport_pays WHERE id_pays = c.ind_port) AS ind_port, c.tel_port, c.id_pays,
                                h.nom AS nomChauffeur, h.prenom AS prenomChauffeur, h.portable,r.session_lang
                            FROM aeroport_trajet t, aeroport_ligne_resa l, aeroport_client c, aeroport_reservation r, chauffeur h
                            WHERE DATE_FORMAT(t.date, '%d-%m-%Y') = '27-04-2010'
                            AND l.id_res = r.id_res
                            AND r.id_client = c.id_client
                            AND l.id_trajet = t.id_trajet
                            AND h.idchauffeur = t.id_chauffeur
                            AND t.estValide = 1
                            ");
*/						
while($row = $sql_tous_les_trajets->fetch())
{
/**
 * 
 * Prise en compte de la langue lors de la redaction du formulaire
 * pour l'envoie du sms dans la meme langue grace a la variable
 * r.session_lang.
 *  
 * Modification Alexandre
 * **/
   switch($row['session_lang']){
    
    case 'fr' :
        $txt_sms = "Alsace navette vous rappelle que vous avez une navette demain à " . $row['heure'].". " . $row['prenomChauffeur'] . " " . $row['nomChauffeur'] . " (" . $row['portable'] . ") sera votre conducteur.";
    break;
    
    case 'en' :
        $txt_sms = "Alsace navette recalls you that your tomorrow's shuttle is at " . $row['heure'].". " . $row['prenomChauffeur'] . " " . $row['nomChauffeur'] . " (" . $row['portable'] . ") will be your driver.";
    break;
   
    case 'ger' :
        $txt_sms = "Alsace navette recalls you that your tomorrow's shuttle is at " . $row['heure'].". " . $row['prenomChauffeur'] . " " . $row['nomChauffeur'] . " (" . $row['portable'] . ") will be your driver.";
    break;
    
    case 'tur' :
        $txt_sms = "Alsace navette recalls you that your tomorrow's shuttle is at " . $row['heure'].". " . $row['prenomChauffeur'] . " " . $row['nomChauffeur'] . " (" . $row['portable'] . ") will be your driver.";
    break;        
    
    case 'rus' :
        $txt_sms = "Alsace navette recalls you that your tomorrow's shuttle is at " . $row['heure'].". " . $row['prenomChauffeur'] . " " . $row['nomChauffeur'] . " (" . $row['portable'] . ") will be your driver.";
    break;
    
    default  :
        $txt_sms = "Alsace navette recalls you that your tomorrow's shuttle is at " . $row['heure'].". " . $row['prenomChauffeur'] . " " . $row['nomChauffeur'] . " (" . $row['portable'] . ") will be your driver.";
    break;    
    
   }
    
    
    /*
    // mail et sms en français
    if($row['id_pays'] == 66)
    {
        $txt_sms = "Alsace navette vous rappelle que vous avez une navette demain à " . $row['heure'].". " . $row['prenomChauffeur'] . " " . $row['nomChauffeur'] . " (" . $row['portable'] . ") sera votre conducteur.";
    }
    else // en anglais
    {
        $txt_sms = "Alsace navette recalls you that your tomorrow's shuttle is at " . $row['heure'].". " . $row['prenomChauffeur'] . " " . $row['nomChauffeur'] . " (" . $row['portable'] . ") will be your driver.";
    }
*/


    //$url_sms = "http://sms.beta.orange-api.net/sms/sendSMS.xml?id=aa99c837828&to=". $row['ind_port'] . $row['tel_port'] . "&content=" . urlencode($txt_sms);
	
	/**lignes "print" a laisser dans le cas dune verification pour voir les sms qui seront envoyé la veille***/
	//print($row['ind_port'] . $row['tel_port'] . "&content=" . urlencode($txt_sms));
	//print("<br />");
	$url_sms = "http://sms.beta.orange-api.net/sms/sendSMS.xml?id=aa99c837828&to=". $row['ind_port'] . $row['tel_port'] . "&content=" . urlencode($txt_sms);
    file_get_contents($url_sms);

}





?>
