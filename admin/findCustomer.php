<?php
	include("verifAuth.php");
?>

<br/>
<br/>
<div style="width:100%;">
	<div style="text-align:center;width:50%;margin:auto;">
<form action="#" method="post">
	Nom (ou adresse email) du client recherch&eacute; : &nbsp;  &nbsp;
	<input id="inputNom" name="nom" type="text" size="40" maxlength="100">
	<input name="chercher" type="hidden" value="true">

	<input type="submit" value="Chercher" />
</form>

<script type="text/javascript">
<!--
	document.getElementById('inputNom').focus(); 
//-->
</script>


<?php


function enleve_accent($string){

	$a = "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûüûýýþÿRr";
    $b = "aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuuyybyRr";  

    $string = strtr(utf8_decode($string), utf8_decode($a), $b);
    $string = strtolower($string);

    return $string;	 
 } 
include("connection.php");
if(isset($_POST['chercher'])){
	
	// mot mal orthographié
	$input = $_POST['nom'];
	
	$input = enleve_accent($input);

	
	$result = mysql_query("SELECT id_client as id, nom, prenom, civilite, mail FROM aeroport_client") or die (mysql_error()); 
	?>
    <br />
    <table width="800px" border="1px">
    <?php
	while ($r = @mysql_fetch_assoc($result)){
            
            $id = addslashes($r["id"]);
            $nom = addslashes($r["nom"]);
			$prenom = addslashes($r["prenom"]);
			$civilite = addslashes($r["civilite"]);
            $mail = addslashes($r["mail"]);
			
			if(levenshtein($input, enleve_accent($nom))<3 || levenshtein($input, enleve_accent($mail))<3){
				
				?>
                  <tr>
                    <td width="80px"><?php echo $id; ?></td>
                    <th width="300px"><a href="index.php?p=5&id=<?php echo $id; ?>"><?php echo $civilite." ".$nom." ".$prenom; ?></a></th>
                    <td width="340px"><a href="mailto:<?php echo $mail; ?>"><?php echo $mail; ?></a></td>
                    <td width="80px">&nbsp;</td>
                  </tr>
               

                
                
                
                <?php
			}
	}
	?>
    </table>
    <?php
	
}

?>
</div>
</div>