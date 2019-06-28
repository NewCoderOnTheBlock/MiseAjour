<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Tourisme Alsace :: Parcours Noel en Alsace</title>
<meta name="Category" content="Tourisme, Voyage, Alsace, Loisirs" />
<meta name="Language" content="fr" />
<meta name="Keywords" content="navette, navettes, taxi navette, navette gare, navettes gare, tarif navette, tarifs navette, horaire navette, horaires navettes, navette bus, navette strasbourg, navettes strasbourg, location navette,navette gare aeroport, navette gare a�roport, horaires navette a�roport, horaires navette aeroport, taxi navette aeroport, tarif navette aeroport, tarif navette a�roport, navette aeroport bale mulhouse, navette bus a�roport, aeroport, a�roport, aeroport de, gare routi�re,transport, tarif, alsace, tourisme alsace, location alsace, region alsace, strasbourg alsace, viste, visiter,visite ville, visite alsace, visite strasbourg, visite mus�e, visite musee, visite �, voyage visite, visite tourisme, taxi aeroport, taxi a�roport,  archeologie, art, modern, contemporain, estampe,dessin, histoire, historique, notre-dame, zoologique, electropolis, optique, jouet, train, textil, taxi, visite,trajet, village, vosge, baroque, gastronomie, route des vins, ebersmunter, kochersberg, bien etre, cuisine, spa, nature, detente, cueillette, thermes, vin, patrimoine, barr, couronne d'or, zen, beaute, bio, noel, geispolsheim, gertwiller, cite medievale, brasserie, tarte flamb�e, choucroute, ferme, Soufflenheim, Drusenheim, Gambsheim, cave " />
<meta name="Robots" content="all" />
<meta name="Revisit-After" content="15 days" />	
<link href="styles/tourisme.css" rel="stylesheet" type="text/css" />
<!-- Ouerture image -->
<link rel="stylesheet" href="styles/lightbox.css" type="text/css" media="screen" />
<script type="text/javascript" src="Scripts/prototype.js"></script>
<script type="text/javascript" src="Scripts/scriptaculous.js?load=effects,builder"></script>
<script type="text/javascript" src="Scripts/lightbox.js"></script>
<!-- //Ouerture image -->
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

function MM_CheckFlashVersion(reqVerStr,msg){
  with(navigator){
    var isIE  = (appVersion.indexOf("MSIE") != -1 && userAgent.indexOf("Opera") == -1);
    var isWin = (appVersion.toLowerCase().indexOf("win") != -1);
    if (!isIE || !isWin){  
      var flashVer = -1;
      if (plugins && plugins.length > 0){
        var desc = plugins["Shockwave Flash"] ? plugins["Shockwave Flash"].description : "";
        desc = plugins["Shockwave Flash 2.0"] ? plugins["Shockwave Flash 2.0"].description : desc;
        if (desc == "") flashVer = -1;
        else{
          var descArr = desc.split(" ");
          var tempArrMajor = descArr[2].split(".");
          var verMajor = tempArrMajor[0];
          var tempArrMinor = (descArr[3] != "") ? descArr[3].split("r") : descArr[4].split("r");
          var verMinor = (tempArrMinor[1] > 0) ? tempArrMinor[1] : 0;
          flashVer =  parseFloat(verMajor + "." + verMinor);
        }
      }
      // WebTV has Flash Player 4 or lower -- too low for video
      else if (userAgent.toLowerCase().indexOf("webtv") != -1) flashVer = 4.0;

      var verArr = reqVerStr.split(",");
      var reqVer = parseFloat(verArr[0] + "." + verArr[2]);
  
      if (flashVer < reqVer){
        if (confirm(msg))
          window.location = "http://www.macromedia.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash";
      }
    }
  } 
}
//-->
</script>
<!-- /menu horizontal -->
</head>

