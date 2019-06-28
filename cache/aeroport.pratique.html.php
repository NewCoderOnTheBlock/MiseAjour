<?php $tpl->includeTpl('aeroport/include.html', false, 0); ?>
<!--
fichier:aeroport.pratique.html
updated:19/06/2019
-->
<script>
	function changerHoraires(e,id) {
		if (id == 100)
		{
			e.className = e.className + ' bloc_strasbourg_selectionne';
		}
		var infos_pratiques = document.getElementById('infos_pratiques_'+id);
		
		var bloc_aeroport_selectionne = document.querySelector('.liste_aeroports .bloc_aeroport_selectionne');
		if (bloc_aeroport_selectionne != undefined)
		{
			bloc_aeroport_selectionne.className = bloc_aeroport_selectionne.className.replace('bloc_strasbourg_selectionne','');
			bloc_aeroport_selectionne.className = bloc_aeroport_selectionne.className.replace('bloc_aeroport_selectionne','');
		}
		
		e.className = e.className + ' bloc_aeroport_selectionne';
		
		var tab_infos_pratiques = document.querySelectorAll('.pratique .infos_pratiques > div');
		
		var trouve = false;
		var infos_pratiques_ouvert;
		var i = 0;
		while(!trouve && i < tab_infos_pratiques.length)
		{
			var elem = tab_infos_pratiques[i];
			if (elem.style.display == 'block')
			{
				infos_pratiques_ouvert = elem;
				trouve = true;
			}
			else
			{
				i++;
			}
		}
		
		infos_pratiques_ouvert.style.display = 'none';
		
		infos_pratiques.style.display = 'block';
		
		if (window.outerWidth < 767 || window.clientWidth < 767) 
		{
			$('html, body').animate({scrollTop: $("#"+infos_pratiques.id).offset().top
				}, "slow");
		}
	}
	
	function showEte(id){
		document.getElementById("infos_pratiques_horaires_hiver_"+id).style.display = "none";
		document.getElementById("bandeau_hiver_"+id).style.backgroundColor = "#2C9EB4";
		document.getElementById("bandeau_hiver_"+id).style.color = "white";
		
		document.getElementById("infos_pratiques_horaires_ete_"+id).style.display = "block";
		document.getElementById("bandeau_ete_"+id).style.background = "none";
		document.getElementById("bandeau_ete_"+id).style.color = "#2C9EB4";
	}
	function showHiver(id){
		document.getElementById("infos_pratiques_horaires_ete_"+id).style.display = "none";
		document.getElementById("bandeau_ete_"+id).style.backgroundColor = "#2C9EB4";
		document.getElementById("bandeau_ete_"+id).style.color = "white";
		
		document.getElementById("infos_pratiques_horaires_hiver_"+id).style.display = "block";
		document.getElementById("bandeau_hiver_"+id).style.background = "none";
		document.getElementById("bandeau_hiver_"+id).style.color = "#2C9EB4";
	}
</script>

