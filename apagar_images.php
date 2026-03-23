<?php  
  
  require_once(dirname(__FILE__). '/app.php');
  
  function recurse_del($src) { 

	$dir = opendir($src);  
	while(false !== ( $file = readdir($dir)) ) { 
		if (( $file != '.' ) && ( $file != '..' )) { 
			if ( is_dir($src . '/' . $file) ) { 
				recurse_del($src . '/' . $file); 
			} 
			else { 
			     
				 // verifica se este arquivo de imagem está na tabela team
			      
				  $fileaux = $file;
				 $fileaux = explode("_",$fileaux);
				 $fileaux =  $fileaux[0];
				   
				$consulta = "
				
					SELECT * FROM team where  image like '%$fileaux%'  or image1 like '%$fileaux%'  or image2 like '%$fileaux%'  or gal_image1 like '%$fileaux%'  or gal_image2 like '%$fileaux%'  or gal_image3 like '%$fileaux%'  or gal_image4 like '%$fileaux%'  or gal_image5 like '%$fileaux%'  or gal_image6 like '%$fileaux%'   
			
				";
				$resultado = mysqli_query(DB::$mConnection,$consulta);

				if(mysqli_num_rows($resultado) ==0){
					if(unlink($src . '/' . $file)){
					//if(1==1){
						echo " <br>  - deletado:  ". $src . '/' . $file ;
					
					}
					else{
						echo "<br> - erro ao deletar ". $src . '/' . $file ;
					}
				 }
				 else{
					 echo "<br> - ACHOU    ". $src . '/' . $file ;
					 echo "<br> IMAGEM  ".  $file ;
					  
				 }
				 	
			} 
		} 
	} 
	closedir($dir); 
}

recurse_del('media/team');

?>
