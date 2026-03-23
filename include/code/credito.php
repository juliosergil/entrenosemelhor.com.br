<?php

if ( $_POST['service'] == 'credit' ) {
	if ( $order['origin'] > $login_user['money'] ){
		Table::Delete('order', $_POST['order_id']);
		$error = "Infelizente o seu saldo não é suficiente para pagar esta oferta.
		 <a href='history.go(-1)'>clique aqui</a> para escolher outro método de pagamento.
		";
	}
	else{
		$orderid =  $_POST['order_id'];
		Table::UpdateCache('order', $_POST['order_id'], array(
					'service' => 'credit',
					'money' => 0,
					'state' => 'pay',
					'credit' => $_POST['origin'],
					'pay_time' => time(),
					));
		$order = Table::FetchForce('order',$_POST['order_id']);
		
		ZTeam::BuyOne($order); 
		}
	}



?>