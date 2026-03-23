<?php

  header('Content-Type: text/html; charset=ISO-8859-1');

 if ($_POST) {
 
	$table = new Table('feedback', $_POST);
	$table->city_id = abs(intval($city['id']));
	$table->create_time = time();
	$table->category = 'suggest';
	$table->title = htmlspecialchars($table->title);
	$table->content = $_POST['content'];
	$table->contact = htmlspecialchars($table->contact);
	/*$table->Insert(array(
		'city_id', 'title', 'contact', 'content', 'create_time',
		'category',
	));
	*/
	  
    $sql = "INSERT INTO `feedback` ( `city_id`, `user_id`, `category`, `title`, `contact`, `content`, `create_time`) VALUES
			( ".abs(intval($city['id'])).", ".$login_user_id.", 'suggest', '".htmlspecialchars($_POST['title'])."', '".htmlspecialchars($_POST['contact'])."', '".htmlentities($_POST['content'])."', ".time().")";
	 mysqli_query(DB::$mConnection,$sql);
	  

	$body = 
	    "<h2>Contato</h2><br>
		<h3> Dados do Contato</h3>
		<p>Nome: ".$_REQUEST["title"]."</p>
		<p>Email: ".$_REQUEST["contact"]."</p> 
		<h3> Mensagem</h3>
		
		<p>".$_REQUEST["content"]."</p>" ;

	if($INI['mail']['mail'] == "smtp"){
		$para = $INI['mail']['user'];  
	}
	else{
		$para = $INI['mail']['from'];
	}

	 if(enviar($para,"Contato",utf8_decode($body))){
		  $enviou =  true;
 	 }
 	 else{
		$enviou =  false;
	 } 
}



?>