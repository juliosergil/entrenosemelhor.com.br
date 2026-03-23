<?php include template("manage_header");?>
<?php require("ini.php");?> 
 
<div id="bdw" class="bdw">
<div id="bd" class="cf">
<div id="leader">
	<div id="content" class="clear mainwide">
        <div class="clear box"> 
            <div class="box-content">
                <div class="sect">
					<form id="login-user-form" method="post" action="/vipmin/user/edit.php?id=<?php echo $user['id']; ?>" enctype="multipart/form-data" class="validator">
					<input type="hidden" name="id" value="<?php echo $user['id']; ?>" />
					<input type="hidden" name="adminnew" value="<?php echo $_REQUEST['adminnew']; ?>" />
					<? if($user['id']=="1"){?>				
									<input type="hidden" name="manager" value="Y" />
					<? } ?>
					<input type="hidden" name="www" id="www"  value="<?=$INI['system']['wwwprefix']?>" /> 
					<div class="option_box">
						<div class="top-heading group">
							<div class="left_float"><h4>Informações</h4></div>
								<div class="the-button">
									<input type="hidden" value="remote" id="deliverytype" name="deliverytype">
									<button onclick="doupdate();" id="run-button" class="input-btn" type="button">
										<div name="spinner-top" id="spinner-top" style="width: 83px; display: block;"><img name="imgrec" id="imgrec" src="<?=$ROOTPATH?>/media/css/i/lendo.gif" style="display: none;"></div>
										<div id="spinner-text"  >Salvar</div>
									</button>
								</div> 
						</div> 
						<div id="container_box">
							<div id="option_contents" class="option_contents"> 
								<div class="form-contain group">
									<!-- =============================   coluna esquerda   =====================================-->
									<div class="starts">   
										<div style="clear:both;"class="report-head">Nome: <span class="cpanel-date-hint"></span></div>
										<div class="group">
											<input type="text" name="realname"   id="realname" class="format_input ckeditor" value="<?php echo $user['realname'] ?>" /> 
										</div>
										
										 <div style="clear:both;"class="report-head">Login: <span class="cpanel-date-hint"></span></div>
										<div class="group">
											<input type="text" name="username"    id="username" class="format_input ckeditor" value="<?php echo $user['username'] ?>" /> 
										</div>
										<? if(!$_REQUEST['adminnew']){?>	 
										<div style="clear:both;"class="report-head">CPF: <span class="cpanel-date-hint"></span></div>
										<div class="group">
											<input type="text" name="cpf"  id="cpf" class="format_input ckeditor" value="<?php echo $user['cpf'] ?>" /> 
										</div>	
										<?}?>
											<div style="clear:both;"class="report-head">DDD: (Apenas números)<span class="cpanel-date-hint"></span></div>
										<div class="group">
											<input type="text" name="ddd"   id="ddd" class="format_input ckeditor" value="<?php echo $user['ddd'] ?>" maxlength="2" onKeyPress="return SomenteNumero(event);" /> 
										</div>	
										
										<div style="clear:both;"class="report-head">Telefone: (Apenas números)<span class="cpanel-date-hint"></span></div>
										<div class="group">
											<input type="text" name="mobile"   id="mobile" class="format_input ckeditor" value="<?php echo $user['mobile'] ?>" maxlength="9" onKeyPress="return SomenteNumero(event);" /> 
										</div>												 
									</div>
									<!-- =============================   fim coluna esquerda   =====================================-->
									<!-- =============================   coluna direita   =====================================-->
									<div class="ends"> 	 		 
							
										<div style="clear:both;"class="report-head">Email: <span class="cpanel-date-hint"></span></div>
										<div class="group">
											<input type="text" name="email" id="email" class="format_input ckeditor" value="<?php echo $user['email'] ?>" /> 
										</div>		
										
										<div style="clear:both;"class="report-head">Senha: <span class="cpanel-date-hint"></span></div>
										<div class="group">
											<input type="text" name="password" id="password" class="format_input ckeditor" value="" /> 
										</div>										
										<br />
											<div style="clear:both;"class="report-head">Estado: <span class="cpanel-date-hint"></span></div>
									<div class="group">
										<input type="text" name="estado" id="estado" class="format_input ckeditor" value="<?php echo $user['estado'] ?>" /> 
									</div>	 
									 
									 <div style="clear:both;"class="report-head">Cidade: <span class="cpanel-date-hint"></span></div>
									<div class="group">
										<input type="text" name="cidadeusuario"  id="cidadeusuario" class="format_input ckeditor" value="<?php echo $user['cidadeusuario'] ?>" /> 
									</div>
									
										<div style="clear:both;"class="report-head">Editor: <span class="cpanel-date-hint"></span></div>
										<div class="group">
											<input style="width:20px;" type="radio" <? if($user['manager']=="Y"){ echo "checked=checked"; }?> value="Y" name="manager"> Sim       
											<input style="width:20px;" type="radio" <? if($user['manager']=="N"){ echo "checked=checked"; }?> value="N" name="manager"> Não    
										</div>										  
									 </div>
									<!-- =============================  fim coluna direita  =====================================-->
								</div> 
							</div>
						</div> 
					
			<!-- ********************************************* ABA  endereços  --> 
				<? if(!$_REQUEST['adminnew']){?>
				<div class="option_box" style="display:none">
					<div class="top-heading group"> <div class="left_float"><h4>Dados de endereço </h4> </div>  </div>  
					 
					<div id="container_box">
						<div id="option_contents" class="option_contents">  
							<div class="form-contain group"> 
								<div class="starts"> 
								 
									<div style="clear:both;"class="report-head">Endereço completo: <span class="cpanel-date-hint"></span></div>
									<div class="group">
										<input type="text" name="address"   id="address" class="format_input ckeditor" value="<?php echo $user['address'] ?>" /> 
									</div> 
									 		 
									<div style="clear:both;"class="report-head">Bairro <span class="cpanel-date-hint"></span></div>
									<div class="group">
										<input type="text" name="bairro"  id="bairro" class="format_input ckeditor" value="<?php echo $user['bairro'] ?>" /> 
									</div>	
									  
									<div style="clear:both;"class="report-head">Cep: <span class="cpanel-date-hint"></span></div>
									<div class="group">
										<input type="text" name="zipcode" id="zipcode" class="format_input ckeditor" value="<?php echo $user['zipcode'] ?>" /> 
									</div>	
								</div>
								<!-- =============================   fim coluna esquerda   =====================================-->
								<!-- =============================   coluna direita   =====================================-->
								<div class="ends"> 	 		 
								 
								 









									<? if($user['id']!=""){?>
										<div style="clear:both;"class="report-head">Data do cadastro: <span class="cpanel-date-hint"></span></div>
										<div class="group">
											<input type="text" name="create_time"  id="create_time" readonly="readonly" class="format_input ckeditor" value="<?php echo date('d/m/Y H:i', $user['create_time']); ?> " /> 
										</div> 
									<? } ?> 
								 </div>
							</div> 
						</div> 
					</div>
				</div> 
				 <!-- ********************************************* ABA local --> 
				 
				<div class="option_box">
					<div class="top-heading group"> <div class="left_float"><h4>Onde nos conheceu </h4> </div>  </div>  
					 
					<div id="container_box">
						<div id="option_contents" class="option_contents">  
							<div class="form-contain group"> 
								<div class="text_area">  
								<textarea cols="45" rows="5" name="local" style="width:100%" id="local" class="format_input ckeditor" ><?php echo htmlspecialchars($user['local']); ?></textarea>
								</div> 
							</div> 
						</div> 
					</div>
				</div>	 
				<? } ?>  				
				</form>
                </div>
            </div> 
        </div>
	</div> 
