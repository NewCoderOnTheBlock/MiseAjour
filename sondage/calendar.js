var MONTH_LIST = new Array("janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre");
var DAY_LIST = new Array("Lun", "Mar", "Mer", "Jeu", "Ven", "Sam", "Dim");

/**
 * Activation du changement d'affichage des jours passés et du jour d'aujourd'hui.
 */ 
var PAST_ENABLED = true;
var TODAY_ENABLED = true;

/**
 * Instance du calendrier (unique puisqu'un seul affiché à la fois).
 */
var calendar = new Calendar();

/**
 * Constructeur.
 */
function Calendar() {
    this.elementId = "";
    this.element = null;

    this.weekday = 0;
    this.day = 0;
    this.month = 0;
    this.year = 0;

    this.cday = 0;
    this.cmonth = 0;
    this.cyear = 0;
    this.cyear2 = 0;

    this.mappingArray = new Array();

    this.cal = document.getElementById("cal");
    this.cald = document.getElementById("cald");
    this.calm = document.getElementById("calm");
    this.caly = document.getElementById("caly");
}

/**
 * Insère, dans le div d'id 'calendar', les éléments DOM du calendrier.
 */
function insertCalendar() {
    var calendarDiv = document.getElementById("calendar");
    var calendarInserted = (calendarDiv != null);
    if (calendarInserted) {
        // Le calendrier est inséré dans le div d'id "calendar".
        if (document.getElementById("cal") == null) {
            addMainDiv(calendarDiv);
            addMonthDiv(calendarDiv);
            addYearDiv(calendarDiv);
        }
    }
    return calendarInserted;
}

/**
 * Insère, dans le div d'id 'calendar', les éléments DOM relatifs à la partie principale du
 * calendrier.
 */ 
function addMainDiv(calendarDiv) {
    var calDiv = document.createElement("DIV");
    calDiv.id = "cal";
    calDiv.className = "ctx";
    
    var table = document.createElement("TABLE");
    table.id = "calh";
    table.border = "1";
    table.vAlign = "center";
    table.width = "300";
    table.className = "calh";
    
    var row = table.insertRow(0);
    
    var cell = row.insertCell(0);
    cell.id = "cal_m_00";
    cell.onclick = decrementMonth;
    cell.appendChild(getImg("graphics/arrow_left.gif"));
    
    cell = row.insertCell(1);
    cell.id = "cal_m_01";
    cell.onclick = incrementMonth;
    cell.appendChild(getImg("graphics/arrow_right.gif"));
    
    cell = row.insertCell(2);
    cell.id = "cal_m_02";
    cell.onclick = updateMonthChoiceVisibility;
    cell.width = "140";
    
    cell = row.insertCell(3);
    cell.id = "cal_m_03";
    cell.onclick = updateMonthChoiceVisibility;
    cell.appendChild(getImg("graphics/arrow_down.gif"));    
    
    cell = row.insertCell(4);
    cell.width = "10";
    
    cell = row.insertCell(5);
    cell.id = "cal_y_00";
    cell.onclick = decrementYear;
    cell.appendChild(getImg("graphics/arrow_left.gif"));
    
    cell = row.insertCell(6);
    cell.id = "cal_y_01";
    cell.onclick = incrementYear;
    cell.appendChild(getImg("graphics/arrow_right.gif"));
    
    cell = row.insertCell(7);
    cell.id = "cal_y_02";
    cell.onclick = updateYearChoiceVisibility;
    cell.width = "60";
    
    cell = row.insertCell(8);
    cell.id = "cal_y_03";
    cell.onclick = updateYearChoiceVisibility;
    cell.appendChild(getImg("graphics/arrow_down.gif"));
    
    cell = row.insertCell(9);
    cell.width = "10";
    
    cell = row.insertCell(10);
    cell.id = "cal_c";
    cell.onclick = hideCalendar;
    var img = getImg("graphics/l_cancel.gif");
    img.width = "15";
    img.height = "13";
    cell.appendChild(img);
    
    row = table.insertRow(1);
    
    cell = row.insertCell(0);
    cell.colSpan = 11;
    
    var subTable = document.createElement("TABLE");
    subTable.width = "300";
    subTable.border = "1";
    subTable.className = "cal";
    subTable.id = "cald";
    
    var subRow = subTable.insertRow(0);
    subRow.align = "center";
    subRow.height = "18";
    
    var subCell;
    var i;
    for (i = 0; i < 7; i++) {
        subCell = subRow.insertCell(i);
        subCell.width = (i < 5 ? "46" : "35");
        subCell.innerHTML = DAY_LIST[i];
    }
    
    var j;
    for (i = 0; i < 6; i++) {
        subRow = subTable.insertRow(i + 1);
        subRow.align = "center";
        subRow.style.height = "18";
        for (j = 0; j < 7; j++) {
            subCell = subRow.insertCell(j);
            subCell.id = "cal_d_" + i + j;
        }
    }
    
    cell.appendChild(subTable);
    calDiv.appendChild(table);
    calendarDiv.appendChild(calDiv);
}

