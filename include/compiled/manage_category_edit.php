<?php include template("manage_header");?>
<?php require("ini.php");?> 

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
				 <form id="login-user-form" method="post" action="/vipmin/category/edit.php?id=<?php echo $category['id']; ?>" enctype="multipart/form-data" class="validator">
					<input type="hidden" name="id" value="<?php echo $category['id']; ?>" />
					<input type="hidden" name="zone" value="<?php echo $zone; ?>" />
				<input type="hidden" name="www" id="www"  value="<?=$INI['system']['wwwprefix']?>" /> 
				<div class="option_box">
					<div class="top-heading group">
						<div class="left_float"><h4>Informações da <?=$tipo?> <?php echo $category['id']; ?></h4></div>
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
										<input type="text" name="name"  maxlength="152" id="name" class="format_input ckeditor" value="<?php echo $category['name'] ?>" /> 
									</div>
									
									<div class="report-head">Categoria Pai: <span class="cpanel-date-hint">Deixe em branco para ser a categoria PAI </span></div>
									<div class="group">
										<div class="cjt-wrapped-select" id="type-select-cjt-wrapped-select">
										<select  name="idpai" id="idpai" onchange="$('#select_idpai').text($('#idpai').find('option').filter(':selected').text())"> 
											<option value=""> </option>
											 <?php  
													if($category['id']){
															$aux =  " and id <> ".$category['id'];
													}
													
													$indentacao = "....";  
													$sql = "select * from category where idpai=0  $aux order by sort_order desc";
													$rs = mysqli_query(DB::$mConnection,$sql);
													while($l = mysqli_fetch_assoc($rs)){
													 $selected ="";
													 if($category['idpai'] == $l['id']){
															$selected =  " selected ";
													 }
		
														echo "<option value='$l[id]' $selected>".displaySubStringWithStrip($l[name],30)."</option>";
														exibe_filhos($l["id"],$indentacao,$category['idpai'],$category['id']);
													}
													$tb = null; 

												 ?>
										</select>
										<div name="select_idpai" id="select_idpai" class="cjt-wrapped-select-skin">Informe a categoria pai</div>
										<div class="cjt-wrapped-select-icon"></div>
										</div> &nbsp;<img class="tTip" title="Quando você informa uma categoria pai, ela irá aparecer como uma subcategoria no menu de navegação do site. Se deixar em branco, esta categoria irá aparecer no menu de navegação principal. A quantidade de categorias principais está diretamente ligado ao tamanho em caracteres de cada categoria." style="cursor:help" id="Search_ToolTip" src="<?=$ROOTPATH?>/media/css/i/info.png">
									</div>  
								 
							 
									<div class="group">
										<div style="clear:both;"class="report-head">Ativa: <span class="cpanel-date-hint"></span></div>
										<input style="width:20px;" type="radio" <? if($category['display'] =="Y" or $category['display'] ==""){echo "checked='checked'";}?>  value="Y" name="display" > Sim  &nbsp;   
										<input style="width:20px;" type="radio" <? if($category['display'] =="N"){echo "checked='checked'";}?>   name="display" value="N"> Não  &nbsp;<img class="tTip" title="Note que se a categoria pai estiver inativa, então todas as categorias filhas ficarão também inativas." style="cursor:help" id="Search_ToolTip" src="<?=$ROOTPATH?>/media/css/i/info.png">  
									 </div>
								</div>
								<!-- =============================   fim coluna esquerda   =====================================-->
								<!-- =============================   coluna direita   =====================================-->
								<div class="ends"> 	 			 
									 
									<div class="report-head">Ordenação: <span class="cpanel-date-hint"> </span></div>
									<div class="group">
										<input type="text" id="sort_order" onKeyPress="return SomenteNumero(event);"  name="sort_order" value="<?php echo $category['sort_order'] ? $category['sort_order'] : 0; ?>"> &nbsp;<img class="tTip" title="Informe a ordem de posicionamento. Ordenação maior fica na frente de ordenação menor." style="cursor:help" id="Search_ToolTip" src="<?=$ROOTPATH?>/media/css/i/info.png">
									</div>	
									<!-- 
									<div class="group">
										<div style="clear:both;"class="report-head">Destaque: <span class="cpanel-date-hint"> </span></div>
										<input style="width:20px;" type="radio" <? if($category['destaque'] =="Y" or $category['destaque'] ==""){echo "checked='checked'";}?>  value="Y" name="destaque" > Sim  &nbsp;   
										<input style="width:20px;" type="radio" <? if($category['destaque'] =="N" or $category['destaque'] ==""){echo "checked='checked'";}?>   name="destaque" value="N"> Não  &nbsp;<img class="tTip" title="Você pode ter no máximo 6 categorias destaques." style="cursor:help" id="Search_ToolTip" src="<?=$ROOTPATH?>/media/css/i/info.png">  
                     						<div style="clear:both;"class="report-head"> Sugerimos deixar em destaque algumas de suas categorias PAIS</div>			
									</div>
									 -->
									 <div id="tipoblock" style="margin-top:2%;margin-bottom:2%;">										
										<div style="clear:both;"class="report-head">Ícone de categoria (MENU):<span class="cpanel-date-hint"> <span class="cpanel-date-hint"><span id="dimensao"> Busque alguns em http://www.iconfinder.com </span> </span></div>
										<div class="group">
											<input type="file" style="border: 1px solid #C1D0D3; color: #666666; width: 86%;" name="imagemcateghome"  id="imagemcateghome" class="format_input ckeditor"  />   
										</div>
										<div class="group">
											<div style="clear:both;"class="report-head">Quero que esta categoria apareça no menu: <span class="cpanel-date-hint"></span></div>
											<input style="width:20px;" type="radio" <? if($category['displaymenu'] =="Y" or $category['displaymenu'] ==""){echo "checked='checked'";}?>  value="Y" name="displaymenu" > Sim  &nbsp;   
											<input style="width:20px;" type="radio" <? if($category['displaymenu'] =="N"){echo "checked='checked'";}?>   name="displaymenu" value="N"> Não  &nbsp;<img class="tTip" title="Se marcado como não, esta categoria não irá aparecer no menu de ícones" style="cursor:help" id="Search_ToolTip" src="<?=$ROOTPATH?>/media/css/i/info.png">  
										</div>
									 
										<?php
											if(!(empty($category['imagemcateghome']))) {
										?>
										<p>
											<a target="_blank" href="<?php echo $ROOTPATH; ?>/media/<?php echo $category['imagemcateghome']; ?>">
												<?php echo $ROOTPATH . "/media/" . $category['imagemcateghome']; ?>
											</a>
										</p>
										<div style="clear:both;"class="report-head">   Tente procurar por alguns ícones em http://www.iconfinder.com ou em http://www.iconarchive.com</div>	
										<?php } ?>
									</div> 
									
									<div id="tipoblock" style="margin-top:2%;margin-bottom:2%;">										
										<div style="clear:both;"class="report-head">Imagem da categoria: (opcional) <!-- Dimensão: 246px larg x 181px altura --><span class="cpanel-date-hint"> <span class="cpanel-date-hint"><span id="dimensao">   </span> </span></div>
										<div class="group">
											<input type="file" style="border: 1px solid #C1D0D3; color: #666666; width: 86%;" name="imagemcateghome2"  id="imagemcateghome2" class="format_input ckeditor"  />   
										</div>
										<?php
											if(!(empty($category['imagemcateghome2']))) {
										?>
										<p>
											<a target="_blank" href="<?php echo $ROOTPATH; ?>/media/<?php echo $category['imagemcateghome2']; ?>">
												<?php echo $ROOTPATH . "/media/" . $category['imagemcateghome2']; ?>
											</a>
										</p>
										<div style="clear:both;"class="report-head">   </div>	
										<?php } ?>
									</div> 
									
									<div class="group">
										<div style="clear:both;"class="report-head">Quero que esta imagem apareça na home: <span class="cpanel-date-hint"></span></div>
										<input style="width:20px;" type="radio" <? if($category['displayhome'] =="Y" or $category['displayhome'] ==""){echo "checked='checked'";}?>  value="Y" name="displayhome" > Sim  &nbsp;   
										<input style="width:20px;" type="radio" <? if($category['displayhome'] =="N"){echo "checked='checked'";}?>   name="displayhome" value="N"> Não  &nbsp;<img class="tTip" title="Na home, quando alguém clicar nesta imagem, irá para a lista de anúncios da categoria" style="cursor:help" id="Search_ToolTip" src="<?=$ROOTPATH?>/media/css/i/info.png">  
									 </div>
									Para redimensionar sua imagem <a href="https://resizeyourimage.com/PT/" target="_blank">clique aqui</a>
								 </div>
								<!-- =============================  fim coluna direita  =====================================-->
							</div> 
						</div>
					</div>
				</div> 
					 
				 <? if( $zone !="city") {?>
				 <!-- ********************************************* ABA Descrição --> 
				<div class="option_box" style="display:none;">
					<div class="top-heading group"> <div class="left_float"><h4>Banner da categoria</h4> </div> &nbsp;<img class="tTip" title="Este banner irá aparecer somente quando o usuário clicar nesta categoria. Dimensão ideal 941px de largura por 140px de altura, você também pode colocar um código html clicando no ícone HTML. Nota: Se esta for uma categoria de link, este banner será ignorado." style="cursor:help" id="Search_ToolTip" src="<?=$ROOTPATH?>/media/css/i/info.png"> </div> 
					 
					<div id="container_box">
						<div id="option_contents" class="option_contents">  
							<div class="form-contain group"> 
								<div class="text_area">  
								<textarea cols="45" rows="5" name="bannercategoria" style="width:100%" id="bannercategoria" class="format_input ckeditor" ><?php echo htmlspecialchars($category['bannercategoria']); ?></textarea>
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

	if( jQuery("#name").val()==""){

		campoobg("name");
		alert("Por favor, informe o nome da <?php echo $tipo; ?>");
		jQuery("#name").focus();
		return false;
	} 
	return true;	
}
 

 if( jQuery("#id").val() ==""){
 
}
else{ 
 
	$('#select_idpai').text($('#idpai').find('option').filter(':selected').text());
}


</script>   