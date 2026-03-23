<?php 
     
import('configure');
import('current');
import('utility');
import('mailer');
import('sms');
import('upgrade'); 
import('uc');
import('cron');
function getOfertasPacote($id){ 
  
	$sql	=	"select id,title,team_price,market_price from team where idpacote='".$id."' and begin_time < '".time()."' and end_time > '".time()."' and now_number < max_number ";
	$rs		=	mysqli_query(DB::$mConnection,$sql);
  
	if(mysqli_num_rows($rs) >0){
		$conteudo	 =	"<div class=\'boxmaior\'><div class=csescolha>Escolha a sua oferta</div><br/><br/>";
		while($row	= mysqli_fetch_array($rs)){
		 
			$idoferta		=	$row['id'];
			$title			=	utf8_decode($row['title']);
			$team_price	 	=	number_format($row['team_price'],2, ',', '.');
			$market_price 	=	number_format($row['market_price'],2, ',', '.');
			$economia 		=	number_format($row['market_price'] - $row['team_price'],2, ',', '.');
			$porcentagem	= 	round(100 - $row['team_price']/$row['market_price']*100,0);
	  
			 if(!$style){
				$style=" style=background:#F0F4F4"; 
			 }
			 else{
				$style=false;
			 }
			$conteudo	.=  "<table><tr $style ><td style=width:650px;>";
			$conteudo	.= 	"<div class=descricaooferta style=\'width: 628px;\'>".$title."</div>";
			$conteudo	.= 	"<div class=descricaooferta style=\'width: 628px;\'><b>De R$ ".$market_price ." por R$ ".$team_price.". ".$porcentagem."% de desconto. Economise R$ ".$economia ."</b></div> <br>";
			$conteudo	.=  "</td><td style=width:50px;><label for=$i><div  style=\'padding:10px;width:96px;\' class=view-deal-button><a  class=button small href=javascript:enviacart($idoferta);>Quero esta</a></div><label></td></tr></table>";
		}
		 $conteudo	.=  "</div>";
	}
	else{
		 $conteudo	.= 	"<font color=#303030 size=10> N�o existem mais ofertas dispon�veis para este pacote. <br>J� est�o canceladas ou esgotadas.<br><br> Por favor, tente verificar a disponibilidade mais tarde. </font><br/><br/>";
	}
	
	return $conteudo;
}

function envia_email_anuncios_finalizados(){ 

	GLOBAL $INI;

	$emailadmin = $INI['mail']['from'];

	Util::log(" envia_email_anuncios_finalizados ");
	
	global $INI,$ROOTPATH;
   
    $sql = "select p.username, p.realname as nome, t.title,t.id from team t, user p where status='1' and (pago='sim' or anunciogratis='s')  and  (avisa is null or avisa='') and p.id = t.user_id and t.end_time < ".time();
	$rs = mysqli_query(DB::$mConnection,$sql) or die(mysqli_error(DB::$mConnection)); 
	 
	Util::log( $sql );  
	
   
	while($l = mysqli_fetch_assoc($rs)){
	 
		$realname 	= utf8_decode($l['nome']);
		$email	 	= utf8_decode($l['username']);
		$title	 	= utf8_decode($l['title']);
		$id	 		= $l['id'];
		
		Util::log( $realname. " ".$email. " ".$title );
		
		
	    $body =
		"<html><head>
</head><body style='font-size:12px;'><meta http-equiv='Content-Type' content='text/html; charset=utf8' />
		<p> Ol&aacute; $realname,  estamos enviando este email para informar que o seu  an&uacute;ncio <b>".$title."</b> expirou e foi finalizado.</p>
		<p>Para republicar o seu an&uacute;ncio novamente <a href='".$ROOTPATH."/adminanunciante'>clique aqui</a> para acessar os seus an&uacute;ncios </p>
		
		<p></p>
		<p></p>
		Atenciosamente
		<p></p>
		<b>".utf8_decode($INI["system"]["sitename"])."</b>
		<br> 
		". $ROOTPATH."</a>
		
		</body></html>" ;
	 
		
		 enviar($emailadmin,utf8_decode($INI["system"]["sitename"])." - $email ".utf8_encode("Anúncio Finalizado"),utf8_encode($body));
	 
		 if(enviar( $email,utf8_decode($INI["system"]["sitename"])." - ".utf8_encode("Anúncio Finalizado"),utf8_encode($body))){

			 $enviou =  true;
			 $sql	 =	"update team set avisa='Y' where id=".$id;
			 $rs 	 =  mysqli_query(DB::$mConnection,$sql);
			 Util::log("EMAIL ENVIADO:  $sql ");
		 
		 }
		 else{
			$enviou =  false;
		 }
	 
	}
}


function ePacote($id){ 
  
	$sql	=	"select id from team where idpacote='".$id."'  limit 1";
	$rs		=	mysqli_query(DB::$mConnection,$sql);
  
	if(mysqli_num_rows($rs) >0){
		return true;
	}
	else{
		return false;
	} 
}

