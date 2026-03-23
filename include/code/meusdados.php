<?php

need_login();
if ( $_POST ) {
	
	unset($msgM);
	
	$update = array(
	 	'email' => $_POST['email'],
		'realname' => utf8_encode($_POST['realname']),
	    'zipcode' => $_POST['cep_'],
	    'address' => utf8_encode($_POST['endereco_']), 
	    'numero' => $_POST['numero_'], 
	    'complemento' => utf8_encode($_POST['complemento_']), 
	    'mobile' => $_POST['numero_'],
	    'bairro' => utf8_encode($_POST['bairro_']),
	    'cidadeusuario' => utf8_encode($_POST['cidadeusuario_']),
	    'estado' => $_POST['estado_'],
	    'ddd' => $_POST['ddd_'],
	    'mobile' => $_POST['telefone_'],
		'city_id' => abs(intval($_POST['websites3'])),
	 );
 
	if ( trim($_POST['meusdados_password']) != "" )
	{
		
		if(trim($_POST['meusdados_password']) == trim($_POST['meusdados_password2'])){
			$update['password'] = trim($_POST['meusdados_password']);
			$update['senha']     = trim($_POST['meusdados_password']);
		}
	}
	  
	if ( ZUser::Modify($login_user['id'], $update) ) {
		
		$msg = 'Dados modificados com sucesso, aperte crtl + f5 para visualizar as modifica��es!' ;
		$msgM = "Dados modificados com sucesso, atualize a p&aacute;gina para visualizar as modifica��es!";
	} else {
		$msg = 'Houve uma falha na atualiza&ccedil;&atilde;o dos dados!' ;
		$msgM = "Houve uma falha na atualiza&ccedil;&atilde;o dos dados!";
	 }
}

$readonly['email'] = defined('UC_API') ? '' : 'readonly';
$readonly['username'] = defined('UC_API') ? 'readonly' : '';
	
$pagetitle = "";



?>