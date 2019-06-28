<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Tourisme Alsace :: Bienvenue</title>
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
//-->
</script>
<!-- /menu horizontal -->
</head>

<body>
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
		<!--
<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="750" height="130">
<param name="movie" value="images_corps/banniereBTN.swf">
<param name="quality" value="high">
<embed src="images_corps/banniereBTN.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="750" height="130"></embed></object>
-->
			<div id="titre_page">
				<h4>Bienvenue sur Alsace-Navette Tourisme !<br />
					Un service Alsace-Navette.</h4><br />
  				<a href="#" title="Retour">Index</a> :: Bienvenue
	  	  </div>		
			<div id="menu">
			
				<?php include('include_body/menu.html'); ?>

	 		</div>
			<div id="services">
				<?php include('include_body/services.html'); ?>
			</div>
		</div>
		<div id="corps_page_contenu"> <!-- contenu de la page, changeable -->		
		<!--               ///////////////////////////////////////////////////////////contenu -->
			<div id="corps_index">
			<?php 

if(isset ($_GET['afficher_news'])) {


mysql_connect("db922.1and1.fr","dbo206617947","D5ZEtV4h");
mysql_select_db("db206617947");


$retour = mysql_query('SELECT * FROM tourisme_news WHERE id='.$_GET['afficher_news'].' '); //chercher les news dans la table  par ordre d'id ( derniere news )

while ($donnees = mysql_fetch_array($retour)) //boucle d'affichage de news
{
$titre1 = stripslashes($donnees['titre']);
$titre = nl2br($titre1) ;       
$contenu1 = stripslashes($donnees['contenu']);
$contenu = nl2br($contenu1) ;
?>

<?php echo "<strong>".$donnees['titre']."</strong>;" ?> </br> <!-- titre de la news -->
<em><strong><font size="-3">posté le <?php echo date('d/m/Y à H\hi', $donnees['timestamp']); ?></font></strong></em><br/><br/> <!-- la date en petit en dessous du site -->
<?php echo $contenu; ?>
<br /><br />
<?php

}

}
elseif (isset ($_GET['listnews'])) // le mot de passe n'est pas bon
{
?>
<p> Veuillez entrer le mot de passe pour effectuer des changement de news</p>
<form method="post" action="admin/listnews.php">
<input type="password" name="tourisme_pass_admin" size="15"/>
<input type="submit" value="Confirmer"/>
</form>
<?php
}

