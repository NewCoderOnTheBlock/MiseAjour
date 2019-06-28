window.addEventListener('load', function() {
	var plus_formules = document.querySelectorAll('#contenu .formules .plus_formules');
	for (var i = 0; i < plus_formules.length; i++)
	{
		var span = plus_formules[i];
		span.addEventListener('click', showTextesFormules);
	}

	var plus_infos = document.querySelectorAll('#contenu .infos_pratiques .plus_infos_pratiques');
	for (var i = 0; i < plus_infos.length; i++)
	{
		var span = plus_infos[i];
		span.addEventListener('click', showInfosPratiques);
	}

	var plus_services = document.querySelectorAll('#contenu .services .plus_services');
	for (var i = 0; i < plus_services.length; i++)
	{
		var span = plus_services[i];
		span.addEventListener('click', showServices);
	}

	function showInfosPratiques(event)
	{
		var id = event.target.id.substr(5);
		var bloc_infos = $('#infos_pratiques_'+id);
		bloc_infos.slideToggle("slow",function(){
			if (bloc_infos[0].style.display == 'block')
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

	function showServices(event)
	{
		var id = event.target.id.substr(14);
		var bloc_services = $('#services_'+id);	
		bloc_services.slideToggle("slow",function(){
			if (bloc_services[0].style.display == 'block')
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

	function showTextesFormules(event)
	{
		var id = event.target.id.substr(8);
		var bloc_texte_formule = $('#texte_formule_'+id);	
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
});