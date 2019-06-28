<?php

require_once('../../admin/connection.php');

$sql_aeroport = mysql_query("SELECT nom, id_lieu FROM aeroport_lieu");
$nb_aeroport = mysql_num_rows($sql_aeroport);



$sql = "SELECT
SUM(reseau_fb) AS fb,
SUM(reseau_fo) AS fo,
SUM(reseau_tw) AS tw,
SUM(reseau_vd) AS vd,
SUM(reseau_ll) AS ll,

(SELECT COUNT(avion_ans) FROM sondage_sondage WHERE avion_ans = '1-2') AS avion_ans_1,
(SELECT COUNT(avion_ans) FROM sondage_sondage WHERE avion_ans = '3-6') AS avion_ans_2,
(SELECT COUNT(avion_ans) FROM sondage_sondage WHERE avion_ans = '+6') AS avion_ans_3,
(SELECT COUNT(avion_ans) FROM sondage_sondage WHERE avion_ans = '0') AS avion_ans_4, ";

$i = 0;
while($row = mysql_fetch_assoc($sql_aeroport))
{
    $sql .= "(SELECT COUNT(aeroport_rhin) FROM sondage_sondage WHERE aeroport_rhin = " . $row['id_lieu'] . ") AS rhin_" . $i . ", ";
    $i++;
}

mysql_data_seek($sql_aeroport, 0);

$sql .= "

(SELECT COUNT(voyage_pro) FROM sondage_sondage WHERE voyage_pro = 1) AS voyage_pro,
(SELECT COUNT(voyage_perso) FROM sondage_sondage WHERE voyage_perso = 1) AS voyage_perso,

SUM(conn_ana_internet) AS conn_ana_internet,
SUM(conn_ana_lien) AS conn_ana_lien,
SUM(conn_ana_moteur) AS conn_ana_moteur,
SUM(conn_ana_reseau) AS conn_ana_reseau,
SUM(conn_ana_presse) AS conn_ana_presse,
SUM(conn_ana_radio) AS conn_ana_radio,
SUM(conn_ana_autre) AS conn_ana_autre,

(SELECT COUNT(trouve_facilement) FROM sondage_sondage WHERE trouve_facilement = 1) AS trouve_oui,
(SELECT COUNT(trouve_facilement) FROM sondage_sondage WHERE trouve_facilement = 0) AS trouve_non,

(SELECT COUNT(utilise_12_ana) FROM sondage_sondage WHERE utilise_12_ana = 1) AS utilise_ana_oui,
(SELECT COUNT(utilise_12_ana) FROM sondage_sondage WHERE utilise_12_ana = 0) AS utilise_ana_non,
(SELECT COUNT(utilise_12_ant) FROM sondage_sondage WHERE utilise_12_ant = 1) AS utilise_ant_oui,
(SELECT COUNT(utilise_12_ant) FROM sondage_sondage WHERE utilise_12_ant = 0) AS utilise_ant_non,
(SELECT COUNT(utilise_12_lvc) FROM sondage_sondage WHERE utilise_12_lvc = 1) AS utilise_lvc_oui,
(SELECT COUNT(utilise_12_lvc) FROM sondage_sondage WHERE utilise_12_lvc = 0) AS utilise_lvc_non,

(SELECT COUNT(utilise_autre) FROM sondage_sondage WHERE utilise_autre = 1) AS intension_oui,
(SELECT COUNT(utilise_autre) FROM sondage_sondage WHERE utilise_autre = 0) AS intension_non,

SUM(utilise_autre_ana) AS intension_ana,
SUM(utilise_autre_ant) AS intension_ant,
SUM(utilise_autre_lvc) AS intension_lvc,

(SELECT COUNT(pres_recommander) FROM sondage_sondage WHERE pres_recommander = 1) AS recommander_oui,
(SELECT COUNT(pres_recommander) FROM sondage_sondage WHERE pres_recommander = 0) AS recommander_non,
(SELECT COUNT(pres_recommander) FROM sondage_sondage WHERE pres_recommander = 2) AS recommander_jcp,

(SELECT COUNT(clarte) FROM sondage_sondage WHERE clarte = 1) AS clarte_1,
(SELECT COUNT(clarte) FROM sondage_sondage WHERE clarte = 2) AS clarte_2,
(SELECT COUNT(clarte) FROM sondage_sondage WHERE clarte = 3) AS clarte_3,
(SELECT COUNT(clarte) FROM sondage_sondage WHERE clarte = 4) AS clarte_4,
(SELECT COUNT(clarte) FROM sondage_sondage WHERE clarte = 5) AS clarte_5,
(SELECT COUNT(clarte) FROM sondage_sondage WHERE clarte = 0) AS clarte_6,

(SELECT COUNT(ergo) FROM sondage_sondage WHERE ergo = 1) AS ergo_1,
(SELECT COUNT(ergo) FROM sondage_sondage WHERE ergo = 2) AS ergo_2,
(SELECT COUNT(ergo) FROM sondage_sondage WHERE ergo = 3) AS ergo_3,
(SELECT COUNT(ergo) FROM sondage_sondage WHERE ergo = 4) AS ergo_4,
(SELECT COUNT(ergo) FROM sondage_sondage WHERE ergo = 5) AS ergo_5,
(SELECT COUNT(ergo) FROM sondage_sondage WHERE ergo = 0) AS ergo_6,

(SELECT COUNT(facilite) FROM sondage_sondage WHERE facilite = 1) AS facilite_1,
(SELECT COUNT(facilite) FROM sondage_sondage WHERE facilite = 2) AS facilite_2,
(SELECT COUNT(facilite) FROM sondage_sondage WHERE facilite = 3) AS facilite_3,
(SELECT COUNT(facilite) FROM sondage_sondage WHERE facilite = 4) AS facilite_4,
(SELECT COUNT(facilite) FROM sondage_sondage WHERE facilite = 5) AS facilite_5,
(SELECT COUNT(facilite) FROM sondage_sondage WHERE facilite = 0) AS facilite_6,

