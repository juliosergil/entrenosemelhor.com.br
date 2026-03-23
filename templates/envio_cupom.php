 <?php
  
  
	$limiteofertasemail = 3; 
	$ofertascanceladas  = 1;  
	$ofertadestaque		= 1;   
	/*
	fim das logo.png
	*/
	
	require_once(dirname(dirname(__FILE__)). '/app.php');
	require_once(dirname(dirname(__FILE__)). '/include/get_ofertas.php');
	   
    $username 	= $_REQUEST['username'];
	$conteudomensagemcliente = $_REQUEST['invitation_content'];
	
	$nomesite = htmlentities($INI['system']['sitename'],ENT_COMPAT,'UTF-8');  
 
 ?> 
<html><head>
</head><body><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="Content-Language" content="pt-br" />
 
<table width="100%" bgcolor="#FFF" border="0" cellpadding="0" cellspacing="0" style="font-size: 14px;color: #303030;font-family: Arial, Helvetica;line-height: 20px;">
<tbody>
<tr>
<td style="padding: 20px;" name="tid" description="mediumBgcolor" bgcolor="#FFF">
<div style="padding: 0px; margin: 0px;">
<table style="font-family: 'Verdana';" width="600" align="center" cellpadding="0" cellspacing="0">
<tbody>
<tr>
<td colspan="5" bgcolor="#FFF">&nbsp;</td>
</tr>
<tr>
<td>
<table width="800" border="0" cellpadding="0" cellspacing="0">
<tbody>
 
<tr bgcolor="#ffffff">
<td valign="top" align="left" bgcolor="#ffffff"></td>
<td style="padding: 10px 15px 15px 15px;" valign="top" width="570" align="left">
</td>
<td></td>
</tr>
<tr bgcolor="#ffffff">
<td valign="top" align="left"></td>
 
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td style="padding: 10px 30px;" bgcolor="#ffffff">
<table width="100%" bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0">
<tbody>
<tr style="font-size: 11px;   color: #303030; padding: 2px 0px; margin: 0px; font-family: 'Verdana';">
<td style="padding: 0px 20px 0px 0px;" valign="top" width="57%">
<h1 style="font-family: Helvetica, Arial, sans-serif; font-weight: normal; letter-spacing: -1px; color: #0099ff; font-size: 28px; line-height: 26px; padding: 2px 0px; margin: 0px;" name="tid" description="darkColor"><img src="<?=$ROOTPATH?>/include/logo/logo.png" alt="<?=$nomesite?>"></h1>
 
<h1 style="font-family: 'Arial'; border-bottom: solid 1px #cccccc; padding: 5px 0px 5px 0px; margin: 0px; color: #0099ff; font-size: 16px; font-weight: bold; letter-spacing: -1px;" name="tid" description="darkColor">Parab&eacute;ns, abaixo est&aacute; os dados do seu cupom</h1>
 <br> 
 <div class="titulo" style="background:#0173C9; box-shadow: 2px 2px 4px 0 #888888;font-family: georgia;font-size: 24px; height: 28px; padding: 0px 12px 0;color:#FFF;margin-bottom:16px;">Segue os dados do seu cupom</div> 
 
	Para a sua comodidade, este cupom estar&aacute; dispon&iacute;vel tamb&eacute;m em sua conta no nosso site, para isso, <a href="<?=$ROOTPATH?>/index.php?page=meuscupons">clique aqui</a> e informe os seus dados de acesso. <br>
   <br>
	<strong>Oferta:</strong>:
	<?=$_REQUEST['oferta']?> <br>
	<strong>N&uacute;mero do Cupom</strong>:
	<?=$_REQUEST['numcupom']?> <br>
	<strong>Senha do Cupom</strong>:
	<?=$_REQUEST['senha']?> <br>
	<strong>Utilizador:</strong>
	<?=  htmlentities($_REQUEST['utilizador'] ,ENT_COMPAT,'UTF-8') ?>
	<br><br>
	<h3>Local de consuma&ccedil;&atilde;o de seu cupom</h3>
	<p><?= htmlentities($_REQUEST['parceiro'] ,ENT_COMPAT,'UTF-8')  ?>
	  <br>
	  <?= htmlentities($_REQUEST['location'] ,ENT_COMPAT,'UTF-8')   ?>
	  <br>
	  <?=$_REQUEST['homepage']?></p>
	 
	<p> </p>
	<p>Obrigado por comprar conosco !</p>
	<p><b>Equipe <?=$nomesite?></b></p>
	<p><b><?=$INI['mail']['helpemail']?></b></p></td>
 
<td style="padding: 10px 0px 10px 0px;" valign="top" width="43%">
 
<!-- ********** BLOCO MAIS OFERTAS ********** -->	
<? if($ofertas != "" ){ ?>
	 
	<div class="maisOfertas boxfundo">
    	 <?=$ofertas?>
    </div>

<? } ?>
<!-- ********** FIM BLOCO MAIS OFERTAS ********** -->	

<p style="font-size: 10px; line-height: 14px; color: #666633; padding: 5px 0px; margin: 0px; font-family: 'Verdana';">&nbsp;</p>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td>
<table style="padding: 0px;" width="100%" border="0" cellpadding="0" cellspacing="0">
<tbody>
<tr bgcolor="#ffffff">
<td></td>
<td style="padding: 5px 15px;"><p style="font-size: 10px; font-family: Verdana; color: #999999; text-align: center;" align="center"><br />
  <a href="%%unsubscribelink%%" style="color: #999999;"> </a> Para entrar em contato, envie um email para 
  <?=$INI['mail']['helpemail']?>
</p>
</td>
<td></td>
</tr>
 
<tr>
<td colspan="3" style="padding: 0px;" bgcolor="#FFF">
<p style="font-family: Verdana; font-size: 10px; color: #ffffff; text-align: center;" align="center">
  <?=$nomesite?> - Todos os direitos reservados
  <br /> 
  </p>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</div>
</td>
</tr>
</tbody>
</table></body></html>