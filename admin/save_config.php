<?php

function stripslashes_r($var)
{
	if(get_magic_quotes_gpc())
	{
		if(is_array($var))
			return array_map('stripslashes_r', $var);
		else
			return stripslashes($var);
	}
	else
		return $var;
}



if(isset($_POST['config']))
{	
	$path = '../libs/';
	
	$_POST = stripslashes_r($_POST);
	
	$config = simplexml_load_file($path . 'config.xml');
	
	$config->mode = $_POST['mode'];
	
	foreach($config->children() as $m)
	{
		$m = $m->getName();
		
		if($m != "mode")
		{
			foreach($config->$m->children() as $child)
			{
				$nom = $child->getName();
				
				$config->$m->$nom = $_POST[($nom . '_' . $m)];
			}
		}
		
	}
	

	// sauvegarde de la nouvelle configuration
	
	$fichier = fopen($path . 'config.temp', 'w');

	fwrite($fichier, trim($config->asXML()));
	
	fclose($fichier);
	
	unlink($path . 'config.xml');
	
	rename($path . 'config.temp', $path . 'config.xml');
	
	unset($config);
	
	header('Location: index.php?p=4');
	exit();
}
else
{
	header('Location: index.php');
	exit();
}
