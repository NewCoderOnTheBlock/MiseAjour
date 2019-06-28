<?php
	include("verifAuth.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="style.css" rel="stylesheet" type="text/css" /> 
</head>
<body>
<?php 
function execution($req)
{	
	if($_SERVER["SERVER_ADDR"]=="192.168.3.2") // si localhost
	{
		$c = mysql_connect('localhost', 'root', '');
		mysql_select_db('a-n');
	}
	else
	{
		$c = mysql_connect('db922.1and1.fr', 'dbo206617947', 'D5ZEtV4h');
		mysql_select_db('db206617947');
	}
	
	mysql_query("SET NAMES 'utf8'");
	mysql_query('SET CHARACTER SET utf8');
	
	$res = mysql_query($req,$c);
	mysql_close($c);
	return $res;
}
?>
<div style="width:100%; text-align:center" id='conducteur'>
	<br />
    <span style="font-family:Verdana, Geneva, sans-serif; font-size:16px; font-weight:bold;">Gestion du personnel</span>
    <br />
      <fieldset class="conducteur">
      	  <legend id='lgdConducteur'>Ajout d'un conducteur</legend>
	      <label for='nom' class='lblForm'>Nom : </label> <input name="nom" type="text" size="15" maxlength="40" id='nom' class='txtForm' />
	      <br/><br/>
	      <label for='prenom' class='lblForm'>Prénom : </label><input name="prenom" type="text" size="15" maxlength="40" id='prenom' class='txtForm' />
	      <br/><br />
        <label class='lblForm' for='adresse'>Adresse : </label><input name="adresse" type="text" size="15" maxlength="40" id='adresse' class='txtForm' />
          <br/><br/>
          <label for='cp' class='lblForm'>Code postal : </label><input maxlength='5' name="cp" type="text" size="15" maxlength="40" id='cp' class='txtForm' />
          <br/><br/>
         <label for='ville' class='lblForm'>Ville : </label><input name="ville" type="text" size="15" maxlength="40" id='ville' class='txtForm' />
          <br/><br/>
          <label for='mail' class='lblForm'>Email : </label><input name="mail" type="text" size="15" maxlength="40" id='mail' class='txtForm' />
          <br/><br/>
          <label for='fixe' class='lblForm'>Téléphone fixe : </label><input maxlength='10' name="fixe" type="text" size="15" maxlength="40" id='fixe' class='txtForm' />
          <br/><br/>
          <label for='portable' class='lblForm'>Téléphone portable : </label><input maxlength='10' name="portable" type="text" size="15" maxlength="40" id='portable' class='txtForm' />
          <br /><br />
          <input type='button' value='Ajouter le conducteur' onclick='verificationInformation()' />
      </fieldset>
      <br />
      <fieldset class="conducteur">
      	<legend id='lgdConducteur'>Supprimer un conducteur</legend>
        <select size="1" id="lstConducteur" style="width:200px;">
        <?php 
            $req = "select idchauffeur, nom, prenom from chauffeur 
                    where idchauffeur != 0
                    AND idchauffeur not in (select id_chauffeur from aeroport_conducteurs_exclus)";
            $res = execution($req);
            $nb = mysql_num_rows($res);

             while ($r = @mysql_fetch_assoc($res)){ 
             
                 $nom = $r['nom'];
                 $prenom = $r['prenom'];
                 $idchauffeur = $r['idchauffeur'];		
            
        ?>
        <option value="<?php echo $idchauffeur; ?>"><?php echo strtoupper($nom)." ".ucfirst($prenom); ?></option>
        <?php 
             }
        ?>
        </select>
        <br /><br />
        <input type="button" value="Supprimer le conducteur" onclick='supprimerConducteur()' />
      </fieldset>
</div>

<script type='text/javascript'>
function verificationInformation()
{
	var nom = document.getElementById('nom').value;
	var prenom = document.getElementById('prenom').value;
	var adresse = document.getElementById('adresse').value;
	var cp = document.getElementById('cp').value;
	var ville = document.getElementById('ville').value;
	var mail = document.getElementById('mail').value;
	var fixe = document.getElementById('fixe').value;
	var portable = document.getElementById('portable').value;

	if(nom=='' || prenom=='' || adresse=='' || cp=='' || ville=='' || mail=='')
		alert("Merci de renseigner tous les champs.");
	else
	{
		param='action=ajoutConducteur&nom='+nom+'&prenom='+prenom+'&adresse='+adresse+'&cp='+cp+'&ville='+ville+'&mail='+mail+'&fixe='+fixe+'&portable='+portable;
		ajax('./php/traitementAjax.php',param,'ajoutConducteur');
	}
}

function supprimerConducteur()
{
	if(confirm("Voulez-vous supprimer le conducteur ?"))
	{
		var id = document.getElementById('lstConducteur').options[document.getElementById('lstConducteur').selectedIndex].value;
		param='action=supprimerConducteur&id='+id;
		ajax('./php/traitementAjax.php',param,'supprimerConducteur');
	}
}

/** FONCTION AJAX **/
function ajax(url,param,choix)
{
	var httpRequest = false;
	
	if (window.XMLHttpRequest) {
		httpRequest = new XMLHttpRequest();
		if (httpRequest.overrideMimeType) {
			httpRequest.overrideMimeType('text/xml');
		}
	}
	else if (window.ActiveXObject) { // IE
		try {
			httpRequest = new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch (e) {
			try {
				httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e) {}
		}
	}
	
	if (!httpRequest) {
		alert('Abandon :( Impossible de creer une instance XMLHTTP');
		return false;
	}
	httpRequest.onreadystatechange = function() { traiter(httpRequest,choix); };
	httpRequest.open("POST",url,true);
	httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=iso-8859-15');
	httpRequest.send(param);
}

function traiter(httpRequest,choix)
{
	
	if (httpRequest.readyState == 4)
	{
		if (httpRequest.status == 200) 
		{
			if(choix=='ajoutConducteur')
				document.getElementById('conducteur').innerHTML = "Ajout du conducteur réussi !";
			else if(choix=='supprimerConducteur')
				document.getElementById('conducteur').innerHTML = "Suppression du conducteur réussie !";
		}
		else{}
	}
	else
	{
	}
}
/** FIN FONCTION AJAX **/
</script>
</body>
</html>