<?php
     header('Content-Type: text/x-json; charset: UTF-8');
     //on se connecte à la bdd
     include("conf/mysql.php");
     include("conf/func_calendrier.php");

     ///////////////////////////////////////////////////////////////////////////////////
     //   on va formater ici un flux JSON qui va pouvoir etre lu par le js client.
     //   Format du JSON:
     //   {
     //      "mois_en_cours" : $mois_en_cours
     //      "lien_precedent" : $lien_vers_le_mois_precedent ,
     //      "lien_suivant" : $lien_vers_le_mois_suivant ,
     //      "calendrier": [
     //            {
     //
     //               "fill": $contenu_a_afficher //(rien, jour du mois ou jour
     //                                           //du mois avec lien
	 //				  "events": $trajet_prevu_ce_jour
     //            },
     //                    ]
     //   }
     //
     //
     //
     ///////////////////////////////////////////////////////////////////////////////////
     //
     //                    On prépare le début du retour au format JSON
     ///////////////////////////////////////////////////////////////////////////////////
     $retour_json='';
     ///////////////////////////////////////////////////////////////////////////////////
     //On détermine d'abord les liens "suivant" "precedent" et le "mois en cours" du calendrier
     ///////////////////////////////////////////////////////////////////////////////////
     $mois=$_POST['mois'];
     $annee=$_POST['annee'];
     $retour_json='{';
     //mois en cours
     $mois_fr=getMois($mois);
     $titre="<span style='font-size:18px;'>".$mois_fr."</span><br>".$annee;
     $retour_json.='"mois_en_cours" : "'.$titre.'" , ';
     //lien suivant
     $date_suivant=getSuivant($mois,$annee,1);
     $lien_suivant="tableau('".$date_suivant[mois]."','".$date_suivant[annee]."')";
     $retour_json.='"lien_suivant" : "'.$lien_suivant.'" , ';
     //lien précédent
     $date_precedent=getSuivant($mois,$annee,-1);
	 $date_now = getSuivant(date("m"), date("Y"), 0);
	 if($date_precedent[mois] < $date_now[mois] && $date_precedent[annee] <= $date_now[annee])
	 {
		$lien_precedent="tableau('".$date_now[mois]."','".$date_now[annee]."')";
	 }
	 else
	 {
		$lien_precedent="tableau('".$date_precedent[mois]."','".$date_precedent[annee]."')";
	 }
     $retour_json.='"lien_precedent" : "'.$lien_precedent.'" , ';


     //Maintenant, on peut peupler le calendrier sous forme d'un tableau de 6 lignes * 7 colonnes
     //On crée notre tableau de 6semaines*7jours soit 42 éléments.
     //On récupére le jour qui démarre le mois
     //ON va stocker tous les jours du mois dans un tableau tab_jours php
     $tab_jours=array();

     $num_jour=getFirstDay($mois,$annee);
     $compteur=1;
     $num_jour_courant=1;
	 $tab_trajets = array();

     while($compteur<43){
     if($compteur<$num_jour){
          $tab_jours[$compteur]='';
     }else
     {
         //si la date existe, on affiche alors le jour dans la cellule du tableau
         if(checkdate($mois,$num_jour_courant,$annee)){
              //On vérifie si un événement a lieu ce jour ci
              $date=$annee."-".$mois."-".$num_jour_courant;
              $contenu='';
              $requete = "SELECT t.*,o.id_outlet FROM europa_trajet t JOIN outlet_outlet o ON t.service_trajet = o.libelle_outlet
						WHERE DATE(t.date_trajet)='".$date."'
							AND t.type_trajet = 'ALLER'
							";
              $req=$db->prepare($requete);
			  $req->execute();

              if($req){
                  $nbre=$req->rowCount();

                  if($nbre>0)
				  {
						while ($data = $req->fetch())
						{
			/*			 	$annee1 = date("Y", $annee);
							$mois1 = date("m", $mois);
							$num_jour_courant1 = date("d", $num_jour_courant);*/
							$date1[jour]=$num_jour_courant;
							$date1[mois]=$mois;
							$date1[annee]=$annee;
							$annee1 = date("Y");
							$mois1 = date("m");
							$num_jour_courant1 = date("d");
							$date_depart = strtotime($data['date_trajet']);
							$requete2 = "SELECT date_trajet FROM europa_trajet WHERE type_trajet = 'RETOUR' AND id_trajet = ".($data['id_trajet']+1);
							$req2 = $db->prepare($requete2);
							$req2->execute();
							$data2 = $req2->fetch();
							if($date1[jour] < $num_jour_courant1 && $date1[mois] <= $mois1 && $date1[annee] <= $annee1)
							{
								$tab_jours[$compteur]=$num_jour_courant;
							}
							else
							{
								$tab_jours[$compteur]=$num_jour_courant;
								$date_retour = strtotime($data2['date_trajet']);
								$tab_trajets[$compteur] = array('id_trajet' => $data['id_trajet'], 'id_lieu' => $data['id_outlet'], 'lieu' => $data['service_trajet'], 'date' => date('d/m/Y',$date_depart),'heure_depart' => date('H\Hi',$date_depart),'heure_retour' => date('H\Hi',$date_retour));
							}
						}
                  }
				  else
                  {
						$tab_jours[$compteur]=$num_jour_courant;
                  }
                  $req->closeCursor();
              }
              $num_jour_courant++;

         }else
         {
           $tab_jours[$compteur]='';
         }

     }
       $compteur++;
     }
     
     ///////////////////////////////////////////////////////////////////////////////////
     // Maintenant que l'on a notre tableau d'événements pour chaque jour du mois
     // On finit de construire la réponse JSON
     ///////////////////////////////////////////////////////////////////////////////////
     if(!empty($tab_jours)){
        $retour_json.=' "calendrier" : [ ';
        $compteur=1;
        while($compteur<43){
           if($compteur==42){
            $retour_json.=' { "fill" : "'.$tab_jours[$compteur].'" , "events" : '.json_encode($tab_trajets[$compteur]).'} ';
           }else
           {
            $retour_json.=' { "fill" : "'.$tab_jours[$compteur].'" , "events" : '.json_encode($tab_trajets[$compteur]).'} , ';
           }
        $compteur++;
        }
        $retour_json.=' ] ';
     }
     $retour_json.=' } ';

     echo $retour_json;

?>