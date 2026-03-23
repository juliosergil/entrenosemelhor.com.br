<?php
require_once(dirname(dirname(dirname(__FILE__))) . '/app.php');
// need_comentado //need_auth('market');
 
$id =  $_REQUEST['id'] ;
$page = Table::Fetch('page', $id);

if(!empty($page)){
	$edicao = true; 
}


$table 	= new Table('page', $_POST); 
$uarray = array( 'id', 'value',  'data_criacao', 'titulo', 'status','imagemcapa','blog');

//$posicao = $_POST['posicao'];
//$sql = "UPDATE page SET posicao = 'normal' WHERE posicao = '".$posicao."'";
//mysqli_query(DB::$mConnection,$sql);

if ( !$edicao ) { // cadastro
	
	if( !is_post()){
		include template('manage_system_pageadd');
	 
	}
	else{  
	
		$table->data_criacao = date("Y-m-d H:i:s"); 
		
		$table->imagemcapa = upload_image('imagemcapa','','pagina');
		
		$table->id = mt_rand(5, 1000000000);
		$flag = $table->insert($uarray);
		$articleId = mysqli_insert_id(DB::$mConnection); 
		
		if($flag){
			Session::Set('notice', 'Dados cadastrados com sucesso.');
			redirect( WEB_ROOT . "/vipmin/system/page.php");
		}
		else{
			Session::Set('notice', 'Erro no cadastro dos dados');
			redirect( WEB_ROOT . "/vipmin/system/pageadd.php");
		}
	
	} 
}

else  { // edicao
 
	if(!is_post()){
		include template('manage_system_pageadd');
	}
	else{ 
		$table->datamodificacao = date("Y-m-d H:i:s");  
		$table->imagemcapa = upload_image('imagemcapa','','pagina');
		
		  if(empty($_FILES['imagemcapa']['tmp_name'])) { 
 
				$key = array_search('imagemcapa', $uarray);
				if($key!==false){
					unset($uarray[$key]);
				}
		  
			}
	
		$flag = $table->update($uarray);  
		if($flag){
			Session::Set('notice', 'Dados alterados com sucesso.');
			redirect( WEB_ROOT . "/vipmin/system/page.php");
		}
		else{
			Session::Set('notice', 'Erro na alteração dos dados');
			redirect( WEB_ROOT . "/vipmin/system/pageadd.php");
		}
	} 
}
