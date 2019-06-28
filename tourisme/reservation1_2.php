<?php

$circuit=$_POST['typeTrajet'];  //type de trajet aller simple, ou aller retour

$jour_depart=$_POST['jour_depart']; // jour de départ
$varDepartAnglais = substr($jour_depart, 6, 4)."-".substr($jour_depart, 3, 2)."-".substr($jour_depart, 0, 2);
$h_dep = $_POST['heure_depart'];
			
$nb_personnes = $_POST['nb_personnes'];// nombre de personnes pour la réservation
$nb_enfant = $_POST['nb_enfant'];
$demande_particuliere = $_POST['demande_particuliere']; // demande particulière pour un ramassage à domicile
		
$civilite = $_POST['civilite'];
		
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
		
$n_voie = $_POST['n_voie'];
$type_voie = $_POST['type_voie'];		
$nom_voie = $_POST['nom_voie'];
$code_postal = $_POST['code_postal'];
$ville = $_POST['ville'];
$pays = $_POST['pays'];
$adresse = $n_voie." ".$type_voie." ".$nom_voie." ".$code_postal." ".$ville;
$pt_dep = $_POST['pt_dep'];

		
$e_mail=$_POST['e_mail'];
		
$telephone = $_POST['telephone'];
$portable = $_POST['portable'];

$prix = $_POST['prix'];
$prixtot = $_POST['prixtot'];
$cir_q =$_POST['questioncircuit'];		
	
$db = mysql_connect('db922.1and1.fr', 'dbo206617947', 'D5ZEtV4h');
//$db = mysql_connect('localhost', 'root', '');
// on sélectionne la base
mysql_select_db('db206617947',$db);
//mysql_select_db('tourisme',$db);
		
$jour = date("j");
$mois = date("m");
$annee = date("Y");
$dte = $annee."-".$mois."-".$jour;  // date du jour 	

$heure = date("H").":".date("i");																					

$sql = "INSERT INTO formulaire_tourisme (civilite , nom , prenom , e_mail , telephone , portable, n_voie , type_voie , nom_voie , code_postal , ville ,  circuit ,  d_depart , h_depart , nb_personnes ,demande , date , heure , nb_enfant , pays , pt_dep , prix_total) VALUES ('$civilite' , '$nom' , '$prenom' , '$e_mail' , '$telephone' , '$portable', '$n_voie' , '$type_voie' , '$nom_voie' , '$code_postal' , '$ville' , '$circuit' ,  '$varDepartAnglais' , '$h_dep' , '$nb_personnes' , '$demande_particuliere' , '$dte' , '$heure' , '$nb_enfant' , '$pays' , '$pt_dep' , '$prixtot')"; 

mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());

mysql_close();


$message1 = "";

$message1 .= "Nom : ".$civilite." ".$nom." ".$prenom."\n";
$message1 .= "Email : ".$e_mail."\n";

if($telephone <> "")
{
$message1 .= "Telephone : ".$telephone."\n";
}

if($portable <> "")
{
$message1 .= "Portable : ".$portable."\n";
}

$message1 .= "circuit : ".$circuit."\n";
$message1 .= "nombre de personnes :".$nb_personnes." \n";
$message1 .= "dont enfants :".$nb_enfant."\n";

$message1 .= "date : ".$jour_depart."\n";

if($nom_voie <> "")
{
$message1 .= "adresse : ".$adresse."\n";
}

if ($demande_particuliere <> "")
{
$message1 .= "demande particulière: ".$demande_particuliere."\n";
}

$message1 .= "prix total: ".$prixtot."\n";

$message1 .= "reponse a la question : ou avez vous connu les circuit? : ".$cir_q;

$destinataire = "info@alsace-navette.com";
$titre = "réponse au formulaire de tourisme";

if(mail($destinataire,$titre,$message1)==false)
{
	include("reservation_erreur.php");
	echo "Une erreur s'est produite";
}

$email = "$e_mail";
$titre = "Confirmation de votre demande pour un circuit ";
$message = $civilite." ".$nom." ".$prenom." \n";
$message .= "Merci de faire confiance à tourisme.alsace-navette.com \n Nous vous confirmons donc que votre demande a été prise en compte pour le circuit suivant. \n \n";

	$message .= "vous avez réservé le circuit ".$circuit." \n";
	$message .= "le départ de ".$pt_dep." est le ".$jour_depart." à ".$h_dep." \n \n ";
	$message .= "nombre de personnes :".$nb_personnes." \n";
	$message .= "dont enfants :".$nb_enfant."\n";
	if ($demande_particuliere <> "")
{
$message .= "demande particulière: ".$demande_particuliere."\n";
}
	$message .= "prix total :".$prixtot." \n";
	$message .= "notre opérateur va vous contacter rapidement pour vous préciser le mode de règlement ainsi que l'organisation du circuit conduit.  \n";

$entete  = "From : info@alsace-navette.com\n";
$entete .= ",Reply-to : info@alsace-navette.com\n";

