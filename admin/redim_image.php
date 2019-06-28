<?php

set_time_limit(0);


function list_dir($chemin)
{
	$tab = array();
	
	if($list = opendir($chemin))
	{
		while(false !== ($fichier = readdir($list)))
		{
			if($fichier != '.' && $fichier != '..' && (strstr($fichier, ".jpg") || strstr($fichier, ".png") || strstr($fichier, ".JPG") || strstr($fichier, ".PNG")))
				$tab[] = $fichier;
		}
		
		closedir($list);
	}
		
	return $tab;
}


function Miniature($imgsource)
{

	$image_dir = '../aeroport_v2/aeroport/photos/';
	// Définition du nom de la miniature
	$miniature = $image_dir."mini_".$imgsource;
	// Définition de la largeur et de la hauteur maximale
	$width = 175;
	$height = 131;
	
	// si l'image qu'on lit est déjà une miniature
	// on applique pas la fonction
	if (strstr($imgsource,"mini_")) {
		return false;
	}
	
	
	$type;
	
	if(strstr($miniature, ".jpg") || strstr($miniature, ".JPG"))
		$type = "jpeg";
	else
		$type = "png";
	
	// si la miniature n'est pas déjà créée
	// (sinon on la réutilise)
	
	if (!file_exists($miniature)) {

		// Cacul des nouvelles dimensions proportionnelles
		list($width_src, $height_src) = getimagesize($image_dir.$imgsource);
	   
		if ($width && ($width_src < $height_src)) {
		   $width = ($height / $height_src) * $width_src;
		} else {
		   $height = ($width / $width_src) * $height_src;
		}
	   
		// créé une image vide
		$im = imagecreatetruecolor ($width, $height) or die ("Erreur pour créer l'image");
	   
		// lit l'image source
		if($type == "jpeg")
			$source = imagecreatefromjpeg($image_dir.$imgsource);
		else
			$source = imagecreatefrompng($image_dir.$imgsource);
	   
	
	   
		// créé la miniature : attention fonction lourde
		imagecopyresampled($im, $source, 0, 0, 0, 0, $width, $height, $width_src, $height_src);
	
	   
		// sauvegarde du résultat
		
		if($type == "jpeg")
			imagejpeg($im, $miniature);
		else
			imagepng($im, $miniature);
	}


}




foreach(list_dir("../aeroport_v2/aeroport/photos") as $photo)
{
	Miniature($photo);
}


echo "loader.innerHTML = 'Les images ont été correctement redimensionnées !';";


?>
