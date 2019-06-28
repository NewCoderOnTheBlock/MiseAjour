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

<title>saisir véhicule</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="style.css" rel="stylesheet" type="text/css" > 
<link href="styles/formulaire1.css" rel="stylesheet" type="text/css" >

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

function Choix(form) 
{
	 /* document.formulaire.h_depart.value */
	if(form.Rubrique.selectedIndex == 0)
	{
		form.Page.options[0].text="";
		form.Page.options[1].text="";
		form.Page.options[2].text="";
		form.Page.options[3].text="";
		form.Page.options[4].text="";
		form.Page.options[5].text="";
		form.Page.options[6].text="";
		form.Page.options[7].text="";
		form.Page.options[8].text="";
		form.Page.options[9].text="";
		form.Page.options[10].text="";
	}
	else if(form.Rubrique.selectedIndex == 1)
	{
		form.Page.options[0].text="";
		form.Page.options[1].text="Baden";
		form.Page.options[2].text="Bale";
		form.Page.options[3].text="Main";
		form.Page.options[4].text="Hahn";
		form.Page.options[5].text="Stuttgart";
		form.Page.options[6].text="Zurich";
		form.Page.options[7].text="Autre";
		form.Page.options[8].text="";
		form.Page.options[9].text="";
		form.Page.options[10].text="";
	}
	else if(form.Rubrique.selectedIndex == 2)
	{
		form.Page.options[0].text="";
		form.Page.options[1].text="Basse Alsace 10H";
		form.Page.options[2].text="Basse Alsace 15H";
		form.Page.options[3].text="Le Long du Rhin";
		form.Page.options[4].text="Au Pays du Kochersberg";
		form.Page.options[5].text="Bien Etre 1";
		form.Page.options[6].text="Bien Etre 2";
		form.Page.options[7].text="Bien Etre 3";
		form.Page.options[8].text="Route des Vins 1";
		form.Page.options[9].text="Route des Vins 2";
		form.Page.options[10].text="Route des Vins 3";
		
		
	}
	else if(form.Rubrique.selectedIndex == 3)
	{		
		form.Page.options[0].text="";
		form.Page.options[1].text="1H";
		form.Page.options[2].text="2H";
		form.Page.options[3].text="3H";
		form.Page.options[4].text="4H";
		form.Page.options[5].text="5H";
		form.Page.options[6].text="6H";
		form.Page.options[7].text="";
		form.Page.options[8].text="";
		form.Page.options[9].text="";
		form.Page.options[10].text="";
	}

}

</script>
<!-- FIN SCRIPT CALENDRIER -->


</head>

<body>

<div id="container">
	
<h1>Saisie Véhicule</h1>

<?php
	  include("menu.php");
	  ?>
<br><br><br><br><br><br><br><br>	
<!-- DEBUT DU SCRIPT CALENDRIER -->
	
<form name="formulaire" method="post" action= "navette1.php">

<label>Véhicule:</label>
<SELECT NAME="vehicule">
				<OPTION>Nissan1</OPTION>
				<OPTION>Renault1</OPTION>
</SELECT><br><br>

<label>Date de Départ:</label>
<input type="Text" name="input1" value="" size="20">
<a href="javascript:cal1.popup();"><img src="../images/img/cal.gif" width="16" height="16" border="0" alt="Cliquez ici pour obtenir la date."></a><br><br>

<label>Conducteur:</label>
<SELECT NAME="conducteur">
				<OPTION>Philippe</OPTION>
				<OPTION>Pacha</OPTION>
				<OPTION>Hamid</OPTION>
				<OPTION>Kevin</OPTION>
</SELECT>&nbsp;								

<label>Service:</label>
<SELECT NAME="Rubrique" onClick='Choix(form)'>
				<OPTION></OPTION>
				<OPTION>Aeroport</OPTION>
				<OPTION>Tourisme</OPTION>
				<OPTION>Laissez Vous Conduire</OPTION>
				<OPTION>Service</OPTION>
</SELECT>&nbsp;

