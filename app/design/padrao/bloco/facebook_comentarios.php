<div style="display:none;" class="tips"><?=__FILE__?></div>

 

<? if(file_exists(WWW_MOD."/facebook_comentarios.inc")) {?>

	<div id="fb-root"></div>
	<?
	$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	?>
	<script async defer crossorigin="anonymous" src="https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v21.0"></script>
 
	<div class="fb-comments" data-href="<?=$actual_link?>" data-width="" data-numposts="5"></div>

<? } ?>