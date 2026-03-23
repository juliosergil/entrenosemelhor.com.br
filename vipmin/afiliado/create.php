<?php
require_once(dirname(dirname(dirname(__FILE__))) . '/app.php');

need_manager();
// need_comentado need_auth('market');

if ( $_POST ) {

	$_POST['location']="1t";

	$table = new Table('partner', $_POST);
	$table->SetStrip('location', 'other');
	$table->create_time = time();
	$table->user_id = $login_user_id;
	$table->password = ZPartner::GenPassword($table->password);
	$table->group_id = abs(intval($table->group_id));
	$table->city_id = abs(intval($table->city_id));
	$table->tipo = "websiteafiliado";
	$table->open = (strtoupper($table->open)=='Y') ? 'Y' : 'N';
	$table->display = (strtoupper($table->display)=='Y') ? 'Y' : 'N';
	$table->image = upload_image('upload_image', null, 'parceiro', true);
	$table->insert(array(
		'username', 'user_id', 'city_id', 'title', 'group_id',
		'bank_name', 'bank_user', 'bank_no', 'create_time',
		'location', 'other', 'homepage', 'contact', 'mobile', 'phone',
		'password', 'address', 'open', 'display',
		'image', 'image1', 'image2', 'longlat','chavesms',  'bairro', 'cep', 'estado', 'cidade','numero','descricao','tipo','bannerparceiro'
	));
	redirect( WEB_ROOT . '/vipmin/afiliado/index.php');
}

include template('manage_afiliado_create');
