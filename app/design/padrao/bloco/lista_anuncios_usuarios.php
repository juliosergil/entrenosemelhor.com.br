<div style="display:none;height:36px;" class="tips"><?=__FILE__?></div> 
<?php
	$BlocosOfertas = new BlocosOfertas();
	$order = " order by `id` DESC ";
	
	if(!empty($_GET['ordena'])){
		$order =  "order by ".$_GET['ordena'];
	}
	  
	$condition = array(  
		"begin_time < '".time()."'",
		"end_time > '".time()."'",
		"status is null or status = 1",
		"pago = 'sim' or anunciogratis = 's'",
		"user_id = " . $login_user_id
	);
	
	if(isset($login_user_id) && !(empty($login_user_id))) {
		$condition[] = "user_id = " . $login_user_id;
	}
		
	$count = Table::Count('team', $condition);
	list($pagesize, $offset, $pagestring) = pagestring($count, 40);

	$teams = DB::LimitQuery('team', array(
		'condition' => $condition,
		'order' => 'order by sort_order DESC',
		'size' => $pagesize,
		'offset' => $offset,
	)); 
	 
	$stordenacao = "cpordenacaofx";
	if($navegador == "other" ||  $navegador == "ie"){
			$stordenacao = "cpordenacaoie";
	} 
?>	
<? if($count>0){?> 
	<div class="title-page" style="float=left;">
		1. Escolha o an&uacute;ncio que deseja destacar
	</div>
<? } ?>
<div class="content-list-offer">
	<div class="list-offer"> 
		<?php 
			foreach($teams as $team) {
					
					$link = $INI['system']['wwwprefix'] . "/anuncio/". $team['id'] . "/" . URLify::filter($team['title']);	
					$cidade = Table::Fetch('ddd_cidades', $team['city_id']);
					$linkCat = gera_link_cat_pai($team['uf'],$team['group_id']); 
			?>
			<li class="item-offer">				
				<div class="image-offer">
					<a href="<?php echo $link; ?>">
						<!--<?php /*echo getImageFeature($team);*/ ?>-->
						
						<?php if( $team!=null ){ ?>
												
							<img  class='image' title="<?=$team['title']?>" alt="<?=$team['title'] ?>" src="<?=$INI['system']['wwwprefix']?>/media/<?=$team['image']?>" />
							
						<?php }else{ ?>
							<img class='image' title=".$team['title']." alt=".$team['title']." src="<?php echo $PATHSKIN?>"."/images/semfoto.jpg" />;
						<?php } ?>
						
					</a>
				</div>
				
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
				
				<div class="date-list-offer">
						<?=data($team['create_time'])?>
				</div>
				<div class="btn btn-view">
					<a href="<?php echo $link; ?>">
						Ver an&uacute;ncio
					</a>
				</div>				
				<div class="btn btn-highlight">
					<a href="#" attr-id="<?php echo $team['id']; ?>" attr-description="<?php echo utf8_decode($team['title']); ?>">
						Destacar
					</a>
				</div>
			</li>
			<?php } ?>
			 
		</ul>
		
		<?php
		  if($count==0){ 
			require_once(DIR_BLOCO . "/noads.php");
		  }
		?> 
	</div>
	
</div> 