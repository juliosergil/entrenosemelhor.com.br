<?php
require_once(dirname(dirname(dirname(__FILE__))) . '/app.php');
require_once(dirname(__FILE__) . '/current.php');

need_manager();

$id = abs(intval($_GET['id']));
$tipo =  $_REQUEST['team_type'];


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
		'ehdestaque','create_time','status','pago','anunciogratis',
        'image', 'image1', 'image2','gal_image1', 'gal_image2', 'gal_image3', 'gal_image4', 'gal_image5', 'gal_image6','sort_order',
	
		);
  

	$idnovaoferta =	getUltimoIdOferta();
		
	$team['id'] = $idnovaoferta;
	$team['create_time'] = date('Y-m-d');
 
	$team['team_price'] =  str_replace("R$ ","",str_replace(",",".",str_replace(".","",$team['team_price'])));
	//$team['team_price'] =  str_replace(" €","",str_replace(",",".",str_replace(".","",$team['team_price'])));
	$team['user_id'] = $_POST['user_id'];
	
	$team['sort_order'] = $_POST['sort_order'];

	$team['begin_time'] = strtotime(str_replace("/","-",$team['begin_time']). " ".$team['begin_time2']);
	$team['end_time'] = strtotime(str_replace("/","-",$team['end_time']). " ".$team['end_time2']);
	$team['city_id'] = abs(intval($team['city_id']));
	$team['image'] = upload_image('upload_image',$eteam['image'],'team',true, $_POST['marcadagua']);
	$team['image1'] = upload_image('upload_image1',$eteam['image1'],'team',false,$_POST['marcadagua']);
	$team['image2'] = upload_image('upload_image2',$eteam['image2'],'team',false,$_POST['marcadagua']);

	// galeria de imagens
	$team['gal_image1'] = upload_image('gal_upload_image1',$eteam['gal_image1'],'team');
	$team['gal_image2'] = upload_image('gal_upload_image2',$eteam['gal_image2'],'team');
	$team['gal_image3'] = upload_image('gal_upload_image3',$eteam['gal_image3'],'team');
	$team['gal_image4'] = upload_image('gal_upload_image4',$eteam['gal_image4'],'team');
	$team['gal_image5'] = upload_image('gal_upload_image5',$eteam['gal_image5'],'team');
	$team['gal_image6'] = upload_image('gal_upload_image6',$eteam['gal_image6'],'team');
	
	  
	$insert = array_unique($insert);
	$table = new Table('team', $team);
	


	if ( $edicao ) {
		$table->SetPk('id', $id);
		$table->update($insert);
		Session::Set('notice', 'Informações modificadas com sucesso!');
		redirect( WEB_ROOT . "/vipmin/team/".$url);
	}
	else if ( $table->insert($insert) ) {
		 
		$idnovo = mysqli_insert_id(DB::$mConnection);
		if($idnovo){
			Session::Set('notice', 'Nova oferta adicionada ('.$idnovo.')' );	
			redirect( WEB_ROOT . "/vipmin/team/".$url);
		}
		else{
			Session::Set('error', 'Não foi possível cadastrar a nova oferta');
			redirect(null);
		}
	}
	else {
		Session::Set('error', 'Falha ao atualizar oferta '.$idnovaoferta);
		redirect(null);
	}
}

$groups = DB::LimitQuery('category', array(
			'condition' => array( 'zone' => 'group', ),
			));
$groups = Utility::OptionArray($groups, 'id', 'name');

//$condition[] = " tipo = 'parceiro' or tipo is null";

$users = DB::LimitQuery('user', array( 
			'order' => 'ORDER BY id DESC',
			));
$users = Utility::OptionArray($users, 'id', 'realname');
$selector = $team['id'] ? 'edit' : 'create';
include template('manage_team_edit');




