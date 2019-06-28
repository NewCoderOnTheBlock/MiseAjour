





<?php


	if(!isset($_GET['annee_recherchee'])){					
		$annee_recherchee = '2009';
	}
	else{
		$annee_recherchee = $_GET['annee_recherchee'];
	}


	if($_SESSION['user_type'] != 'c'){
		$id = $_GET['idchauf'];
	}
	else{
		$id = $_SESSION['user_id'];
	}

	include("connection.php");
	
	$req_heure_chauff = "SELECT g.id_com as idcm,
				DATE_FORMAT(t.date, '%m') mois,
				DATE_FORMAT(t.date, '%d') jour,
				DATE_FORMAT(r.heureD_str, '%H') as heureDep,
				DATE_FORMAT(r.heureD_str, '%i') as minutesDep,
				DATE_FORMAT(r.heureA_str, '%H') as heureA,
				DATE_FORMAT(r.heureA_str, '%i') as minutesA
				FROM aeroport_trajet t,
				aeroport_recap_trajet r,
				aeroport_gestion_planning g
					WHERE DATE_FORMAT(t.date, '%Y') = '".$annee_recherchee."'  
					AND r.id_conducteur = '".$id."'  
					AND r.idcm =  g.id_com
					AND g.id_trajet = t.id_trajet 
					GROUP BY g.id_com";
                   
	$res_heure_chauff = mysql_query($req_heure_chauff)or die(mysql_error());
	
	$heureJanvier = 0;
	$heureFevrier = 0;
	$heureMars = 0;
	$heureAvril = 0;
	$heureMai = 0;
	$heureJuin = 0;
	$heureJuillet = 0;
	$heureAout = 0;
	$heureSeptembre = 0;
	$heureOctobre = 0;
	$heureNovembre = 0;
	$heureDecembre = 0;
	// première quinzaine de chaque mois
	$heureJanvier1 = 0;
	$heureFevrier1 = 0;
	$heureMars1 = 0;
	$heureAvril1 = 0;
	$heureMai1 = 0;
	$heureJuin1 = 0;
	$heureJuillet1 = 0;
	$heureAout1 = 0;
	$heureSeptembre1 = 0;
	$heureOctobre1 = 0;
	$heureNovembre1 = 0;
	$heureDecembre1 = 0;
	//deuxième quinzaine de chaque mois
	$heureJanvier2 = 0;
	$heureFevrier2 = 0;
	$heureMars2 = 0;
	$heureAvril2 = 0;
	$heureMai2 = 0;
	$heureJuin2 = 0;
	$heureJuillet2 = 0;
	$heureAout2 = 0;
	$heureSeptembre2 = 0;
	$heureOctobre2 = 0;
	$heureNovembre2 = 0;
	$heureDecembre2 = 0;
	
	$minuteJanvier = 0;
	$minuteFevrier = 0;
	$minuteMars = 0;
	$minuteAvril = 0;
	$minuteMai = 0;
	$minuteJuin = 0;
	$minuteJuillet = 0;
	$minuteAout = 0;
	$minuteSeptembre = 0;
	$minuteOctobre = 0;
	$minuteNovembre = 0;
	$minuteDecembre = 0;
	// première quinzaine de chaque mois
	$minuteJanvier1 = 0;
	$minuteFevrier1 = 0;
	$minuteMars1 = 0;
	$minuteAvril1 = 0;
	$minuteMai1 = 0;
	$minuteJuin1 = 0;
	$minuteJuillet1 = 0;
	$minuteAout1 = 0;
	$minuteSeptembre1 = 0;
	$minuteOctobre1 = 0;
	$minuteNovembre1 = 0;
	$minuteDecembre1 = 0;
	//deuxième quinzaine de chaque mois
	$minuteJanvier2 = 0;
	$minuteFevrier2 = 0;
	$minuteMars2 = 0;
	$minuteAvril2 = 0;
	$minuteMai2 = 0;
	$minuteJuin2 = 0;
	$minuteJuillet2 = 0;
	$minuteAout2 = 0;
	$minuteSeptembre2 = 0;
	$minuteOctobre2 = 0;
	$minuteNovembre2 = 0;
	$minuteDecembre2 = 0;
	
	
	while ($r = @mysql_fetch_assoc($res_heure_chauff)){
		$idcm = $r["idcm"];
		$mois = $r["mois"];
		$jour = $r["jour"];
		$heureDep = $r["heureDep"];
		$minuteDep = $r["minutesDep"];
		$heureA = $r["heureA"];
		$minuteA = $r["minutesA"];
		
		
		// calcul du temps passé
		$heure = $heureA - $heureDep;
		if($heure <0){
			$heure = $heure +24;
		}
		$minute = $minuteA - $minuteDep;
		if($minute <0){
			$minute = $minute + 60;
			$heure = $heure -1;
		}
		//switch selon le mois
		switch ($mois){
			case 01 :
				$heureJanvier = $heureJanvier + $heure;
				$minuteJanvier = $minuteJanvier + $minute;
				if($minuteJanvier >= 60){
					$minuteJanvier = $minuteJanvier - 60;
					$heureJanvier = $heureJanvier + 1;
				}
				if($jour <= 15){
					$heureJanvier1 = $heureJanvier1 + $heure;
					$minuteJanvier1 = $minuteJanvier1 + $minute;
					if($minuteJanvier1 >= 60){
						$minuteJanvier1 = $minuteJanvier1 - 60;
						$heureJanvier1 = $heureJanvier1 + 1;
					}
				}
				else{
					$heureJanvier2 = $heureJanvier2 + $heure;
					$minuteJanvier2 = $minuteJanvier2 + $minute;
					if($minuteJanvier2 >= 60){
						$minuteJanvier2 = $minuteJanvier2 - 60;
						$heureJanvier2 = $heureJanvier2 + 1;
					}
				}
				break;
			case 02 :
				$heureFevrier = $heureFevrier + $heure;
				$minuteFevrier = $minuteFevrier + $minute;
				if($minuteFevrier >= 60){
					$minuteFevrier = $minuteFevrier - 60;
					$heureFevrier = $heureFevrier + 1;
				}
				if($jour <= 15){
					$heureFevrier1 = $heureFevrier1 + $heure;
					$minuteFevrier1 = $minuteFevrier1 + $minute;
					if($minuteFevrier1 >= 60){
						$minuteFevrier1 = $minuteFevrier1 - 60;
						$heureFevrier1 = $heureFevrier1 + 1;
					}
				}
				else{
					$heureFevrier2 = $heureFevrier2 + $heure;
					$minuteFevrier2 = $minuteFevrier2 + $minute;
					if($minuteFevrier2 >= 60){
						$minuteFevrier2 = $minuteFevrier2 - 60;
						$heureFevrier2 = $heureFevrier2 + 1;
					}
				}
				
				break;
			case 03 :
				$heureMars = $heureMars + $heure;
				$minuteMars = $minuteMars + $minute;
				if($minuteMars >= 60){
					$minuteMars = $minuteMars - 60;
					$heureMars = $heureMars + 1;
				}
				if($jour <= 15){
					$heureMars1 = $heureMars1 + $heure;
					$minuteMars1 = $minuteMars1 + $minute;
					if($minuteMars1 >= 60){
						$minuteMars1 = $minuteMars1 - 60;
						$heureMars1 = $heureMars1 + 1;
					}
				}
				else{
					$heureMars2 = $heureMars2 + $heure;
					$minuteMars2 = $minuteMars2 + $minute;
					if($minuteMars2 >= 60){
						$minuteMars2 = $minuteMars2 - 60;
						$heureMars2 = $heureMars2 + 1;
					}
				}
				
				break;
			case 04 :
				$heureAvril = $heureAvril + $heure;
				$minuteAvril = $minuteAvril + $minute;
				if($minuteAvril >= 60){
					$minuteAvril = $minuteAvril - 60;
					$heureAvril = $heureAvril + 1;
				}
				if($jour <= 15){
					$heureAvril1 = $heureAvril1 + $heure;
					$minuteAvril1 = $minuteAvril1 + $minute;
					if($minuteAvril1 >= 60){
						$minuteAvril1 = $minuteAvril1 - 60;
						$heureAvril1 = $heureAvril1 + 1;
					}
				}
				else{
					$heureAvril2 = $heureAvril2 + $heure;
					$minuteAvril2 = $minuteAvril2 + $minute;
					if($minuteAvril2 >= 60){
						$minuteAvril2 = $minuteAvril2 - 60;
						$heureAvril2 = $heureAvril2 + 1;
					}
				}
				
				break;
			case 05 :
				$heureMai = $heureMai + $heure;
				$minuteMai = $minuteMai + $minute;
				if($minuteMai >= 60){
					$minuteMai = $minuteMai - 60;
					$heureMai = $heureMai + 1;
				}
				if($jour <= 15){
					$heureMai1 = $heureMai1 + $heure;
					$minuteMai1 = $minuteMai1 + $minute;
					if($minuteMai1 >= 60){
						$minuteMai1 = $minuteMai1 - 60;
						$heureMai1 = $heureMai1 + 1;
					}
				}
				else{
					$heureMai2 = $heureMai2 + $heure;
					$minuteMai2 = $minuteMai2 + $minute;
					if($minuteMai2 >= 60){
						$minuteMai2 = $minuteMai2 - 60;
						$heureMai2 = $heureMai2 + 1;
					}
				}
				break;
			case 06 :
				$heureJuin = $heureJuin + $heure;
				$minuteJuin = $minuteJuin + $minute;
				if($minuteJuin >= 60){
					$minuteJuin = $minuteJuin - 60;
					$heureJuin = $heureJuin + 1;
				}
				if($jour <= 15){
					$heureJuin1 = $heureJuin1 + $heure;
					$minuteJuin1 = $minuteJuin1 + $minute;
					if($minuteJuin1 >= 60){
						$minuteJuin1 = $minuteJuin1 - 60;
						$heureJuin1 = $heureJuin1 + 1;
					}
				}
				else{
					$heureJuin2 = $heureJuin2 + $heure;
					$minuteJuin2 = $minuteJuin2 + $minute;
					if($minuteJuin2 >= 60){
						$minuteJuin2 = $minuteJuin2 - 60;
						$heureJuin2 = $heureJuin2 + 1;
					}
				}
			
				break;
			case 07 :
				$heureJuillet = $heureJuillet + $heure;
				$minuteJuillet = $minuteJuillet + $minute;
				if($minuteJuillet >= 60){
					$minuteJuillet = $minuteJuillet - 60;
					$heureJuillet = $heureJuillet + 1;
				}
				if($jour <= 15){
					$heureJuillet1 = $heureJuillet1 + $heure;
					$minuteJuillet1 = $minuteJuillet1 + $minute;
					if($minuteJuillet1 >= 60){
						$minuteJuillet1 = $minuteJuillet1 - 60;
						$heureJuillet1 = $heureJuillet1 + 1;
					}
				}
				else{
					$heureJuillet2 = $heureJuillet2 + $heure;
					$minuteJuillet2 = $minuteJuillet2 + $minute;
					if($minuteJuillet2 >= 60){
						$minuteJuillet2 = $minuteJuillet2 - 60;
						$heureJuillet2 = $heureJuillet2 + 1;
					}
				}
			
				break;				
				
			case 08 :
				$heureAout = $heureAout + $heure;
				$minuteAout = $minuteAout + $minute;
				if($minuteAout >= 60){
					$minuteAout = $minuteAout - 60;
					$heureAout = $heureAout + 1;
				}
				if($jour <= 15){
					$heureAout1 = $heureAout1 + $heure;
					$minuteAout1 = $minuteAout1 + $minute;
					if($minuteAout1 >= 60){
						$minuteAout1 = $minuteAout1 - 60;
						$heureAout1 = $heureAout1 + 1;
					}
				}
				else{
					$heureAout2 = $heureAout2 + $heure;
					$minuteAout2 = $minuteAout2 + $minute;
					if($minuteAout2 >= 60){
						$minuteAout2 = $minuteAout2 - 60;
						$heureAout2 = $heureAout2 + 1;
					}
				}
			
				break;				
			case 09 :
				$heureSeptembre = $heureSeptembre + $heure;
				$minuteSeptembre = $minuteSeptembre + $minute;
				if($minuteSeptembre >= 60){
					$minuteSeptembre = $minuteSeptembre - 60;
					$heureSeptembre = $heureSeptembre + 1;
				}
				if($jour <= 15){
					$heureSeptembre1 = $heureSeptembre1 + $heure;
					$minuteSeptembre1 = $minuteSeptembre1 + $minute;
					if($minuteSeptembre1 >= 60){
						$minuteSeptembre1 = $minuteSeptembre1 - 60;
						$heureSeptembre1 = $heureSeptembre1 + 1;
					}
				}
				else{
					$heureSeptembre2 = $heureSeptembre2 + $heure;
					$minuteSeptembre2 = $minuteSeptembre2 + $minute;
					if($minuteSeptembre2 >= 60){
						$minuteSeptembre2 = $minuteSeptembre2 - 60;
						$heureSeptembre2 = $heureSeptembre2 + 1;
					}
				}
			
				break;				
			case 10 :
				$heureOctobre = $heureOctobre + $heure;
				$minuteOctobre = $minuteOctobre + $minute;
				if($minuteOctobre >= 60){
					$minuteOctobre = $minuteOctobre - 60;
					$heureOctobre = $heureOctobre + 1;
				}
				if($jour <= 15){
					$heureOctobre1 = $heureOctobre1 + $heure;
					$minuteOctobre1 = $minuteOctobre1 + $minute;
					if($minuteOctobre1 >= 60){
						$minuteOctobre1 = $minuteOctobre1 - 60;
						$heureOctobre1 = $heureOctobre1 + 1;
					}
				}
				else{
					$heureOctobre2 = $heureOctobre2 + $heure;
					$minuteOctobre2 = $minuteOctobre2 + $minute;
					if($minuteOctobre2 >= 60){
						$minuteOctobre2 = $minuteOctobre2 - 60;
						$heureOctobre2 = $heureOctobre2 + 1;
					}
				}
			
				break;				
			case 11 :
				$heureNovembre = $heureNovembre + $heure;
				$minuteNovembre = $minuteNovembre + $minute;
				if($minuteNovembre >= 60){
					$minuteNovembre = $minuteNovembre - 60;
					$heureNovembre = $heureNovembre + 1;
				}
				if($jour <= 15){
					$heureNovembre1 = $heureNovembre1 + $heure;
					$minuteNovembre1 = $minuteNovembre1 + $minute;
					if($minuteNovembre1 >= 60){
						$minuteNovembre1 = $minuteNovembre1 - 60;
						$heureNovembre1 = $heureNovembre1 + 1;
					}
				}
				else{
					$heureNovembre2 = $heureNovembre2 + $heure;
					$minuteNovembre2 = $minuteNovembre2 + $minute;
					if($minuteNovembre2 >= 60){
						$minuteNovembre2 = $minuteNovembre2 - 60;
						$heureNovembre2 = $heureNovembre2 + 1;
					}
				}
			
				break;		
			case 12 :
				$heureDecembre = $heureDecembre + $heure;
				$minuteDecembre = $minuteDecembre + $minute;
				if($minuteDecembre >= 60){
					$minuteDecembre = $minuteDecembre - 60;
					$heureDecembre = $heureDecembre + 1;
				}
				if($jour <= 15){
					$heureDecembre1 = $heureDecembre1 + $heure;
					$minuteDecembre1 = $minuteDecembre1 + $minute;
					if($minuteDecembre1 >= 60){
						$minuteDecembre1 = $minuteDecembre1 - 60;
						$heureDecembre1 = $heureDecembre1 + 1;
					}
				}
				else{
					$heureDecembre2 = $heureDecembre2 + $heure;
					$minuteDecembre2 = $minuteDecembre2 + $minute;
					if($minuteDecembre2 >= 60){
						$minuteDecembre2 = $minuteDecembre2 - 60;
						$heureDecembre2 = $heureDecembre2 + 1;
					}
				}
			
				break;
		}
	}


