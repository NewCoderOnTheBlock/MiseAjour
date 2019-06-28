<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
<title>Menu déroulant horizontal</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

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


<style type="text/css">

/*CSS issu des tutoriels http://css.alsacreations.com*/ 
body {
margin: 0;
padding: 0;
background: white;
font: 80% verdana, arial, sans-serif;
}
dl, dt, dd, ul, li {
margin: 0;
padding: 0;
list-style-type: none;
}
#menu {
position: absolute;
top: 30;
left: 5;
z-index:100;
width: 100%;
}
#menu dl {
float: left;
width: 12em;
margin: 0 1px;
}
#menu dt {
cursor: pointer;
text-align: center;
font-weight: bold;
background: #ccc;
border: 1px solid gray;
}
#menu dd {
border: 1px solid gray;
}
#menu li {
text-align: center;
background: #fff;
}
#menu li a, #menu dt a {
color: #000;
text-decoration: none;
display: block;
height: 100%;
border: 0 none;
}
#menu li a:hover, #menu dt a:hover {
background: #eee;
}

#site {
position: absolute;
z-index: 1;
top : 70px;
left : 10px;
color: #000;
background-color: #ddd;
padding: 5px;
border: 1px solid gray; 
}

a {text-decoration: none;
color: black;
color: #222;
}

</style>
</head>

<body>

<div id="menu">
	<dl>
		<dt onmouseover="javascript:montre();"><a href="deconnexion.php" title="Retour à l'accueil">Déconnexion</a></dt>
	</dl>
	
	<dl>			
		<dt onmouseover="javascript:montre('smenu1');">Navettes</dt>
			<dd id="smenu1">
				<ul>
					<li><a href="infos.php">Réservations</a></li>

					<li><a href="demandes.php">Demandes</a></li>
					<li><a href="vue.php">Vue d'ensemble</a></li>
					<li><a href="valider.php">Valider Demande</a></li>
					<li><a href="sup.php">Supprimer Demande</a></li>
					<li><a href="modifier.php">Modifier Demande</a></li>
					<li><a href="historique.php">Historique</a></li>
					<li><a href="paypal.php">Trace Paypal</a></li>
				</ul>

			</dd>
	</dl>
	
	
	<dl>	
		<dt onmouseover="javascript:montre('smenu2');">Saisir 1 Réservation</dt>
			<dd id="smenu2">
				<ul>
					<li><a href="reservation.php">Saisir</a></li>
				</ul>
			</dd>
	</dl>
	
	<dl>	
		<dt onmouseover="javascript:montre('smenu3');">Véhicule</dt>
			<dd id="smenu3">

				<ul>
					<li><a href="navette.php">Saisir Véhicule</a></li>
					<li><a href="nissan.php">Nissan</a></li>
					<li><a href="renault.php">Renault</a></li>
					<li><a href="sup_saisie.php">Supprimer Saisie</a></li>

				</ul>
			</dd>
	</dl>
	
	<dl>	
		<dt onmouseover="javascript:montre('smenu4');">Chauffeurs</dt>
			<dd id="smenu4">
				<ul>
					<li><a href="philippe.php">Philippe</a></li>
					<li><a href="hamid.php">Hamid</a></li>
					<li><a href="kevin.php">Kévin</a></li>
					<li><a href="pacha.php">Pacha</a></li>
				</ul>
			</dd>
	</dl>
	
	<dl>	
		<dt onmouseover="javascript:montre('smenu5');">Gestion</dt>
			<dd id="smenu5">
				<ul>
					<li><a href="gestion.php">Gestion des demandes</a></li>
					<li><a href="gestionnaire.php">Voir la Gestion</a></li>
				</ul>
			</dd>
	</dl>
	
	<dl>	
		<dt onmouseover="javascript:montre('smenu6');">E-Mail</dt>
			<dd id="smenu6">
				<ul>
					<li><a href="email.php">E-Mail auto</a></li>
				</ul>
			</dd>
	</dl>
	
	<dl>	
		<dt onmouseover="javascript:montre('smenu7');">Pratique</dt>
			<dd id="smenu7">
				<ul>
					<li><a href="conducteurs.php">Conducteurs</a></li>
				</ul>
			</dd>
	</dl>
	<br><br><br>
</div>


</body>
</html>
	