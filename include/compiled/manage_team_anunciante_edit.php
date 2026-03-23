<?php include template("manage_anunciante_header"); ?>
<?php require("ini.php");
 $iduser = $_SESSION['user_id'];
 
 setcookie("vpc", "23", time()+3600);
 
if(!(empty($team['city_id']))) {
	$sql = "select nome from cidades where id = " . $team['city_id'];
	$rs = mysqli_query(DB::$mConnection,$sql);
	$row_city = mysqli_fetch_assoc($rs);
}

?> 

<style>
	.cjt-wrapped-select,
	.option_contents INPUT[type="text"]	{
		width: 100%;
	}
	#type-select-cjt-wrapped-select .cjt-wrapped-select-skin,
	#type-select-cjt-wrapped-select select {
		height: 34px;
	}
	.report-head {
		margin-top: 10px;
		font-size: 13px;
	}
	.label {
		color: #586061 !important;
		padding: 0 !important;
		margin: 0 !important;
		font-size: 13px !important;
		font-weight: bold !important;
	}
	#run-button {
		height: 35px;
		overflow: visible;
		margin-bottom: 15px;
		font-weight: bold;
		text-transform: uppercase;
	}
	
	/* ===== FIX RESPONSIVO TOPO (evita corte no mobile) ===== */
.option_box > .top-heading{
	height: auto !important;
	min-height: 0 !important;
	overflow: visible !important;
}

/* bloco de ações fora do top-heading */
.anuncio-top-actions{
	padding: 10px 10px 0 10px;
}

.anuncio-top-actions .row{
	margin-left: -5px;
	margin-right: -5px;
}

.anuncio-top-actions .acao-col{
	padding-left: 5px;
	padding-right: 5px;
	margin-bottom: 10px;
}

.anuncio-top-actions .input-btn,
.anuncio-top-actions .btn{
	display: block;
	width: 100% !important;
	white-space: normal;
}

/* garante que file inputs não estourem no mobile */
input[type="file"]{
	max-width: 100%;
}

@media (max-width: 767px){
	.anuncio-top-actions{
		padding: 10px 10px 0 10px;
	}
}
</style>
 

