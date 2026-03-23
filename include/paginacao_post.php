<?php
 
include "../app.php";  

header("Content-Type: text/html; charset=ISO-8859-1"); 
$horaatual 	= time();  

if($INI['option']['paginacao'] == ""){
	$per_page = 12;
}
else{
	$per_page = $INI['option']['paginacao'];
} 

$page 		= $_REQUEST['page'];
$start 		= ($page-1)*$per_page;

if( $_REQUEST['idparceiro'] != "" ){
	$temoferta_website = $BlocosOfertas->produtos_websites_afiliados($start,$per_page);
} else{ 
	$temoferta = $BlocosOfertas->ofertas_recentes($start,$per_page); // esse metodo traz as ofertas recentes de parceiros e anunciantes, porem para ofertas de anunciantes a oferta deve ser valida ( data final < que data corrente)
}

if(!$temoferta and !$temoferta_website){
	include(DIR_BLOCO."/categoria_sem_oferta.php"); 
}
 

?>