<div style="display:none;height:36px;" class="tips"><?=__FILE__?></div> 
<?php
	$BlocosOfertas = new BlocosOfertas();
	$order = " order by `sort_order` DESC, `id` DESC ";
	if(!empty($_GET['ordena'])){
		$order =  "order by ".$_GET['ordena'];
	}
	$condition = array(  
		"begin_time < '".time()."'",
		"end_time > '".time()."'",
		"status is null or status = 1",
		"pago = 'sim' or anunciogratis = 's'"
	);
	if(!empty($_GET['cppesquisa'])){
		$cppesquisa = urldecode($_GET['cppesquisa']);
		$condition[] .= "title LIKE '%" . retira_acentos($cppesquisa) . "%' or summary LIKE '%" . retira_acentos($cppesquisa) . "%'";
	}
	if($_GET['id_category'] !=0 && isset($_GET['id_category']) && !(empty($_GET['id_category']))) {	
		$id_category = strip_tags($_GET['id_category']);
		$BlocosOfertas->getcategoriafilhas($id_category); 
		$idcategorias.=$BlocosOfertas->categoriasfilhas.$id_category; 
		//echo "---".$idcategorias;
		$condition[] .= "group_id in (" .$idcategorias. ")";
		$category = Table::Fetch('category', $id_category);
	}	
	if(isset($_GET['state']) && !(empty($_GET['state'])) && $_GET['state'] !="0" && $_GET['state'] != "all" ) {	
		$state = strip_tags($_GET['state']);
		$condition[] .= "uf = '" . $state . "'";
	}	
	if(isset($_GET['city']) && !(empty($_GET['city']))) {	
		$city = strip_tags($_GET['city']);
		$condition[] .= "city_id = '" . $city . "'";
	}
	else {
		unset($city);
	}
	$count = Table::Count('team', $condition);
	list($pagesize, $offset, $pagestring) = pagestring($count, 50);
	$teams = DB::LimitQuery('team', array(
		'condition' => $condition,
		'order' => $order,
		'size' => $pagesize,
		'offset' => $offset,
	)); 
	$stordenacao = "cpordenacaofx";
	if($navegador == "other" ||  $navegador == "ie"){
			$stordenacao = "cpordenacaoie";
	} 
?>	 
<div class="content-categories-offer"> 
<?php
	require_once(DIR_BLOCO . "/bloco_categorias.php");
?>


</div>
<link rel="stylesheet" href="<?php echo $PATHSKIN; ?>/css/owl.carousel/dist/assets/owl.carousel.min.css">
<link rel="stylesheet" href="<?php echo $PATHSKIN; ?>/css/owl.carousel/dist/assets/owl.theme.default.min.css">
<script src="https://owlcarousel2.github.io/OwlCarousel2/assets/vendors/jquery.min.js"></script>
<script src="<?php echo $PATHSKIN; ?>/css/owl.carousel/dist/owl.carousel.min.js"></script>
<style>
	.offers-featured {
		width: 728px;
		float: left;
		height: 160px;
		margin-left: 8px;
		margin-bottom: 10px;
	}
	.item {
		/*background: #F70; */
		float: left;
		display: inline;
		padding: 2px;
	}
</style>
<script>
	jQuery('document').ready(function() {
		var owl = jQuery('.owl-carousel');
		owl.owlCarousel({
			items:4,
			loop:true,
			margin:10,
			autoplay:true,
			autoplayTimeout:3000,
			autoplayHoverPause:true
		});
		jQuery('.play').on('click',function(){
			owl.trigger('play.owl.autoplay',[1000])
		});
		jQuery('.stop').on('click',function(){
			owl.trigger('stop.owl.autoplay')
		});	
	});
</script>
<?php
	$sqlOc = "select id, title, image, team_price, mostrarpreco from team where  ehdestaque = 'Y' and (status is null or status = 1) and (pago = 'sim' or anunciogratis = 's') and begin_time < '".time()."' and end_time > '".time()."' order by rand()";
	$rsOc = mysqli_query(DB::$mConnection,$sqlOc);
