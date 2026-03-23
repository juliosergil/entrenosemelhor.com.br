 <? if(file_exists(WWW_MOD."/pix.inc") or  $INI['system']['textopagamento'] !="" ) { ?>	
  
	 <div class="option_box" style="border: none !important;outline: unset !important;">		 
		 <div id="container_box">
			<div id="option_contents" class="option_contents">  
				<div class="form-contain group"> 
					<div class="ends2"> 
						<?php echo $INI['system']['textopagamento']; ?> 
					</div> 
					
					<? if(file_exists(WWW_MOD."/pix.inc") and $idplano!="10" ) { ?>	
						
						<div style="height:600px;"> 
							 <iframe name="pixplanos" id="pixplanos" frameborder="0" height="100%" width="100%" scrolling="no" src="<?=$ROOTPATH?>/pix/pix_planos.php?valor=<?=$planos_publicacao['valor']?>" id="layout"></iframe>  
						</div>
						
					<? } ?> 
				</div> 
			</div>
		</div>
	</div>
	
<? } ?> 
