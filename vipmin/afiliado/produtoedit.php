<?php
require_once(dirname(dirname(dirname(__FILE__))) . '/app.php');
require_once(dirname(__FILE__) . '/current.php');

need_manager();
need_auth('team');
 
$id = abs(intval($_GET['id']));
$team = $eteam = Table::Fetch('produtos_afiliados', $id);
if(!empty($team)){
	$edicao = true; 
}

if ( is_get() && empty($team) ) {
	$team = array();
	$team['id'] = 0;
	$team['user_id'] = $login_user_id;
	$team['begin_time'] = strtotime('+0 days');
	$team['end_time'] = strtotime('+1 days'); 
	$team['market_price'] = 10;
	$team['team_price'] = 2;
	
 
}
else if ( is_post() ) {
	$team = $_POST;
		$insert = array(
		'id','title', 'market_price', 'team_price', 'end_time',
		'begin_time', 'summary', 'notice',
		'image', 'image1', 'image2', 'now_number',
		'gal_image1', 'gal_image2', 'gal_image3', 'gal_image4', 'gal_image5', 'gal_image6',
		'detail', 'sort_order',
		'user_id', 'city_id', 'group_id', 'partner_id', 'sort_order','posicionamento','url','team_type','pre_number'
		);
		
    $idnovaoferta =	getUltimoIdOferta();

	$team['id'] = $idnovaoferta;
	$team['user_id'] = $login_user_id;
	$team['team_type'] = 'website_afiliado';
	$team['begin_time'] = strtotime($team['begin_time']);
	$team['city_id'] = abs(intval($team['city_id']));
	$team['partner_id'] = abs(intval($team['partner_id']));
	$team['sort_order'] = abs(intval($team['sort_order']));
	$team['end_time'] = strtotime($team['end_time']); 
	$team['image'] = upload_image('upload_image',$eteam['image'],'anunciante',true);
	$team['image1'] = upload_image('upload_image1',$eteam['image1'],'anunciante');
	$team['image2'] = upload_image('upload_image2',$eteam['image2'],'anunciante');

	// galeria de imagens
	$team['gal_image1'] = upload_image('gal_upload_image1',$eteam['gal_image1'],'anunciante');
	$team['gal_image2'] = upload_image('gal_upload_image2',$eteam['gal_image2'],'anunciante');
	$team['gal_image3'] = upload_image('gal_upload_image3',$eteam['gal_image3'],'anunciante');
	$team['gal_image4'] = upload_image('gal_upload_image4',$eteam['gal_image4'],'anunciante');
	$team['gal_image5'] = upload_image('gal_upload_image5',$eteam['gal_image5'],'anunciante');
	$team['gal_image6'] = upload_image('gal_upload_image6',$eteam['gal_image6'],'anunciante');

 

	if ( !$id ) {
		$team['now_number'] = $team['pre_number'];
	} else {
		$field = 'quantity';
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
	$table = new Table('produtos_afiliados', $team);
	$table->SetStrip('summary', 'detail', 'notice');


	if ( $edicao ) {
		$table->SetPk('id', $id);
		$table->update($insert);
		Session::Set('notice', 'Informações modificadas com sucesso!');
		redirect( WEB_ROOT . "/vipmin/afiliado/produto.php");
	}
	/*else if ( $team['id'] ) {
		Session::Set('error', 'Edição ilegal '.$idnovaoferta);
		redirect( WEB_ROOT . "/vipmin/afiliado/produto.php");
	}*/

	else if ( $table->insert($insert) ) {

		Session::Set('notice', 'Novo produto para website afiliado adicionado com sucesso ' );	
		redirect( WEB_ROOT . "/vipmin/afiliado/produto.php");
	}
	else {
		Session::Set('error', 'Falha ao editar oferta: '.$idnovaoferta);
		redirect(null);
	}
}

$groups = DB::LimitQuery('category', array(
			'condition' => array( 'zone' => 'group', ),
			));
$groups = Utility::OptionArray($groups, 'id', 'name');

$partners = DB::LimitQuery('partner', array(
			'condition' => array( 'tipo' => 'websiteafiliado', ),
			'order' => 'ORDER BY id DESC',
	));
			
$partners = Utility::OptionArray($partners, 'id', 'title');
$selector = $team['id'] ? 'edit' : 'create';

include template('manage_afiliado_produtoedit');