?>

<div style="width:100%; text-align:center; margin-top:40px; margin-bottom:40px;">
  <form action="" method="get" style="display:inline">
    	<input name="annee_recherchee" type="hidden" value="<?php echo $annee_recherchee-1; ?>" />
        <input name="p" type="hidden" value="3" />
    <input name="sub" type="submit" value="<<" <?php if(isset($id)){ ?>onclick="chargeFichier(<?php echo $id; ?>, <?php echo $annee_recherchee-1; ?>);" <?php } ?>/>
   </form>
    <?php echo $annee_recherchee; ?>
   <form action="" method="get" style="display:inline">
	<input name="annee_recherchee" type="hidden" value="<?php echo $annee_recherchee+1; ?>" />
    <input name="p" type="hidden" value="3" />
    <input name="sub" type="submit" value=">>" <?php if(isset($id)){ ?>onclick="chargeFichier(<?php echo $id; ?>, <?php echo $annee_recherchee+1; ?>);" <?php } ?>/>
  </form>
</div>

<br />
<div style="width:100%; text-align:center;">
<span>Heures effectuées sur les navettes:</span>
	<center><div id="table_div" style="margin:auto"> </div></center>
</div>


<script type="text/javascript">

      google.load("visualization", "1", {packages:["table"]});
      google.setOnLoadCallback(drawTable);

	  function drawTable() {
        var data = new google.visualization.DataTable();
        data.addColumn('number', 'Mois');
		data.addColumn('string', '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total');
		data.addColumn('string', 'Première quinzaine');
		data.addColumn('string', 'Deuxième quinzaine');

        data.addRows(12);
        data.setCell(0, 0, 1, 'Janvier');
		data.setCell(0, 1, '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $heureJanvier."h ".$minuteJanvier."min ";    ?>');
		data.setCell(0, 2, '<?php echo $heureJanvier1."h ".$minuteJanvier1."min ";    ?>');
		data.setCell(0, 3, '<?php echo $heureJanvier2."h ".$minuteJanvier2."min ";    ?>');

		data.setCell(1, 0, 2, 'Fevrier');
		data.setCell(1, 1, '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $heureFevrier."h ".$minuteFevrier."min ";    ?>');
		data.setCell(1, 2, '<?php echo $heureFevrier1."h ".$minuteFevrier1."min ";    ?>');
		data.setCell(1, 3, '<?php echo $heureFevrier2."h ".$minuteFevrier2."min ";    ?>');

		data.setCell(2, 0, 3, 'Mars');
		data.setCell(2, 1, '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $heureMars."h ".$minuteMars."min ";    ?>');
		data.setCell(2, 2, '<?php echo $heureMars1."h ".$minuteMars1."min ";    ?>');
		data.setCell(2, 3, '<?php echo $heureMars2."h ".$minuteMars2."min ";    ?>');

		data.setCell(3, 0, 4, 'Avril');
		data.setCell(3, 1, '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $heureAvril."h ".$minuteAvril."min ";    ?>');
		data.setCell(3, 2, '<?php echo $heureAvril1."h ".$minuteAvril1."min ";    ?>');
		data.setCell(3, 3, '<?php echo $heureAvril2."h ".$minuteAvril2."min ";    ?>');

		data.setCell(4, 0, 5, 'Mai');
		data.setCell(4, 1, '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $heureMai."h ".$minuteMai."min ";    ?>');
		data.setCell(4, 2, '<?php echo $heureMai1."h ".$minuteMai1."min ";    ?>');
		data.setCell(4, 3, '<?php echo $heureMai2."h ".$minuteMai2."min ";    ?>');

		data.setCell(5, 0, 6, 'Juin');
		data.setCell(5, 1, '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $heureJuin."h ".$minuteJuin."min ";    ?>');
		data.setCell(5, 2, '<?php echo $heureJuin1."h ".$minuteJuin1."min ";    ?>');
		data.setCell(5, 3, '<?php echo $heureJuin2."h ".$minuteJuin2."min ";    ?>');

		data.setCell(6, 0, 7, 'Juillet');
		data.setCell(6, 1, '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $heureJuillet."h ".$minuteJuillet."min ";    ?>');
		data.setCell(6, 2, '<?php echo $heureJuillet1."h ".$minuteJuillet1."min ";    ?>');
		data.setCell(6, 3, '<?php echo $heureJuillet2."h ".$minuteJuillet2."min ";    ?>');

		data.setCell(7, 0, 8, 'Aout');
		data.setCell(7, 1, '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $heureAout."h ".$minuteAout."min ";    ?>');
		data.setCell(7, 2, '<?php echo $heureAout1."h ".$minuteAout1."min ";    ?>');
		data.setCell(7, 3, '<?php echo $heureAout2."h ".$minuteAout2."min ";    ?>');

		data.setCell(8, 0, 9, 'Septembre');
		data.setCell(8, 1, '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $heureSeptembre."h ".$minuteSeptembre."min ";    ?>');
		data.setCell(8, 2, '<?php echo $heureSeptembre1."h ".$minuteSeptembre1."min ";    ?>');
		data.setCell(8, 3, '<?php echo $heureSeptembre2."h ".$minuteSeptembre2."min ";    ?>');

		data.setCell(9, 0, 10, 'Octobre');
		data.setCell(9, 1, '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $heureOctobre."h ".$minuteOctobre."min ";    ?>');
		data.setCell(9, 2, '<?php echo $heureOctobre1."h ".$minuteOctobre1."min ";    ?>');
		data.setCell(9, 3, '<?php echo $heureOctobre2."h ".$minuteOctobre2."min ";    ?>');

		data.setCell(10, 0, 11, 'Novembre');
		data.setCell(10, 1, '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $heureNovembre."h ".$minuteNovembre."min ";    ?>');
		data.setCell(10, 2, '<?php echo $heureNovembre1."h ".$minuteNovembre1."min ";    ?>');
		data.setCell(10, 3, '<?php echo $heureNovembre2."h ".$minuteNovembre2."min ";    ?>');

		data.setCell(11, 0, 12, 'Decembre');
		data.setCell(11, 1, '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $heureDecembre."h ".$minuteDecembre."min ";    ?>');
		data.setCell(11, 2, '<?php echo $heureDecembre1."h ".$minuteDecembre1."min ";    ?>');
		data.setCell(11, 3, '<?php echo $heureDecembre2."h ".$minuteDecembre2."min ";    ?>');


       var table = new google.visualization.Table(document.getElementById('table_div'));
       table.draw(data, {allowHtml: true, showRowNumber: true});

      }
	  drawTable();

