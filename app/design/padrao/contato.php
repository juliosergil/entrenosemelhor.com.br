<?php  require_once("include/head.php"); ?>
<?php  require_once("include/code/contato.php"); ?>

	<body id="page1">
	<style>
	.form-control.form-contact {
		width: 100% !important;
	}
	.mt-5, .my-5 {
    background: #4e4a4a;
    margin-top: 3rem!important;
}
	</style>
	<?php  require_once(DIR_BLOCO . "/header.php"); ?>  
	
		<div class="tail-top"> 		 
			<div style="display:none;" class="tips"><?=__FILE__?></div> 
			  
		<div class="container mt-5 mb-4">
		    <div class="row">
			   <div class="col-12 px-md-4">
			   	<div class="title-page">
						Entre em contato conosco !
					</div>
					
				<form id="formcadcontato" name="formcadcontato" method="post" action="">
					<div class="form"> 
						<input name="title" type="text" id="title" class="form-control form-contact" placeholder="Informe o seu nome">
					</div>							
					<div class="form"> 
						<input name="contact" type="text" id="contact" class="form-control form-contact" placeholder="Informe o seu email">
					</div>							
					<div class="form" style="clear: both;"> 
						<textarea cols="30" rows="5" name="content" id="content" class="form-control form-contact" placeholder="Informe sua mensagem"></textarea>
					</div>							
					<div class="form-group"> 
						<a href="javascript:cadastro();" class="link-1 btAnunciar js-scroll-trigger"> Enviar  </a>
					</div>
				</form>
			   </div>
			</div>
		 </div>
		 
			 <!-- recomendados pra voce -->
				<div class="adrecomendados">
				  
				<?php
					require_once(DIR_BLOCO . "/recomendados.php");
				?> 
				<!--Galeria premium-->
				<div class="adpremium">
					<?php
						require_once(DIR_BLOCO . "/galeria_premium.php");
					?>  
				  
				</div> 
				<?php
					require_once(DIR_BLOCO . "/rodape.php");
				?> 
				</div> 
			</div>
		</div> 
		<!--Modal galeria de imagens--> 
		<!-- Modal -->
		<?php require_once(DIR_BLOCO . "/modal.php"); ?> 
	</body>
</html>

<script language="javascript">
	function cadastro(){
	
		if(J("#title").val() == ""){
			alert("Por favor, informe o seu nome.")
			document.getElementById("title").focus();
			return;
		}

		if(J("#contact").val() == ""){
			alert("Por favor, informe o seu email.")
			document.getElementById("contact").focus();
			return;
		}

		if(document.formcadcontato.content.value == ""){
			alert("Por favor, escreva a mensagem.")
			document.formcadcontato.content.focus();
			return;
		}		

		J("#formcadcontato").submit();	 
	}	

	<?php  
		if($enviou){ 
	?> 
	alert("Email enviado com sucesso. Obrigado por entrar em contato !")
	location.href  = '<?php echo $INI['system']['wwwprefix']?>/index.php';
	<? }
	else if($_POST and !$enviou){ ?>
	alert("Houve um erro no envio do email, tente novamente mais tarde.")
	<? } ?>
</script>	
		
