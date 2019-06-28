<?php 

require_once('config.php');
require_once('pdo2.php');


try {
	
	global $dsn, $user, $pass, $gest_erreur;
	
	$connexion = new PDO($dsn, $user, $pass);
	//~ $connexion = new PDO('mysql:host=localhost;dbname=navette;charset=utf8', 'root', '');
	$connexion->exec("SET NAMES 'utf8'");
	$connexion->exec('SET CHARACTER SET utf8');
	/*$connexion->exec("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");*/
	// KEMPF : Ajout de l'IP dans les LOGS
	$write_prepared = $connexion->prepare("INSERT INTO aeroport_logs_sql VALUES('', NOW(), :sql, :ip)");
}
catch(PDOException $e)
{
	if($gest_erreur) // version de développement
	{
		echo 'Erreur SQL  : ' . $e->getMessage();
		
		exit();
	}
	else // version "en ligne"
	{
		header('Location: /aeroport/erreur-e0.html');
	
		exit();
	}
}



function query($sql, $fetchMode = PDO::FETCH_ASSOC, $paypal = false)
{
	global $dsn, $user, $pass, $gest_erreur, $connexion;

	try
	{	
        //$connexion = PDO2::getInstance($dsn, $user, $pass);

		// Lancer une exception si une erreur survient
		$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$res = $connexion->query($sql);

		$res->setFetchMode($fetchMode);
	}
	catch(PDOException $e)
	{
		if($gest_erreur) // version de développement
		{
			echo 'Requete SQL : ' . $sql;
			echo '<br />';
			echo 'Erreur SQL  : ' . $e->getMessage();
			
			exit();
		}
		else // version "en ligne"
		{
			if(!$paypal)
			{	
				header('Location: /aeroport/erreur-e0.html');
		
				exit();
			}
		}
	}
	
	return $res;
}


function write($sql, $paypal = false)
{
	global $dsn, $user, $pass, $gest_erreur, $connexion;
	echo "wriiiiiiite";
	write_prepare($sql);
	
	try
	{
     //   $connexion = PDO2::getInstance($dsn, $user, $pass);
	   
		// Lancer une exception si une erreur survient
		$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$connexion->exec($sql);

	}
	catch(PDOException $e)
	{
		if($gest_erreur) // version de développement
		{
			echo 'Requete SQL : ' . $sql;
			echo '<br />';
			echo 'Erreur SQL  : ' . $e->getMessage();
			
			exit();
		}
		else // version "en ligne"
		{
			if(!$paypal)
			{	
				header('Location: /aeroport/erreur-e0.html');
		
				exit();
			}
		}
	}
}


function write2($sql)
{
	global $dsn, $user, $pass, $connexion;
echo $sql;
echo "SAUTTTTTTTTT";
	write_prepare($sql);

  //  $connexion = PDO2::getInstance($dsn, $user, $pass);
   
	$connexion->exec($sql);

	return $connexion;
}



$prepared = array();


// version "requete préparé" de query
function query_prepare($sql, $param, $id, $fetchMode = PDO::FETCH_ASSOC)
{
	global $dsn, $user, $pass, $gest_erreur, $prepared, $connexion;

		
	try
	{		
		//$connexion = PDO2::getInstance($dsn, $user, $pass);

		// Lancer une exception si une erreur survient
		$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		if(array_key_exists($id, $prepared))
			$res = $prepared[$id];
		else
		{
			$res = $connexion->prepare($sql);
			
			$prepared[$id] = $res;
		}
		
		$res->execute($param);
		$res->setFetchMode($fetchMode);
	}
	catch(PDOException $e)
	{
		if($gest_erreur) // version de développement
		{
			echo 'Requete SQL : ' . $sql;
			echo '<br />';
			echo 'Erreur SQL  : ' . $e->getMessage();
			
			exit();
		}
		else // version "en ligne"
		{
			header('Location: /aeroport/erreur-e0.html');
		
			exit();
		}
	}

	return $res;
}


// ne sert qu'aux logs sql !!!!
function write_prepare($sql)
{
	global $dsn, $user, $pass, $gest_erreur, $write_prepared;
	
	try
	{		
		//$connexion = PDO2::getInstance($dsn, $user, $pass);
		
		// KEMPF : Ajout de l'IP dans les LOGS
		$write_prepared->execute(array(':sql' => str_replace("\t", "", preg_replace("/(\r\n|\n|\r)/", " ", $sql)), ':ip' => $_SERVER["REMOTE_ADDR"]));
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
	}
}




?>
