<?php

$nbr_champs=$_POST['nbrchamps'];

for($i=0;$i<$nbr_champs;$i++)
{
$email = $_POST[$i];
echo $email;
$titre = "Votre demande pour une navette";
$message = "Bonjour et merci de faire confiance aux services d’alsace navette.com.\n";
$message .= "Votre demande de réservation pour le(s) trajet(s)  ...............a (ont) bien été enregistrée.\n";
$message .= "Malheureusement, aucune navette n’étant disponible pour cette période nous ne pouvons donner suite à votre demande.\n";
$message .= "Nous éspèrons vous retrouver très prochainement parmi notre clientèle.\n\n";
$message .= "Cordialement,\n";
$message .= "www.alsace-navette.com\n";
$message .= "03 88 22 22 71 \n \n";

$entete  = "From : info@alsace-navette.com\n";
$entete .= ",Reply-to : info@alsace-navette.com\n";

if(mail($email, $titre, $message, $entete)==false)
{
	echo "Une erreur s'est produite dans l'envoi du mail";
}
else
{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

<head>

<title>envoi e-mail</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="style.css" rel="stylesheet" type="text/css" > 

</head>

<body>

<div id="container">
	<h1>Administration du site www.alsace-navette.com</h1>
	<?php
	  include("menu.php");
	  ?>
	
	<div id="centre">
	
	<h1>E-Mails envoyés aux clients  </h1>
	
	</div>
</div>

</body>

</html>
<?
}
}
?>