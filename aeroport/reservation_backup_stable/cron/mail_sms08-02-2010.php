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

$sql_tous_les_trajets = query("SELECT DATE_FORMAT(l.heure, '%Hh%i') AS heure, (SELECT identifiant_tel FROM aeroport_pays WHERE id_pays = r.id_pays) AS ind_port, r.telephone_passager, r.id_pays,
                                h.nom AS nomChauffeur, h.prenom AS prenomChauffeur, h.portable
                            FROM aeroport_trajet t, aeroport_ligne_resa l, aeroport_reservation r, chauffeur h
                            WHERE DATE_FORMAT(t.date, '%d-%m-%Y') = DATE_FORMAT(DATE_ADD(NOW(), INTERVAL 1 DAY), '%d-%m-%Y')
                            AND l.id_res = r.id_res
                            AND l.id_trajet = t.id_trajet
                            AND h.idchauffeur = t.id_chauffeur
                            AND t.estValide = 1");

while($row = $sql_tous_les_trajets->fetch())
{
    // mail et sms en français
    if($row['id_pays'] == 66)
    {
        $txt_sms = "Alsace navette vous rappelle que vous avez une navette demain à " . $row['heure'].". " . $row['prenomChauffeur'] . " " . $row['nomChauffeur'] . " (" . $row['portable'] . ") sera votre conducteur.";
    }
    else // en anglais
    {
        $txt_sms = "Alsace navette recalls you that your tomorrow's shuttle is at " . $row['heure'].". " . $row['prenomChauffeur'] . " " . $row['nomChauffeur'] . " (" . $row['portable'] . ") will be your driver.";
    }


    //$url_sms = "http://sms.beta.orange-api.net/sms/sendSMS.xml?id=aa99c837828&to=". $row['ind_port'] . $row['tel_port'] . "&content=" . urlencode($txt_sms);
	$url_sms = "http://sms.beta.orange-api.net/sms/sendSMS.xml?id=aa99c837828&to=". $row['ind_port'] . $row['telephone_passager'] . "&content=" . urlencode($txt_sms);
    file_get_contents($url_sms);

}





?>
