<?php  
require_once(dirname(dirname(__FILE__)) . '/app.php');
  
if ( $_POST ) {
	$acao =  $_POST['acao'];
	
	if($_POST['acao']=="login") { 
		
		$login_user = ZUser::GetLogin($_POST['email'], $_POST['password']);
			if ( !$login_user ) {
				 
				Session::Set('error', "<BR>Não foi possível fazer o seu login. Por favor, verifique os seus dados.");
				redirect(WEB_ROOT . '/index.php?page=autentica&acao='.$acao.'&erro=1');
				
			} else if (option_yes('emailverify') && $login_user['enable']=='N' 	&& $login_user['secret']) {
				Session::Set('error', $_POST['email']);
				redirect(WEB_ROOT .'/verificaemail.php');
				
			} else { 
				Session::Set('user_id', $login_user['id']);
				ZLogin::Remember($login_user);
				ZUser::SynLogin($login_user['username'], $_POST['password']);
				ZCredit::Login($login_user['id']);
			   
			if(isset($_SESSION["loginpagepost"])){
				 
					redirect($_SESSION["loginpagepost"]); 			
			}
			else{
			 
				redirect(get_loginpage(WEB_ROOT . '/index.php'));
			} 
		}
	}	
	
	else if($_POST['acao']=="loginimportacontato") { 
		
		$login_user = ZUser::GetLogin($_POST['email'], $_POST['password']);
			if ( !$login_user ) {
				 
				 echo "0";
				 
			} else if (option_yes('emailverify') && $login_user['enable']=='N' 	&& $login_user['secret']) {
				
					echo "01";
				
			} else {
				Session::Set('user_id', $login_user['id']);
				ZLogin::Remember($login_user);
				ZUser::SynLogin($login_user['username'], $_POST['password']);
				ZCredit::Login($login_user['id']);
			    
		}
	}
	
	else if($_POST['acao']=="logintoupup") { 
		
		$login_user = ZUser::GetLogin($_POST['email'], $_POST['password']);
			if ( !$login_user ) {
				echo "00";
			} else if (option_yes('emailverify') && $login_user['enable']=='N' 	&& $login_user['secret']) {
				Session::Set('error', $_POST['email']);
				redirect(WEB_ROOT .'/verificaemail.php');
				
			} else {
				Session::Set('user_id', $login_user['id']);
				ZLogin::Remember($login_user);
				ZUser::SynLogin($login_user['username'], $_POST['password']);
				ZCredit::Login($login_user['id']); 
				$au = Table::Fetch('user', $_POST['email'], 'email');
				 
				echo $login_user['id'];	
			}
	}
	 
	else if($_POST['acao']=="cadastro") { 
	  
		$u = array();
		$u['cidadeusuario'] = $_POST['cidadeusuario'];
		$u['zipcode'] = $_POST['cep'];
		$u['bairro'] = $_POST['bairro']; 
		$u['estado'] = $_POST['estado'];
		$u['address'] = $_POST['endereco'];
		$u['numero'] = $_POST['numero'];
		$u['ddd'] = $_POST['ddd'];
	    $u['complemento'] = $_POST['complemento'];
		$u['username'] = strval($_POST['emailcadastro']);
		$u['mobile'] = strval($_POST['telefone']);
		$u['realname'] = strval($_POST['username']);
		$u['cpf'] = strval($_POST['cpf']);
		$u['password'] = strval($_POST['passwordcad']);
		$u['email'] = strval($_POST['emailcadastro']);
		$u['city_id'] =  0; 
		$u['local'] = strval($_POST['local']); 
        $nome =  $u['realname'];
		$user =  $u['username'];
		$admin_notify = $INI['mail']['user'];
		$dtcriacao =  date("dd/mm/YYYY"); 
		$email = $u['email'];
		 
		$dominio = getDomino($_POST['emailcadastro']);

		if(!checkdnsrr ($dominio)){
			echo   utf8_encode("Falha no registro. Por favor, informe um email válido");
			exit;
		} 
		   
		if ( ! Utility::ValidEmail($u['email'], true) ) {
			echo utf8_encode("Falha no registro, o endereço de email informado não é válido"); 
			exit;
		}
		  
		 
		if ($_POST['password2']==$_POST['passwordcad'] && $_POST['passwordcad']) {
	 
			if ( option_yes('emailverify') ) {
				$u['enable'] = 'Y';
			} 
			
			/*
			if($_POST['cpf'] != "" and $INI['option']['cpf']=="Y"){

				$sql = " select cpf from user where cpf='".$_POST['cpf']."'";
				$rs = mysqli_query(DB::$mConnection,$sql); 
				$lin = mysqli_fetch_object($rs);
				$cpf = $lin->cpf;
				if($cpf!=""){
					echo utf8_encode("Falha no registro, este cpf já está existe em nosso cadastro."); 
					exit;
				}
			}
			*/
			$au = Table::Fetch('user', $_POST['emailcadastro'], 'email');
			if ( $au ) { 
				echo utf8_encode("Falha no registro, e-mail já cadastrado"); 
			}
			else {			
				
				if ( $user_id = ZUser::Create($u) ) {
				 
					if ( $_POST['receberofertas'] ) {
		
						if( $INI['option']['confirmacaoemail'] == "Y"){

							$secret = md5($_POST['emailcadastro']);
							$sql =  "insert into subscribe (email,city_id,secret) values ('".$_POST['emailcadastro']."',".$u['city_id'].",'$secret' )";
							$rs = mysqli_query(DB::$mConnection,$sql);
							mail_sign_confirmacao($_POST['emailcadastro'],$secret);
						}
						
						//ZSubscribe::Create($u['email'],  intval($u['city_id']));
						$secret = md5($u['email'].$u['city_id']);
						$sql = "INSERT INTO `email_list_subscribers` ( `listid`, `emailaddress`, `domainname`, `format`, `confirmed`, `confirmcode`, `requestdate`, `requestip`, `confirmdate`, `confirmip`, `subscribedate`, `bounced`, `unsubscribed`, `unsubscribeconfirmed`, `formid`) VALUES ( 2, '".$email."', '".$dominio."', 'h', '1', '82cca631f30c3a42f7366e5ceeb38eee', '', '', '', '', '', 0, 0, '0', 0);";
						$rs = @mysqli_query(DB::$mConnection,$sql);  
							
					}
	 
					ZLogin::Login($user_id);
					mail_cadastro($user_id);
					echo $user_id;
						   
					 
				} else {
					echo utf8_encode("Falha no cadastro. Entre em contao conosco.");  
				}
			}
		} else {
			  echo utf8_encode("Falha no registro, definição de senha incorreta."); 
		}
	
	}else if($_POST['acao']=="altera_enderecos") { 
	   
		$tipo = $_POST['tipo'];
		$idcarrinho = $_POST['idcarrinho'];
		$idusuario = $_POST['idusuario'];
		$cidade = $_POST['cidade'];
		$cep = $_POST['cep'];
		$bairro = $_POST['bairro']; 
		$estado = $_POST['estado'];
		$endereco = $_POST['endereco'];
		$numero = $_POST['numero'];
		$complemento = $_POST['complemento'];  
		$telefone = $_POST['telefone'];  
		 
		$sql = "update user set ".$tipo."_cidade = '$cidade',".$tipo."_cep = '$cep',".$tipo."_bairro = '$bairro',".$tipo."_estado = '$estado',".$tipo."_endereco = '$endereco',".$tipo."_numero = '$numero',".$tipo."_complemento = '$complemento',".$tipo."_telefone = '$telefone' where id=".$idusuario;
		$rs =  mysqli_query(DB::$mConnection,$sql);
		if(!$rs){
			echo " Não foi possível alterar este endereço. Tente novamente mais tarde. Desculpe pelo incômodo.";
		}
		else{
		
			$sql = "select idcarrinho from order_enderecos where idcarrinho=".$idcarrinho;
			$rs =  mysqli_query(DB::$mConnection,$sql);
			
			if(mysqli_num_rows($rs) > 0){ //atualiza o endereço de cobranca ou entrega
				$sql = "update order_enderecos set ".$tipo."_cidade = '$cidade',".$tipo."_cep = '$cep',".$tipo."_bairro = '$bairro',".$tipo."_estado = '$estado',".$tipo."_endereco = '$endereco',".$tipo."_numero = '$numero',".$tipo."_complemento = '$complemento',".$tipo."_telefone = '$telefone' where  idcarrinho=".$idcarrinho;
				$rs =  mysqli_query(DB::$mConnection,$sql);
			}
			else{ // insere um novo endereco para esse carrinho (novo pedido)
				$sql = "insert into order_enderecos set ".$tipo."_cidade = '$cidade',".$tipo."_cep = '$cep',".$tipo."_bairro = '$bairro',".$tipo."_estado = '$estado',".$tipo."_endereco = '$endereco',".$tipo."_numero = '$numero',".$tipo."_complemento = '$complemento',".$tipo."_telefone = '$telefone',idcarrinho='$idcarrinho'";
				$rs =  mysqli_query(DB::$mConnection,$sql);
				if(!$rs){
					echo " Não foi possível inserir este endereço. Tente novamente mais tarde. Desculpe pelo incômodo.";
				}			
			}
 	
		}
	}
}

$currefer = strval($_GET['r']);
if ($currefer) { Session::Set('loginpage', udecode($currefer)); }
 