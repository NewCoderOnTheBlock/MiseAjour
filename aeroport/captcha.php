<?php

	session_start();
	
	header("Content-type: image/png"); // on spécifie le type de l'image
	header("Cache-Control: no-store, no-cache, must-revalidate"); // pour être sûr de générer une image différente à chaque fois

	$img = imagecreatetruecolor(190, 60);
	$fond = imagecolorallocate($img, $rouge=mt_rand(0, 255), $vert=mt_rand(0, 255), $bleu=mt_rand(0, 255));
	imagefill($img, 0, 0, $fond);
	
	$colorCode = imagecolorallocate($img, 255-$rouge, 255-$vert, 255-$bleu); // couleur du code
	
	for($i = 0; $i < 5; $i++) // lignes horizontales
	{
	    $couleur_ligne = imagecolorallocate($img, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
        imageline($img, 0, mt_rand(0, 60), 190, mt_rand(0, 60), $couleur_ligne);
	}
	
	for($i = 0; $i < 5; $i++) // lignes verticales
	{
	    $couleur_ligne = imagecolorallocate($img, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
        imageline($img, mt_rand(0, 190), 0, mt_rand(0, 190), 60, $couleur_ligne);
	}
	
	$i = 0;
	$x = 20;
	$y = 25;
	$code = array();
	
	$lettre = array('a', 'b', 'c', 'd', 'e','f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 1, 2, 3, 4, 5, 6, 7, 8, 9);
	
	
	while($i < 5)  // le code doit avoir 5 chiffres / lettres
	{
		$code[$i] = $lettre[mt_rand(0, count($lettre))];
		imagettftext($img, 25, mt_rand(-25, 20), $x, $y, $colorCode, realpath("times.ttf"), $code[$i]);
		$i++;
		$x += 1.4 * 20;
		$y = mt_rand(25, 45);
	}
	
	$nombre;
	foreach ($code as $caractere)
		$nombre .= $caractere;
	
	$_SESSION['code_captcha'] = $nombre;  // le code de vérification
	
	imagepng($img);  // on crée l'image
	imagedestroy($img); // on la détruit
?>