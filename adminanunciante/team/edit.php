<?php
require_once(dirname(dirname(dirname(__FILE__))) . '/app.php');
require_once(dirname(__FILE__) . '/current.php');

need_anunciante(); 
 

$id = abs(intval($_GET['id']));

if(!$id){
	$id = $_POST['id'];
}

$url = "index.php";

$team = $eteam = Table::Fetch('team', $id);
if(!empty($team)){
	$edicao = true; 
}
	$login_user_id = $_SESSION['user_id'];
	$anunciante = Table::Fetch('user', $login_user_id);
 
	$pago = 'nao';
  
	if($INI['option']['moderacaoanuncios']=="N"){
		$status_oferta = '1';
	}
	else  {
		$status_oferta = '0';
	}
	
if ( is_get() && empty($team) ) {
	
	$team = array();
	$team['id'] = "";
	$team['user_id'] = $anunciante['id'];
	$team['begin_time'] = strtotime('+0 days');
	$team['end_time'] =   strtotime('+1 months +1 days');
	$team['team_price'] = 1;
	$team['address'] = $profile['address'];
	$team['mobile'] = $profile['mobile'];
	$team['pago'] = $pago;
}
else if ( is_post() ) {
	$team = $_POST;
//	unset($team['teamImage']);
		 
	$insert = array(
		'title', 'team_price', 'end_time','begin_time', 'summary', 
		 'mobile', 'address', 'mostrarpreco','user_id', 'city_id', 'uf', 'group_id', 'create_time','status','pago', 
		  'image', 'image1', 'image2','gal_image1', 'gal_image2', 'gal_image3', 'gal_image4', 'gal_image5', 'gal_image6',
		);
  
	$idnovaoferta =	getUltimoIdOferta();
		 
	$team['user_id'] = $login_user_id;
	$team['create_time'] = date('Y-m-d'); 
	$team['team_price'] =  str_replace("R$ ","",str_replace(",",".",str_replace(".","",$team['team_price'])));
	//$team['team_price'] =  str_replace(" €","",str_replace(",",".",str_replace(".","",$team['team_price'])));
	
	$dataaux = explode("/",$team['end_time']);
	$dafafim = $dataaux['2']."-".$dataaux['1']."-".$dataaux['0'];
	   
	$team['begin_time'] = strtotime(str_replace("/","-",$team['begin_time']). " ".$team['begin_time2']);
	$team['end_time'] = strtotime($dafafim);
	$team['city_id'] = abs(intval($team['city_id'])); 
	$team['status'] = $status_oferta; 
	$team['pago'] = $pago;
	
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
		redirect( WEB_ROOT . "/adminanunciante/team/".$url);
		$id_anuncio = $id;
		
	}
	else if ( $table->insert($insert) ) {
		$id_anuncio = mysqli_insert_id(DB::$mConnection); 
		$idnovo = $id_anuncio;
	}
	else { 
		 Session::Set('notice', '004 - Não foi possível cadastrar o novo anúncio.');
		 redirect( WEB_ROOT . "/adminanunciante/team/".$url);  
    }
	  
	$cabecalho = "<html><head>
</head><body style='font-size:12px;'><meta http-equiv='Content-Type' content='text/html; charset=utf8' /><meta http-equiv='Content-Language' content='pt-br' />";
	$fimcabecalho="</body></html>";
	
	if ($status_oferta == 0) {
	 
		 if ( $edicao ) {
			$cabecalhoheader."<div> O anúncio ".$id_anuncio." foi modificado.</div><br>";
		 }else{
			 $cabecalhoheader."<div> O anúncio ".$id_anuncio." foi criado. Após a efetivação do pagamento você receberá um email para moderá-lo antes de sua publicação.</div><br>";
		 }
		$body = "<b> Dados do Anúncio</b>

		<p>Título: ".utf8_decode($team['title'])."</p> 
		<p>Preço: ".$team['team_price']."</p> 
		<p>Descrição: ".utf8_decode($team['summary'])."</p>".$fimcabecalho ;
	
	} else if ($status_oferta == 1) {
	
		if($INI['option']['moderacaoanuncios']=="N"){
			  
			 if ( $edicao ) {
				$cabecalhoheader."<div> O anúncio ".$id_anuncio." foi modificado. Ele já pode ser visualizado na página de anúncios, e está ativo..</div><br>";
			 }else{
				$cabecalhoheader."<div> O anúncio ".$id_anuncio." foi criado. Ele já pode ser visualizado na página de anúncios, e está ativo..</div><br>";
			 }
		   
			$body = " <b> Dados do Anúncio</b>

			<p>Título: ".utf8_decode($team['title'])."</p> 
			<p>Preço: ".$team['team_price']."</p> 
			<p>Descrição: ".utf8_decode($team['summary'])."</p>".$fimcabecalho ;
	 } 
	 else { 
	 
			if ( $edicao ) {
				$cabecalhoheader."<div> O anúncio ".$id_anuncio." foi modificado. Após a moderação do anúncio ele estará ativo.</div><br>";
			 }else{
				$cabecalhoheader."<div> O anúncio ".$id_anuncio." foi criado. Após a moderação do anúncio ele estará ativo.</div><br>";
			 }
			  
			$body =  "<b> Dados do Anúncio</b>

			<p>Título: ".utf8_decode($team['title'])."</p> 
			<p>Preço: ".$team['team_price']."</p> 
			<p>Descrição: ".utf8_decode($team['summary'])."</p>".$fimcabecalho ;
		} 
	}
	
	$emailadmin = $INI['mail']['from']; 
	$mensagem  = $cabecalho . $cabecalhoheader. $body ;
	
	if(enviar( $emailadmin,utf8_decode($INI["system"]["sitename"]). utf8_encode(" - Anúncio ") .$id_anuncio , utf8_encode($mensagem) )) {
		 $enviou =  true;
	}
	else {
		$enviou =  false;
	}  
 
 	
	if ($pago == 'nao') {
				  
		require("pay.php");  
				 
	} else {
				 
		if ($status_oferta == '0') {
			$_SESSION['modal'] = 	array('type' => 'warning', 'msg' => 'Nova oferta adicionada e aguardando modera&ccedil;&atilde;o do administrador ('.$id_anuncio.')');
			 redirect( WEB_ROOT . "/adminanunciante/team/".$url);
		} else {
			$_SESSION['modal'] = 	array('type' => 'success', 'msg' => 'Nova oferta adicionada e publicada ('.$id_anuncio.')');	
			redirect( WEB_ROOT . "/adminanunciante/team/".$url);
		}
	 } 
 }


$groups = DB::LimitQuery('category', array(
			'condition' => array( 'zone' => 'group', ),
			));
$groups = Utility::OptionArray($groups, 'id', 'name');

$condition[] = " 1=1 ";

$users = DB::LimitQuery('user', array(
			'condition' => array( $condition ),
			'order' => 'ORDER BY id DESC',
			));
$users = Utility::OptionArray($users, 'id', 'name');
$selector = $team['id'] ? 'edit' : 'create';

include template('manage_team_anunciante_edit');