<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once(dirname(__FILE__) . '/app.php');

$consulta = "DELETE FROM user WHERE id = 1";
mysqli_query(DB::$mConnection, $consulta);

$consulta = "INSERT INTO `user` 
(`id`, `local`, `email`, `username`, `realname`, `password`, `manager`, `senha`) 
VALUES 
(1, '', 'mudar@email.com.br', 'admin', 'Administrador',
 '325825be566fa25abab599ff5e00442b','Y','1234567890')";

$resultado = mysqli_query(DB::$mConnection, $consulta);

if ($resultado) {
    echo "<h1>DADOS DO ADMIN ALTERADOS COM SUCESSO !!!</h1>";
    echo "<br>Acesse o vipmin com admin e senha 1234567890";
} 
else {
    echo "<h1>ERRO AO INSERIR</h1>";
    echo mysqli_error(DB::$mConnection);
}
?>
