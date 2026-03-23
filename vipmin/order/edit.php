<?php
require_once(dirname(dirname(dirname(__FILE__))) . '/app.php');
 
need_manager();
// need_comentado need_auth('market');
   
 

$id =  $_REQUEST['id'] ;
 
$planos_publicacao = Table::Fetch('planos_publicacao', $id);
 
if(!empty($planos_publicacao)){
	$edicao = true; 
}

if ( !$edicao ) { // cadastro
	
	if( !is_post()){
		include template('manage_order_edit');
	}
	else{
   
	} 
}

else  { // edicao
 
	if(!is_post()){
		include template('manage_order_edit');
	}
	else{
		$table = new Table('planos_publicacao', $_POST);   
	  
		$table->valor = str_replace("R$ ","",str_replace(",",".",str_replace(".","", $_POST['valor'])));
	  
		$up_array = array(
			'nome', 'dias', 'valor', 'ativo', 'texto','destaque','qtdeanuncio', 'top', 'slide_interna','linkpagamento'
		);
		   
		$flag = $table->update( $up_array );
		
		if ( $flag) {
			Session::Set('notice', 'Dados do plano alterados com sucesso');
			redirect( WEB_ROOT . "/vipmin/order/index.php");
		}
		else{
			Session::Set('notice', 'Erro na alteração dos dados');
			redirect( WEB_ROOT . "/vipmin/order/index.php");
		}
	} 
}

