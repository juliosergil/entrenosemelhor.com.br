 <?
 if(!$nome){
	$nomes 		= explode(" ",utf8_decode($login_user['realname']));
	$nome 		= $nomes[0];
	$sobrenome 	= $nomes[1]. " ".$nomes[2]. " ".$nomes[3]. " ".$nomes[4];
 }
 ?>
<div style="display:none;" class="tips"><?=__FILE__?></div>
<?
if($INI['pagseguro']['novaapi']=="sim"){
	
	require_once(WWW_ROOT.'/util/apipagseguro/createPaymentRequest.php'); 	
}
else { ?>
<!-- :::::::::::::::::::: formulario de pagamento PAGSEGURO ::::::::::::: -->
<?php if($INI['pagseguro']['acc'] != ""){ ?> 
	<form id="pagseguro" name="pagseguro"  method="post" sid="<?php echo $team_id; ?>" action="https://pagseguro.uol.com.br/checkout/checkout.jhtml">
		<input type="hidden" readonly="readonly" name="email_cobranca" value="<?php echo $INI["pagseguro"]["acc"]; ?>">
		<input type="hidden" readonly="readonly" name="tipo" value="CP">
		<input type="hidden" readonly="readonly" name="moeda" value="BRL">
		<input type="hidden" readonly="readonly" id="ref_transacao" name="ref_transacao" value="<?php echo  $idpedido; ?>">
		<input type="hidden" readonly="readonly" id="reference" name="reference" value="<?php echo  $idpedido; ?>">
		<input type="hidden" readonly="readonly" id="item_id_1" name="item_id_1" value="<?php echo  $idpedido; ?>">
		<input type="hidden" readonly="readonly" id="item_descr_1" name="item_descr_1" value="<?=$title?>">
		<input type="hidden" readonly="readonly" id="item_quant_1" name="item_quant_1" value="<?php echo $quantity ?>">
		<input type="hidden" readonly="readonly" id="item_valor_1" name="item_valor_1" value="<?php echo  $valor_original	 ?>">
		
		<input type="hidden" readonly="readonly" name="item_frete_1" value="<?=$valorfrete?>"> 
		<input type="hidden" readonly="readonly" name="item_peso_1" value="0"> 
		<input type="hidden" readonly="readonly" name="tipo_frete" value="">
		  <!-- Dados do comprador (opcionais) -->  
		<input type="hidden" name="senderName" value="<?=$login_user['realname']?>">  
		<input type="hidden" name="senderEmail" value="<?=$login_user['email']?>">  
		
			<!-- Informações de frete (opcionais) -->  
		<input type="hidden" name="shippingType" value="1">  
		<input type="hidden" name="shippingAddressPostalCode" value="<?=$login_user['zipcode']?>">  
		<input type="hidden" name="shippingAddressStreet" value="<?=$login_user['address']?>">      
		<input type="hidden" name="shippingAddressDistrict" value="<?=$login_user['bairro']?>">  
		<input type="hidden" name="shippingAddressCity" value="<?=$login_user['cidadeusuario']?>">  
		<input type="hidden" name="shippingAddressState" value="<?=$login_user['estado']?>">  
		<input type="hidden" name="shippingAddressCountry" value="BRA">  
		  
		<!-- Dados do comprador (opcionais) -->    
		<input type="hidden" name="senderPhone" value="<?=$login_user['mobile']?>">   
	</form>
<? } 
}?> 