<div id="leader" class="container-fluid">
	<div id="content" class="clear mainwide row">
        <div class="clear box"> 
            <div class="box-content">
                <div class="sect">
				<form id="nform"  method="post" action="/adminanunciante/team/edit.php?id=<?php echo $team['id']; ?>" enctype="multipart/form-data" class="validator">
				<input type="hidden" id="id" name="id" value="<?php echo $team['id']; ?>" />
				<div class="option_box">
	<div class="top-heading group" style="padding:0 !important;padding-top:5px !important;">
		<div class="col-md-12 col-xs-12 col-sm-12" style="padding-top: 6px; padding-left: 0px;">
			<h4>Informações gerais do anúncio <?=$team['id']?></h4>
		</div>
	</div>

	<!-- AÇÕES DO TOPO (fora do top-heading para não cortar no mobile) -->
	<div class="anuncio-top-actions">
		<input type="hidden" value="<?=$team['pago']?>" readonly="readonly" id="pago" name="pago">
		<input type="hidden" value="<?=$_REQUEST["idplano"]?>" readonly="readonly" id="idplano" name="idplano">
		<input type="hidden" value="<?=$team['anunciogratis']?>" readonly="readonly" id="anunciogratis" name="anunciogratis">
		<input type="hidden" name="user_id" id="user_id" value="<?=$iduser?>">

		<div class="row">
			<div class="col-md-3 col-sm-6 col-xs-12 acao-col">
				<button onclick="doupdate();" id="run-button" class="input-btn btn btn-success" type="button">
					<div name="spinner-top" id="spinner-top" style="width: 83px; display: block;">
						<img name="imgrec" id="imgrec" src="<?=$ROOTPATH?>/media/css/i/lendo.gif" style="display: none;">
					</div>
					Salvar
				</button>
			</div>

			<div class="col-md-3 col-sm-6 col-xs-12 acao-col">
				<button onclick="javascript:location.href='index.php'" id="run-button" class="input-btn btn btn-primary" type="button">
					<div name="spinner-top" id="spinner-top" style="width: 83px; display: block;">
						<img name="imgrec" id="imgrec" src="<?=$ROOTPATH?>/media/css/i/lendo.gif" style="display: none;">
					</div>
					Listar meus anúncios
				</button>
			</div>
		</div>
	</div>

	<div id="container_box">
		<div id="option_contents" class="option_contents">  
			<div class="form-contain group">
				<!-- =============================   coluna esquerda   =====================================-->
				<div class="starts col-md-6 col-xs-12 col-sm-12 col-md-6 col-xs-12 col-sm-12">
					<div style="clear:both;"class="report-head">
						Título do anúncio:   <img style="cursor:help" class="tTip" title="Tenha certeza que este campo irá conter as principais palavras chaves deste anúncio. Não se esqueça que estas mesmas palavras devem estar no campo descrição do anúncio para otimizar ainda mais as buscas." src="<?=$ROOTPATH?>/media/css/i/info.png"> 
						<span class="cpanel-date-hint"></span>
					</div>
					<div class="group">
						<input type="text" name="title"  maxlength="162" id="title" class="form-control ckeditor" value="<?php echo htmlspecialchars($team['title']); ?>" />
					</div> 
					<div class="report-head">Estado: <span class="cpanel-date-hint"></span></div>
					<div class="group">
						<div class="cjt-wrapped-select" id="type-select-cjt-wrapped-select">
						<select class="form-control ckeditor" name="uf" id="uf" onchange="$('#select_uf').text($('#uf').find('option').filter(':selected').text())"> 
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
				</div>
				<!-- =============================   fim coluna esquerda   =====================================-->
				<!-- =============================   coluna direita   =====================================-->
				<div class="ends col-md-6 col-xs-12 col-sm-12 col-md-6 col-xs-12 col-sm-12">
					<div class="report-head">Cidade: <span class="cpanel-date-hint"></span></div>
					<div class="group">
						<div class="cjt-wrapped-select" id="type-select-cjt-wrapped-select" >
						<select  name="city_id" id="city_id" onchange="$('#select_city_id').text($('#city_id').find('option').filter(':selected').text())"> 
							<option value=""> </option>
							<?php 
								$SQL = "SELECT * FROM cidades WHERE uf = '{$team['uf']}' order by nome";
								$cidades = mysqli_query(DB::$mConnection,$SQL) or die(mysqli_error(DB::$mConnection));
								while ($row = mysqli_fetch_array($cidades, MYSQLI_ASSOC)) {
									if ($team['city_id'] == $row['id']) { 
										echo "<option value='{$row['id']}' selected >{$row['nome']}</option>";
									} else {
										echo "<option value='{$row['id']}'>{$row['nome']}</option>";
									}
								} 
							?>
						</select> 
						<div name="select_city_id" id="select_city_id" class="cjt-wrapped-select-skin">
							<?php echo empty($row_city['nome']) ? "Todas as cidades" : $row_city['nome']; ?>
						</div>
						<div class="cjt-wrapped-select-icon"></div>
						</div>   
					</div> 									
						<div id="c_categoria">
						<div class="report-head">Categoria: <span class="cpanel-date-hint"></span></div>
						<div class="group">
							<div class="cjt-wrapped-select" id="type-select-cjt-wrapped-select">
							<select  name="group_id" id="group_id" onchange="$('#select_group_id').text($('#group_id').find('option').filter(':selected').text())"> 
								<option value=""> </option>
								 <?php 											
								   
								   $indentacao = "....";
							       $sql = "select * from category where idpai=0 order by sort_order desc, name asc";
									$rs = mysqli_query(DB::$mConnection,$sql);
									while($l = mysqli_fetch_assoc($rs)){
									 $selected ="";
									 if($team['group_id'] == $l['id']){
											$selected =  " selected ";
									 }

										echo "<option value='".$l['id']."' $selected>".substr($l['name'],0,30)."</option>";
										exibe_filhos($l["id"],$indentacao,$team['group_id']);
									}
									
									 ?>
							</select>
							<div name="select_group_id" id="select_group_id" class="cjt-wrapped-select-skin">Informe a categoria</div>
							<div class="cjt-wrapped-select-icon"></div>
							</div>  
						</div> 
					</div> 
			
					<div style="float:left; width:100%; margin-top: 15px;margin-bottom:11px; display:none">
					   <span class="report-label">Mostrar mensagem de segurança</span>  
						<input style="width:20px;" type="radio" checked="checked" value="1" name="mostrarseguranca"> Sim       
					 </div>
					 
				 </div>
				<!-- =============================  fim coluna direita  =====================================-->
			</div> 
		</div>
	</div>
