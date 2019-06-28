// Fonction in_array (Valeur X est dans un tableau Y ou pas)
function inArray(needle, haystack) {
    var length = haystack.length;
    for(var i = 0; i < length; i++) {
        if(haystack[i] == needle) return true;
    }
    return false;
}


// <!-- <![CDATA[
/*

*/
// Project: Dynamic Date Selector (DtTvB) - 2006-03-16
// Script featured on JavaScript Kit- http://www.javascriptkit.com
// Code begin...
// Set the initial date.
var ds_i_date = new Date();
ds_c_month = ds_i_date.getMonth() + 1;
ds_c_year = ds_i_date.getFullYear();

var today = new Date();

var elt_src;
var lang = "fr";

function compare_to(d1, d2)
{
	if(d1.getTime() < d2.getTime())
		return -1;
	else if(d1.getTime() > d2.getTime())
		return 1;
	else
		return 0;
}

function diff_mois(d1, d2)
{
	var diff = Math.abs(d1.getTime() - d2.getTime());
	
	var tmp = new Date(diff);
	
	return Math.ceil(diff / (1000*60*60*24));
}

// Get Element By Id
function ds_getel(id) {
	return document.getElementById(id);
}

// Get the left and the top of the element.
function ds_getleft(el) {
	var tmp = el.offsetLeft;
	el = el.offsetParent
	while(el) {
		tmp += el.offsetLeft;
		el = el.offsetParent;
	}
	return tmp;
}

function ds_gettop(el) {
	var tmp = el.offsetTop;
	el = el.offsetParent
	while(el) {
		tmp += el.offsetTop;
		el = el.offsetParent;
	}
	return tmp;
}

// Output Element
var ds_oe1;
// Container
var ds_ce1;

// Output Element
var ds_oe2;
// Container
var ds_ce2;

// Output Buffering
var ds_ob = ''; 
function ds_ob_clean() {
	ds_ob = '';
}
function ds_ob_flush(type) {
	eval("ds_oe" + type).innerHTML = ds_ob;
	ds_ob_clean();
}
function ds_echo(t) {
	ds_ob += t;
}

var ds_element; // Text Element...

// Francais
var ds_monthnames_fr = [
'Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin',
'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Decembre'
]; // You can translate it for your language.

var ds_daynames_fr = [
'Dim', 'Lun', 'Mar', 'Me', 'Jeu', 'Ven', 'Sam'
]; // You can translate it for your language.

var ds_daynames_long_fr = [
'Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'
];

// Anglais
var ds_monthnames_en = [
'January', 'February', 'March', 'April', 'May', 'June',
'July', 'August', 'September', 'October', 'November', 'December'
]; // You can translate it for your language.

var ds_daynames_en = [
'Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'
]; // You can translate it for your language.

var ds_daynames_long_en = [
'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'
];


// Allemand
var ds_monthnames_ger = [
'Januar', 'Februar', 'März', 'April', 'Mai', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember'																																																																													
]; // You can translate it for your language.

var ds_daynames_ger = [
  'Son', 'Mon', 'Die', 'Mit', 'Don', 'Frei', 'Sam'
]; // You can translate it for your language.

var ds_daynames_long_ger = [
 'Sonntag', 'Monntag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag'
];


var fermer_fr = "Fermer";
var fermer_en = "Close";
var fermer_ger = 'Schliessen';


var ds_monthnames = eval("ds_monthnames_" + lang);
var ds_daynames = eval("ds_daynames_" + lang);
var ds_daynames_long = eval("ds_daynames_long_" + lang);
var fermer = eval("fermer_" + lang);


// Calendar template
function ds_template_main_above(t, type) {
	return '<table cellpadding="3" cellspacing="1" class="ds_tbl">'
	     + '<tr>'
		 + '<td class="ds_head" style="cursor: pointer;text-align:center;" onclick="ds_pm(\'' + type + '\');" colspan="2">&lt;</td>'
		 + '<td class="ds_head" style="cursor: pointer;text-align:center;" onclick="ds_hi();" colspan="3">[' + fermer + ']</td>'
		 + '<td class="ds_head" style="cursor: pointer;text-align:center;" onclick="ds_nm(\'' + type + '\');" colspan="2">&gt;</td>'
		 + '</tr>'
	     + '<tr>'
		 + '<td colspan="7" class="ds_head" style="text-align:center;">' + t + '</td>'
		 + '</tr>'
		 + '<tr>';
}

function ds_template_day_row(t) {
	return '<td class="ds_subhead">' + t + '</td>';
	// Define width in CSS, XHTML 1.0 Strict doesn't have width property for it.
}

function ds_template_new_week() {
	return '</tr><tr>';
}

