<?php include template("manage_header");?>

<div id="bdw" class="bdw">
<div id="bd" class="cf">
<div id="partner"> 
	<div id="content" class="clear mainwide">
        <div class="clear box">
            <div class="box-top"></div>
            <div class="box-content"> 
                <div class="sect">
                    <form method="post">
					<!-- ********************************************* ABA PAGSEGURO --> 
					<div class="option_box"> 
						<div class="top-heading group"> <div class="left_float"><h4>Gateway de Pagamento</h4> </div>
							<div class="the-button"> 
								<button onclick="doupdate();" id="run-button" class="input-btn" type="button">
									<div name="spinner-top" id="spinner-top" style="width: 83px; display: block;"><img name="imgrec" id="imgrec" src="<?=$ROOTPATH?>/media/css/i/lendo.gif" style="display: none;"></div>
									<div id="spinner-text"  >Salvar</div>
								</button>
							</div> 
						</div> 
					 
						<div id="container_box">
							<div id="option_contents" class="option_contents"> 
							   <!--
								<div class="form-contain group"> 
										<div class="starts">  
										   <div id="mail-zone-div" style="float:left; width:100%; margin-top: 15px;margin-bottom:11px;">
												<span class="report-label">Escolha o método de pagamento:</span>  
												 
												<input style="width:20px;" type="radio" onclick="mostrar(this.value);" <? if($INI['credito']['metodo_pagamento'] =="pagseguro" ){ echo "checked=checked"; }?> value="pagseguro" name="credito[metodo_pagamento]"> Pagseguro  
												<input style="width:20px;" type="radio" onclick="mostrar(this.value);" <? if($INI['credito']['metodo_pagamento'] =="paypal"){ echo "checked=checked"; }?> value="paypal" name="credito[metodo_pagamento]" > Paypal  
												 
												<input style="width:20px;" type="radio" onclick="mostrar(this.value);" <? if($INI['credito']['metodo_pagamento'] =="mercadopago" or $INI['credito']['metodo_pagamento'] ==""){ echo "checked=checked"; }?> value="mercadopago" name="credito[metodo_pagamento]" > Mercado Pago  
											</div> 	 
										</div>  
								</div> 
								-->
								
								<div id="option_contents" class="option_contents">  
									<div class="form-contain group">  
										<div class="starts">   
											<div id="url_botao_comprar"> 
													<div class="report-head">Token do Mercado Pago: <span class="cpanel-date-hint"> </span></div>
													<div class="group">
														<input type="text"  name="mercadopago[token]" value="<?php echo $INI['mercadopago']['token'] ?>">  
													</div> 
													<b> O token é algo parecido como:</b> APP_USR-5170885210680441-091313-6b88b8ba365b5fb689612589395539f7-2629965
													
													<div class="report-head">Public Key: <span class="cpanel-date-hint"> </span></div>
													<div class="group">
														<input type="text"  name="mercadopago[publickey]" value="<?php echo $INI['mercadopago']['publickey'] ?>">  
													</div> 
														<b> O Public Key é algo parecido como:</b> APP_USR-efe1bdde-0c71-4a31-af63-ae63950ac3dd
														
													 
											</div>	 
										</div> 
										<div class="ends"> 
										
										Para gerar seu token do mercado pago, acesse sua conta ou cadastre grátis em <a target="_blank" href="https://www.mercadopago.com.br/"> <b>mercadopago.com.br</b></a> <br><br>
										No menu esquerdo, clique em "<B>seu negócio</B>" depois em "<B>Configurações</B>", faça o login de segurança e preencha algumas informações básicas.<br>
										No campo Plataforma, informe "<B>Outras</B>", ao gerar as credencias, serão geradas 4 chaves. <br><br>Copie a chave "<B>Access Token</B>" (segunda chave. Depois de copiar Access Token, cole no campo "<B>Token do Mercado Pago</B>" no lado esquerdo desta página e salve.
										Depois copie também a chave Public Key e cole no campo Public Key aqui do lado.
										
										Segue um vídeo para lhe ajudar https://www.youtube.com/watch?v=w7kyGZUrkVY
										
										</div>  
									</div> 
								</div>
									
									
							
						<!-- 
						<div class="ends"><? if(!file_exists(WWW_MOD."/pagseguro.inc")) {?> <h1><a target="_blank"  href="https://www.tkstore.com.br/whmcs/cart.php?a=add&pid=625">Clique aqui</a> e adquira o plugin de atualização automática do pagseguro <span class="cpanel-date-hint"> </h1> <div class="group">  Os pedidos do site aprovados automaticamente pelo pagseguro</div>	 <? }?>	 			 
						  </div> 
						  -->
					</div> 
				</div>
			</div> 

						 
			  
					</div>  
			     
                 </form>
                </div>
            </div>
            <div class="box-bottom"></div>
        </div>
	</div>

<div id="sidebar">
</div>

</div>
</div> <!-- bd end -->
</div> <!-- bdw end -->
 <script>
	function validador(){
		return true;
	}	
	 
 
</script>