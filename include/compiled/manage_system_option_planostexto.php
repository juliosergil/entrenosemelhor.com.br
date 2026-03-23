<div class="form-contain group">
		<!-- =============================   coluna esquerda   =====================================-->
		<div class="starts">
			
			<div style="float:left; width:100%; margin-top: 15px;margin-bottom:2px;border-bottom:1px solid #EBECEE">
				<span class="report-head">Alterar página de planos de anunciantes por texto:</span> <span class="cpanel-date-hint">Edite o texto abaixo</span>
				<input style="width:20px;" type="radio" <? if($INI['option']['planos_texto_anunciante'] == "Y"){ echo "checked=checked";}?> value="Y" name="option[planos_texto_anunciante]"> Sim  &nbsp;<img class="tTip" style="cursor:help" id="Search_ToolTip" src="<?=$ROOTPATH?>/media/css/i/info.png" title="Ao ativar essa opção você se responsabiliza por todo e qualquer texto informado no conteúdo abaixo" >
				<input style="width:20px;" type="radio" <? if($INI['option']['planos_texto_anunciante'] == "N" or $INI['option']['planos_texto_anunciante'] == ""){ echo "checked=checked";}?>  value="N" name="option[planos_texto_anunciante]" > Não  &nbsp; 
			</div> 
		</div>
		<!-- =============================   fim coluna esquerda   =====================================-->
		<!-- =============================   coluna direita   =====================================-->
		<div class="ends"> 
		
			 
			
		 </div>
		<!-- =============================  fim coluna direita  =====================================-->
	</div> 
 
	<div class="option_box" style="clear: both;margin-top:10px;">
		<div class="top-heading group"> 
			<div class="left_float">
				<h4>Conteúdo da página de planos para anunciantes</h4> 
			</div> &nbsp;
		</div> 
		<div id="container_box">
			<div id="option_contents" class="option_contents">  
				<div class="form-contain group"> 
					<div class="text_area">  
					<textarea cols="45" rows="5" name="option[planos_texto_conteudo_anunciante]" style="width:100%"  class="format_input ckeditor" >
						<?php echo htmlspecialchars($INI['option']['planos_texto_conteudo_anunciante']); ?>
					</textarea>
					</div> 
				</div> 
			</div> 
		</div>
	</div> 