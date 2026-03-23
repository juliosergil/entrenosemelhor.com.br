 <?php
 	  
	$limiteofertasemail = 3; 
	$ofertascanceladas  = 1;  
	$ofertadestaque		= 1;   
	/*
	fim das logo.png
	*/
	$origem = "indicacao";
	require_once(dirname(dirname(__FILE__)). '/app.php');
	require_once(dirname(dirname(__FILE__)). '/include/get_ofertas.php');
	$page = Table::Fetch('page', 'about_us');
	  
    $nome 	= $_REQUEST['realname'];
	$conteudomensagemcliente =  utf8_encode($_REQUEST['invitation_content']) ;
	
	$sobre = utf8_decode($page['value']);
	
	$nomesite = htmlentities($INI['system']['sitename'],ENT_COMPAT,'UTF-8');
  
 	?>
	
    Olá, você já conhece o <?=$INI['system']['sitename'] ?>. Pois dê uma olhada no melhor site de compras coletivas de todos os tempos.  Nele existem ofertas de até 90% pra você e toda a sua família. 
	Acesse o endereço <?=$ROOTPATH/convite/$login_user_id ?> e faça o seu cadastro agora mesmo.
	Cadastre no nosso portal e aproveite todas as nossa ofertas. Aproveite para convidar seus amigos e ainda ganhar créditos para cada convite bem sucedido.
	É muito simples ganhar, na primeira compra de um de seus convidados, iremos lhe dar R$ <?=number_format($systeminvitecredit,2,',','')?> como crédito em nosso site para gastar em qualquer oferta. 
	Aproveite, não perca mais tempo, todos estão aderindo essa idéia e só falta você.
	<?=chr(13)?>  
    Boas compras. 
	<?=chr(13)?>
	Equipe <?=utf8_decode($INI['system']['sitename'])?>
	<?=chr(13).$INI['mail']['user'];	
	
	
	?>