<!-- :::::::::::::::::::: formulario de pagamento MERCADO PAGO ::::::::::::: -->
<?php  if($INI['mercadopago']['acc_id'] != ""){ 
		$item_valor2 = $valor_original;
        $item_valor2 = str_replace(",",".",$item_valor2);
?>
<form id="mercadopago" target="_blank" name="mercadopago"  action="https://www.mercadopago.com/mlb/buybutton" method="post">
  <input type="hidden" readonly="readonly" name="acc_id" value="<?=$INI['mercadopago']['acc_id']?>">      
  <input type="hidden" readonly="readonly" name="enc" value="<?php echo $INI['mercadopago']['enc']; ?>">	
  <input type="hidden" name="token" value="<?php echo $INI['mercadopago']['token']; ?>">
  
    <input type="hidden" readonly="readonly" name="url_succesfull" value="<?php echo $ROOTPATH?>/pedido/mercadopago/retorno.php">
	<!--
    <input type="hidden" readonly="readonly" name="url_process" value="<?php echo $ROOTPATH?>/pedido/mercadopago/retorno.php">
    <input type="hidden" readonly="readonly" name="url_cancel" value="<?php echo $ROOTPATH?>/pedido/mercadopago/retorno.php">
	-->
	
  <input type="hidden" readonly="readonly" id="item_id"  name="item_id" value="<?php echo  $idpedido; ?>">  
  <input type="hidden" readonly="readonly" id="name"  name="name" value="<?=$title?>">  
  <input type="hidden" readonly="readonly" name="currency" value="REA">  
  <input type="hidden" readonly="readonly" id="price" name="price" value="<?php echo  $item_valor2?>">   
  <input type="hidden" readonly="readonly" name="cart_cep" value="<?=$login_user['zipcode']?>">   
  <input type="hidden" readonly="readonly" name="cart_street" value="<?=$login_user['address']?>">   
  <input type="hidden" readonly="readonly" name="cart_complement" value="">  
  <input type="hidden" readonly="readonly" name="cart_phone" value="<?=$login_user['mobile']?>">   
  <input type="hidden" readonly="readonly" name="cart_district" value=""> 
  <input type="hidden" readonly="readonly" name="cart_city" value="<?=$login_user['cidadeusuario']?>">  
  <input type="hidden" readonly="readonly" name="cart_state" value="<?=$login_user['estado']?>"> 
  <input type="hidden" readonly="readonly" name="cart_name" value="<?=$nome?>">   
  <input type="hidden" readonly="readonly" name="cart_surname" value="<?=$sobrenome?>">    
  <input type="hidden" readonly="readonly" name="cart_email" value="<?=$login_user['email']?>">  
  <input type="hidden" readonly="readonly" name="cart_doc_nbr" value="">    
  <input type="hidden" readonly="readonly" name="seller_op_id" value="<?php echo  $idpedido; ?>">
  
  <input type="hidden" name="shipping_cost" value="<?=$valorfrete?>">
  <input type="hidden" name="ship_cost_mode" value="FI">
	
	<!--
	ship_cost_mode Modo de envio: CO (Envio pelos Correios); FI (Custos fixos); FS (Frete grátis); DS (Envio digital).
	-->
	
</form>
<? } ?>
 
 
<!-- :::::::::::::::::::: formulario de pagamento PAGAMENTO DIGITAL ::::::::::::: -->
<?php if($INI['pagamentodg']['acc'] != ""){ ?>
<form name="pagamentodigital" id="pagamentodigital"  method="post" sid="<?php echo $team_id; ?>" action="https://www.pagamentodigital.com.br/checkout/pay/"  >
<input name="email_loja" type="hidden" readonly="readonly" value="<?php echo $INI['pagamentodg']['acc']; ?>">
<input id="produto_codigo_1" name="produto_codigo_1" type="hidden" readonly="readonly" value="<?php echo $idpedido; ?>">
<input id="produto_descricao_1"  name="produto_descricao_1" type="hidden" readonly="readonly" value="<?=$title?>">
<input id="produto_qtde_1" name="produto_qtde_1" type="hidden" readonly="readonly" value="<?php echo $quantity ?>">
<input id="produto_valor_1" name="produto_valor_1" id="produto_valor_1" type="hidden" readonly="readonly" value="<?php echo number_format(str_replace(".","",$valor_original),2,',','');?>" >
<input name="tipo_integracao" type="hidden" readonly="readonly" value="PAD">
<!-- opcionais -->
<input id="id_pedido" name="id_pedido" type="hidden" readonly="readonly" value="">
<input   name="email" type="hidden" readonly="readonly" value="<?=$login_user['email']?>">
<input   name="nome" type="hidden" readonly="readonly" value="<?=$login_user['realname']?>">
<input   name="cpf" type="hidden" readonly="readonly" value="<?=$login_user['cpf']?>">
<input   name="telefone" type="hidden" readonly="readonly" value="<?=$login_user['mobile']?>">
<input   name="endereco" type="hidden" readonly="readonly" value="<?=$login_user['address']?>">
<input   name="bairro" type="hidden" readonly="readonly" value="<?=$login_user['bairro']?>">
<input   name="cidade" type="hidden" readonly="readonly" value="<?=$login_user['cidadeusuario']?>">
<input   name="estado" type="hidden" readonly="readonly" value="<?=$login_user['estado']?>">
<input  name="cep" type="hidden" readonly="readonly" value="<?=$login_user['zipcode']?>">  


<input name="frete" type="hidden" readonly="readonly" value="<?=$valorfrete?>"> 
<input name="url_retorno" type="hidden" readonly="readonly" value="<?php echo $INI['system']['wwwprefix']?>/pedido/pagamentodg/retorno.php"> 
<input name="url_aviso" type="hidden" value="<?php echo $INI['system']['wwwprefix']?>/pedido/pagamentodg/retorno.php">
<input name="redirect" type="hidden" value="true">
                                                                   
</form>


<? } ?>

