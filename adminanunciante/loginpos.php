<?php
require_once(dirname(dirname(__FILE__)) . '/app.php'); 

unset($_SESSION['user_id']);    


if ( $_POST ) {
	if ( !$login_admin ) {
		$login_admin = ZUser::GetLogin($_POST['username'], $_POST['password']);
		
		if ( !$login_admin ) {
			Session::Set('error', 'Nome de usuário e senha não conferem!');
			redirect( WEB_ROOT . '/adminanunciante/login.php');
		}
	}
	
	if($login_admin){
		redirect( WEB_ROOT . '/adminanunciante/index.php');
	}
}

include template('manage_login');