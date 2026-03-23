<? 

$anuncio = $ROOTPATH."/".$_SERVER[REQUEST_URI];
 
if(file_exists(WWW_MOD."/whatsapp.inc") and !empty($telefonezap)) { 

	if(!function_exists("geraurlzap")){
		function geraurlzap($fone,$title,$nomeanunciante ){
			global $INI;
			$fone = tratafone($fone);
			?>
			https://api.whatsapp.com/send?l=pt&phone=55<?=$fone?>&text=<?="Olá ".$nomeanunciante.", achei o anúncio $title no site [ ".$INI["system"]["sitename"]." ] e gostaria de saber mais detalhes.";?>

		<? } 
	}

	if(!function_exists("tratafone")){
		function tratafone($fone){
			
			$fone = str_replace(" ","", $fone ); 
			$fone = str_replace("-","", $fone );
			
			$fone = str_replace('\)','', $fone );  
			$fone = str_replace('\(','', $fone );   
			return $fone ;
		}
	}


	?>

	<? if($telefonezap){?>

		 <strong class="fontzap">Converse com o vendedor: </strong><span class="fontnum">  </span>
		 <a target="_blank" href="<?=trim(geraurlzap($telefonezap,$anuncio,$nomeanunciante));?>">
			<img src="https://www.vipcomsistemas.com.br/images/whatsapp.png" style="height: 30px"> 
		 </a> 

	<? } ?>

	<style>
	.fontzap{
		color: green;
		font-size: 15px;	
	}
	.fontnum{
		font-weight: 900;
	}
	</style>

<? } ?>
 