<!-- :::::::::::::::::::: formulario de pagamento MOIP ::::::::::::: -->
<?php if($INI['moip']['mid'] != ""){  
 
?>
<form id="moip" name="moip" method="post" action="https://www.moip.com.br/PagamentoMoIP.do" sid="<?php echo $team_id; ?>">
<input type='hidden' readonly="readonly" id='id_carteira' name='id_carteira' value='<?php echo $INI['moip']['mid']; ?>'>
<input type='hidden' readonly="readonly" id='id_transacao' name='id_transacao' value='<?php echo $idpedido; ?>'>
<input type='hidden' readonly="readonly" id='valor' name='valor' value='<?php echo  str_replace(",","",$valor_outros_gateways) ?>'>
<input type='hidden' readonly="readonly" id='nome' name='nome' value='<?=$title ?>'>
<input type='hidden' readonly="readonly" id='descricao' name='descricao' value='<?=$title ?>'>
</form>
<? } ?>

<!-- :::::::::::::::::::: formulario de pagamento cartao de credito::::::::::::: -->
<?php if($INI['credito']['pay'] == "1"){  ?>
<form id="cartaocredito" name="cartaocredito" method="post" action="<?=$ROOTPATH?>/index.php?page=pagamentocc">
	<input type='hidden' readonly="readonly" id='valor' name='valor' value='<?php echo  str_replace(",","",$valor_original) ;  ?>'>
	<input type="hidden" readonly="readonly" name="pedido" value="<?php echo $idpedido; ?>">
	<input type="hidden" readonly="readonly" name="team_id" value="<?php echo $team_id; ?>">
</form>
<? } ?>
 
 <!-- :::::::::::::::::::: formulario de pagamento PAYPAL ::::::::::::: -->
<?php if($INI['paypal']['mid'] != ""){  ?>
 
 <form action="https://www.paypal.com/cgi-bin/webscr"  id="paypal" name="paypal" method="post">
 
	<input type="hidden" readonly="readonly" name="cmd" value="_xclick">
	 <input type="hidden" readonly="readonly" name="lc" value="<?php echo $INI['paypal']['loc']; ?>"> 
	<input type="hidden" readonly="readonly" name="business" value="<?php echo $INI['paypal']['mid']; ?>">
	<input type="hidden" readonly="readonly" id="item_name" name="item_name" value="<?=$title?>">
	<input type="hidden" readonly="readonly" id="item_number" name="item_number" value="<?php echo  $idpedido; ?>">
	<input type="hidden" readonly="readonly" id="amount" name="amount" value="<?php echo  str_replace(",",".",$valor_original) ;  ?>">
	<input type="hidden" readonly="readonly" name="first_name" value="<?=$nome?>">
	<input type="hidden" readonly="readonly" name="last_name" value="<?=$sobrenome?>">
	<input type="hidden" readonly="readonly" name="address1" value="<?=$login_user['address']?>">
	<input type="hidden" readonly="readonly" name="address2" value="<?=$login_user['bairro']?>">
	<input type="hidden" readonly="readonly" name="city" value="<?=$login_user['cidadeusuario']?>">
	<input type="hidden" readonly="readonly" name="tax_id" value="<?=$login_user['cpf']?>">
	<input type="hidden" readonly="readonly" name="state" value="<?=$login_user['estado']?>">
	<input type="hidden" readonly="readonly" name="zip" value="<?=$login_user['zipcode']?>">
	<input type="hidden" readonly="readonly" name="H_PhoneNumber" value="<?=$login_user['mobile']?>">
	<input type="hidden" readonly="readonly" name="email" value="<?=$login_user['email']?>">
	<INPUT TYPE="hidden" readonly="readonly" NAME="return" value="<?php echo $INI['system']['wwwprefix']?>/pedido/paypal/retorno.php">  
	<input type="hidden" readonly="readonly" name="currency_code" value="<?php echo $INI['paypal']['loc']; ?>"> 
	 
	<input type="hidden" readonly="readonly" name="rm" value="2" /> 
	<input type="hidden" readonly="readonly" name="notify_url" value="<?php echo $INI['system']['wwwprefix']?>/pedido/paypal/retorno.php" /> 
	<input type="hidden" readonly="readonly" name="transaction_subject" value="<?=$title?>" />
 
</form>
<? } ?> 

