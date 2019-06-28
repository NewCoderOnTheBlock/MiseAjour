<?php 
	session_start();
	include("verifAuth.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Interface d'administration</title>
		<meta name="robots" content="noindex" />
		<link rel="stylesheet" type="text/css" href="calendrier.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="style.css" media="screen" />

	</head>

	<body>
		<h1 align="center">Interface d'administration</h1>

		<table align="center" style="border:solid black 1px;" cellpadding="5" cellspacing="5" >
			<tr>
				<th colspan=20>Menu</th>
			</tr>
			<tr>
				<td><a href="index.php?p=1&action=1">Vues</a></td>
				<td><a href="index.php?p=2&t=europa">Options Europa-Park</a></td>
				<td><a href="index.php?p=2&t=royal">Options Royal-Palace</a></td>
				<td><a href="index.php?p=2&t=outlet">Options Outlet</a></td>
				<td><a href="index.php?p=4">Navettes Outlet</a></td>
				<td><a href="index.php?p=5">Saisie manuelle Royal-Palace</a></td>
				<td><a href="index.php?p=10">Déconnexion</a></td>
			</tr>
		</table>
		
		<?php 
		if($_SESSION['user_type']!="a"){
			session_unset();
			session_destroy();
			require("log.php");
		}
		else
		{
			
			switch ($_GET['p']) {	
				case 1:
					require("vue.php");
					break;
				case 2:
					require("options.php");
					break;
				case 3:
					require("info_client.php");
					break;
				case 4:
					require("gestion_trajets.php");
					break;
				case 5:
					require("saisie_manuelle_royal.php");
					break;
				case 10:
					session_unset();  
					session_destroy();
					require("log.php");
					break;
				default:
					echo "<br /><div style=\"width:100%; text-align:center;\">Bienvenue dans l'interface de gestion de Alsace-Navette.com !</div>";
					break;
			}
			
		}
		
		?>
	</body>
</html>