?>
<div class="content-list-offer">
	<?php
		require_once(DIR_BLOCO . "/bloco_cidades_anuncios.php");
	?> 
		<? if(mysqli_num_rows($rsOc)){?>
			<div class="offers-featured">
				<div class="owl-carousel owl-theme">
					<?php
						while($item = mysqli_fetch_assoc($rsOc)) {
							$link = $INI['system']['wwwprefix'] . "/anuncio/". $item['id'] . "/" . URLify::filter($item['title']);	
							?>
							<div class="item">
								<a href="<?php echo $link; ?>">
									<?
									//echo getImageFeature($item); 
									?>
									<? if($item['image']){?>
										<img  class='image' title="<?=$item['title']?>" alt="<?=$item['title'] ?>" src="<?=$INI['system']['wwwprefix']?>/media/<?=$item['image']?>" />
									<?}?>
									<?=utf8_decode($item['title'])?>
								</a>
							</div>
							<?php } ?>
						</div>
					</div>
			<? } ?>
	<div class="list-offer">
		<?php
			if(!(empty($category))) { ?>
			<div class="title-block" style="margin-top:10px;">
				Anúncios da categoria "<?php echo utf8_decode($category['name']); ?>"  
			</div>
			<?php } ?>
			<ul>
			<? 
			if(!empty($_GET['cppesquisa'])){
				$linkC = gera_link_cat($state);
			?>
				<div style="color:#303030;">Você pesquisou por: <b><?=$_GET['cppesquisa']?></b> - <a href="<?=$linkC?>">Limpar pesquisa</a> </div>
			<? } ?>
			<?  
			if($count>0){?>
				<div class="pagination" style="color: #000;">
					<?php echo $pagestring; ?>
				</div>
			<? }  
			foreach($teams as $team) {
					$link = $INI['system']['wwwprefix'] . "/anuncio/". $team['id'] . "/" . URLify::filter($team['title']);	
					$cidade = Table::Fetch('cidades', $team['city_id']);
					$linkCat = gera_link_cat_pai($team['uf'],$team['group_id']); 
					$estado = Table::Fetch('estados', $team['uf']);
			?>
			<li class="item-offer">				
				<div class="image-offer">
					<a href="<?php echo $link; ?>">
						<img  class='image' title="<?=$team['title']?>" alt="<?=$team['title'] ?>" src="<?=$INI['system']['wwwprefix']?>/media/<?=$team['image']?>" />
					</a>
				</div>
				<div class="info-list-offer">
					<a href="<?php echo $link; ?>">
						<div class="title-list-offer">
						<?php
							echo utf8_decode($team['title']);
						?><span style="margin-left: 29px;color:#000;font-size: 12px;"><?=data($team['create_time'])?> </span>
						</div>	
					</a>				
					<div class="local-list-offer">
						<p>
							 
							<span class="local-name">								
								 
									<?php echo  utf8_decode($cidade['nome']); ?> / <?=utf8_decode($estado[nome]); ?> 
							</span>
						</p>						
					 	
					</div>				
				</div>
				<?php if($team['mostrarpreco'] == 1){?>
					<div class="price-list-offer">    
						<?=utf8_decode($INI['system']['currency'])?> <?php echo number_format($team['team_price'], 2, ",", "."); ?>
					</div>
				<? } ?>	
				<? if($team['mostrarpreco'] == 0){?>
					<div class="price-list-offer">    
						A combinar
					</div>
				<? } ?>				
				<div class="btn btn-view">
					<a href="<?php echo $link; ?>">
						Ver anúncio
					</a>
				</div>
			</li>
			<?php } ?>
			<? if($count>0){?>
				<div class="pagination" style="color: #000;">
					<?php echo $pagestring; ?>
				</div>
			<? } ?>
		</ul>
		<?php
			  if($count==0){ 
				require_once(DIR_BLOCO . "/noads.php");
			  }
		?> 
	</div>
	<div class="list-banner">
		<?php
			echo str_replace("../../", $ROOTPATH . "/", $INI['bulletin'][$id_category]);
		?>
	</div>
</div> 