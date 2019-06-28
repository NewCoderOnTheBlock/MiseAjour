<?php

require_once('../libs/db.php');

require_once("../includes/fonctions.php");

if(isset($_POST['action']))
{
	if($_POST['action'] == 'get_horaire_fixe')
	{	
		$lst = $_POST['lst'];
		$type = $_POST['type2'];
		$date = $_POST['date'];
		$id_lieu = intval($_POST['lieu']);
		
		$type_date = get_type_horaire($date, $id_lieu);
		

		
		$ret = query("	SELECT id_fixe, DATE_FORMAT(" . $type . ", '%Hh%i') AS " . $type . " 
						FROM aeroport_fixe 
						WHERE id_lieu = '" . $id_lieu ."' 
						AND (type_horaire = 'ANNEE' OR type_horaire = '".$type_date."')
						GROUP BY " . $type);


		$res = $lst . '.options[' . $lst . '.options.length] = new Option("- - h - -", "0");';
		
		while($row = $ret->fetch())
		{
			$res .= $lst . '.options[' . $lst . '.options.length] = new Option("' . $row[$type] . '", "' . $row['id_fixe'] . '");';
		}
			
		$ret->closeCursor();
		
		echo $res;
	}
	elseif($_POST['action'] == "get_navette")
	{
		$id_dest = intval($_POST['id_dest']);
		$id_lieu = intval($_POST['id_lieu']);
		$type = $_POST['type'];
		
		require_once('includes/' . $_SESSION['lang'] . '.lang.php');
		
		

		$ret = query("SELECT DATE_FORMAT(" . $type . ", '%Hh%i') AS " . $type . " FROM aeroport_fixe WHERE id_lieu = '" . $id_lieu . "' AND id_dest = '" . $id_dest . "' AND corr_" . $type . " = 1");
		
		$res = "res_recherche.innerHTML = '<span>" . $ajax_expli . "</span><table>";
		
		while($row = $ret->fetch())
		{
			if($row[$type] != '')
				$res .= "<tr><td>" . $ajax_depart . " : " . $row[$type] . "</td></tr>";
		}
		
		$ret->closeCursor();
		
		$res .= "</table>'";
		
		echo $res;
	}
	elseif($_POST['action'] == "get_aeroport")
	{
		$id_aeroport = intval($_POST['id_lieu']);
		
		$ret = query("SELECT d.destination, f.id_dest
						FROM aeroport_fixe f, aeroport_destination d
						WHERE f.id_dest = d.id_dest
						AND f.id_lieu = '" . $id_aeroport . "'
						GROUP BY f.id_dest");
		
		$res = "";
		
		while($row = $ret->fetch())
		{
			$res .= "fixe_dest.options[fixe_dest.options.length] = new Option('" . $row['destination'] . "', '" . $row['id_dest'] . "');";
		}
		
		$ret->closeCursor();
		
		echo $res;
	}
	elseif($_POST['action'] == "get_aeroport_type")
	{
		$id_aeroport = intval($_POST['id_lieu']);
		$type = $_POST['type'];
		
		$ret = query("SELECT d.destination, f.id_dest
						FROM aeroport_fixe f, aeroport_destination d
						WHERE f.id_dest = d.id_dest
						AND f.id_lieu = '" . $id_aeroport . "'
						AND f." . $type . " = 1
						GROUP BY f.id_dest");
		
		$res = "";
		
		while($row = $ret->fetch())
		{
			$res .= "fixe_dest.options[fixe_dest.options.length] = new Option('" . $row['destination'] . "', '" . $row['id_dest'] . "');";
		}
		
		$ret->closeCursor();
		
		echo $res;
	}
    elseif($_POST['action'] == "get_navette_recherche")
    {
        require_once('includes/' . $_SESSION['lang'] . '.lang.php');

        
        $dep = intval($_POST['dep']);
        $arr = intval($_POST['arr']);
        $datee = $_POST['date'];

        $param = array(
				   ':date' => $datee,
				   ':dest' => $arr,
				   ':depart' => $dep
				   );

        $ret = query_prepare("SELECT t.id_trajet, t.id_lieu_dest, t.id_lieu_depart, DATE_FORMAT(t.date, '%d/%m/%Y %Hh%im') as date, DATE_FORMAT(t.date, '%d/%m/%Y %H:%i') as date2, SUM(l.nb_pers) AS nb_pers, SUM(l.nb_enfant) AS nb_enfant, l.est_paye, t.estValide
				FROM aeroport_trajet t
				LEFT JOIN aeroport_ligne_resa l ON l.id_res
				LEFT JOIN aeroport_reservation r ON r.id_res
				WHERE DATE_FORMAT(t.date, '%d-%m-%Y') = :date
				AND t.id_lieu_dest = :dest
				AND t.id_lieu_depart = :depart
				AND l.id_res = r.id_res
				AND t.id_trajet = l.id_trajet
				GROUP BY t.id_trajet", $param, "get_navette_recherche");


        $res = "res_recherche_top.innerHTML = '";

        if($ret->rowCount() != 0)
        {
            $res .= "<table style=\"border-collapse:collapse\"><tr><th class=\"header_col\">" . $trajet_depart  . "</th><th class=\"header_col\">" . $trajet_arrive . "</th><th class=\"header_col\">" . $date . " - " . $heure . "</th><th class=\"header_col\">" . $nombre_passager . "</th><th class=\"header_col\">" . $statut . "</th></tr>";
        }
        else
            $res .= addslashes($pas_de_navette);

        while($row = $ret->fetch())
        {
            $res .= "<tr><td class=\"cell_col\">" . get_lieu($row['id_lieu_depart']) . "</td><td class=\"cell_col\">" . get_lieu($row['id_lieu_dest']) . "</td><td class=\"cell_col\">" . $row['date'] . "</td><td class=\"cell_col\">" . ($row['nb_pers'] + $row['nb_enfant']) . "</td><td class=\"cell_col\">";

            if($row['estValide'] == 0)
            {
                if($row['est_paye'] == 1)
                    $res .= $en_attente_de_validation;
                else
                    $res .= $en_attente_de_paiement;
            }
            else
                $res .= $confirmee;

            $res .= "</td></tr>";
        }$ret->closeCursor();

        echo $res . "';";
    }elseif($_POST['action'] == "set_demande_annulee")
    {
        
        $lieu_dep = intval($_POST['lieu_dep']);
        $lieu_dest = intval($_POST['lieu_dest']);
        $nom = $_POST['nom'];
        $email = $_POST['email'];
        $etape = $_POST['etape'];
        $prix = $_POST['prix'];
        $estSimple = intval($_POST['simple']);

		$demande = "INSERT INTO aeroport_demande_annulee (nom, email, id_lieu_depart, id_lieu_dest, date, etape_arret, prix, estSimple) 
					VALUES (
						'" . $nom . "',
						'" . $email . "',
						'" . $lieu_dep . "',
						'" . $lieu_dest . "',
						'" . date("Y-m-d H:i:s") ."',
						'" . $etape . "',
						'" . $prix . "',
						'" . $estSimple . "'
						)";
				
		write($demande);
    }
	else if($_POST['action'] == 'get_horaire_fixe_accueil')
	{	
		$type = htmlspecialchars($_POST['type']);
		if ($_POST['date'] != '')
		{
			$date = $_POST['date'];
		}
		else
		{
			$date = date('d-m-Y');
		}
		$id_lieu = intval($_POST['lieu']);
		
		$type_date = get_type_horaire($date, $id_lieu);
		

		
		$ret = query("	SELECT id_fixe, DATE_FORMAT(" . $type . ", '%Hh%i') AS ".$type."
						FROM aeroport_fixe 
						WHERE id_lieu = " . $id_lieu ." 
						AND (type_horaire = 'ANNEE' OR type_horaire = '".$type_date."')
						GROUP BY " . $type);


		$res = array();
		
		while($row = $ret->fetch())
		{
			$res[] = array('id_fixe' => $row['id_fixe'],'heure' => $row[$type]);
		}
			
		$ret->closeCursor();
		
		echo json_encode($res);
	}
}
else
{
	header('Location: index.php');
	exit();
}


?>