<label>Navette/Circuit:</label>
<SELECT NAME="Page">
				<OPTION></OPTION>
				<OPTION></OPTION>
				<OPTION></OPTION>	
				<OPTION></OPTION>
				<OPTION></OPTION>
				<OPTION></OPTION>	
				<OPTION></OPTION>
				<OPTION></OPTION>
				<OPTION></OPTION>
				<OPTION></OPTION>
				<OPTION></OPTION>		
</SELECT>&nbsp;	
											

<label>Remarques:</label>
<textarea name="remarques" rows="3" cols="30" size ="200"></textarea><br><br>

<label>Groupes:</label>
<SELECT NAME="groupe">
				<OPTION>1</OPTION>
				<OPTION>2</OPTION>
				<OPTION>3</OPTION>
				<OPTION>4</OPTION>
				<OPTION>5</OPTION>
				<OPTION>6</OPTION>
				<OPTION>7</OPTION>
				<OPTION>8</OPTION>
</SELECT>&nbsp;

<label>Passagers Aller:</label>
<SELECT NAME="pass_aller">
				<OPTION>0</OPTION>
				<OPTION>1</OPTION>
				<OPTION>2</OPTION>
				<OPTION>3</OPTION>
				<OPTION>4</OPTION>
				<OPTION>5</OPTION>
				<OPTION>6</OPTION>
				<OPTION>7</OPTION>
				<OPTION>8</OPTION>
</SELECT>&nbsp;

<label>Passagers Retour:</label>
<SELECT NAME="pass_retour">
				<OPTION>0</OPTION>
				<OPTION>1</OPTION>
				<OPTION>2</OPTION>
				<OPTION>3</OPTION>
				<OPTION>4</OPTION>
				<OPTION>5</OPTION>
				<OPTION>6</OPTION>
				<OPTION>7</OPTION>
				<OPTION>8</OPTION>
</SELECT>&nbsp;

<label>Montant payé au conducteur :</label>
			<input type="texte" name="mnt" size="4" ONFOCUS='this.value=""'><br><br>
			
<label>Horaire Départ:</label>
<SELECT NAME="heureD">
				<OPTION>00</OPTION>
				<OPTION>01</OPTION>
				<OPTION>02</OPTION>
				<OPTION>03</OPTION>
				<OPTION>04</OPTION>
				<OPTION>05</OPTION>
				<OPTION>06</OPTION>
				<OPTION>07</OPTION>
				<OPTION>08</OPTION>
				<OPTION>09</OPTION>
				<OPTION>10</OPTION>
				<OPTION>11</OPTION>
				<OPTION>12</OPTION>
				<OPTION>13</OPTION>
				<OPTION>14</OPTION>
				<OPTION>15</OPTION>
				<OPTION>16</OPTION>
				<OPTION>17</OPTION>
				<OPTION>18</OPTION>
				<OPTION>19</OPTION>
				<OPTION>20</OPTION>
				<OPTION>21</OPTION>
				<OPTION>22</OPTION>
				<OPTION>23</OPTION>
</SELECT>&nbsp;
<SELECT NAME="minuteD">
				<OPTION>00</OPTION>
				<OPTION>05</OPTION>
				<OPTION>10</OPTION>
				<OPTION>15</OPTION>
				<OPTION>20</OPTION>
				<OPTION>25</OPTION>
				<OPTION>30</OPTION>
				<OPTION>35</OPTION>
				<OPTION>40</OPTION>
				<OPTION>45</OPTION>
				<OPTION>50</OPTION>
				<OPTION>55</OPTION>
</SELECT>&nbsp;

<label>Horaire Arrivée:</label>
<SELECT NAME="heureA">
				<OPTION>00</OPTION>
				<OPTION>01</OPTION>
				<OPTION>02</OPTION>
				<OPTION>03</OPTION>
				<OPTION>04</OPTION>
				<OPTION>05</OPTION>
				<OPTION>06</OPTION>
				<OPTION>07</OPTION>
				<OPTION>08</OPTION>
				<OPTION>09</OPTION>
				<OPTION>10</OPTION>
				<OPTION>11</OPTION>
				<OPTION>12</OPTION>
				<OPTION>13</OPTION>
				<OPTION>14</OPTION>
				<OPTION>15</OPTION>
				<OPTION>16</OPTION>
				<OPTION>17</OPTION>
				<OPTION>18</OPTION>
				<OPTION>19</OPTION>
				<OPTION>20</OPTION>
				<OPTION>21</OPTION>
				<OPTION>22</OPTION>
				<OPTION>23</OPTION>
