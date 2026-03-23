<?php

$idpais =  94; // irlanda
 
//include "../app.php";  

// importa configuracoes para conexao no banco de dados que contem a tabelas das cidades mundiais
$db_host = "localhost";
$db_username = "root";
$db_password = "senha";
$db_name = "cidadesmundo";

$connec_citys = mysqli_connect($db_host, $db_username, $db_password,$db_name);

if(!$connec_citys){
	 echo mysqli_connect_error();
	 exit;
}
  
// importa configuracoes para conexao no banco de dados que contem do site

$db_host = "localhost";
$db_username = "root";
$db_password = "senha";
$db_name = "guiagoprime";

$connec_site = mysqli_connect($db_host, $db_username, $db_password,$db_name );

if(!$connec_site){
	 echo mysqli_connect_error();
	 exit;
}
  
 // deleta os estados nacionais 
$sql = " TRUNCATE estados" ;
$rs = mysqli_query($connec_site,$sql ); 

 // deleta as cidades nacionais 
$sql = " TRUNCATE cidades" ;
$rs = mysqli_query($connec_site, $sql );  

/* listando a tabela region do bando de dados mundial para popular a tabela de estados*/ 
 
 $sql = "INSERT INTO database1.table (column)
SELECT database2.table.column
FROM database2.table";
 
$sql = "select * from  regions where country_id = $idpais" ;
$rs = mysqli_query($connec_citys,$sql ); 
while($row = mysqli_fetch_assoc($rs)){

	echo "--".$row[name];
	
}

?>