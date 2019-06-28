
<script src="SpryAssets/SpryCollapsiblePanel.js" type="text/javascript"></script>

<link href="SpryAssets/SpryCollapsiblePanel.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<br /><br /><br /><br />



<!-- DIV CONTENANT LE CALENDRIER -->

<script type="text/javascript">

var ds_i_date = new Date();

<?php

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

</script>

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
											ligne.est_paye as estPayeRes,
											DATE_FORMAT(res.date, \'%d-%m-%Y à %Hh%i\') as date_res,
											ligne.comm_bis as bis,
											ligne.id_pt_rass as idPt,			
											ligne.rassemblement as adresse,
											ligne.remboursement as remboursement,
											ligne.prix as prix,
											ligne.type_trajet as type_trajet,
											DATE_FORMAT(ligne.heure, \'%Hh%i\' ) as heure,   
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
		}
		else
		{
			//et on complète la requète pour prendra la date en compte (seulement le mois
			$msg = " AND DATE_FORMAT(t.date, '%m-%Y' ) ='".$date."'";
		}
	}
	
	
	//requete de sélection des trajets à la date voulue s'il y en a une
	$query = "SELECT t.id_trajet as id_trajet,
					DATE_FORMAT(t.date, '%w' ) as jour,
					DATE_FORMAT(t.date, '%d-%m-%Y' ) as dateDep,
					DATE_FORMAT(t.date, '%Hh%i' ) as heureDep,
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

    
	<?php
	//teste de la présence de trajet à cette date
	if ($nbreq == "0"){
		echo "Il n'y a pas de réservation à cette date";
	}
	else{
		$oldDate  ="";
		
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
				?>
                <h3 style="text-align:center;"><?php echo $day."le ".$dateDep; ?></h3>
             
             
                <?php
				}
			
			
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