</SELECT>&nbsp;
<SELECT NAME="minuteA">
				<OPTION>00</OPTION>
				<OPTION>05</OPTION>
				<OPTION>10</OPTION>
				<OPTION>15</OPTION>
				<OPTION>20</OPTION>
				<OPTION>25</OPTION>
				<OPTION>30</OPTION>
				<OPTION>35</OPTION>
				<OPTION>40</OPTION>
				<OPTION>45</OPTION>
				<OPTION>50</OPTION>
				<OPTION>55</OPTION>
</SELECT>&nbsp;

<label>Prise ou dépot Domicile:</label>
<SELECT NAME="domicile">
				<OPTION>0</OPTION>
				<OPTION>1</OPTION>
				<OPTION>2</OPTION>
				<OPTION>3</OPTION>
				<OPTION>4</OPTION>
				<OPTION>5</OPTION>
				<OPTION>6</OPTION>
				<OPTION>7</OPTION>
				<OPTION>8</OPTION>
				<OPTION>9</OPTION>
				<OPTION>10</OPTION>
				<OPTION>11</OPTION>
				<OPTION>12</OPTION>
				<OPTION>13</OPTION>
				<OPTION>14</OPTION>
				<OPTION>15</OPTION>
				<OPTION>16</OPTION>
</SELECT>&nbsp;<br><br>

<label>Kms au Départ :</label>
<input type="texte" name="kmsD" size="6" ONFOCUS='this.value=""'>&nbsp;
<label>Kms à l'Arrivée :</label>
<input type="texte" name="kmsA" size="6" ONFOCUS='this.value=""'>&nbsp;

<label>Niveau Essence Départ:</label>
<SELECT NAME="nivD">
				<OPTION>0</OPTION>
				<OPTION>1</OPTION>
				<OPTION>2</OPTION>
				<OPTION>3</OPTION>
				<OPTION>4</OPTION>
				<OPTION>5</OPTION>
				<OPTION>6</OPTION>
				<OPTION>7</OPTION>
				<OPTION>8</OPTION>
				<OPTION>9</OPTION>
</SELECT>&nbsp;

<label>Niveau Essence Arrivée:</label>
<SELECT NAME="nivA">
				<OPTION>0</OPTION>
				<OPTION>1</OPTION>
				<OPTION>2</OPTION>
				<OPTION>3</OPTION>
				<OPTION>4</OPTION>
				<OPTION>5</OPTION>
				<OPTION>6</OPTION>
				<OPTION>7</OPTION>
				<OPTION>8</OPTION>
				<OPTION>9</OPTION>
</SELECT>&nbsp;

<label> Payé Essence : (format 55.45)</label>
<input type="texte" name="essence" size="4" ONFOCUS='this.value=""'><br><br>

<label>Lavage Exterieur:</label>
<SELECT NAME="lavext">
				<OPTION>NON</OPTION>
				<OPTION>OUI</OPTION>
</SELECT>&nbsp;

<label>Lavage Intérieur:</label>
<SELECT NAME="lavint">
				<OPTION>NON</OPTION>
				<OPTION>OUI</OPTION>
</SELECT>&nbsp;

<label> Nombre d'unités:</label>
<input type="texte" name="unites" size="4" ONFOCUS='this.value=""'>

<label> Lieu de dépot du véhicule:</label>
<input type="texte" name="depot" size="50" ONFOCUS='this.value=""'>

<br><br>


<p align="center"><input type="submit" value="Envoyer" />
<input type="reset" value="Effacer" />
</p>	

</form>

<script type="text/javascript" language="JavaScript">

// create calendar object(s) just after form tag closed
// specify form element as the only parameter (document.forms['formname'].elements['inputname']);
// note: you can have as many calendar objects as you need for your application
var cal1 = new calendar1(document.forms['formulaire'].elements['input1']);
cal1.year_scroll = true;
cal1.time_comp = false;	
</script>	
				

</div>
</body>
</html>