function getImg($imagem){ 
	global $INI;   
	return $INI['system']['wwwprefix']."/media/".$imagem;
}
function semImg($imagem){ 
	global $INI,$PATHSKIN; 
	
	return $PATHSKIN."/images/semfoto.jpg";
}
function mostratopo(){ 
	global $INI, $idpagina;
	if( $INI['option']['redirecionador'] == "Y" or $idpagina or $_REQUEST['page'] or $_REQUEST['idoferta'] ){
		return true;
	}
	else{
		return false;
	} 
}
function RemoveXSS($val) { 
   // remove all non-printable characters. CR(0a) and LF(0b) and TAB(9) are allowed 
   // this prevents some character re-spacing such as <java\0script> 
   // note that you have to handle splits with \n, \r, and \t later since they *are* allowed in some inputs 
  // $val = preg_replace('/([\x00-\x08,\x0b-\x0c,\x0e-\x19])/', '', $val); 
    
   // straight replacements, the user should never need these since they're normal characters 
   // this prevents like <IMG SRC=&#X40&#X61&#X76&#X61&#X73&#X63&#X72&#X69&#X70&#X74&#X3A &#X61&#X6C&#X65&#X72&#X74&#X28&#X27&#X58&#X53&#X53&#X27&#X29> 
   $search = 'abcdefghijklmnopqrstuvwxyz'; 
   $search .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
   $search .= '1234567890!@#$%^&*()'; 
   $search .= '~`";,:?+/={}[]-_|\'\\'; 
   for ($i = 0; $i < strlen($search); $i++) { 
   
      // ;? matches the ;, which is optional 
      // 0{0,7} matches any padded zeros, which are optional and go up to 8 chars 
    
      // &#x0040 @ search for the hex values 
      $val = preg_replace('/(&#[xX]0{0,8}'.dechex(ord($search[$i])).';?)/i', $search[$i], $val); // with a ; 
      // &#00064 @ 0{0,7} matches '0' zero to seven times 
      $val = preg_replace('/(&#0{0,8}'.ord($search[$i]).';?)/', $search[$i], $val); // with a ; 
   } 
    
   // now the only remaining whitespace attacks are \t, \n, and \r 
   $ra1 = Array('javascript', 'vbscript', 'expression', 'applet', 'meta', 'xml', 'blink', 'link', 'style', 'script', 'embed', 'object', 'iframe', 'frame', 'frameset','ilayer', 'layer', 'bgsound', 'title', 'base'); 
   $ra2 = Array('onabort', 'onactivate', 'onafterprint', 'onafterupdate', 'onbeforeactivate', 'onbeforecopy', 'onbeforecut', 'onbeforedeactivate', 'onbeforeeditfocus','onbeforepaste', 'onbeforeprint', 'onbeforeunload', 'onbeforeupdate', 'onblur', 'onbounce', 'oncellchange', 'onchange', 'onclick', 'oncontextmenu', 'oncontrolselect','oncopy', 'oncut', 'ondataavailable', 'ondatasetchanged', 'ondatasetcomplete', 'ondblclick', 'ondeactivate', 'ondrag', 'ondragend', 'ondragenter', 'ondragleave', 'ondragover','ondragstart', 'ondrop', 'onerror', 'onerrorupdate', 'onfilterchange', 'onfinish', 'onfocus', 'onfocusin', 'onfocusout', 'onhelp', 'onkeydown', 'onkeypress', 'onkeyup','onlayoutcomplete', 'onload', 'onlosecapture', 'onmousedown', 'onmouseenter', 'onmouseleave', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onmousewheel','onmove', 'onmoveend', 'onmovestart', 'onpaste', 'onpropertychange', 'onreadystatechange', 'onreset', 'onresize', 'onresizeend', 'onresizestart', 'onrowenter', 'onrowexit','onrowsdelete', 'onrowsinserted', 'onscroll', 'onselect', 'onselectionchange', 'onselectstart', 'onstart', 'onstop', 'onsubmit', 'onunload'); 
   $ra = array_merge($ra1, $ra2); 
    
   $found = true; // keep replacing as long as the previous round replaced something 
   while ($found == true) { 
      $val_before = $val; 
      for ($i = 0; $i < sizeof($ra); $i++) { 
         $pattern = '/'; 
         for ($j = 0; $j < strlen($ra[$i]); $j++) { 
            if ($j > 0) { 
               $pattern .= '('; 
               $pattern .= '(&#[xX]0{0,8}([9ab]);)'; 
               $pattern .= '|'; 
               $pattern .= '|(&#0{0,8}([9|10|13]);)'; 
               $pattern .= ')*'; 
            } 
            $pattern .= $ra[$i][$j]; 
         } 
         $pattern .= '/i'; 
         $replacement = substr($ra[$i], 0, 2).'<x>'.substr($ra[$i], 2); // add in <> to nerf the tag 
         $val = preg_replace($pattern, $replacement, $val); // filter out the hex tags 
         if ($val_before == $val) { 
            // no replacements were made, so exit the loop 
            $found = false; 
         } 
      } 
   }  
   return $val; 
}
function current_teamcategory($gid='0') {
	global $city;
 
	foreach(option_hotcategory('group') AS $id=>$name) {
		$a["$id"] = $name;
	}
	$l = "/team/index.php?gid={$gid}";
	if (!$gid) $l = "/team/index.php";
	return current_link($l, $a, true);
}
function current_teamcategory_principal($gid='0') {
	global $city;
 
	foreach(option_hotcategory('group') AS $id=>$name) {
		$a["$id"] = $name;
	}
	$l = "/team/index.php?gid={$gid}";
	if (!$gid) $l = "/team/index.php";
	return current_link_principal($l, $a, true);
}
function current_teamcategory_recentes($gid='0') {
	global $city;
 
	foreach(option_hotcategory('group') AS $id=>$name) {
		$a["$id"] = $name;
	}
	$l = "/team/index.php?gid={$gid}";
	if (!$gid) $l = "/team/index.php";
	return current_link_recentes($l, $a, true);
}
function current_teamcategoryhome($gid='0') {
	global $city;
  
	foreach(option_hotcategory('group') AS $id=>$name) {
		$a["/". $city['ename']."/Categoria/$id"] = $name;
	}
	 
	return current_link_home($l, $a, true);
} 
function tratacidade($nome) {
	    $var =    $nome  ;
		
		/*$var = str_replace("[����]","a",$var);
		$var = str_replace("[���]","E",$var);
		$var = str_replace("[���]","e",$var);
		$var = str_replace("[�]","I",$var);
		$var = str_replace("[����]","O",$var);
		$var = str_replace("[�����]","o",$var);
		$var = str_replace("[���]","U",$var);
		$var = str_replace("[�]","i",$var);
		$var = str_replace("[���]","u",$var);
		$var = str_replace("�","C",$var);
		$var = str_replace("�","c",$var);
		//$var = str_replace(" ","-",$var);
		$var = str_replace("_","-",$var);*/
		 
 
		return $var;
	}
function getNavegador(){
	$useragent = $_SERVER['HTTP_USER_AGENT'];
 
  if (preg_match('|MSIE ([0-9].[0-9]{1,2})|',$useragent,$matched)) {
    $browser_version=$matched[1];
    $browser = 'ie';
  } elseif (preg_match( '|Opera/([0-9].[0-9]{1,2})|',$useragent,$matched)) {
    $browser_version=$matched[1];
    $browser = 'Opera';
  } elseif(preg_match('|Firefox/([0-9\.]+)|',$useragent,$matched)) {
    $browser_version=$matched[1];
    $browser = 'Firefox';
  } elseif(preg_match('|Chrome/([0-9\.]+)|',$useragent,$matched)) {
    $browser_version=$matched[1];
    $browser = 'Chrome';
  } elseif(preg_match('|Safari/([0-9\.]+)|',$useragent,$matched)) {
    $browser_version=$matched[1];
    $browser = 'Safari';
  } else {
    // browser not recognized!
    $browser_version = 0;
    $browser= 'other';
  }
  
  return strtolower($browser);
}
function upload_image($input, $image=null, $type="team", $scale=false,$marcadagua=false) {
	  global $INI;
	 $img = new canvas();
	 
	$year = date("Y"); $day = date("md"); $n = time().rand(1000,9999).".jpg";
	$z = $_FILES[$input];
	if ($z && strpos($z["type"], "image")===0 && $z["error"]==0) {
		if (!$image) {
			RecursiveMkdir( IMG_ROOT . "/" . "{$type}/{$year}/{$day}" );
			$image = "{$type}/{$year}/{$day}/{$n}";
			$path = IMG_ROOT . "/" . $image;
		} else {
			RecursiveMkdir( dirname(IMG_ROOT ."/" .$image) );
			$path = IMG_ROOT . "/" .$image;
		}
		if ($type=="user") {
			Image::Convert($z["tmp_name"], $path, 48, 48, Image::MODE_CUT);
		}
		else if($type == "imagemcateghome") {
		
			move_uploaded_file($z["tmp_name"], $path);
			$npath = preg_replace('#(\d+)\.(\w+)$#', "\\1_categhome\\2", $path); 
			$img->carrega(WWW_ROOT."/media/".$image)->redimensiona( 285,400 )->grava($npath);			
			
		}	
		else if($type == "imagemcateghome2") {
		
			move_uploaded_file($z["tmp_name"], $path);
			$npath = preg_replace('#(\d+)\.(\w+)$#', "\\1_categhome\\2", $path); 
			$img->carrega(WWW_ROOT."/media/".$image)->grava($npath);			
			
		}
		else if($type=="team") {
			move_uploaded_file($z["tmp_name"], $path);  
			
				/*============= MARCA DAGUA NA FOTO ORIGINAL ESCOMENTAR =======================*/
			 if(file_exists(WWW_MOD."/marcadagua.inc")) {
				$npath =  $path; 
				$img->carrega(WWW_ROOT."/media/".$image)->marca($INI['system']['wwwprefix'].'/skin/padrao/images/marca.png', 'meio', 'centro' )->grava($npath);
			 }
			/*============================ FIM MARCA DAGUA ================================*/
			
			
			//$npath = preg_replace('#(\d+)\.(\w+)$#', "\\1_recentes_mod2.\\2", $path); 
			//$img->carrega(WWW_ROOT."/media/".$image)->redimensiona( null,162 )->grava($npath); 
			 
			//$npath = preg_replace('#(\d+)\.(\w+)$#', "\\1_destaque.\\2", $path);
			$npath = preg_replace('#(\d+)\.(\w+)$#', "\\1_thumb.\\2", $path);
			Image::Convert($path , $npath, 80, 60, Image::MODE_CUT);
			 
			
			$npath = preg_replace('#(\d+)\.(\w+)$#', "\\1_mini.\\2", $path); 
			//$img->carrega(WWW_ROOT."/media/".$image)->redimensiona( 104,78 )->grava($npath);
			Image::Convert($path , $npath, 104,78 , Image::MODE_CUT);
			
			
		}	
		else if($type=="estatica") {
			move_uploaded_file($z["tmp_name"], $path);  
			$npath = preg_replace('#(\d+)\.(\w+)$#', "\\1_".$input.".\\2", $path); 
			$img->carrega(WWW_ROOT."/media/".$image)->grava($npath);  
			
		}
	 	 else if($type=="parceiro") {
			move_uploaded_file($z["tmp_name"], $path);
			$npath = preg_replace('#(\d+)\.(\w+)$#', "\\1_parceirohome.\\2", $path);
			$img->carrega(WWW_ROOT."/media/".$image)->redimensiona( 148,110 )->grava($npath);
		} 
		else if($type=="parceiro2") {
			move_uploaded_file($z["tmp_name"], $path);
			$npath = preg_replace('#(\d+)\.(\w+)$#', "\\1_parceiropng.\\2", $path);
			Image::Convert($path, $npath, null, 120, Image::MODE_CUT);
		}
		else if($type=="pagina") {
			move_uploaded_file($z["tmp_name"], $path);
			$npath = preg_replace('#(\d+)\.(\w+)$#', "\\1_mini.\\2", $path);
			$img->carrega(WWW_ROOT."/media/".$image)->redimensiona( null,247 )->grava($npath);
		} 
	  
	}
	return $image;
}

function magic_gpc($string) {
	
						 
									 
									
	
		  
								   
   
  
	  return $string;
	  
   
}


 
function template($tFile) {
	global $INI; 
	if ( 0===strpos($tFile, 'manage') ) {
		return __template($tFile);
	}
	if ($INI['skin']['template']) {
 
		$templatedir = DIR_TEMPLATE. '/' . $INI['skin']['template'];
		$checkfile = $templatedir . '/html_header.html';
		if ( file_exists($checkfile) ) {
		 
			return __template($INI['skin']['template'].'/'.$tFile);
		}
		
	} 
	return __template($tFile);
}
function render($tFile, $vs=array()) {
    ob_start();
    foreach($GLOBALS AS $_k=>$_v) {
        ${$_k} = $_v;
    }
	foreach($vs AS $_k=>$_v) {
		${$_k} = $_v;
	}
	include template($tFile);
    return render_hook(ob_get_clean());
}
function render_hook($c) {
	global $INI;
	$c = preg_replace('#href="/#i', 'href="'.WEB_ROOT.'/', $c);
	$c = preg_replace('#src="/#i', 'src="'.WEB_ROOT.'/', $c);
	$c = preg_replace('#action="/#i', 'action="'.WEB_ROOT.'/', $c);
	 
	$page = strval($_SERVER['REQUEST_URI']);
	if($INI['skin']['theme'] && !preg_match('#/vipmin/#i',$page)) {
		$themedir = WWW_ROOT. '/media/theme/' . $INI['skin']['theme'];
		$checkfile = $themedir. '/css/index.css';
		if ( file_exists($checkfile) ) {
			$c = preg_replace('#/media/css/#', "/media/theme/{$INI['skin']['theme']}/css/", $c);
			$c = preg_replace('#/media/img/#', "/media/theme/{$INI['skin']['theme']}/img/", $c);
		}
	}
	if (strtolower(cookieget('locale','zh_cn'))=='zh_tw') {
		require_once(DIR_FUNCTION  . '/tradition.php');
		$c = str_replace(explode('|',$_charset_simple), explode('|',$_charset_tradition),$c);
	}
 
	$c = obscure_rep($c);
	return $c;
}
function output_hook($c) {
	global $INI;
	if ( 0==abs(intval($INI['system']['gzip'])))  die($c);
	$HTTP_ACCEPT_ENCODING = $_SERVER["HTTP_ACCEPT_ENCODING"];
	if( strpos($HTTP_ACCEPT_ENCODING, 'x-gzip') !== false )
		$encoding = 'x-gzip';
	else if( strpos($HTTP_ACCEPT_ENCODING,'gzip') !== false )
		$encoding = 'gzip';
	else $encoding == false;
	if (function_exists('gzencode')&&$encoding) {
		$c = gzencode($c);
		header("Content-Encoding: {$encoding}");
	}
	$length = strlen($c);
	header("Content-Length: {$length}");
	die($c);
}
$lang_properties = array();
function I($key) {
    global $lang_properties, $LC;
    if (!$lang_properties) {
        $ini = DIR_ROOT . '/i18n/' . $LC. '/properties.ini';
        $lang_properties = Config::Instance($ini);
    }
    return isset($lang_properties[$key]) ?
        $lang_properties[$key] : $key;
}
function json($data, $type='eval') {
    $type = strtolower($type);
    $allow = array('eval','alert','updater','dialog','mix', 'refresh');
    if (false==in_array($type, $allow))
        return false;
    Output::Json(array( 'data' => $data, 'type' => $type,));
}
function retira_acento ($txt){
$txt= str_replace("[????]","A", $txt );
$txt= str_replace("[?????]","a",$txt);
$txt= str_replace("[???]","E",$txt);
$txt= str_replace("[???]","e",$txt);
$txt= str_replace("[?]","I",$txt);
$txt= str_replace("[????]","O",$txt);
$txt= str_replace("[?????]","o",$txt);
$txt= str_replace("[???]","U",$txt);
$txt= str_replace("[?]","i",$txt);
$txt= str_replace("[???]","u",$txt);
$txt= str_replace("?","C",$txt);
$txt= str_replace("?","c",$txt);
return $txt;
}
function retira_acentos( $string, $slug = false) {
  $string = strtolower($string);
  // Código ASCII das vogais
  $ascii['a'] = range(224, 230);
  $ascii['e'] = range(232, 235);
  $ascii['i'] = range(236, 239);
  $ascii['o'] = array_merge(range(242, 246), array(240, 248));
  $ascii['u'] = range(249, 252);
  // Código ASCII dos outros caracteres
  $ascii['b'] = array(223);
  $ascii['c'] = array(231);
  $ascii['d'] = array(208);
  $ascii['n'] = array(241);
  $ascii['y'] = array(253, 255);
  foreach ($ascii as $key=>$item) {
    $acentos = '';
    foreach ($item AS $codigo) $acentos .= chr($codigo);
    $troca[$key] = '/['.$acentos.']/i';
  }
  $string = preg_replace(array_values($troca), array_keys($troca), $string);
  // Slug?
  if ($slug) {
    // Troca tudo que não for letra ou número por um caractere ($slug)
    $string = preg_replace('/[^a-z0-9]/i', $slug, $string);
    // Tira os caracteres ($slug) repetidos
    $string = preg_replace('/' . $slug . '{2,}/i', $slug, $string);
    $string = trim($string, $slug);
  }
  return $string;
}
function redirect($url=null, $notice=null, $error=null) {
	$url = $url ? obscure_rep($url) : $_SERVER['HTTP_REFERER'];
	$url = $url ? $url : '/';
	if ($notice) Session::Set('notice', $notice);
	if ($error) Session::Set('error', $error);
    header("Location: {$url}");
    exit;
}
function write_php_file($array, $filename=null){
	$v = "<?php\r\n\$INI = ";
	$v .= var_export($array, true);
	$v .=";\r\n?>";
	return file_put_contents($filename, $v);
}
function write_ini_file($array, $filename=null){
	$ok = null;
	if ($filename) {
		$s =  ";;;;;;;;;;;;;;;;;;\r\n";
		$s .= ";; SYS_INIFILE\r\n";
		$s .= ";;;;;;;;;;;;;;;;;;\r\n";
	}
	foreach($array as $k=>$v) {
		if(is_array($v))   {
			if($k != $ok) {
				$s  .=  "\r\n[{$k}]\r\n";
				$ok = $k;
			}
			$s .= write_ini_file($v);
		}else   {
			if(trim($v) != $v || strstr($v,"["))
				$v = "\"{$v}\"";
			$s .=  "$k = \"{$v}\"\r\n";
		}
	}
	if(!$filename) return $s;
	return file_put_contents($filename, $s);
}
function save_config($type='ini') {
	return configure_save();
	global $INI; $q = ZSystem::GetSaveINI($INI);
	if ( strtoupper($type) == 'INI' ) {
		if (!is_writeable(SYS_INIFILE)) return false;
		return write_ini_file($q, SYS_INIFILE);
	}
	if ( strtoupper($type) == 'PHP' ) {
		if (!is_writeable(SYS_PHPFILE)) return false;
		return write_php_file($q, SYS_PHPFILE);
	}
	return false;
}
function save_system($ini) {
	$system = Table::Fetch('system', 1);
	$ini = ZSystem::GetUnsetINI($ini);
	$value = Utility::ExtraEncode($ini);
	$table = new Table('system', array('value'=>$value));
	if ( $system ) $table->SetPK('id', 1);
	return $table->update(array( 'value'));
}
function atualiza_qtde_visualizacao($idoferta) {
 
	$sql = "select visualizados from team where id = $idoferta";
    $rs = mysqli_query(DB::$mConnection,$sql);	
	$linha = mysqli_fetch_object($rs);
	
	if($linha->visualizados){
	  
	   $sql = "update team set visualizados = visualizados + 1 where id = $idoferta";
		mysqli_query(DB::$mConnection,$sql); 
	}
	else{ 
		$sql = "update team set visualizados =  1 where id = $idoferta";
		mysqli_query(DB::$mConnection,$sql);
	} 
}
function get_num_pedido($tipo) {
	$data = date("Y-m-d H:i:s");
	
	$valorped = str_replace("","",$_REQUEST['valorpedido']);
	$valorped = str_replace(",",".",$valorped);
	
    $sql	=	"INSERT INTO `order`(datapedido,service,user_id,team_id,quantity,price,origin,tipo,city_id) values ('".$data."','".$_REQUEST['gateway']."','".$_REQUEST['idusuario']."','".$_REQUEST['idoferta']."','".$_REQUEST['quantidade']."','".$_REQUEST['valor_unitario']."','".$valorped."','".$tipo."','".$_REQUEST['city_id']."' )";
	$rs = mysqli_query(DB::$mConnection,$sql);
	if(!$rs){
		echo $sql." ".mysqli_error(DB::$mConnection);
	}
	else{
		if($tipo=="promocional"){ // atualiza o contator promocional
			$sql = "update team set now_number = now_number+1 where id =".$_REQUEST['idoferta'];
			mysqli_query(DB::$mConnection,$sql);
		}
	
		$idnovopedido = mysqli_insert_id(DB::$mConnection);
		if($tipo!="promocional"){
			$usuario 	= Table::Fetch('user', $_REQUEST['idusuario']);
			$nome 		= $usuario['realname'] ;
			$qtde 		= $_REQUEST['quantidade']; 
			$sql 		=  "insert into order_amigos (nome,order_id,qtde) values ('$nome',$idnovopedido,$qtde)";
			mysqli_query(DB::$mConnection,$sql);
		}
		 
		return $idnovopedido;
	}
}
function get_id_pagamento() {
 
	$sql = "select max(id) as id from pagamentos";
    $rs = mysqli_query(DB::$mConnection,$sql);	
	$linha = mysqli_fetch_object($rs);
	$idpagamento = $linha->id;
	if($idpagamento==""){
		$idpagamento=1;	
	}
	$idpagamento = (int)$idpagamento + 1;
	return $idpagamento;
 
}
//$sql	=	"update team set anunciogratis = 'sim' where id=".$idnovo;
//$rs = @mysqli_query(DB::$mConnection,$sql);
			 
			 
 function insere_dados_pagamento($team_id,$idpedido,$valor,$user_id,$idplano,$status_pagamento,$mensagem) {
  
	global $INI,$ROOTPATH;
  
	$data = date("Y-m-d H:i:s");
	
	$valorped = str_replace("","",$valor);
	$valorped = str_replace(",",".",$valorped);
	
    $sql	=	"INSERT INTO `pagamentos`(id, team_id ,datapagamento,idplano,valor,status_pagamento,mensagem) values (".$idpedido.",".$team_id.",'".$data."','".$idplano."',".$valorped.",'".$status_pagamento."','".$mensagem."')";
	$rs = @mysqli_query(DB::$mConnection,$sql);
	if($rs){
			Util::log($team_id. " - Dados do pagamento inseridos na tabela Pagamentos com sucesso.");
	}
	else{
		Util::log($team_id. " - Erro ao inserir os dados do pagamento inseridos na tabela Pagamentos. ". mysqli_error(DB::$mConnection). " ".$sql);
	}
	
	
	if($status_pagamento=="Sucesso"){
		 $sql	=	"update team set pago = 'sim', anunciogratis='', idplano='$idplano',ehdestaque='Y' where id=".$team_id;
		 $rs = @mysqli_query(DB::$mConnection,$sql);
		  
		if($rs){
			Util::log($team_id. " - Anuncio ".$team_id." atualizado para pago na tabela team com sucesso");
		}
		else{
			Util::log($team_id. " - Erro ao atualizar o anuncio ".$team_id." para pago na tabela team. ". mysqli_error(DB::$mConnection). " ".$sql);
		}
	
		alteradatafim_anuncio($team_id,$idplano);
		  
		$team = Table::Fetch('team', $team_id);
		 
		$body =
		"<html><head>
</head><body style='font-size:12px;'><meta http-equiv='Content-Type' content='text/html; charset=utf8' /><meta http-equiv='Content-Language' content='pt-br' />
		<div> Ol&aacute;, o an&uacute;ncio ".$team_id." foi pago e agora voc&ecirc; precisa moder&aacute;-lo antes de sua publica&ccedil;&atilde;o.</div><br>
		Para moderar este an&uacute;ncio entre na administra&ccedil;&atilde;o no menu an&uacute;ncios, clique em editar o an&uacute;ncio ".$team_id." e altere o status Modera&ccedil;&atilde;o<br>
		<p>Moderar: <a href='".$ROOTPATH."/vipmin'>$ROOTPATH/vipmin</a> </p>
		<br>
		<b> Dados do An&uacute;ncio</b>
		<p>An&uacute;ncio: ".$team['title']."</p> 
		<p>Descri&ccedil;&atilde;o: ".$team['summary']."</p></body></html>" ;
		
		$emailadmin = $INI['mail']['from'];
		
		 if(enviar( $emailadmin,utf8_decode($INI["system"]["sitename"])." - ". utf8_encode("Postagem $team_id paga e aguardando para ser moderada"), utf8_encode($body) )){
			 $enviou =  true;
		 }
		 else{
			$enviou =  false;
		 }
	}
	  
}

function finalizaanuncio() {

	global $INI;

	// -------------------- [DV-ANCHOR: INPUTS] --------------------
	$team_id = isset($_REQUEST['team_id']) ? (int)$_REQUEST['team_id'] : 0;
	$user_id = isset($_REQUEST['user_id']) ? (int)$_REQUEST['user_id'] : 0;
	$idplano = isset($_REQUEST['idplano']) ? (int)$_REQUEST['idplano'] : 0;

	// Se faltar algo básico, para (evita INSERT quebrado)
	if ($team_id <= 0 || $user_id <= 0 || $idplano <= 0) {
		// você pode trocar por return; ou registrar log
		return false;
	}

	$data = date("Y-m-d H:i:s");

	// -------------------- [DV-ANCHOR: VALOR-CLEAN] --------------------
	$valor_raw = isset($_REQUEST['valor']) ? (string)$_REQUEST['valor'] : '0';
	$valor_raw = trim($valor_raw);

	// remove tudo que não for dígito, ponto ou vírgula (tira R$, espaços etc.)
	$valor = preg_replace('/[^\d\.,]/', '', $valor_raw);

	// trata formato brasileiro 1.234,56 -> 1234.56
	if (strpos($valor, ',') !== false && strpos($valor, '.') !== false) {
		$valor = str_replace('.', '', $valor);   // remove milhar
		$valor = str_replace(',', '.', $valor);  // vírgula vira decimal
	} else {
		// trata 29,90 -> 29.90
		$valor = str_replace(',', '.', $valor);
	}

	// garante número
	if ($valor === '' || !is_numeric($valor)) {
		$valor = '0';
	}

	// padroniza 2 casas decimais (como string numérica)
	$valorped = number_format((float)$valor, 2, '.', '');

	// -------------------- [DV-ANCHOR: INSERT-PAGAMENTO] --------------------
	$sql = "INSERT INTO `pagamentos`
			(`team_id`,`user_id`,`datapagamento`,`idplano`,`valor`,`status_pagamento`,`mensagem`)
			VALUES ($team_id, $user_id, '$data', $idplano, $valorped, '', '')";

	// NÃO use @ aqui, senão você fica cego
	$rs = mysqli_query(DB::$mConnection, $sql);
	if (!$rs) {
		// Debug rápido: veja exatamente qual SQL quebrou
		// echo $sql; exit;
		// Ou logue:
		// error_log("finalizaanuncio INSERT error: ".mysqli_error(DB::$mConnection)." | SQL=".$sql);
		return false;
	}

	// -------------------- [DV-ANCHOR: PLANO-SLIDE-INTERNA] --------------------
	// Ajuste 'planos' para o nome real da sua tabela de planos (ex: plan, plano, etc.)
	$plano = Table::Fetch('planos_publicacao', $idplano);
	if ($plano && isset($plano['slide_interna']) && strtolower(trim($plano['slide_interna'])) === 's') {
		$sql = "UPDATE `team` SET `ehdestaque`='Y' WHERE `id`=$team_id LIMIT 1";
		mysqli_query(DB::$mConnection, $sql);
	}

	// -------------------- [DV-ANCHOR: UPDATE-TEAM] --------------------
	$sql = "UPDATE `team` SET `anunciogratis`='s' WHERE `id`=$team_id LIMIT 1";
	mysqli_query(DB::$mConnection, $sql);

	// mantém sua regra
	alteradatafim_anuncio($team_id, $idplano);

	$team = Table::Fetch('team', $team_id);

	// -------------------- [DV-ANCHOR: EMAIL] --------------------
	$body =
		"<html><head></head><body style='font-size:12px;'>
		<meta http-equiv='Content-Type' content='text/html; charset=utf8' />
		<h2> O An&uacute;ncio ".$team_id." precisa ser moderado antes de sua publica&ccedil;&atilde;o.</h2><br>
		Para moderar este an&uacute;ncio entre na administra&ccedil;&atilde;o no menu an&uacute;ncios, clique em editar o an&uacute;ncio '".$team_id."' e altere o status Modera&ccedil;&atilde;o<br>
		<h3> Dados do An&uacute;ncio</h3>
		<p>An&uacute;ncio: ".utf8_decode($team['title'])."</p>
		<p>Descri&ccedil;ao: ".utf8_decode($team['summary'])."</p>
		</body></html>";

	$emailadmin = $INI['mail']['from'];

	if (enviar($emailadmin, utf8_decode($INI["system"]["sitename"])." - ".utf8_encode(" Postagem ".$team_id." aguardando para ser moderada"), utf8_encode($body))) {
		$enviou = true;
   
	} else {
		$enviou = false;
	}

	return true;
}
function getdiasplanocliente($plano_id){
	$sql = "select dias from partner_planos where status in ('gratis','pago','') and plano_id = $plano_id order by id desc ";
    $rs = mysqli_query(DB::$mConnection,$sql);	
	$linha = mysqli_fetch_object($rs);
	$dias = $linha->dias;
	return $dias;
	
}
 
  

function getdiasplano($plano_id){
	if($plano_id){
		$sql = "select dias from planos_publicacao where id = $plano_id";
		$rs = mysqli_query(DB::$mConnection,$sql);	
		$linha = mysqli_fetch_object($rs);
		$dias = $linha->dias;
	}
	return $dias;
}
   
 
function alteradatafim_anuncio($team_id,$plano_id){
	$dias = getdiasplano($plano_id);
	if(!empty($dias)){
		Util::log($team_id. " - Os dias para o plano id $plano_id são $dias dia(s) ");
	}
	else{
		Util::log($team_id. " - Erro ao buscar os dias do plano $plano_id. ". mysqli_error(DB::$mConnection). " ".$sql);
		return;
	}
	
	$sql = "select dias from planos_publicacao where id = $plano_id";
    $rs = mysqli_query(DB::$mConnection,$sql);	
	$linha = mysqli_fetch_object($rs);
	$dias = $linha->dias;
	$begin_time =   strtotime('+0 days');  
    $end_time   =   strtotime('+'.$dias.' days'); 
	$sql	=	"update team set end_time= '$end_time', begin_time='$begin_time' where id=".$team_id;
	$rs = @mysqli_query(DB::$mConnection,$sql);
	//Util::log($sql);
	if($rs){
		Util::log($team_id. " - Periodo de veiculacao do anuncio atualizados com sucesso");
	}
	else{
		Util::log($team_id. " - Erro ao atualizar o periodo de veiculacao do anuncio plano $plano_id. ". mysqli_error(DB::$mConnection));
	}
	atualiza_max_anuncios_partner($team_id,$plano_id);
}

// inclusao de modulo de qtde de anuncios por plano
// bruno
// 29/07/15
 
function atualiza_max_anuncios_partner($team_id, $plano_id) {

    Util::log("plano_id: $plano_id - atualiza_max_anuncios_partner para team_id: $team_id");

    $planos_publicacao = Table::Fetch('planos_publicacao', $plano_id);
    if (!$planos_publicacao) {
        Util::log("Erro: plano_id $plano_id não encontrado.");
        return false;
    }

    $qtdeanuncio_planocontratado = intval($planos_publicacao['qtdeanuncio'] ?? 0);
    if ($qtdeanuncio_planocontratado <= 0) {
        Util::log("qtdeanuncio_planocontratado inválido ou zero. Nada a atualizar.");
        return false;
    }

    $team = Table::Fetch('team', $team_id);
    if (!$team) {
        Util::log("Erro: team_id $team_id não encontrado.");
        return false;
    }

    $partner_id = intval($team['partner_id'] ?? 0);
    if ($partner_id <= 0) {
        Util::log("Erro: partner_id inválido para team_id $team_id.");
        return false;
    }

    $partner = Table::Fetch('partner', $partner_id);
    $max_anuncios = intval($partner['max_anuncios'] ?? 0);

									   
    if ($max_anuncios <= 0) {
        // Se estiver "-1" ou "0", zera ou redefine
        Util::log("plano_id: $plano_id - redefinindo max_anuncios para $qtdeanuncio_planocontratado");
        $sql = "UPDATE partner SET max_anuncios = $qtdeanuncio_planocontratado WHERE id = $partner_id";
											 
    } else {
        // Incrementa max_anuncios
        Util::log("plano_id: $plano_id - incrementando max_anuncios em $qtdeanuncio_planocontratado");
        $sql = "UPDATE partner SET max_anuncios = max_anuncios + $qtdeanuncio_planocontratado WHERE id = $partner_id";
    }

    $rs = mysqli_query(DB::$mConnection, $sql);
   
    if ($rs) {
        Util::log("team_id $team_id - max_anuncios do parceiro $partner_id atualizado com sucesso.");
    } else {
	   
        Util::log("team_id $team_id - ERRO ao atualizar max_anuncios: $sql | ".mysqli_error(DB::$mConnection));
   
 
  
	  
																																	
    }

    return $rs ? true : false;
																
										   
		 
														 
  
	  
																										  
  
 
   
}

function republicar_anuncio($team_id){ 
	
	// o anuncio sera republicado para 30 dias
 
	Util::log("republicar_anuncio()" ); 
	Util::log("id anuncio: ".$team_id); 

	$begin_time =   strtotime('+0 days');  
    $end_time   =   strtotime('+30 days'); 
	
	$sql	=	"update team set end_time= '$end_time', begin_time='$begin_time' where id=".$team_id;
	$rs 	= mysqli_query(DB::$mConnection,$sql);
	  
	if($rs){
		Util::log($team_id. " - Periodo de veiculacao do anuncio atualizados com sucesso");
	}
	else{
		Util::log($team_id. " - Erro ao atualizar o periodo de veiculacao do anuncio. ". mysqli_error(DB::$mConnection));
	} 
	
}

 
function estapago($team_id) {
  
 	$sql = "select id from pagamentos where team_id =".$team_id." and status_pagamento= 'Sucesso'";
    $rs = mysqli_query(DB::$mConnection,$sql);	
	if(mysqli_num_rows($rs) >0){
		return true;
	}
	  
}
function buscaParcelas() {
	$valor = $_REQUEST['valor'];
	
	$opcoes='	<option value="1">1</option>';
	if( ($valor/2) >= 5 ){ $opcoes.='	<option value="2">2</option>';}
	if( ($valor/3) >= 5 ){$opcoes.='	<option value="3">3</option>';}
	if( ($valor/4) >= 5 ){$opcoes.='	<option value="4">4</option>';}
	if( ($valor/5) >= 5 ){$opcoes.='	<option value="5">5</option>';}
	if( ($valor/6) >= 5 ){$opcoes.='	<option value="6">6</option>';}
	if( ($valor/7) >= 5 ){$opcoes.='	<option value="7">7</option>';}
	if( ($valor/8) >= 5 ){$opcoes.='	<option value="8">8</option>';}
	if( ($valor/9) >= 5 ){$opcoes.='	<option value="9">9</option>';}
	if( ($valor/10) >= 5 ){$opcoes.='	<option value="10">10</option>';}
	if( ($valor/11) >= 5 ){$opcoes.='	<option value="11">11</option>';}
	if( ($valor/12) >= 5 ){$opcoes.='	<option value="12">12</option>';}
	
	return $opcoes;
 	   
}
 
function verifica_regras_pre_compra() {
 
	$team = Table::Fetch('team', $_REQUEST['idoferta']);
	
	$ERROR 				=	"";
	$oferta_esgotada 	=  false;
	$end_time 			= date('YmdHis', $team['end_time']); 
	$date 				= date('YmdHis');
	
	$ex_con = array(
			'user_id' => $_REQUEST['idusuario'],
			'team_id' => $_REQUEST['idoferta'],
			'state' => 'unpay',
			);
	$order = DB::LimitQuery('order', array(
		'condition' => $ex_con,
		'one' => true,
	));
	if ( !$team ) { 
			$ERROR = 'Desculpe, esta oferta n�o existe mais em nossos registros' ;
			return utf8_encode($ERROR);
	}
	if (strtoupper($team['buyonce'])=='Y') {
		$ex_con['state'] = 'pay';
		if ( Table::Count('order', $ex_con) ) {
			$ERROR = 'Voc� j� comprou esta oferta. Informamos que para esta oferta, voc� s� pode comprar uma vez. Obrigado !';
			return utf8_encode($ERROR);
		}
	}
	if ($team['per_number']>0) {
		$now_count = Table::Count('order', array(
			'user_id' => $_REQUEST['idusuario'],
			'team_id' => $_REQUEST['idoferta'],
			'state' => 'pay',
		), 'quantity');
		
		$team['per_number'] -= $now_count;
		
		if ($team['per_number']<=0) {
			$ERROR = 'Voc� chegou ao limite de compra para esta oferta, por favor, d� uma olhada em outras ofertas!' ;
			return utf8_encode($ERROR);
		}
	}
	if( $team['begin_time']>time()){
		$ERROR = 'Desculpe, acabamos de adiar o in�cio desta oferta. Por favor, d� uma olhada em outras ofertas.' ;
		return utf8_encode($ERROR);
	}
	if ( $team['end_time']<=time() ) { 
		$ERROR = 'Desculpe, esta oferta acabou de finalizar. Por favor, d� uma olhada em outras ofertas.' ;
		return utf8_encode($ERROR);
	}
	if($_REQUEST['acao']!='participar'){
		if( $team['now_number'] >= $team['max_number'] ){ 
			$ERROR = 'Desculpe, esta oferta esgotou-se neste momento. Por favor, d� uma olhada em outras ofertas.' ;
			return utf8_encode($ERROR);
		 } 
	 }
	if($_REQUEST['acao']=='participar'){
		 if (strtoupper($team['buyonce'])=='Y') {
			$ex_con = array(
					'user_id' => $_REQUEST['idusuario'],
					'team_id' => $_REQUEST['idoferta'], 
					);
			$order = DB::LimitQuery('order', array(
				'condition' => $ex_con,
				'one' => true,
			));
			
			if ( Table::Count('order', $ex_con) ) {
				$ERROR = 'Voc� j� est� participando desta promo��o. Informamos que para esta promo��o, voc� s� pode participar uma vez. Obrigado !';
				return utf8_encode($ERROR);
			}
		}
		
	}
   
	return utf8_encode($ERROR);
}
function get_funcao_js() {
	global $login_user_id,$team,$INI;  
	
	if($login_user_id){
	 
		if(ePacote($team['id'])){
			$conteudo = getOfertasPacote($team['id']);
			$funcao_JS = "abreboxOfertasPacote('$conteudo');";
		}
		else if($team['processo_compra']=="" or $team['processo_compra']=="0"){
			$funcao_JS = "J('#dadospedido').submit();"; 
		}
		else{
			$funcao_JS = "calc(1);";
		}
	}
	else{
		if($team['processo_compra']=="" or $team['processo_compra']=="0"){
			$funcao_JS = "set_utm(0);"; 
		}
		else{
			$funcao_JS = "calc(),set_utm();";
		}
	}
	if($team['url_comprar']!=""){
		$funcao_JS = "envia_url_comprar();";
	}
	
	if($team['team_type'] =="participe"){
		if($login_user_id){
			$funcao_JS = "participar(1);";
		}
		else{
			$funcao_JS = "participar(),set_utm();";
		}
	
	}
	
	return $funcao_JS;
}
function atualiza_click($idoferta,$url=false) {
	
	global $login_user_id, $INI; 
	$dados  = Table::Fetch('team',$idoferta);
	
	
	$user_id =  $login_user_id; // user logado
	$category_id = $dados[group_id];
	
	$sql = "select clicados from team where id = $idoferta";
    $rs = mysqli_query(DB::$mConnection,$sql);	
	$linha = mysqli_fetch_object($rs);
	
	if($linha->clicados){
	     $sql = "update team set clicados = clicados + 1 where id = $idoferta";
		mysqli_query(DB::$mConnection,$sql);	
	}
	else{
		  $sql = "update team set clicados = 1 where id = $idoferta";
		mysqli_query(DB::$mConnection,$sql);
	}
	
	$ip =  $_SERVER['REMOTE_ADDR'];
	$data = date('Y-m-d H:i:s');
	 
	 
	$sql = "select * from user_category_recomendados where category_id = $category_id and user_id = $user_id";
    $rs = mysqli_query(DB::$mConnection,$sql);	
	$linha = mysqli_fetch_object($rs);
	
	if(mysqli_num_rows($rs) == 0){
	  //  echo $sql = "update user_category_recomendados set count = count + 1  where category_id = $category_id and user_id = $user_id";
	  "==".  $sql = "insert into user_category_recomendados (user_id,category_id) values ('$user_id','$category_id' )";
	  mysqli_query(DB::$mConnection,$sql);	
	}
	else {
		mysqli_error(DB::$mConnection);
	}
	 
	
	
}
function need_post() {
	return is_post() ? true : redirect(WEB_ROOT . '/index.php');
}
function need_manager($super=false) {
 
 	/*$sql =  "select manager from user where id = ".abs(intval($_SESSION['user_id']));
	$rs  = mysqli_query(DB::$mConnection,$sql);
	$row = mysqli_fetch_object($rs);
	
	if($row->manager=="Y"){
	 
		return true;
	}
	*/
	
	if ( ! is_manager() ) {
		redirect( WEB_ROOT . '/vipmin/login.php' );
	}
	 
	if ( ! $super ) return true;
	
	  
	if ( abs(intval($_SESSION['user_id'])) == 1 ) return true;
	return redirect( WEB_ROOT . '/vipmin/misc/index.php');
}

 
function need_anunciante($super=false) { 
  
	if($_SESSION['user_id']=="1"){
		return redirect( WEB_ROOT . '/adminanunciante/loginnegado.php');
	}
	 

	
	
	/* verificar trecho de codigo  31/01/2019 bruno */
	if ( abs(intval($_SESSION['user_id']))) {
		return true;
	}
	
	
	return redirect( WEB_ROOT . '/adminanunciante/login.php');
}
function need_partner() {
	return is_partner() ? true : redirect( WEB_ROOT . '/lojista/login.php');
}
function need_open($b=true) {
	if (true===$b) {
		return true;
	}
	if ($AJAX) json('Este recurso não está aberto', 'alert');
	Session::Set('error', 'Caracter�sticas p�gina que voc� visita n�o est� aberto');
	redirect( WEB_ROOT . '/index.php');
}
function getUltimoIdOferta() {
/*
	$sql 			=  "select id from team order by id desc limit 1";
	$rs  			= mysqli_query(DB::$mConnection,$sql);
	$row 			= mysqli_fetch_object($rs);
	$idofertateam 	= $row->id;
	
	$sql 			=  "select id from team order by id desc limit 1";
	$rs  			= mysqli_query(DB::$mConnection,$sql);
	$row 			= mysqli_fetch_object($rs);
	$idofertateam 	= $row->id;
	*/
	
	$sql 		=  "select valor from configuracao where campo='ultimo_id_oferta'";
	$rs  		= mysqli_query(DB::$mConnection,$sql);
	$row 		= mysqli_fetch_object($rs);
	$idoferta 	= $row->valor;
	
	if($idoferta==""){
		$idoferta=0;
	}
	
	$idnovaoferta = $idoferta + 1;
	
	mysqli_query(DB::$mConnection,"update configuracao set valor = '$idnovaoferta'  where campo='ultimo_id_oferta'");
	return $idnovaoferta;
	
}
function need_auth($b=true) {
    global $AJAX, $INI, $login_user;

																					 
											
								 
 
						
  
			  
	
 
    if (is_string($b)) {

        // Garante que $auths seja array
        $auths = isset($INI['authorization'][$login_user['id']]) ? $INI['authorization'][$login_user['id']] : [];

        // Checa se o usuário é manager ou possui a autorização
	
   
        $b = is_manager(true) || in_array($b, $auths);
    }

    if (true === $b) {
        return true;
    }

    if ($AJAX) {
        json('????', 'alert');
    }

    die(include template('manage_misc_noright'));
}

function is_manager($super=false, $weak=false) {
	global $login_user;
	
	/*$sql =  "select manager from user where id = ".abs(intval($_SESSION['user_id']));
	$rs  = mysqli_query(DB::$mConnection,$sql);
	$row = mysqli_fetch_object($rs);
	
	if($row->manager=="Y"){
	 
		return true;
	}*/
	
	if ( $weak===false &&( !$_SESSION['admin_id'] || $_SESSION['admin_id'] != $login_user['id']) ) {
		return false;
	}
	if ( ! $super ) return ($login_user['manager'] == 'Y');
	return $login_user['id'] == 1;
}
function is_partner() {
	return ($_SESSION['partner_id']>0);
}
function is_newbie(){ return (cookieget('newbie')!='N'); }
function is_get() { return ! is_post(); }
function is_post() {
	return strtoupper($_SERVER['REQUEST_METHOD']) == 'POST';
}
function is_login() {
	return isset($_SESSION['user_id']);
}
function get_loginpage($default=null) {
	$loginpage = Session::Get('loginpage', true);
	if ($loginpage)  return $loginpage;
	if ($default) return $default;
	return WEB_ROOT . '/index.php';
}
function cookie_city($city) {
 
}
function ename_city($ename=null) {
	return DB::LimitQuery('category', array(
		'condition' => array(
			'zone' => 'city',
			'ename' => $ename,
		),
		'one' => true,
	));
}
function cookieset($k, $v, $expire=0) {
	$pre = substr(md5($_SERVER['HTTP_HOST']),0,4);
	$k = "{$pre}_{$k}";
	if ($expire==0) {
		$expire = time() + 365 * 86400;
	} else {
		$expire += time();
	}
	setCookie($k, $v, $expire, '/');
}
function cookieget($k, $default='') {
	$pre = substr(md5($_SERVER['HTTP_HOST']),0,4);
	$k = "{$pre}_{$k}";
	return isset($_COOKIE[$k]) ? strval($_COOKIE[$k]) : $default;
}
function moneyit($k) {
    return rtrim(rtrim(sprintf("%1.2f",$k), ' '), '.');
    }
function moneyit2($k) {
$moeda2 = number_format($k, '0');  
return rtrim($moeda2);
}
function moneyit3($k) {
$moeda3 = number_format($k, 2, ',', '.'); 
return rtrim($moeda3);
}
 
function debug($v, $e=false) {
	global $login_user_id;
	if ($login_user_id==100000) {
		echo "<pre>";
		var_dump( $v);
		if($e) exit;
	}
}
function getparam($index=0, $default=0) {
	if (is_numeric($default)) {
		$v = abs(intval($_GET['param'][$index]));
	} else $v = strval($_GET['param'][$index]);
	return $v ? $v : $default;
}
function getpage() {
	$c = abs(intval($_GET['page']));
	return $c ? $c : 1;
}
function pagestring($count, $pagesize, $wap=false) {
	$p = new Pager($count, $pagesize, 'page');
	if ($wap) {
		return array($pagesize, $p->offset, $p->genWap());
	}
	return array($pagesize, $p->offset, $p->genBasic());
}
function uencode($u) {
	return base64_encode(urlEncode($u));
}
function udecode($u) {
	return urlDecode(base64_decode($u));
}
function share_facebook($team) {
	global $login_user_id;
	global $INI;
	if ($team)  {
		$query = array(
				'u' => $INI['system']['wwwprefix'] . "/team.php?id={$team['id']}&r={$login_user_id}",
				't' => $team['title'],
				);
	}
	else {
		$query = array(
				'u' => $INI['system']['wwwprefix'] . "/r.php?r={$login_user_id}",
				't' => $INI['system']['sitename'] . '(' .$INI['system']['wwwprefix']. ')',
				);
	}
	$query = http_build_query($query);
	return 'http://www.facebook.com/sharer.php?'.$query;
}
 
function share_twitter($team) {
	global $login_user_id;
	global $INI;
	if ($team)  {
		$query = array(
				'status' => $INI['system']['wwwprefix'] . "/team.php?id={$team['id']}&r={$login_user_id}" . ' ' . $team['title'],
				);
	}
	else {
		$query = array(
				'status' => $INI['system']['wwwprefix'] . "/r.php?r={$login_user_id}" . ' ' . $INI['system']['sitename'] . '(' .$INI['system']['wwwprefix']. ')',
				);
	}
	$query = http_build_query($query);
	return 'http://twitter.com/?'.$query;
}
 
function share_renren($team) {
	global $login_user_id;
	global $INI;
	if ($team)  {
		$query = array(
				'link' => $INI['system']['wwwprefix'] . "/team.php?id={$team['id']}&r={$login_user_id}",
				'title' => $team['title'],
				);
	}
	else {
		$query = array(
				'link' => $INI['system']['wwwprefix'] . "/r.php?r={$login_user_id}",
				'title' => $INI['system']['sitename'] . '(' .$INI['system']['wwwprefix']. ')',
				);
	}
	$query = http_build_query($query);
	return 'http://share.renren.com/share/buttonshare.do?'.$query;
}
function share_kaixin($team) {
	global $login_user_id;
	global $INI;
	if ($team)  {
		$query = array(
				'rurl' => $INI['system']['wwwprefix'] . "/team.php?id={$team['id']}&r={$login_user_id}",
				'rtitle' => $team['title'],
				'rcontent' => strip_tags($team['summary']),
				);
	}
	else {
		$query = array(
				'rurl' => $INI['system']['wwwprefix'] . "/r.php?r={$login_user_id}",
				'rtitle' => $INI['system']['sitename'] . '(' .$INI['system']['wwwprefix']. ')',
				'rcontent' => $INI['system']['sitename'] . '(' .$INI['system']['wwwprefix']. ')',
				);
	}
	$query = http_build_query($query);
	return 'http://www.kaixin001.com/repaste/share.php?'.$query;
}
function share_douban($team) {
	global $login_user_id;
	global $INI;
	if ($team)  {
		$query = array(
				'url' => $INI['system']['wwwprefix'] . "/team.php?id={$team['id']}&r={$login_user_id}",
				'title' => $team['title'],
				);
	}
	else {
		$query = array(
				'url' => $INI['system']['wwwprefix'] . "/r.php?r={$login_user_id}",
				'title' => $INI['system']['sitename'] . '(' .$INI['system']['wwwprefix']. ')',
				);
	}
	$query = http_build_query($query);
	return 'http://www.douban.com/recommend/?'.$query;
}
function tratanome($title){
	$var = str_replace("[����]","A", utf8_decode($title) );
	$var = str_replace("[����]","a",$var);
	$var = str_replace("[���]","E",$var);
	$var = str_replace("[���]","e",$var);
	$var = str_replace("[�]","I",$var);
	$var = str_replace("[����]","O",$var);
	$var = str_replace("[�����]","o",$var);
	$var = str_replace("[���]","U",$var);
	$var = str_replace("[�]","i",$var);
	$var = str_replace("[���]","u",$var);
	$var = str_replace("�","C",$var);
	$var = str_replace("�","c",$var);
	return $var;
}
 
 
function urlamigavel($nome){
	return  str_replace("++","+",utf8_decode(str_replace("r$","",strtolower(str_replace("-","",str_replace("'","",str_replace(",","",str_replace("!","",str_replace("/","",str_replace("%","",str_replace(".","",str_replace(" ","+",$nome)))))))))))) ;
}
function share_sina($team) {
	global $login_user_id;
	global $INI;
	if ($team)  {
		$query = array(
				'url' => $INI['system']['wwwprefix'] . "/team.php?id={$team['id']}&r={$login_user_id}",
				'title' => $team['title'],
				);
	}
	else {
		$query = array(
				'url' => $INI['system']['wwwprefix'] . "/r.php?r={$login_user_id}",
				'title' => $INI['system']['sitename'] . '(' .$INI['system']['wwwprefix']. ')',
				);
	}
	$query = http_build_query($query);
	return 'http://v.t.sina.com.cn/share/share.php?'.$query;
}
function share_mail($team) {
	global $login_user_id;
	global $INI;
	if (!$team) {
		$team = array(
				'title' => $INI['system']['sitename'] . '(' . $INI['system']['wwwprefix'] . ')',
				);
	}
	$pre[] = "Found a good site--{$INI['system']['sitename']}?Every day is a New deal!";
	if ( $team['id'] ) {
		$pre[] = "Customers today are:{$team['title']}";
		$pre[] = "I think you will be interested in:";
		$pre[] = $INI['system']['wwwprefix'] . "/team.php?id={$team['id']}&r={$login_user_id}";
		 
		$sub = "You are interested in?{$team['title']}";
	} else {
		$sub = $pre[] = $team['title'];
	}
	$sub = mb_convert_encoding($sub, 'GBK', 'UTF-8');
	$query = array( 'subject' => $sub, 'body' => $pre, );
	$query = http_build_query($query);
	return 'mailto:?'.$query;
}
function domainit($url) {
	if(strpos($url,'//')) { preg_match('#[//]([^/]+)#', $url, $m);
} else { preg_match('#[//]?([^/]+)#', $url, $m); }
return $m[1];
}
function getDomino($email){
	$email = explode("@",$email);
	return $email[1];	
} 
 
if(! function_exists ( 'checkdnsrr' )){ 
	function checkdnsrr ( $host , $type = '' ){ 
		if(!empty( $host )){ 
			$type = (empty( $type )) ? 'MX' : $type ; 
			exec ( 'nslookup -type=' . $type . ' ' . escapeshellcmd ( $host ), $result ); 
			$it = new ArrayIterator ( $result ); 
			foreach(new RegexIterator ( $it , '~^' . $host . '~' , RegexIterator :: GET_MATCH ) as $result ){ 
				if( $result ){ 
					return true ; 
				} 
			} 
		} 
		return false ; 
	} 
}
function RecursiveMkdir($path) {
	if (!file_exists($path)) {
		RecursiveMkdir(dirname($path));
		@mkdir($path, 0777,true);
	}
	 
}
function need_login($wap=false) {
	if ( isset($_SESSION["user_id"]) ) {
		if (is_post()) {
			unset($_SESSION["loginpage"]);
			unset($_SESSION["loginpagepost"]);
		}
		return $_SESSION["user_id"];
	}
 
	$_SESSION["loginpagepost"] = $_SERVER["REQUEST_URI"];
	 
	if (true===$wap) {
		return redirect(WEB_ROOT . "/wap/login.php");
	}
 
	return redirect(WEB_ROOT . "/index.php?acao=needlogin");
}
function user_image($image=null) {
global $INI;
	if (!$image) {
		return $INI['system']['imgprefix'] . '/media/img/user-no-avatar.gif';
	}
	return $INI['system']['imgprefix'] . '/media/' .$image;
}
function team_image($image=null, $index=false) {
	global $INI;
	if (!$image) return null;
	if ($index) {
		$path = WWW_ROOT . '/media/' . $image;
		$image = preg_replace('#(\d+)\.(\w+)$#', "\\1_index.\\2", $image);
		$dest = WWW_ROOT . '/media/' . $image;
		if (!file_exists($dest) && file_exists($path) ) {
			Image::Convert($path, $dest, 200, 120, Image::MODE_SCALE);
		}
	}
	return $INI['system']['imgprefix'] . '/media/' .$image;
}
function userreview($content) {
	$line = preg_split("/[\n\r]+/", $content, -1, PREG_SPLIT_NO_EMPTY);
	$r = '<ul>';
	foreach($line AS $one) {
		$c = explode('|', htmlspecialchars($one));
		$c[2] = $c[2] ? $c[2] : '/';
		$r .= "<li>{$c[0]}<span><a href=\"{$c[2]}\" target=\"_blank\">{$c[1]}</a>";
		$r .= ($c[3] ? "?{$c[3]}?":'') . "</span></li>\n";
	}
	return $r.'</ul>';
}
function invite_state($invite) {
	if ('Y' == $invite['pay']) return 'J� comprou';
	if ('C' == $invite['pay']) return 'N�o Aprovado';
	if ('N' == $invite['pay'] && $invite['buy_time']) return 'Ainda n�o comprou';
	if (time()-$invite['create_time']>7*86400) return 'Expirado';
	return 'N�o Comprei';
}
function team_state(&$team) {
	if ( $team['now_number'] >= $team['min_number'] ) {
		if ($team['max_number']>0) {
			if ( $team['now_number']>=$team['max_number'] ){
				if ($team['close_time']==0) {
					$team['close_time'] = $team['end_time'];
				}
				return $team['state'] = 'soldout';
			}
		}
		if ( $team['end_time'] <= time() ) {
			$team['close_time'] = $team['end_time'];
		}
		return $team['state'] = 'success';
	} else {
		if ( $team['end_time'] <= time() ) {
			$team['close_time'] = $team['end_time'];
			return $team['state'] = 'failure';
		}
	}
	return $team['state'] = 'none';
}
 
function state_explain($team, $error='false') {
	$state = team_state($team);
	$state = strtolower($state);
	switch($state) {
		case 'none': return 'Oferta em curso';
		case 'soldout': return 'Oferta esgotada';
		case 'failure': if($error) return 'Oferta n�o atingiu min. de compradores';
		case 'success': return 'Sucesso na oferta';
		default: return 'Oferta Finalizada';
	}
}
function get_zones($zone=null) {
	$zones = array(
			'city' => 'Cidade',
			'group' => 'Categoria',
			//'public' => 'Categoria do Forum',
			//'grade' => 'User Grade',
			//'express' => 'Express',
			'partner' => 'Categoria de parceria',
			);
	if ( !$zone ) return $zones;
	if (!in_array($zone, array_keys($zones))) {
		$zone = 'city';
	}
	return array($zone, $zones[$zone]);
}
 
function down_xls($data, $keynames, $name='dataxls') {
	$xls[] = "<html><meta http-equiv=content-type content=\"text/html; charset=UTF-8\"><body><table border='1'>";
	$xls[] = "<tr><td>ID</td><td>" . implode("</td><td>", array_values($keynames)) . '</td></tr>';
	foreach($data As $o) {
		$line = array(++$index);
		foreach($keynames AS $k=>$v) {
			$line[] = $o[$k];
		}
		$xls[] = '<tr><td>'. implode("</td><td>", $line) . '</td></tr>';
	}
	$xls[] = '</table></body></html>';
	$xls = join("\r\n", $xls);
	header('Content-Disposition: attachment; filename="'.$name.'.xls"');
	die(mb_convert_encoding($xls,'UTF-8','UTF-8'));
}
function option_hotcategory($zone='city', $force=false, $all=false) {
	$cates = option_category($zone, $force, true);
	$r = array();
	foreach($cates AS $id=>$one) {
		if ('Y'==strtoupper($one['display'])) $r[$id] = $one;
	}
	return $all ? $r: Utility::OptionArray($r, 'id', 'name');
}
function option_category($zone='city', $force=false, $all=false) {
	$cache = $force ? 0 : 86400*30;
	$cates = DB::LimitQuery('category', array(
		'condition' => array( 'zone' => $zone, ),
		'order' => 'ORDER BY sort_order DESC, id DESC',
		'cache' => $cache,
	));
	$cates = Utility::AssColumn($cates, 'id');
	return $all ? $cates : Utility::OptionArray($cates, 'id', 'name');
}
function option_yes($n, $default=false) {
	global $INI;
	if (false==isset($INI['option'][$n])) return $default;
	$flag = trim(strval($INI['option'][$n]));
	return abs(intval($flag)) || strtoupper($flag) == 'Y';
}
function option_yesv($n, $default='N') {
	return option_yes($n, $default=='Y') ? 'Y' : 'N';
}
function team_discount($team, $save=false) {
	if ($team['market_price']<0 || $team['team_price']<0 ) {
		return '?';
	}
	return moneyit((10*$team['team_price']/$team['market_price']));
}
function desconto($team_price, $market_price) {
	 
	return moneyit((10*$team_price/$market_price));
}
function team_origin($team, $quantity=0) {
	$origin = $quantity * $team['team_price'];
	if ($team['delivery'] == 'express'
			&& ($team['farefree']==0 || $quantity < $team['farefree'])
		) {
			$origin += $team['fare'];
		}
	return $origin;
}
function error_handler($errno, $errstr, $errfile, $errline) {
	switch ($errno) {
		case E_PARSE:
		case E_ERROR:
			echo "<b>Fatal ERROR</b> [$errno] $errstr<br />\n";
			echo "Fatal error on line $errline in file $errfile";
			echo "PHP " . PHP_VERSION . " (" . PHP_OS . ")<br />\n";
			exit(1);
			break;
		default: break;
	}
	return true;
}
function obscure_rep($u) {
	if(!option_yes('encodeid')) return $u;
	if(preg_match('#/vipmin/#', $_SERVER['REQUEST_URI'])) return $u;
	return preg_replace_callback('#(\?|&)id=(\d+)(\b)#i', obscure_cb, $u);
}
function obscure_did() {
	$gid = strval($_GET['id']);
	if ($gid && strpos($gid, 'WR')===0) {
		$_GET['id'] = base64_decode(substr($gid,2))>>2;
	}
}
function obscure_cb($m) {
	$eid = obscure_eid($m[2]);
	return "{$m[1]}id={$eid}{$m[3]}";
}
function obscure_eid($id) {
	return 'WR'.base64_encode($id<<2);
}
obscure_did();
function trimarray($o) {
	if (!is_array($o)) return trim($o);
	foreach($o AS $k=>$v) { $o[$k] = trimarray($v); }
	return $o;
}
$_POST = trimarray($_POST);
set_error_handler('error_handler');
function img_parceiro() {
	return ($_SESSION['partner_id']>0);
}
/*
function exibe_filhos($id_categoria, $indent='',$idpai=false,$id=false){
 
 	if($id){
		$aux =  " and id <> ".$id;
	}
													
	$sql = "select name, id from category where idpai=$id_categoria  $aux order by name ASC";
	$rs = mysqli_query(DB::$mConnection,$sql);

	echo "<div class='optionfilhas'>";
	
	while($l = mysqli_fetch_assoc($rs)){
	    $selected ="";
		if($idpai == $l['id']){
				$selected =  " selected ";
		}

		echo "<div data-id='".$l['id']."' class='filha option ".$selected."'>".htmlentities($l['name'])."</div>";
	}

	echo "</div>";
}*/

function exibe_filhos($id_categoria, $indent='',$idpai=false,$id=false){
 
 	if($id){
			$aux =  " and id <> ".$id;
	}
													
	$sql = "select * from category where idpai = $id_categoria $aux order by sort_order desc";
	$rs = mysqli_query(DB::$mConnection,$sql);
	
	while($l = mysqli_fetch_assoc($rs)){
	    $selected ="";
		if($idpai == $l['id']){
				$selected =  " selected ";
		}
		$tipocategoria = $l['tipo'];
		$nomecategoria = $l['name'];
		
		if($tipocategoria=="")
		
		echo "<option value='" . $l['id'] . "'" . $selected . ">" . $indent .  utf8_decode($l['name']) . "</option>";
		exibe_filhos($l["id"], $indent . $indent,$idpai,$id);
	}
}

function exibe_filhos_m($id_categoria, $indent='',$idpai=false,$id=false){
 
 	if($id){
			$aux =  " and id <> ".$id;
	}
													
	$sql = "select * from category where idpai=$id_categoria   $aux order by sort_order desc";
	$rs = mysqli_query(DB::$mConnection,$sql);
	
	while($l = mysqli_fetch_assoc($rs)){
	    $selected ="";
		if($idpai == $l['id']){
				$selected =  " selected ";
		}
		$tipocategoria = $l['tipo'];
		$nomecategoria = $l['name'];
		
		if($tipocategoria=="")
		
		echo "<option value='" . $l['id'] . "'" . $selected . ">" . $indent .  utf8_decode($l['name']) . "</option>";
		exibe_filhos($l["id"], $indent . $indent,$idpai,$id);
	}
}


function exibe_filhos_page($id_categoria, $indent='',$idpai=false){
 
  
	$sql = "select * from category where idpai=$id_categoria";
	$rs = mysqli_query(DB::$mConnection,$sql);
	
	while($l = mysqli_fetch_assoc($rs)){
	    $selected ="";
		if($idpai == $l['id']){
				$selected =  " selected ";
		}
		echo "<option value='$l[id]' $selected  >$indent $l[name]</option>";
		exibe_filhos($l["id"], $indent . $indent,$idpai,$id);
	}
}
	
function getImagem($team,$aux=false){
	global $INI, $ROOTPATH; 

	$images = "";

   /* verificar esse trecho de codigo abaixo  31/01/2019  estava no site clubdevenda.com.br
	if($aux== "popular"){ 
		$imgbase = substr($team['estatica_home'],0,-4)."_estatica_home.jpg";
		if(file_exists(WWW_ROOT."/media/".$imgbase)){
			return $INI['system']['wwwprefix']."/media/".$imgbase;
		} 
	}
	else if($aux== "lateral"){ 
		$imgbase = substr($team['estatica_direita'],0,-4)."_estatica_direita.jpg";
		if(file_exists(WWW_ROOT."/media/".$imgbase)){
			return $INI['system']['wwwprefix']."/media/".$imgbase;
		} 
	}
	else if($aux=="detalhe"){ 
		$imgbase = substr($team['estatica_detalhe'],0,-4)."_estatica_detalhe.jpg";
		if(file_exists(WWW_ROOT."/media/".$imgbase)){
			return $INI['system']['wwwprefix']."/media/".$imgbase;
		} 
	}
	 
	 if($aux != ""){
		 $aux = "_".$aux;
	  }
	  
	  if(!$team['image']){
		return $INI['system']['wwwprefix']."/skin/padrao/images/semfoto.jpg";
	  }
	  else{
		return $INI['system']['wwwprefix']."/media/".substr($team['image'],0,-4).$aux.".jpg";
	 }
   
    /* fim trecho de codigo */


	$sql = "SELECT * FROM team_fotos WHERE team_id = ".$team['id']." limit 8";
	$imgs = mysqli_query(DB::$mConnection,$sql);

	if(mysqli_num_rows($imgs) > 0){
		while($img = mysqli_fetch_assoc($imgs)){
			$images .= "<li><img  title='".$team['title']."' alt='".$team['title']."' src='".$ROOTPATH."/media/team/".$img['img']."'' /></li>";
		}
	}else{
		$images .= "<li><img  title=".$team['title']." alt=".$team['title']." src=".semImg()." /></li>";
	}

	return $images;
	
}

function getImagemMobile($team,$aux=false){
	global $INI, $ROOTPATH; 

	$images = "";

	$sql = "SELECT * FROM team_fotos WHERE team_id = ".$team['id']." limit 8";
	$imgs = mysqli_query(DB::$mConnection,$sql);

	if(mysqli_num_rows($imgs) > 0){
		while($img = mysqli_fetch_assoc($imgs)){
			$images .= "<li><img  title='".$team['title']."' alt='".$team['title']."' src='".str_replace("/mobile", "", $ROOTPATH)."/media/team/".$img['img']."'' /></li>";
		}
	}else{
		$images .= "<li><img  title=".$team['title']." alt=".$team['title']." src=".semImg()." /></li>";
	}

	return $images;
	
}

function getImageFeature($team){
	global $INI, $ROOTPATH; 

	$sql = "SELECT * FROM team_fotos WHERE team_id = ".$team['id']." limit 1";
	$imgs = mysqli_query(DB::$mConnection,$sql);

	if(mysqli_num_rows($imgs) > 0){
		while($img = mysqli_fetch_assoc($imgs)){
			$image .= "<img class='image' src='$ROOTPATH/media/team/".$img['img']."' alt='".$team['title']."'>";
		}
	}else{
		$image .= "<img class='image' title=".$team['title']." alt=".$team['title']." src=".semImg()." />";
	}

	return $image;
	
}

function getImageFeatureMobile($team){
	global $INI, $ROOTPATH; 

	$sql = "SELECT * FROM team_fotos WHERE team_id = ".$team['id']." limit 1";
	$imgs = mysqli_query(DB::$mConnection,$sql);

	if(mysqli_num_rows($imgs) > 0){
		while($img = mysqli_fetch_assoc($imgs)){
			$image .= "<img class='image' src='".str_replace("/mobile", "", $ROOTPATH)."/media/team/".$img['img']."' alt='".$team['title']."'>";
		}
	}else{
		$image .= "<img class='image' title=".$team['title']." alt=".$team['title']." src=".semImg()." />";
	}

	return $image;
	
}

//superbanner
function getsuperslide(){ 
			    
		global $ROOTPATH ;
		
		$dir =  WWW_ROOT."/media/superbackground";
		$dh =  opendir($dir);
		
		if($dh){
		  
			while ($file = readdir($dh)){
			
				if($file =="." or $file == ".." or $file =="thumbs"){
					continue;
				} 
				$itens[] = $file ; 
			} 
			
			sort($itens);
			
			foreach ($itens as $file) {
			
			  if(strtolower($file) == "thumbs.db"){ continue; }
				$imagens.="{image :  '$ROOTPATH/media/superbackground/".trim($file)."', title : 'teste', thumb : 'teste', url : '$ROOTPATH/media/superbackground/".trim($file)."'},";
			 } 
			
		}
		$imagens = substr($imagens, 0, -1); 
	return 	$imagens;
}
function calculaFrete($cod_servico, $cep_origem, $cep_destino, $peso, $altura, $largura, $comprimento, $valor_declarado)
{
    #OFICINADANET###############################
    # C�digo dos Servi�os dos Correios
    # 41106 PAC sem contrato
    # 40010 SEDEX sem contrato
    # 40045 SEDEX a Cobrar, sem contrato
    # 40215 SEDEX 10, sem contrato
    ############################################
	  
	$cod_servico = 41106;
	$valor_declarado = number_format($valor_declarado, 2, ',', '.');
	 
    $correios = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?nCdEmpresa=&sDsSenha=&sCepOrigem=".$cep_origem."&sCepDestino=".$cep_destino."&nVlPeso=".$peso."&nCdFormato=1&nVlComprimento=".$comprimento."&nVlAltura=".$altura."&nVlLargura=".$largura."&sCdMaoPropria=n&nVlValorDeclarado=". $valor_declarado ."&sCdAvisoRecebimento=n&nCdServico=".$cod_servico."&nVlDiametro=0&StrRetorno=xml";
    $xml = simplexml_load_file($correios);
    if($xml->cServico->Erro == '0')
        return $xml->cServico->Valor;
    else
        return false;
}
function getCepDestino($dados){ 
	if(empty($dados['entrega_cep'])){
			return $dados['zipcode'];
	 }
	else{
		return $dados['entrega_cep'];
	}
	
}
function getEnderecoClienteEntrega($dados){ 
	  
	if(empty($dados['entrega_endereco'])){
			getEnderecoClienteCobranca($dados);
			return;
	}
	$endereco = ucfirst(utf8_decode($dados['entrega_endereco'])). ", ".ucfirst($dados['entrega_numero']);
	if($dados['entrega_complemento']!=""){
		$endereco.= " ".ucfirst(utf8_decode($dados['entrega_complemento']));
	}
	$endereco .=  ", ".ucfirst(utf8_decode($dados['entrega_bairro'])). ", ".ucfirst(utf8_decode($dados['entrega_cidade'])). " - ".strtoupper(utf8_decode($dados['entrega_estado'])). " - ".$dados['entrega_cep'];
	echo $endereco ;
 
}
function getEnderecoClienteCobranca($dados){ 
	
	if(empty($dados['cobranca_endereco'])){
			getEnderecoCliente($dados);
			return;
	}
	
	$endereco = ucfirst(utf8_decode($dados['cobranca_endereco'])). ", ".ucfirst($dados['cobranca_numero']);
	if($dados['cobranca_complemento']!=""){
		$endereco.= " ".ucfirst(utf8_decode($dados['cobranca_complemento']));
	}
	$endereco .=  ", ".ucfirst(utf8_decode($dados['cobranca_bairro'])). ", ".ucfirst(utf8_decode($dados['cobranca_cidade'])). " - ".strtoupper(utf8_decode($dados['cobranca_estado'])). " - ".$dados['cobranca_cep'];
	echo $endereco ;
 
}
function getEnderecoCliente($dados){ 
	
	$endereco = ucfirst(utf8_decode($dados['address'])). ", ".ucfirst(utf8_decode($dados['bairro'])). ", ".ucfirst(utf8_decode($dados['cidadeusuario'])). " - ".strtoupper($dados['estado']). " - ".$dados['zipcode'];
	echo $endereco ;
 
}
function displaySubStringWithStrip($string, $length=NULL)
{
    if ($length == NULL)
            $length = 50;
   
    $stringDisplay = substr(strip_tags($string), 0, $length);
    if (strlen(strip_tags($string)) > $length)
        $stringDisplay .= ' ...';
    return $stringDisplay;
}
function verificarepublicacao($republicacao,$left_hour,$left_day){
	if($republicacao=="1"){
			if($left_day >1 ){
				$left_day = 0;
				$hora_corrente =  date("H"); 
				$left_hour = 23  - $hora_corrente ;  
				return $left_hour;
		}
	}
	return $left_hour;
}
function getEnderecoEntregaPedido($dados){ 
	   
	$endereco = ucfirst($dados['entrega_endereco']). ", ".ucfirst($dados['entrega_numero']);
	if($dados['entrega_complemento']!=""){
		$endereco.= " ".ucfirst($dados['entrega_complemento']);
	}
	$endereco .=  ", ".ucfirst( $dados['entrega_bairro'] ). ", ".ucfirst($dados['entrega_cidade']). " - ".strtoupper($dados['entrega_estado']). " - ".$dados['entrega_cep'];
	echo $endereco ;
 
}
function getEnderecoEntregaPedidoUser($dados){ 
	   
	$endereco = ucfirst(utf8_decode($dados['entrega_endereco'])). ", ".ucfirst($dados['entrega_numero']);
	if($dados['entrega_complemento']!=""){
		$endereco.= " ".ucfirst(utf8_decode($dados['entrega_complemento']));
	}
	$endereco .=  ", ".ucfirst(utf8_decode($dados['entrega_bairro'])). ", ".ucfirst(utf8_decode($dados['entrega_cidade'])). " - ".strtoupper(utf8_decode($dados['entrega_estado'])). " - ".$dados['entrega_cep'];
	echo $endereco ;
 
}
 
function getEnderecoCobrancaPedido($dados){ 
  
	$endereco = ucfirst($dados['cobranca_endereco']). ", ".ucfirst($dados['cobranca_numero']);
	if($dados['cobranca_complemento']!=""){
		$endereco.= " ".ucfirst($dados['cobranca_complemento']);
	}
	$endereco .=  ", ".ucfirst($dados['cobranca_bairro']). ", ".ucfirst($dados['cobranca_cidade']). " - ".strtoupper($dados['cobranca_estado']). " - ".$dados['cobranca_cep'];
	echo $endereco ;
 
}
function data($var){
	return date('d/m/Y', strtotime($var));
}
function getEnderecoCobrancaPedidoAdmin($idpedido){ 
  
	$dados  = Table::Fetch('order_enderecos',$idpedido,'idpedido');
  
	$endereco = ucfirst($dados['cobranca_endereco']). ", ".ucfirst($dados['cobranca_numero']);
	if($dados['cobranca_complemento']!=""){
		$endereco.= " ".ucfirst($dados['cobranca_complemento']);
	}
	$endereco .=  ", ".ucfirst($dados['cobranca_bairro']). ", ".ucfirst($dados['cobranca_cidade']). " - ".strtoupper($dados['cobranca_estado']). " - ".$dados['cobranca_cep'];
	echo $endereco ;
 
}
function getEnderecoEntregaPedidoAdmin($idpedido){ 
	   
	 $dados  = Table::Fetch('order_enderecos',$idpedido,'idpedido');
	   
	$endereco = ucfirst($dados['entrega_endereco']). ", ".ucfirst($dados['entrega_numero']);
	if($dados['entrega_complemento']!=""){
		$endereco.= " ".ucfirst($dados['entrega_complemento']);
	}
	$endereco .=  ", ".ucfirst( $dados['entrega_bairro'] ). ", ".ucfirst($dados['entrega_cidade']). " - ".strtoupper($dados['entrega_estado']). " - ".$dados['entrega_cep'];
	echo $endereco ;
 
}

function geraBreadcrumb( ){ 
	   global $city,$INI;

	$linkcidade =  "<a  class='breadlink' href='".$INI['system']['wwwprefix']."/". strtolower(str_replace(" ","-",utf8_decode($city['name'])))."/ofertas/". $city['id']."'>".utf8_decode($city['name'])."</a>";
	$idcategoria = $_REQUEST['idcategoria'];

	if($idcategoria and empty($_POST['cppesquisa'])){
			$linkcategoria .= getDadosPai($idcategoria);
			$linkcategoria .=  "<a class='breadlink' href='".$INI['system']['wwwprefix']."/index.php?idcategoria=$idcategoria'>".utf8_decode($categoria['name'])."</a>";
			$Breadcrumb = $linkcidade.$linkcategoria;
	}
	else{
		$Breadcrumb = $linkcidade ;
	}
	 echo $Breadcrumb;
}


function getDadosPai($id){

	$linkcategoria = "";

	while($id != 0 and !is_null($id)){
		$categoria  = Table::Fetch('category',$id);
		$linkcategoria = "<span style='font-size:13px;face:verdana;color:#ccc'> ></span> <a class='breadlink' href='".$INI['system']['wwwprefix']."/index.php?idcategoria=$id'>".utf8_decode($categoria['name'])."</a> ".$linkcategoria;
		$id = $categoria['idpai'];
	}

	return $linkcategoria;
}

//bannerslideshow
function getbannerslideshow(){ 
			    
		global $ROOTPATH ;
		
		$dir =  WWW_ROOT."/media/slideshowbanners";
		$dh =  opendir($dir);
		
		if($dh){
		  
			while ($file = readdir($dh)){
			
				if($file =="." or $file == ".." or $file =="thumbs"){
					continue;
				} 
				$itens[] = $file ; 
			} 
			
			sort($itens);
			
			foreach ($itens as $file) {
				if(strtolower($file) == "thumbs.db"){ continue; }
				$imagens.="<li><a href='#cubeJelly'><img src='$ROOTPATH/media/slideshowbanners/".trim($file)."' class='cubeJelly' /></a></li>";
			 } 
			
		} 
		
	return 	$imagens;
}
function getImagemDestaque($estatica){ 
		global $INI;  
		$imgbaseestatica = substr($estatica,0,-4)."_imgdestaque.jpg";   
		if(file_exists(WWW_ROOT."/media/".$imgbaseestatica)){ 
			return $INI['system']['wwwprefix']."/media/".$imgbaseestatica;
		}
}		
function conecta(){
	global $INI;
	mysqli_connect($INI['db']['host'],$INI['db']['user'], $INI['db']['pass'],$INI['db']['name']) or die(mysqli_error(DB::$mConnection));
	//mysql_select_db($INI['db']['name']) or die(mysqli_error(DB::$mConnection));		
}
function gravaplano($partner_id,$idplano,$status,$idanuncio){ 
 																   
		if($idplano){
			$data = date("Y-m-d H:i:s");
			$dias 	= getdiasplano($idplano);
			$planos_publicacao = Table::Fetch('planos_publicacao',$idplano); 
			$qtdeanuncio = $planos_publicacao["qtdeanuncio"];
			$sql	=	"INSERT INTO `partner_planos`( partner_id,data, plano_id,dias,status,qtdeanuncio ) values ( '".$partner_id."','".$data."','".$idplano."','".$dias."','$status','$qtdeanuncio')";
			$rs 	=  mysqli_query(DB::$mConnection,$sql); 
			if(!$rs){
				echo "$data -  Não foi possível inserir este plano $idplano em partner_planos.".mysqli_error(DB::$mConnection);
				Util::log($_REQUEST['team_id']. " -  Nao foi possivel inserir este plano $idplano em partner_planos.".mysqli_error(DB::$mConnection));
			}
			else{
				Util::log($_REQUEST['team_id']. " -  Plano $idplano inserido com sucesso na tabela partner_planos para anunciante $partner_id");
				$partner_plano_id = mysqli_insert_id(DB::$mConnection);
				atualiza_partner_plano_id($idanuncio,$partner_plano_id);
			}
		}
}

function atualiza_partner_plano_id($idanuncio,$partner_plano_id){
	  
	 Util::log("atualiza_partner_plano_id() - idanuncio:  $idanuncio - partner_plano_id: $partner_plano_id");
      if($idanuncio != ""){
		$sql	=	"update team set partner_plano_id = $partner_plano_id where id=".$idanuncio;
		$rs     =  mysqli_query(DB::$mConnection,$sql); 
		Util::log("$sql");
	 }
	 else{
		Util::log("Nao precisa atualizar o partner_plano_id da oferta uma vez que o usuario esta adquirindo o plano na area publica");
	 } 
 
}

function grava_id_plano(){
	 	if($_REQUEST['id_plano']){
			$sql	=	"update team set id_plano='".$_REQUEST['id_plano']."' where id=".$_REQUEST['team_id'];
			$rs 	=  mysqli_query(DB::$mConnection,$sql);
			if(!$rs){ 
				Util::log("  grava_id_plano.".mysqli_error(DB::$mConnection));
			}
			else{
				Util::log("grava_id_plano: ". $sql); 
			}
		}
}
function get_partner_plano_id($anuncianteid){
	 Util::log("get_partner_plano_id()" ); 
	 Util::log("ID anunciante: ".$anuncianteid); 
	 $sql = "select * from partner_planos where partner_id = $anuncianteid order by id desc limit 1";
	 $rs = mysqli_query(DB::$mConnection,$sql);
	 $row =  mysqli_fetch_assoc($rs);
	 $partner_plano_id = $row[id]; 
	 Util::log($sql); 
	 Util::log("partner_plano_id :".$partner_plano_id ); 
	 return  $partner_plano_id; 
}
function busca_plano_cliente($partner_id){ 
	/*
	$sql = "select plano_id from partner_planos where status in ('gratis','pago','') and partner_id = $partner_id order by id DESC limit 1"; 
    $rs = mysqli_query(DB::$mConnection,$sql);
	if(!$rs){
		Util::log("Erro na consulta do ultimo plano contratado para o cliente: $partner_id ". mysqli_error(DB::$mConnection));
		return;
	} 
	$linha = mysqli_fetch_object($rs);
	$plano_id = $linha->plano_id;
	return $plano_id;
	*/
	Util::log("busca_plano_cliente()" ); 
	Util::log("ID anunciante: ".$partner_id); 
	//$partner_planos  = Table::Fetch('partner_planos',$anuncianteid,'partner_id');
	 $sql = "select plano_id from partner_planos where partner_id = $partner_id   order by id desc limit 1";
	 $rs = mysqli_query(DB::$mConnection,$sql);
	 $row =  mysqli_fetch_assoc($rs); 
	 $plano_id = $row[plano_id] ;
	 Util::log( $sql );
	 Util::log( "plano_id  ".$plano_id  );
	 return $plano_id;
}

function detectResolution() {
	
	$useragent=$_SERVER['HTTP_USER_AGENT'];

	if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))) {
		return true;
	}
	else {
		return false;
	}
}