(SELECT COUNT(qualite_accueil) FROM sondage_sondage WHERE qualite_accueil = 1) AS accueil_1,
(SELECT COUNT(qualite_accueil) FROM sondage_sondage WHERE qualite_accueil = 2) AS accueil_2,
(SELECT COUNT(qualite_accueil) FROM sondage_sondage WHERE qualite_accueil = 3) AS accueil_3,
(SELECT COUNT(qualite_accueil) FROM sondage_sondage WHERE qualite_accueil = 4) AS accueil_4,
(SELECT COUNT(qualite_accueil) FROM sondage_sondage WHERE qualite_accueil = 5) AS accueil_5,
(SELECT COUNT(qualite_accueil) FROM sondage_sondage WHERE qualite_accueil = 0) AS accueil_6,

(SELECT COUNT(qualite_chauffeur) FROM sondage_sondage WHERE qualite_chauffeur = 1) AS chauffeur_1,
(SELECT COUNT(qualite_chauffeur) FROM sondage_sondage WHERE qualite_chauffeur = 2) AS chauffeur_2,
(SELECT COUNT(qualite_chauffeur) FROM sondage_sondage WHERE qualite_chauffeur = 3) AS chauffeur_3,
(SELECT COUNT(qualite_chauffeur) FROM sondage_sondage WHERE qualite_chauffeur = 4) AS chauffeur_4,
(SELECT COUNT(qualite_chauffeur) FROM sondage_sondage WHERE qualite_chauffeur = 5) AS chauffeur_5,
(SELECT COUNT(qualite_chauffeur) FROM sondage_sondage WHERE qualite_chauffeur = 0) AS chauffeur_6,

(SELECT COUNT(qualite_transport) FROM sondage_sondage WHERE qualite_transport = 1) AS service_1,
(SELECT COUNT(qualite_transport) FROM sondage_sondage WHERE qualite_transport = 2) AS service_2,
(SELECT COUNT(qualite_transport) FROM sondage_sondage WHERE qualite_transport = 3) AS service_3,
(SELECT COUNT(qualite_transport) FROM sondage_sondage WHERE qualite_transport = 4) AS service_4,
(SELECT COUNT(qualite_transport) FROM sondage_sondage WHERE qualite_transport = 5) AS service_5,
(SELECT COUNT(qualite_transport) FROM sondage_sondage WHERE qualite_transport = 0) AS service_6,

(SELECT COUNT(qualite_prix) FROM sondage_sondage WHERE qualite_prix = 1) AS prix_1,
(SELECT COUNT(qualite_prix) FROM sondage_sondage WHERE qualite_prix = 2) AS prix_2,
(SELECT COUNT(qualite_prix) FROM sondage_sondage WHERE qualite_prix = 3) AS prix_3,
(SELECT COUNT(qualite_prix) FROM sondage_sondage WHERE qualite_prix = 4) AS prix_4,
(SELECT COUNT(qualite_prix) FROM sondage_sondage WHERE qualite_prix = 5) AS prix_5,
(SELECT COUNT(qualite_prix) FROM sondage_sondage WHERE qualite_prix = 0) AS prix_6,

(SELECT COUNT(global) FROM sondage_sondage WHERE global = 1) AS global_1,
(SELECT COUNT(global) FROM sondage_sondage WHERE global = 2) AS global_2,
(SELECT COUNT(global) FROM sondage_sondage WHERE global = 3) AS global_3,
(SELECT COUNT(global) FROM sondage_sondage WHERE global = 4) AS global_4,
(SELECT COUNT(global) FROM sondage_sondage WHERE global = 5) AS global_5,
(SELECT COUNT(global) FROM sondage_sondage WHERE global = 0) AS global_6


FROM sondage_sondage";


$ret = mysql_query($sql) or die(mysql_error());
$row = mysql_fetch_assoc($ret);


$ret_nb_rep = mysql_query("SELECT COUNT(id) AS nb FROM sondage_sondage");
$row_nb_rep = mysql_fetch_assoc($ret_nb_rep);
$nb_rep = $row_nb_rep['nb'];



$global = mysql_query("SELECT * FROM sondage_sondage");




function get_image($val)
{
    $img = '<img src="';

    switch($val)
    {
        case 1:
            $img .= "pascontentpascontent.png";
            break;
        case 2:
            $img .= "pascontent.png";
            break;
        case 3:
            $img .= "neutre.png";
            break;
        case 4:
            $img .= "content.png";
            break;
        case 5:
            $img .= "contentcontent.png";
            break;
        case 0:
            $img .= "npc.png";
            break;
    }

    return $img . '" />';
}


?>


