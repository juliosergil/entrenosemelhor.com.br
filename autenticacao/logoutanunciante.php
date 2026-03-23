<?php
require_once(dirname(dirname(__FILE__)) . '/app.php');

ob_get_clean();
if(isset($_SESSION['user_id'])) {
	unset($_SESSION['user_id']);
	ZLogin::NoRemember();
	ZUser::SynLogout();  
	
	if($_SESSION['access_token']!=''){
 
	   unset($_COOKIE['user_id']);
	 
	  // print_r($_COOKIE);
	  // exit;
	  redirect( WEB_ROOT . '/adminanunciante/login.php');
	}
	if($fblogouturl!='')
    	redirect($fblogouturl);
	else
	   redirect( WEB_ROOT . '/adminanunciante/login.php');

}
 
 
redirect( WEB_ROOT . '/index.php');
