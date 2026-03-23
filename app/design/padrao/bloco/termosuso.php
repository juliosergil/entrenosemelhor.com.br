<link href="https://www.scriptacompanhante.com.br/venus/skin/padrao/css/alert.css" rel="stylesheet" /> 
<link href="https://www.scriptacompanhante.com.br/venus/skin/padrao/css/theme.css" rel="stylesheet" /> 
<script src="https://www.scriptacompanhante.com.br/venus/js/jquery-1.11.1.min.js"></script> 
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/jquery-ui.min.js"></script>

<script type="text/javascript">
		 //<![CDATA[
			$(window).load(function() { // makes sure the whole site is loaded
				$('#status').fadeOut(); // will first fade out the loading animation
				$('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
				$('body').delay(350).css({'overflow':'visible'});
			})
		 //]]>
		</script> 
		
<script src="https://www.scriptacompanhante.com.br/venus/js/alert.js"></script>
<script type="text/javascript" src="https://www.scriptacompanhante.com.br/venus/js/jquery.cookie.js"></script>
		
<script type="text/javascript">
	$(document).ready(function() {
		var alert = $.cookie("white-room");
		if(!alert) {
			 setTimeout( function() {
				 $.alert.open({
					 title: "Aviso de conteúdo adulto",
					 maxHeight: 140,
					 width: 450,
					 buttons: {
						 accept : 'Entrar',
						 leave  : 'Sair'
					 },
					 content: "Ao aceitar essas condições, você verifica se você tem idade legal para ver esses materiais. Se você está sob a idade legal ou está ofendido por esse material, saia do site agora. Todo o conteúdo e imagens neste site estão sujeitos a direitos autorais e não podem ser reproduzidos de qualquer forma sem a permissão expressa do proprietário.<br/><br/>",
					 cancel: false,
					 draggable: false,
					 callback: function(button) {
						 if (button == 'accept') {
							 $.cookie("white-room", true, { expires : 1, path : "/" }); // 1 - day (24hrs)
						 } else {
							 window.location = "http://www.google.com"; //redirect url
						}

											}
				});
			}, 1000); // you can set the timeout in ms for aler box appearing - 1000 = 1s
		}
	});		 
</script>

<?php  

// incluir este include na principal.php
//require_once(DIR_BLOCO."/termosuso.php"); 

?>

