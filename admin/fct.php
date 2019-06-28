<?php
	//set_time_limit(0);
	
	function trouverNomAeroport($idLieu){
		$req = "SELECT nom FROM aeroport_lieu where id_lieu = '".$idLieu."'";
		$result = mysql_query($req) or die (mysql_error());
		$r = @mysql_fetch_assoc($result);
		return utf8_decode($r['nom']);
	}
	function trouverNomChauffeur($id){
		$req = "SELECT nom FROM chauffeur where idchauffeur = '".$id."'";
		$result = mysql_query($req) or die (mysql_error());
		$r = @mysql_fetch_assoc($result);
		return utf8_decode($r['nom']);
	}
	
	function formaterTps($sec){
		$tps = "";
		if(floor($sec/3600)>0){
			$h=floor($sec/3600);
			$sec = $sec - $h*3600;
			$h.="h";
			$tps.=$h;
		}
		if(floor($sec/60)>0){
			$m=floor($sec/60)."m";
			$tps.=$m;
			
		}
		return $tps;
		
	}
    /*function exploser($heure)
    {
        $tab = explode(':', $heure);

        return mktime($tab[0], $tab[1], $tab[2]);
    }*/
	
	function calculerMoyenneConducteur($id_chauffeur, $id_lieu, $date, $periode){//$date = "AAAA MM" ou "AAAA SS" selon le param�tre periode
		if($periode == "s"){
			$msg =  "DATE_FORMAT(t.date, '%x %v')";
		}
		else{
			$msg =  "DATE_FORMAT(t.date, '%Y %c')";
		}

		$req = "SELECT  
						r.kmsD as kmsD,
						r.kmsA as kmsA,
						r.pass_retour_nonres as nonResRetour,
						r.pass_aller_nonres as nonResAller,
						TIME_TO_SEC(r.heureD_str) as heureD_str,
						TIME_TO_SEC(r.heureA_aero) as heureA_aero,
						TIME_TO_SEC(r.heureD_aero) as heureD_aero,
						TIME_TO_SEC(r.heureA_str) as heureA_str,
						g.type as typeTrajet,
						g.id_lieu as idLieu
				FROM aeroport_recap_trajet r, aeroport_trajet t, aeroport_gestion_planning g 
				WHERE r.id_conducteur = '".$id_chauffeur."'
				AND g.id_com = r.idcm 
				AND g.id_trajet = t.id_trajet 
				AND g.id_lieu = '".$id_lieu."' 
				AND ".$msg." = '".$date."'";
        
				
		$result = mysql_query($req) or die (mysql_error());
		$nb = mysql_num_rows($result);
		$km = 0;
		$tps = 0;
		$nbPers = 0;

       
		while($r = @mysql_fetch_assoc($result)){
			$kmsD = $r['kmsD'];
			$kmsA = $r['kmsA'];
			$nonResRetour = $r['nonResRetour'];
			$nonResAller = $r['nonResAller'];
			$heureD_str = $r['heureD_str'];
			$heureA_aero = $r['heureA_aero'];
			$heureD_aero = $r['heureD_aero'];
			$heureA_str = $r['heureA_str'];
			$typeTrajet = $r['typeTrajet'];
			$idLieu = $r['idLieu'];
			
			if($typeTrajet=="retour"){
				$tps+= ($heureA_str - $heureD_aero);
				$nbPers+= $nonResRetour;
			}
			else{
				$tps+= ($heureA_aero - $heureD_str);
				$nbPers+= $nonResAller;
			}
			$km+= $kmsA - $kmsD;
			
		}
        if($km != 0 && $tps != 0 && $nbPers !=0)
        {
            $km = intval($km/$nb);
            $tps = intval($tps/$nb);
            $nbPers = intval($nbPers/$nb);
        }
		$tps = formaterTps($tps);
		

		$chauf = trouverNomChauffeur($id_chauffeur);
		$lieu = trouverNomAeroport($id_lieu);
		
		return array($chauf,$lieu,$nb,$km,$tps,$nbPers);
	}
	
	function creer_csv_chauff($annee, $periode){
		 if(file_exists('./bilan_'.$annee.'.csv'))
                unlink('./bilan_'.$annee.'.csv');  // on vire l'ancien fichier s'il existe
		if($fichier = fopen("./bilan_".$annee.".csv", "a")){ //ouverture du fichier
			
			$tab_csv = array(utf8_decode('période'),'chauffeur',utf8_decode('aéroport'),utf8_decode('nombre de navettes effectuées'),'moyenne km sur une navette','moyenne de temps sur une navette',utf8_decode('moyenne de passagers non prévus sur une navette'));
			fputcsv($fichier, $tab_csv, ';'); // on �crit dans le fichier les ent�tes des colonnes
			$tab_chauff = retourner_tab_chauff(); // r�cup�ration des id des conducteurs
			$tab_lieu = retourner_tab_lieu(); // r�cup�ration des id des a�roports

			//si on demande par mois
			if($periode == "m"){
				$x = 12;
				$tab_libelle = array('','Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Decembre');
			}
			//si on demande par jour
			else{
				//on regarde le num�ro de la derni�re semaine de l'annee demand�e
				$reqan = "SELECT WEEK('".$annee."-12-31') as nbWeek";
				$resultan = mysql_query($reqan) or die (mysql_error());
				$ran = @mysql_fetch_assoc($resultan);
				$x =  $ran['nbWeek'];
				$tab_libelle = array('','semaine 1','semaine 2','semaine 3','semaine 4','semaine 5','semaine 6','semaine 7','semaine 8','semaine 9','semaine 10','semaine 11','semaine 12','semaine 13','semaine 14','semaine 15','semaine 16','semaine 17','semaine 18','semaine 19','semaine 20','semaine 21','semaine 22','semaine 23','semaine 24','semaine 25','semaine 26','semaine 27','semaine 28','semaine 29','semaine 30','semaine 31','semaine 32','semaine 33','semaine 34','semaine 35','semaine 36','semaine 37','semaine 38','semaine 39','semaine 40','semaine 41','semaine 42','semaine 43','semaine 44','semaine 45','semaine 46','semaine 47','semaine 48','semaine 49','semaine 50','semaine 51','semaine 52','semaine 53','semaine 54','semaine 55');
				
			}	
				
				for($i=1; $i<=$x ; $i++){
                    
					foreach( $tab_lieu as $lieu){
						
						foreach( $tab_chauff as $chauff){
							$tab = array($tab_libelle[$i]);
							fputcsv($fichier, array_merge( $tab, calculerMoyenneConducteur($chauff, $lieu, $annee." ".$i, $periode) ), ';');
						}
					
					}
				}
				
			
			
		}
		fclose($fichier); // fermeture du fichier
		
		
        // pour lancer le t�l�chargement du fichier
        header("Content-disposition: attachment; filename=bilan_".$annee.".csv");
        header("Content-Type: application/force-download");
        header("Content-Transfer-Encoding: text/plain\n"); // ne pas enlever le \n
        header("Content-Length: ".filesize('./bilan_'.$annee.'.csv'));
        header("Pragma: no-cache");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0, public");
        header("Expires: 0");
        header('Pragma: public');
        readfile('./bilan_'.$annee.'.csv');
		
		



	}
	
	function retourner_tab_chauff(){
		$req = "SELECT idchauffeur FROM chauffeur where idchauffeur != '0'";
		$result = mysql_query($req) or die (mysql_error());

        $res = array();

		while($r = @mysql_fetch_array($result))
            $res[] = $r['idchauffeur'];

        return $res;
	}
	function retourner_tab_lieu(){
		$req = "SELECT id_lieu FROM aeroport_lieu where id_lieu != '100'";
		$result = mysql_query($req) or die (mysql_error());

		$res = array();

		while($r = @mysql_fetch_array($result))
            $res[] = $r['id_lieu'];

        return $res;
	}
		
		
		
		
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function calculerMoyenneNavette($id_lieu, $date, $periode){//$date = "AAAA MM" ou "AAAA SS" selon le param�tre periode
		if($periode == "s"){
			$msg =  "DATE_FORMAT(t.date, '%x %v')";
		}
		else{
			$msg =  "DATE_FORMAT(t.date, '%Y %c')";
		}

		$req = "SELECT  
						r.pass_retour_nonres as nonResRetour,
						r.pass_aller_nonres as nonResAller,
						g.type as typeTrajet,
						g.id_lieu as idLieu,
						(l.prix-l.remboursement) as recette,
						l.prov_dest as prov_dest,
						l.nb_pers as nb_pers,
						r.montantA as montantA,
						r.montantR as montantR
				FROM aeroport_recap_trajet r, aeroport_trajet t, aeroport_gestion_planning g , aeroport_ligne_resa l
				WHERE g.id_com = r.idcm 
				AND g.id_trajet = t.id_trajet 
				AND l.id_trajet = t.id_trajet 
				AND g.id_lieu = '".$id_lieu."' 
				AND ".$msg." = '".$date."'
				";
        
				
		$result = mysql_query($req) or die (mysql_error());
		$nb = mysql_num_rows($result);
	

       $array = array();
		while($r = @mysql_fetch_assoc($result)){
			$nonResRetour = $r['nonResRetour'];
			$nonResAller = $r['nonResAller'];
			$typeTrajet = $r['typeTrajet'];
			$idLieu = $r['idLieu'];
			$recette = $r['recette'];
			$prov_dest = $r['prov_dest'];
			//$montantA = $r['montantA'];
			//$montantR = $r['montantR'];
			$nbPers = $r['nb_pers'];
			
			if($typeTrajet=="retour"){
				//$nbPersNR = $nonResRetour;
				//$recette = $montantR;
			}
			else{
				//$nbPersNR = $nonResAller;
				//$recette = $montantA;
				
			}
			$lieu = trouverNomAeroport($id_lieu);
			$array[] = array($lieu,$prov_dest,$nbPers,$recette);
		}
		

		
		
		return $array;
}
	



