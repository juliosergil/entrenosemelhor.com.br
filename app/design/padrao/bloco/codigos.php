<?php
session_start();

$actual_link = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

if (!stristr($_SERVER['REQUEST_URI'], "login")) {
    $_SESSION['ultima_oferta_visitada'] = $actual_link;
}

include(DIR_BLOCO."/developer.php"); 

if (file_exists(WWW_MOD."/chat_zap.inc") && !$team) {
    include(DIR_BLOCO."/chat_zap.php"); 
}

include(DIR_BLOCO."/chat_zap_anunciante.php");
?>

<!-- ============  CODIGOS INCLUIDOS PELO USUARIO VIA VIPMIN - tags <style></style> não é necessario incluir ========  -->
<!-- ============  CSS  ========  -->
<style>
	<?php echo $INI['system']['codigoscss']; ?>
</style>

<!-- ============  JAVASCRIPT (o usuario deve incluir as tags de inicio e fim das tags <script></script>)  ========  -->

<?php echo $INI['system']['codigosrodape']; ?>

<? if( file_exists(WWW_MOD."/lgpd.inc")) {?>

<style>
.cookieTitle{ text-align: center; }
.cookieDesc{ text-align: center; }
</style>

	<style>.cookieConsentContainer{z-index:999;width:100%;min-height:20px;box-sizing:border-box;padding: 11px 31px 10px 29px;background:#232323;overflow:hidden;position:fixed;bottom:30px;right:30px;display:none}.cookieConsentContainer .cookieTitle a{font-family:OpenSans,arial,sans-serif;color:#fff;font-size:20px;line-height:20px;display:block}.cookieConsentContainer .cookieDesc p{  margin:0;padding:0;font-family:OpenSans,arial,sans-serif;color:#fff;font-size:17px;line-height:20px;display:block;margin-top:10px}.cookieConsentContainer .cookieDesc a{font-family:OpenSans,arial,sans-serif;color:#fff;text-decoration:underline}.cookieConsentContainer .cookieButton a{display:inline-block;font-family:OpenSans,arial,sans-serif;color:#fff;font-size:14px;font-weight:700;margin-top:14px;background:#000;box-sizing:border-box;padding:15px 24px;text-align:center;transition:background .3s}.cookieConsentContainer .cookieButton a:hover{cursor:pointer;background:#3e9b67}@media (max-width:980px){.cookieConsentContainer{bottom:0!important;left:0!important;width:100%!important}}</style>

	<script>var purecookieTitle="Esse site usa Cookies",purecookieDesc='<?=utf8_decode("Nós armazenamos dados temporariamente para melhorar a sua experiência de navegação e recomendar conteúdo de seu interesse. Ao utilizar nossos serviços, você concorda com tal monitoramento.")?>',purecookieLink='',purecookieButton="Aceitar";function pureFadeIn(e,o){var i=document.getElementById(e);i.style.opacity=0,i.style.display=o||"block",function e(){var o=parseFloat(i.style.opacity);(o+=.02)>1||(i.style.opacity=o,requestAnimationFrame(e))}()}function pureFadeOut(e){var o=document.getElementById(e);o.style.opacity=1,function e(){(o.style.opacity-=.02)<0?o.style.display="none":requestAnimationFrame(e)}()}function setCookie(e,o,i){var t="";if(i){var n=new Date;n.setTime(n.getTime()+24*i*60*60*1e3),t="; expires="+n.toUTCString()}document.cookie=e+"="+(o||"")+t+"; path=/"}function getCookie(e){for(var o=e+"=",i=document.cookie.split(";"),t=0;t<i.length;t++){for(var n=i[t];" "==n.charAt(0);)n=n.substring(1,n.length);if(0==n.indexOf(o))return n.substring(o.length,n.length)}return null}function eraseCookie(e){document.cookie=e+"=; Max-Age=-99999999;"}function cookieConsent(){getCookie("purecookieDismiss")||(document.body.innerHTML+='<div class="cookieConsentContainer" id="cookieConsentContainer"><div class="cookieTitle"><span style="font-size:19px;color:#fff;">'+purecookieTitle+'</span></div><div class="cookieDesc"><p>'+purecookieDesc+" "+purecookieLink+'</p></div><div class="cookieButton"><a onClick="purecookieDismiss();">'+purecookieButton+"</a></div></div>",pureFadeIn("cookieConsentContainer"))}function purecookieDismiss(){setCookie("purecookieDismiss","1",365),pureFadeOut("cookieConsentContainer")}window.onload=function(){cookieConsent()};</script>
		
<? } ?>

	<div style="position: relative;">
    <!-- conteúdo atual do rodapé aqui -->

    <!-- Link discreto -->
    <a target="_blank" href="<?=$ROOTPATH?>/index.php?page=urls" style="
        position: absolute;
        right: 10px;
        bottom: 5px;
        font-size: 10px;
        color: #555;
        text-decoration: none;">
        Parceiros
    </a>
</div>
