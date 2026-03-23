 

<?php include template("manage_anunciante_header"); ?>
<?php require("ini.php"); ?>

<?php  
if($id_anuncio){
	$idanuncio = $id_anuncio;
}
else if($_REQUEST['teamid']){
	$idanuncio = $_REQUEST['teamid'];
} 

else{
	$idanuncio = $team['id'];
} 
 
$iduser = $_SESSION['user_id']; 

$user = Table::Fetch('user', $iduser); 
$idpedido =  $idanuncio; 
?>  

<style>
	report-head { 
    font-size: 13px;  
}

 </style>
<div id="leader" class="container-fluid">
	<div id="content" class="clear mainwide row">
        <div class="clear box"> 
            <div class="box-content">
                <div class="sect"> 
				<!-- para o pagamento moip -->
				<input type="hidden" name="www" id="www"  value="<?=$INI['system']['wwwprefix']?>" /> 
				<input type="hidden" name="nomeCliente" id="nomeCliente"  value="<?=$user['realname']?>" /> 
				<input type="hidden" name="telefoneCliente" id="telefoneCliente"  value="<?=$user['mobile']?>" /> 
				<input type="hidden" name="CPFCliente" id="CPFCliente"  value="<?=$user['cpf']?>" /> 
				 
				<div id="contentmoip"></div>
				<!-- para o pagamento moip -->
				
				<div class="option_box">
					<div class="top-heading group">
						<div class="left_float"><h4>Escolha seu plano para realizar o pagamento </h4></div> 
					</div> 
				 
					 <div id="container_box">
						<div id="option_contents" class="option_contents">  
							<div class="form-contain group">
								<!-- =============================   coluna esquerda   =====================================-->
								<div class="starts col-md-8 col-xs-12 col-sm-12">  									  
									  <div class="row">
										<?
											$sql = "select * from planos_publicacao where ativo = 's' order by id";
											$rs = mysqli_query(DB::$mConnection,$sql);
											while($dados = mysqli_fetch_assoc($rs)){ 
										 ?> 
											<div class="col-md-4 col-xs-6 col-sm-6 plan-container" data-val="<?php echo $dados['id']?>">
												<div class="thumbnail">			
												
												<input type="radio" precoplano="<?=number_format($dados['valor'], 2, ',', '');?>"  value="<?=$dados['id']?>##<?=number_format($dados['valor'], 2, ',', '');?>##<?=$dados['gratis']?>##<?=$dados['linkpagamento']?>" id="planos_publicacao_<?php echo $dados['id']?>" name="planos_publicacao"> <span class="CorDestaque"><?=$dados['nome']?></span>										 
												<div class="descricaoDestaque">
													<ul class="listaDestaques">
														<?=$dados['texto']?>
													</ul>
												</div>
												<p align="left" style="font-size:10px;margin-left:auto;margin-right:auto;text-align:center;"> 
													R$ <input type="text" readonly="readonly" style="width:70px; font-weight:bold; color:#666; font-size:16px; border:#d8d8d8; background: transparent;" value="<?=number_format($dados['valor'], 2, ',', '');?>" name="inptDestaque1" id="inptDestaque1">
												</p>
												</div> 
											</div>
										 
										<? } ?> 
									</div>						 
								</div>
							 
								<!-- ============================= // fim coluna esquerda // =====================================-->
								<!-- ============================= // coluna direita // =====================================-->
								<div class="ends col-md-4 col-xs-12 col-sm-12"> 
								  
								<div class="seu_estoque box pagamento">
									 <div class="botaogratis" style="display:none;">  
										<div style="margin-top:7px;">
											 <button onclick="fecharanuncio();" id="run-button" class="input-btn" type="button"><div name="spinner-top" id="spinner-top" style="width: 203px; display: block;"><img name="imgrec" id="imgrec" src="<?=$ROOTPATH?>/media/css/i/lendo.gif" style="display: none;"></div><div id="spinner-text"  >Finalizar Anúncio</div></button> 
										 </div>
									</div>  
									<div class="termo_uso">  
										<div style="font-size: 22px; font-weight: bold; border-bottom: 1px solid rgb(204, 204, 204); margin-bottom: 28px;">Fazer Pagamento</div>									
									 
									 	<div class="linha" style="">  
											<div class="btpay">   
												 <div class="btpagamento">
													<a href="javascript:enviapag_normal();">
														<img src="<?=$PATHSKIN?>/images/botaopagar.png"  border="0" /> 
													</a> 
												</div>
											</div>
										</div> 
	
										<form target ="_blank"   name="formpg" id="formpg"  method="GET"  action=""> 
											
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
	  
											  
										<input type="hidden" id="idpagamento" name="idpagamento" value="<?php echo get_id_pagamento(); ?>" />
										<input type="hidden" id="idplano" name="idplano" value="" />

										<div style="margin-top:11px;">
										<?=$INI['system']['textopagamento']?>
									   </div>
										<? if(file_exists(WWW_MOD."/pix.inc")) { ?>	
												 <div style="height:600px;"> 
													 <iframe name="pixplanos" id="pixplanos" frameborder="0" height="100%" width="100%" scrolling="no" src="<?=$ROOTPATH?>/pix/pix_planos.php" id="layout"></iframe>  
												</div>
										   <? } ?> 
										   
									</div>										  
								</div> 								  
								</div>
							</div> 
						</div>
					</div>
				</div>			   
				</div>  
			</div>
		</div> 
	</div>
