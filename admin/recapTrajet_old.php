
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
	


<div id="container">
	
<center><h1>Compte rendu de mission</h1></center>

<br><br><br><br><br><br><br><br>	
<?php 
// connexion à la bdd
include("connection.php");


	  $query="SELECT id_com, id_lieu, id_chauffeur, id_vehicule FROM aeroport_gestion_planning
			  WHERE id_com='".$_POST['idcm']."'";
		$result = mysql_query($query) or die (mysql_error());
		$r = @mysql_fetch_assoc($result);
		$idChauffPrevu = $r["id_chauffeur"];
		$idVehiculePrevu = $r["id_vehicule"];
		$idlieu = $r["id_lieu"];


?>
	
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
          
          
          
          <option value="<?php echo $idchauffeur; ?>" <? if($_SESSION['user_id'] == $idchauffeur){ echo"selected='selected'"; } ?>><?php echo $nom; ?></option>
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
          
          
          
          <option value="<?php echo $id_vehicule; ?>" <? if($idVehiculePrevu == $id_vehicule){ echo"selected='selected'"; } ?>><?php echo $libelle; ?></option>
          <?php } ?>
        </SELECT>
        
        
        <br><br>
        
        
        
        <label>Remarques:</label>
        <textarea name="remarques" rows="3" cols="30" size ="200"> </textarea>
        <br>
        <label>Passagers Aller qui ont r&eacute;serv&eacute; :</label>
        <select name="pass_aller_res">
          <option value="0">0</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
          <option value="6">6</option>
          <option value="7">7</option>
          <option value="8">8</option>
        </select>
        &nbsp;
        <label>Passagers Retour qui ont r&eacute;serv&eacute; :</label>
        <select name="pass_retour_res">
          <option value="0">0</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
          <option value="6">6</option>
          <option value="7">7</option>
          <option value="8">8</option>
        </select>
        </p>
      <p><br>
        
        
        
        <label>Passagers Aller qui n'avaient pas réservé:</label>
        <SELECT NAME="pass_aller_nonres">
          <option value="0">0</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="0">4</option>
          <option value="5">5</option>
          <option value="6">6</option>
          <option value="7">7</option>
          <option value="8">8</option>
        </SELECT>
        &nbsp;
        
        <label>Passagers Retour :</label>
        <SELECT NAME="pass_retour_nonres">
          <option value="0">0</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
          <option value="6">6</option>
          <option value="7">7</option>
          <option value="8">8</option>
        </SELECT>
        &nbsp;</p>
      <p>
        
        <label>Montant payé au conducteur en liquide : aller :</label>
        <input type="texte" name="montantA" size="5" value="0" onfocus="this.value = ''"/>€
        <label> retour:</label>
        <input type="texte" name="montantR" size="5" value="0" onfocus="this.value = ''"/>€
        </p>
      <p>Nombre Groupes Aller : 
        <select name="nb_grp_aller" id="nb_grp_aller">
          <option value="0" selected="selected">0</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
          <option value="6">6</option>
          <option value="7">7</option>
          <option value="8">8</option>
          <option value="9">9</option>
          <option value="10">10</option>
        </select>
        Nombre Groupes Retour : 
        <select name="nb_grp_retour" id="nb_grp_retour">
          <option value="0" selected="selected">0</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
          <option value="6">6</option>
          <option value="7">7</option>
          <option value="8">8</option>
          <option value="9">9</option>
          <option value="10">10</option>
          </select>
  </p>
      <p><label>J'ai pris des passagers à domicile</label>
        <input type="checkbox" name="priseDom" id="priseDom" value="aPriseDom" />
      </p>
      <p><label>J'ai déposé des passagers à domicile </label>
        <input type="checkbox" name="deposeDom" id="deposeDom" value="aDeposeDom" />
        <br>
        <br>
      </p>
    </div>
    <hr />			
    <div id="spryradio1">
      <table width="726" height="47">
        <tr>
          <td width="211"><label>
            <input type="radio" name="from" value="from_stras" id="from_0" checked="checked"  onclick="cacher_div('2');"/>
            Je venais de Strasbourg</label></td>
            <td width="191"><label>
            <input type="radio" name="from" value="from_this_aero" id="from_1" onclick="cacher_div('1');"/>
            j'étais déjà à cet aéroport</label></td>
            <td width="308"><label>
            <input type="radio" name="from" value="from_other_aero" id="from_2" onclick="cacher_div('3');"/>
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
        <option value="00">00</option>
        <option value="01">01</option>
        <option value="02">02</option>
        <option value="03">03</option>
        <option value="04">04</option>
        <option value="05">05</option>
        <option value="06">06</option>
        <option value="07">07</option>
        <option value="08">08</option>
        <option value="09">09</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
        <option value="13">13</option>
        <option value="14">14</option>
        <option value="15">15</option>
        <option value="16">16</option>
        <option value="17">17</option>
        <option value="18">18</option>
        <option value="19">19</option>
        <option value="20">20</option>
        <option value="21">21</option>
        <option value="22">22</option>
        <option value="23">23</option>
      </SELECT>
      &nbsp; 
      <SELECT NAME="minuteD_str" id="minuteD_str">
        <option value="00">00</option>
        <option value="05">05</option>
        <option value="10">10</option>
        <option value="15">15</option>
        <option value="20">20</option>
        <option value="25">25</option>
        <option value="30">30</option>
        <option value="35">35</option>
        <option value="40">40</option>
        <option value="45">45</option>
        <option value="50">50</option>
        <option value="55">55</option>
      </SELECT>
      &nbsp;
    </div>
      <div id="haa">
      <label id="lbl_aa"><br />
        Horaire Arrivée A&eacute;roport :</label>
      <SELECT NAME="heureA_aero" id="heureA_aero">
        <option value="00">00</option>
        <option value="01">01</option>
        <option value="02">02</option>
        <option value="03">03</option>
        <option value="04">04</option>
        <option value="05">05</option>
        <option value="06">06</option>
        <option value="07">07</option>
        <option value="08">08</option>
        <option value="09">09</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
        <option value="13">13</option>
        <option value="14">14</option>
        <option value="15">15</option>
        <option value="16">16</option>
        <option value="17">17</option>
        <option value="18">18</option>
        <option value="19">19</option>
        <option value="20">20</option>
        <option value="21">21</option>
        <option value="22">22</option>
        <option value="23">23</option>
      </SELECT>
      &nbsp;
      <SELECT NAME="minuteA_aero" id="minuteA_aero">
        <option value="00">00</option>
        <option value="05">05</option>
        <option value="10">10</option>
        <option value="15">15</option>
        <option value="20">20</option>
        <option value="25">25</option>
        <option value="30">30</option>
        <option value="35">35</option>
        <option value="40">40</option>
        <option value="45">45</option>
        <option value="50">50</option>
        <option value="55">55</option>
      </SELECT>
      </div>
    <hr />
    <div id="spryradio2">
      <table width="925" height="47">
        <tr>
          <td width="213"><label>
            <input type="radio" name="to" value="to_stras" id="to_0" checked="checked"  onclick="changer_label('Horaire arrivée strasbourg', '1');" />
            Je retournais à Strasbourg</label></td>
            <td width="424"><label>
            <input type="radio" name="to" value="to_this_aero" id="to_1" onclick="changer_label('', '3');" />
            je suis resté à cet aéroport pour une navette beaucoup plus tard</label></td>
            <td width="272"><label>
            <input type="radio" name="to" value="to_other_aero" id="to_2" onclick="changer_label('Horaire arrivée autre aéroport', '2');" />
            je vais directement à un autre aéroport</label></td>
        </tr>
      </table>
      <span class="radioRequiredMsg">Effectuez une sélection</span></div>
    
    <div id="hda">
      
        <p>
          <label id="lbl_da">        Horaire D&eacute;part Aéroport :</label>
          <select name="heureD_aero" id="heureD_aero">
            <option selected="selected">00</option>
            <option value="01">01</option>
            <option value="02">02</option>
            <option value="03">03</option>
            <option value="04">04</option>
            <option value="05">05</option>
            <option value="06">06</option>
            <option value="07">07</option>
            <option value="08">08</option>
            <option value="09">09</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
            <option value="13">13</option>
            <option value="14">14</option>
            <option value="15">15</option>
            <option value="16">16</option>
            <option value="17">17</option>
            <option value="18">18</option>
            <option value="19">19</option>
            <option value="20">20</option>
            <option value="21">21</option>
            <option value="22">22</option>
            <option value="23">23</option>
          </select>
          &nbsp;
          <select name="minuteD_aero" id="minuteD_aero">
            <option value="00">00</option>
            <option value="05">05</option>
            <option value="10">10</option>
            <option value="15">15</option>
            <option value="20">20</option>
            <option value="25">25</option>
            <option value="30">30</option>
            <option value="35">35</option>
            <option value="40">40</option>
            <option value="45">45</option>
            <option value="50">50</option>
            <option value="55">55</option>
          </select>
       <br /> 
    </div>
    <div id="has">
      <label id="lbl_as">Horaire Arriv&eacute;e Strasbourg :</label>
      <select name="heureA_str" id="heureA_str">
        <option value="00">00</option>
        <option value="01">01</option>
        <option value="02">02</option>
        <option value="03">03</option>
        <option value="04">04</option>
        <option value="05">05</option>
        <option value="06">06</option>
        <option value="07">07</option>
        <option value="08">08</option>
        <option value="09">09</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
        <option value="13">13</option>
        <option value="14">14</option>
        <option value="15">15</option>
        <option value="16">16</option>
        <option value="17">17</option>
        <option value="18">18</option>
        <option value="19">19</option>
        <option value="20">20</option>
        <option value="21">21</option>
        <option value="22">22</option>
        <option value="23">23</option>
      </select>
      <select name="minuteA_str" id="minuteA_str">
        <option value="00">00</option>
        <option value="05">05</option>
        <option value="10">10</option>
        <option value="15">15</option>
        <option value="20">20</option>
        <option value="25">25</option>
        <option value="30">30</option>
        <option value="35">35</option>
        <option value="40">40</option>
        <option value="45">45</option>
        <option value="50">50</option>
        <option value="55">55</option>
      </select>
    </div>
    <hr />
      &nbsp;<br><br>
      
      <label>Kms au Départ :</label>
      <input type="texte" name="kmsD" size="6" ONFOCUS='this.value=""'>&nbsp;
      <label>Kms à l'Arrivée :</label>
      <input type="texte" name="kmsA" size="6" ONFOCUS='this.value=""'>&nbsp;
      <br /><br />
      <label>Niveau carburant Départ:</label>
      <SELECT NAME="niv_essence_depart">
        <option value="0">0</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
      </SELECT>
      &nbsp;
      
      <label>Niveau carburant Arrivée:</label>
      <SELECT NAME="niv_essence_arrivee">
        <option value="0">0</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
      </SELECT>
      &nbsp;
      
      <label> Payé Essence : (format 55.45)</label>
      <input type="texte" name="essence" size="6" value="0">
      <label> Consommation moyenne : </label>
      <input type="texte" name="consoMoyenne" size="6" value="0">
      <br><br>
      <label>Lavage Exterieur:</label>
      <SELECT NAME="lavext">
        <option value="0">NON</option>
        <option value="1">OUI</option>
      </SELECT>
      &nbsp;
      
      <label>Lavage Intérieur:</label>
      <SELECT NAME="lavint">
        <option value="0">NON</option>
        <option value="1">OUI</option>
      </SELECT>
      &nbsp;
      
      <label> Nombre d'unités:</label>
      <input type="texte" name="unites" size="4"  value="0" ONFOCUS='this.value=""'>
      
      <label> Lieu de dépot du véhicule:</label>
      <input type="texte" name="depot" size="50"  value=" " ONFOCUS='this.value=""'>
      
    </p>
    
    explications à remplir si un retard trop important a été pris :
    <textarea name="expli" id="expli" cols="45" rows="5"> </textarea>
    
    <br>
    <br>
    
    
    </p>
    <input name="idcm" id="idcm" type="hidden" value="<?php echo $_POST['idcm']; ?>" />
    <p align="center"><input type="button" value="Envoyer" onClick="valider();" />
      
    </p>	
    </div>
</form>


				



<script type="text/javascript">
<!--
var spryradio1 = new Spry.Widget.ValidationRadio("spryradio1");
var spryradio2 = new Spry.Widget.ValidationRadio("spryradio2");
//-->
</script>
	