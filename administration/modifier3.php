<?php	
$id = $_POST['id'];
$date = $_POST['date'];
$heure = $_POST['heure'];
$personnes = $_POST['personnes'];
$trajet = $_POST['trajet'];
$depart = $_POST['depart'];
$destination = $_POST['destination'];
$heure_vol = $_POST['heure_vol'];
$n_vol = $_POST['n_vol'];
$rassemblement = $_POST['rassemblement'];
$demande = $_POST['demande'];
$date_dem = $_POST['date_dem'];
$date_paiement = $_POST['date_paiement'];
$paiement = $_POST['paiement'];
$montant = $_POST['montant'];
$civilite = $_POST['civilite'];
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$tel = $_POST['tel'];
$portable = $_POST['portable'];
$n_voie = $_POST['n_voie'];
$type_voie = $_POST['type_voie'];
$nom_voie = $_POST['nom_voie'];
$cp = $_POST['cp'];
$ville = $_POST['ville'];
$pays = $_POST['pays'];

$db = mysql_connect('db922.1and1.fr', 'dbo206617947', 'D5ZEtV4h');
mysql_select_db('db206617947',$db);
//$db = mysql_connect('localhost', 'root', '');
//mysql_select_db('navette',$db);

$sql = "UPDATE vue_globale SET d_depart='$date',h_depart='$heure',nb_personnes='$personnes',typetrajet='$trajet',depart='$depart',destination='$destination',h_vol='$heure_vol',n_vol='$n_vol',rassemblement='$rassemblement',demande='$demande',date='$date_dem',datepaiement='$date_paiement',paiement='$paiement',montant='$montant',civilite='$civilite', nom='$nom' ,prenom='$prenom', e_mail='$email', telephone='$tel', portable='$portable', n_voie='$n_voie', type_voie='$type_voie', nom_voie='$nom_voie', code_postal='$cp', ville='$ville', pays='$pays' where reservation = '$id' "; 

mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());

mysql_close();

session_destroy();

include ("accueil.php");
 
?>

