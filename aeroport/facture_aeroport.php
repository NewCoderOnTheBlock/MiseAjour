<style type="text/css">
<!--
.noborder
{
    border-top:none;
	border-bottom:none;
}
-->
</style>
<?php
	// On écrit ce que contiendra le PDF
	
	header('Content-Type: text/html; charset=ISO-8859-15');
	echo '
	<page style="font-size: 18pt" backbottom ="10%">
		<page_footer>
			<table style="width:100%;">
				<tr>
					<td style="width:50%;">N° SIRET : 477674063 00037</td>
					<td style="text-align:right;width:50%;">AFI Alsace</td>
				</tr>
				<tr>
					<td>'.$lang_fact_tva.' '.$lang_fact_intracommunautaire.' : FR73 477674063</td>
					<td style="text-align:right;">alsace-navette.com</td>
				</tr>
			</table>
		</page_footer>
		<table align="center" cellspacing="0" style="width:100%; font-size: 20px;">
			<tr>
				<td style="width:50%;">
					AFI ALSACE<br />
					2 rue du Coq<br />
					67000 STRASBOURG<br />
					Tel : +33 (0)3 88 22 22 71<br />
					<a>info@alsace-navette.com</a>
				</td>
				<td style="width:50%;" style="text-align:right;"><img src="./images/LOGO.png" /></td>
			</tr>
			<tr>
				<td><h1>'.$lang_facture.' n°'.$fac_id_facture.'</h1></td>
				<td>'.$fac_civilite_c.' '.$fac_nom_c.' '.$fac_prenom_c.'</td>
			</tr>
			<tr>
				<td>Strasbourg, '.$fac_date_res.'</td>
				<td><a>'.$fac_mail_c.'</a></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
		</table>
		<table align="center" border="1" cellspacing="0" style="width:100%; font-size: 20px; border:solid black 1px;">
			<tr>
				<th style="width:20%;text-align:center;">'.$lang_fact_date.'</th>
				<th style="width:40%;text-align:center;">'.$lang_fact_objet.'</th>
				<th style="width:20%;text-align:center;">'.$lang_fact_montant.'</th>
			</tr>
			<tr>
				<td style="border-bottom:none;">&nbsp;</td>
				<td style="border-bottom:none;">&nbsp;</td>
				<td style="border-bottom:none;">&nbsp;</td>
			</tr>';
			
			// ALLER
			echo '
			<tr>
				<td class="noborder" style="text-align:center;">'.$fac_date_aller.'</td>
				<td class="noborder">'.(($fac_nb_pers_aller > 0) ? $fac_nb_pers_aller." ".$lang_fact_personnes."<br />" : "").'<i>'.$lang_fact_transfert.' '.$fac_lieu_1_aller.' -> '.$fac_lieu_2_aller.'</i></td>
				<td class="noborder" style="text-align:center;">'.$fac_prix_aller.' €</td>
			</tr>
			<tr>
				<td class="noborder">&nbsp;</td>
				<td class="noborder">&nbsp;</td>
				<td class="noborder">&nbsp;</td>
			</tr>';
			
			// Surcout horaires non-fixes
			if (!empty($fac_horaire_demande_aller)){
				echo '
				<tr>
					<td class="noborder" style="text-align:center;"></td>
					<td class="noborder">'.$lang_fact_horaire_demande.'</td>
					<td class="noborder" style="text-align:center;">'.$fac_horaire_demande_aller.' €</td>
				</tr>
				<tr>
					<td class="noborder">&nbsp;</td>
					<td class="noborder">&nbsp;</td>
					<td class="noborder">&nbsp;</td>
				</tr>';
			}
			
			// Surcout Domicile
			if (!empty($fac_maj_dom_aller)){
				echo '
				<tr>
					<td class="noborder" style="text-align:center;"></td>
					<td class="noborder">'.$lang_fact_domicile.'</td>
					<td class="noborder" style="text-align:center;">'.$fac_maj_dom_aller.' €</td>
				</tr>
				<tr>
					<td class="noborder">&nbsp;</td>
					<td class="noborder">&nbsp;</td>
					<td class="noborder">&nbsp;</td>
				</tr>';
			}
			
			if (!empty($fac_maj_nuit_aller)){
				echo '
				<tr>
					<td class="noborder" style="text-align:center;"></td>
					<td class="noborder">'.$lang_horaires_de_nuit.'</td>
					<td class="noborder" style="text-align:center;">'.$fac_maj_nuit_aller.' €</td>
				</tr>
				<tr>
					<td class="noborder">&nbsp;</td>
					<td class="noborder">&nbsp;</td>
					<td class="noborder">&nbsp;</td>
				</tr>';
			}
			
			// Remise 8 personnes
			if ($fac_nb_pers_aller == 8){
				echo '
				<tr>
					<td class="noborder" style="text-align:center;"></td>
					<td class="noborder">'.$lang_remise_8_pers.'</td>
					<td class="noborder" style="text-align:center;">- '.$fac_remise_8_pers_aller.' €</td>
				</tr>
				<tr>
					<td class="noborder">&nbsp;</td>
					<td class="noborder">&nbsp;</td>
					<td class="noborder">&nbsp;</td>
				</tr>';
			}
			
			// RETOUR : On vérifie si il y a un retour
			if (isset($fac_date_retour)){
				echo '
				<tr>
					<td class="noborder" style="text-align:center;">'.$fac_date_retour.'</td>
					<td class="noborder">'.(($fac_nb_pers_retour > 0) ? $fac_nb_pers_retour." ".$lang_fact_personnes."<br />" : "").'<i>'.$lang_fact_transfert.' '.$fac_lieu_1_retour.' -> '.$fac_lieu_2_retour.'</i></td>
					<td class="noborder" style="text-align:center;">'.$fac_prix_retour.' €</td>
				</tr>
				<tr>
					<td class="noborder">&nbsp;</td>
					<td class="noborder">&nbsp;</td>
					<td class="noborder">&nbsp;</td>
				</tr>';
				
				// Surcout horaires non-fixes
				if (!empty($fac_horaire_demande_retour)){
					echo '
					<tr>
						<td class="noborder" style="text-align:center;"></td>
						<td class="noborder">'.$lang_fact_horaire_demande.'</td>
						<td class="noborder" style="text-align:center;">'.$fac_horaire_demande_retour.' €</td>
					</tr>
					<tr>
						<td class="noborder">&nbsp;</td>
						<td class="noborder">&nbsp;</td>
						<td class="noborder">&nbsp;</td>
					</tr>';
				}
				
				// Surcout Domicile
				if (!empty($fac_maj_dom_retour)){
					echo '
					<tr>
						<td class="noborder" style="text-align:center;"></td>
						<td class="noborder">'.$lang_fact_domicile.'</td>
						<td class="noborder" style="text-align:center;">'.$fac_maj_dom_retour.' €</td>
					</tr>
					<tr>
						<td class="noborder">&nbsp;</td>
						<td class="noborder">&nbsp;</td>
						<td class="noborder">&nbsp;</td>
					</tr>';
				}
			
				if (!empty($fac_maj_nuit_retour)){
					echo '
					<tr>
						<td class="noborder" style="text-align:center;"></td>
						<td class="noborder">'.$lang_horaires_de_nuit.'</td>
						<td class="noborder" style="text-align:center;">'.$fac_maj_nuit_retour.' €</td>
					</tr>
					<tr>
						<td class="noborder">&nbsp;</td>
						<td class="noborder">&nbsp;</td>
						<td class="noborder">&nbsp;</td>
					</tr>';
				}
				
				// Remise 8 personnes
				if ($fac_nb_pers_retour == 8){
					echo '
					<tr>
						<td class="noborder" style="text-align:center;"></td>
						<td class="noborder">'.$lang_remise_8_pers.'</td>
						<td class="noborder" style="text-align:center;">- '.$fac_remise_8_pers_retour.' €</td>
					</tr>
					<tr>
						<td class="noborder">&nbsp;</td>
						<td class="noborder">&nbsp;</td>
						<td class="noborder">&nbsp;</td>
					</tr>';
				}
			}
			
			// DERNIERE MINUTE
			if (!empty($fac_res_der_min)){
				echo '
				<tr>
					<td class="noborder" style="text-align:center;"></td>
					<td class="noborder">'.$lang_fact_res_der_min.'</td>
					<td class="noborder" style="text-align:center;">'.$fac_res_der_min.' €</td>
				</tr>
				<tr>
					<td class="noborder">&nbsp;</td>
					<td class="noborder">&nbsp;</td>
					<td class="noborder">&nbsp;</td>
				</tr>';
			}
			
			//SUPPLEMENT ATTENTE
			if (!empty($fac_res_attente)){
				echo '
				<tr>
					<td class="noborder" style="text-align:center;"></td>
					<td class="noborder">'.$lang_fact_attente.'</td>
					<td class="noborder" style="text-align:center;">'.$fac_res_attente.' €</td>
				</tr>
				<tr>
					<td class="noborder">&nbsp;</td>
					<td class="noborder">&nbsp;</td>
					<td class="noborder">&nbsp;</td>
				</tr>';
			}			
			
			// SUPPLEMENT
			if (!empty($fac_supplement)){
				echo '
				<tr>
					<td class="noborder" style="text-align:center;"></td>
					<td class="noborder">'.$lang_fact_supplement.'</td>
					<td class="noborder" style="text-align:center;">'.$fac_supplement.' €</td>
				</tr>
				<tr>
					<td class="noborder">&nbsp;</td>
					<td class="noborder">&nbsp;</td>
					<td class="noborder">&nbsp;</td>
				</tr>';
			}
			
			// REMISE
			if (!empty($fac_remise)){
				echo '
				<tr>
					<td class="noborder" style="text-align:center;"></td>
					<td class="noborder">'.$lang_remise.'</td>
					<td class="noborder" style="text-align:center;">'.$fac_remise.' €</td>
				</tr>
				<tr>
					<td class="noborder">&nbsp;</td>
					<td class="noborder">&nbsp;</td>
					<td class="noborder">&nbsp;</td>
				</tr>';
			}
			
			// Affichage du Total + TVA
				// HT
			echo '
				<tr>
					<th colspan="2" style="width:60%;text-align:right;border-bottom:none;">TOTAL '.$lang_fact_ht.'&nbsp;</th>
					<th style="width:20%;text-align:center;">'.number_format(($fac_prix_total-($fac_prix_total*$fac_tva/100)), 2, '.', '').' €</th>
				</tr>';
				//TVA
			echo '
				<tr>
					<th class="noborder" colspan="2" style="width:60%;text-align:right;">TOTAL '.$lang_fact_tva.' ('.$fac_tva.'%)&nbsp;</th>
					<th style="width:20%;text-align:center;">'.number_format(($fac_prix_total*$fac_tva/100), 2, '.', '').' €</th>
				</tr>';
				//TTC
			echo '
				<tr>
					<th colspan="2" style="width:60%;text-align:right;border-top:none;">TOTAL '.$lang_fact_ttc.'&nbsp;</th>
					<th style="width:20%;text-align:center;">'.number_format($fac_prix_total, 2, '.', '').' €</th>
				</tr>';
			
			echo '
		</table>
		<br />
		<div style="width=100%; text-align:center;">'.$lang_fact_merci.'</div><br />
	</page>';
	
	// Génération du PDF
	$content = ob_get_clean();
	require_once(dirname(__FILE__).'/../html_to_pdf/html2pdf.class.php');
	try
	{
		$html2pdf = new HTML2PDF('P', 'A4', 'fr');
		$html2pdf->writeHTML($content);
		$html2pdf->Output($lang_facture.'.pdf', 'D');
		exit;
	}
	catch(HTML2PDF_exception $e) {
		echo $e;
		exit;
	}
?>