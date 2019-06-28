<?php
// include("verifAuth.php");
include_once("verifAuth.php");
include_once("../includes/fonctions.php");
include_once("../libs/db.php");

include('connection.php');

if(isset($_POST['action']) && $_POST['action'] == "maj")
{
    $prix_base = $_POST['nv_prix_aller'];

    $id_ligne = $_POST['id_ligne'];
    $id_trajet = $_POST['id_trajet'];
    $id_res = $_POST['id_res'];
	
	$nuit = $_POST['lst_nuit'];
	if($nuit == '1')
	{
		$PaiementNuit = 14;
	}
	else
	{
		$PaiementNuit = 0;
	}
	$depart = $_POST['datedepart'];
	$id_facture= $_POST['id_de_la_facture'];
	if($id_facture != '')
	{
	$date2 = query("SELECT * from aeroport_facture WHERE id_facture='".$id_facture."'");
	while ($donnees = $date2->fetch())
	{
		$prixtotal = $donnees['prix_total'];
		$depart2 = $donnees['date_aller'];
		if( $depart2 == $depart)
		{
			$prixbase = $donnees['prix_aller'];
			
			$reservation_minute = $donnees['res_der_min'];
			$horaire_demande = $donnees['horaire_demande_aller'];
			$maj_dom = $donnees['maj_dom_aller'];
			$demande_nuit = $donnees['nuit_aller'];
			if ($demande_nuit == '1')
			{
				$demande_nuit1 = 14;
			}
			else
			{
				$demande_nuit1 = 0;
			}
			
			$nouveauprix1 = $prixtotal - ($prixbase - $prix_base);
			if(isset ($_POST['lst_der_min']) && $_POST['lst_der_min']=='24')
			{
				if(isset ($_POST['lst_nv_fixe_aller']) && $_POST['lst_nv_fixe_aller']=='0')
				{
					$nouveauprix = $nouveauprix1 - ( $reservation_minute - 14 ) - ( $horaire_demande - 0 ) - ( $maj_dom - $_POST['nv_supplement_aller']) - ( $demande_nuit1 - $PaiementNuit);
					mysql_query("UPDATE aeroport_facture SET prix_total = '" . $nouveauprix . "', prix_aller = '" . $prix_base . "', res_der_min = '14', horaire_demande_aller = '0', maj_dom_aller = '" . $_POST['nv_supplement_aller'] . "', nuit_aller = '" . $_POST['lst_nuit'] . "' WHERE id_facture = '" . $id_facture."'");
				}
				else
				{
					$nouveauprix = $nouveauprix1 - ( $reservation_minute - 14 ) - ( $horaire_demande - 16 ) - ( $maj_dom - $_POST['nv_supplement_aller']) - ( $demande_nuit1 - $PaiementNuit);
					mysql_query("UPDATE aeroport_facture SET prix_total = '" . $nouveauprix . "', prix_aller = '" . $prix_base . "', res_der_min = '14', horaire_demande_aller = '16', maj_dom_aller = '" . $_POST['nv_supplement_aller'] . "', nuit_aller = '" . $_POST['lst_nuit'] . "' WHERE id_facture = '" . $id_facture."'");			
				}

			}
			elseif (isset ($_POST['lst_der_min']) && $_POST['lst_der_min']=='72')
			{
					if(isset ($_POST['lst_nv_fixe_aller']) && $_POST['lst_nv_fixe_aller']=='0')
				{
					$nouveauprix = $nouveauprix1 - ( $reservation_minute - 7 ) -( $horaire_demande - 0 ) -  ( $maj_dom - $_POST['nv_supplement_aller']) - ( $demande_nuit1 - $PaiementNuit);
					mysql_query("UPDATE aeroport_facture SET prix_total = '" . $nouveauprix . "', prix_aller = '" . $prix_base . "', res_der_min = '7', horaire_demande_aller = '0', maj_dom_aller = '" . $_POST['nv_supplement_aller'] . "', nuit_aller = '" . $_POST['lst_nuit'] . "' WHERE id_facture = '" . $id_facture."'");
				}
				else
				{
					$nouveauprix = $nouveauprix1 - ( $reservation_minute - 7 ) - ( $horaire_demande - 16 ) -  ( $maj_dom - $_POST['nv_supplement_aller']) - ( $demande_nuit1 - $PaiementNuit);
					mysql_query("UPDATE aeroport_facture SET prix_total = '" . $nouveauprix . "', prix_aller = '" . $prix_base . "', res_der_min = '7', horaire_demande_aller = '16', maj_dom_aller = '" . $_POST['nv_supplement_aller'] . "', nuit_aller = '" . $_POST['lst_nuit'] . "' WHERE id_facture = '" . $id_facture."'");
				}
			}
			else
			{
					if(isset ($_POST['lst_nv_fixe_aller']) && $_POST['lst_nv_fixe_aller']=='0')
				{
					$nouveauprix = $nouveauprix1 - ( $reservation_minute - 0 ) - ( $horaire_demande - 0 )  -  ( $maj_dom - $_POST['nv_supplement_aller']) - ( $demande_nuit1 - $PaiementNuit);
					mysql_query("UPDATE aeroport_facture SET prix_total = '" . $nouveauprix . "', prix_aller = '" . $prix_base . "', res_der_min = '0', horaire_demande_aller = '0', maj_dom_aller = '" . $_POST['nv_supplement_aller'] . "', nuit_aller = '" . $_POST['lst_nuit'] . "' WHERE id_facture = '" . $id_facture."'");
				}
				else
				{
					$nouveauprix = $nouveauprix1 - ( $reservation_minute - 0 ) - ( $horaire_demande - 16 )  -  ( $maj_dom - $_POST['nv_supplement_aller']) - ( $demande_nuit1 - $PaiementNuit);
					mysql_query("UPDATE aeroport_facture SET prix_total = '" . $nouveauprix . "', prix_aller = '" . $prix_base . "', res_der_min = '0', horaire_demande_aller = '16', maj_dom_aller = '" . $_POST['nv_supplement_aller'] . "', nuit_aller = '" . $_POST['lst_nuit'] . "' WHERE id_facture = '" . $id_facture."'");			
				}
			}
		}
		else
		{
			$prixbase = $donnees['prix_retour'];
			
			$reservation_minute = $donnees['res_der_min'];
			$horaire_demande = $donnees['horaire_demande_retour'];
			$maj_dom = $donnees['maj_dom_retour'];
			$demande_nuit = $donnees['nuit_retour'];
			if ($demande_nuit == '1')
			{
				$demande_nuit1 = 14;
			}
			else
			{
				$demande_nuit1 = 0;
			}
			
			$nouveauprix1 = $prixtotal - ($prixbase - $prix_base);
			if(isset ($_POST['lst_der_min']) && $_POST['lst_der_min']=='24')
			{
				if(isset ($_POST['lst_nv_fixe_aller']) && $_POST['lst_nv_fixe_aller']=='0')
				{
					$nouveauprix = $nouveauprix1 - ( $reservation_minute - 14 ) - ( $horaire_demande - 0 ) - ( $maj_dom - $_POST['nv_supplement_aller']) - ( $demande_nuit1 - $PaiementNuit);
					mysql_query("UPDATE aeroport_facture SET prix_total = '" . $nouveauprix . "', prix_retour = '" . $prix_base . "', maj_dom_retour = '" . $_POST['nv_supplement_aller'] . "', res_der_min = '7', horaire_demande_retour = '0', nuit_retour = '" . $_POST['lst_nuit'] . "' WHERE id_facture = '" . $id_facture."'");
				}
				else
				{
					$nouveauprix = $nouveauprix1 - ( $reservation_minute - 14 ) - ( $horaire_demande - 16 ) - ( $maj_dom - $_POST['nv_supplement_aller']) - ( $demande_nuit1 - $PaiementNuit);
					mysql_query("UPDATE aeroport_facture SET prix_total = '" . $nouveauprix . "', prix_retour = '" . $prix_base . "', maj_dom_retour = '" . $_POST['nv_supplement_aller'] . "', res_der_min = '7', horaire_demande_retour = '16', nuit_retour = '" . $_POST['lst_nuit'] . "' WHERE id_facture = '" . $id_facture."'");			
				}

			}
			elseif (isset ($_POST['lst_der_min']) && $_POST['lst_der_min']=='72')
			{
					if(isset ($_POST['lst_nv_fixe_aller']) && $_POST['lst_nv_fixe_aller']=='0')
				{
					$nouveauprix = $nouveauprix1 - ( $reservation_minute - 7 ) -( $horaire_demande - 0 ) -  ( $maj_dom - $_POST['nv_supplement_aller']) - ( $demande_nuit1 - $PaiementNuit);
					mysql_query("UPDATE aeroport_facture SET prix_total = '" . $nouveauprix . "', prix_retour = '" . $prix_base . "', maj_dom_retour = '" . $_POST['nv_supplement_aller'] . "', res_der_min = '14', horaire_demande_retour = '0', nuit_retour = '" . $_POST['lst_nuit'] . "' WHERE id_facture = '" . $id_facture."'");
				}
				else
				{
					$nouveauprix = $nouveauprix1 - ( $reservation_minute - 7 ) - ( $horaire_demande - 16 ) -  ( $maj_dom - $_POST['nv_supplement_aller']) - ( $demande_nuit1 - $PaiementNuit);
					mysql_query("UPDATE aeroport_facture SET prix_total = '" . $nouveauprix . "', prix_retour = '" . $prix_base . "', maj_dom_retour = '" . $_POST['nv_supplement_aller'] . "', res_der_min = '14', horaire_demande_retour = '16', nuit_retour = '" . $_POST['lst_nuit'] . "' WHERE id_facture = '" . $id_facture."'");
				}
			}
			else
			{
					if(isset ($_POST['lst_nv_fixe_aller']) && $_POST['lst_nv_fixe_aller']=='0')
				{
					$nouveauprix = $nouveauprix1 - ( $reservation_minute - 0 ) - ( $horaire_demande - 0 )  -  ( $maj_dom - $_POST['nv_supplement_aller']) - ( $demande_nuit1 - $PaiementNuit);
					mysql_query("UPDATE aeroport_facture SET prix_total = '" . $nouveauprix . "', prix_retour = '" . $prix_base . "', maj_dom_retour = '" . $_POST['nv_supplement_aller'] . "', res_der_min = '0', horaire_demande_retour = '0', nuit_retour = '" . $_POST['lst_nuit'] . "' WHERE id_facture = '" . $id_facture."'");
				}
				else
				{
					$nouveauprix = $nouveauprix1 - ( $reservation_minute - 0 ) - ( $horaire_demande - 16 )  -  ( $maj_dom - $_POST['nv_supplement_aller']) - ( $demande_nuit1 - $PaiementNuit);
					mysql_query("UPDATE aeroport_facture SET prix_total = '" . $nouveauprix . "', prix_retour = '" . $prix_base . "', maj_dom_retour = '" . $_POST['nv_supplement_aller'] . "', res_der_min = '0', horaire_demande_retour = '16', nuit_retour = '" . $_POST['lst_nuit'] . "' WHERE id_facture = '" . $id_facture."'");			
				}
			}
			
		}
	}
	}
	else {}

    mysql_query("UPDATE aeroport_ligne_resa SET prix_base = " . $prix_base . " WHERE id_ligne = " . $id_ligne);

    mysql_query("UPDATE aeroport_reservation SET res_der_min = '" . $_POST['lst_der_min'] . "' WHERE id_res = " . $id_res);
	
	// KEMPF : Option annulation
    mysql_query("UPDATE aeroport_reservation SET opt_annulation = '" . $_POST['opt_annulation'] . "' WHERE id_res = " . $id_res);
    mysql_query("UPDATE aeroport_reservation SET montant_opt_annulation = '" . $_POST['montant_opt_annulation'] . "' WHERE id_res = " . $id_res);

    mysql_query("UPDATE aeroport_ligne_resa SET supplement = " . $_POST['nv_supplement_aller'] . " WHERE id_ligne = " . $id_ligne);

    $prix = 0;
    $prix_affiche = 0;
	$val_der_min = 0;

    if($_POST['lst_der_min'] != "")
    {
        $ret = mysql_query("SELECT val_option FROM aeroport_options WHERE nom_option = 'maj_" . $_POST['lst_der_min'] . "'");
        $row = mysql_fetch_assoc($ret);

		$val_der_min = $row['val_option'];
    }

    $sql_3 = mysql_query("SELECT estFixe FROM aeroport_ligne_resa WHERE id_ligne = '" . $id_ligne . "'") or die(mysql_error());
    $row_3 = mysql_fetch_assoc($sql_3);
    
    
    $sql_4 = mysql_query("SELECT id_lieu_dest, id_lieu_depart FROM aeroport_trajet WHERE id_trajet = " . $id_trajet) or die(mysql_error());
    $row_4 = mysql_fetch_assoc($sql_4);

    //$tab_surcout = array(1, 2);

    $sql_1 = mysql_query("SELECT val_option FROM aeroport_options WHERE nom_option = 'maj_surcout_demande'") or die(mysql_error());
    $row_1 = mysql_fetch_assoc($sql_1);
    $maj_nav_demande = $row_1['val_option'];

    //if((in_array($row_4['id_lieu_dest'], $tab_surcout) || in_array($row_4['id_lieu_depart'], $tab_surcout))){
		if($_POST['lst_nv_fixe_aller'] == "1")
		{
			$prix += $maj_nav_demande;
			mysql_query("UPDATE aeroport_ligne_resa SET estFixe = 0 WHERE id_ligne = " . $id_ligne);
		}
		else
			mysql_query("UPDATE aeroport_ligne_resa SET estFixe = 1 WHERE id_ligne = " . $id_ligne);
   // }
    
	$supplement_nuit = ($_POST['lst_nuit'] == 1) ? intval($_POST['maj_horaire_nuit']) : 0;
	
    $prix += $prix_base + $_POST['nv_supplement_aller'];

	$prix += $val_der_min + $supplement_nuit;
	
	if ($_POST['opt_annulation'] == 1){
		$prix += $_POST['montant_opt_annulation'];
	}
	
	/*
		On ne fait que afficher le tarif de nuit,
		car le prix du tarif de nuit est déjà inclus dans le prix
	*/
    $prix_affiche += $prix; 

    mysql_query("UPDATE aeroport_ligne_resa SET prix = ".$prix.", est_nuit = ".$_POST['lst_nuit']." WHERE id_ligne = " . $id_ligne);

    ?>

    <script type="text/javascript">

        var prix = opener.document.getElementById("<?php echo $_POST['id_affiche']; ?>");

        prix.innerHTML = "<?php echo $prix_affiche; ?> €";

        self.close();
        
    </script>

    <?php

}
else
{
    // Majoration navette à la demande
    $sql_1 = mysql_query("	SELECT val_option 
							FROM aeroport_options 
							WHERE nom_option = 'maj_surcout_demande'") or die(mysql_error());
    $row_1 = mysql_fetch_assoc($sql_1);
	
    $maj_nav_demande = $row_1['val_option'];
	
    // Majoration navette de nuit
    $sql_1 = mysql_query("	SELECT val_option 
							FROM aeroport_options 
							WHERE nom_option = 'maj_horaire_nuit'") or die(mysql_error());
    $row_1 = mysql_fetch_assoc($sql_1);
	
    $maj_horaire_nuit = $row_1['val_option'];

	
    // type de dernière minute (24, -72) + Annulation
    $sql_2 = mysql_query("	SELECT res_der_min, opt_annulation, montant_opt_annulation
							FROM aeroport_reservation 
							WHERE id_res = " . intval($_GET['id_res'])) or die(mysql_error());
    $row_2 = mysql_fetch_assoc($sql_2);

	
    $sql_3 = mysql_query("	SELECT estFixe, supplement, prix_base, type_trajet, est_nuit, DATE_FORMAT(heure, '%H:%i' ) as heure_format
							FROM aeroport_ligne_resa 
							WHERE id_ligne = '" . intval($_GET['id_ligne']) . "'") or die(mysql_error());
    $row_3 = mysql_fetch_assoc($sql_3);

    $txt_total = $row_3['prix_base'];
    $txt_supplement = $row_3['supplement'];
		
	// KEMPF : Si il est de nuit :
	$bool_horaire_nuit = ($row_3['est_nuit'] == 1) ? true : false;

    if($row_3['type_trajet'] == 'ALLER')
    {
        if($row_2['res_der_min'] == "24")
            $type_res_der_min = "24";
        elseif($row_2['res_der_min'] == "72")
            $type_res_der_min = "72";
        else
            $type_res_der_min = "";
			
		$opt_annulation = $row_2['opt_annulation'];
		$montant_opt_annulation = $row_2['montant_opt_annulation'];
    }

    $sql_4 = mysql_query("	SELECT id_lieu_dest, id_lieu_depart 
							FROM aeroport_trajet 
							WHERE id_trajet = " . intval($_GET['id_trajet'])) or die(mysql_error());
    $row_4 = mysql_fetch_assoc($sql_4);

   // $tab_surcout = array(1, 2);


    // if(($row_3['estFixe'] == "0" && (in_array($row_4['id_lieu_dest'], $tab_surcout) || in_array($row_4['id_lieu_depart'], $tab_surcout))))
    if(($row_3['estFixe'] == "0"))
        $bool_nv_navette_demande = '1';
    else
        $bool_nv_navette_demande = '0';
}

?>


<html>
<head>
    <title>Modification du prix d'une réservation</title>
</head>

<body>
    <form method="post" action="modif_prix.php">
    
        <p>
            <label for="lst_der_min">Réservation de dernière minute : </label>
            <select name="lst_der_min" id="lst_der_min">

                <?php if($type_res_der_min == '')
                {
                ?>
                    <option value="" selected="selected">Non</option>
                    <option value="24">- 24h</option>
                    <option value="72">- 72h</option>
                <?php 
                }
                elseif($type_res_der_min == '24')
                {                
                ?>
                    <option value="">Non</option>
                    <option value="24" selected="selected">- 24h</option>
                    <option value="72">- 72h</option>
                <?php 
                }
                else
                {
                ?>
                    <option value="">Non</option>
                    <option value="24">- 24h</option>
                    <option value="72" selected="selected">- 72h</option>
                <?php
                }
                ?>

            </select>
        </p>
		
		<p>
			<label for="opt_annulation">Option d'annulation</label>
            <select name="opt_annulation" id="opt_annulation">

                <?php 
				if($opt_annulation == 1){
                ?>
                    <option value="1" selected="selected">Oui</option>
                    <option value="0">Non</option>
                <?php 
                }else{
                ?>
                    <option value="1">Oui</option>
                    <option value="0"  selected="selected">Non</option>
                <?php
                }
                ?>

            </select>
            <input type="text" name="montant_opt_annulation" id="montant_opt_annulation" value="<?php echo $montant_opt_annulation; ?>" size="4" /> €
		</p>

        <p>
            <label for="nv_prix_aller">Changer le prix du trajet : </label>
            <input type="text" name="nv_prix_aller" id="nv_prix_aller" value="<?php echo $txt_total; ?>" size="3" />
            €
        </p>

        <p>
            <label for="lst_nv_fixe_aller">Navette à la demande (+ <?php echo $maj_nav_demande; ?> €) ?</label>
            <select name="lst_nv_fixe_aller" id="lst_nv_fixe_aller">

                <?php if($bool_nv_navette_demande == '0')
                {
                ?>
                    <option value="0" selected="selected">Non</option>
                    <option value="1">Oui</option>
                <?php
                }
                else
                {
                ?>
                    <option value="0">Non</option>
                    <option value="1" selected="selected">Oui</option>
                <?php
                }
                ?>

            </select>
        </p>
		
        <p>
			<label for="lst_nuit">Navette de nuit (+ <?=$maj_horaire_nuit ?> €) ?</label>
			<select name="lst_nuit" id="lst_nuit">

                <?php if($bool_horaire_nuit == 0)
                {
                ?>
                    <option value="0" selected="selected">Non</option>
                    <option value="1">Oui</option>
                <?php
                }
                else
                {
                ?>
                    <option value="0">Non</option>
                    <option value="1" selected="selected">Oui</option>
                <?php
                }
                ?>

            </select>
        </p>

        <p>
            <label for="nv_supplement_aller">Changer le prix de la prise à domicile : </label>
            <input type="text" id="nv_supplement_aller" name="nv_supplement_aller" value="<?php echo $txt_supplement; ?>" size="3" />
            €
        </p>


        <input type="hidden" name="action" value="maj" />
        <input type="hidden" name="id_res" value="<?php echo $_GET['id_res']; ?>" />
        <input type="hidden" name="id_ligne" value="<?php echo $_GET['id_ligne']; ?>" />
        <input type="hidden" name="id_trajet" value="<?php echo $_GET['id_trajet']; ?>" />
        <input type="hidden" name="id_affiche" value="<?php echo $_GET['id_affiche']; ?>" />
        <input type="hidden" name="maj_horaire_nuit" value="<?php echo $maj_horaire_nuit; ?>" />
        <input type="hidden" name="id_de_la_facture" value="<?php echo $_GET['id_facture']; ?>" />
        <input type="hidden" name="datedepart" value="<?php echo $_GET['date_depart']; ?>" />
        <input type="submit" value="Modifier" />

    </form>

</body>


</html>