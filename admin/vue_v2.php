<?php
	include("verifAuth.php");
	require_once("../libs/db.php");
	require_once("../includes/fonctions.php");
?>
	
<script src="SpryAssets/SpryCollapsiblePanel.js" type="text/javascript"></script>

<script src="../aeroport/scripts/jquery.js" type="text/javascript"></script>
<script src="scripts/tableau.js" type="text/javascript"></script>
<script src="scripts/supprimer_ligne.js" type="text/javascript"></script>
<script src="scripts/switcher_ligne.js" type="text/javascript"></script>
<script src="scripts/validTrajet.js" type="text/javascript"></script>
<link href="SpryAssets/SpryCollapsiblePanel.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />

<br /><br /><br /><br />

<!-- DIV CONTENANT LE CALENDRIER -->

<script type="text/javascript">

var ds_i_date = new Date();

<?php
	// Affichage des navettes vide, ou non
	if (isset($_POST['sh_empty'])){
		$_SESSION['show_empty_shuttle'] = ($_POST['sh_empty'] == "1") ? true : false;
	}
	
    function get_ind($id)
    {
        $r = mysql_query("SELECT identifiant_tel FROM aeroport_pays WHERE id_pays = " . $id);

        $rr = mysql_fetch_assoc($r);

        return $rr['identifiant_tel'];
    }

	if($_GET['action']=="2")
	{
		$t_date = explode('-', $_POST['date']);

		if($_POST['type_cal'] == "jour")
		{
	?>
		ds_c_month = <?php echo $t_date[1]; ?>;
		ds_c_year = <?php echo $t_date[2]; ?>;
	<?php
		}
		else
		{
		?>
			ds_c_month = <?php echo intval($t_date[0]); ?>;
			ds_c_year = <?php echo $t_date[1]; ?>;
		<?php
		}
	}
	else
	{
	?>
		ds_c_month = ds_i_date.getMonth() + 1;
		ds_c_year = ds_i_date.getFullYear();
	<?php
	}
?>	
	/*
		KEMPF : 
		Permet l'insertion des données des services annexes dans la liste
		Inséré dans une balise DIV ayant la date en tant qu'ID
		Si la balise n'existe pas, on la crée.
	*/

	function inner_html_annexe(div, html){
		var elem = document.getElementById(div);
		
		// Si l'élément existe déjà (Grace aux navettes classiques)
		if (elem){
			var nouvelElem = document.createElement("div");
			nouvelElem.style.width = "100%";
			nouvelElem.innerHTML = html;
			
			elem.appendChild(nouvelElem);
		}else{
		// Sinon, on va ajouter l'élément dans une balise que l'on aura crée
			var divDecoupe = div.substring(4, 14);
			var arrayDiv = divDecoupe.split('-');			
			var actualDate = new Date(parseInt(arrayDiv[2]), parseInt(arrayDiv[1]-1), parseInt(arrayDiv[0]), 0, 0, 0, 0);
			
			// Création de la balise
			var minimumDiff;
			var minimumElem;
			var firstLoop = true;
			(".dayDiv").each(function(){
				var decoupe = this.id.substring(4, 14);
				var arrayDayDiv = decoupe.split('-');
				var dayDivDate = new Date(parseInt(arrayDayDiv[2]), parseInt(arrayDayDiv[1]-1), parseInt(arrayDayDiv[0]), 0, 0, 0, 0);
				var diff = actualDate.getTime() - dayDivDate.getTime();
				
				if (firstLoop){
					minimumDiff = diff;
					minimumElem = this;
					firstLoop = false;
				}else{
					if (diff > 0 && minimumDiff > diff){
						minimumDiff = diff;
						minimumElem = this;
					}
				}

			});
			
			/* On calcul le jour de la semaine */
			var idJour = actualDate.getDay();
			var jour;
			
			switch(idJour){
				case 0:
					jour ="Dimanche";
					break;
				case 1:
					jour ="Lundi";
					break;
				case 2:
					jour ="Mardi";
					break;
				case 3:
					jour ="Mercredi";
					break;
				case 4:
					jour ="Jeudi";
					break;
				case 5:
					jour ="Vendredi";
					break;
				case 6:
					jour ="Samedi";
					break;
			}
			
			/* Panneau déroulant du trajet */
			var newElementTrajet = document.createElement("div"); 
			newElementTrajet.innerHTML = html;
			newElementTrajet.id = div;
			newElementTrajet.class = "dayDiv";
			document.getElementById("listeTrajets").insertBefore(newElementTrajet, minimumElem.nextSibling);
			
			/* Entete du jour */
			var newElementDate = document.createElement("h3"); 
			var leTexte = document.createTextNode(jour+" le "+divDecoupe);
			newElementDate.appendChild(leTexte);
			newElementDate.style.textAlign = "center";
			document.getElementById("listeTrajets").insertBefore(newElementDate, minimumElem.nextSibling);
		}
	}
	
	/*
		KEMPF : 
		Fonction permettant de modifier le contenu d'un commentaire 
		(Remplace le commentaire par un textarea)
	*/
	function autoriser_modification(id){
		var elem = document.getElementById("commentaire_annexe_"+id);
		var contenu = elem.innerHTML.replace(/\t/g, "");
		var bouton = document.getElementById("bouton_modif_"+id);
		
		elem.innerHTML = "<textarea style='width:90%;'>"+contenu+"</textarea>";
		
		bouton.innerHTML = "<img src='images/tick.png' onclick='enregistrer_modifiation("+id+");' />";
	}
	
	/*
		KEMPF :
		Fonction permettant d'enregistrer la modification du commentaire via AJAX
		(Récupère les données du textarea et envoie le contenu pour modifier dans la BBD
		puis retire le textarea)
	*/
	function enregistrer_modifiation(id){
	
		var elem = document.getElementById("commentaire_annexe_"+id);
		var textarea = elem.getElementsByTagName('textarea')[0];
		var valeur = textarea.value.replace(/\t/g, "");
		
		var httpRequest = false;
		
		if (window.XMLHttpRequest){   // Mozilla, Safari,...
		   httpRequest = new XMLHttpRequest();
		}else if (window.ActiveXObject){   // IE
			try {
				httpRequest = new ActiveXObject("Msxml2.XMLHTTP");
			}catch (e) {
				try {
					httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
				}catch (e) {}
			}
		}

		if (!httpRequest) {
			alert('Abandon :( Impossible de créer une instance XMLHTTP')
			return false
		}
		
		httpRequest.onreadystatechange = function(){
			if(httpRequest.readyState == 4) {
				eval(httpRequest.responseText);
			}
		}
		
		// On envoie les données à une page PHP qui s'occupera de faire le traitement avec la base de données		
		httpRequest.open("POST", "ajax_modifier_commentaire_annexe.php", true);
		httpRequest.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		httpRequest.send("id=" + id + "&valeur=" + valeur);
		
		// On actualise l'affichage chez l'utilisateur
		elem.innerHTML = valeur;
		
		var bouton = document.getElementById("bouton_modif_"+id);		
		bouton.innerHTML = "<img src='images/arrow_circle.png' onclick='autoriser_modification("+id+");' />";
	}
	
	
	/*
		Ajout KEMPF
		
		Fonctions d'ajout et de suppression d'un passager dans une ligne_resa
	*/
	
	function set_nb_passager(id_ligne_resa, nb, index)
	{
		if (nb <= 0 || nb >= 9)
		{
			alert("Impossible de modifier ! (Minimum : 1 - Maximum : 8)");
			return false;
		}
		else
		{
			if (confirm("Voulez-vous vraiment modifier le nombre de passagers de la réservation n°"+id_ligne_resa+" par "+nb+" ?"))
			{
				window.location='index.php?p=1&action=1&set_passager='+id_ligne_resa+'&nb_passager='+nb;
				return true;
			}
			else
			{
				return false;
			}
		}
	}
