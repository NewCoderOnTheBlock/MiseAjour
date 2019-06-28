<?php
function est_coche($id)
{
    if(isset($id) && $id == 'on')
        return "1";
    else
        return "0";
}

include ("../admin/connection.php");


if(isset($_POST['send_sondage']))
{
	$suggestion = ($_POST['suggestion_site'] == "Suggestions pour le site..." || $_POST['suggestion_site'] == "Suggestions...") ? "" : $_POST['suggestion_site'];
	$commentaire = ($_POST['commentaire_site'] == "Commentaires..." || $_POST['commentaire_site'] == "Comments...") ? "" : $_POST['commentaire_site'];
	
    $sql = "
        INSERT INTO sondage_sondage VALUES(
        '',
        '" . $_POST['titre'] . "',
        '" . $_POST['prenom'] . "',
        '" . $_POST['nom'] . "',
        '" . $_POST['dattee'] . "',
        '" . $_POST['ville'] . "',
        '" . $_POST['pays'] . "',
        '" . $_POST['mail'] . "',
        '" . est_coche($_POST['fb']) . "',
        '" . est_coche($_POST['tw']) . "',
        '" . est_coche($_POST['vd']) . "',
        '" . est_coche($_POST['li']) . "',
        '" . est_coche($_POST['fo']) . "',
        '" . $_POST['comm_forum'] . "',
        '" . $_POST['pp'] . "',
        '" . $_POST['aeroport'] . "',
        '" . $_POST['comm_dest'] . "',
        '" . est_coche($_POST['ra_pro']) . "',
        '" . est_coche($_POST['ra_perso']) . "',
        '" . est_coche($_POST['connaissance_internet']) . "',
        '" . est_coche($_POST['connaissance_lien']) . "',
        '" . est_coche($_POST['connaissance_moteur']) . "',
        '" . $_POST['connaissance_moteur_txt'] . "',
        '" . est_coche($_POST['connaissance_reseau']) . "',
        '" . (($_POST['connaissance_reseau_lst'] == 0) ? "" : $_POST['connaissance_reseau_lst']) . "',
        '" . est_coche($_POST['connaissance_presse']) . "',
        '" . est_coche($_POST['connaissance_radio']) . "',
        '" . est_coche($_POST['connaissance_autre']) . "',
        '" . $_POST['connaissance_autre_txt'] . "',
        '" . $_POST['trouve_facilement'] . "',
        '" . $_POST['trouve_facilement_txt'] . "',
        '" . $_POST['utilise_aeroport'] . "',
        '" . $_POST['utilise_tourisme'] . "',
        '" . $_POST['utilise_lvc'] . "',
        '" . $_POST['va_utiliser'] . "',
        '" . est_coche($_POST['va_utiliser_aeroport']) . "',
        '" . est_coche($_POST['va_utiliser_tourisme']) . "',
        '" . est_coche($_POST['va_utiliser_lvc']) . "',
        '" . $_POST['comm_nouveau_service'] . "',
        '" . $_POST['clarte'] . "',
        '" . $_POST['ergo'] . "',
        '" . $_POST['facilite'] . "',
        '" . $_POST['qualite_accueil'] . "',
        '" . $_POST['qualite_chauffeur'] . "',
        '" . $_POST['qualite_transport'] . "',
        '" . $_POST['qualite_prix'] . "',
        '" . $_POST['global'] . "',
        '" . $_POST['recommendation'] . "',
        '" . $suggestion . "',
        '" . $commentaire . "'
    )";

    mysql_query($sql) or die(mysql_error());
}

?>


<html>
    <head>
        <meta http-equiv="refresh" content="5; url=http://www.alsace-navette.com" />
        <title>Merci !</title>
		
    </head>

    <body>
        <div style="text-align:center">
            <h2>Merci de votre participation !</h2>
        </div>
    </body>
</html>