function bannerExists(){
	global $ROOTPATH ;
		
	$dir =  WWW_ROOT."/media/slideshowbanners";
	$dh =  opendir($dir);
	$file = readdir($dh);

	if($file == ".."){
		return false;
	}else{
		return true;
	}
}

function UrlAtual(){
	$dominio= $_SERVER['HTTP_HOST'];
	$url = "http://" . $dominio. $_SERVER['REQUEST_URI'];
	return $url;
}

function get_total_anuncios_categoria($uf, $idcat,$procura){
		$BlocosOfertas = new BlocosOfertas();
		$BlocosOfertas->categoriasfilhas = "";
		$BlocosOfertas->getcategoriafilhas($idcat); 
		$idcategorias = $BlocosOfertas->categoriasfilhas.$idcat;

		$condition = array(  
			"begin_time < '".time()."'",
			"end_time > '".time()."'", 
			"status is null or status = 1",
			"group_id in (".$idcategorias.")", 
			"pago = 'sim' or anunciogratis = 's'",
			
		);
		
		if($uf!="all" and $uf!="" and $uf!="0"){
			$condition[] = "uf in ('".$uf."')" ;
		} 
		if(!empty($procura)){ 
			$condition[] =  "title like '%".$procura."%' or summary like '%".$procura."%'" ;
		} 
		// print_r($condition);
		 
		$count = Table::Count('team', $condition);
		return $count;
			
}

