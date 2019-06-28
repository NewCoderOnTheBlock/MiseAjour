var lang = document.getElementById('hd_lang').value; // langue

var txtDepart = document.getElementById('txtDepart'); // lieu de depart
var txtDestination = document.getElementById('txtDestination'); // lieu de destination
var trajet_aller_simple = document.getElementById('trajet_aller_simple'); // radio aller simple
var trajet_aller_retour = document.getElementById('trajet_aller_retour'); // radio aller retour
var txtDateAller = document.getElementById('txtDateAller'); // date aller
var txtDateRetour = document.getElementById('txtDateRetour'); // date aller

var txtAdulteAller = document.getElementById('txtAdulteAller'); // adulte aller
var txtEnfantAller = document.getElementById('txtEnfantAller'); // enfant aller
var divEnfantAller = document.getElementById('divEnfantAller'); // div enfant aller
var txtEnfant_g0_aller = document.getElementById('txtEnfant_g0_aller'); // 1er type d'enfant aller
var txtEnfant_g1_aller = document.getElementById('txtEnfant_g1_aller'); // 2er type d'enfant aller
var txtEnfant_g2_aller = document.getElementById('txtEnfant_g2_aller'); // 3er type d'enfant aller
var txtEnfant_g3_aller = document.getElementById('txtEnfant_g3_aller'); // 4er type d'enfant aller
var lst_enfant_aller=new Array("txtEnfant_g0_aller","txtEnfant_g1_aller","txtEnfant_g2_aller","txtEnfant_g3_aller");	
var txtCieAerienneAller = document.getElementById('txtCieAerienneAller'); // compagnie aérienne aller
var txtDestinationVolAller = document.getElementById('txtDestinationVolAller'); // destination vol aller
var txtProvenanceVolAller = document.getElementById('txtProvenanceVolAller'); // provenance vol aller
var txtHeureVolAller = document.getElementById('txtHeureVolAller'); // heure du vol aller
var txtMinuteVolAller = document.getElementById('txtMinuteVolAller'); // minute du vol aller
var txtHoraireDemandeAller = document.getElementById('txtHoraireDemandeAller'); // horaire a la demande aller
var txtHoraireFixeAller = document.getElementById('txtHoraireFixeAller'); // horaire fixe aller
var txtHoraireAllerHd = document.getElementById('txtHoraireAllerHd'); // champ caché dans lequel on met l'horaire sélectionné Aller
var divFixeAller = document.getElementById('divFixeAller'); // div des horaires fixes
var txtRdvAller = document.getElementById('txtRdvAller'); // lieu rendez vous aller
var domicileAller = document.getElementById('domicileAller'); // div pour le domicile aller
var txtAdresseAller = document.getElementById('txtAdresseAller'); // adresse domicile aller
var txtCodePostalAller = document.getElementById('txtCodePostalAller'); // code postal domicile aller
var txtVilleAller = document.getElementById('txtVilleAller'); // ville domicile aller

