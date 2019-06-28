<!-- Jssor Slider Begin -->
<div id="slider1_container" style="display: none; position: relative;margin:auto;width:1060px; height:215px; overflow: hidden;border-bottom:3px solid grey;">
	<div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width:1060px; height:215px;overflow: hidden;">
		<?php if (time() < mktime(0,0,0,7,14,2015))
		{?>
			<div>
				<a href="services.php"><img u="image" src2="images/banniere_14.png"></a>
			</div><?php
		}?>
		<div>
			<img u="image" src2="images/banniere_sac.png">
		</div>
		<div>
			<img u="image" src2="images/banniere_metz.png">
		</div>
	</div>
	<!--#region Bullet Navigator Skin Begin -->
	<!-- Help: http://www.jssor.com/development/slider-with-bullet-navigator-jquery.html -->
	<style>
		/* jssor slider bullet navigator skin 05 css */
		/*
		.jssorb05 div           (normal)
		.jssorb05 div:hover     (normal mouseover)
		.jssorb05 .av           (active)
		.jssorb05 .av:hover     (active mouseover)
		.jssorb05 .dn           (mousedown)
		*/
		.jssorb05 {
			position: absolute;
		}
		.jssorb05 div, .jssorb05 div:hover, .jssorb05 .av {
			position: absolute;
			/* size of bullet elment */
			width: 16px;
			height: 16px;
			background: url(images/b21.png) no-repeat;
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
		/* jssor slider arrow navigator skin 11 css */
		/*
		.jssora11l                  (normal)
		.jssora11r                  (normal)
		.jssora11l:hover            (normal mouseover)
		.jssora11r:hover            (normal mouseover)
		.jssora11l.jssora11ldn      (mousedown)
		.jssora11r.jssora11rdn      (mousedown)
		*/
		.jssora11l, .jssora11r {
			display: block;
			position: absolute;
			/* size of arrow element */
			width: 37px;
			height: 37px;
			cursor: pointer;
			background: url(images/a11.png) no-repeat;
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