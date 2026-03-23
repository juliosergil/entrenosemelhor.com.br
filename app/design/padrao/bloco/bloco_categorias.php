<div style="display:none;height:36px;" class="tips"><?=__FILE__?></div> 

<?
if($_GET['id_category'] !=0 && isset($_GET['id_category']) && !(empty($_GET['id_category']))) {	
	$id_category = strip_tags($_GET['id_category']);
	$sqlaux = " idpai = $id_category and " ;
}
else{
	$sqlaux = " idpai = 0 and " ;
}

/* Busca das categorias */
$sqlF = "select id, name, imagemcateghome from category where  $sqlaux  display = 'Y' order by sort_order desc ";
$rsF = mysqli_query(DB::$mConnection,$sqlF);
 

?>
<div class="form-categories">
	<div class="title-block list-categories">
		Busca por categorias 
	</div> 
		<div class="list-categories"> 
			<a class='linkv' href="<?=gera_link_allcat($state, $id_category)?>"> << Todas as categorias</a> 
			<div class='title'><?=utf8_decode($category['name'])?></div>  
			<ul >
	
			<?php
				while($rowF = mysqli_fetch_assoc($rsF)) {
					
					$total = get_total_anuncios_categoria($state, $rowF['id'],$cppesquisa);  
					$linkC = gera_link_cat($state,$rowF['id']); 
				?>
					<li style="height: 45px;">
						<a href="<?php echo $linkC; ?>"> 
							<?php
								if(!(empty($rowF['imagemcateghome']))) { ?> 
								<img class="img-category" src="<?php echo $ROOTPATH; ?>/media/<?php echo $rowF['imagemcateghome']; ?>">
							 
							<?php } else { ?>
							 
								<img class="img-category" src="<?php echo $PATHSKIN; ?>/images/categoriaimage.png">
												
							<?php } 
								echo utf8_decode($rowF['name']);
							?>
							 <span class='qtd'> ( <b><?=$total?></b> )</span> 
						 </a>
					</li> 
				<?php } ?>
			</ul>
		</div> 

</div> 

<div class="form-categories" style="text-align: center;padding-top: 15px;margin-top: 10px;">
 
	<?php echo  $INI['bulletin']['topotodos'] ; ?>
	<?php echo  $INI['bulletin'][ $_GET['id_category']]; ?>
	
</div>

<script>

$("img").addClass("img-thumbnail");

</script>