</div> 
<script> 
  
var www = jQuery("#www").val();
var team_id = '<?php echo $idpedido; ?>';
var gratis="";
var idpagamento="";

function fecharanuncio(){
	
	plano  = $("input[name='planos_publicacao']:checked").val();
  
	planoarr = plano.split('##');
	 
	 idplano = planoarr[0];
	 valor = planoarr[1];
	 gratis = planoarr[2]; 
		if(gratis=="s"){ 
			idpagamento =  team_id;
			finalizaanuncio('<?php echo $iduser; ?>',idpagamento,gratis);
		}
		else{
			alert('Este anúncio não é grátis. Por favor, escolha um plano grátis.');
		}
	 
}

var idplano;
var linkpagamento;
function mostravalor(){
	 plano  = $("input[name='planos_publicacao']:checked").val();
 
	 planoarr = plano.split('##');
	 
	 idplano = planoarr[0];
	 var valor = planoarr[1];
	 gratis = planoarr[2];
	 linkpagamento = planoarr[3];

	jQuery('#valorforall').val(valor)
	
	descricao = "Pagamento de Plano - R$ "+valor; 	 
	$("#valoranuncio").val(valor); 
	$("#item_descr_1").val(descricao);  
	$("#reference").val(idplano); 
	$("#ref_transacao").val(idplano);  
	jQuery('#item_valor_1').val(valor)
	 
	//mercado pago
	$("#name").val(descricao); 
	jQuery('#price').val(valor)
	
	//paypal
	$("#item_name_1").val(descricao); 
	$("#transaction_subject").val(descricao); 
	jQuery('#amount_1').val(valor)
	
	 
	if(gratis=="s"){
		 
		 $('.termo_uso').fadeOut('slow', function() {
		   $('.termo_uso').hide()
		 }); 
		 
		 $('.botaogratis').fadeIn('slow', function() {
		 $('.botaogratis').show()
		 });
		 
	}
	else{
		
		$('.botaogratis').fadeOut('slow', function() {
		   $('.botaogratis').hide()
		 }); 
		 
		 $('.termo_uso').fadeIn('slow', function() {
		 $('.termo_uso').show()
		 });
		  
	}
	<? if(file_exists(WWW_MOD."/pix.inc")) { ?>	
		/* atualiza o qrcode do pix*/
		$("#pixplanos").contents().find("input").val(valor); 
		$("#pixplanos").contents().find("form").submit();
	<? } ?>					   
}
    
	  
function enviapag_normal(){
	
   Valor  =  jQuery('#valorforall').val();
   
	if(Valor==""){
			campoobg("valoranuncio");
			alert("Por favor, escolha um plano para o anúncio");
			jQuery("#valoranuncio").focus();
			return;
	}   
	 // gravando o idplano
	 $.get(www+"/include/funcoes.php?acao=grava_id_plano&id_plano="+idplano+"&team_id=<?=$idanuncio?>",
	  function(data){
		  if(jQuery.trim(data)!=""){ 
				alert(data)
		 }
		else{ 
			if(linkpagamento==""){
				alert("Este plano não tem um link de pagamento, acesse a administração no menu Planos, edite este plano e informe o link de pagamento");
				return false;
			}
			$('#formpg').attr('action', linkpagamento); 
				 jQuery("#formpg").submit();
			}		 
	   }); 
}

 function finalizaanuncio(idcliente,idPedido,gratis){
	if(gratis!="s"){
			alert('Este anúncio não é grátis. Por favor, escolha um plano grátis.');
	}
	else{
		 
		Valor =  jQuery('#valoranuncio').val();
		 
	   $.get(www+"/include/funcoes.php?acao=finalizaanuncio&user_id="+idcliente+"&idpedido="+idPedido+"&valor="+Valor+"&idplano="+idplano+"&team_id=<?=$idanuncio?>" ,
	   function(data){
		  if(jQuery.trim(data)!=""){ 
				alert(data)
		 }
		 else{
			$.colorbox({html:"<font color='black' size='2'> Anúncio finalizado com sucesso!</font>"});
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