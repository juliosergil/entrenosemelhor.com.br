<? if($txterro == ""){ ?> 
		<h3> <?php echo "Escolha a sua Forma de pagamento" ?> </h3>
<? }  
if($envio){
		echo "<h2 style='font-size:14px;'>Os dados deste pedido foram enviados para o seu email e já está disponível em sua conta 
		caso você queira fazer o pagamento mais tarde </h2>";
}?> 
<br class="clear" />  
<?php
   
if ($pgcredito !="sim"){ // se este pedido nao for pagamento de credito, ou seja, só entra se for pagamento de ofertas. 
	
	$quantity 		= $order['quantity']; 
	$idpedido		= $order['id'];
	$team_id		= $idproduto;
	$team 			= Table::Fetch('team', $team_id); 
	$valor_original = number_format($team['team_price'], 2, ',', '.'); // dependendo do gateway, o valor total é calcula diretamente nele, com o valor da oferta + quantidade
	$valorfrete		= 0;
	
	if($team['frete']=="1" ){  // verifica para poder somar o valor do pedido com o valor do frete
		if( $team['fretegratuito'] == "1"){
			$valorfrete = "0,00";
		}
		else if( $team['valorfrete'] != "" and $team['valorfrete'] != "0,00"){
			$valorfrete = $team['valorfrete']; // somente se o valor do frete for fixo no cadastro da oferta
		}
		else{
			$valorfrete = calculaFrete(41106,$team['ceporigem'], getCepDestino($login_user),  $quantity * $team['peso'], $team['altura'], $team['largura'],  $team['comprimento'], $team['team_price']);
		}
		$valorfrete = str_replace(",",".",$valorfrete); 
 
	}
  
	/* apenas para o moip */
	$valor_outros_gateways = $order['origin'];  
	$valor_outros_gateways = number_format($valor_outros_gateways,2);
	$valor_outros_gateways = str_replace(",","",$valor_outros_gateways); 
	$valor_outros_gateways = str_replace(".","",$valor_outros_gateways);
	
	/* fim  moip */
	 
	if($team['preco_comissao'] != "" and $team['preco_comissao'] !="0"){ // o valor a ser pago pelo usuario será o valor da comissao (valor do cupom, oferta do tipo cupomnow)
	  
		/* apenas para o moip */
		$valor_outros_gateways = $team['preco_comissao'] * $quantity; 
		$valor_outros_gateways = number_format($valor_outros_gateways,2);
		$valor_outros_gateways = str_replace(",","",$valor_outros_gateways); 
		$valor_outros_gateways = str_replace(".","",$valor_outros_gateways);
		/* fim  moip */
		
		$valoronline 		= $team['preco_comissao'];  
		$valor_original  	= number_format($valoronline, 2, ',', '.');
		$valorcompra 		= $valoronline * $quantity;
		  
	   if($valorfrete){ $textocomissao 		=   "<h2 style='font-size:14px;'>Você está pagando agora o valor de: R$ ".number_format($valorcompra, 2, ',', '.')." + Frete no valor de R$ ".$valorfrete." </h2>";} 
	   if(!$valorfrete){ $textocomissao  	=   "<h2 style='font-size:14px;'>Você está pagando agora o valor de: R$ ".number_format($valorcompra, 2, ',', '.')."</h2>";} 
	   
		$textocomissao 		.=  "<h2 style='font-size:14px;'>Veja no regulamento desta oferta como entrar em contato com o parceiro após a aprovação do pagamento.</h2>";
		$textocomissao 		.=  "<h2 style='font-size:14px;'>Você receberá um e-mail com os dados do cupom assim que seu pagamento for aprovado.</h2>";
 
		if($team['team_type'] =="cupom" and $team["textopedido"] != ""){?>
			<span><?=utf8_decode($team["textopedido"])?></span>
		<?}
		else{
			if($origem == "minhaconta"){
				echo utf8_encode($textocomissao);
			}
			else{
				echo $textocomissao;
			}
		}
	}
}
else{  
	$now = time();
	$randno = rand(1000,9999);
	  
	$title 		=  "Recarga de Créditos no ".$INI['system']['sitename'] ;
	$quantity 	= 1;
	$team_id	= "charge-$login_user_id-$now-$randno";
	$idpedido 	= $team_id;	 
} 
$hash = md5( "Vipcom!@#".$idpedido.$valor_original.$quantity);

