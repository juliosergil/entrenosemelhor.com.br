<?php

require_once "./app.php";
 
$idoferta = strval($_REQUEST['idoferta']);
$nome_proposta = strval($_REQUEST['nome_proposta']); 
$email_proposta = strval($_REQUEST['email_proposta']);
$ddd_proposta = strval($_REQUEST['ddd_proposta']);
$telefone_proposta = strval($_REQUEST['telefone_proposta']);
$proposta = strval($_REQUEST['proposta']);
$team  = Table::Fetch('team',$idoferta);

if($ddd_proposta=="DDD"){
	$ddd_proposta="";
}
if($telefone_proposta=="Telefone"){
	$telefone_proposta="";
} 

$user_id = $team['user_id'];
$user  = Table::Fetch('user',$user_id);
if ( $_POST ) {
	/*
	$dominio = getDomino($email_proposta);
	if(!checkdnsrr ($dominio)){
			echo  utf8_encode("Por favor, informe um email válido");
			exit;
	}
	*/
	
	//ZSubscribe::Create($email_proposta, $city_id);
	
	include("templates/template.class.php");

	$link = UrlAnuncio($team['id']);

	$template = new Template_new('templates/proposta.html');
	//Dados Gerais
	$template->set("data", date("d/m/Y H:i:s"));
	$template->set("baseurl", $ROOTPATH);
	$template->set("urllogo", $ROOTPATH."/include/logo/logo.png");
	$template->set("nomesite", utf8_decode($INI['system']['sitename']));
	$template->set("imgatention", $PATHSKIN."/images/atention.png");
	$template->set("urlanunciante", $ROOTPATH."/adminanunciante");
	$template->set("infoimg", $PATHSKIN."/images/info.png");
	$template->set("caledarimg", $PATHSKIN."/images/calendar-clock.png");

	//Dados do anúncio
	$template->set("teamid", $team['id']);
	$template->set("teamtitle", htmlentities($team['title']));
	$template->set("teamestado", $team['uf']);
	$template->set("teamquartos", $team['imob_quartos']);
	$template->set("teamvagas", $team['imob_vagas']);
	$template->set("teambanheiros", $team['imob_banheiros']);
	$template->set("urlanuncio", $link);
	$template->set("financiamento", $financiamento);
	$template->set("teampreco", $financiamento);

	//Dados da proposta
	$template->set("nomeproposta",htmlentities($nome_proposta));
	$template->set("emailproposta", $email_proposta);
	$template->set("telefoneproposta", $telefone_proposta);
	$template->set("proposta", htmlentities($proposta));

	//if(enviar($partner['contact'],ASSUNTO_PROPOSTA,$template->output())){

	if(enviar($user['email'], "Mensagem de nova proposta no site " . utf8_decode($INI['system']['sitename']), $template->output())){
			$enviado=true;
	}

	$mensagem="";
	unset($mensagem);
	
	$data = date("Y-m-d H:i:s");
  
	$insert = array(
	'idoferta', 'nome_proposta', 'email_proposta', 'ddd_proposta',
	'telefone_proposta', 'proposta', 'data', 'user_id', 
	);
	
	$propostas = $_POST;
	
	$propostas['data'] = $data;
	$propostas['user_id'] = $team['user_id'];
	
	$table = new Table('propostas', $propostas);
	
	
	if ( $table->insert($insert) and !$enviado ) {
		echo utf8_encode("Sua proposta foi salva, mas não conseguimos envia-la por e-mail. ".mysqli_error(DB::$mConnection)) ;
	} 

}
 
