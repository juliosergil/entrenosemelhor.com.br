<div class="content mt-3">  
<div style="display:none;" class="tips"><?=__FILE__?></div> 
	
	<?php
		$sql_a = "select * from category where displayhome = 'Y' and  display = 'Y' order by sort_order desc";
		$rs_a = mysqli_query(DB::$mConnection,$sql_a); 
	?>

	<div class="row">
			
		<?
		while($row = mysqli_fetch_assoc($rs_a)) {
				
				$nomecat = utf8_decode($row['name']);
				$linkC = gera_link_cat("",$row['id']); 
				$imagem_cat = $ROOTPATH."/media/".$row['imagemcateghome2'];		
				if(empty($row['imagemcateghome2'])){
					$imagem_cat = $PATHSKIN."/images/semfoto.png";	
				}
		 ?>
			
			<div class="col-lg-3 col-md-4 col-xs-6 thumb">
				<a href="<?=$linkC?>">                            
					<!--img  src="http://www.guiacomercialscript.com.br/prime/skin/padrao/images/carros.png" class="img-fluid "  alt=""-->
					<!-- <img  src='<?=$ROOTPATH?>/media/<?=$row['imagemcateghome']?>' class="img-fluid img-galeria"  alt="">  -->  
					<img  src='<?=$imagem_cat?>' class="img-fluid img-galeria"  alt="">    
					<p class="titulo-galeria"><?=$nomecat?></p>  
					<!-- <p class="descricao">Planos Profissionais</p>   -->             
				</a>
			</div> 
		
		<? } ?>
		
	</div>

</div>
  