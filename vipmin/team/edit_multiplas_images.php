<?php
require_once(dirname(dirname(dirname(__FILE__))) . '/app.php');
require_once(dirname(__FILE__) . '/current.php');

need_manager();

$id = abs(intval($_GET['id']));

if(!$id){
	$id = $_POST['id'];
}

$url = "index.php";


$team = $eteam = Table::Fetch('team', $id);
if(!empty($team)){
	$edicao = true; 
	
	if($team['pago'] =="nao" and $team['anunciogratis'] !="s"  ){

		$idplano 				=   $team['id_plano'];
		if(!empty($idplano)){
			$dias 					=  getdiasplano($idplano);
			$team['begin_time']  	=  strtotime('+0 days');
			$team['end_time']		=  strtotime('+'.$dias.' days'); 
			Util::log(" DIAS: ".$dias );
			Util::log(" end_time: ".$team['end_time'] );
			
		}
	}
} 


if ( is_get() && empty($team) ) {
	$team = array();
	$team['id'] = "";
	$team['begin_time'] = strtotime('+0 days');
	$team['begin_time2'] = date('H:i');
	$team['end_time2'] = date('H:i');
	$team['end_time'] = strtotime('+1 days'); 
	$team['team_price'] = 1;
	$team['address'] = $profile['address'];
	$team['mobile'] = $profile['mobile'];
	
}
else if ( is_post() ) {
	$team = $_POST;
 
 	if($team['pago'] =="anunciogratis"){
			$team['pago']="";
			$team['anunciogratis'] ="s";
	}
	else if($team['pago'] ==""){
			$team['pago']="";
			$team['anunciogratis'] ="";
	}
	else if($team['pago'] =="s"){
			$team['pago']="s";
			$team['anunciogratis'] ="";
	}
	
	$insert = array(
		'title', 'team_price', 'end_time','begin_time','summary', 
		'mobile', 'address','user_id', 'city_id', 'uf', 'group_id', 'mostrarpreco',
		'ehdestaque','create_time','status','pago','anunciogratis'
		);
  

	$idnovaoferta =	getUltimoIdOferta();
		
	$team['id'] = $idnovaoferta;
	$team['create_time'] = date('Y-m-d');
 
	$team['team_price'] =  str_replace("R$ ","",str_replace(",",".",str_replace(".","",$team['team_price'])));
	$team['user_id'] = $_POST['user_id'];

	$team['begin_time'] = strtotime(str_replace("/","-",$team['begin_time']). " ".$team['begin_time2']);
	$team['end_time'] = strtotime(str_replace("/","-",$team['end_time']). " ".$team['end_time2']);
	$team['city_id'] = abs(intval($team['city_id']));
	


	$insert = array_unique($insert);
	$table = new Table('team', $team);

	if ( $edicao ) {
		$table->SetPk('id', $id);
		$table->update($insert);
		$data = json_encode(['status' => 1, 'id' => $id]);
		echo $data;
		exit;
		//Session::Set('notice', 'Informações modificadas com sucesso!');
		//redirect( WEB_ROOT . "/vipmin/team/".$url);
	}
	else if ( $table->insert($insert) ) {
		 
		$idnovo = mysqli_insert_id(DB::$mConnection);
		if($idnovo){
			$data = json_encode(['status' => 1, 'id' => $idnovo]);
			echo $data;
			exit;
			//Session::Set('notice', 'Nova oferta adicionada ('.$idnovo.')' );	
			//redirect( WEB_ROOT . "/vipmin/team/".$url);
		}
		else{
			$msg = "Não foi possível cadastrar o novo anúncio";
			$data = json_encode(['status' => 0, 'id' => $idnovo, 'msg' => $msg]);
			echo $data;
			exit;
			//Session::Set('error', 'Não foi possível cadastrar a nova oferta');
			//redirect(null);
		}
	}
	else {
		//Session::Set('error', 'Falha ao atualizar oferta '.$idnovaoferta);
		//redirect(null);
		$msg = "Não foi possível cadastrar o novo anúncio";
		$data = json_encode(['status' => 0, 'id' => $idnovo, 'msg' => $msg]);
		echo $data;
		exit;
	}
}

$groups = DB::LimitQuery('category', array(
			'condition' => array( 'zone' => 'group', ),
			));
$groups = Utility::OptionArray($groups, 'id', 'name');


$users = DB::LimitQuery('user', array( 
			'order' => 'ORDER BY id DESC',
			));
$users = Utility::OptionArray($users, 'id', 'realname');
$selector = $team['id'] ? 'edit' : 'create';
include template('manage_team_edit');



