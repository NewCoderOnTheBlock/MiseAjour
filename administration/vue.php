<?php session_start(); 
/*
si la variable de session login n'existe pas cela siginifie que le visiteur
n'a pas de session ouverte, il n'est donc pas logué ni autorisé à
acceder à l'espace membres
*/
if (!isset($_SESSION['user'])  ) { 
   //header ('Location: index.php'); 
   echo '<script language="Javascript">
		<!--
		document.location.replace("index.html");
		// -->
		</script>'; 
  exit();  
 } 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

<head>

<title>vue d'ensemble</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="style.css" rel="stylesheet" type="text/css" > 

<!-- DEBUT SCRIPT CALENDRIER -->
<!-- European format dd-mm-yyyy -->
<script type="text/javascript" language="JavaScript">
// Title: Tigra Calendar
// URL: http://www.softcomplex.com/products/tigra_calendar/
// Version: 3.3 (European date format)
// Date: 09/01/2005 (mm/dd/yyyy)
// Note: Permission given to use this script in ANY kind of applications if
//    header lines are left unchanged.

// if two digit year input dates after this year considered 20 century.
var NUM_CENTYEAR = 30;
// is time input control required by default
var BUL_TIMECOMPONENT = false;
// are year scrolling buttons required by default
var BUL_YEARSCROLL = true;

var calendars = [];
var RE_NUM = /^\-?\d+$/;

function calendar1(obj_target) {

	// assigning methods
	this.gen_date = cal_gen_date1;
	this.gen_time = cal_gen_time1;
	this.gen_tsmp = cal_gen_tsmp1;
	this.prs_date = cal_prs_date1;
	this.prs_time = cal_prs_time1;
	this.prs_tsmp = cal_prs_tsmp1;
	this.popup    = cal_popup1;

	// validate input parameters
	if (!obj_target)
		return cal_error("Error calling the calendar: no target control specified");
	if (obj_target.value == null)
		return cal_error("Error calling the calendar: parameter specified is not valid target control");
	this.target = obj_target;
	this.time_comp = BUL_TIMECOMPONENT;
	this.year_scroll = BUL_YEARSCROLL;
	
	// register in global collections
	this.id = calendars.length;
	calendars[this.id] = this;
}

function cal_popup1 (str_datetime) {
	if (str_datetime) {
		this.dt_current = this.prs_tsmp(str_datetime);
	}
	else {
		this.dt_current = this.prs_tsmp(this.target.value);
		this.dt_selected = this.dt_current;
	}
	if (!this.dt_current) return;

	var obj_calwindow = window.open(
		'calendar.html?datetime=' + this.dt_current.valueOf()+ '&id=' + this.id,
		'Calendar', 'width=200,height='+(this.time_comp ? 215 : 190)+
		',status=no,resizable=no,top=200,left=200,dependent=yes,alwaysRaised=yes'
	);
	obj_calwindow.opener = window;
	obj_calwindow.focus();
}

// timestamp generating function
function cal_gen_tsmp1 (dt_datetime) {
	return(this.gen_date(dt_datetime) + ' ' + this.gen_time(dt_datetime));
}

// date generating function
function cal_gen_date1 (dt_datetime) {
	return (
		(dt_datetime.getDate() < 10 ? '0' : '') + dt_datetime.getDate() + "-"
		+ (dt_datetime.getMonth() < 9 ? '0' : '') + (dt_datetime.getMonth() + 1) + "-"
		+ dt_datetime.getFullYear()
	);
}
// time generating function
function cal_gen_time1 (dt_datetime) {
	return (
		(dt_datetime.getHours() < 10 ? '0' : '') + dt_datetime.getHours() + ":"
		+ (dt_datetime.getMinutes() < 10 ? '0' : '') + (dt_datetime.getMinutes()) + ":"
		+ (dt_datetime.getSeconds() < 10 ? '0' : '') + (dt_datetime.getSeconds())
	);
}

// timestamp parsing function
function cal_prs_tsmp1 (str_datetime) {
	// if no parameter specified return current timestamp
	if (!str_datetime)
		return (new Date());

	// if positive integer treat as milliseconds from epoch
	if (RE_NUM.exec(str_datetime))
		return new Date(str_datetime);
		
	// else treat as date in string format
	var arr_datetime = str_datetime.split(' ');
	return this.prs_time(arr_datetime[1], this.prs_date(arr_datetime[0]));
}

