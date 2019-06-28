<?php $tpl->includeTpl('header.html', false, 0); ?>

<!--
fichier:aeroport.include.html.php
updated 26/06/2019
-->
<div id="body">

	<input type="hidden" id="page_lang" value="<?php echo $tpl->vars['LANG']; ?>" />
    <script type="text/javascript" src="<?php echo $tpl->vars['BASEURL']; ?>scripts/lang.js"></script>


	<?php $tpl->includeTpl('aeroport/menu/speedbar.html', false, 0); ?>
	
	<div id="global">
