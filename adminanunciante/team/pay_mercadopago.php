<?
  
	if ($INI['mercadopago']['token'] !== '') {
		// Criar preferência do Mercado Pago
		$MP_ACCESS_TOKEN = $INI['mercadopago']['token'];
		$MP_BACK_URL = $ROOTPATH.'/adminanunciante/team/index.php';
		$MP_WEBHOOK_URL = $ROOTPATH.'/webhooks/mercadopago.php'; // URL DE RETORNO - ATUALIZACAO NO BANCO 
		$MP_WEBHOOK_SIGNATURE = 'OxK1MBl1cP9j97l5';

		$data = [
			'items' => [
				[
					'id' => $_REQUEST['idplano'],
					'title' => ' Pagamento Plano do Site. Cod: '.$_REQUEST['idplano'],
					'quantity' => 1,
					'unit_price' => (float) $planos_publicacao['valor']
				]
			],
			'back_urls' => [
				'success' => $MP_BACK_URL,
				'pending' => $MP_BACK_URL,
				'failure' => $MP_BACK_URL
			],
			'external_reference' => (string) $idnovo,
			'notification_url' => $MP_WEBHOOK_URL . '?source_news=webhooks&signature=' . $MP_WEBHOOK_SIGNATURE
		];

		$headers = [
			'Content-Type: application/json',
			'Authorization: Bearer ' . $MP_ACCESS_TOKEN
		];

		$curl = curl_init();

		curl_setopt($curl, CURLOPT_URL, 'https://api.mercadopago.com/checkout/preferences');
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

		$response = curl_exec($curl);
		curl_close($curl);

		$response = json_decode($response, true);
		$id = $response['id'];

		redirect( WEB_ROOT . '/include/compiled/manage_team_pagamento_mercadopago.php?idplano='.$_REQUEST['idplano']."&teamid=".$idnovo . '&preference_id=' . $id);
	 } else {
		 echo "O administrador do site ainda não configurou a sua conta do Mercado Pago. Por favor acesse Sistema->Métodos de Pagamento";
		 exit;
	}
 
?>