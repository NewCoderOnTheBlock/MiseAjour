window.addEventListener('load', function() {
  var tab_events = [];

  var select_depart = document.querySelector('#contenu .formulaire_reservation #depart');
  select_depart.addEventListener('change', function (event) {
      var input_depart = document.querySelector('#contenu .formulaire_reservation #input_depart');
      input_depart.value = event.target.options[event.target.options.selectedIndex].value;
      var div_adresse = document.querySelector('#contenu .formulaire_reservation #adresse_client');
      if (event.target.options[event.target.options.selectedIndex].value == 4)
      {
          div_adresse.style.display = 'block';
      }
      else
      {
          div_adresse.style.display = 'none';
      }
  })

  tableau = function(mois,annee)
  {
      var url = './ajax_calendrier.php';
      var parametres = 'mois=' + mois + '&annee=' + annee;

      var myAjax = new Ajax.Request(
      	url,
      	{
      		method: 'post',
      		parameters: parametres,
      		onComplete: remplirCalendrier
      	}
      );

      // On cache par défaut la dernière ligne du tableau
      var tr = document.querySelector('div#calendrier > div > table > tbody > tr:last-of-type');
      tr.style.display = 'none';
  }

  function remplirCalendrier(reponsejson) {
      //on utilise la fonction evalJSON de prototype pour parser la réponse JSON
      var data=reponsejson.responseText.evalJSON();

      //On place les liens suivants,précédents et le mois en cours
      document.getElementById('link_suivant').onclick=function(){eval(data.lien_suivant) ;};
      document.getElementById('link_precedent').onclick=function(){eval(data.lien_precedent);};
      document.getElementById('titre').innerHTML=data.mois_en_cours;

      //Maintenant, on affiche tous les jours du calendrier
      var compteur=1;
      var id='';
      while(compteur<43){
        id=compteur.toString();
        var case_cal = document.getElementById(id);

        // Gestion de l'affichage des trajets sur le calendrier avec une couleur par centre outlet

        // On remet un fond blanc pour toutes les cases
        case_cal.className = case_cal.className.replace(" case_metzingen","");
        case_cal.className = case_cal.className.replace(" case_roppenheim","");
        case_cal.className = case_cal.className.replace(" case_talange","");
        case_cal.className = case_cal.className.replace(" case_zweibrucken","");
        // Puis on les colorie si besoin
        var events = data.calendrier[(compteur-1)].events;
        if (events != null)
        {
            case_cal.style.cursor = "pointer";
            case_cal.addEventListener('click',chooseEvent);
            tab_events[compteur] = events;
            if (events.lieu == "Outlet City - Metzingen")
            {
                case_cal.className = case_cal.className + " case_metzingen";
            }
            else if (events.lieu == "The Style Outlet - Roppenheim")
            {
                case_cal.className = case_cal.className + " case_roppenheim";
            }
            else if (events.lieu == "Marques Avenue - Talange")
            {
                case_cal.className = case_cal.className + " case_talange";
            }
            else if(events.lieu == "The Style Outlet - Zweibrucken")
            {
                case_cal.className = case_cal.className + " case_zweibrucken";
            }
        }

        case_cal.innerHTML=data.calendrier[(compteur-1)].fill;
        if (compteur == 36)
        {
            var tr = document.querySelector('div#calendrier > div > table > tbody > tr:last-of-type');
            if (case_cal.innerHTML == '') // Si la première case de la dernière ligne est vide
            {
                // On cache la dernière ligne du tableau
                tr.style.display = 'none';
            }
            else
            {
                // On affiche la dernière ligne du tableau
                tr.style.display = 'table-row';
            }
        }
        compteur++;
      }
  }

  function chooseEvent(event) {
      var td = event.target;
      var id = td.id;
      var events = tab_events[id];

      var input_date = document.querySelector('#contenu .formulaire_reservation #date');
      var input_destination = document.querySelector('#contenu .formulaire_reservation #destination');
      var select_depart = document.querySelector('#contenu .formulaire_reservation #depart');
      var input_id_lieu = document.querySelector('#contenu .formulaire_reservation #id_lieu')
      var input_heure_depart = document.querySelector('#contenu .formulaire_reservation #heure_depart');
      var input_heure_retour = document.querySelector('#contenu .formulaire_reservation #heure_retour');
      var input_id_trajet = document.querySelector('#contenu .formulaire_reservation #id_trajet');
      var div_adresse = document.querySelector('#contenu .formulaire_reservation #adresse_client');

      select_depart.disabled = false;
      input_date.value = events.date;
      input_destination.value = events.lieu;
      input_id_lieu.value = events.id_lieu;
      input_heure_depart.value = events.heure_depart;
      input_heure_retour.value = events.heure_retour;
      input_id_trajet.value = events.id_trajet;

      // Gestion de la journée à Metzingen du 14 juillet
      if (events.date == '14/07/2015' && events.id_lieu == 1)
      {
          var options = select_depart.options;
          var i = 0;
          var trouve = false;
          while (i < options.length && !trouve)
          {
              if (options[i].value == 3)
              {
                  options[i].selected = true;
                  trouve = true;
              }
              else
              {
                  i++;
              }
          }
          select_depart.disabled = true;
          div_adresse.style.display = 'none';
      }

      if (window.outerWidth < 767 || window.clientWidth < 767) 
      {
        $('html, body').animate({scrollTop: $("#form_reservation").offset().top
          }, "slow");
      }
  }
});