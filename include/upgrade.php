<?php

require_once(dirname(dirname(__FILE__)). '/app.php');

$sql = "ALTER TABLE `team` CHANGE `nascimento` `nascimento` TEXT NULL DEFAULT NULL; ";
$rs = @mysqli_query(DB::$mConnection,$sql);

$sql = "ALTER TABLE  `team` ADD  `processo_compra` VARCHAR( 20 ) NULL  ";
$rs = @mysqli_query(DB::$mConnection,$sql);
 

 
?>