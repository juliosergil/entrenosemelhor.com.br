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
						<div class="col-md-6 col-xs-12 col-sm-12" style="padding-top: 6px; padding-left: 0px;">
							<h4>Informações gerais do anúncio <?=$team['id']?></h4>
						</div>
						<div class="the-button col-md-6 col-xs-12 col-sm-12">  
							<input type="hidden" value="<?=$team['pago']?>" readonly="readonly" id="pago" name="pago">
							<input type="hidden" value="<?=$team['anunciogratis']?>" readonly="readonly" id="anunciogratis" name="anunciogratis">
							<input type="hidden" name="user_id" id="user_id" value="<?=$iduser?>" > 
							<div class="col-md-3 col-xs-12 col-sm-12">
								<button id="run-button" class="input-btn btn btn-success doUpdate" type="button"><div name="spinner-top" id="spinner-top" style="width: 83px; display: block;"><img name="imgrec" id="imgrec" src="<?=$ROOTPATH?>/media/css/i/lendo.gif" style="display: none;"></div> Salvar </button>
							</div>
							<div class="col-md-3 col-xs-12 col-sm-12">
								<button  onclick="javascript:location.href='index.php'"  id="run-button" class="input-btn btn btn-primary" type="button"><div name="spinner-top" id="spinner-top" style="width: 83px; display: block;"><img name="imgrec" id="imgrec" src="<?=$ROOTPATH?>/media/css/i/lendo.gif" style="display: none;"></div> Listar meus anúncios </button>
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
														$tmp_estado = $row['uf'];
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
											       $sql = "select * from category where idpai=0 order by sort_order desc";
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
					<div class="top-heading group"> 
						<div class="left_float">
							<span class="style2" style="margin-left:5px;">   
								Imagens do anúncio </span><span class="style5"> Resolução ideal 530px x 400px - No máximo 6 imagens por anúncio</span></div> 
					</div> 
					<div id="container_box">
						<div id="option_contents" class="option_contents">  
							<div class="form-contain group">
								<!-- =============================   coluna esquerda   =====================================-->
								<div class="starts col-md-6 col-xs-12 col-sm-12 col-md-6 col-xs-12 col-sm-12">  
									<div style="clear:both;"class="report-head">Para escolher várias imagens, mantenha a tecla CTRL pressionada e clique nas imagens desejadas  <span class="cpanel-date-hint"><span id="dimensao"></span>  </span> 
									</div>
									<div class="group">
										<input type="file" multiple name="tempImg"  id="tempImg" class="form-control"  /> 
									 </div> 
									
								</div>
								<!-- ============================= // fim coluna esquerda // =====================================-->
								<!-- ============================= // coluna direita // =====================================-->
								<div class="ends col-md-6 col-xs-12 col-sm-12 col-md-6 col-xs-12 col-sm-12"> 
									<div class="preview">
													<?php
														if($team['id']){
															$images = getimagesteam($team['id']);

															foreach ($images as $img) {

																echo "<div class='preview-thumbs-container preview-id-".$img['id']."'>";
																echo "<i class='far fa-times-circle' data-img='".$img['id']."'></i>";
																echo "<img class='team-thumb' src='".$ROOTPATH."/media/team/".$img['img']."' />";
																echo "</div>";

															}
														}
													?>
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
									<textarea name="summary" id="summary" class="form-control" >
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
								<button  id="run-button" class="btn btn-success btn-block doUpdate" type="button">
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


  jQuery('.fa-times-circle').click(function(e){

	    	var id = jQuery(this).attr('data-img');

	    	console.log(id);

	    	URL = "<?php echo $ROOTPATH; ?>/ajax/deleteimages.php";
	    	jQuery.ajax({
				url: URL,
				type: 'POST',
				data: { filtro: 'del_image_gal', image: id },
				success: function(r) {
					console.log(r);
					jQuery('.preview-id-'+id).remove();
					alert("Imagem removida com sucesso!");
				}
			});


	    });




	 	
if( jQuery("#id").val() != ""){
 
	$('#select_city_id').text($('#city_id').find('option').filter(':selected').text());
	$('#select_group_id').text($('#group_id').find('option').filter(':selected').text());
}


	$(".doUpdate").click(function(e){
		e.preventDefault();
		e.stopPropagation();

		if(validador()){
			var data = saveTeamData();
		}
	});


	//COMPRIME AS IMAGENS ASSIM QUE SÃO SELECIONADAS E ADD A UM ARRAY.
	// Initialization
	const compress = new Compress()
	const imgsStr = [];
	
	compress.attach('#tempImg', {
	  size: 2,
	  quality: .75
	}).then((data) => {

		data.forEach(function(item){
			const img1 = item;
	  		const base64str = img1.prefix+img1.data;
	  		
	  		if(imgsStr.length < 6){
				imgsStr.push(base64str);
			}
	  		
		});
	});


//SALVA OS DADOS DO ANÚNCIO PRIMEIRO
function saveTeamData(){
	
	var fd = $("#nform").serializeArray();

	var fdObj = {};

	fd.map(function(item){
		fdObj[item.name] = item.value;
	})
         
	$.ajax({
		   type: "POST",
		   url: "<?php echo $INI['system']['wwwprefix']?>/adminanunciante/team/edit.php",
		   data: fdObj, 
           dataType: 'json',

		   success: function(data){
		   		//NOVO ANÚNCIO
		   		if(data['status'] == 1){
		   			var edit  = false;
		   		}else if(data['status'] == 2){
		   			var edit = true;	
		   		}else if(data['status'] == 0){
		   			alert(data['msg']);
		   			return false;
		   		}

		   		saveTeamImages(data['id'], edit)
		   }
	});
}



//APÓS SALVAR OS DADOS DO ANÚNCIO ESSA FUNÇÃO SALVA AS FOTOS DO MESMO.
function saveTeamImages(id, edit = false){

	var encodedata = {'id':id,'action':'saveImages',images:imgsStr};

	$.ajax({
		type:"post",
		url:"<?php echo $INI['system']['wwwprefix']?>/ajax/manage.php",
		data :encodedata,
		dataType:"json",
		beforeSend : function(){
			alert("Dados do anúncio salvos com sucesso! Salvando imagens...");
            $(".animationload").show();
        },
        success: function(data){
        	if(data['status'] == 1){
	
   				$(".animationload").hide();
   				
   				if(!edit){
   					alert("Imagens salvas com sucesso! Você será redirecionado para a escolha do plano.");
	   				$(".animationload").hide();
	   				window.location = "<?php echo $ROOTPATH; ?>/adminanunciante/team/pagamentopagseguro.php?id="+id;
   				}else{
   					alert("Imagens salvas com sucesso! ");
	   				$(".animationload").hide();
	   				window.location = "<?php echo $ROOTPATH; ?>/adminanunciante/team/index.php";
   				}

   			}else{
   				alert("Erro ao salvar as imagens do anúncio.");
   				$(".animationload").hide();
   			}
        }
		
	});

	return;
}



function campoobg(campo){
	$("#"+campo).css("background", "#F9DAB7");
}



function validador(){
	
	var images = "<?php echo count($images); ?>";


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

	if(imgsStr.length < 1 && images < 1){
		campoobg("tempImg");
		alert("Por favor, insira pelo menos uma imagem.");
		jQuery("#tempImg").focus();
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