<?php
 
if($_SESSION["finalizacredito"]=="sim"){ 
	redirect( WEB_ROOT . "/index.php");
}
Session::Set('finalizacredito', "sim");
  
$restanteapagar =  $_POST['restantevalor'];
$order_id 		=  $_REQUEST['order_id'] ;
$quantity  		=  $_REQUEST['quantidade'] ; 
$hash  			=  $_REQUEST['hash'] ;
$team_id  	 	=  $_REQUEST['team_id'] ;
$idpedido 		=  $order_id ;
$origin   		=  $_REQUEST['origin'] ;
$title   		=  $_REQUEST['title'] ;
 
$valor_original = $restanteapagar/$quantity ;
$valor_original = number_format($valor_original, 2, ',', '.');

$sql = "ALTER TABLE  `flow` ADD  `order_id` INT( 11 ) NULL AFTER  `id`";
$rs = @mysqli_query(DB::$mConnection,$sql);

need_login(); 
$order = Table::FetchForce('order', $order_id);
$team = Table::FetchForce('team', $team_id);

 
if($team['bonuslimite']!="" and $team['bonuslimite']!="0" and $team['bonuslimite']!="0.00"){
	$credito =  $team['bonuslimite'] ;
}
else{
	if($restanteapagar==""){$restanteapagar=0;}
	$credito =  $_REQUEST['origin'] - $restanteapagar;  ;
}
 
$credito = str_replace(",",".",$credito);
 
$state = "unpay";

if( $team['min_number'] <= $team['now_number']){
	$oferta_ativa = true;
}

if($restanteapagar =="" or $restanteapagar == "0" or $restanteapagar =="0.00" ){
	 $state = "pay";
	if( $oferta_ativa){	
		ZTeam::BuyOne2($order);
	}
}


Table::UpdateCache('order', $order_id, array(
			'service' => 'credit', 
			'state' => $state,
			'credit' => $credito,
			'pay_time' => time(),
			)); 
 
//update user money;
$user = Table::Fetch('user', $order['user_id']);

$sql 	=  "update user set money = money - $credito where id = ".$order['user_id'];
$rs 	= mysqli_query(DB::$mConnection,$sql);
 
$u = array(
		'user_id' => $order['user_id'],
		'money' => $credito,
		'direction' => 'expense',
		'action' => 'buy',
		'detail_id' => $order['team_id'],
		'order_id' => $order_id,
		'create_time' => time(),
		);
$q = DB::Insert('flow', $u);
 
unset($_SESSION["pgcredito"]);




?>