$nomes 		= explode(" ",utf8_decode($login_user['realname']));
$nome 		= $nomes[0];
$sobrenome 	= $nomes[1]. " ".$nomes[2]. " ".$nomes[3]. " ".$nomes[4];
?>
   
	<? require_once('opcoes_pagamento.php');?>	

   <? if ($pgcredito !="sim"){

			$saldousuario 	= str_replace(".","",number_format($login_user['money'],2));
			$valorpedido 	= str_replace(".","",number_format($order['origin'],2)); 
	 ?>
	 <? if($team['metodo_pagamento'] != "99"){?>
		<?php if($team['preco_comissao'] != "" and $team['preco_comissao'] !="0" and $team['preco_comissao'] !="0.00"){   ?> 
				<?php if ($login_user['money'] >= $valoronline  and  $login_user['money'] !="0.00" ){ ?>
						<br class="clear" /> 
						 
						<div class="linha" style=""> </div>
						<? if($origem == "minhaconta"){?>
							<div class="btpay" style="width:435px; float:left;"><?=utf8_encode("Você")?> tem R$ <?php echo $login_user['money'] ?> <?=utf8_encode("de créditos para fazer esse pagamento, agora você paga apenas R$ ".number_format($valorcompra, 2, ',', '.').", aproveite !")?></div>
						<? }
						else{
							if($team["bonuslimite"] != "" and $team["bonuslimite"] != "0" and $team["bonuslimite"] != "0.00"){
								$restantevalor = $valoronline - $team["bonuslimite"];
							?>
								<div class="btpay" style="width:435px; float:left;">Você só pode utilizar R$ <?php echo $team["bonuslimite"] ?>  de seus créditos para comprar esta oferta. O restante do valor (R$ <?=number_format($restantevalor,2)?>) você deve utilizar de outra forma de pagamento para concretizar o pedido </div>
							<?}
							else{ ?>
								<div class="btpay" style="width:435px; float:left;">Você tem R$ <?php echo $login_user['money'] ?>  de créditos para fazer esse pagamento, agora você paga apenas <b>R$ <?=number_format($valorcompra, 2, ',', '.')?></b>, aproveite ! </div>
							<? } 
						 }
						 ?>
						 <div class="btsal" style="width:200px;"><a style="width:400px;" href="javascript:enviapag('order-pay-credit-form');">  <div style="float:right;width:229px;" class="button__padd">  <div class="botao"><a style="width: 191px;padding:10px 23px 5px 17px;" role="button" class="large blue button btfimcarrinho" id="tdb1"  href="javascript:enviapag_normal('order-pay-credit-form');"><div class="carrinho"></div><div class="btpagamento">Usar meus créditos</div></div></div></a></div>
				<?php  } ?>
			<?php  } 

		else if ((int)$login_user['money'] !="0" and $login_user['money'] !="" and $login_user['money'] !="0.00" ){ ?>
					<div class="linha" style="padding: 15px 0px 8px;"> </div>
					
					<? if($origem == "minhaconta"){?>
						<div class="float:left;"><?=utf8_encode("Você")?> tem R$ <?php echo $login_user['money'] ?> <?=utf8_encode("de créditos para fazer esse pagamento, aproveite !")?></div>
					<? }
					if($team["bonuslimite"] != "" and $team["bonuslimite"] != "0" and $team["bonuslimite"] != "0.00"){
							$restantevalor = $order['origin'] - $team["bonuslimite"]; ?>
							<div class="float:left;">Você só pode utilizar R$ <?php echo $team["bonuslimite"] ?>  de seus créditos para comprar esta oferta. O restante do valor (R$ <?=number_format($restantevalor,2)?>) você deve utilizar de outra forma de pagamento para concretizar o pedido </div>
						<?}
						else if ((int)$login_user['money'] < (int)$order['origin']){ 
							 $restantevalor = $order['origin'] - $login_user['money']; ?>
							<div class="btpay" style="width:435px; float:left;">Você está utilizando R$ <?php echo number_format($login_user['money'],2) ?>  de seus créditos para comprar esta oferta. O restante do valor (R$ <?=number_format($restantevalor,2)?>) você deve utilizar de outra forma de pagamento para concretizar o pedido </div>
						 <?}
					 else{ ?> 
						<div class="btpay" style="width:435px; float:left;">Você tem <b>R$ <?php echo $login_user['money'] ?></b>  de créditos para fazer esse pagamento </div>
					<? } ?>
					 
					<div class="btsal" style="width:200px;float:right;"><a style="width:400px;" href="javascript:enviapag('order-pay-credit-form');">  <div style="float:right;width:229px;" class="button__padd">  <div class="botao"><a style="width: 191px;padding:10px 23px 5px 17px;" role="button" class="large blue button btfimcarrinho" id="tdb1"  href="javascript:enviapag_normal('order-pay-credit-form');"><div class="carrinho"></div><div class="btpagamento">Usar meus créditos</div></div></div></a></div>
				 
		<?php  } ?>
	 <?php  } ?>
 <?php  } ?>
 
    <br class="clear" /> 
    <br class="clear" /> 
	<div><img src="<?=$PATHSKIN?>/images/bandeiras.gif" /></div>
 
<? require_once('formularios_pagamento.php');?>


 <script language="javascript">
	  
	function enviapag_normal(valorform){
 
		<?php if ($pgcredito =="sim"){?>
		
				if(J("#valorcredito").val() == "" || J("#valorcredito").val() == "Informe o valor"){
					alert('<?=utf8_encode("Por favor, informe o valor de créditos que você quer comprar.")?>');
					return
				}
 
				valor = J("#valorcredito").val()
				valor = valor.replace(",",".")
				J("#item_valor_1").val(valor)
				J("#produto_valor_1").val(valor)
				J("#valor").val(valor)
				J("#price").val(valor)
				 
		 <? } ?>  
		  
			
	   if(valorform=="pagseguro"){
		  if(J("#urlapipg").val() != "" & J("#urlapipg").val() !="undefined"){
				 
				location.href=J("#urlapipg").val();  
		  }
	  } 
	 
	 J("#"+valorform).submit();
	 
}
	 
</script>
 
<BR><BR>

<?php

?>