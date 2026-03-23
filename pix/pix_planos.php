<?php 

require_once(dirname(dirname(__FILE__)). '/app.php');

   if (!empty($INI["credito"]["chave_pix"])) {
      $chave_pix=strtolower($INI["credito"]["chave_pix"]);
      $beneficiario_pix=removerAcentos($INI["credito"]["beneficiario_pix"]);
      $cidade_pix=removerAcentos($INI["credito"]["cidade_pix"]);
      if (isset($INI["credito"]["descricao_pix"])){
         $descricao=$INI["credito"]["descricao_pix"];
      }
      else { $descricao=''; }
      if ((!isset($_REQUEST["identificador"])) || (empty($_REQUEST["identificador"]))) {
         $identificador="***";
      }
      else {
         $identificador=$_REQUEST["identificador"];
      }
      $gerar_qrcode=true;
   }
   else {
      $cidade_pix="SAO PAULO";
      $gerar_qrcode=false;
   }
 
 //echo "---".$_REQUEST["valor"];
if ($_REQUEST["valor"]){
	 $valor_pix =  str_replace(",",".",$_REQUEST["valor"]);
	$valor_pix=preg_replace("/[^0-9.]/","",$valor_pix);
  
}
else {
   $valor_pix="10.00";
}

 //echo "-------------->".$cidade_pix;
  //echo "-------------->".$_REQUEST["valor"];
 //echo "-------------->".$valor_pix;
 //echo "-------------->".$chave_pix;
// echo "-------------->".$beneficiario_pix;

$cidade_pix="SAO PAULO";
$INI['system']['sitename'] = str_replace(" ","",$INI['system']['sitename']);
$INI['system']['sitename'] = strtolower($INI['system']['sitename']);
 $beneficiario_pix = $INI['system']['sitename'];
 
?> 

<!doctype html>
<html lang="pt-br">
<head>
<title>PAGAR COM PIX</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">  
<!--
<link href="phpqrcode/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" type="text/css">
<link href="phpqrcode/css/grid.scss" rel="stylesheet" type="text/css" >
<link href="phpqrcode/css/reboot.scss" rel="stylesheet" type="text/css" >
<script src="phpqrcode/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<script src="phpqrcode/js/jquery.min.js" type="text/javascript"></script>
<script src="phpqrcode/js/0f8eed42e7.js" crossorigin="anonymous"></script>
-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
<script src="https://kit.fontawesome.com/0f8eed42e7.js" crossorigin="anonymous"></script>
 

<script>
function copiar() {
  var copyText = document.getElementById("brcodepix");
  copyText.select();
  copyText.setSelectionRange(0, 99999); /* For mobile devices */
  document.execCommand("copy");
  document.getElementById("clip_btn").innerHTML='<i class="fas fa-clipboard-check"></i>';
}
function reais(v){
    v=v.replace(/\D/g,"");
    v=v/100;
    v=v.toFixed(2);
    return v;
}
function mascara(o,f){
    v_obj=o;
    v_fun=f;
    setTimeout("execmascara()",1);
}
function execmascara(){
    v_obj.value=v_fun(v_obj.value);
}
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script> 

<style>
a {text-decoration: none;} 
p {text-align: center;}


.row>* { 
    width: 49% !important; 
}

.card {
    width: 100% !important;  
}

@media (min-width: 992px){
	.row-cols-lg-auto>* {
		width: 49%  !important;  
	}
}

</style>
</head>
<body style="text-align: center;">
<div style="text-align: center; clear:both;" > 

<?=utf8_decode($INI["credito"]["mensagem_pix"])?> 
 
</div>
<?php
/* 
# Exemplo de uso do php_qrcode_pix com descrição dos campos 
# Desenvolvido em 2021 por Vipcom Sistemas - http://www.vipcomsistemas.com.br
# 
*/
if ($gerar_qrcode){
   include "phpqrcode/qrlib.php"; 
   include "funcoes_pix.php";
   $px[00]="01"; //Payload Format Indicator, Obrigatório, valor fixo: 01
   // Se o QR Code for para pagamento único (só puder ser utilizado uma vez), descomente a linha a seguir.
   //$px[01]="12"; //Se o valor 12 estiver presente, significa que o BR Code só pode ser utilizado uma vez. 
   $px[26][00]="BR.GOV.BCB.PIX"; //Indica arranjo específico; “00” (GUI) obrigatório e valor fixo: br.gov.bcb.pix
   $px[26][01]=$chave_pix;
   if (!empty($descricao)) {
      $tam_max_descr=99-(4+4+4+14+strlen($chave_pix));
      if (strlen($descricao) > $tam_max_descr) {
         $descricao=substr($descricao,0,$tam_max_descr);
      }
      $px[26][02]=$descricao;
   }
   $px[52]="0000"; //Merchant Category Code “0000” ou MCC ISO18245
   $px[53]="986"; //Moeda, “986” = BRL: real brasileiro - ISO4217
   $px[54]=$valor_pix;
   $px[58]="BR"; //“BR” – Código de país ISO3166-1 alpha 2
   $px[59]=$beneficiario_pix; //Nome do beneficiário/recebedor. Máximo: 25 caracteres.
   $px[60]=$cidade_pix; //Nome cidade onde é efetuada a transação. Máximo 15 caracteres.
   $px[62][05]=$identificador;
   $px[62][50][00]="BR.GOV.BCB.BRCODE"; //Payment system specific template - GUI
   $px[62][50][01]="1.0.0"; //Payment system specific template - versão
   $pix=montaPix($px);
   $pix.="6304"; //Adiciona o campo do CRC no fim da linha do pix.
   $pix.=crcChecksum($pix); //Calcula o checksum CRC16 e acrescenta ao final.
   $linhas=round(strlen($pix)/120)+1;
   ?>
   
   <? if(file_exists(WWW_MOD."/pixcopia.inc")) {?>
   
	   <p></p>
	   <p></p>
	   <div class="card" style="display:block;">
	   <h3>Linha do Pix (copia e cola):</h3>
	   <div class="row">
		  <div class="col">
		  <textarea class="text-monospace"   id="brcodepix" rows="<?= $linhas; ?>" cols="130" onclick="copiar()"><?= $pix;?></textarea
		  </div>
		  <div class="col md-1">
		  <p><button type="button" id="clip_btn" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Copiar" onclick="copiar()"><i class="fas fa-clipboard"></i>Copiar</button></p>
		  </div>
	   </div>
	   </div>
	   
   <? } ?>
   
   <!-- <h3>Imagem de QRCode do Pix:</h3> -->
   <p>
   <img src="logo_pix.png"><br>
   <?php
   ob_start();
   QRCode::png($pix, null,'M',5);
   $imageString = base64_encode( ob_get_contents() );
   ob_end_clean();
   // Exibe a imagem diretamente no navegador codificada em base64.
   echo '<img src="data:image/png;base64,' . $imageString . '"></p>';
}
?> 

<form id="nform" name="nform"  action="" method="GET"  >
	 <input type="hidden" name="valor" value="100" />  
</form>
											
</body>
</html>

<?
function removerAcentos($texto){
return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$texto);
}

?>