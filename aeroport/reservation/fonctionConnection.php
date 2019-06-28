<?php
function Connectbdd(){
	if($_SERVER["SERVER_ADDR"]=="192.168.3.2"){ // si localhost
		try
		{
			$c = new PDO('mysql:host=db922.1and1.fr;dbname=db206617947;charset=utf8', 'dbo206617947', 'D5ZEtV4h');
		}
		catch(Exception $e)
		{
				die('Erreur : '.$e->getMessage());
		}
	}

	else
		{
			$c = new PDO('mysql:host=localhost;dbname=db206617947;charset=utf8', 'root', '');
			
		}
		//~ $c = mysql_connect('db922.1and1.fr', 'dbo206617947', 'D5ZEtV4h');
			//~ mysql_query("SET NAMES 'utf8'");
		//~ mysql_query('SET CHARACTER SET utf8');
		return $c;
}
?>
