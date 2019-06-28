<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Tourisme Alsace :: Reservation</title>
<meta name="Category" content="Tourisme, Voyage, Alsace, Loisirs" />
<meta name="Language" content="fr" />
<meta name="Keywords" content="tourisme , voyage, alsace , navette , alsace-navette , tourisme.alsace-navette , minibus , musée , circuit , circuit touristique , transport, transport collectif , transport personne , véhicule , visiter , visites , poterie, chocolat, pain d'épice, rhin ,kochersberg , obernai, sélestat, andlau, betschdorf, soufflenheim, kaysersberg, bergheim, haguenau, village " />
<meta name="Robots" content="all" />
<meta name="Revisit-After" content="15 days" />	
<link href="styles/tourisme.css" rel="stylesheet" type="text/css" />
<link href="styles/calendrier.css" rel="stylesheet" type="text/css" />
<!-- menu horizontal -->
<script type="text/javascript">
<!--
window.onload=montre;
function montre(id) {
var d = document.getElementById(id);
	for (var i = 1; i<=10; i++) {
		if (document.getElementById('smenu'+i)) {document.getElementById('smenu'+i).style.display='none';}
	}
if (d) {d.style.display='block';}
}
//-->
</script>
<!-- /menu horizontal -->

</head>

<body>

<!-- phpmyvisites -->

<a href="http://www.phpmyvisites.net/" title="phpMyVisites | Open source web analytics" 
onclick="window.open(this.href);return(false);"><script type="text/javascript">
<!--
var a_vars = Array();
var pagename='';

