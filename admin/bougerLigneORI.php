<?php
function header_mail()
				{
					$headerMail = "From: \"Alsace-navette.com\"<info@alsace-navette.com>\n";
					$headerMail .= "Reply-to: \"Alsace-navette.com\" <info@alsace-navette.com>\n";
					$headerMail .= "MIME-Version: 1.0\n";
					$headerMail .= "Content-Type: text/html; charset=utf-8\n";
					$headerMail .= "X-Mailer: PHP/" . phpversion();
					
					return $headerMail;
				}
function wp_mktime($_timestamp = ''){
    if($_timestamp){
        $_split_datehour = explode(' ',$_timestamp);
        $_split_data = explode("-", $_split_datehour[0]);
        $_split_hour = explode(":", $_split_datehour[1]);

        return mktime ($_split_hour[0], $_split_hour[1], $_split_hour[2], $_split_data[1], $_split_data[2], $_split_data[0]);
    }
} 


function get_online_offline()
{
    $config = simplexml_load_file(dirname(__FILE__) . '/../libs/config.xml');

    $mode = $config->mode;

    unset($config);

    return $mode;
}



include("connection.php");


$mode = get_online_offline();



$ligneResa = $_POST['ligneResa'];
$numTrajet = $_POST['numTrajet'];
$trajetDest = $_POST['trajetDest'];
$idC = $_POST['idC'];
$idV = $_POST['idV'];
$estValid = $_POST['estValid'];
$emedm = 1;


$info_trajet = mysql_query("SELECT DATE_FORMAT(date, '%d/%m/%Y à %Hh%i') as date, id_lieu_depart, id_lieu_dest, id_chauffeur FROM aeroport_trajet WHERE id_trajet = '" . $numTrajet . "'") or die(mysql_error());
$row_trajet = mysql_fetch_assoc($info_trajet);

$depart = mysql_query("SELECT nom FROM aeroport_lieu WHERE id_lieu = '" . $row_trajet['id_lieu_depart'] . "'") or die(mysql_error());
$row_depart = mysql_fetch_assoc($depart);

$retour = mysql_query("SELECT nom FROM aeroport_lieu WHERE id_lieu = '" . $row_trajet['id_lieu_dest'] . "'") or die(mysql_error());
$row_retour = mysql_fetch_assoc($retour);


$chauffeur = mysql_query("SELECT prenom, mail FROM chauffeur WHERE idchauffeur = '" . $row_trajet['id_chauffeur'] . "'") or die(mysql_error());
$row_chauff = mysql_fetch_assoc($chauffeur);



//préparation de la requête de sélection des info du trajet de destination
$req2 = "SELECT * from aeroport_trajet WHERE id_trajet = '".$trajetDest."'";
$result = mysql_query($req2)or die(mysql_error());

