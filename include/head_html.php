<head>
<link rel="icon"  type="image/x-icon" href="/skin/padrao/images/favicon.ico">
 <? include_once("head_tags.php");?> 

 <?php if($BlocosOfertas->tituloferta){?>
<title><?php echo  $BlocosOfertas->tituloferta ; ?> | <?php echo utf8_decode( $INI['system']['sitename']); ?>  </title>
<?php }
 else if($team['seo_title']){?>
<title><?php echo utf8_decode(  $team['seo_title'] )?> </title>
<?}
 else { ?>
<title><?php echo utf8_decode( $INI['system']['sitename']); ?>    </title>
<?php }?> 
<?php if(strip_tags($team['seo_description'])) { ?>
<meta name="description" content="<?php echo mb_strimwidth(strip_tags(utf8_decode(strip_tags($team['seo_description'])) ), 0, 320); ?>" />
<?php } else if(strip_tags($INI['system']['seodescricao'])) { ?>
<meta name="description" content="<?php echo utf8_decode( strip_tags($INI['system']['seodescricao'])); ?> " />
<?php }  else { ?>
<meta name="description" content="<?php echo utf8_decode( $INI['system']['sitename']); ?>, <?php echo utf8_decode($INI['system']['sitetitle']); ?>   " />
<?php }?> 
<?php if($team['seo_keyword']){?>
<meta name="keywords" content="<?php echo utf8_decode($team['seo_keyword']); ?>" />
<?php } 
	else if($INI['system']['seochaves']){?>
<meta name="keywords" content="<?php echo utf8_decode($INI['system']['seochaves']); ?>, <?php echo utf8_decode($city['name']); ?>" />
<?php } 
	else { ?>
<meta name="keywords" content="<?php echo utf8_decode($INI['system']['sitename']); ?>,  <?php echo utf8_decode($city['name']); ?>" />
<?php } ?>
<link href="<?php echo $ROOTPATH; ?>/feed.php?ename=<?php echo utf8_decode($city['ename']); ?>" rel="alternate" title="subscription update" type="application/rss+xml" />
 
<script type="text/javascript">
	var WEB_ROOT 	= "<?php echo WEB_ROOT; ?>";
	var URLWEB	 	= "<?php echo $ROOTPATH?>";
	var CITY_ID	 	= "<?php echo $city['id']?>";
	var ID_PARCEIRO = "<?php echo $_REQUEST['idparceiro']?>";
</script>
<script type="text/javascript">var LOGINUID= <?php echo abs(intval($login_user_id)); ?>;</script>
<?php echo Session::Get('script',true); ?>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/css?family=Nunito+Sans&display=swap" rel="stylesheet">
<!-- Go to www.addthis.com/dashboard to customize your tools --> 
<script type="text/javascript" src="https://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5dd813692e72e955"></script>
 
<script src="https://kit.fontawesome.com/9e51fb4733.js" crossorigin="anonymous"></script> 
<link rel="stylesheet" href="<?=$PATHSKIN?>/css/layout-site.css" type="text/css" media="all"> 
<link rel="stylesheet" href="<?=$PATHSKIN?>/css/site.css" type="text/css" media="all">
<link rel="stylesheet" href="<?=$PATHSKIN?>/css/css-site.css" type="text/css" media="all">
<link rel="stylesheet" href="<?=$PATHSKIN?>/css/classic.css" type="text/css" media="all">
 <link rel="stylesheet" href="<?=$PATHSKIN?>/css/css2.css" type="text/css" media="all">  
<link rel="stylesheet" href="<?=$PATHSKIN?>/css/slide.css" type="text/css" media="all"> 
<link rel="stylesheet" href="<?=$PATHSKIN?>/css/menu.css" type="text/css" media="all"> 
<link rel="stylesheet" href="<?=$PATHSKIN?>/css/rodap.css" type="text/css" media="all"> 
<link rel="stylesheet" href="<?=$PATHSKIN?>/css/blog.css" type="text/css" media="all"> 
<link rel="stylesheet" href="<?=$PATHSKIN?>/css/global-site.css" type="text/css" media="all"> 
<link rel="stylesheet" href="<?=$PATHSKIN?>/css/buttons.css" type="text/css" media="all"> 
<link rel="stylesheet" href="<?=$PATHSKIN?>/css/bootstrap431.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="<?=$ROOTPATH?>/js/form_css3/formcss3.css" type="text/css"  />  
<!-- JS -->
<style>
.img-fluid{ 
	height:100%;
}
</style>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script type="text/javascript" src="<?=$ROOTPATH?>/js/bootstrap-413/bootstrap.js" ></script>
<script type="text/javascript" src="<?=$ROOTPATH?>/js/jquery-1.7.1.min.js" ></script>
<script type="text/javascript" src="<?=$ROOTPATH?>/js/jquery.cookie.js" ></script>
<script type="text/javascript" src="<?=$ROOTPATH?>/js/mascara.js" ></script>
<script type="text/javascript" src="<?=$ROOTPATH?>/js/slider.js" ></script>

<script type="text/javascript" src="<?=$ROOTPATH?>/js/funcoes.js"></script> 
<script type="text/javascript" src="<?=$ROOTPATH?>/js/corner.js"></script>   
<script type="text/javascript" src="<?=$ROOTPATH?>/js/menu/menu.js"></script>    
<link rel="stylesheet" href="<?=$ROOTPATH?>/js/slideshow/css/skitter.styles.css" type="text/css"  /> 
<script type="text/javascript" src="<?=$ROOTPATH?>/js/slideshow/js/jquery.skitter.min.js"></script>
<script type="text/javascript" src="<?=$ROOTPATH?>/js/slideshow/js/highlight.js"></script>
<script type="text/javascript" src="<?=$ROOTPATH?>/js/slideshow/js/jquery.easing.1.3.js"></script> 
<script type="text/javascript" src="<?=$ROOTPATH?>/js/site.js"></script>  
 <meta http-equiv="cache-control" content="public" /> <!-- reconhecida pelo HTTP 1.1 -->
<meta http-equiv="Pragma" content="public"> <!-- reconhecida por todas as vers�es do HTTP -->
<meta content="document" name="resource-type"></meta> 
<meta content="ALL" name="robots"></meta>
<meta content="Global" name="distribution"></meta>
<meta content="General" name="rating"></meta>  
<?php if($INI['system']['googleanalitics'] != "") { ?>
<script type="text/javascript">
var _gaq = _gaq || [];
_gaq.push(['_setAccount', '<?php echo $INI['system']['googleanalitics'] ?>']);
_gaq.push(['_setCustomVar', 1,'cidade','SaoPaulo_D2581',2])
_gaq.push(['_trackPageview']);
(function() {
var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();
</script >
<?php  } ?>
<? if($_REQUEST['unsub']){ ?>
	<script>
    alert("Cancelamento de newsletter feito com sucesso!");
    </script>
<?}?>
<? include_once("head_color.php");?>
</head>