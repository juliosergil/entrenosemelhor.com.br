<?php

class Categoria{
  
	public function getCategorias(){ 
	
		$sql 	= "select id,title,image,homepage from partner where display='Y' order by rand()";
		$result = mysqli_query(DB::$mConnection,$sql); 
		return $result;	
	}
	public function getMenuNavegacao(){ 
	
		global $ROOTPATH;
	    $sql 	= "select * from category where zone = 'group' and display='Y' order by sort_order desc, id asc";
		$result = mysqli_query(DB::$mConnection,$sql); 
		while($row 	= mysqli_fetch_object($result)){
		
			require(DIR_BLOCO."/bloco_menu_navegacao.php");
		}
	}
	
	public function getCategoria($categoria_id){ 
	
		$sql 	= "select * from category where id = $categoria_id";
		$result = mysqli_query(DB::$mConnection,$sql); 
		$dados 	= mysqli_fetch_assoc($result);
		return $dados;	
	}
}


?>