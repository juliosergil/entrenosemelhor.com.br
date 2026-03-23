<?php   

//require_once(dirname(dirname(__FILE__)) . '/app.php');

$width_o 	=  $_REQUEST["width"];  
$height_o 	=  $_REQUEST["height"];  
$idcidade 	=  $_REQUEST["idcidade"];  
$id 		=  $_REQUEST["id"];  
  
  
	  if($_REQUEST['tipo']=='imagensbackground'){   
		$nome =  mt_rand(1244, 8915);  
		$diretorio = $_REQUEST['dir'];
		$nome.=".jpg";
		$destination_path = dirname(getcwd())."/skin/padrao/".$diretorio."/".$nome;	
		$target_path = $destination_path ;	  

		$result = 0;      
		if(move_uploaded_file($_FILES['myfile']['tmp_name'], $target_path)) {      
			$result = 1;   
		}    
		sleep(1);
 	 
	}
	else if($_REQUEST['tipo']=='background'){     

		$nome =  mt_rand(1244, 8915);     
		$destination_path = dirname(getcwd())."/skin/padrao/background/".$nome.".png";	
		$target_path = $destination_path ;	  

		$result = 0;      
		if(move_uploaded_file($_FILES['myfile']['tmp_name'], $target_path)) {      
			$result = 1;   
		}    
		sleep(1);
 	 
	}
	
	
	if($_REQUEST['tipo']=='diversas'){     

			$nome =  $_REQUEST["nome"];      
			$destination_path = dirname(getcwd())."/skin/padrao/images/".$nome;	
			$target_path = $destination_path ;	  

			$result = 0;      
			if(move_uploaded_file($_FILES['myfile']['tmp_name'], $target_path)) {      
				$result = 1;   
			}    
		sleep(1);	

	}
		else if($_REQUEST['nome']=='favicon'){     
		
		$nome =  $_REQUEST["nome"]; 
		//$destination_path = getcwd().DIRECTORY_SEPARATOR."/".$nome."/"; 
		$destination_path = dirname(getcwd())."/skin/padrao/images/".$nome.".ico";	
		$target_path = $destination_path;
		$result = 0; 

		list($width, $height) = getimagesize($_FILES['myfile']['tmp_name']);
	     
		if(@move_uploaded_file($_FILES['myfile']['tmp_name'], $target_path)) {
		  $result = 1;
		} 
  
		 
		sleep(1);
 	 
	}
	
	else if($_REQUEST['tipo']=='publicidade'){     

		$nome =  $_REQUEST["nome"]; 
		$destination_path = getcwd().DIRECTORY_SEPARATOR."/".$nome."/";
		$target_path = $destination_path . "".$nome."_".$id.".png"; 
		$result = 0; 

		list($width, $height) = getimagesize($_FILES['myfile']['tmp_name']);
	     
		if(@move_uploaded_file($_FILES['myfile']['tmp_name'], $target_path)) {
		  $result = 1;
		} 
  
		if($result==1){
			if((int)$width != (int)$width_o or (int)$height !=(int) $height_o ){
			  //$result = 2;
			} 
		} 
		sleep(1);
		
		//busca_publicidade();
 	 
	}	 
	else if($_REQUEST['tipo']=='topo'){     

		$nome =  $_REQUEST["nome"];      
		$destination_path = dirname(getcwd())."/skin/padrao/topo/".$nome.".png";	
		$target_path = $destination_path ;	  

		$result = 0;      
		if(move_uploaded_file($_FILES['myfile']['tmp_name'], $target_path)) {      
			$result = 1;   
		}    
		sleep(1);
 	 
	}	
	else if($_REQUEST['tipo']=='home'){     
		
		$nome =  $_REQUEST["nome"]; 
		//$destination_path = getcwd().DIRECTORY_SEPARATOR."/".$nome."/"; 
		$destination_path = getcwd()."/skin/padrao/images/".$nome.".jpg";	
		$target_path = $destination_path;
		$result = 0; 
 
	     
		if(@move_uploaded_file($_FILES['myfile']['tmp_name'], $target_path)) {
		  $result = 1;
		}
  
		 
		sleep(1);
 	 
	}
	else if($_REQUEST['tipo']=='pop'){     
		
		$nome =  $_REQUEST["nome"]; 
		$destination_path = dirname(getcwd()).DIRECTORY_SEPARATOR."/".$nome."/";
		$nome =  "banner"; 
		$target_path = $destination_path . "".$nome."_".$idcidade.".jpg"; 
		$result = 0; 

		  
		if(@move_uploaded_file($_FILES['myfile']['tmp_name'], $target_path)) {
		  $result = 1;
		} 
  
		 
		sleep(1);
 	 
	}	
	else if($_REQUEST['nome']=='imagemhome'){     
		
		$nome =  $_REQUEST["nome"]; 
		$destination_path = getcwd()."/skin/padrao/images/".$nome.".jpg";	 
		$result = 0; 

		list($width, $height) = getimagesize($_FILES['myfile']['tmp_name']);
	     
		if(@move_uploaded_file($_FILES['myfile']['tmp_name'], $destination_path	)) {
		  $result = 1;
		} 
		if($result==1){
			if((int)$width != (int)$width_o or (int)$height !=(int) $height_o ){
			  //$result = 2;
			}
		}
	 
   
		sleep(1);
 	 
	}
	
	else{
		//logo
		$nome =  $_REQUEST["nome"]; 
		$destination_path = getcwd().DIRECTORY_SEPARATOR."/".$nome."/";
		$target_path = $destination_path . "".$nome.".png"; 
		$result = 0; 

		list($width, $height) = getimagesize($_FILES['myfile']['tmp_name']);
	     
		if(@move_uploaded_file($_FILES['myfile']['tmp_name'], $target_path)) {
		  $result = 1;
		} 
		if($result==1){
			if((int)$width != (int)$width_o or (int)$height !=(int) $height_o ){
			  $result = 1;
			}
		}
	  
		sleep(1);
 
}
?>
	
 <script language="javascript" type="text/javascript">
  window.top.window.stopUpload(<?php echo $result; ?>);
</script>