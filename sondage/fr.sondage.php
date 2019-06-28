<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href="calendar.css" rel="stylesheet" type="text/css" media="all" />

		<title>Sondage</title>
		
		
		<!-- Fichiers de la nouvelle interface 	-->
		<link href="../aeroport/css/style.css" rel="stylesheet" type="text/css" />
		<link href="../aeroport/styles/commun.css" rel="stylesheet" type="text/css" media="all" />
		<link href="../aeroport/styles/normal.css" rel="stylesheet" type="text/css" media="all" title="A" />
		<link href="../aeroport/styles/medium.css" rel="alternate stylesheet" type="text/css" media="all" title="A+" />
		
		<style type="text/css">
			.custom_input {
				border:none;
				border-bottom:dotted black 1px;
			}
		</style>
		
	</head>
	
	<body>

		<div style="width:100%;margin:auto;text-align:center;">
			<img src="LOGO.gif" />

			<form action="traitement_sondage.php" method="post" id="form">
				<!-- KEMPF :
					Champs passés en hidden = champs dont on 
					a plus besoin dans le formulaire
				-->	
				<input type="hidden" id="dattee" name="dattee" value="0000-00-00" />
				<input type="hidden" name="ville" id="ville" maxlength="35" value="N/A" class="input120">
				<!-- -->
				<p align="right">
					<a href="index.php?lang=fr">[FR]</a>
					<a href="index.php?lang=en">[EN]</a>
				</p>
				
				<h3>ENQUETE DE SATISFACTION</h3>
				
				<!-- Bloc Entete -->
				<div class='blocTotal'>
					<div class='titreBlocTotal'></div>
					<div class='contenuBlocTotal' style="padding:5px;">
						<p>
							Bonjour,
							<br />
							Nous vous remercions de bien vouloir répondre aux questions suivantes qui nous permettrons de voir votre satisfaction sur nos services, d'améliorer la qualité de nos services et mieux répondre à vos attentes.
							<br /><br />
							Laissez-vous séduire, laissez-vous conduire avec Alsace Navette.

						</p>
					</div>
				</div>
				
				<!-- Bloc Contenu -->
				<div class='blocTotal'>
					<div class='titreBlocTotal'></div>
					<div class='contenuBlocTotal' style="padding:5px;">
						
						<div style="width:100%;text-align:center;">
								
							<div id="div_0">
								
								<table align="center">
								
									<tr>
										<td>

											<center>
											
												<p>
													<u>Informations Personnelles</u>
												</p>
												
												<table border="0" cellspacing="0" cellpadding="2" class="form_field_white" >
													<tr>
														<td align="left" >Civilité&nbsp;:&nbsp;</td>
														<td>
															<select name="titre" id="lst_civ" class="input120" width="120">
																<option>Merci de choisir ...</option>
																<option value="Mme">Mme.</option>
																<option value="Mlle">Mlle.</option>
																<option value="Mr">M.</option>
															</select>
														</td>
													</tr>
													<tr>
														<td align="left" >Prénom&nbsp;:&nbsp;</td>
														<td>
															<input type="text" name="prenom" id="prenom" maxlength="30" value="" class="custom_input" size="12">
														</td>
													</tr>
													<tr>
														<td align="left" >Nom&nbsp;:&nbsp;</td>
														<td>
															<input type="text" name="nom" id="nom" maxlength="30" value="" class="custom_input" size="12">
														</td>
													</tr>
													<tr>
														<td align="left">Pays&nbsp;:&nbsp;</td>
														<td>
															<select name="pays" id="pays" class="input120" width="120">

																<option>Merci de choisir ...</option>
																<option>Afghanistan</option>
																<option>Afrique du Sud</option>
																<option>Albanie </option>
																<option>Algérie </option>
																<option>Allemagne </option>
																<option>Andorre </option>
																<option>Angola </option>
																<option>Antigua-et-Barbuda </option>
																<option>Arabie saoudite </option>
																<option>Argentine </option>
																<option>Arménie </option>
																<option>Australie  </option>
																<option>Autriche  </option>
																<option>Azerbaïdjan  </option>
																<option>Bahamas  </option>
																<option>Bahreïn </option>
																<option>Bangladesh </option>
																<option>Barbade </option>
																<option>Belau</option>
																<option>Belgique </option>
																<option>Belize </option>
																<option>Bénin </option>
																<option>Bhoutan </option>
																<option>Biélorussie </option>
																<option>Birmanie </option>
																<option>Bolivie </option>
																<option>Bosnie-Herzégovine </option>
																<option>Botswana </option>
																<option>Brésil </option>
																<option>Brunei </option>
																<option>Bulgarie </option>
																<option>Burkina </option>
																<option>Burundi </option>
																<option>Cambodge </option>
																<option>Cameroun </option>
																<option>Canada </option>
																<option>Cap-Vert </option>
																<option>Chili </option>
																<option>Chine </option>
																<option>Chypre </option>
																<option>Colombie </option>
																<option>Comores  </option>
																<option>Congo </option>
																<option>Congo </option>
																<option>Cook </option>
																<option>Corée du Nord </option>
																<option>Corée du Sud </option>
																<option>Costa Rica </option>
																<option>Côte d'Ivoire </option>
																<option>Croatie </option>
																<option>Cuba </option>
																<option>Danemark </option>
																<option>Djibouti </option>
																<option>Dominique </option>
																<option>Égypte  </option>
																<option>Émirats arabes unis </option>
																<option>Équateur  </option>
																<option>Érythrée </option>
																<option>Espagne  </option>
																<option>Estonie  </option>
																<option>États-Unis </option>
																<option>Éthiopie  </option>
																<option>Fidji  </option>
																<option>Finlande </option>
																<option selected>France </option>
																<option>Gabon </option>
																<option>Gambie </option>
																<option>Géorgie </option>
																<option>Ghana </option>
																<option>Grèce </option>
																<option>Grenade </option>
																<option>Guatemala </option>
																<option>Guinée </option>
																<option>Guinée-Bissao </option>
																<option>Guinée équatoriale </option>
																<option>Guyana </option>
																<option>Haïti </option>
																<option>Honduras </option>
																<option>Hongrie </option>
																<option>Inde  </option>
																<option>Indonésie </option>
																<option>Iran  </option>
																<option>Iraq  </option>
																<option>Irlande  </option>
																<option>Islande  </option>
																<option>Israël </option>
																<option>Italie  </option>
																<option>Jamaïque </option>
																<option>Japon </option>
																<option>Jordanie </option>
																<option>Kazakhstan </option>
																<option>Kénya</option>
																<option>Kirghizistan </option>
																<option>Kiribati </option>
																<option>Koweït </option>
																<option>Laos </option>
																<option>Lesotho </option>
																<option>Lettonie </option>
																<option>Liban </option>
																<option>Liberia </option>
																<option>Libye </option>
																<option>Liechtenstein </option>
																<option>Lituanie </option>
																<option>Luxembourg </option>
																<option>Macédoine </option>
																<option>Madagascar </option>
																<option>Malaisie </option>
																<option>Malawi </option>
																<option>Maldives  </option>
																<option>Mali </option>
																<option>Malte </option>
																<option>Maroc </option>
																<option>Marshall </option>
																<option>Maurice </option>
																<option>Mauritanie </option>
																<option>Mexique </option>
																<option>Micronésie </option>
																<option>Moldavie </option>
																<option>Monaco </option>
																<option>Mongolie </option>
																<option>Mozambique </option>
																<option>Namibie </option>
																<option>Nauru </option>
																<option>Népal </option>
																<option>Nicaragua </option>
																<option>Niger </option>
																<option>Nigeria </option>
																<option>Niue</option>
																<option>Norvège </option>
																<option>Nouvelle-Zélande </option>
																<option>Oman </option>
																<option>Ouganda  </option>
																<option>Ouzbékistan  </option>
																<option>Pakistan </option>
																<option>Panama </option>
																<option>Papouasie - Nouvelle Guinée </option>
																<option>Paraguay </option>
																<option>Pays-Bas </option>
																<option>Pérou </option>
																<option>Philippines  </option>
																<option>Pologne </option>
																<option>Portugal </option>
																<option>Qatar </option>
																<option>République centrafricaine </option>
																<option>République dominicaine </option>
																<option>République tchèque </option>
																<option>Roumanie </option>
																<option>Royaume-Uni </option>
																<option>Russie </option>
																<option>Rwanda </option>
																<option>Saint-Christophe-et-Niévès </option>
																<option>Sainte-Lucie</option>
																<option>Saint-Marin</option>
																<option>Saint-Vincent-et-les Grenadines</option>
																<option>Salomon </option>
																<option>Salvador</option>
																<option>Samoa occidentales </option>
																<option>Sao Tomé-et-Principe </option>
																<option>Sénégal </option>
																<option>Seychelles  </option>
																<option>Sierra Leone </option>
																<option>Singapour </option>
																<option>Slovaquie </option>
																<option>Slovénie </option>
																<option>Somalie </option>
																<option>Soudan </option>
																<option>Sri Lanka </option>
																<option>Suède </option>
																<option>Suisse </option>
																<option>Suriname </option>
																<option>Swaziland </option>
																<option>Syrie </option>
																<option>Tadjikistan </option>
																<option>Tanzanie </option>
																<option>Tchad </option>
																<option>Thaïlande </option>
																<option>Togo </option>
																<option>Tonga  </option>
																<option>Trinité-et-Tobago </option>
																<option>Tunisie </option>
																<option>Turkménistan </option>
																<option>Turquie </option>
																<option>Tuvalu </option>
																<option>Ukraine </option>
																<option>Uruguay </option>
																<option>Vanuatu</option>
																<option>Venezuela </option>
																<option>Viêt Nam </option>
																<option>Yémen </option>
																<option>Yougoslavie </option>
																<option>Zaïre</option>
																<option>Zambie </option>
																<option>Zimbabwe </option>

															</select>
														</td>
													</tr>
													<tr>
														<td align="left" >Mail &nbsp;:&nbsp;</td>
														<td>
															<input type="text" name="mail" id="mail" maxlength="50" value="" class="custom_input" size="30">
														</td>
													</tr>
													<tr>
														<td align="left">Quels réseaux sociaux utilisez vous ?</td>
														<td>
															<input name="fb" id="fb" type="checkbox"/> Facebook<br />
															<input name="tw" id="tw" type="checkbox"/> Twitter<br />
															<input name="vd" id="vd" type="checkbox"/> Viadeo<br />
															<input name="li" id="li" type="checkbox"/> LinkedIn<br />
															<input name="fo" id="fo" type="checkbox" /> Forum<br />
														</td>
														<td valign="bottom" align="left">
															<textarea name="comm_forum" id="comm_forum" style="display:none" rows=1 cols=25></textarea>
														</td>
													</tr>
												</table>
											</td>
											
										</tr>
									
									</table>
								
								</center>
							
							</div>

							<div id="div_1">
								<center>
									<p>
										<u>Type de voyageur</u>
									</p>

									<table>
									
										<tr>
											<td align="left">1.		Combien de fois par an prenez-vous l'avion ?</td>
											<td align="left">
												<span>
													<input name="pp" type="radio" value="+6" />Plus de 6
													<br />
													<input name="pp" type="radio" value="3-6" />3-6
													<br />
													<input name="pp" type="radio" value="1-2" />1-2
													<br />
													<input type="radio" name="pp" value="0" />Moins
												</span>
											</td>
										<tr/>
										
										<tr>
											<td align="left">2.		Quel aéroport de la région du Rhin supérieure utilisez-vous le plus souvent ?</td>
											<td>
												<select name="aeroport" id="lst_aeroport"  class="input120" width="120">
													<option>Merci de choisir ...</option>
													<option value="1">Bâle-Mulhouse</option>
													<option value="2">Karlsruhe / Baden-Baden</option>
													<option value="3">Stuttgart</option>
													<option value="4">Francfort Hahn</option>
													<option value="5">Francfort Main</option>
													<option value="6">Zürich</option>
													<option value="100">Strasbourg</option>
												</select>
											</td>
										</tr>
										
										<tr>
											<td align="left">3.		Donner vos principales destinations de voyages... </td>
											<td>
												<textarea name="comm_dest" id="comm_dest" rows=1 cols=30></textarea>
											</td>
										</tr>
										
										<tr>
											<td align="left">4.		Pour quelles raisons voyagez-vous ?</td>
											<td>
												<input name="ra_perso" id="ra_perso" type="checkbox"/>Personnelles
												<input name="ra_pro" id="ra_pro" type="checkbox"/>Professionnelles
											</td>
										<tr/>
										
									</table>
								
								<br/>
							
								</center>
								
							</div>
							
							<div id="div_2">
								<center>
								
									<p>
										<u>Alsace Navette sur Internet</u>
									</p>
									<p>5.	Comment avez-vous pris connaissance du site alsace-navette.com ?</p>
									
									<table>
									
										<tr>
											<td>							
												<input name="connaissance_internet" id="connaissance_internet" type="checkbox"/> Internet
											</td>
											<td>&nbsp;</td>
										</tr>
										
										<tr>
											<td>
												<input name="connaissance_lien" id="connaissance_lien" type="checkbox"/> Lien direct
											</td>
											<td>&nbsp;</td>
										</tr>
										
										<tr>
											<td>
												<input name="connaissance_moteur" id="connaissance_moteur" type="checkbox"/> Moteur de recherche
											</td>
											<td>
												<textarea name="connaissance_moteur_txt" id="connaissance_moteur_txt" style="display:none" rows=1 cols=35></textarea>
											</td>
										</tr>
										
										<tr>
											<td>
												<input name="connaissance_reseau" id="connaissance_reseau" type="checkbox"/> Réseau social<br />
											</td>
											<td>
												<select name="connaissance_reseau_lst" id="connaissance_reseau_lst" style="display:none" class="input120" width="120">
													<option value="0">Merci de choisir le réseau...</option>
													<option value="1">Facebook</option>
													<option value="2">Twitter</option>
													<option value="3">Viadeo</option>
													<option value="4">LinkedIn</option>
													<option value="5">Forum</option>
												</select>
									
											</td>
										</tr>
										
										<tr>
											<td>
												<input name="connaissance_presse" id="connaissance_presse" type="checkbox" /> Presse<br />
											</td>
											<td>&nbsp;</td>
										<tr/>
										
										<tr>
											<td>
												<input name="connaissance_radio" id="connaissance_radio" type="checkbox" /> Radio<br />
											<td/>
											<td>&nbsp;</td>
										<tr/>
										
										<tr>
											<td>	
												<input name="connaissance_autre" id="connaissance_autre" type="checkbox" /> Autres :
											</td>
											<td>
												<input name="connaissance_autre_txt" id="connaissance_autre_txt" style="display:none" type="text" class="custom_input" size="20" maxlength="30" />
											<td/>
										<tr/>
										
									</table>
									
									<p>6.	Avez-vous facilement trouvé l'adresse de notre site internet ?</p>
									
									<input name="trouve_facilement" value="1" type="radio" />Oui<br />
									<table>
								
										<tr>
											<td>
												<input name="trouve_facilement" value="0" type="radio"/>Non <br />
											</td>
										</tr>
										<tr style="display:none" id="trouve_facilement_txt2">
											<td>
												Précisez :
												<textarea name="trouve_facilement_txt" id="trouve_facilement_txt" rows=1 cols=35></textarea>
											</td>
										</tr>
									</table>
								
								</center>
								
							</div>
							
							<div id="div_3">
								
								<center>
							
									<p>
										<u>Vous : nos clients</u>
									</p>
									
									<p>7.	Dans les 12 derniers mois avez-vous utilisé l'un des...</p>
									
									<table>
										<tr>
											<td align="left" width="40%">Service aéroport :</td>
											<td align="center" width="30%">
												<input name="utilise_aeroport" type="radio" value="1" />Oui
											</td>
											<td align="center" width="30%">
												<input name="utilise_aeroport" type="radio" value="0"/>Non
											</td>
										</tr>
										<tr>
											<td align="left">Service tourisme :</td>
											<td align="center">
												<input name="utilise_tourisme" type="radio" value="1"/>Oui 
											</td>
											<td align="center">
												<input name="utilise_tourisme" type="radio" value="0"/>Non 
											</td>
										</tr>
										<tr>
											<td align="left">Laissez-vous conduire :</td>
											<td align="center">
												<input name="utilise_lvc" type="radio" value="1"/>Oui 
											</td>
											<td align="center">
												<input name="utilise_lvc" type="radio" value="0"/>Non 
											</td>
										</tr>
									</table>

									<p>8.	Avez vous l'intention d'utiliser d'autres services d'Alsace Navette ? </p>
									
									<table>
										<tr>
											<td>
												<input name="va_utiliser" value="1" type="radio"/>Oui 
											</td>
											<td id="va_utiliser_td" style="display:none">
												<input name="va_utiliser_aeroport" id="va_utiliser_aeroport" type="checkbox"/> « Service aéroport »<br />
												<input name="va_utiliser_tourisme" id="va_utiliser_tourisme" type="checkbox"/> « Service Tourisme »<br />
												<input name="va_utiliser_lvc" id="va_utiliser_lvc" type="checkbox"/> « Laissez-vous conduire »<br />
											</td>
										</tr>
										<tr>
											<td>
												<input name="va_utiliser" value="0" type="radio"/>Non 
											</td>
										</tr>
									</table>
									
									<p>9.	Quels autres services souhaiteriez-vous qu'alsace-navette vous propose ?</p>
									
									<textarea name="comm_nouveau_service" id="comm_nouveau_service" rows=1 cols=30></textarea>

								</center>
								
							</div>
							
							
							<div id="div_4">
							
								<center>
									<p>
										<u>10.	Votre satisfaction sur notre prestation</u>
									</p>
									
									<p>Quel est votre niveau de satisfaction en ce qui concerne :</p>
										
									<table width="75%"style="padding:25px;border:1px solid black;">
										<tr>
											<td width="70%">&nbsp;</td>
											
											<td width="5%" align="center"><img src="pascontentpascontent.png" alt="Très pas content" /></td>
											<td width="5%" align="center"><img src="pascontent.png" alt="Pas content" /></td>
											<td width="5%" align="center"><img src="neutre.png" alt="Neutre" /></td>
											<td width="5%" align="center"><img src="content.png" alt="Content" /></td>
											<td width="5%" align="center"><img src="contentcontent.png" alt="Très content" /></td>
											<td width="5%" align="center">Sans opinion</td>
											
										</tr>
										<tr>
											<td>Clarté des informations</td>
											<td style="text-align:center;"><input name="clarte" value="1" type="radio"/></td>
											<td style="text-align:center;"><input name="clarte" value="2" type="radio"/></td>
											<td style="text-align:center;"><input name="clarte" value="3" type="radio"/></td>
											<td style="text-align:center;"><input name="clarte" value="4" type="radio"/></td>
											<td style="text-align:center;"><input name="clarte" value="5" type="radio"/></td>
											<td style="text-align:center;"><input name="clarte" value="0" type="radio"/></td>
										</tr>
										<tr>
											<td>Ergonomie du site</td>
											<td style="text-align:center;"><input name="ergo" value="1" type="radio"/></td>
											<td style="text-align:center;"><input name="ergo" value="2" type="radio"/></td>
											<td style="text-align:center;"><input name="ergo" value="3" type="radio"/></td>
											<td style="text-align:center;"><input name="ergo" value="4" type="radio"/></td>
											<td style="text-align:center;"><input name="ergo" value="5" type="radio"/></td>
											<td style="text-align:center;"><input name="ergo" value="0" type="radio"/></td>
										</tr>
										<tr>
											<td>Facilité de réservation et de paiement</td>
											<td style="text-align:center;"><input name="facilite" value="1" type="radio"/></td>
											<td style="text-align:center;"><input name="facilite" value="2" type="radio"/></td>
											<td style="text-align:center;"><input name="facilite" value="3" type="radio"/></td>
											<td style="text-align:center;"><input name="facilite" value="4" type="radio"/></td>
											<td style="text-align:center;"><input name="facilite" value="5" type="radio"/></td>
											<td style="text-align:center;"><input name="facilite" value="0" type="radio"/></td>
										</tr>
										<tr>
											<td>La qualité relationnelle du service d'accueil d'Alsace Navette</td>
											<td style="text-align:center;"><input name="qualite_accueil" value="1" type="radio"/></td>
											<td style="text-align:center;"><input name="qualite_accueil" value="2" type="radio"/></td>
											<td style="text-align:center;"><input name="qualite_accueil" value="3" type="radio"/></td>
											<td style="text-align:center;"><input name="qualite_accueil" value="4" type="radio"/></td>
											<td style="text-align:center;"><input name="qualite_accueil" value="5" type="radio"/></td>
											<td style="text-align:center;"><input name="qualite_accueil" value="0" type="radio"/></td>
										</tr>
										<tr>
											<td>La qualité relationnelle du service de chauffeur d'Alsace Navette</td>
											<td style="text-align:center;"><input name="qualite_chauffeur" value="1" type="radio"/></td>
											<td style="text-align:center;"><input name="qualite_chauffeur" value="2" type="radio"/></td>
											<td style="text-align:center;"><input name="qualite_chauffeur" value="3" type="radio"/></td>
											<td style="text-align:center;"><input name="qualite_chauffeur" value="4" type="radio"/></td>
											<td style="text-align:center;"><input name="qualite_chauffeur" value="5" type="radio"/></td>
											<td style="text-align:center;"><input name="qualite_chauffeur" value="0" type="radio"/></td>
										</tr>
										<tr>
											<td>La qualité du service transport</td>
											<td style="text-align:center;"><input name="qualite_transport" value="1" type="radio"/></td>
											<td style="text-align:center;"><input name="qualite_transport" value="2" type="radio"/></td>
											<td style="text-align:center;"><input name="qualite_transport" value="3" type="radio"/></td>
											<td style="text-align:center;"><input name="qualite_transport" value="4" type="radio"/></td>
											<td style="text-align:center;"><input name="qualite_transport" value="5" type="radio"/></td>
											<td style="text-align:center;"><input name="qualite_transport" value="0" type="radio"/></td>
										</tr>
										<tr>
											<td>Le rapport qualité-prix de la prestation</td>
											<td style="text-align:center;"><input name="qualite_prix" value="1" type="radio"/></td>
											<td style="text-align:center;"><input name="qualite_prix" value="2" type="radio"/></td>
											<td style="text-align:center;"><input name="qualite_prix" value="3" type="radio"/></td>
											<td style="text-align:center;"><input name="qualite_prix" value="4" type="radio"/></td>
											<td style="text-align:center;"><input name="qualite_prix" value="5" type="radio"/></td>
											<td style="text-align:center;"><input name="qualite_prix" value="0" type="radio"/></td>
											
										</tr>
										<tr>
											<td>Votre niveau de satisfaction globale</td>
											<td style="text-align:center;"><input name="global" value="1" type="radio"/></td>
											<td style="text-align:center;"><input name="global" value="2" type="radio"/></td>
											<td style="text-align:center;"><input name="global" value="3" type="radio"/></td>
											<td style="text-align:center;"><input name="global" value="4" type="radio"/></td>
											<td style="text-align:center;"><input name="global" value="5" type="radio"/></td>
											<td style="text-align:center;"><input name="global" value="0" type="radio"/></td>
											
										</tr>

									</table>
									
								</center>
								
							</div>
							
							<div id="div_5">
							
								<center>
									
									<p>
										<u>11.	Question ouverte</u>
									</p>
									
									<table width=50%>
										<tr>
											<td>Etes-vous prêt à nous recommander </td>
											<td valign="top">Oui</td>
											<td valign="top">Non</td>
											<td valign="top">&nbsp;&nbsp;?</td>
										</tr>
										<tr>
											<td>auprès de vos relations ?<b/></td>
											<td><span><input name="recommendation" value="1" type="radio"/></span></td>
											<td><span><input name="recommendation" value="0" type="radio"/></span></td>
											<td><span><input name="recommendation" value="2" type="radio"/></span></td>
										</tr>
									</table>
									
									<p>
										<u>12.	Vos commentaires et suggestions d'amélioration</u>
									</p>
									
									<table>
										<tr>
											<td>Commentaires</td>
											<td>Suggestions d'amélioration</td>
										</tr>
										<tr>
											<td><textarea name="commentaire_site" id="commentaire_site" rows=5 cols=30>Commentaires...</textarea></td>
											<td><textarea name="suggestion_site" id="suggestion_site" rows=5 cols=30>Suggestions pour le site...</textarea></td>
										</tr>
									</table>
									
									<p>Nous vous remercions de votre confiance et de votre collaboration à la qualité des nos prestations.</p>
									
								</center>
								
							</div>
							
							<!-- Bas du formulaire -->
							
							
							<center>
								
								<input type="hidden" id="etape" value="0" />
								<input type="hidden" name="send_sondage" id="toto" />
								
								<br />

								<input type="button" style="display:none" id="btn_envoyer" value="Envoyer les réponses" />
								
								<div style="display:none">
									<input type="button" id="btn_retour" value="Retour" />
								</div>
								
								<input type="button" value="Etape suivante" id="btn_suivant" />
								
							</center>
							
						</div>

						<script type="text/javascript" src="./sondage.js"></script>
						
					</div>
				</div>
				
				
					
			</form>
		
		</div>
		
	</body>
	
</html>