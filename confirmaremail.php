<?php
require_once(dirname(__FILE__) . '/app.php');
 
$secret =  $_GET['secret'] ;

if ($secret) { 

	$sql 	=  "select * from subscribe where secret= '".$secret."'";
	$rs 	= mysqli_query(DB::$mConnection,$sql);
	$row 	= mysqli_fetch_object($rs);

	$email 	= $row->email;
	$ativo 	= $row->ativo;
		
	
	if(!empty($email) and empty($ativo)){ // falta confirmar
	
		echo $sql =  "update subscribe set ativo = 's' where secret = '".$secret."'";
		$rs = mysqli_query(DB::$mConnection,$sql);
		?>
		<script>
		alert("<?=utf8_encode("Confirmação de email realizada com sucesso! Agora você está pronto para receber nossas ofertas. Parabéns !")?>")
		</script>
		<?
	}
	if(!empty($email) and  $ativo == "s"){ // confirmado
		 echo utf8_encode("Não se preocupe, O seu email já está ativado.");
		 exit;
	}
	if( empty($email) and empty($ativo)){ // usuario nao encontrado
	 
		 echo utf8_encode("Me desculpe, mais não conseguimos encontrar o seu usuário.");
		 exit;
		  
	}
		
}

redirect( WEB_ROOT  . '/index.php');

 
