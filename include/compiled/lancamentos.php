<?
	$actual_link = "$_SERVER[HTTP_HOST]";
	$actual_linkfull = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
 
	if(strpos($actual_linkfull,"vipmin/index.php")){
		 
		echo file_get_contents("https://www.tkstore.com.br/lancamentos_vipcom.php?domain=$ROOTPATH&server=$actual_link");
	}
?>
 
<script type="text/javascript" src="<?=$ROOTPATH?>/js/jquery.cookie.js" ></script>
<?
  
 
 
function getBrowser() { 
  $u_agent = $_SERVER['HTTP_USER_AGENT'];
  $bname = 'Unknown';
  $platform = 'Unknown';
  $version= "";

  //First get the platform?
  if (preg_match('/linux/i', $u_agent)) {
    $platform = 'linux';
  }elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
    $platform = 'mac';
  }elseif (preg_match('/windows|win32/i', $u_agent)) {
    $platform = 'windows';
  }

  // Next get the name of the useragent yes seperately and for good reason
  if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)){
    $bname = 'Internet Explorer';
    $ub = "MSIE";
  }elseif(preg_match('/Firefox/i',$u_agent)){
    $bname = 'Mozilla Firefox';
    $ub = "Firefox";
  }elseif(preg_match('/OPR/i',$u_agent)){
    $bname = 'Opera';
    $ub = "Opera";
  }elseif(preg_match('/Chrome/i',$u_agent) && !preg_match('/Edge/i',$u_agent)){
    $bname = 'Google Chrome';
    $ub = "Chrome";
  }elseif(preg_match('/Safari/i',$u_agent) && !preg_match('/Edge/i',$u_agent)){
    $bname = 'Apple Safari';
    $ub = "Safari";
  }elseif(preg_match('/Netscape/i',$u_agent)){
    $bname = 'Netscape';
    $ub = "Netscape";
  }elseif(preg_match('/Edge/i',$u_agent)){
    $bname = 'Edge';
    $ub = "Edge";
  }elseif(preg_match('/Trident/i',$u_agent)){
    $bname = 'Internet Explorer';
    $ub = "MSIE";
  }

  // finally get the correct version number
  $known = array('Version', $ub, 'other');
  $pattern = '#(?<browser>' . join('|', $known) .
')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
  if (!preg_match_all($pattern, $u_agent, $matches)) {
    // we have no matching number just continue
  }
  // see how many we have
  $i = count($matches['browser']);
  if ($i != 1) {
    //we will have two since we are not using 'other' argument yet
    //see if version is before or after the name
    if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
        $version= $matches['version'][0];
    }else {
        $version= $matches['version'][1];
    }
  }else {
    $version= $matches['version'][0];
  }

  // check if we have a number
  if ($version==null || $version=="") {$version="?";}

  return array(
    'userAgent' => $u_agent,
    'name'      => $bname,
    'version'   => $version,
    'platform'  => $platform,
    'pattern'    => $pattern
  );
} 

// now try it
$ua=getBrowser();
//$yourbrowser= "Your browser: " . $ua['name'] . " " . $ua['version'] . " on " .$ua['platform'] . " reports: <br >" . $ua['userAgent'];
 

// verifica pendencias de configuração: 
 
if( $INI['mail']['from'] == "" or $INI['mail']['from'] == "brunoresendecouto@hotmail.com"  or $INI['mail']['from'] == "atendimento@dominio.com.br" or $INI['mail']['from'] == "suportevipcom@gmail.com" )  { ?>  
	 <script> 
	 jQuery(document).ready(function(){
		// alert("Você ainda não configurou nenhum email. Por favor, vá na opção Sistema->Configurar e-mails e informe o seu email de remetente.");
		// jQuery.cookie('navegadorfire', '1', { expires: 99999 });
	 });
	</script>
<? }  	 
   

if($ua['name'] !="Google Chrome" and !$_COOKIE['navegadorfire']) { ?>  
	 <script>  
	 jQuery(document).ready(function(){
		alert("Atenção, esta administração tem um melhor desenpenho pelo navegador chrome");
		 jQuery.cookie('navegadorfire', '1', { expires: 99999 });
	 });
	</script>
<? }  
  
 
  
  