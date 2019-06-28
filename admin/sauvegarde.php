<br /><br />
<?php
include("verifAuth.php");
/**
 * Nom du fichier : sauvegarde.php
 * 
 * 
 * Objectif: script permettant d'afficher les boutons de sauvegarde
 * et en restauration en fonction si on est sur debian ou pas.
 * 
 * 
 * */

/**
 * Affichage des boutons
 * */
 if($_SERVER["SERVER_ADDR"]!="192.168.3.2"){
?>
<div style='text-align:center'>
	<input type='button' value='Sauvegarder les tables aéroport' onclick='sauvegardeAeroport()' />
	<input type='button' value='Sauvegarder les tables agenda' onclick='sauvegardeAgenda()' />
	<input type='button' value='Sauvegarder les tables autres' onclick='sauvegardeAutre()' />
</div>
<?php
 } 
/**
 * 
 si on est bien sur le serveur DEBIAN on peut restaurer les bases de données
 *
***/
 if($_SERVER["SERVER_ADDR"]=="192.168.3.2"){
?>
 	<div style='text-align:center' id="boutons">
 	<input type='button' value='Effacer les tables aéroport' onclick='ConfirmMessage()' style="background:red; width:200px;"  />
 	<br />
	<input type='button' value='Restaurer les tables aéroport' onclick='restaureAeroport()' style="width:200px;" />
	<br />
	<input type='button' value='Restaurer les tables agenda' onclick='restaureAgenda()' style="width:200px; "/>
	<br />
	<input type='button' value='Restaurer les tables autres' onclick='restaureAutre()' style="width:200px;" />
</div>
<?php  
 }
 ?>

<?php 
	echo '<ul>';
	if($dossier = opendir('../divers/sauvegarde/'))
	{
		while(false !== ($fichier = readdir($dossier)))
		{
			$fi = explode(".",$fichier);
			if($fichier != '.' && $fichier != '..' && $fichier != 'index.php' && $fi[1]=="sql")
			{
				echo '<li><a href="../divers/sauvegarde/' . $fichier . '">' . $fichier . '</a></li>';
			}
		}
	}
	echo '</ul>';	
		
closedir($dossier); //Ne pas oublier de fermer le dossier 
//EN DEHORS de la boucle ! 
//Ce qui évitera à PHP bcp de calculs et des pbs liés à l'ouverture du dossier
					
?>

<script type='text/javascript'>
function sauvegardeAeroport()
{
	window.location.href='../divers/sauvegarde/script/sauvegardeAeroport.php';
}

function sauvegardeAgenda()
{
	window.location.href='../divers/sauvegarde/script/sauvegardeAgenda.php';
}

function sauvegardeAutre()
{
	window.location.href='../divers/sauvegarde/script/sauvegardeReste.php';
}


function restaureAeroport()
{
	window.location.href='../divers/restaure/restaureAeroport.php';
}

function restaureAgenda()
{
	window.location.href='../divers/restaure/restaureAgenda.php';
}

function restaureAutre()
{
	window.location.href='../divers/restaure/restaureReste.php';
}
function detruireTable()
{
	window.location.href='../divers/detruire/detruireBaseDeDonnees.php';
}

function ConfirmMessage() {
    if (confirm("Voulez-vous vraiment effacer les tables ?")) { // Clic sur OK
 	   detruireTable();
    }
}
</script>