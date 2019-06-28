var btn_envoyer = document.getElementById("btn_envoyer");
var civ = document.getElementById("lst_civ");
var nom = document.getElementById("nom");
var prenom = document.getElementById("prenom");
var ville = document.getElementById("ville");
var pays = document.getElementById("pays");
var mail = document.getElementById("mail");
var reseau_fb = document.getElementById("fb");
var reseau_tw = document.getElementById("tw");
var reseau_vd = document.getElementById("vd");
var reseau_li = document.getElementById("li");
var reseau_fo = document.getElementById("fo");
var reseau_fo_txt = document.getElementById("comm_forum");
var avion_ans = document.getElementsByName("pp");
var avion_rhin = document.getElementById("lst_aeroport");
var comm_dest = document.getElementById("comm_dest");
var raison_perso = document.getElementById("ra_perso");
var raison_pro = document.getElementById("ra_pro");
var conn_internet = document.getElementById("connaissance_internet");
var conn_lien = document.getElementById("connaissance_lien");
var conn_moteur = document.getElementById("connaissance_moteur");
var conn_moteur_txt = document.getElementById("connaissance_moteur_txt");
var conn_reseau = document.getElementById("connaissance_reseau");
var conn_reseau_lst = document.getElementById("connaissance_reseau_lst");
var conn_presse = document.getElementById("connaissance_presse");
var conn_radio = document.getElementById("connaissance_radio");
var conn_autre = document.getElementById("connaissance_autre");
var conn_autre_txt = document.getElementById("connaissance_autre_txt");
var trouve_facile = document.getElementsByName("trouve_facilement");
var trouve_facilement_txt = document.getElementById("trouve_facilement_txt");
var trouve_facilement_txt2 = document.getElementById("trouve_facilement_txt2");
var utilise_ana = document.getElementsByName("utilise_aeroport");
var utilise_ant = document.getElementsByName("utilise_tourisme");
var utilise_lvc = document.getElementsByName("utilise_lvc");
var va_utiliser = document.getElementsByName("va_utiliser");
var va_utiliser_td = document.getElementById("va_utiliser_td");
var va_utiliser_ana = document.getElementById("va_utiliser_aeroport");
var va_utiliser_ant = document.getElementById("va_utiliser_tourisme");
var va_utiliser_lvc = document.getElementById("va_utiliser_lvc");
var nouveau_service = document.getElementById("comm_nouveau_service");
var clarte = document.getElementsByName("clarte");
var ergo = document.getElementsByName("ergo");
var facilite = document.getElementsByName("facilite");
var qualite_accueil = document.getElementsByName("qualite_accueil");
var qualite_chauffeur = document.getElementsByName("qualite_chauffeur");
var qualite_transport = document.getElementsByName("qualite_transport");
var qualite_prix = document.getElementsByName("qualite_prix");
var global = document.getElementsByName("global");
var recommander = document.getElementsByName("recommendation");
var comm_site = document.getElementById("commentaire_site");
var sugg_site = document.getElementById("suggestion_site");
var etape = document.getElementById("etape");
var btn_suivant = document.getElementById("btn_suivant");

var btn_retour = document.getElementById("btn_retour").parentNode;


for(var i = 1; i < 6; i++)
{
    document.getElementById("div_" + i).style.display = "none";
}


function suivant()
{
    if(etape.value == 0)
	{
		btn_retour.style.display = "inline";
	}

    
    if(etape.value == 4)
    {
        document.getElementById("div_" + etape.value).style.display = "none";
        etape.value = parseInt(etape.value) + 1;
        document.getElementById("div_" + etape.value).style.display = "block";
        btn_suivant.style.display = "none";
        btn_envoyer.style.display = "block";
    }
    else
    {
        document.getElementById("div_" + etape.value).style.display = "none";
        etape.value = parseInt(etape.value) + 1;
        document.getElementById("div_" + etape.value).style.display = "block";
    }
}


function retour()
{
    document.getElementById("div_" + etape.value).style.display = "none";
    etape.value = parseInt(etape.value) - 1;
    document.getElementById("div_" + etape.value).style.display = "block";
}