</div>
</div> 
<script>
 
function validador(){
 
	limpacampos(); 

	if( jQuery("#realname").val()==""){

		campoobg("realname");
		alert("Por favor, informe o nome do cliente");
		jQuery("#realname").focus();
		return false;
	} 	
	if( jQuery("#username").val()==""){

		campoobg("username");
		alert("Por favor, informe o login do cliente");
		jQuery("#username").focus();
		return false;
	}
	if( jQuery("#email").val()==""){

		campoobg("email");
		alert("Por favor, informe o email do cliente");
		jQuery("#email").focus();
		return false;
	}
   if( jQuery("#ddd").val()==""){

		campoobg("ddd");
		alert("Por favor, informe o ddd  ");
		jQuery("#ddd").focus();
		return false;
	}
	
	if( jQuery("#mobile").val()==""){

		campoobg("mobile");
		alert("Por favor, informe o telefone do cliente");
		jQuery("#mobile").focus();
		return false;
	}
	
	if( jQuery("#email").val()==""){

		campoobg("email");
		alert("Por favor, informe o email do cliente");
		jQuery("#email").focus();
		return false;
	} 	
	if( jQuery("#ID").val()==""){
		if( jQuery("#password").val()==""){

			campoobg("password");
			alert("Por favor, informe a senha do cliente");
			jQuery("#password").focus();
			return false;
		} 
	}
	return true;	
}
 
 jQuery(document).ready(function(){ 
    
  // jQuery("#mobile").mask("(99)9999-9999"); 
   jQuery("#cpf").mask("999999999-99");
   jQuery("#estado").mask("aa");
   jQuery("#zipcode").mask("99999999");
});


</script>   