<div id="CollapsiblePanel<?php echo $id_trajet; ?>" class="CollapsiblePanel" style="width:1650px">
                		   <!-- BARRE SUPERIEUR (résumé du trajet) -->
						  <div class="CollapsiblePanelTab" id="barre<?php echo $id_trajet; ?>"  
						  	<?php 	
									if($emedm == 1){
										echo"style=\"background-color:#FB7E71;\"";
									}
									
									else if($estPaye == 0){
										echo"style=\"background-color:#6DFFE1;\"";
									}
							
									else if($estValide ==1 && $emedm == 0)	
										{
										echo"style=\"background-color:#0C3;\"";
									}
										?>
                          
                          >
						  <table id="tbl<?php echo $id_trajet; ?>" width="1650px" border="0" cellpadding="1" style="font-family:Verdana, Geneva, sans-serif;">
                              <tr>
                                <th style="width:80px;"><?php echo $id_trajet; ?></th>
                                <th style="width:220px;"><?php echo " départ le ".$dateDep." à ".$heureDep; ?></th>
                                <th style="width:280px;"><?php echo $nom_depart." -> ".$nom_dest; ?></th>
                                <th style="width:190px;" id="tab_chauffeur_<?php echo $id_trajet; ?>"><?php echo $nom." ".$prenom; ?></th>
                                <th style="width:150px;" id="tab_vehicule_<?php echo $id_trajet; ?>"><?php echo $libelle; ?></th>
                                <th style="width:170px;">Payé / Non payé : <span id="nb_paye_<?php echo $id_trajet; ?>"></span>/<span id="nb_pas_paye_<?php echo $id_trajet; ?>"></span></th>
                                <th style="width:100px;">Passagers : <span id="nb_passager_<?php echo $id_trajet; ?>"></span></th>
                                <th></th>
                              </tr>
                           </table>
						   
                          
                          
                          
                          </div>
                          <!-- ZONE DE CONTENU (détail de chaque réservation pour le trajet) -->
						  <div class="CollapsiblePanelContent" style="display:none">
                          <div style="overflow-x:hidden; overflow-y:auto; width:100%; height:100%;">
                          <?php
						  //sélection du détail des réservations correspondant au trajet en cours
							
							mysql_query("SET @id_trajet = " . $id_trajet);
                            $result4 = mysql_query("EXECUTE req_res USING @id_trajet") or die (mysql_error());
							
							?>
                            <?php if($estValide ==0){ ?>
								<input type="button" id="btn_valid<?php echo $id_trajet; ?>"  value="Valider" onclick="valid(<?php echo $id_trajet; ?>, <?php echo $emedm; ?>);"/>
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
                            <?php }
									else if($emedm == 1){ ?>
										<input type="button" id="btn_valid<?php echo $id_trajet; ?>"  value="Valider" onclick="valid2(<? echo $id_trajet; ?>, <? echo $idC; ?>, <? echo $idV; ?>);"/>
                                        <?php }
										
										if($estPaye == 0)
										{
											?>
                                            
                                             <input type="button" value="Trajet payé" onclick="change_a_paye('<?php echo $id_trajet; ?>', 'aeroport_trajet', '1', 'id_trajet');" />
                                            
                                            <?php											
										}
										/*else
										{
											?>
                                            
                                            <input type="button" value="Trajet non payé" onclick="change_a_paye('<?php echo $id_trajet; ?>', 'aeroport_trajet', '0', 'id_trajet');" />
                                            
                                            <?php											
										}*/
                                        ?>
                                        <input type="hidden" id="estValide_<?php echo $id_trajet; ?>" value="<?php echo $estValide; ?>" />
							<!-- début du tableau des résultat-->	
							<table width="1650px" id="<?php echo $id_trajet; ?>" border="1">
                                <tr>
                                    <th style="width:32px;background:lightblue;"> ID </th>
                                    <th style="width:217px;background:lightblue;"> Client </th>
                                    <th style="width:54px;background:lightblue;"> Nombre </th>
                                    <th style="width:97px;background:lightblue;"> Tel </th>
                                    <th style="width:262px;background:lightblue;"> Vol </th>
                                    <th style="width:82px;background:lightblue;"> Heure </th>
                                    <th style="width:250px;background:lightblue;"> Point de rassemblement </th>
                                    <th style="width:350px;background:lightblue;"> Commentaires </th>
                                    <th style="width:179px;background:lightblue;"> Infos </th>
                                    <th style="background:lightblue;"> Options </th>
                                 </tr>
								
								<?php


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
								$supplement = 0; // supplement de la réservation de dernière minute (seulement pour l'aller)
                                $methode_paiement = $r4['methode_paiement'];

                                $nb_passager += $nbPers;
								
								if($estPayeRes == 0)
									$nb_pas_paye++;
								else
									$nb_paye++;


                                $id_affiche++;
								
								if($r4['type_trajet'] == 'ALLER')
								{
									if($r4['res_der_min'] == "24")
										$supplement = 10;
									elseif($r4['res_der_min'] == "72")
										$supplement = 5;
								}

                                $ind_fixe = get_ind($r4['ind_fixe']);
                                $ind_port = get_ind($r4['ind_port']);
									
									
								?>


                               
								<tr id="ligne<?php echo $idRes; ?>">
                                    <td style="text-align:center;"><?php echo $idRes; ?></td>
                                    <td><a href="index.php?p=5&amp;id=<?php echo $id_client; ?>" target="_blank"><?php echo $civCli." ".$nomCli." ".$prenomCli; ?></a></td>
                                    <td style="text-align:center;">
										<?php 
											echo $nbPers; 
											/*
												Ajout KEMPF
												
												Possiblité de modifier le nombre de personnes sur un trajet
											*/
										?>
										<br />
										<img src="images/icon_moins.png" alt="Retirer" title="Retirer" style="cursor:pointer" />&nbsp;<img src="images/icon_plus.png" alt="Ajouter" title="Ajouter" style="cursor:pointer" />
										
									</td>

                                    <td style="text-align:center;"><?php echo "(".$ind_fixe.")".$fixCli."<br />(".$ind_port.")".$portCli; ?></td>
                                    <td style="text-align:center;"><?php echo $numVol; ?></td>
                                    <td style="text-align:center;"><?php echo $heure; ?></td>
                                    <td style="text-align:center;"><?php if($nomRass == "Domicile"){echo $adresse;} else{echo $nomRass;} ?></td>
                                    <td><?php echo nl2br($bis); ?></td>
                                    <td>Prix : <a onclick="window.open(this.href, 'Modification du prix d\'réservation', 'width=450,height=250,resizable=yes'); return false;" href="modif_prix.php?id_res=<?php echo $id_res; ?>&id_trajet=<?php echo $id_trajet; ?>&id_ligne=<?php echo $idRes; ?>&id_affiche=prix_<?php echo $id_affiche; ?>" id="prix_<?php echo $id_affiche; ?>"><?php echo ($prix + $supplement); ?> €</a>
                                    <br />Est payé : <?php echo ($estPayeRes == 0) ? "Non" : "Oui (" . $methode_paiement . ")"; ?>
                                    <br />A rembourser : <a onclick="window.open(this.href, 'Modification du prix d\'réservation', 'width=450,height=250,resizable=yes'); return false;" href="modif_remb.php?id_ligne=<?php echo $idRes; ?>&id_affiche=remb_<?php echo $id_affiche; ?>" id="remb_<?php echo $id_affiche; ?>"><?php echo $mnt_a_rembourser; ?> €</a>
                                    <br />Date : <?php echo $date_de_res; ?>
                                    <br /><?php echo '<a href="../aeroport/reservation/paiement-manuel-'.$id_client.'-'.$id_res.'-'.$id_trajet.'-0-'.$idRes.'-0-0-'.$code_cli.'.html" target="_blank">Détail du prix</a>';
									?></td>
                                    <td style="text-align:center">
                                    

                                    <img src="images/poubelle.jpg" title="Supprimer" width="35" height="35" alt="Supprimer"  style="cursor:pointer" onclick="supprimer_ligne(<?php echo $idRes; ?>,<?php echo $id_trajet; ?>,<?php echo $idC; ?>,<?php echo $idV; ?>);"/>
                                    			<hr />
                                    <img src="images/switch.png" width="35" height="35" alt="Changer" onclick="switcher_ligne(<?php echo $idRes; ?>,<?php echo $id_trajet; ?>,<?php echo $idC; ?>,<?php echo $idV; ?>);" title="Changer" style="cursor:pointer" />

                                    <?php
										if($estPayeRes == 0)
										{
										?>
											<hr />
                                           
                                            <?php echo '<a href="../aeroport/reservation/paiement-manuel-'.$id_client.'-'.$id_res.'-'.$id_trajet.'-0-'.$idRes.'-0-0-'.$code_cli.'.html" target="_blank"><img src="images/payer.png" height="20" alt="Payer" title="Payer" style="cursor:pointer;" /></a>';
											?>
                                           
                                            <input type="button" value="A payé" onclick="change_a_paye('<?php echo $idRes; ?>', 'aeroport_ligne_resa', '1', 'id_ligne');" />
                                      
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

				//-->
				</script>
						<p></p>
			  <?php

			}
		}
	


?>

          
<script src="scripts/tableau.js" type="text/javascript"></script>
<script src="scripts/supprimer_ligne.js" type="text/javascript"></script>
<script src="scripts/switcher_ligne.js" type="text/javascript"></script>
<script src="scripts/validTrajet.js" type="text/javascript"></script>

