<?php
require_once(dirname(dirname(dirname(__FILE__))) . '/app.php');

need_manager();
$condition = array();
 

  
$count = Table::Count('estados', $condition);
list($pagesize, $offset, $pagestring) = pagestring($count, 100);
 
$categories = DB::LimitQuery('estados', array(
	'condition' => $condition,
	'order' => 'ORDER BY nome',
	'size' => $pagesize,
	'offset' => $offset,
));
 

include template('manage_category_indexestados');