if(mysql_num_rows($result) == 1)
{
	//préparation de la requête d'update
	$req = "UPDATE aeroport_ligne_resa SET id_trajet = '".$trajetDest."' WHERE id_ligne = '".$ligneResa."'";
	mysql_query($req)or die(mysql_error());
	
	
	//mise à jour dans l'agenda du trajet d'origine s'il a déjà été validé
	if($estValid ==1){
		
		$content_mail = "Bonjour " . $row_chauff['prenom'] . ", <br /><br />Un petit mail pour vous informer que sur votre navette de " . $row_depart['nom'] . " vers " . $row_retour['nom'] . " du " . $row_trajet['date'] . ", une personne c'est retirée.<br /><br />Vous pouvez consulter l'agenda pour vérifier. <br /><br />Bonne route !";
		
	
    
    if($mode == "online")
    {
		mail($row_chauff['mail'], "Une personne en moins | " . utf8_decode($row_trajet['date']), $content_mail, header_mail());
    }
    else
    {
        file_put_contents("unepersonneenmoins.html", $content_mail.$row_chauff['mail']);
    }
    
			//echo "maj_note(".$numTrajet.",".$emedm.",".$idC.",".$idV.");";  	
			
			$idChauffeur = $idC;
	$idVehicule = $idV;




	//selection des infos du trajet
$query7= "SELECT id_lieu_depart, id_lieu_dest, id_vehicule, DATE_FORMAT(date, '%Y-%m-%d') as dateDep, DATE_FORMAT(date, '%d/%m/%Y') as dateDep2, DATE_FORMAT(date, '%H') as heureDep, DATE_FORMAT(date, '%i') as minutesDep FROM aeroport_trajet where id_trajet = '$numTrajet'";


			$result7 = mysql_query($query7) or die ($query7);
			while ($r7 = @mysql_fetch_assoc($result7)){
				$id_depart = $r7["id_lieu_depart"];
				$id_dest = $r7["id_lieu_dest"];
				$dateDep = $r7["dateDep"];
				$dateDep2 = $r7["dateDep2"];
				$heureDep = $r7["heureDep"];
				$minutesDep = $r7["minutesDep"];
			}

//selection des infos vehicule
	$query69 = "SELECT * FROM aeroport_vehicule l WHERE id_vehicule = ".$idVehicule;

			$result69 = mysql_query($query69) or die ($query69);
			$r69 = @mysql_fetch_assoc($result69);
			$libelle_vehicule = $r69["libelle"];
			
			
			
						
//selection du nom de départ et arrivée
	$query6 = "SELECT l.nom as nom, l.duree as duree FROM aeroport_lieu l WHERE l.id_lieu = ".$id_depart;

			$result6 = mysql_query($query6) or die ($query6);
			while ($r6 = @mysql_fetch_assoc($result6)){
				$nom_depart = $r6["nom"];
				$duree = $r6["duree"];
			}
	//requête de récupération du lieu d'arrivé
	$query7 = "SELECT l.nom as nom, l.duree as duree FROM aeroport_lieu l WHERE l.id_lieu = ".$id_dest;

	$result7 = mysql_query($query7) or die (mysql_error());
	while ($r7 = @mysql_fetch_assoc($result7)){
		$nom_dest = $r7["nom"];
		if($duree==0){$duree = $r7["duree"];}
	}
$id = "";
$mere_id = 0;
$util_id = $_SESSION['user_id'];
$aty_id = 2;
$date = $dateDep  ;
$plage = 1;
$plage_duree = 1;

$detail = "
Voiture : ".$libelle_vehicule."

PRENDRE
";
$query3 = "SELECT *, DATE_FORMAT(heure, '%H') as heureDep, DATE_FORMAT(heure, '%Hh%i') as tpsDep, DATE_FORMAT(heure, '%i') as minutesDep from aeroport_ligne_resa WHERE id_trajet = '$numTrajet' ORDER BY heure";

$result3 = mysql_query($query3)or die(mysql_error());
$ok=true;

$nb_pers_total = 0;


while ($r3 = @mysql_fetch_assoc($result3)){
	$id_res = $r3["id_res"];
	$id_ligne = $r3["id_ligne"];
	$a_ete_mail = $r3["a_ete_mail"];
	$id_trajet = $r3["id_trajet"];
	$id_pt_rass = $r3["id_pt_rass"];
	$tpsDep = $r3["tpsDep"];
	$com = addslashes($r3["comm_bis"]);
	
	//lieu de rassemblement, soit adresse si personnalisé, soit pt rassemblement
	if($id_pt_rass == 4){
		$rassemblement = $r3["rassemblement"];		
	}
	else{
		$query5 = "SELECT fr from aeroport_rassemblement WHERE id_pt = '$id_pt_rass'";
		$result5 = mysql_query($query5)or die(mysql_error());
		$r5 = @mysql_fetch_assoc($result5);
		$rassemblement = $r5["fr"];
	}
	$info_vol =$r3["info_vol"];
	$nb_pers = $r3["nb_pers"];
	$heure = $r3["heure"];
	
	$rassemblement = addslashes($rassemblement);
	$query4 = "SELECT cli.civilite as civ, 
	cli.nom as nom, 
	cli.prenom as prenom, 
	cli.mail as mail, 
	cli.tel_port as telport, 
	cli.tel_fixe as telfixe,
	(SELECT aeroport_pays.identifiant_tel
	FROM aeroport_pays, aeroport_client
	WHERE aeroport_pays.id_pays = aeroport_client.ind_fixe
	AND aeroport_client.id_client = resa.id_client
	) AS indfixe, 
    (SELECT aeroport_pays.identifiant_tel
	FROM aeroport_pays, aeroport_client
	WHERE aeroport_pays.id_pays = aeroport_client.ind_port
	AND aeroport_client.id_client = resa.id_client
	) AS indport 
	from aeroport_client cli, aeroport_reservation resa WHERE resa.id_res = '".$id_res."' AND resa.id_client = cli.id_client";

	$result4 = mysql_query($query4)or die(mysql_error());
	

	$r4 = @mysql_fetch_assoc($result4);
		
		$civilite = $r4["civ"];
		$nom = addslashes($r4["nom"]);
		$prenom =addslashes($r4["prenom"]);
		$mail = $r4["mail"];
		$telport = $r4["telport"];
        $telfixe = $r4["telfixe"];
        
        $indfixe = $r4["indfixe"]; 
        $indport = $r4["indport"];

    $nb_pers_total += $nb_pers;
	
	$detail.="- ".$civilite." ".stripslashes($nom)." ".stripslashes($prenom)." (".$nb_pers." pers), ".stripslashes($rassemblement).", ".$heure."
	port: "."(".$indport.")".$telport." - fixe: "."(".$indfixe.")" .$telfixe."
	courriel : ".$mail."
	".$info_vol."
	";
	if($com!=""){$detail.="	( ".stripslashes($com)." )";}
}
$detail = addslashes($detail);
if(date("I", wp_mktime($dateSec)) == 0 ){//si on est en heure d'hiver, on fait -1 pour passer en UTC (format d'heure Phenix), sinon on fait -2
	$heureDep2 = $heureDep - 1;
	$minutesDep2 = $minutesDep /0.6;
	$heure_debut =$heureDep2.".".$minutesDep2  ; 
	$heureDuree=intval(abs($duree/3600)); 
	$minutesDuree=(abs($duree/3600)-intval(abs($duree/3600)))*60; 
	$heuresFin = $heureDuree + $heureDep;
	$minutesFin = ($minutesDuree + $minutesDep);
	if($minutesFin >=60){
		$minutesFin = $minutesFin - 60;
		$heuresFin = heuresFin +1;
	}
	if($heuresFin <25){ 
		$heuresFin = $heuresFin-1;
		$minutesFin = $minutesFin / 0.6;
		$heure_fin = $heuresFin.".".$minutesFin ;
	}
	else{
		$heure_fin = "00.00";
	}
}
else{
	$heureDep2 = $heureDep - 2;
	$minutesDep2 = $minutesDep /0.6;
	$heure_debut =$heureDep2.".".$minutesDep2  ; 
	$heureDuree=intval(abs($duree/3600)); 
	$minutesDuree=(abs($duree/3600)-intval(abs($duree/3600)))*60; 
	$heuresFin = $heureDuree + $heureDep;
	$minutesFin = ($minutesDuree + $minutesDep);
	if($minutesFin >=60){
		$minutesFin = $minutesFin - 60;
		$heuresFin = heuresFin +1;
	}
	if($heuresFin <25){ 
		$heuresFin = $heuresFin-2;
		$minutesFin = $minutesFin / 0.6;
		$heure_fin = $heuresFin.".".$minutesFin ;
	}
	else{
		$heure_fin = "00.00";
	}
}$rappel=1;
$rappel_coef=1440;
$email = 0;
$prive = 0;
$couleur = "orange";
$nb_participant=1;
$createur_id = $_SESSION['user_id'];
$query51 = "SELECT DATE_FORMAT(now(), '%H') as heureNow, DATE_FORMAT(now(), '%i') as minutesNow, DATE_FORMAT(now(), '%Y-%m-%d') as dateNow";
		$result51 = mysql_query($query51)or die(mysql_error());
		$r51 = @mysql_fetch_assoc($result51);
		$heureNow = $r51["heureNow"]-1;
		$minutesNow = $r51["minutesNow"];
		$dateNow = $r51["dateNow"];
		
$date_creation = $dateNow." ".$heureNow.":".$minutesNow.":00";
$modificateur_id = $_SESSION['user_id'];
$date_modif = "";

$libelle = $nom_depart." - ".$nom_dest . " (" . $nb_pers_total . " pers)";

	$reqVide = "SELECT * from aeroport_ligne_resa WHERE id_trajet = '".$numTrajet."'";
	$resVide = mysql_query($reqVide)or die(mysql_error());
	$numLigne = mysql_num_rows($resVide);
	if($numLigne !=0){
		$date_modif = $dateNow." ".$heureNow.":".$minutesNow.":00";
		$query2 = "UPDATE agenda_agenda SET age_mere_id = '$mere_id',
											age_util_id = $util_id,
											  age_aty_id = '$aty_id',
											  age_date = '$date',
											  age_heure_debut = '$heure_debut',
											  age_heure_fin = '$heure_fin',
											  age_plage = '$plage',
											  age_plage_duree = '$plage_duree',
											  age_libelle = '$libelle',
											  age_detail = '$detail',
											  age_rappel = '$rappel',
											  age_rappel_coeff = '$rappel_coeff',
											  age_email = '$email',
											  age_prive = '$prive',
											  age_couleur = '$couleur',
											  age_nb_participant = '$nb_participant',
											  age_modificateur_id = $modificateur_id,
											  age_date_modif = '$date_modif'
										WHERE id_trajet = '$numTrajet'";
		$result2 = mysql_query($query2)or die($query2);

	}
	else{
		$queryVide1 = "SELECT age_id FROM agenda_agenda WHERE id_trajet = '".$numTrajet."'";
		$resultVide1 = mysql_query($queryVide1)or die(mysql_error());
		while ($rVide1 = @mysql_fetch_assoc($resultVide1)){
			$queryVide3 = "DELETE FROM agenda_agenda_concerne WHERE aco_age_id = '".$rVide1["age_id"]."'";
			$resultVide3 = mysql_query($queryVide3)or die(mysql_error());
			
		}
		$queryVide2 = "DELETE FROM agenda_agenda WHERE id_trajet = '".$numTrajet."'";
		$resultVide2 = mysql_query($queryVide2)or die(mysql_error());
		$queryVide4 = "DELETE FROM aeroport_gestion_planning WHERE id_trajet = '".$numTrajet."'";
		$resultVide4 = mysql_query($queryVide4)or die(mysql_error());
		$queryVide5 = "DELETE FROM aeroport_trajet WHERE id_trajet = '".$numTrajet."'";
		$resultVide5 = mysql_query($queryVide5)or die(mysql_error());
		
	}
	}
	/*
	$reqPaye = mysql_query("SELECT est_paye FROM aeroport_ligne_resa WHERE id_trajet = '" . $trajetDest . "'") or die(mysql_error());
	$ok = true;
	while($row = mysql_fetch_assoc($reqPaye))
	{
		if($row['est_paye'] != "1")
			$ok = false;
	}
	
	if(!$ok)
	{
		mysql_query("UPDATE aeroport_trajet SET est_paye = '0' WHERE id_trajet = '" . $trajetDest . "'") or die(mysql_error());	
	}
	*/
	
	$r = @mysql_fetch_assoc($result);
	$idC = $r['id_chauffeur'];
	$idV = $r['id_vehicule'];
	$estValid = $r['estValide'];

// si trajet de destination déjà validé

	if($estValid ==1){

		$idChauffeur = $idC;
	$idVehicule = $idV;
	$numTrajet = $trajetDest;
	
	
	//sélection des infos du chauffeur
$query_chauff = "select * from chauffeur where idchauffeur= ".$idChauffeur;

$result_chauff = mysql_query($query_chauff)or die($query_chauff);
$r21 = @mysql_fetch_assoc($result_chauff);
$nomChauffeur = $r21['nom']." ".$r21['prenom'];
$numPortable = $r21['portable'];



$content_mail = "Bonjour " . $r21['prenom'] . ", <br /><br />Un petit mail pour vous informer que sur votre navette de " . $row_depart['nom'] . " vers " . $row_retour['nom'] . " du " . $row_trajet['date'] . ", une personne c'est rajoutée.<br /><br />Vous pouvez consulter l'agenda pour vérifier. <br /><br />Bonne route !";
		
	
    if($mode == "online")
    {
        mail($row_chauff['mail'], "Une personne en plus | " . utf8_decode($row_trajet['date']), $content_mail, header_mail());
    }
    else
    {
        file_put_contents("unepersonneneplus.html", $content_mail.$row_chauff['mail']);
    }



	//selection des infos du trajet
$query7= "SELECT id_lieu_depart, id_lieu_dest, id_vehicule, DATE_FORMAT(date, '%Y-%m-%d') as dateDep, DATE_FORMAT(date, '%d/%m/%Y') as dateDep2, DATE_FORMAT(date, '%H') as heureDep, DATE_FORMAT(date, '%i') as minutesDep FROM aeroport_trajet where id_trajet = '$numTrajet'";


			$result7 = mysql_query($query7) or die ($query7);
			while ($r7 = @mysql_fetch_assoc($result7)){
				$id_depart = $r7["id_lieu_depart"];
				$id_dest = $r7["id_lieu_dest"];
				$dateDep = $r7["dateDep"];
				$dateDep2 = $r7["dateDep2"];
				$heureDep = $r7["heureDep"];
				$minutesDep = $r7["minutesDep"];
			}

//selection des infos vehicule
	$query69 = "SELECT * FROM aeroport_vehicule l WHERE id_vehicule = ".$idVehicule;

			$result69 = mysql_query($query69) or die ($query69);
			$r69 = @mysql_fetch_assoc($result69);
			$libelle_vehicule = $r69["libelle"];
			
			
			
						
//selection du nom de départ et arrivée
	$query6 = "SELECT l.nom as nom, l.duree as duree FROM aeroport_lieu l WHERE l.id_lieu = ".$id_depart;

			$result6 = mysql_query($query6) or die ($query6);
			while ($r6 = @mysql_fetch_assoc($result6)){
				$nom_depart = $r6["nom"];
				$duree = $r6["duree"];
			}
	//requête de récupération du lieu d'arrivé
	$query7 = "SELECT l.nom as nom, l.duree as duree FROM aeroport_lieu l WHERE l.id_lieu = ".$id_dest;

	$result7 = mysql_query($query7) or die (mysql_error());
	while ($r7 = @mysql_fetch_assoc($result7)){
		$nom_dest = $r7["nom"];
		if($duree==0){$duree = $r7["duree"];}
	}
$id = "";
$mere_id = 0;
$util_id = $_SESSION['user_id'];
$aty_id = 2;
$date = $dateDep  ;
$plage = 1;
$plage_duree = 1;

$nb_pers_total = 0;

$detail = "
Voiture : ".$libelle_vehicule."

PRENDRE
";
$query3 = "SELECT *, DATE_FORMAT(heure, '%H') as heureDep, DATE_FORMAT(heure, '%Hh%i') as tpsDep, DATE_FORMAT(heure, '%i') as minutesDep from aeroport_ligne_resa WHERE id_trajet = '$numTrajet' ORDER BY heure";

$result3 = mysql_query($query3)or die(mysql_error());
$ok=true;
while ($r3 = @mysql_fetch_assoc($result3)){
	$id_res = $r3["id_res"];
	$id_ligne = $r3["id_ligne"];
	$a_ete_mail = $r3["a_ete_mail"];
	$id_trajet = $r3["id_trajet"];
	$id_pt_rass = $r3["id_pt_rass"];
	$tpsDep = $r3["tpsDep"];
	$com = addslashes($r3["comm_bis"]);
	
	//lieu de rassemblement, soit adresse si personnalisé, soit pt rassemblement
	if($id_pt_rass == 4){
		$rassemblement = $r3["rassemblement"];		
	}
	else{
		$query5 = "SELECT fr from aeroport_rassemblement WHERE id_pt = '$id_pt_rass'";
		$result5 = mysql_query($query5)or die(mysql_error());
		$r5 = @mysql_fetch_assoc($result5);
		$rassemblement = $r5["fr"];
	}
	$info_vol =$r3["info_vol"];
	$nb_pers = $r3["nb_pers"];
	$heure = $r3["heure"];
	$nb_pers_total += $nb_pers;
	$rassemblement = addslashes($rassemblement);
	$query4 = "SELECT cli.civilite as civ,
	cli.nom as nom,
	cli.prenom as prenom,
	cli.mail as mail,
	cli.tel_port as telport,
	cli.tel_fixe as telfixe,
	(SELECT aeroport_pays.identifiant_tel
	FROM aeroport_pays, aeroport_client
	WHERE aeroport_pays.id_pays = aeroport_client.ind_fixe
	AND aeroport_client.id_client = resa.id_client
	) AS indfixe, 
    (SELECT aeroport_pays.identifiant_tel
	FROM aeroport_pays, aeroport_client
	WHERE aeroport_pays.id_pays = aeroport_client.ind_port
	AND aeroport_client.id_client = resa.id_client
	) AS indport  
	from aeroport_client cli, aeroport_reservation resa WHERE resa.id_res = '".$id_res."' AND resa.id_client = cli.id_client";
	

	
	$result4 = mysql_query($query4)or die(mysql_error());
	
	while ($r4 = @mysql_fetch_assoc($result4)){
		
		$civilite = $r4["civ"];
		$nom = addslashes($r4["nom"]);
		$prenom =addslashes($r4["prenom"]);
		$mail = $r4["mail"];
		$telport = $r4["telport"];
        $telfixe = $r4["telfixe"];
        
        $indfixe = $r4["indfixe"]; 
        $indport = $r4["indport"];
        

		//pour éviter que les clients reçoivent le mail en double lors d'une revalidation
		if($a_ete_mail == 0){
			 
			$sujet_nouveau_client = "Votre réservation sur Alsace-navette.com ";
			$debut_nouveau_client = "Bonjour <b> ".$civilite." ".$nom." ".$prenom."</b>,<br /><br />La navette du <b> ".$dateDep2." à ".$tpsDep."</b>  pour <b> ".$nom_depart."</b> - <b> ".$nom_dest."</b> que vous avez réservée sur Alsace-navette.com a été validée par nos services ! <br />
			<b> ".$nomChauffeur."</b> vous accueillera à bord de nos navettes à l'heure et au lieu prévu lors de votre réservation. Vous pourrez joindre votre conducteur par téléphone au <b> (+33)".$numPortable."</b>.<br /><br />
			
			Vous pouvez également à tout moment retrouver ces informations sur <b> <a href=\"http://alsace-navette.com/aeroport\"> Alsace-navette.com </a></b> en vous connectant à l'aide de votre adresse e-mail et du mot de passe que vous avez reçu par courriel lors de votre première réservation. <br /><br /><br />
			Pour nous aider à améliorer nos services, nous avons mis en place un sondage, accessible <a href=\"http://alsace-navette.com/sondage/\">ici</a>.<br /><br /><br />
			Merci d'utiliser nos services et à bientôt sur Alsace-Navette.com ! ";
		
		 
	if($mode == "online")
    {
        mail($mail, utf8_decode($sujet_nouveau_client), $debut_nouveau_client, header_mail());
	
        mail("info@alsace-navette.com", utf8_decode($sujet_nouveau_client), $debut_nouveau_client, header_mail());
    }
    else
    {
        file_put_contents("toto.html", $sujet_nouveau_client." <br /><br />".$debut_nouveau_client);
    }

			$query_up_mail = "update aeroport_ligne_resa set a_ete_mail = '1' where id_ligne = '".$id_ligne."'";
			$result_mail = mysql_query($query_up_mail)or die(mysql_error());
		}
		
	}
	

	$detail.="
	- ".$civilite." ".stripslashes($nom)." ".stripslashes($prenom)." (".$nb_pers." pers), ".stripslashes($rassemblement).", ".$heure."
	port: "."(".$indport.")".$telport." - fixe: "."(".$indfixe.")" .$telfixe."
	courriel : ".$mail."
	".$info_vol."
	";
	if($com!=""){$detail.="	( ".stripslashes($com)." )";}
}
$detail = addslashes($detail);

	
	/*$r4 = @mysql_fetch_assoc($result4);
		
		$civilite = $r4["civ"];
		$nom = addslashes($r4["nom"]);
		$prenom =addslashes($r4["prenom"]);
		$mail = $r4["mail"];
		$telport = $r4["telport"];
	
	
	
	$detail.="
	- ".$civilite." ".stripslashes($nom)." ".stripslashes($prenom)." (".$nb_pers." pers), ".stripslashes($rassemblement).", ".$heure."
	tel: ".$telport." - " .$telfixe."
	courriel : ".$mail."
	".$info_vol."
	";
	if($com!=""){$detail.="	( ".stripslashes($com)." )";}
}
$detail = addslashes($detail);*/
$heureDep2 = $heureDep - 1;
$minutesDep2 = $minutesDep /0.6;
$heure_debut =$heureDep2.".".$minutesDep2  ; 
$heureDuree=intval(abs($duree/3600)); 
$minutesDuree=(abs($duree/3600)-intval(abs($duree/3600)))*60; 
$heuresFin = $heureDuree + $heureDep;
$minutesFin = ($minutesDuree + $minutesDep);
if($minutesFin >=60){
	$minutesFin = $minutesFin - 60;
	$heuresFin = heuresFin +1;
}
if($heuresFin <25){ 
	$heuresFin = $heuresFin-1;
	$minutesFin = $minutesFin / 0.6;
	$heure_fin = $heuresFin.".".$minutesFin ;
}
else{
	$heure_fin = "00.00";
}
$rappel=1;
$rappel_coef=1440;
$email = 0;
$prive = 0;
$couleur = "orange";
$nb_participant=1;
$createur_id = $_SESSION['user_id'];
$query51 = "SELECT DATE_FORMAT(now(), '%H') as heureNow, DATE_FORMAT(now(), '%i') as minutesNow, DATE_FORMAT(now(), '%Y-%m-%d') as dateNow";
		$result51 = mysql_query($query51)or die(mysql_error());
		$r51 = @mysql_fetch_assoc($result51);
		$heureNow = $r51["heureNow"]-1;
		$minutesNow = $r51["minutesNow"];
		$dateNow = $r51["dateNow"];
		
$date_creation = $dateNow." ".$heureNow.":".$minutesNow.":00";
$modificateur_id = $_SESSION['user_id'];
$date_modif = "";

$libelle = $nom_depart." - ".$nom_dest . " (" . $nb_pers_total . " pers)";

	$reqVide = "SELECT * from aeroport_ligne_resa WHERE id_trajet = '".$numTrajet."'";
	$resVide = mysql_query($reqVide)or die(mysql_error());
	$numLigne = mysql_num_rows($resVide);
	if($numLigne !=0){
		$date_modif = $dateNow." ".$heureNow.":".$minutesNow.":00";
		$query2 = "UPDATE agenda_agenda SET age_mere_id = '$mere_id',
											age_util_id = '$util_id',
											  age_aty_id = '$aty_id',
											  age_date = '$date',
											  age_heure_debut = '$heure_debut',
											  age_heure_fin = '$heure_fin',
											  age_plage = '$plage',
											  age_plage_duree = '$plage_duree',
											  age_libelle = '$libelle',
											  age_detail = '$detail',
											  age_rappel = '$rappel',
											  age_rappel_coeff = '$rappel_coeff',
											  age_email = '$email',
											  age_prive = '$prive',
											  age_couleur = '$couleur',
											  age_nb_participant = '$nb_participant',
											  age_modificateur_id = '$modificateur_id',
											  age_date_modif = '$date_modif'
										WHERE id_trajet = '$numTrajet'";
		$result2 = mysql_query($query2)or die($query2);

	}
	else{
		$queryVide1 = "SELECT age_id FROM agenda_agenda WHERE id_trajet = '".$numTrajet."'";
		$resultVide1 = mysql_query($queryVide1)or die(mysql_error());
		while ($rVide1 = @mysql_fetch_assoc($resultVide1)){
			$queryVide3 = "DELETE FROM agenda_agenda_concerne WHERE aco_age_id = '".$rVide1["age_id"]."'";
			$resultVide3 = mysql_query($queryVide3)or die(mysql_error());
			
		}
		$queryVide2 = "DELETE FROM agenda_agenda WHERE id_trajet = '".$numTrajet."'";
		$resultVide2 = mysql_query($queryVide2)or die(mysql_error());
		$queryVide4 = "DELETE FROM aeroport_gestion_planning WHERE id_trajet = '".$numTrajet."'";
		$resultVide4 = mysql_query($queryVide4)or die(mysql_error());
		$queryVide5 = "DELETE FROM aeroport_trajet WHERE id_trajet = '".$numTrajet."'";
		$resultVide5 = mysql_query($queryVide5)or die(mysql_error());
		
	}
	
		
		
		
		
		
		
		//	echo "maj_note(".$trajetDest.",".$emedm.",".$idC.",".$idV.");";  	
	}

	
	
	$numTrajet = $_POST['numTrajet'];
	$estValid = $_POST['estValid'];
	
	$reqVide = "SELECT * from aeroport_ligne_resa WHERE id_trajet = '".$numTrajet."'";

	$resVide = mysql_query($reqVide)or die(mysql_error());
	$numLigne = mysql_num_rows($resVide);
	
	if($numLigne == 0){
		$queryVide4 = "DELETE FROM aeroport_gestion_planning WHERE id_trajet = '".$numTrajet."'";
		$resultVide4 = mysql_query($queryVide4)or die(mysql_error());
		$queryVide5 = "DELETE FROM aeroport_trajet WHERE id_trajet = '".$numTrajet."'";
		$resultVide5 = mysql_query($queryVide5)or die(mysql_error());
		
		
		if($estValid ==1){
			
			$content_mail = "Bonjour " . $row_chauff['prenom'] . ", <br /><br />Un petit mail pour vous informer la navette de " . $row_depart['nom'] . " vers " . $row_retour['nom'] . " du " . $row_trajet['date'] . " à été supprimée.<br /><br />Vous pouvez consulter l'agenda pour vérifier. <br /><br />Bonne route !";
		
			
            if($mode == "online")
            {
                mail($row_chauff['mail'], "Suppression d'un trajet | " . utf8_decode($row_trajet['date']), $content_mail, header_mail());
            }
            else
            {
                file_put_contents("unnavetteenmions.html", $content_mail.$row_chauff['mail']);
            }
			
		}

	}
	
	
	echo "alert('La ligne a bien été déplacée vers le trajet " . $trajetDest . " !');";
	echo "window.location.reload(true);";
}
else
	echo "alert('Etes-vous bien sûr du trajet ? Nous ne l\'avons pas trouvé !');";

?>