</script>











<?php
    //////////////////////////////////////////////////////////////////////////////////////////////////
    $req_heure_chauff = "SELECT DATE_FORMAT(r.date, '%m')as mois,
				DATE_FORMAT(r.date, '%d') as jour,
				DATE_FORMAT(r.heureD_str, '%H') as heureDep,
				DATE_FORMAT(r.heureD_str, '%i') as minutesDep,
				DATE_FORMAT(r.heureA_str, '%H') as heureA,
				DATE_FORMAT(r.heureA_str, '%i') as minutesA
				FROM
				aeroport_recap_trajet r
					WHERE DATE_FORMAT(r.date, '%Y') = '".$annee_recherchee."'
					AND r.id_conducteur = '".$id."'
                    AND  r.id_activite != 'NULL'
					";
                    
	$res_heure_chauff = mysql_query($req_heure_chauff)or die(mysql_error());

    //on sauvegarde les heures du premier tableau pour le réutiliser dans le dernier
    $tab_heures = array();
    $tab_heures['janvier']['total'] = array($heureJanvier,$minuteJanvier);
    $tab_heures['janvier']['premiere'] = array($heureJanvier1,$minuteJanvier1);
    $tab_heures['janvier']['deuxieme'] = array($heureJanvier2,$minuteJanvier2);

    $tab_heures['fevrier']['total'] = array($heureFevrier,$minuteFevrier);
    $tab_heures['fevrier']['premiere'] = array($heureFevrier1,$minuteFevrier1);
    $tab_heures['fevrier']['deuxieme'] = array($heureFevrier2,$minuteFevrier2);

    $tab_heures['mars']['total'] = array($heureMars,$minuteMars);
    $tab_heures['mars']['premiere'] = array($heureMars1,$minuteMars1);
    $tab_heures['mars']['deuxieme'] = array($heureMars2,$minuteMars2);

    $tab_heures['avril']['total'] = array($heureAvril,$minuteAvril);
    $tab_heures['avril']['premiere'] = array($heureAvril1,$minuteAvril1);
    $tab_heures['avril']['deuxieme'] = array($heureAvril2,$minuteAvril2);

    $tab_heures['mai']['total'] = array($heureMai,$minuteMai);
    $tab_heures['mai']['premiere'] = array($heureMai1,$minuteMai1);
    $tab_heures['mai']['deuxieme'] = array($heureMai2,$minuteMai2);

    $tab_heures['juin']['total'] = array($heureJuin,$minuteJuin);
    $tab_heures['juin']['premiere'] = array($heureJuin1,$minuteJuin1);
    $tab_heures['juin']['deuxieme'] = array($heureJuin2,$minuteJuin2);

    $tab_heures['juillet']['total'] = array($heureJuillet,$minuteJuillet);
    $tab_heures['juillet']['premiere'] = array($heureJuillet1,$minuteJuillet1);
    $tab_heures['juillet']['deuxieme'] = array($heureJuillet2,$minuteJuillet2);

    $tab_heures['aout']['total'] = array($heureAout,$minuteAout);
    $tab_heures['aout']['premiere'] = array($heureAout1,$minuteAout1);
    $tab_heures['aout']['deuxieme'] = array($heureAout2,$minuteAout2);

    $tab_heures['septembre']['total'] = array($heureSeptembre,$minuteSeptembre);
    $tab_heures['septembre']['premiere'] = array($heureSeptembre1,$minuteSeptembre1);
    $tab_heures['septembre']['deuxieme'] = array($heureSeptembre2,$minuteSeptembre2);

    $tab_heures['octobre']['total'] = array($heureOctobre,$minuteOctobre);
    $tab_heures['octobre']['premiere'] = array($heureOctobre1,$minuteOctobre1);
    $tab_heures['octobre']['deuxieme'] = array($heureOctobre2,$minuteOctobre2);

    $tab_heures['novembre']['total'] = array($heureNovembre,$minuteNovembre);
    $tab_heures['novembre']['premiere'] = array($heureNovembre1,$minuteNovembre1);
    $tab_heures['novembre']['deuxieme'] = array($heureNovembre2,$minuteNovembre2);

    $tab_heures['decembre']['total'] = array($heureDecembre,$minuteDecembre);
    $tab_heures['decembre']['premiere'] = array($heureDecembre1,$minuteDecembre1);
    $tab_heures['decembre']['deuxieme'] = array($heureDecembre2,$minuteDecembre2);





	$heureJanvier = 0;
	$heureFevrier = 0;
	$heureMars = 0;
	$heureAvril = 0;
	$heureMai = 0;
	$heureJuin = 0;
	$heureJuillet = 0;
	$heureAout = 0;
	$heureSeptembre = 0;
	$heureOctobre = 0;
	$heureNovembre = 0;
	$heureDecembre = 0;
	// première quinzaine de chaque mois
	$heureJanvier1 = 0;
	$heureFevrier1 = 0;
	$heureMars1 = 0;
	$heureAvril1 = 0;
	$heureMai1 = 0;
	$heureJuin1 = 0;
	$heureJuillet1 = 0;
	$heureAout1 = 0;
	$heureSeptembre1 = 0;
	$heureOctobre1 = 0;
	$heureNovembre1 = 0;
	$heureDecembre1 = 0;
	//deuxième quinzaine de chaque mois
	$heureJanvier2 = 0;
	$heureFevrier2 = 0;
	$heureMars2 = 0;
	$heureAvril2 = 0;
	$heureMai2 = 0;
	$heureJuin2 = 0;
	$heureJuillet2 = 0;
	$heureAout2 = 0;
	$heureSeptembre2 = 0;
	$heureOctobre2 = 0;
	$heureNovembre2 = 0;
	$heureDecembre2 = 0;

	$minuteJanvier = 0;
	$minuteFevrier = 0;
	$minuteMars = 0;
	$minuteAvril = 0;
	$minuteMai = 0;
	$minuteJuin = 0;
	$minuteJuillet = 0;
	$minuteAout = 0;
	$minuteSeptembre = 0;
	$minuteOctobre = 0;
	$minuteNovembre = 0;
	$minuteDecembre = 0;
	// première quinzaine de chaque mois
	$minuteJanvier1 = 0;
	$minuteFevrier1 = 0;
	$minuteMars1 = 0;
	$minuteAvril1 = 0;
	$minuteMai1 = 0;
	$minuteJuin1 = 0;
	$minuteJuillet1 = 0;
	$minuteAout1 = 0;
	$minuteSeptembre1 = 0;
	$minuteOctobre1 = 0;
	$minuteNovembre1 = 0;
	$minuteDecembre1 = 0;
	//deuxième quinzaine de chaque mois
	$minuteJanvier2 = 0;
	$minuteFevrier2 = 0;
	$minuteMars2 = 0;
	$minuteAvril2 = 0;
	$minuteMai2 = 0;
	$minuteJuin2 = 0;
	$minuteJuillet2 = 0;
	$minuteAout2 = 0;
	$minuteSeptembre2 = 0;
	$minuteOctobre2 = 0;
	$minuteNovembre2 = 0;
	$minuteDecembre2 = 0;


	while ($r = @mysql_fetch_assoc($res_heure_chauff)){
		
		$mois = $r["mois"];
		$jour = $r["jour"];
		$heureDep = $r["heureDep"];
		$minuteDep = $r["minutesDep"];
		$heureA = $r["heureA"];
		$minuteA = $r["minutesA"];


		// calcul du temps passé
		$heure = $heureA - $heureDep;
		if($heure <0){
			$heure = $heure +24;
		}
		$minute = $minuteA - $minuteDep;
		if($minute <0){
			$minute = $minute + 60;
			$heure = $heure -1;
		}
		//switch selon le mois
		switch ($mois){
			case 01 :
				$heureJanvier = $heureJanvier + $heure;
				$minuteJanvier = $minuteJanvier + $minute;
				if($minuteJanvier >= 60){
					$minuteJanvier = $minuteJanvier - 60;
					$heureJanvier = $heureJanvier + 1;
				}
				if($jour <= 15){
					$heureJanvier1 = $heureJanvier1 + $heure;
					$minuteJanvier1 = $minuteJanvier1 + $minute;
					if($minuteJanvier1 >= 60){
						$minuteJanvier1 = $minuteJanvier1 - 60;
						$heureJanvier1 = $heureJanvier1 + 1;
					}
				}
				else{
					$heureJanvier2 = $heureJanvier2 + $heure;
					$minuteJanvier2 = $minuteJanvier2 + $minute;
					if($minuteJanvier2 >= 60){
						$minuteJanvier2 = $minuteJanvier2 - 60;
						$heureJanvier2 = $heureJanvier2 + 1;
					}
				}
				break;
			case 02 :
				$heureFevrier = $heureFevrier + $heure;
				$minuteFevrier = $minuteFevrier + $minute;
				if($minuteFevrier >= 60){
					$minuteFevrier = $minuteFevrier - 60;
					$heureFevrier = $heureFevrier + 1;
				}
				if($jour <= 15){
					$heureFevrier1 = $heureFevrier1 + $heure;
					$minuteFevrier1 = $minuteFevrier1 + $minute;
					if($minuteFevrier1 >= 60){
						$minuteFevrier1 = $minuteFevrier1 - 60;
						$heureFevrier1 = $heureFevrier1 + 1;
					}
				}
				else{
					$heureFevrier2 = $heureFevrier2 + $heure;
					$minuteFevrier2 = $minuteFevrier2 + $minute;
					if($minuteFevrier2 >= 60){
						$minuteFevrier2 = $minuteFevrier2 - 60;
						$heureFevrier2 = $heureFevrier2 + 1;
					}
				}

				break;
			case 03 :
				$heureMars = $heureMars + $heure;
				$minuteMars = $minuteMars + $minute;
				if($minuteMars >= 60){
					$minuteMars = $minuteMars - 60;
					$heureMars = $heureMars + 1;
				}
				if($jour <= 15){
					$heureMars1 = $heureMars1 + $heure;
					$minuteMars1 = $minuteMars1 + $minute;
					if($minuteMars1 >= 60){
						$minuteMars1 = $minuteMars1 - 60;
						$heureMars1 = $heureMars1 + 1;
					}
				}
				else{
					$heureMars2 = $heureMars2 + $heure;
					$minuteMars2 = $minuteMars2 + $minute;
					if($minuteMars2 >= 60){
						$minuteMars2 = $minuteMars2 - 60;
						$heureMars2 = $heureMars2 + 1;
					}
				}

				break;
			case 04 :
				$heureAvril = $heureAvril + $heure;
				$minuteAvril = $minuteAvril + $minute;
				if($minuteAvril >= 60){
					$minuteAvril = $minuteAvril - 60;
					$heureAvril = $heureAvril + 1;
				}
				if($jour <= 15){
					$heureAvril1 = $heureAvril1 + $heure;
					$minuteAvril1 = $minuteAvril1 + $minute;
					if($minuteAvril1 >= 60){
						$minuteAvril1 = $minuteAvril1 - 60;
						$heureAvril1 = $heureAvril1 + 1;
					}
				}
				else{
					$heureAvril2 = $heureAvril2 + $heure;
					$minuteAvril2 = $minuteAvril2 + $minute;
					if($minuteAvril2 >= 60){
						$minuteAvril2 = $minuteAvril2 - 60;
						$heureAvril2 = $heureAvril2 + 1;
					}
				}

				break;
			case 05 :
				$heureMai = $heureMai + $heure;
				$minuteMai = $minuteMai + $minute;
				if($minuteMai >= 60){
					$minuteMai = $minuteMai - 60;
					$heureMai = $heureMai + 1;
				}
				if($jour <= 15){
					$heureMai1 = $heureMai1 + $heure;
					$minuteMai1 = $minuteMai1 + $minute;
					if($minuteMai1 >= 60){
						$minuteMai1 = $minuteMai1 - 60;
						$heureMai1 = $heureMai1 + 1;
					}
				}
				else{
					$heureMai2 = $heureMai2 + $heure;
					$minuteMai2 = $minuteMai2 + $minute;
					if($minuteMai2 >= 60){
						$minuteMai2 = $minuteMai2 - 60;
						$heureMai2 = $heureMai2 + 1;
					}
				}
				break;
			case 06 :
				$heureJuin = $heureJuin + $heure;
				$minuteJuin = $minuteJuin + $minute;
				if($minuteJuin >= 60){
					$minuteJuin = $minuteJuin - 60;
					$heureJuin = $heureJuin + 1;
				}
				if($jour <= 15){
					$heureJuin1 = $heureJuin1 + $heure;
					$minuteJuin1 = $minuteJuin1 + $minute;
					if($minuteJuin1 >= 60){
						$minuteJuin1 = $minuteJuin1 - 60;
						$heureJuin1 = $heureJuin1 + 1;
					}
				}
				else{
					$heureJuin2 = $heureJuin2 + $heure;
					$minuteJuin2 = $minuteJuin2 + $minute;
					if($minuteJuin2 >= 60){
						$minuteJuin2 = $minuteJuin2 - 60;
						$heureJuin2 = $heureJuin2 + 1;
					}
				}

				break;
			case 07 :
				$heureJuillet = $heureJuillet + $heure;
				$minuteJuillet = $minuteJuillet + $minute;
				if($minuteJuillet >= 60){
					$minuteJuillet = $minuteJuillet - 60;
					$heureJuillet = $heureJuillet + 1;
				}
				if($jour <= 15){
					$heureJuillet1 = $heureJuillet1 + $heure;
					$minuteJuillet1 = $minuteJuillet1 + $minute;
					if($minuteJuillet1 >= 60){
						$minuteJuillet1 = $minuteJuillet1 - 60;
						$heureJuillet1 = $heureJuillet1 + 1;
					}
				}
				else{
					$heureJuillet2 = $heureJuillet2 + $heure;
					$minuteJuillet2 = $minuteJuillet2 + $minute;
					if($minuteJuillet2 >= 60){
						$minuteJuillet2 = $minuteJuillet2 - 60;
						$heureJuillet2 = $heureJuillet2 + 1;
					}
				}

				break;

			case 08 :
				$heureAout = $heureAout + $heure;
				$minuteAout = $minuteAout + $minute;
				if($minuteAout >= 60){
					$minuteAout = $minuteAout - 60;
					$heureAout = $heureAout + 1;
				}
				if($jour <= 15){
					$heureAout1 = $heureAout1 + $heure;
					$minuteAout1 = $minuteAout1 + $minute;
					if($minuteAout1 >= 60){
						$minuteAout1 = $minuteAout1 - 60;
						$heureAout1 = $heureAout1 + 1;
					}
				}
				else{
					$heureAout2 = $heureAout2 + $heure;
					$minuteAout2 = $minuteAout2 + $minute;
					if($minuteAout2 >= 60){
						$minuteAout2 = $minuteAout2 - 60;
						$heureAout2 = $heureAout2 + 1;
					}
				}

				break;
			case 09 :
				$heureSeptembre = $heureSeptembre + $heure;
				$minuteSeptembre = $minuteSeptembre + $minute;
				if($minuteSeptembre >= 60){
					$minuteSeptembre = $minuteSeptembre - 60;
					$heureSeptembre = $heureSeptembre + 1;
				}
				if($jour <= 15){
					$heureSeptembre1 = $heureSeptembre1 + $heure;
					$minuteSeptembre1 = $minuteSeptembre1 + $minute;
					if($minuteSeptembre1 >= 60){
						$minuteSeptembre1 = $minuteSeptembre1 - 60;
						$heureSeptembre1 = $heureSeptembre1 + 1;
					}
				}
				else{
					$heureSeptembre2 = $heureSeptembre2 + $heure;
					$minuteSeptembre2 = $minuteSeptembre2 + $minute;
					if($minuteSeptembre2 >= 60){
						$minuteSeptembre2 = $minuteSeptembre2 - 60;
						$heureSeptembre2 = $heureSeptembre2 + 1;
					}
				}

				break;
			case 10 :
				$heureOctobre = $heureOctobre + $heure;
				$minuteOctobre = $minuteOctobre + $minute;
				if($minuteOctobre >= 60){
					$minuteOctobre = $minuteOctobre - 60;
					$heureOctobre = $heureOctobre + 1;
				}
				if($jour <= 15){
					$heureOctobre1 = $heureOctobre1 + $heure;
					$minuteOctobre1 = $minuteOctobre1 + $minute;
					if($minuteOctobre1 >= 60){
						$minuteOctobre1 = $minuteOctobre1 - 60;
						$heureOctobre1 = $heureOctobre1 + 1;
					}
				}
				else{
					$heureOctobre2 = $heureOctobre2 + $heure;
					$minuteOctobre2 = $minuteOctobre2 + $minute;
					if($minuteOctobre2 >= 60){
						$minuteOctobre2 = $minuteOctobre2 - 60;
						$heureOctobre2 = $heureOctobre2 + 1;
					}
				}

				break;
			case 11 :
				$heureNovembre = $heureNovembre + $heure;
				$minuteNovembre = $minuteNovembre + $minute;
				if($minuteNovembre >= 60){
					$minuteNovembre = $minuteNovembre - 60;
					$heureNovembre = $heureNovembre + 1;
				}
				if($jour <= 15){
					$heureNovembre1 = $heureNovembre1 + $heure;
					$minuteNovembre1 = $minuteNovembre1 + $minute;
					if($minuteNovembre1 >= 60){
						$minuteNovembre1 = $minuteNovembre1 - 60;
						$heureNovembre1 = $heureNovembre1 + 1;
					}
				}
				else{
					$heureNovembre2 = $heureNovembre2 + $heure;
					$minuteNovembre2 = $minuteNovembre2 + $minute;
					if($minuteNovembre2 >= 60){
						$minuteNovembre2 = $minuteNovembre2 - 60;
						$heureNovembre2 = $heureNovembre2 + 1;
					}
				}

				break;
			case 12 :
				$heureDecembre = $heureDecembre + $heure;
				$minuteDecembre = $minuteDecembre + $minute;
				if($minuteDecembre >= 60){
					$minuteDecembre = $minuteDecembre - 60;
					$heureDecembre = $heureDecembre + 1;
				}
				if($jour <= 15){
					$heureDecembre1 = $heureDecembre1 + $heure;
					$minuteDecembre1 = $minuteDecembre1 + $minute;
					if($minuteDecembre1 >= 60){
						$minuteDecembre1 = $minuteDecembre1 - 60;
						$heureDecembre1 = $heureDecembre1 + 1;
					}
				}
				else{
					$heureDecembre2 = $heureDecembre2 + $heure;
					$minuteDecembre2 = $minuteDecembre2 + $minute;
					if($minuteDecembre2 >= 60){
						$minuteDecembre2 = $minuteDecembre2 - 60;
						$heureDecembre2 = $heureDecembre2 + 1;
					}
				}

				break;
		}
	}
		