<!-- :::::::::::::::::::: formulario de pagamento DINHEIRO MAIL ::::::::::::: -->
<?php if($INI['dinheiro']['mid'] != ""){  ?>
 

	<form action="https://checkout.dineromail.com/CheckOut" id="dinheiro" name="dinheiro"  method="post" >
	<!--Sale settings-->
	<input type="hidden" name="tool" value="cart" />
	<input type="hidden" name="merchant" value="<?php echo $INI['dinheiro']['mid']; ?>" /> 
	<input type="hidden" name="language" value="pt" />
	<input type="hidden" name="transaction_id" value="<?php echo  $idpedido; ?>" />
	<input type="hidden" name="currency" value="brl" />
	<input type="hidden" name="ok_url" value="<?php echo $INI['system']['wwwprefix']?>/pedido/dinheiromail/retorno.php" />
	<input type="hidden" name="error_url" value="<?php echo $INI['system']['wwwprefix']?>/pedido/dinheiromail/retorno.php" />
	<input type="hidden" name="pending_url" value="<?php echo $INI['system']['wwwprefix']?>/pedido/dinheiromail/retorno.php" /> 
	<input type="hidden" name="buyer_message" value="1" />
	<input type="hidden" name="header_image" value="<?php echo $INI['system']['wwwprefix']?>/include/logo/logo.png" />
	<input type="hidden" name="country_id" value="2" /> 
	<!--PaymetMethod-->
	<input type="hidden" name="payment_method_available" value="all" /> 
	<!--Items-->
	<!--Item1 -->
	<input type="hidden" id="item_name_1"  name="item_name_1" value="<?=utf8_encode($title)?>" /> 
	<input type="hidden" id="item_quantity_1" name="item_quantity_1" value="<?php echo $quantity ?>" />
	<input type="hidden" id="item_ammount_1" name="item_ammount_1" value="<?php echo  str_replace(",",".",$valor_original) ;  ?>" />
	<input type="hidden" id="item_currency_1" name="item_currency_1" value="brl" />
	<input type="hidden" id="shipping_type_1" name="shipping_type_1" value="0" />
	<!-- <input type="hidden" name="weight_1" value="kg" />-->
	<!--<input type="hidden" name="item_weight_1" value="0" />-->
	<!-- <input type="hidden" name="shipping_currency_1" value="brl" />-->
  
	<!--Buyer info -->
	<input type="hidden" name="buyer_name" value="<?=$nome?>" />
	<input type="hidden" name="buyer_lastname" value="<?=$sobrenome?>" />
	<input type="hidden" name="buyer_sex" value="m" />
	<input type="hidden" name="buyer_nacionality" value="bra" />
	<input type="hidden" name="buyer_document_type" value="cpf" />
	<input type="hidden" name="buyer_document_number" value="<?=$login_user['cpf']?>" />
	<input type="hidden" name="buyer_email" value="<?=$login_user['email']?>" />
	<input type="hidden" name="buyer_phone" value="<?=$login_user['mobile']?>" /> 
	<input type="hidden" name="buyer_zip_code" value="<?=$login_user['zipcode']?>" />
	<input type="hidden" name="buyer_street" value="<?=$login_user['address']?> <?=$login_user['bairro']?>" /> 
	<input type="hidden" name="buyer_city" value="<?=$login_user['cidadeusuario']?>" />
	<input type="hidden" name="buyer_state" value="<?=$login_user['estado']?>" />
	<input type="hidden" name="change_quantity" value="0" />
	<input type="hidden" name="display_shipping" value="0" />
	<input type="hidden" name=" display_additional_charge" value="0" />
	 
	</form>
<? } 
?>

	 
<!-- :::::::::::::::::::: formulario de pagamento SALDO DE CONTA ::::::::::::: -->
<? 
$valor_original = str_replace(",",".",$valor_original);
$valor_original = $valor_original * $quantity; 
?>
<form id="order-pay-credit-form" action="<?=$ROOTPATH?>/index.php?page=finalizacredito"  method="post" sid="<?php echo $team_id ?>">
	<input type="hidden" readonly="readonly" name="origin" value="<?=$valor_original?>" />
	<input type="hidden" readonly="readonly" name="order_id" value="<?php echo $idpedido; ?>" />
	<input type="hidden" readonly="readonly" name="quantidade" value="<?php echo $quantity; ?>" />
	<input type="hidden" readonly="readonly" name="hash" value="<?php echo $hash; ?>" />
	<input type="hidden" readonly="readonly" name="team_id" value="<?php echo $team_id; ?>" />
	<input type="hidden" readonly="readonly" name="restantevalor" value="<?php echo $restantevalor; ?>" />
	<input type="hidden" readonly="readonly" name="title" value="<?php echo $title; ?>" />
	<input type="hidden" readonly="readonly" name="service" value="credit" /> 
</form>