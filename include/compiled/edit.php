<?php
require_once(dirname(dirname(dirname(__FILE__))) . '/app.php');
require_once(dirname(__FILE__) . '/current.php');

need_anunciante();  
  
$id = abs(intval($_GET['id']));
$tipo =  $_REQUEST['team_type'];
 
$login_user_id = $_SESSION['user_id'];

$url = "index.php";
  
$team = $eteam = Table::Fetch('team', $id);
if(!empty($team)){
	$edicao = true; 
}
 
	$anunciante = Table::Fetch('user', $login_user_id);
	
	$count_ofertas = mysqli_fetch_row(mysqli_query(DB::$mConnection,"SELECT COUNT(id) as Contagem FROM `team` WHERE user_id = {$anunciante['id']} AND usou_bonus = 'sim'"));
	$total_ofertas = $count_ofertas[0];
	  
	$pago = 'nao';
	$usoubonus = 'nao';
	
	if ($anunciante['max_anuncios'] > 0) {
		if ($total_ofertas < $anunciante['max_anuncios']) {
			$pago = 'sim';
			$usoubonus = 'sim';
		}
	}
	if ($anunciante['max_anuncios'] == '0') {
		$pago = 'sim';
	}
	if ($anunciante['max_anuncios'] == '-1') {
		$pago = 'nao';
	}
	
	if($INI['option']['moderacaoanuncios']=="N"){
		$status_oferta = '1';
	}
	else  {
		$status_oferta = '0';
	}
	
