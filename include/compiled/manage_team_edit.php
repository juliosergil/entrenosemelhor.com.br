<?php include template("manage_header");?>
<?php require("ini.php");
 ?> 
 

<div id="bdw" class="bdw">
<div id="bd" class="cf">
<div id="leader">
	<div id="content" class="clear mainwide">
        <div class="clear box"> 
            <div class="box-content">
                <div class="sect">
				<form id="nform" id="nform"  method="post" action="/vipmin/team/edit.php?id=<?php echo $team['id']; ?>" enctype="multipart/form-data" class="validator">
				<input type="hidden" id="id" name="id" value="<?php echo $team['id']; ?>" />
				<input type="hidden" name="www" id="www"  value="<?=$INI['system']['wwwprefix']?>" /> 
				<div class="option_box">
					<div class="top-heading group">
						<div class="left_float"><h4>Informações gerais do produto <?=$team['id']?></h4></div>
							<div class="the-button" style="width:700px;"> 
								
								<div style="float:left;"><button onclick="doupdate();" id="run-button" class="input-btn" type="button"><div name="spinner-top" id="spinner-top" style="width: 83px; display: block;"><img name="imgrec" id="imgrec" src="<?=$ROOTPATH?>/media/css/i/lendo.gif" style="display: none;"></div><div id="spinner-text"  >Salvar</div></button></div>
								<div style="float:left;"><button  onclick="javascript:location.href='<?=$ROOTPATH?>/vipmin/category/index.php?zone=group'"  id="run-button" class="input-btn" type="button"><div name="spinner-top" id="spinner-top" style="width: 83px; display: block;"><img name="imgrec" id="imgrec" src="<?=$ROOTPATH?>/media/css/i/lendo.gif" style="display: none;"></div><div id="spinner-text"  >Cadastrar categorias</div></button></div> 
								<div style="float:left;"><button  onclick="javascript:location.href='index.php'"  id="run-button" class="input-btn" type="button"><div name="spinner-top" id="spinner-top" style="width: 83px; display: block;"><img name="imgrec" id="imgrec" src="<?=$ROOTPATH?>/media/css/i/lendo.gif" style="display: none;"></div><div id="spinner-text"  >Listar Anúncios</div></button></div>
								
								
							</div> 
					</div> 
				 
					 <div id="container_box">
						<div id="option_contents" class="option_contents">  
							<div class="form-contain group">
								<!-- =============================   coluna esquerda   =====================================-->
								<div class="starts"> 
									<div style="clear:both;"class="report-head">Nome do produto ou serviço: <span class="cpanel-date-hint"></span></div>
									<div class="group">
										<input type="text" name="title"  maxlength="162" id="title" class="format_input ckeditor" value="<?php echo htmlspecialchars($team['title']); ?>" />  
									</div> 
									
									<div class="report-head">Estado: <span class="astobrig">*</span> <span class="cpanel-date-hint"> &nbsp;  <img class="tTip" title="Escolha o estado onde o produto se encontra e será anunciado" style="cursor:help" id="Search_ToolTip" src="<?=$ROOTPATH?>/media/css/i/info.png"> </span></div>
									<div class="group">
										<div class="cjt-wrapped-select" id="type-select-cjt-wrapped-select">
										<select name="uf" id="uf" onchange="$('#select_uf').text($('#uf').find('option').filter(':selected').text())"> 
											<option value=""></option>
											<?php
												$sql = "SELECT  uf,nome FROM estados";
												$estados = mysqli_query(DB::$mConnection,$sql) or die(mysqli_error(DB::$mConnection));
												while ($row = mysqli_fetch_array($estados, MYSQLI_ASSOC)) {
													if ($team['uf'] == $row['uf']) {
														$tmp_estado = $row['nome'];
														echo "<option value='{$row['uf']}' selected>{$row['nome']}</option>";
													} else {
														echo "<option value='{$row['uf']}'>{$row['nome']}</option>";		
													}
												}
											?>
										</select> 
										<script>
											URL = "<?php echo $ROOTPATH; ?>/ajax/filtro_pesquisa.php";
											jQuery(function() {
												jQuery('#uf').bind('change', function(ev) {
													jQuery.ajax({
														url: URL,
														type: 'POST',
														data: { filtro: 'cidades', estado: jQuery('#uf').val() },
														beforeSend: function() {
															jQuery('#select_city_id').html('Carregando...');
															jQuery('#city_id').html('<option>Carregando...</option>');
														},
														success: function(r) {
															jQuery('#select_city_id').html('Selecione uma cidade');
															jQuery('#city_id').html(r);
														}
													});
												});
											});
										</script>
										<div name="select_uf" id="select_uf" class="cjt-wrapped-select-skin"><?php if (isset($tmp_estado)) echo $tmp_estado; else echo "Selecione um estado"; ?></div>
										<div class="cjt-wrapped-select-icon"></div>
										</div>  
									</div> 
									 
									<div class="report-head">Cidade: <span class="astobrig">*</span>  <span class="cpanel-date-hint">   &nbsp;  <img class="tTip" title="Escolha a cidade onde o produto se encontra e será anunciado" style="cursor:help" id="Search_ToolTip" src="<?=$ROOTPATH?>/media/css/i/info.png"> Escolha primeiro o estado</div>
									<div class="group">
										<div class="cjt-wrapped-select" id="type-select-cjt-wrapped-select">
										<select  name="city_id" id="city_id" onchange="$('#select_city_id').text($('#city_id').find('option').filter(':selected').text())"> 
											<option value=""></option>
											<?php
												if ($team['uf'] != '') {
													$SQL = "SELECT * FROM cidades WHERE uf = '{$team['uf']}'";
													$cidades = mysqli_query(DB::$mConnection,$SQL) or die(mysqli_error(DB::$mConnection));
													while ($row = mysqli_fetch_array($cidades, MYSQLI_ASSOC)) {
														if ($team['city_id'] == $row['id']) {
															$tmp_cidade = $row['nome'];
															echo "<option value='{$row['id']}' selected>{$row['nome']}</option>";
														} else {
															echo "<option value='{$row['id']}'>{$row['nome']}</option>";
														}
													}
												}
											?>
										</select>
							 
										<div name="select_city_id" id="select_city_id" class="cjt-wrapped-select-skin"><?php if (isset($tmp_cidade)) echo $tmp_cidade; ?></div>
										<div class="cjt-wrapped-select-icon"></div>
										</div>  
									</div> 
									<!-- 
									<div id="c_categoria">
										<div class="report-head">Categoria: <span class="cpanel-date-hint"></span></div>
										<div class="group">
											<div class="selectcontainer">
												<div class="select-placeholder">Categorias <span><img src="../../media/css/i/droparrow.png"></span></div>
												<div class="options-container">
													<?php
														/*$sql = "select * from category where idpai=0 order by name ASC";
														$rs = mysqli_query(DB::$mConnection,$sql);
														while($l = mysqli_fetch_assoc($rs)){

															if(haschildren($l['id'])){
																$arrow = "<span><img src='../../media/css/i/droparrow.png'></span>";
															}else{
																$arrow = "";
															}

															echo "<div class='selectoption'>";
															echo "<div class='optionpai option'>".displaySubStringWithStrip($l['name'],30).$arrow."</div>";
															exibe_filhos($l["id"],$indentacao,$team['group_id']);
															echo "</div>";
														}
													*/?>	
												</div>
											</div> 
										</div> 
									</div> 
									<input type="hidden" name="group_id" value="" id="group_id" />
									-->
										
									<div id="c_categoria">
										<div class="report-head">Categoria: <span class="cpanel-date-hint"></span></div>
										<div class="group">
											<div class="cjt-wrapped-select" id="type-select-cjt-wrapped-select">
											<select  name="group_id" id="group_id" onchange="$('#select_group_id').text($('#group_id').find('option').filter(':selected').text())"> 
												<option value=""> </option>
												 <?php 
														 
												   $indentacao = "....";
											       $sql = "select * from category where   idpai=0 order by sort_order desc";
													$rs = mysqli_query(DB::$mConnection,$sql);
													while($l = mysqli_fetch_assoc($rs)){
													 $selected ="";
													 if($team['group_id'] == $l['id']){
															$selected =  " selected ";
													 }
		
														echo "<option value='$l[id]' $selected>".displaySubStringWithStrip($l["name"],30)."</option>";
														exibe_filhos($l["id"],$indentacao,$team['group_id']);
													}
													
													 ?>
											</select>
											<div name="select_group_id" id="select_group_id" class="cjt-wrapped-select-skin">Informe a categoria</div>
											<div class="cjt-wrapped-select-icon"></div>
											</div>  
										</div> 
									</div> 
									
									<div style="clear:both;"class="report-head">Este é um dos anúncios da galeria premium <span class="cpanel-date-hint">  </span>  </div>
									<div class="group">
										<input style="width:20px;" type="radio"  <? if($team['ehdestaque'] =="Y" ){echo "checked='checked'";}?>   value="Y"    id="ehdestaque" name="ehdestaque"> Sim  &nbsp;<img style="cursor:help" class="tTip" title="O sistema irá buscar aleatoriamente todos os anúncios que você colocou para aparecer em destaque para mostrar 5 anúncios por vêz." src="<?=$ROOTPATH?>/media/css/i/info.png">
										<input style="width:20px;" type="radio" <? if($team['ehdestaque'] =="N" or $team['ehdestaque'] ==""){echo "checked='checked'";}?>  value="N" id="ehdestaque"  name="ehdestaque" > Não  &nbsp; 
									 </div>	
								</div>
								<!-- =============================   fim coluna esquerda   =====================================-->
								<!-- =============================   coluna direita   =====================================-->
								<div class="ends">
									
									<div id="parceirobk">
										<div class="report-head">Anunciante <span class="cpanel-date-hint">Deixe em branco caso não tenha.</span></div>
										<div class="cjt-wrapped-select" id="type-select-cjt-wrapped-select">
											<select  name="user_id" id="user_id" onchange="$('#select_user_id').text($('#user_id').find('option').filter(':selected').text())"> 
												<option value="">Informe o anunciante</option>
												<?php echo Utility::Option($users, $team['user_id']); ?>
											</select>
											<div name="select_user_id" id="select_user_id" class="cjt-wrapped-select-skin">Informe o anunciante</div>
											<div class="cjt-wrapped-select-icon"></div>
										</div>  
									</div>
									
									
									<div class="report-head">Ordenação: <span class="cpanel-date-hint"></span></div>
									<div class="group">
										<input type="text" id="sort_order" maxlength="11" onKeyPress="return SomenteNumero(event);"  name="sort_order" value="<?php echo $team['sort_order'] ? $team['sort_order'] : 0; ?>"> &nbsp;<img class="tTip" title="Informe a ordem de posicionamento deste anúncio no site. Oferta com número de ordem maior ficam em primeiro lugar. ( coluna da direita )" style="cursor:help" id="Search_ToolTip" src="<?=$ROOTPATH?>/media/css/i/info.png">
									</div>
									  
									  								
										
									 <div style="float:left; width:100%;">
									     <div class="report-head">Publicação: <span class="cpanel-date-hint"></span></div>
										<input style="width:20px;" type="radio" <?=$status1?> value="1" name="status"> Ativa    &nbsp;<img class="tTip" title="Os anúncios só serão publicados no site se estiverem Pagos e com o status Ativa" style="cursor:help" id="Search_ToolTip" src="<?=$ROOTPATH?>/media/css/i/info.png">   
										<input style="width:20px;" type="radio" <?=$status0?> value="0" name="status"> Aguardando Moderação
										<input style="width:20px;" type="radio" <?=$status2?> value="2" name="status"> Reprovada
									 </div> 
									 
									 <div style="float:left; width:100%;">
									     <div class="report-head">Status Pagamento: <span class="cpanel-date-hint"></span></div>
										<input style="width:20px;" type="radio" <? if($team['pago']=="sim"){ echo "checked=checked"; }?> value="sim" name="pago"> Pago   &nbsp;<img class="tTip" title="Os anúncios só serão publicados no site se estiverem Pagos e com o status Ativa" style="cursor:help" id="Search_ToolTip" src="<?=$ROOTPATH?>/media/css/i/info.png">     
										<input style="width:20px;" type="radio" <? if($team['anunciogratis']=="s" and $team['pago']!="sim"){ echo "checked=checked"; }?> value="anunciogratis" name="pago"> Grátis   &nbsp;<img class="tTip" title="Quando você altera um anúncio para grátis, ele irá ser publicado logo após você alterar o campo Publicação para Ativa " style="cursor:help" id="Search_ToolTip" src="<?=$ROOTPATH?>/media/css/i/info.png">     
										<input style="width:20px;" type="radio" <? if($team['pago']!="sim" and $team['anunciogratis']!="s"){ echo "checked=checked"; }?>   value="" name="pago"> Pendente 
									 </div>
										 
								 </div>
								<!-- =============================  fim coluna direita  =====================================-->
							</div> 
						</div>
					</div>
				</div>
				<!-- ********************************************* ABA Controle de Estoque e periodo --> 
				<div class="option_box">
					<div class="top-heading group">
						<div class="left_float"><h4>Controle de Período</h4></div>
					</div> 
					<div id="container_box">
						<div id="option_contents" class="option_contents">  
							<div class="form-contain group">
								<!-- =============================   coluna esquerda   =====================================-->
								<div class="starts">
									 <div class="report-head">Data início: <span class="cpanel-date-hint"></span></div>
									<div class="group">
										<input style="width:40%;" type="text"  xd="<?php echo date('d/m/Y', $team['begin_time']); ?>" name="begin_time" id="begin_time" class="format_input ckeditor"  maxlength="10"  value="<?php echo date('d/m/Y', $team['begin_time']); ?>"/>
										 <img  style="cursor:pointer;" onclick="javascript:displayCalendar(document.forms[0].begin_time,'dd/mm/yyyy',this);" alt="select date" src="<?=$ROOTPATH?>/media/css/i/calendar.png"> 
									</div>
									
									<div class="report-head">Hora início: <span class="cpanel-date-hint"></span></div>
									<div class="group">
										<input style="width:40%;" type="text" id="begin_time2"  name="begin_time2"  value="<?php echo  $team['begin_time2'] ; ?>"  class="format_input ckeditor"  maxlength="10"  />
									</div> 
									
								</div>
								<!-- ============================= // fim coluna esquerda // =====================================-->
								<!-- ============================= // coluna direita // =====================================-->
								<div class="ends"> 
									  
									<div class="report-head">Data fim: <span class="cpanel-date-hint"></span></div>
									<div class="group">
										<input style="width:40%;" type="text"  xd="<?php echo date('d/m/Y', $team['end_time']); ?>" name="end_time" id="end_time" class="format_input ckeditor"  maxlength="10"  value="<?php echo date('d/m/Y', $team['end_time']); ?>"/>
										 <img  style="cursor:pointer;" onclick="javascript:displayCalendar(document.forms[0].end_time,'dd/mm/yyyy',this);" alt="select date" src="<?=$ROOTPATH?>/media/css/i/calendar.png"> 
									</div> 
								 
									<div class="report-head">Hora fim: <span class="cpanel-date-hint"></span></div>
									<div class="group">
										<input style="width:40%;" type="text" name="end_time2" id="end_time2"   value="<?php echo  $team['end_time2'] ; ?>"  class="format_input ckeditor"  maxlength="10"  />
									</div> 
									 
								 </div>
								</div>
								<!-- ============================= // fim coluna direita // =====================================-->
							</div> 
						</div>
					</div>
					
					<!-- ********************************************* ABA Informações de preço e pagamento --> 
					
				<div class="option_box" id="abapagamento">
					<div class="top-heading group">
						<div class="left_float"><h4>Informações de Preço</h4></div>
					</div> 
					<div id="container_box">
						<div id="option_contents" class="option_contents">  
							<div class="form-contain group">
								<!-- =============================   coluna esquerda   =====================================-->
								<div class="starts">   
									<div id="c_valores">
									 
										<div style="clear:both;"class="report-head">Preço: <span class="cpanel-date-hint"></span></div>
										<div class="group">
											<input type="text" name="team_price"  id="team_price"   class="format_input ckeditor"   value="<?php echo  $team['team_price'] ; ?>"  />   
										</div> 	
									</div>
								  
								</div>
								<!-- ============================= // fim coluna esquerda // =====================================-->
								<!-- ============================= // coluna direita // =====================================-->
									<div class="ends">  
										<div style="float:left; width:100%; margin-top: 15px;margin-bottom:11px;">
										   <span class="report-label">Mostrar Preço:</span>  
											<input style="width:20px;" type="radio" <?=$mostrarprecosim?> value="1" name="mostrarpreco"> Sim      
											<input style="width:20px;" type="radio" <?=$mostrarpreconao?> value="0" name="mostrarpreco"> Não
										 </div>
								   </div> 
								</div>
								<!-- ============================= // fim coluna direita // =====================================-->
							</div> 
						</div>
					</div>
				 
			<!-- ********************************************* ABA Fotos --> 
				<div class="option_box">
					<div class="top-heading group"> <div class="left_float">  </div> </div> 
					<div id="container_box">
						<div id="option_contents" class="option_contents">  
							<div class="form-contain group">
								<!-- =============================   coluna esquerda   =====================================-->
								<div class="starts">  
									<div style="clear:both;"class="report-head">Foto 1: <span class="cpanel-date-hint">TAMANHO MÁXIOM 2MB</span></div>  
									<div class="group">
										<input type="file" style="border: 1px solid #C1D0D3; color: #666666; width: 86%;" name="upload_image"  id="upload_image" class="format_input ckeditor"  value="<?php  $team['upload_image'] ; ?>" />  <?php if($team['image']){?> <br><span style="clear:both;" class="cpanel-date-hint"> <?php echo team_image($team['image']); ?>&nbsp;&nbsp;<a href="javascript:delimagem(<?php echo $team['id']; ?>, 'image');" ><img style="width: 13px;" src="<?=$ROOTPATH?>/media/css/i/excluir.png" /> </a></span> <?php }?>
									 </div> 
									<div style="clear:both;"class="report-head">Foto 2: <span class="cpanel-date-hint">TAMANHO MÁXIOM 2MB</span></div>
									<div class="group">
										<input type="file" style="border: 1px solid #C1D0D3; color: #666666; width: 86%;" name="upload_image1"  id="upload_image1" class="format_input ckeditor"   value="<?php  $team['upload_image1'] ; ?>" />   <?php if($team['image1']){?> <br><span style="clear:both;" class="cpanel-date-hint"><?php echo team_image($team['image1']); ?>&nbsp;&nbsp;<a href="javascript:delimagem(<?php echo $team['id']; ?>, 'image1');"><img style="width: 13px;" src="<?=$ROOTPATH?>/media/css/i/excluir.png" /> </a> </span><?php }?> 
									</div> 
									<div style="clear:both;"class="report-head">Foto 3: <span class="cpanel-date-hint">TAMANHO MÁXIOM 2MB</span></div>
									<div class="group">
										<input type="file" style="border: 1px solid #C1D0D3; color: #666666; width: 86%;" name="upload_image2"  id="upload_image2" class="format_input ckeditor"   value="<?php  $team['upload_image2'] ; ?>" />   <?php if($team['image2']){?><br><span style="clear:both;" class="cpanel-date-hint"> <?php echo team_image($team['image2']); ?>&nbsp;&nbsp;<a href="javascript:delimagem(<?php echo $team['id']; ?>, 'image2');"><img style="width: 13px;" src="<?=$ROOTPATH?>/media/css/i/excluir.png" /> </a> </span><?php }?>
									</div> 
									<div style="clear:both;"class="report-head">Foto 4: <span class="cpanel-date-hint">TAMANHO MÁXIOM 2MB</span></div>
									<div class="group">
										<input type="file" style="border: 1px solid #C1D0D3; color: #666666; width: 86%;" name="gal_upload_image1"  id="gal_upload_image1" class="format_input ckeditor"   value="<?php  $team['gal_upload_image1'] ; ?>" />   <?php if($team['gal_image1']){?> <br><span style="clear:both;" class="cpanel-date-hint"><?php echo team_image($team['gal_image1']); ?>&nbsp;&nbsp;<a  href="javascript:delimagem(<?php echo $team['id']; ?>, 'gal_image1');"><img style="width: 13px;" src="<?=$ROOTPATH?>/media/css/i/excluir.png" /> </a> </span><?php }?>
									</div>  
								</div>
								<!-- ============================= // fim coluna esquerda // =====================================-->
								<!-- ============================= // coluna direita // =====================================-->
								<div class="ends"> 
									<div style="clear:both;"class="report-head">Foto 5:  <span class="cpanel-date-hint">TAMANHO MÁXIOM 2MB</span></div>
									<div class="group">
										<input type="file" style="border: 1px solid #C1D0D3; color: #666666; width: 86%;" name="gal_upload_image2"  id="gal_upload_image5" class="format_input ckeditor"   value="<?php  $team['gal_upload_image2'] ; ?>" /> <?php if($team['gal_image2']){?><br><span style="clear:both;" class="cpanel-date-hint"> <?php echo team_image($team['gal_image2']); ?>&nbsp;&nbsp;<a  href="javascript:delimagem(<?php echo $team['id']; ?>, 'gal_image2');"><img style="width: 13px;" src="<?=$ROOTPATH?>/media/css/i/excluir.png" /> </a></span> <?php }?>   
									</div> 
									<div style="clear:both;"class="report-head">Foto 6: <span class="cpanel-date-hint">TAMANHO MÁXIOM 2MB</span></div>
									<div class="group">
										<input type="file" style="border: 1px solid #C1D0D3; color: #666666; width: 86%;" name="gal_upload_image3"  id="gal_upload_image6" class="format_input ckeditor"   value="<?php  $team['gal_upload_image3'] ; ?>" />   <?php if($team['gal_image3']){?><br><span style="clear:both;" class="cpanel-date-hint"> <?php echo team_image($team['gal_image3']); ?>&nbsp;&nbsp;<a  href="javascript:delimagem(<?php echo $team['id']; ?>, 'gal_image3');"><img style="width: 13px;" src="<?=$ROOTPATH?>/media/css/i/excluir.png" /> </a></span><?php }?>
									</div> 
									<div style="clear:both;"class="report-head">Foto 7: <span class="cpanel-date-hint">TAMANHO MÁXIOM 2MB</span></div>
									<div class="group">
										<input type="file" style="border: 1px solid #C1D0D3; color: #666666; width: 86%;" name="gal_upload_image4"  id="gal_upload_image7" class="format_input ckeditor"   value="<?php  $team['gal_upload_image4'] ; ?>" />  <?php if($team['gal_image4']){?> <br><span style="clear:both;" class="cpanel-date-hint"><?php echo team_image($team['gal_image4']); ?>&nbsp;&nbsp;<a  href="javascript:delimagem(<?php echo $team['id']; ?>, 'gal_image4');"><img style="width: 13px;" src="<?=$ROOTPATH?>/media/css/i/excluir.png" /> </a></span> <?php }?> 
									</div> 
									<div style="clear:both;"class="report-head">Foto 8: <span class="cpanel-date-hint">TAMANHO MÁXIOM 2MB</span></div>
									<div class="group">
										<input type="file" style="border: 1px solid #C1D0D3; color: #666666; width: 86%;" name="gal_upload_image5"  id="gal_upload_image8" class="format_input ckeditor"   value="<?php  $team['gal_upload_image5'] ; ?>" />   <?php if($team['gal_image5']){?> <br><span style="clear:both;" class="cpanel-date-hint"><?php echo team_image($team['gal_image5']); ?>&nbsp;&nbsp;<a href="javascript:delimagem(<?php echo $team['id']; ?>, 'gal_image5');"><img style="width: 13px;" src="<?=$ROOTPATH?>/media/css/i/excluir.png" /> </a> </span><?php }?>
									</div> 
								 </div> 
								</div>
								<!-- ============================= // fim coluna direita // =====================================-->
							</div> 
						</div>
					</div> 
							 
					
					 <!-- ********************************************* ABA Descrição da oferta --> 
					<div class="option_box">
						<div class="top-heading group"> <div class="left_float"><h4>Descrição</h4> </div> &nbsp;<img class="tTip" title="DICA: Se você está copiando esta descrição de algum site ou documento, recomendamos primeiro copiar e colar no bloco de notas, logo em seguida, copie do bloco de notas e cole aqui no editor. Isto irá retirar todas as formatações indevidas. Uma vez que isto pode danificar o seu site." style="cursor:help" id="Search_ToolTip" src="<?=$ROOTPATH?>/media/css/i/info.png"> </div> 
						 
						<div id="container_box">
							<div id="option_contents" class="option_contents">  
								<div class="form-contain group"> 
									<div class="text_area">  
									<textarea cols="45" rows="5" name="summary" style="width:100%" id="summary" class="format_input ckeditor" ><?php echo htmlspecialchars($team['summary']); ?></textarea>
									</div> 
								</div> 
							</div> 
						</div>
					</div>	 
					 
				</div> 
				<div class="option_box"> 
					<div id="container_box">
						<div id="option_contents" class="option_contents">
							<div class="the-button">
								<button onclick="doupdate();" id="run-button" class="input-btn doUpdate" type="button">
									<div id="spinner-text2">Salvar</div>
								</button>
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
var www = jQuery("#www").val();

 
$("#end_time").mask("99/99/9999");
$("#begin_time").mask("99/99/9999");
$("#end_time2").mask("99:99");
$("#begin_time2").mask("99:99");