btn_suivant.onclick = verifier;

btn_retour.onclick = retour;


function verifier()
{
    

    if(etape.value == 0)
    {
        var champ_vide = new Array();
        if(civ.selectedIndex == 0)
            champ_vide.push("Civilité");

        if(nom.value == "")
            champ_vide.push("Nom");

        if(prenom.value == "")
            champ_vide.push("Prénom");

        if(pays.selectedIndex == 0)
            champ_vide.push("Pays");

        if(mail.value == "")
            champ_vide.push("Mail");

        if(reseau_fo.checked && reseau_fo_txt.value == "")
            champ_vide.push("Forum");
        
        if(champ_vide.length == 0)
            suivant();
        else
            {
                var t = "";

                for(var j = 0; j < champ_vide.length; j++)
                    t += champ_vide[j] + " - ";

                alert("Les questions suivantes n'ont pas été traités : " + t);
            }

    }
    else if(etape.value == 1)
    {
        var champ_vide = new Array();
        if(!avion_ans[0].checked && !avion_ans[1].checked && !avion_ans[2].checked && !avion_ans[3].checked)
            champ_vide.push("1");

        if(avion_rhin.selectedIndex == 0)
            champ_vide.push("2");

        if(comm_dest.value == "")
            champ_vide.push("3");

        if(!raison_perso.checked && !raison_pro.checked)
            champ_vide.push("4");

        if(champ_vide.length == 0)
            suivant();
        else
            {
                var t = "";

                for(var j = 0; j < champ_vide.length; j++)
                    t += champ_vide[j] + " - ";

                alert("Les questions suivantes n'ont pas été traités : " + t);
            }
    }
    else if(etape.value == 2)
    {
        var champ_vide = new Array();
  
        if(!conn_internet.checked && !conn_lien.checked && !conn_moteur.checked && !conn_reseau.checked && !conn_presse.checked && !conn_radio.checked && !conn_autre.checked)
            champ_vide.push("5");

        if(conn_moteur.checked && conn_moteur_txt.value == "")
            champ_vide.push("Mots clés des moteurs de recherche");

        if(conn_reseau.checked && conn_reseau_lst.selectedIndex == 0)
            champ_vide.push("Découverte par réseau social");

        if(conn_autre.checked && conn_autre_txt.value == "")
            champ_vide.push("Découverte du site");

        if(!trouve_facile[0].checked && !trouve_facile[1].checked)
            champ_vide.push("6");

        if(trouve_facile[1].checked && trouve_facilement_txt.value == "")
            champ_vide.push("Difficulté pour trouver le site");

        if(champ_vide.length == 0)
            suivant();
        else
            {
                var t = "";

                for(var j = 0; j < champ_vide.length; j++)
                    t += champ_vide[j] + " - ";

                alert("Les questions suivantes n'ont pas été traités : " + t);
            }
    }
    else if(etape.value == 3)
    {
        var champ_vide = new Array();
        if(!utilise_ana[0].checked && !utilise_ana[1].checked)
            champ_vide.push("7 (Aéroport)");

        if(!utilise_ant[0].checked && !utilise_ant[1].checked)
            champ_vide.push("7 (Tourisme)");

        if(!utilise_lvc[0].checked && !utilise_lvc[1].checked)
            champ_vide.push("7 (LVC)");

        if(!va_utiliser[0].checked && !va_utiliser[1].checked)
            champ_vide.push("8");

        if(va_utiliser[0].checked && !va_utiliser_ana.checked && !va_utiliser_ant.checked && !va_utiliser_lvc.checked)
            champ_vide.push("8 (Service)");

        if(champ_vide.length == 0)
            suivant();
        else
            {
                var t = "";

                for(var j = 0; j < champ_vide.length; j++)
                    t += champ_vide[j] + " - ";

                alert("Les questions suivantes n'ont pas été traités : " + t);
            }
    }
    else if(etape.value == 4)
    {
        var champ_vide = new Array();
        var trouve = false;
        for(var i = 0; i < 6 && !trouve; i++)
        {
            if(clarte[i].checked)
                trouve = true;
        }
        if(!trouve)
            champ_vide.push("10 (Clarte)");

        trouve = false;
        for(i = 0; i < 6 && !trouve; i++)
        {
            if(ergo[i].checked)
                trouve = true;
        }
        if(!trouve)
            champ_vide.push("10 (Ergonomie)");

        trouve = false;
        for(i = 0; i < 6 && !trouve; i++)
        {
            if(facilite[i].checked)
                trouve = true;
        }
        if(!trouve)
             champ_vide.push("10 (Facilité de réservation)");

        trouve = false;
        for(i = 0; i < 6 && !trouve; i++)
        {
            if(qualite_accueil[i].checked)
                trouve = true;
        }
        if(!trouve)
            champ_vide.push("10 (Qualité de l'accueil)");

        trouve = false;
        for(i = 0; i < 6 && !trouve; i++)
        {
            if(qualite_chauffeur[i].checked)
                trouve = true;
        }
        if(!trouve)
            champ_vide.push("10 (Qualité du chauffeur)");

        trouve = false;
        for(i = 0; i < 6 && !trouve; i++)
        {
            if(qualite_transport[i].checked)
                trouve = true;
        }
        if(!trouve)
            champ_vide.push("10 (Qualité du transport)");

        trouve = false;
        for(i = 0; i < 6 && !trouve; i++)
        {
            if(!qualite_prix[i].checked)
                trouve = true;
        }
        if(!trouve)
            champ_vide.push("10 (Qualité prix)");

        trouve = false;
        for(i = 0; i < 6 && !trouve; i++)
        {
            if(global[i].checked)
                trouve = true;
        }
        if(!trouve)
             champ_vide.push("10 (Satisfaction globale)");

         if(champ_vide.length == 0)
            suivant();
        else
            {
                var t = "";

                for(var j = 0; j < champ_vide.length; j++)
                    t += champ_vide[j] + " - ";

                alert("Les questions suivantes n'ont pas été traités : " + t);
            }
    }
    else
    {
        var champ_vide = new Array();
        if(!recommander[0].checked && !recommander[1].checked && !recommander[2].checked)
            champ_vide.push("11");
    

        if(champ_vide.length != 0)
        {
            var t = "";

            for(var j = 0; j < champ_vide.length; j++)
                t += champ_vide[j] + " - ";

            alert("Les questions suivantes n'ont pas été traités : " + t);
        }
        else
            document.getElementById("form").submit();
    }
    
}


