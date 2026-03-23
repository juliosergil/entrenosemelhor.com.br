<?

$others_side_ns = abs(intval($INI['system']['sideteam']));
$others_team_id = abs(intval($team['id']));
$others_city_id = abs(intval($city['id']));
$others_now = time();
 
$oc = array(
	'city_id' => array($others_city_id, 0),
	'team_type' => 'especial',
	"begin_time < '$others_now'",
//	"end_time > '$others_now'",
	);
$others = DB::LimitQuery('team', array(
	'condition' => $oc, 
	'order' => 'ORDER BY `end_time` DESC , `now_number`' ,
	));
 

?>
