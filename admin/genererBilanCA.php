<?php
/*
	KEMPF Pierre-Louis :
	Cette page permet de générer un fichier excel afin de 
	faire un bilan de l'activité au cours d'une année/mois
*/
session_start();
include("verifAuth.php");

$annee = (isset($_POST['annee'])) ? $_POST['annee'] : date("Y");

$date_like = (isset($_POST['mois'])) ? date("Y-m", mktime(0, 0, 0, $_POST['mois'], 1, $annee)) : date("Y", mktime(0, 0, 0, 1, 1, $annee));

$nom_fichier = (isset($_POST['mois'])) ? $_POST['mois']."-".$annee : $annee;

header('Content-Type: application/csv-tab-delimited-table');
header('Content-disposition: filename=monBilan_'.$nom_fichier.'.csv');

$somme_totale = 0;
$nombre_total = 0;
$nombre_total_trajet = 0;
$nombre_passager = 0;

// connexion à la bdd
include("connection.php");

// Affichage de l'entête
echo
'"Bilan de l\'année '.$annee.'";
';

/* Nombre de trajets TOTAL */
$query = "	SELECT 	COUNT(DISTINCT vue_trajet.id) as nb_trajet
			FROM 	(	SELECT ligne.id_trajet as id
						FROM aeroport_reservation res, aeroport_ligne_resa ligne
						WHERE res.id_res = ligne.id_res
						AND ligne.est_paye = 1
						AND res.date LIKE '".$date_like."%'
					) as vue_trajet";
					
$result = mysql_query($query) or die (mysql_error());

while ($r = @mysql_fetch_assoc($result))
{ 
	$nombre_total_trajet = $r['nb_trajet'];
}

	/* Paypal */
echo
'
"Paypal";

';

// Calcul des autres données
$queryPaypal = "SELECT *, DATE_FORMAT(res.date, '%d-%m-%Y') as date_res, ligne.methode_paiement as metho, ligne.id_res as id_reserv
			FROM aeroport_reservation res, aeroport_ligne_resa ligne
			WHERE res.id_res = ligne.id_res
			AND ligne.est_paye = 1
			AND ligne.methode_paiement = 'PayPal'
			AND res.date LIKE '".$date_like."%'
			ORDER BY res.date";

$result = mysql_query($queryPaypal) or die (mysql_error());
	
$nbreq = mysql_num_rows($result);

$nombre_total_paypal = $nbreq;
$nombre_total = $nombre_total + $nombre_total_paypal;

echo
'"ID";"Date";"Methode";"Somme";
';
$somme_totale_paypal = 0;
$nombre_passager_paypal = 0;

while ($r = @mysql_fetch_assoc($result))
{ 
echo
'"'.$r['id_reserv'].'";"'.$r['date_res'].'";"'.$r['metho'].'";"'.$r['prix'].'";
';

$somme_totale_paypal = $somme_totale_paypal + $r['prix'];
$nombre_passager_paypal = $nombre_passager_paypal + $r['nb_pers'];

}

$somme_totale = $somme_totale + $somme_totale_paypal;
$nombre_passager = $nombre_passager + $nombre_passager_paypal;

echo
'
"Totaux PayPal";
"Nb. de réservations";"'.$nombre_total_paypal.'";
"Somme totale";"'.$somme_totale_paypal.'€";
"Nombre passagers";"'.$nombre_passager_paypal.'";
';

	/* E-Transactions */
echo
'
"E-transaction";

';

// Calcul des autres données
$queryCA = "SELECT *, DATE_FORMAT(res.date, '%d-%m-%Y') as date_res, ligne.methode_paiement as metho, ligne.id_res as id_reserv
			FROM aeroport_reservation res, aeroport_ligne_resa ligne
			WHERE res.id_res = ligne.id_res
			AND ligne.est_paye = 1
			AND ligne.methode_paiement = 'e-transaction'
			AND res.date LIKE '".$date_like."%'
			ORDER BY res.date";

$result = mysql_query($queryCA) or die (mysql_error());
	
$nbreq = mysql_num_rows($result);

$nombre_total_ca = $nbreq;
$nombre_total = $nombre_total + $nombre_total_ca;

echo
'"ID";"Date";"Methode";"Somme";

';

$somme_totale_ca = 0;
$nombre_passager_ca = 0;

while ($r = @mysql_fetch_assoc($result))
{ 
echo
'"'.$r['id_reserv'].'";"'.$r['date_res'].'";"'.$r['metho'].'";"'.$r['prix'].'";
';

$somme_totale_ca = $somme_totale_ca + $r['prix'];
$nombre_passager_ca = $nombre_passager_ca + $r['nb_pers'];
}

$somme_totale = $somme_totale + $somme_totale_ca;
$nombre_passager = $nombre_passager + $nombre_passager_ca;

echo
'
"Totaux E-Transaction";
"Nb. de réservations";"'.$nombre_total_ca.'";
"Somme totale";"'.$somme_totale_ca.'€";
"Nombre passagers";"'.$nombre_passager_ca.'";
';

	/* Autre */
echo
'
"Autres";
';

$somme_totale_autre = 0;
$nombre_passager_autre = 0;

while ($r = @mysql_fetch_assoc($result))
{ 
	$nombre_total_trajet_autre = $r['nb_trajet'];
	$nombre_total_trajet = $nombre_total_trajet + $nombre_total_trajet_autre;
}

// Calcul des autres données
$queryAutre = "SELECT *, DATE_FORMAT(res.date, '%d-%m-%Y') as date_res, ligne.methode_paiement as metho, ligne.id_res as id_reserv
			FROM aeroport_reservation res, aeroport_ligne_resa ligne
			WHERE res.id_res = ligne.id_res
			AND ligne.est_paye = 1
			AND ligne.methode_paiement = ''
			AND res.date LIKE '".$date_like."%'
			ORDER BY res.date";

$result = mysql_query($queryAutre) or die (mysql_error());
	
$nbreq = mysql_num_rows($result);

$nombre_total_autre = $nbreq;
$nombre_total = $nombre_total + $nombre_total_autre;

echo
'"ID";"Date";"Methode";"Somme";
';

while ($r = @mysql_fetch_assoc($result))
{ 
echo
'"'.$r['id_reserv'].'";"'.$r['date_res'].'";"'.$r['metho'].'";"'.$r['prix'].'";
';

$somme_totale_autre = $somme_totale_autre + $r['prix'];
$nombre_passager_autre = $nombre_passager_autre + $r['nb_pers'];
}

$somme_totale = $somme_totale + $somme_totale_autre;
$nombre_passager = $nombre_passager + $nombre_passager_autre;

echo
'
"Totaux Autre";
"Nb. de réservations";"'.$nombre_total_autre.'";
"Somme totale";"'.$somme_totale_autre.'€";
"Nombre passagers";"'.$nombre_passager_autre.'";
';

// Affichage des totaux
echo
'
---------------------------------------------

"Totaux généraux";
"Nb. de réservations";"'.$nombre_total.'";
"Nb. de trajets";"'.$nombre_total_trajet.'";
"Somme totale";"'.$somme_totale.'€";
"Nombre passagers";"'.$nombre_passager.'";


';


exit;
?>