?>


<br/>
<br/>
<div style="width:100%; text-align:center; margin-top:40px; margin-bottom:40px;">
  <form action="" method="get" style="display:inline">
    	<input name="annee_recherchee" type="hidden" value="<?php echo $annee_recherchee-1; ?>" />
        <input name="p" type="hidden" value="3" />
    <input name="sub" type="submit" value="<<" <?php if(isset($id)){ ?>onclick="chargeFichier(<?php echo $id; ?>, <?php echo $annee_recherchee-1; ?>);" <?php } ?>/>
   </form>
    <?php echo $annee_recherchee; ?>
   <form action="" method="get" style="display:inline">
	<input name="annee_recherchee" type="hidden" value="<?php echo $annee_recherchee+1; ?>" />
    <input name="p" type="hidden" value="3" />
    <input name="sub" type="submit" value=">>" <?php if(isset($id)){ ?>onclick="chargeFichier(<?php echo $id; ?>, <?php echo $annee_recherchee+1; ?>);" <?php } ?>/>
  </form>
</div>
    
<br />

<div style="width: 100%; text-align: center;">
<span>Heures effectuées sur d'autres activitées:</span>
<center>
<div id="table_div2" style="margin: auto;">
</div>
</center>
</div>

<script type="text/javascript">
		function toto() { }
		toto();
      google.load("visualization", "1", {packages:["table"]});
      google.setOnLoadCallback(drawTable2);
	  
	  function drawTable2() {

        var data = new google.visualization.DataTable();
        data.addColumn('number', 'Mois');
		data.addColumn('string', '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total');
		data.addColumn('string', 'Première quinzaine');
		data.addColumn('string', 'Deuxième quinzaine');
       
        data.addRows(12);
        data.setCell(0, 0, 1, 'Janvier');
		data.setCell(0, 1, '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $heureJanvier."h ".$minuteJanvier."min ";    ?>');
		data.setCell(0, 2, '<?php echo $heureJanvier1."h ".$minuteJanvier1."min ";    ?>');
		data.setCell(0, 3, '<?php echo $heureJanvier2."h ".$minuteJanvier2."min ";    ?>');
		
		data.setCell(1, 0, 2, 'Fevrier');
		data.setCell(1, 1, '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $heureFevrier."h ".$minuteFevrier."min ";    ?>');
		data.setCell(1, 2, '<?php echo $heureFevrier1."h ".$minuteFevrier1."min ";    ?>');
		data.setCell(1, 3, '<?php echo $heureFevrier2."h ".$minuteFevrier2."min ";    ?>');
		
		data.setCell(2, 0, 3, 'Mars');
		data.setCell(2, 1, '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $heureMars."h ".$minuteMars."min ";    ?>');
		data.setCell(2, 2, '<?php echo $heureMars1."h ".$minuteMars1."min ";    ?>');
		data.setCell(2, 3, '<?php echo $heureMars2."h ".$minuteMars2."min ";    ?>');
		
		data.setCell(3, 0, 4, 'Avril');
		data.setCell(3, 1, '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $heureAvril."h ".$minuteAvril."min ";    ?>');
		data.setCell(3, 2, '<?php echo $heureAvril1."h ".$minuteAvril1."min ";    ?>');
		data.setCell(3, 3, '<?php echo $heureAvril2."h ".$minuteAvril2."min ";    ?>');
		
		data.setCell(4, 0, 5, 'Mai');
		data.setCell(4, 1, '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $heureMai."h ".$minuteMai."min ";    ?>');
		data.setCell(4, 2, '<?php echo $heureMai1."h ".$minuteMai1."min ";    ?>');
		data.setCell(4, 3, '<?php echo $heureMai2."h ".$minuteMai2."min ";    ?>');
		
		data.setCell(5, 0, 6, 'Juin');
		data.setCell(5, 1, '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $heureJuin."h ".$minuteJuin."min ";    ?>');
		data.setCell(5, 2, '<?php echo $heureJuin1."h ".$minuteJuin1."min ";    ?>');
		data.setCell(5, 3, '<?php echo $heureJuin2."h ".$minuteJuin2."min ";    ?>');
		
		data.setCell(6, 0, 7, 'Juillet');
		data.setCell(6, 1, '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $heureJuillet."h ".$minuteJuillet."min ";    ?>');
		data.setCell(6, 2, '<?php echo $heureJuillet1."h ".$minuteJuillet1."min ";    ?>');
		data.setCell(6, 3, '<?php echo $heureJuillet2."h ".$minuteJuillet2."min ";    ?>');
        
		data.setCell(7, 0, 8, 'Aout');
		data.setCell(7, 1, '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $heureAout."h ".$minuteAout."min ";    ?>');
		data.setCell(7, 2, '<?php echo $heureAout1."h ".$minuteAout1."min ";    ?>');
		data.setCell(7, 3, '<?php echo $heureAout2."h ".$minuteAout2."min ";    ?>');
		
		data.setCell(8, 0, 9, 'Septembre');
		data.setCell(8, 1, '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $heureSeptembre."h ".$minuteSeptembre."min ";    ?>');
		data.setCell(8, 2, '<?php echo $heureSeptembre1."h ".$minuteSeptembre1."min ";    ?>');
		data.setCell(8, 3, '<?php echo $heureSeptembre2."h ".$minuteSeptembre2."min ";    ?>');
		
		data.setCell(9, 0, 10, 'Octobre');
		data.setCell(9, 1, '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $heureOctobre."h ".$minuteOctobre."min ";    ?>');
		data.setCell(9, 2, '<?php echo $heureOctobre1."h ".$minuteOctobre1."min ";    ?>');
		data.setCell(9, 3, '<?php echo $heureOctobre2."h ".$minuteOctobre2."min ";    ?>');
		
		data.setCell(10, 0, 11, 'Novembre');
		data.setCell(10, 1, '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $heureNovembre."h ".$minuteNovembre."min ";    ?>');
		data.setCell(10, 2, '<?php echo $heureNovembre1."h ".$minuteNovembre1."min ";    ?>');
		data.setCell(10, 3, '<?php echo $heureNovembre2."h ".$minuteNovembre2."min ";    ?>');
		
		data.setCell(11, 0, 12, 'Decembre');
		data.setCell(11, 1, '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $heureDecembre."h ".$minuteDecembre."min ";    ?>');
		data.setCell(11, 2, '<?php echo $heureDecembre1."h ".$minuteDecembre1."min ";    ?>');
		data.setCell(11, 3, '<?php echo $heureDecembre2."h ".$minuteDecembre2."min ";    ?>');
		

       var table1 = new google.visualization.Table(document.getElementById('table_div2'));
       table1.draw(data, {allowHtml: true, showRowNumber: true});
      }
	  drawTable2();


