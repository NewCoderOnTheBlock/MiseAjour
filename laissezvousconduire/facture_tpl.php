<?php
    ob_start();

	// On écrit ce que contiendra le PDF
	echo '
	<page style="font-size: 18pt">
		<table cellspacing="0" style="width: 100%; font-size: 14px">
			<tr>
				<td style="width: 100%; color: #444444; font-size: 50px; text-align:right;">
					Facture
				</td>
			</tr>
			<tr>
				<td style="width: 100%; color: #444444; font-size: 50px;">
					Alsace-Navette.com
				</td>
			</tr>
		</table>
		<table cellspacing="0" style="font-size: 20px">
			<tr>
				<td>
					2 rue du Coq
				</td>
			</tr>
			<tr>
				<td>
					67000 STRASBOURG
				</td>
			</tr>
			<tr>
				<td>
					Tel : 03 88 33 33 71 | 06 27 18 12 52
				</td>
			</tr>
			<tr>
				<td>
					Email : info@alsace-navette.com
				</td>
			</tr>
			<tr>
				<td>
					N° SIRET : 47767406300037
				</td>
			</tr>
		</table>
		<hr />
		Le '.date("d/m/Y", strtotime($date_r)).'
		<br />
		<table cellspacing="0" style="width: 100%; font-size: 18px;">
			<tr>
				<td><h2>Facturé à :</h2></td>
			</tr>
			<tr>
				<td>'.$nom_c.' '.$prenom_c.'</td>
			</tr>
			<tr>
				<td>'.$mail_c.'</td>
			</tr>
		</table>
		<br />
		<table cellspacing="0" style="width: 100%; font-size: 18px;">
			<tr>
				<td><h2>Description du trajet :</h2></td>
				<td></td>
			</tr>
			<tr>
				<td>Aller-retour pour le service Laissez-vous Conduire</td>
				<td></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td></td>
			</tr>
			<tr>
				<td style="text-align:right;"><u>Aller</u> : </td>
				<td> '.$libelle_aller_r.' le '.date("d/m/Y à H:i", strtotime($date_aller_r)).' <br />vers Europa-park</td>
			</tr>';
			
			if ($type_aller_r == 4){
				echo '
				<tr>
					<td></td>
					<td><i>'.$adresse_aller_r.'</i></td>
				</tr>';
			}
			
			echo '
			<tr>
				<td>&nbsp;</td>
				<td></td>
			</tr>
			<tr>
				<td style="text-align:right;"><u>Retour</u> : </td>
				<td> Europa-Park le '.date("d/m/Y à H:i", strtotime($date_retour_r)).' <br />vers '.$libelle_retour_r.'</td>
			</tr>';
			
			if ($type_retour_r == 4){
				echo '
				<tr>
					<td></td>
					<td><i>'.$adresse_retour_r.'</i></td>
				</tr>';
			}
			
			echo '
		</table>
		<br />
		<br />
		<hr />
		
		Total HT : '.($prix_r-($prix_r*$taux_tva/100)).' € <br />
		Total TVA ('.$taux_tva.'%) : '.($prix_r*$taux_tva/100).' € <br />
		<hr />
		Total TTC : '.$prix_r.' € <br />
		
		<br />
		<br />
		<br />
		
		<table cellspacing="0" style="width: 100%; font-size: 18px">
			<tr>
				<td style="width:100%; text-align:center;">Merci de votre confiance !</td>
			</tr>
		</table>
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