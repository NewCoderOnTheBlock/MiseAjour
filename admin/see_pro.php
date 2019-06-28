<?php
include("verifAuth.php");
include 'connection.php';
?>
<script src="SpryAssets/SpryCollapsiblePanel.js" type="text/javascript"></script>

    <link href="SpryAssets/SpryCollapsiblePanel.css" rel="stylesheet" type="text/css" />
    <script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
    <link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='index.php?p=25&id_pro="+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>


<br />
<br />
<div style="width:100%;">
	<div style="text-align:center;margin:auto;">
        <h2><u>Visualisation des clients professionnels</u></h2>
        <br />
      <form name="form" id="form" action="get">
          <select name="jumpMenu" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)" size="15">
             <?php
		  $query_pro="SELECT * from aeroport_client where professionnel='1' ORDER BY nom asc";
          $result_pro = mysql_query($query_pro) or die (mysql_error());
          while ($r = @mysql_fetch_assoc($result_pro))
          {
              $titre_list=$r['nom']." ".$r['prenom'];
              $id_list=$r['id_client'];

		  ?>
            <option value="<?php echo $id_list;?>"><?php echo $titre_list;?></option>
          <?php
		  }
		  ?>
          </select>
      </form>
	</div>
</div>
<div style="text-align:center;margin:auto;">
<h3>Liste des trajets non payés</h3>
</div>
<?php
if(isset ($_GET["id_pro"]))
{

            //sélection préalable de tous les chauffeurs (sans michel, provisoir avant de le supprimer proprement)
        $queryChauff = "select * from chauffeur where idchauffeur != 4";
        $resultChauff = mysql_query($queryChauff) or die (mysql_error());
        //sélection préalable de tous les véhicules
        $queryVehicule = "select * from aeroport_vehicule";
        $resultVehicule = mysql_query($queryVehicule) or die (mysql_error());

        $ret_alea = mysql_query("select nb_alea FROM aeroport_client WHERE id_client = ".intval($_GET['id_pro']));
        $nb_alea = mysql_fetch_assoc($ret_alea);


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
                           aeroport_vehicule v,
						   aeroport_ligne_resa l,
						   aeroport_reservation r,
                           aeroport_facture_pro f
                      WHERE c.idchauffeur = t.id_chauffeur
					  		AND v.id_vehicule = t.id_vehicule
							AND l.id_trajet = t.id_trajet
							AND l.id_res = r.id_res
							AND r.id_client = ".intval($_GET['id_pro'])."
                            AND f.num_ligne = l.id_ligne
                            AND f.statut = 0
							ORDER BY t.date DESC";

    $result = mysql_query($query) or die (mysql_error());

        $nbreq = mysql_num_rows($result);


        if($nbreq > 0)
            echo '<br /><a href="../aeroport/reservation/professionnel-'.intval($_GET['id_pro']).'-'.date('Y').date('m').date('d').'-'.$nb_alea['nb_alea'].'.html">Facture</a><br /><br />';


        ?>
        <form action="#" method="post" name="voirCom">

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

            while ($r = @mysql_fetch_assoc($result))

                {
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

                //requête de récupération du nom du lieu de départ
                $query2 = "SELECT l.nom as nom FROM aeroport_lieu l WHERE l.id_lieu = ".$id_depart;
                $result2 = mysql_query($query2) or die (mysql_error());
                while ($r2 = @mysql_fetch_assoc($result2)){
                    $nom_depart = $r2["nom"];
                }
                //requête de récupération du lieu d'arrivé
                $query3 = "SELECT l.nom as nom FROM aeroport_lieu l WHERE l.id_lieu = ".$id_dest;
                $result3 = mysql_query($query3) or die (mysql_error());
                while ($r3 = @mysql_fetch_assoc($result3)){
                    $nom_dest = $r3["nom"];
                }

                    ?>

                    <!-- DIV DU PANNEAU EXTENSIBLE (en spry -> librairie JS fournie par adobe dans DREAMWEAVER à partir de la version CS3) -->

    <div id="CollapsiblePanel<?php echo $id_trajet; ?>" class="CollapsiblePanel" style="width:1500px">
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
                                            ?>>


                              <table id="tbl<?php echo $id_trajet; ?>" width="1360px" border="0" cellpadding="1" style="font-family:Verdana, Geneva, sans-serif;">
                                  <tr>
                                    <th style="width:80px;"><?php echo $id_trajet; ?></th>
                                    <th style="width:220px;"><?php echo " départ le ".$dateDep." à ".$heureDep; ?></th>
                                    <th style="width:280px;"><?php echo $nom_depart." -> ".$nom_dest; ?></th>
                                    <th style="width:190px;" id="tab_chauffeur_<?php echo $id_trajet; ?>"><?php echo $nom." ".$prenom; ?></th>
                                    <th style="width:150px;" id="tab_vehicule_<?php echo $id_trajet; ?>"><?php echo $libelle; ?></th>
                                    <th></th>
                                  </tr>
                               </table>




                              </div>
                              <!-- ZONE DE CONTENU (détail de chaque réservation pour le trajet) -->
                              <div class="CollapsiblePanelContent">
                              <div style="overflow-x:hidden; overflow-y:auto; width:100%; height:100%;">
                              <?php
                              //sélection du détail des réservations correspondant au trajet en cours
                              $query4 = "SELECT ligne.id_ligne as idRes,
                                                ligne.nb_pers as nbPers,
                                                ligne.nb_enfant as nbEnf,
                                                res.id_res as id_res,
                                                res.commentaire as commentaire,
                                                res.res_der_min as res_der_min,
                                                ligne.est_paye as estPayeRes,
                                                DATE_FORMAT(res.date, '%d-%m-%Y à %Hh%i') as date_res,
                                                ligne.comm_bis as bis,
                                                ligne.id_pt_rass as idPt,
                                                ligne.rassemblement as adresse,
                                                ligne.remboursement as remboursement,
                                                ligne.prix as prix,
                                                ligne.type_trajet as type_trajet,
												cli.id_client as idCli,
												cli.nom as nomCli,
												cli.prenom as prenomCli,
												cli.civilite as civCli,
												cli.id_client as id_client,
                                                DATE_FORMAT(ligne.heure, '%Hh%i' ) as heure,
                                                ligne.info_vol as numVol,
                                                rassemblement.fr as nomRass
                                        FROM aeroport_reservation res,
                                                aeroport_rassemblement rassemblement,
                                                aeroport_ligne_resa ligne,
												aeroport_client cli
                                        WHERE ligne.id_trajet = ".$id_trajet."
                                                AND ligne.id_res = res.id_res
                                                AND rassemblement.id_pt = ligne.id_pt_rass
												AND cli.id_client = res.id_client
                                        ORDER BY ligne.id_ligne";



                                $result4 = mysql_query($query4) or die (mysql_error());

                                ?>

                                <!-- début du tableau des résultat-->
                                <table width="1500px" id="<?php echo $id_trajet; ?>" border="1">
                                    <tr>
                                        <th style="width:32px;background:lightblue;"> ID </th>
                                        <th style="width:217px;background:lightblue;"> Client </th>
                                        <th style="width:54px;background:lightblue;"> Nombre </th>
                                        <th style="width:362px;background:lightblue;"> Vol </th>
                                        <th style="width:82px;background:lightblue;"> Heure </th>
                                        <th style="width:250px;background:lightblue;"> Point de rassemblement </th>
                                        <th style="width:360px;background:lightblue;"> Commentaires </th>
                                        <th style="width:179px;background:lightblue;"> Infos </th>
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
                                    $mnt_a_rembourser = $r4["remboursement"];
                                    $date_de_res = $r4["date_res"];
                                    $prix = $r4["prix"];
									$nomCli = $r4["nomCli"];//
									$prenomCli = $r4["prenomCli"];//
									$civCli = $r4["civCli"];//
									$fixCli = $r4["fixCli"];//
									$portCli = $r4["portCli"];//
									$id_client = $r4["id_client"];//
                                    $estPayeRes = $r4["estPayeRes"];
                                    $id_res = $r4["id_res"];
                                    $code_cli = $r4["code_cli"];
                                    $supplement = 0; // supplement de la réservation de dernière minute (seulement pour l'aller)

                                    if($r4['type_trajet'] == 'ALLER')
                                    {
                                        if($r4['res_der_min'] == "24")
                                            $supplement = 10;
                                        elseif($r4['res_der_min'] == "72")
                                            $supplement = 5;
                                    }


                                    ?>
                                    <tr id="ligne<?php echo $idRes; ?>">
                                        <td style="text-align:center;"><?php echo $idRes; ?></td>
                                        <td><a href="index.php?p=5&amp;id=<?php echo $id_client; ?>" target="_blank"><?php echo $civCli." ".$nomCli." ".$prenomCli; ?></a></td>
                                        <td style="text-align:center;"><?php echo $nbPers; ?></td>
                                        <td style="text-align:center;"><?php echo $numVol; ?></td>
                                        <td style="text-align:center;"><?php echo $heure; ?></td>
                                        <td style="text-align:center;"><?php if($nomRass == "Domicile"){echo $adresse;} else{echo $nomRass;} ?></td>
                                        <td><?php echo nl2br($bis); ?></td>
                                        <td>Prix : <?php echo ($prix + $supplement); ?> €
                                        <br />Est payé : <?php echo ($estPayeRes == 0) ? "Non" : "Oui"; ?>
                                        <br />A rembourser : <?php echo $mnt_a_rembourser; ?> €
                                        <br />Date : <?php echo $date_de_res; ?></td>
                                    </tr>


                                    <?php
                                }


                              ?>


                              </table>
                              <!-- affichage du commentaire du chauffeur si souhaité  -->
                              <?php
                                    if($_POST['voirCom'] == 1){
                                        $req_com = " SELECT * from aeroport_recap_trajet WHERE idcm in (SELECT id_com FROM aeroport_gestion_planning WHERE id_trajet = ".$id_trajet.")";
                                        $res_com = mysql_query($req_com) or die (mysql_error());
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
                                            $remarques = $r_com["remarques"];
                                            $pass_aller_nonres = $r_com["pass_aller_nonres"];
                                            $pass_retour_nonres = $r_com["pass_retour_nonres"];
                                            $montant = $r_com["montant"];
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
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
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
                                                    <td><?php echo $pass_aller_res." personnes/ ".$pass_aller_res. "personnes"; ?> </td>
                                                  </tr>
                                                  <tr>
                                                    <td><strong>Nb passagers aller/retour n'ayant pas réservés : </strong></td>
                                                    <td><?php echo $pass_aller_nonres." personnes/ ".$pass_aller_nonres. " personnes"; ?></td>
                                                  </tr>
                                                  <tr>
                                                  <tr>
                                                    <td><strong>Montant reçu en liquide : </strong></td>
                                                    <td><?php echo $montant." €"; ?></td>
                                                  </tr>
                                                    <td><strong>Nb groupes aller/retour : </strong></td>
                                                    <td><?php echo $nb_grp_aller." grp /".$nb_grp_retour." grp"; ?></td>
                                                  </tr>
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
                                                    <td><?php echo $lavint; ?> </td>
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
                    //-->
                    </script>
                            <p></p>
                  <?php


                }
            }
}


    ?>



