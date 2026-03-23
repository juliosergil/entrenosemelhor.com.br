<?
if(file_exists(WWW_MOD."/comentariosfacebook.inc")) {
	
	$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	?>
	<script async defer crossorigin="anonymous" src="https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v16.0" nonce="APIzzGpL"></script>
	<div class="fb-comments" data-href="<?=$actual_link?>" data-width="100%" data-numposts="10"></div>


<? } ?>