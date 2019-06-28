
var td = document.getElementsByTagName("td")

var modifencours = false
var col=-1
var lig=-1
var tabId = -1

function traiter()
{
   var montd = this
   var montr = this.parentNode
   var table = montr.parentNode
   if(tabId == -1 || tabId == table.parentNode.id || lig == -1 || lig == montr.cellIndex)
   {
	   tabId = table.parentNode.id
	   if(document.getElementById("barre"+tabId).style.backgroundColor != "rgb(0, 204, 51)" || (montd.cellIndex == 7 || col == 7)){
		
		   if (montd.cellIndex==10)
		   {
			  lig = montr.rowIndex
		
			  // je récupère le n° de l'employé présent dans la colonne 0 de la ligne <tr> dont le <td> a été cliqué
			  var NumResa = table.rows[lig].cells[0].innerHTML
			  // le nom du fichier que je vais appeler en AJAX (pas forc?ment utile de la mettre en variable, on aurait pu l'écrire directement dans la fonction modifAjax)
			  //var url   = "ajax.php"
			  // les paramètres que je vais envoyer au fichier ajax.php par l'interm?diaire d'AJAX
			  // il me faut une variable action (que je fixe ici à supprimer)
			  // il me faut une variable NumResa (pour savoir quel employé je vais supprimer)
			  // les deux autres variables col et valeur ne vont pas me servir dans le cadre de la suppression (je les fixe à -1)
			  // par contre j'en aurais besoin pour la modification et pour eviter de tester avec un isset dans le code ajax.php je les définis et les fixe à -1
			  // sinon j'aurais un warning me disant que col et valeur ne sont pas définis dans le tableau $_POST
			  //var param = "action=supprimer&NumResa="+NumResa+"&col=-1&valeur=-1"
			  // je lance ma fonction AJAX avec mes paramètres pour supprimer la ligne dans la base
			  //modifAjax(url,param)
			  // je modifie mon tableau à l'écran pour effacer la ligne
			  table.deleteRow(lig)
		   }
		   else if (montd.cellIndex!=0) 
		   {
				 if (!modifencours && montd.cellIndex!=1 && montd.cellIndex!=2 && montd.cellIndex!=3 && montd.cellIndex!=8 && montd.cellIndex!=9)
				 {
		
					   col = montd.cellIndex
					   lig = montr.rowIndex
					   modifencours=true
					   
					   
					   /*if (montd.cellIndex==2 )
						{
						   var contenu = table.rows[lig].cells[col].innerHTML
						   table.rows[lig].cells[col].innerHTML = '<input type="text" id="valeur" value="'+contenu+'" size="2" />'
						   var valeur = document.getElementById("valeur")
						   valeur.focus()
						}
						else */if (montd.cellIndex==7 )
						{
						   var contenu = table.rows[lig].cells[col].innerHTML

						   table.rows[lig].cells[col].innerHTML = '<textarea id="valeur" cols="50" rows="3" style="overflow-x:hidden; overflow-y:scroll;">'+contenu.replace(/<br>/g, "")+'</textarea>'

						   var valeur = document.getElementById("valeur")
						   valeur.focus()
						}
						else if (montd.cellIndex==4 )
						{
						   var contenu = table.rows[lig].cells[col].innerHTML
						   table.rows[lig].cells[col].innerHTML = '<textarea id="valeur" cols="37" rows="3" style="overflow-x:hidden; overflow-y:scroll;">'+contenu.replace(/<br>/g, "")+'</textarea>'
						   var valeur = document.getElementById("valeur")
						   valeur.focus()
						}
						else if (montd.cellIndex==5 )
						{
						   var contenu = table.rows[lig].cells[col].innerHTML
						   var heures = contenu.substr(0,2)
						   var minutes = contenu.substr(3,2)
						   modifAjax("modifResa.php","action=lstHeure&defautHeure="+heures+"&defautMin="+minutes+"")
						}
						else if (montd.cellIndex==6 )
						{	
						   var contenu = table.rows[lig].cells[col].innerHTML
						   modifAjax("modifResa.php","action=recupPt&defaut="+contenu+"")
						   
						}
		
				 }
				 else if(modifencours && montd.cellIndex!= col && montd.cellIndex!=8 && montd.cellIndex!=9)
				 {
					   modifencours=false
					   var valeur = document.getElementById("valeur")
					   // je modifie la base il me faut donc le n° de l'employé
					   var NumResa = table.rows[lig].cells[0].innerHTML
					   // le nom du fichier appelé
					   var url   = "modifResa.php"
					   
					   //si c'est une modification du point de rassemblement
					   if(col == 6){
						   //si c'est une prise à domicile
						   if(valeur.options[valeur.selectedIndex].value == 4){
							   var oldcol = col
							   var oldlig = lig
							   modifAjax(url,"action=recupRass&NumResa="+NumResa)
							    
						   }
						   //sinon (pas de prise à domicile)
						   else{
							   var oldcol = col
							   var oldlig = lig
							   modifAjax("modifResa.php","action=modifier&NumResa="+NumResa+"&col="+col+"&valeur="+valeur.value)
							   modifAjax("modifResa.php","action=recupUnRass&NumRass="+valeur.value)
							
						   }
						     
					   }
					   else if(col == 5){
						   var heure = document.getElementById("heure").value
						   var minute =  document.getElementById("min").value
						   valeur.value = heure+":"+minute
						   var param = "action=modifier&NumResa="+NumResa+"&col="+col+"&valeur="+valeur.value
						   modifAjax(url,param)
					   }
					   else{
						   // mes paramètre, j'indique dans action que je fais une modification
						   // je passe le numéro de la colonne dans col (?a me permettra dans le PHP de savoir si col=1 alors c'est ename qui est modifié, sinon si col=2 alors c'est job)
						   // je passe aussi la nouvelle valeur saisie dans valeur
						   
						   var param = "action=modifier&NumResa="+NumResa+"&col="+col+"&valeur="+valeur.value
	
						   // je lance ma fonction AJAX pour mettre à jour la BD
						   modifAjax(url,param)
					   }
					   // je mets à jour l'affichage
					   table.rows[lig].cells[col].innerHTML = valeur.value.replace(/\n/g, '<br>\n')
					   lig = -1
					   col = -1
					   tabId = -1
				 }
		   }
	   }
	}
	
	function modifAjax(url,param)
	{
			 var httpRequest = false;
			 if (window.XMLHttpRequest)
			 {   // Mozilla, Safari,...
				 httpRequest = new XMLHttpRequest();
			 }
			 else
				 if (window.ActiveXObject)
				 {   // IE
					 try {
						  httpRequest = new ActiveXObject("Msxml2.XMLHTTP");
						 }
					 catch (e) {
						   try {
								httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
							   }
						   catch (e) {
									 }
						   }
			 }
	
			 if (!httpRequest) {
				alert('Abandon :( Impossible de créer une instance XMLHTTP')
				return false
			 }
	
			 httpRequest.onreadystatechange = function(){
				 //quand la requête est finie
				if(httpRequest.readyState == 4) {
					if(param.substr(0,14) == "action=recupPt"){
						recuperationPoints(httpRequest); 
					}
					//si le point de rassemblement est à personnaliser
					else if(param.substr(0,16) == "action=recupRass"){
						//on récupère l'adresse qui a peut etre déjà été saisie
						//et on affiche une zone de saisie
						var adresse = prompt("Adresse de rassemblement?",httpRequest.responseText);
						table.rows[oldlig].cells[oldcol].innerHTML = adresse
						//mise à jour de la base de donnée (update de ip_pt et rassemblement)
						modifAjax("modifResa.php","action=modifier&NumResa="+NumResa+"&col="+oldcol+"&valeur="+valeur.value+"&adresse="+adresse)
					}
					else if(param.substr(0,18) == "action=recupUnRass"){
						table.rows[oldlig].cells[oldcol].innerHTML = httpRequest.responseText
					}
					else if(param.substr(0,15) == "action=lstHeure"){
						table.rows[lig].cells[col].innerHTML = httpRequest.responseText
					}
					
				}
				 
			}

			 httpRequest.open("POST", url, true);
			 httpRequest.setRequestHeader("Content-Type", "application/x-www-form-urlencoded")
			 httpRequest.send(param);
	}
	function recuperationPoints(http_request) {
		table.rows[lig].cells[col].innerHTML = http_request.responseText
		var valeur = document.getElementById("valeur")
		valeur.focus()
	} 
}



