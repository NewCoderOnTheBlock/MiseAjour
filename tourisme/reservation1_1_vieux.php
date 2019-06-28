<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Tourisme Alsace :: Reservation</title>
<meta name="Category" content="Tourisme, Voyage, Alsace, Loisirs" />
<meta name="Language" content="fr" />
<meta name="Keywords" content="navette, navettes, taxi navette, navette gare, navettes gare, tarif navette, tarifs navette, horaire navette, horaires navettes, navette bus, navette strasbourg, navettes strasbourg, location navette,navette gare aeroport, navette gare aéroport, horaires navette aéroport, horaires navette aeroport, taxi navette aeroport, tarif navette aeroport, tarif navette aéroport, navette aeroport bale mulhouse, navette bus aéroport, aeroport, aéroport, aeroport de, gare routière,transport, tarif, alsace, tourisme alsace, location alsace, region alsace, strasbourg alsace, viste, visiter,visite ville, visite alsace, visite strasbourg, visite musée, visite musee, visite à, voyage visite, visite tourisme, taxi aeroport, taxi aéroport,  archeologie, art, modern, contemporain, estampe,dessin, histoire, historique, notre-dame, zoologique, electropolis, optique, jouet, train, textil, taxi, visite,trajet, village, vosge, baroque, gastronomie, route des vins, ebersmunter, kochersberg, bien etre, cuisine, spa, nature, detente, cueillette, thermes, vin, patrimoine, barr, couronne d'or, zen, beaute, bio, noel, geispolsheim, gertwiller, cite medievale, brasserie, tarte flambée, choucroute, ferme, Soufflenheim, Drusenheim, Gambsheim, cave " />
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
<!-- Récuperation données page précédente -->
<?php
// On commence par récupérer les champs de la page précédente de la réservation
		$circuit=$_POST['typeTrajet']; 
		
		$jour_depart=$_POST['date']; // jour de départ
		$jour = substr($jour_depart, 0, 2);
		
		$nb_personnes = $_POST['nb_personnes'];// nombre de personnes pour la réservation
		$demande_particuliere = $_POST['demande']; // demande particulière 
		
		$civilite = $_POST['civilite'];
		
		$nom = $_POST['nom'];
		$prenom = $_POST['prenom'];
		
		$n_voie = $_POST['n_voie'];
		$type_voie = $_POST['type_voie'];
		$nom_voie = $_POST['nom_voie'];
		$code_postal = $_POST['code_postal'];
		$ville = $_POST['ville'];
		$adresse_complet = $n_voie." ".$type_voie." ".$nom_voie;
		$nb_enfant = $_POST['nb_enfant'];
		$pays = $_POST['pays'];
		$pt_dep = $_POST['pt_dep'];
		
		$e_mail=$_POST['e_mail'];
		
		$telephone = $_POST['telephone'];
		$portable = $_POST['portable'];
		$cir_q = $_POST['questioncircuit'];
		
		if ( ($circuit=="La Basse ALSACE (Départ 10h)") ||  ($circuit=="Le Long du Rhin") || ($circuit=="Au pays du KOCHERSGERG") || ($circuit=="Cueillette et thermes") || ($circuit=="Découverte du Haut Rhin") || ($circuit=="La cuisine Bio") )
		{
			$h_dep = "10H";
		}
		else if ($circuit=="La Basse ALSACE (Départ 15h)")
		{
			$h_dep = "15H";
		}
		else if ($circuit=="Cueillette et thermes")
		{
			$h_dep = "13H30";
		}
		else if ($circuit=="Cuisine et Spa")
		{
			$h_dep = "9H15";
		}
		else if (($circuit=="Vins et patrimoine") || ($circuit=="De Barr à la Couronne d'Or"))
		{
			$h_dep = "11H00";
		}
		else if ($circuit=="Zen et beauté") 
		{
			$h_dep = "9H30";
		}
		else if ($circuit=="Le bioscope") 
		{
			$h_dep = "9H00";
		}
		else if (($circuit=="Au pays des Mystères de Noel") || ($circuit=="Au pays du Sapin de Noel") || ($circuit=="Au Pays des Etoiles de Noel"))
		{
			$h_dep = "13H";
		}
		
		if ( ($circuit=="La Basse ALSACE (Départ 10h)") || ($circuit=="Au pays des Mystères de Noel") || ($circuit=="Au pays du Sapin de Noel") || ($circuit=="Au Pays des Etoiles de Noel") || ($circuit=="Le Long du Rhin") || ($circuit=="Au pays du KOCHERSGERG") || ($circuit=="Nature et détente") || ($circuit=="Cueillette et thermes") || ($circuit=="Cuisine et Spa")  || ($circuit=="Vins et patrimoine") || ($circuit=="De Barr à la Couronne d'Or") || ($circuit=="Découverte du Haut Rhin") || ($circuit=="Zen et beauté") || ($circuit=="La cuisine Bio") || ($circuit=="Le bioscope" ))
		{ 
			if ( ($jour==8) || ($jour==15) || ($jour==22) || ($jour==5) || ($jour==12) || ($jour==19) ) 
			{
				$prix=39;
			}
			else if ( ($jour==9) || ($jour==16) || ($jour==23) )
			{
				$prix=39;
			}
			else
			{
				$prix=39;
			}
		}
		
		if ($circuit=="La Basse ALSACE (Départ 15h)")
		{ 
			if ( ($jour==8) || ($jour==9) || ($jour==15) || ($jour==16) || ($jour==22) || ($jour==23) ) 
			{
				$prix=39;
			}
			else if ( ($jour==5) || ($jour==12) || ($jour==19) ) 
			{
				$prix=39;
			}
			else
			{
				$prix=39;
			}
		}
		
		/******
		la date de réservation doit etre :
		 >= date(jour)
		******/
		