else{

?><table width="100%" border="0" cellpadding="20">
			 <tr>
    <td height="50" colspan="2"><h1 align="center"><u>L&rsquo;Alsace dans toute sa splendeur&nbsp;!</u></h1>
	<table border="0" cellspacing="0" cellpadding="0" width="80%" height="50" style="color:#FFFFFF" align="center">
                  <tr>
                    <td width="10%" valign="top"><a href="bienetre.php" style="color:#FFFFFF" title="Voir ce parcours"><img src="images/Image1.png" border="0" /></a></td>
                    <td width="10%" valign="top"><a href="vins.php" style="color:#FFFFFF" title="Voir ce parcours"><img src="images/Image3.png" border="0" /></p></a></td>
                    <td width="10%" valign="top"><a href="nature.php" style="color:#FFFFFF" title="Voir ce parcours"><img src="images/Image2.png" border="0" /></a></td>
                    <td width="10%" valign="top"><a href="bio.php" style="color:#FFFFFF" title="Voir ce parcours"><img src="images/Image5.png" border="0" /></a></td>
                    <td width="10%" valign="top"><a href="noel.php" style="color:#FFFFFF" title="Voir ce parcours"><img src="images/Image4.png" border="0" /></a></td>
                  </tr>
                </table>	</td>
    </tr>
  <tr>
    <td width="30%" valign="top">
				<p align="left"><strong><em>L&rsquo;Alsace&nbsp;: une r&eacute;gion g&eacute;n&eacute;reuse vous ouvre les  bras&nbsp;!</em></strong></p>
			<p>D&eacute;couvrez une r&eacute;gion &agrave; &eacute;chelle humaine  (8&nbsp;280 km&sup2;) o&ugrave; se m&ecirc;lent une grande vari&eacute;t&eacute; de paysages&nbsp;: des for&ecirc;ts,  des vall&eacute;es, des plaines, des sommets... Et o&ugrave; l&rsquo;accueil chaleureux est une  tradition ancestrale&nbsp;!</p>
				<p><br />
  &nbsp;En  famille, en couple ou entre amis, venez partagez des moments inoubliables&nbsp;!</p>
				<p><strong><em>&nbsp;</em></strong></p>
				<img src="images/raison.jpg" border="0" vspace="0" /></td>
    <td width="70%">
			
				<p align="justify"><strong><em>Bougez</em></strong>,  en sillonnant les sentiers parfum&eacute;s et bois&eacute;s des Vosges, ou les riches  collines sous-vosgiennes inond&eacute;es d&rsquo;un vignoble verdoyant&hellip;<br />
				  <br />
                    <strong><em>Cultivez-vous</em></strong>, en d&eacute;couvrant notre patrimoine artisanal, nos maisons &agrave; colombages,  nos villages class&eacute;s et fleuris, nos mus&eacute;es d&rsquo;art et d&rsquo;histoire, mais aussi le  patrimoine architectural et religieux par les &eacute;glises romanes, gothiques et  baroques, dont la c&eacute;l&egrave;bre abbatiale d&rsquo;Ebersmunster, joyau baroque du Grand Est.<br />
                    <br />
                    <strong><em>D&eacute;tendez-vous</em></strong>, en fl&acirc;nant dans les nombreux parcs et jardins, souvent remarquables,  de notre r&eacute;gion. Ou red&eacute;couvrez le naturel, en d&eacute;couvrant les acteurs bio de la  r&eacute;gion, dans le domaine de l&rsquo;agriculture mais aussi du bien-&ecirc;tre. Et n&rsquo;oubliez  pas les luxueux Spa, centres thermaux et h&ocirc;tels de charme, &agrave; votre service pour  de purs moments de d&eacute;tente&hellip;<br />
                    <br />
                    <strong><em>Amusez-vous</em></strong>,  en vous laissant prendre au jeu de nos f&ecirc;tes, traditionnelles ou non, pendant  lesquelles la convivialit&eacute; prend tout son sens&nbsp;!<br />
                    <br />
          <strong><em>Enfin,</em></strong> <strong><em>r&eacute;galez-vous,</em></strong> en vous d&eacute;lectant d&rsquo;une gastronomie c&eacute;l&eacute;br&eacute;e depuis longtemps comme l&rsquo;une des  plus gourmande de France&nbsp;! Restaurants &eacute;toil&eacute;s ou g&eacute;n&eacute;reuse cuisine  familiale, Winstubs traditionnelles ou fermes auberges, Route des Vins,  producteurs passionn&eacute;s, mais aussi agriculteurs et vignerons ind&eacute;pendants ou  bio&hellip; Tous les go&ucirc;ts s&rsquo;y retrouveront&nbsp;!</p>  </td>
  </tr>
<?php
} 
?>
</table>

			  
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
		 &copy;Alsace-Navette.com	- <a href="mentions.php">Mentions légales</a><a href="conditions.php" style="display:none;">Conditions de vente</a> - <a href="contact.php">Contact</a> - <a href="index2.php?listnews"> Administration<img src="images/smiley.gif" border="0"  style="display:none;" /></a>			</div>
		</div>
	</div>
	<!-- //news-->
	<div id="news">
		<div id="news_haut">
		</div>
<div id="news_contenu">
			<?php include('include_body/news.html'); ?>
		</div>		<div id="news_footer">		
		</div>
	</div>
	<!-- /news end-->
	<div id="partenaires">
		<div id="partenaires_haut">
		</div>
		<div id="partenaires_contenu">
		<!-- ////////////partenaires -->
		
				<?php include('include_body/partenaires.html'); ?>	
		
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