for (var i=0;i<td.length;i++)
{
	if(td[i].className != 'ds_head' && td[i].className != 'ds_subhead' && td[i].className != 'td' && td[i].className != 'ds_cell')
		td[i].onclick = traiter;
}

// Ajout KEMPF
function change_mode_paiement(id, valeur)
{
	var httpRequest = false;
	if (window.XMLHttpRequest)
	{   // Mozilla, Safari,...
	   httpRequest = new XMLHttpRequest();
	}
	else if (window.ActiveXObject)
	{   // IE
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
	  alert('Abandon :( Impossible de créer une instance XMLHTTP')
	  return false
	}
	
	httpRequest.onreadystatechange = function(){
		//quand la requête est finie
		if(httpRequest.readyState == 4) {
			eval(httpRequest.responseText);
		}
	}
	
	httpRequest.open("POST", "modifResa.php", true);
	httpRequest.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	httpRequest.send("action=modePaiement&id=" + id + "&valeur=" + valeur);
}


function change_a_paye(id, table, valeur, id_cherche, mode)
{
	var httpRequest = false;
	if (window.XMLHttpRequest)
	{   // Mozilla, Safari,...
	   httpRequest = new XMLHttpRequest();
	}
	else if (window.ActiveXObject)
	{   // IE
		   try {
				httpRequest = new ActiveXObject("Msxml2.XMLHTTP");
			   }
		   catch (e) {
				 try {
					  httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
					 }
				 catch (e) {
						   }
				 }
	}

	
	if (!httpRequest) {
	  alert('Abandon :( Impossible de créer une instance XMLHTTP')
	  return false
	}
	
	httpRequest.onreadystatechange = function(){
	   //quand la requête est finie
	  if(httpRequest.readyState == 4) {
		  eval(httpRequest.responseText);
		  }
	}
	
	httpRequest.open("POST", "modifResa.php", true);
	httpRequest.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	httpRequest.send("action=change_paye&id=" + id + "&table=" + table + "&valeur=" + valeur + "&id_cherche=" + id_cherche + "&mode=" + mode);
}