<body onload="MM_CheckFlashVersion('7,0,0,0','Le contenu de cette page n&eacute;cessite une version plus r&eacute;cente de Macromedia Flash Player. Voulez-vous le t&eacute;l&eacute;charger maintenant ?');">
<!-- Loading -->
<div id="cache"><table width="400" bgcolor="#ffffff" border="0" cellpadding="2" cellspacing="0"><tr><td valign="middle"><table width="100%" bgcolor="#FFFFFF" border="0" cellpadding="0" cellspacing="0"><tr><td valign="middle"><img style="float:right; vertical-align:middle;" src="images/loading.gif" border="0" height="32" width="32" alt="#"/><font face="Verdana" size="4" color="#000000"><br>Chargement de la page... <br /> Merci de patienter<br><br></font></td>  </tr></table></td>  </tr></table></div>

<script language="javascript">

var nava = (document.layers);
var dom = (document.getElementById);
var iex = (document.all);
if (nava) { cach = document.cache }
else if (dom) { cach = document.getElementById("cache").style }
else if (iex) { cach = cache.style }
largeur = screen.width;
cach.visibility = "visible";

function cacheOff()
	{
	cach.visibility = "hidden";
	}
window.onload = cacheOff
</script> 
<!-- /Loading -->



	<div id="page">
		<div id="corps_page_haut_noel"> <!-- header page -->	
			<div id="titre_page">
				<h4>Bienvenue sur Alsace-Navette Tourisme !<br />
					Un service Alsace-Navette.</h4><br />
  					<a href="noel.php" title="Retour">No�l en Alsace</a> :: Pr�sentation du parcours
	  	  </div>		
			<div id="menu">
			
				<?php include('include_body/menu.html') ?>

	 		</div>
			<div id="services">
				<?php include('include_body/services_noel.html') ?>
			</div>
		</div>
		<div id="corps_page_contenu"> <!-- contenu de la page, changeable -->		
		<!--               ///////////////////////////////////////////////////////////contenu -->
			<div id="corps_texte"> <!-- Texte � gauche -->
		
				<p id="titres_themes"><img src="images/noel.jpg" border="0" /><p>
				 
				
				 <img style="float:left;" width="220" height="176" src="images/voiture.jpg" />                  
				
				<p style="margin-left:230px; padding:2px; border:0px; height:125px"><em><br /> 
		        <br />
			    
			    </em></p>
				<br />
				<br />
				<br />
				<br />
				
                <p align="justify" style="font-size:14px;">No�l en Alsace : laissez-vous s�duire, laissez vous conduire�<br />
<br />
Pour tous ceux qui veulent vivre un No�l hors du commun, c�est en Alsace qu�il faut venir.
Ici la f�erie et la magie de cette f�te sont toujours au rendez-vous !
<br /><br />
Pour vous permettre de d�couvrir ce monde enchant� en toute tranquillit�, en famille ou
entre amis, alsace-navette vous propose 3 � circuits-conduits �.
<br /><br />
Fini le stress et les soucis de la route. Vous n�avez qu�� vous laisser conduire par notre chauffeur et profiter pleinement de votre s�jour de No�l en Alsace.
<br /><br />
Embarquez dans la navette, bouclez la ceinture et... en route pour un voyage initiatique et convivial.<br />
<br />