function affiche_txt(t, id)
{
    if(t.checked)
        id.style.display = "block";
    else
        id.style.display = "none";
}


function affiche_txt_inline(t, id)
{
    if(t.checked)
        id.style.display = "inline";
    else
        id.style.display = "none";
}


function affiche_txt_radio(t, id, ind)
{
    if(t[ind].checked)
        id.style.display = "block";
    else
        id.style.display = "none";
}


function efface()
{
    if(this.value == "Commentaires..." || this.value == "Suggestions pour le site...")
        this.value = "";
}




reseau_fo.onclick = function() { affiche_txt(reseau_fo, reseau_fo_txt); };
conn_moteur.onclick = function() { affiche_txt(conn_moteur, conn_moteur_txt); };
conn_reseau.onclick = function() { affiche_txt(conn_reseau, conn_reseau_lst); };
conn_autre.onclick = function() { affiche_txt_inline(conn_autre, conn_autre_txt); };
trouve_facile[0].onchange = function() { affiche_txt_radio(trouve_facile, trouve_facilement_txt2, 1); };
trouve_facile[1].onchange = function() { affiche_txt_radio(trouve_facile, trouve_facilement_txt2, 1); };
va_utiliser[0].onchange = function() { affiche_txt_radio(va_utiliser, va_utiliser_td, 0); };
va_utiliser[1].onchange = function() { affiche_txt_radio(va_utiliser, va_utiliser_td, 0); };

comm_site.onclick = efface;
sugg_site.onclick = efface;


btn_envoyer.onclick = verifier;