</div>
				<!-- ********************************************* ABA Controle de Estoque e periodo --> 
				<div class="option_box" style="display:none;">
					<div class="top-heading group">
						<div class="left_float"><h4>Controle de Período</h4></div>
					</div> 
					<div id="container_box">
						<div id="option_contents" class="option_contents">  
							<div class="form-contain group">
								<!-- =============================   coluna esquerda   =====================================-->
								<div class="starts col-md-6 col-xs-12 col-sm-12 col-md-6 col-xs-12 col-sm-12">
									 <div class="report-head">Data início: <span class="cpanel-date-hint"></span></div>
									<div class="group">
										<input style="width:40%;" type="text"  xd="<?php echo date('d/m/Y', $team['begin_time']); ?>" name="begin_time" id="begin_time" class="form-control ckeditor"  maxlength="10"  value="<?php echo date('d/m/Y', $team['begin_time']); ?>"/>
										 <img  style="cursor:pointer;" onclick="javascript:displayCalendar(document.forms[0].begin_time,'dd/mm/yyyy',this);" alt="select date" src="<?=$ROOTPATH?>/media/css/i/calendar.png"> 
									</div>
									
									<div class="report-head">Hora início: <span class="cpanel-date-hint"></span></div>
									<div class="group">
										<input style="width:40%;" type="text" id="begin_time2"  name="begin_time2"  value="<?php echo  $team['begin_time2'] ; ?>"  class="form-control ckeditor"  maxlength="10"  />
									</div> 
									
								</div>
								<!-- ============================= // fim coluna esquerda // =====================================-->
								<!-- ============================= // coluna direita // =====================================-->
								<div class="ends col-md-6 col-xs-12 col-sm-12 col-md-6 col-xs-12 col-sm-12"> 
									  
									<div class="report-head">Data fim: <span class="cpanel-date-hint"></span></div>
									<div class="group">
										<input style="width:40%;" type="text"  xd="<?php echo date('d/m/Y', $team['end_time']); ?>" name="end_time" id="end_time" class="form-control ckeditor"  maxlength="10"  value="<?php echo date('d/m/Y', $team['end_time']); ?>"/>
										 <img  style="cursor:pointer;" onclick="javascript:displayCalendar(document.forms[0].end_time,'dd/mm/yyyy',this);" alt="select date" src="<?=$ROOTPATH?>/media/css/i/calendar.png"> 
									</div> 
								 
									<div class="report-head">Hora fim: <span class="cpanel-date-hint"></span></div>
									<div class="group">
										<input style="width:40%;" type="text" name="end_time2" id="end_time2"   value="<?php echo  $team['end_time2'] ; ?>"  class="form-control ckeditor"  maxlength="10"  />
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
								<div class="starts col-md-6 col-xs-12 col-sm-12 col-md-6 col-xs-12 col-sm-12">   
									<div id="c_valores">
									 
										<div style="clear:both;"class="report-head">Preço: <span class="cpanel-date-hint"></span></div>
										<div class="group">
											<?php
												if($team['team_price'] == 0){
													$price = "";
												}else{
													$price = $team['team_price'];
												}
											?>
											<input type="text" name="team_price"  id="team_price"   class="form-control ckeditor"   value="<?php echo  $price ; ?>"  />
										</div> 	
									</div>
								  
								</div>
								<!-- ============================= // fim coluna esquerda // =====================================-->
								<!-- ============================= // coluna direita // =====================================-->
									<div class="ends col-md-6 col-xs-12 col-sm-12 col-md-6 col-xs-12 col-sm-12">  
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
						<div class="top-heading group">
							<div class="left_float">
								<h4>
									Descrição
								</h4> 
							</div>
							&nbsp;<img class="tTip" title="DICA: Se você está copiando esta descrição de algum site ou documento, recomendamos primeiro copiar e colar no bloco de notas, logo em seguida, copie do bloco de notas e cole aqui no editor. Isto irá retirar todas as formatações indevidas." style="cursor:help" id="Search_ToolTip" src="<?=$ROOTPATH?>/media/css/i/info.png"> 
						</div> 
						<div id="container_box">
							<div id="option_contents" class="option_contents">  
								<div class="form-contain group"> 
									<div class="text_area">  
									<textarea name="summary" id="summary" class="form-control ckeditor" >
										<?php echo htmlspecialchars($team['summary']); ?></textarea>
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
								<button onclick="doupdate();" id="run-button" class="btn btn-success btn-block doUpdate" type="button">
									<div id="spinner" style="width: 83px; display: block;"> <img name="imgrec2" id="imgrec2" src="<?=$ROOTPATH?>/media/css/i/lendo.gif" style="display: none;"></div>
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
	<div class="animationload">
        <div class="osahanloading"></div>
    </div> 
