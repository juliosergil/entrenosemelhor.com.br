<?php

// $tokenPagBank = '46d0513f-7bfb-4756-b645-ac54de6590c5da1b6eff41e6b1d3d44f753af86733f7e454-b1df-43f4-a601-aebe7f7690d1';
//$tokenPagBank = 'F953F31867914906B70DD26245A7F8B3';
// $tokenPagBank = '665b73bf-c9d3-4196-abf4-a56cd364e6ef5b4dfa5e47409d58541dd064d2f675fc996d-94ff-4b3f-8bfd-a67204458e6c';
//$tokenMercadoPago = 'TEST-1824143023728390-111015-ee749c8cb9d43c5a66ed70797cf44f16-114741296';


$tokenPagBank =  $INI['pagseguro']['pagseguro'];
$tokenMercadoPago = $INI['mercadopago']['token'] ;

$nomeproduto = "Compra no site ".$INI['system']['sitename'];

?>


<div style="display:none;" class="tips"><?= __FILE__ ?></div>
<style>
	.buy-button.btn-success .icon.small,
	.sellers-list-item:hover .buy-button .icon.small {
		top: 17px;
	}
	
 
	[type=button]:not(:disabled), [type=reset]:not(:disabled), [type=submit]:not(:disabled), button:not(:disabled) {
	   width: 199px !important;
	}
 
 .btn,
	.noUiSlider div {
		padding: 0;
	}

	.buy-button .text {
		padding-left: 0; 
		  color: #fff; 
		font-size: 22px;
	
	}

	.buy-button {
		height: 57px;
	}

	.my-cart-product-wrapper {
		border-top: 1px solid #e4e4e4;
	} 
</style>
<section id="content" class="content">
	<div class="main-content clearfix">
		<section class="main-content my-cart" style="min-height:0px;">
			<div>
				<div class="page-title-car clearfix">
				</div>
				<article class="my-cart-box">
					<header>
						<ul class="my-cart-header-wrapper clearfix">
							<h2 class="text-center">Formas de Pagamento <span class="my-cart-header-items"> </span></h2>
						</ul>
					</header>
					<ul class="my-cart-content-wrapper">
						<li class="my-cart-content-item linhaItem" style="display:none;">


							<!-- DUPLICAR ESTE BLOCO PARA OS BOTOES DO PAGSEGURO E MERCADO PAGO -->

							<ul class="my-cart-product-wrapper clearfix">
								<li class="my-cart-product-item my-cart-product-description col-md-6 col-xs-12 col-sm-12 text-center">
									<figure class="product-list-image"> </figure>
									<div class="product-list-item">
										<div>
											<div> <img src="<?= $PATHSKIN ?>/images/pagamento_entrega.png" border="0" /></div>
										</div>
									</div>
								</li>
								<li class="my-cart-product-item my-cart-product-price"> </li>
								<li class="my-cart-product-item my-cart-product-quantity col-md-6 col-xs-12 col-sm-12 text-center">
									<div class="buy-button-wrapper">
										<a class="">
											<button type="button" class="buy-button btn btn-success pg-entrega">
												<span class="icon small"></span><span class="text">Pagar na entrega do produto</span>
											</button>
										</a>
									</div>
								</li>
								<li class="my-cart-product-item my-cart-product-subtotal my-cart-product-price totalItem"> </li>
							</ul>

							<!-- FIM BLOCO -->

						</li>

						<!-- pagseguro -->
						<? if($tokenPagBank){?>
						
							<li class="my-cart-content-item linhaItem" style="">
								<!-- DUPLICAR ESTE BLOCO PARA OS BOTOES DO PAGSEGURO E MERCADO PAGO -->

								<ul class="my-cart-product-wrapper clearfix">
									<li class="my-cart-product-item my-cart-product-description col-md-6 col-xs-12 col-sm-12 text-center">
										<figure class="product-list-image"> </figure>
										<div class="product-list-item">
											<div>
												<div> <img src="<?= $PATHSKIN ?>/images/pagrecorte.png" style=" width: 180px; object-fit: contain;" border="0" /></div>
											</div>
										</div>
									</li>
									<li class="my-cart-product-item my-cart-product-price"> </li>
									<li class="my-cart-product-item my-cart-product-quantity col-md-6 col-xs-12 col-sm-12 text-center">
										<div class="buy-button-wrapper">
											<a class="">
												<button type="button" class="buy-button btn btn-success pg-pagbank">
													<span class="icon small"></span><span class="text">Pagar com PagBank</span>
												</button>
											</a>
										</div>
									</li>
									<li class="my-cart-product-item my-cart-product-subtotal my-cart-product-price totalItem"> </li>
								</ul>

								<!-- FIM BLOCO --> 
							</li>
						
						<? } ?>

						<!-- mercadopago -->
						<? if($tokenMercadoPago){?>
							
							<li class="my-cart-content-item linhaItem"> 
								<!-- DUPLICAR ESTE BLOCO PARA OS BOTOES DO PAGSEGURO E MERCADO PAGO -->

								<ul class="my-cart-product-wrapper clearfix">
									<li class="my-cart-product-item my-cart-product-description col-md-6 col-xs-12 col-sm-12 text-center">
										<figure class="product-list-image"> </figure>
										<div class="product-list-item">
											<div>
												<div> <img src="<?= $PATHSKIN ?>/images/mercadopago.png" style=" width: 180px; object-fit: contain;" border="0" /></div>
											</div>
										</div>
									</li>
									<li class="my-cart-product-item my-cart-product-price"> </li>
									<li class="my-cart-product-item my-cart-product-quantity col-md-6 col-xs-12 col-sm-12 text-center">
										<div class="buy-button-wrapper">
											<a class="">
												<button type="button" class="buy-button btn btn-success pg-mercadopago">
													<span class="icon small"></span><span class="text">Pagar  </span>
												</button>
											</a>
										</div>
									</li>
									<li class="my-cart-product-item my-cart-product-subtotal my-cart-product-price totalItem"> </li>
								</ul>

								<!-- FIM BLOCO --> 
							</li>
						
						<? } ?>
			
						  <!-- PIX -->
						  <?php if($INI["credito"]["chave_pix"] and  file_exists(WWW_MOD."/pix.inc") ){  
								$valorpix = ($order['price'] - $team["bonuslimite"]) + $valorfrete; 
							?>
							<li class="my-cart-content-item linhaItem">  
									<iframe name="pixplanos" id="pixplanos" frameborder="0" height="600" width="100%" scrolling="no" src="<?=$ROOTPATH?>/pix/pix_planos.php?valor=<?=$valorpix?>" id="layout"></iframe>  
							  
							</li>
						
						<? } ?>
						
					</ul>

				</article>
			</div>
		</section>
	</div>
