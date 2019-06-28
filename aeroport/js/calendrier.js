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

// Ajout KEMPF : var restriction permet de rentre les jours passés accessibles ou non
var restriction = true;

var today = new Date();

var elt_src;
var lang = document.getElementById('page_lang').value;

var tab_lst = new Array('lst_heure_retour', 'lst_passager_adulte_aller', 'lst_passager_enfant_aller', 'lst_passager_adulte_retour', 'lst_passager_enfant_retour', 'pt_rassemblement_aller', 'pt_rassemblement_retour', 'lst_fixe_depart', 'lst_fixe_retour');


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
	el = el.offsetParent;
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
'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin',
'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Décembre'
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


// Russe
var ds_monthnames_rus = [
'Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'
]; // You can translate it for your language.

var ds_daynames_rus = [
'Вос', 'Пон', 'Вто', 'Сре', 'Чет', 'Пят', 'Суб'
]; // You can translate it for your language.

var ds_daynames_long_rus = [
'Воскресенье', 'Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота'
];


// Turque
var ds_monthnames_tur = [
'Ocak', 'Şubat', 'Mart', 'Nisan', 'Yapabilir', 'Haziran',
'Temmuz', 'Ağustos', 'Eylül', 'Ekim', 'Kasım', 'Ara'
]; // You can translate it for your language.

var ds_daynames_tur = [
'Paz', 'Paz', 'Sal', 'Çar', 'Per', 'Cum', 'Cum'
]; // You can translate it for your language.

