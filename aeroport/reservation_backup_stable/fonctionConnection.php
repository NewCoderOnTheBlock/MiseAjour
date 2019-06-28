<?php
function execution($req)
{	
	if($_SERVER["SERVER_ADDR"]=="192.168.3.2") // si localhost
	{
		$c = mysql_connect('localhost', 'root', '');
		mysql_select_db('a-n');
	}
	else
	{
		$c = mysql_connect('db922.1and1.fr', 'dbo206617947', 'D5ZEtV4h');
		mysql_select_db('db206617947');
	}
	
	mysql_query("SET NAMES 'utf8'");
	mysql_query('SET CHARACTER SET utf8');
	
	$res = mysql_query($req,$c);
	mysql_close($c);
	return $res;
}
?>