<?php

require_once "./app.php";
 
$idprofissional = strval($_REQUEST['idprofissional']);
$avaliacao = strval($_REQUEST['avaliacao']);
$nome_comment = strval($_REQUEST['nome_comment']); 
$email_comment = strval($_REQUEST['email_comment']); 
$comment = strval($_REQUEST['comment']);
$partner  = Table::Fetch('partner',$idprofissional); 
$user  = Table::Fetch('user',$login_user_id); 
 
	   
if ( $_POST ) {

	$dominio = getDomino($email_comment); 
	if(!checkdnsrr ($dominio)){
			echo  utf8_encode("Por favor, informe um email válido");
			exit;
	} 
	
	$insert = array(
		'idprofissional', 'nome_comment', 'email_comment',  'comment', 'data', 'user_id','avaliacao', 
	); 
	$mensagens = $_POST; 
	$data = date("Y-m-d H:i:s");
	$mensagens['data'] = $data;
	$mensagens['user_id'] = $login_user_id; 
	$table = new Table('mensagens', $mensagens);
	 
    $flag = $table->insert($insert);
	
	if($flag){ 
			echo utf8_encode("A sua avaliação foi registrada com sucesso !") ;
	}
	else{
		echo utf8_encode("Houve um erro no registro de sua avaliação !") ;
	}	
 
	$parametros = array( 'idprofissional' => $idprofissional, 'nome_comment' => $nome_comment, 'email_comment' => $email_comment,  'comment' => $comment);
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
	$mensagem = file_get_contents($INI["system"]["wwwprefix"]."/templates/envio_mensagem.php", false, $request);
 
	if(enviar( $user['email'],ENVIO_MENSAGEM,$mensagem)){
			$enviado=true;
	}

	$mensagem="";
	unset($mensagem);  
}
