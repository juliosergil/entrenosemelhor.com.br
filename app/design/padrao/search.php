	<?php  
		require_once("include/head.php"); 
	?>
	<body id="page1">
		<div class="tail-top"> 
			<div style="display:none;" class="tips"><?=__FILE__?></div>		
			<div >
				<?php  require_once(DIR_BLOCO . "/header.php"); ?>
				<section id="content">
					<?php require_once(DIR_BLOCO . "/lista_anuncios.php"); ?>
				</section>
				<?php
					require_once(DIR_BLOCO . "/rodape.php");	
				?>	 
			</div>
		</div> 
	
	</body>
</html>


