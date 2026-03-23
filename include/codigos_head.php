<?

$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$URL = $ROOTPATH;

function destroi_sessao_admin(){
	
	$_SESSION = array();
	if (ini_get("session.use_cookies")) {
		$params = session_get_cookie_params();
		setcookie(
			session_name(),
			'',
			time() - 42000,
			$params["path"], 
			$params["domain"],
			$params["secure"],
			$params["httponly"]
		);
		foreach (array_keys($_COOKIE) as &$value) {
			setcookie($value, null, -1, '/');
		}
	}
	session_destroy();
}

function eh_admin(){
	 
	if ( $_SESSION['user_id']== "1"){  
		return true;
	}
}
 
 if( eh_admin() ){         // admin logado no vipmin, nao pode ficar logado no frontend
	$login_user_id = "";
	unset($login_user_id); 
	unset($login_user); 
}

?>