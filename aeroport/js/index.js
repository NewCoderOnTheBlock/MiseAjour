var lang = document.getElementById('hd_lang');

function btnOver(id)
{
	if(id!="boutonOK")
		document.getElementById(id).src='./images/bouton/'+id+"Hover_"+document.getElementById('hd_lang').value+'.png';
	else
		document.getElementById(id).src='./images/bouton/'+id+'Hover.png';
}

function btnOut(id)
{
	if(id!="boutonOK")
		document.getElementById(id).src='./images/bouton/'+id+"_"+document.getElementById('hd_lang').value+'.png';
	else
		document.getElementById(id).src='./images/bouton/'+id+'.png';
}

function mon_compte_hover(id)
{
	document.getElementById(id).style.textDecoration = "underline";
}

function mon_compte_out(id)
{
	document.getElementById(id).style.textDecoration = "none";
}

function overOngletCentre(id)
{
	if(document.getElementById(id).className != 'sousMenuCourantTarifForm')
		document.getElementById(id).style.background = "url('./images/bloc/3c_titre_bloc_centre_actif.png')";
}

function outOngletCentre(id)
{
	if(document.getElementById(id).className != 'sousMenuCourantTarifForm')
		document.getElementById(id).style.background = "url('./images/bloc/3c_titre_bloc_centre_inactif.png')";
}

function hover_tableau_tarif(id)
{
	document.getElementById(id).className = "ligneTarifOver";
	document.getElementById('prix'+id).className = "prixBordeau";
}

function out_tableau_tarif(id)
{
	document.getElementById(id).className = "ligneTabTarif";
	document.getElementById('prix'+id).className = "prixNormal";
}

function changementPageTarif(id)
{
	window.location.href='./fiche_tarif-'+id+'.html';
}

function affichageTarif(id)
{
	if(id=="titreGaucheCelluleCentrale")
	{
		document.getElementById('formulaire_reservation').style.display="block";
		document.getElementById('zone_tarif').style.display="none";
		document.getElementById('titreGaucheCelluleCentrale').className = "sousMenuCourantTarifForm";
		document.getElementById('titreDroiteCelluleCentrale').className = "";
		document.getElementById('titreDroiteCelluleCentrale').style.background = "url('./images/bloc/3c_titre_bloc_centre_inactif.png')";
		document.getElementById('titreGaucheCelluleCentrale').style.background = "url('./images/bloc/3c_titre_bloc_centre_actif.png')";
	}
	else if(id=="titreDroiteCelluleCentrale")
	{
		document.getElementById('formulaire_reservation').style.display="none";
		document.getElementById('zone_tarif').style.display="block";
		document.getElementById('titreDroiteCelluleCentrale').className = "sousMenuCourantTarifForm";
		document.getElementById('titreGaucheCelluleCentrale').className = "";
		document.getElementById('titreDroiteCelluleCentrale').style.background = "url('./images/bloc/3c_titre_bloc_centre_actif.png')";
		document.getElementById('titreGaucheCelluleCentrale').style.background = "url('./images/bloc/3c_titre_bloc_centre_inactif.png')";
	}
}

function changementSousMenuRecap(id)
{
	
	if(id=="navettePourLesvols")
	{
		document.getElementById("navettePourLesvols").className='menuDeroulantSelection';
		document.getElementById("horaireVersBaden").className='menuDeroulantNonSelection';
		document.getElementById("horaireVersBale").className='menuDeroulantNonSelection';
		document.getElementById("horaireAlaDemande").className='menuDeroulantNonSelection';
		
		document.getElementById('contenuInfoBlocDeroulantNavette').style.display = "block";
		document.getElementById('contenuInfoBlocDeroulantKar_Bad').style.display = "none";
		document.getElementById('contenuInfoBlocDeroulantBal_Mul').style.display = "none";
		document.getElementById('contenuInfoBlocDeroulantDemande').style.display = "none";
		
	}
	else if(id=="horaireVersBaden")
	{
		document.getElementById("navettePourLesvols").className='menuDeroulantNonSelection';
		document.getElementById("horaireVersBaden").className='menuDeroulantSelection';
		document.getElementById("horaireVersBale").className='menuDeroulantNonSelection';
		document.getElementById("horaireAlaDemande").className='menuDeroulantNonSelection';
		
		document.getElementById('contenuInfoBlocDeroulantNavette').style.display = "none";
		document.getElementById('contenuInfoBlocDeroulantKar_Bad').style.display = "block";
		document.getElementById('contenuInfoBlocDeroulantBal_Mul').style.display = "none";
		document.getElementById('contenuInfoBlocDeroulantDemande').style.display = "none";
		
	}
	else if(id=="horaireVersBale")
	{
		document.getElementById("navettePourLesvols").className='menuDeroulantNonSelection';
		document.getElementById("horaireVersBaden").className='menuDeroulantNonSelection';
		document.getElementById("horaireVersBale").className='menuDeroulantSelection';
		document.getElementById("horaireAlaDemande").className='menuDeroulantNonSelection';
		
		document.getElementById('contenuInfoBlocDeroulantNavette').style.display = "none";
		document.getElementById('contenuInfoBlocDeroulantKar_Bad').style.display = "none";
		document.getElementById('contenuInfoBlocDeroulantBal_Mul').style.display = "block";
		document.getElementById('contenuInfoBlocDeroulantDemande').style.display = "none";
	}
	else if(id=="horaireAlaDemande")
	{
		document.getElementById("navettePourLesvols").className='menuDeroulantNonSelection';
		document.getElementById("horaireVersBaden").className='menuDeroulantNonSelection';
		document.getElementById("horaireVersBale").className='menuDeroulantNonSelection';
		document.getElementById("horaireAlaDemande").className='menuDeroulantSelection';

		document.getElementById('contenuInfoBlocDeroulantNavette').style.display = "none";
		document.getElementById('contenuInfoBlocDeroulantKar_Bad').style.display = "none";
		document.getElementById('contenuInfoBlocDeroulantBal_Mul').style.display = "none";
		document.getElementById('contenuInfoBlocDeroulantDemande').style.display = "block";
	}
}
function envoyerform(name){
	document.getElementsByName(name)[0].submit();
}