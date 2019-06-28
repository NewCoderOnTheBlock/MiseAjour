<?php
	include("verifAuth.php");

	include("connection.php");


	if(isset($_POST['nv_trajet']) && $_POST['hdn_date'] != "")
	{
		if(strlen($_POST['heure']) < 2)
			$_POST['heure'] = '0' . $_POST['heure'];

		if(strlen($_POST['minute']) < 2)
			$_POST['minute'] = '0' . $_POST['minute'];

		$estFixe = "0";

		if($_POST['depart'] == '100')
		{
			if($_POST['dest'] == '1' || $_POST['dest'] == '2')
			{
				$fixe = mysql_query("SELECT distinct(depart) FROM aeroport_fixe WHERE depart = '" . $_POST['heure'] . ":" . $_POST['minute'] . ":00'");

				if(mysql_num_rows($fixe) == 1)
					$estFixe = "1";
			}
		}
		elseif($_POST['depart'] == '1' || $_POST['depart'] == '2')
		{
			$fixe = mysql_query("SELECT distinct(retour) FROM aeroport_fixe WHERE retour = '" . $_POST['heure'] . ":" . $_POST['minute'] . ":00' AND id_lieu = '" . $_POST['depart'] . "'");

			if(mysql_num_rows($fixe) == 1)
				$estFixe = "1";
		}


		// insertion du trajet
		$sql = "INSERT INTO aeroport_trajet VALUES('0', '3', '', '" . intval($_POST['depart']) . "', '" . intval($_POST['dest']) . "', '" . $_POST['hdn_date'] . " " . $_POST['heure'] . ":" . $_POST['minute'] . ":00', '0', '0', '" . $estFixe . "', '0', '0', '0')";

		mysql_query($sql);


		$id_trajet = mysql_insert_id();


		// insertion dans gestion_planning


		$max = mysql_query("SELECT MAX(id_com) AS max_id FROM aeroport_gestion_planning") or die(mysql_error());
		$max_id = mysql_fetch_assoc($max);
        $id_com_trouve = 0;
		$id_com = $max_id['max_id'] + 1;
		$type = "";
		$id_dest = "";
		if($_POST['depart'] == '100')
		{
			$id_dest = $_POST['dest'];
			$type = "aller";
		}
		else
		{
			$id_dest = $_POST['depart'];
			$type = "retour";
		}

		function get_duree($id)
		{
			$ret = mysql_query("SELECT duree FROM aeroport_lieu WHERE id_lieu = '" . $id . "'");

			$row = mysql_fetch_assoc($ret);

			$res = $row['duree'];

			return $res;
		}


		$type2 = "chauffeur";

		// voir si correspondance dans gestion planning

		//départ strasbourg
		if($_POST['depart'] == 100)
		{
			$tab_hr = explode(':', $_POST['heure'] . ':' . $_POST['minute'] . ':00');
			$tab_date = explode('-', $_POST['hdn_date']);


			$tps_en_seconde = mktime(intval($tab_hr[0]), intval($tab_hr[1]), 0, intval($tab_date[1]), intval($tab_date[2]), intval($tab_date[0])) + (4 * get_duree($_POST['dest']));


			$tps_en_seconde2 = mktime(intval($tab_hr[0]), intval($tab_hr[1]), 0, intval($tab_date[1]), intval($tab_date[2]), intval($tab_date[0])) + get_duree($_POST['dest']);

			$sql = "SELECT id_trajet
					FROM aeroport_trajet
					WHERE date BETWEEN '" . date('Y-m-d H:i:00', $tps_en_seconde2) . "'
					AND '" . date('Y-m-d H:i:00', $tps_en_seconde) . "'
					AND id_lieu_depart = '" . $_POST['dest'] . "'
					AND id_lieu_dest = '" . $_POST['depart'] . "'
					ORDER BY date ASC";



			$ret = mysql_query($sql) or die(mysql_error());

			while(($roww = mysql_fetch_assoc($ret)) && !$trouve)
			{
				$query_tmp = mysql_query("SELECT id_com
								   FROM aeroport_gestion_planning
								   WHERE id_com = (SELECT id_com
													FROM aeroport_gestion_planning
													WHERE id_trajet = '" . $roww['id_trajet'] . "'
													)");


				if(mysql_num_rows($query_tmp) < 2)
				{
					$sql = "SELECT DISTINCT id_" . $type2 . " AS " . $type2 . ", id_com
							FROM aeroport_gestion_planning
							WHERE id_com = (SELECT DISTINCT id_com
											FROM aeroport_gestion_planning
											WHERE id_trajet = '" . $roww['id_trajet'] . "')";

				//	echo $sql;

					$ret2 = mysql_query($sql);

					if(mysql_num_rows($ret2) == 1)
					{
						$rowww = mysql_fetch_assoc($ret2);
						$id_com = $rowww['id_com'];
                        $id_com_trouve = 1;

						break;
					}
				}
			}
		}
		else // départ aéroport
		{

			$tab_hr = explode(':', $_POST['heure'] . ':' . $_POST['minute'] . ':00');
			$tab_date = explode('-', $_POST['hdn_date']);

			$tps_en_seconde = mktime(intval($tab_hr[0]), intval($tab_hr[1]), 0, intval($tab_date[1]), intval($tab_date[2]), intval($tab_date[0])) - (3 * get_duree($_POST['depart']));

			$tps_en_seconde2 = mktime(intval($tab_hr[0]), intval($tab_hr[1]), 0, intval($tab_date[1]), intval($tab_date[2]), intval($tab_date[0]));

			$sql = "SELECT id_chauffeur, id_vehicule, id_trajet
					FROM aeroport_trajet t
					WHERE ADDTIME(t.date, (SELECT SEC_TO_TIME(l.duree)
											FROM aeroport_lieu l
											WHERE l.id_lieu = '" . $_POST['depart'] . "'
											))
					BETWEEN '" . date('Y-m-d H:i:00', $tps_en_seconde) . "' AND '" . date('Y-m-d H:i:00', $tps_en_seconde2) . "'
					AND t.id_lieu_dest = '" . $_POST['depart'] . "'
					AND t.est_paye = 1
					AND DATEDIFF(t.date, '" . date('Y-m-d', $tps_en_seconde2) . "') = 0
					ORDER BY t.date ASC";

					//echo $sql;


			$ret = mysql_query($sql);

			while(($roww = mysql_fetch_assoc($ret)) && !$trouve)
			{
				$query_tmp = mysql_query("SELECT id_com
								   FROM aeroport_gestion_planning
								   WHERE id_com = (SELECT id_com
													FROM aeroport_gestion_planning
													WHERE id_trajet = '" . $roww['id_trajet'] . "'
													)");

				if(mysql_num_rows($query_tmp) < 2)
				{
					$sql = "SELECT DISTINCT id_" . $type2 . " AS " . $type2 . ", id_com
							FROM aeroport_gestion_planning
							WHERE id_com = (SELECT DISTINCT id_com
											FROM aeroport_gestion_planning
											WHERE id_trajet = '" . $roww['id_trajet'] . "')";

					$ret2 = mysql_query($sql);

					if(mysql_num_rows($ret2) == 1)
					{
						$rowww = mysql_fetch_assoc($ret2);
						$id_com = $rowww['id_com'];
                        $id_com_trouve = 1;
						break;
					}
				}
			}
		}

		$planning = "";

		if($id_com_trouve != 0)
		{
			$ret_ret = mysql_query("SELECT id_chauffeur, id_vehicule FROM aeroport_gestion_planning WHERE id_com = '" . $id_com . "'");

			$ret_ret_ret = mysql_fetch_assoc($ret_ret);

			$planning = "INSERT INTO aeroport_gestion_planning (id_com, id_chauffeur, id_vehicule, type, id_lieu, id_trajet)
						VALUES (
								'" . $id_com . "',
								'" . $ret_ret_ret['id_chauffeur'] . "',
								'" . $ret_ret_ret['id_vehicule'] . "',
								'" . $type . "',
								'" . $id_dest . "',
								'" . $id_trajet . "'
								)";

			mysql_query("UPDATE aeroport_trajet SET id_vehicule = '" . $ret_ret_ret['id_vehicule'] . "', id_chauffeur = '" . $ret_ret_ret['id_chauffeur'] . "' WHERE id_trajet = '" . $id_trajet . "'") or die(mysql_error());
		}
		else
		{
			$planning = "INSERT INTO aeroport_gestion_planning (id_com, id_chauffeur, id_vehicule, type, id_lieu, id_trajet)
						VALUES (
								'" . $id_com . "',
								'0',
								'3',
								'" . $type . "',
								'" . $id_dest . "',
								'" . $id_trajet . "'
								)";

           
		}

		mysql_query($planning) or die(mysql_error());




		/*
		// insertion d'une ligne résa

		$sql = "INSERT INTO aeroport_ligne_resa (id_res, id_trajet, id_pt_rass, rassemblement, info_vol, nb_pers, nb_enfant, bebe, comm_bis, heure, prix, estFixe, supplement, prix_base, rajout, est_paye, type_trajet)
			VALUES (

		*/
		echo '
		<script type="text/javascript">
		<!--
			window.location = "index.php?p=1&action=1";
		//-->
		</script>
		';
		//header('Location: index.php?p=1&action=1');
	}
	else
	{
?>
	<div style="width:100%; text-align:center; margin-top:50px; margin-bottom:30px">

    	<h2>Saisie d'un trajet</h2>

        <br />

        <h3 style="color:red;">ATTENTION : A n'utiliser que pour "réunir" différents trajet en un !<br />Utiliser de préférence la saisie manuelle !</h3>

        <br />

	<form method="post" action="index.php?p=7">
    	<input type="hidden" name="nv_trajet" />
    	<?php
			$depart = mysql_query("SELECT nom, id_lieu FROM aeroport_lieu");
			$lieu = "";
			while($row = mysql_fetch_assoc($depart))
				$lieu .= '<option value="' . $row['id_lieu'] . '">' . $row['nom'] . '</option>';
		?>

    	<label for="depart">D&eacute;part : </label>
        <select name="depart" id="depart">
        	<?php echo $lieu; ?>
        </select>

        <br /><br />
        <label for="dest">Destination : </label>
        <select name="dest" id="dest">
        	<?php echo $lieu; ?>
        </select>
        <br /><br />

        <label for="date">Date du trajet : </label>
        <input type="text" id="date" disabled="disabled" />
        <input type="hidden" id="hdn_date" name="hdn_date" />

		<br />
		<br />
		
        <table class="ds_box" cellpadding="0" cellspacing="0" id="ds_conclass" style="display: none;">
			<tr><td id="ds_calclass">
			</td></tr>
        </table>



    <script src="scripts/calendar3.js" type="text/javascript"></script>
	<script type="text/javascript">
    <!--
		var ds_i_date = new Date();
		ds_c_month = ds_i_date.getMonth() + 1;
		ds_c_year = ds_i_date.getFullYear();
        ds_sh();
    //-->
    </script>

        <br />
       	<br />

        <label for="heure">Heure : </label>
        <select name="heure" id="heure">
        <?php
			for($i = 0; $i < 24; $i++)
				echo '<option value="' . $i . '">' . $i . '</option>';
		?>
        </select>

        <label for="minute">Minute : </label>
        <select name="minute" id="minute">
        <?php
			for($i = 0; $i < 60; $i+=5)
				echo '<option value="' . $i . '">' . $i . '</option>';
		?>
        </select>

        <br />
        <br />
        <input type="submit" value="Confirmer" />
    </form>

    </div>

<?php
	}
?>