<html>
    <head>
        <title>Résultats du sondage</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <style type="text/css">
            table, td, th { border-collapse:collapse; border: 1px solid black}
        </style>


        <script type="text/javascript" src="http://www.google.com/jsapi"></script>
        <script type="text/javascript">
            google.load('visualization', '1', {packages: ['piechart']});
            google.load('visualization', '1', {packages: ['barchart']});

            function drawVisualization()
            {
                var data_reseau_sociaux = new google.visualization.DataTable();
                data_reseau_sociaux.addColumn('string', 'Réseau');
                data_reseau_sociaux.addColumn('number', 'Nombre');
                data_reseau_sociaux.addRows(5);
                data_reseau_sociaux.setValue(0, 0, 'Facebook');
                data_reseau_sociaux.setValue(0, 1, <?php echo $row['fb']; ?>);
                data_reseau_sociaux.setValue(1, 0, 'Twitter');
                data_reseau_sociaux.setValue(1, 1, <?php echo $row['tw']; ?>);
                data_reseau_sociaux.setValue(2, 0, 'Viadeo');
                data_reseau_sociaux.setValue(2, 1, <?php echo $row['vd']; ?>);
                data_reseau_sociaux.setValue(3, 0, 'LinkedIn');
                data_reseau_sociaux.setValue(3, 1, <?php echo $row['ll']; ?>);
                data_reseau_sociaux.setValue(4, 0, 'Forum');
                data_reseau_sociaux.setValue(4, 1, <?php echo $row['fo']; ?>);


                var data_avion_ans = new google.visualization.DataTable();
                data_avion_ans.addColumn('string', 'Réseau');
                data_avion_ans.addColumn('number', 'Nombre');
                data_avion_ans.addRows(4);
                data_avion_ans.setValue(0, 0, '1-2');
                data_avion_ans.setValue(0, 1, <?php echo $row['avion_ans_1']; ?>);
                data_avion_ans.setValue(1, 0, '3-6');
                data_avion_ans.setValue(1, 1, <?php echo $row['avion_ans_2']; ?>);
                data_avion_ans.setValue(2, 0, '+6');
                data_avion_ans.setValue(2, 1, <?php echo $row['avion_ans_3']; ?>);
                data_avion_ans.setValue(3, 0, 'Moins');
                data_avion_ans.setValue(3, 1, <?php echo $row['avion_ans_4']; ?>);


                var aeroport_utilise = new google.visualization.DataTable();
                aeroport_utilise.addColumn('string', 'Aéroport');
                aeroport_utilise.addColumn('number', 'Nombre');
                aeroport_utilise.addRows(<?php echo $nb_aeroport; ?>);

                <?php
                    $i = 0;
                    while($row_aeroport = mysql_fetch_assoc($sql_aeroport))
                    {
                        echo "aeroport_utilise.setValue(" . $i . ", 0, '" . $row_aeroport['nom'] . "');\n";
                        echo "aeroport_utilise.setValue(" . $i . ", 1, " . $row['rhin_' . $i] . ");\n";
                        $i++;
                    }
                ?>


                var raison_voyage = new google.visualization.DataTable();
                raison_voyage.addColumn('string', 'Raison');
                raison_voyage.addColumn('number', 'Nombre');
                raison_voyage.addRows(2);
                raison_voyage.setValue(0, 0, 'Personnelles');
                raison_voyage.setValue(0, 1, <?php echo $row['voyage_perso']; ?>);
                raison_voyage.setValue(1, 0, 'Professionnelle');
                raison_voyage.setValue(1, 1, <?php echo $row['voyage_pro']; ?>);

                var connaissance = new google.visualization.DataTable();
                connaissance.addColumn('string', 'Connaissance');
                connaissance.addColumn('number', 'Nombre');
                connaissance.addRows(7);
                connaissance.setValue(0, 0, 'Internet');
                connaissance.setValue(0, 1, <?php echo $row['conn_ana_internet']; ?>);
                connaissance.setValue(1, 0, 'Lien direct');
                connaissance.setValue(1, 1, <?php echo $row['conn_ana_lien']; ?>);
                connaissance.setValue(2, 0, 'Moteur de recherche');
                connaissance.setValue(2, 1, <?php echo $row['conn_ana_moteur']; ?>);
                connaissance.setValue(3, 0, 'Réseau social');
                connaissance.setValue(3, 1, <?php echo $row['conn_ana_reseau']; ?>);
                connaissance.setValue(4, 0, 'Presse');
                connaissance.setValue(4, 1, <?php echo $row['conn_ana_presse']; ?>);
                connaissance.setValue(5, 0, 'Radio');
                connaissance.setValue(5, 1, <?php echo $row['conn_ana_radio']; ?>);
                connaissance.setValue(6, 0, 'Autre');
                connaissance.setValue(6, 1, <?php echo $row['conn_ana_autre']; ?>);


                var trouve = new google.visualization.DataTable();
                trouve.addColumn('string', 'Trouvé facilement');
                trouve.addColumn('number', 'Nombre');
                trouve.addRows(2);
                trouve.setValue(0, 0, 'Oui');
                trouve.setValue(0, 1, <?php echo $row['trouve_oui']; ?>);
                trouve.setValue(1, 0, 'Non');
                trouve.setValue(1, 1, <?php echo $row['trouve_non']; ?>);


                var utilise = new google.visualization.DataTable();
                utilise.addColumn('string', 'Service');
                utilise.addColumn('number', 'Oui');
                utilise.addColumn('number', 'Non');
                utilise.addRows(3);
                utilise.setValue(0, 0, 'ANA');
                utilise.setValue(0, 1, <?php echo $row['utilise_ana_oui']; ?>);
                utilise.setValue(0, 2, <?php echo $row['utilise_ana_non']; ?>);
                utilise.setValue(1, 0, 'ANT');
                utilise.setValue(1, 1, <?php echo $row['utilise_ant_oui']; ?>);
                utilise.setValue(1, 2, <?php echo $row['utilise_ant_non']; ?>);
                utilise.setValue(2, 0, 'LVC');
                utilise.setValue(2, 1, <?php echo $row['utilise_lvc_oui']; ?>);
                utilise.setValue(2, 2, <?php echo $row['utilise_lvc_non']; ?>);


                var intension = new google.visualization.DataTable();
                intension.addColumn('string', 'Intension d\'utiliser');
                intension.addColumn('number', 'Nombre');
                intension.addRows(2);
                intension.setValue(0, 0, 'Oui');
                intension.setValue(0, 1, <?php echo $row['intension_oui']; ?>);
                intension.setValue(1, 0, 'Non');
                intension.setValue(1, 1, <?php echo $row['intension_non']; ?>);


                var intension_detail = new google.visualization.DataTable();
                intension_detail.addColumn('string', 'Intension d\'utiliser (détail)');
                intension_detail.addColumn('number', 'Nombre');
                intension_detail.addRows(3);
                intension_detail.setValue(0, 0, 'ANA');
                intension_detail.setValue(0, 1, <?php echo $row['intension_ana']; ?>);
                intension_detail.setValue(1, 0, 'ANT');
                intension_detail.setValue(1, 1, <?php echo $row['intension_ant']; ?>);
                intension_detail.setValue(2, 0, 'LVC');
                intension_detail.setValue(2, 1, <?php echo $row['intension_lvc']; ?>);


                var recommander = new google.visualization.DataTable();
                recommander.addColumn('string', 'Près à recommander');
                recommander.addColumn('number', 'Nombre');
                recommander.addRows(3);
                recommander.setValue(0, 0, 'Oui');
                recommander.setValue(0, 1, <?php echo $row['recommander_oui']; ?>);
                recommander.setValue(1, 0, 'Non');
                recommander.setValue(1, 1, <?php echo $row['recommander_non']; ?>);
                recommander.setValue(2, 0, '?');
                recommander.setValue(2, 1, <?php echo $row['recommander_jcp']; ?>);


                var clarte = new google.visualization.DataTable();
                clarte.addColumn('string', 'Clarté');
                clarte.addColumn('number', 'Nombre');
                clarte.addRows(6);
                clarte.setValue(0, 0, ':(:(');
                clarte.setValue(0, 1, <?php echo $row['clarte_1']; ?>);
                clarte.setValue(1, 0, ':(');
                clarte.setValue(1, 1, <?php echo $row['clarte_2']; ?>);
                clarte.setValue(2, 0, ':|');
                clarte.setValue(2, 1, <?php echo $row['clarte_3']; ?>);
                clarte.setValue(3, 0, ':)');
                clarte.setValue(3, 1, <?php echo $row['clarte_4']; ?>);
                clarte.setValue(4, 0, ':):)');
                clarte.setValue(4, 1, <?php echo $row['clarte_5']; ?>);
                clarte.setValue(5, 0, '?');
                clarte.setValue(5, 1, <?php echo $row['clarte_6']; ?>);


                var ergo = new google.visualization.DataTable();
                ergo.addColumn('string', 'Ergonomie');
                ergo.addColumn('number', 'Nombre');
                ergo.addRows(6);
                ergo.setValue(0, 0, ':(:(');
                ergo.setValue(0, 1, <?php echo $row['ergo_1']; ?>);
                ergo.setValue(1, 0, ':(');
                ergo.setValue(1, 1, <?php echo $row['ergo_2']; ?>);
                ergo.setValue(2, 0, ':|');
                ergo.setValue(2, 1, <?php echo $row['ergo_3']; ?>);
                ergo.setValue(3, 0, ':)');
                ergo.setValue(3, 1, <?php echo $row['ergo_4']; ?>);
                ergo.setValue(4, 0, ':):)');
                ergo.setValue(4, 1, <?php echo $row['ergo_5']; ?>);
                ergo.setValue(5, 0, '?');
                ergo.setValue(5, 1, <?php echo $row['ergo_6']; ?>);


                var facilite = new google.visualization.DataTable();
                facilite.addColumn('string', 'Facilité');
                facilite.addColumn('number', 'Nombre');
                facilite.addRows(6);
                facilite.setValue(0, 0, ':(:(');
                facilite.setValue(0, 1, <?php echo $row['facilite_1']; ?>);
                facilite.setValue(1, 0, ':(');
                facilite.setValue(1, 1, <?php echo $row['facilite_2']; ?>);
                facilite.setValue(2, 0, ':|');
                facilite.setValue(2, 1, <?php echo $row['facilite_3']; ?>);
                facilite.setValue(3, 0, ':)');
                facilite.setValue(3, 1, <?php echo $row['facilite_4']; ?>);
                facilite.setValue(4, 0, ':):)');
                facilite.setValue(4, 1, <?php echo $row['facilite_5']; ?>);
                facilite.setValue(5, 0, '?');
                facilite.setValue(5, 1, <?php echo $row['facilite_6']; ?>);


                var qualite_accueil = new google.visualization.DataTable();
                qualite_accueil.addColumn('string', 'Qualité de l\'accueil');
                qualite_accueil.addColumn('number', 'Nombre');
                qualite_accueil.addRows(6);
                qualite_accueil.setValue(0, 0, ':(:(');
                qualite_accueil.setValue(0, 1, <?php echo $row['accueil_1']; ?>);
                qualite_accueil.setValue(1, 0, ':(');
                qualite_accueil.setValue(1, 1, <?php echo $row['accueil_2']; ?>);
                qualite_accueil.setValue(2, 0, ':|');
                qualite_accueil.setValue(2, 1, <?php echo $row['accueil_3']; ?>);
                qualite_accueil.setValue(3, 0, ':)');
                qualite_accueil.setValue(3, 1, <?php echo $row['accueil_4']; ?>);
                qualite_accueil.setValue(4, 0, ':):)');
                qualite_accueil.setValue(4, 1, <?php echo $row['accueil_5']; ?>);
                qualite_accueil.setValue(5, 0, '?');
                qualite_accueil.setValue(5, 1, <?php echo $row['accueil_6']; ?>);


                var qualite_chauffeur = new google.visualization.DataTable();
                qualite_chauffeur.addColumn('string', 'Qualité du chauffeur');
                qualite_chauffeur.addColumn('number', 'Nombre');
                qualite_chauffeur.addRows(6);
                qualite_chauffeur.setValue(0, 0, ':(:(');
                qualite_chauffeur.setValue(0, 1, <?php echo $row['chauffeur_1']; ?>);
                qualite_chauffeur.setValue(1, 0, ':(');
                qualite_chauffeur.setValue(1, 1, <?php echo $row['chauffeur_2']; ?>);
                qualite_chauffeur.setValue(2, 0, ':|');
                qualite_chauffeur.setValue(2, 1, <?php echo $row['chauffeur_3']; ?>);
                qualite_chauffeur.setValue(3, 0, ':)');
                qualite_chauffeur.setValue(3, 1, <?php echo $row['chauffeur_4']; ?>);
                qualite_chauffeur.setValue(4, 0, ':):)');
                qualite_chauffeur.setValue(4, 1, <?php echo $row['chauffeur_5']; ?>);
                qualite_chauffeur.setValue(5, 0, '?');
                qualite_chauffeur.setValue(5, 1, <?php echo $row['chauffeur_6']; ?>);


                var qualite_service = new google.visualization.DataTable();
                qualite_service.addColumn('string', 'Qualité du service');
                qualite_service.addColumn('number', 'Nombre');
                qualite_service.addRows(6);
                qualite_service.setValue(0, 0, ':(:(');
                qualite_service.setValue(0, 1, <?php echo $row['service_1']; ?>);
                qualite_service.setValue(1, 0, ':(');
                qualite_service.setValue(1, 1, <?php echo $row['service_2']; ?>);
                qualite_service.setValue(2, 0, ':|');
                qualite_service.setValue(2, 1, <?php echo $row['service_3']; ?>);
                qualite_service.setValue(3, 0, ':)');
                qualite_service.setValue(3, 1, <?php echo $row['service_4']; ?>);
                qualite_service.setValue(4, 0, ':):)');
                qualite_service.setValue(4, 1, <?php echo $row['service_5']; ?>);
                qualite_service.setValue(5, 0, '?');
                qualite_service.setValue(5, 1, <?php echo $row['service_6']; ?>);


                var qualite_prix = new google.visualization.DataTable();
                qualite_prix.addColumn('string', 'Qualité prix');
                qualite_prix.addColumn('number', 'Nombre');
                qualite_prix.addRows(6);
                qualite_prix.setValue(0, 0, ':(:(');
                qualite_prix.setValue(0, 1, <?php echo $row['prix_1']; ?>);
                qualite_prix.setValue(1, 0, ':(');
                qualite_prix.setValue(1, 1, <?php echo $row['prix_2']; ?>);
                qualite_prix.setValue(2, 0, ':|');
                qualite_prix.setValue(2, 1, <?php echo $row['prix_3']; ?>);
                qualite_prix.setValue(3, 0, ':)');
                qualite_prix.setValue(3, 1, <?php echo $row['prix_4']; ?>);
                qualite_prix.setValue(4, 0, ':):)');
                qualite_prix.setValue(4, 1, <?php echo $row['prix_5']; ?>);
                qualite_prix.setValue(5, 0, '?');
                qualite_prix.setValue(5, 1, <?php echo $row['prix_6']; ?>);


                var global = new google.visualization.DataTable();
                global.addColumn('string', 'Qualité globale');
                global.addColumn('number', 'Nombre');
                global.addRows(6);
                global.setValue(0, 0, ':(:(');
                global.setValue(0, 1, <?php echo $row['global_1']; ?>);
                global.setValue(1, 0, ':(');
                global.setValue(1, 1, <?php echo $row['global_2']; ?>);
                global.setValue(2, 0, ':|');
                global.setValue(2, 1, <?php echo $row['global_3']; ?>);
                global.setValue(3, 0, ':)');
                global.setValue(3, 1, <?php echo $row['global_4']; ?>);
                global.setValue(4, 0, ':):)');
                global.setValue(4, 1, <?php echo $row['global_5']; ?>);
                global.setValue(5, 0, '?');
                global.setValue(5, 1, <?php echo $row['global_6']; ?>);
                

                new google.visualization.PieChart(document.getElementById('reseau_sociaux')).draw(data_reseau_sociaux, null);
                new google.visualization.PieChart(document.getElementById('avion_an')).draw(data_avion_ans, null);
                new google.visualization.PieChart(document.getElementById('aeroport_utilise')).draw(aeroport_utilise, null);
                new google.visualization.PieChart(document.getElementById('raison_voyage')).draw(raison_voyage, null);
                new google.visualization.PieChart(document.getElementById('connaissance')).draw(connaissance, null);
                new google.visualization.PieChart(document.getElementById('trouve')).draw(trouve, null);
                new google.visualization.BarChart(document.getElementById('utilise')).draw(utilise, null);
                new google.visualization.PieChart(document.getElementById('intension')).draw(intension, null);
                new google.visualization.PieChart(document.getElementById('intension_detail')).draw(intension_detail, null);
                new google.visualization.PieChart(document.getElementById('recommander')).draw(recommander, null);

                new google.visualization.PieChart(document.getElementById('clarte')).draw(clarte, null);
                new google.visualization.PieChart(document.getElementById('ergo')).draw(ergo, null);
                new google.visualization.PieChart(document.getElementById('facilite')).draw(facilite, null);
                new google.visualization.PieChart(document.getElementById('qualite_relation_accueil')).draw(qualite_accueil, null);
                new google.visualization.PieChart(document.getElementById('qualite_relation_chauffeur')).draw(qualite_chauffeur, null);
                new google.visualization.PieChart(document.getElementById('qualite_service')).draw(qualite_service, null);
                new google.visualization.PieChart(document.getElementById('qualite_prix')).draw(qualite_prix, null);
                new google.visualization.PieChart(document.getElementById('global')).draw(global, null);

            }

            google.setOnLoadCallback(drawVisualization);
        </script>
    </head>

    <body>
        <span><strong>Nombre de réponses : <?php echo $nb_rep; ?></strong></span>
        <div>
            <h3>Réseaux sociaux utilisés</h3>
            <div id="reseau_sociaux" style="width: 300px; height: 300px;"></div>
            <div>
                <table>
                    <tr>
                        <th>FaceBook</th>
                        <th>Twitter</th>
                        <th>Viadeo</th>
                        <th>LinkedIn</th>
                        <th>Forum</th>
                    </tr>
                    <tr>
                        <td><?php echo $row['fb']; ?></td>
                        <td><?php echo $row['tw']; ?></td>
                        <td><?php echo $row['vd']; ?></td>
                        <td><?php echo $row['ll']; ?></td>
                        <td><?php echo $row['fo']; ?></td>
                    </tr>
                </table>
            </div>
        </div>

        <div>
            <h3>Prise de l'avion par an</h3>
            <div id="avion_an" style="width: 300px; height: 300px;"></div>
            <div>
                <table>
                    <tr>
                        <th>1-2</th>
                        <th>3-6</th>
                        <th>+6</th>
                        <th>Moins</th>
                    </tr>
                    <tr>
                        <td><?php echo round(($row['avion_ans_1']*100/$nb_rep), 2) . " % (" . $row['avion_ans_1']. ")"; ?></td>
                        <td><?php echo round(($row['avion_ans_2']*100/$nb_rep), 2) . " % (" . $row['avion_ans_2']. ")"; ?></td>
                        <td><?php echo round(($row['avion_ans_3']*100/$nb_rep), 2) . " % (" . $row['avion_ans_3']. ")"; ?></td>
                        <td><?php echo round(($row['avion_ans_4']*100/$nb_rep), 2) . " % (" . $row['avion_ans_4']. ")"; ?></td>
                    </tr>
                </table>
            </div>
        </div>

        <div>
            <h3>Aéroport utilisé</h3>
            <div id="aeroport_utilise" style="width: 550px; height: 550px;"></div>
            <?php
                $i = 0;
                mysql_data_seek($sql_aeroport, 0);

                $th = "";
                $td = "";

                while($row_aeroport = mysql_fetch_assoc($sql_aeroport))
                {
                    $th .= "<th>" . $row_aeroport['nom'] . "</th>\n";
                    $td .= "<td>" . round(($row['rhin_' . $i]*100/$nb_rep), 2) . " % (" . $row['rhin_' . $i] . ")" . "</td>\n";
                    $i++;
                }
            ?>

            <div>
                <table>
                    <tr>
                        <?php echo $th; ?>
                    </tr>
                    <tr>
                        <?php echo $td; ?>
                    </tr>
                </table>
            </div>
        </div>

        <div>
            <h3>Raison des voyages</h3>
            <div id="raison_voyage" style="width: 300px; height: 300px;"></div>
            <div>
                <table>
                    <tr>
                        <th>Personnelles</th>
                        <th>Professionnelles</th>
                    </tr>
                    <tr>
                        <td><?php echo round(($row['voyage_perso']*100/$nb_rep)) . " % (" . $row['voyage_perso'] . ")"; ?></td>
                        <td><?php echo round(($row['voyage_pro']*100/$nb_rep)) . " % (" . $row['voyage_pro'] . ")"; ?></td>
                    </tr>
                </table>
            </div>
        </div>

        <div>
            <h3>Connaissance d'Alsace navette</h3>
            <div id="connaissance" style="width: 550px; height: 550px;"></div>
            <div>
                <table>
                    <tr>
                        <th>Internet</th>
                        <th>Lien direct</th>
                        <th>Moteur de recherche</th>
                        <th>Réseau social</th>
                        <th>Presse</th>
                        <th>Radio</th>
                        <th>Autre</th>
                    </tr>
                    <tr>
                        <td><?php echo $row['conn_ana_internet']; ?></td>
                        <td><?php echo $row['conn_ana_lien']; ?></td>
                        <td><?php echo $row['conn_ana_moteur']; ?></td>
                        <td><?php echo $row['conn_ana_reseau']; ?></td>
                        <td><?php echo $row['conn_ana_presse']; ?></td>
                        <td><?php echo $row['conn_ana_radio']; ?></td>
                        <td><?php echo $row['conn_ana_autre']; ?></td>
                    </tr>
                </table>
            </div>
        </div>

        <div>
            <h3>Trouvé facilement</h3>
            <div id="trouve" style="width: 300px; height: 300px;"></div>
            <div>
                <table>
                    <tr>
                        <th>Oui</th>
                        <th>Non</th>
                    </tr>
                    <tr>
                        <td><?php echo round(($row['trouve_oui']*100/$nb_rep), 2) . " % (" . $row['trouve_oui'] . ")"; ?></td>
                        <td><?php echo round(($row['trouve_non']*100/$nb_rep), 2) . " % (" . $row['trouve_non'] . ")"; ?></td>
                    </tr>
                </table>
            </div>
        </div>

        <div>
            <h3>Utilisé les 12 derniers mois</h3>
            <div id="utilise" style="width: 300px; height: 300px;"></div>
			<div>
                <table>
                    <tr>
                        <th>ANA</th>
                        <th>ANT</th>
						<th>LVC</th>
                    </tr>
                    <tr>
                        <td><?php echo round(($row['utilise_ana_oui']*100/$nb_rep), 2) . " % (" . $row['utilise_ana_oui'] . ")"; ?></td>
                        <td><?php echo round(($row['utilise_ant_oui']*100/$nb_rep), 2) . " % (" . $row['utilise_ant_oui'] . ")"; ?></td>
						<td><?php echo round(($row['utilise_lvc_oui']*100/$nb_rep), 2) . " % (" . $row['utilise_lvc_oui'] . ")"; ?></td>
                    </tr>
                </table>
            </div>
        </div>

        <div>
            <h3>Intension d'utiliser</h3>
            <div id="intension" style="width: 300px; height: 300px;"></div>
			<div>
                <table>
                    <tr>
                        <th>Oui</th>
                        <th>Non</th>
                    </tr>
                    <tr>
                        <td><?php echo round(($row['intension_oui']*100/$nb_rep), 2) . " % (" . $row['intension_oui'] . ")"; ?></td>
                        <td><?php echo round(($row['intension_non']*100/$nb_rep), 2) . " % (" . $row['intension_non'] . ")"; ?></td>
                    </tr>
                </table>
            </div>
        </div>

        <div>
            <h3>Intension d'utiliser (détail)</h3>
            <div id="intension_detail" style="width: 300px; height: 300px;"></div>
			<div>
                <table>
					<tr>
						<th>ANA</th>
						<th>ANT</th>
						<th>LVC</th>
					</tr>
                    <tr>
                        <td><?php echo $row['intension_ana']; ?></td>
                        <td><?php echo $row['intension_ant']; ?></td>
						<td><?php echo $row['intension_lvc']; ?></td>
                    </tr>
                </table>
            </div>
        </div>

        <div>
            <h3>Satisfaction</h3>
            <div>
                <h4>Clarté</h4>
                <div id="clarte" style="width: 300px; height: 300px;"></div>
				<div>
                <table>
					<tr>
						<th><img src="pascontentpascontent.png" alt="Pas content pas content" /></th>
						<th><img src="pascontent.png" alt="Pas content" /></th>
						<th><img src="neutre.png" alt="Neutre" /></th>
						<th><img src="content.png" alt="Content" /></th>
						<th><img src="contentcontent.png" alt="Content content" /></th>
						<th><img src="npc.png" alt="NPC" /></th>
					</tr>
                    <tr>
						<?php
							$i = 1;
							while($i <= 6)
							{
								echo "<td>" . round(($row['clarte_' . $i]*100/$nb_rep), 2) . " % (" . $row['clarte_' . $i] . ")</td>";
								$i++;
							}
						?>
                    </tr>
                </table>
            </div>
            </div>

            <div>
                <h4>Ergonomie</h4>
                <div id="ergo" style="width: 300px; height: 300px;"></div>
				<div>
                <table>
					<tr>
						<th><img src="pascontentpascontent.png" alt="Pas content pas content" /></th>
						<th><img src="pascontent.png" alt="Pas content" /></th>
						<th><img src="neutre.png" alt="Neutre" /></th>
						<th><img src="content.png" alt="Content" /></th>
						<th><img src="contentcontent.png" alt="Content content" /></th>
						<th><img src="npc.png" alt="NPC" /></th>
					</tr>
                    <tr>
						<?php
							$i = 1;
							while($i <= 6)
							{
								echo "<td>" . round(($row['ergo_' . $i]*100/$nb_rep), 2) . " % (" . $row['ergo_' . $i] . ")</td>";
								$i++;
							}
						?>
                    </tr>
                </table>
            </div>
            </div>

            <div>
                <h4>Facilité de réservation</h4>
                <div id="facilite" style="width: 300px; height: 300px;"></div>
				<div>
                <table>
					<tr>
						<th><img src="pascontentpascontent.png" alt="Pas content pas content" /></th>
						<th><img src="pascontent.png" alt="Pas content" /></th>
						<th><img src="neutre.png" alt="Neutre" /></th>
						<th><img src="content.png" alt="Content" /></th>
						<th><img src="contentcontent.png" alt="Content content" /></th>
						<th><img src="npc.png" alt="NPC" /></th>
					</tr>
                    <tr>
						<?php
							$i = 1;
							while($i <= 6)
							{
								echo "<td>" . round(($row['facilite_' . $i]*100/$nb_rep), 2) . " % (" . $row['facilite_' . $i] . ")</td>";
								$i++;
							}
						?>
                    </tr>
                </table>
            </div>
            </div>

            <div>
                <h4>Qualité relationnelle de l'accueil</h4>
                <div id="qualite_relation_accueil" style="width: 300px; height: 300px;"></div>
				<div>
                <table>
					<tr>
						<th><img src="pascontentpascontent.png" alt="Pas content pas content" /></th>
						<th><img src="pascontent.png" alt="Pas content" /></th>
						<th><img src="neutre.png" alt="Neutre" /></th>
						<th><img src="content.png" alt="Content" /></th>
						<th><img src="contentcontent.png" alt="Content content" /></th>
						<th><img src="npc.png" alt="NPC" /></th>
					</tr>
                    <tr>
						<?php
							$i = 1;
							while($i <= 6)
							{
								echo "<td>" . round(($row['accueil_' . $i]*100/$nb_rep), 2) . " % (" . $row['accueil_' . $i] . ")</td>";
								$i++;
							}
						?>
                    </tr>
                </table>
            </div>
            </div>

            <div>
                <h4>Qualité relationnelle du chauffeur</h4>
                <div id="qualite_relation_chauffeur" style="width: 300px; height: 300px;"></div>
				<div>
                <table>
					<tr>
						<th><img src="pascontentpascontent.png" alt="Pas content pas content" /></th>
						<th><img src="pascontent.png" alt="Pas content" /></th>
						<th><img src="neutre.png" alt="Neutre" /></th>
						<th><img src="content.png" alt="Content" /></th>
						<th><img src="contentcontent.png" alt="Content content" /></th>
						<th><img src="npc.png" alt="NPC" /></th>
					</tr>
                    <tr>
						<?php
							$i = 1;
							while($i <= 6)
							{
								echo "<td>" . round(($row['chauffeur_' . $i]*100/$nb_rep), 2) . " % (" . $row['chauffeur_' . $i] . ")</td>";
								$i++;
							}
						?>
                    </tr>
                </table>
            </div>
            </div>

            <div>
                <h4>Qualité du service</h4>
                <div id="qualite_service" style="width: 300px; height: 300px;"></div>
				<div>
                <table>
					<tr>
						<th><img src="pascontentpascontent.png" alt="Pas content pas content" /></th>
						<th><img src="pascontent.png" alt="Pas content" /></th>
						<th><img src="neutre.png" alt="Neutre" /></th>
						<th><img src="content.png" alt="Content" /></th>
						<th><img src="contentcontent.png" alt="Content content" /></th>
						<th><img src="npc.png" alt="NPC" /></th>
					</tr>
                    <tr>
						<?php
							$i = 1;
							while($i <= 6)
							{
								echo "<td>" . round(($row['clarte_' . $i]*100/$nb_rep), 2) . " % (" . $row['clarte_' . $i] . ")</td>";
								$i++;
							}
						?>
                    </tr>
                </table>
            </div>
            </div>

            <div>
                <h4>Rapport qualité/prix</h4>
                <div id="qualite_prix" style="width: 300px; height: 300px;"></div>
				<div>
                <table>
					<tr>
						<th><img src="pascontentpascontent.png" alt="Pas content pas content" /></th>
						<th><img src="pascontent.png" alt="Pas content" /></th>
						<th><img src="neutre.png" alt="Neutre" /></th>
						<th><img src="content.png" alt="Content" /></th>
						<th><img src="contentcontent.png" alt="Content content" /></th>
						<th><img src="npc.png" alt="NPC" /></th>
					</tr>
                    <tr>
						<?php
							$i = 1;
							while($i <= 6)
							{
								echo "<td>" . round(($row['prix_' . $i]*100/$nb_rep), 2) . " % (" . $row['prix_' . $i] . ")</td>";
								$i++;
							}
						?>
                    </tr>
                </table>
            </div>
            </div>

            <div>
                <h4>Niveau de satisfaction globale</h4>
                <div id="global" style="width: 300px; height: 300px;"></div>
				<div>
                <table>
					<tr>
						<th><img src="pascontentpascontent.png" alt="Pas content pas content" /></th>
						<th><img src="pascontent.png" alt="Pas content" /></th>
						<th><img src="neutre.png" alt="Neutre" /></th>
						<th><img src="content.png" alt="Content" /></th>
						<th><img src="contentcontent.png" alt="Content content" /></th>
						<th><img src="npc.png" alt="NPC" /></th>
					</tr>
                    <tr>
						<?php
							$i = 1;
							while($i <= 6)
							{
								echo "<td>" . round(($row['global_' . $i]*100/$nb_rep), 2) . " % (" . $row['global_' . $i] . ")</td>";
								$i++;
							}
						?>
                    </tr>
                </table>
            </div>
            </div>
        </div>

        <div>
            <h3>Près à recommander</h3>
            <div id="recommander" style="width: 300px; height: 300px;"></div>
			<div>
                <table>
					<tr>
						<th>Oui</th>
						<th>Non</th>
                        <th>?</th>
					</tr>
                    <tr>
                        <td><?php echo round(($row['recommander_oui']*100/$nb_rep), 2) . " % (" . $row['recommander_oui']. ")"; ?></td>
                        <td><?php echo round(($row['recommander_non']*100/$nb_rep), 2) . " % (" . $row['recommander_non']. ")"; ?></td>
                        <td><?php echo round(($row['recommander_jcp']*100/$nb_rep), 2) . " % (" . $row['recommander_jcp']. ")"; ?></td>
                    </tr>
                </table>
            </div>
        </div>

        <br /><br />

        <table style="width:3000px">
            <tr>
                <th>Civilite</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Date de naissance</th>
                <th>Ville</th>
                <th>Pays</th>
                <th>Mail</th>
                <th>Réseaux sociaux</th>
                <th>Avion / ans</th>
                <th>Aéroport</th>
                <th>Destinations</th>
                <th>Raisons</th>
                <th>Connaissances</th>
                <th>Trouvé facilement</th>
                <th>Utilisé (12 mois)</th>
                <th>Intension d'utiliser</th>
                <th>Aimerait en plus</th>
                <th>Impressions</th>
                <th>Près à recommander</th>
                <th>Suggestions</th>
                <th style="width:500px">Commentaires</th>
            </tr>

            <?php
                while($row = mysql_fetch_assoc($global))
                {
                    echo "<tr><td>" . $row['civilite'] . "</td>
                        <td>" . $row['nom'] . "</td>
                        <td>" . $row['prenom'] . "</td>
                        <td>" . $row['date_de_naissance'] . "</td>
                        <td>" . $row['ville'] . "</td>
                        <td>" . $row['pays'] . "</td>
                        <td>" . $row['mail'] . "</td>
                        <td><ul>";

                        if($row['reseau_fb'] != 0)
                            echo "<li>FaceBook</li>";

                        if($row['reseau_tw'] != 0)
                            echo "<li>Twitter</li>";

                        if($row['reseau_vd'] != 0)
                            echo "<li>Viadeo</li>";

                        if($row['reseau_ll'] != 0)
                            echo "<li>LinkedIn</li>";

                        if($row['reseau_fo'] != 0)
                            echo "<li>Forum (" . $row['reseau_fo_txt'] . ")</td>";

                    echo "</ul></td>
                        <td>" . $row['avion_ans'] . "</td>
                        <td>";

                    $ret_aeroport = mysql_query("SELECT nom FROM aeroport_lieu WHERE id_lieu = " . $row['aeroport_rhin']);
                    $row_aeroport = mysql_fetch_assoc($ret_aeroport);

                    echo $row_aeroport['nom'] . "</td>
                        <td>" . $row['principale_dest'] . "</td>
                        <td><ul>";

                    if($row['voyage_pro'] != 0)
                        echo '<li>Professionnelles</li>';

                    if($row['voyage_perso'] != 0)
                        echo '<li>Personnelles</li>';

                    echo "</ul></td>
                        <td><ul>";

                    if($row['conn_ana_internet'] != 0)
                        echo "<li>Internet</li>";

                    if($row['conn_ana_lien'] != 0)
                        echo "<li>Lien direct</li>";

                    if($row['conn_ana_moteur'] != 0)
                        echo "<li>Moteur de recherche (" . $row['conn_ana_moteur_txt'] . ")</li>";

                    if($row['conn_ana_reseau'] != 0)
                    {
                        echo "<li>Réseau social (";

                        $ret_reseau = mysql_query("SELECT nom_reseau FROM sondage_reseau WHERE id_reseau = " . $row['conn_ana_reseau_val']);
                        $row_reseau = mysql_fetch_assoc($ret_reseau);

                        echo $row_reseau['nom_reseau'] . ")</li>";
                    }

                    if($row['conn_ana_presse'] != 0)
                        echo "<li>Presse</li>";

                    if($row['conn_ana_radio'] != 0)
                        echo "<li>Radio</li>";

                    if($row['conn_ana_autre'] != 0)
                        echo "<li>Autre (" . $row['conn_ana_autre_txt'] . ")</li>";

                    echo "</ul></td>
                        <td>" . (($row['trouve_facilement'] == 1) ? "Oui" : "Non (" . $row['trouve_facilement_txt']) . "</td>
                        <td><ul>";

                    if($row['utilise_12_ana'] != 0)
                        echo "<li>ANA</li>";

                    if($row['utilise_12_ant'] != 0)
                        echo "<li>ANT</li>";

                    if($row['utilise_12_lvc'] != 0)
                        echo "<li>LVC</li>";

                    echo "</ul></td>
                        <td>";

                    if($row['utilise_autre'] != 0)
                    {
                        echo "<ul>";

                        if($row['utilise_autre_ana'] != 0)
                            echo "<li>ANA</li>";

                        if($row['utilise_autre_ant'] != 0)
                            echo "<li>ANT</li>";

                        if($row['utilise_autre_lvc'] != 0)
                            echo "<li>LVC</li>";

                        echo "</ul>";
                    }
                    else
                        echo "Non";

                    echo "</td>
                        <td>" . $row['aime_service'] . "</td>
                        <td style=\"white-space:nowrap\">Clarté : " . get_image($row['clarte']) . "<br />
                        Ergonomie : " . get_image($row['ergo']) . "<br />
                        Facilité : " . get_image($row['facilite']) . "<br />
                        Qualite accueil : " . get_image($row['accueil']) . "<br />
                        Qualité chauffeur : " . get_image($row['clarte']) . "<br />
                        Qualité transport : " . get_image($row['clarte']) . "<br />
                        Qualité prix : " . get_image($row['clarte']) . "<br />
                        Global : " . get_image($row['clarte']) . "</td>
                        <td>" . (($row['pres_recommander'] == 0) ? "Non" : "Oui") . "</td>
                        <td style=\"width:500px\">" . $row['suggestion'] . "</td>
                        <td style=\"width:500px\">" . $row['commentaire'] . "</td>
                    </tr>";

                }
            ?>

        </table>
        
    </body>
</html>