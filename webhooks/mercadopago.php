<?php

require_once(dirname(dirname(__FILE__)). '/app.php');

 Util::log(" ####### CHAMADA DO RETORNO DE PAGAMENTO #######  ");
 
$MP_ACCESS_TOKEN = $INI['mercadopago']['token'];
$SIGNATURE = 'OxK1MBl1cP9j97l5';

 Util::log(" TOKEN: ".$MP_ACCESS_TOKEN);
 
 

if ($_GET['signature'] !== $SIGNATURE) {
    //return;
}
 
$requestBody = file_get_contents('php://input');
$requestBody = json_decode($requestBody, true);

$_POST = $requestBody;

if ($_POST['type'] !== 'payment') {
	 Util::log(" type nao eh pagamento. Saindo...: ".$_POST['type']);
     return;
}

$paymentId = $_POST['data']['id'];
 Util::log("paymentId:  ".$paymentId);
 
$headers = [
    'Content-Type: application/json',
    'Authorization: Bearer ' . $MP_ACCESS_TOKEN
];

$curl = curl_init();

curl_setopt($curl, CURLOPT_URL, "https://api.mercadopago.com/v1/payments/$paymentId");
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

Util::log("URL para debugar: https://api.mercadopago.com/v1/payments/$paymentId");
 
$response = curl_exec($curl);
curl_close($curl);

$response = json_decode($response, true);

$status  = $response['status'];
$team_id = $response['external_reference'];

//$team_id=264; 
//$status="approved";
 

Util::log("Status: $status ");
Util::log("ID TEAM: $team_id ");


if ($status === 'approved') { 
	
	$sql = "UPDATE team SET status = 1, pago = 'sim' WHERE id = $team_id";
	$rs		=	mysqli_query(DB::$mConnection,$sql);
	
	Util::log("SQL: UPDATE team SET status = 1, pago = 'sim' WHERE id = $team_id");
	
    $team = Table::Fetch('team', $team_id);
	$plano_id =  $team["id_plano"];
	 
	alteradatafim_anuncio($team_id,$plano_id );
	
}
