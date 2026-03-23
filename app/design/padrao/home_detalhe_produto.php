	<?php  

		if(!isvalidteam($team) AND $login_user['manager'] != 'Y'){
			$url = $ROOTPATH;

			if (!headers_sent()){
        		header('Location: '.$url);
        		exit();
        	} else {
		        echo '<script type="text/javascript">';
		        echo 'window.location.href="'.$url.'";';
		        echo '</script>';
		        echo '<noscript>';
		        echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
		        echo '</noscript>'; exit;
		   	}
		}

		require_once("include/head.php"); 
	?>
	<body id="page1"> 
		<!-- Go to www.addthis.com/dashboard to customize your tools --> 
		
		<div class="tail-top"> 
			<div style="display:none;" class="tips"><?=__FILE__?></div>		
			<div>
				<?php  require_once(DIR_BLOCO."/header.php"); ?>
				<section id="content">
					<div class="container">
						<?php  
						
							$BlocosOfertas->getBlocoDetalheProduto($idoferta,$BlocosOfertas->tipo_oferta);
						?> 	
					</div>				
				</section>
				
			</div>
		</div> 	 
		<script>
			function envia_url_comprar(){ 
				location.href  = '<?php echo  $team['url_comprar'] ?>'; 
			}
		</script>
		<!-- Go to www.addthis.com/dashboard to customize your tools -->
		<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-59edd85f51f63f64"></script>
		<?php
					require_once(DIR_BLOCO."/rodape.php");	
		?>
	</body>
</html>
