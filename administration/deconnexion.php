<?php session_start();  
 session_unset();  
 session_destroy();  
 //header('Location: index.php');
  echo '<script language="Javascript">
		<!--
		document.location.replace("http://www.alsace-navette.com");
		// -->
		</script>';  
  exit();  
 ?> 