<?php
require_once(dirname(dirname(dirname(__FILE__))) . '/app.php');


need_anunciante(); 
 
$now = time();
if($_REQUEST['acao']=='site'){
	$condition = array( 
		"end_time > {$now}",
		'user_id' => $_SESSION['user_id'], 
		"status is null or status = 1",
	);
}
else{
	$condition = array(
		 'user_id' => $_SESSION['user_id'], 
	);
}
 
/* filter start */
$team_type = strval($_GET['team_type']);
$team_title = strval(RemoveXSS($_GET['team_title']));
$city_id = strval($_GET['city_id']); 

if ($team_type) { $condition['team_type'] = $team_type; }
if ($city_id) { $condition['city_id'] = $city_id; }
if ($user_id) { $condition['user_id'] = $user_id; }
if ($team_title) { 
	$condition[] = "title LIKE '%".RemoveXSS($team_title)."%'";
 }
 
if($_GET['idoferta']) {
	$idoferta = (int) strip_tags($_GET['idoferta']);
	
	unset($condition);
	$condition[] = "id = " . $idoferta;
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
 
$users = DB::LimitQuery('user', array( 
			'order' => 'ORDER BY id DESC',
			));
$users = Utility::OptionArray($users, 'id', 'title');
 

$selector = 'index';

include template('manage_team_anunciante_index');