</section>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
	jQuery(".pg-entrega").click(function() {
		var order = <?= $order_id ?>;
		alert("Pedido realizado com sucesso. Aguarde enquanto o redirecionamos para a Home.");
		location.href = "<?php echo $INI['system']['wwwprefix'] ?>/include/funcoes.php?acao=pagamentoentrega&orderid=" + order;
	});



	jQuery(".pg-pagbank").click(function() {

		// alerta carregamento
		Swal.showLoading()

		preco = $("#preco").val();
		frete = $("#frete").val();
		
		if(frete==""){
			frete="0.00";
		}
		
		if(preco==""){
			alert("O preço total do pedido está vazio, verifique input hidden preco no arquivo pedido");
			return false;
		}
		
		nomeproduto = '<?= $nomeproduto ?>'
		tokenPagBank = '<?= $tokenPagBank ?>'
		$.post('app/design/padrao/bloco/pagseguro.php', {
				preco,
				tokenPagBank,
				nomeproduto,
				frete
			},

			function(retorno) {
				//   console.log(retorno);
				if (retorno == 0) {
					Swal.fire({
						icon: "error",
						title: 'Ocorreu um problema. Tente novamente.',
					})
				} else {
					var link = document.createElement("a");
					link.href = retorno;
					link.target = "_blank";
					link.click();
					Swal.fire({
						icon: "success",
						title: 'Vamos te redirecionar para a pagina de pagamento!',
					})
				}

			})
	});

	jQuery(".pg-mercadopago").click(function() {

		// alerta carregamento
		Swal.showLoading()

		preco = jQuery("#preco").val()
		frete = jQuery("#frete").val()
		
		if(frete==""){
			frete="0.00";
		}
		
		if(preco==""){
			alert("O preço total do pedido está vazio, verifique input hidden preco no arquivo pedido");
			return false;
		}
		
		nomeproduto = '<?= $nomeproduto ?>'
		tokenMercadoPago = '<?= $tokenMercadoPago ?>'
 
		jQuery.post('app/design/padrao/bloco/mercadopago/payment.php', {
				preco,
				frete,
				nomeproduto,
				tokenMercadoPago
			},

			function(retorno) {
				//   console.log(retorno);
				if (retorno == 0) {
					alert('Ocorreu um problema.')
				} else {
					// alert('Vamos te redirecionar para a pagina de pagamento!')
					// window.open(location.href = retorno, '_blank');
					
					var link = document.createElement("a");
					link.href = retorno;
					link.target = "_blank";
					link.click();
					Swal.fire({
						icon: "success",
						title: 'Vamos te redirecionar para a pagina de pagamento!',
					})
				}

			})
	});
</script>