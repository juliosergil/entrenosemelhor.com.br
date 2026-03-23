<?php
$id = abs(intval($_POST['id']));
need_login();
 
if($_SESSION["finalizacompracupom"]){
    unset($_SESSION["finalizacompracupom"]);
	redirect( WEB_ROOT . "/index.php");
}
$idcarrinho = $_POST['idcarrinho'];
$valorfrete = $_POST['totalfrete'];

$_SESSION["finalizacompracupom"] = true;

$txterro = "";
//O item que você está comprando não existe
$team = Table::Fetch('team', $id);
 
if ( !$team || $team['begin_time']>time() ) {
	//Session::Set('error', 'O item que você está comprando não existe mais!');
	redirect( WEB_ROOT . "/index.php");
}

$ex_con = array(
		'user_id' => $login_user_id,
		'team_id' => $team['id'],
		'state' => 'unpay',
		);
$order = DB::LimitQuery('order', array(
	'condition' => $ex_con,
	'one' => true,
));

//você já comprou este produto, busque outras ofertas
if (strtoupper($team['buyonce'])=='Y') {
	$ex_con['state'] = 'pay';
	if ( Table::Count('order', $ex_con) ) {
		$txterro =  'você já comprou este produto, busque outras ofertas!';
	}
} else if ($team['per_number']>0) {
	$now_count = Table::Count('order', array(
		'user_id' => $login_user_id,
		'team_id' => $id,
		'state' => 'pay',
	), 'quantity');
	$team['per_number'] -= $now_count;
	if ($team['per_number']<=0) {
		$txterro = 'Você chegou ao limite de compra para esta oferta, por favor dê uma olhada em outras ofertas!';
	}
} 
$team['state'] = team_state($team);