</p>  
				
			</div> 
			<!-- end tete page -->
		  <div id="corps_planning"> <!-- calque haut droite, pour planing etc -->
			
			<!--	<h2>Circuits:</h2>
				
				
			    <br />
			    <strong>&bull; Au pays des Myst�res de No�l</strong> [<a href="noel1.php" title="Lire l'article">Lire</a>] <br />
			    <a href="img_p_5/noel1.jpg" rel="lightbox[roadtrip]" title="Zoom"><img src="img_p_5/noel1_small.jpg" width="110" height="85" style="float:left;" alt="#" border="0" /></a>
				<p>Ce voyage en � Outre-For�t � commence par la d�couverte de la Ferme ADAM � Wahlenheim�</p>
				<br />
		  		<strong>&bull; Au pays du sapin de No�l</strong>  [<a href="noel2.php" title="Lire l'article">Lire</a>]<br />
		  		<a href="img_p_5/noel2.jpg" rel="lightbox[roadtrip]" title="Zoom"><img src="img_p_5/noel2.jpg" width="110" height="85" style="float:left;" alt="#" border="0" /></a>
				<p>Le voyage commence par la visite du mus�e du Chocolat � Geispolsheim  ou du Pain d'�pice � Gertwiller...</p>
				<br />
		  		<strong>&bull; Au Pays des Etoiles de Noel</strong> [<a href="noel3.php" title="Lire l'article">Lire</a>]<br />
		  		<a href="img_p_5/noel3.jpg" rel="lightbox[roadtrip]" title="Zoom"><img src="img_p_5/noel3_small.jpg" width="110" height="85" style="float:left;" alt="#" border="0" /></a>
				<p>Retrouvez le temps des Cit�s m�di�vales o� f�tes et plaisirs rythmaient les saisons, le long de... </p>
				
			!-->
</div>
			<div id="corps_images"> <!-- calque bas droite,pour images etc -->
			
				<marquee onmouseout="start()" onmouseover="stop()"><!-- defilement images horizontal -->
				<a href="img_p_5/noel4.jpg" rel="lightbox[roadtrip]" title="Zoom"><img src="img_p_5/noel4_small.jpg" border="0" width="110" height="85" alt="#" /></a>
				<a href="img_p_5/noel5.jpg" rel="lightbox[roadtrip]" title="Zoom"><img src="img_p_5/noel5_small.jpg" width="110" height="85" alt="#" border="0" /></a>
				<a href="img_p_5/noel6.jpg" rel="lightbox[roadtrip]" title="Zoom"><img src="img_p_5/noel6_small.jpg" width="110" height="85" alt="#" border="0" /></a>
				<a href="img_p_5/noel7.jpg" rel="lightbox[roadtrip]" title="Zoom"><img src="img_p_5/noel7_small.jpg" width="110" height="85" alt="#" border="0" /></a>
				<a href="img_p_5/noel8.jpg" rel="lightbox[roadtrip]" title="Zoom"><img src="img_p_5/noel8_small.jpg" width="110" height="85" alt="#" border="0" /></a>
				<a href="img_p_5/noel9.jpg" rel="lightbox[roadtrip]" title="Zoom"><img src="img_p_5/noel9_small.jpg" width="110" height="85" alt="#" border="0" /></a>
				<a href="img_p_5/noel10.jpg" rel="lightbox[roadtrip]" title="Zoom"><img src="img_p_5/noel10_small.jpg" width="110" height="85" alt="#" border="0" /></a>

				</marquee>
			
			</div>
		<!--               //////////////////////////////////////////////////////fin contennu -->
		</div>
		<div id="corps_page_footer_noel"> 
		  <div align="center">
		  <!-- footer page -->
		  <br />
		  <br />
		  <br />
		  <br />
		  &copy;Alsace-Navette.com	- <a href="mentions.php">Mentions l�gales</a><a href="conditions.php" style="display:none;">Conditions de vente</a> - <a href="contact.php">Contact</a>			</div>
		</div>
	</div>
	<div id="news">
		<div id="news_haut_noel">
		</div>
<div id="news_contenu">
			<?php include('include_body/news.html'); ?>
		</div>		<div id="news_footer">		
		</div>
	</div>
	<div id="partenaires">
		<div id="partenaires_haut_noel">
		</div>
		<div id="partenaires_contenu">
		<!-- ////////////partenaires -->
		
				<?php include('include_body/partenaires.html') ?>	
		
		<!-- ////////////partenaires end -->
			
		</div>
		<div id="partenaires_footer">		
			</div>	
	</div>
	
	<!--	<div id="news">
				<?php include('include_body/news.php') ?>
	</div>!-->
    
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
