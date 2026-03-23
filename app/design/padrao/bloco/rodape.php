<footer class="type-2 text-center bg-dark" style="clear: both;">
 		<div style="display:none;height:36px;" class="tips"><?=__FILE__?></div> 
	<div class="logofooter " > 
			 
		  </div>  	   
	<div class="position-center mt-3">

		<div class="footer-links col-sm-8 offset-sm-2">                            
			<a href="<?php echo $ROOTPATH; ?>/contato"  lurker="help_footer">Entre em contato</a>
			<?php
			$pages = getStaticPages();

			while ($page = mysqli_fetch_assoc($pages)) {
			?>
		
			<a  class="  " href="<?php echo $ROOTPATH; ?>/page/<?php echo $page['id']; ?>">
				<?php echo utf8_decode($page['titulo']); ?>
			</a>
	
		<?php
			}
		?>                      
		</div>  
		<!--Midias Sociais-->
	<div class="col-lg-5 d-flex justify-content-center justify-content-lg-end mt-4" style="max-width: 100% !important;    justify-content: center !important;">
		<?php if($INI['other']['facebook']  != ""){ ?>
		
				<a  target="_blank" href="<?=$INI['other']['facebook']?>">
					<img src="<?=$PATHSKIN?>/images/icone_facebook.png"> 
				</a>
			
			<?php } ?>
			<?php if($INI['other']['twitter']  != ""){ ?>
			
				<a class = "iconeMedia" target="_blank" href="<?=$INI['other']['twitter']?>">
					<img src="<?=$PATHSKIN?>/images/icone_twitter.png"> 
				</a>
			
			<?php } ?>	
			<?php if($INI['other']['instagram']  != ""){ ?>
			
				<a class = "iconeMedia" target="_blank" href="<?=$INI['other']['instagram']?>">
					<img src="<?=$PATHSKIN?>/images/icone_instagram.png">
				</a>
			
			<?php } ?>		
			<?php if($INI['other']['youtube']  != ""){ ?>
			
				<a  class = "iconeMedia" target="_blank" href="<?=$INI['other']['youtube']?>"> 
					<img src="<?=$PATHSKIN?>/images/icone_youtube.png"> 
				</a>
			
			<?php } ?>	
		 </div>
	</div>
	<hr class="mt-4">	
	<? 
	if(isset($_REQUEST['vendedor'])){
		$_SESSION['vendedor'] = $_REQUEST['vendedor'];
	}
	?> 
  
	  <div style="font-size:15px"><a target="_blank" href="https://www.vipcomsistemas.com.br">&copy;  <?= utf8_decode($INI["system"]["sitename"])?> Ltda  - Todos os direitos reservados.</a></div>
	</div> 
	  
</footer>
 
<? 
if(empty($_SESSION['vendedor'])){   
	 include(DIR_BLOCO."/direitoautoral.php");  
 } 
?> 
 

 <? include_once(DIR_BLOCO."/codigos.php"); ?>
 
 

 
	<!--
 <script src="https://code.jivosite.com/widget/b0LYQp0zAe" async></script>
--> 