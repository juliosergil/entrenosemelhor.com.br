<?php
require_once(dirname(dirname(dirname(__FILE__))) . '/app.php');

need_manager();
need_auth('enquete_show');

$now = time();
$condition = array(
	
);

/* filter start */
$team_type = strval($_GET['team_type']);
if ($team_type) { $condition['team_type'] = $team_type; }
/* filter end */

$count = Table::Count('enquete_oferta', $condition);
list($pagesize, $offset, $pagestring) = pagestring($count, 20);

$teams = DB::LimitQuery('enquete_oferta', array(
	'condition' => $condition,
	'order' => 'where status="1" ORDER BY id_enquete_oferta DESC',
	'size' => $pagesize,
	'offset' => $offset,
));
//$cities = Table::Fetch('category', Utility::GetColumn($teams, 'city_id'));
//$groups = Table::Fetch('category', Utility::GetColumn($teams, 'group_id'));

$selector = 'editseo';
include template('manage_enquete_index');


