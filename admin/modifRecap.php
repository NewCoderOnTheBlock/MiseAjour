<?php
	include("verifAuth.php");
?>
	<script type="text/javascript" src="./scripts/makeRequest.js"></script>



	<script type="text/javascript">
		function changer_label(texte, lieu){
			document.getElementById('lbl_as').innerHTML = texte;
			if(lieu=='1' || lieu=='2'){
				document.getElementById('hda').style.display='block';
				document.getElementById('has').style.display='block';
			}
			else{
				document.getElementById('hda').style.display='none';
				document.getElementById('has').style.display='none';
			}
		}
        function cacher_div(param){
            if(param=='1'){
                document.getElementById('hds').style.display='none';
				document.getElementById('haa').style.display='none';
            }
            else if(param=='2'){
                document.getElementById('hds').style.display='block';
				document.getElementById('haa').style.display='block';
            }
            else if(param=='3'){
                document.getElementById('hds').style.display='none';
                document.getElementById('haa').style.display='block';
            }
        }


		function valider()
		{
			var ok = true;
			var maform = document.forms[0];
			for (var champ=0; champ < maform .elements.length-1; champ++) {
				if(maform.elements[champ].value == ""){
					ok = false;
				}
			}
			if(ok)
			{ // les données sont ok on test la longueur du champ explications, s'il est vide on vérifie que les horaire sont correctes, sinon on autorise l'envoi du formulaire
				if((document.getElementById('expli').value !=" ")&&(document.getElementById('expli').value !="")){
					//alert("le champ est rempli");
					document.getElementById('formulaire').submit();
				}
				else{
				//	alert("le champ est pas rempli");
                    if(document.getElementById('from_0').checked==true&&document.getElementById('to_0').checked==true){
                        return makeRequest(document.getElementById('idcm').value, document.getElementById('heureD_str').options[document.getElementById('heureD_str').selectedIndex].text, document.getElementById('minuteD_str').options[document.getElementById('minuteD_str').selectedIndex].text, document.getElementById('heureA_str').options[document.getElementById('heureA_str').selectedIndex].text, document.getElementById('minuteA_str').options[document.getElementById('minuteA_str').selectedIndex].text, document.getElementById('heureA_aero').options[document.getElementById('heureA_aero').selectedIndex].text, document.getElementById('minuteA_aero').options[document.getElementById('minuteA_aero').selectedIndex].text, document.getElementById('heureD_aero').options[document.getElementById('heureD_aero').selectedIndex].text, document.getElementById('minuteD_aero').options[document.getElementById('minuteD_aero').selectedIndex].text);

                    }
                    else{
                        document.getElementById('formulaire').submit();
                    }
				}
			}
			else
			{ // sinon on affiche un message
				alert("Saisissez tous les champs SVP");
				// et on indique de ne pas envoyer le formulaire
				return false;
			}
		}
	</script>
	<script src="SpryAssets/SpryValidationRadio.js" type="text/javascript"></script>
	<link href="SpryAssets/SpryValidationRadio.css" rel="stylesheet" type="text/css" />
    <?php
    include("connection.php");
    $query="SELECT * from aeroport_recap_trajet where id_recap = '".$_GET['id_recap']."'";
    $resultat = mysql_query($query) or die (mysql_error());
    $r = @mysql_fetch_assoc($resultat);

    $id_recap=$_GET['id_recap'];
   $idcm=$r['idcm'];
   $id_conducteur=$r['id_conducteur'];
   $idVehicule=$r['id_vehicule'];
   $date=$r['date'];
   $heureD_str=$r['heureD_str'];
   $heureA_aero=$r['heureA_aero'];
   $heureD_aero=$r['heureD_aero'];
   $heureA_str=$r['heureA_str'];
   $nb_grp_aller=$r['nb_grp_aller'];
   $nb_grp_retour=$r['nb_grp_retour'];
   $pass_aller_res=$r['pass_aller_res'];
   $pass_aller_nonres=$r['pass_aller_nonres'];
   $pass_retour_res=$r['pass_retour_res'];
   $pass_retour_nonres=$r['pass_retour_nonres'];
   $kmsD=$r['kmsD'];
   $kmsA=$r['kmsA'];
   $niv_essence_depart=$r['niv_essence_depart'];
   $niv_essence_arrivee=$r['niv_essence_arrivee'];
   $remarques=$r['remarques'];
   $montantA=$r['montantA'];
   $montantR=$r['montantR'];
   $essence=$r['essence'];
   $lavext=$r['lavext'];
   $lavint=$r['lavint'];
   $unites=$r['unites'];
   $depot=$r['depot'];
   $remarques = str_replace('<br />', '', $remarques);
   $remarques = str_replace('<br/>', '', $remarques);

   
   $heureD_str = explode(":",$heureD_str);
   $minuteD_str =  $heureD_str[1];
   $heureD_str = $heureD_str[0];
    
   $heureA_str = explode(":", $heureA_str);
   $minuteA_str =  $heureA_str[1];
   $heureA_str = $heureA_str[0];
  
   $heureD_aero = explode(":", $heureD_aero);
   $minuteD_aero =  $heureD_aero[1];
   $heureD_aero = $heureD_aero[0];
   
   $heureA_aero = explode(":", $heureA_aero);
   $minuteA_aero =  $heureA_aero[1];
   $heureA_aero = $heureA_aero[0];


    
        //vérification des cas particuliers
        //présence de prise à domicile
        if(ereg('[présence de prises à domicile]', $remarques)) {
            $prise_dom = true;
            $remarques = preg_replace('/\[présence de prises à domicile\]/', "", $remarques);
        } else {
            $prise_dom = false;
        }
        //présence de dépose à domicile
        if(ereg('[présence de dépose à domicile]', $remarques)) {
            
            $depose_dom = true;
            $remarques = preg_replace('/\[présence de dépose à domicile\]/', "", $remarques);
        } else {
            $depose_dom = false;
        }
        //provenance
        if(ereg('[retour à la suite d\'une longue attente à cet aéroport]', $remarques)) {
            $provenance = 1;
            $remarques = preg_replace('/\[retour à la suite d\'une longue attente à cet aéroport\]/', "", $remarques);
        }
        else if(ereg('[en provenance directe d\'un autre aéroport]', $remarques)){
            $provenance = 3;
            $remarques = preg_replace('/\[en provenance directe d\'un autre aéroport\]/', "", $remarques);
        }
        else{
            $provenance = 2;
        }

        //destination
        if(ereg('[en route vers un autre aéroport sans passer par Strasbourg]', $remarques)) {
            $destination= 2;
            $remarques = preg_replace('/\[en route vers un autre aéroport sans passer par Strasbourg\]/', "", $remarques);
        }
        else if(ereg('[En attente sur l\'aéroport pour un trajet retour beaucoup plus tard]', $remarques)){
            $destination = 3;
            $remarques = preg_replace('/\[En attente sur l\'aéroport pour un trajet retour beaucoup plus tard\]/', "", $remarques);
        }
        else{
            $destination = 1;
        }
        

