<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href="calendar.css" rel="stylesheet" type="text/css" media="all" />

		<title>Survey</title>
		
		
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
				
				<h3>SATISFACTION SURVEY</h3>
				
				<!-- Bloc Entete -->
				<div class='blocTotal'>
					<div class='titreBlocTotal'></div>
					<div class='contenuBlocTotal' style="padding:5px;">
						<p>
							Hello,
							<br />
							Thank you kindly answer the following questions which will enable us to see your satisfaction with our services, improve the quality of our services and better meet your expectations.
							<br /><br />
							Be seduced, let you drive with Alsace Shuttle.

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
													<u>Basic Information</u>
												</p>
												
												<table border="0" cellspacing="0" cellpadding="2" class="form_field_white" >
													<tr>
														<td align="left" >Civilité&nbsp;:&nbsp;</td>
														<td>
															<select name="titre" id="lst_civ" class="input120" width="120">
																<option>Choose one of the option...</option>
																<option value="Mme">Miss.</option>
																<option value="Mlle">Mrs.</option>
																<option value="Mr">M.</option>
															</select>
														</td>
													</tr>
													<tr>
														<td align="left" >First Name&nbsp;:&nbsp;</td>
														<td>
															<input type="text" name="prenom" id="prenom" maxlength="30" value="" class="custom_input" size="12">
														</td>
													</tr>
													<tr>
														<td align="left" >Last Name&nbsp;:&nbsp;</td>
														<td>
															<input type="text" name="nom" id="nom" maxlength="30" value="" class="custom_input" size="12">
														</td>
													</tr>
													<tr>
														<td align="left">Country&nbsp;:&nbsp;</td>
														<td>
															<select name="pays" id="pays" class="input120" width="120">

																<option>Thank you for choosing ...</option>
																<option>Afghanistan</option>
																<option>Albania</option>
																<option>Algeria</option>
																<option>Andorra</option>
																<option>Angola</option>
																<option>Antigua and Barbuda</option>
																<option>Argentina</option>
																<option>Armenia</option>
																<option>Australia</option>
																<option>Austria</option>
																<option>Azerbaijan</option>
																<option>Bahamas </option>
																<option>Bahrain</option>
																<option>Bangladesh</option>
																<option>Barbados</option>
																<option>Belarus</option>
																<option>Belgium</option>
																<option>Belize</option>
																<option>Benin</option>
																<option>Bhutan</option>
																<option>Bolivia</option>
																<option>Bosnia and Herzegovina</option>
																<option>Botswana</option>
																<option>Brazil</option>
																<option>Brunei</option>
																<option>Bulgaria</option>
																<option>Burkina</option>
																<option>Burma</option>
																<option>Burundi</option>
																<option>Cambodia</option>
																<option>Cameroon</option>
																<option>Canada</option>
																<option>Cape Verde</option>
																<option>Central African Republic </option>
																<option>Chad</option>
																<option>Chile</option>
																<option>China</option>
																<option>Colombia</option>
																<option>Comoros </option>
																<option>Congo </option>
																<option>Cook Islands</option>
																<option>Costa Rica</option>
																<option>Croatia</option>
																<option>Cuba</option>
																<option>Cyprus</option>
																<option>Czech Republic </option>
																<option>Denmark</option>
																<option>Djibouti</option>
																<option>Dominica</option>
																<option>Dominican Republic </option>
																<option>Ecuador</option>
																<option>Egypt</option>
																<option>El Salvador</option>
																<option>Equatorial Guinea</option>
																<option>Eritrea</option>
																<option>Estonia</option>
																<option>Ethiopia</option>
																<option>Fiji</option>
																<option>Finland</option>
																<option>France</option>
																<option>Gabon</option>
																<option>Gambia </option>
																<option>Georgia</option>
																<option>Germany</option>
																<option>Ghana</option>
																<option>Greece</option>
																<option>Grenada</option>
																<option>Guatemala</option>
																<option>Guinea</option>
																<option>Guinea-Bissau</option>
																<option>Guyana</option>
																<option>Haiti</option>
																<option>Holy See </option>
																<option>Honduras</option>
																<option>Hungary</option>
																<option>Iceland</option>
																<option>India</option>
																<option>Indonesia</option>
																<option>Iran</option>
																<option>Iraq</option>
																<option>Ireland</option>
																<option>Israel</option>
																<option>Italy</option>
																<option>Ivory Coast</option>
																<option>Jamaica</option>
																<option>Japan</option>
																<option>Jordan</option>
																<option>Kazakhstan</option>
																<option>Kenya</option>
																<option>Kiribati</option>
																<option>Kuwait</option>
																<option>Kyrgyzstan</option>
																<option>Laos</option>
																<option>Latvia</option>
																<option>Lebanon</option>
																<option>Lesotho</option>
																<option>Liberia</option>
																<option>Libya</option>
																<option>Liechtenstein</option>
																<option>Lithuania</option>
																<option>Luxembourg</option>
																<option>Macedonia (The Former Yugoslav Republic of)</option>
																<option>Madagascar</option>
																<option>Malawi</option>
																<option>Malaysia</option>
																<option>Maldives</option>
																<option>Mali</option>
																<option>Malta</option>
																<option>Marshall Islands </option>
																<option>Mauritania</option>
																<option>Mauritius</option>
																<option>Mexico</option>
																<option>Micronesia (The Federated States of)</option>
																<option>Moldova</option>
																<option>Monaco</option>
																<option>Mongolia</option>
																<option>Morocco</option>
																<option>Mozambique</option>
																<option>Namibia</option>
																<option>Nauru</option>
																<option>Nepal</option>
																<option>Netherlands </option>
																<option>New Zealand</option>
																<option>Nicaragua</option>
																<option>Niger </option>
																<option>Nigeria</option>
																<option>Niue</option>
																<option>North Korea</option>
																<option>Norway</option>
																<option>Oman</option>
																<option>Pakistan</option>
																<option>Palau</option>
																<option>Panama</option>
																<option>Papua New Guinea</option>
																<option>Paraguay</option>
																<option>Peru</option>
																<option>Philippines </option>
																<option>Poland</option>
																<option>Portugal</option>
																<option>Qatar</option>
																<option>Romania</option>
																<option>Russia</option>
																<option>Rwanda</option>
																<option>Saint Kitts and Nevis</option>
																<option>Saint Lucia</option>
																<option>Saint Vincent and the Grenadines</option>
																<option>San Marino</option>
																<option>Sao Tome and Principe</option>
																<option>Saudi Arabia</option>
																<option>Senegal</option>
																<option>Seychelles</option>
																<option>Sierra Leone</option>
																<option>Singapore</option>
																<option>Slovakia</option>
																<option>Slovenia</option>
																<option>Solomon Islands</option>
																<option>Somalia</option>
																<option>South Africa</option>
																<option>South Korea</option>
																<option>Spain</option>
																<option>Sri Lanka</option>
																<option>Sudan</option>
																<option>Suriname</option>
																<option>Swaziland</option>
																<option>Sweden</option>
																<option>Switzerland</option>
																<option>Syria</option>
																<option>Tajikistan</option>
																<option>Tanzania</option>
																<option>Thailand</option>
																<option>Togo</option>
																<option>Tonga</option>
																<option>Trinidad and Tobago</option>
																<option>Tunisia</option>
																<option>Turkey</option>
																<option>Turkmenistan</option>
																<option>Tuvalu</option>
																<option>Uganda</option>
																<option>Ukraine</option>
																<option>United Arab Emirates </option>
																<option>United Kingdom </option>
																<option>United States </option>
																<option>Uruguay</option>
																<option>Uzbekistan</option>
																<option>Vanuatu</option>
																<option>Venezuela</option>
																<option>Vietnam</option>
																<option>Western Samoa</option>
																<option>Yemen</option>
																<option>Yougoslavia</option>
																<option>Zaire</option>
																<option>Zambia</option>
																<option>Zimbabwe</option>

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
														<td align="left">Which one of the following social networks are you using ?</td>
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
											<td align="left">1.		How many times do you travel by plane?</td>
											<td align="left">
												<span>
													<input name="pp" type="radio" value="+6" />More than 6
													<br />
													<input name="pp" type="radio" value="3-6" />3-6
													<br />
													<input name="pp" type="radio" value="1-2" />1-2
													<br />
													<input type="radio" name="pp" value="0" />Less
												</span>
											</td>
										<tr/>
										
										<tr>
											<td align="left">2.		Which airport are you using most?</td>
											<td>
												<select name="aeroport" id="lst_aeroport"  class="input120" width="120">
													<option>Choose one of the following...</option>
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
											<td align="left">3.		Give your top travel destinations... </td>
											<td>
												<textarea name="comm_dest" id="comm_dest" rows=1 cols=30></textarea>
											</td>
										</tr>
										
										<tr>
											<td align="left">4.		For which reasons do you travel ?</td>
											<td>
												<input name="ra_perso" id="ra_perso" type="checkbox"/>Personal
												<input name="ra_pro" id="ra_pro" type="checkbox"/>Professional
											</td>
										<tr/>
										
									</table>
								
								<br/>
							
								</center>
								
							</div>
							
							<div id="div_2">
								<center>
								
									<p>
										<u>Alsace Navette on Internet</u>
									</p>
									<p>5.	How have you find out about our company ?</p>
									
									<table>
									
										<tr>
											<td>							
												<input name="connaissance_internet" id="connaissance_internet" type="checkbox"/> Internet
											</td>
											<td>&nbsp;</td>
										</tr>
										
										<tr>
											<td>
												<input name="connaissance_lien" id="connaissance_lien" type="checkbox"/> Direct link
											</td>
											<td>&nbsp;</td>
										</tr>
										
										<tr>
											<td>
												<input name="connaissance_moteur" id="connaissance_moteur" type="checkbox"/> Search Engine
											</td>
											<td>
												<textarea name="connaissance_moteur_txt" id="connaissance_moteur_txt" style="display:none" rows=1 cols=35></textarea>
											</td>
										</tr>
										
										<tr>
											<td>
												<input name="connaissance_reseau" id="connaissance_reseau" type="checkbox"/> Social Network<br />
											</td>
											<td>
												<select name="connaissance_reseau_lst" id="connaissance_reseau_lst" style="display:none" class="input120" width="120">
													<option value="0">Please choose one of the following ...</option>
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
												<input name="connaissance_presse" id="connaissance_presse" type="checkbox" /> Newspaper<br />
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
												<input name="connaissance_autre" id="connaissance_autre" type="checkbox" /> Other :
											</td>
											<td>
												<input name="connaissance_autre_txt" id="connaissance_autre_txt" style="display:none" type="text" class="custom_input" size="20" maxlength="30" />
											<td/>
										<tr/>
										
									</table>
									
									<p>6.	Have you easily find our website ?</p>
									
									<input name="trouve_facilement" value="1" type="radio" />Yes<br />
									<table>
								
										<tr>
											<td>
												<input name="trouve_facilement" value="0" type="radio"/>No<br />
											</td>
										</tr>
										<tr style="display:none" id="trouve_facilement_txt2">
											<td>
												Precise :
												<textarea name="trouve_facilement_txt" id="trouve_facilement_txt" rows=1 cols=35></textarea>
											</td>
										</tr>
									</table>
								
								</center>
								
							</div>
							
							<div id="div_3">
								
								<center>
							
									<p>
										<u>You, our customers</u>
									</p>
									
									<p>7.	In the last 12 months have you used...</p>
									
									<table>
										<tr>
											<td align="left" width="40%">Airport Service :</td>
											<td align="center" width="30%">
												<input name="utilise_aeroport" type="radio" value="1" />Oui
											</td>
											<td align="center" width="30%">
												<input name="utilise_aeroport" type="radio" value="0"/>Non
											</td>
										</tr>
										<tr>
											<td align="left">Tourism Service :</td>
											<td align="center">
												<input name="utilise_tourisme" type="radio" value="1"/>Oui 
											</td>
											<td align="center">
												<input name="utilise_tourisme" type="radio" value="0"/>Non 
											</td>
										</tr>
										<tr>
											<td align="left">Let yourself be driven :</td>
											<td align="center">
												<input name="utilise_lvc" type="radio" value="1"/>Oui 
											</td>
											<td align="center">
												<input name="utilise_lvc" type="radio" value="0"/>Non 
											</td>
										</tr>
									</table>

									<p>8.	Would you like to try another service of  Alsace Navette ? </p>
									
									<table>
										<tr>
											<td>
												<input name="va_utiliser" value="1" type="radio"/>Yes 
											</td>
											<td id="va_utiliser_td" style="display:none">
												<input name="va_utiliser_aeroport" id="va_utiliser_aeroport" type="checkbox"/> « Airport Service »<br />
												<input name="va_utiliser_tourisme" id="va_utiliser_tourisme" type="checkbox"/> « Tourism Service »<br />
												<input name="va_utiliser_lvc" id="va_utiliser_lvc" type="checkbox"/> « Let yourself be driven »<br />
											</td>
										</tr>
										<tr>
											<td>
												<input name="va_utiliser" value="0" type="radio"/>No 
											</td>
										</tr>
									</table>
									
									<p>9.	Which other service would you like the Alsace Navette propose you ?</p>
									
									<textarea name="comm_nouveau_service" id="comm_nouveau_service" rows=1 cols=30></textarea>

								</center>
								
							</div>
							
							
							<div id="div_4">
							
								<center>
									<p>
										<u>10.	Your satisfaction for our services</u>
									</p>
									
									<p>What is your level of satisfaction of :</p>
										
									<table width="75%"style="padding:25px;border:1px solid black;">
										<tr>
											<td width="70%">&nbsp;</td>
											
											<td width="5%" align="center"><img src="pascontentpascontent.png" alt="Très pas content" /></td>
											<td width="5%" align="center"><img src="pascontent.png" alt="Pas content" /></td>
											<td width="5%" align="center"><img src="neutre.png" alt="Neutre" /></td>
											<td width="5%" align="center"><img src="content.png" alt="Content" /></td>
											<td width="5%" align="center"><img src="contentcontent.png" alt="Très content" /></td>
											<td width="5%" align="center">No opinion</td>
											
										</tr>
										<tr>
											<td>Clarity of informations</td>
											<td style="text-align:center;"><input name="clarte" value="1" type="radio"/></td>
											<td style="text-align:center;"><input name="clarte" value="2" type="radio"/></td>
											<td style="text-align:center;"><input name="clarte" value="3" type="radio"/></td>
											<td style="text-align:center;"><input name="clarte" value="4" type="radio"/></td>
											<td style="text-align:center;"><input name="clarte" value="5" type="radio"/></td>
											<td style="text-align:center;"><input name="clarte" value="0" type="radio"/></td>
										</tr>
										<tr>
											<td>Ergonomy of the website</td>
											<td style="text-align:center;"><input name="ergo" value="1" type="radio"/></td>
											<td style="text-align:center;"><input name="ergo" value="2" type="radio"/></td>
											<td style="text-align:center;"><input name="ergo" value="3" type="radio"/></td>
											<td style="text-align:center;"><input name="ergo" value="4" type="radio"/></td>
											<td style="text-align:center;"><input name="ergo" value="5" type="radio"/></td>
											<td style="text-align:center;"><input name="ergo" value="0" type="radio"/></td>
										</tr>
										<tr>
											<td>Ease of booking and payment</td>
											<td style="text-align:center;"><input name="facilite" value="1" type="radio"/></td>
											<td style="text-align:center;"><input name="facilite" value="2" type="radio"/></td>
											<td style="text-align:center;"><input name="facilite" value="3" type="radio"/></td>
											<td style="text-align:center;"><input name="facilite" value="4" type="radio"/></td>
											<td style="text-align:center;"><input name="facilite" value="5" type="radio"/></td>
											<td style="text-align:center;"><input name="facilite" value="0" type="radio"/></td>
										</tr>
										<tr>
											<td>The quality of workers</td>
											<td style="text-align:center;"><input name="qualite_accueil" value="1" type="radio"/></td>
											<td style="text-align:center;"><input name="qualite_accueil" value="2" type="radio"/></td>
											<td style="text-align:center;"><input name="qualite_accueil" value="3" type="radio"/></td>
											<td style="text-align:center;"><input name="qualite_accueil" value="4" type="radio"/></td>
											<td style="text-align:center;"><input name="qualite_accueil" value="5" type="radio"/></td>
											<td style="text-align:center;"><input name="qualite_accueil" value="0" type="radio"/></td>
										</tr>
										<tr>
											<td>The quality of drivers</td>
											<td style="text-align:center;"><input name="qualite_chauffeur" value="1" type="radio"/></td>
											<td style="text-align:center;"><input name="qualite_chauffeur" value="2" type="radio"/></td>
											<td style="text-align:center;"><input name="qualite_chauffeur" value="3" type="radio"/></td>
											<td style="text-align:center;"><input name="qualite_chauffeur" value="4" type="radio"/></td>
											<td style="text-align:center;"><input name="qualite_chauffeur" value="5" type="radio"/></td>
											<td style="text-align:center;"><input name="qualite_chauffeur" value="0" type="radio"/></td>
										</tr>
										<tr>
											<td>The quality of our services</td>
											<td style="text-align:center;"><input name="qualite_transport" value="1" type="radio"/></td>
											<td style="text-align:center;"><input name="qualite_transport" value="2" type="radio"/></td>
											<td style="text-align:center;"><input name="qualite_transport" value="3" type="radio"/></td>
											<td style="text-align:center;"><input name="qualite_transport" value="4" type="radio"/></td>
											<td style="text-align:center;"><input name="qualite_transport" value="5" type="radio"/></td>
											<td style="text-align:center;"><input name="qualite_transport" value="0" type="radio"/></td>
										</tr>
										<tr>
											<td>QThe price considering the quality</td>
											<td style="text-align:center;"><input name="qualite_prix" value="1" type="radio"/></td>
											<td style="text-align:center;"><input name="qualite_prix" value="2" type="radio"/></td>
											<td style="text-align:center;"><input name="qualite_prix" value="3" type="radio"/></td>
											<td style="text-align:center;"><input name="qualite_prix" value="4" type="radio"/></td>
											<td style="text-align:center;"><input name="qualite_prix" value="5" type="radio"/></td>
											<td style="text-align:center;"><input name="qualite_prix" value="0" type="radio"/></td>
											
										</tr>
										<tr>
											<td>Your global satisfaction level</td>
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
										<u>11.	Open questions</u>
									</p>
									
									<table width=50%>
										<tr>
											<td>Are you ready to recommand us</td>
											<td valign="top">Yes</td>
											<td valign="top">No</td>
											<td valign="top">&nbsp;&nbsp;?</td>
										</tr>
										<tr>
											<td>to your friends ?<b/></td>
											<td><span><input name="recommendation" value="1" type="radio"/></span></td>
											<td><span><input name="recommendation" value="0" type="radio"/></span></td>
											<td><span><input name="recommendation" value="2" type="radio"/></span></td>
										</tr>
									</table>
									
									<p>
										<u>12.	Your comments and suggestions</u>
									</p>
									
									<table>
										<tr>
											<td>Comments</td>
											<td>Suggestions of amelioration</td>
										</tr>
										<tr>
											<td><textarea name="commentaire_site" id="commentaire_site" rows=5 cols=30>Comments...</textarea></td>
											<td><textarea name="suggestion_site" id="suggestion_site" rows=5 cols=30>Suggestions...</textarea></td>
										</tr>
									</table>
									
									<p>We are grateful for your collaboration and trust!</p>
									
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