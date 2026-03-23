
<ul id="menu">

<?php
// Lista de domínios bloqueados (sem www) 
$dominios_bloqueados = [
    'scriptacompanhante.com.br',
    'guiacomercialscript.com.br',
    'vipcomsites.com.br',
    'sistemaclassificados.com.br',
    'sistemacomprascoletivas.com.br'
];

// Pega o domínio atual e remove o "www."
$dominio_atual = preg_replace('/^www\./', '', strtolower($_SERVER['HTTP_HOST']));

// Verifica se NÃO está na lista bloqueada
if (!in_array($dominio_atual, $dominios_bloqueados)) :
?>

  
<li><a href="/vipmin/misc/index.php">Plugins</a>  
	<ul>  
		<?php include template("menu_painel"); ?> 
	</ul>
</li> 


<?php endif; ?>
 
<li><a href="/vipmin/misc/index.php">Gerenciar</a>
	 <ul> 
<? if($INI['option']['auth_setup']!="N"){ ?> <li> <a target="_blank"  href="https://www.vipcomsistemas.com.br/compartilhar-anuncios-pagina-site-chat-whatsapp-redes-sociais-divulgar-turbinar-criar-logotipo-hospedagem/"><?=utf8_encode("Outros Serviços")?></a></li> <? } ?> 
		
		<li> <a target="_blank" href="/index.php"><?=utf8_encode("Visualizar Site")?></a> </li> 
		<!-- <? if(file_exists(WWW_MOD."/Configurar Pagamento.inc")) { ?>	<li> <a href="/vipmin/system/Configurar Pagamento.php">Gerar QRcode Configurar Pagamento</a> </li> <? } ?> -->
		<li> <a href="/vipmin/misc/feedback.php"><?=utf8_encode("Contatos")?></a> </li>
		 <li><a href="/vipmin/category/indexcidades.php">Cidades </a>    </li> 
	 <li><a href="/vipmin/category/indexestados.php">Estados </a>    </li> 
	 
	</ul>
</li>
<li><a href="#">Layout</a>
	 <ul>
		<li> <a href="/vipmin/system/logo.php"><?=utf8_encode("Alterar Logo")?></a> </li> 
		<li> <a href="/vipmin/system/cores.php"><?=utf8_encode("Alterar Cores")?></a> </li> 
		<!--
		<li> <a href="/vipmin/system/background.php"><?=utf8_encode("Alterar Background")?></a> </li> 
		<? if(file_exists(WWW_MOD."/superbackground.inc")){?><li> <a href="/vipmin/system/slide.php"><?=utf8_encode("Super Background")?></a> </li> <? } ?> 
		<? if(file_exists(WWW_MOD."/propostas.inc")){?><li> <a href="/vipmin/system/banners.php"><?=utf8_encode("Banners Slideshow")?></a> </li> <? } ?>
		--> 
		<li> <a href="/vipmin/system/bulletin.php"><?=utf8_encode("Banners e Avisos")?></a> </li>
		<li> <a href="/vipmin/system/imagens.php"><?=utf8_encode("Gerenciar Imagens")?></a></li>		 
	</ul>
 </li> 
<li><a href="/vipmin/team/index.php"><?=utf8_encode("Anúncios")?></a>
	<ul> 
		<li>
			<a href="/vipmin/team/edit.php"><?=utf8_encode("Criar Anúncio")?> </a>       
			<a href="/vipmin/team/index.php"><?=utf8_encode("Consultar Anúncios")?> </a>    
		</li>
	</ul>
</li>
<!--
<? if(file_exists(WWW_MOD."/propostas.inc")){?><li><a href="/vipmin/team/propostas.php"><?=utf8_encode("Propostas Recebidas")?></a> </li> <? } ?>
-->
<? if(file_exists(WWW_MOD."/anunciante.inc")){?><li><a href="/vipmin/order/index.php"><?=utf8_encode("Planos")?></a>
	<ul> 
		<li>
			<a href="/vipmin/order/index.php"><?=utf8_encode("Consultar Planos")?> </a> 
		</li>
	</ul>
</li> 
<? } ?>
<li><a href="/vipmin/user/index.php">Anunciantes</a>
	<ul> 
		<li>
			<a href="/vipmin/user/edit.php">Novo anunciantes</a>
			<a href="/vipmin/user/index.php">Consultar anunciantes</a> 
		</li>
	</ul>
</li>
<li><a href="/vipmin/system/page.php"><?=utf8_encode("Páginas")?></a></li>  
	<li> <a href="/vipmin/category/index.php?zone=group">Categorias</a> </li>   
<li><a href="/vipmin/system/index.php">Sistema</a>
 <ul> 
    <li> <a target="_blank"  href="https://drive.google.com/open?id=1eMI9-rrlpqSH4mzZo45cuwTquN8ybPN_"><?=utf8_decode("Acessar Arquivos")?></a> </li>
   
	 <li> <a href="/vipmin/system/index.php"><?=utf8_encode("Informações Básicas")?></a> </li>
	<li> <a href="/vipmin/system/option.php"><?=utf8_encode("Configurações")?></a> </li>
	<!-- <li> <a href="/vipmin/category/index.php">Cidades</a> </li>	-->
   <li><a href="/vipmin/system/redes.php?pg=redessociais">Redes Sociais</a></li>  
	<? if(file_exists(WWW_MOD."/pix.inc")){?><li> <a href="/vipmin/system/pay.php"><?=utf8_encode("Configurar chave pix")?></a> </li><? } ?>
	<li> <a href="/vipmin/system/email.php"><?=utf8_encode("Configurar Contatos")?></a> </li> 
	<li> <a href="/vipmin/misc/backup.php"><?=utf8_encode("Backup dos Dados")?></a> </li>
	<li>  <a href="/vipmin/user/manager.php">Administrador</a> </li>
	<!--<li> <a href="/vipmin/system/page.php"><?=utf8_encode("Páginas Estáticas")?></a> </li>-->	 
</ul>
</li>
</ul> 