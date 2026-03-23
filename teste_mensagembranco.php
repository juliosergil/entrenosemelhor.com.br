<?php  
	
 
$mensagem = file_get_contents("http://www.montadorbr.com.br/templates/cadastro.php", false);
echo "--".$mensagem;

?>