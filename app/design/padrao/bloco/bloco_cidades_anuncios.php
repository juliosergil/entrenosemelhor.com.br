<div style="display:none;height:36px;" class="tips"><?=__FILE__?></div> 

<?
	
	$state = $_REQUEST['Estado'];

    if($idcategorias){
		$sqlauxcat = " and b.group_id in  ( " . $idcategorias. " )" ;
	}
	if($state){
		$sqlauxstate =  " a.uf = '" . $state . "' and " ;
	}
	
	/* Busca das cidades */
	$sql = "select a.nome, a.id from cidades a where $sqlauxstate a.id IN ( select b.city_id from team b where b.city_id = a.id and b.begin_time < '".time()."' and b.end_time > '".time()."' and ( b.status is null or b.status = 1) and (b.pago = 'sim' or b.anunciogratis = 's') $sqlauxcat ) ";
	$rs = mysqli_query(DB::$mConnection,$sql);
	
	/* Total registros */
	$total = mysqli_num_rows($rs);
	
	/* Número de colunas */
	$num = ceil($total / 2); 

	if($total > 0){ ?>

	<div class="list-city-offer">
	<?php
		$j = 1;
		
		while($row = mysqli_fetch_assoc($rs)) { 
			if(empty($id_category)) {
				$totalC = get_total_anuncios_city($row['id'],$cppesquisa); 
			}
			else {
				$sqlC = "select count(*) as total from team where city_id = " . $row['id'] . " and group_id in  ( " . $idcategorias. " )";
				
				$rsC = mysqli_query(DB::$mConnection,$sqlC);
				$rowC = mysqli_fetch_assoc($rsC);
				$totalC = $rowC['total'];
			} 
			
			$cidade = Table::Fetch('cidades', $row['id']); 
			$linkC = gera_link($state,$id_category,$row['id'],$cppesquisa);
			
			if($j == 1 || $j == $num) {
		?>
		<ul>
		<?php } ?>
			<li>
				<a href="<?php echo "$linkC"; ?>">
					<?php
						echo utf8_decode($row['nome']);
					?>
					-
					<span class="total-city">
						<?php
							echo empty($totalC) ? "0 anúncios" : $totalC . " anúncio(s)";
						?>
					</span>
				</a>
			</li>
		<?php
			if($j == $total || $j == ($num - 1)) {
		?>

		</ul>
		<?php } ?>
		<?php $j ++; } ?>
	</div>

<? } ?>