$('#team_price').priceFormat({
    prefix: 'R$ ',
    centsSeparator: ',',
    thousandsSeparator: '.'
});

/*
$('#team_price').priceFormat({
	prefix: '',
    suffix: ' €',
    centsSeparator: ',',
    thousandsSeparator: '.'
});

*/

	 	
if( jQuery("#id").val() != ""){
	$('#select_user_id').text($('#user_id').find('option').filter(':selected').text());
	$('#select_city_id').text($('#city_id').find('option').filter(':selected').text());
	$('#select_group_id').text($('#group_id').find('option').filter(':selected').text());
}


function doupdate(){

	if(validador()){
		$("#spinner-text").css("opacity", "0.2");
		$("#spinner-text2").css("opacity", "0.2");
		jQuery("#imgrec").show()
		jQuery("#imgrec2").show()
		document.forms[0].submit();
	}
}
 

function campoobg(campo){
	$("#"+campo).css("background", "#F9DAB7");
 
}

 
function delimagem(idoferta,campo){
 
$.get(WEB_ROOT+"/vipmin/delgal.php?id="+idoferta+"&gal="+campo,
 			
   function(data){
      if(jQuery.trim(data)==""){
     	alert("Imagem apagada com sucesso. Após finalizar a edição de anúncio clique no botão salvar para efetivar a exclusão desta imagem. ");
	  }  
	  else{
		  alert(data)
	  }
   });
}


