<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Tourisme Alsace :: Parcours Route des Vins</title>
<meta name="Category" content="Tourisme, Voyage, Alsace, Loisirs" />
<meta name="Language" content="fr" />
<meta name="Keywords" content="navette, navettes, taxi navette, navette gare, navettes gare, tarif navette, tarifs navette, horaire navette, horaires navettes, navette bus, navette strasbourg, navettes strasbourg, location navette,navette gare aeroport, navette gare aéroport, horaires navette aéroport, horaires navette aeroport, taxi navette aeroport, tarif navette aeroport, tarif navette aéroport, navette aeroport bale mulhouse, navette bus aéroport, aeroport, aéroport, aeroport de, gare routière,transport, tarif, alsace, tourisme alsace, location alsace, region alsace, strasbourg alsace, viste, visiter,visite ville, visite alsace, visite strasbourg, visite musée, visite musee, visite à, voyage visite, visite tourisme, taxi aeroport, taxi aéroport,  archeologie, art, modern, contemporain, estampe,dessin, histoire, historique, notre-dame, zoologique, electropolis, optique, jouet, train, textil, taxi, visite,trajet, village, vosge, baroque, gastronomie, route des vins, ebersmunter, kochersberg, bien etre, cuisine, spa, nature, detente, cueillette, thermes, vin, patrimoine, barr, couronne d'or, zen, beaute, bio, noel, geispolsheim, gertwiller, cite medievale, brasserie, tarte flambée, choucroute, ferme, Soufflenheim, Drusenheim, Gambsheim, cave " />
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
		<div id="corps_page_haut"> <!-- header page -->	
			<div id="titre_page">
				<h4>Bienvenue sur Alsace-Navette Tourisme !<br />
					Un service Alsace-Navette.</h4><br />
  					<a href="#" title="Retour">Bien-Être</a> :: Présentation du parcours
	  	  </div>		
			<div id="menu">
			
				<?php include('include_body/menu.html') ?>

	 		</div>
			<div id="services">
				<?php include('include_body/services_vins.html') ?>
			</div>
		</div>
		<div id="corps_page_contenu"> <!-- contenu de la page, changeable -->		
		<!--               ///////////////////////////////////////////////////////////contenu -->
			<div id="corps_texte"> <!-- Texte à gauche -->
		
				<p id="titres_themes"><img src="images/vins.jpg" border="0" /><p>
				 
				
				 <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" width="220" height="176" id="FLVPlayer" style="float:left;">
                    <param name="movie" value="FLVPlayer_Progressive.swf" />
                    <param name="salign" value="lt" />
                    <param name="quality" value="high" />
                    <param name="scale" value="noscale" />
                    <param name="FlashVars" value="&MM_ComponentVersion=1&skinName=Clear_Skin_1&streamName=videos/CLIPS_CRT_TRILINGUE_Title_15&autoPlay=true&autoRewind=true" />
                    <embed src="FLVPlayer_Progressive.swf" flashvars="&MM_ComponentVersion=1&skinName=Clear_Skin_1&streamName=videos/CLIPS_CRT_TRILINGUE_Title_15&autoPlay=true&autoRewind=true" quality="high" scale="noscale" width="220" height="176" name="FLVPlayer" salign="LT" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />                  
				</object>
				<p style="margin-left:230px; padding:2px; border:0px; height:135px"><em><br /> 
		        <br />
			    
			    </em></p>
				<br />
				<br />
				<br />
				<br />
                <p align="justify">Laissez-vous séduire par les paysages verts et vallonnés des vignes alsaciennes !
Découvrez des viticulteurs passionnés et des vins hors du commun, d’une qualité et d’une finesse qui font leur si grande réputation.
Dégustations, spécificités des vins, visites de caves et de vignobles, apprentissage des étapes de fabrication, vous saurez tout sur nos vins, dans leur grande diversité, et sur notre amour de la vigne !
<br />
</p>  
				
			</div> 
			<!-- end tete page -->
		  <div id="corps_planning"> <!-- calque haut droite, pour planing etc -->
			
			<!--	<h2>Circuits:</h2>
				
				
			    <br />
			    <strong>&bull; Vins et patrimoine</strong>  [<a href="vins1.php" title="Lire l'article">Lire</a>] <br />
			    <a href="img_p_3/vins1.jpg" rel="lightbox[roadtrip]" title="Zoom"><img src="img_p_3/vins1_small.jpg" width="110" height="85" style="float:left;" alt="#" border="0" /></a>
				<p>Amateur de bonne chère mais aussi avide de culture ? Ce circuit est pour vous ! Puisqu’il inclut la découverte des Vins...</p>
		  		<strong>&bull; De Barr à la Couronne d'Or</strong>  [<a href="vins2.php" title="Lire l'article">Lire</a>]<br />
		  		<a href="img_p_3/vins2.jpg" rel="lightbox[roadtrip]" title="Zoom"><img src="img_p_3/vins2_small.jpg" width="110" height="85" style="float:left;" alt="#" border="0" /></a>
				<p>Visitez de grandes caves dont la renommée dépasse de loin le cercle régional ! Mais aussi des viticulteurs...</p><br />
				<strong>&bull; Découverte du Haut Rhin</strong>  [<a href="vins3.php" title="Lire l'article">Lire</a>]<br />
		  		<a href="img_p_3/vins3.jpg" rel="lightbox[roadtrip]" title="Zoom"><img src="img_p_3/vins3.jpg" width="110" height="85" style="float:left;" alt="#" border="0" /></a>
				<p>Colmar, capitale des Vins d’Alsace fait le pari de vous séduire ! La beauté et le charme de ses quartiers typiques, sa…</p>
		  		!-->

</div>
			<div id="corps_images"> <!-- calque bas droite,pour images etc -->
			
				<marquee onmouseout="start()" onmouseover="stop()"><!-- defilement images horizontal -->
				<a href="img_p_3/vins4.jpg" rel="lightbox[roadtrip]" title="Zoom"><img src="img_p_3/vins4_small.jpg" border="0" width="110" height="85" alt="#" /></a>
				<a href="img_p_3/vins5.jpg" rel="lightbox[roadtrip]" title="Zoom"><img src="img_p_3/vins5_small.jpg" width="110" height="85" alt="#" border="0" /></a>
				<a href="img_p_3/vins6.jpg" rel="lightbox[roadtrip]" title="Zoom"><img src="img_p_3/vins6_small.jpg" width="110" height="85" alt="#" border="0" /></a>
				<a href="img_p_3/vins7.jpg" rel="lightbox[roadtrip]" title="Zoom"><img src="img_p_3/vins7_small.jpg" width="110" height="85" alt="#" border="0" /></a>
				</marquee>
			
			</div>
		<!--               //////////////////////////////////////////////////////fin contennu -->
		</div>
		<div id="corps_page_footer"> 
		  <div align="center">
		  <!-- footer page -->
		  <br />
		  <br />
		  <br />
		  <br />
		  &copy;Alsace-Navette.com	- <a href="mentions.php">Mentions légales</a><a href="conditions.php" style="display:none;">Conditions de vente</a> - <a href="contact.php">Contact</a>			</div>
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
	
	<!--	<div id="news">
				<?php include('include_body/news.php') ?>
	</div>	!-->
    
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