function creer_csv_navette($annee, $periode){
		 if(file_exists('./compta_'.$annee.'.csv'))
                unlink('./compta_'.$annee.'.csv');  // on vire l'ancien fichier s'il existe
		if($fichier = fopen("./compta_".$annee.".csv", "a+")){ //ouverture du fichier
			
			$tab_csv = array(utf8_decode('période'),utf8_decode('aéroport'),utf8_decode('Destination'),utf8_decode('Nombre de passagers qui ont réservé'),utf8_decode('recette des réservations'));
			fputcsv($fichier, $tab_csv, ';'); // on �crit dans le fichier les ent�tes des colonnes
			
			$tab_lieu = retourner_tab_lieu(); // r�cup�ration des id des a�roports

			//si on demande par mois
			if($periode == "m"){
				$x = 12;
				$tab_libelle = array('','Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Decembre');
			}
			//si on demande par jour
			else{
				//on regarde le num�ro de la derni�re semaine de l'annee demand�e
				$reqan = "SELECT WEEK('".$annee."-12-31') as nbWeek";
				$resultan = mysql_query($reqan) or die (mysql_error());
				$ran = @mysql_fetch_assoc($resultan);
				$x =  $ran['nbWeek'];
				$tab_libelle = array('','semaine 1','semaine 2','semaine 3','semaine 4','semaine 5','semaine 6','semaine 7','semaine 8','semaine 9','semaine 10','semaine 11','semaine 12','semaine 13','semaine 14','semaine 15','semaine 16','semaine 17','semaine 18','semaine 19','semaine 20','semaine 21','semaine 22','semaine 23','semaine 24','semaine 25','semaine 26','semaine 27','semaine 28','semaine 29','semaine 30','semaine 31','semaine 32','semaine 33','semaine 34','semaine 35','semaine 36','semaine 37','semaine 38','semaine 39','semaine 40','semaine 41','semaine 42','semaine 43','semaine 44','semaine 45','semaine 46','semaine 47','semaine 48','semaine 49','semaine 50','semaine 51','semaine 52','semaine 53','semaine 54','semaine 55');
				
			}	
				
				for($i=1; $i<=$x ; $i++){
                    
					foreach( $tab_lieu as $lieu){
						foreach( calculerMoyenneNavette( $lieu, $annee." ".$i, $periode) as $tabRes){
							
							$tab = array($tab_libelle[$i]);
							fputcsv($fichier, array_merge( $tab, $tabRes ), ';');
						}
					
					}
				}
				
			
			
		}
		fclose($fichier); // fermeture du fichier
		
		
        // pour lancer le t�l�chargement du fichier
        header("Content-disposition: attachment; filename=compta_".$annee.".csv");
        header("Content-Type: application/force-download");
        header("Content-Transfer-Encoding: text/plain\n"); // ne pas enlever le \n
        header("Content-Length: ".filesize('./compta_'.$annee.'.csv'));
        header("Pragma: no-cache");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0, public");
        header("Expires: 0");
        header('Pragma: public');
        readfile('./compta_'.$annee.'.csv');
		
		



	}
?>