// date parsing function
function cal_prs_date1 (str_date) {

	var arr_date = str_date.split('-');

	if (arr_date.length != 3) return cal_error ("Invalid date format: '" + str_date + "'.\nFormat accepted is dd-mm-yyyy.");
	if (!arr_date[0]) return cal_error ("Invalid date format: '" + str_date + "'.\nNo day of month value can be found.");
	if (!RE_NUM.exec(arr_date[0])) return cal_error ("Invalid day of month value: '" + arr_date[0] + "'.\nAllowed values are unsigned integers.");
	if (!arr_date[1]) return cal_error ("Invalid date format: '" + str_date + "'.\nNo month value can be found.");
	if (!RE_NUM.exec(arr_date[1])) return cal_error ("Invalid month value: '" + arr_date[1] + "'.\nAllowed values are unsigned integers.");
	if (!arr_date[2]) return cal_error ("Invalid date format: '" + str_date + "'.\nNo year value can be found.");
	if (!RE_NUM.exec(arr_date[2])) return cal_error ("Invalid year value: '" + arr_date[2] + "'.\nAllowed values are unsigned integers.");

	var dt_date = new Date();
	dt_date.setDate(1);

	if (arr_date[1] < 1 || arr_date[1] > 12) return cal_error ("Invalid month value: '" + arr_date[1] + "'.\nAllowed range is 01-12.");
	dt_date.setMonth(arr_date[1]-1);
	 
	if (arr_date[2] < 100) arr_date[2] = Number(arr_date[2]) + (arr_date[2] < NUM_CENTYEAR ? 2000 : 1900);
	dt_date.setFullYear(arr_date[2]);

	var dt_numdays = new Date(arr_date[2], arr_date[1], 0);
	dt_date.setDate(arr_date[0]);
	if (dt_date.getMonth() != (arr_date[1]-1)) return cal_error ("Invalid day of month value: '" + arr_date[0] + "'.\nAllowed range is 01-"+dt_numdays.getDate()+".");

	return (dt_date)
}

// time parsing function
function cal_prs_time1 (str_time, dt_date) {

	if (!dt_date) return null;
	var arr_time = String(str_time ? str_time : '').split(':');

	if (!arr_time[0]) dt_date.setHours(0);
	else if (RE_NUM.exec(arr_time[0]))
		if (arr_time[0] < 24) dt_date.setHours(arr_time[0]);
		else return cal_error ("Invalid hours value: '" + arr_time[0] + "'.\nAllowed range is 00-23.");
	else return cal_error ("Invalid hours value: '" + arr_time[0] + "'.\nAllowed values are unsigned integers.");
	
	if (!arr_time[1]) dt_date.setMinutes(0);
	else if (RE_NUM.exec(arr_time[1]))
		if (arr_time[1] < 60) dt_date.setMinutes(arr_time[1]);
		else return cal_error ("Invalid minutes value: '" + arr_time[1] + "'.\nAllowed range is 00-59.");
	else return cal_error ("Invalid minutes value: '" + arr_time[1] + "'.\nAllowed values are unsigned integers.");

	if (!arr_time[2]) dt_date.setSeconds(0);
	else if (RE_NUM.exec(arr_time[2]))
		if (arr_time[2] < 60) dt_date.setSeconds(arr_time[2]);
		else return cal_error ("Invalid seconds value: '" + arr_time[2] + "'.\nAllowed range is 00-59.");
	else return cal_error ("Invalid seconds value: '" + arr_time[2] + "'.\nAllowed values are unsigned integers.");

	dt_date.setMilliseconds(0);
	return dt_date;
}

function cal_error (str_message) {
	alert (str_message);
	return null;
}
</script>
<!-- FIN SCRIPT CALENDRIER -->

</head>

<body>

<div id="container">
	<h1>Administration du site www.alsace-navette.com</h1>
	<?php
	  include("menu.php");
	  ?>
	
	<div id="centre">
