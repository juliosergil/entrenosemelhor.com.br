 <?php
   
	require_once(dirname(dirname(__FILE__)). '/app.php'); 
	    
	$idoferta = strval($_REQUEST['idoferta']);
	$nome_proposta = strval($_REQUEST['nome_proposta']); 
	$email_proposta = strval($_REQUEST['email_proposta']);
	$ddd_proposta = strval($_REQUEST['ddd_proposta']);
	$telefone_proposta = strval($_REQUEST['telefone_proposta']);
	$proposta = strval($_REQUEST['proposta']); 
	  
	$team  = Table::Fetch('team',$idoferta);
	$link = $INI['system']['wwwprefix']."/anuncio/". $team['id']."/".urlamigavel( tratanome( $team['title']));
    $nomesite = htmlentities($INI['system']['sitename'],ENT_COMPAT,'UTF-8');
 
 ?>
<html><head>
</head><body><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="Content-Language" content="pt-br" />
 
<table width="100%"  border="0" cellpadding="0" cellspacing="0">
<tbody>
<tr>
<td style="padding: 20px;" name="tid" description="mediumBgcolor" >
<div style="padding: 0px; margin: 0px;">
<table style="font-family: 'Verdana';" width="600" align="center" cellpadding="0" cellspacing="0">
<tbody>
 
<tr>
<td style="padding: 10px 30px;" bgcolor="#ffffff">
	
	
<table width="100%" bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0">
<tbody>
<tr style="font-size: 11px; color: #303030; padding: 2px 0px; margin: 0px; font-family: 'Verdana';">
<td style="padding: 0px 20px 0px 0px;" valign="top" width="57%">
<h1 style="font-family: Helvetica, Arial, sans-serif; font-weight: normal; letter-spacing: -1px; color: #0099ff; font-size: 28px; line-height: 26px; padding: 2px 0px; margin: 0px;" name="tid" description="darkColor"><img style="max-width: 320px;" src="<?=$ROOTPATH?>/include/logo/logo.png" alt="<?= utf8_encode($nomesite) ?>"></h1>


<h1 style="font-family: 'Arial'; border-bottom: solid 1px #cccccc; padding: 5px 0px 5px 0px; margin: 0px; color: #0099ff; font-size: 16px; font-weight: bold; letter-spacing: -1px;" name="tid" description="darkColor">Voc&ecirc; recebeu uma nova proposta!</h1>
<div class="titulo" style="background:#0173C9; box-shadow: 2px 2px 4px 0 #888888;font-family: georgia;font-size: 24px; height: 28px; padding: 0px 12px 0;color:#FFF;margin-bottom:16px;"><?=utf8_encode($team['title'])?></div>

<h3><?=utf8_encode($team['title'])?></h3>
<br>
<h3>Dados do Interessado</h3>
<p><b>Nome:</b> <?=utf8_encode($nome_proposta)?></p>
<p><b>Email:</b> <?=$email_proposta?></p>
<? if($ddd_proposta){?><p><b>DDD:</b> <?=$ddd_proposta?></p> <? } ?>
<? if($telefone_proposta){?><p><b>Telefone:</b> <?=$telefone_proposta?></p> <? } ?>
<p></p>
<p><b>Mensagem:</b> <?=utf8_encode($proposta)?></p>
<p><b>An&uacute;ncio:</b><a target="_blank" href="<?=$link?>"> <?=$link?></a></p>
<p></p>
<p>=============================</p>

<p> Voc&ecirc; est&aacute; recebendo esta mensagem porque o seu an&uacute;ncio est&aacute; publicado no site
	<br>
<b> <?=$nomesite ?> - <a href="<?=$INI['system']['wwwprefix']?>"><?=$INI['system']['wwwprefix']?></a></b></p>
<p></p><p></p>
<p></p> Para alterar o seu an&uacute;ncio <a href="<?=$INI['system']['wwwprefix']?>/adminanunciante">clique aqui</a> ou nos envie um email
<p><b><?=$INI['mail']['helpemail']?></b></p>
<p></p><p>Atenciosamente</p>
<p><?=$nomesite ?></p>
</td>

<td style="padding: 10px 0px 10px 0px;" valign="top" width="43%">

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
 
<td></td>
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