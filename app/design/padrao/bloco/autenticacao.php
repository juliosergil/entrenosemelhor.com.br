<div style="display:none;" class="tips"><?=__FILE__?></div>

<?php  
require_once(dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/app.php');
?> 

<!-- Modal login -->
   <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
		
			<div class="modal-content">	
				<div class="modal-header">
						<h3 class="modal-title">Fazer Login</h3>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
				</div>		
				<div class="modal-body">
					<form method="POST" id="formauth" style="">
							<div style="float: left; margin-right:5px;"> 
								<input class="inputmodal" type="text"  placeholder="Informe seu e-mail"  id="email" name="email">
							</div>
							<div style="float: left;margin-right:5px;"> 
								<input class="inputmodal" type="password" placeholder="Informe sua senha"  id="password" name="password">
							</div>
							<div style="float: left;  margin-top: -7px;">
								<a class="link-1 btAnunciar js-scroll-trigger" style="" href="javascript:entrar();"><em><b>Entrar</b></em></a>
							</div>
						
						<div id="loading" style="clear: both;color:303030;font-size:12px;"> </div>
							<div style="margin-top: 10px; float: left; clear: both; ">
								<a href="#" id="esqueciSenha" style="color:#303030;font-size: 13px !important;"   data-toggle="modal" data-target="#modalSenha"> Esqueci minha senha </a> | <a href="#"  id="cadastrar" style="color:#303030;font-size: 13px !important;"  data-toggle="modal" data-target="#modalCadastrar"> Quero me cadastrar </a>
							</div>
					</form> 												
				</div>														
				
			</div>
		</div>
	</div>

<!--modal login-->
<!-- modal esqueci a senha-->

<div class="modal fade" id="modalSenha" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">	
		<div class="modal-header">
					<h3 class="modal-title">Esqueci a Senha</h3>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
			</div>			
			<div class="modal-body">
				<form method="POST" id="formauth" style="">
						<div style="float: left; margin-right:5px;">  
							<input type="text" value="Insira seu e-mail"  id="email_esqueci"   style="font-size: 13px;" placeholder="Informe o seu e-mail"	name="email_esqueci">
			
						</div>
					 
						<div style="float: left; padding-top:0px;">
							<a class="link-1 btAnunciar js-scroll-trigger" style="" href="javascript:enviar();"><em><b>Enviar</b></em></a>
						</div>
					
					<div id="loading" style="clear: both;color:303030;font-size:12px;"> </div>
						<div style="margin-top: 10px; float: left; clear: both; ">
							<a href="#" id="esqueciSenha" style="color:#303030;font-size:12px;"  data-toggle="modal" data-target="#modalSenha"> Esqueci minha senha </a> | <a href="#" id="cadastrar" style="color:#303030;font-size:12px;"  data-toggle="modal" data-target="#modalCadastrar"> Quero me cadastrar </a>
						</div>
				</form> 												
			</div>														
			
		</div>
	</div>
</div>

<!-- modal esqueci a senha-->

<!-- modal cadastrar-->
<div class="modal fade" id="modalCadastrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">	
			<div class="modal-header">
						<h3 class="modal-title">Fazer Meu Cadastro</h3>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
				</div>			
				<div class="modal-body modal-cadastrar" >
					<form style="clear: both;" id="formcad" name="formcad"  METHOD="POST" action="autenticacao/login.php">
								
								<div id="loading" style="display:none;clear: both;color:303030;font-size:12px;">  <div style="margin-left:20px;" id="txt"></div> </div>
									
								<div class="form-group row">
									<div class="col-md-6 ">
										<label>Nome Completo*</label>
										<input class="form-control" name="username" type="text"  id="username" onFocus="if(this.value =='Insira seu nome' ) this.value=''" onBlur="if(this.value=='') this.value='Insira seu nome'" value="Insira seu nome"  />
									</div>
									<div class="col-md-6">
										<label>Email*</label>
										<input class="form-control" name="emailcadastro"  type="text"  id="emailcadastro" onFocus="if(this.value =='Insira seu e-mail' ) this.value=''" onBlur="if(this.value=='') this.value='Insira seu e-mail'" value="Insira seu e-mail"  />
									</div>
									<!-- 
									<div class="col-md-6">
										<label>CPF*</label>
										<input  class="form-control" name="cpf" type="text" id="cpf" />
									</div>
									<div class="col-md-6">
											<label>Diga onde nos conheceu</label>
											<input  class="form-control"  name="local"   type="text" id="local"    />
									</div>
									-->
									<!-- 
									<input type="hidden" name="websites3" id="websites3" value="1" > 
									<div class="col-md-4">
											<label>Cep (apenas n&uacute;meros)</label>
											<input class="form-control"  onKeyPress="return SomenteNumero(event);" name="cep"  onblur="getEndereco();" type="text" id="cep"    />
									</div>
									<div class="col-md-6">
											<label>Endere&ccedil;o*</label>
											<input class="form-control"  name="endereco"   type="text" id="endereco"    />
									</div>
									<div class="col-md-2">
											<label>N&uacute;mero</label>
											<input class="form-control" name="numero"   type="text" id="numero"    />
									</div>
									<div class="col-md-6">
											<label>Complemento</label>
											<input class="form-control" name="complemento"   type="text" id="complemento"    />
									</div>
									<div class="col-md-6">
											<label>Bairro </label>
											<input class="form-control"  name="bairro"   type="text" id="bairro"    />
									</div>
									<div class="col-md-6">
											<label>Cidade</label>
											<input class="form-control"  name="cidadeusuario"   type="text" id="cidadeusuario"    />
											
									</div>
									<div class="col-md-6">
											<label>Estado</label>
											<input class="form-control"  name="estado"   type="text" id="estado"    />
											
									</div>
									-->
									<div class="col-md-6">
											<label>DDD* (Apenas números)</label>

											<input class="form-control" name="ddd" type="text" id="ddd" maxlength="2" onKeyPress="return SomenteNumero(event);" />
											
									</div>
									<div class="col-md-6">
											<label>Telefone* (Apenas números)</label>
											<input class="form-control" name="telefone" type="text" id="telefone" maxlength="9" onKeyPress="return SomenteNumero(event);"  />
											
									</div>
									<div class="col-md-6">
											<label>Senha*</label>
											<input class="form-control" name="passwordcad" type="password" id="passwordcad"  />											
									</div>
									<div class="col-md-6">
											<label>Redigite a senha*</label>
											<input class="form-control" name="password2"  type="password"  id="password2"   />										
									</div>
									<!-- 
									<div class="col-md-6">
										<input class="form-control" type="checkbox" class="cinput" id="receberofertas" checked name="receberofertas"/>  
									</div>	
									
									<div class="col-md-6">
										Cadastrar na Newsletter
									</div>
									-->
									<div class="col-md-12">
									<span style="font-family:verdana;color:303030;font-size:12px;">    * Campos obrigat&aacute;rios</span> 
									 </div>		
								</div>			 
														
								<div style="padding-top: 20px;margin-right:23px; ">
									<a class="link-1 btAnunciar js-scroll-trigger" style="" href="javascript:cadastropop();"><em><b>Cadastrar</b></em></a>
								</div>
								
								<div style="width: 218px; float: left; margin-top: 14px; margin-left: 20px;">
									<a href="#" id="login" style="font-family:verdana;color:#303030;font-size:12px;"  data-toggle="modal" data-target="#exampleModal1" >J&aacute; sou cadastrado, quero logar</a>
								</div>
								<? if($INI['option']['termosobrigatorio']=="Y"){ ?>
									<div style="color: #303030; font-size: 12px; float: right; width: 299px; margin-top: 20px; margin-right: 214px;">
										<input style="width:10px;" type="checkbox" value="1" name="aceitardb2" id="aceitardb2"> Aceito a pol&iacute;tica de privacidade. <a target="_blank" href="<?=$ROOTPATH?>/page/about_privacy/Politicas%20de%20Privacidade">Clique para ler</a>
									</div>
								<? } ?>	
						</form>												
				</div>														
				
			</div>
		</div>
	</div>
<!-- modal cadastrar-->
	
<script language="javascript">
// post logar
function entrar(){
		 
	if(jQuery("#email").val() == "" ||  J("#email").val() == "Insira seu e-mail"){ 
		alert("Por favor, informe seu email.");
		jQuery("#loading").html("");
		document.getElementById("email").focus();
		return;
	}
	 
	if(jQuery("#password").val() == ""){ 
		alert("Por favor, informe sua senha.");
		jQuery("#loading").html("");
		document.getElementById("password").focus();
		return;
	}
 
 
	jQuery.ajax({
		   type: "POST",
		   cache: false,
		   async: false,
		   url: "<?php echo $INI['system']['wwwprefix']?>/autenticacao/login.php",
		   data: "acao=logintoupup&email="+J("#email").val()+"&password="+J("#password").val(),
		   success: function(user_id){
			
		   idusuario = jQuery.trim(user_id);
		   if(jQuery.trim(idusuario)=="00"){
		     
				 alert("Email ou senha incorretos. Por favor, verifique os seus dados.");
				 jQuery("#loading").html("");
			 } 
		   else { 
			   
			  
			   
			  if(jQuery("#utm").val()=="1"){
				  if(jQuery("#tipooferta").val()=="participe"){
					participar(1);
				  }else{
					 enviapag() ;
				  }
			 }
			  else{
                 location.href  = '<?php echo $INI['system']['wwwprefix']?>/index.php?<?php echo $_SERVER["QUERY_STRING"] ?>';
			  }	
		   }		  
		}
	});
}

//post esqueci senha
//post esqueci senha
function enviar(){
	  
	if(J("#email_esqueci").val() == "" ||  J("#email_esqueci").val() == "Insira seu e-mail" ){
	    alert("Por favor, informe seu email.");
		jQuery("#loading").html("");
		document.getElementById("email_esqueci").focus();
		return;
	}
	 
  //jQuery("#loading").html("<img style=margin-left:50px; src=<?=$PATHSKIN?>/images/ajax-loader2.gif> Estamos validando seu email...");
  
	J.ajax({
		   type: "POST",
		   cache: false,
		   async: false,
		   url: "<?php echo $INI['system']['wwwprefix']?>/autenticacao/repass.php",
		   data: "email="+J("#email_esqueci").val(),
		   success: function(retorno){
		   
		   if(jQuery.trim(retorno)==""){  
				alert("A senha foi enviada com sucesso para seu email")
				//jQuery("#loading").html("Sua senha foi enviada com sucesso para o seu email");
				//location.href  = '<?php echo $INI['system']['wwwprefix']?>';
			 } 
		   else {
			 
			  	alert(retorno);
				jQuery("#loading").html("");
		   }
		}
	});
}
 
 //cadastro
 var idusuario;
 function cadastropop(){
	
	<? if($INI['option']['termosobrigatorio']=="Y"){ ?>
		var aceitar='';
	  
		aceitar = J("input[type=checkbox][name=aceitardb2]:checked").val()
	  
		if( aceitar != "on" & aceitar != "1") {
				alert("Por favor, aceite os termos de privacidade para realizar o seu cadastro")
				return;
		}
	<? } ?>
	
    var cpf="";

    jQuery("#loading").hide();
	 
	if(J("#username").val() == "Insira seu nome"){
	    alert("Por favor, informe seu nome.");
		jQuery("#loading").hide();
		document.getElementById("username").focus();
		return;
	}
		
	if(J("#emailcadastro").val() == "Insira seu e-mail"){
	    alert("Por favor, informe seu email.");
		jQuery("#loading").hide();
		document.getElementById("emailcadastro").focus();
		return;
	}
	
	/*
	 if(jQuery("#cpf").val() == "Insira seu cpf"){
		alert("Informe o seu cpf.")
		document.getElementById("cpf").focus();
		return;
	}	
	
	cpf = jQuery("#cpf").val();
	cpf =  cpf.replace("-","");
 
	if( !validaCPF(cpf)){
		alert("Informe um cpf existente.")
		document.getElementById("cpf").focus();
		return;
	}	  
	if(J("#websites3").val() == ""){
	 
		alert("Por favor, escolha a cidade de interesse das ofertas");
		jQuery("#loading").hide();
		document.getElementById("websites3").focus();
		return;
	}	
	*/
	
  // dados de enrede?o
	 
	 /*
	if(J("#cep").val() == ""){

		alert("Por favor, informe seu cep.");
		jQuery("#loading").hide();
		document.getElementById("cep").focus();
		return;
	}
	 if(J("#endereco").val() == ""){

		alert("Por favor, informe seu endereco.");
		jQuery("#loading").hide();
		document.getElementById("endereco").focus();
		return;
	} 
	*/
	/*
	if(J("#numero").val() == ""){

		alert("Por favor, informe o numero.");
		jQuery("#loading").hide();
		document.getElementById("numero").focus();
		return;
	}
	if(J("#bairro").val() == ""){

		alert("Por favor, informe seu bairro.");
		jQuery("#loading").hide();
		document.getElementById("bairro").focus();
		return;
	}*/
	/*
	if(J("#cidadeusuario").val() == ""){

		alert("Por favor, informe sua cidade.");
		jQuery("#loading").hide();
		document.getElementById("cidadeusuario").focus();
		return;
	}
	if(J("#estado").val() == ""){

		alert("Por favor, informe seu estado.");
		jQuery("#loading").hide();
		document.getElementById("estado").focus();
		return;
	}	
	*/
	if(J("#ddd").val() == ""){

		alert("Por favor, informe seu DDD.");
		jQuery("#loading").hide();
		document.getElementById("ddd").focus();
		return;
	}
	if(J("#telefone").val() == ""){

		alert("Por favor, informe seu telefone.");
		jQuery("#loading").hide();
		document.getElementById("telefone").focus();
		return;
	}
	if(J("#passwordcad").val() == ""){
	    alert("Por favor, informe sua senha.");
		jQuery("#loading").hide();
		document.getElementById("passwordcad").focus();
		return;
	}
	
	if(J("#password2").val() == ""){

		alert("Por favor, redigite sua senha.");
		jQuery("#loading").hide();
		document.getElementById("password2").focus();
		return;
	}
	
	if(J("#password2").val() != J("#passwordcad").val() ){
	    alert("Por favor, revise suas senhas. Senhas diferentes.");
		jQuery("#loading").hide();
		document.getElementById("password2").focus();
		return;
	}
	
  var checkreceber="";
	J(".cinput:checked").each(function(){
 
		checkreceber = ' [' + this.value + '] ';
	});
 
		cpf = jQuery("#cpf").val();
 
		jQuery.ajax({
		   type: "POST",
		   cache: false,
		   async: false,
		   url: "<?php echo $INI['system']['wwwprefix']?>/autenticacao/login.php",
		   data: "acao=cadastro&ddd="+J("#ddd").val()+"&telefone="+J("#telefone").val()+"&numero="+J("#numero").val()+"&cidadeusuario="+J("#cidadeusuario").val()+"&cep="+J("#cep").val()+"&endereco="+J("#endereco").val()+"&estado="+J("#estado").val()+"&complemento="+J("#complemento").val()+"&bairro="+J("#bairro").val()+"&cpf="+cpf+"&receberofertas="+checkreceber+"&username="+J("#username").val()+"&passwordcad="+J("#passwordcad").val()+"&emailcadastro="+J("#emailcadastro").val()+"&websites3="+J("#websites3").val()+"&local="+J("#local").val()+"&password2="+J("#password2").val(),
		   success: function(user_id){
		 
		   flag =  user_id.indexOf("Falha");
		 
			if(flag!=-1){ 
				 alert(user_id);
				jQuery("#loading").hide();
			} 
			else {  
			  J("#idusuario").val(user_id);
			  idusuario = jQuery.trim(user_id);
			    if(jQuery("#utm").val()=="1"){
					  if(J("#tipooferta").val()=="participe"){
						participar(1);
					  }else{
						 enviapag() ;
					  }
				}
				  else{
					    location.href  = '<?php echo $INI['system']['wwwprefix']?>/index.php?<?php echo $_SERVER["QUERY_STRING"] ?>';
				  }	 	
			 }
		}
	});	
}
 

function getEndereco() {
 
		// Se o campo CEP n?o estiver vazio
		if(jQuery.trim(J("#cep").val()) != ""){
			/* 
				Para conectar no servi?o e executar o json, precisamos usar a fun??o
				getScript do jQuery, o getScript e o dataType:"jsonp" conseguem fazer o cross-domain, os outros
				dataTypes n?o possibilitam esta intera??o entre dom?nios diferentes
				Estou chamando a url do servi?o passando o par?metro "formato=javascript" e o CEP digitado no formul?rio
				http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep="+J("#cep").val()
			*/
			jQuery.getScript("http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep="+J("#cep").val(), function(){
				// o getScript d? um eval no script, ent?o ? s? ler!
				//Se o resultado for igual a 1
				if(resultadoCEP["resultado"]){
					// troca o valor dos elementos
					J("#endereco").val(unescape(resultadoCEP["tipo_logradouro"])+"  "+unescape(resultadoCEP["logradouro"]));
					J("#bairro").val(unescape(resultadoCEP["bairro"]));
					J("#cidadeusuario").val(unescape(resultadoCEP["cidade"]));
					J("#estado").val(unescape(resultadoCEP["uf"]));
				}else{
					alert("Endere&ccedil;o n&atilde;o encontrado");
				}
			});				
		}			
}

 
	
jQuery(document).ready(function(){
  // J("#date").mask("99/99/9999");
    
  // J("#telefone").mask("9999-9999");
   //J("#").mask("99-9999999");
   //J("#ssn").mask("999-99-9999");
  // jQuery("#cpf").mask("999999999-99");
  // jQuery("#estado").mask("aa");
});

 

/*
jQuery('#inline_logar input').bind('keypress', function(e) {
        if(e.keyCode==13){
			entrar();
	}
});
jQuery('#inline_cadastrar input').bind('keypress', function(e) {
        if(e.keyCode==13){
			cadastropop();
	}
});
jQuery('#inline_esquecisenha input').bind('keypress', function(e) {
        if(e.keyCode==13){
			enviar();
	}
});*/


</script>
											
	