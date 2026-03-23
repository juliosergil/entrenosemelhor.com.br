<?php
$destino="produto";
if($team['team_type'] == "website_afiliado"){
	$destino =   "websiteafiliado" ;
}
if($team['title'] != ""){
	$titletag =  "Comprando essa oferta, você tem ".$discount_rate."% de desconto, e economiza R$ ".number_format($discount_price, 2, ',', '.').". Aproveite pois faltam ".$intfalta." para esgotar." ;
}
else{
	$titletag =  utf8_decode($INI['system']['sitetitle']). " -  O Seu Portal de Compras Coletivas";
}
$titletag=" ";
$num = rand(0, 7);
$destaque = "botslide";

if($team['manterdimensao']=="1"){
// as imagens irão ficar com as dimensoes originais
	$imagem1 	= $team['image'];
	$imagem2 	= $team['image1'];
	$imagem3 	= $team['image2'];
	$galimagem1 = $team['gal_image1'];
	$galimagem2 = $team['gal_image2'];
	$galimagem3 = $team['gal_image3'];
	$galimagem4 = $team['gal_image4'];
	$galimagem5 = $team['gal_image5'];
	$galimagem6 = $team['gal_image6'];

}
else {
//  iremos tratar as imagens para ficar de acordo com o layout
	$imagem1 	= substr($team['image'],0,-4)."_".$destaque.".jpg";
	$imagem2 	= substr($team['image1'],0,-4)."_".$destaque.".jpg";
	$imagem3 	= substr($team['image2'],0,-4)."_".$destaque.".jpg";
	$galimagem1 = substr($team['gal_image1'],0,-4)."_".$destaque.".jpg";
	$galimagem2 = substr($team['gal_image2'],0,-4)."_".$destaque.".jpg";
	$galimagem3 = substr($team['gal_image3'],0,-4)."_".$destaque.".jpg";
	$galimagem4 = substr($team['gal_image4'],0,-4)."_".$destaque.".jpg";
	$galimagem5 = substr($team['gal_image5'],0,-4)."_".$destaque.".jpg";
	$galimagem6 = substr($team['gal_image6'],0,-4)."_".$destaque.".jpg";
}
 
$marginl = "-13px;";
if($oferta_ativa and !$ofertafechada and !$oferta_esgotada){
		$marginl = "-48px;";
}
else{
	$txb = "Faltam $qtdeparaativar para ativar a oferta";
}



?>