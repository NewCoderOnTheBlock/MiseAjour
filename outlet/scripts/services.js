window.addEventListener('load', function() {
	var plus_formules = document.querySelectorAll('#contenu .formules .plus_services');
	for (var i = 0; i < plus_formules.length; i++)
	{
		var span = plus_formules[i];
		span.addEventListener('click', showTextesFormules);
	}

	var plus_infos = document.querySelectorAll('#contenu .formules .plus_infos_pratiques');
	for (var i = 0; i < plus_infos.length; i++)
	{
		var span = plus_infos[i];
		span.addEventListener('click', showHorairesTarifs);
	}

	function showTextesFormules(event)
	{
		var id = event.target.id.substr(8);
		var bloc_texte_formule = $('#infos_service_'+id);	
		bloc_texte_formule.slideToggle("slow",function(){
			if (bloc_texte_formule[0].style.display == 'block')
			{
				event.target.innerHTML = '-';
				event.target.style.padding = '3px 11.5px';
			}
			else
			{
				event.target.innerHTML = '+';
				event.target.style.padding = '3px 9px';
			}
		});
	}

	function showHorairesTarifs(event)
	{
		var id = event.target.id.substr(6);
		var bloc_horaires_tarifs = $('#horaires_tarifs_'+id);	
		bloc_horaires_tarifs.slideToggle("slow",function(){
			if (bloc_horaires_tarifs[0].style.display == 'block')
			{
				event.target.innerHTML = '-';
				event.target.style.padding = '3px 11.5px';
			}
			else
			{
				event.target.innerHTML = '+';
				event.target.style.padding = '3px 9px';
			}
		});
	}
});