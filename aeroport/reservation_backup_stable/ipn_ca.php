<?php

//permet de traiter le retour ipn de paybox

@set_time_limit(300);

$dirname = dirname(__FILE__);

require_once($dirname . "/../../libs/config.php");
require_once($dirname . "/../../libs/db.php");
require_once($dirname . "/traitement.php");
require_once($dirname . "/../../includes/fonctions.php");


if($_GET['erreur'] == '00000')
{

    global $mode_paypal;

    $custom = str_replace("-", "|", $_GET['ref']);

    if(!empty($custom) && $custom != "" && strlen($custom) != 0)
    {
        $custom_r = explode('|', $custom);
						
		$id_paypal = $custom_r[0];
		$id_demande_non_final = $custom_r[11];
		$id_facture = $custom_r[10];
		
		if($custom_r[9] == "0")
		{
			$ret_pro = query("SELECT pro FROM aeroport_paypal WHERE id_paypal = " . $id_paypal);
			$row_pro = $ret_pro->fetch();
	 
			if($row_pro['pro'] == 0)
				traitement($custom, $mode_paypal, "e-transaction");
			else
				traitement($custom, $mode_paypal, "Pro");

			$ret_pro->closeCursor();
			
			/* 
				La ligne dans aeroport_paypal est supprimée à chaque paiement. 
				De ce fait, il ne reste dans la table que les réservation n'ayant pas abouties. 
				Pourquoi utiliser cette table ? Pourquoi supprimer lorsque la réservation est effectuée ?
			*/
            if($id_paypal != 0)
			{
                write("DELETE FROM aeroport_paypal WHERE id_paypal = '" . $id_paypal . "'");
			}
			/* KEMPF : Si la demande abouti, on supprime sa ligne dans la table des demandes non-finalisées */
			if($id_demande_non_final != 0)
			{
				write("DELETE FROM aeroport_demande_non_finalisee WHERE id = '" . $id_demande_non_final . "'");
			}
			/* On rend cette facture valide et on supprime celles qui ne le sont pas */
			write("UPDATE aeroport_facture SET valide = 1 WHERE id_facture = " . $id_facture . "");
			//write("DELETE FROM aeroport_facture WHERE valide = 0 AND id_facture < " . $id_facture . "");
		}
		else
		{
			traitement($custom, $mode_paypal, "");
        }
    }
}
else
{
    $res = print_r($_GET, true);
}


?>