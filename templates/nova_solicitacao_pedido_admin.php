 <?php  
 
	$limiteofertasemail = 1; 
	$ofertascanceladas  = 1;  
	$ofertadestaque		= 1;   
	/*
	fim das logo.png
	*/
	
	require_once(dirname(dirname(__FILE__)). '/app.php');
	require_once(dirname(dirname(__FILE__)). '/include/get_ofertas.php');
	   
    $nome 	= $_REQUEST['realname'];
	$conteudomensagemcliente = $_REQUEST['invitation_content'];
	
    $nomesite = htmlentities($INI['system']['sitename'],ENT_COMPAT,'UTF-8');  
	 
 
 ?>
<html><head>

<style type="text/css">
.negtxt {
	font-weight: bold;
}
</style>
</head><body><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
<table width="100%" bgcolor="#67a919" border="0" cellpadding="0" cellspacing="0">
<tbody>
<tr>
<td style="padding: 20px;" name="tid" description="mediumBgcolor" bgcolor="#67a919">
<div style="padding: 0px; margin: 0px;">
<table style="font-family: 'Verdana';" width="600" align="center" cellpadding="0" cellspacing="0">
<tbody>
<tr>
<td colspan="5" bgcolor="#67a919">&nbsp;</td>
</tr>
<tr>
<td>
<table width="800" border="0" cellpadding="0" cellspacing="0">
<tbody>
 
<tr bgcolor="#ffffff">
<td valign="top" align="left" bgcolor="#ffffff"></td>
 
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
 
<h1 style="font-family: 'Arial'; border-bottom: solid 1px #cccccc; padding: 5px 0px 5px 0px; margin: 0px; color: #0099ff; font-size: 16px; font-weight: bold; letter-spacing: -1px;" name="tid" description="darkColor">Nova solicita&ccedil;&atilde;o de pedido  aguardando o pagamento </h1> 
<p><b>Dados do Pedido </b></p> 
<div class="maisOfertas boxfundo" style="width:95%">
<p> Usuário: <?= $_REQUEST['realname'] ?>
  <br>
  Oferta: 
  <?=   $_REQUEST['nome'] ;  ?>
  <br>
  Quantidade: 
  <?=$_REQUEST['quantity']?>
  <br> 
  Informações adicionais: 
  <?=$_REQUEST['remark']?>
  <br>
  <b>Valor total do pedido: R$ <?= $_REQUEST['origin'] ?></b></p>
 
 </div>
<p>Assim que o cliente realizar o pagamento, ele receber&aacute; um email de confirma&ccedil;&atilde;o de pagamento enviado pelo sistema.<br>
  Caso esta oferta esteja ativa no momento do pagamento, ele receber&aacute; um email com os dados do cupom. No entanto, ele poder&aacute; tamb&eacute;m entrar em sua conta pelo site e imprim&iacute;-lo.<br>
  <br>
  Lembrando que se a oferta n&atilde;o estiver ativa no momento do pagamento, ele apenas ir&aacute; receber um email de confirma&ccedil;&atilde;o de pagamento e o mesmo dever&aacute; aguardar a ativa&ccedil;&atilde;o da oferta. A oferta &eacute; ativada quando o seu n&uacute;mero m&iacute;nimo &eacute; alcan&ccedil;ado.
<p><span class="negtxt">Observa&ccedil;&atilde;o</span>: Se voc&ecirc; como administrador logo ap&oacute;s a compra do cliente, ir na administra&ccedil;&atilde;o e editar esta oferta fazendo o seu campo de venda virtual se igualar ao campo de venda m&iacute;nima, estamos dizendo que voc&ecirc; est&aacute; for&ccedil;ando a ativa&ccedil;&atilde;o da oferta. Neste caso ap&oacute;s salvar, voc&ecirc; deve esperar a pr&oacute;xima venda desta oferta para que o cupom seja enviado aos clientes que pagaram e est&atilde;o na fila aguardando o mesmo. Outra op&ccedil;&atilde;o &eacute; enviar manualmente o cupom pela administra&ccedil;&atilde;o clicando em reenviar cupom na consulta de pedidos.
<p>Caso voc&ecirc; tenha recebido este pagamento por dinheiro, ou outra forma de pagamento que n&atilde;o seja os m&eacute;todos do site, voc&ecirc; pode ir na mesma consulta de pedidos e alterar o status deste pedido para pago, assim, da mesma forma, se a oferta estiver ativa, o sistema ir&aacute; enviar o cupom ao cliente.
<p>O Vipcom conta com um log de transa&ccedil;&atilde;o rigoroso onde voc&ecirc; pode est&aacute; acompanhando todos os processos de pagamento e libera&ccedil;&atilde;o de cupom a partir deles, ficam sempre na pasta log. Veja como &eacute; simples: &Eacute; criado um arquivo txt por dia para cada movimenta&ccedil;&atilde;o, mais todas elas ficam no arquivo cujo o nome ser&aacute; a data do dia. Por ex: o arquivo <span class="negtxt">20110708.txt </span>foi gerado no dia 08 de julho de 2011. Para o dia 09 de Julho de 2011 ser&aacute; gerado o arquivo <span class="negtxt">20110709.txt</span>. Sendo assim voc&ecirc; pode estar visualizando cada log a partir de: 
  <span class="negtxt">
  <?=$ROOTPATH?>
  /log/20110708.txt</span> trocando sempre as datas.
<p>Voc&ecirc; pode tamb&eacute;m personalizar todos os templates de envio de email do Vipcom, para isso, entre no diret&oacute;rio TEMPLATES, os nomes s&atilde;o bem intuitivos e voc&ecirc; pode alterar qualquer coisa. 
<p><b>Equipe <?=$nomesite?></b></p>
<p><b><?=$INI['mail']['helpemail']?></b></p></td>
 
</tr>
<tr style="font-size: 11px;   color: #303030; padding: 2px 0px; margin: 0px; font-family: 'Verdana';">
  <td style="padding: 0px 20px 0px 0px;" valign="top">&nbsp;</td>
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
<td valign="bottom" width="10" bgcolor="#ffffff" height="25"><img src="<?=$ROOTPATH?>/skin/padrao/images/c3.gif" width="15" height="25" /></td>
<td bgcolor="#ffffff"></td>
<td valign="bottom" width="10" bgcolor="#ffffff" height="25"><img src="<?=$ROOTPATH?>/skin/padrao/images/c4.gif" width="15" height="25" /></td>
</tr>
<tr>
<td colspan="3" style="padding: 0px;" bgcolor="#67a919">
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