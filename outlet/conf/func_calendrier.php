<?php
	session_start();
     //Quelques fonctions utiles pour la gestion d'un calendrier
     
     //Transforme un numéro de mois en son nom
     function getMois($mois){
       $mois=sprintf("%d",$mois);
       $tab_mois_fr =array("Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre");
	   $tab_mois_en =array("January","February","March","April","May","June","July","August","September","October","November","December");
       return ${"tab_mois_" . $_SESSION['lang']}[$mois-1];
     }
     
     //fonction qui renvoit le mois et l'année  dans le calendrier en fonction du pas
     //un pas de 1 signifie la date pour le mois suivant celui passé en paramètre
     //un pas de -1 signifie la date pour le mois précédent celui passé en paramètre
     function getSuivant($mois,$annee,$pas){
       $tmstp_suivant=mktime(0,0,0,($mois+$pas),1,$annee);
/*	   $date_now = mktime(0,0,0,date("m"),1,date("Y"));
	   if($tmstp_suivant < $date_now)
		{
			$date_suivante[mois]=date("m",$date_now);
			$date_suivante[annee]=date("Y",$date_now);
		else
		{*/
		   $date_suivante[mois]=date("m",$tmstp_suivant);
		   $date_suivante[annee]=date("Y",$tmstp_suivant);
		//}
       return $date_suivante;
     }
     
     //fonction qui retourne le premier jour du mois
     //0->Lundi
     //1->Mardi
     //...
     //6->Dimanche
     function getFirstDay($mois,$annee){
       $tmstp=mktime(0,0,0,$mois,1,$annee);
       //on récupère le numéro du jour de la semaine... mais au format anglais (0->dimanche, ...) mais
       //nous on veut un calendrier commençant le lundi !!
       $jour=date("w",$tmstp);

       $tab_jour=array(0=>7,1=>1,2=>2,3=>3,4=>4,5=>5,6=>6);
       
       return $tab_jour[$jour];
     }
?>