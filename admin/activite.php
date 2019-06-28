<?php
include 'connection.php';

?>
<script type="text/javascript">
		function valider()
		{
			var ok = true;
			var maform = document.forms[0];
			for (var champ=0; champ < maform .elements.length-3; champ++) {
				if(maform.elements[champ].value == ""){
					ok = false;
				}
			}
			if(ok)
			{ // les données sont ok on test la longueur du champ explications, s'il est vide on vérifie que les horaire sont correctes, sinon on autorise l'envoi du formulaire
				if((document.getElementById('id_activite').value =="6")&&(document.getElementById('autre_activite').value =="")){

					alert("Saisissez tous les champs SVP");
                    return false;
				}
				else{
                    document.getElementById("form").submit();
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
<br />
<br />
<div style="width:100%;">
	<div style="text-align:center;width:50%;margin:auto;">
        <h2><u>Récapitulatif des activités</u></h2>
        <br />
        <br />
        <form name="form" id="form" action="activite_final.php" method="POST">
            <label for="date">Date de l'activité : </label>
            
            <input type="hidden" id="hdn_date" name="hdn_date" />
            <br />
            <br />
            <table class="ds_box" cellpadding="0" cellspacing="0" id="ds_conclass" style="display: none;">
                <tr>
                    <td id="ds_calclass"></td>
                </tr>
            </table>
            <br />
            <input type="text" id="date" disabled="disabled" />
            <script src="scripts/calendar3.js" type="text/javascript"></script>
            <script type="text/javascript">
            <!--
                var ds_i_date = new Date();
                ds_c_month = ds_i_date.getMonth() + 1;
                ds_c_year = ds_i_date.getFullYear();
                ds_sh();
            //-->
            </script>
            <br />
            <br />
            <br />
            <u>Ordre de mission:</u>
            <br />
            <br />
            <label>reçu comment?</label>
            <select name="comment_ordre" id="comment_ordre">
                <option value="directement">directement</option>
                <option value="mail">par mail</option>
                <option value="telephone">par téléphone</option>
            </select>
            <br />
            <br />
            <label>De :</label>
            <select name="id_admin_ordre" id="id_admin_ordre">
                <?php
                $req = "select iduser, nom, prenom from zzprofile where iduser not in (select iduser from aeroport_administratifs_exclus)";
                    $res = mysql_query($req);
                    $nb = mysql_num_rows($res);

                     while ($r = @mysql_fetch_assoc($res)){

                         $nom = $r['nom'];
                         $prenom = $r['prenom'];
                         $idUser = $r['iduser'];
                         echo"<option value=\"".$idUser."\">".$prenom." ".$nom."</option>";
                     }
                ?>
                
            </select>
            <br />
            <br />
            <label>Heure de début :</label>
            <SELECT NAME="heureD" id="heureD">
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
              <SELECT NAME="minuteD" id="minuteD">
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
              <br />
            <br />
            <label>Heure de fin :</label>
            <SELECT NAME="heureA" id="heureA">
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
              <SELECT NAME="minuteA" id="minuteA">
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
                <option value="55" onclick="alert('ça marche')">55</option>
              </SELECT>
               <br />
            <br />
            <br />
            <u>Activité:</u>
            <br />
            <br />
            <select name="id_activite" id="id_activite">
                <?php
                $req = "select id_activite, libelle_activite FROM activites where id_activite != 6";
                    $res = mysql_query($req);

                     while ($r = @mysql_fetch_assoc($res)){

                         $id_activite = $r['id_activite'];
                         $libelle_activite = $r['libelle_activite'];

                         echo"<option value=\"".$id_activite."\" onclick=\"document.getElementById('autre').style.display='none'\">".$libelle_activite."</option>";
                     }
                ?>
                <option value="6" onclick="document.getElementById('autre').style.display='block'">Autre...</option>
            </select>
            <br />
            <br />
            <div id="autre" style="display:none">
                <label>Précisez : </label>
                <input type="text" id="autre_activite" name="autre_activite" />
            </div>
            <br />
            <br />
            <label>Commentaire :</label>
            <textarea name="remarques" id="remarques" rows="4" cols="20"></textarea>
            <br />
            <br />
            <input type="button" value="Envoyer" onClick="valider();" />

        </form>
    </div>
</div>