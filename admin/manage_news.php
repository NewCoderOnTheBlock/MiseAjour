<?php
	include("verifAuth.php");
	include 'connection.php';

?>

<script type="text/javascript" src="TinyMCE/tiny_mce.js"></script>

<script type="text/javascript">
tinyMCE.init({
    mode : "textareas",
    language: "fr",
    theme : "advanced",
    /*skin : "o2k7",*/
    theme_advanced_buttons1 : "bold,italic,underline,separator,justifyleft,justifycenter,justifyright,justifyfull,separator,blockquote,formatselect,bullist,numlist,separator,outdent,indent,separator,undo,redo,separator,link,unlink,separator,image,separator,forecolor,backcolor,removeformat",
    theme_advanced_buttons2 : "",
    theme_advanced_buttons3 : "",
    theme_advanced_toolbar_location : "top",
    theme_advanced_toolbar_align : "left"
   /* content_css : "/template/tiny_mce.css"*/
});
</script>

<?php





    if($_GET['action']=="suppr"){
        $query="DELETE from aeroport_news WHERE id='".$_POST['id_news']."'";
        $result = mysql_query($query)or die($query);
        ?>
        <script type="text/javascript">
                <!--
                window.location.replace("index.php?p=20");
                -->
            </script>
            <?php
    }
    //si le formulaire a été soumis on enregistre dans la base
    elseif(isset($_GET['id_news'])){
        $query = "SELECT * from aeroport_news where id = '".$_GET['id_news']."'";
        $result = mysql_query($query)or die($query);
        $r = @mysql_fetch_assoc($result);
        $titre_fr = $r['titre_fr'];
        $titre_en = $r['titre_en'];
        $titre_ger = $r['titre_ger'];
        $texte_fr = $r['texte_fr'];
        $texte_en = $r['texte_en'];
        $texte_ger = $r['texte_ger'];

        $cat_news = $r['id_cat'];

        $public = $r['public'];

    }
    elseif(isset($_POST['titre_fr'])){
        //si id_news a été posté, c'est un update à faire
        if($_POST['id_news']!=""){
            $public = "0";
            if(isset($_POST['public']) && $_POST['public'] == "on")
                $public = "1";

            $query = "UPDATE aeroport_news set titre_fr='".$_POST['titre_fr']."',titre_en='".$_POST['titre_en']."',titre_ger='".$_POST['titre_ger']."',texte_fr='". $_POST['texte_fr'] ."',texte_en='".$_POST['texte_en'] ."',texte_ger='". $_POST['texte_ger'] ."', id_cat = " . intval($_POST['categorie']) . ", public = ".$public." WHERE id=".$_POST['id_news'];
            $result = mysql_query($query)or die($query);

        }
        //sinon c'est un insert
        else {
            $public = "0";
            if(isset($_POST['public']) && $_POST['public'] == "on")
                $public = "1";

            $query = "INSERT INTO aeroport_news VALUES('','".$_POST['titre_fr']."','".$_POST['titre_en']."','".$_POST['titre_ger']."','". $_POST['texte_fr'] ."','".$_POST['texte_en'] ."','". $_POST['texte_ger']."',NOW(), " . intval($_POST['categorie']) . ", ".$public.")";
            $result = mysql_query($query)or die($query);

        }
        ?>
            <script type="text/javascript">
                <!--
                window.location.replace("index.php?p=20");
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
		  $query_news="SELECT * from aeroport_news";
          $result_news = mysql_query($query_news) or die (mysql_error());
          while ($r = @mysql_fetch_assoc($result_news))
          {
              $titre_list=$r['titre_fr'];
              $id_list=$r['id'];
          
		  ?>
            <option value="index.php?p=20&id_news=<?php echo $id_list;?>"><?php echo $titre_list;?></option>
          <?php
		  }
		  ?>
          </select>
      </form>
      <br>
      <br>
      <form id="form1" name="form1" method="post" action="index.php?p=20&id_news=<?php echo $id_list;?>&action=suppr">
        <input type="hidden" name="id_news" value="<?php echo $_GET['id_news']; ?>">
        <input type="submit" name="supp" id="supp" value="Supprimer" />
      </form>
      <br>
      <br>
      <form id="form2" name="form2" method="post" action="index.php?p=20">
        <input type="submit" name="supp" id="supp" value="Nouvelle" />
      </form>
      <form id="form5" action="index.php?p=22" method="post">
      </form>
      <br />
        <br />
        <form action="index.php?p=20" method="post" name="form" style="width:775px;margin-left:auto;margin-right:auto;">
            <input type="hidden" name="id_news" value="<?php echo $_GET['id_news']; ?>">
           <label>Titre FR : </label>
           <input type="text" name="titre_fr" size="50" value="<?php echo $titre_fr; ?>"/>
           <br/><br/>
           <label>Titre EN : </label>
           <input type="text" name="titre_en" size="50" value="<?php echo $titre_en; ?>"/>
           <br/><br/>
           <label>Titre DE : </label>
           <input type="text" name="titre_ger" size="50" value="<?php echo $titre_ger; ?>"/>
           <br/><br/>

           <label>Catégorie : </label>
           <select name="categorie">
                <option value=""></option>
                <?php
                    $ret = mysql_query("SELECT id_cat, cat_fr FROM aeroport_news_cat") or die(mysql_error());
                    while($row = mysql_fetch_assoc($ret))
                    {
                        if($cat_news == $row['id_cat'])
                            echo '<option value="' . $row['id_cat'] . '" selected=\"selected\">' . $row['cat_fr'] . '</option>';
                        else
                            echo '<option value="' . $row['id_cat'] . '">' . $row['cat_fr'] . '</option>';
                    }
                ?>
           </select>

           <input type="button" value="Modifier les catégories" onclick="document.getElementById('form5').submit();" />
           <br /><br />


           <br />
           <input type="checkbox" name="public" id="public" <?php if($public == "1") echo " checked=\"checked\" ";?> />
           <label for="public">Est publié</label>

           <br /><br /><br />


           <label>contenu FR </label>
           <textarea name="texte_fr" id="texte_fr" style="width:100%; height:200px;"><?php echo $texte_fr; ?></textarea>

           <br/><br/>
            <label>contenu EN </label>
            <textarea name="texte_en" style="width:100%; height:200px;"><?php echo $texte_en; ?></textarea>

           <br/><br/>
            <label>contenu DE </label>
            <textarea name="texte_ger" style="width:100%; height:200px;"><?php echo $texte_ger; ?></textarea>

           <br/><br/>

           <input type="submit" value="Enregistrer">
        </form>
      
	</div>
</div>