function ds_template_blank_cell(colspan) {
	return '<td colspan="' + colspan + '"></td>'
}

function ds_template_day(d, m, y, classe) {
	
	if(classe == "")
		return '<td class="ds_cell pointer" style="text-align:center;" onclick="ds_onclick(' + d + ',' + m + ',' + y + ')">' + d + '</td>';
	else
		return '<td class="ds_cell ' + classe + '" style="text-align:center;">&nbsp;' + d + '&nbsp;</td>';
	// Define width the day row.
}

function ds_template_main_below() {
	return '</tr>'
	     + '</table>';
}

// This one draws calendar...
function ds_draw_calendar(m, y, type) {
	// First clean the output buffer.
	ds_ob_clean();
	// Here we go, do the header
	ds_echo (ds_template_main_above(ds_monthnames[m - 1] + ' ' + y, type));
	for (i = 0; i < 7; i ++) {
		ds_echo (ds_template_day_row(ds_daynames[i]));
	}
	// Make a date object.
	var ds_dc_date = new Date();
	// Modif KEMPF : Correction du fameux bug de Fevrier
	ds_dc_date.setFullYear(y, m - 1, 1);
	
	var first_day = ds_dc_date.getDay();
	
	if (m == 1 || m == 3 || m == 5 || m == 7 || m == 8 || m == 10 || m == 12) {
		days = 31;
	} else if (m == 4 || m == 6 || m == 9 || m == 11) {
		days = 30;
	} else {
		// Gestion du mois de février
			// Est Bissextile : 29 sinon 28
		days = (y % 4 == 0  || y % 400 == 0) ? 29 : 28;
	} 

	var first_loop = 1;
	// Start the first week
	ds_echo (ds_template_new_week());
	// If sunday is not the first day of the month, make a blank cell...
	if (first_day != 0) {
		ds_echo (ds_template_blank_cell(first_day));
	}
	var j = first_day;
	
	
	for (i = 0; i < days; i ++) {
		// Today is sunday, make a new week.
		// If this sunday is the first day of the month,
		// we've made a new row for you already.
		if (j == 0 && !first_loop) {
			// New week!!
			ds_echo (ds_template_new_week());
		}
		// Make a row of that day!
		var classe = "";
		
		/* Ajout KEMPF : Il est plus précis de comparer deux Timestamp */
		var actual_date = new Date();
		actual_date.setFullYear(y, m - 1, i+1);
		
		// On ajout deux jours, afin que la réservation ne puisse pas se faire dans cet interval
		actual_date.setTime(actual_date.getTime() - 48*3600000);
		
		if(actual_date.getTime() < today.getTime())
			classe = "cal_noSelect";
		
		/*
			KEMPF : Ici, gestion des jours ne pouvant pas être 
			sélectionnés dans le calendrier :
			Seuls les samedis et les jours possédant un trajet peuvent 
			l'être
		*/
		if(j != 6){
			classe = "cal_noSelect";
		}
		
		// Si il est dans les jours ayant des trajets, on le déselectionne :
		if (inArray(i+1, leTableauDesTrajets[m])){
			classe = "";
		}
		
		ds_echo (ds_template_day(i + 1, m, y, classe));
		
		// This is not first loop anymore...
		first_loop = 0;
		// What is the next day?
		j ++;
		j %= 7;
	}

	// Do the footer
	ds_echo (ds_template_main_below());
	// And let's display..
	ds_ob_flush(type);
	// Scroll it into view.

	//eval('ds_ce'+type).scrollIntoView();
}



// A function to show the calendar.
// When user click on the date, it will set the content of t.
function ds_sh(t, tab, cal, type, langue) {
	
	if (typeof(langue) != 'undefined'){
		lang = langue;
		ds_monthnames = eval("ds_monthnames_" + lang);
		ds_daynames = eval("ds_daynames_" + lang);
		ds_daynames_long = eval("ds_daynames_long_" + lang);
		fermer = eval("fermer_" + lang);
	}
	
	// Set the element to set...
	elt_src = t;

	if(type == '1')
	{
		ds_oe1 = ds_getel(cal);
		ds_ce1 = ds_getel(tab);
	}
	else
	{
		ds_oe2 = ds_getel(cal);
		ds_ce2 = ds_getel(tab);
	}

	ds_element = document.getElementById(t);
	// Make a new date, and set the current month and year.
	var ds_sh_date = new Date();
	ds_c_month = ds_sh_date.getMonth() + 1;
	ds_c_year = ds_sh_date.getFullYear();
	// Draw the calendar
	if(type == 1)
		ds_draw_calendar(ds_c_month, ds_c_year, type);
	else
	{
		var m = ds_c_month + 1;
		var a = ds_c_year;
		
		if(m > 12)
		{
			m = 1;
			a++;
		}
		
		ds_draw_calendar(m, a, type);
	}
	
	// To change the position properly, we must show it first.
	ds_ce1.style.display = '';
	
	if(type == '1')
		ds_ce1.style.display = '';
	else
		ds_ce2.style.display = '';
		
	// Move the calendar container!
	if(type == '1')
	{
		the_left = ds_getleft(ds_element) - 80;
		the_top = ds_gettop(ds_element) + ds_element.offsetHeight;
	
		ds_ce1.style.left = the_left + 'px';
		ds_ce1.style.top = the_top + 'px';
	}


	// Scroll it into view.
	//eval('ds_ce'+type).scrollIntoView();
}

