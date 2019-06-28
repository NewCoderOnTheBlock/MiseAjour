<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<link rel='stylesheet' href='./css/style.css' />
		<script type='text/javascript' src='./js/mootools.js'></script>
		<script type='text/javascript' src='./js/demo.js'></script>
		<title>Alsace Solidaire</title>
	</head>
<body>
<?php
	if(isset($_GET['lang']))
	{
		echo "<input type='hidden' value='".$_GET['lang']."' id='lang' />";
	}
	else
	{
		echo "<input type='hidden' value='fr' id='lang' />";
	}
?>

	<img src='./img/background.png' alt='bg' id='bgBody' />
	<div id='contenu'>
		<div style='margin-left:590px;'>
			<img src='./img/flag/flag_fr.png' class='imgDrapeau' id='drapFR' onclick='changementLangue(this.id)' />
			<img src='./img/flag/flag_en.png' class='imgDrapeau' id='drapEN' onclick='changementLangue(this.id)' />
			<img src='./img/flag/flag_ger.png' class='imgDrapeau' id='drapGER' onclick='changementLangue(this.id)' />
		</div>
		<table align='center'>
			<tr>
				<td colspan='4' style='height:90%'>
					<!--<img src='./img/logos/logo-alsace-navette.png' alt='logo' width='70' />
					<img src='./img/titres/titre-alsace-navette.png' />-->
					<img src='./img/logoSolidaire.jpg' width="64" style='margin-left:6px;' />
					<img src='./img/titres/titre-alsace-navette.png' />
					<img src='./img/titres/banniere-animee.gif' width='469' />
				</td>
			</tr>
			<tr>
				<td id="rajjunior" style='cursor:pointer' onclick='lienRAJjunior()'>
					<div id="myElementRAJjunior"></div>
					<div id='txtRAJjunior'>Talents'Dicaps et AFI Alsace ont &eacute;labor&eacute; ensemble le projet r&eacute;seau active job junior  pour les jeunes de 14 à 18 ans qui rencontrent des difficultés dans le choix de leur orientation.<br /></div>
				</td>
				<td style='background:url(./img/carres/carrejaune.png) no-repeat;text-align:center;font-size:12pt;'></td>
				<td id='d2c' style='cursor:pointer' onclick="lienD2C()">
					<div id="myElementD2C"></div>
					<div id='txtD2C'><br />Une &eacute;quipe de juriste est &agrave; l'&eacute;coute et propose des conseils personnalis&eacute;s sur toutes les questions d'ordre juridique. <br /></div>
				</td>
				<td style='background:url(./img/carres/carrejaune.png) no-repeat;;text-align:center;font-size:12pt;'></td>
			</tr>
			<tr>
				<td id="rajcampus" style='cursor:pointer' onclick='lienRAJcampus()'>
					<div id="myElementRAJcampus"></div>
					<div id='txtRAJcampus'>Talents'Dicaps et AFI Alsace ont &eacute;labor&eacute; ensemble le projet r&eacute;seau active job campus qui est un atelier de redynamisation vers l'emploi pour les jeunes de 18 à 25 ans.<br /></div>
				</td>
				<td colspan='2' rowspan='2'><img src='./img/titres/milieu.png' alt='milieu' width='330' style='margin-left:5px;' /></td>
				<td style='background:url(./img/carres/carrejaune.png) no-repeat;text-align:center;font-size:12pt;'></td>
			</tr>
			<tr>
				<td id="rajplus" style='cursor:pointer' onclick='lienRAJplus()'>
					<div id="myElementRAJplus"></div>
					<div id='txtRAJplus'>Talents'Dicaps et AFI Alsace ont &eacute;labor&eacute; ensemble le projet r&eacute;seau active job plus qui est un atelier de redynamisation vers l'emploi pour les actifs et les seniors de 50 ans et plus.<br /></div>
				</td>
				<td style='background:url(./img/carres/carrejaune.png) no-repeat;text-align:center;font-size:12pt;'></td>
			</tr>
			<tr>
				<td style='background:url(./img/carres/carrejaune.png) no-repeat;text-align:center;font-size:12pt;'></td>
				<td id='wag' style='cursor:pointer' onclick="lienWAG()">
					<div id="myElementWAG"></div>
				</td>
				<td style='background:url(./img/carres/carrejaune.png) no-repeat;text-align:center;font-size:12pt;'></td>
				<td id='aa' style='cursor:pointer' onclick="lienAA()">
					<div id="myElementAA"></div>
					<div id="txtAA"><div style="font-size:13.5pt;font-weight:bold; margin-top:45px;">Pouvoir changer !<br /></div></div>
				</td>
			</tr>
		</table>
		<br />
		<?php
		if(isset($_GET['lang']))
		{
			if($_GET['lang']=="fr")
			{
		?>
		<div style='width:690px;margin-left:auto;margin-right:auto;text-align:justify;font-size:11pt;'>
				<img src='./img/titres/titrequisommesnous.png' width='210' />
				<br />
				<div style='float:left;width:350px;padding-top:32px;' >
								Alsace navette solidaire soutient depuis plusieurs ann&eacute;es des projets favorisant l'int&eacute;gration sociale, &eacute;conomique et citoyenne de tous. Compos&eacute;es de personnes aux horizons culturels et sociales diverses, ces projets ont pour but de rassembler des hommes et des femmes de bonne volont&eacute; voulant oeuvrer pour des projets qui valorisent le "vivre ensemble avec nos diff&eacute;rences". 
				</div>
				<div style='float:left;margin-left:20px;margin-bottom:10px;margin-top:-35px;'>
					<img src='./img/maisonAlsacienne.jpg' width='320' />
					<br />
					<div style="font-size:7pt;font-style:italic;font-family:Arial"><span style='font-style:normal'>Photo :</span> PhillipC <span style='font-style:normal'>&nbsp;(source : Flickr)</span></div>
				</div>
					Les sites Droit2citoyen, atelier r&eacute;seau active job ainsi que alsace-avenir sont des projets de citoyennet&eacute; cr&eacute;&eacute;s dans l'espoir de favoriser l'entraide, l'insertion professionnelle, ainsi que le pouvoir d'expression. 
		</div>
		<?php
			}
			else if($_GET['lang']=="en")
			{
		?>
		<div style='width:690px;margin-left:auto;margin-right:auto;text-align:justify;font-size:11pt;'>
				<img src='./img/titres/titrequiAgl.png' width='210' />
				<br />
				<div style='float:left;width:350px;padding-top:32px;' >
								Alsace navette solidarity has been supporting for several years projects promoting social, economic and civic integration. Composed of people with cultural horizons and from diverse social backgrounds, these projects aim to gather together men and women of good will who are willing to work on projects which enhance “living together with our differences”.
				</div>
				<div style='float:left;margin-left:20px;margin-bottom:10px;margin-top:-35px;'>
					<img src='./img/maisonAlsacienne.jpg' width='320' />
					<br />
					<div style="font-size:7pt;font-style:italic;font-family:Arial"><span style='font-style:normal'>Photo :</span> PhillipC <span style='font-style:normal'>&nbsp;(source : Flickr)</span></div>
				</div>
					The sites Droit2citoyen, workshop network active job as well as Alsace-avenir are projects of citizenship created in the hope of promoting mutual aid, integration into the world of work and the right of expression.
		</div>		
		<?php
			}
			else if($_GET['lang']=="ger")
			{
		?>
		<div style='width:690px;margin-left:auto;margin-right:auto;text-align:justify;font-size:11pt;'>
				<img src='./img/titres/titrequiAlld.png' width='210' />
				<br />
				<div style='float:left;width:350px;padding-top:32px;' >
								Alsace navette solidarity has been supporting for several years projects promoting social, economic and civic integration. Composed of people with cultural horizons and from diverse social backgrounds, these projects aim to gather together men and women of good will who are willing to work on projects which enhance “living together with our differences”.
				</div>
				<div style='float:left;margin-left:20px;margin-bottom:10px;margin-top:-35px;'>
					<img src='./img/maisonAlsacienne.jpg' width='320' />
					<br />
					<div style="font-size:7pt;font-style:italic;font-family:Arial"><span style='font-style:normal'>Photo :</span> PhillipC <span style='font-style:normal'>&nbsp;(source : Flickr)</span></div>
				</div>
					The sites Droit2citoyen, workshop network active job as well as Alsace-avenir are projects of citizenship created in the hope of promoting mutual aid, integration into the world of work and the right of expression.
		</div>		
		<?php
			}
		}
		else
		{
		?>
		<div style='width:690px;margin-left:auto;margin-right:auto;text-align:justify;font-size:11pt;'>
				<img src='./img/titres/titrequisommesnous.png' width='210' />
				<br />
				<div style='float:left;width:350px;padding-top:32px;' >
								Alsace navette solidaire soutient depuis plusieurs ann&eacute;es des projets favorisant l'int&eacute;gration sociale, &eacute;conomique et citoyenne de tous. Compos&eacute;es de personnes aux horizons culturels et sociales diverses, ces projets ont pour but de rassembler des hommes et des femmes de bonne volont&eacute; voulant oeuvrer pour des projets qui valorisent le "vivre ensemble avec nos diff&eacute;rences". 
				</div>
				<div style='float:left;margin-left:20px;margin-bottom:10px;margin-top:-35px;'>
					<img src='./img/maisonAlsacienne.jpg' width='320' />
					<br />
					<div style="font-size:7pt;font-style:italic;font-family:Arial"><span style='font-style:normal'>Photo :</span> PhillipC <span style='font-style:normal'>&nbsp;(source : Flickr)</span></div>
				</div>
					Les sites Droit2citoyen, atelier r&eacute;seau active job ainsi que alsace-avenir sont des projets de citoyennet&eacute; cr&eacute;&eacute;s dans l'espoir de favoriser l'entraide, l'insertion professionnelle, ainsi que le pouvoir d'expression. 
		</div>
		<?php
		}
		?>
	
