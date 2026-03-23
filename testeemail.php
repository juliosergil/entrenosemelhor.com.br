<?php  		
		require_once(dirname( __FILE__). '/app.php');
		
		error_reporting(E_ALL);
		
		 $para="brunosantos.em@gmail.com";  
		  
	    $parametros = $_POST;
		$request_params = array(
			'http' => array(
				'method'  => 'POST',
				'header'  => implode("\r\n", array(
					'Content-Type: application/x-www-form-urlencoded',
					'Content-Length: ' . strlen(http_build_query($parametros)),
				)),
				'content' => http_build_query($parametros),
			)
		);

		$request  = stream_context_create($request_params);
		$body = file_get_contents($INI["system"]["wwwprefix"]."/templates/cadastro.php", false, $request);
		
		//$body="oi";
		
		 if(mail($para, "enviando email do servidor", $body,getHeader())){ 
			echo "<br>enviou via file_get_contents ";   
		 }
		else{
			echo "<br>erro via file_get_contents ";  
		}   
		
		
		
		 function getFrom(){
		
			global $INI;
			
			if($INI['mail']['mail'] == "smtp"){
				$from = $INI['mail']['user'];
				ini_set("SMTP", $INI['mail']['user']); 
			}
			else{
				$from = $INI['mail']['from'];
			}
			return $from;  
			
	   }
	   
      function getHeader(){
		
	          global $INI;
			   
		    $HEADER = "MIME-Version: 1.0\r\n";
			$HEADER .= "Content-Type: text/html; charset='ISO-8859-1'\r\n";
			$HEADER .= "From: ".$INI['system']['sitename']." <". getFrom().">\r\n";
			$HEADER .= "X-Priority: 3\r\n"; 
			
			return $HEADER;
		}
		
		