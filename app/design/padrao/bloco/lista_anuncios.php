
 <?php
	$BlocosOfertas = new BlocosOfertas();
	$order = " order by `sort_order` DESC, `id` DESC ";
//	$id_category =  get_id($_GET['id_category']);
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
	if(!empty($_GET['id_vendedor'])){ 
        $condition[] = "user_id = " . intval($_REQUEST['id_vendedor']);
    }
	if($_GET['id_category'] !=0 && isset($_GET['id_category']) && !(empty($_GET['id_category']))) {	
		$id_category =  $_GET['id_category'] ; 
		$BlocosOfertas->getcategoriafilhas($id_category); 
		$idcategorias.=$BlocosOfertas->categoriasfilhas.$id_category;  
		$condition[] .= "group_id in (" .$idcategorias. ")";
		$category = Table::Fetch('category', $id_category);
	}	
	if(!empty($_GET['Estado']) && $_GET['Estado'] !="all"  && empty($_GET['state'] !="0")) {	
		$state = strip_tags($_GET['Estado']);
		$condition[] .= "uf = '" . $state . "'";
	}	
	if(isset($_GET['city']) && !(empty($_GET['city']))) {	
		$city = strip_tags($_GET['city']);
		$condition[] .= "city_id = '" . $city . "'";
	}
	else {
		unset($city);
	}
		//print_r($condition);
	$count = Table::Count('team', $condition);
	list($pagesize, $offset, $pagestring) = pagestring($count, 40);
	$teams = DB::LimitQuery('team', array(
		'condition' => $condition,
		'order' => 'order by create_time DESC',
		'size' => $pagesize,
		'offset' => $offset,
	)); 
	$stordenacao = "cpordenacaofx";
	if($navegador == "other" ||  $navegador == "ie"){
			$stordenacao = "cpordenacaoie";
	} 
?>	
<style>
.premium-title { 
	color: #333 !important;
}
.item {
      background: #fff !important;
}
.titulo-galeria {
    height: 21% !important;
}
</style>
<!--Criação do layout novo -->
<div class="container">
   <div class= "row">
    <div style="display:none;" class="tips"><?=__FILE__?></div> 
	   <div class="col-md-4">
		   <div class="content-categories-offer">		   
					<form method="GET" name="form-search-offer" id="form-search-offer" action="<?php echo $ROOTPATH; ?>">
						<div class="form-group">
						<select placeholder="Estado" class="form-field-text selecaux" id="Estado" name="Estado" >
						<option value="">Estado</option>
						<?php 
						$sql = "SELECT e.uf, e.nome FROM `estados` e WHERE e.uf in ( select b.uf  from team b where b.uf = e.uf and ( b.status is null or b.status = 1 ) and (pago = 'sim' or anunciogratis = 's') and begin_time < '".time()."' and end_time > '".time()."' ) ORDER BY e.nome ASC";
						$estados = mysqli_query(DB::$mConnection,$sql) or die(mysqli_error(DB::$mConnection));
						while ($row = mysqli_fetch_array($estados, MYSQLI_ASSOC)) {
							$selected ='';
							if($state == $row['uf']){
								$selected ="selected='selected'";
							}
							echo utf8_decode("<option $selected  value='{$row['uf']}'>{$row['nome']}</option>");		
						}
						?>
						</select>
						<input class="form-field-text" type="text" name="cppesquisa" id="cppesquisa" placeholder="Buscar por palavra chave" maxlength="28" value="<?=$_GET['cppesquisa']?>">
						<input id="searchbutton" class="btn btn-success btn-search " type="submit" onclick="" value="Buscar">
						<input type="hidden" name="state" value="<?php echo $state; ?>">
						<input type="hidden" name="city" value="<?php echo $city; ?>">
						<input type="hidden" name="page" value="search">
						</div>
					</form> 
					<?php
						require_once(DIR_BLOCO . "/bloco_categorias.php");
					?>
			</div>
		</div>
		<div class="col-md-8">
			<div class="content-list-offer">
				<div class ="row">
					<div class="col-md-12">
						<?php
							require_once(DIR_BLOCO . "/bloco_cidades_anuncios.php");
						?> 
					</div>
				</div>	 
				<!--galeria-->
				<?php
					$flag = true;
					require_once(DIR_BLOCO . "/galeria_premium.php");
				?> 
				<div class ="row">
					<div class="col-md-12">	
					 <?php if ($rsOc instanceof mysqli_result && mysqli_num_rows($rsOc) > 0) { ?>
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
									An&uacute;ncios da categoria "<?php echo utf8_decode($category['name']); ?>"  
								</div>
						<?php } ?>
							<ul>
									<? if(!empty($_GET['cppesquisa'])){
											$linkC = gera_link_cat($state);
									?>
										<div style="color:#303030;font-size: 14px;color:#303030;">Voc&ecirc; pesquisou por:  <b> <?=$_GET['cppesquisa']?></b> - <a href="<?=$linkC?>">Limpar pesquisa</a> </div>
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
								?>
								  <li class="item-offer">	
										<div class="row info-list-offer">
											<div class="col-md-3">
												<div class="image-offer">
													<a href="<?php echo $link; ?>">
														<img  class='image' title="<?=$team['title']?>" alt="<?=$team['title'] ?>" src="<?=$INI['system']['wwwprefix']?>/media/<?=$team['image']?>" />
													</a>
												</div>
											</div>
											<div class="col-md-3">							
												<div class="title-list-offer">
													<a href="<?php echo $link; ?>"> 
														<?php
															echo utf8_decode($team['title']);
														?>
													 </a>	
												</div>
											</div>
											<div class="col-md-3">
												<?php if($team['mostrarpreco'] == 1){?>
														<div class="price-list-offer">    
															R$ <?php echo number_format($team['team_price'], 2, ",", "."); ?>
														</div>
												<? } ?>	
												<? if($team['mostrarpreco'] == 0){?>
													<div class="price-list-offer">    
														A combinar
													</div>
												<? } ?>		
											</div>
											<div class="col-md-3">
													<div class="data-list-offer"><?=data($team['create_time'])?> 
													<br><?=$cidade['nome'];?> / <?=$team['uf']?>  
												 </div>
											</div>	
				                    	</div>				 
					               </li>
				              <?php } ?>			
							</ul>
						</div>	
					</div>		
				</div> 
				<?php
					if($count==0){ 
						echo "Nenhum an&uacute;ncio encontrado :(";
					}
				?> 
			</div>
		</div>		 
		<div class="imgs_categoria_desktop">
			<?php require(DIR_BLOCO . "/categorias_imagem_destaque.php"); ?>	 
		</div> 
	</div>
