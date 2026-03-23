<?php include template("manage_header"); 

if(empty($planos_publicacao['dias'])){
	$planos_publicacao['dias']=30;
}
	 
?>

<script type="text/javascript" src="/media/js/tinymce_pt/jscripts/tiny_mce/tiny_mce.js"></script> 
<script type="text/javascript" src="/media/js/tinymce_pt/jscripts/tiny_mce/plugins/tinybrowser/tb_tinymce.js.php"></script> 
<script src="/media/js/include_tinymce.js" type="text/javascript"></script> 

<div id="bdw" class="bdw">
<div id="bd" class="cf">
<div id="leader">
	<div id="content" class="clear mainwide">
        <div class="clear box"> 
            <div class="box-content">
                <div class="sect">
				<form id="nform" id="nform"  method="post" action="/vipmin/order/edit.php" enctype="multipart/form-data" class="validator">
				<input type="hidden" id="id" name="id" value="<?=$planos_publicacao['id']; ?>" />
				<input type="hidden" name="guarantee" value="Y" />
				<input type="hidden" name="system" value="Y" /> 
				<input type="hidden" name="www" id="www"  value="<?=$INI['system']['wwwprefix']?>" /> 
				<div class="option_box">
					<div class="top-heading group">
						<div class="left_float"><h4>Informações do Plano <?=$planos_publicacao['id']?></h4></div>
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
								   
									<div class="report-head">Nome do Plano: <span class="cpanel-date-hint"></span></div>
									<div class="group">
										<input type='text' maxlength="15" name='nome' id='nome' value='<?=$planos_publicacao['nome']?>' />
										<img class="tTip" title="Note que este título deve ser pequeno o suficiente para caber dentro do box de planos" style="cursor:help" id="Search_ToolTip" src="<?=$ROOTPATH?>/media/css/i/info.png">
									</div> 
									
									<div class="report-head">Dias de publicação: <span class="cpanel-date-hint">SOMENTE NÚMEROS</span></div>
									<div class="group">
										<input type='text' maxlength="15" onKeyPress="return SomenteNumero(event);" name='dias' id='dias' value='<?=$planos_publicacao['dias']?>' />
										<img class="tTip" title="É quantidade de dias que o anúncio do internauta ficará online no site" style="cursor:help" id="Search_ToolTip" src="<?=$ROOTPATH?>/media/css/i/info.png">
									</div>  
									<!-- 
										<div class="report-head">Qtde de Anúncios: <span class="cpanel-date-hint"></span></div>
										<div class="group">
											<input type='text' maxlength="15" onKeyPress="return SomenteNumero(event);"  name='qtdeanuncio' id='qtdeanuncio' value='<?=$planos_publicacao['qtdeanuncio']?>' />
											<img class="tTip" title="É quantidade de anúncios que o cliente poderá fazer pagando este plano. Quando o cliente publicar todos os anúncios do plano, ele deverá escolher um novo plano. Informe uma sequencia de sete 9 ex: 9999999 para anúncios ilimitados" style="cursor:help" id="Search_ToolTip" src="<?=$ROOTPATH?>/media/css/i/info.png">
										</div> 
									-->	
									<input type='hidden' name='qtdeanuncio' id='qtdeanuncio' value='1' />
																				
									<? if($planos_publicacao['id'] <> "10"){?>
									<div class="report-head">Valor do Plano: <span class="cpanel-date-hint"></span></div>
									<div class="group">
										<input type='text' maxlength="25" name='valor' id='valor' value='<?=$planos_publicacao['valor']?>' />
									 </div> 
									<? } else {?>
											Este é um plano grátis e não tem valor
									<? }?>
									   
									<div class="report-head">Texto do Plano: <span class="cpanel-date-hint">Se precisar, insira códigos HTML </span></div>
									<div class="group">
										<input type='text' maxlength="64" name='texto' id='texto' value='<?=$planos_publicacao['texto']?>' />
										<img class="tTip" title="Este texto irá aparecer para o usuário no momento da escolha dos planos" style="cursor:help" id="Search_ToolTip" src="<?=$ROOTPATH?>/media/css/i/info.png">
									 </div> 
									 									
								</div>
								<!-- =============================   fim coluna esquerda   =====================================-->
								<!-- =============================   coluna direita   =====================================-->
								<div class="ends">
								 <div class="report-head">Ativo <span class="cpanel-date-hint"></span></div>
								 	 
								<input style="width:20px;" type="radio" <? if($planos_publicacao['ativo']=="s"){ echo "checked=checked"; }?> value="s" name="ativo"> Sim       
								<input style="width:20px;" type="radio" <? if($planos_publicacao['ativo']=="n"){ echo "checked=checked"; }?> value="n" name="ativo"> Não    
							 
							   <div></div>
								<? if(file_exists(WWW_MOD."/topo.inc")){?>   
								<div class="report-head">Voltar ao topo <span class="cpanel-date-hint"></span></div>
								<input style="width:20px;" type="radio" <? if($planos_publicacao['top']=="s"){ echo "checked=checked"; }?> value="s" name="top"> Sim       
								<input style="width:20px;" type="radio" <? if($planos_publicacao['top']=="n"){ echo "checked=checked"; }?> value="n" name="top"> Não    
								<? } ?>
								
								<div>
									<div class="report-head">Slide interno <span class="cpanel-date-hint"></span></div>
									<input style="width:20px;" type="radio" <? if($planos_publicacao['slide_interna']=="s"){ echo "checked=checked"; }?> value="s" name="slide_interna"> Sim       
									<input style="width:20px;" type="radio" <? if($planos_publicacao['slide_interna']=="n"){ echo "checked=checked"; }?> value="n" name="slide_interna"> Não    
								</div>
								
								<? if(file_exists(WWW_MOD."/propostas.inc")){?>
									<div class="report-head">Destaque <span class="cpanel-date-hint"></span></div>
										 
											<input style="width:20px;" type="radio" <? if($planos_publicacao['destaque']=="sim"){ echo "checked=checked"; }?> value="sim" name="destaque"> Sim       
											<input style="width:20px;" type="radio" <? if($planos_publicacao['destaque']=="nao" or $planos_publicacao['destaque']==""){ echo "checked=checked"; }?> value="nao" name="destaque"> Não    
										 
										   <div></div>
								<? } ?>

								<? if($planos_publicacao['id']!="10"){  include ("link_pagamento.php");  } ?>


								 </div>
								<!-- =============================  fim coluna direita  =====================================-->
							</div> 
						</div>
					</div>
				</div>
				
				</form>
                </div>
            </div> 
        </div>
	</div> 
</div>
</div> 
<script>
function validador(){
		return true;
}
$('#valor').priceFormat({
    prefix: 'R$ ',
    centsSeparator: ',',
    thousandsSeparator: '.'
});

</script>   