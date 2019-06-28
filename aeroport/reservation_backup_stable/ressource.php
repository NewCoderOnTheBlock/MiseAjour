<?php
	@session_start();

	function ressource($type, $type1, $type2) // aller|depart|(vehicule|chauffeur) ; retour|retour|(vehicule|chauffeur)
	{
		if($type2 == "vehicule")
			$_SESSION[$type2 . '_id_' . $type] = 3;
		else
			$_SESSION[$type2 . '_id_' . $type] = 0;
			
		$_SESSION['ressource_' . $type] = false;

        
		$tab_ok = array();

		
		$tab_if = array();
		$tab_foreach = array();
		
		if($type2 == "vehicule")
		{
			$tab_date = explode('-', $_SESSION['trajet']['date_' . $type1]);
		
			$annee = intval($tab_date[2]);
			$mois = intval($tab_date[1]);
			$jour = intval($tab_date[0]);
			
			$format_date = "'" . $annee . "-" . $mois . "-" . $jour . " " . $_SESSION['trajet']['heure_' . $type1] . "'";
			
			$nb_pers = ($_SESSION['trajet']['passager_adulte_' . $type] + $_SESSION['trajet']['passager_enfant_' . $type]);
			
			$tab_if = get_tab_vehicule_roule_pas($format_date, $nb_pers);

			$tab_foreach = get_id_vehicule($nb_pers);

			$tab_ok = $tab_if;
		}
		else
		{
			// heure ou le chauffeur reviendrai
			$duree_un_trajet = query("SELECT duree FROM aeroport_lieu WHERE id_lieu = '" . (($_SESSION['trajet']['dest'] == 100) ? $_SESSION['trajet']['depart'] : $_SESSION['trajet']['dest']) . "'");
			
			$row_duree = $duree_un_trajet->fetch();
			
			$duree_trajet = $row_duree['duree'];
			
			if($_SESSION['trajet']['dest'] != 100)
				$duree_trajet *= 2;
				
			$tab_heure_depart_trajet = explode(':', $_SESSION['trajet']['heure_depart']);
			$heure_retour_trajet = mktime($tab_heure_depart_trajet[0], $tab_heure_depart_trajet[1]) + $duree_trajet;
	
			// chauffeurs qui sont disponibles à cette heure
			$tab_chauffeur_pas_conge = get_chauffeur_pas_conge($_SESSION['trajet']['date_' . $type1], $_SESSION['trajet']['heure_depart']);

			// chauffeur qui ne roulent pas du tout ce jour et qui sont pas en congé (ceux dispo quoi)
			$tab_chauffeur_ok = tab_chauffeur_roule_pas($_SESSION['trajet']['date_' . $type1], date('H:i', $heure_retour_trajet));

			$tab_if = $tab_chauffeur_ok;
			$tab_foreach = $tab_chauffeur_pas_conge;

			$tab_ok = $tab_chauffeur_ok;
		}


		foreach($tab_foreach as $id)
		{
			$continue = true;
			
			
			if(!in_array($id, $tab_if))
			{
				$tab = array();
				
				//            0              1             2           3             4         5       6        7
				//tableau ID_TRAJET - TPS_avant_depart - DUREE - HEURE_DEPART - TYPE_TRAJET - DEST - DEPART - EST_PAYE de la navette
				if($type2 == "vehicule")
				{
					if(! ($tab = get_premier_dernier($id, $_SESSION['trajet']['heure_' . $type1], $_SESSION['trajet']['date_' . $type1])))
						$continue = false;
				}
				else
				{
					if(! ($tab = get_premier_dernier2($id, $_SESSION['trajet']['heure_' . $type1], $_SESSION['trajet']['date_' . $type1])))
						$continue = false;
				}
				
				
				if($continue)
				{
					$tab_hr = explode(':', $_SESSION['trajet']['heure_' . $type1]);
					$hr_courant = intval($tab_hr[0]);
	
					$hr_depart_navette_courant;
					if($_SESSION['trajet']['dest'] == 100) // navette courante de aéroport vers strasbourg : on change l'heure de départ
					{
						$tab_hr_tmp = explode(':', $_SESSION['trajet']['heure_' . $type1]);
						
						$seconde = mktime($tab_hr_tmp[0], $tab_hr_tmp[1]);
						$hr_depart_navette_courant = date('H:i', $seconde - get_duree_depuis_trajet($_SESSION['trajet'][$type1]));
					}
					else
						$hr_depart_navette_courant = $_SESSION['trajet']['heure_' . $type1];
	
					if($tab[1][0] == 0 && $tab[0][0] != 0 && $hr_depart_navette_courant.':00' != $tab[0][3]) // si pas départ après mais avant et pas de navette à la même heure
					{
						if($tab[0][5] != 100) // départ stasbourg
							$tab[0][2] *= 2; // durée du trajet multiplié par 2
	
						$tmp_tps = explode(':', $tab[0][3]);
						
						$var = mktime($tmp_tps[0], $tmp_tps[1]);
	
						$heure_arrive = $tab[0][2] + $var; // durée du trajet avant + heure de départ trajet avant
	
						$tmp_dep = explode(':', $_SESSION['trajet']['heure_' . $type1]);			
	
	
						if(($heure_arrive) <= mktime($tmp_dep[0], $tmp_dep[1]))
							$tab_ok[] = $id;
					}
					elseif($tab[0][0] == 0 && $tab[1][0] != 0 && $hr_depart_navette_courant.':00' != $tab[1][3]) // si pas navette avant mais une après
					{
						$t = ($_SESSION['trajet']['dest'] == 100) ? $_SESSION['trajet']['depart'] : $_SESSION['trajet']['dest'];
						$d = get_duree_depuis_trajet($t);
	
						if($_SESSION['trajet']['dest'] != 100)
							$d *= 2;
							
						$t2 = ($tab[1][5] == 100) ? $tab[1][6] : $tab[1][5];
						$d2 = get_duree_depuis_trajet($t2);
							
						$tmp_tps = explode(':', $tab[1][3]);
	
						$tmp_ret = explode(':', $_SESSION['trajet']['heure_'. $type1]);
	
						$heure_retour = $d + mktime($tmp_ret[0], $tmp_ret[1]); // retour de la navette courant
	
						$tps_depart_reel = mktime($tmp_tps[0], $tmp_tps[1]);
						if($tab[1][5] == 100)
							$tps_depart_reel -= $d2;
	
						if($heure_retour <= $tps_depart_reel)
							$tab_ok[] = $id;
					}
					elseif($tab[0][0] != 0 && $hr_depart_navette_courant.':00' != $tab[0][3] && $hr_depart_navette_courant.':00' != $tab[1][3]) // navette avant et après et pas au meme moment
					{
						if($tab[0][5] != 100) // si pas aeroport->strasbourg
							$tab[0][2] *= 2; // durée du trajet multiplié par 2
	
						$tmp_tps = explode(':', $tab[0][3]);
							
						$var = mktime($tmp_tps[0], $tmp_tps[1]);
	
						$heure_retour_avant = $tab[0][2] + $var; // durée du trajet avant + heure de départ trajet avant
	
						$tmp_ret = explode(':', $_SESSION['trajet']['heure_'. $type1]);
	
						if(($heure_retour_avant) <= mktime($tmp_ret[0], $tmp_ret[1])) // si navette avant OK
						{
							$t = ($_SESSION['trajet']['dest'] == 100) ? $_SESSION['trajet']['depart'] : $_SESSION['trajet']['dest'];
							$d = get_duree_depuis_trajet($t);
	
							if($_SESSION['trajet']['dest'] != 100)
								$d *= 2;
								
							$t2 = ($tab[1][5] == 100) ? $tab[1][6] : $tab[1][5];
							$d2 = get_duree_depuis_trajet($t2);
								
							$tmp_tps = explode(':', $tab[1][3]);
	
							$tmp_ret = explode(':', $_SESSION['trajet']['heure_'. $type1]);
	
							$heure_retour = $d + mktime($tmp_ret[0], $tmp_ret[1]); // retour de la navette courant
	
							$tps_depart_reel = mktime($tmp_tps[0], $tmp_tps[1]);
							if($tab[1][5] == 100)
								$tps_depart_reel -= $d2;
	
							if($heure_retour <= $tps_depart_reel)
								$tab_ok[] = $id;
						}
					}
					elseif($tab[0][0] == 0 && $tab[1][0] == 0) // aucun trajet avant ni après (que pour pacha normalement)
					{
						$tab_ok[] = $id;	
					}
				}
			}
		}
		
		
		$trouve = false;
		$tab_trouve = 0;
		$id_com = 0;
		
		
		// voir si correspondance dans gestion planning
		
		//départ strasbourg
		if($_SESSION['trajet']['depart'] == 100)
		{
			$tab_hr = explode(':', $_SESSION['trajet']['heure_' . $type1]);
			$tab_date = explode('-', $_SESSION['trajet']['date_' . $type1]);
			

			$tps_en_seconde = mktime(intval($tab_hr[0]), intval($tab_hr[1]), 0, intval($tab_date[1]), intval($tab_date[0]), intval($tab_date[2])) + (4 * get_duree($_SESSION['trajet']['dest']));


			$tps_en_seconde2 = mktime(intval($tab_hr[0]), intval($tab_hr[1]), 0, intval($tab_date[1]), intval($tab_date[0]), intval($tab_date[2])) + get_duree($_SESSION['trajet']['dest']);

			$sql = "SELECT id_trajet
					FROM aeroport_trajet
					WHERE date BETWEEN :date1
					AND :date2
					AND id_lieu_depart = :dest
					AND id_lieu_dest = :depart
                    AND est_paye = 1
					ORDER BY date ASC";

			$param = array(
						   ':date1' => date('Y-m-d H:i:00', $tps_en_seconde2),
						   ':date2' => date('Y-m-d H:i:00', $tps_en_seconde),
						   ':dest' => $_SESSION['trajet']['dest'],
						   ':depart' => $_SESSION['trajet']['depart']
						   );
				
			$ret = query_prepare($sql, $param, "ressource_1");
			
			while(($roww = $ret->fetch()) && !$trouve)
			{
                $query_tmp = query_prepare("SELECT g.id_com
                                            FROM aeroport_gestion_planning g, aeroport_trajet t
                                            WHERE g.id_com = (SELECT id_com
                                                                FROM aeroport_gestion_planning
                                                                WHERE id_trajet = :id)
                                            AND t.id_trajet = g.id_trajet
                                            AND t.est_paye = 1", array(':id' => $roww['id_trajet']), "ressource_2");
				
				
				if($query_tmp->rowCount() < 2)
				{
					$sql = "SELECT DISTINCT id_" . $type2 . " AS " . $type2 . ", id_com
							FROM aeroport_gestion_planning
							WHERE id_com = (SELECT DISTINCT id_com
											FROM aeroport_gestion_planning
											WHERE id_trajet = '" . $roww['id_trajet'] . "')";
							
				//	echo $sql;
		
					$ret2 = query($sql);
					
					if($ret2->rowCount() == 1)
					{
						$rowww = $ret2->fetch();
						
						$trouve = true;
						$tab_trouve = $rowww[$type2];
						$id_com = $rowww['id_com'];
	
						break;
					}
					
					$ret2->closeCursor();
				}
				
				$query_tmp->closeCursor();
			}
			
			$ret->closeCursor();
		}
		else // départ aéroport
		{

			$tab_hr = explode(':', $_SESSION['trajet']['heure_' . $type1]);
			$tab_date = explode('-', $_SESSION['trajet']['date_' . $type1]);

			$tps_en_seconde = mktime(intval($tab_hr[0]), intval($tab_hr[1]), 0, intval($tab_date[1]), intval($tab_date[0]), intval($tab_date[2])) - (3 * get_duree($_SESSION['trajet']['depart']));
			
			$tps_en_seconde2 = mktime(intval($tab_hr[0]), intval($tab_hr[1]), 0, intval($tab_date[1]), intval($tab_date[0]), intval($tab_date[2]));
			
			$sql = "SELECT id_chauffeur, id_vehicule, id_trajet
					FROM aeroport_trajet t
					WHERE ADDTIME(t.date, (SELECT SEC_TO_TIME(l.duree)
															FROM aeroport_lieu l
															WHERE l.id_lieu = '" . $_SESSION['trajet']['depart'] . "'
															))
					BETWEEN '" . date('Y-m-d H:i:00', $tps_en_seconde) . "' AND '" . date('Y-m-d H:i:00', $tps_en_seconde2) . "'
					AND t.id_lieu_dest = '" . $_SESSION['trajet']['depart'] . "'
					AND t.est_paye = 1
					AND DATEDIFF(t.date, '" . date('Y-m-d', $tps_en_seconde2) . "') = 0
					ORDER BY t.date ASC";
					
					//echo $sql;

			
			$ret = query($sql);
			
			while(($roww = $ret->fetch()) && !$trouve)
			{
				$query_tmp = query_prepare("SELECT g.id_com
                                            FROM aeroport_gestion_planning g, aeroport_trajet t
                                            WHERE g.id_com = (SELECT id_com
                                                                FROM aeroport_gestion_planning
                                                                WHERE id_trajet = :id)
                                            AND t.id_trajet = g.id_trajet
                                            AND t.est_paye = 1", array(':id' => $roww['id_trajet']), "ressource_2");

				if($query_tmp->rowCount() < 2)
				{
					$sql = "SELECT DISTINCT id_" . $type2 . " AS " . $type2 . ", id_com
							FROM aeroport_gestion_planning
							WHERE id_com = (SELECT DISTINCT id_com
											FROM aeroport_gestion_planning
											WHERE id_trajet = '" . $roww['id_trajet'] . "')";
	
					$ret2 = query($sql);
					
					if($ret2->rowCount() == 1)
					{
						$rowww = $ret2->fetch();
	
						$trouve = true;
						$tab_trouve = $rowww[$type2];
						$id_com = $rowww['id_com'];
	
						break;
					}
					
					$ret2->closeCursor();
				}
				
				$query_tmp->closeCursor();
			}
			
			$ret->closeCursor();
		}
		
		
		if($trouve)
		{
			$_SESSION[$type2 . '_id_'. $type] = $tab_trouve;
			
			$_SESSION['id_com_' . $type] = $id_com;

            $_SESSION['ressource_' . $type] = true;
		}
		else
		{
			if(count($tab_ok) <= 0)
			{
				if($type2 == "vehicule")
				{
					$_SESSION[$type2 . '_id_'. $type] = 3;
				}
				else
				{
					$_SESSION[$type2 . '_id_'. $type] = 0;
				}
			}
			else
			{
				do {
					$ch = $tab_ok[mt_rand(0, count($tab_ok)-1)];
				}				
				while($ch == 6 && count($tab_ok) > 1);
					
				
				$_SESSION[$type2 . '_id_'. $type] = $ch;
			}
		}
		
		/*
		
		if($type2 == "vehicule")
		{
			echo 'vehicule : ';
			print_r($tab_ok);
		}
		else
		{
			echo 'chauffeur:';
			print_r($tab_ok);
		}

		echo $_SESSION[$type2 . '_id_'. $type];
		*/
		
	}

?>