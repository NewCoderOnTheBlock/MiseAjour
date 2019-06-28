<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Tourisme Alsace :: Reservation</title>
<meta name="Category" content="Tourisme, Voyage, Alsace, Loisirs" />
<meta name="Language" content="fr" />
<meta name="Keywords" content="navette, navettes, taxi navette, navette gare, navettes gare, tarif navette, tarifs navette, horaire navette, horaires navettes, navette bus, navette strasbourg, navettes strasbourg, location navette,navette gare aeroport, navette gare a�roport, horaires navette a�roport, horaires navette aeroport, taxi navette aeroport, tarif navette aeroport, tarif navette a�roport, navette aeroport bale mulhouse, navette bus a�roport, aeroport, a�roport, aeroport de, gare routi�re,transport, tarif, alsace, tourisme alsace, location alsace, region alsace, strasbourg alsace, viste, visiter,visite ville, visite alsace, visite strasbourg, visite mus�e, visite musee, visite �, voyage visite, visite tourisme, taxi aeroport, taxi a�roport,  archeologie, art, modern, contemporain, estampe,dessin, histoire, historique, notre-dame, zoologique, electropolis, optique, jouet, train, textil, taxi, visite,trajet, village, vosge, baroque, gastronomie, route des vins, ebersmunter, kochersberg, bien etre, cuisine, spa, nature, detente, cueillette, thermes, vin, patrimoine, barr, couronne d'or, zen, beaute, bio, noel, geispolsheim, gertwiller, cite medievale, brasserie, tarte flamb�e, choucroute, ferme, Soufflenheim, Drusenheim, Gambsheim, cave " />
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
//--><!-- /menu horizontal -->

<!-- cacher boutons -->
function afficher(reservation)
{
	document.getElementById(reservation).style.visibility = "";
}
function cacher(reservation)
{
	document.getElementById(reservation).style.visibility = "hidden";
}

/* script cacher ou montrer div */
function divaffiche(){ document.getElementById("popup").style.display = "block"; document.getElementById("cache").style.display = "inline"; document.getElementById("voir").style.display = "none"; } function divcache(){ document.getElementById("popup").style.display = "none"; document.getElementById("cache").style.display = "none"; document.getElementById("voir").style.display = "inline"; } 
</script>


</head>

<body>

 

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
				  <div id="popup" style=" overflow:auto;display:none;height:auto; width:auto;border:1px solid #CCCCCC;background-color:#F9F9F9;top:232px; left:150px; z-index:10000; position:absolute; padding:15px"><a href="javascript:divcache()" style="color:#CC0000">Fermer</a><br /><br />