</script>












<?php
    //////////////////////////////////////////////////////////////////////////////////////////////////



                    //echo $req_heure_chauff;
	$res_heure_chauff = mysql_query($req_heure_chauff)or die(mysql_error());

	$heureJanvier += $tab_heures['janvier']['total']['0'];
	$heureFevrier += $tab_heures['fevrier']['total']['0'];
	$heureMars += $tab_heures['mars']['total']['0'];
	$heureAvril += $tab_heures['avril']['total']['0'];
	$heureMai += $tab_heures['mai']['total']['0'];
	$heureJuin += $tab_heures['juin']['total']['0'];
	$heureJuillet += $tab_heures['juillet']['total']['0'];
	$heureAout += $tab_heures['aout']['total']['0'];
	$heureSeptembre += $tab_heures['septembre']['total']['0'];
	$heureOctobre += $tab_heures['octobre']['total']['0'];
	$heureNovembre += $tab_heures['novembre']['total']['0'];
	$heureDecembre += $tab_heures['decembre']['total']['0'];
	// première quinzaine de chaque mois
	$heureJanvier1 += $tab_heures['janvier']['premiere']['0'];
	$heureFevrier1 += $tab_heures['fevrier']['premiere']['0'];
	$heureMars1 += $tab_heures['mars']['premiere']['0'];
	$heureAvril1 += $tab_heures['avril']['premiere']['0'];
	$heureMai1 += $tab_heures['mai']['premiere']['0'];
	$heureJuin1 += $tab_heures['juin']['premiere']['0'];
	$heureJuillet1 += $tab_heures['juillet']['premiere']['0'];
	$heureAout1 += $tab_heures['aout']['premiere']['0'];
	$heureSeptembre1 += $tab_heures['septembre']['premiere']['0'];
	$heureOctobre1 += $tab_heures['octobre']['premiere']['0'];
	$heureNovembre1 += $tab_heures['novembre']['premiere']['0'];
	$heureDecembre1 += $tab_heures['decembre']['premiere']['0'];
	//deuxième quinzaine de chaque mois
	$heureJanvier2 += $tab_heures['janvier']['deuxieme']['0'];
	$heureFevrier2 += $tab_heures['fevrier']['deuxieme']['0'];
	$heureMars2 += $tab_heures['mars']['deuxieme']['0'];
	$heureAvril2 += $tab_heures['avril']['deuxieme']['0'];
	$heureMai2 += $tab_heures['mai']['deuxieme']['0'];
	$heureJuin2 += $tab_heures['juin']['deuxieme']['0'];
	$heureJuillet2 += $tab_heures['juillet']['deuxieme']['0'];
	$heureAout2 += $tab_heures['aout']['deuxieme']['0'];
	$heureSeptembre2 += $tab_heures['septembre']['deuxieme']['0'];
	$heureOctobre2 += $tab_heures['octobre']['deuxieme']['0'];
	$heureNovembre2 += $tab_heures['novembre']['deuxieme']['0'];
	$heureDecembre2 += $tab_heures['decembre']['deuxieme']['0'];

	$minuteJanvier += $tab_heures['janvier']['total']['1'];
	$minuteFevrier += $tab_heures['fevrier']['total']['1'];
	$minuteMars += $tab_heures['mars']['total']['1'];
	$minuteAvril += $tab_heures['avril']['total']['1'];
	$minuteMai += $tab_heures['mai']['total']['1'];
	$minuteJuin += $tab_heures['juin']['total']['1'];
	$minuteJuillet += $tab_heures['juillet']['total']['1'];
	$minuteAout += $tab_heures['aout']['total']['1'];
	$minuteSeptembre += $tab_heures['septembre']['total']['1'];
	$minuteOctobre += $tab_heures['octobre']['total']['1'];
	$minuteNovembre += $tab_heures['novembre']['total']['1'];
	$minuteDecembre += $tab_heures['decembre']['total']['1'];
	// première quinzaine de chaque mois
	$minuteJanvier1 += $tab_heures['janvier']['premiere']['1'];
	$minuteFevrier1 += $tab_heures['fevrier']['premiere']['1'];
	$minuteMars1 += $tab_heures['mars']['premiere']['1'];
	$minuteAvril1 += $tab_heures['avril']['premiere']['1'];
	$minuteMai1 += $tab_heures['mai']['premiere']['1'];
	$minuteJuin1 += $tab_heures['juin']['premiere']['1'];
	$minuteJuillet1 += $tab_heures['juillet']['premiere']['1'];
	$minuteAout1 += $tab_heures['aout']['premiere']['1'];
	$minuteSeptembre1 += $tab_heures['septembre']['premiere']['1'];
	$minuteOctobre1 += $tab_heures['octobre']['premiere']['1'];
	$minuteNovembre1 += $tab_heures['novembre']['premiere']['1'];
	$minuteDecembre1 += $tab_heures['decembre']['premiere']['1'];
	//deuxième quinzaine de chaque mois
	$minuteJanvier2 += $tab_heures['janvier']['deuxieme']['1'];
	$minuteFevrier2 += $tab_heures['fevrier']['deuxieme']['1'];
	$minuteMars2 += $tab_heures['mars']['deuxieme']['1'];
	$minuteAvril2 += $tab_heures['avril']['deuxieme']['1'];
	$minuteMai2 += $tab_heures['mai']['deuxieme']['1'];
	$minuteJuin2 += $tab_heures['juin']['deuxieme']['1'];
	$minuteJuillet2 += $tab_heures['juillet']['deuxieme']['1'];
	$minuteAout2 += $tab_heures['aout']['deuxieme']['1'];
	$minuteSeptembre2 += $tab_heures['septembre']['deuxieme']['1'];
	$minuteOctobre2 += $tab_heures['octobre']['deuxieme']['1'];
	$minuteNovembre2 += $tab_heures['novembre']['deuxieme']['1'];
	$minuteDecembre2 += $tab_heures['decembre']['deuxieme']['1'];




