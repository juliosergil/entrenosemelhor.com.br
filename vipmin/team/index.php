<?php
require_once(dirname(dirname(dirname(__FILE__))) . '/app.php');

need_manager();
need_auth('team');

$now = time();
if($_REQUEST['acao']=='site'){
	$condition = array(
		"end_time > {$now}",
	);
}
else{
	$condition = array(
	);
}

/* filter start */
$teamid = strval($_GET['idoferta']);
$team_type = strval($_GET['team_type']);
$team_title = strval($_GET['team_title']);
$group_id = strval($_GET['group_id']);
$city_id = strval($_GET['city_id']);
$user_id = strval($_GET['user_id']);

if ($teamid) { $condition['id'] = $teamid; }
if ($team_type) { $condition['team_type'] = $team_type; }
if ($group_id) { $condition['group_id'] = $group_id; }
if ($city_id) { $condition['city_id'] = $city_id; }
if ($user_id) { $condition['user_id'] = $user_id; }
if ($team_title) { 
	$condition[] = "title LIKE '%".RemoveXSS($team_title)."%'";
 }
 
/* filter end */ 
$count = Table::Count('team', $condition);
list($pagesize, $offset, $pagestring) = pagestring($count, 20);

$teams = DB::LimitQuery('team', array(
	'condition' => $condition,
	'order' => 'ORDER BY id DESC',
	'size' => $pagesize,
	'offset' => $offset,
));
$cities = Table::Fetch('cidades', Utility::GetColumn($teams, 'city_id'));
$groups = Table::Fetch('category', Utility::GetColumn($teams, 'group_id'));
$user = Table::Fetch('user', Utility::GetColumn($teams, 'user_id'));

//$condition_p[] = " tipo = 'parceiro' or tipo is null";
$users = DB::LimitQuery('user', array(
			//'condition' => array( $condition_p ),
			'order' => 'ORDER BY id DESC',
			));
$users = Utility::OptionArray($users, 'id', 'title');
 

$selector = 'index';
include template('manage_team_index');


