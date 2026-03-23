<?php
require_once(dirname(dirname(dirname(__FILE__))) . '/app.php');
require_once(dirname(__FILE__) . '/current.php');

need_anunciante(); 
 
 

$id = abs(intval($_GET['id']));
$tipo =  $_REQUEST['team_type'];

$url = "index.php";

$team = $eteam = Table::Fetch('team', $id);
if(!empty($team)){
	$edicao = true; 
}
	$login_user_id = $_SESSION['user_id'];
	$anunciante = Table::Fetch('user', $login_user_id);
	
	$count_ofertas = mysqli_fetch_row(mysqli_query(DB::$mConnection,"SELECT COUNT(id) as Contagem FROM `team` WHERE user_id = {$anunciante['id']} AND usou_bonus = 'sim'"));
	$total_ofertas = $count_ofertas[0];
	$pago = 'nao';
	$usoubonus = 'nao';
	
	if ($total_ofertas == '0' || $total_ofertas == null || $total_ofertas == '') {
		$total_ofertas = '0';
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
	$team['end_time'] =   strtotime('+1 months +1 days');
	$team['team_price'] = 1;
	$team['address'] = $profile['address'];
	$team['mobile'] = $profile['mobile'];
	$team['pago'] = $pago;
}
else if ( is_post() ) {
	$team = $_POST;
		 
	$insert = array(
		'title', 'team_price', 'end_time',
		'begin_time', 'summary', 'image', 'image1', 'image2', 
		'gal_image1', 'gal_image2', 'gal_image3', 'gal_image4', 'gal_image5', 
		'detail','sort_order', 'mobile', 'address', 'mostrarpreco',
		'user_id', 'city_id', 'uf', 'group_id', 'sort_order','create_time','status','pago', 
		);
  
	$idnovaoferta =	getUltimoIdOferta();
		 
	$team['user_id'] = $login_user_id;
	$team['create_time'] = date('Y-m-d');
 

	$team['team_price'] =  str_replace("R$ ","",str_replace(",",".",str_replace(".","",$team['team_price'])));
	
	$dataaux = explode("/",$team['end_time']);
	$dafafim = $dataaux['2']."-".$dataaux['1']."-".$dataaux['0'];
	  

	$team['begin_time'] = strtotime(str_replace("/","-",$team['begin_time']). " ".$team['begin_time2']);
	$team['end_time'] = strtotime($dafafim);
	$team['city_id'] = abs(intval($team['city_id']));
	$team['sort_order'] = abs(intval($team['sort_order']));
	 
	
	$team['status'] = $status_oferta;
		
	$team['pago'] = $pago;
	
	$team['image'] = upload_image('upload_image',$eteam['image'],'team',true, $_POST['marcadagua']);
	$team['image1'] = upload_image('upload_image1',$eteam['image1'],'team',false,$_POST['marcadagua']);
	$team['image2'] = upload_image('upload_image2',$eteam['image2'],'team',false,$_POST['marcadagua']);

	// galeria de imagens
	$team['gal_image1'] = upload_image('gal_upload_image1',$eteam['gal_image1'],'team');
	$team['gal_image2'] = upload_image('gal_upload_image2',$eteam['gal_image2'],'team');
	$team['gal_image3'] = upload_image('gal_upload_image3',$eteam['gal_image3'],'team');
	$team['gal_image4'] = upload_image('gal_upload_image4',$eteam['gal_image4'],'team');
	$team['gal_image5'] = upload_image('gal_upload_image5',$eteam['gal_image5'],'team'); 
	 
	//$team['summary'] = html_entity_decode($team['summary']);
	//$team['summary'] = htmlentities($team['summary']);

	//team_type == goods
	if($team['team_type'] == 'goods'){
		$team['min_number'] = 1;
		$tean['conduser'] = 'N';
	}


	$insert = array_unique($insert);
	$table = new Table('team', $team);

	if ( $edicao ) {
		
		$table->SetPk('id', $id);
		$table->update($insert);
		//Session::Set('notice', utf8_encode('Informações modificadas com sucesso!'));
		$_SESSION['modal'] = array('type' => 'success', 'msg' => "Informações modificadas com sucesso!");
		redirect( WEB_ROOT . "/adminanunciante/team/".$url);
	}
	else if ( $table->insert($insert) ) {
		$idnovo = mysqli_insert_id(DB::$mConnection);
		if($idnovo){
			$_SESSION['modal'] = array('type' => 'success', 'msg' => "Cadastro realizado com sucesso - id (".$idnovo.")");
			
			$cabecalhoheader="<html><head>
</head><body style='font-size:12px;'><meta http-equiv='Content-Type' content='text/html; charset=utf8' /><meta http-equiv='Content-Language' content='pt-br' />";
			$fimcabecalho="</body></html>";
			
			if ($status_oferta == 0) {
			$body = 
			$cabecalhoheader."<div> O anúncio ".$idnovo." foi criado. Após a efetivação do pagamento você receberá um email para moderá-lo antes de sua publicação.</div><br>
			
			<b> Dados do Anúncio</b>

			<p>Título: ".utf8_decode($team['title'])."</p> 
			<p>Preço: ".$team['team_price']."</p> 
			<p>Descrição: ".utf8_decode($team['summary'])."</p>".$fimcabecalho ;
			
			} else if ($status_oferta == 1) {
			
				if($INI['option']['moderacaoanuncios']=="N"){
					
					$body = 
					$cabecalhoheader."<div> O anúncio ".$idnovo." foi criado. Ele já pode ser visualizado na página de anúncios, e está ativo..</div><br>
					
					<b> Dados do Anúncio</b>

					<p>Título: ".utf8_decode($team['title'])."</p> 
					<p>Preço: ".$team['team_price']."</p> 
					<p>Descrição: ".utf8_decode($team['summary'])."</p>".$fimcabecalho ;
			 } 
				else {
					$body = 
					$cabecalhoheader."<div> O anúncio ".$idnovo." foi criado. Após a moderação do anúncio ele estará ativo.</div><br>
					
					<b> Dados do Anúncio</b>

					<p>Título: ".utf8_decode($team['title'])."</p> 
					<p>Preço: ".$team['team_price']."</p> 
					<p>Descrição: ".utf8_decode($team['summary'])."</p>".$fimcabecalho ;
				}
				
			}
			
			$emailadmin = $INI['mail']['from'];
			
			if(enviar( $emailadmin,utf8_decode($INI["system"]["sitename"]). utf8_encode(" - Anúncio ") .$idnovo , utf8_encode($body) )) {
				 $enviou =  true;
			}
			else {
				$enviou =  false;
			}
			
			if ($pago == 'nao') {
				if($INI["pagseguro"]["acc"] != ""){
					if ($anunciante['max_anuncios'] > '0') {
						$_SESSION['modal'] = 	array('type' => 'warning', 'msg' => 'Seu limite de ofertas se esgotou, caso queira continuar, por favor, selecione um de nossos planos.');
						include template('manage_team_pagamentopagseguro');
						exit; 
					}
					if ($anunciante['max_anuncios'] < '0') {
						$_SESSION['modal'] = 	array('type' => 'warning', 'msg' => 'Por favor, selecione um plano para publicar sua oferta.');
						include template('manage_team_pagamentopagseguro');
					exit;
					}
				}
				else {
					 echo "Você ainda não configurou a sua conta do pagseguro. Por favor acesse Sistema->Métodos de Pagamento";
					 exit;
				}
			 } else {
				if ($status_oferta == '0') {
					$_SESSION['modal'] = 	array('type' => 'warning', 'msg' => 'Nova oferta adicionada e aguardando modera&ccedil;&atilde;o do administrador ('.$idnovo.')');
					 redirect( WEB_ROOT . "/adminanunciante/team/".$url);
				} else {
					$_SESSION['modal'] = 	array('type' => 'success', 'msg' => 'Nova oferta adicionada e publicada ('.$idnovo.')');	
					redirect( WEB_ROOT . "/adminanunciante/team/".$url);
				}
			 }
			exit; 
		}
		else {
			$_SESSION['modal'] =  array('type' => 'danger', 'msg' => 'Não foi possível cadastrar o novo anúncio');
			 redirect(null);
		}
	}
	else {
		$_SESSION['modal'] = 	array('type' => 'danger', 'msg' => 'Falha ao atualizar o anúncio'.$idnovaoferta);
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
$users = Utility::OptionArray($users, 'id', 'name');
$selector = $team['id'] ? 'edit' : 'create';

include template('manage_team_anunciante_edit');