<br />
Periode 1 : Semaine<br />
Periode 2 : Mercredi et Weekend<br />
Periode 3 : Jours de f�te
</div>
				<b style="padding-left:59px;">Rappel :: Tarifs des circuits</b>
				<table height="30" width="600" border="1" bordercolor="#999999"  style="margin-left:59px;"  class = "tab_tarif" bgcolor="#FFFFFF">
					<thead> <!-- En-t�te du tableau -->
						<tr>      
							<th width="18%" height="15" class = "tab_col"><div align="left">Tarifs</div></th>
							<th width="18%" class = "tab_col"><div align="center">Periode 1</div></th>
							<th width="18%" class = "tab_col"><div align="center">Periode 2</div></th>
							<th width="18%" class = "tab_col"><div align="center">Periode 3</div></th>
					    </tr>
					</thead>

					<tbody> <!-- Corps du tableau -->
						<tr>
							<td height="15" width="100" class = "tab_donnees"><strong style="font-size:10px;">Tous circuits* </strong></td>
							<td class = "tab_donnees"><div align="center"><font color="#86D66B">39�</font></div></td>
							<td class = "tab_donnees"><div align="center"><font color="#F8B434">43�</font></div></td>
							<td class="tab_donnees"><div align="center"><font color="#FF5151">47�</font></div></td>
							<td class="tab_donnees" width="28%"><div align="center"><input type="button" border="0" id="affiche" value="Voir les correspondances des periodes" onClick="divaffiche()" style="display:inline; float:right;"/></div></td>
					    </tr>

					</tbody> 
				</table>
				<b style="padding-left:59px;">*Hors repas et activit�s</b>

				<div id="special_reservation"> <!-- Texte � gauche -->

		
				<table class="ds_box" cellpadding="0" cellspacing="0" id="ds_conclass" style="display: none;">
										<tr><td id="ds_calclass"></td></tr>
			  </table>
									
				<form method="post" action= "reservation1_1.php" name ="formulaire">
												 <fieldset class="field" style="height:730px; float:left; width:350px; padding:10px; margin:10px;">
														  <legend>Client</legend>										
													      <label><br />
														 	 Civilit� <font color = "red">*</font>:<br />
														  </label>
														  <input type="radio" name="civilite" value="M." />M.
														  <input type="radio" name="civilite" value="Mlle" />Mlle
														  <input type="radio" name="civilite" value="Mme" />Mme
														  <br>
														  <label>Nom <font color = "red">*</font> :<br />
														  </label>
														  <input class = "input_res2" type="text" name="nom" size="30" />
													      <label><br />
														  Pr�nom  <font color = "red">*</font>:<br />
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
			   											  
														  <label><br />
														  Ville <font color = "red">*</font> :<br />
														  </label>
														  <input class = "input_res2" type="text" name="ville" size="30" />
														  <br />
			   											  
														  <label>Pays <font color = "red">*</font> : </label><br />
												    <select name="pays">
														<option value = ""></option>
														<?php
														// on se connecte � MySQL
														$db = mysql_connect('db922.1and1.fr', 'dbo206617947', 'D5ZEtV4h');
														//$db = mysql_connect('localhost', 'root', '');

													    // on s�lectionne la base
														mysql_select_db('db206617947',$db);
														//mysql_select_db('navette',$db);

														// on cr�e la requ�te SQL
														$sql = 'SELECT nom FROM pays';

														// on envoie la requ�te
														$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());

														// on fait une boucle qui va faire un tour pour chaque enregistrement
														while($data = mysql_fetch_assoc($req))
														    { ?>
															<option value = "<?php														
															echo $data['nom'];?>">
															<?php
															echo $data['nom'];
															}
															?></option>
															<?php

														// on ferme la connexion � mysql

														mysql_close();
														?> 

												    </select>
												    <br />
												    <br />
													<label>Point de d�part souhait� (suppl�ment de 10� si 'Autre')<font color = "red">*</font>  :<br />
											     </label><br />
														<input type="radio" name="pt_dep" value="Gare" onChange='testerRadio(this.form.pt_dep)' onClick='cacher("reservation");'/>
																	Gare
												 		<input type="radio" name="pt_dep" value="Autre" onChange='testerRadio(this.form.pt_dep)' onClick='afficher("reservation");'/>
																	Autre (Domicile,hotel,entreprise,..)
												   					 <br />

													<br />
													<br />
														  <div id="reservation">
														  <label>N� voie  :<br />
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
															
														  </div>
														  <br>
														  <label>Par quel biais connaissez-vous alsace-navette tourisme ?</label><br />
														  <textarea name="cir_q"></textarea>
														  
														  
				  </fieldset>
													
														<fieldset id="choix_navette" style="height:730px; float:right; width:270px; padding:10px; margin:10px;">
															<legend>Circuit</legend>
															<br />
												
															<label>Choix du circuit <font color = "red">*</font> : </label>
												
															<div class ="type_trajet">
												
															  <p><strong>Gastronomie<br />
																</strong>
																  <input type="radio" name="typeTrajet" value="La Basse ALSACE (D�part 10h)" onChange='testerRadio(this.form.typeTrajet)'/>
																	La Basse ALSACE(D�part 10h)
												   					 <br />
												   				  <input type="radio" name="typeTrajet" value="La Basse ALSACE (D�part 15h)" onchange='testerRadio(this.form.typeTrajet)'/>
																	La Basse ALSACE(D�part 15h) <br>
																  <input type="radio" name="typeTrajet" value="Le Long du Rhin" onChange='testerRadio(this.form.typeTrajet)'/>
																	Le Long du Rhin <br />
																  <input type="radio" name="typeTrajet" value="Au pays du KOCHERSGERG" onChange='testerRadio(this.form.typeTrajet)'/>
																	Au pays du KOCHERSGERG <br />
																	<strong>Bien-�tre</strong>													<br>
																  <input type="radio" name="typeTrajet" value="Nature et d�tente" onChange='testerRadio(this.form.typeTrajet)'/>
                                                    				Nature et d�tente <br>
                                                    			  <input type="radio" name="typeTrajet" value="Cueillette et thermes" onChange='testerRadio(this.form.typeTrajet)'/>
																	Cueillette et thermes <br />
																  <input type="radio" name="typeTrajet" value="Cuisine et Spa" onChange='testerRadio(this.form.typeTrajet)'/>
																	Cuisine et Spa <br />
                                                    				<strong>Route des Vins</strong> <br>
                                                    			  <input type="radio" name="typeTrajet" value="Vins et patrimoine" onChange='testerRadio(this.form.typeTrajet)'/>
                                                    				Vins et patrimoine <br />
                                                    			  <input type="radio" name="typeTrajet" value="De Barr � la Couronne d'Or" onChange='testerRadio(this.form.typeTrajet)'/>
                                                    				De Barr � la Couronne d'Or <br />
																  <input type="radio" name="typeTrajet" value="D�couverte du Haut Rhin" onChange='testerRadio(this.form.typeTrajet)'/>
                                                    				D�couverte du Haut Rhin <br />
																<strong>D�couverte Bio</strong> <br>
                                                    			  <input type="radio" name="typeTrajet" value="Zen et beaut�" onChange='testerRadio(this.form.typeTrajet)'/>
                                                    				Zen et beaut� <br />
                                                    			  <input type="radio" name="typeTrajet" value="La cuisine Bio" onChange='testerRadio(this.form.typeTrajet)'/>
                                                    				La cuisine Bio <br />
																  <input type="radio" name="typeTrajet" value="Le bioscope" onChange='testerRadio(this.form.typeTrajet)'/>
                                                    				Le bioscope<br />
																	<strong>No�l en Alsace</strong> <br>
                                                    			  <input type="radio" name="typeTrajet" value="Au pays des Myst�res de Noel" onChange='testerRadio(this.form.typeTrajet)'/>
                                                    				Au pays des Myst�res de No�l <br />
                                                    			  <input type="radio" name="typeTrajet" value="Au pays du Sapin de Noel" onChange='testerRadio(this.form.typeTrajet)'/>
                                                    				Au pays du Sapin de No�l <br />
																  <input type="radio" name="typeTrajet" value="Au Pays des Etoiles de Noel" onChange='testerRadio(this.form.typeTrajet)'/>
                                                    				Au pays des Etoiles de No�l<br />
															  </p>
															</div>
												 
												
															<p>
												  				<label>Date<font color = "red">*</font>:</label>
												  				<br />
											    				<input class = "date" onclick="ds_sh(this);" name="date" readonly="readonly" style="cursor: text" />
														</p>
																<p>
																<label>Nombre personnes: <br />
adultes <font color = "red">*</font> : </label>
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
																</select><br />
																<label>Enfants (-12ans) :</label>
																<select name="nb_enfant">
																	<option>0</option>
																	<option>1</option>
																	<option>2</option>
																	<option>3</option>
																	<option>4</option>
																	<option>5</option>
																	<option>6</option>
																	<option>7</option>
																	<option>8</option>
														  		</select>
																</p>
														
																<p>     
																<label style="text-align:left">Demande particuli�re:(si�ge enfant,..)</label>
												
																<br />
																<textarea class = "demande" name="demande" rows="3" cols="25"></textarea>
																</p>
												
													
																<p id="buttons">&nbsp;												 			
																
																  <input type="submit" value="Valider" />
																  <input type="reset" value="Effacer" />
													    </p>
														<br />
															<font color = "red">*</font> Champs obligatoire
															<br />
															<font color = "red">**</font> Un des deux champs doit �tre renseign�
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
		  &copy;Alsace-Navette.com	- <a href="mentions.php">Mentions l�gales</a> - <a href="contact.php">Contact</a> - <a href="conditions.php">Conditions de vente</a>	</div>
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
    
    <script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-7305006-1");
pageTracker._trackPageview();
} catch(err) {}</script>


</body>
</html>
