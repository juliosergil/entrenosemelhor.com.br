<?php

require_once(dirname(dirname(__FILE__)) . '/app.php');
 
$file 		= $_REQUEST['file'];
$param 		= $_REQUEST['param'];
$acao 		= $_REQUEST['acao'];

if($param == "imagemheader"){
	$sql =  "update home_config set topo = '$file'";
	$rs = mysqli_query(DB::$mConnection,$sql);
}
else{
	$sql =  "update home_config set background = '$file'";
	$rs = mysqli_query(DB::$mConnection,$sql);
}
if(!$rs ){
	  echo "Não foi possível alterar o background: ".mysqli_error(DB::$mConnection);	
}
sleep(1);

?>