function limpacampos(){		 
	$("input[type=text]").each(function(){ 
		$("#"+this.id).css("background", "#fff");
	}); 
	$("#upload_image").css("background", "#fff");
	
}


function validador(){
	
	limpacampos();
	tipopferta = $("input[@name=team_type]:checked").attr('value');

	if( jQuery("#title").val()==""){

		campoobg("title");
		alert("Por favor, informe o título do anúncio");
		jQuery("#title").focus();
		return false;
	}	
	if( jQuery("#uf").val()==""){

		campoobg("uf");
		alert("Por favor, informe o estado.");
		jQuery("#uf").focus();
		return false;
	}	
	if( jQuery("#city_id").val()==""){

		campoobg("city_id");
		alert("Por favor, informe a cidade.");
		jQuery("#city_id").focus();
		return false;
	}
	if( jQuery("#group_id").val()==""){

		campoobg("group_id");
		alert("Por favor, informe a categoria.");
		jQuery("#group_id").focus();
		return false;
	}
   if( jQuery("#user_id").val()==""){

		campoobg("user_id");
		alert("Por favor, informe o anunciante.");
		jQuery("#user_id").focus();
		return false;
	}

	 upload_image_bd  = '<?=$team['image']?>';
	  
	 if( jQuery("#upload_image").val() == "" && upload_image_bd == ""){
		
		alert("Por favor, faça upload da primeira foto ao menos.");
		campoobg("upload_image");
		jQuery("#upload_image").focus();
		return false;
	 }
 	
	 
	return true;	
} 
 

 

</script>   
  