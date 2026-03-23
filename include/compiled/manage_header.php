<?php 

include template("manage_html_header");

?>

<script type="text/javascript" src="/media/js/jquery-1.4.2.min.js"></script> 
 
<link rel="stylesheet" type="text/css" href="<?=$ROOTPATH?>/js/colorbox/colorbox.css"/> 
<script type="text/javascript" src="<?=$ROOTPATH?>/js/colorbox/jquery.colorbox-min.js"></script> 
<link rel="stylesheet" type="text/css" href="<?=$ROOTPATH?>/js/color/farbtastic.css"/> 
<script type="text/javascript" src="<?=$ROOTPATH?>/js/farbtastic.js"></script>
<script type="text/javascript" src="<?=$ROOTPATH?>/js/jbase.js"></script>
<link rel="stylesheet" href="/media/calendar/dhtmlgoodies/dhtmlgoodies_calendar.css" type="text/css" media="screen" charset="utf-8" /> 
<script src="/media/calendar/dhtmlgoodies/dhtmlgoodies_calendar.js" type="text/javascript"></script> 
<link rel="stylesheet" type="text/css" href="/media/tip/theme/style.css" />
<link rel="stylesheet" type="text/css" href="/media/css/menu.css" />
<script src="/media/tip/js/jquery.betterTooltip.js" type="text/javascript"></script> 
<script type="text/javascript" src="/js/mascara.js"></script> 
<script type="text/javascript" src="/media/js/main.js"></script> 
<script type="text/javascript" src="/media/js/jquery.price_format.1.7.min.js"></script>
 
  
 <!-- EDITOR: INCLUSAO DAS LIBS -->
	<script src="/media/ckeditor/ckeditor.js"></script>
<!-- EDITOR FIM -->

<script type="text/javascript">

	$(document).ready(function(){
		$('.tTip').betterTooltip({speed: 100, delay: 30});
	});

</script> 

<!-- EDITOR: INCLUSAO DAS LIBS -->
	<script src="/media/ckeditor/ckeditor.js"></script>
<!-- EDITOR FIM -->
  

<?php require "manage_header_logo.php"; ?>


<?php if($session_notice=Session::Get('notice',true)){?>
	<script>
		jQuery(document).ready(function(){   
			jQuery.colorbox({html:"<div class='msgsoft'> <img src='<?=$ROOTPATH?>/media/css/i/Accept-icon.png'> <?php echo $session_notice; ?></div>"});
		});
	</script>
<?php }?>
<?php if($session_notice=Session::Get('error',true)){?>
	<script>
		jQuery(document).ready(function(){   
			jQuery.colorbox({html:"<div class='msgsoft'> <img src='<?=$ROOTPATH?>/media/css/i/falha.png'> <?php echo $session_notice; ?></div>"});
		});
	</script>
<?php }?>
<?php
	
?>
 