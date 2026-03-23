<?php
require_once(dirname(dirname(dirname(__FILE__))) . '/app.php');

need_manager();
need_auth('team');

$condition = array(
	'idoferta' => $_REQUEST['idoferta'], 
);

/* filter start */
$team_type = strval($_GET['team_type']);
/* filter end */

$count = Table::Count('produtos_afiliados_enviados', $condition);
list($pagesize, $offset, $pagestring) = pagestring($count, 20);

$teams = DB::LimitQuery('produtos_afiliados_enviados', array(
	'condition' => $condition,
	'order' => 'ORDER BY data DESC',
	'size' => $pagesize,
	'offset' => $offset,
));

$team = Table::Fetch('produtos_afiliados',$_REQUEST['idoferta']); 
 

$selector = 'index';
include template('manage_afiliado_produtoclicado');


