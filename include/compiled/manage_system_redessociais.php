<?php include template("manage_header");?>
 
<div id="bdw" class="bdw">

<div id="bd" class="cf">

<div id="partner">

	<div id="content" class="clear mainwide">

        <div class="clear box">
  
            <div class="box-content">

			<div class="option_box">
				<!--<div class="top-heading group"> <div class="left_float"><h4>Redes Sociais</h4></div> </div> -->
					<div class="sect">
						<form method="post"> 
						<div class="option_box">
						<div class="top-heading group"> 
							<div class="the-button">
									<input type="hidden" value="remote" id="deliverytype" name="deliverytype">
									<div class="top-heading group"> <div class="left_float"><h4>Redes Sociais</h4></div> </div>
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
										<div style="clear:both;"class="report-head">Twitter: <span class="cpanel-date-hint">Incluir endereço com http://</span></div>
										<div class="group">
											<input type="text" name="other[twitter]"  id="other[twitter]" class="format_input ckeditor" value="<?php echo $INI['other']['twitter']; ?>" />  <img style="cursor:help" class="tTip" title="Nome do seu perfil no Twitter " src="<?=$ROOTPATH?>/media/css/i/info.png"> 
										</div> 
											<div class="report-head">Facebook: <span class="cpanel-date-hint">Incluir endereço com http://</span></div>
										<div class="group">
											<input type="text" name="other[facebook]"  id="other[facebook]" class="format_input ckeditor" value="<?php echo $INI['other']['facebook']; ?>" />  <img style="cursor:help" class="tTip" title="Endereço do seu perfil no Facebook " src="<?=$ROOTPATH?>/media/css/i/info.png"> 
										</div>  
									</div>
									<!-- =============================   fim coluna esquerda   =====================================-->
									<!-- =============================   coluna direita   =====================================-->
									<div class="ends">
										<div class="report-head">Instagram: <span class="cpanel-date-hint">Incluir endereço com http://</span></div>
										<div class="group">
											<input type="text" name="other[instagram]"  id="other[instagram]" class="format_input ckeditor" value="<?php echo $INI['other']['instagram']; ?>" />  <img style="cursor:help" class="tTip" title="Endereço do seu perfil no Instagram " src="<?=$ROOTPATH?>/media/css/i/info.png"> 
										</div> 
										<div class="report-head">Youtube: <span class="cpanel-date-hint">Incluir endereço com http://</span></div>
										<div class="group">
											<input type="text" name="other[youtube]"  id="other[youtube]" class="format_input ckeditor" value="<?php echo $INI['other']['youtube']; ?>" />  <img style="cursor:help" class="tTip" title="Endereço do seu canal no Youtube " src="<?=$ROOTPATH?>/media/css/i/info.png"> 
										</div>
									 </div>
									<!-- =============================  fim coluna direita  =====================================-->
								</div> 
							</div>
						</div>
					</div>
   
		 

						<input type="hidden" size="30" name="pg" value="<?php echo $_REQUEST['pg'] ?>"/>

						<!-- cores --> 
						
						<input type="hidden" size="30" name="other[colormenusuperior]" value="<?=$INI['other']['colormenusuperior']; ?>"/>
               			<input type="hidden" size="30" name="other[colormenusuperiorhover]" value="<?=$INI['other']['colormenusuperiorhover']; ?>"/>
               			<input type="hidden" size="30" name="other[colormenusuperiorborder]" value="<?=$INI['other']['colormenusuperiorborder']; ?>"/>
               			<input type="hidden" size="30" name="other[background_titulo_destaque]" value="<?=$INI['other']['background_titulo_destaque']; ?>"/> 
               			<input type="hidden" size="30" name="other[botaodetalhe]" value="<?=$INI['other']['botaodetalhe']; ?>"/> 
               			<input type="hidden" size="30" name="other[botaodetalhehover]" value="<?=$INI['other']['botaodetalhehover']; ?>"/> 
               			<input type="hidden" size="30" name="other[colortitulocidade]" value="<?=$INI['other']['colortitulocidade']; ?>"/>
               			<input type="hidden" size="30" name="other[coloremailofertas]" value="<?=$INI['other']['coloremailofertas']; ?>"/>
               			<input type="hidden" size="30" name="other[colorfundocidades]" value="<?=$INI['other']['colorfundocidades']; ?>"/>
               			<input type="hidden" size="30" name="other[colortextoh3]" value="<?=$INI['other']['colortextoh3']; ?>"/>
               			<input type="hidden" size="30" name="other[color_destaque_titulo]" value="<?=$INI['other']['color_destaque_titulo']; ?>"/>
               			<input type="hidden" size="30" name="other[color_destaque_titulo_txt]" value="<?=$INI['other']['color_destaque_titulo_txt']; ?>"/>
               			<input type="hidden" size="30" name="other[color_destaque_botao]" value="<?=$INI['other']['color_destaque_botao']; ?>"/>
               			<input type="hidden" size="30" name="other[color_detalhe_oferta_home]" value="<?=$INI['other']['color_detalhe_oferta_home']; ?>"/>
               			<input type="hidden" size="30" name="other[color_detalhe_oferta_home_txt]" value="<?=$INI['other']['color_detalhe_oferta_home_txt']; ?>"/>
               			<input type="hidden" size="30" name="other[oferta_valor]" value="<?=$INI['other']['oferta_valor']; ?>"/>
               			<input type="hidden" size="30" name="other[color_qtd_vendido]" value="<?=$INI['other']['color_qtd_vendido']; ?>"/>
               			<input type="hidden" size="30" name="other[color_contadornovo]" value="<?=$INI['other']['color_contadornovo']; ?>"/>
               			<input type="hidden" size="30" name="other[color_fundo_meio_rodape]" value="<?=$INI['other']['color_fundo_meio_rodape']; ?>"/> 
               			<input type="hidden" size="30" name="other[cor_letra_topo]" value="<?=$INI['other']['cor_letra_topo']; ?>"/> 
               			<input type="hidden" size="30" name="other[rodapedetalhe]" value="<?=$INI['other']['rodapedetalhe']; ?>"/>  
               			<input type="hidden" size="30" name="other[color_fundo_laterais_rodape]" value="<?=$INI['other']['color_fundo_laterais_rodape']; ?>"/>  
               			<input type="hidden" size="30" name="other[background_titulos]" value="<?=$INI['other']['background_titulos']; ?>"/>  
               			<input type="hidden" size="30" name="other[background_oferta_nacional]" value="<?=$INI['other']['background_oferta_nacional']; ?>"/>  
               			<input type="hidden" size="30" name="other[fundooferta]" value="<?=$INI['other']['fundooferta']; ?>"/>  
               			<input type="hidden" size="30" name="other[topodetalhe]" value="<?=$INI['other']['topodetalhe']; ?>"/> 
               			<input type="hidden" size="30" name="other[bgheader]" value="<?=$INI['other']['bgheader']; ?>"/> 
               			<input type="hidden" size="30" name="other[btn-add]" value="<?=$INI['other']['btn-add']; ?>"/> 
               			<input type="hidden" size="30" name="other[subtitle]" value="<?=$INI['other']['subtitle']; ?>"/> 
               			<input type="hidden" size="30" name="other[cormapa]" value="<?=$INI['other']['cormapa']; ?>"/> 
               			<input type="hidden" size="30" name="other[fill]" value="<?=$INI['other']['fill']; ?>"/> 
               			<input type="hidden" size="30" name="other[not-found]" value="<?=$INI['other']['not-found']; ?>"/> 
               			<input type="hidden" size="30" name="other[list-city-offer]" value="<?=$INI['other']['list-city-offer']; ?>"/> 
               			<input type="hidden" size="30" name="other[price-list-offer]" value="<?=$INI['other']['price-list-offer']; ?>"/> 
               			<input type="hidden" size="30" name="other[price-box]" value="<?=$INI['other']['price-box']; ?>"/> 
               			<input type="hidden" size="30" name="other[info-block]" value="<?=$INI['other']['info-block']; ?>"/> 
               			<input type="hidden" size="30" name="other[welcome]" value="<?=$INI['other']['welcome']; ?>"/> 
               			<input type="hidden" size="30" name="other[txtrodape]" value="<?=$INI['other']['txtrodape']; ?>"/> 
               			<input type="hidden" size="30" name="other[rodape]" value="<?=$INI['other']['rodape']; ?>"/> 
						
						

						</form>

					</div>

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

<?php 



?>

