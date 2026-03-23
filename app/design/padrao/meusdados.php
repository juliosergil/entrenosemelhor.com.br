	<?php  
		require_once("include/code/meusdados.php");
		require_once("include/head.php"); 
	?>
	<body id="page1"> 
		<style>
		/*celular*/
			@media screen and (max-width: 767px) { 

			}

			/*desktop*/
			@media screen and (min-width: 768px) {

			 	.form-group {
					width: 50% !important;
				}
			}

		
		</style>
		<script type="text/javascript" src="<?=$ROOTPATH?>/js/include_select_css.js"></script>

		<script>
		  
			function update(){
					 
				if(J("#meusdados_password").val() != "" & J("#meusdados_password2").val() == ""){
					alert("Por favor, repita a senha ou deixe os campos em branco para n&atilde;o alterar.")
					document.getElementById("meusdados_password").focus();
					return;
				}
				if(J("#meusdados_password").val() != J("#meusdados_password2").val()){
					alert("As senhas n&atilde;o conferem. Caso n&atilde;o queira alterar as senhas, deixe-as em branco.")
					document.getElementById("meusdados_password2").focus();
					return;
				}
				 
			  // dados de enrede�o
				 
				if(J("#cep_").val() == ""){

					alert("Por favor, informe seu cep.");
					jQuery("#loading").hide();
					document.getElementById("cep_").focus();
					return;
				}
				 if(J("#endereco_").val() == ""){

					alert("Por favor, informe seu endereco.");
					jQuery("#loading").hide();
					document.getElementById("endereco_").focus();
					return;
				} 
				/*
				if(J("#ddd_").val() == ""){

					alert("Por favor, informe o DDD.");
					jQuery("#loading").hide();
					document.getElementById("ddd_").focus();
					return;
				}
				*/
				if(J("#numero_").val() == ""){

					alert("Por favor, informe o n&uacute;mero.");
					jQuery("#loading").hide();
					document.getElementById("numero_").focus();
					return;
				}
				if(J("#bairro_").val() == ""){

					alert("Por favor, informe seu bairro.");
					jQuery("#loading").hide();
					document.getElementById("bairro_").focus();
					return;
				}
				if(J("#cidadeusuario_").val() == ""){

					alert("Por favor, informe sua cidade.");
					jQuery("#loading").hide();
					document.getElementById("cidadeusuario_").focus();
					return;
				}
				if(J("#estado_").val() == ""){

					alert("Por favor, informe seu estado.");
					jQuery("#loading").hide();
					document.getElementById("estado_").focus();
					return;
				}	
				if(J("#telefone_").val() == ""){

					alert("Por favor, informe seu telefone.");
					jQuery("#loading").hide();
					document.getElementById("telefone_").focus();
					return;
				}
			
				J("#formcadupdate").submit();					 
			}
			
			
		function getEndereco() {
		 
				// Se o campo CEP n�o estiver vazio
				if(J.trim(J("#cep_").val()) != ""){
					/* 
						Para conectar no servi�o e executar o json, precisamos usar a fun��o
						getScript do jQuery, o getScript e o dataType:"jsonp" conseguem fazer o cross-domain, os outros
						dataTypes n�o possibilitam esta intera��o entre dom�nios diferentes
						Estou chamando a url do servi�o passando o par�metro "formato=javascript" e o CEP digitado no formul�rio
						http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep="+J("#cep").val()
					*/
					J.getScript("http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep="+J("#cep_").val(), function(){
						// o getScript d� um eval no script, ent�o � s� ler!
						//Se o resultado for igual a 1
						if(resultadoCEP["resultado"]){
							// troca o valor dos elementos
							J("#endereco_").val(unescape(resultadoCEP["tipo_logradouro"])+"  "+unescape(resultadoCEP["logradouro"]));
							J("#bairro_").val(unescape(resultadoCEP["bairro"]));
							J("#cidadeusuario_").val(unescape(resultadoCEP["cidade"]));
							J("#estado_").val(unescape(resultadoCEP["uf"]));
						}else{
							alert("Endere�o n�o encontrado");
						}
					});				
				}			
		}

		jQuery(document).ready(function(){
		  // J("#date").mask("99/99/9999");
		 // jQuery("#telefone_").mask("(99) 9999-9999");
		   //J("#").mask("99-9999999");
		   //J("#ssn").mask("999-99-9999");
		 //  jQuery("#cpf").mask("999999999-99");
		 //  jQuery("#cep_").mask("99999999");
		  // jQuery("#estado_").mask("aa");
		});
		 
		</script>
		<div class="tail-top"> 
			<div style="display:none;" class="tips"><?=__FILE__?></div>		
			<div >
				<?php  require_once(DIR_BLOCO."/header.php"); ?>
				<section id="content">
					<div class="title-page corpreto">
						<i class="fa fa-cogs" aria-hidden="true"></i> Meus dados
					</div>
					<div class="row">
					  <div class="col-md-12 container">
							<div class="content-page">
								<form id="formcadupdate" name="formcadupdate" method="post" action="">
									<div class="form-group">
										<label>
											Nome:
										</label>
										<input name="realname" class="form-control"  style="width:97%" type="text"   id="realname" onFocus="if(this.value =='Insira seu nome' ) this.value=''" onBlur="if(this.value=='') this.value='Insira seu nome'" value="<?php echo  utf8_decode($login_user['realname']) ; ?>">
									</div>							
									<div class="form-group">
										<label>
											Email:
										</label>
										<input name="email" class="form-control" style="width:97%" type="text"  id="email" onFocus="if(this.value =='Insira seu e-mail' ) this.value=''" onBlur="if(this.value=='') this.value='Insira seu e-mail'" value="<?php echo $login_user['email']; ?>" readonly="readonly">
									</div>								
									<div class="form-group">
										<label>
											Senha:
										</label>
										<input name="meusdados_password" class="form-control" style="width:97%" type="password"   id="meusdados_password">
									</div>							
									<div class="form-group">
										<label>
											Digite a senha novamente:
										</label>
										<input name="meusdados_password2"  class="form-control" style="width:97%" type="password"   id="meusdados_password2"   />
									</div>								
									<div class="form-group">
										<label>
											CEP:
										</label>
										<input class="form-control" style="width:97%" value="<?=$login_user['zipcode']?>" onKeyPress="return SomenteNumero(event);" name="cep_"  onblur="getEndereco();" type="text" id="cep_">
									</div>							
									<div class="form-group">
										<label>
											Endere&ccedil;o:
										</label>
										<input class="form-control" style="width:97%" name="endereco_" value="<?=utf8_decode($login_user['address'])?>"  type="text" id="endereco_">
									</div>								
									<div class="form-group">
										<label>
											N&uacute;mero:
										</label>
										<input class="form-control" style="width:97%" value="<?=$login_user['numero']?>" name="numero_"   type="text" id="numero_">
									</div>							
									<div class="form-group">
										<label>
											Complemento:
										</label>
										<input class="form-control" style="width:97%" value="<?=utf8_decode($login_user['complemento'])?>"name="complemento_"   type="text" id="complemento_">
									</div>								
									<div class="form-group">
										<label>
											Bairro:
										</label>
										<input class="form-control" style="width:97%" name="bairro_"  value="<?=utf8_decode($login_user['bairro'])?>" type="text" id="bairro_">
									</div>							
									<div class="form-group">
										<label>
											Cidade:
										</label>
										<input class="form-control" style="width:97%" value="<?=utf8_decode($login_user['cidadeusuario'])?>"  name="cidadeusuario_"   type="text" id="cidadeusuario_">
									</div>								
									<div class="form-group">
										<label>
											Estado:
										</label>
										<input class="form-control"  style="width:97%" name="estado_"  value="<?=strtoupper($login_user['estado'])?>" type="text" id="estado_">
									</div>							
									<div class="form-group">
										<label>
											Telefone:
										</label>
										<input class="form-control" style="width:97%" value="<?=$login_user['mobile']?>" name="telefone_" type="text" id="telefone_">
									</div>													
									<div class="form-group ">
										<a href="javascript:update();"  class="link-1 btAnunciar d-block   ">
											<em> 
													Atualizar dados 
											</em>
										</a>
									</div>
								</form>
							</div>
						</div>
					</div>		
				</section>
				<?php
					require_once(DIR_BLOCO."/rodape.php");	
				?>
			</div>
		</div> 		
	</body>
</html>