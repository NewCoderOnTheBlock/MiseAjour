<?php 
	include("verifAuth.php");
	
	include("../includes/fonctions.php");
	require_once("../libs/db.php");
	/*
		KEMPF Pierre-Louis :
		Cette page permet de connaitre les 20 demandes n'ayant pas abouties
		se rapprochant le plus de la date actuelle.
		-> Permet de contacter la personne si celle-ci n'a pas réservé
	*/
?>

<!-- DIV CONTENANT LE CALENDRIER -->

<script type="text/javascript">

var ds_i_date = new Date();

<?php	
	if($_GET['action']=="2")
	{
		$t_date = explode('-', $_POST['date']);

		if($_POST['type_cal'] == "jour")
		{
	?>
		ds_c_month = <?php echo $t_date[1]; ?>;
		ds_c_year = <?php echo $t_date[2]; ?>;
	<?php
		}
		else
		{
		?>
			ds_c_month = <?php echo intval($t_date[0]); ?>;
			ds_c_year = <?php echo $t_date[1]; ?>;
		<?php
		}
	}
	else
	{
	?>
		ds_c_month = ds_i_date.getMonth() + 1;
		ds_c_year = ds_i_date.getFullYear();
	<?php
	}
?>
</script>

<?php
	// Gestion de la date en fonction du calendrier
	$limite = "";
	if($_GET['action'] == "2"){
		//on récupère la date en question
		$date = $_POST['date'];
		$type_cal = $_POST['type_cal'];
		
		if($type_cal == "jour")
		{
			//et on complète la requète pour prendra la date en compte
			$msg = " WHERE DATE_FORMAT(date_aller, '%d-%m-%Y' ) ='".$date."' ";
		}
		else
		{
			//et on complète la requète pour prendra la date en compte (seulement le mois
			$msg = " WHERE DATE_FORMAT(date_aller, '%m-%Y' ) ='".$date."' ";
		}
		
	//SI L'UTILISATEUR N'A PAS CHOISI DE DATE DANS LE CALENDRIER
	}else{
		$msg = " WHERE date_aller >= NOW() ";
		$limite = " LIMIT 40";
	}
?>

<div style="width:100%;text-align:center" id='div_demande'>
	<br /><br />
	<div>
        <table class="ds_box" cellpadding="0" cellspacing="0" id="ds_conclass" style="display: none;">
			<tr>
				<td id="ds_calclass"></td>
			</tr>
        </table>
    </div>
    
    <script src="scripts/calendar.js" type="text/javascript"></script>
	<script type="text/javascript">
    <!--
        ds_sh();
    //-->
    </script>
	
	<!-- FORMULAIRE ENVOYE LORS D'UN CLIC SUR UN CHIFFRE DU CALENDRIER (voir les 6 dernières ligne de calendar.js) -->
	<form id="form1" name="form1" action="index.php?p=31&amp;action=2" method="post" >
		<!-- champ caché du formulaire contenant la date défini lors l'un clic sur un chiffre du calendrier -->
		<input id ="date" name="date" type="hidden" value="" />
		<input type="hidden" name="type_cal" id="type_cal" value="" />
	</form>
	
	<br /><br />
	
	<?php		
		$req = query("	SELECT *, DATE_FORMAT(date_demande, '%d/%m/%Y %H:%i') as dateDemande, DATE_FORMAT(date_aller, '%d/%m/%Y %H:%i') as dateAller, DATE_FORMAT(date_retour, '%d/%m/%Y %H:%i') as dateRetour
						FROM aeroport_demande_non_finalisee
						".$msg."
						ORDER BY date_aller
						".$limite."");
		
		echo "
			<div style='text-align:center;width:1100px;margin-left:auto;margin-right:auto'>
			<h2>Demandes n'ayant pas abouties.</h2>
		";
			
		while ($r = $req->fetch()){ 
			$libelle_type = ($r['estSimple'] == 1) ? "Aller" : "Aller-Retour";
			
			echo "
			<table style='width: 1080px;border:solid #222222 2px;' frame='all' rules='all'> 
				<tr>
					<td style='text-align:left;padding-left:10px;font-style:italic;'>[".$r['id']."] le ".$r['dateDemande']."</td>
					<td colspan='4' style='border-top:solid white 1px;'></td>
				</tr>
				<tr style='background:#DDDDDD;'>
					<th width='25%'>Client</th>
					<th width='25%'>Email</th>
					<th width='25%'>Type</th>
					<th width='10%'>Nb. Pers</th>
					<th width='15%'>Langue</th>
				</tr>
				<tr>
					<td>".$r['nom_client']."</td>
					<td><a href=\"mailto:".$r['email_client']."\">".$r['email_client']."</a></td>
					<td>".$libelle_type."</td>
					<td>".$r['nbPers']."</td>
					<td>".$r['langue']."</td>
				</tr>			
				<tr style='background:#DDDDDD;'>
					<th>Type</th>
					<th>Date</th>
					<th colspan='3'>Trajet</th>
				</tr>
				<tr style='background:#BBFFBB;'>
					<th>Aller</th>
					<td><span style='color:#003C9F'>".$r['dateAller']."</span></td>
					<td colspan='3'><span style='font-style:italic;'>".get_lieu($r['id_lieu_dep'])."</span> à <span style=\"font-style:italic;\">".get_lieu($r['id_lieu_dest'])."</span></td>
				</tr>";
				
			if ($r['estSimple'] == 0){
				echo "
				<tr style='background:#FFBBBB;'>
					<th>Retour</th>
					<td><span style='color:#003C9F'>".$r['dateRetour']."</span></td>
					<td colspan='3'><span style='font-style:italic;'>".get_lieu($r['id_lieu_dest'])."</span> à <span style=\"font-style:italic;\">".get_lieu($r['id_lieu_dep'])."</span></td>
				</tr>";
			}
				
			echo "</table>
				<br />";
			
		}
		
		echo "</div>";
		
		$req->closeCursor();

	?>
</div>