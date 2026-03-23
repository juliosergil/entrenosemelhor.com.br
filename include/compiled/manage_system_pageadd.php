<?php include template("manage_header");?>
 
<div id="bdw" class="bdw">
<div id="bd" class="cf">
<div id="partner"> 
	<div id="content" class="clear mainwide">
        <div class="clear box">
            <div class="box-top"></div>
		  <form id="login-user-form" method="post" action="/vipmin/system/pageadd.php?id=<?php echo $id ?>" enctype="multipart/form-data" class="validator">
            <div class="box-content">  
				<input  type="hidden"  value="<?=$id ?>" name="idmodelo"  id="idmodelo"  >
				<input  type="hidden"  value="<?=$id?>" name="id"  id="id"  >
				<input  type="hidden"  value="" name="cpverifica_categoria"  id="cpverifica_categoria"  >
				<div class="option_box">
					 <div class="top-heading group">
							<div class="left_float"><h4><b><span name="modificacao" id="modificacao"></span></b> </h4></div>
							<div class="the-button" style="width:570px;">
								<input type="hidden" value="remote" id="deliverytype" name="deliverytype">
								<button onclick="javascript:location.href='pageadd.php'" id="run-button" class="input-btn" type="button"> <div name="spinner-top" id="spinner-top" style="width: 83px; display: block;"><img name="imgrec" id="imgrec" src="<?=$ROOTPATH?>/media/css/i/lendo.gif" style="display: none;"></div><div id="spinner-text"  >Nova</div></button> 
								<button onclick="doupdate();" id="run-button" class="input-btn" type="button"> <div name="spinner-top" id="spinner-top" style="width: 83px; display: block;"><img name="imgrec" id="imgrec" src="<?=$ROOTPATH?>/media/css/i/lendo.gif" style="display: none;"></div><div id="spinner-text"  >Salvar</div></button>
								 <button onclick="visualizar();" id="run-button" class="input-btn" type="button"> <div name="spinner-top" id="spinner-top" style="width: 83px; display: block;"><img name="imgrec" id="imgrec" src="<?=$ROOTPATH?>/media/css/i/lendo.gif" style="display: none;"></div><div id="spinner-text"  >Visualizar</div></button>
								<button onclick="javascript:location.href='page.php'" id="run-button" class="input-btn" type="button"> <div name="spinner-top" id="spinner-top" style="width: 83px; display: block;"><img name="imgrec" id="imgrec" src="<?=$ROOTPATH?>/media/css/i/lendo.gif" style="display: none;"></div><div id="spinner-text"  >Listar</div></button>
							</div> 
						</div>  
				</div> 
				
				<div  class="option_box">  
					<div id="container_box">
						<div id="option_contents" class="option_contents"> 
							<div class="form-contain group"> 
							<!-- =============================   coluna esquerda   =====================================-->
								<div class="starts" style="min-height:114px;"> 
									<div style="clear:both;"class="report-head">Título <span class="cpanel-date-hint"> Todas as páginas serão também adicionadas como novos modelos </span></div>
									<div class="group">
										<input type="text" name="titulo"   id="titulo" class="format_input ckeditor" value="<?=$page['titulo']?>" />  
									</div>	
									
									<div class="report-head">Imagem da capa: <span class="cpanel-date-hint"> DIMENSÃO SUGERIDA: 466px de largura por 247px de altura </span></div>
									<div class="group">
										<input type="file" style="border: 1px solid #C1D0D3; color: #666666; width: 86%;" name="imagemcapa"  id="imagemcapa" class="format_input ckeditor"  /><?php if($page['imagemcapa']){?> 
										<br><span style="clear:both;" class="cpanel-date-hint"> <?php echo team_image($page['imagemcapa']); ?> </span> <?php }?>
									</div>
									
									
									<div class="group">
										<div style="clear:both;"class="report-head">Ativa: <span class="cpanel-date-hint"></span></div>
										<input style="width:20px;" type="radio" <? if($page['status']  =="1" or $status  ==""){echo "checked='checked'";}?>  value="1" name="status" id="status" > Sim  &nbsp;   
										<input style="width:20px;" type="radio" <? if($page['status']   =="0"){echo "checked='checked'";}?>   name="status"  id="status"  value="0"> Não   &nbsp;<img class="tTip" title="Páginas desativadas não aparecem no site. Isto pode ser ideal para você visualizar uma página antes de seus clientes. Para isso, salve a página como desativada, faça as alterações e ao finalizar, visualize, altere para ativa e clique no botão salvar." style="cursor:help" id="Search_ToolTip" src="<?=$ROOTPATH?>/media/css/i/info.png">
									 </div>
									 
									 <div class="group">
										<div style="clear:both;"class="report-head">Página de Artigo: <span class="cpanel-date-hint"></span></div>
										<input style="width:20px;" type="radio" <? if($page['blog']  =="1" or $page['blog']  ==""){echo "checked='checked'";}?>  value="1" name="blog" id="blog" > Sim  &nbsp;   
										<input style="width:20px;" type="radio" <? if($page['blog']   =="0"){echo "checked='checked'";}?>   name="blog"  id="blog"  value="0"> Não   &nbsp;<img class="tTip" title=" Marque sim se este artigo é para aparecer na página de Blog do site" style="cursor:help" id="Search_ToolTip" src="<?=$ROOTPATH?>/media/css/i/info.png">
									 </div>
									 
									 
									 
								</div>
								<!-- ============================= // fim coluna esquerda // =====================================-->
								<!-- ============================= // coluna direita // =====================================-->
								<div class="ends" style="min-height:109px;">  
									 <span class="cpanel-date-hint">Nota: Se retornar uma mensagem de erro ao salvar a página, verifique a formatação do conteúdo do editor. </span>
									 <span class="cpanel-date-hint">Isso pode acontecer se você copiou o texto de alguma página de internet. </span>
									 <span class="cpanel-date-hint">Primeiro, cole esse texto no bloco de notas para retirar a formatação. </span>
									 <span class="cpanel-date-hint">Em seguida, copie do bloco de notas e cole no editor. </span>
								</div> 
							</div> 
						</div>  
					</div> 
					<div class="sect" style="clear:both;" >
						<div class="field" style="width:99%">
							<textarea  id="value" style="width:100%;height:450px;" class="editor ckeditor" name="value"><?php echo htmlspecialchars($page['value'] ); ?></textarea> 
						</div>
					</div>
			</div>
		</div>
		</form>
		<div class="box-bottom"></div>
	</div>
</div>

<div id="sidebar">
</div>

</div>
</div> <!-- bd end -->
</div> <!-- bdw end -->


<script>
 
 function limpacampos(){		 
	$("input[type=text]").each(function(){ 
		$("#"+this.id).css("background", "#fff");
	}); 
	$("#upload_image").css("background", "#fff");
}

function validador(){
 
	limpacampos();  

	if( jQuery("#titulo").val()==""){

		campoobg("titulo");
		alert("Por favor, informe o titulo");
		jQuery("#titulo").focus();
		return false;
	} 
	return true;	
}
 
 
 
function visualizar( ){ 
		if(jQuery.trim(jQuery("#idmodelo").val()) != ""){ 
			
			  var windowSizeArray = [ "width=200,height=200",
                                    "width=300,height=400,scrollbars=yes" ];
    
				var url = "<?=$ROOTPATH?>/artigo/"+jQuery.trim(jQuery("#idmodelo").val());
				var windowName = "popUp";//$(this).attr("name");
				var windowSize = windowSizeArray[$(this).attr("rel")];

				window.open(url, windowName, windowSize);

				//event.preventDefault(); 
		}
		else{
			alert("Para visualizar esta página, você precisa salvá-la.")
		}
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
   
   
</script>
  