if(mail($email, $titre, $message, $entete)==false)
{
	include("reservation_erreur.php");
	echo "Une erreur s'est produite dans l'envoi du mail";
}
else
{

$db = mysql_connect('db922.1and1.fr', 'dbo206617947', 'D5ZEtV4h');
//$db = mysql_connect('localhost', 'root', '');
// on sélectionne la base
mysql_select_db('db206617947',$db);
//mysql_select_db('tourisme',$db);

$jour = date("j");
		$mois = date("m");
		$annee = date("Y");
		$dateJ = $annee."-".$mois."-".$jour;  // date du jour pour alimenter la table réservation			

		$service ='Tourisme';	
			
		//aller
		$sql7 = "INSERT INTO vue_globale 
(nom , prenom , e_mail , telephone , portable , n_voie , type_voie , nom_voie , code_postal , ville , d_depart , h_depart , rassemblement , nb_personnes , demande , date , nb_enfant , pays , typetrajet , depart ) 
VALUES  
('$nom' , '$prenom' , '$e_mail' , '$telephone' , '$portable', '$n_voie', '$type_voie' , '$nom_voie' , '$code_postal' , '$ville' ,  '$varDepartAnglais' , '$h_dep'  , '$pt_dep' , '$nb_personnes' , '$demande_particuliere' , '$dte' , '$nb_enfant' , '$pays' , 'tourisme' , '$circuit')"; 
		mysql_query($sql7) or die('Erreur SQL !<br>'.$sql7.'<br>'.mysql_error());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Tourisme Alsace :: Reservation</title>
<meta name="Category" content="Tourisme, Voyage, Alsace, Loisirs" />
<meta name="Language" content="fr" />
<meta name="Keywords" content="tourisme , voyage, alsace , navette , alsace-navette , tourisme.alsace-navette , minibus , musée , circuit , circuit touristique , transport, transport collectif , transport personne , véhicule , visiter , visites , poterie, chocolat, pain d'épice, rhin ,kochersberg , obernai, sélestat, andlau, betschdorf, soufflenheim, kaysersberg, bergheim, haguenau, village " />
<meta name="Robots" content="all" />
<meta name="Revisit-After" content="15 days" />	
<link href="styles/tourisme.css" rel="stylesheet" type="text/css" />
<link href="styles/calendrier.css" rel="stylesheet" type="text/css" />
<!-- menu horizontal -->
<script type="text/javascript">
<!--
window.onload=montre;
function montre(id) {
var d = document.getElementById(id);
	for (var i = 1; i<=10; i++) {
		if (document.getElementById('smenu'+i)) {document.getElementById('smenu'+i).style.display='none';}
	}
if (d) {d.style.display='block';}
}
//-->
</script>
<!-- /menu horizontal -->

</head>
<body>



	<div id="page">
		<div id="corps_page_haut"> <!-- header page -->	
			<div id="titre_page">
				<h4>Bienvenue sur Alsace-Navette Tourisme !<br />
					Un service Alsace-Navette.</h4><br />
  				R&eacute;servation :: Fin :: Merci !
	  	  </div>		
			<div id="menu">
			
				<?php include('include_body/menu.html') ?>

	 		</div>
			<div id="services">
				<?php include('include_body/services.html') ?>
			</div>
		</div>
		<div id="corps_page_contenu"> <!-- contenu de la page, changeable -->		
		<!--               ///////////////////////////////////////////////////////////contenu -->
		
		  <div id="special_reservation">
											<h4>Votre réservation</h4>
												
												<p>
						  </p><br /><br />
												<b>Nous nous remercions de faire confiance à<br /> 
												tourisme.alsace-navette.com</b><br />
												Nous vous confirmons que votre demande a bien <br />
						  été prise en compte.<br />
						  Un mail avec les différents détails vient de vous<br /> 
			être envoyé.								</div>
			 
			<!-- end tete page -->

		<!--               //////////////////////////////////////////////////////fin contennu -->
		</div>
		<div id="corps_page_footer"> 
		  <div align="center">
		  <!-- footer page -->
		  <br />
		  <br />
		  <br />
		  <br />
		  &copy;Alsace-Navette.com	- <a href="mentions.php">Mentions légales</a> - <a href="contact.php">Contact</a> - <a href="conditions.php">Conditions de vente</a>	</div>
		</div>
</div>
	<div id="news">
		<div id="news_haut">
		</div>
<div id="news_contenu">
			<?php include('include_body/news.html'); ?>
		</div>		<div id="news_footer">		
		</div>
	</div>
	<div id="partenaires">
		<div id="partenaires_haut">
		</div>
		<div id="partenaires_contenu">
		<!-- ////////////partenaires -->
		
				<?php include('include_body/partenaires.html') ?>	
		
		<!-- ////////////partenaires end -->
			
		</div>	<div id="partenaires_footer">		
			</div>
	</div>
    
    <script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-7305006-1");
pageTracker._trackPageview();
} catch(err) {}</script>


</body>

</html>
<?php
		}
		?>