?>


<br/>
<br/>
<div style="width:100%; text-align:center; margin-top:40px; margin-bottom:40px;">
  <form action="" method="get" style="display:inline">
    	<input name="annee_recherchee" type="hidden" value="<?php echo $annee_recherchee-1; ?>" />
        <input name="p" type="hidden" value="3" />
    <input name="sub" type="submit" value="<<" <?php if(isset($id)){ ?>onclick="chargeFichier(<?php echo $id; ?>, <?php echo $annee_recherchee-1; ?>);" <?php } ?>/>
   </form>
    <?php echo $annee_recherchee; ?>
   <form action="" method="get" style="display:inline">
	<input name="annee_recherchee" type="hidden" value="<?php echo $annee_recherchee+1; ?>" />
    <input name="p" type="hidden" value="3" />
    <input name="sub" type="submit" value=">>" <?php if(isset($id)){ ?>onclick="chargeFichier(<?php echo $id; ?>, <?php echo $annee_recherchee+1; ?>);" <?php } ?>/>
  </form>
</div>

<br />

<div style="width: 100%; text-align: center;">
<span>Total:</span>
<center>
<div id="table_div3" style="margin: auto;">
</div>
</center>
</div>

<script type="text/javascript">
		function titi() { }
		titi();
      google.load("visualization", "1", {packages:["table"]});
      google.setOnLoadCallback(drawTable3);

	  function drawTable3() {

        var data = new google.visualization.DataTable();
        data.addColumn('number', 'Mois');
		data.addColumn('string', '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total');
		data.addColumn('string', 'Première quinzaine');
		data.addColumn('string', 'Deuxième quinzaine');

        data.addRows(12);
        data.setCell(0, 0, 1, 'Janvier');
		data.setCell(0, 1, '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $heureJanvier."h ".$minuteJanvier."min ";    ?>');
		data.setCell(0, 2, '<?php echo $heureJanvier1."h ".$minuteJanvier1."min ";    ?>');
		data.setCell(0, 3, '<?php echo $heureJanvier2."h ".$minuteJanvier2."min ";    ?>');

		data.setCell(1, 0, 2, 'Fevrier');
		data.setCell(1, 1, '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $heureFevrier."h ".$minuteFevrier."min ";    ?>');
		data.setCell(1, 2, '<?php echo $heureFevrier1."h ".$minuteFevrier1."min ";    ?>');
		data.setCell(1, 3, '<?php echo $heureFevrier2."h ".$minuteFevrier2."min ";    ?>');

		data.setCell(2, 0, 3, 'Mars');
		data.setCell(2, 1, '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $heureMars."h ".$minuteMars."min ";    ?>');
		data.setCell(2, 2, '<?php echo $heureMars1."h ".$minuteMars1."min ";    ?>');
		data.setCell(2, 3, '<?php echo $heureMars2."h ".$minuteMars2."min ";    ?>');

		data.setCell(3, 0, 4, 'Avril');
		data.setCell(3, 1, '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $heureAvril."h ".$minuteAvril."min ";    ?>');
		data.setCell(3, 2, '<?php echo $heureAvril1."h ".$minuteAvril1."min ";    ?>');
		data.setCell(3, 3, '<?php echo $heureAvril2."h ".$minuteAvril2."min ";    ?>');

		data.setCell(4, 0, 5, 'Mai');
		data.setCell(4, 1, '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $heureMai."h ".$minuteMai."min ";    ?>');
		data.setCell(4, 2, '<?php echo $heureMai1."h ".$minuteMai1."min ";    ?>');
		data.setCell(4, 3, '<?php echo $heureMai2."h ".$minuteMai2."min ";    ?>');

		data.setCell(5, 0, 6, 'Juin');
		data.setCell(5, 1, '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $heureJuin."h ".$minuteJuin."min ";    ?>');
		data.setCell(5, 2, '<?php echo $heureJuin1."h ".$minuteJuin1."min ";    ?>');
		data.setCell(5, 3, '<?php echo $heureJuin2."h ".$minuteJuin2."min ";    ?>');

		data.setCell(6, 0, 7, 'Juillet');
		data.setCell(6, 1, '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $heureJuillet."h ".$minuteJuillet."min ";    ?>');
		data.setCell(6, 2, '<?php echo $heureJuillet1."h ".$minuteJuillet1."min ";    ?>');
		data.setCell(6, 3, '<?php echo $heureJuillet2."h ".$minuteJuillet2."min ";    ?>');

		data.setCell(7, 0, 8, 'Aout');
		data.setCell(7, 1, '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $heureAout."h ".$minuteAout."min ";    ?>');
		data.setCell(7, 2, '<?php echo $heureAout1."h ".$minuteAout1."min ";    ?>');
		data.setCell(7, 3, '<?php echo $heureAout2."h ".$minuteAout2."min ";    ?>');

		data.setCell(8, 0, 9, 'Septembre');
		data.setCell(8, 1, '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $heureSeptembre."h ".$minuteSeptembre."min ";    ?>');
		data.setCell(8, 2, '<?php echo $heureSeptembre1."h ".$minuteSeptembre1."min ";    ?>');
		data.setCell(8, 3, '<?php echo $heureSeptembre2."h ".$minuteSeptembre2."min ";    ?>');

		data.setCell(9, 0, 10, 'Octobre');
		data.setCell(9, 1, '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $heureOctobre."h ".$minuteOctobre."min ";    ?>');
		data.setCell(9, 2, '<?php echo $heureOctobre1."h ".$minuteOctobre1."min ";    ?>');
		data.setCell(9, 3, '<?php echo $heureOctobre2."h ".$minuteOctobre2."min ";    ?>');

		data.setCell(10, 0, 11, 'Novembre');
		data.setCell(10, 1, '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $heureNovembre."h ".$minuteNovembre."min ";    ?>');
		data.setCell(10, 2, '<?php echo $heureNovembre1."h ".$minuteNovembre1."min ";    ?>');
		data.setCell(10, 3, '<?php echo $heureNovembre2."h ".$minuteNovembre2."min ";    ?>');

		data.setCell(11, 0, 12, 'Decembre');
		data.setCell(11, 1, '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $heureDecembre."h ".$minuteDecembre."min ";    ?>');
		data.setCell(11, 2, '<?php echo $heureDecembre1."h ".$minuteDecembre1."min ";    ?>');
		data.setCell(11, 3, '<?php echo $heureDecembre2."h ".$minuteDecembre2."min ";    ?>');


       var table1 = new google.visualization.Table(document.getElementById('table_div3'));
       table1.draw(data, {allowHtml: true, showRowNumber: true});
      }
	  drawTable3();


</script>

