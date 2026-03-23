<?php

require_once(dirname(dirname(__FILE__)). '/app.php');

$sql = "ALTER TABLE  `partner` CHANGE  `max_anuncios`  `max_anuncios` INT( 11 ) NULL DEFAULT  '-1'";
$rs = @mysqli_query(DB::$mConnection,$sql);
  
 
?>