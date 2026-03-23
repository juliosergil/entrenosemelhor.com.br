<?php
	$sql_a = "select * from page where status = '1' and  blog = '1'  order by rand() limit 4 ";
	$rs_a = mysqli_query(DB::$mConnection,$sql_a); 
?>
	
<div class="blog container text-center mt-5 mb-5"style="  margin-top: 70px; margin-bottom: 70px;" >
<div style="display:none;" class="tips"><?=__FILE__?></div> 
	<div >
		<h2  class="head-blog" style="font-size: 40px;" > <?php echo utf8_decode($INI['system']['blog']); ?> </h2 >
		<p class="head-blog mb-5">  <?php echo utf8_decode($INI['system']['blogdesc']); ?> </p>
	</div>
	<div class="row" >
	
		<?
		while($row = mysqli_fetch_assoc($rs_a)) {
				
				$nomecat = utf8_decode($row['titulo']);
				$link = $INI['system']['wwwprefix'] . "/page/". $row['id'] . "/" .  $nomecat ;	
		 ?>
			<div class="col-lg-3 col-sm-6">
				<div class=" blogtxt ">
					<div class="gallery-item wow fadeInUp ">
						<a href="<?=$link ?>" class="gallery-popup" style="text-decoration: none;" >
						<img class="img-responsive img-thumbnail" src="<?=$ROOTPATH?>/media/<?=$row['imagemcapa']?>"   lurker="itemhome_5">
						<div class="head-desc">
						<h3 class="head-blog mt-3"> <?=$nomecat?> </h3> 	
						</a>
						</div>
					</div>
				</div>
			</div>
		<? } ?>
		
 
	</div>
</div>
				