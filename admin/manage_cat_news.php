<?php
	include("verifAuth.php");
	include 'connection.php';


if($_GET['action']=="suppr"){
        $query="DELETE from aeroport_news_cat WHERE id_cat='".$_POST['id_cat']."'";
        $result = mysql_query($query)or die($query);

        mysql_query("DELETE FROM aeroport_news WHERE id_cat = " . $_POST['id_cat']) or die(mysql_error());
        ?>
        <script type="text/javascript">
                <!--
                window.location.replace("index.php?p=22");
                -->
            </script>
            <?php
    }
    // on récupère la cat sélectionnée
elseif(isset($_GET['id_cat'])){

    $query = "SELECT * from aeroport_news_cat where id_cat = '".$_GET['id_cat']."'";

    $result = mysql_query($query)or die($query);
    $r = @mysql_fetch_assoc($result);
    $cat_fr = $r['cat_fr'];
    $cat_en = $r['cat_en'];
    $cat_ger = $r['cat_ger'];
}
elseif(isset($_POST['cat_fr'])){
    //si id_news a été posté, c'est un update à faire
    if($_POST['id_cat']!=""){
        $query = "UPDATE aeroport_news_cat set cat_fr='".$_POST['cat_fr']."',cat_en='".$_POST['cat_en']."',cat_ger='".$_POST['cat_ger']."' WHERE id_cat=".$_POST['id_cat'];
        $result = mysql_query($query)or die($query);

    }
    //sinon c'est un insert
    else {
        $query = "INSERT INTO aeroport_news_cat VALUES('','".$_POST['cat_fr']."','".$_POST['cat_en']."','".$_POST['cat_ger']. "')";
        $result = mysql_query($query)or die($query);
    }
    ?>
        <script type="text/javascript">
            <!--
            window.location.replace("index.php?p=22");
            -->
        </script>
    <?php

}

?>


<script type="text/javascript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>


<br />
<br />
<div style="width:100%;">
	<div style="text-align:center;margin:auto;">
        <h2><u>Gérer les news</u></h2>

      <form name="form" id="form">
          <select name="jumpMenu" size="5" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
          <?php
		  $query_news="SELECT * from aeroport_news_cat";
          $result_news = mysql_query($query_news) or die (mysql_error());
          while ($r = @mysql_fetch_assoc($result_news))
          {
              $titre_list=$r['cat_fr'];
              $id_list=$r['id_cat'];

		  ?>
            <option value="index.php?p=22&id_cat=<?php echo $id_list;?>"><?php echo $titre_list;?></option>
          <?php
		  }
		  ?>
          </select>
      </form>

      <br>
      <br>
      <form id="form1" name="form1" method="post" action="index.php?p=22&action=suppr">
        <input type="hidden" name="id_cat" value="<?php echo $_GET['id_cat']; ?>">
        <span>ATTENTION : toutes les news dans cette catégorie seront supprimées !</span>
        <br />
        <input type="submit" name="supp" id="supp" value="Supprimer" />
      </form>
      <br>
      <br>
      <form id="form2" name="form2" method="post" action="index.php?p=22">
        <input type="submit" name="supp" id="supp" value="Nouvelle" />
      </form>
      <br />
      <br />

      <form action="index.php?p=22" method="post" name="form" style="width:775px;margin-left:auto;margin-right:auto;">
            <input type="hidden" name="id_cat" value="<?php echo $_GET['id_cat']; ?>">
           <label>FR : </label>
           <input type="text" name="cat_fr" size="50" value="<?php echo $cat_fr; ?>"/>
           <br/><br/>
           <label>EN : </label>
           <input type="text" name="cat_en" size="50" value="<?php echo $cat_en; ?>"/>
           <br/><br/>
           <label>DE : </label>
           <input type="text" name="cat_ger" size="50" value="<?php echo $cat_ger; ?>"/>
           <br/><br/>
           <input type="submit" value="Enregistrer">
        </form>

	</div>
</div>