if ( $team['close_time'] ) {
	 $txterro =  'Desculpe, O tempo para comprar esta oferta se esgotou.';
}
 		
 
if ( $_POST["acao"] =="pag" and $txterro=="" ) {
	
	$table = new Table('order', $_POST);
	$table->quantity = abs(intval($table->quantity));

	//Quantidade não pode ser inferior a 1
	if ( $table->quantity == 0 ) {
		$txterro = 'Quantidade não pode ser inferior a 1';
	}
	//sua compra foi além do limite
	else if ( $team['per_number']>0 && $table->quantity > $team['per_number'] ) {
		$txterro = 'Sua compra foi além do limite!';
	}
	else{
		
		if ($order && $order['state']=='unpay') {
			$table->SetPk('id', $order['id']);
		}
		 
		 $statuspedido =  "unpay";
		 
		if($INI['option']['pontuacao']=="Y" and $_POST['cartpontos']=="1"){
			$totalpontoscart = (int)$_POST['quantity'] * (int)$team['pontos'];
			if((int)$login_user['score'] >= (int)$totalpontoscart){
			 $statuspedido =  "pay";
			 $usopontos = true;
			 $service= "pontos"; 
			}
		} 
		 
		$condbuy =  htmlentities($table->condbuy);
	
		$table->user_id = $login_user_id;
		$table->tipo = $service;
		$table->service = $service;
		$table->condbuy = $condbuy;
		$table->valorfrete = $valorfrete;
		$table->state = $statuspedido;
		$table->team_id = $team['id'];
		$table->city_id = $team['city_id'];
		$table->express = ($team['delivery']=='express') ? 'Y' : 'N';
		$table->fare = $table->express=='Y' ? $team['fare'] : 0;
		$table->price = $team['team_price'];
		$table->datapedido = date("Y-m-d H:i:s");
		$table->credit = 0;
		if ( $table->id ) {
			$eorder = Table::Fetch('order', $table->id);
			if ($eorder['state']=='unpay'&& $eorder['team_id'] == $id && $eorder['user_id'] == $login_user_id   ) {
				$table->origin = team_origin($team, $table->quantity);
				$table->origin -= $eorder['card'];
			} else {
				$eorder = null;
			}
		}
		if (!$eorder){
			$table->SetPk('id', null);
			$table->create_time = time();
			$table->origin = team_origin($team, $table->quantity);
		}

		$insert = array(
				'user_id', 'team_id', 'city_id', 'state',
				'fare', 'express', 'origin', 'price',
				'address', 'zipcode', 'realname', 'mobile',
				'quantity', 'create_time', 'remark', 'condbuy','datapedido','service','tipo','valorfrete'
			);

		if ($flag = $table->insert($insert)) {
			$order_id = mysqli_insert_id(DB::$mConnection); 
	 
			$order = Table::Fetch('order', $order_id);
			 
			if($team['frete']=="1" ){
			
				$sql = "update order_enderecos set idpedido = '$order_id' where idcarrinho=".$idcarrinho;
				$rs =  mysqli_query(DB::$mConnection,$sql);
				unset($_SESSION['IDCARRINHO']);
				$_SESSION['IDCARRINHO']=""; 
			}	
			 
			$sql = "ALTER TABLE  `order_amigos` ADD  `qtde` INT( 11 ) NULL AFTER `id`";
			$rs = @mysqli_query(DB::$mConnection,$sql);

			$sql = "ALTER TABLE  `order_amigos` ADD  `atualizado` INT( 11 ) NULL AFTER `id`";
			$rs = @mysqli_query(DB::$mConnection,$sql);

			if($_REQUEST['nomeuso1']){
				$nome = utf8_decode($_REQUEST['nomeuso1'])  ;
				$qtde = $_REQUEST['qtde1']; 
				 $sql =  "insert into order_amigos (nome,order_id,qtde) values ('$nome',$order_id,$qtde)";
				mysqli_query(DB::$mConnection,$sql);
			}
			if($_REQUEST['nomeuso2'] and $_REQUEST['nomeuso2'] != "Nome de quem vai usar este cupom"){
				$nome =utf8_decode($_REQUEST['nomeuso2']);
				$qtde =$_REQUEST['qtde2'];
			    $sql =  "insert into order_amigos (nome,order_id,qtde) values ('$nome',$order_id,$qtde)";
				mysqli_query(DB::$mConnection,$sql);
			}
			if($_REQUEST['nomeuso3'] and $_REQUEST['nomeuso3'] != "Nome de quem vai usar este cupom"){
				$nome =utf8_decode($_REQUEST['nomeuso3']);
				$qtde =$_REQUEST['qtde3'];
				$sql =  "insert into order_amigos (nome,order_id,qtde) values ('$nome',$order_id,$qtde)";
				mysqli_query(DB::$mConnection,$sql);
			}
			if($_REQUEST['nomeuso4'] and $_REQUEST['nomeuso4'] != "Nome de quem vai usar este cupom"){
				$nome =utf8_decode($_REQUEST['nomeuso4']);
				$qtde =$_REQUEST['qtde4'];
				$sql =  "insert into order_amigos (nome,order_id,qtde) values ('$nome',$order_id,$qtde)";
				mysqli_query(DB::$mConnection,$sql);
			}
			 
		   if( $usopontos ){
			
				$totalpontoscart = (int)$_POST['quantity'] * (int)$team['pontos'];
				$sql = "update user set score = score  - ".$totalpontoscart ." where id =".$login_user['id'];
				$rs =  mysqli_query(DB::$mConnection,$sql); 
				ZTeam::BuyOnePontos($order); 
				 
			} 
			
			if (!$order) {
				$txterro = 'Desculpe, houve um erro ao buscar os dados do pedido. Por favor, entre em contato conosco.';
			}
			if ( $order['user_id'] != $login_user['id']) {
			
				$o_userid		=$order['user_id'];
				$o_login_user	=$login_user['id'];
			
				$txterro=  'Desculpe, Esse pedido gerou um conflito em nossos sistema. Por favor, entre em contato conosco. ( "'.$o_userid.' ) - ( '.$o_login_user.' ) ';
			}
		
			if ( $order['state'] == 'unpay' ) {

				/*
				if($INI['pagseguro'] && $order['service']=='pagseguro') {
					$ordercheck['pagseguro'] = 'checked';
				}
				else if($INI['alipay']['mid'] && $order['service']=='alipay') {
					$ordercheck['alipay'] = 'checked';
				}
				else if($INI['moip']['mid'] && $order['service']=='moip') {
					$ordercheck['moip'] = 'checked';
				}
				else if($INI['pagamentodg']['mid'] && $order['service']=='pagamentodg') {
					$ordercheck['pagamentodg'] = 'checked';
				}
				else if($INI['bill']['mid'] && $order['service']=='bill') {
					$ordercheck['bill'] = 'checked';
				}
				else if($INI['paypal']['acc'] && $order['service']=='paypal') {
					$ordercheck['paypal'] = 'checked';
				}

				else if($INI['alipay']['mid']) {
					$ordercheck['alipay'] = 'checked';
				}
				else if($INI['pagamentodg']['mid']) {
					$ordercheck['pagamentodg'] = 'checked';
				}
				else if($INI['mercadopago']['mid']) {
					$ordercheck['mercadopago'] = 'checked';
				}
				else if($INI['moip']['mid']) {
					$ordercheck['moip'] = 'checked';
				}
				else if($INI['bill']['mid']) {
					$ordercheck['bill'] = 'checked';
				}
				else if($INI['paypal']['acc']) {
					$ordercheck['paypal'] = 'checked';
				}

				$credityes = ($login_user['money'] >= $order['origin']);
				$creditonly = ($team['team_type'] == 'seconds' && option_yes('creditseconds'));
				*/
				

			   /* generator unique pay_id */ 
				$randid = rand(1000,9999);
				$pay_id = "go-{$order['id']}-{$order['quantity']}-{$randid}";
				Table::UpdateCache('order', $order['id'], array('pay_id' => $pay_id,));
			}
	  
		}
	}
}