var txtAdulteRetour = document.getElementById('txtAdulteRetour'); // adulte Retour
var txtEnfantRetour = document.getElementById('txtEnfantRetour'); // enfant Retour
var divEnfantRetour = document.getElementById('divEnfantRetour'); // div enfant Retour
var txtEnfant_g0_retour = document.getElementById('txtEnfant_g0_retour'); // 1er type d'enfant Retour
var txtEnfant_g1_retour = document.getElementById('txtEnfant_g1_retour'); // 2er type d'enfant Retour
var txtEnfant_g2_retour = document.getElementById('txtEnfant_g2_retour'); // 3er type d'enfant Retour
var txtEnfant_g3_retour = document.getElementById('txtEnfant_g3_retour'); // 4er type d'enfant Retour
var lst_enfant_retour=new Array("txtEnfant_g0_retour","txtEnfant_g1_retour","txtEnfant_g2_retour","txtEnfant_g3_retour");
var txtCieAerienneRetour = document.getElementById('txtCieAerienneRetour'); // compagnie aérienne Retour
var txtDestinationVolRetour = document.getElementById('txtDestinationVolRetour'); // destination vol Retour
var txtProvenanceVolRetour = document.getElementById('txtProvenanceVolRetour'); // provenance vol Retour
var txtHeureVolRetour = document.getElementById('txtHeureVolRetour'); // heure du vol Retour
var txtMinuteVolRetour = document.getElementById('txtMinuteVolRetour'); // minute du vol Retour
var txtHoraireDemandeRetour = document.getElementById('txtHoraireDemandeRetour'); // horaire a la demande Retour
var txtHoraireFixeRetour = document.getElementById('txtHoraireFixeRetour'); // horaire fixe Retour
var txtHoraireRetourHd = document.getElementById('txtHoraireRetourHd'); // champ caché dans lequel on met l'horaire sélectionné Retour
var divFixeRetour = document.getElementById('divFixeRetour'); // div des horaires fixes
var txtRdvRetour = document.getElementById('txtRdvRetour'); // lieu rendez vous Retour
var domicileRetour = document.getElementById('domicileRetour'); // div pour le domicile Retour
var txtAdresseRetour = document.getElementById('txtAdresseRetour'); // adresse domicile Retour
var txtCodePostalRetour = document.getElementById('txtCodePostalRetour'); // code postal domicile Retour
var txtVilleRetour = document.getElementById('txtVilleRetour'); // ville domicile Retour

var txtCommentaire = document.getElementById('txtCommentaire');

var gauche_reservation = document.getElementById('gauche_reservation'); // zone de gauche de la reservation
var droite_reservation = document.getElementById('droite_reservation'); // zone de droite de la reservation

var copie_txtDepart = copie_liste(txtDepart); // copie de la liste d'aeroport du depart
var copie_txtDestination = copie_liste(txtDestination); // copie de la liste d'aeroport de la destination

var boutonRechercher = document.getElementById('boutonRechercher'); // bouton rechercher

var param="";
txtDestination.disabled=true;
gestion_liste_a_r();
function gestion_liste_a_r()
{
	if(txtDepart.value!=0) // si le depart est selectionne
	{
		txtDestination.disabled=false; // on reactive la liste destination
		if(txtDepart.value==1) // si depart = strasbourg
		{
			for(var i=0;i<txtDestination.options.length;i++)
			{
				if(txtDestination.options[i].value==1)
				{
					txtDestination.options[i]=null;
				}
			}
			param = "action=majListeHoraireFixeAller&depart="+txtDepart.value+"&destination="+txtDestination.value;
			ajax("./php/traitementAjax.php",param,"majListeHoraireFixeAller");
			
			param = "action=majListeHoraireFixeRetour&depart="+txtDepart.value+"&destination="+txtDestination.value;
			ajax("./php/traitementAjax.php",param,"majListeHoraireFixeRetour");
		}
		else // sinon
		{
			restaure_destination();
			for(var i=0;i<txtDestination.options.length;i++)
			{
				if(txtDestination.options[i].value==1)
				{
					txtDestination.options[i].selected="selected";	
					txtDestination.disabled=true;
					param = "action=majListeHoraireFixeAller&depart="+txtDepart.value+"&destination="+txtDestination.value;
					ajax("./php/traitementAjax.php",param,"majListeHoraireFixeAller");

					param = "action=majListeHoraireFixeRetour&depart="+txtDepart.value+"&destination="+txtDestination.value;
					ajax("./php/traitementAjax.php",param,"majListeHoraireFixeRetour");
				}
			}
		}
	}
	else
	{
		txtDestination.disabled=true; // on reactive la liste destination
	}
}