var phpmyvisitesSite = 5;
var phpmyvisitesURL = "http://www.alsace-navette.com/phpmv2/phpmyvisites.php";
//-->
</script>
<script language="javascript" src="http://www.alsace-navette.com/phpmv2/phpmyvisites.js" type="text/javascript"></script>
<noscript><p>phpMyVisites | Open source web analytics
<img src="http://www.alsace-navette.com/phpmv2/phpmyvisites.php" alt="Statistics" style="border:0" />
</p></noscript></a>
<!-- /phpmyvisites --> 

	<div id="page">
		<div id="corps_page_haut"> <!-- header page -->	
			<div id="titre_page">
				<h4>Bienvenue sur Alsace-Navette Tourisme !<br />
					Un service Alsace-Navette.</h4><br />
  				R&eacute;servation :: Demande de r&eacute;servation
	  	  </div>		
			<div id="menu">
			
				<?php include('include_body/menu.html') ?>

	 		</div>
			<div id="services">
				<?php include('include_body/services.html') ?>
			</div>
		</div>
		<div id="corps_page_contenu1"> <!-- contenu de la page, changeable -->		
		<!--               ///////////////////////////////////////////////////////////contenu -->
		
				<b style="padding-left:59px;">Rappel :: Tarifs des circuits</b>
				<table height="30" border="1" bordercolor="#999999"  style="margin-left:59px;"  class = "tab_tarif">
					<thead> <!-- En-tête du tableau -->
						<tr>      
							<th width="100" height="15" class = "tab_col"><div align="left">Tarifs</div></th>
							<th width="100" class = "tab_col"><div align="center">Semaine</div></th>
							<th width="100" class = "tab_col"><div align="center">Weekend</div></th>
						</tr>
					</thead>

					<tbody> <!-- Corps du tableau -->
						<tr>
							<td height="15" width="100" class = "tab_donnees"><strong style="font-size:10px;">Tous circuits* </strong></td>
							<td class = "tab_donnees"><div align="center">39€</div></td>
							<td class = "tab_donnees"><div align="center">39€</div></td>
						</tr>
					</tbody> 
				</table>
				<b style="padding-left:59px;">*Hors repas et activités</b>

				<div id="special_reservation"> <!-- Texte à gauche -->

		
				<table class="ds_box" cellpadding="0" cellspacing="0" id="ds_conclass" style="display: none;">
										<tr><td id="ds_calclass"></td></tr>
			  </table>
									
				<form method="post" action= "reservation1_1.php" name ="formulaire">
												 <fieldset class="field" style="height:650px; float:left; width:350px; padding:10px; margin:10px;">
														  <legend>Client</legend>										
													      <label><br />
														 	 Civilité <font color = "red">*</font>:<br />
														  </label>
														  <input type="radio" name="civilite" value="M." />M.
														  <input type="radio" name="civilite" value="Mlle" />Mlle
														  <input type="radio" name="civilite" value="Mme" />Mme
														  <br>
														  <label>Nom <font color = "red">*</font> :<br />
														  </label>
														  <input class = "input_res2" type="text" name="nom" size="30" />
													      <label><br />
														  Prénom  <font color = "red">*</font>:<br />
                                                          </label>
													      <input class = "input_res2" type="text" name="prenom" size="30" />
			   											  <br />
			  											  <br />
			   											  -- Contact ---------------------<br />
			 										      <br>
													   	  <label>Email <font color = "red">*</font> :<br />
													   	  </label>
														  <input class = "input_res2" type="text" name="e_mail" size="30" />
														  <br>
														  <label>Telephone <font color = "red">**</font> :<br />
 														  </label>
													 	  <input class = "input_res2" type="text" name="telephone" size="30" ONFOCUS='this.value=""' value=""/>
													  	  <label><br />
														  Portable <font color = "red">**</font> :<br />
														  </label>
														  <input class = "input_res2" type="text" name="portable" size="30" ONFOCUS='this.value=""' value="" />
			   											  <br />
			   											  <br />
			    										  - Renseignements (facultatif) <br />
			  										      <br>
														  <label>N° voie  :<br />
														  </label>
														  <input class = "input_res2" type="text" name="n_voie" size="30" />
														  <label><br />
														  Type de voie  : </label>
           												  <br />
            											  <select name="type_voie">
																<option value = "rue">rue</option>
																<option value = "boulevard">boulevard</option>
																<option value = "avenue">avenue</option>
					 											<option value = "impasse">impasse</option>
																<option value = "chemin">chemin</option>
																<option value = "route">route</option>
														  </select>
														  <label><br />
														  Nom de voie  : </label>
            											  <br />
            											  <input class = "input_res2" type="text" name="nom_voie" size="30" />
														  <br>
													  	  <label>Code postal  :<br />
														  </label>
														  <input class = "input_res2" type="text" name="code_postal" size="30" />
														  <label><br />
														  Ville  :<br />
														  </label>
														  <input class = "input_res2" type="text" name="ville" size="30" />
														  <br>
												  </fieldset>
													
														<fieldset id="choix_navette" style="height:650px; float:right; width:270px; padding:10px; margin:10px;">
															<legend>Circuit</legend>
															<br />
												
															<label>Choix du circuit <font color = "red">*</font> : </label>
												
															<div class ="type_trajet">
												
															  <p><strong>Entre nature et Cuisine<br />
																</strong>
																  <input type="radio" name="typeTrajet" value="La Basse ALSACE (Départ 10h)" onChange='testerRadio(this.form.typeTrajet)'/>
																	La Basse ALSACE(Départ 10h)
												   					 <br />
												   				  <input type="radio" name="typeTrajet" value="La Basse ALSACE (Départ 15h)" onchange='testerRadio(this.form.typeTrajet)'/>
																	La Basse ALSACE(Départ 15h) <br>
																  <input type="radio" name="typeTrajet" value="Le Long du Rhin" onChange='testerRadio(this.form.typeTrajet)'/>
																	Le Long du Rhin <br />
																  <input type="radio" name="typeTrajet" value="Au pays du KOCHERSGERG" onChange='testerRadio(this.form.typeTrajet)'/>
																	Au pays du KOCHERSBERG <br />
																	<strong>Bien-être</strong>													<br>
																  <input type="radio" name="typeTrajet" value="Nature et Bien-être" onChange='testerRadio(this.form.typeTrajet)'/>
                                                    				Nature et Bien-être <br>
                                                    			  <input type="radio" name="typeTrajet" value="Cueillette à Soultz-Lutzelhouse" onChange='testerRadio(this.form.typeTrajet)'/>
																	Cueillette à Soultz-Lutzelhouse <br />
																  <input type="radio" name="typeTrajet" value="Gastronomie et Bien-être" onChange='testerRadio(this.form.typeTrajet)'/>
																	Gastronomie et Bien-être <br />
                                                    				<strong>Route des Vins</strong> <br>
                                                    			  <input type="radio" name="typeTrajet" value="Aux alentours de Barr" onChange='testerRadio(this.form.typeTrajet)'/>
                                                    				Aux alentours de Barr <br />
                                                    			  <input type="radio" name="typeTrajet" value="Tour des Domaines Vinicoles" onChange='testerRadio(this.form.typeTrajet)'/>
                                                    				Tour des Domaines Vinicoles <br />
																<strong>Découverte Bio</strong> <br>
                                                    			  <input type="radio" name="typeTrajet" value="Detente et Bien-être" onChange='testerRadio(this.form.typeTrajet)'/>
                                                    				Détente et Bien-être <br />
                                                    			  <input type="radio" name="typeTrajet" value="Tour des Domaines Vinicoles" onChange='testerRadio(this.form.typeTrajet)'/>
                                                    				Gastronomique <br />
																  <input type="radio" name="typeTrajet" value="Au bioscope" onChange='testerRadio(this.form.typeTrajet)'/>
                                                    				Au bioscope<br />
																	<strong>Noël en Alsace</strong> <br>
                                                    			  <input type="radio" name="typeTrajet" value="Au pays des Mystères de Noël" onChange='testerRadio(this.form.typeTrajet)'/>
                                                    				Au pays des Mystères de Noël <br />
                                                    			  <input type="radio" name="typeTrajet" value="Au Pays du Sapin de Noel" onChange='testerRadio(this.form.typeTrajet)'/>
                                                    				Au pays du Sapin de Noël <br />
																  <input type="radio" name="typeTrajet" value="Au Pays des Etoiles de Noel" onChange='testerRadio(this.form.typeTrajet)'/>
                                                    				Au Pays des Etoiles de Noel<br />
															  </p>
															</div>
												 
												
															<p>
												  				<label>Date<font color = "red">*</font>:</label>
												  				<br />
											    				<input class = "date" onclick="ds_sh(this);" name="date" readonly="readonly" style="cursor: text" />
														</p>
																<p>
																<label>Nombre personnes <font color = "red">*</font> : </label>
																<select name="nb_personnes" onClick="f(this.form.h_depart)">
																	<option value = "1">1</option>
																		<?php
																			$nb = 0;
																			$nbplace = 8;
																			$i = 2;
																			while($i <= $nbplace)
																		{
																		?>
																	<option value = "<?php														
																							print("$nb"."$i");?>">
																	<?php
																		print("$i");
																		$i++;
																		}
																		?>
																	</option>
																</select>
																</p>
														
																<p>     
																<label style="text-align:left">Demande particulière:(siège enfant,..)</label>
												
																<br />
																<textarea class = "demande" name="demande" rows="3" cols="25"></textarea>
																</p>
												
													
																<p id="buttons">&nbsp;												 			
																
																  <input type="submit" value="Valider" />
																  <input type="reset" value="Effacer" />
													    </p>
																<script type = "text/javascript" src = "Scripts/calendrier.js"></script>
													  </fieldset>

									</form>
	
				</div>
			 
			<!-- end tete page -->

		<!--               //////////////////////////////////////////////////////fin contennu -->
		</div>
		<div id="corps_page_footer"> 
		  <div align="center">
		  <!-- footer page -->
		  <br />
		  <br />
		  <br />
		  <br />
		  &copy;Alsace-Navette.com	- <a href="mentions.php">Mentions légales</a> - <a href="contact.php">Contact</a> - <a href="conditions.php">Conditions de vente</a>	</div>
		</div>
</div>
	<div id="news">
		<div id="news_haut">
		</div>
<div id="news_contenu">
			<?php include('include_body/news.html'); ?>
		</div>		<div id="news_footer">		
		</div>
	</div>
	<div id="partenaires">
		<div id="partenaires_haut">
		</div>
		<div id="partenaires_contenu">
		<!-- ////////////partenaires -->
		
				<?php include('include_body/partenaires.html') ?>	
		
		<!-- ////////////partenaires end -->
			
		</div>	<div id="partenaires_footer">		
			</div>
	</div>
</body>
</html>
