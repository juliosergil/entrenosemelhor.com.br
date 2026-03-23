 <? if($navegador=="firefox"){?>
	<style>
	.btpagamento{  
		margin-top:0px; 
	}
	</style>
<? } ?>

<div style="display:none;" class="tips"><?=__FILE__?></div>
 
<?php if($team['metodo_pagamento'] == "pagseguro" or $team['metodo_pagamento'] == "" or  $team['metodo_pagamento'] == "99"){ if($INI['pagseguro']['acc'] != ""){ ?><div class="linha" style=""> <div class="btclass"> <img src="<?=$PATHSKIN?>/images/pagseguro.png"   border="0" /></div><div class="btpay">  <div class="button__padd">  <div class="botao"><a style="width: 191px;padding:10px 23px 5px 17px;" role="button" class="large blue button btfimcarrinho" id="tdb1"  href="javascript:enviapag_normal('pagseguro');"><div class="carrinho"></div><div class="btpagamento">Pagar com pagseguro</div></div></div></a> </div></div><? }} ?>
<?php if($team['metodo_pagamento'] == "mercadopago" or $team['metodo_pagamento'] == "" or  $team['metodo_pagamento'] == "99"){ if($INI['mercadopago']['acc_id'] != ""){ ?><div class="linha" style=""> <div class="btclass"> <img src="<?=$PATHSKIN?>/images/mercadopago.png"   border="0" /></div><div class="btpay"> <div class="button__padd">  <div class="botao"><a style="width: 191px;padding:10px 23px 5px 17px;" role="button" class="large blue button btfimcarrinho" id="tdb1"  href="javascript:enviapag_normal('mercadopago');"><div class="carrinho"></div><div class="btpagamento">Pagar com mercado pago</div></div></div></a> </div></div><? }} ?> 
<?php if($team['metodo_pagamento'] == "moip" or $team['metodo_pagamento'] == "" or  $team['metodo_pagamento'] == "99"){ if($INI['moip']['mid'] != ""){ ?><div class="linha" style=""><div class="btclass"> <img src="<?=$PATHSKIN?>/images/moip.png"   border="0" /></div><div class="btpay"> <div class="button__padd">  <div class="botao"><a style="width: 191px;padding:10px 23px 5px 17px;" role="button" class="large blue button btfimcarrinho" id="tdb1"  href="javascript:enviapag_normal('moip');"><div class="carrinho"></div><div class="btpagamento">Pagar com moip</div></div></div></a></div></div><? }} ?>
<?php if($team['metodo_pagamento'] == "pagamentodigital" or $team['metodo_pagamento'] == "" or  $team['metodo_pagamento'] == "99"){ if($INI['pagamentodg']['acc'] != ""){ ?><div class="linha" style=""><div class="btclass"> <img src="<?=$PATHSKIN?>/images/pagamentodigital.png"   border="0" /></div><div class="btpay"> <div class="button__padd">  <div class="botao"><a style="width: 191px;padding:10px 23px 5px 17px;" role="button" class="large blue button btfimcarrinho" id="tdb1"  href="javascript:enviapag_normal('pagamentodigital');"><div class="carrinho"></div><div class="btpagamento">Pagar com pag. digital</div></div></div></a></div></div><? }} ?>
<?php if($team['metodo_pagamento'] == "dinheiro" or $team['metodo_pagamento'] == "" or  $team['metodo_pagamento'] == "99"){  if($INI['dinheiro']['mid'] != ""){ ?><div class="linha" style=""><div class="btclass"> <img src="<?=$PATHSKIN?>/images/dinheiro.jpg"  style="width: 143px;" border="0" /></div><div class="btpay">  <div class="button__padd">  <div class="botao"><a style="width: 191px;padding:10px 23px 5px 17px;" role="button" class="large blue button btfimcarrinho" id="tdb1"  href="javascript:enviapag_normal('dinheiro');"><div class="carrinho"></div><div class="btpagamento">Pagar com dinheiro mail</div></div></div></a></div></div><? }} ?> 
<?php if($team['metodo_pagamento'] == "paypal" or $team['metodo_pagamento'] == "" or  $team['metodo_pagamento'] == "99"){ if($INI['paypal']['mid'] != ""){ ?><div class="linha" style=""> <div class="btclass"> <img src="<?=$PATHSKIN?>/images/paypal.png"   border="0" /></div><div class="btpay">  <div class="button__padd">  <div class="botao"><a style="width: 191px;padding:10px 23px 5px 17px;" role="button" class="large blue button btfimcarrinho" id="tdb1"  href="javascript:enviapag_normal('paypal');"><div class="carrinho"></div><div class="btpagamento">Pagar com paypal</div></div></div></a> </div></div><? }} ?>

<?php if($team['metodo_pagamento'] == "06" or $team['metodo_pagamento'] == "" or  $team['metodo_pagamento'] == "99"){
	
/*	if($INI['credito']['pay'] == "1"){ ?>
	<? if($origem == "minhaconta"){?>
		<div class="linha" style="padding: 15px 0px 8px;"> <div class="btclass"> <img src="<?=$PATHSKIN?>/images/modulo_flag_cards.png" border="0" /></div><div class="btpay"><a   href="javascript:enviapag('cartaocredito');" ><div class="button__padd">  <div class="botao"><a style="width: 191px;padding:10px 23px 5px 17px;" role="button" class="large blue button btfimcarrinho" id="tdb1"  href="javascript:enviaformapag();"><div class="carrinho"></div><div class="btpagamento">Pagar com cartão de crédito</div></div></div></a></div></div>
	 <? } else{ ?>	
		<div class="linha" style="padding: 15px 0px 8px;">  <div class="btclass"> <img src="<?=$PATHSKIN?>/images/modulo_flag_cards.png" border="0" /></div><div class="btpay"><a   href="javascript:enviapag('cartaocredito');" > <div class="button__padd">  <div class="botao"><a style="width: 191px;padding:10px 23px 5px 17px;" role="button" class="large blue button btfimcarrinho" id="tdb1"  href="javascript:enviaformapag();"><div class="carrinho"></div><div class="btpagamento">Pagar com cartão de crédito</div></div></div></a></div></div>
	<? } 
	}
*/
}