function gestion_formulaire_aller_retour()
{
	if(this.id=="trajet_aller_simple") // si c'est un aller simple, on cache le retour
	{
		droite_reservation.style.display='none';
		txtDateRetour.value='';
		txtDateRetour.disabled=true;
	}
	else // si c'est aller retour
	{
		droite_reservation.style.display='block';
		txtDateRetour.disabled=false;
	}
}

function affichage_domicile()
{
	if(txtRdvAller.value==4)
		domicileAller.style.display="block";
	else
		domicileAller.style.display="none";
		
	if(txtRdvRetour.value==4)
		domicileRetour.style.display="block";
	else
		domicileRetour.style.display="none";
}

function affichage_enfant()
{
	if(txtEnfantAller.value>0)
		divEnfantAller.style.display="block";
	else
		divEnfantAller.style.display="none";
		
	if(txtEnfantRetour.value>0)
		divEnfantRetour.style.display="block";
	else
		divEnfantRetour.style.display="none";
}

function copie_liste(a) // permet de faire une copie d'une liste
{
	var c=new Array();
	c[0]=new Array();
	c[1]=new Array();
	for(var b=0;b<a.length;b++)
	{
		c[0][b]=a.options[b].value;
		c[1][b]=a.options[b].text;
	}
	return c;
}

function restaure_depart() // restaure la liste des trajets de depart
{
	for(var a=0;a<copie_txtDepart[0].length;a++)
		txtDepart.options[a]=new Option(copie_txtDepart[1][a],copie_txtDepart[0][a]);
}

function restaure_destination() // restaure la liste des trajets de arrive
{
	for(var a=0;a<copie_txtDestination[0].length;a++)
	{
		txtDestination.options[a]=new Option(copie_txtDestination[1][a],copie_txtDestination[0][a]);
	}
}

function verification() // verification si tous les champs sont remplis
{
	var erreur=false;
	
	/* Verification des données pour l'Aller */
	if(txtDepart.selectedIndex==0)
		erreur=true;
	if(txtDestination.selectedIndex==0)
		erreur=true;
	if(txtDateAller.value=='' || txtDateAller.value==null)
		erreur=true;
	if(txtEnfantAller.options[txtEnfantAller.selectedIndex].value!=0) // si un enfant aller est selectionne
	{ // on verifie si l'age est precise
		var d=0;
		for(var c=0;c<lst_enfant_aller.length;c++)
		{
			var a=document.getElementById(lst_enfant_aller[c]);
			d+=a.selectedIndex;
		}
		if(d!=txtEnfantAller.options[txtEnfantAller.selectedIndex].value)
			erreur=true;
	}
	if(parseInt(txtEnfantAller.selectedIndex)+parseInt(txtEnfant_g0_aller.value)+parseInt(txtEnfant_g1_aller.value)+parseInt(txtEnfant_g2_aller.value)+parseInt(txtEnfant_g3_aller.value)>20)
		erreur=true;
	if(txtCieAerienneAller.value=='')
		erreur=true;
	if(txtDestinationVolAller.value=='')
		erreur=true;
	if(txtProvenanceVolAller.value=='')
		erreur=true;
	if(txtHeureVolAller.selectedIndex==0)
		erreur=true;
	if(txtMinuteVolAller.selectedIndex==0)
		erreur=true;	
	if(txtHoraireAllerHd.value==0 || txtHoraireAllerHd.value=='')
		erreur=true;
	if(txtRdvAller.selectedIndex==0)
		erreur=true;
	if(txtRdvAller.options[txtRdvAller.selectedIndex].value==4)
	{
		if(txtAdresseAller.value=="" || txtAdresseAller.value==null)
			erreur=true;
		if(txtCodePostalAller.value=="" || txtCodePostalAller.value==null)
			erreur=true;
		if(txtVilleAller.value=="" || txtVilleAller.value==null)
			erreur=true;
	}
	
	/* Verification des données pour le Retour */
	if(trajet_aller_retour.checked) // si c'est un aller retour, on reccupere également les valeurs du retour
	{
		if(txtDepart.selectedIndex==0)
			erreur=true;
		if(txtDestination.selectedIndex==0)
			erreur=true;
		if(txtDateRetour.value=='' || txtDateRetour.value==null)
			erreur=true;
		if(txtEnfantRetour.options[txtEnfantRetour.selectedIndex].value!=0) // si un enfant aller est selectionne
		{ // on verifie si l'age est precise
			var d=0;
			for(var c=0;c<lst_enfant_retour.length;c++)
			{
				var a=document.getElementById(lst_enfant_retour[c]);
				d+=a.selectedIndex;
			}
			if(d!=txtEnfantRetour.options[txtEnfantRetour.selectedIndex].value)
				erreur=true;
		}
		if(parseInt(txtEnfantRetour.selectedIndex)+parseInt(txtEnfant_g0_retour.value)+parseInt(txtEnfant_g1_retour.value)+parseInt(txtEnfant_g2_retour.value)+parseInt(txtEnfant_g3_retour.value)>20)
			erreur=true;
		if(txtCieAerienneRetour.value=='')
			erreur=true;
		if(txtDestinationVolRetour.value=='')
			erreur=true;
		if(txtProvenanceVolRetour.value=='')
			erreur=true;
		if(txtHeureVolRetour.selectedIndex==0)
			erreur=true;
		if(txtMinuteVolRetour.selectedIndex==0)
			erreur=true;	
		if(txtHoraireRetourHd.value==0 || txtHoraireRetourHd.value=='')
			erreur=true;
		if(txtRdvRetour.selectedIndex==0)
			erreur=true;
		if(txtRdvRetour.options[txtRdvRetour.selectedIndex].value==4)
		{
			if(txtAdresseRetour.value=="" || txtAdresseRetour.value==null)
				erreur=true;
			if(txtCodePostalRetour.value=="" || txtCodePostalRetour.value==null)
				erreur=true;
			if(txtVilleRetour.value=="" || txtVilleRetour.value==null)
				erreur=true;
		}
	}
	return erreur;
}

