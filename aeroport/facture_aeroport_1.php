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
	echo '
	<page style="font-size: 18pt" backbottom ="10%">
		<page_footer>
			<table style="width:100%;">
				<tr>
					<td style="width:50%;">N° SIRET : 477674063 00035</td>
					<td style="text-align:right;width:50%;">AFI Alsace</td>
				</tr>
				<tr>
					<td>TVA Intracommunautaire : FR73 477674063 00035</td>
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
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td></td>
				<td>'.$civilite_c.' '.$nom_c.' '.$prenom_c.'</td>
			</tr>
			<tr>
				<td></td>
				<td><a>'.$mail_c.'</a></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td><h1>Facture n°'.$id_paypal.'</h1></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td>Strasbourg, le '.date("d/m/Y", time()).'</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
		</table>
		<br />
		<table align="center" border="1" cellspacing="0" style="width:100%; font-size: 20px; border:solid black 1px;">
			<tr>
				<th style="width:20%;text-align:center;">DATE</th>
				<th style="width:40%;text-align:center;">OBJET</th>
				<th style="width:20%;text-align:center;">MONTANT</th>
			</tr>
			<tr>
				<td style="border-bottom:none;">&nbsp;</td>
				<td style="border-bottom:none;">&nbsp;</td>
				<td style="border-bottom:none;">&nbsp;</td>
			</tr>';
			
			// ALLER
			
			echo '
			<tr>
				<td class="noborder" style="text-align:center;">'.$date_aller.'</td>
				<td class="noborder">Transfert '.$lieu_1_aller.' -> '.$lieu_2_aller.'</td>
				<td class="noborder" style="text-align:center;">'.$prix_aller.' €</td>
			</tr>
			<tr>
				<td class="noborder">&nbsp;</td>
				<td class="noborder">&nbsp;</td>
				<td class="noborder">&nbsp;</td>
			</tr>';
			// Surcout horaires non-fixes
			if (isset($horaire_demande_aller)){
				echo '
				<tr>
					<td class="noborder" style="text-align:center;"></td>
					<td class="noborder">Horaires à la demande</td>
					<td class="noborder" style="text-align:center;">'.$horaire_demande_aller.' €</td>
				</tr>
				<tr>
					<td class="noborder">&nbsp;</td>
					<td class="noborder">&nbsp;</td>
					<td class="noborder">&nbsp;</td>
				</tr>';
			}
			// Surcout Domicile
			if (isset($maj_dom_aller)){
				echo '
				<tr>
					<td class="noborder" style="text-align:center;"></td>
					<td class="noborder">Surcoût domicile</td>
					<td class="noborder" style="text-align:center;">'.$maj_dom_aller.' €</td>
				</tr>
				<tr>
					<td class="noborder">&nbsp;</td>
					<td class="noborder">&nbsp;</td>
					<td class="noborder">&nbsp;</td>
				</tr>';
			}
			
			// RETOUR : On vérifie si il y a un retour
			if (isset($date_retour)){
				echo '
				<tr>
					<td class="noborder" style="text-align:center;">'.$date_retour.'</td>
					<td class="noborder">Transfert '.$lieu_1_retour.' -> '.$lieu_2_retour.'</td>
					<td class="noborder" style="text-align:center;">'.$prix_retour.' €</td>
				</tr>
				<tr>
					<td class="noborder">&nbsp;</td>
					<td class="noborder">&nbsp;</td>
					<td class="noborder">&nbsp;</td>
				</tr>';
				// Surcout horaires non-fixes
				if (isset($horaire_demande_retour)){
					echo '
					<tr>
						<td class="noborder" style="text-align:center;"></td>
						<td class="noborder">Horaires à la demande</td>
						<td class="noborder" style="text-align:center;">'.$horaire_demande_retour.' €</td>
					</tr>
					<tr>
						<td class="noborder">&nbsp;</td>
						<td class="noborder">&nbsp;</td>
						<td class="noborder">&nbsp;</td>
					</tr>';
				}
				// Surcout Domicile
				if (isset($maj_dom_retour)){
					echo '
					<tr>
						<td class="noborder" style="text-align:center;"></td>
						<td class="noborder">Surcoût domicile</td>
						<td class="noborder" style="text-align:center;">'.$maj_dom_retour.' €</td>
					</tr>
					<tr>
						<td class="noborder">&nbsp;</td>
						<td class="noborder">&nbsp;</td>
						<td class="noborder">&nbsp;</td>
					</tr>';
				}
				
				
			}
			// DERNIERE MINUTE
			if (isset($res_der_min)){
				echo '
				<tr>
					<td class="noborder" style="text-align:center;"></td>
					<td class="noborder">Surcoût domicile</td>
					<td class="noborder" style="text-align:center;">'.$res_der_min.' €</td>
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
					<th colspan="2" style="width:60%;text-align:right;border-bottom:none;">TOTAL HT:</th>
					<th style="width:20%;text-align:center;">'.number_format(($prix_total-($prix_total*$tva/100)), 2, '.', '').' €</th>
				</tr>';
				//TVA
			echo '
				<tr>
					<th class="noborder" colspan="2" style="width:60%;text-align:right;">TOTAL TVA ('.$tva.'%):</th>
					<th style="width:20%;text-align:center;">'.number_format(($prix_total*$tva/100), 2, '.', '').' €</th>
				</tr>';
				//TTC
			echo '
				<tr>
					<th colspan="2" style="width:60%;text-align:right;border-top:none;">TOTAL TTC:</th>
					<th style="width:20%;text-align:center;">'.number_format($prix_total, 2, '.', '').' €</th>
				</tr>';
			
			echo '
		</table>
		<br />
		<div style="width=100%; text-align:center;">Merci de votre confiance !</div><br />
	</page>
	';
	
	// Génération du PDF
	$content = ob_get_clean();
	require_once(dirname(__FILE__).'/../html_to_pdf/html2pdf.class.php');
	try
	{
		$html2pdf = new HTML2PDF('P', 'A4', 'fr', false, 'ISO-8859-1');
		$html2pdf->writeHTML($content);
		$html2pdf->Output('Facture.pdf');
		exit;
	}
	catch(HTML2PDF_exception $e) {
		echo $e;
		exit;
	}
?>