<?php include template("manage_header");?>
<?php require("ini.php");?> 

 
 
<div id="bdw" class="bdw">
<div id="bd" class="cf">
<div id="leader">
	<div id="content" class="clear mainwide">
        <div class="clear box"> 
            <div class="box-content">
                <div class="sect">
				 <form id="login-user-form" method="post" action="/vipmin/category/editestado.php?id=<?php echo $category['id']; ?>" enctype="multipart/form-data" class="validator">
				<input type="hidden" name="id" value="<?php echo $category['id']; ?>" />
				<input type="hidden" name="www" id="www"  value="<?=$INI['system']['wwwprefix']?>" /> 
				<div class="option_box">
					<div class="top-heading group">
						<div class="left_float"><h4>Informações do Estado <?php echo $category['nome']; ?></h4></div>
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
								 
								
									<div style="clear:both;"class="report-head">UF: <span class="cpanel-date-hint">2 caracteres</span></div>
									<div class="group">
										<input type="text" name="uf"  maxlength="2" id="uf" class="format_input ckeditor" value="<?php echo $category['uf'] ?>" /> 
									</div>	
									
									<div style="clear:both;"class="report-head">Nome: <span class="cpanel-date-hint"></span></div>
									<div class="group">
										<input type="text" name="nome"  maxlength="100" id="nome" class="format_input ckeditor" value="<?php echo $category['nome'] ?>" /> 
									</div>
									
							 
								</div>
								<!-- =============================   fim coluna esquerda   =====================================-->
								<!-- =============================   coluna direita   =====================================-->
								<div class="ends"> 	 			 
								 
								 						
							 	</div>
								<!-- =============================  fim coluna direita  =====================================-->
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
 
function validador(){
 
	limpacampos(); 

	if( jQuery("#name").val()==""){

		campoobg("name");
		alert("Por favor, informe o nome ");
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

 <script>
jQuery(document).ready(function() {
	jQuery('#car_tipo').bind('change', function(ev) {
		buscaFiltros('fabricante2');
	});
	//buscaFiltros('fabricante');
});

	function buscaFiltros(filtro) {
		jQuery.ajax({
			url:  "<?php echo $ROOTPATH; ?>/ajax/filtro_pesquisa.php",
			type: "POST",
			data: {
				filtro: filtro,
				tipo: jQuery('#car_tipo').val(),
			},
			beforeSend: function() {
				if (filtro == 'fabricante2') {
					jQuery('#fabricante').html("<option>Carregando...</option>");
				}
			},
			success: function(r) {
				if (filtro == 'fabricante2')
					jQuery('#fabricante').html(r);
			}
		});
	}
</script>