// Hide the calendar.
function ds_hi() {
	ds_ce1.style.display = 'none';
}

// Moves to the next month...
function ds_nm(type) {
	// Increase the current month.
	ds_c_month ++;
	// We have passed December, let's go to the next year.
	// Increase the current year, and set the current month to January.
	if (ds_c_month > 12) {
		ds_c_month = 1; 
		ds_c_year++;
	}
		
	var tmp = new Date(ds_c_year, ds_c_month-1, today.getDate(), 0, 0, 0, 0);
		
	if(diff_mois(today, tmp) <= (5*31))
	{
		ds_draw_calendar(ds_c_month, ds_c_year, '1');
		
		var m = ds_c_month + 1;

		var y = ds_c_year;
		if(m > 12)
		{
			m = 1;
			y++;
		}
		
		ds_draw_calendar(m, y, '2');
	}
	else
		ds_pm(type);
}



// Moves to the previous month...
function ds_pm(type) {
	
	var tmp = new Date(ds_c_year, ds_c_month-1, today.getDate(), 0, 0, 0, 0);	
	
	if(compare_to(today, tmp) == -1)
	{
		var m2 = ds_c_month + 1;

		var y2 = ds_c_year;
		if(m2 > 12)
		{
			m2 = 1;
			y2++;
		}
		
		ds_c_month = ds_c_month - 1; // Can't use dash-dash here, it will make the page invalid.
		// We have passed January, let's go back to the previous year.
		// Decrease the current year, and set the current month to December.
		if (ds_c_month < 1) {
			ds_c_month = 12; 
			ds_c_year = ds_c_year - 1; // Can't use dash-dash here, it will make the page invalid.
		}
		// Redraw the calendar.
		ds_draw_calendar(ds_c_month, ds_c_year, '1');
		
		var m = m2 - 1;

		var y = y2;
		if(m < 1)
		{
			m = 12;
			y--;
		}
		
		ds_draw_calendar(m, y, '2');
	}
}

// Moves to the next year...
function ds_ny() {
	// Increase the current year.
	ds_c_year++;
	// Redraw the calendar.
	ds_draw_calendar(ds_c_month, ds_c_year);
}

// Moves to the previous year...
function ds_py() {
	// Decrease the current year.
	ds_c_year = ds_c_year - 1; // Can't use dash-dash here, it will make the page invalid.
	// Redraw the calendar.
	ds_draw_calendar(ds_c_month, ds_c_year);
}

// Format the date to output.
function ds_format_date(d, m, y) {
	// 2 digits month.
	m2 = '00' + m;
	m2 = m2.substr(m2.length - 2);
	// 2 digits day.
	d2 = '00' + d;
	d2 = d2.substr(d2.length - 2);
	// YYYY-MM-DD
//	return y + '-' + m2 + '-' + d2;

	var day = new Date(y, (m - 1), d, 0, 0, 0, 0)
	
	var res = ds_daynames_long[day.getDay()] + " " + d + " " + ds_monthnames[(m - 1)] + " " + y;
	
	var id = ds_element.id.substr(4);

	document.getElementById(id + "_long").value = res;

	m = (('' + m + '').length == 1) ? '0' + m : m;
	d = (('' + d + '').length == 1) ? '0' + d : d;

	document.getElementById(id).value = d + '-' + m + '-' + y;

	return res;
}

// When the user clicks the day.
function ds_onclick(d, m, y) {
	// Hide the calendar.
	ds_hi();
	// Set the value of it, if we can.
	if (typeof(ds_element.value) != 'undefined') {
		ds_element.value = ds_format_date(d, m, y);
	// Maybe we want to set the HTML in it.
	} else if (typeof(ds_element.innerHTML) != 'undefined') {
		ds_element.innerHTML = ds_format_date(d, m, y);
	// I don't know how should we display it, just alert it to user.
	} else {
		alert (ds_format_date(d, m, y));
	}
}

// And here is the end.

// ]]> -->
