<?php
need_login();
 
if($_REQUEST['status'] == "pendentes"){

	$etime = strtotime('7 days ago');
	
	$condition = array( 
		'user_id' => $login_user_id, 
		'team_id' => 0,
		"create_time > {$etime}",
	);
	//$count = Table::Count('invite', $condition);

	//list($pagesize, $offset, $pagestring) = pagestring($count, 20);

	$invites = DB::LimitQuery('invite', array(
				'condition' => $condition,
				'order' => 'ORDER BY buy_time DESC',
			//	'size' => $pagesize,
				//'offset' => $offset,
				));

	$user_ids = Utility::GetColumn($invites, 'other_user_id');
	$users = Table::Fetch('user', $user_ids);

}
else if($_REQUEST['status'] == "completos"){

	$condition = array( 
		'user_id' => $login_user_id, 
		'pay' => 'Y',
		);
	$count = Table::Count('invite', $condition);
	$money = Table::Count('invite', $condition, 'credit');

	//list($pagesize, $offset, $pagestring) = pagestring($count, 20);

	$invites = DB::LimitQuery('invite', array(
				'condition' => $condition,
				'order' => 'ORDER BY buy_time DESC',
			//	'size' => $pagesize,
			//	'offset' => $offset,
				));

	$user_ids = Utility::GetColumn($invites, 'other_user_id');
	$team_ids = Utility::GetColumn($invites, 'team_id');

	$users = Table::Fetch('user', $user_ids);
	$teams = Table::Fetch('team', $team_ids);

}
else{
	
	$condition = array( 'user_id' => $login_user_id, );
	$count = Table::Count('invite', $condition);

	$money = Table::Count('invite', $condition, 'credit');

	//list($pagesize, $offset, $pagestring) = pagestring($count, 20);

	$invites = DB::LimitQuery('invite', array(
				'condition' => $condition,
				'order' => 'ORDER BY buy_time DESC',
			//	'size' => $pagesize,
				//'offset' => $offset,
				));

	$user_ids = Utility::GetColumn($invites, 'other_user_id');
	$team_ids = Utility::GetColumn($invites, 'team_id');

	$users = Table::Fetch('user', $user_ids);
	$teams = Table::Fetch('team', $team_ids);
}



?>