function get_total_anuncios_city($city_id,$procura){ 

 
		$condition = array(  
			"begin_time < '".time()."'",
			"end_time > '".time()."'",
			 "title like '%".$procura."%' or summary like '%".$procura."%'", 
			"status is null or status = 1",
			"city_id in (".$city_id.")", 
			"pago = 'sim' or anunciogratis = 's'", 
			
		);
		$count = Table::Count('team', $condition);
		return $count;
			
}

 function gera_link($state = null,$category_id,$city_id,$procura){
	 
	 if(empty($category_id)){
		 $category_id = "0";
	 }
 	if(is_null($state) or $state == ""){
	 	$state = 'all';
	 }
	 
	 $cidade = Table::Fetch('cidades', $city_id);
	 $linkC = $INI['system']['wwwprefix'] . "/searchs/" . $state . "/".urlamigavel($cidade['nome'])."/" . $city_id."/".$category_id."/".$procura; 
	 return $linkC;
 }
 /*
 function gera_link_cat($state = null,$category_id){
	global $ROOTPATH;
	 
   $category = Table::Fetch('category', $category_id);
   if(is_null($state) or $state == ""){
	 	$state = 'all';
	 }
	  
	 $linkC = $ROOTPATH . "/anuncios/" . $state . "/".$category_id . "/".utf8_decode($category[name]) ; 
	 return $linkC;
 } 
 */
 
  function gera_link_cat($state = null,$category_id=FALSE){
	 
   if(is_null($state) or $state == ""){
	 	$state = 'all';
	 }
	  
	 $linkC = $INI['system']['wwwprefix'] . "/anuncios/" . $state . "/".$category_id; 
	 return $linkC;
 } 
 
 
 function gera_link_cat_pai($state = null,$category_id){

	if (is_null($state) || $state == "") {
		$state = 'all';
   
   
													   
							   
															
																					
	}

	$categoria = Table::Fetch('category', $category_id);

	if ($categoria['idpai'] != "0") {
		$categoria = Table::Fetch('category', $categoria['idpai']);
		return $INI['system']['wwwprefix'] . "/anuncios/" . $state . "/" . $categoria['id'];
	}

	$linkC = $INI['system']['wwwprefix'] . "/anuncios/" . $state . "/" . $categoria['id'];
	return $linkC;

 }
  function gera_link_allcat($state = null,$category_id){
	if(is_null($tate)){
  		$state = "all";
  	}
	  
	 $categoria 	= Table::Fetch('category', $category_id);
	  if($categoria['idpai'] !="0"){
		$categoria 	= Table::Fetch('category', $categoria['idpai']);
		return  $INI['system']['wwwprefix'] . "/anuncios/" . $state . "/".$categoria['id']; 
	}
	 $linkC = $INI['system']['wwwprefix'] . "/search/state/" . $state; 
	 return $linkC;
 }

 
 function gera_link_anuncios_user($user_id){
 
	 $linkC = $INI['system']['wwwprefix'] . "/vendedor/".$user_id;  
	 return $linkC;
 }
 
 function getnome($id){
	$user 	= Table::Fetch('user', $id);
 
	$nomes = explode(" ",$user['realname']); 
	return $nomes[0];
}
 
 function getcatpai($id){
	$categoria 	= Table::Fetch('category', $id);
  
 
    if($categoria['idpai'] !="0"){
		$categoria 	= Table::Fetch('category', $categoria['idpai']);
   
		return utf8_decode($categoria['name']);
	}
	return utf8_decode($categoria['name']);
}

