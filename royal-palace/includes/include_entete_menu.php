
<!-- 
	Site crée par KEMPF Pierre-Louis
	01-2012
 -->

<!-- Le header -->
<div id="entete" align="center">
	<img id="full-screen-background-image" src="images/header.jpg"></img>
	<div id="wrapper"></div>
</div>

<!-- Drapeaux de langue -->
<div id="id_flag" align="right">
	<a href="index.php?lang=fr"><img src="images/flag_fr.png" width="20" height="15"/></a>
	<a href="index.php?lang=en"><img src="images/flag_en.png" width="20" height="15"/></a>
	<span id="google_translate_element"></span>
	&nbsp;
</div>

<!-- La barre de navigation -->
<div id="navigation">
	<table>
		<tr>
			<td><a href="index.php"><?php echo $lang_titre_accueil; ?></a></td>
			<td><a href="informations.php"><?php echo $lang_titre_informations; ?></a></td>
			<td><a href="tarifs.php"><?php echo $lang_titre_tarifs; ?></a></td>
			<td><a href="contact.php"><?php echo $lang_titre_contact; ?></a></td>
		</tr>
	</table>
</div>

<script>
	function googleTranslateElementInit() {
		new google.translate.TranslateElement({
			pageLanguage: '{LANGUE}',
			includedLanguages: 'de,es,it,ru,tr',
			layout: google.translate.TranslateElement.InlineLayout.SIMPLE
		},'google_translate_element');
	}
</script>
<script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>