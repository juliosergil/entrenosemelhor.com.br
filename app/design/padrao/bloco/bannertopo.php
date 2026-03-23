<?		
if( $INI['slideshowbanners']['ativo'] == "N" or $INI['slideshowbanners']['ativo'] == "" ){ 
	
if($_REQUEST["idoferta"]){
	 
		if($INI['bulletin']['topotodos']){
			$banner = trim($INI['bulletin']['topotodos']);
		}
	
}
else if($_REQUEST['idcategoria'] != "" or $idcategoria !=""){
	if($idcategoria!=""){
			$idcatbusca=$idcategoria;
	}
	else{
			$idcatbusca=$_REQUEST['idcategoria'];
	}
	$categoria = $Categoria->getCategoria($idcatbusca) ;
	$banner =  $categoria['bannercategoria'];
}
if($banner ==""){
	$banner = trim($INI['bulletin']['topotodos']);
}

$marginbotton="7px";
if($ehome){ 
	$marginbotton="24px";
}	
?>
<? 
 
if($banner!=""){?>
	<div style="display:none;" class="tips"><?=__FILE__?></div>
	 
	<div class="bannerofertas" style="margin-bottom:22px;width:952px;margin-left:17px;overflow:hidden;clear:both;padding-top:12px;">
		<?=$banner?>  
	</div>
<? } 
else{?>
	<div  style="margin-bottom:0; clear:both;padding-top:29px;"></div>
<? } }
 
 
 else {
 	if(bannerExists()){
 	?>
	<div class="bannerofertas">
		<div class="border_box">
			<div class="box_skitter">
				<ul> 
				<?=getbannerslideshow()?>
				</ul>
			</div>
		</div>		
	</div>
 <? }} ?>