function getStaticPages(){
	$sql = "SELECT * FROM page WHERE status = 1 and blog <> '1'";
	$pages = mysqli_query(DB::$mConnection,$sql);
	return $pages;
}

function haschildren($id){
	$sql = "SELECT id FROM category WHERE idpai = ".$id;
	$rs = mysqli_query(DB::$mConnection,$sql);
	$rows = mysqli_num_rows($rs);
	if($rows > 0){
		return true;
	}

	return false;
}

function urlAnuncio($id){
	global $INI,$ROOTPATH;

	$anuncio = Table::Fetch('team', $id);
	$titulo = URLify::filter($anuncio['title']);

	$url = $ROOTPATH."/anuncio/".$id."/".$titulo;

	return $url;
}


function isvalidteam($team){
	if($team['begin_time'] < time() AND $team['end_time'] > time() AND (is_null($team['status']) OR $team['status'] == 1) AND ($team['pago'] == 'sim' OR $team['anunciogratis'] == 's')){
		return true;
	}
	return false;
}


function showModal($modal = null){

	unset($_SESSION['modal']);

	if(!is_null($modal['msg'])){
		return "<div class='container-fluid'>
				<div class='row'>
					<div class='col-md-12'>
						<div class='alert alert-".$modal['type']." alert-dismissable'>
							 
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>
								×
							</button>
							<strong>".utf8_encode($modal['msg'])."</strong>
						</div>
					</div>
				</div>
			</div>";
	}
}