/**
 * Insère, dans le div d'id 'calendar', les éléments DOM relatifs au choix du mois du calendrier.
 */
function addMonthDiv(calendarDiv) {
    var calmDiv = document.createElement("DIV");
    calmDiv.id = "calm";
    calmDiv.className = "ctx";
    
    var table = document.createElement("TABLE");
    table.className = "calm";
    table.border = "1";
    table.width = "300";
    var row;
    var cell;
    for (i = 0; i < 3; i++) {
        row = table.insertRow(i);
        row.style.height = "18";
        for (j = 0; j < 4; j++) {
            cell = row.insertCell(j);
            cell.id = "calm_" + (3 * j + i + 1);
            cell.width = (j < 2 ? "23%" : "26%");
        }
    }
    calmDiv.appendChild(table);
    calendarDiv.appendChild(calmDiv);
}

/**
 * Insère, dans le div d'id 'calendar', les éléments DOM relatifs au choix de l'année du
 * calendrier.
 */
function addYearDiv(calendarDiv) {
    var calyDiv = document.createElement("DIV");
    calyDiv.id = "caly";
    calyDiv.className = "ctx";
    
    var table = document.createElement("TABLE");
    var row = table.insertRow(0);
    
    var cell = row.insertCell(0);
    var img = getImg("graphics/arrow_left.gif");
    img.onclick = decreaseYear;
    cell.appendChild(img);
    
    cell = row.insertCell(1);
    var subTable = document.createElement("TABLE");
    subTable.className = "caly";
    subTable.border = "1";
    subTable.width = "240";
    var subRow;
    var subCell;
    for (i = 0; i < 5; i++) {
        subRow = subTable.insertRow(i);
        subRow.style.height = "18";
        for (j = 0; j < 5; j++) {
            subCell = subRow.insertCell(j);
            subCell.id = "caly_" + (5 * j + i + 1);
            subCell.width = "20%";
        }
    }
    cell.appendChild(subTable);
    
    cell = row.insertCell(2);
    img = getImg("graphics/arrow_right.gif");
    img.onclick = increaseYear;
    cell.appendChild(img);
    
    calyDiv.appendChild(table);
    calendarDiv.appendChild(calyDiv);
}

/**
 * Retourne un élément image à insérer dans le calendrier.
 */
function getImg(src) {
    var img = document.createElement("IMG");
    img.src = src;
    img.className = "but";
    img.width = "16";
    img.height = "16";
    return img;
}

function initCalendar(date) {
    calendar.weekday = date.getDay();
    calendar.day = date.getDate();
    calendar.month = date.getMonth() + 1;
    calendar.year = date.getFullYear();

    calendar.cmonth = calendar.month;
    calendar.cyear = calendar.year;

    fillMonthChoice();
    fillYearChoice();
}