<script type="text/javascript">
var l = document.getElementById('lang').value;
function lienAA()
{
	window.location.href="./fiche_AA.php?lang="+l;
}

function lienD2C()
{
	window.location.href="./fiche_D2C.php?lang="+l;
}

function lienRAJjunior()
{
	window.location.href="./fiche_RAJJ.php?lang="+l;
}

function lienRAJplus()
{
	window.location.href="./fiche_RAJP.php?lang="+l;
}

function lienRAJcampus()
{
	window.location.href="./fiche_RAJC.php?lang="+l;
}

function lienWAG()
{
	window.location.href="./fiche_WAG.php?lang="+l;
}

function changementLangue(id)
{
	if(id=="drapFR")
	{
		window.location.href="./index.php?lang=fr";
	}
	else if(id=="drapEN")
	{
		window.location.href="./index.php?lang=en";
	}
	else if(id=="drapGER")
	{
		window.location.href="./index.php?lang=ger";
	}
}
</script>
<!-- Piwik -->
<script type="text/javascript">
var pkBaseURL = (("https:" == document.location.protocol) ? "https://alsace-navette.com/piwik/" : "http://alsace-navette.com/piwik/");
document.write(unescape("%3Cscript src='" + pkBaseURL + "piwik.js' type='text/javascript'%3E%3C/script%3E"));
</script><script type="text/javascript">
try {
var piwikTracker = Piwik.getTracker(pkBaseURL + "piwik.php", 1);
piwikTracker.trackPageView();
piwikTracker.enableLinkTracking();
} catch( err ) {}
</script><noscript><p><img src="http://alsace-navette.com/piwik/piwik.php?idsite=1" style="border:0" alt="" /></p></noscript>
<!-- End Piwik Tag -->
</body>
</html>