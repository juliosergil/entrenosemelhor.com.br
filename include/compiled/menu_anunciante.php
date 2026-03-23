<script type="text/javascript">
$(function() {
  if ($.browser.msie && $.browser.version.substr(0,1)<7)
  {
	$('li').has('ul').mouseover(function(){
		$(this).children('ul').show();
		}).mouseout(function(){
		$(this).children('ul').hide();
		})
  }
});        
</script>

<ul id="menu">  
 
<li><a href="/adminanunciante/team/index.php"><?=utf8_encode("Anúncios")?></a>
	<ul> 
		<li>
			<a href="/adminanunciante/team/edit.php"><?=utf8_encode("Criar Anúncio")?> </a>       
			<a href="/adminanunciante/team/index.php"><?=utf8_encode("Consultar Anúncios")?> </a>    
		</li>
	</ul>
</li> 
<li><a href="/adminanunciante/team/propostas.php"><?=utf8_encode("Propostas Recebidas")?></a> </li> 
 
 
</ul> 
