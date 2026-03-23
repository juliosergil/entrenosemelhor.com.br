<div style="display:none;" class="tips"><?=__FILE__?></div>


<? if(file_exists(WWW_MOD."/facebook_share.inc")) {?>

	<div id="fb-root"></div>
	<?
	$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	?>
	<script async defer crossorigin="anonymous" src="https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v21.0"></script>

	<div class="fb-share-button" data-href="<?=$actual_link?>" data-layout="" data-size=""><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Compartilhar</a></div>

<? } ?>
 