function initElement(id, evt) {
    if (!evt) {
        evt = window.event;
    }
    calendar.elementId = "";
    calendar.element = document.getElementById(id);

    var hGap = -92;
    var vGap = 12;
    var elementStyle = calendar.cal.style;
    var clientX = evt.clientX;
    var clientY = evt.clientY;
    var rightedge = document.body.clientWidth - clientX - hGap;
    var bottomedge = document.body.clientHeight - clientY - vGap;
    if (rightedge < calendar.cal.offsetWidth) {
        elementStyle.left = document.body.scrollLeft + clientX - hGap - calendar.cal.offsetWidth;
    } else {
        elementStyle.left = document.body.scrollLeft + clientX + hGap;
    }
    if (bottomedge < calendar.cal.offsetHeight) {
        elementStyle.top = document.body.scrollTop + clientY - vGap - calendar.cal.offsetHeight;
    } else {
        elementStyle.top = document.body.scrollTop + clientY + vGap;
    }

    calendar.calm.style.left = parseInt(elementStyle.left) + 5;
    calendar.calm.style.top = parseInt(elementStyle.top) + 28;
    calendar.caly.style.left = parseInt(elementStyle.left) + 12;
    calendar.caly.style.top = parseInt(elementStyle.top) + 33;
}

function displayCalendar(id, ev) {
    if (insertCalendar()) {
        calendar = new Calendar();
    
        var i;
        var element;
        for (i = 0; i < 4; i++) {
            element = document.getElementById("cal_m_0" + i);
            element.onmouseover = highlightHead;
            element.onmouseout = unhighlightHead;
        }
        for (i = 0; i < 4; i++) {
            element = document.getElementById("cal_y_0" + i);
            element.onmouseover = highlightHead;
            element.onmouseout = unhighlightHead;
        }
        element = document.getElementById("cal_c");
        element.onmouseover = highlightHead;
        element.onmouseout = unhighlightHead;
        
        initElement(id, ev);
        var dateValue = calendar.element.value;
        var validDate = false;
        if (dateValue != "") {
            var s = dateValue.split("/");
            var d;
            var m;
            var y;
            if (s.length == 3) {
                d = s[0];
                m = s[1];
                y = s[2];
                if (!isNaN(d) && !isNaN(m) && !isNaN(y)) {
                    var m2 = parseNumber(m);
                    if (m2 >= 1 && m2 <= 12) {
                        validDate = true;
                        var y2 = parseNumber(y);
                        if (y2 < 100) {
                            y2 += 2000;
                        }
                        var d2 = parseNumber(d);
                        var testDate = new Date(y2, m2 - 1, 1);
                        if (d2 >= 1 && d2 <= getMaxMonthLastDay(testDate)) {
                            initCalendar(new Date(y2, m2 - 1, d2));
                        } else {
                            initCalendar(new Date(y2, m2 - 1, 1));
                        }
                    }
                }
            }
        }
        if (!validDate) {
            initCalendar(new Date());
        }
        fillCalendar();
        showCalendar();
    } else {
        window.status = "Div 'calendar' inexistant : aucun calendrier ajouté.";
    }
}

function showCalendar() {
    calendar.cal.style.visibility = "visible";
    showDayChoice();
    hideMonthChoice();
    hideYearChoice();
}

function hideCalendar() {
    calendar.cal.style.visibility = "hidden";
    hideDayChoice();
    hideMonthChoice();
    hideYearChoice();
}

function showDayChoice() {
    calendar.cald.style.visibility = "visible";
}

function hideDayChoice() {
    calendar.cald.style.visibility = "hidden";
}

function showMonthChoice() {
    calendar.calm.style.visibility = "visible";
}

function hideMonthChoice() {
    calendar.calm.style.visibility = "hidden";
}

function showYearChoice() {
    calendar.caly.style.visibility = "visible";
}

function hideYearChoice() {
    calendar.caly.style.visibility = "hidden";
}

function updateMonthChoiceVisibility() {
    if (calendar.calm.style.visibility == "visible") {
        showDayChoice();
        hideMonthChoice();
    } else {
        hideDayChoice();
        hideYearChoice();
        showMonthChoice();
    }
}

function updateYearChoiceVisibility() {
    if (calendar.caly.style.visibility == "visible") {
        showDayChoice();
        hideYearChoice();
    } else {
        calendar.cyear2 = calendar.cyear;
        hideDayChoice();
        hideMonthChoice();
        fillYearChoice();
        showYearChoice();
    }
}

