<div class="linha" style="">  
	<div class="btpay">   
		 <div class="btpagamento">
			<a href="javascript:enviapag_normal('pagseguro');"> 
				<img style='max-width: 278px;' src="<?=$PATHSKIN?>/images/botaopagar.png"  border="0" />
			</a> 
		</div>
	</div>
</div> 
 <input type="hidden" readonly="readonly" id="valorforall" name="valorforall" value="">	
<!-- PAGSEGURO -->
<? 
$GATEWAY = 'pagseguro';
	if($INI['credito']['metodo_pagamento'] =="pagseguro" or $INI['credito']['metodo_pagamento'] ==""){?>

	<div class="linha" style="">  
		<div class="btpay">   
			 <div class="btpagamento">
				<a href="javascript:enviapag_normal();">
					<img src="<?=$PATHSKIN?>/images/<?=$GATEWAY?>.png"  border="0" /> 
				</a> 
			</div>
		</div>
	</div> 
	<form target ="_blank"   name="formpg" id="formpg"  method="post" sid="<?php echo $team_id; ?>" action="https://pagseguro.uol.com.br/checkout/checkout.jhtml">
		<input type="hidden" readonly="readonly" name="email_cobranca" value="<?php echo $INI["pagseguro"]["acc"]; ?>">
		<input type="hidden" readonly="readonly" name="tipo" value="CP">
		<input type="hidden" readonly="readonly" name="moeda" value="BRL">
		<input type="hidden" readonly="readonly" id="ref_transacao" name="ref_transacao" value="">
		<input type="hidden" readonly="readonly" id="reference" name="reference" value="">
		<input type="hidden" readonly="readonly" id="item_id_1" name="item_id_1" value="<?php echo  $idanuncio; ?>">
		<input type="hidden" readonly="readonly" id="item_descr_1" name="item_descr_1" value="">
		<input type="hidden" readonly="readonly" id="item_quant_1" name="item_quant_1" value="1">
		<input type="hidden" readonly="readonly" id="item_valor_1" name="item_valor_1" value="">  
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
		<input type="hidden" name="encoding" value="UTF-8">   
		
		  <input type="hidden" name="ship_cost_mode" value="FI">
	 </form> 
	 
<? } ?>
 
 <!-- PAYPAL -->

<? 
$GATEWAY = 'paypal';
if($INI['credito']['metodo_pagamento'] =="paypal"){ ?>

	<div class="linha" style="">  
		<div class="btpay">   
			 <div class="btpagamento">
				<a href="javascript:enviapag_normal();">
					<img src="<?=$PATHSKIN?>/images/<?=$GATEWAY?>.png"  border="0" /> 
				</a> 
			</div>
		</div>
	</div>  
		 
	<form  target="_blank" action="https://www.paypal.com/cgi-bin/webscr" name="formpg" id="formpg"  method="post">

		<input type="hidden" readonly="readonly" name="cmd" value="_xclick">
		<input type="hidden" readonly="readonly" name="lc" value="<?php echo $INI['paypal']['loc']; ?>"> 
		<input type="hidden" readonly="readonly" name="business" value="<?php echo $INI['paypal']['mid']; ?>">
 
		<input type="hidden" readonly="readonly" id="item_name_1" name="item_name" value="">
		<input type="hidden" readonly="readonly" id="item_number_1" name="item_number" value="<?php echo  $idanuncio; ?>">
		<input type="hidden" readonly="readonly" id="amount_1" name="amount" value="">

		<!--<input type="hidden" readonly="readonly"  name="shipping" value="">-->
		<input type="hidden" readonly="readonly" name="first_name" value="<?=$login_user['realname']?>">
		<input type="hidden" readonly="readonly" name="last_name" value="<?=$login_user['realname']?>">
		<input type="hidden" readonly="readonly" name="address1" value="<?=$login_user['address']?>">
		<input type="hidden" readonly="readonly" name="address2" value="<?=$login_user['bairro']?>">
		<input type="hidden" readonly="readonly" name="city" value="<?=$login_user['cidadeusuario']?>">
		<input type="hidden" readonly="readonly" name="tax_id" value="<?=$login_user['cpf']?>">
		<input type="hidden" readonly="readonly" name="state" value="<?=$login_user['estado']?>">
		<input type="hidden" readonly="readonly" name="zip" value="<?=$login_user['zipcode']?>">
		<input type="hidden" readonly="readonly" name="H_PhoneNumber" value="<?=$login_user['mobile']?>">
		<input type="hidden" readonly="readonly" name="email" value="<?=$login_user['email']?>">
		  <INPUT TYPE="hidden" readonly="readonly" NAME="return" value="<?php echo $INI['system']['wwwprefix']?>">  
		<input type="hidden" readonly="readonly" name="currency_code" value="<?php echo $INI['paypal']['loc']; ?>"> 
		 
		<input type="hidden" readonly="readonly" name="rm" value="2" /> 
		<!-- <input type="hidden" readonly="readonly" name="notify_url" value="<?php echo $INI['system']['wwwprefix']?>/pedido/paypal/retorno.php" /> -->
		<input type="hidden" readonly="readonly" name="transaction_subject" value="" />
	</form>

<? } ?>
 
 
<!-- MERCADO  PAGO -->
<? 
$GATEWAY = 'mercadopago';
if($INI['credito']['metodo_pagamento'] =="mercadopago"){ ?>

	<div class="linha" style="">  
		<div class="btpay">   
			 <div class="btpagamento">
				<a href="javascript:enviapag_normal();">
					<img src="<?=$PATHSKIN?>/images/<?=$GATEWAY?>.png"  border="0" /> 
				</a> 
			</div>
		</div>
	</div> 
		
	<form   target="_blank"  id="formpg"  name="formpg"  action="https://www.mercadopago.com/mlb/buybutton" method="post">
	  <input type="hidden" readonly="readonly" name="acc_id" value="<?=$INI['mercadopago']['acc_id']?>">      
	  <input type="hidden" readonly="readonly" name="enc" value="<?php echo $INI['mercadopago']['enc']; ?>">	
	  <input type="hidden" name="token" value="<?php echo $INI['mercadopago']['token']; ?>">   
	  <input type="hidden" readonly="readonly" id="item_id"  name="item_id" value="<?php echo  $idanuncio; ?>">  
	  <input type="hidden" readonly="readonly" id="name"  name="name" value="">  
	  <input type="hidden" readonly="readonly" name="currency" value="REA">  
	  <input type="hidden" readonly="readonly" id="price" name="price" value="">   
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
	  <input type="hidden" readonly="readonly" name="seller_op_id" value="<?php echo  $idanuncio; ?>">
		 
	</form>

<? } ?>