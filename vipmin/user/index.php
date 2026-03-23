<?php
require_once(dirname(dirname(dirname(__FILE__))) . '/app.php');

need_manager();
need_auth('admin');

$email = strval($_GET['email']);

$uname = strval($_GET['uname']);
$mobile = strval($_GET['mobile']);
$cpf = abs(intval($_GET['cpf']));
$ucity = abs(intval($_GET['ucity']));
$cs = strval($_GET['cs']);
$address = strval($_GET['address']);
$bairro = strval($_GET['bairro']);
$cidadeusuario = strval($_GET['cidadeusuario']);
$saldo =  $_GET['saldo']  ;  
  
$condition = array();

 
/* filter */
$id =  $_GET['id']  ; if ($id) $condition['id'] = $id;

$realname = strval($_GET['realname']);
 
$estado =  $_GET['estado']  ; if ($estado) $condition['estado'] = $estado;
$money =  $_GET['money']  ; if ($money) $condition['money'] = $money;

if ($saldo=="true") {
	$condition[] = "money > 0";
}
if ($mobile) { 
	$condition[] = "mobile like '%".RemoveXSS($mobile)."%'";
}
if ($local) { 
	$local[] = "local like '%".RemoveXSS($local)."%'";
}
if ($cidadeusuario) { 
	$condition[] = "cidadeusuario like '%".RemoveXSS($cidadeusuario)."%'";
}
if ($bairro) { 
	$condition[] = "bairro like '%".RemoveXSS($bairro)."%'";
}
if ($address) { 
	$condition[] = "address like '%".RemoveXSS($address)."%'";
}
if ($cpf) { 
	$condition[] = "cpf like '%".RemoveXSS($cpf)."%'";
}
if ($email) { 
	$condition[] = "email like '%".RemoveXSS($email)."%'";
}
if ($realname) { 
	$condition[] = "realname like '%".RemoveXSS($realname)."%'";
}
  
if (abs(intval($ucity))) {
	$condition['city_id'] = abs(intval($ucity));
}
/* end */ 
$count = Table::Count('user', $condition);
list($pagesize, $offset, $pagestring) = pagestring($count, 20);

$users = DB::LimitQuery('user', array(
	'condition' => $condition,
	'order' => 'ORDER BY id DESC',
	'size' => $pagesize,
	'offset' => $offset,
));

include template('manage_user_index');
