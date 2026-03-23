<?php
 
include "../app.php";  
$sqlcat="";
if($_REQUEST["idcategoria"]){
	$sqlcat =  " and group_id = ".$_REQUEST["idcategoria"];
}

$horaatual 	= time(); 

if($INI['option']['paginacao'] == ""){
	$per_page = 6;
}
else{
	$per_page = $INI['option']['paginacao'];
} 

 
$sqlc 		= "select * from team where team_type = 'especial' and posicionamento <> 5 and begin_time < '$horaatual' $sqlcat";
$rsdc 		= mysqli_query(DB::$mConnection,$sqlc);
$cols 		= mysqli_num_rows($rsdc);
$page 		= $_REQUEST['page'];

$start 		= ($page-1)*$per_page;
$sql 		= "select * from  team where team_type = 'especial' and posicionamento <> 5 and begin_time < '$horaatual' $sqlcat order by `end_time` DESC , `now_number` limit $start,$per_page ";
$rsd 		= mysqli_query(DB::$mConnection,$sql);

$temoferta=false; 
while ($value = mysqli_fetch_assoc($rsd))
{
	$temoferta=true;
	$end_time = date('YmdHis', $value['end_time']); 
	$date = date('YmdHis');

	$tx = "Vendido"; if($value['now_number']>1) { $tx = "Vendidos"; }

	$nomeurl = urlamigavel(tratanome($value['title']));
	$ofertafechada = false;

	 if( $end_time  < $date){
		$ofertafechada = true;
	  }

	$esgotado =	false;
	if($value['now_number'] >= $value['max_number']){
		$esgotado=true;
	}
    $quantidade_faltante  = $value['max_number'] - $value['now_number'];
	
	$discount_rate = round(100 - $value['team_price']/$value['market_price']*100,0);

	$summary = substr($value['summary'],0,200)."...";
	$min = $value['min_number'] ;
	  
	$discount_price = $value['market_price'] - $value['team_price'];
	$discount_rate = round(100 - $value['team_price']/$value['market_price']*100,0);

	$left = array();
	$now = time();
	$diff_time = $left_time = $value['end_time']-$now;

	$left_day 	= floor($diff_time/86400);
	$left_time 	= $left_time % 86400;
	$horafaltante 	= floor($left_time/3600);
	$left_hour 	= floor($left_time/3600);
	$left_time 	= $left_time % 3600;
	$left_minute = floor($left_time/60);
	$left_time 	= $left_time % 60;
	
  
	/* progress bar size */
	$bar_size = ceil(190*($value['now_number']/$value['min_number']));
	$bar_offset = ceil(5*($value['now_number']/$value['min_number']));

	$partner = Table::Fetch('partner', $value['partner_id']);

	 
	include(DIR_BLOCO."/bloco_recentes_vitrine.php"); 
	 
	?>
	 <script>
		//alert('<?=$left_day?>') 
		J('#<?php echo $value['id']?>_countdown').countdown({
		until: '<? echo $left_day; ?>d<? echo $left_hour; ?>h<? echo $left_minute; ?>m<? echo $left_time; ?>s',

		<? if( $left_day == 1) {?> 
			format: 'd',
			layout: 'Falta {dn} dia <br>'
		<? } 
		else if( $left_day >= 1) {?> 
			format: 'dh',
			 layout: 'Faltam {dn} dias <br>'
		<? } else { ?>
			format: 'hms',
			layout: '{hn}h &nbsp;&nbsp;{mn}m &nbsp;&nbsp;{sn}s <br>'  
		<? } ?>		  
		});
 
	</script>
<?php
	if( $ofertafechada){ 
		?><script>  
			J('#<?php echo $value['id']?>_countdown').html("Tempo esgotado"); 
			J('#<?php echo $value['id']?>_temporestante').html(""); 
			J('#<?php echo $value['id']?>_quebra').show(); 
		 </script>
	<? }

}
if(!$temoferta){
	include(DIR_BLOCO."/categoria_sem_oferta.php"); 
}
 
?>