function offerTop() {
	
	$sql = "SELECT DISTINCT planos_publicacao.id FROM `planos_publicacao` INNER JOIN team ON team.id_plano = planos_publicacao.id WHERE  planos_publicacao.top ='s' and team.begin_time < '" . time() . "' and end_time > '" . time() . "' and status is null or status = 1 and pago = 'sim' or anunciogratis = 's'";
	$rs = mysqli_query(DB::$mConnection,$sql);
	
	while($row = mysqli_fetch_assoc($rs)) {
		
		$sqlU = "UPDATE team SET `create_time` = '" . date('Y-m-d', strtotime(date('Y-m-d') . '+1 days')) . "' WHERE `id_plano` = " . $row['id'] . " and `create_time` < '" . date("Y-m-d") . "' ";
		$rsU = mysqli_query(DB::$mConnection,$sqlU);
	}
}

function base64_to_jpg($string, $file) {
  $fp = fopen($file, "wb"); 
  $data = explode(',', $string);
  fwrite($fp, base64_decode($data[1])); 
  fclose($fp); 
  return $file; 
}

function insertTeamImages($imgs, $teamid){

	$arrImgs = $imgs;

	foreach ($arrImgs as $img) {

		$name = time().rand(1000,9999);
		$ext = explode(";",$img);
		$ext = explode(":", $ext[0]);
		$ext = explode("/",$ext[1]);
		$ext = $ext[1];

		$name .=  ".".$ext;
		$ano = date('Y');
		$mes = date("m");
		$dia = date('d');

		$path = IMG_ROOT."/team/".$ano."/".$mes.$dia."/";


		if(!file_exists($path)){
			RecursiveMkdir($path);
		}


		$img = base64_to_jpg($img, $path.$name);

		$sql = "INSERT INTO team_fotos (team_id, img, role) values(".$teamid.",'".$ano."/".$mes.$dia."/".$name."','team')";

		mysqli_query(DB::$mConnection,$sql);
	}

	return 1;
}

