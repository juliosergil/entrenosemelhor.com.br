<!-- Integração Mercado Pago -->
<script src="https://sdk.mercadopago.com/js/v2"></script>
<script>
   if('<?php echo $INI['mercadopago']['publickey']; ?>' == ""){
	   //alert(" O campo publickey está vazio, acesse a administração no menu Sistema->gateway de pagamento e informe ");
   } 
   
   if('<?php echo $_REQUEST['preference_id'] ?>' == ""){
	   //alert(" Preference_id não foi gerado  ");
   } 
   
   else{
   
		const PUBLIC_KEY = '<?php echo $INI['mercadopago']['publickey']; ?>';
		
		const mp = new MercadoPago(PUBLIC_KEY);
		const bricksBuilder = mp.bricks();

		const url = new URL(location.href);
		const params = url.searchParams;

		bricksBuilder.create('wallet', 'wallet_container', {
			initialization: {
				preferenceId: params.get('preference_id'),
			},
			customization: {
				texts: {
					valueProp: 'smart_option',
				},
			},
		});
   }
</script>
<!-- Fim Integração Mercado Pago -->
 
<style>
button.svelte-1fupiv9 .text-container-2n9LKW span.svelte-1fupiv9 {
    font-size: 18px !important; 
    color: #fff !important;
}
button, .form-button {
    background: unset !important;
}
  
report-head { 
    font-size: 13px;  
}
</style>