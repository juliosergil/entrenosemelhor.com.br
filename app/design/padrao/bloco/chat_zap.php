<?
if(file_exists(WWW_MOD."/chat_zap.inc")) { 

	function tratafonezap($fone){
		
		$fone = str_replace(" ","", $fone ); 
		$fone = str_replace("-","", $fone );
		
		$fone = str_replace('\)','', $fone );  
		$fone = str_replace('\(','', $fone );   
		return $fone ;
	}

	$celzap = $INI['mail']['helpphone'];
	$celzap = tratafonezap($celzap);
	?>

	<style>
	.whatsapp_fixo {
		display: none;
		width: 216px;
		height: 75px;
		padding: 15px 0 0 50px;
		position: fixed;
		z-index: 9;
		 right: 50%; 
		bottom: 0;
		font-family: 'Roboto',sans-serif;
		font-size: 22px;
		color: #FFF;
		text-align: center;
		line-height: 22px;
		border-radius: 15px 15px 0 0;
		background-color: #6baa46;
		background-image: url(https://www.vipcomsistemas.com.br/wp-content/themes/agencies/images/bg_whatsapp_fixo.png);
		background-repeat: no-repeat;
		background-position: 18px center;
		cursor: pointer;
	}
	.whatsapp_fixo span.maior {
		font-size: 16px;
		font-weight: 700;
	}

	.notelzap{
		    background: #fff;
			position: fixed;
			height: 94px;
			width: 600px;
			bottom: 25px;
			right: 8%;
			z-index: 100;
			padding: 12px;
	
	}
	</style>

	<? if($INI['mail']['helpphone']){?>

		<div style=" position:fixed; bottom: 25px; right: 8%; z-index:100;"> <a target="_blank" href="https://api.whatsapp.com/send?l=pt&phone=55<?=$celzap?>&text=Ol%C3%A1, estou navegando no site <?php echo $INI['system']['sitename']; ?>. Você pode me ajudar ?"><img src="https://www.vipcomsistemas.com.br/images/whatsapp.png" ></a> </div>

	<? }else{ ?>
		 <div class="notelzap" data-selector="img"> Para o ícone do whatsapp aparecer, acesse a admininstração do site e vá em Sistema->Configurar Email <BR> e altere o campo telefone no formato 11998776611</div> 
	<? }?>

<? } ?>