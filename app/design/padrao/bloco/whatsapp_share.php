 <?
 
 if(file_exists(WWW_MOD."/whatsapp-share.inc")) { 
 
	 $actual_link = "$ROOTPATH$_SERVER[REQUEST_URI]";
	 $texto = "Olá, eu achei um site muito legal e quero compartilhar com você, acesse  $actual_link ";
	 ?>
	  
	 Compartilhar no <a target="_blank" href="https://web.whatsapp.com/send?text=<?=$texto?>" data-action="share/whatsapp/share"><img style="width:39px" src="https://cdn.icon-icons.com/icons2/373/PNG/256/Whatsapp_37229.png"></a>
<? } ?>