<?php $tpl->includeTpl('aeroport/include.html', false, 0); ?>
<!--
fichier:aeroport.index.html.php
updated 26/06/2019
-->

<div id="contenu" class="row">

    <input type="hidden" id="logger" value="<?php echo $tpl->vars['LOGGER']; ?>" />
    <input type="hidden" id="heure_fixe_aller" value="<?php echo $tpl->vars['HEURE_FIXE_ALLER']; ?>" />
    <input type="hidden" id="heure_fixe_retour" value="<?php echo $tpl->vars['HEURE_FIXE_RETOUR']; ?>" />
	
	<script type="text/javascript" src="<?php echo $tpl->vars['BASEURL']; ?>styles/csshover.js"></script>

    <script type="text/javascript" src="<?php echo $tpl->vars['BASEURL']; ?>scripts/calendrier.js"></script>
	<script type="text/javascript" src="scripts/jssor.slider.mini.js"></script>
	<script>
		jQuery(document).ready(function ($) {
			var options = {
				$AutoPlay: true,                                    //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
                $AutoPlaySteps: 1,                                  //[Optional] Steps to go for each navigation request (this options applys only when slideshow disabled), the default value is 1
                $AutoPlayInterval: 2000,                            //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
                $PauseOnHover: 1,                                   //[Optional] Whether to pause when mouse over if a slider is auto playing, 0 no pause, 1 pause for desktop, 2 pause for touch device, 3 pause for desktop and touch device, 4 freeze for desktop, 8 freeze for touch device, 12 freeze for desktop and touch device, default value is 1

                $ArrowKeyNavigation: true,   			            //[Optional] Allows keyboard (arrow key) navigation or not, default value is false
                $SlideEasing: $JssorEasing$.$EaseOutQuint,          //[Optional] Specifies easing for right to left animation, default value is $JssorEasing$.$EaseOutQuad
                $SlideDuration: 800,                                //[Optional] Specifies default duration (swipe) for slide in milliseconds, default value is 500
                $MinDragOffsetToSlide: 20,                          //[Optional] Minimum drag offset to trigger slide , default value is 20
                //$SlideWidth: 600,                                 //[Optional] Width of every slide in pixels, default value is width of 'slides' container
                //$SlideHeight: 300,                                //[Optional] Height of every slide in pixels, default value is height of 'slides' container
                $SlideSpacing: 0, 					                //[Optional] Space between each slide in pixels, default value is 0
                $DisplayPieces: 1,                                  //[Optional] Number of pieces to display (the slideshow would be disabled if the value is set to greater than 1), the default value is 1
                $ParkingPosition: 0,                                //[Optional] The offset position to park slide (this options applys only when slideshow disabled), default value is 0.
                $UISearchMode: 1,                                   //[Optional] The way (0 parellel, 1 recursive, default value is 1) to search UI components (slides container, loading screen, navigator container, arrow navigator container, thumbnail navigator container etc).
                $PlayOrientation: 1,                                //[Optional] Orientation to play slide (for auto play, navigation), 1 horizental, 2 vertical, 5 horizental reverse, 6 vertical reverse, default value is 1
                $DragOrientation: 1,                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)

                $ArrowNavigatorOptions: {                           //[Optional] Options to specify and enable arrow navigator or not
                    $Class: $JssorArrowNavigator$,                  //[Requried] Class to create arrow navigator instance
                    $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                    $AutoCenter: 2,                                 //[Optional] Auto center arrows in parent container, 0 No, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
                    $Steps: 1,                                      //[Optional] Steps to go for each navigation request, default value is 1
                    $Scale: false                                   //Scales bullets navigator or not while slider scale
                },

                $BulletNavigatorOptions: {                                //[Optional] Options to specify and enable navigator or not
                    $Class: $JssorBulletNavigator$,                       //[Required] Class to create navigator instance
                    $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                    $AutoCenter: 1,                                 //[Optional] Auto center navigator in parent container, 0 None, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
                    $Steps: 1,                                      //[Optional] Steps to go for each navigation request, default value is 1
                    $Lanes: 1,                                      //[Optional] Specify lanes to arrange items, default value is 1
                    $SpacingX: 12,                                   //[Optional] Horizontal space between each item in pixel, default value is 0
                    $SpacingY: 4,                                   //[Optional] Vertical space between each item in pixel, default value is 0
                    $Orientation: 1,                                //[Optional] The orientation of the navigator, 1 horizontal, 2 vertical, default value is 1
                    $Scale: false                                   //Scales bullets navigator or not while slider scale
                }
			};
				
			$("#slider1_container").css("display", "block");
			var jssor_slider1 = new $JssorSlider$("slider1_container", options);
			
			//responsive code begin
            //you can remove responsive code if you don't want the slider scales while window resizes
            function ScaleSlider() {
                var parentWidth = jssor_slider1.$Elmt.parentNode.clientWidth;
                if (parentWidth) {
                    jssor_slider1.$ScaleWidth(parentWidth - 30);
                }
                else
                    window.setTimeout(ScaleSlider, 30);
            }
            ScaleSlider();

            $(window).bind("load", ScaleSlider);
            $(window).bind("resize", ScaleSlider);
            $(window).bind("orientationchange", ScaleSlider);
            //responsive code end
		});
	</script>
	
	<div class="row" style="margin-bottom:20px;">
		<!-- Jssor Slider Begin -->
		<div id="slider1_container" style="display: none; position: relative; margin: 0 auto; width: 980px; height: 300px; overflow: hidden;">
			<div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 1140px; height: 300px;overflow: hidden;">
				<div>
					<img u="image" src2="images/slide/photo_slid_coupe.png">
					<div><h4>Services aéroport</h4><a href="services.php"><span>En savoir plus</span></a></div>
				</div>
				<div>
					<img u="image" src2="images/slide/photo_slid_coup_a.png">
					<div><h4>Services aéroport</h4><a href="services.php"><span>En savoir plus</span></a></div>
				</div>
				<div>
					<img u="image" src2="images/navette.png">
					<div><h4>Services aéroport</h4><a href="services.php"><span>En savoir plus</span></a></div>
				</div>
			</div>
			<!--#region Bullet Navigator Skin Begin -->
            <!-- Help: http://www.jssor.com/development/slider-with-bullet-navigator-jquery.html -->
            <style>
                
                
                .jssorb05 {
                    position: absolute;
                }
                .jssorb05 div, .jssorb05 div:hover, .jssorb05 .av {
                    position: absolute;
                    
                    width: 16px;
                    height: 16px;
                    background: url(css/images/b21.png) no-repeat;
                    overflow: hidden;
                    cursor: pointer;
                }
                .jssorb05 div { background-position: -7px -7px; }
                .jssorb05 div:hover, .jssorb05 .av:hover { background-position: -37px -7px; }
                .jssorb05 .av { background-position: -67px -7px; }
                .jssorb05 .dn, .jssorb05 .dn:hover { background-position: -97px -7px; }
            </style>
			<div u="navigator" class="jssorb05" style="bottom: 16px; right: 6px;">
                <!-- bullet navigator item prototype -->
                <div u="prototype"></div>
            </div>
			<!--#region Arrow Navigator Skin Begin -->
            <!-- Help: http://www.jssor.com/development/slider-with-arrow-navigator-jquery.html -->
            <style>
                
                
                .jssora11l, .jssora11r {
                    display: block;
                    position: absolute;
                    
                    width: 37px;
                    height: 37px;
                    cursor: pointer;
                    background: url(css/images/a11.png) no-repeat;
                    overflow: hidden;
                }
                .jssora11l { background-position: -11px -41px; }
                .jssora11r { background-position: -71px -41px; }
                .jssora11l:hover { background-position: -131px -41px; }
                .jssora11r:hover { background-position: -191px -41px; }
                .jssora11l.jssora11ldn { background-position: -251px -41px; }
                .jssora11r.jssora11rdn { background-position: -311px -41px; }
            </style>
			<!-- Arrow Left -->
            <span u="arrowleft" class="jssora11l" style="top: 123px; left: 20px;">
            </span>
            <!-- Arrow Right -->
            <span u="arrowright" class="jssora11r" style="top: 123px; right: 20px;">
            </span>
		</div>
		<!-- Jssor Slider End -->
	</div>
	
	<!-- CONTENU Centre -->
	<div class="col-xs-12 col-sm-6 col-md-6">
		<h4><?php echo $tpl->vars['TITLE_RESERVATION']; ?></h4>
		<div class="col-xs-12 col-sm-12 col-md-12 reservation">
                <?php if ($tpl->vars['CLASS_ERREUR'] != '') : ?>

                    <br />

                    <div class="<?php echo $tpl->vars['CLASS_ERREUR']; ?>">
                        <strong><?php echo $tpl->vars['ERREUR']; ?></strong>
                    </div>

                    <br />

                <?php endif; ?>

				<form method="post" action="reservation/choix-navette.php?action=verif" id="form_res">
					<div>

						<script type="text/javascript" src="scripts/infobulle.js"></script>
						
						<div class="type-trajet row">
							<span class="label_cote_3 col-xs-12 col-sm-12 col-md-4" style="padding:0;"><?php echo $tpl->vars['TRAJET_TYPE']; ?> <sup class="rouge">*</sup></span>
							<div class="col-xs-6 col-xs-6 col-md-4">
								<label for="trajet_aller_simple" style="font-weight:normal;"><?php echo $tpl->vars['TRAJET_ALLER_SIMPLE']; ?></label>
								<?php if ($tpl->vars['TRAJET'] == '1') : ?>
									<input type="radio" name="type_trajet" id="trajet_aller_simple" value="1" checked="checked" style="margin-left:5px;"/>
								<?php else : ?>
									<input type="radio" name="type_trajet" id="trajet_aller_simple" value="1" style="margin-left:5px;"/>
								<?php endif; ?>
							</div>
							<div class="col-xs-6 col-xs-6 col-md-4">
								<label for="trajet_aller_retour" style="font-weight:normal;"><?php echo $tpl->vars['TRAJET_ALLER_RETOUR']; ?></label>
								<?php if ($tpl->vars['TRAJET'] == '0') : ?>
									<input type="radio" name="type_trajet" id="trajet_aller_retour" value="0" checked="checked" style="margin-left:5px;"/>
								<?php else : ?>
									<input type="radio" name="type_trajet" id="trajet_aller_retour" value="0" style="margin-left:5px;"/>
								<?php endif; ?>
							</div>
						</div>
						
						<div class="row">
						
							<label for="lst_trajet_depart" class="label_cote_3 col-xs-12 col-sm-6 col-md-4"><?php echo $tpl->vars['TRAJET_DEPART']; ?> <sup class="rouge">*</sup></label>
							<select name="lst_trajet_depart" id="lst_trajet_depart" class="col-xs-9 col-sm-6 col-md-4">

								<?php foreach ($tpl->vars['LST_DEPART'] as $__tpl_foreach_key['LST_DEP'] => $__tpl_foreach_value['LST_DEP']) : ?>

									<?php if ($__tpl_foreach_value['LST_DEP']['id_lieu'] == $tpl->vars['DEP_CHERCHE']) : ?>

										<option value="<?php echo $__tpl_foreach_value['LST_DEP']['id_lieu']; ?>" selected="selected"><?php echo $__tpl_foreach_value['LST_DEP']['nom']; ?></option>

									<?php else : ?>

										<option value="<?php echo $__tpl_foreach_value['LST_DEP']['id_lieu']; ?>"><?php echo $__tpl_foreach_value['LST_DEP']['nom']; ?></option>

									<?php endif; ?>

								<?php endforeach; ?>

							</select>
						</div>
						
						<div class="row">
							<label for="lst_trajet_arrive" class="label_cote_3 col-xs-12 col-sm-6 col-md-4"><?php echo $tpl->vars['TRAJET_ARRIVE']; ?> <sup class="rouge">*</sup></label>
							<select name="lst_trajet_arrive" id="lst_trajet_arrive" class="col-xs-9 col-sm-6 col-md-4">

								<?php foreach ($tpl->vars['LST_DEPART'] as $__tpl_foreach_key['LST_DEP'] => $__tpl_foreach_value['LST_DEP']) : ?>

									<?php if ($__tpl_foreach_value['LST_DEP']['id_lieu'] == $tpl->vars['DEST_CHERCHE']) : ?>

										<option value="<?php echo $__tpl_foreach_value['LST_DEP']['id_lieu']; ?>" selected="selected"><?php echo $__tpl_foreach_value['LST_DEP']['nom']; ?></option>

									<?php else : ?>

										<option value="<?php echo $__tpl_foreach_value['LST_DEP']['id_lieu']; ?>"><?php echo $__tpl_foreach_value['LST_DEP']['nom']; ?></option>

									<?php endif; ?>

								<?php endforeach; ?>

							</select>
						</div>

						<div class="row">
							<label for="nb_passagers" class="label_cote_3 col-xs-12 col-sm-6 col-md-4" style="text-transform:none;"><?php echo $tpl->vars['NOMBRE_PASSAGER']; ?><sup class="rouge">*</sup></label>
							<select name="lst_passager_adulte_aller" id="lst_passager_adulte_aller" class="col-xs-9 col-sm-6 col-md-4">
								<?php foreach ($tpl->vars['LST_PERSONNE'] as $__tpl_foreach_key['LST_PERSONNE'] => $__tpl_foreach_value['LST_PERSONNE']) : ?>
									<?php if ($__tpl_foreach_value['LST_PERSONNE']['personne'] == $tpl->vars['NB_PERSONNE_CHERCHE_ALLER']) : ?>
										<option value="<?php echo $__tpl_foreach_value['LST_PERSONNE']['personne']; ?>" selected="selected"><?php echo $__tpl_foreach_value['LST_PERSONNE']['personne']; ?></option>
									<?php else : ?>
										<option value="<?php echo $__tpl_foreach_value['LST_PERSONNE']['personne']; ?>"><?php echo $__tpl_foreach_value['LST_PERSONNE']['personne']; ?></option>
									<?php endif; ?>
								<?php endforeach; ?>
							</select>
						</div>
						<!--<div class="blocFondVioletTotal" style="margin-bottom:20px;"><?php echo $tpl->vars['NOMBRE_PASSAGER']; ?></div>

						<table width="100%">
							<tr>
								<th class="header_tab" style="width:50%;padding:1px;color:#363636;background:#F4BE04;"><?php echo $tpl->vars['ALLER']; ?></th>
								<th class="header_tab" style="width:50%;padding:1px;color:#363636;background:#F4BE04;"><?php echo $tpl->vars['RETOUR']; ?></th>
							</tr>
							
							<tr>
								<th class="header_tab" style="display:none;">&nbsp;</th>
								<th class="header_tab" style="display:none;">&nbsp;</th>
							</tr>

							<tr>
								<td>

									<label for="lst_passager_adulte_aller"><?php echo $tpl->vars['PASSAGER_ADULTE']; ?> <span class="rouge">*</span> : </label>
									<select name="lst_passager_adulte_aller" id="lst_passager_adulte_aller">

										<?php foreach ($tpl->vars['LST_PERSONNE'] as $__tpl_foreach_key['LST_PERSONNE'] => $__tpl_foreach_value['LST_PERSONNE']) : ?>

											<?php if ($__tpl_foreach_value['LST_PERSONNE']['personne'] == $tpl->vars['NB_PERSONNE_CHERCHE_ALLER']) : ?>

												<option value="<?php echo $__tpl_foreach_value['LST_PERSONNE']['personne']; ?>" selected="selected"><?php echo $__tpl_foreach_value['LST_PERSONNE']['personne']; ?></option>

											<?php else : ?>

												<option value="<?php echo $__tpl_foreach_value['LST_PERSONNE']['personne']; ?>"><?php echo $__tpl_foreach_value['LST_PERSONNE']['personne']; ?></option>

											<?php endif; ?>

										<?php endforeach; ?>

									</select>

									<br />

									<label for="lst_passager_enfant_aller"><?php echo $tpl->vars['PASSAGER_ENFANT']; ?> <span class="rouge">*</span> : </label>
									<select name="lst_passager_enfant_aller" id="lst_passager_enfant_aller">

										<?php foreach ($tpl->vars['LST_ENFANT'] as $__tpl_foreach_key['LST_ENFANT'] => $__tpl_foreach_value['LST_ENFANT']) : ?>

											<?php if ($__tpl_foreach_value['LST_ENFANT']['personne'] == $tpl->vars['NB_ENFANT_CHERCHE_ALLER']) : ?>

												<option value="<?php echo $__tpl_foreach_value['LST_ENFANT']['personne']; ?>" selected="selected"><?php echo $__tpl_foreach_value['LST_ENFANT']['personne']; ?></option>

											<?php else : ?>

												<option value="<?php echo $__tpl_foreach_value['LST_ENFANT']['personne']; ?>"><?php echo $__tpl_foreach_value['LST_ENFANT']['personne']; ?></option>

											<?php endif; ?>

										<?php endforeach; ?>

									</select>
									
								</td>

								<td>
								
									<div id="passager_retour" style="">

										<label for="lst_passager_adulte_retour"><?php echo $tpl->vars['PASSAGER_ADULTE']; ?> <span class="rouge">*</span> : </label>
										<select name="lst_passager_adulte_retour" id="lst_passager_adulte_retour">

											<?php foreach ($tpl->vars['LST_PERSONNE'] as $__tpl_foreach_key['LST_PERSONNE'] => $__tpl_foreach_value['LST_PERSONNE']) : ?>

												<?php if ($__tpl_foreach_value['LST_PERSONNE']['personne'] == $tpl->vars['NB_PERSONNE_CHERCHE_RETOUR']) : ?>

													<option value="<?php echo $__tpl_foreach_value['LST_PERSONNE']['personne']; ?>" selected="selected"><?php echo $__tpl_foreach_value['LST_PERSONNE']['personne']; ?></option>

												<?php else : ?>

													<option value="<?php echo $__tpl_foreach_value['LST_PERSONNE']['personne']; ?>"><?php echo $__tpl_foreach_value['LST_PERSONNE']['personne']; ?></option>

												<?php endif; ?>

											<?php endforeach; ?>

										</select>

										<br />

										<label for="lst_passager_enfant_retour" ><?php echo $tpl->vars['PASSAGER_ENFANT']; ?> <span class="rouge">*</span> : </label>
										<select name="lst_passager_enfant_retour" id="lst_passager_enfant_retour">

											<?php foreach ($tpl->vars['LST_ENFANT'] as $__tpl_foreach_key['LST_ENFANT'] => $__tpl_foreach_value['LST_ENFANT']) : ?>

												<?php if ($__tpl_foreach_value['LST_ENFANT']['personne'] == $tpl->vars['NB_ENFANT_CHERCHE_RETOUR']) : ?>

													<option value="<?php echo $__tpl_foreach_value['LST_ENFANT']['personne']; ?>" selected="selected"><?php echo $__tpl_foreach_value['LST_ENFANT']['personne']; ?></option>

												<?php else : ?>

													<option value="<?php echo $__tpl_foreach_value['LST_ENFANT']['personne']; ?>"><?php echo $__tpl_foreach_value['LST_ENFANT']['personne']; ?></option>

												<?php endif; ?>

											<?php endforeach; ?>

										</select>

									</div>
									
								</td>
								
							</tr>
							
						</table>-->

						<div class="row" style="margin:15px 0 50px 0;">
							<div class="col-xs-12 col-sm-6 col-md-6 aller">
																
								<span class="label_cote_4" style="font-weight:bold;"><?php echo $tpl->vars['DATE_DEPART']; ?> <?php echo $tpl->vars['ALLER']; ?> <sup class="rouge">*</sup></span><br>
								<span id="lbl_jour_depart" style="background-color:#FFF" class="pointer" onclick="document.getElementById('ds_conclass2').style.display='none';ds_sh('lbl_jour_depart', 'ds_conclass1', 'ds_calclass1', '1');"> <?php echo $tpl->vars['SELECTIONNER_DATE_DEPART']; ?> </span>
							
								<span>
									<input type="hidden" name="jour_depart" id="jour_depart" value="<?php echo $tpl->vars['TXT_JOUR_DEPART']; ?>" />
									<input type="hidden" name="jour_depart_long" id="jour_depart_long" value="<?php echo $tpl->vars['TXT_JOUR_DEPART_LONG']; ?>" />

									<input type="button" onfocus="ds_sh('lbl_jour_depart', 'ds_conclass1', 'ds_calclass1', '1');" onclick="ds_sh('lbl_jour_depart', 'ds_conclass1', 'ds_calclass1', '1');" style="background-image:url(images/calendar.png); height:16px; width:16px;padding:0;margin:0;border:0;" class="pointer" />
								</span>
								
								<br />
								<br />

								<table class="ds_box" cellpadding="0" cellspacing="0" id="ds_conclass1" style="display:none;margin:auto;text-align:center;">
									<tr>
										<td id="ds_calclass1" valign="top"><br /></td>
									</tr>
								</table>
								
								<label for="lst_fixe_depart" class="label_cote_4" style="text-transform:none;"><?php echo $tpl->vars['FIXE_ALLER']; ?> <sup class="rouge">**</sup></label><br>
								<select id="lst_fixe_depart" name="lst_fixe_depart"><option>- - h - -</option></select>
								
								<img class="pointer" src="images/icones/info-16.png" alt="Aide" onclick='$("#popup_aideFixe").dialog("open");' />	
							<br />
							
							<div style="margin-top:10px;margin-bottom:10px;">
								<label for="lst_heure_depart" class="label_cote_4" style="text-transform:none;"><?php echo $tpl->vars['HEURE_DEPART']; ?> <sup class="rouge">**</sup></label><br>
								<select name="lst_heure_depart" id="lst_heure_depart">
									<?php foreach ($tpl->vars['LST_HEURE'] as $__tpl_foreach_key['LST_H'] => $__tpl_foreach_value['LST_H']) : ?>

										<?php if ($__tpl_foreach_value['LST_H']['code_heure'] == $tpl->vars['HEURE_DEPART_CHERCHE']) : ?>

											<option value="<?php echo $__tpl_foreach_value['LST_H']['code_heure']; ?>" selected="selected"><?php echo $__tpl_foreach_value['LST_H']['heure']; ?></option>

										<?php else : ?>

											<option value="<?php echo $__tpl_foreach_value['LST_H']['code_heure']; ?>"><?php echo $__tpl_foreach_value['LST_H']['heure']; ?></option>

										<?php endif; ?>

									<?php endforeach; ?>
								</select>

								<img class="pointer" src="images/icones/info-16.png" alt="Aide" onclick='$("#popup_aideDemande").dialog("open");'/>	
							</div>

							<label for="pt_rassemblement_aller" class="label_cote_4" style="text-transform:none;"><span id="label_pt_rassemblement_aller" ><?php echo $tpl->vars['PT_RASSEMBLEMENT']; ?> </span><sup class="rouge">*</sup></label><br>
							<div class="col-xs-12 col-sm-12 col-md-12" style="padding:0">
								<select name="pt_rassemblement_aller" onchange="modifier()" id="pt_rassemblement_aller" class="col-xs-9 col-sm-9 col-md-9" style="margin-bottom:5px;">
									<?php foreach ($tpl->vars['LST_PT_RASSEMBLEMENT'] as $__tpl_foreach_key['LST_PT'] => $__tpl_foreach_value['LST_PT']) : ?>

										<?php if ($__tpl_foreach_value['LST_PT']['id_pt'] == $tpl->vars['PT_RASSEMBLEMENT_ALLER_CHERCHE']) : ?>

											<option value="<?php echo $__tpl_foreach_value['LST_PT']['id_pt']; ?>" selected="selected"><?php echo $__tpl_foreach_value['LST_PT']['nom']; ?></option>

										<?php else : ?>

											<option value="<?php echo $__tpl_foreach_value['LST_PT']['id_pt']; ?>"><?php echo $__tpl_foreach_value['LST_PT']['nom']; ?></option>

										<?php endif; ?>

									<?php endforeach; ?>
								</select>
								<div class="col-xs-3 col-sm-3 col-md-3" style="padding-left:5px;">
									<img class="pointer" src="images/icones/info-16.png" alt="Aide" onclick='$("#popup_aideRassemblement").dialog("open");'/>
								</div>
							</div>
							
							<div id="rass_aller" style="display:none">
								
								<div class="row">
									<label for="rass_adresse_aller" class="col-xs-12 col-sm-12 col-md-12"><?php echo $tpl->vars['ADRESSE_CLIENT']; ?> <sup class="rouge">*</sup></label>
									<input type="text" id="rass_adresse_aller" name="rass_adresse_aller" value="<?php echo $tpl->vars['TXT_RASS_ADRESSE_ALLER']; ?>" maxlength="200" class="col-xs-9 col-sm-9 col-md-9" />
								</div>

								<div class="row">
									<label for="rass_cp_aller" class="col-xs-12 col-sm-12 col-md-12"><?php echo $tpl->vars['CODE_POST_CLIENT']; ?> <sup class="rouge">*</sup></label>
									<input type="text" id="rass_cp_aller" name="rass_cp_aller" value="<?php echo $tpl->vars['TXT_RASS_CP_RETOUR']; ?>" maxlength="5" class="col-xs-9 col-sm-9 col-md-9"/>
								</div>

								<div class="row">
									<label for="rass_ville_aller" class="col-xs-12 col-sm-12 col-md-12"><?php echo $tpl->vars['VILLE_CLIENT']; ?> <sup class="rouge">*</sup></label>
									<input type="text" id="rass_ville_aller" name="rass_ville_aller" value="<?php echo $tpl->vars['TXT_RASS_VILLE_ALLER']; ?>" maxlength="50" class="col-xs-9 col-sm-9 col-md-9"/>
								</div>

								<div class="row">
								<!-- !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->
									<label for="rass_pays_aller" class="col-xs-12 col-sm-12 col-md-3"><?php echo $tpl->vars['PAYS_CLIENT']; ?> <sup class="rouge">*</sup></label>
									<select id="rass_pays_aller" name="rass_pays_aller" class="col-xs-9 col-sm-9 col-md-6"/>
											<option value="1">France</option>
											<option value="2">Allemagne</option>				
									</select>
								</div>
								
							</div>
							
						</div>

						<div id="vol_retour" class="col-xs-12 col-sm-6 col-md-6" style="padding-right:0;">
							<div>
								<span class="label_cote_4" style="font-weight:bold;"><?php echo $tpl->vars['DATE_RETOUR']; ?> <?php echo $tpl->vars['RETOUR']; ?> <sup class="rouge">*</sup></span><br>
								<span id="lbl_jour_retour" style="background-color:#FFF" class="pointer" onclick="document.getElementById('ds_conclass1').style.display='none';ds_sh('lbl_jour_retour', 'ds_conclass2', 'ds_calclass3', '1');"> <?php echo $tpl->vars['SELECTIONNER_DATE_RETOUR']; ?> </span>
								
								<span>
									<input type="hidden" name="jour_retour" id="jour_retour" value="" />
									<input type="hidden" name="jour_retour_long" id="jour_retour_long" value="" />

									<input type="button" onfocus="ds_sh('lbl_jour_retour', 'ds_conclass2', 'ds_calclass3', '1');" onclick="ds_sh('lbl_jour_retour', 'ds_conclass2', 'ds_calclass3', '1');" style="background-image:url(images/calendar.png); height:16px; width:16px;padding:0;margin:0;border:0;" class="pointer" />
								</span>
								
								<br />
								<br />

								<table class="ds_box" cellpadding="0" cellspacing="0" id="ds_conclass2" style="display:none;margin:auto;text-align:center;">
									<tr>
										<td id="ds_calclass3" valign="top"><br /></td>
									</tr>
								</table>
								
								
								

								<div id="horaire_fixe_retour" style="margin-bottom:10px;">

									<label for="lst_fixe_retour" class="label_cote_4" style="text-transform:none;"><?php echo $tpl->vars['FIXE_RETOUR']; ?> <sup class="rouge">**</sup></label><br>
									<select id="lst_fixe_retour" name="lst_fixe_retour">
									</select> 
									
									<img class="pointer" src="images/icones/info-16.png" alt="Aide" onclick='$("#popup_aideFixe").dialog("open");' />	
								</div>

								<div style="margin-bottom:10px;">
									<label for="lst_heure_retour" class="label_cote_4" style="text-transform:none;"><?php echo $tpl->vars['HEURE_RETOUR']; ?> <sup class="rouge">**</sup></label><br>
									<select name="lst_heure_retour" id="lst_heure_retour">
										<?php foreach ($tpl->vars['LST_HEURE'] as $__tpl_foreach_key['LST_H'] => $__tpl_foreach_value['LST_H']) : ?>

											<?php if ($__tpl_foreach_value['LST_H']['code_heure'] == $tpl->vars['HEURE_RETOUR_CHERCHE']) : ?>

												<option value="<?php echo $__tpl_foreach_value['LST_H']['code_heure']; ?>" selected="selected"><?php echo $__tpl_foreach_value['LST_H']['heure']; ?></option>

											<?php else : ?>

												<option value="<?php echo $__tpl_foreach_value['LST_H']['code_heure']; ?>"><?php echo $__tpl_foreach_value['LST_H']['heure']; ?></option>

											<?php endif; ?>

										<?php endforeach; ?>
									</select>

									<img class="pointer" src="images/icones/info-16.png" alt="Aide" onclick='$("#popup_aideDemande").dialog("open");' />	
								</div>
								
								<label for="pt_rassemblement_retour" class="label_cote_4" style="text-transform:none;"><span id="label_pt_rassemblement_retour" ><?php echo $tpl->vars['PT_RASSEMBLEMENT']; ?> <sup class="rouge">*</sup></label><br>
								<div class="col-xs-12 col-sm-12 col-md-12" style="padding:0">
									<select name="pt_rassemblement_retour" onchange="modifier()" id="pt_rassemblement_retour" class="col-xs-9 col-sm-9 col-md-9" style="margin-bottom:5px;">
										<?php foreach ($tpl->vars['LST_PT_RASSEMBLEMENT'] as $__tpl_foreach_key['LST_PT'] => $__tpl_foreach_value['LST_PT']) : ?>

											<?php if ($__tpl_foreach_value['LST_PT']['id_pt'] == $tpl->vars['PT_RASSEMBLEMENT_RETOUR_CHERCHE']) : ?>

												<option value="<?php echo $__tpl_foreach_value['LST_PT']['id_pt']; ?>" selected="selected"><?php echo $__tpl_foreach_value['LST_PT']['nom']; ?></option>

											<?php else : ?>

												<option value="<?php echo $__tpl_foreach_value['LST_PT']['id_pt']; ?>"><?php echo $__tpl_foreach_value['LST_PT']['nom']; ?></option>

											<?php endif; ?>

										<?php endforeach; ?>
									</select>
									<div class="col-xs-3 col-sm-3 col-md-3" style="padding-left:5px;">
										<img class="pointer" src="images/icones/info-16.png" alt="Aide" onclick='$("#popup_aideRassemblement").dialog("open");' /> 
									</div>
								</div>

									<div id="rass_retour" style="display:none">
										
										<div class="row">
											<label for="rass_adresse_retour" class="col-xs-12 col-sm-12 col-md-12"><?php echo $tpl->vars['ADRESSE_CLIENT']; ?> <sup class="rouge">*</sup></label>
											<input type="text" id="rass_adresse_retour" name="rass_adresse_retour" value="<?php echo $tpl->vars['TXT_RASS_ADRESSE_RETOUR']; ?>" maxlength="200" class="col-xs-9 col-sm-9 col-md-9"/>
										</div>

										<div class="row">
											<label for="rass_cp_retour" class="col-xs-12 col-sm-12 col-md-12"><?php echo $tpl->vars['CODE_POST_CLIENT']; ?> <sup class="rouge">*</sup></label>
											<input type="text" id="rass_cp_retour" name="rass_cp_retour" value="<?php echo $tpl->vars['TXT_RASS_CP_RETOUR']; ?>" maxlength="5" class="col-xs-9 col-sm-9 col-md-9"/>
										</div>

										<div class="row">
											<label for="rass_ville_retour" class="col-xs-12 col-sm-12 col-md-12"><?php echo $tpl->vars['VILLE_CLIENT']; ?> <sup class="rouge">*</sup></label>
											<input type="text" id="rass_ville_retour" name="rass_ville_retour" value="<?php echo $tpl->vars['TXT_RASS_VILLE_RETOUR']; ?>" maxlength="50" class="col-xs-9 col-sm-9 col-md-9"/>
										</div>
										
										<div class="row">
										<!-- !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->
											<label for="rass_ville_retour" class="col-xs-12 col-sm-12 col-md-3"><?php echo $tpl->vars['PAYS_CLIENT']; ?> <sup class="rouge">*</sup></label>
											<select id="rass_pays_retour" name="rass_pays_retour" class="col-xs-9 col-sm-9 col-md-6"/>
												<option value="1">France</option>
												<option value="2">Allemagne</option>
											</select>
										</div>
										
									</div>
								</div>
							</div>
							
						<br />

						<br />
					</div>
						
					<label for="email" class="label_cote_4"><?php echo $tpl->vars['EMAIL']; ?><sup class="rouge">*</sup></label>
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-6" style="padding:0;">
							<input type="email" id="email" name="email" value="<?php echo $tpl->vars['TXT_EMAIL']; ?>" maxlength="50" class="col-xs-11 col-sm-11 col-md-11" style="padding:0 5px;height:30px;"/>
						</div>
						<div style="text-align:center;" class="col-xs-12 col-sm-12 col-md-6">
							<div id="btn_envoie"><input type="button" value="<?php echo $tpl->vars['BTN_AFFICHER_TARIFS']; ?>" style="border:none;background:transparent;color:white;text-transform:uppercase;"/><span style="padding-right:5px;">&#10148;</span></div>
						</div>
					</div>

				</form>	
				
				<!-- Div de fin de v2 -->		
	
			</div>
			
			<span style="display:inline-block;font-size:0.8em;margin-top:10px;"><sup class="rouge">*</sup> : <?php echo $tpl->vars['OBLIGATOIRE']; ?><br />
			<sup class="rouge">**</sup> : <?php echo $tpl->vars['OBLIGATOIRE_2']; ?></span>
			
		</div>
		<div class="col-xs-12 col-sm-6 col-md-6" style="text-align:center;margin-top:10px;">
			<img src="images/tampons/tampon1.png" class="tampon">
		</div>
		<div class="col-xs-12 col-sm-6 col-md-6" style="text-align:center;margin-top:10px;">
			<img src="images/tampons/tampon2.png" class="tampon">
		</div>
	</div>
	<div class="col-xs-12 col-sm-6 col-md-6">
		