</div>	
<!--Criação do layout novo -->
	<!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">			
						<div class="modal-body">
							<div class="row p-4">
								<div class="d-none d-lg-flex col-md-6 justify-content-center align-items-center">	
									<!--img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiPz4KPHN2ZyB3aWR0aD0iMjVweCIgaGVpZ2h0PSIzMHB4IiB2aWV3Qm94PSIwIDAgMjUgMzAiIHZlcnNpb249IjEuMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayI+CiAgICA8IS0tIEdlbmVyYXRvcjogU2tldGNoIDUwLjIgKDU1MDQ3KSAtIGh0dHA6Ly93d3cuYm9oZW1pYW5jb2RpbmcuY29tL3NrZXRjaCAtLT4KICAgIDx0aXRsZT5JY29ucyAvIGJhZGdlLyBwcmVtaXVtPC90aXRsZT4KICAgIDxkZXNjPkNyZWF0ZWQgd2l0aCBTa2V0Y2guPC9kZXNjPgogICAgPGRlZnM+PC9kZWZzPgogICAgPGcgaWQ9Ik9MWC0tLU5ldyIgc3Ryb2tlPSJub25lIiBzdHJva2Utd2lkdGg9IjEiIGZpbGw9Im5vbmUiIGZpbGwtcnVsZT0iZXZlbm9kZCI+CiAgICAgICAgPGcgaWQ9IkRlc2t0b3AtLS1Db21wb25lbnRlcyIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoLTE5Ny4wMDAwMDAsIC0xMzU5LjAwMDAwMCkiPgogICAgICAgICAgICA8ZyBpZD0iR3JvdXAtNSIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMTkzLjAwMDAwMCwgMTM1OC4wMDAwMDApIj4KICAgICAgICAgICAgICAgIDxnIGlkPSJJY29ucy0vLWJhZGdlLy1wcmVtaXVtIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSg0LjAwMDAwMCwgMS4wMDAwMDApIj4KICAgICAgICAgICAgICAgICAgICA8ZyBpZD0ic2Vsby1wcmVtaXVtIj4KICAgICAgICAgICAgICAgICAgICAgICAgPHBhdGggZD0iTTI1LDEuNDQ3MjMwNzUgQzI1LDAuMzU0MjIxODg5IDI0LjYzNjQxMTcsLTMuNTUyNzEzNjhlLTE1IDIzLjQ4NzQ3MjUsLTMuNTUyNzEzNjhlLTE1IEwxLjU1NDg3MDYxLC0zLjU1MjcxMzY4ZS0xNSBDMC4zMzA4NzczMDQsLTMuNTUyNzEzNjhlLTE1IDMuMjA2MzI0MWUtMTMsMC4zMjc3NTg3ODkgLTEuODIyMDk4MDNlLTEyLDEuNDQ3MjMwNzUgTC0xLjgzMzIwMDI2ZS0xMiwyOS41MjM4MDk1IEwxMi41LDIzLjk1MDcxODUgQzEyLjQ5OTk5MiwyMy45NTA3MjMgMTYuNjY2NjU4NywyNS44MDg0MjAxIDI1LDI5LjUyMzgwOTUgTDI1LDEuNDQ3MjMwNzUgWiIgaWQ9Ik1hc2siIGZpbGw9IiMyOEI1RDkiIGZpbGwtcnVsZT0ibm9uemVybyI+PC9wYXRoPgogICAgICAgICAgICAgICAgICAgICAgICA8ZyBpZD0iR3JvdXAiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDYuMjUwMDAwLCA3Ljg1NzE0MykiIGZpbGw9IiNGRkZGRkYiIGZpbGwtcnVsZT0ibm9uemVybyI+CiAgICAgICAgICAgICAgICAgICAgICAgICAgICA8cG9seWdvbiBpZD0iU2hhcGUiIHBvaW50cz0iMCAyLjg1NzE0Mjg2IDYuNjQwNTQyMTIgMTAuNzE0Mjg1NyAxMy4yODEyNSAyLjg1NzE0Mjg2IDYuNjQwNTQyMTIgMi44NTcxNDI4NiI+PC9wb2x5Z29uPgogICAgICAgICAgICAgICAgICAgICAgICAgICAgPHBvbHlnb24gaWQ9IlNoYXBlIiBwb2ludHM9IjEzLjI4MTI1IDIuMTQyODU3MTQgMTEuNTE2NjA0OSAwIDYuNjQwNTQyMTIgMCAxLjc2NDY0NTA5IDAgMCAyLjE0Mjg1NzE0IDYuNjQwNTQyMTIgMi4xNDI4NTcxNCI+PC9wb2x5Z29uPgogICAgICAgICAgICAgICAgICAgICAgICA8L2c+CiAgICAgICAgICAgICAgICAgICAgPC9nPgogICAgICAgICAgICAgICAgPC9nPgogICAgICAgICAgICA8L2c+CiAgICAgICAgPC9nPgogICAgPC9nPgo8L3N2Zz4=" alt="Premium" style="height: 200px;"-->								
								</div>
								<div class="col-lg-6 modalText">
									<div class="d-flex justify-content-between mb-3">
										<div class="d-flex align-items-center">
										   <h2 class="mb-0" style="font-size: 24px">Anuncie na galeria do Guia Go</h2>
										</div>	
									</div>
									<p>Texto</p>
									<ul class="unstyled">
										<li>item 1</li>									
										<li>item 2</li>
										<li>item 3</li>
									</ul>
									<div class="mt-3">
										<a class="btn btn-primary btAnunciar  <?php if(empty($login_user)) { echo ' tk_logar ';} ?>" href="<?php echo $link; ?>" <?php if(empty($login_user)) { ?> class="tk_logar"<?php } ?>" >Comprar</a>
										<button class="btn btn-link text-dark"  data-dismiss="modal" type="button">Fechar</button></div>
								</div>
							</div>														
						</div>			
						<!--div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="button" class="btn btn-primary">Save changes</button>
						</div-->
					</div>
				</div>
			</div>
<!-- modal-->
<div style="display:none;height:36px;" class="tips"><?=__FILE__?></div> 
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
		background: #F70;
		height: 123px;
		width: 164px;
		float: left;
		display: inline;
		padding: 5px;
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