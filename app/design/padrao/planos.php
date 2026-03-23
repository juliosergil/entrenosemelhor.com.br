<?php  
	$titulo_pagina = "Escolha o seu plano abaixo";
	     
	require_once("include/head.php");  
?> 
	<body>  
		<?php  require_once(DIR_BLOCO."/header.php");  ?>	
		
		<link rel="stylesheet" href="<?=$PATHSKIN?>/css/planosnew.css"> 
 
		<div class="container">
		<div style="display:none;" class="tips"><?=__FILE__?></div>
			<div class="row"> 
				<div class="block col-md-12 col-xs-12 col-sm-12">
				 
				 	<div class="tt-block-title tt-sub-pages">
						  <h2 class="tt-title">Escolha um plano para cadastrar seu anúncio</h2>  
					</div>
					 
					<div class="row"> 
						<?php  
							 	    
							/******************************************/
							require_once(DIR_BLOCO."/planos_itens.php");
							/******************************************/
							
							?> 
					</div>
				</div>
			</div> 
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>  
		</div>
	</div>
	<?php 
	$ACAO="gravaplano";
	$TIPOPLANO="anuncio";
	//require_once(DIR_BLOCO."/planos_js.php");
	?>
	<?php require_once(DIR_BLOCO."/rodape.php");  ?> 
	</body>
</html>