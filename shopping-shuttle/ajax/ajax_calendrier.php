<?php
     header('Content-Type: text/x-json; charset: UTF-8');
     //on se connecte � la bdd
     include("../conf/mysql.php");
     include("../conf/func_calendrier.php");
     //On r�cup�re le mois et l'ann�e pour le traitement
     $mois=$_GET['mois'];
     $annee=$_GET['annee'];
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
     //            },
     //                    ]
     //   }
     //
     //
     //
     ///////////////////////////////////////////////////////////////////////////////////
     //
     //                    On pr�pare le d�but du retour au format JSON
     ///////////////////////////////////////////////////////////////////////////////////
     $retour_json='';
     ///////////////////////////////////////////////////////////////////////////////////
     //On d�termine d'abord les liens "suivant" "precedent" et le "mois en cours" du calendrier
     ///////////////////////////////////////////////////////////////////////////////////
     $mois=$_GET['mois'];
     $annee=$_GET['annee'];
     $retour_json='{';
     //mois en cours
     $mois_fr=getMois($mois);
     $titre=htmlentities($mois_fr." ".$annee,ENT_QUOTES);
     $retour_json.='"mois_en_cours" : "'.$titre.'" , ';
     //lien suivant
     $date_suivant=getSuivant($mois,$annee,1);
     $lien_suivant="tableau('".$date_suivant[mois]."','".$date_suivant[annee]."')";
     $retour_json.='"lien_suivant" : "'.$lien_suivant.'" , ';
     //lien pr�c�dent
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
     //On cr�e notre tableau de 6semaines*7jours soit 42 �l�ments.
     //On r�cup�re le jour qui d�mmarre le mois
     //ON va stocker tous les jours du mois dans un tableau tab_jours php
     $tab_jours=array();

     $num_jour=getFirstDay($mois,$annee);
     $compteur=1;
     $num_jour_courant=1;

     while($compteur<43){
     if($compteur<$num_jour){
          $tab_jours[$compteur]='';
     }else
     {
         //si la date existe, on affiche alors le jour dans la cellule du tableau
         if(checkdate($mois,$num_jour_courant,$annee)){
              //On v�rifie si un �v�nement a lieu ce jour ci
              $date=$annee."-".$mois."-".$num_jour_courant;
              $contenu='';
              $requete = "SELECT * FROM europa_trajet 
						WHERE date_trajet='".$date." 07:00:00'
							AND type_trajet = 'ALLER'
							OR date_trajet='".$date." 08:00:00'
							AND type_trajet = 'ALLER'
							OR date_trajet='".$date." 09:00:00'
							AND type_trajet = 'ALLER'
							OR date_trajet='".$date." 10:00:00'
							AND type_trajet = 'ALLER'
							OR date_trajet='".$date." 11:00:00'
							AND type_trajet = 'ALLER'
							OR date_trajet='".$date." 12:00:00'
							AND type_trajet = 'ALLER'
							OR date_trajet='".$date." 13:00:00'
							AND type_trajet = 'ALLER'
							OR date_trajet='".$date." 14:00:00'
							AND type_trajet = 'ALLER'
							OR date_trajet='".$date." 15:00:00'
							AND type_trajet = 'ALLER'
							OR date_trajet='".$date." 16:00:00'
							AND type_trajet = 'ALLER'
							OR date_trajet='".$date." 17:00:00'
							AND type_trajet = 'ALLER'
							OR date_trajet='".$date." 18:00:00'
							AND type_trajet = 'ALLER'
							OR date_trajet='".$date." 19:00:00'
							AND type_trajet = 'ALLER'
							OR date_trajet='".$date." 20:00:00'
							AND type_trajet = 'ALLER'
							OR date_trajet='".$date." 21:00:00'
							AND type_trajet = 'ALLER'
							";
              $ress=mysql_query($requete);
              if($ress){
                  $nbre=mysql_num_rows($ress);

                  if($nbre>0){
                     //lien vers le script qui va d�clencher l'affichage des �v�nement pour le jour donn�
		/*			 $annee1 = date("Y", $annee);
					 $mois1 = date("m", $mois);
					 $num_jour_courant1 = date("d", $num_jour_courant);*/
					 $date1[jour]=$num_jour_courant;
					 $date1[mois]=$mois;
					 $date1[annee]=$annee;
					 $annee1 = date("Y");
					 $mois1 = date("m");
					 $num_jour_courant1 = date("d");
					 if($date1[jour] < $num_jour_courant1 && $date1[mois] <= $mois1 && $date1[annee] <= $annee1)
					 {
						$tab_jours[$compteur]=$num_jour_courant;
					}
					 else
					{
						$lien='<a href=\'#\' onclick=\'showEvent(\\"'.$date.'\\");\'>'.$num_jour_courant.'</a>';
						$tab_jours[$compteur]=$lien;
					}
                  }else
                  {

                    $tab_jours[$compteur]=$num_jour_courant;
                  }
                  mysql_free_result($ress);
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
     // Maintenant que l'on a notre tableau d'�v�nements pour chaque jour du mois
     // On finit de construire la r�ponse JSON
     ///////////////////////////////////////////////////////////////////////////////////
     if(!empty($tab_jours)){
        $retour_json.=' "calendrier" : [ ';
        $compteur=1;
        while($compteur<43){
           if($compteur==42){
            $retour_json.=' { "fill" : "'.$tab_jours[$compteur].'" } ';
           }else
           {
            $retour_json.=' { "fill" : "'.$tab_jours[$compteur].'" } , ';
           }
        $compteur++;
        }
        $retour_json.=' ] ';
     }
     $retour_json.=' } ';

     echo $retour_json;

?>