?>


<div id="container">

<center><h1>Compte rendu de mission</h1></center>

<br><br><br><br><br><br><br><br>


<form name="formulaire" id="formulaire" method="post" action= "saisie.php">
  <div style="margin:auto; padding:auto; width:1024px;">
    <div >
      <p>
        <?php $query2="SELECT idchauffeur, nom FROM chauffeur";
			  $result2 = mysql_query($query2) or die (mysql_error());
			?>
        <label>Nom du conducteur :</label>
        <SELECT NAME="conducteur">
          <?php while ($r2 = @mysql_fetch_assoc($result2)){
								$idchauffeur= $r2["idchauffeur"];
								$nom = $r2["nom"];

					?>



          <option value="<?php echo $idchauffeur; ?>" <? if($id_conducteur == $idchauffeur){ echo"selected='selected'"; } ?>><?php echo $nom; ?></option>
          <?php } ?>
        </SELECT>
        <?php $query2="SELECT id_vehicule, libelle FROM aeroport_vehicule";
			  $result2 = mysql_query($query2) or die (mysql_error());
			?>
        &nbsp;&nbsp;<label>Véhicule utilisé :</label>
        <SELECT NAME="vehicule">
          <?php while ($r2 = @mysql_fetch_assoc($result2)){
								$id_vehicule= $r2["id_vehicule"];
								$libelle = $r2["libelle"];

					?>



          <option value="<?php echo $id_vehicule; ?>" <? if($idVehicule == $id_vehicule){ echo"selected='selected'"; } ?>><?php echo $libelle; ?></option>
          <?php } ?>
        </SELECT>


        <br><br>



        <label>Remarques:</label>
        <textarea name="remarques" rows="3" cols="30" size ="200"> <?php echo $remarques;?></textarea>
        <br>
        <label>Passagers Aller qui ont r&eacute;serv&eacute; :</label>
        <select name="pass_aller_res">
        <?php
        for($i = 0; $i<=8; $i++){
            ?>
            <option value="<?php echo $i; ?>" <? if($i == $pass_aller_res){ echo"selected='selected'"; } ?>><?php echo $i; ?></option>
            <?php
        }
        ?>
         
        </select>
        &nbsp;
        <label>Passagers Retour qui ont r&eacute;serv&eacute; :</label>
        <select name="pass_retour_res">
          <?php
        for($i = 0; $i<=8; $i++){
            ?>
            <option value="<?php echo $i; ?>" <? if($i == $pass_retour_res){ echo"selected='selected'"; } ?>><?php echo $i; ?></option>
            <?php
        }
        ?>
        </select>
        </p>
      <p><br>



        <label>Passagers Aller qui n'avaient pas réservé:</label>
        <SELECT NAME="pass_aller_nonres">
            <?php
        for($i = 0; $i<=8; $i++){
            ?>
            <option value="<?php echo $i; ?>" <? if($i == $pass_aller_nonres){ echo"selected='selected'"; } ?>><?php echo $i; ?></option>
            <?php
        }
        ?>
        </SELECT>
        &nbsp;

        <label>Passagers Retour :</label>
        <SELECT NAME="pass_retour_nonres">
              <?php
        for($i = 0; $i<=8; $i++){
            ?>
            <option value="<?php echo $i; ?>" <? if($i == $pass_retour_nonres){ echo"selected='selected'"; } ?>><?php echo $i; ?></option>
            <?php
        }
        ?>
        </SELECT>
        &nbsp;</p>
      <p>

        <label>Montant payé au conducteur en liquide : aller :</label>
        <input type="texte" name="montantA" size="5" value="<?php echo $montantA;?>"/>€
        <label> retour:</label>
        <input type="texte" name="montantR" size="5" value="<?php echo $montantR;?>"/>€
        </p>
      <p>Nombre Groupes Aller :
        <select name="nb_grp_aller" id="nb_grp_aller">
                <?php
        for($i = 0; $i<=8; $i++){
            ?>
            <option value="<?php echo $i; ?>" <? if($i == $nb_grp_aller){ echo"selected='selected'"; } ?>><?php echo $i; ?></option>
            <?php
        }
        ?>
        </select>
        Nombre Groupes Retour :
        <select name="nb_grp_retour" id="nb_grp_retour">
                 <?php
        for($i = 0; $i<=8; $i++){
            ?>
            <option value="<?php echo $i; ?>" <? if($i == $nb_grp_retour){ echo"selected='selected'"; } ?>><?php echo $i; ?></option>
            <?php
        }
        ?>
          </select>
  </p>
       
      <p><label>J'ai pris des passagers à domicile</label>
        <input type="checkbox" name="priseDom" id="priseDom" value="aPriseDom" <?php if($prise_dom){echo"checked=\"checked\"" ;}?> />
      </p>
      <p><label>J'ai déposé des passagers à domicile </label>
        <input type="checkbox" name="deposeDom" id="deposeDom" value="aDeposeDom" <?php if($depose_dom){echo"checked=\"checked\"" ;}?>/>
        <br>
        <br>
      </p>
    </div>
    <hr />
    <div id="spryradio1">
      <table width="726" height="47">
        <tr>
          <td width="211"><label>
            <input type="radio" name="from" value="from_stras" id="from_0" <?php if($provenance==2){echo "checked=\"checked\"";}?>  onclick="cacher_div('2');"/>
            Je venais de Strasbourg</label></td>
            <td width="191"><label>
            <input type="radio" name="from" value="from_this_aero" id="from_1"  <?php if($provenance==1){echo "checked=\"checked\"";}?> onclick="cacher_div('1');"/>
            j'étais déjà à cet aéroport</label></td>
            <td width="308"><label>
            <input type="radio" name="from" value="from_other_aero" id="from_2"  <?php if($provenance==3){echo "checked=\"checked\"";}?> onclick="cacher_div('3');"/>
            je venais directement d'un autre aéroport</label></td>
        </tr>
      </table>
      <span class="radioRequiredMsg">fectuez une sélection.<br />
      </span>
    </div>
    <br />
    <div id="hds">
      <label id="lbl_ds">Horaire Départ Strasbourg :</label>
      <SELECT NAME="heureD_str" id="heureD_str">
               <?php
        for($i = 0; $i<=24; $i++){
            if($i<10){
                $j="0".$i;
            }
            else{
                $j=$i;
            }
            ?>
            <option value="<?php echo $j; ?>" <? if($j == $heureD_str){ echo"selected='selected'"; } ?>><?php echo $j; ?></option>
            <?php
        }
        ?>

      </SELECT>
      &nbsp;
      <SELECT NAME="minuteD_str" id="minuteD_str">
               <?php
        for($i = 0; $i<60; $i=$i+5){
            if($i<10){
                $j="0".$i;
            }
            else{
                $j=$i;
            }
            ?>
            <option value="<?php echo $j; ?>" <? if($j == $minuteD_str){ echo"selected='selected'"; } ?>><?php echo $j; ?></option>
            <?php
        }
        ?>
      </SELECT>
      &nbsp;
    </div>
      <div id="haa">
      <label id="lbl_aa"><br />
        Horaire Arrivée A&eacute;roport :</label>
      <SELECT NAME="heureA_aero" id="heureA_aero">
              <?php
        for($i = 0; $i<24; $i++){
            if($i<10){
                $j="0".$i;
            }
            else{
                $j=$i;
            }
            ?>
            <option value="<?php echo $j; ?>" <? if($j == $heureA_aero){ echo"selected='selected'"; } ?>><?php echo $j; ?></option>
            <?php
        }
        ?>
      </SELECT>
      &nbsp;
      <SELECT NAME="minuteA_aero" id="minuteA_aero">
                <?php
        for($i = 0; $i<60; $i=$i+5){
            if($i<10){
                $j="0".$i;
            }
            else{
                $j=$i;
            }
            ?>
            <option value="<?php echo $j; ?>" <? if($j == $minuteA_aero){ echo"selected='selected'"; } ?>><?php echo $j; ?></option>
            <?php
        }
        ?>
      </SELECT>
      </div>
    <hr />
    <div id="spryradio2">
      <table width="925" height="47">
        <tr>
          <td width="213"><label>
            <input type="radio" name="to" value="to_stras" id="to_0" <?php if($destination==1){echo "checked=\"checked\"";}?>   onclick="changer_label('Horaire arrivée strasbourg', '1');" />
            Je retournais à Strasbourg</label></td>
            <td width="424"><label>
            <input type="radio" name="to" value="to_this_aero" id="to_1" <?php if($destination==3){echo "checked=\"checked\"";}?>  onclick="changer_label('', '3');" />
            je suis resté à cet aéroport pour une navette beaucoup plus tard</label></td>
            <td width="272"><label>
            <input type="radio" name="to" value="to_other_aero" id="to_2" <?php if($destination==2){echo "checked=\"checked\"";}?>  onclick="changer_label('Horaire arrivée autre aéroport', '2');" />
            je vais directement à un autre aéroport</label></td>
        </tr>
      </table>
      <span class="radioRequiredMsg">Effectuez une sélection</span></div>

    <div id="hda">

        <p>
          <label id="lbl_da">        Horaire D&eacute;part Aéroport :</label>
          <select name="heureD_aero" id="heureD_aero">
            <?php
        for($i = 0; $i<24; $i++){
            if($i<10){
                $j="0".$i;
            }
            else{
                $j=$i;
            }
            ?>
            <option value="<?php echo $j; ?>" <? if($j == $heureD_aero){ echo"selected='selected'"; } ?>><?php echo $j; ?></option>
            <?php
        }
        ?>
          </select>
          &nbsp;
          <select name="minuteD_aero" id="minuteD_aero">
               <?php
        for($i = 0; $i<60; $i=$i+5){
            if($i<10){
                $j="0".$i;
            }
            else{
                $j=$i;
            }
            ?>
            <option value="<?php echo $j; ?>" <? if($j == $minuteD_aero){ echo"selected='selected'"; } ?>><?php echo $j; ?></option>
            <?php
        }
        ?>
          </select>
       <br />
    </div>
    <div id="has">
      <label id="lbl_as">Horaire Arriv&eacute;e Strasbourg :</label>
      <select name="heureA_str" id="heureA_str">
             <?php
        for($i = 0; $i<24; $i++){
            if($i<10){
                $j="0".$i;
            }
            else{
                $j=$i;
            }
            ?>
            <option value="<?php echo $j; ?>" <? if($j == $heureA_str){ echo"selected='selected'"; } ?>><?php echo $j; ?></option>
            <?php
        }
        ?>
      </select>
      <select name="minuteA_str" id="minuteA_str">
              <?php
        for($i = 0; $i<60; $i=$i+5){
            if($i<10){
                $j="0".$i;
            }
            else{
                $j=$i;
            }
            ?>
            <option value="<?php echo $j; ?>" <? if($j == $minuteA_str){ echo"selected='selected'"; } ?>><?php echo $j; ?></option>
            <?php
        }
        ?>
      </select>
    </div>
    <hr />
      &nbsp;<br><br>

      <label>Kms au Départ :</label>
      <input type="texte" name="kmsD" value="<?php echo $kmsD;?>" size="6">&nbsp;
      <label>Kms à l'Arrivée :</label>
      <input type="texte" name="kmsA" value="<?php echo $kmsA;?>" size="6">&nbsp;
      <br /><br />
      <label>Niveau carburant Départ:</label>
      <SELECT NAME="niv_essence_depart">
            <?php
        for($i = 0; $i<=9; $i++){
            ?>
            <option value="<?php echo $i; ?>" <? if($i == $essenceD){ echo"selected='selected'"; } ?>><?php echo $j; ?></option>
            <?php
        }
        ?>
      </SELECT>
      &nbsp;

      <label>Niveau carburant Arrivée:</label>
      <SELECT NAME="niv_essence_arrivee">
            <?php
        for($i = 0; $i<=9; $i++){
            ?>
            <option value="<?php echo $i; ?>" <? if($i == $essenceA){ echo"selected='selected'"; } ?>><?php echo $j; ?></option>
            <?php
        }
        ?>
      </SELECT>
      &nbsp;

      <label> Payé Essence : (format 55.45)</label>
      <input type="texte" name="essence" size="6" value="<?php echo $essence;?>"><br><br>

      <label>Lavage Exterieur:</label>
      <SELECT NAME="lavext">
        <option value="0" <?php if($lavext==0){ echo"selected='selected'"; } ?>>NON</option>
        <option value="1" <?php if($lavext==1){ echo"selected='selected'"; } ?>>OUI</option>
      </SELECT>
      &nbsp;

      <label>Lavage Intérieur:</label>
      <SELECT NAME="lavint">
        <option value="0" <?php if($lavint==0){ echo"selected='selected'"; } ?>>NON</option>
        <option value="1" <?php if($lavint==1){ echo"selected='selected'"; } ?>>OUI</option>
      </SELECT>
      &nbsp;

      <label> Nombre d'unités:</label>
      <input type="texte" name="unites" size="4"  value="0">

      <label> Lieu de dépot du véhicule:</label>
      <input type="texte" name="depot" size="50"  value=" <?php echo $depot;?>">

    </p>

    explications à remplir si un retard trop important a été pris :
    <textarea name="expli" id="expli" cols="45" rows="5" value=" "> </textarea>

    <br>
    <br>


    </p>
    <input name="idcm" id="idcm" type="hidden" value="<?php echo $idcm ?>" />
    <input name="id_recap" id="id_recap" type="hidden" value="<?php echo $id_recap ?>" />
    <p align="center"><input type="button" value="Envoyer" onClick="valider();" />

    </p>
    </div>
</form>






<script type="text/javascript">
<!--
var spryradio1 = new Spry.Widget.ValidationRadio("spryradio1");
var spryradio2 = new Spry.Widget.ValidationRadio("spryradio2");
//-->
cacher_div("<?php echo $provenance?>")
if("<?php echo $destination?>"=="1"){
    changer_label('Horaire arrivée strasbourg', '1')
}
else if("<?php echo $destination?>"=="2"){
    changer_label('Horaire arrivée autre aéroport', '2')
}
else if("<?php echo $destination?>"=="3"){
    changer_label('', '2')
}


</script>
	