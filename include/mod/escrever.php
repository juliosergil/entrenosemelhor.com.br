<?php
$nome = $_REQUEST['nome'];
$arquivo = fopen($nome.".inc",'w');
if ($arquivo == false) die('Não foi possível criar o arquivo.');
if ($arquivo == true) echo ' feito' ;
?>