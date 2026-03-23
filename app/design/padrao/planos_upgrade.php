	<style>	
	 
		.title-page { 
			color:#303030 !important;
		}
		.btn.btn-highlight a,
		.btn.btn-close {
			background: #38b;
			color: #FFF;
			text-decoration: none;
			font-weight: bold;
			text-transform: uppercase;
			padding: 10px;
			border-radius: 3px;
			margin-top: 55px;
			float: right;
			margin-right: 5px;
		}
	 
		span.featured {
			color: red;
			text-decoration: underline;
			font-weight: bold;
		}
		 
	</style>	
	<?php 
		require_once("include/head.php"); 
	?>
	<link href='<?php echo $PATHSKIN; ?>/css/planos.css' rel='stylesheet' type='text/css'>
	<body id="page1">
		<div class="tail-top"> 
			<div style="display:none;" class="tips"><?=__FILE__?></div>		
			<div >
				<?php  require_once(DIR_BLOCO."/header.php"); ?>
				<section id="content">
					<!-- <div class="title-page" style="float=left;">
						1. Escolha o an&uacute;ncio que deseja destacar
					</div>
					-->					
					<div class="content-page">	
						<?php  require_once(DIR_BLOCO . "/lista_anuncios_usuarios.php"); ?>
					</div>
					
					<div class="content-list-offer" id="choose-plan">
						<div class="title-page">
							2. Escolha o seu plano
						</div>
						<div class="list-offer">
							<?php 							
								$sqlplanos = "select * from planos_publicacao where ativo = 's' order by id";
								$rsplanos = mysqli_query(DB::$mConnection,$sqlplanos);
								
								while($row = mysqli_fetch_array($rsplanos)){
									
									$valor_plano = explode(".", $row['valor']);
							?>
							<div class="col-md-3">
								<div class="pricing hover-effect">
									<div class="pricing-head">
										<h3 style="background: ;border-bottom:1px solid ">
											<?php echo utf8_decode($row['nome']); ?>
										</h3>
										<h4>
											<i>
												R$
											</i>
											<?php echo $valor_plano[0]; ?><i>,<?php echo $valor_plano[1]; ?></i>
										</h4>
									</div>
									<ul class="pricing-content list-unstyled">
										<li>
											<?php echo utf8_decode($row['texto']); ?>
										</li>									
										<li>
											<?=utf8_decode("Período de publicação")?>: <?php echo $row['dias'] . " dias";?>
										</li>
									</ul>
									<div class="pricing-footer btn_assine" id="btn_assine" data-nome="<?=utf8_decode($row['nome'])?>" data-idplano="<?=utf8_decode($row['id'])?>">
										<a href="#" class="btn yellow-crusta btn-buy-plan" attr-name="<?=utf8_decode($row['nome'])?>" attr-info="<?=$row['id']?>##<?=$row['valor']?>##<?=empty($row['gratis']) ? 'n' : 's'; ?>"  value="<?=$row['id']?>##<?=$row['valor']?>##<?=empty($row['gratis']) ? 'n' : 's'; ?>"> 
											ADQUIRIR
										</a>
									</div>
								</div>
							</div>
							<?php } ?>						
						</div>
					</div>
				  
				  		
					<div class="content-list-offer" id="resume">
						<div class="title-page">
							<?=utf8_decode("3. Confirmação")?>
						</div>
						<div class="list-offer">
							<div id="text-resume"></div>
						</div>
						<a href="#" class="btn btn-close" id="btn-close"> 
							Finalizar
						</a>
					</div>
					
				</section>
				 <!-- recomendados pra voce -->
				 	<!--Galeria premium-->
				<div class="adpremium">
					<?php
						require_once(DIR_BLOCO . "/galeria_premium.php");
					?>  
				</div>
					
				<div class="adrecomendados">
				  
					<?php
						require_once(DIR_BLOCO . "/recomendados.php");
					?> 
				  
				</div>
				
				<?php
					require_once(DIR_BLOCO."/rodape.php");	
				?>
			</div>
		</div> 
		<form id="pagseguro" name="pagseguro"  method="post" sid="<?php echo $team_id; ?>" action="https://pagseguro.uol.com.br/checkout/checkout.jhtml">
			<input type="hidden" readonly="readonly" name="email_cobranca" value="<?php echo $INI["pagseguro"]["acc"]; ?>">
			<input type="hidden" readonly="readonly" name="tipo" value="CP">
			<input type="hidden" readonly="readonly" name="moeda" value="BRL">
			<input type="hidden" readonly="readonly" id="ref_transacao" name="ref_transacao" value="">
			<input type="hidden" readonly="readonly" id="reference" name="reference" value="">
			<input type="hidden" readonly="readonly" id="item_id_1" name="item_id_1" value="">
			<input type="hidden" readonly="readonly" id="item_descr_1" name="item_descr_1" value="">
			<input type="hidden" readonly="readonly" id="item_quant_1" name="item_quant_1" value="1">
			<input type="hidden" readonly="readonly" id="item_valor_1" name="item_valor_1" value="">  
			  <!-- Dados do comprador (opcionais) -->  
			<input type="hidden" name="senderName" value="<?=$login_user['realname']?>">  
			<input type="hidden" name="senderEmail" value="<?=$login_user['email']?>">  
			
			<!-- Informa��es de frete (opcionais) -->  
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
	</body>
	<script>   
		var www = '<?php echo $ROOTPATH; ?>';
		var team_id = '<?php echo $idpedido; ?>';
		var gratis="";
		var idpagamento="";
		
		function fecharanuncio(plano){
			
			//plano  = jQuery(this).attr('attr-info');
			
			//console.log(jQuery(this));
		  
			planoarr = plano.split('##');	 
			idplano = planoarr[0];
			valor = planoarr[1];
			gratis = planoarr[2]; 

			if(gratis=="s"){ 
				idpagamento =  team_id;
				finalizaanuncio('<?php echo $idparceiro; ?>',idpagamento,gratis);
			}
			else{
				alert('Este anúncio não � gr�tis. Por favor, escolha um plano gr�tis.');
			}	 
		}

		var idplano;
		function mostravalor(plano){
			 //plano  = $("input[name='planos_publicacao']:checked").val();
		 
			 planoarr = plano.split('##');
			 
			 idplano = planoarr[0];
			 valor = planoarr[1];
			 gratis = planoarr[2];
				 
			descricao = "Pagamento de Plano - R$ "+valor; 	 
			jQuery("#valoranuncio").val(valor); 
			jQuery("#item_descr_1").val(descricao);  
			jQuery("#reference").val(idplano); 
			jQuery("#ref_transacao").val(idplano);  
			jQuery("#item_id_1").val(idplano);  
			jQuery('#item_valor_1').val(valor)
			 
			//mercado pago
			//jQuery("#name").val(descricao); 
			//jQuery('#price').val(valor)
			
			 
			if(gratis=="s"){
				 
				 jQuery('.termo_uso').fadeOut('slow', function() {
				   jQuery('.termo_uso').hide()
				 }); 
				 
				 jQuery('.botaogratis').fadeIn('slow', function() {
				 $jQuery('.botaogratis').show()
				 });
				 
			}
			else{
				
				jQuery('.botaogratis').fadeOut('slow', function() {
					jQuery('.botaogratis').hide()
				}); 

				jQuery('.termo_uso').fadeIn('slow', function() {
					jQuery('.termo_uso').show()
				});			  
			}
			
			document.getElementById('pagseguro').submit();
		}
					  
		function enviapag_normal(valorform){
			
		   Valor	 	=  jQuery('#item_valor_1').val();
		   idanuncioA	 	=  jQuery('#item_id_1').val();
		   
			if(Valor==""){
					campoobg("valoranuncio");
					alert("Por favor, escolha um plano para o an�ncio");
					jQuery("#valoranuncio").focus();
					return;
			}   
			 // gravando o idplano
			 jQuery.get(www+"/include/funcoes.php?acao=grava_id_plano&id_plano="+idplano+"&team_id=" + idanuncioA,
			  function(data){
				  if(jQuery.trim(data)!=""){ 
						alert(data)
				 }
				else{ 
					 jQuery("#"+valorform).submit();
				}		 
			   }); 
		}

		 function finalizaanuncio(idcliente,idPedido,gratis){
			if(gratis!="s"){
					alert('Este an�ncio n�o � gr�tis. Por favor, escolha um plano gr�tis.');
			}
			else{
				 
				Valor =  jQuery('#valoranuncio').val();
				 
			   jQuery.get(www+"/include/funcoes.php?acao=finalizaanuncio&user_id="+idcliente+"&idpedido="+idPedido+"&valor="+Valor+"&idplano="+idplano+"&team_id="+team_id ,
			   function(data){
				  if(jQuery.trim(data)!=""){ 
						alert(data)
				 }
				 else{
					window.alert('An�ncio finalizado com sucesso!');
					  location.href = www+"/adminanunciante/";
				}
			   });  
			}
		}

		jQuery(".plan-container").click(function(){
			var id = jQuery(this).attr("data-val");
			jQuery("#planos_publicacao_"+id).attr('checked', 'checked');
			mostravalor();
		});
	</script>
	
	<script>
		(function(){
		
			const userId        = '<?php echo empty($login_user['id']) ? "" : $login_user['id']; ?>';
			const planOptions   = document.querySelectorAll('.btn-buy-plan');	
			const btnHighlight  = document.querySelectorAll('.btn-highlight');	
			
			const choosePlan      = document.getElementById('choose-plan');
			const resume	      = document.getElementById('resume');
			const textResume      = document.getElementById('text-resume');
			
			let attrDescription   = '';
			let attr              = '';
			
			const itemId          = document.getElementById('item_id_1');
			
			const btnClose        = document.getElementById('btn-close');

			choosePlan.style.display = 'none';	
			resume.style.display 	 = 'none';	
			
			function submitPermission(userId) {
				
				if(userId == "") {
				
					Array.from(planOptions).forEach(function(element) {
						
						element.classList.add('tk_logar');
					});
					
					return false;
				}
				else {
					
					return true;
				}
			}

			if(submitPermission(userId)) {
				
				/* Escolha do an�ncio para destacar */			
				Array.from(btnHighlight).forEach((element) => {
					
					element.addEventListener('click', function(e) {
						
						e.preventDefault();
						
						const attrId 		  = parseInt(e.target.getAttribute('attr-id'));
						attrDescription   	  = e.target.getAttribute('attr-description');
						
						itemId.value = attrId;
						choosePlan.style.display = 'block';
						choosePlan.scrollIntoView();
					});
				});
				
				/* Escolha do plano */			
				Array.from(planOptions).forEach((element) => {
					
					element.addEventListener('click', function(e) {						
			
						let attrName = this.getAttribute('attr-name');
						attr = this.getAttribute('attr-info');
						
						/* Descri��o do an�ncio escolhido */
						textResume.innerHTML = '<div style="font-size: 18px; text-align: center;"> Foi feito o upgrade do an&uacute;ncio: <span class=\'featured\'>\'' + attrDescription + '</span>\'  utilizando o plano: \'<span class=\'featured\'>' + attrName + '</span>\'.<br> Clique em finalizar para realizar o pagamento.</div>';
						resume.style.display = 'block';
						resume.scrollIntoView();
					});		
				});
				
				/* Finaliza��o do upgrade */
				btnClose.addEventListener('click', (e) => {
					
					e.preventDefault();
					
					if(attr.split('##')[2] == 's') {
						
						fecharanuncio(attr);
					}
					else {
						
						mostravalor(attr);
					}				
				});	
			}			
		}());
	</script>
</html>