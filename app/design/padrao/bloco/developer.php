<style>
.tips {
	background: #800000;
	border: 1px;
	color: #FFF;
	display: block;
	font-family:  Arial, Helvetica, sans-serif;
	font-size: 16px;
	height: 28px;
	text-align: left;
	z-index:999999999999;
	position:relative;
}
.esfont{
	margin-left:10px;color: #fff;font-weight: 400;
}
</style>

<div style="position:relative; display:none;color: #fff; background: #ff7500; width: 100%;  height: 42px;" id="webdeveloper" class="webdeveloper"><a  class="esfont" href="#" onclick="javascript:jQuery('.tips').css('display', 'block'); event.preventDefault();">Mostrar arquivos </a> | <a class="esfont"  href="#" onclick="javascript:jQuery('.tips').css('display', 'none'); event.preventDefault();">Esconder arquivos</a>  |<a class="esfont"  href="#" onclick="javascript:jQuery('.webdeveloper').css('display', 'none'); event.preventDefault();">Deligar TKDEVELOPER</a> <a class="esfont"  style="float:left;" href="http://www.vipcomsistemas.com.br" target="_blank"><img src="<?=$PATHSKIN?>/images/logoweb.png" /></a></div>

<? if($INI['option']['bloco_tkdeveloper'] == "Y"){?>
	<script> 
		document.getElementById('webdeveloper').style.display = 'block';
	</script>
<? } ?>