<?php

class Parceiro{
  
	public function getParceiros(){ 
	
		$sql 	= "select id,title,image,homepage from partner where tipo = 'parceiro' and display='Y' order by rand()";
		$result = mysqli_query(DB::$mConnection,$sql); 
		return $result;
		 
	}
	public function getParceiro($partner_id){ 
	
		$sql 	= "select * from partner where  display='Y' and id =  $partner_id";
		$result = mysqli_query(DB::$mConnection,$sql); 
		$dados 	= mysqli_fetch_assoc($result);
		return $dados;	
	}
}


?>