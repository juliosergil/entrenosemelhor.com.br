<?php
// menumobile.php — Menu mobile isolado (sem conflitos) — header clean
// Usa $login_admin se existir
?> 
<link rel="stylesheet" href="<?=$ROOTPATH?>/media/css/dashboard_mobile.css" />
<div class="vmob-root vmob-reset">

  <!-- HEADER CLEAN -->
  <header class="vmob-header">
    <div class="vmob-header__row">
      <div class="vmob-brand">
        <img src="/media/css/i/logovi.png" alt="Vipmin" />
											
      </div>

      <div class="vmob-chip" aria-label="Usuário logado">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
          <circle cx="12" cy="7.5" r="3.5"></circle>
          <path d="M4 19c0-3.3 3.6-5.5 8-5.5s8 2.2 8 5.5"></path>
        </svg>
        <div>
          <small>Olá,</small>
          <strong><?= htmlspecialchars($login_admin['username'] ?? 'Administrador') ?></strong>
        </div>
      </div>

      <!-- Burger alto (top-right) -->
      <button class="vmob-burger" id="vmobToggle" aria-label="Abrir menu" aria-expanded="false" aria-controls="vmobDrawer">
        <span class="vmob-burger__bar"></span>
      </button> 
			
    </div> 	 
  </header>



  <!-- OVERLAY -->
  <div class="vmob-overlay" id="vmobOverlay" hidden></div>

  <!-- DRAWER -->
  <aside class="vmob-drawer" id="vmobDrawer" aria-hidden="true">
    <div class="vmob-drawer__head">
      <svg class="vmob-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="7.5" r="3.5"/><path d="M4 19c0-3.3 3.6-5.5 8-5.5s8 2.2 8 5.5"/></svg>
      <div class="vmob-drawer__title">Olá, <?= htmlspecialchars($login_admin['username'] ?? 'Administrador') ?></div>
    </div>

    <ul class="vmob-menu">

		<!-- 0) DASHBOARD -->
		<li class="vmx-mm-item">
		  <a href="/vipmin" class="vmx-mm-link" aria-label="Ir para o Dashboard">
			<!-- ícone home -->
			<svg class="vmx-mm-ico" width="18" height="18" viewBox="0 0 24 24" fill="none"
				 stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
			  <path d="M3 11l9-8 9 8"></path>
			  <path d="M9 22V12h6v10"></path>
			</svg>
			<span>Dashboard</span>
		  </a>
		</li>


      <!-- Gerenciar -->
      <li class="vmob-item">
        <a href="#" class="vmob-link vmob-toggle" data-target="sub-gerenciar">
          <svg class="vmob-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="9"/><path d="M12 8h.01M11 12h2v6h-2"/></svg>
          <span class="vmob-label">Gerenciar</span>
          <svg class="vmob-caret" viewBox="0 0 24 24" fill="currentColor"><path d="M9 18l6-6-6-6"/></svg>
        </a>
        <div id="sub-gerenciar" class="vmob-sub">
          <ul>
           	<? if($INI['option']['auth_setup']!="N"){ ?> <li> <a target="_blank"  href="https://www.vipcomsistemas.com.br/compartilhar-anuncios-pagina-site-chat-whatsapp-redes-sociais-divulgar-turbinar-criar-logotipo-hospedagem/">Outros Serviços</a></li> <? } ?> 
		
		<li> <a target="_blank" href="/index.php">Visualizar Site</a> </li> 
		<!-- <? if(file_exists(WWW_MOD."/Configurar Pagamento.inc")) { ?>	<li> <a href="/vipmin/system/Configurar Pagamento.php">Gerar QRcode Configurar Pagamento</a> </li> <? } ?> -->
		<li> <a href="/vipmin/misc/feedback.php">Contatos</a> </li>
		 <li><a href="/vipmin/category/indexcidades.php">Cidades </a>    </li> 
		<li><a href="/vipmin/category/indexestados.php">Estados </a>    </li>  
		
          </ul>
        </div>
      </li>

      <!-- Layout -->
      <li class="vmob-item">
        <a href="#" class="vmob-link vmob-toggle" data-target="sub-layout">
          <svg class="vmob-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 21v-7M4 10V3M12 21V10M12 7V3M20 21v-5M20 12V3"/><circle cx="4" cy="14" r="2"/><circle cx="12" cy="10" r="2"/><circle cx="20" cy="17" r="2"/></svg>
          <span class="vmob-label">Layout</span>
          <svg class="vmob-caret" viewBox="0 0 24 24" fill="currentColor"><path d="M9 18l6-6-6-6"/></svg>
        </a>
        <div id="sub-layout" class="vmob-sub">
        <ul>
			<li> <a href="/vipmin/system/logo.php">Alterar Logo</a> </li> 
			<li> <a href="/vipmin/system/cores.php">Alterar Cores</a> </li> 
			<!--
			<li> <a href="/vipmin/system/background.php">Alterar Background</a> </li> 
			<? if(file_exists(WWW_MOD."/superbackground.inc")){?><li> <a href="/vipmin/system/slide.php">Super Background</a> </li> <? } ?> 
			<? if(file_exists(WWW_MOD."/propostas.inc")){?><li> <a href="/vipmin/system/banners.php">Banners Slideshow</a> </li> <? } ?>
			--> 
			<li> <a href="/vipmin/system/bulletin.php">Banners e Avisos</a> </li>
			<li> <a href="/vipmin/system/imagens.php">Gerenciar Imagens</a></li>	
		</ul>
        </div>
      </li>

      <!-- Anuncios -->
      <li class="vmob-item">
        <a href="#" class="vmob-link vmob-toggle" data-target="sub-planos">
          <svg class="vmob-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M7 10V6a5 5 0 0 1 10 0v4M5 10h14l-1 10H6L5 10Z"/></svg>
          <span class="vmob-label">Anúncios</span>
          <svg class="vmob-caret" viewBox="0 0 24 24" fill="currentColor"><path d="M9 18l6-6-6-6"/></svg>
        </a>
        <div id="sub-planos" class="vmob-sub">
        	<ul> 
				<li>
					<a href="/vipmin/team/edit.php">Criar Anúncio</a>       
					<a href="/vipmin/team/index.php">Consultar Anúncios</a>    
				</li>
			</ul>
        </div>
      </li>    
	  
	  <!-- Planos -->
      <li class="vmob-item">
        <a href="#" class="vmob-link vmob-toggle" data-target="sub-anuncios">
          <svg class="vmob-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M7 10V6a5 5 0 0 1 10 0v4M5 10h14l-1 10H6L5 10Z"/></svg>
          <span class="vmob-label">Planos</span>
          <svg class="vmob-caret" viewBox="0 0 24 24" fill="currentColor"><path d="M9 18l6-6-6-6"/></svg>
        </a>
        <div id="sub-anuncios" class="vmob-sub">
          <ul>
				<li>
					<a href="/vipmin/order/index.php">Consultar Planos</a> 
				</li>
          </ul>
        </div>
      </li>

      <!-- Itens diretos 
	  <? if(file_exists(WWW_MOD."/stories.inc")){?>
		  <li class="vmob-item">
			<a class="vmob-link" href="/vipmin/team/stories.php">
			  <svg class="vmob-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M17 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
			  <span class="vmob-label">Stories</span>
			</a>
		  </li> 
	   <? } ?>
	  
	  <li class="vmob-item">
        <a class="vmob-link" href="/vipmin/system/avaliacoes.php">
          <svg class="vmob-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M17 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
          <span class="vmob-label">Avaliações</span>
        </a>
      </li>		

	  <li class="vmob-item">
        <a class="vmob-link" href="/vipmin/system/depoimentos.php">
          <svg class="vmob-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M17 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
          <span class="vmob-label">Depoimentos</span>
        </a>
      </li>	 

	  <li class="vmob-item">
        <a class="vmob-link" href="/vipmin/user/index.php">
          <svg class="vmob-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M17 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
          <span class="vmob-label">Usuários</span>
        </a>
      </li>
  
      <li class="vmob-item">
        <a class="vmob-link" href="/vipmin/system/page.php">
          <svg class="vmob-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M11 4H4a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2h13a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5 21.5 5.5"/><path d="M7 13l9.5-9.5 3 3L10 16H7z"/></svg>
          <span class="vmob-label">Artigos</span>
        </a>
      </li>
		-->
      <li class="vmob-item">
        <a class="vmob-link" href="/vipmin/category/index.php?zone=group">
          <svg class="vmob-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/></svg>
          <span class="vmob-label">Categorias</span>
        </a>
      </li>

      <li class="vmob-item">
        <a class="vmob-link" href="/vipmin/system/option.php">
          <svg class="vmob-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 21v-7M4 10V3M12 21V10M12 7V3M20 21v-5M20 12V3"/><circle cx="4" cy="14" r="2"/><circle cx="12" cy="10" r="2"/><circle cx="20" cy="17" r="2"/></svg>
          <span class="vmob-label">Configurações</span>
        </a>
      </li>
      
      <!-- Sistema -->
      <li class="vmob-item">
        <a href="#" class="vmob-link vmob-toggle" data-target="sub-sistema">
          <svg class="vmob-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="9"/><path d="M12 8h.01M11 12h2v6h-2"/></svg>
          <span class="vmob-label">Sistema</span>
          <svg class="vmob-caret" viewBox="0 0 24 24" fill="currentColor"><path d="M9 18l6-6-6-6"/></svg>
        </a>
        <div id="sub-sistema" class="vmob-sub">
			<ul> 
			  <li> <a target="_blank"  href="https://drive.google.com/open?id=1eMI9-rrlpqSH4mzZo45cuwTquN8ybPN_">Acessar Arquivos</a> </li>
			  <li> <a target="_blank" href="https://drive.google.com/open?id=153CPg__z_z_9tpZRP955yf7VyAVZ9R6d">Manual</a> </li> 
			  <li> <a href="/vipmin/system/index.php">Informações Básicas</a> </li>
				<li> <a href="/vipmin/system/option.php">Configurações</a> </li>
				 <li> <a href="/vipmin/category/index.php?zone=group">Categorias</a> </li>   
				<? if(file_exists(WWW_MOD."/pix.inc")){?><li> <a href="/vipmin/system/pay.php">Configurar chave pix</a> </li><? } ?>
				 <? if(file_exists(WWW_MOD."/gateway.inc")){?><li> <a href="/vipmin/system/gateway.php">Gateway de Pagamento</a> </li> <? } ?>
				<li> <a href="/vipmin/system/email.php">Configurar Contatos</a> </li> 
				<li> <a href="/vipmin/misc/backup.php">Backup dos Dados</a> </li>
				<li>  <a href="/vipmin/user/manager.php">Administrador</a> </li> 	  
			</ul>
        </div>
      </li>

      <!-- Sair (no fim do menu) -->
      <li class="vmob-item">
        <a class="vmob-link" href="/autenticacao/logout.php">
          <svg class="vmob-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 7V5a2 2 0 0 1 2-2h7v18h-7a2 2 0 0 1-2-2v-2"></path><path d="M16 12H3m3-3-3 3 3 3"></path></svg>
          <span class="vmob-label">Sair</span>
        </a>
      </li>
    </ul>
  </aside>