</script>
	
<?php
// KEMPF : Définition des fonctions PHP
function set_passager($id_ligne, $nb)
{
	if (isset($id_ligne) && isset($nb))
	{
		if ($nb > 0){
			mysql_query("	UPDATE aeroport_ligne_resa
							SET nb_pers = '".$nb."'
							WHERE id_ligne = '" .$id_ligne. "'
						") or die(mysql_error());
		}
	}
}

function get_nom_lieu($id){
		
	$query = '	SELECT nom_lieu
				FROM europa_lieu
				WHERE id_lieu = "'.$id.'"
			';
					
	$result = mysql_query($query) or die (mysql_error());
	
	$r = @mysql_fetch_assoc($result);
	
	$value = $r['nom_lieu'];
	
	return $value;
}

function get_indice($id){
	
	$query = '	SELECT identifiant_tel
				FROM aeroport_pays
				WHERE id_pays = "'.$id.'"
			';
					
	$result = mysql_query($query) or die (mysql_error());
	
	$r = @mysql_fetch_assoc($result);
	
	$value = $r['identifiant_tel'];
	
	return $value;
}

?>

<div style="width:100%;text-align:center;">
	<div style="width:50%;float:left;">
        <table class="ds_box" cellpadding="0" cellspacing="0" id="ds_conclass" style="display: none;">
        <tr><td id="ds_calclass">
        </td></tr>
        </table>
    </div>
    
    <script src="scripts/calendar.js" type="text/javascript"></script>
	<script type="text/javascript">
    <!--
        ds_sh();
    //-->
    </script>
    
    

    <div style="width:50%;float:left;text-align:center;">
        <table border="border-collapse:collapse">
			<tr>
                <th>Légende des couleurs</th>
            </tr>
            <tr>
            	<td style="background-color:#DDDDDD">Nouvelle demande</td>
            </tr>
            <tr>
                <td style="background-color:#6DFFE1">Demande non payée</td>
            </tr>
            <tr>
                <td style="background-color:#00CC33">Demande validée</td>
            </tr>
            <tr>
                <td style="background-color:#FB7E71">Rajout sur une demande validée</td>
           	</tr>
            <tr>
                <td style="background-color:#FFFF6A">Navette vide</td>
           	</tr>
        </table>
    </div>
</div>

<div style="height:2px;clear:both;"></div>


<!-- FORMULAIRE ENVOYE LORS D'UN CLIC SUR UN CHIFFRE DU CALENDRIER (voir les 6 dernières ligne de calendar.js) -->
<form id="form1" name="form1" action="index.php?p=1&amp;action=2" method="post" >
<!-- champ caché du formulaire contenant la date défini lors l'un clic sur un chiffre du calendrier -->
<input id ="date" name="date" type="hidden" value="" />
<input type="hidden" name="type_cal" id="type_cal" value="" />
</form>
<br />
  <?php

// connexion à la bdd
include("connection.php");



// préparation des requêtes pour une optimisation des performances

mysql_query("PREPARE req_lieu FROM 'SELECT l.nom AS nom FROM aeroport_lieu l WHERE l.id_lieu = ?'");

mysql_query("PREPARE req_res FROM 'SELECT ligne.id_ligne as idRes,
						  					ligne.nb_pers as nbPers,
											ligne.nb_enfant as nbEnf,
											res.id_res as id_res,
											res.commentaire as commentaire,
											res.res_der_min as res_der_min,
											res.opt_annulation,
											res.montant_opt_annulation,
											res.type_client as type_client_reserv,
											ligne.est_annule,
											ligne.est_paye as estPayeRes,
											DATE_FORMAT(res.date, \'%d-%m-%Y à %Hh%i\') as date_res,
											ligne.comm_bis as bis,
											ligne.id_pt_rass as idPt,			
											ligne.rassemblement as adresse,
											ligne.remboursement as remboursement,
											ligne.prix as prix,
											ligne.est_nuit as est_nuit,
											ligne.type_trajet as type_trajet,
											DATE_FORMAT(ligne.heure, \'%Hh%i\' ) as heure,   
											DATE_FORMAT(ligne.heure, \'%H:%i\' ) as heure2,
											ligne.info_vol as numVol,
                                            ligne.methode_paiement as methode_paiement,
											rassemblement.fr as nomRass,
											cli.id_client as idCli,
											cli.nom as nomCli,
											cli.prenom as prenomCli,
											cli.civilite as civCli,
											cli.tel_fixe as fixCli,
											cli.tel_port as portCli,
											cli.id_client as id_client,
											cli.nb_alea as code_cli,
                                            cli.ind_fixe as ind_fixe,
                                            cli.ind_port as ind_port
						  			FROM aeroport_reservation res,
											aeroport_rassemblement rassemblement,
											aeroport_client cli,
											aeroport_ligne_resa ligne
									WHERE ligne.id_trajet = ?
											AND ligne.id_res = res.id_res
											AND rassemblement.id_pt = ligne.id_pt_rass
											AND cli.id_client = res.id_client
									ORDER BY ligne.id_ligne'");

/*
	Ajout KEMPF
	
	Vérifications si demande de suppression ou ajout d'un passager
*/
if (isset($_GET['set_passager']) && isset($_GET['nb_passager']))
{
	// Envoi à la fonction
	
	set_passager($_GET['set_passager'], $_GET['nb_passager']);
}

if($_POST['voirCom'] == 1)
	mysql_query("PREPARE req_com FROM 'SELECT * from aeroport_recap_trajet WHERE idcm in (SELECT id_com FROM aeroport_gestion_planning WHERE id_trajet = ?)'");


	//sélection préalable de tous les chauffeurs (sans michel, provisoir avant de le supprimer proprement)
	$queryChauff = "select * from chauffeur where idchauffeur not in (select id_chauffeur from aeroport_conducteurs_exclus)";
	$resultChauff = mysql_query($queryChauff) or die (mysql_error());
	
	//sélection préalable de tous les véhicules
	$queryVehicule = "select * from aeroport_vehicule";
	$resultVehicule = mysql_query($queryVehicule) or die (mysql_error());
	
	
	//SI L'UTILISATEUR N'A PAS CHOISI DE DATE DANS LE CALENDRIER
	if($_GET['action']==1){
		//il n'y aura pas de complément dans la requete
		$msg = " AND t.date >= NOW()";
		$msg_annexe = " AND t.date_trajet >= NOW()";
	}
	//SI L'UTILISATEUR A CHOISI UNE DATE
	elseif($_GET['action']=="2"){
		//on récupère la date en question
		$date = $_POST['date'];
		$type_cal = $_POST['type_cal'];
		
		if($type_cal == "jour")
		{
			//et on complète la requète pour prendra la date en compte
			$msg = " AND DATE_FORMAT(t.date, '%d-%m-%Y' ) ='".$date."'";
			$msg_annexe = " AND (DATE_FORMAT(t.date_trajet, '%d-%m-%Y' ) ='".$date."')";
		}
		else
		{
			//et on complète la requète pour prendra la date en compte (seulement le mois
			$msg = " AND DATE_FORMAT(t.date, '%m-%Y' ) ='".$date."'";
			$msg_annexe = " AND DATE_FORMAT(t.date_trajet, '%m-%Y' ) ='".$date."'";
		}
	}
	
	
	//requete de sélection des trajets à la date voulue s'il y en a une
	$query = "SELECT t.id_trajet as id_trajet,
					DATE_FORMAT(t.date, '%w' ) as jour,
					DATE_FORMAT(t.date, '%d-%m-%Y' ) as dateDep,
					DATE_FORMAT(t.date, '%Hh%i' ) as heureDep,
					DATE_FORMAT(t.date, '%Y-%m-%d %H:%i:%s' ) as dateFull,
					t.estValide as estValide,
					t.est_paye as est_paye,
					t.emedm as emedm,
					t.id_vehicule as idV,
					v.libelle as libelle,
					c.nom as nom,
					c.idchauffeur as idC,
					c.prenom as prenom ,
					t.id_lieu_depart as id_depart,
					t.id_lieu_dest as id_dest
			  FROM aeroport_trajet t,
				   chauffeur c,
				   aeroport_vehicule v
			  WHERE c.idchauffeur = t.id_chauffeur 
			  AND v.id_vehicule = t.id_vehicule
			  ".$msg." 
			  ORDER BY t.date ASC";
			  
	/*
		Ajout KEMPF : Requete des navettes sur les services annexes
	*/
	$query_annexe = "	SELECT *,
							DATE_FORMAT(t.date_trajet, '%w' ) as jour_trajet,
							DATE_FORMAT(t.date_trajet, '%d-%m-%Y' ) as date_trajet,
							DATE_FORMAT(t.date_trajet, '%Hh%i' ) as heure_trajet,
							DATE_FORMAT(r.date, '%d-%m-%Y %Hh%i' ) as date_reserv
						FROM europa_reservation r,
							europa_client c, 
							europa_lieu l,
							europa_trajet t,
							europa_ligne_reserv ligne
						WHERE r.id_client = c.id_client
						AND ligne.code_reserv = r.id_reservation
						AND ligne.code_trajet = t.id_trajet 
						".$msg_annexe." 
						GROUP BY ligne.id_ligne
						ORDER BY t.date_trajet ASC";
				  
	$result_annexe = mysql_query($query_annexe) or die (mysql_error());
				  
	$result = mysql_query($query) or die (mysql_error());
	
	$nbreq = mysql_num_rows($result);
	
	if(isset($_POST['type_cal']) && $_POST['type_cal'] != "jour")
	{
		$date = explode('-', $_POST['date']);

		$tab_mois = array("Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre");
		
	?>
		<h2 style="text-align:center;">Mois de <?php echo $tab_mois[intval($date[0])-1] . " " . intval($date[1]); ?></h2>
		<br />
	
	<?php
	}
	?>
	<form action="#" method="post" name="voirCom" style="display:inline">
    	<input id ="date" name="date" type="hidden" value="<?php echo $_POST['date']; ?>" />
		<input type="hidden" name="type_cal" id="type_cal" value="<?php echo $_POST['type_cal']; ?>" />
        <?php
		if($_POST['voirCom']==1){
			?>
            <input id ="voirCom" name="voirCom" type="hidden" value="0" />
            <input value="Cacher les commentaires" type="submit" />
            <?php
			
		}
		else{
			?>
            <input id ="voirCom" name="voirCom" type="hidden" value="1" />
            <input value="Voir les commentaires" type="submit" />
            <?php
		}
		
		
		?>
    </form>
	<form action="http://alsace-navette.com/admin/index.php?p=1&action=1" method="post" name="show_empty_shuttle" style="display:inline">
    	<input name="sh_empty" type="hidden" value="<?= (!$_SESSION['show_empty_shuttle']) ? 1 : 0 ?>" />
		<input type="submit" value="<?= (!$_SESSION['show_empty_shuttle']) ? "Afficher les navettes vides" : "Masquer les navettes vides" ?>" />
    </form>
	<div id="listeTrajets">
	<?php
	//teste de la présence de trajet à cette date
	if ($nbreq == "0"){
		echo "
			<br />
			<br />
			<div style='width:100%;text-align:center;'>
				Il n'y a pas de réservation à cette date
			</div>";
	}
	else{
		$start_draw = true;
		$oldDate = "";
		
		// id pour la modification du prix
		$id_affiche = 0;

		while ($r = @mysql_fetch_assoc($result))
		{ 
		
			$nb_paye = 0;
			$nb_pas_paye = 0;
            $nb_passager = 0;
		
			//récupération des données
			$prenom = $r["prenom"];
			$nom = $r["nom"];
			$dateDep = $r["dateDep"];
			$jour = $r["jour"];
			$idC = $r["idC"];
			$idV = $r["idV"];
			$libelle = $r["libelle"];
			$heureDep = $r["heureDep"];
			$id_trajet = $r["id_trajet"];
			$id_dest = $r["id_dest"];
			$id_depart = $r["id_depart"];
			$estValide = $r["estValide"];
			$estPaye = $r["est_paye"];
			$emedm = $r["emedm"];
		
			//écriture de la date si nouveau jour
			
			if($dateDep != $oldDate){
				$oldDate = $dateDep;
				switch($jour){
					case 0:
						$day ="Dimanche ";
						break;
					case 1:
						$day ="Lundi ";
						break;
					case 2:
						$day ="Mardi ";
						break;
					case 3:
						$day ="Mercredi ";
						break;
					case 4:
						$day ="Jeudi ";
						break;
					case 5:
						$day ="Vendredi ";
						break;
					case 6:
						$day ="Samedi ";
						break;
				}
				if (!$start_draw){
					// Fin du div du jour précédent
					echo "</div>";
				}
				?>
					<h3 style="text-align:center;"><?php echo $day."le ".$dateDep; ?></h3>
					<div style="width=100%;" id="day_<?=$dateDep ?>" class="dayDiv">
                <?php
				$start_draw = false;
			}
			
			/////////////////////////////
			
			
			
			mysql_query("SET @id_depart = " . $id_depart);
			$result2 = mysql_query("EXECUTE req_lieu USING @id_depart");
			while ($r2 = @mysql_fetch_assoc($result2)){
				$nom_depart = $r2["nom"];
			}
			
			mysql_query("SET @id_dest = " . $id_dest);
			$result3 = mysql_query("EXECUTE req_lieu USING @id_dest");
			while ($r3 = @mysql_fetch_assoc($result3)){
				$nom_dest = $r3["nom"];
			}
			
				?>
                
				<!-- DIV DU PANNEAU EXTENSIBLE (en spry -> librairie JS fournie par adobe dans DREAMWEAVER à partir de la version CS3) -->

					<div id="CollapsiblePanel<?php echo $id_trajet; ?>" class="CollapsiblePanel" style="width:100%">
					   <!-- BARRE SUPERIEUR (résumé du trajet) -->
					   <?php 	
							if($emedm == 1){
								$top_bar_color = "style='background-color:#FB7E71;'";
							}
							else if($estPaye == 0){
								$top_bar_color = "style='background-color:#6DFFE1;'";
							}
							else if($estValide == 1 && $emedm == 0){
								$top_bar_color = "style='background-color:#0C3;'";
							}
							else if($estPaye == 1 && $estValide == 0){
								$top_bar_color = "style='background-color:#DDDDDD;'";
							}
						?>
						<div class="CollapsiblePanelTab" id="barre<?php echo $id_trajet; ?>" <?=$top_bar_color?>>
						
							<table id="tbl<?php echo $id_trajet; ?>" width="100%" border="0" cellpadding="1" style="font-family:Verdana, Geneva, sans-serif;">
								<tr>
									<th style="width:5%;"><?php echo $id_trajet; ?></th>
									<th style="width:20%;"><?php echo " Départ le ".$dateDep." à ".$heureDep; ?></th>
									<th style="width:30%;"><?php echo $nom_depart." -> ".$nom_dest; ?></th>
									<th style="width:10%;" id="tab_chauffeur_<?php echo $id_trajet; ?>"><?php echo $nom." ".$prenom; ?></th>
									<th style="width:10%;" id="tab_vehicule_<?php echo $id_trajet; ?>"><?php echo $libelle; ?></th>
									<th style="width:15%;">Payé / Non payé : <span id="nb_paye_<?php echo $id_trajet; ?>"></span>/<span id="nb_pas_paye_<?php echo $id_trajet; ?>"></span></th>
									<th style="width:10%;">Passagers : <span id="nb_passager_<?php echo $id_trajet; ?>"></span></th>
								</tr>
							</table>
						   
						</div>
						
						<!-- ZONE DE CONTENU (détail de chaque réservation pour le trajet) -->
						<div class="CollapsiblePanelContent" style="display:none">
							<div style="overflow-x:hidden; overflow-y:hidden; width:100%; height:100%;">
							
								<table width="100%" border="0">
									<tr>
										<td>
											<?php
												if ($estValide == 0){
											?>
											<input type="button" id="btn_valid<?php echo $id_trajet; ?>"  value="Valider le trajet" onclick="valid(<?php echo $id_trajet; ?>, <?php echo $emedm; ?>);"/>
											<?php
												}
											?>
										</td>
										<td>
											<form action="changerChauffeur.php" method="post">
												
												<select name="idChauffeur" id="chauffeur<?php echo $id_trajet; ?>">
												<?php 
												mysql_data_seek($resultChauff, 0);
												while ($rChauff = @mysql_fetch_assoc($resultChauff)){
													?>
													<option value="<?php echo $rChauff["idchauffeur"]; ?>" <?php if($idC ==$rChauff["idchauffeur"]){echo "selected=\"selected\"";}?> ><?php echo $rChauff["nom"]." ".$rChauff["prenom"] ; ?></option>
													<?php
												}
												?>
												</select>
												
												<select name="idVehicule" id="vehicule<?php echo $id_trajet; ?>">
												<?php 
												mysql_data_seek($resultVehicule, 0);
												while ($rVehicule = @mysql_fetch_assoc($resultVehicule)){
													?>
													<option value="<?php echo $rVehicule["id_vehicule"]; ?>" <?php if($idV ==$rVehicule["id_vehicule"]){echo "selected=\"selected\"";}?> ><?php echo $rVehicule["libelle"]; ?></option>
													<?php
												}
												?>
												</select>
												
												<input name="idTrajet" type="hidden" value="<?php echo $id_trajet; ?>" />
												<input type="submit" id="changer<?php echo $id_trajet; ?>" value="Changer le conducteur/vehicule"/>
												
											 </form>
										</td>
									</tr>
								</table>
                            <?php 
								if($emedm == 1)
								{ 
							?>
								<input type="button" id="btn_valid<?php echo $id_trajet; ?>"  value="Valider le trajet" onclick="valid2(<? echo $id_trajet; ?>, <? echo $idC; ?>, <? echo $idV; ?>);"/>
							<?php 
								}
							?>
								<input type="hidden" id="estValide_<?php echo $id_trajet; ?>" value="<?php echo $estValide; ?>" />
								
								<!-- 
									Début du tableau des résultats 
								-->	
								<table width="100%" id="<?php echo $id_trajet; ?>" border="1">
									<tr>
										<th style="width:2%;background:#B0D8FF;"> ID </th>
										<th style="width:15%;background:#B0D8FF;"> Client </th>
										<th style="width:3%;background:#B0D8FF;"> Nombre </th>
										<th style="width:10%;background:#B0D8FF;"> Tel </th>
										<th style="width:15%;background:#B0D8FF;"> Vol </th>
										<th style="width:5%;background:#B0D8FF;"> Heure </th>
										<th style="width:15%;background:#B0D8FF;"> Point de rassemblement </th>
										<th style="width:15%;background:#B0D8FF;"> Commentaires </th>
										<th style="width:15%;background:#B0D8FF;"> Infos </th>
										<th style="width:5%;background:#B0D8FF;"> Options </th>
									 </tr>
								
							<?php
							
							// Sélection du détail des réservations correspondant au trajet en cours
							mysql_query("SET @id_trajet = " . $id_trajet);
							$result4 = mysql_query("EXECUTE req_res USING @id_trajet") or die (mysql_error());
							
                            while ($r4 = @mysql_fetch_assoc($result4)){
                                $idRes = $r4["idRes"];//
								$nbPers = $r4["nbPers"]+$r4["nbEnf"];//
								$commentaire = $r4["commentaire"];//
								$bis = $r4["bis"];//
								$idPt = $r4["idPt"];//
								$adresse = $r4["adresse"];//
								$numVol = nl2br($r4["numVol"]);//
								$heure = $r4["heure"];//
								$nomRass = $r4["nomRass"];//
								$nomCli = $r4["nomCli"];//
								$prenomCli = $r4["prenomCli"];//
								$civCli = $r4["civCli"];//
								$fixCli = $r4["fixCli"];//
								$portCli = $r4["portCli"];//
								$mnt_a_rembourser = $r4["remboursement"];
								$date_de_res = $r4["date_res"];
								$prix = $r4["prix"];
								$estPayeRes = $r4["estPayeRes"];
								$id_client = $r4["idCli"];
								$id_res = $r4["id_res"];
								$code_cli = $r4["code_cli"];
								$est_nuit = $r4["est_nuit"];
								$supplement = 0; // supplement de la réservation de dernière minute (seulement pour l'aller)
                                $methode_paiement = $r4['methode_paiement'];
								$aller_simple = $r4['estSimple'];
								
								// On remplace E-transaction par CA (Pour éviter de déborder)
								$methode_paiement = ($methode_paiement == "e-transaction") ? "CA" : $methode_paiement;
								
								// KEMPF : Option annulation
								$aOptAnnulation = $r4["opt_annulation"];
								$estAnnulee = $r4["est_annule"];
								
								// KEMPF : Type du client
								$type_client_reserv = $r4["type_client_reserv"] == "" ? "" : "<br /><br /><strong>".$r4["type_client_reserv"]."</strong>";
								
								$bonus_background = ($estAnnulee == 1) ? "background-color:#FFB9B9;" : "";
								
                                $nb_passager += $nbPers;
								
								if($estPayeRes == 0)
									$nb_pas_paye++;
								else
									$nb_paye++;


                                $id_affiche++;
								
								if($r4['type_trajet'] == 'ALLER')
								{
									if($r4['res_der_min'] == "24")
										$supplement = intval(get_option("maj_24"));
									elseif($r4['res_der_min'] == "72")
										$supplement = intval(get_option("maj_72"));
								}

                                $ind_fixe = get_ind($r4['ind_fixe']);
                                $ind_port = get_ind($r4['ind_port']);
								
								// Jour majoré : dateFull
									
								// Kempf : Ajout d'un texte spécifiant si c'est un trajet de nuit 
								$bonus_horaire_nuit = ($est_nuit == 1) ? "<br /><strong style='color:red'>Nuit</strong>" : "";
								
								// Kempf : Tests sur la facon de récupérer la facture liée à une ligne_resa
								$id_de_la_facture = get_facture($id_client, $dateDep);
								$date_paiement = get_date_facture($id_client, $dateDep);
								if (!empty($id_de_la_facture)){
									$txt_facture = '
										<br />
										<br />
										<a target="blank_" style="font-style:italic;" href="http://alsace-navette.com/aeroport/facture-'.sha1($id_de_la_facture).'">Facture n°'.$id_de_la_facture.'</a>
										<br />
										<br />
										<a href="http://alsace-navette.com/admin/index.php?p=28&id='.$id_de_la_facture.'">Modifier manuellement cette facture</a>';
								}else{
									if ($estPayeRes == 1) {
										$txt_facture = "<br /><input id='clickMe' type='button' value='Créer une facture' onclick='creationfacture($idRes);' />";
									}
								}
								?>
                               
								<tr id="ligne<?php echo $idRes; ?>" style="<?=$bonus_background?>">
                                    <td style="text-align:center;"><?php echo $idRes; ?></td><input type="hidden" value="$estPayeRes" />
                                    <td>
										<a href="index.php?p=5&amp;id=<?php echo $id_client; ?>" target="_blank"><?php echo $civCli." ".$nomCli." ".$prenomCli; ?></a>
										
										<?=$type_client_reserv?>
										<?=$txt_facture?>
									</td>
                                    <td style="text-align:center;">
										<?php 
											/*
												Modifications KEMPF
												
												Possiblité de modifier le nombre de personnes sur un trajet.
												
												Lorsque l'on clique sur le premier Div, celui ci se cache 
												et laisse place à la combobox
											*/
											$actualId = $nbPers - 1;
										?>	
										<div id="div_set_nb_passager<?php echo $idRes; ?>" onClick="this.style.display='none';document.getElementById('select_set_nb_passager<?php echo $idRes; ?>').style.display='block';document.getElementById('select_set_nb_passager<?php echo $idRes; ?>').focus();">
											<?php echo "&nbsp;".$nbPers."&nbsp;"; ?>
										</div>
										
										<div id="select_set_nb_passager<?php echo $idRes; ?>" style="display:none;" >
											<select onChange="if (<?php echo $nbPers; ?> != this.options[this.selectedIndex].value){if(!set_nb_passager(<?php echo $idRes; ?>, this.options[this.selectedIndex].value)){this.selectedIndex = <?php echo $actualId; ?>;};}">
												<?php 
												for ($i=1;$i<9;$i++){
													?>
													
													<option value="<?php echo $i; ?>" <?php if($i ==$nbPers){echo "selected=\"selected\"";}?> ><?php echo $i; ?></option>
													
													<?php
												}
												?>
											</select>
										</div>
										<!--
											Fin modifs
										-->
									</td>

                                    <td style="text-align:center;">
										<?php 
											echo ($fixCli != '') ? "(".$ind_fixe.")".$fixCli : ""; 
											echo ($fixCli != '' && $portCli != '') ? "<br />" : ""; 
											echo ($portCli != '') ? "(".$ind_port.")".$portCli : ""; 
										?>
									</td>
                                    <td style="text-align:center;"><?php echo $numVol; ?></td>
                                    <td style="text-align:center;"><?php echo $heure.$bonus_horaire_nuit; ?></td>
                                    <td style="text-align:center;"><?php if($nomRass == "Domicile"){echo $adresse;} else{echo $nomRass;} ?></td>
                                    <td><?php echo nl2br($bis); ?></td>
                                    <td>
										<u>Prix</u> : <a onclick="window.open(this.href, 'Modification du prix d\'réservation', 'width=450,height=300,resizable=yes'); return false;" href="modif_prix.php?id_res=<?php echo $id_res; ?>&id_trajet=<?php echo $id_trajet; ?>&id_ligne=<?php echo $idRes; ?>&id_affiche=prix_<?php echo $id_affiche; ?>&id_facture=<?php echo $id_de_la_facture; ?>&date_depart=<?echo $dateDep; ?>" id="prix_<?php echo $id_affiche; ?>"><?php echo ($prix); ?> €</a>
										<br />
										<u>Est payé</u> : <?php echo ($estPayeRes == 0) ? "<span style='color:#FF6262;font-weight:bold;'>Non</span>" : "<span style='color:#00CC33;font-weight:bold;'>Oui</span>"; ?><?=((!empty($methode_paiement)) ? " (" . $methode_paiement . ")" : "") ?>
										<br />
										<u>Opt. annulation</u> : <?php echo ($aOptAnnulation == 0) ? "<span style='color:#FF6262;font-weight:bold;'>Non</span>" : "<span style='color:#00CC33;font-weight:bold;'>Oui</span>"; ?>
										<br />
										<u>A rembourser</u> : <a onclick="window.open(this.href, 'Modification du prix d\'réservation', 'width=450,height=250,resizable=yes'); return false;" href="modif_remb.php?id_ligne=<?php echo $idRes; ?>&id_affiche=remb_<?php echo $id_affiche; ?>" id="remb_<?php echo $id_affiche; ?>"><?php echo $mnt_a_rembourser; ?> €</a>
										<br />
										<u>Date</u> : <?php echo $date_de_res; ?>
										<br />
										<?php echo '<a href="../aeroport/reservation/paiement-manuel-'.$id_client.'-'.$id_res.'-'.$id_trajet.'-0-'.$idRes.'-0-0-'.$code_cli.'.html" target="_blank">Détail du prix</a>';?>
										<br />
										<?php if (!empty($date_paiement)) { ?><u>Date paiement</u> : <?php echo $date_paiement; }?>
									</td>
                                    <td style="text-align:center">
                                    

                                    <img src="images/poubelle.jpg" title="Supprimer" width="35" height="35" alt="Supprimer"  style="cursor:pointer" onclick="supprimer_ligne(<?php echo $idRes; ?>,<?php echo $id_trajet; ?>,<?php echo $idC; ?>,<?php echo $idV; ?>);"/>
                                    			<hr />
                                    <img src="images/switch.png" width="35" height="35" alt="Changer" onclick="switcher_ligne(<?php echo $idRes; ?>,<?php echo $id_trajet; ?>,<?php echo $idC; ?>,<?php echo $idV; ?>);" title="Changer" style="cursor:pointer" />

                                    <?php
										if($estPayeRes == 0)
										{
										?>
											<hr />
                                           
                                            <?php echo '<a href="../aeroport/reservation/paiement-manuel-'.$id_client.'-'.$id_res.'-'.$id_trajet.'-0-'.$idRes.'-0-0-'.$code_cli.'.html" target="_blank">Payer</a>';
											?>
                                           <input type="hidden" value="test" />
                                            <input type="button" value="A payé (PayPal)" onclick="change_a_paye('<?php echo $idRes; ?>', 'aeroport_ligne_resa', '1', 'id_ligne');change_mode_paiement('<?php echo $idRes; ?>', 'PayPal');creationfacture('<?php echo $idRes; ?>');" />
                                            <input type="button" value="A payé (CA)" onclick="change_a_paye('<?php echo $idRes; ?>', 'aeroport_ligne_resa', '1', 'id_ligne');change_mode_paiement('<?php echo $idRes; ?>', 'e-transaction');creationfacture('<?php echo $idRes; ?>');" />
                                            <input type="button" value="A payé (Autre)" onclick="change_a_paye('<?php echo $idRes; ?>', 'aeroport_ligne_resa', '1', 'id_ligne');change_mode_paiement('<?php echo $idRes; ?>', 'autre');creationfacture('<?php echo $idRes; ?>');" />
                                      
											<?php
										 }
										/* else
										 {
											?>
                                            <hr />
                                            <input type="button" value="N'a pas payé" onclick="change_a_paye('<?php echo $idRes; ?>', 'aeroport_ligne_resa', '0', 'id_ligne');" />
                                            <?php
										 }*/
										 ?>
                                         		
                                   	</td>
                                </tr>
								
								
								<?php
                            }
                          
                          ?>
                          </table>
						  
						  <?php
							
							// Ajout KEMPF : Bouton Annuler si pas de passagers sur la navette
							if ($nb_passager == 0 && !$estValide){
								
								echo '
									<table width="100%" border="0">
										<tr>
											<td>
												<form action="scripts/annulerTrajet.php" method="POST">
													<input type="hidden" value="'.$id_trajet.'" name="id_trajet" />
													<input type="submit" id="btn_annuler_'.$id_trajet.'"  value="Annuler" />
												</form>
											</td>
										</tr>
									</table>';
								
							}
							
						  ?>
						  
                          <!-- affichage du commentaire du chauffeur si souhaité  -->
                          <?php
                          		if($_POST['voirCom'] == 1){
									
									
									$res_com = mysql_query("EXECUTE req_com USING @id_trajet") or die (mysql_error());
									while($r_com = @mysql_fetch_assoc($res_com)){
										$id_conducteur = $r_com["id_conducteur"];
										$id_vehicule = $r_com["id_vehicule"]; 	
										$date = $r_com["date"];
										$heureD_str = $r_com["heureD_str"];
										$heureA_aero = $r_com["heureA_aero"];
										$heureD_aero = $r_com["heureD_aero"];
										$heureA_str = $r_com["heureA_str"];
										$nb_grp_aller = $r_com["nb_grp_aller"];
										$nb_grp_retour = $r_com["nb_grp_retour"];
										$pass_aller_res = $r_com["pass_aller_res"];
										$pass_retour_res = $r_com["pass_retour_res"];
										$kmsD = $r_com["kmsD"];
										$kmsA = $r_com["kmsA"];
										$niv_essence_depart = $r_com["niv_essence_depart"];
										$niv_essence_arrivee = $r_com["niv_essence_arrivee"];
										$remarques = stripcslashes($r_com["remarques"]);
										$pass_aller_nonres = $r_com["pass_aller_nonres"];
										$pass_retour_nonres = $r_com["pass_retour_nonres"];
										$montantA = $r_com["montantA"];	
										$montantR = $r_com["montantR"];
										$essence = $r_com["essence"];	
										$lavext = $r_com["lavext"];
										$lavint = $r_com["lavint"];
										$unites = $r_com["unites"];
										$depot = $r_com["depot"];
										
										$queryChauff2 = "select * from chauffeur where idchauffeur = ".$id_conducteur."";
										$resultChauff2 = mysql_query($queryChauff2) or die (mysql_error());
										$rChauff2 = @mysql_fetch_assoc($resultChauff2);
										$queryVehicule2 = "select * from aeroport_vehicule where id_vehicule = ".$id_vehicule."";
										$resultVehicule2 = mysql_query($queryVehicule2) or die (mysql_error());
										$rVehi2 = @mysql_fetch_assoc($resultVehicule2);
										
										?>
                                        <br />
                                        <br />
										<div style="float:left">
                                              <table border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                  <td width="350px"><strong>Chauffeur : </strong></td>
                                                  <td><?php echo $rChauff2["nom"]." ".$rChauff2["prenom"] ; ?></td>
                                                </tr>
                                                <tr>
                                                  <td><strong>Vehicule : </strong></td>
                                                  <td><?php echo $rVehi2["libelle"]; ?></td>
                                                </tr>
                                                <tr>
                                                  <td><strong>Heure dep Strasbourg : </strong></td>
                                                  <td><?php echo $heureD_str; ?></td>
                                                </tr>
                                                <tr>
                                                  <td><strong>Heure arrivée aéroport : </strong></td>
                                                  <td><?php echo $heureA_aero; ?></td>
                                                </tr>
                                                <tr>
                                                  <td><strong>Heure dép aéroport : </strong></td>
                                                  <td><?php echo $heureD_aero; ?></td>
                                                </tr>
                                                <tr>
                                                  <td><strong>Heure arrivée Strasbourg : </strong></td>
                                                  <td><?php echo $heureA_str; ?></td>
                                                </tr>
                                                <tr>
                                                  <td><strong>Nb passagers aller/retour ayant réservés : </strong></td>
                                                  <td><?php echo $pass_aller_res." personnes/ ".$pass_aller_res. "personnes"; ?></td>
                                                </tr>
                                                <tr>
                                                  <td><strong>Nb passagers aller/retour n'ayant pas réservés : </strong></td>
                                                  <td><?php echo $pass_aller_nonres." personnes/ ".$pass_aller_nonres. " personnes"; ?></td>
                                                </tr>
                                                <tr>
                                                <tr>
                                                  <td><strong>Montant reçu en liquide à l'aller: </strong></td>
                                                  <td><?php echo $montantA." €"; ?></td>
                                                </tr>
                                                <tr>
                                                  <td><strong>Montant reçu en liquide au retour: </strong></td>
                                                  <td><?php echo $montantR." €"; ?></td>
                                                </tr>
                                                <td><strong>Nb groupes aller/retour : </strong></td>
                                                  <td><?php echo $nb_grp_aller." grp /".$nb_grp_retour." grp"; ?></td>
                                                </tr>
                                                 </table>
                                            </div>
                                             <div style="float:left;">
                                            <table border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                  <td><strong>Kilomètres au compteur (départ) : </strong></td>
                                                  <td><?php echo $kmsD." km"; ?></td>
                                                </tr>

                                                <tr>
                                                  <td><strong>Kilomètres au compteur (arrivée) : </strong></td>
                                                  <td><?php echo $kmsA." km"; ?></td>
                                                </tr>
                                                <tr>
                                                  <td><strong>Niveau d'essence (départ) : </strong></td>
                                                  <td><?php echo $niv_essence_depart; ?></td>
                                                </tr>
                                                <tr>
                                                  <td><strong>Niveau d'essence (départ) : </strong></td>
                                                  <td><?php echo $niv_essence_arrivee; ?></td>
                                                </tr>
                                                <tr>
                                                  <td><strong>Frais de carburant :</strong></td>
                                                  <td><?php echo $essence; ?></td>
                                                </tr>
                                                <tr>
                                                  <td><strong>Lavage extérieur du véhicule : </strong></td>
                                                  <td><?php echo $lavext; ?></td>
                                                </tr>
                                                <tr>
                                                  <td><strong>Lavage intérieur du véhicule : </strong></td>
                                                  <td><?php echo $lavint; ?></td>
                                                </tr>
                                                <tr>
                                                  <td><strong>Unités de lavage consommées : </strong></td>
                                                  <td><?php echo $unites; ?></td>
                                                </tr>
                                                <tr>
                                                  <td><strong>Lieu de dépot : </strong></td>
                                                  <td><?php echo $depot; ?></td>
                                                </tr>
                                                <tr>
                                                  <td><strong>Remarques : </strong></td>
                                                  <td><?php echo $remarques; ?></td>
                                                </tr>
                                              </table>
                                              </div>
									
									<?php 
									}
								}
								
								
                          ?>
                          </div>
					</div>
				</div>
     
                
                
<!-- CREATION DYNAMIQUE DE L'OBJET SPRY POUR CORRESPONDRE A L'ID DE LA DIV CI-DESSUS-->
				<script type="text/javascript">
				<!--

					var CollapsiblePanel<?php echo $id_trajet; ?> = new Spry.Widget.CollapsiblePanel("CollapsiblePanel<?php echo $id_trajet; ?>",{ contentIsOpen: false});

					document.getElementById("nb_paye_<?php echo $id_trajet; ?>").innerHTML = "<?php echo $nb_paye; ?>";
					document.getElementById("nb_pas_paye_<?php echo $id_trajet; ?>").innerHTML = "<?php echo $nb_pas_paye; ?>";
					document.getElementById("nb_passager_<?php echo $id_trajet; ?>").innerHTML = "<?php echo $nb_passager; ?>";
					
					<?php
						// KEMPF : Changement de BG des navettes annulées
						if ($estAnnulee == 1){
							?>
							//document.getElementById("barre<?= $id_trajet ?>").style.backgroundColor  = "#FF8000";
							<?php
						}
					
						// KEMPF : Si passager = 0, on affiche pas la top-bar du tableau (ID, DATE, ...)
						// KEMPF : Si passager = 0 ET non validé, on affiche en jaune
						if ($nb_passager == 0 && $estValide == 0){
							?>
							document.getElementById("<?= $id_trajet ?>").style.display = "none";
							document.getElementById("barre<?= $id_trajet ?>").style.backgroundColor  = "#FFFF6A";
							
							<?php
							// Si l'admin a décidé de ne pas afficher les navettes vides, alors on les cache
							if (!$_SESSION['show_empty_shuttle']){
							?>
							document.getElementById("CollapsiblePanel<?= $id_trajet ?>").style.display = "none";
							
						<?php
							}
						}
					?>

				//-->
				</script>
			  <?php
				// Retour à la ligne pour espacer les différents cadres
				echo (!($nb_passager == 0 && $estValide == 0) || $_SESSION['show_empty_shuttle']) ? "<br />" : "";
			}
		}
	
	/*
		KEMPF : 
		Gestion de l'affichage des navettes europaPark, Royal-Palace, etc...
	*/
	
	$id_prev_trajet = 0;
	$id_trajet = 0;
	$new_trajet = true;
	
	$query_annexe = "	SELECT *,
							vehi.libelle as libelle_vehi,
							chau.nom as nom_chauf,
							chau.prenom as prenom_chauf,
							c.nom as nom_cli,
							c.prenom as prenom_cli,
							t.adresse as adresse_trajet,
							t.adresse_2 as adresse_2_trajet,
							r.type_lieu_aller as lieu_aller,
							r.type_lieu_retour as lieu_retour,
							r.adresse_aller as adr_aller,
							r.adresse_retour as adr_retour,
							r.commentaire as commentaire,
							DATE_FORMAT(t.date_trajet, '%w' ) as jour_trajet,
							DATE_FORMAT(t.date_trajet, '%d-%m-%Y' ) as date_trajet,
							DATE_FORMAT(t.date_trajet, '%Hh%i' ) as heure_trajet,
							DATE_FORMAT(r.date, '%d-%m-%Y %Hh%i' ) as date_reserv
						FROM europa_reservation r,
							europa_client c, 
							europa_lieu l,
							europa_trajet t,
							europa_ligne_reserv ligne,
							chauffeur chau,
							aeroport_vehicule vehi
						WHERE r.id_client = c.id_client
						AND ligne.code_reserv = r.id_reservation
						AND ligne.code_trajet = t.id_trajet 
						AND t.code_chauffeur = chau.idchauffeur
						AND t.code_vehicule = vehi.id_vehicule
						".$msg_annexe."
						GROUP BY ligne.id_ligne
						ORDER BY t.date_trajet ASC";
	
	$new_day = true;
	$first_loop = true;
	$chaine_a_afficher = "";
	$chaine_javascript = "";
	$chaine_innerHTML = "";
	$oldDate = "";
		
	$result_annexe = mysql_query($query_annexe) or die (mysql_error());
	while($r_annexe = @mysql_fetch_assoc($result_annexe)){
		$date = $r_annexe['date_trajet'];
		
		if ($first_loop){
			$oldDate = $date;
			$id_prev_trajet = $r_annexe["id_trajet"];
		}
		
		$id_reserv = $r_annexe["id_reservation"];
		
		$id_trajet = $r_annexe["id_trajet"];
		// Regroupement des trajets
		if ($id_prev_trajet != $id_trajet){
			
			if (!$first_loop){
			
				$chaine_a_afficher .= "</div></div><br />";
				$chaine_javascript .= "
					<script type=\"text/javascript\">
						var CollapsiblePanel_annexe_".$id_prev_trajet." = new Spry.Widget.CollapsiblePanel(\"CollapsiblePanel_annexe_".$id_prev_trajet."\",{ contentIsOpen: false});
					</script>";
			}
			
			$id_prev_trajet = $id_trajet;
			$new_trajet = true;
		}else{
			$new_trajet = false;
		}
		
		if ($oldDate != $date || $first_loop){
			echo "
				<script type='text/javascript'>
					inner_html_annexe('day_".$date."', '<div style=\"width:100%;text-align:center;color:#707070;font-weight:bold;\">Services annexes (".$date.")</div><br />');
					inner_html_annexe('day_".$oldDate."', '".preg_replace("(\r\n|\n|\r)",'', $chaine_a_afficher)."');
				</script>
			";
			$new_day = true;
			$oldDate = $date;
			$chaine_a_afficher = "";
		}else{
			$new_day = false;
		}
		
		
		echo $r_annexe['date_trajet']." -> ".$oldDate."<br />";
			
		//récupération des données
		
		
		$service_reserv = $r_annexe["service"];
		
		$date_reserv = $r_annexe["date_reserv"];
		
		$id_client = $r_annexe["id_client"];
		$prenom = addslashes ($r_annexe["prenom_cli"]);
		$nom = addslashes ($r_annexe["nom_cli"]);
		$mail = addslashes ($r_annexe["mail"]);
		$tel_port = substr($r_annexe["tel_port"], 1);
		$tel_fixe = substr($r_annexe["tel_fixe"], 1);
		$indice_tel = get_indice($r_annexe["pays"]);
		
		$code_chauffeur = $r_annexe["code_chauffeur"];
		$code_vehicule = $r_annexe["code_vehicule"];
		
		$nom_chauffeur = addslashes ($r_annexe["nom_chauf"]);
		$prenom_chauffeur = addslashes ($r_annexe["prenom_chauf"]);
		$libelle_vehicule = addslashes ($r_annexe["libelle_vehi"]);
		
		$commentaire_reserv = addslashes ($r_annexe["commentaire"]);
		
		$estValide = ($r_annexe["estValide"] == 1) ? true : false;
		
		$txt_tel_port = ($tel_port == "") ? "" : "(".$indice_tel.")".$tel_port."";
		$txt_tel_fixe = ($tel_fixe == "") ? "" : "(".$indice_tel.")".$tel_fixe."";
		
		if ($txt_tel_port != "" && $txt_tel_fixe != ""){
			$txt_tel_port .= "<br />";
		}
		
		$date_trajet = $r_annexe["date_trajet"];
		$heure_trajet = $r_annexe["heure_trajet"];
		$jour_trajet = $r_annexe["jour_trajet"];
		
		$prix = $r_annexe["prix"];
		$nb_passagers = $r_annexe["nb_pers"];
		$estPaye = ($r_annexe["est_paye"] == 1) ? true : false;
		$txt_paye = ($estPaye == 1) ? "Payé : ".$prix." €" : "Non payé";
		
		$type_trajet = $r_annexe["type_trajet"];
		$lieu_reserv = ($type_trajet == "ALLER") ? $r_annexe["lieu_aller"] : $r_annexe["lieu_retour"];
		$domicile_reserv = $r_annexe["adr_".strtolower($type_trajet)];
		
		if (empty($r_annexe["adresse_trajet"])){
			$rassemblement_1 = get_nom_lieu($lieu_reserv);				
			// Si à domicile, on l'affiche
			if ($lieu_reserv == 4){
				$rassemblement_1 .= "<br />".$domicile_reserv;
			}
		}else{
			$rassemblement_1 = $r_annexe["adresse_trajet"];
		}
		$rassemblement_2 = $r_annexe["adresse_2_trajet"];
		
		
		// Affichage
		
		if ($new_trajet || $first_loop){
			if ($estValide){
				$style_annexe = "background-color:#00CC33;";
			}elseif ($estPaye){
				$style_annexe = "background-color:#DDDDDD;";
			}else{
				$style_annexe = "background-color:#6DFFE1;";
			}
			$prov_dest_trajet = ($type_trajet == "ALLER") ? "Strasbourg -> ".$service_reserv : $service_reserv." -> Strasbourg";
			$chaine_a_afficher .= "
			<div width=\"100%\" id=\"CollapsiblePanel_annexe_".$id_trajet."\" class=\"CollapsiblePanel\">
				<table id=\"tbl".$id_reserv."\" width=\"100%\" class=\"CollapsiblePanelTab\" style=\"font-family: Verdana,Geneva,sans-serif;".$style_annexe."\" border=\"0\" cellpadding=\"1\" >
					<tr>
						<th style=\"width:5%;\">".$id_trajet."</th>
						<th style=\"width:20%;\">Départ le ".$date_trajet." à ".$heure_trajet."</th>
						<th style=\"width:30%;\">".$prov_dest_trajet."</th>
						<th style=\"width:10%;\">".$nom_chauffeur." ".$prenom_chauffeur."</th>
						<th style=\"width:10%;\">".$libelle_vehicule."</th>
						<th style=\"width:15%;\">".$txt_paye."</th>
						<th style=\"width:10%;\">Passagers : ".$nb_passagers."</th>
					</tr>
				</table>
				<div width=\"100%\">";
			
			if ($estPaye && !$estValide){
				
				$chaine_a_afficher .= "
				<table width=\"100%\">
					<tr>
						<td>
							<form action=\"validerTrajetAnnexe.php\" method=\"post\">
								<input name=\"id_trajet\" type=\"hidden\" value=\"".$id_trajet."\" />
								<input type=\"submit\" value=\"Valider le trajet\"/>
							</form>
						</td>
						<td>
							<form action=\"changerChauffeurAnnexe.php\" method=\"post\">
								<select name=\"id_chauffeur\">";
								
								mysql_data_seek($resultChauff, 0);
								while ($rChauff = @mysql_fetch_assoc($resultChauff)){
									
									$chaine_a_afficher .= "<option value=\"".$rChauff["idchauffeur"]."\" ".(($code_chauffeur == $rChauff["idchauffeur"]) ? "\"selected\"" : "\"\"").">".$rChauff["nom"]." ".$rChauff["prenom"]."</option>";
									
								}
								$chaine_a_afficher .= "
								</select> 
								
								<select name=\"id_vehicule\">";
								 
								mysql_data_seek($resultVehicule, 0);
								while ($rVehicule = @mysql_fetch_assoc($resultVehicule)){
									
									$chaine_a_afficher .= "<option value=\"".$rVehicule["id_vehicule"]."\" ".(($code_vehicule == $rVehicule["id_vehicule"]) ? "\"selected\"" : "\"\"").">".$rVehicule["libelle"]."</option>";
									
								}
								
								$chaine_a_afficher .= "
								</select> 
								<input name=\"id_trajet\" type=\"hidden\" value=\"".$id_trajet."\" />
								<input type=\"submit\" value=\"Changer le conducteur/vehicule\"/>
							 </form>
						</td>
					</tr>
				</table>";
			}
				
			$chaine_a_afficher .= "
			<table width=\"100%\">
				<tr>
					<td>
						<form action=\"supprimerTrajetAnnexe.php\" method=\"post\">
							<input name=\"id_trajet\" type=\"hidden\" value=\"".$id_trajet."\" />
							<input name=\"valide\" type=\"hidden\" value=\"".($estValide ? 1 : 0)."\" />
							<input type=\"submit\" value=\"Supprimer le trajet\"/>
						</form>
					</td>
				</tr>
			</table>";
			
		}
		
		// Informations spécifiques à chaque client du trajet -->
		$chaine_a_afficher .= "
			<div width=\"100%\" class=\"CollapsiblePanelContent\">
				<table class=\"table_info_trajet\" width=\"100%\" border=\"1\">
					<tr>
						<th style=\"width:10%;background-color:#B0D8FF;\">ID</th>
						<th style=\"width:15%;background-color:#B0D8FF;\">Client</th>
						<th style=\"width:15%;background-color:#B0D8FF;\">Tel</th>
						<th style=\"width:15%;background-color:#B0D8FF;\">Rassemblement</th>
						<th style=\"width:15%;background-color:#B0D8FF;\">Destination</th>
						<th style=\"width:20%;background-color:#B0D8FF;\">Commentaire</th>
						<th style=\"width:10%;background-color:#B0D8FF;\">Infos</th>
					</tr>
					<tr style=\"text-align:center\">
						<td>".$id_reserv."</td>
						<td><a href=\"http://alsace-navette.com/europapark/admin/index.php?p=3&id=".$id_client."\">".$nom." ".$prenom."</a></td>
						<td>".$txt_tel_port.$txt_tel_fixe."</td>
						<td>
							".addslashes(($type_trajet == "ALLER") ? $rassemblement_1 : $rassemblement_2)."
						</td>
						<td>
							".addslashes(($type_trajet == "ALLER") ? $rassemblement_2 : $rassemblement_1)."
						</td>
						<td >
							<div id=\"commentaire_annexe_".$id_reserv."\">
								".addslashes(nl2br($commentaire_reserv))."
							</div>
							<div id=\"bouton_modif_".$id_reserv."\">
								<img src=\"images/arrow_circle.png\" onclick=\"autoriser_modification(".$id_reserv.");\" />
							</div>
						</td>
						<td style=\"text-align:left;\">
							<u>Prix</u> : ".$prix." €
							<br />
							<u>Date</u> : ".$date_reserv."
						</td>
					</tr>
				</table>
			</div>";
			
		$first_loop = false;
	}
	// Fermeture du dernier service annexe (S'il y en a)
	if (!$first_loop){
		$chaine_a_afficher .= "</div></div><br />";
		$chaine_javascript .= "
			<script type=\"text/javascript\">
				var CollapsiblePanel_annexe_".$id_prev_trajet." = new Spry.Widget.CollapsiblePanel(\"CollapsiblePanel_annexe_".$id_prev_trajet."\",{ contentIsOpen: false});
			</script>";
			
		echo "
			<script type='text/javascript'>
				inner_html_annexe('day_".$oldDate."', '".preg_replace("(\r\n|\n|\r)",'', $chaine_a_afficher)."');
			</script>
		";
		
		echo $chaine_javascript;
	}
	mysql_close();
?>
</div>

          
<script src="scripts/tableau.js" type="text/javascript"></script>
<script src="scripts/supprimer_ligne.js" type="text/javascript"></script>
<script src="scripts/switcher_ligne.js" type="text/javascript"></script>
<script src="scripts/validTrajet.js" type="text/javascript"></script>