function interdireMauvaiseDateDepart($jour_depart)
{
	$mois = substr($jour_depart, 3, 2);
	$jour = substr($jour_depart, 0, 2);
	$jourRef = date("j");
	$moisRef = date("m");

	if( ($mois == $moisRef) && ($jour < $jourRef) )
	{
		$res = true;
	}
	else
	{
		$res = false;
	}	
return($res);
}
$verificationDepart = interdireMauvaiseDateDepart($jour_depart);

/*******************
********************/
		
		
		if($circuit =="") //on regarde si le circuit est bien renseigné
		{
			include("reservation_erreur.php");
			echo("Il faut choisir un circuit"."<br />");	
		}
		
		/* *********   deuxième condition        trajet aller simple                  *******************/
			
		else if( ($jour_depart == "") || ($verificationDepart == true) || ($civilite == "") || ($nom == "") || ($prenom == "") || ($e_mail == "") || (($telephone == "") && ($portable == "")))// on vérifie si toutes les les informations sont renseignées
		{
			include("reservation_erreur.php");
			
			if($verificationDepart == true)
			{
				echo("Vous ne pouvez pas réserver un circuit à une date antérieure à celle d'aujourd'hui"."<br />");
			}	
			if($jour_depart == "")
			{
				echo("vous avez oublié de renseigner la date du circuit"."<br />");
			}
			if($civilite == "")
			{
				echo("vous avez oublié de renseigner votre civilité"."<br />");
			}
			if($nom == "")
			{
				echo("vous avez oublié de renseigner votre nom"."<br />");
			}
			if($prenom =="")
			{
				echo("vous avez oublié de renseigner votre prénom"."<br />");
			}
			if($e_mail=="")
			{
				echo("vous avez oublié de renseigner votre e-mail"."<br />");
			}
			if($telephone =="" && $portable=="")
			{
				echo("vous avez oublié de renseigner votre téléphone ou votre portable"."<br />");
			}
			if($pays=="")
			{
				echo("vous avez oublié de renseigner votre pays"."<br />");
			}
		}
		else
		{
		
		?>
		
		<!-- //Recuperation données page précédente -->
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
		<div id="corps_page_contenu"> <!-- contenu de la page, changeable -->		
		<!--               ///////////////////////////////////////////////////////////contenu -->
		
								<div id="special_reservation_1">
											<font size="4">Récapitulatif de votre réservation</font><BR/>

											<FONT face=Arial size=3>Nous vous confirmerons votre demande par e-mail .<br /></font><br />

											
											<!-- <span class = "recap_reservation_total">--><u>RESERVATION:</u><br />
											<!--<span class = "coordonnees_recap">--><?php
											echo $civilite." ".$nom." ". $prenom."<br />";
											echo $e_mail."<br />"."<br />";
											
											?><!--</span>-->
											
										    <b><u>Circuit :</u></b>&nbsp <?php echo $circuit."<br />"; ?>
											<br />
											<strong>Départ de <?php echo $pt_dep; ?> :</strong> le <?php echo $jour_depart?> à <?php echo $h_dep."<br />"; ?><br>
											<strong>Nombre de personnes :</strong> <?php echo $nb_personnes."<br />"; ?>
											<strong>Dont enfants: :</strong> <?php echo $nb_enfant."<br />"; ?>
											<strong><br />
											Prix par personne :</strong> <?php echo $prix ."<br />"; ?><br>
											<strong>Prix total:</strong> 
											<?php 	
														$sup = 10;

														if ($pt_dep=="Domicile")
														{
															$prixtot=$prix*$nb_personnes;
															$prixtot+=$sup ;
															echo $prixtot ;
														}
														else
														{
															$prixtot=$prix*$nb_personnes;
															echo $prixtot ;
														}
														?>
											<!--Tarif à payer :--> 
											
											<form method="post" action="reservation1_2.php" name ="formulaire2">
											
												  <p align="center"><input type="submit" value="Valider" /></p>
											
												<input type = "hidden" name = "typeTrajet" value="<?=$circuit?>">
												<input type = "hidden" name = "jour_depart" value="<?=$jour_depart?>">
												<input type = "hidden" name = "heure_depart" value="<?=$h_dep?>">
												<input type = "hidden" name = "nb_personnes" value="<?=$nb_personnes?>">
												<input type = "hidden" name = "nb_enfant" value="<?=$nb_enfant?>">
												<input type = "hidden" name = "demande_particuliere" value="<?=$demande_particuliere?>">
												<input type = "hidden" name = "civilite" value="<?=$civilite?>">
												<input type = "hidden" name = "nom" value="<?=$nom?>">
												<input type = "hidden" name = "prenom" value="<?=$prenom?>">
												<input type = "hidden" name = "n_voie" value="<?=$n_voie?>">
												<input type = "hidden" name = "type_voie" value="<?=$type_voie?>">
												<input type = "hidden" name = "nom_voie" value="<?=$nom_voie?>">
												<input type = "hidden" name = "code_postal" value="<?=$code_postal?>">
												<input type = "hidden" name = "pt_dep" value="<?=$pt_dep?>">
												<input type = "hidden" name = "ville" value="<?=$ville?>">
												<input type = "hidden" name = "pays" value="<?=$pays?>">
												<input type = "hidden" name = "e_mail" value="<?=$e_mail?>">
												<input type = "hidden" name = "telephone" value="<?=$telephone?>">
												<input type = "hidden" name = "portable" value="<?=$portable?>">
												<input type = "hidden" name = "prix" value="<?=$prix?>">
												<input type = "hidden" name = "prixtot" value="<?=$prixtot?>">
												<input type="hidden" name="questioncircuit" value="<?=$cir_q?>">
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
			
		</div><div id="partenaires_footer">		
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
<?php
		}
		?>
</html>
