	<?php 
		$page = Table::Fetch('page', $idpagina );
		$pagetitle = $page['titulo']; 
		$idcategoria = $page['category_id'];

		if(!$idpagina){
			$pagetitle = "P&aacute;gina não encontrada";
			$page['value'] = "Nenhuma página associada";
		}
	
		require_once("include/head.php"); 
	?>
	<style>
 .content-page { 
    margin-left: 10px !important;
    margin-right: 10px !important; 
}
	</style>
	<body id="page1">
		<div class="tail-top "> 
			<div style="display:none;" class="tips"><?=__FILE__?></div>		
			<div >
				<?php  require_once(DIR_BLOCO."/header.php"); ?>
				<section id="content ">
                    <div class="row">
					   <div class="col-md-12">
					   		<div class="title-page corpreto">
									<?php 
										echo utf8_decode($pagetitle);
									?>
							</div>
					   </div>
					</div>
					<div class="row ">
					  <div class="col-md-12 container">					
							<div class="content-page">
								<?=htmlspecialchars_decode($page['value'])?>
							</div>
						</div>
					</div>		
				</section>
				<?php
					require_once(DIR_BLOCO."/rodape.php");	
				?>
			</div>
		</div> 	 
		<script>
			function envia_url_comprar(){ 
				location.href  = '<?php echo  $team['url_comprar'] ?>'; 
			}
		</script>
	</body>
</html>