if ( is_get() && empty($team) ) {
	
	$team = array();
	$team['id'] = "";
	$team['user_id'] = $anunciante['id'];
	$team['begin_time'] = strtotime('+0 days');
	$team['begin_time2'] = date('H:i');
	$team['end_time2'] =   strtotime('+1 months +1 days');
	$team['end_time'] =   strtotime('+1 months +1 days');
	$team['expire_time'] = strtotime('+1 months +1 days');
	$team['min_number'] = 10;
	$team['per_number'] = 1;
	$team['minimo_pessoa'] = 1;
	$team['pre_number'] = 10;
	$team['max_number'] = 1000;
	//$team['market_price'] = 1;
	$team['team_price'] = 1;
	$team['delivery'] = 'coupon';
	$team['address'] = $profile['address'];
	$team['mobile'] = $profile['mobile'];
	$team['fare'] = 5;
	$team['farefree'] = 0;
	$team['bonus'] = abs(intval($INI['system']['invitecredit']));
	$team['conduser'] = $INI['system']['conduser'] ? 'Y' : 'N';
	$team['pago'] = $pago;
	$team['usoubonus'] = $usoubonus;
}
else if ( is_post() ) {
	$team = $_POST;
		 
	$insert = array(
		'title', 'market_price', 'team_price', 'end_time',
		'begin_time', 'expire_time', 'min_number', 'max_number',
		'summary', 'notice', 'per_number', 'product',
		'image', 'image1', 'image2', 'flv', 'now_number',
		'gal_image1', 'gal_image2', 'gal_image3', 'gal_image4', 'gal_image5', 'gal_image6',
		'detail','sort_order','mobile', 'address','maisinformacoes','pre_number',
		'user_id', 'city_id', 'group_id', 'state','posicionamento','layout',
		'mostrarpreco','create_time','mostrarseguranca','status','pago'
		);
  
	$idnovaoferta =	getUltimoIdOferta();
		 
	$team['user_id'] = $login_user_id;
	$team['create_time'] = date('Y-m-d');
 
	$team['state'] = 'none';
	$team['team_price'] =  str_replace("R$ ","",str_replace(",",".",str_replace(".","",$team['team_price'])));
	 
	$team['valorfrete'] =   str_replace("R$ ","",$team['valorfrete']);
	$team['preco_comissao'] =  str_replace("R$ ","",str_replace(",",".",str_replace(".","",$team['preco_comissao'])));
	$team['market_price'] = str_replace("R$ ","",str_replace(",",".",str_replace(".","",$team['market_price']))); 
	$team['begin_time'] = strtotime(str_replace("/","-",$team['begin_time']). " ".$team['begin_time2']);
	$team['end_time'] = strtotime(str_replace("/","-",$team['end_time']). " ".$team['end_time2']);
	$team['expire_time'] = strtotime(str_replace("/","-",$team['expire_time']). " ".$team['end_time2']);
	$team['city_id'] = abs(intval($team['city_id']));
	$team['sort_order'] = abs(intval($team['sort_order']));
	
	$team['status'] = $status_oferta;
		
	$team['pago'] = $pago;
	
	$team['usou_bonus'] = $usoubonus;
	
	$team['fare'] = abs(intval($team['fare']));
	$team['farefree'] = abs(intval($team['farefree']));
	$team['pre_number'] = abs(intval($team['pre_number']));  
	$team['image'] = upload_image('upload_image',$eteam['image'],'team',true, $_POST['marcadagua']);
	$team['image1'] = upload_image('upload_image1',$eteam['image1'],'team',false,$_POST['marcadagua']);
	$team['image2'] = upload_image('upload_image2',$eteam['image2'],'team',false,$_POST['marcadagua']);

	// galeria de imagens
	$team['gal_image1'] = upload_image('gal_upload_image1',$eteam['gal_image1'],'team');
	$team['gal_image2'] = upload_image('gal_upload_image2',$eteam['gal_image2'],'team');
	$team['gal_image3'] = upload_image('gal_upload_image3',$eteam['gal_image3'],'team');
	$team['gal_image4'] = upload_image('gal_upload_image4',$eteam['gal_image4'],'team');
	$team['gal_image5'] = upload_image('gal_upload_image5',$eteam['gal_image5'],'team');
	$team['gal_image6'] = upload_image('gal_upload_image6',$eteam['gal_image6'],'team');
	
	// estaticas 
	$team['estatica_home'] = upload_image('estatica_home',$eteam['estatica_home'],'estatica');
	$team['estatica_direita'] = upload_image('estatica_direita',$eteam['estatica_direita'],'estatica');
	$team['estatica_detalhe'] = upload_image('estatica_detalhe',$eteam['estatica_detalhe'],'estatica');
	$team['estatica_recentes'] = upload_image('estatica_recentes',$eteam['estatica_recentes'],'estatica');

	//team_type == goods
	if($team['team_type'] == 'goods'){
		$team['min_number'] = 1;
		$tean['conduser'] = 'N';
	}

	if ( !$id ) {
		$team['now_number'] = $team['pre_number'];
	} else {
		$field = strtoupper($table->conduser)=='Y' ? null : 'quantity';
		$now_number = Table::Count('order', array(
					'team_id' => $id,
					'state' => 'pay',
					), $field);
		$team['now_number'] = ($now_number + $team['pre_number']);

		/* Increased the total number of state is not sold out */
		if ( $team['max_number'] > $team['now_number'] ) {
			$team['close_time'] = 0;
			$insert[] = 'close_time';
		}
	}

	$insert = array_unique($insert);
	$table = new Table('team', $team);
	


	if ( $edicao ) {
		$table->SetPk('id', $id);
		$table->update($insert);
		//Session::Set('notice', utf8_encode('Informações modificadas com sucesso!'));
		echo "<script>alert('Informações modificadas com sucesso!');</script>";
		redirect( WEB_ROOT . "/adminanunciante/team/".$url);
	}
	else if ( $table->insert($insert) ) {
		$idnovo = mysqli_insert_id(DB::$mConnection);
		if($idnovo){
			Session::Set('notice', utf8_encode('Novo anúncio adicionado ('.$idnovo.')') );	 
			
			if ($status_oferta == 0) {
			$body = 
			"<div> O anúncio ".$idnovo." foi criado. Após a efetivação do pagamento você receberá um email para moderá-lo antes de sua publicação.</div><br>
			
			<b> Dados do Anúncio</b>

			<p>Título: ".$team['title']."</p> 
			<p>Preço: ".$team['team_price']."</p> 
			<p>Descrição: ".$team['summary']."</p>" ;
			} else if ($status_oferta == 1) {
				if($INI['option']['moderacaoanuncios']=="N"){
					$body = 
			"<div> O anúncio ".$idnovo." foi criado. Ele já pode ser visualizado na página de anúncios, e está ativo..</div><br>
			
			<b> Dados do Anúncio</b>

			<p>Título: ".$team['title']."</p> 
			<p>Preço: ".$team['team_price']."</p> 
			<p>Descrição: ".$team['summary']."</p>" ;
				} else {
					$body = 
			"<div> O anúncio ".$idnovo." foi criado. Após a moderação do anúncio ele estará ativo.</div><br>
			
			<b> Dados do Anúncio</b>

			<p>Título: ".$team['title']."</p> 
			<p>Preço: ".$team['team_price']."</p> 
			<p>Descrição: ".$team['summary']."</p>" ;
				}
				
			}
			
			$emailadmin = $INI['mail']['from'];
			
			if(enviar( $emailadmin,utf8_decode($INI["system"]["sitename"]).utf8_encode(" - Anúncio ".$idnovo),utf8_encode($body))) {
				 $enviou =  true;
			}
			else {
				$enviou =  false;
			}
			
			if ($pago == 'nao') {
				if($INI["pagseguro"]["acc"] != ""){
					if ($anunciante['max_anuncios'] > '0') {
						Session::Set('notice', 'Seu limite de ofertas se esgotou, caso queira continuar, por favor, selecione um de nossos planos.');	
						include template('manage_team_pagamentopagseguro');
						exit; 
					}
					if ($anunciante['max_anuncios'] < '0') {
						Session::Set('notice', 'Por favor, selecione um plano para publicar sua oferta.');	
						include template('manage_team_pagamentopagseguro');
					exit;
					}
				}
				else {
					if ($anunciante['max_anuncios'] > '0') {
						Session::Set('notice', 'Seu limite de ofertas se esgotou, caso queira continuar, por favor, selecione um de nossos planos.');	
						include template('manage_team_pagamento');
						exit;
					}
					if ($anunciante['max_anuncios'] < '0') {
					Session::Set('notice', 'Por favor, selecione um plano para publicar sua oferta.');	
					include template('manage_team_pagamento');
					exit;
					}
				}
			 } else {
				if ($status_oferta == '0') {
					Session::Set('notice', 'Nova oferta adicionada e aguardando sua moderação ('.$idnovo.')' );	
					redirect( WEB_ROOT . "/adminanunciante/team/".$url);
				} else {
					Session::Set('notice', 'Nova oferta adicionada e publicada ('.$idnovo.')' );	
					redirect( WEB_ROOT . "/adminanunciante/team/".$url);
				}
			 }
			exit; 
		}
		else {
			Session::Set('error', utf8_encode('Não foi possível cadastrar o novo anúncio'));
			redirect(null);
		}
	}
	else {
		Session::Set('error', utf8_encode('Falha ao atualizar o anúncio'.$idnovaoferta));
		redirect(null);
	}
}

$groups = DB::LimitQuery('category', array(
			'condition' => array( 'zone' => 'group', ),
			));
$groups = Utility::OptionArray($groups, 'id', 'name');

$condition[] = " tipo = 'parceiro' or tipo is null";

$users = DB::LimitQuery('user', array(
			'condition' => array( $condition ),
			'order' => 'ORDER BY id DESC',
			));
$users = Utility::OptionArray($users, 'id', 'title');
$selector = $team['id'] ? 'edit' : 'create';

include template('manage_team_anunciante_edit');