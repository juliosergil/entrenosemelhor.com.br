

<div style="padding-left: 0%;clear:both;background: #262424;height: 56px;padding-right: 9%;">
  <? if($INI['option']['auth_setup']!="N"){?> | 
	<!-- <span style="color:#fff;float: right;margin-top: 21px;font-size: 12px;">criado por <a style="color:#f5c046;" target="_blank" href="https://www.vipcomsistemas.com.br">Vipcom Sistemas</a> </span> -->
 <? }  
 
	$url = $ROOTPATH."/index.php?page=urls";

	if($origem){
		$url="https://www.vipcomsistemas.com.br";
	}
 
	?>
	<a target="_blank" href="<?=$url?>">
		<?  if( !file_exists(getcwd()."/include/mod/rodape.inc")) { ?>
			<img style='float: right;' src="/skin/padrao/logofooter.png">
		<? } else {?>
			<img style='float: right;display:none;' src="/skin/padrao/logofooter.png">
		<? } ?>
	</a>
</div>

 