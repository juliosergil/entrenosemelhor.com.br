<?php

require_once(dirname(__FILE__). '/app.php');

$consulta = " select * from user where id=1";
$resultado = @mysqli_query(DB::$mConnection,$consulta);
$row = mysqli_fetch_assoc($resultado);

echo "--email: " .$row['email'];
echo "<br>--username: " .$row['username'];
echo "<br>--senha: " .$row['senha'];
 
 
 
?>