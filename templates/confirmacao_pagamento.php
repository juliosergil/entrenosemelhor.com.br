 <?php
	$limiteofertasemail = 3;  
	$ofertascanceladas  = 1;  
	$ofertadestaque		= 1;  
 
	require_once(dirname(dirname(__FILE__)). '/app.php');
	require_once(dirname(dirname(__FILE__)). '/include/get_ofertas.php');
	   
    $nome 	= $_REQUEST['realname'];
	$conteudomensagemcliente = $_REQUEST['invitation_content'];
    $nomesite = htmlentities($INI['system']['sitename'],ENT_COMPAT,'UTF-8');
 ?> 
<html><head>
</head><body><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="Content-Language" content="pt-br" />
<style>
.maisOfertas {
     
    display: block;
    font-family: "Arial";
    font-size: 14px;
    overflow: hidden;
    width: 213;
    color: #303030;
	font-family:verdana;
	font-size:11px;
	margin-left:17px; 
}

.boxfundo {
	-moz-border-radius: 10px 10px 10px 10px;
	background: none repeat scroll 0 0 #F0F0F0;
	border: 1px solid #E8E8E8;
	padding: 10px;
	}
	
</style>
<table width="100%"  border="0" cellpadding="0" cellspacing="0" style="font-size: 14px;color: #303030;font-family: Arial, Helvetica;line-height: 20px;">
<tbody>
<tr>
<td style="padding: 20px;" name="tid" description="mediumBgcolor" >
<div style="padding: 0px; margin: 0px;">
<table style="font-family: 'Verdana';" width="600" align="center" cellpadding="0" cellspacing="0">
<tbody>
<tr>
<td colspan="5" >&nbsp;</td>
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
<h1 style="font-family: 'Arial'; border-bottom: solid 1px #cccccc; padding: 5px 0px 5px 0px; margin: 0px; color: #0099ff; font-size: 16px; font-weight: bold; letter-spacing: -1px;" name="tid" description="darkColor">Parab&eacute;ns, seu pedido acaba de ser aprovado</h1>
 <br> 
 <div class="titulo" style="background:#0173C9; box-shadow: 2px 2px 4px 0 #888888;font-family: georgia;font-size: 24px; height: 28px; padding: 0px 12px 0;color:#FFF;margin-bottom:16px;">Segue os dados do seu pedido</div> 
 
 O pedido n&uacute;mero
<?=$_REQUEST['idPedido'] ?> acaba de ser aprovado. 
<h1 style="font-family: Helvetica, Arial, sans-serif; font-weight: normal; letter-spacing: -1px; color: #0099ff; font-size: 28px; line-height: 26px; padding: 2px 0px; margin: 0px;" name="tid" description="darkColor"><img src="<?=$ROOTPATH?>/include/logo/logo.png" alt="<?=$nomesite?>"></h1>
   
Voc&ecirc; receber&aacute; o n&uacute;mero e a senha do cupom assim que a oferta for ativada, voc&ecirc; pode tamb&eacute;m imprimir o cupom atrav&eacute;s de nosso site! 
 <p><strong>Dados do pedido<br>
 </strong><br>
N&uacute;mero do pedido : <b><?=$_REQUEST['idPedido'] ?></b> <br>
Nome do cliente: <b><?=  $_REQUEST['cliente_site'];  ?></b> <br>
Email do cliente: <b><?=$_REQUEST['email_site']?></b> <br>
Status da transa&ccedil;&atilde;o: <b><?= $_REQUEST['status_transacao']    ?></b> <br>
Tipo do pagamento: <b><?=  $_REQUEST['tipo_pagamento']   ?></b> <br>
Produto comprado: <b><?= $_REQUEST['descricao_produto']   ?></b> <br> 
Data do pagamento: <b><?=$_REQUEST['data_pagamento']?></b></p>
 <p><b></b></p>
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
<td colspan="3" style="padding: 0px;" >
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