<script>
var www = jQuery("#www").val();

URL = "<?php echo $ROOTPATH; ?>/ajax/filtro_pesquisa.php";
jQuery(function() {
	jQuery('#uf').bind('change', function(ev) {
		jQuery.ajax({
			url: URL,
			type: 'POST',
			data: { filtro: 'cidades', estado: jQuery('#uf').val() },
			beforeSend: function() { 
				jQuery('#city_id').html('<option>Carregando...</option>');
			},
			success: function(r) {
				jQuery('#select_city_id').html('Selecione uma cidade');
				jQuery('#city_id').html(r);
			}
		});
	});
});    

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

	 	
if( jQuery("#id").val() != ""){
 
	$('#select_city_id').text($('#city_id').find('option').filter(':selected').text());
	$('#select_group_id').text($('#group_id').find('option').filter(':selected').text());
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
	 

	if( jQuery("#title").val()==""){

		campoobg("title");
		alert("Por favor, informe o título do anúncio.");
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

	 upload_image_bd  = '<?=$team['image']?>';
	  
	 if( jQuery("#upload_image").val() == "" && upload_image_bd == ""){
		
		alert("Por favor, faça upload da primeira foto ao menos.");
		campoobg("upload_image");
		jQuery("#upload_image").focus();
		return false;
	 }

	 if( jQuery("#id").val() ==""){
	 	<?php if ($pago == 'sim') {
			if ($INI['option']['moderacaoanuncios']=="N") {
		?>
			alert("Seu anúncio foi publicado.");
		<?php } else { ?>
			alert("Seu anúncio será moderado e então publicado. Este processo pode durar até 24 horas. Obrigado.");		
		<? }
		} else {
			?>
			alert("Seu anúncio está sendo cadastrado e ficará armazenado em sua conta. \n Iremos lhe redirecionar para a escolha do plano desejado");
		<? } ?>
	 }
	 
	return true;	
}

</script>   