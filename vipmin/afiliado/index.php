<?php
require_once(dirname(dirname(dirname(__FILE__))) . '/app.php');

need_manager();
// need_comentado need_auth('market');

$condition = array();

/* filter */
$ptitle = strval($_GET['ptitle']);
if ($ptitle ) {
	$condition[] = "title LIKE '%".RemoveXSS($ptitle)."%'";
}
$condition['tipo'] = "websiteafiliado";
/* filter end */

$count = Table::Count('partner', $condition);
list($pagesize, $offset, $pagestring) = pagestring($count, 20);

$partners = DB::LimitQuery('partner', array(
	'condition' => $condition,
	'order' => 'ORDER BY head DESC, id DESC',
	'size' => $pagesize,
	'offset' => $offset,
));
$groups = option_category('partner');
$cities = option_category('city');


include template('manage_afiliado_index');
