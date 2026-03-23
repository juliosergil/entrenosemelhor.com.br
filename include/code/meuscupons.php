<?php

need_login();
 
$daytime = strtotime(date('d-m-Y'));

$consumido = strval($_GET['consumido']);
$idpedido = $_REQUEST['idpedido'];

if($consumido == ""){
	$consumido= "N";
}

if($_REQUEST['idpedido']){

		$condition = array(
		'user_id' => $login_user_id,
		'order_id' => $idpedido,
	);
	
}

else if($_GET['expirados']== "Y"){

		$condition = array(
		'user_id' => $login_user_id,
		'consume' => "$consumido",
		"expire_time < {$daytime}",
	);

}
else{	
	$condition = array(
		'user_id' => $login_user_id,
		'consume' => "$consumido",
	);
} 

$count = Table::Count('coupon', $condition);

list($pagesize, $offset, $pagestring) = pagestring($count, 100);
$coupons = DB::LimitQuery('coupon', array(
	'condition' => $condition,
	'order' => 'ORDER BY order_id desc, create_time',
	'size' => $pagesize,
	'offset' => $offset,
));

$team_ids = Utility::GetColumn($coupons, 'team_id');
$teams = Table::Fetch('team', $team_ids);



?>