function getimagesteam($teamid){
	$conn = PDOconnection();

	$sql = "SELECT id, img FROM team_fotos WHERE team_id = ".$teamid;
	
	$stm = $conn->prepare($sql);
	$stm->execute();
	$gallery = $stm->fetchAll();
	
	$conn = null;

	return $gallery;
}

function PDOconnection(){
	global $INI;
	$servername = $INI['db']['host'];
	$username = $INI['db']['user'];
	$password = $INI['db']['pass'];
	$dbname = $INI['db']['name'];

	try {
	    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password, array('charset'=>'utf8'));
	    // set the PDO error mode to exception
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    $conn->query("SET CHARACTER SET utf8");
	    
	    return $conn;
	}
	catch(PDOException $e)
	{
		echo "Connection failed: " . $e->getMessage();
	}

}

function tratafone($fone){
	
	$fone = str_replace(" ","", $fone ); 
	$fone = str_replace("-","", $fone );
	
	$fone = str_replace('\)','', $fone );  
	$fone = str_replace('\(','', $fone );   
 
									   
									 
 
	return $fone ;
}

function geraurlzap($fone,$nomeanunciante =false){
	global $INI;
	$fone = tratafone($fone); 
?>
	https://wa.me/55<?=$fone?>?text=<?=utf8_encode("Olá ".$nomeanunciante.", como vai? Me interessei pelo seu anúncio no site ".$INI["system"]["sitename"].". Poderia me enviar mais detalhes por gentileza.");?>

<? } 

function get_id($ids){
	
	$arr = explode("/",$ids); 
	
	return $arr[1];
	
}


							 
 
														  
				  
																				 
				   
																
	 

												  
 


								
																		
				 
 
										 
																							  
			   
  