//each user per day per buy
if (!$order) {
	$order = json_decode(Session::Get('loginpagepost'),true);
	settype($order, 'array');
	if ($order['mobile']) $login_user['mobile'] = $order['mobile'];
	if ($order['zipcode']) $login_user['zipcode'] = $order['zipcode'];
	if ($order['address']) $login_user['address'] = $order['address'];
	if ($order['realname']) $login_user['realname'] = $order['realname'];
	$order['quantity'] = 1;
}
//end;

$order['origin'] = team_origin($team, $order['quantity']);

if ($team['max_number']>0 && $team['conduser']=='N') {
	$left = $team['max_number'] - $team['now_number'];
	if ($team['per_number']>0) {
		$team['per_number'] = min($team['per_number'], $left);
	} else {
		$team['per_number'] = $left;
	}
}

$tituloproduto =  utf8_decode(substr($team['title'],0,80))."..." ; 
$item_valor = number_format($team['team_price'], 2, ',', '.');
$title  = utf8_decode(substr($team['title'],0,80))."...";
$idproduto = $team['id'];
 
if($txterro==""){
 
	 if(!$oferta_ativa){
		$body2 = "<p><b>Lembrando que, o cupom só será gerado assim que a oferta estiver ativa</b></p>" ;
	}
 
  $parametros = array( 'realname' => $login_user['realname'], 'title' => $team['title'], 'quantity' => $order['quantity'],  'body2' => $body2 ,'origin' => $order['origin'],'remark' => $_REQUEST['remark']);
  $request_params = array(
		'http' => array(
			'method'  => 'POST',
			'header'  => implode("\r\n", array(
				'Content-Type: application/x-www-form-urlencoded',
				'Content-Length: ' . strlen(http_build_query($parametros)),
			)),
			'content' => http_build_query($parametros),
		)
	);
   $request  = stream_context_create($request_params);

    
	$emailadmin = $INI['mail']['from'];
     
	if($usopontos){
	   $arquivotemplate = "confirmacao_pedido_pontos.php";
	   $arquivotemplateadmin = "nova_solicitacao_pedido_admin.php";
	}
	else{
		$arquivotemplate = "confirmacao_pedido.php";
		$arquivotemplateadmin = "nova_solicitacao_pedidopontos_admin.php";
	}
   
   //emvia email para cliente
   if($team["team_type"] != "off"){
	$mensagem = file_get_contents($INI["system"]["wwwprefix"]."/templates/".$arquivotemplate, false, $request);
	enviar( $login_user['email'],ASSUNTO_NOVO_PEDIDO. ": ".displaySubStringWithStrip($team['title'],80),$mensagem);
   }

	//emvia email para administrador
	$assunto = "Novo Pedido Realizado";
	$mensagemadmin = file_get_contents($INI["system"]["wwwprefix"]."/templates/nova_solicitacao_pedido_admin.php", false, $request);
	enviar( $emailadmin ,$assunto,$mensagemadmin);

	$mensagem="";
	unset($mensagem);

	$envio = true;
}

$pagina = "pedido";




?>