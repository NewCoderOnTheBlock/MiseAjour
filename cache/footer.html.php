<!--
fichier:footer.html.php
updated 27/06/2019
-->

<footer class="row">
	<div class="row" style="margin:0;">
		<div class="col-xs-12 col-sm-6 col-md-6">
			<div class="col-xs-12 col-sm-12 col-md-5" style="padding:0;">
				<a href="services.php"><img src="/images/Qui_sommes.png" class="picto_footer"><?php echo $tpl->vars['LIEN_QUI_SOMMES_NOUS']; ?></a>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-4" style="padding:0;">
				<a href="<?php echo $tpl->vars['PORTAIL']; ?>"><img src="images/nos-services.png" class="picto_footer"><?php echo $tpl->vars['LIEN_SERVICES']; ?></a>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-3" style="padding:0;">
				<a href="contact.php"><img src="../navette/test/aeroport/images/contact.png" class="picto_footer"><?php echo $tpl->vars['LIEN_CONTACT']; ?></a>
			</div>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-6">
			<div class="col-xs-12 col-sm-12 col-md-3" style="padding:0;">
				<a href="<?php echo $tpl->vars['MENTIONS']['LIEN']; ?>"><img src="../navette/test/aeroport/images/<?php echo $tpl->vars['MENTIONS']['IMG']; ?>" class="picto"><?php echo $tpl->vars['MENTIONS']['TEXT']; ?></a>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-4" style="padding:0;">
				<a href="<?php echo $tpl->vars['CGV']['LIEN']; ?>"><img src="../navette/test/aeroport/images/<?php echo $tpl->vars['CGV']['IMG']; ?>" class="picto"><?php echo $tpl->vars['CGV']['TEXT']; ?></a>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-3" style="padding:0;">
				<a href="<?php echo $tpl->vars['CHARTE']['LIEN']; ?>"><img src="../navette/test/aeroport/images/<?php echo $tpl->vars['CHARTE']['IMG']; ?>" class="picto"><?php echo $tpl->vars['CHARTE']['TEXT']; ?></a>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-2" style="padding:0;">
				<a href="<?php echo $tpl->vars['PLAN']['LIEN']; ?>"><img src="../navette/test/aeroport/images/<?php echo $tpl->vars['PLAN']['IMG']; ?>" class="picto"><?php echo $tpl->vars['PLAN']['TEXT']; ?></a>
			</div>
		</div>
	</div>
	<div class="row" style="margin:0;margin-top:20px;">
		<div class="col-xs-12 col-sm-6 col-md-6">
			<a href="<?php echo $tpl->vars['PORTAIL']; ?>"><img src="images/logo-alsace-navette.png" style="width:80px;"><span style="margin-left:10px;"><?php echo $tpl->vars['ALT_BANDEAU']; ?></span></a>
		</div>
		<div class="col-xs-7 col-sm-3 col-md-2 col-md-offset-3" style="padding-right:0;text-align:right;">
			<p style="font-size:0.8em;"><?php echo $tpl->vars['TEXTE_LICENCE']; ?></p>
		</div>
		<div class="col-xs-5 col-sm-2 col-md-1">
			<img src="../navette/test/aeroport/images/logo-republiqueFrancaise.png">
		</div>
	</div>
</footer>

</div>

<!--[if IE]>
	<style type="text/css">
		body {
			background-color: #FFFFFF;
			background-image:url(images/background-repeat.jpg);
			background-position:left bottom;
			background-attachment:fixed;
			background-repeat:repeat-x;

			font-family: 'Trebuchet MS', Arial, sans-serif;
			font-size: 0.8em;
			margin-left: auto;
			margin-right: auto;
			width:1010px;
			margin-top: 0;
		}
	
        #contenu {
        	overflow: visible;
            padding-top:10px;
            margin-left: 55px;
            margin-right: 55px;
            padding-left: 60px;
            padding-right:65px;
            margin-bottom: 0;
            padding-bottom: 0;
            background: url(images/ariane.png) repeat-x scroll 0 0;
            background-color: #DFDFDF;
            border-bottom: 1px solid #DFDFDF;
        }
        
        #header {
            background: url(images/fond_header_ie.png) repeat-x scroll 0 0;
            margin-left:55px;
            margin-right:55px;
        }
		
		#entete{
			margin-left:150px;
			margin-bottom:5px;
			margin-left:auto;
			margin:right:auto;
		}
		
		#banniere{
			width:836px;height:120px;margin-left:-15px;
		}
		#entete{
			margin-bottom:50px;
		}
		#billetAvion{
			float: left;position:relative;z-index:2;
		}
        
        #div_gauche, #div_droite {
        	background-color: #DFDFDF;
        }
        
        #footer {
        	text-align: center;
            clear:both;
            height:45px;
       	}
        
        
    </style>
<![endif]-->



<?php if ($tpl->vars['MODE'] == 'online') : ?>

<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-12711980-1");
pageTracker._trackPageview();
} catch(err) {}</script>
	
<?php endif; ?>