function confirmation_reservation()
{
	if(!verification())
	{
		param = "action=demandeReservation";
		/* Récupération des données pour l'Aller */
		param += "&txtDepartAller="+txtDepart.options[txtDepart.selectedIndex].value;
		param += "&txtDestinationAller="+txtDestination.options[txtDestination.selectedIndex].value;
		param += "&txtDateAller="+txtDateAller.value;
		param += "&txtAdulteAller="+txtAdulteAller.options[txtAdulteAller.selectedIndex].value;
		param += "&txtEnfantAller="+txtEnfantAller.options[txtEnfantAller.selectedIndex].value
		if(txtEnfantAller.options[txtEnfantAller.selectedIndex].value>0)
		{
			param +="&txtEnfant_g0_aller="+txtEnfant_g0_aller.options[txtEnfant_g0_aller.selectedIndex].value;
			param +="&txtEnfant_g1_aller="+txtEnfant_g1_aller.options[txtEnfant_g1_aller.selectedIndex].value;
			param +="&txtEnfant_g2_aller="+txtEnfant_g2_aller.options[txtEnfant_g2_aller.selectedIndex].value;
			param +="&txtEnfant_g3_aller="+txtEnfant_g3_aller.options[txtEnfant_g3_aller.selectedIndex].value;
		}
		else
		{
			param +="&txtEnfant_g0_aller=0";
			param +="&txtEnfant_g1_aller=0";
			param +="&txtEnfant_g2_aller=0";
			param +="&txtEnfant_g3_aller=0";
		}
		param += "&txtCieAerienneAller="+txtCieAerienneAller.value;
		param += "&txtDestinationVolAller="+txtDestinationVolAller.value;
		param += "&txtProvenanceVolAller="+txtProvenanceVolAller.value;
		param += "&txtHeureVolAller="+txtHeureVolAller.options[txtHeureVolAller.selectedIndex].value;
		param += "&txtMinuteVolAller="+txtMinuteVolAller.options[txtMinuteVolAller.selectedIndex].value;
		param += "&txtHoraireAllerHd="+txtHoraireAllerHd.value;
		param += "&txtRdvAller="+txtRdvAller.options[txtRdvAller.selectedIndex].value;
		if(txtRdvAller.options[txtRdvAller.selectedIndex].value==4)
		{
			param += "&txtAdresseAller="+txtAdresseAller.value;
			param += "&txtCodePostalAller="+txtCodePostalAller.value;
			param += "&txtVilleAller="+txtVilleAller.value;
		}
		else
		{
			param += "&txtAdresseAller=0";
			param += "&txtCodePostalAller=0";
			param += "&txtVilleAller=0";
		}
		
		// si c'est un aller retour, on gere le retour
		if(trajet_aller_retour.checked)
		{
			param += "&aller_retour=1";
			param += "&txtDestinationRetour="+txtDepart.options[txtDepart.selectedIndex].value;
			param += "&txtDepartRetour="+txtDestination.options[txtDestination.selectedIndex].value;
			param += "&txtDateRetour="+txtDateRetour.value;
			param += "&txtAdulteRetour="+txtAdulteRetour.options[txtAdulteRetour.selectedIndex].value;
			param += "&txtEnfantRetour="+txtEnfantRetour.options[txtEnfantRetour.selectedIndex].value
			if(txtEnfantRetour.options[txtEnfantRetour.selectedIndex].value>0)
			{
				param +="&txtEnfant_g0_retour="+txtEnfant_g0_retour.options[txtEnfant_g0_retour.selectedIndex].value;
				param +="&txtEnfant_g1_retour="+txtEnfant_g1_retour.options[txtEnfant_g1_retour.selectedIndex].value;
				param +="&txtEnfant_g2_retour="+txtEnfant_g2_retour.options[txtEnfant_g2_retour.selectedIndex].value;
				param +="&txtEnfant_g3_retour="+txtEnfant_g3_retour.options[txtEnfant_g3_retour.selectedIndex].value;
			}
			else
			{
				param +="&txtEnfant_g0_retour=0";
				param +="&txtEnfant_g1_retour=0";
				param +="&txtEnfant_g2_retour=0";
				param +="&txtEnfant_g3_retour=0";
			}
			param += "&txtCieAerienneRetour="+txtCieAerienneRetour.value;
			param += "&txtDestinationVolRetour="+txtDestinationVolRetour.value;
			param += "&txtProvenanceVolRetour="+txtProvenanceVolRetour.value;
			param += "&txtHeureVolRetour="+txtHeureVolRetour.options[txtHeureVolRetour.selectedIndex].value;
			param += "&txtMinuteVolRetour="+txtMinuteVolRetour.options[txtMinuteVolRetour.selectedIndex].value;
			param += "&txtHoraireRetourHd="+txtHoraireRetourHd.value;
			param += "&txtRdvRetour="+txtRdvRetour.options[txtRdvRetour.selectedIndex].value;
			if(txtRdvRetour.options[txtRdvRetour.selectedIndex].value==4)
			{
				param += "&txtAdresseRetour="+txtAdresseRetour.value;
				param += "&txtCodePostalRetour="+txtCodePostalRetour.value;
				param += "&txtVilleRetour="+txtVilleRetour.value;
			}
			else
			{
				param += "&txtAdresseRetour=0";
				param += "&txtCodePostalRetour=0";
				param += "&txtVilleRetour=0";
			}
		}
		param += "&txtCommentaire="+txtCommentaire.value;
		ajax("./php/traitementAjax.php",param,"demandeReservation");
	}
	else
	{
		alert('Il y a des champs manquant');
	}
}

