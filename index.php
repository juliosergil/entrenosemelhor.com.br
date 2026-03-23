<?php

require_once(dirname(__FILE__) . '/app.php');

if($INI['option']['index_manutencao'] == 'Y' AND $login_user['id'] != 1){
	require_once(WWW_ROOT."/manutencao.php");
	exit;
} 

// Perguntar para o Bruno se tem problema 
/*if(detectResolution()) {
	if($_REQUEST['idpagina']){
		$endereco = $ROOTPATH . "/mobile/page/".$_REQUEST['idpagina'];
		header("Location: " . $endereco);
		exit;
	} 
	if($_REQUEST['idoferta']){
		
		$endereco = $ROOTPATH . "/mobile/?idoferta=".$_REQUEST['idoferta'];
		header("Location: " . $endereco);
		exit;
	}
	else{
		$endereco = $ROOTPATH . "/mobile/index.php";
		header("Location: " . $endereco);
		exit;
	}
}*/
 

//RemoveXSS($_REQUEST); 
if($_REQUEST["idpagina"]){
	$idpagina 	= explode("/",$_REQUEST["idpagina"]); // urlrewrite
	$idpagina = $idpagina[0];
 
}
 
if($_REQUEST["idoferta"]){
 
	$idoferta 	= explode("/",$_REQUEST["idoferta"]); // urlrewrite
	$linkaux 	= explode("/",$_REQUEST["idoferta"]); // urlrewrite
	$idoferta	=  $idoferta[0]; 
	 
}

if($_REQUEST['login_fb']=="true"){

	mail_cadastro_fb($_REQUEST['user_id']);
			
} 

if($idoferta) {
	$team = $BlocosOfertas->getOfertaDestaqueHome($idoferta); 
}

if($_REQUEST['page']){
	require_once(DIR_DESIGN."/".$_REQUEST["page"].".php");
	exit;
} 
if($idoferta or $INI['option']['redirecionador'] == "Y" ){ 
	require_once(DIR_DESIGN."/home_detalhe_produto.php");
}
else if($INI['option']['paginainicial'] != "" ){ 
	$idpagina  = $INI['option']['paginainicial'];
	require_once(DIR_DESIGN."/pagina.php");
}
else{ 
	require_once(DIR_DESIGN."/home.php");
}

if(file_exists(WWW_MOD."/verifica_anuncios_finalizados.inc")) { envia_email_anuncios_finalizados(); }
offerTop();
?>  