var ds_daynames_long_tur = [
'Pazar', 'Pazartesi', 'Salı', 'Çarşamba', 'Perşembe', 'Cuma', 'Cumartesi'
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
var fermer_rus = "Закрыть";
var fermer_tur = "Kapatmak";
var fermer_ger = 'Schliessen';






var ds_monthnames = eval("ds_monthnames_" + lang);
var ds_daynames = eval("ds_daynames_" + lang);
var ds_daynames_long = eval("ds_daynames_long_" + lang);
var fermer = eval("fermer_" + lang);


// Calendar template
function ds_template_main_above(t, type) {
	return '<table cellpadding="3" cellspacing="1" class="ds_tbl">'
	     + '<tr>'
		 + '<td class="ds_head" style="cursor: pointer" onclick="ds_pm(\'' + type + '\');" colspan="2">&lt;</td>'
		 + '<td class="ds_head" style="cursor: pointer" onclick="ds_hi();" colspan="3">[' + fermer + ']</td>'
		 + '<td class="ds_head" style="cursor: pointer" onclick="ds_nm(\'' + type + '\');" colspan="2">&gt;</td>'
		 + '</tr>'
	     + '<tr>'
		 + '<td colspan="7" class="ds_head">' + t + '</td>'
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
		return '<td class="ds_cell ds_valid_cell" onclick="ds_onclick(' + d + ',' + m + ',' + y + ')">' + d + '</td>';
	else
		return '<td class="ds_cell ' + classe + '">&nbsp;' + d + '&nbsp;</td>';
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
	ds_dc_date.setFullYear(y, m - 1, 1);
	if (m == 1 || m == 3 || m == 5 || m == 7 || m == 8 || m == 10 || m == 12) {
		days = 31;
	} else if (m == 4 || m == 6 || m == 9 || m == 11) {
		days = 30;
	} else {
		days = (y % 4 == 0  || y % 400 == 0) ? 29 : 28;
	}
	var first_day = ds_dc_date.getDay();


    // ATTENTION : Date en avril 2009 décalé !!
    if(y == 2009 && m == 4)
        first_day -= 2;


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
		if(restriction && i + 1 < today.getDate() && today.getMonth() == m-1)
			classe = "calendrier_barre";
			
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
function ds_sh(t, tab, cal, type) {
	
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
	
	var bloc_reservation = document.querySelector('#contenu div.reservation');
	var bloc_droite = document.querySelector('#contenu div.bloc_droite');
	var height = bloc_reservation.offsetHeight;
	
	if(type == '1')
		elem = ds_ce1;
	else
		elem = ds_ce2;

	if (window.outerWidth > 991 && elem.style.display == 'none')
	{
		var newHeight = height + 220;
		bloc_reservation.style.height = newHeight + 'px';
		bloc_droite.style.height = newHeight + 'px';
	}
	else if(window.outerWidth > 767 && elem.style.display == 'none')
	{
		var newHeight = height + 200;
		bloc_reservation.style.height = newHeight + 'px';
		bloc_droite.style.height = newHeight + 'px';
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
	var bloc_reservation = document.querySelector('#contenu div.reservation');
	var bloc_droite = document.querySelector('#contenu div.bloc_droite');
	var height = bloc_reservation.offsetHeight;
	if (window.outerWidth > 991)
	{
		var newHeight = height - 220;
		bloc_reservation.style.height = newHeight + 'px';
		bloc_droite.style.height = newHeight + 'px';
	}
	else if(window.outerWidth > 767)
	{
		var newHeight = height - 200;
		bloc_reservation.style.height = newHeight + 'px';
		bloc_droite.style.height = newHeight + 'px';
	}
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
	var date = d + '-' + m + '-' + y;
	// Set the value of it, if we can.
	if (typeof(ds_element.value) != 'undefined') {
		ds_element.value = ds_format_date(d, m, y);
		getHorairesFixes(ds_element,date);
	// Maybe we want to set the HTML in it.
	} else if (typeof(ds_element.innerHTML) != 'undefined') {
		ds_element.innerHTML = ds_format_date(d, m, y);
		getHorairesFixes(ds_element,date);
	// I don't know how should we display it, just alert it to user.
	} else {
		alert (ds_format_date(d, m, y));
	}
}

function getHorairesFixes(ds_element,date) {
	var lst_fixe_depart = document.getElementById('lst_fixe_depart');
	var lst_fixe_retour = document.getElementById('lst_fixe_retour');

	var choix1 = lst_trajet_arrive.selectedIndex;
	var valeur1 = lst_trajet_arrive.options[choix1].value;
	var choix = lst_trajet_depart.selectedIndex;
	var valeur = lst_trajet_depart.options[choix].value;
	if (ds_element.id == "lbl_jour_depart")
	{
		for(var i = lst_fixe_depart.length; i >= 0; i--)
		{
			lst_fixe_depart.options[i] = null;
		}
		var opt20 = document.createElement('option');
		opt20.value = "0";
		opt20.innerHTML = "- - h - -";
		lst_fixe_depart.appendChild(opt20);

		if (valeur1 != 100)
		{
			var type = "depart";
			var val = valeur1;
		}
		else
		{
			var type = "retour";
			var val = valeur;
		}
		var aRemplir = "depart";
	}
	else
	{
		for(var i = lst_fixe_retour.length; i >= 0; i--)
		{
			lst_fixe_retour.options[i] = null;
		}

		var opt21 = document.createElement('option');
		opt21.value = "0";
		opt21.innerHTML = "- - h - -";
		lst_fixe_retour.appendChild(opt21);
		if (valeur1 != 100)
		{
			var type = "retour";
			var val = valeur1;
		}
		else
		{
			var type = "depart";
			var val = valeur;
		}
		var aRemplir = "retour";
	}
	request(type,val,aRemplir,date);
}

function request(type,valeur,aRemplir,date) {
	var xhr = new XMLHttpRequest();
	xhr.open("POST","ajax.php",true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.send("action=get_horaire_fixe_accueil&type="+type+"&lieu="+valeur+"&date="+date);
	xhr.addEventListener('readystatechange', function () {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status==0)) {
			ajouteOption(JSON.parse(xhr.responseText),aRemplir);
		}
	});
}

// And here is the end.

// ]]> -->