<?php include ("block_droite.html.php");?>


		<div class="col-xs-12 col-sm-6 col-md-6" style="text-align:center;margin-top:10px;">
			<img src="images/tampons/tampon3.png" class="tampon">
		</div>
		<div class="col-xs-12 col-sm-6 col-md-6" style="text-align:center;margin-top:10px;">
			<img src="images/tampons/tampon4.png" class="tampon">
		</div>
	</div>

	<!--<script type="text/javascript" src="scripts/ajax.js"></script>	!-->
	<script type="text/javascript" src="<?php echo $tpl->vars['BASEURL']; ?>scripts/accueil_mini2.js"></script>
<!--	<script type="text/javascript" src="scripts/accueil.js"></script> !-->
	<script src="<?php echo $tpl->vars['BASEURL']; ?>scripts/swfobject_modified.js" type="text/javascript"></script>
<!--	<style type="text/css" src="scripts/ajax.js"></style> !-->
	<script type="text/javascript" src="<?php echo $tpl->vars['BASEURL']; ?>scripts/ajax.js"></script>
	
	<div id="popup_aideFixe" title="<?php echo $tpl->vars['ALT_AIDE']; ?>" style="display:none;">
		<img class="pointer" src="images/icones/info-16.png" />
		<?php echo $tpl->vars['HOVER_AIDE_FIXE']; ?>
	</div>
	<div id="popup_aideDemande" title="<?php echo $tpl->vars['ALT_AIDE']; ?>" style="display:none;">
		<img class="pointer" src="images/icones/info-16.png" /> 
		<?php echo $tpl->vars['HOVER_AIDE']; ?>
	</div>
	<div id="popup_aideRassemblement" title="<?php echo $tpl->vars['ALT_AIDE']; ?>" style="display:none;">
		<img class="pointer" src="images/icones/info-16.png" /> 
		<?php echo $tpl->vars['AIDE_PT_RASSEMBLEMENT']; ?>
	</div>	
	
		<script type="text/javascript">
			$(function() {		
				$( "#popup_aideFixe" ).dialog({
					modal: true,
					autoOpen: false,
					width: 500,
					resizable: false,
					draggable: false,
					buttons: {
						Ok: function() {
							$( this ).dialog( "close" );
						}
					}
				});
				$( "#popup_aideDemande" ).dialog({
					modal: true,
					autoOpen: false,
					width: 500,
					resizable: false,
					draggable: false,
					buttons: {
						Ok: function() {
							$( this ).dialog( "close" );
						}
					}
				});
				$( "#popup_aideRassemblement" ).dialog({
					modal: true,
					autoOpen: false,
					width: 500,
					resizable: false,
					draggable: false,
					buttons: {
						Ok: function() {
							$( this ).dialog( "close" );
						}
					}
				});
			});
	</script> 

</div>

<?php $tpl->includeTpl('footer.html', false, 0); ?>

