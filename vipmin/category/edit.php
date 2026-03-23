<?php
require_once(dirname(dirname(dirname(__FILE__))) . '/app.php');

need_manager();
// need_comentado need_auth('market');
 
$id =  $_REQUEST['id'] ;
$category = Table::Fetch('category', $id);
$zone = $_REQUEST['zone'];
 
 
if($zone=="city"){
	$tipo="Cidade";
}
else{
	$tipo="Categoria";
}

if(!empty($category)){
	$edicao = true; 
}

$table 	= new Table('category', $_POST); 
$uarray = array('imagemcateghome', 'zone',  'name', 'display', 'sort_order','bannercategoria','idpai','tipo','linkexterno','target','imagemcateghome2','displayhome','displaymenu' );
$table->display = strtoupper($table->display)=='Y' ? 'Y' : 'N';
$table->displayhome = strtoupper($table->displayhome)=='Y' ? 'Y' : 'N';

if ( !$edicao ) { // cadastro
	
	if( !is_post()){
		include template('manage_category_edit');
	}
	else{ 
		  
		if($_FILES['imagemcateghome']['name'] != "") {
			$table->imagemcateghome = upload_image('imagemcateghome',$category2['imagemcateghome'],'imagemcateghome','imagemcateghome');
		}
		
		if($_FILES['imagemcateghome2']['name'] != "") {
			$table->imagemcateghome2 = upload_image('imagemcateghome2',$category2['imagemcateghome2'],'imagemcateghome2','imagemcateghome2');
		}
		if($_FILES['displaymenu']['name'] != "") {
			$table->displaymenu = upload_image('displaymenu',$category2['displaymenu'],'displaymenu','displaymenu');
		}	
		 
		$flag = $table->insert($uarray);
		
		if($flag){
			Session::Set('notice', 'Dados cadastrados com sucesso.');
			redirect( WEB_ROOT . "/vipmin/category/index.php?zone=$zone");
		}
		else{
			Session::Set('notice', 'Erro na alteração dos dados');
			redirect( WEB_ROOT . "/vipmin/category/index.php?zone=$zone");
		}
	
	} 
} 
else  { // edicao
 
	if(!is_post()){
		include template('manage_category_edit');
	}
	else{ 
		
		if($_FILES['imagemcateghome']['name'] != "") {
			$table->imagemcateghome = upload_image('imagemcateghome',$category2['imagemcateghome'],'imagemcateghome');
		}			 
		if($_FILES['imagemcateghome2']['name'] != "") {
			$table->imagemcateghome2 = upload_image('imagemcateghome2',$category2['imagemcateghome2'],'imagemcateghome2');
		}
		if($_FILES['displaymenu']['name'] != "") {
			$table->displaymenu = upload_image('displaymenu',$category2['displaymenu'],'displaymenu','displaymenu');
		}
		
		$flag = $table->update($uarray); 
		
		if ( $flag) {
			Session::Set('notice', 'Dados alterados com sucesso');
			redirect( WEB_ROOT . "/vipmin/category/index.php?zone=$zone");
		}
		else{
			Session::Set('notice', 'Erro na alteração dos dados');
			redirect( WEB_ROOT . "/vipmin/category/index.php?zone=$zone");
		}
	} 
}