<div class="row">
	
	<h3 class="titre_pratique"><?php echo $tpl->vars['TITRE']; ?></h3>
	
	<div class="pratique row">
		<p style="padding:0 35px;margin-top:20px;"><?php echo $tpl->vars['TRAJET_SIMPLE']; ?></p>
		<div class="liste_aeroports col-xs-12 col-sm-6 col-md-6">	
			<?php if ($tpl->getBlock('horaires')) : foreach ($tpl->getBlock('horaires') as $__tpl_blocs['horaires']){ ?>
				<div class="col-xs-6 col-sm-6 col-md-3 bloc_aeroport <?php echo $__tpl_blocs['horaires']['SELEC']; ?>" onclick="changerHoraires(this,<?php echo $__tpl_blocs['horaires']['ID_LIEU']; ?>)">
					<div class="col-xs-12 col-sm-12 col-md-12 bloc_aeroport_nom">
						<?php echo $__tpl_blocs['horaires']['DEST']; ?>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-12 bloc_aeroport_voir">
						<?php echo $tpl->vars['VOIR_PLUS']; ?>
					</div>
				</div>				
			<?php } endif; ?>
			<div class="col-xs-12 col-sm-12 col-md-12 bloc_aeroport bloc_strasbourg <?php echo $__tpl_blocs['horaires']['SELEC']; ?>" onclick="changerHoraires(this,100)">
				<div class="col-xs-12 col-sm-12 col-md-12 bloc_aeroport_nom">
					Strasbourg<br><span style="font-weight:normal;font-size:12px;"><?php echo $tpl->vars['POINTS_RASS_STRASBOURG']; ?></span>
				</div>
			</div>		
		</div>
		
		<div class="infos_pratiques col-xs-12 col-sm-6 col-md-6">
			<?php if ($tpl->getBlock('horaires')) : foreach ($tpl->getBlock('horaires') as $__tpl_blocs['horaires']){ ?>
				<div id="infos_pratiques_<?php echo $__tpl_blocs['horaires']['ID_LIEU']; ?>" class="col-xs-12 col-sm-12 col-md-12" style="display:<?php echo $__tpl_blocs['horaires']['DISPLAY']; ?>;padding:0;">
					<div class="infos_pratiques_nom col-xs-12 col-sm-12 col-md-12">
						<div class="col-xs-12 col-sm-12 col-md-5" style="padding:10px 0;"><span style="text-transform:uppercase;font-weight:bold;"><?php echo $__tpl_blocs['horaires']['DEST']; ?></span><br><a href="tarifs.php?id=<?php echo $__tpl_blocs['horaires']['ID_LIEU']; ?>" style="font-size:10px;text-decoration:underline;"><?php echo $tpl->vars['INFOS_TARIF']; ?></a></div>
						<div class="col-xs-12 col-sm-12 col-md-7" style="z-index:1;text-align:right;padding-right:0;"><a href="<?php echo $__tpl_blocs['horaires']['LIEN_HORAIRES_VOLS']; ?>"><img src="images/aeroport_<?php echo $__tpl_blocs['horaires']['ID_LIEU']; ?>.png" style="padding-top:10px;border:2px solid #2C9EB4;"></a></div>
					</div>
					
					<div class="infos_pratiques_horaires col-xs-12 col-sm-12 col-md-12">
						<?php if ($__tpl_blocs['horaires']['ID_LIEU'] == 11 || $__tpl_blocs['horaires']['ID_LIEU'] == 10 || $__tpl_blocs['horaires']['ID_LIEU'] == 12) : ?>
							<p style="text-transform:none;margin-top:10px;"><?php echo $tpl->vars['EXPLICATION_AUTRE']; ?></p>
						<?php elseif ($__tpl_blocs['horaires']['ID_LIEU'] == 7) : ?>
							<p style="text-transform:none;margin-top:10px;"><?php echo $tpl->vars['EXPLICATION_ENZTHEIM']; ?></p>
						<?php else : ?>
							<p><?php echo $tpl->vars['HORAIRES_FIXES']; ?></p>
							<div class="infos_pratiques_horaires_tab col-xs-12 col-sm-12 col-md-12">
								<h4 class="col-xs-12 col-sm-6 col-md-6" id="bandeau_ete_<?php echo $__tpl_blocs['horaires']['ID_LIEU']; ?>" onclick="showEte(<?php echo $__tpl_blocs['horaires']['ID_LIEU']; ?>)"><?php echo $tpl->vars['ETE']; ?></h4>
								<h4 class="col-xs-12 col-sm-6 col-md-6" id="bandeau_hiver_<?php echo $__tpl_blocs['horaires']['ID_LIEU']; ?>" onclick="showHiver(<?php echo $__tpl_blocs['horaires']['ID_LIEU']; ?>)" style="background-color:#2C9EB4;color:white;"><?php echo $tpl->vars['HIVER']; ?></h4>
								<p class="col-xs-6 col-sm-6 col-md-6"><?php echo $tpl->vars['DEP_STR_GARE']; ?></p>
								<p class="col-xs-6 col-sm-6 col-md-6"><?php echo $tpl->vars['DEP_AEROPORT']; ?></p>
								
								<div class="infos_pratiques_horaires_ete col-xs-12 col-sm-12 col-md-12" id="infos_pratiques_horaires_ete_<?php echo $__tpl_blocs['horaires']['ID_LIEU']; ?>">
									<div class="infos_pratiques_horaires_ete_depart col-xs-6 col-sm-6 col-md-6">
										<div class="infos_pratiques_horaires_ete_depart_matin col-xs-6 col-sm-6 col-md-6">
											<?php if (isset($__tpl_blocs['horaires']['ete_depart_matin'])) : foreach ($__tpl_blocs['horaires']['ete_depart_matin'] as $__tpl_blocs['ete_depart_matin']){ ?>
												<?php echo $__tpl_blocs['ete_depart_matin']['DEPART']; ?><br>
											<?php } endif; ?>
										</div>
										<div class="infos_pratiques_horaires_ete_depart_am col-xs-6 col-sm-6 col-md-6">
											<?php if (isset($__tpl_blocs['horaires']['ete_depart_am'])) : foreach ($__tpl_blocs['horaires']['ete_depart_am'] as $__tpl_blocs['ete_depart_am']){ ?>
												<?php echo $__tpl_blocs['ete_depart_am']['DEPART']; ?><br>
											<?php } endif; ?>
										</div>
									</div>
									<div class="infos_pratiques_horaires_ete_retour col-xs-6 col-sm-6 col-md-6">
										<div class="infos_pratiques_horaires_ete_retour_matin col-xs-6 col-sm-6 col-md-6">
											<?php if (isset($__tpl_blocs['horaires']['ete_retour_matin'])) : foreach ($__tpl_blocs['horaires']['ete_retour_matin'] as $__tpl_blocs['ete_retour_matin']){ ?>
												<?php echo $__tpl_blocs['ete_retour_matin']['RETOUR']; ?><br>
											<?php } endif; ?>
										</div>
										<div class="infos_pratiques_horaires_ete_retour_am col-xs-6 col-sm-6 col-md-6">
											<?php if (isset($__tpl_blocs['horaires']['ete_retour_am'])) : foreach ($__tpl_blocs['horaires']['ete_retour_am'] as $__tpl_blocs['ete_retour_am']){ ?>
												<?php echo $__tpl_blocs['ete_retour_am']['RETOUR']; ?><br>
											<?php } endif; ?>
										</div>
									</div>
								</div>
								<div class="infos_pratiques_horaires_hiver col-xs-12 col-sm-6 col-md-12" id="infos_pratiques_horaires_hiver_<?php echo $__tpl_blocs['horaires']['ID_LIEU']; ?>" style="display:none;">
									<div class="infos_pratiques_horaires_hiver_depart col-xs-6 col-sm-6 col-md-6">
										<div class="infos_pratiques_horaires_hiver_depart_matin col-xs-6 col-sm-6 col-md-6">
											<?php if (isset($__tpl_blocs['horaires']['hiver_depart_matin'])) : foreach ($__tpl_blocs['horaires']['hiver_depart_matin'] as $__tpl_blocs['hiver_depart_matin']){ ?>
												<?php echo $__tpl_blocs['hiver_depart_matin']['DEPART']; ?><br>
											<?php } endif; ?>
										</div>
										<div class="infos_pratiques_horaires_hiver_depart_am col-xs-6 col-sm-6 col-md-6">
											<?php if (isset($__tpl_blocs['horaires']['hiver_depart_am'])) : foreach ($__tpl_blocs['horaires']['hiver_depart_am'] as $__tpl_blocs['hiver_depart_am']){ ?>
												<?php echo $__tpl_blocs['hiver_depart_am']['DEPART']; ?><br>
											<?php } endif; ?>
										</div>
									</div>
									<div class="infos_pratiques_horaires_hiver_retour col-xs-6 col-sm-6 col-md-6">
										<div class="infos_pratiques_horaires_hiver_retour_matin col-xs-6 col-sm-6 col-md-6">
											<?php if (isset($__tpl_blocs['horaires']['hiver_retour_matin'])) : foreach ($__tpl_blocs['horaires']['hiver_retour_matin'] as $__tpl_blocs['hiver_retour_matin']){ ?>
												<?php echo $__tpl_blocs['hiver_retour_matin']['RETOUR']; ?><br>
											<?php } endif; ?>
										</div>
										<div class="infos_pratiques_horaires_hiver_retour_am col-xs-6 col-sm-6 col-md-6">
											<?php if (isset($__tpl_blocs['horaires']['hiver_retour_am'])) : foreach ($__tpl_blocs['horaires']['hiver_retour_am'] as $__tpl_blocs['hiver_retour_am']){ ?>
												<?php echo $__tpl_blocs['hiver_retour_am']['RETOUR']; ?><br>
											<?php } endif; ?>
										</div>
									</div>
								</div>
							</div>
						<?php endif; ?>
					</div>
					
					<?php if ($__tpl_blocs['horaires']['ID_LIEU'] != 7 && $__tpl_blocs['horaires']['ID_LIEU'] != 10 && $__tpl_blocs['horaires']['ID_LIEU'] != 11 && $__tpl_blocs['horaires']['ID_LIEU'] != 12) : ?>
						<div class="col-xs-12 col-sm-12 col-md-12 infos_pratiques_option">
							<p style="text-transform:none;font-weight:normal;"><span style="font-weight:bold;"><?php echo $tpl->vars['OPTION']; ?></span> <?php echo $tpl->vars['TXT_OPTION_DEMANDE']; ?></p>
						</div>
					<?php endif; ?>
					
					<div class="col-xs-12 col-sm-12 col-md-12 infos_pratiques_duree">
						<p style="font-weight:normal;margin-bottom:0;"><span style="font-weight:bold;"><?php echo $tpl->vars['DUREE']; ?></span> <?php echo $__tpl_blocs['horaires']['DUREE']; ?></p>
					</div>
					
					<?php if ($__tpl_blocs['horaires']['ID_LIEU'] == 1 || $__tpl_blocs['horaires']['ID_LIEU'] == 2 || $__tpl_blocs['horaires']['ID_LIEU'] == 3 || $__tpl_blocs['horaires']['ID_LIEU'] == 5 || $__tpl_blocs['horaires']['ID_LIEU'] == 6) : ?>
						<div class="col-xs-12 col-sm-12 col-md-12 infos_pratiques_rass" id="infos_pratiques_rass_<?php echo $__tpl_blocs['horaires']['ID_LIEU']; ?>">
							<p><?php echo $tpl->vars['PT_RASS']; ?></p>
							<?php if ($__tpl_blocs['horaires']['ID_LIEU'] == 1) : ?>
								<p class="col-xs-12 col-sm-12 col-md-7"><?php echo $tpl->vars['TXT_RASS_BALE']; ?></p>
								<p class="col-xs-12 col-sm-12 col-md-5" style="text-align:right;"><a href="https://www.google.fr/maps/place/47%C2%B035%2757.6%22N+7%C2%B031%2757.7%22E/@47.599325,7.532699,618m/data=!3m2!1e3!4b1!4m2!3m1!1s0x0:0x0!6m1!1e1?hl=fr"><?php echo $tpl->vars['TXT_GOOGLE_MAP']; ?><img src="images/icones/maps-16.gif" style="margin-left:5px;margin-bottom:4px;"></a></p>
								<p class="col-xs-12 col-sm-12 col-md-6"><img src="images/sortie_bale.jpg" width="90%"></p>
								<p class="col-xs-12 col-sm-12 col-md-6"><a href="http://www.euroairport.com/fr/stationnement/"><img src="images/plan_bale.jpg" width="90%"></a></p>
							<?php elseif ($__tpl_blocs['horaires']['ID_LIEU'] == 2) : ?>
								<p class="col-xs-12 col-sm-12 col-md-7"><?php echo $tpl->vars['TXT_RASS_BADEN']; ?></p>
								<p class="col-xs-12 col-sm-12 col-md-5" style="text-align:right;"><a href="https://www.google.fr/maps/place/48%C2%B046%2742.5%22N+8%C2%B005%2714.5%22E/@48.778475,8.087358,604m/data=!3m2!1e3!4b1!4m2!3m1!1s0x0:0x0!6m1!1e1?hl=fr"><?php echo $tpl->vars['TXT_GOOGLE_MAP']; ?><img src="images/icones/maps-16.gif" style="margin-left:5px;margin-bottom:4px;"></a></p>
								<p class="col-xs-12 col-sm-12 col-md-5"><img src="images/sortie_baden.jpg" width="80%"></p>
								<p class="col-xs-12 col-sm-12 col-md-7"><a href="images/plan_baden_big.png"><img src="images/plan_baden.jpg" width="100%"></a></p>
							<?php elseif ($__tpl_blocs['horaires']['ID_LIEU'] == 3) : ?>
								<p class="col-xs-12 col-sm-12 col-md-7"><?php echo $tpl->vars['TXT_RASS_STUTTGART']; ?></p>
								<p class="col-xs-12 col-sm-12 col-md-5" style="text-align:right;"><a href="https://www.google.fr/maps/place/48%C2%B041%2725.9%22N+9%C2%B011%2734.0%22E/@48.690465,9.191962,505m/data=!3m1!1e3!4m2!3m1!1s0x0:0x0!6m1!1e1?hl=fr"><?php echo $tpl->vars['TXT_GOOGLE_MAP']; ?><img src="images/icones/maps-16.gif" style="margin-left:5px;margin-bottom:4px;"></a></p>
								<p class="col-xs-12 col-sm-12 col-md-5"><img src="images/sortie_stuttgart.jpg" width="80%"></p>
								<p class="col-xs-12 col-sm-12 col-md-7"><a href="http://www.stuttgart-airport.com/travellers-and-visitors/service/terminal-guide/"><img src="images/plan_stutt.jpg" width="100%"></a></p>
							<?php elseif ($__tpl_blocs['horaires']['ID_LIEU'] == 5) : ?>
								<p class="col-xs-12 col-sm-12 col-md-7"><?php echo $tpl->vars['TXT_RASS_FRANCFORT_MAIN']; ?></p>
								<p class="col-xs-12 col-sm-12 col-md-5" style="text-align:right;"><a href="https://www.google.fr/maps/@50.0497764,8.5689389,245m/data=!3m1!1e3?hl=fr"><?php echo $tpl->vars['TXT_GOOGLE_MAP']; ?><img src="images/icones/maps-16.gif" style="margin-left:5px;margin-bottom:4px;"></a></p>
								<p class="col-xs-12 col-sm-12 col-md-6"><img src="images/sortie_fm.jpg" width="90%"></p>
								<p class="col-xs-12 col-sm-12 col-md-6"><a href="http://www.frankfurt-airport.de/content/frankfurt_airport/de/misc/container/Parken/parkplatzuebersicht20110217/jcr:content.file/park-lageplan_deutsch-inkl--p31.pdf"><img src="images/plan_fm.jpg" width="75%"></a></p>
							<?php else : ?>
								<p class="col-xs-12 col-sm-12 col-md-7"><?php echo $tpl->vars['TXT_RASS_ZURICH']; ?></p>
								<p class="col-xs-12 col-sm-12 col-md-5" style="text-align:right;"><a href="https://www.google.fr/maps/place/AIRPORT+TAXI+Z%C3%9CRICH/@47.4513482,8.5640855,265m/data=!3m1!1e3!4m2!3m1!1s0x0000000000000000:0x1611154dc1dfc40d!6m1!1e1?hl=fr"><?php echo $tpl->vars['TXT_GOOGLE_MAP']; ?><img src="images/icones/maps-16.gif" style="margin-left:5px;margin-bottom:4px;"></a></p>
								<p class="col-xs-12 col-sm-12 col-md-6"><img src="images/sortie_zurich.jpg" width="90%"></p>
								<p class="col-xs-12 col-sm-12 col-md-6"><a href="http://www.aeroport-de-zurich.com/passagers-et-visiteurs/services-a-l-aeroport/plans-des-batiments"><img src="images/plan_zurich.jpg" width="90%"></a></p>
							<?php endif; ?>
						</div>	
					<?php endif; ?>
					
					<div class="col-xs-12 col-sm-12 col-md-12 infos_pratiques_horaires_vols">
						<p><?php echo $tpl->vars['HORAIRES_VOLS']; ?></p>
						<p style="font-weight:normal;text-transform:none;"><?php echo $tpl->vars['TXT_HORAIRES_VOLS']; ?> <a href="<?php echo $__tpl_blocs['horaires']['LIEN_HORAIRES_VOLS']; ?>"><?php echo $tpl->vars['SITE_AEROPORT']; ?></a></p>
					</div>
				</div>
			<?php } endif; ?>
			<div id="infos_pratiques_100" class="col-xs-12 col-sm-12 col-md-12" style="display:none;padding:0;">
				<div class="infos_pratiques_nom col-xs-12 col-sm-12 col-md-12">
					<div class="col-xs-12 col-sm-12 col-md-5" style="padding:10px 0;"><span style="text-transform:uppercase;font-weight:bold;">Strasbourg</span></div>
				</div>
				
				<div class="infos_pratiques_horaires col-xs-12 col-sm-12 col-md-12">
					<p><?php echo $tpl->vars['HORAIRES_DISPONIBLES']; ?></p>
					<p style="text-transform:none;font-weight:normal;"><?php echo $tpl->vars['TXT_HORAIRES_STRASBOURG']; ?></p>
					<ul>
						<li><?php echo $tpl->vars['HOTEL_HILTON']; ?> : <span style="font-weight:bold;">+ 10 </span>min</li>
						<li><?php echo $tpl->vars['PALAIS_DROITS_HOMMES']; ?> : <span style="font-weight:bold;">+ 15 </span>min</li>
					</ul>
				</div>
				
				<div class="col-xs-12 col-sm-12 col-md-12 infos_pratiques_rass">
					<p><?php echo $tpl->vars['PTS_RASS']; ?></p>
					<p><?php echo $tpl->vars['TXT_PTS_RASS_STRASBOURG']; ?></p>	
					<p class="col-xs-12 col-sm-9 col-md-9"><?php echo $tpl->vars['ADRESSE_PALAIS_DROITS_HOMMES']; ?></p><p class="col-xs-12 col-sm-3 col-md-3 infos_pratiques_rass_map"><a href="https://www.google.fr/maps/place/All%C3%A9e+Ren%C3%A9+Cassin,+67000+Strasbourg/@48.59892,7.775552,16z/data=!4m2!3m1!1s0x4796c88d565406df:0x85b1ec8101be5020?hl=fr"><img src="images/icones/maps-16.gif"></a></p>
					<p class="col-xs-12 col-sm-9 col-md-9"><?php echo $tpl->vars['ADRESSE_HOTEL_HILTON']; ?></p><p class="col-xs-12 col-sm-3 col-md-3 infos_pratiques_rass_map"><a href="https://www.google.com/maps/place/1+Rue+Fritz+Kieffer,+67000+Strasbourg,+France/@48.5956782,7.754104,17z/data=!3m1!4b1!4m2!3m1!1s0x4796c85c8c9bb95d:0xf3c3c4ec5e6a34fa"><img src="images/icones/maps-16.gif"></a></p>
					<p class="col-xs-12 col-sm-9 col-md-9" style="margin-bottom:0;"><?php echo $tpl->vars['ADRESSE_GARE']; ?></p><p class="col-xs-12 col-sm-3 col-md-3 infos_pratiques_rass_map" style="margin-bottom:0;"><a href="https://www.google.fr/maps/place/3+Boulevard+de+Metz,+67000+Strasbourg/@48.583634,7.733924,16z/data=!4m2!3m1!1s0x4796c83522536795:0x31c2a0e74455c7ce?hl=fr"><img src="images/icones/maps-16.gif"></a></p>
				</div>	
			</div>
		</div>
	</div>  

	<div class="col-xs-12 col-sm-12 col-md-12 logos_compagnies">
		<div class="col-xs-12 col-sm-2 col-md-2">
			<a href="http://www.airfrance.fr"><img src="images/compagnies/airfrance.png"></a>
		</div>
		<div class="col-xs-12 col-sm-2 col-md-2">
			<a href="http://www.austrian.com"><img src="images/compagnies/austrian.png"></a>
		</div>
		<div class="col-xs-12 col-sm-2 col-md-2">
			<a href="http://www.easyjet.com/fr"><img src="images/compagnies/easyjet.png"></a>
		</div>
		<div class="col-xs-12 col-sm-2 col-md-2">
			<a href="http://www.ryanair.com/fr"><img src="images/compagnies/ryan.png"></a>
		</div>
		<div class="col-xs-12 col-sm-2 col-md-2">
			<a href="https://www.swiss.com/fr/fr"><img src="images/compagnies/swiss.png"></a>
		</div>
		<div class="col-xs-12 col-sm-2 col-md-2">
			<a href="http://www.turkishairlines.com/en-fr"><img src="images/compagnies/turkish.png"></a>
		</div>
	</div>
</div>

<?php $tpl->includeTpl('footer.html', false, 0); ?>
