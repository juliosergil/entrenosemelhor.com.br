<?php 

include(dirname(dirname(dirname(__FILE__)))."/app.php");
require("pagamento_controle.php");

$iduser = $_SESSION['user_id'];  
 
include template("manage_anunciante_header"); ?> 
  
<div id="bdw" class="bdw">
	<div id="bd" class="cf">
		<div id="leader">
			<div id="content" class="clear mainwide">
				<div class="clear box"> 
					<div class="box-content">
						<div class="sect">   
							<input type="hidden" name="www" id="www"  value="<?=$INI['system']['wwwprefix']?>" />   
							
							<div class="option_box">
								<? if($idplano!="10"){?>
									<div class="top-heading group">
										<div class="left_float" style="display: flex; justify-content: center;color: #fff;background: #333;width: 100%; "><h3 style="margin-top: 25px;margin: 31px;font-weight: 800;font-size: 22px;">Realize o Pagamento para publicar seu Anúncio </h3></div>
									 </div> 
								 <? }?>
							 
								 <div id="container_box"  style="display: flex; justify-content: center;background: #fff;">
									<div id="option_contents" class="option_contents">  
										<div class="form-contain group">   
											<div class="ends2" style="float: none; margin: 0 auto">
											 
											<? if($idplano!="10"){?>								 
													<div class="seu_estoque box pagamento"> 
														<div class="termo_uso">   
															<div class="linha" style="">   
																<? if($_REQUEST['preference_id']){?>
																 
																	<div class="btpay">
																	   <!-- botao do mercadopago aqui -->
																		<div id="wallet_container"></div>
																	</div>
																	
																<? }
																  else if($planos_publicacao["linkpagamento"]){ ?>
																		<div class="btpay">
																			<a target="_blank" href="<?=$planos_publicacao["linkpagamento"]?>"><img class="img-responsive" src="<?=$PATHSKIN?>/images/botaopagar.png"  border="0" /></a>
																		</div>
																 <? } ?>
																
															</div>  
														</div>  
													</div> 
											<? } 
											else {?>
												 <!-- Anúncio planos GRATIS!  -->
												 <button style="border:none; color:#000;FONT-SIZE: 15PX;"  onclick="javascript:location.href='<?=$ROOTPATH?>/adminanunciante/team/index.php'"  id="run-button" class="input-btn" type="button">Voltar para meus anúncios</button>
											 <? } ?>
											  
											</div>
										</div> 
									</div>
								</div>
							</div>

							 <?
								require("pagamento_pix.php");
							 ?>
					   
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
var idplano = '<?php echo $idplano; ?>';

function grava_plano_anuncio(){
	 
	 if(idplano != "") {
		 
		 $.get(www+"/include/funcoes.php?acao=grava_id_plano&id_plano="+idplano+"&team_id=<?=$idanuncio?>",
		  function(data){
			  if(jQuery.trim(data)!=""){ 
					alert(data)
			 } 	 
		   }); 
	 }
}

 function finalizaanuncio_gratis(){
  
		Valor =  jQuery('#valoranuncio').val();
		   
		   $.get(www+"/include/funcoes.php?acao=finalizaanuncio&user_id=<?=$iduser?>&idpedido="+team_id+"&valor="+Valor+"&idplano="+idplano+"&team_id=<?=$idanuncio?>" ,
		   function(data){
			  if(jQuery.trim(data)!=""){ 
					alert(data)
			 } 
			 else{
				   alert("Anúncio concluído com sucesso! " );
				   location.href = www+"/adminanunciante/";
				}
		   });  
	   
	 
}

grava_plano_anuncio();
if(idplano=="10"){
	finalizaanuncio_gratis();
}
 
</script> 

<?
require("pagamento_mercadopago_js.php");
?>