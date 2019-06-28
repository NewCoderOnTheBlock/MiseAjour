<?php

	session_start();
	
	$lang = $_SESSION['lang'];
	$lang_autre_1 = $_SESSION['lang_autre_1'];
	$lang_autre_2 = $_SESSION['lang_autre_2'];
    $lang_autre_3 = $_SESSION['lang_autre_3'];
    $lang_autre_4 = $_SESSION['lang_autre_4'];
	
	session_destroy();
	
	session_start();
	
	$_SESSION['lang'] = $lang;
	$_SESSION['lang_autre_1'] = $lang_autre_1;
	$_SESSION['lang_autre_2'] = $lang_autre_2;
    $_SESSION['lang_autre_3'] = $lang_autre_3;
    $_SESSION['lang_autre_4'] = $lang_autre_4;
	
	
	
	header('Location: index.php');
	exit();
	
?>
