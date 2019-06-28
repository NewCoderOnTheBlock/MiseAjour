<?php
session_start();

if ($_SESSION['login'] = true)
{

mysql_connect("db922.1and1.fr","dbo206617947","D5ZEtV4h");
mysql_select_db("db206617947");

?>


<h3><a href="listnews.php">Retour à la liste des news</a></h3>
<?php


if (isset($_GET['modifier_news'])) 
{

    $retour = mysql_query('SELECT * FROM tourisme_news WHERE id=' . $_GET['modifier_news']);
    $donnees = mysql_fetch_array($retour);
    
    $titre = $donnees['titre'];
    $contenu2 = $donnees['contenu'];
    $id_news = $donnees['id']; 
    $contenu = stripslashes($contenu2);

}
else
{
    $titre = '';
    $contenu = '';
    $id_news = 0; 

}
?>

<form action="listnews.php" method="post">
<p>Titre : <input type="text" size="30" name="titre" value="<?php echo $titre; ?>" /></p>
<p>
    Contenu :<br />
    <textarea name="contenu" cols="50" rows="10">
    <?php echo $contenu; ?>
    </textarea><br />
    
    <input type="hidden" name="id_news" value="<?php echo $id_news; ?>" />
	<input type="submit" value="Envoyer" />
</p>

</form>
</div>
<?php
}
else{
echo "erreur";
}
?>