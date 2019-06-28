/* 
	KEMPF
	Fonction de redirection facilitée avec les touches
	
	Exemple : Dans l'administration, taper ESPACE puis "nvt" pour aller sur la page navette
	(Ou "nvt" puis ESPACE)
*/

var keyChaine = "";
var keyArray = new Array();
keyArray[65] = "a";
keyArray[66] = "b";
keyArray[67] = "c";
keyArray[68] = "d";
keyArray[69] = "e";
keyArray[70] = "f";
keyArray[71] = "g";
keyArray[72] = "h";
keyArray[73] = "i";
keyArray[74] = "j";
keyArray[75] = "k";
keyArray[76] = "l";
keyArray[77] = "m";
keyArray[78] = "n";
keyArray[79] = "o";
keyArray[80] = "p";
keyArray[81] = "q";
keyArray[82] = "r";
keyArray[83] = "s";
keyArray[84] = "t";
keyArray[85] = "u";
keyArray[86] = "v";
keyArray[87] = "w";
keyArray[88] = "x";
keyArray[89] = "y";
keyArray[90] = "z";

keyArray[32] = "@";

var keyRedirection = new Array();
keyRedirection["nvt"] = 'http://alsace-navette.com/admin/index.php?p=1&action=1';
keyRedirection["agd"] = 'http://alsace-navette.com/phenix';
keyRedirection["rct"] = 'http://alsace-navette.com/admin/index.php?p=32';
keyRedirection["opt"] = 'http://alsace-navette.com/admin/index.php?p=172';
keyRedirection["faq"] = 'http://alsace-navette.com/admin/index.php?p=173';
keyRedirection["hrs"] = 'http://alsace-navette.com/admin/index.php?p=12';
keyRedirection["anx"] = 'http://alsace-navette.com/europapark/admin/index.php?p=1&action=1';
keyRedirection["dcx"] = 'http://alsace-navette.com/admin/index.php?p=10';
keyRedirection["dnf"] = 'http://alsace-navette.com/admin/index.php?p=31';

checkCommands = function(){
	// On parcours toutes les redirections possibles et on test
	for (var key in keyRedirection){
		// On cherche la chaine (Avec un @ avant ou après)
		if (keyChaine.search(key+"@") > -1 || keyChaine.search("@"+key) > -1){
			window.location.href = keyRedirection[key]; 
		}
	}
};

processKeyEvent = function(eventType, event){
	// MSIE hack -> IE n'utilise pas la variable event mais window.event
	if (window.event)
	{
		event = window.event;
	}
	
	if (keyArray[event.keyCode]){
		keyChaine += keyArray[event.keyCode];
		
		checkCommands();
	}
	
};

processKeyUp = function(event){
	processKeyEvent("onkeyup", event);
};

document.onkeydown = processKeyUp;