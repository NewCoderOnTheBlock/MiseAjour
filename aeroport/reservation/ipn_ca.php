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
		
		/* 
			Vérification si c'est pour RoyalPalace :
		*/
		if ($custom_r[3] == "ROYAL"){
			
			require_once('/homepages/3/d205267944/htdocs/royal-palace/includes/init_functions.php');
			$custom .= "|e-transaction";
			traitementPayement($custom);
			
		}
		/* 
			Vérification si c'est pour EuropaPark :
		*/
		elseif ($custom_r[3] == "EUROPA"){
			
			require_once('/homepages/3/d205267944/htdocs/europapark/includes/init_functions.php');
			$custom .= "|e-transaction";
			traitementPayement($custom);
			
		}
		/* 
			Vérification si c'est pour les Outlet :
		*/
		elseif ($custom_r[3] == "OUTLET"){
			
			require_once('/homepages/3/d205267944/htdocs/outlet/includes/init_functions.php');
			$custom .= "|e-transaction";
			traitementPayement($custom);
			
		}
		/* 
			Vérification si c'est pour LaissezVousConduire :
		*/
		elseif ($custom_r[3] == "LAISSEZVOUSCONDUIRE"){
			
			require_once('/homepages/3/d205267944/htdocs/laissezvousconduire/includes/init_functions.php');
			$custom .= "|e-transaction";
			traitementPayement($custom);
			
		}
		/* 
			Vérification si c'est pour Aeroport :
		*/
		else{
			$id_paypal = $custom_r[0];
			$id_demande_non_final = $custom_r[10];
			
			if($custom_r[9] == "0")
			{
				$ret_pro = query("SELECT pro FROM aeroport_paypal WHERE id_paypal = " . $id_paypal);
				$row_pro = $ret_pro->fetch();
				$ret_pro->closeCursor();
		 
				if($row_pro['pro'] == 0)
					traitement($custom, $mode_paypal, "e-transaction");
				else
					traitement($custom, $mode_paypal, "Pro");

				
				/* 
					La ligne dans aeroport_paypal est supprimée à chaque paiement. 
					De ce fait, il ne reste dans la table que les réservation n'ayant pas abouties. 
					Pourquoi utiliser cette table ? Pourquoi supprimer lorsque la réservation est effectuée ? Par soucis de place surement
				*/
				if($id_paypal != 0)
				{
					write("DELETE FROM aeroport_paypal WHERE id_paypal = '" . $id_paypal . "'");
				}
				/* KEMPF : Si la demande abouti, on supprime sa ligne dans la table des demandes non-finalisées */
				if(!empty($id_demande_non_final))
				{
					write("DELETE FROM aeroport_demande_non_finalisee WHERE id = '" . $id_demande_non_final . "'");
				}
			}
			else
			{
				traitement($custom, $mode_paypal, "");
			}
		}
    }
}
else
{
    $res = print_r($_GET, true);
}


?>