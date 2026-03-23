 <div class="container pt-5 pb-5" >
 <div style="display:none;" class="tips"><?=__FILE__?></div> 
	  <div class="row galeria-wrapper">
		 <div class="col-12 d-flex flex-md-row flex-column justify-content-md-between">
			 <div class="d-flex align-items-center">
					<!-- <img style="max-height: 85px;" src="<?=$PATHSKIN?>/images/premium.png" alt="Galeria Premium">-->
					 <h2 class="ml-2 mb-0 premium-title">Galeria Premium</h2>
			 </div>	
			 <div class="d-flex align-items-center mt-2 mt-md-0">
				<p class="semi-small mb-0 d-flex align-items-center"> 
					<a class="button7"  <?php if(empty($login_user)) { ?> data-toggle="modal" data-target="#exampleModal1"<?php }else{?> href="<?php echo $ROOTPATH; ?>/planos"<?} ?> >
							Coloque seu an&uacute;ncio aqui
						</a> 
				</p>
			</div>							 
		</div>
		 <div class="col-12">
			<div class="MultiCarousel" data-items="1,3,5,6" data-slide="1" id="MultiCarousel"  data-interval="1000">
				<div class="MultiCarousel-inner">
					
					<?php
						$sql = "select id, title, image, team_price, mostrarpreco from team where  ehdestaque = 'Y' and (status is null or status = 1) and (pago = 'sim' or anunciogratis = 's') and begin_time < '".time()."' and end_time > '".time()."' order by rand()";
						$rs = mysqli_query(DB::$mConnection,$sql);
						
						while($row = mysqli_fetch_assoc($rs)) {
						
							$link = $INI['system']['wwwprefix'] . "/anuncio/". $row['id'] . "/" . URLify::filter($row['title']);	
							$row['title'] = utf8_decode($row['title']);
					?>
						<div class="item">
						<div class="pad15">
						<!--a title="<?php echo $row['title']; ?>" href="<?php echo $link; ?>" class="gallery-link"-->
								<div class="gallery-image">
									<div class="gallery-image-box">
										<?php //echo getImageFeature($row); ?>
										
										<?php if( $row!=null ){ ?>
												<a title="<?php echo $row['title']; ?>" href="<?php echo $link; ?>" >	
													<img  class='image' title="<?=$row['title']?>" alt="<?=$row['title'] ?>" src="<?=$INI['system']['wwwprefix']?>/media/<?=$row['image']?>" />
												</a>
										<?php }else{ ?>
												<a title="<?php echo $row['title']; ?>" href="<?php echo $link; ?>" >	
													<img class='image' title="<?=$row['title']?>" alt="<?=$row['title']?>" src="<?php echo $PATHSKIN."/images/semfoto.jpg"?>" />;
												</a>
										<?php } ?>
										
									</div>
								</div>
								<h3 class="gallery-title"><a title="<?php echo $row['title']; ?>" href="<?php echo $link; ?>" class="gallery-link"><?php echo $row['title']; ?></a></h3>
								<?php if($row['mostrarpreco'] == 1){?>
									<p class="gallery-price">    
										R$ <?php echo number_format($row['team_price'], 2, ",", "."); ?>
									</p>
								<? } ?>	
								<? if($row['mostrarpreco'] == 0){?>
									<p class="gallery-price">    
										A combinar
									</p>
							<!--/a-->	
							<? } ?>

						</div>
					</div>

					<?}?>
				
				</div>
				<button class="btn btn-default  leftLst"><</button>
				<button class="btn btn-default  rightLst">></button>
			</div>					 
		</div>	
	</div>
</div> 