</div>

<script>
(()=> {
  const drawer = document.getElementById('vmobDrawer');
  const overlay = document.getElementById('vmobOverlay');
  const toggle  = document.getElementById('vmobToggle');

  function openDrawer(){
    drawer.classList.add('is-open');
    overlay.classList.add('is-open');
    overlay.hidden = false;
    toggle.setAttribute('aria-expanded','true');
    document.body.style.overflow='hidden';
  }
  function closeDrawer(){
    drawer.classList.remove('is-open');
    overlay.classList.remove('is-open');
    toggle.setAttribute('aria-expanded','false');
    document.body.style.overflow='';
    setTimeout(()=>overlay.hidden=true, 220);
  }

  toggle.addEventListener('click', ()=> {
    drawer.classList.contains('is-open') ? closeDrawer() : openDrawer();
  });
  overlay.addEventListener('click', closeDrawer);
  document.addEventListener('keydown', (e)=> {
    if(e.key === 'Escape' && drawer.classList.contains('is-open')) closeDrawer();
  });

  // Accordion com animação de altura
  document.querySelectorAll('.vmob-toggle').forEach(btn=>{
    btn.addEventListener('click', (ev)=>{
      ev.preventDefault();
      const id = btn.getAttribute('data-target');
      const sub = document.getElementById(id);
      const item = btn.closest('.vmob-item');
      const open = item.classList.contains('is-open');

									  
      if(open){
        sub.style.height = sub.scrollHeight + 'px';
        requestAnimationFrame(()=>{ sub.style.height = '0px'; });
        item.classList.remove('is-open');
      }else{
        sub.style.height = 'auto';
        const h = sub.scrollHeight + 'px';
        sub.style.height = '0px';
        requestAnimationFrame(()=>{ sub.style.height = h; });
        item.classList.add('is-open');
      }

								  
      sub.addEventListener('transitionend', ()=>{
        if(item.classList.contains('is-open')) sub.style.height = 'auto';
									
		 
      }, {once:true});
    });
  });

})();
</script>