function fillCalendar() {
    document.getElementById("cal_m_02").innerHTML = getStringMonth(calendar.cmonth);
    document.getElementById("cal_y_02").innerHTML = calendar.cyear;
    var element;

    var i = 0;
    var j = 0;
    for (i = 0; i < 6; i++) {
        for (j = 0; j < 7; j++) {
            element = document.getElementById("cal_d_" + i + j);
            element.innerHTML = "";
            element.onclick = "";
            element.onmouseover = "";
            element.onmouseout = "";
            element.className = "";
        }
    }

    i = 0;
    j = (new Date(calendar.cyear, calendar.cmonth-1, 1)).getDay();
    j = (j + 6) % 7;
    var count = 1;
    var days = getMonthLastDay();
    while (count <= days) {
        element = document.getElementById("cal_d_" + i + j);
        element.innerHTML = count;
        element.onclick = selectDay;
        element.onmouseover = highlightDay;
        element.onmouseout = unhighlightDay;
        element.className = getCellClassNameSuffix(count);
        
        calendar.mappingArray[10 * i + j] = count;
        j++;
        if (j == 7) {
            i++;
            j = 0;
        }
        count++;
    }
}

function fillMonthChoice() {
    var i;
    var element;
    for (i = 1; i <= 12; i++) {
        element = document.getElementById("calm_" + i);
        element.innerHTML = getStringMonth(i);
        element.onclick = selectMonth;
        element.onmouseover = highlightHead;
        element.onmouseout = unhighlightHead;
    }
}

function fillYearChoice() {
    var i;
    var element;
    var gap = calendar.cyear2 - 11;
    for (i = 1; i <= 25; i++) {
        element = document.getElementById("caly_" + i);
        element.innerHTML = gap + i;
        element.onclick = selectYear;
        element.onmouseover = highlightHead;
        element.onmouseout = unhighlightHead;
    }
}

function highlightDay(evt) {
    var element = getEventElement(evt);
    element.className = "sel" + getCellClassNameSuffix(element.innerHTML);
}

function unhighlightDay(evt) {
    //getEventElement(evt).className = "";
    var element = getEventElement(evt);
    element.className = getCellClassNameSuffix(element.innerHTML);
}

function highlightHead(evt) {
    var element = getEventElement(evt);
    if (element.tagName == "IMG") {
        element = element.parentNode;
    }
    element.className = "sel";
    if (element.id == "cal_m_02") {
        document.getElementById("cal_m_03").className = "sel";
    } else if (element.id == "cal_m_03") {
        document.getElementById("cal_m_02").className = "sel";
    } else if (element.id == "cal_y_02") {
        document.getElementById("cal_y_03").className = "sel";
    } else if (element.id == "cal_y_03") {
        document.getElementById("cal_y_02").className = "sel";
    }
}

function unhighlightHead(evt) {
    var element = getEventElement(evt);
    if (element.tagName == "IMG") {
        element = element.parentNode;
    }
    element.className = "";
    if (element.id == "cal_m_02") {
        document.getElementById("cal_m_03").className = "";
    } else if (element.id == "cal_m_03") {
        document.getElementById("cal_m_02").className = "";
    } else if (element.id == "cal_y_02") {
        document.getElementById("cal_y_03").className = "";
    } else if (element.id == "cal_y_03") {
        document.getElementById("cal_y_02").className = "";
    } 
}

function selectDay(evt) {
    var id = getEventElement(evt).id;
    calendar.cday = calendar.mappingArray[parseInt(id.substr(id.length - 2))];
    hideCalendar();
    var d = calendar.cday;
    var m = calendar.cmonth;
    var y = calendar.cyear;
    window.status = d + " - " + m + " - " + y;
    calendar.element.value = (d < 10 ? "0" : "") + d + "/" + (m < 10 ? "0" : "") + m + "/" + y;
}

function selectMonth(evt) {
    var id = getEventElement(evt).id;
    var s = id.split("_");
    calendar.cmonth = parseInt(s[s.length - 1]);
    hideMonthChoice();
    showDayChoice();
    fillCalendar();
}

function selectYear(evt) {
    var id = getEventElement(evt).id;
    var s = id.split("_");
    calendar.cyear = parseInt(s[s.length - 1]) + calendar.cyear2 - 11;
    hideYearChoice();
    showDayChoice();
    fillCalendar();
}

function incrementMonth() {
    if (calendar.cmonth == 12) {
        calendar.cmonth = 1;
        calendar.cyear = calendar.cyear + 1;
    } else {
        calendar.cmonth = calendar.cmonth + 1;
    }
    fillCalendar();
}

