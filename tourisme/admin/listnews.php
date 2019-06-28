<?php
session_start();

$mdp = '19ruekuhn';

if (isset ($_POST['tourisme_pass_admin']))
{
$tourisme_pass_admin = htmlentities($_POST['tourisme_pass_admin']);
}
else 
{
$tourisme_pass_admin = '';
}
if ($tourisme_pass_admin == $mdp OR isset($_SESSION['login']))// Si le mot de passe est bon
{
$_SESSION['login'] = 1;


mysql_connect("db922.1and1.fr","dbo206617947","D5ZEtV4h");
mysql_select_db("db206617947");

?>


<h2><a href="addnews.php"><center>Ajouter une news</center></a></h2>
<?php


if (isset($_POST['titre']) AND isset($_POST['contenu']))
{

	 
    $titre = addslashes($_POST['titre']);
    $contenu = addslashes($_POST['contenu']);
    if ($_POST['id_news'] == 0)
    {

        mysql_query("INSERT INTO tourisme_news VALUES('', '" . $titre . "', '" . $contenu . "', '" . time() . "')");
    }
    else
    {
        mysql_query("UPDATE tourisme_news SET titre='" . $titre . "',  contenu='" . $contenu . "' WHERE id=" . $_POST['id_news']);
    }
}

if (isset($_GET['supprimer_news'])) 
{
    
    mysql_query('DELETE FROM tourisme_news WHERE id=' . $_GET['supprimer_news']);
}

?>

<table><tr>
<th>Modifier</th>
<th>Supprimer</th>
<th>Titre</th>
<th>Date</th>

</tr>

<?php

$retour = mysql_query('SELECT * FROM tourisme_news ORDER BY id DESC');
while ($donnees = mysql_fetch_array($retour)) 
{                                                              
?>

<tr>
<td><?php echo '<a href="addnews.php?modifier_news=' . $donnees['id'] . '">'; ?>Modifier</a></td>
<td><?php echo '<a href="listnews.php?supprimer_news=' . $donnees['id'] . '">'; ?>Supprimer</a></td>
<td><?php echo stripslashes($donnees['titre']); ?></td>
<td><?php echo date('d/m/Y', $donnees['timestamp']); ?></td>
</tr>

<?php
} 
?>
</table>
<h2><a href="http://www.tourisme.alsace-navette.com/index2.php"><center>retour acceuil</center></a></h2>
</div>

<?php
}else{

echo "Mauvais mot de passe";
}
?>