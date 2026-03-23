<?php

error_reporting (E_ALL);
require_once(dirname(dirname(__FILE__)) . '/app.php'); // RSPONSAVEL POR FAZER A CONEXAO COM BANCO DE DADOS INTERNO
 /*
$username = "vipcomho_vipcom";
$host 		= "localhost";
$database = "vipcomho_cidadesmundo";
$password = "orbsat2006";
*/

$username = "vipcomho_bruno";
$host = "localhost";
$database = "vipcomho_cidadesmundo";
$password = "orbsat2006";

 
function getConnected($host,$user,$pass,$db) {

   $mysqli = new mysqli($host, $user, $pass, $db);

   if($mysqli->connect_error) 
     die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());

   return $mysqli;
}
 
$mysqli = getConnected($host,$username,$password,$database);



$countries = mysqli_query($mysqli , "SELECT * FROM countries") or die(mysqli_error());
  
 
//Mudança de cidades e regioes
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    if(!empty($_POST['country']))
    {
	
		
		$sql = "ALTER TABLE `team` CHANGE `uf` `uf` VARCHAR(50) NULL DEFAULT NULL;";
		$rs = mysqli_query(DB::$mConnection,$sql);
		
		
		$sql = "ALTER TABLE `team` CHANGE `city_id` `city_id` INT(10) UNSIGNED NULL DEFAULT NULL;";
		$rs = mysqli_query(DB::$mConnection,$sql);

        
        $countrySelected = $_POST['country'];
       // $regions = $conn->query("select * from regions WHERE country_id = '{$countrySelected}' ")->fetchAll();
       // $cities = $conn->query("select * from cities WHERE country_id = '{$countrySelected}'")->fetchAll();

	 
		$regions = mysqli_query($mysqli, "select * from regions WHERE country_id = $countrySelected") or die(mysqli_error());
		$cities = mysqli_query($mysqli, "select * from cities WHERE country_id = $countrySelected") or die(mysqli_error());
		
	 
        exec_action("DELETE FROM cidades WHERE 1 = 1");
        exec_action("DELETE FROM estados WHERE 1 = 1");
 
		while ($region = mysqli_fetch_assoc($regions)) 
        {
            $id = $region["id"];
            $name = utf8_encode($region["name"]);
            $code = utf8_encode($region["code"]);
            if($name != "")
                exec_action("INSERT INTO estados (id,uf,nome) VALUES ({$id},'{$id}','{$name}')");
        } 
		
		while ($city = mysqli_fetch_assoc($cities))
        {
            $name = utf8_encode($city["name"]);

            $region_id = $city["region_id"];
            if($name != "")
                exec_action("INSERT INTO cidades (estado,uf,nome) VALUES ('{$region_id}','{$region_id}','{$name}')");
        }
    }

?>
<H1> REGIÕES ALTERADAS COM SUCESSO</H1>
<?
}


function exec_action($sql){
    $rs 	= mysqli_query(DB::$mConnection,$sql);
    $row 	= mysqli_fetch_object($rs);
    return $row;
}

 
// pequeno prototipo abaixo
?>


<HTML>
<FORM action="" method="post" >
    <h3>SELECIONE O PAÍS PARA MUDAR AS REGIÕES E ESTADOS</h3>
    <select name="country">
        <?php while ($country = mysqli_fetch_assoc($countries)) { ?>
        <option value="<?=$country['id']?>"><?=$country['name']?></option>
        <?php } ?>
    </select>
    <button type="submit">ENVIAR</button>
</FORM>
</HTML>
