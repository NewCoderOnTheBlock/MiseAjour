<?php
	include("verifAuth.php");
?>

<script type="text/javascript">
function afficherDiv(type){
	if(type=="conducteur"){
		document.getElementById('conducteur').style.display = 'block';
		document.getElementById('bureau').style.display = 'none';
		
	}
	else{
		document.getElementById('conducteur').style.display = 'none';
		document.getElementById('bureau').style.display = 'block';
	}


}
</script>

 <br/><br/> <br/><br/>
<div style="width:100%; text-align:center">
    <span style="font-family:Verdana, Geneva, sans-serif; font-size:16px; font-weight:bold;">Ajout de personnel</span>
    <br />
    <br />
    <form name="form1" method="post" action="index.php?p=18">
      <select name="type" id="type" onChange="afficherDiv(document.getElementById('type').options[this.selectedIndex].value)">
        <option value="conducteur">Conducteur</option>
        <option value="bureau">Administratif</option>
      </select>
       <br/><br/>
      <br/>
      <label>nom</label> <input name="nom" type="text" size="15" maxlength="40">
      <br/><br/>
      <label>prenom </label><input name="prenom" type="text" size="15" maxlength="40">
      <br/><br />
      
      <div id="conducteur">
        <p>
		  <label>adresse</label><input name="adresse" type="text" size="15" maxlength="40">
          <br/><br/>
          <label>cp </label><input name="cp" type="text" size="15" maxlength="40">
          <br/><br/>
          <label> ville </label><input name="ville" type="text" size="15" maxlength="40">
          <br/><br/>
          <label>mail </label><input name="mail" type="text" size="15" maxlength="40">
          <br/><br/>
          <label>fixe </label><input name="fixe" type="text" size="15" maxlength="40">
          <br/><br/>
          <label>portable </label><input name="portable" type="text" size="15" maxlength="40">
        </p>
        
          
          <br />
          <br />
          
      </div>
      
      <div id="bureau" style="display:none;">
       <label> identifiant </label><input name="identifiant" type="text" size="15" maxlength="40">
        <br/>
      </div>
      
      <input type="submit" name="submit" id="submit" value="Envoyer" />
    </form>
    
    
    <hr />
    <br />
    <span style="font-family:Verdana, Geneva, sans-serif; font-size:16px; font-weight:bold;">Suppression de personnel de bureau</span>
    <br />
    <br />
    <form action="index.php?p=19" method="post">
    	<input type="hidden" name="qui" value="bureau" />
        <select name="idBureau" size="1" id="bureau">
        <?php 
        include("connection.php");
            $req = "select iduser, nom, prenom from zzprofile where iduser not in (select iduser from aeroport_administratifs_exclus)";
            $res = mysql_query($req);
            $nb = mysql_num_rows($res);
            
             while ($r = @mysql_fetch_assoc($res)){ 
             
                 $nom = $r['nom'];
                 $prenom = $r['prenom'];
                 $idUser = $r['iduser'];		
            
        
        
        ?>
        <option value="<?php echo $idUser; ?>"><?php echo $nom." ".$prenom; ?></option>
        <?php 
             }
        ?>
        </select>
        <br /><br />
        <input name="" type="submit" value="retirer les droits" />
    </form>
    
	<hr />
    <br />
    <span style="font-family:Verdana, Geneva, sans-serif; font-size:16px; font-weight:bold;">Suppression de conducteurs</span>
    <br />
    <br />
    <form action="index.php?p=19"  method="post">
    	<input type="hidden" name="qui" value="conducteur" />
        <select name="idConducteur" size="1" id="bureau">
        <?php 
            $req = "select idchauffeur, nom, prenom from chauffeur 
                    where idchauffeur != 0
                    AND idchauffeur not in (select id_chauffeur from aeroport_conducteurs_exclus)";
            $res = mysql_query($req);
            $nb = mysql_num_rows($res);
            ?>
            
            
            
            <?php
             while ($r = @mysql_fetch_assoc($res)){ 
             
                 $nom = $r['nom'];
                 $prenom = $r['prenom'];
                 $idchauffeur = $r['idchauffeur'];		
            
        ?>
        <option value="<?php echo $idchauffeur; ?>"><?php echo $nom." ".$prenom; ?></option>
        <?php 
             }
        ?>
        </select>
        <br /><br />
        <input name="" type="submit" value="retirer les droits" />
	</form>
</div>