<br><br><br><br><br><br><br><br>
	<form method="post" action= "requeteClient.php" name ="formulaire1">
	Vous pouvez classer en effectuant une <u>requete par client</u> <br>
	<input type="texte" name="client" size="30" ONFOCUS='this.value=""'>
	<input id="button1" type="submit" value="GO"/>
	</form>
	<form method="post" action= "requeteDate.php" name ="requeteDate">
	Vous pouvez classer en effectuant une <u>requete par date</u> (j-mois-années) <br>
	<input id="button1" type="submit" value="GO"/>
	

	<td bgcolor="#ffffff" valign="top" width="390">
		<input type="Text" name="input1" value="" size="20">
		<a href="javascript:cal1.popup();"><img src="../images/img/cal.gif" width="16" height="16" border="0" alt="Cliquez ici pour obtenir la date."></a><br>
	</td>

	<script language="JavaScript">
	<!-- // create calendar object(s) just after form tag closed
		 // specify form element as the only parameter (document.forms['formname'].elements['inputname']);
		 // note: you can have as many calendar objects as you need for your application
		var cal1 = new calendar1(document.forms['requeteDate'].elements['input1']);
		cal1.year_scroll = true;
		cal1.time_comp = false;
	</script>

	</form>

<?

// ouverture de la connexion et choix de la BD 
   
$connexion = mysql_connect('db922.1and1.fr', 'dbo206617947', 'D5ZEtV4h');
//$db = mysql_connect('localhost', 'root', '');
mysql_select_db('db206617947', $connexion);
//mysql_select_db('alsanavette',$db);


// prendre la liste des champs 
$sql= "SELECT d_depart,h_depart,nb_personnes,typetrajet,depart,destination,h_vol,n_vol,rassemblement,demande,date,datepaiement,paiement,montant,nom,nb_enfant,reservation FROM vue_globale where d_depart >= '".date('Y-m-d')."' ORDER BY d_depart";

$result = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
//prendre chaque rangée

if ($ligne = mysql_fetch_array($result)) 
{
    echo "<h1>Vue d'ensemble des réservations et des demandes</h1>";
	echo "<table>\n";
    echo "<thead><th>Date</th><th>Heure</th><th>Personnes</th><th>Nbr enfants</th><th>Trajet</th><th>Départ</th><th>Arrivée</th><th>Heure_Vol</th><th>N° Vol</th><th>Rassemblement</th><th>Demande</th><th>Date demande</th><th>Date paiement</th><th>Paiement</th><th>Montant</th><th>Nom</th><th>ID</th></thead>\n";
	do 
	{
		$date=substr($ligne[0],8,2).'/'.substr($ligne[0],5,2);
		$heure=substr($ligne[6],0,5);
		$dated=substr($ligne[10],8,2).'/'.substr($ligne[10],5,2);
		$datep=substr($ligne[11],8,2).'/'.substr($ligne[11],5,2);
		$ID1=$ligne["nom"];
		if ($ligne[12]<>'')
		{
		echo"<tr bgcolor='green'><td>$date</td><td>$ligne[1]</td><td>$ligne[2]</td><td>$ligne[14]</td><td>$ligne[3]</td><td>$ligne[4]</td><td>$ligne[5]</td><td>$heure</td><td>$ligne[7]</td><td>$ligne[8]</td><td>$ligne[9]</td><td>$dated</td><td>$datep</td><td>$ligne[12]</td><td>$ligne[13]</td>";
		echo "<td><b>";
		?>
		<a href="clients3.php?ID=<?echo $ID1?>"  target=_BLANK><? echo $ID1;?></a>
		<?
		echo "</a></b></td><td>$ligne[16]</td>";
		}
		else
		{
        echo"<tr><td>$date</td><td>$ligne[1]</td><td>$ligne[2]</td><td>$ligne[14]</td><td>$ligne[3]</td><td>$ligne[4]</td><td>$ligne[5]</td><td>$heure</td><td>$ligne[7]</td><td>$ligne[8]</td><td>$ligne[9]</td><td>$dated</td><td>$datep</td><td>$ligne[12]</td><td>$ligne[13]</td>";
		echo "<td><b>";
		?>
		<a href="clients3.php?ID=<?echo $ID1?>"  target=_BLANK><? echo $ID1;?></a>
		<?
		echo "</a></b></td><td>$ligne[16]</td>";
		}
	} 
    while ($ligne = mysql_fetch_array($result));
    echo "</table>\n";
} 
else  
{
echo "<h1>Vue d'ensemble des réservations et des demandes</h1>";
echo "Désolé, pas d'enregistrement !";   
}

mysql_close();

?>
</div>
	
</div>


	

</body>

</html>
