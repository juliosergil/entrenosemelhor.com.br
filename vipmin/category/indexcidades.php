<?php
require_once(dirname(dirname(dirname(__FILE__))) . '/app.php');

need_manager();
$condition = array();

if(!(empty($_GET["uf_id"]))) {

	$uf = strip_tags($_GET["uf_id"]);
	$condition[] = " uf = '" . $uf . "'";
}

if(!(empty($_GET["city_id"]))) { 
	
	$city = strip_tags($_GET["city_id"]);
	$condition[] = "nome like '%" . RemoveXSS($city) . "%'";
}

  
$count = Table::Count('cidades', $condition);
list($pagesize, $offset, $pagestring) = pagestring($count, 100);
 
$categories = DB::LimitQuery('cidades', array(
	'condition' => $condition,
	'order' => 'ORDER BY uf, nome',
	'size' => $pagesize,
	'offset' => $offset,
));

$estados = mysqli_query(DB::$mConnection,"select nome, uf from estados");

include template('manage_category_indexcidades');