function decrementMonth() {
    if (calendar.cmonth == 1) {
        calendar.cmonth = 12;
        calendar.cyear = calendar.cyear - 1;
    } else {
        calendar.cmonth = calendar.cmonth - 1;
    }
    fillCalendar();
}

function incrementYear() {
    calendar.cyear = calendar.cyear + 1;
    fillCalendar();
}

function decrementYear() {
    calendar.cyear = calendar.cyear - 1;
    fillCalendar();
}

function increaseYear() {
    calendar.cyear2 = calendar.cyear2 + 20;
    fillYearChoice();
}

function decreaseYear() {
    calendar.cyear2 = calendar.cyear2 - 20;
    fillYearChoice();
}

function getMonthLastDay() {
    var testDate = new Date(calendar.cyear, calendar.cmonth - 1, 29);
    return getMaxMonthLastDay(testDate);
}

function getMaxMonthLastDay(date) {
    if (date.getDate() == 29) {
        date.setDate(30);
        if (date.getDate() == 30) {
            date.setDate(31);
            if (date.getDate() == 31) {
                return 31
            } else {
                return 30;
            }
        } else {
            return 29;
        }
    } else {
        return 28;
    }
}

function getStringMonth(index) {
    return MONTH_LIST[index - 1];
}

var checkClickEnabled = true;
var clickedElement = null;

function checkClick(evt) {
    if ((checkClickEnabled)
            && (calendar.cal != null)
            && (calendar.cal.style.visibility == "visible")) {
        checkClickEnabled = false;
        if (evt.target != null) {
            clickedElement = evt.target;
        } else {
            clickedElement = window.event.srcElement;
        }
        setTimeout("checkClickAnalysis()", 200);
    }
}

function checkClickAnalysis() {
    var element = clickedElement;
    var calendarElement = false;
    var id;
    var tagName = element.tagName;
    // Vérification que le clic courant n'est pas relatif à une image dont le rôle est justement
    // d'afficher le calendrier.
    if (tagName == "IMG") {
        var imgOnClickFunction = "" + element.onclick;
        calendarElement = (imgOnClickFunction.indexOf("displayCalendar") != -1);
    }
    // Vérification de l'appartenance ou non de l'élément ayant déclenché l'événement 'onclick' au
    // calendrier.
    if (!calendarElement) {
        while (element != null && tagName != "FORM") {
            id = element.id;
            if (id != null && (id == "cal" || id == "calm" || id == "caly") && tagName == "DIV") {
                // L'élément ayant déclenché l'événement 'onclick' appartient au calendrier : on ne
                // doit donc pas masquer ce dernier.
                calendarElement = true;
            }
            element = element.parentNode;
            if (element != null) {
                tagName = element.tagName;
            }
        }
        if (!calendarElement) {
            hideCalendar();
        }
    }
    checkClickEnabled = true;
}

function getEventElement(evt) {
    if (!evt) {
        return window.event.srcElement;
    } else {
        return evt.target;
    }
}

function parseNumber(n) {
    while (n != "" && n.substring(0, 1) == "0") {
        n = n.substring(1);
    }
    return parseInt(n);
}

function getCellClassNameSuffix(day) {
    if (PAST_ENABLED || TODAY_ENABLED) {
        var today = new Date();
        var selectedDate = new Date(calendar.cyear, calendar.cmonth - 1, day);
        if (selectedDate.getYear() < today.getYear()) {
            return (PAST_ENABLED ? "pas" : "");
        } else if (selectedDate.getYear() > today.getYear()) {
            return "";
        } else {
            if (selectedDate.getMonth() < today.getMonth()) {
                return (PAST_ENABLED ? "pas" : "");
            } else if (selectedDate.getMonth() < today.getMonth()) {
                return "";
            } else {
                if (selectedDate.getDate() < today.getDate()) {
                    return (PAST_ENABLED ? "pas" : "");
                } else if (selectedDate.getDate() > today.getDate()) {
                    return "";
                } else {
                    return (TODAY_ENABLED ? "tod" : "");
                }
            }
        }
    } else {
        return "";
    }
}
