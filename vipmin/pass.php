<?php
require_once(dirname(dirname(__FILE__)) . '/app.php');
$user = Table::Fetch('user', 1);
$email = $user['email'];
$senha = $user['senha'];

$body =  "Segue abaixo os dados de acesso do Vipmin do site ".utf8_decode($INI['system']['sitename'])."<br> Email: $email e senha: $senha";

if(empty($email)){
	$erro1 = "Não foi possível enviar o email. O email está vazio";
}
else{
	if($email == "admin@admin.com.br"){
		$erro2 =  true;
	}	
} 

if($INI['mail']['mail'] == "smtp"){
	$para = $INI['mail']['user'];  
}
else{
	$para = $INI['mail']['from'];
}

if($para == "atendimento@dominio.com.br"){
	$erro3 = true;
}

if($erro2 and $erro3) { 
	echo "Não foi possível enviar o email. Você não alterou o email e ele ainda está com o valor padrão do sistema ($para)";
}
else{
    
	if(!$erro2){
		
		if(enviar($email,"Envio de Senha",$body)){
			 echo "Os dados de acesso foram enviados com sucesso para o email $email";
			 $enviou = true;
		 }
		 else{
			echo "Não foi possível enviar os dados de acesso para o email $email";
		 }
	 
	}
	if(!$enviou){
		if(!$erro3){
			
			if(enviar($para,"Envio de Senha",$body)){
				 echo "Os dados de acesso foram enviados com sucesso para o email $para";
			 }
			 else{
				echo "Não foi possível enviar os dados de acesso para o email $para";
			 }
		 
		}
	} 
} 

?>