<?php

	session_start();
	
	require_once(dirname(__FILE__) . "/../libs/config.php");
	require_once(dirname(__FILE__) . "/../includes/fonctions.php");

	
	if($_SESSION['config']['maintenance'] && (get_ip() != $_SESSION['config']['ip_autorise']))
	{
?>

<html>
<head>
	<title>Maintenance en cours | Alsace-navette.com</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<body>

<div style="text-align:center">

	<h1>Maintenance en cours</h1>
    
    <br />
    
    <span>Une opération de maintenance est actuellement en cours.</span>
    
    <br />
    
    <br />
    
    <span>Nous faisons au plus vite pour réduire au maximum la durée de la maintenance.</span>
    
    <br />
    
    <br />
    
    <!--<span>En cas d'urgence, vous pouvez nous joindre au 03 88 22 22 71.</span>-->
    
    <br />
    
    <br />
    
    <br />
    <br />
    
    <span><i>L'équipe de développement d'Alsace-navette.com</i></span>
    
</div>

<script type="text/javascript">
	var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
	document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
	</script>
	<script type="text/javascript">
	try {
	var pageTracker = _gat._getTracker("UA-7302589-1");
	pageTracker._trackPageview();
	} catch(err) {}</script>

</body>
</html>

<?php
	
	}
	else
	{
		header('Location: index.html');
		exit();
	}
?>
