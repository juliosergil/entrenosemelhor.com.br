 <?php
	
	if(file_exists(WWW_MOD."/googletranslate.inc")) {?>

	<script type="text/javascript"> 
	// includedLanguages: 'de,es,fr,en,it',
	// layout: google.translate.TranslateElement.InlineLayout.SIMPLE

	function googleTranslateElementInit() {
	  new google.translate.TranslateElement({autoDisplay: true, pageLanguage: 'pt', includedLanguages: 'en,pt', layout: google.translate.TranslateElement.InlineLayout.HORIZONTAL}, 'google_translate_element');
	}
	</script>

	<script type="text/javascript"  src="https://translate.google.com/translate_a/element.js?
	cb=googleTranslateElementInit"></script>
 
<? } ?>