<?php
need_login();
unset($_SESSION["loginpagepost"]);
unset($_SESSION["finalizacompracupom"]);
unset($_SESSION["finalizacredito"]);

$_SESSION["pgcredito"] =  "1";

$id = abs(intval($_REQUEST['id']));

$team = Table::Fetch('team', $id);
if(!$team){
	$team = Table::Fetch('produtos_afiliados', $id);
} 
if ( !$team || $team['begin_time']>time() ) {
	$ERROR = 'Esta oferta não existe mais em nossos registros. Desculpe!';
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

if (strtoupper($team['buyonce'])=='Y') {
	$ex_con['state'] = 'pay';
	if ( Table::Count('order', $ex_con) ) {
		$ERROR = 'Você já comprou esta oferta. Informamos que para esta oferta, você só pode comprar uma vez. Obrigado !';
	}
}
else if ($team['per_number']>0) {
	$now_count = Table::Count('order', array(
		'user_id' => $login_user_id,
		'team_id' => $id,
		'state' => 'pay',
	), 'quantity');
	$team['per_number'] -= $now_count;
	if ($team['per_number']<=0) {
		$ERROR = 'Você chegou ao limite de compra para esta oferta, por favor, dê uma olhada em outras ofertas!' ;
	}
} 
  
if ($team['max_number']>0 && $team['conduser']=='N') {
	$left = $team['max_number'] - $team['now_number'];
	if ($team['per_number']>0) {
		$team['per_number'] = min($team['per_number'], $left);
	} else {
		$team['per_number'] = $left;
	}
}

$tituloproduto =  substr($team['title'],0,100)."..." ; 

$item_valor = $team['team_price'];
 
if($team["team_type"] == "cupom"){
	 $item_valor =  $team['preco_comissao'] ;
} 
$item_valorjs =  $item_valor ;

$valor2 = 2 * $team['team_price'];
$valor2 =  number_format($valor2, 2, ',', '.');

$valor3 = 3 * $team['team_price'];
$valor3 = number_format($valor3, 2, ',', '.');

$valor4 = 4 * $team['team_price'];
$valor4 = number_format($valor4, 2, ',', '.');

$pagina = "carrinho";  

if($team['frete']=="1" ){
	$classebox =  "boxtotal";
	if( $team['fretegratuito'] == "1"){
		$valorfrete = "0,00";
	}
	else if( $team['valorfrete'] != "" and $team['valorfrete'] != "0,00"){
		$valorfrete = $team['valorfrete'];
	}
	else{
		$valorfrete = calculaFrete(41106,$team['ceporigem'], getCepDestino($login_user), $team['peso'], $team['altura'], $team['largura'],  $team['comprimento'], $team['team_price']);
	}

	if(empty($_SESSION['IDCARRINHO'])){
		$_SESSION['IDCARRINHO'] = rand(1000,9999);
		
		$sql = "select idcarrinho from order_enderecos where idcarrinho=".$_SESSION['IDCARRINHO'];
		$rs =  mysqli_query(DB::$mConnection,$sql);
			
		if(mysqli_num_rows($rs) == 0){ //atualiza o endereço de cobranca ou entrega
			$sql = " 
			INSERT INTO `order_enderecos` ( `idcarrinho`, `entrega_cep`, `entrega_endereco`, `entrega_numero`, `entrega_complemento`, `entrega_bairro`, `entrega_cidade`, `entrega_estado`, `entrega_telefone`, `cobranca_cep`, `cobranca_endereco`, `cobranca_numero`, `cobranca_complemento`, `cobranca_bairro`, `cobranca_cidade`, `cobranca_estado`, `cobranca_telefone`) VALUES
			(  ".$_SESSION['IDCARRINHO'].",  '".$login_user['entrega_cep']."', '".$login_user['entrega_endereco']."', '".$login_user['entrega_numero']."', '".$login_user['entrega_complemento']."', '".$login_user['entrega_bairro']."', '".$login_user['entrega_cidade']."', '".$login_user['entrega_estado']."', '".$login_user['entrega_telefone']."', '".$login_user['cobranca_cep']."', '".$login_user['cobranca_endereco']."', '".$login_user['cobranca_numero']."', '".$login_user['cobranca_complemento']."', '".$login_user['cobranca_bairro']."', '".$login_user['cobranca_cidade']."', '".$login_user['cobranca_estado']."', '".$login_user['cobranca_telefone']."');
			";
			$rs =  mysqli_query(DB::$mConnection,$sql);
		}	
	}
 
}
else{
	$classebox="boxtotalsemfrete";
} 


 

?>