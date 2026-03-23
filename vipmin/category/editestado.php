<?php
require_once(dirname(dirname(dirname(__FILE__))) . '/app.php');

need_manager();
// need_comentado need_auth('market');
 
$id =  $_GET['id'] ;
$category = Table::Fetch('estados', $id);
 
if(!empty($category)){
	$edicao = true; 
}

$table = new Table('estados', $_POST); 
$uarray = array(  'uf','nome'  );

if (!$edicao) { // cadastro
	
	if(!is_post()){
		include template('manage_category_editestado');
	}
	else{ 
		  
		$flag = $table->insert($uarray);
		
		if($flag){
			Session::Set('notice', 'Dados cadastrados com sucesso!');
			redirect( WEB_ROOT . "/vipmin/category/indexestados.php");
		}
		else{
			Session::Set('notice', 'Erro ao inserir dados!');
			redirect( WEB_ROOT . "/vipmin/category/indexestados.php");
		}
	
	} 
}

else  { // edicao
 
	if(!is_post()){
		include template('manage_category_editestado');
	}
	else{ 
		  
		$table->SetPk('id', $id); 
		$flag = $table->update($uarray); 
		
		if ( $flag) {
			Session::Set('notice', 'Dados alterados com sucesso!');
			redirect( WEB_ROOT . "/vipmin/category/indexestados.php");
		}
		else{
			Session::Set('notice', 'Erro na alteração dos dados!');
			redirect( WEB_ROOT . "/vipmin/category/indexestados.php");
		}
	} 
}