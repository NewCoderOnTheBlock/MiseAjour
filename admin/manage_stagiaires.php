<?php
	include("verifAuth.php");
	include 'connection.php';


    if($_GET['action']=="suppr"){
        $query="DELETE from aeroport_stagiaire WHERE id_stagiaire='".$_POST['id_stg']."'";
        $result = mysql_query($query)or die($query);
        ?>
        <script type="text/javascript">
                <!--
                window.location.replace("index.php?p=21");
                -->
            </script>
            <?php
    }
    //si le formulaire a été soumis on enregistre dans la base
    elseif(isset($_GET['id_stg'])){
        $query = "SELECT * from aeroport_stagiaire where id_stagiaire = '".$_GET['id_stg']."'";
        $result = mysql_query($query)or die($query);
        $r = @mysql_fetch_assoc($result);
        $nom = $r['nom'];
        $prenom = $r['prenom'];
        $login = $r['login'];
        $mdp = $r['mdp'];
       

    }
    elseif(isset($_POST['nom'])){
        //si id_stg a été posté, c'est un update à faire
        if($_POST['id_stg']!=""){
            $query = "UPDATE  aeroport_stagiaire set nom='".$_POST['nom']."',prenom='".$_POST['prenom']."',login='".$_POST['login']."',mdp='". $_POST['mdp'] ."' WHERE id_stagiaire=".$_POST['id_stg'];
            $result = mysql_query($query)or die($query);

        }
        //sinon c'est un insert
        else {
            $query = "INSERT INTO aeroport_stagiaire VALUES('','".$_POST['nom']."','".$_POST['prenom']."','".$_POST['login']."','". $_POST['mdp'] ."')";
            $result = mysql_query($query)or die($query);

        }
        ?>
            <script type="text/javascript">
                <!--
                window.location.replace("index.php?p=21");
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
        <h2><u>Gérer les stg</u></h2>

      <form name="form" id="form">
          <select name="jumpMenu" size="5" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
          <?php
		  $query_stg="SELECT * from aeroport_stagiaire";
          $result_stg = mysql_query($query_stg) or die (mysql_error());
          while ($r = @mysql_fetch_assoc($result_stg))
          {
              $titre_list=$r['nom']." ".$r['prenom'];
              $id_list=$r['id_stagiaire'];

		  ?>
            <option value="index.php?p=21&id_stg=<?php echo $id_list;?>"><?php echo $titre_list;?></option>
          <?php
		  }
		  ?>
          </select>
      </form>
      <br>
      <br>
      <form id="form1" name="form1" method="post" action="index.php?p=21&id_stg=<?php echo $id_list;?>&action=suppr">
        <input type="hidden" name="id_stg" value="<?php echo $_GET['id_stg']; ?>">
        <input type="submit" name="supp" id="supp" value="Supprimer" />
      </form>
      <br>
      <br>
      <form id="form2" name="form2" method="post" action="index.php?p=21">
        <input type="submit" name="supp" id="supp" value="Nouvelle" />
      </form>
      <br />
        <br />
        <form action="index.php?p=21" method="post" name="form" >
            <input type="hidden" name="id_stg" value="<?php echo $_GET['id_stg']; ?>">
           <label>nom : </label>
           <input type="text" name="nom" size="50" value="<?php echo $nom; ?>"/>
           <br/><br/>
           <label>prenom : </label>
           <input type="text" name="prenom" size="50" value="<?php echo $prenom; ?>"/>
           <br/><br/>
           <label>login : </label>
           <input type="text" name="login" size="50" value="<?php echo $login; ?>"/>
           <br/><br/>
           <label>mdp </label>
           <input type="password" name="mdp" size="50" value="<?php echo $mdp; ?>"/>

           <input type="submit" value="Enregistrer">
        </form>

	</div>
</div>