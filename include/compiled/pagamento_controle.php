<?php  

if(isset($_REQUEST['idanuncio'])){
	$anuncio = $_REQUEST['idanuncio'];
}

$idplano = $_REQUEST['idplano'];
$teamid = $_REQUEST['teamid']; 

if($anuncio){
	$nome = "Reativação do anúncio nº ".$anuncio;
}else{
	$nome = "Aquisição de plano ".$planos_publicacao['nome'];
}

if(empty($idplano )){
	?>
		<script>
		alert("Por favor, escolha o plano novamente e refaça o anúncio.")
		location.href="<?=$ROOTPATH?>/index.php?page=planos";
		</script>
		
	<?
	exit;
}
$planos_publicacao  = Table::Fetch('planos_publicacao',$idplano);
  
if($idnovo){
	$idanuncio = $idnovo;
}else if($anuncio){
	$idanuncio = $anuncio;
}
else{
	$idanuncio = $teamid;
}
	 
$iduser = $_SESSION['user_id'];  
$user = Table::Fetch('user', $iduser);

if($idplano=="10"){ 
	//plano gratis = id 10
	finalizaanuncio($idanuncio,$idplano);
} 
$idpedido =  $idanuncio;
 
	 
?> 