<div style="display:none;" class="tips"><?=__FILE__?></div> 

<?
 //session_start();
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

 $URL = $ROOTPATH;
?>
 <!--FACEBOOK-->
 <? if($team){?>
	 <meta property="og:image" content="<?=$INI['system']['wwwprefix']."/media/".$team['image']?>">
 <? }else{?>
	 <meta property="og:image" content="<?=$ROOTPATH?>/include/logo/logo.png">
 <? } ?>

<meta property="og:image:type" content="image/png"> 

<!-- TWITER -->
 
<?php echo utf8_decode($INI['system']['metatags']); ?>
<? include("codigos_head.php"); ?>

 