function getion_liste_horaire(id,type)
{
	if(type=="aller")
	{			
		if(id=="txtHoraireFixeAller")
		{
			txtHoraireDemandeAller.selectedIndex=0;
			txtHoraireAllerHd.value = txtHoraireFixeAller.options[txtHoraireFixeAller.selectedIndex].value;
		}
		else if(id=="txtHoraireDemandeAller")
		{
			txtHoraireFixeAller.selectedIndex=0;
			txtHoraireAllerHd.value = txtHoraireDemandeAller.options[txtHoraireDemandeAller.selectedIndex].value;
		}
	}
	else if(type=="retour")
	{
		if(id=="txtHoraireFixeRetour")
		{
			txtHoraireDemandeRetour.selectedIndex=0;
			txtHoraireRetourHd.value = txtHoraireFixeRetour.options[txtHoraireFixeRetour.selectedIndex].value;
		}
		else if(id=="txtHoraireDemandeRetour")
		{
			txtHoraireFixeRetour.selectedIndex=0;
			txtHoraireRetourHd.value = txtHoraireDemandeRetour.options[txtHoraireDemandeRetour.selectedIndex].value;
		}
	}
}

/** FONCTION AJAX **/
function ajax(url,param,choix)
{
	var httpRequest = false;
	
	if (window.XMLHttpRequest) {
		httpRequest = new XMLHttpRequest();
		if (httpRequest.overrideMimeType)
			httpRequest.overrideMimeType('text/xml');
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

function traiter(xhr,choix)
{
	if (xhr.readyState == 4)
	{
		if (xhr.status == 200) 
		{
			if(choix=="majListeHoraireFixeAller")
			{
				if(xhr.responseText!=0)
				{
					divFixeAller.style.display='block';
					var tabHeure = xhr.responseText.split('|');
					txtHoraireFixeAller.options.length=1;
					
					for(var i=0;i<tabHeure.length-1;i++)
					{
						var elem = tabHeure[i].split('_');
						txtHoraireFixeAller.options[txtHoraireFixeAller.length] = new Option(elem[1],elem[0]);
					}
				}
				else
				{
					divFixeAller.style.display='none';
				}
			}
			else if(choix=="majListeHoraireFixeRetour")
			{
				if(xhr.responseText!=0)
				{
					divFixeRetour.style.display='block';
					var tabHeure = xhr.responseText.split('|');
					txtHoraireFixeRetour.options.length=1
					
					for(var i=0;i<tabHeure.length-1;i++)
					{
						var elem = tabHeure[i].split('_');
						txtHoraireFixeRetour.options[txtHoraireFixeRetour.length] = new Option(elem[1],elem[0]);
					}
				}
				else
				{
					divFixeRetour.style.display='none';
				}
			}
			else if(choix=="demandeReservation")
			{
				if(xhr.responseText)
					window.location.href='./affichage_information.php';
			}
		}
		else{}
	}
	else
	{
	}
}
/** FIN FONCTION AJAX **/

trajet_aller_simple.onclick = gestion_formulaire_aller_retour;
trajet_aller_retour.onclick = gestion_formulaire_aller_retour;
txtDepart.onchange = gestion_liste_a_r;
txtDestination.onchange = gestion_liste_a_r;
txtRdvAller.onchange = affichage_domicile;
txtRdvRetour.onchange = affichage_domicile;
txtEnfantAller.onchange = affichage_enfant;
txtEnfantRetour.onchange = affichage_enfant;
boutonRechercher.onclick = confirmation_reservation;
txtHoraireFixeAller.onchange = function(){getion_liste_horaire('txtHoraireFixeAller','aller')};
txtHoraireDemandeAller.onchange = function(){getion_liste_horaire('txtHoraireDemandeAller','aller')};
txtHoraireFixeRetour.onchange = function(){getion_liste_horaire('txtHoraireFixeRetour','retour')};
txtHoraireDemandeRetour.onchange = function(){getion_liste_horaire('txtHoraireDemandeRetour','retour')};