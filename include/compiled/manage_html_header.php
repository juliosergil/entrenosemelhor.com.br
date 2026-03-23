<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" id="<?php echo $INI['sn']['sn']; ?>">
<head>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv=content-type content="text/html; charset=UTF-8">
	<title><?php echo $INI['system']['sitename']; ?> - Vipmin </title>
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
	<link rel="icon"  type="image/x-icon" href="/skin/padrao/icones/v.ico">
	 
	<link rel="stylesheet" href="/media/css/index.css" type="text/css" media="screen" charset="utf-8" /> 
	  
	<link rel="stylesheet" href="/media/css/mail.css" type="text/css" media="screen" charset="utf-8" /> 
	
	<link rel="stylesheet" href="/media/css/wrapped-select.css" type="text/css" media="screen" charset="utf-8" /> 
	
	<link rel="stylesheet" href="/media/css/timeSelector-whm.css" type="text/css" media="screen" charset="utf-8" /> 
	  
	<script type="text/javascript">var WEB_ROOT = '<?php echo WEB_ROOT; ?>';</script>
 
	<script src="/media/js/index.js" type="text/javascript"></script> 
	
	  
	<!-- novo override moderno (carregar por último) -->
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?=$ROOTPATH?>/media/css/vipmin-modern.css?v=1">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
 <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@500;600;700&display=swap" rel="stylesheet">

 
	  
	 
	<?php echo Session::Get('script',true);; ?>
</head>
<body class="<?php echo $request_uri=='index'?'bg-alt':'newbie'; ?>">
<div id="pagemasker"></div><div id="dialog"></div>
<div id="doc">

 
