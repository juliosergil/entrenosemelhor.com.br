<?php
/**
 * Vipmin — seletor de menu por dispositivo
 *
 * - Desktop/Tablet: estrutura clássica (#hdw > #hd) + logo + veralteracao + chip usuário + menu.php
 * - Mobile: menumobile.php (CSS/JS isolados)
 *
 * Teste manual:
 *   ?force_mobile=1 -> força mobile
 *   ?force_mobile=0 -> força desktop
 */

function vmx_is_mobile(): bool {
  if (isset($_GET['force_mobile'])) {
    return $_GET['force_mobile'] === '1';
  }
  $ua = strtolower($_SERVER['HTTP_USER_AGENT'] ?? '');
  if ($ua === '') return false;

  foreach ([
    'iphone','ipod','ipad','android','blackberry','bb10','iemobile',
    'windows phone','mobile','silk','kindle','opera mini','opera mobi'
  ] as $n) {
    if (strpos($ua, $n) !== false) return true;
  }
  return false;
}

$__dir         = __DIR__;
$__menuDesktop = $__dir . '/menu.php';        // seu menu clássico (apenas a UL e afins)
$__menuMobile  = $__dir . '/menumobile.php';  // novo menu mobile isolado
$__useMobile   = vmx_is_mobile() && file_exists($__menuMobile);

if ($__useMobile && file_exists($__menuMobile)) {
  // ====== MOBILE ======
  include $__menuMobile;

} else {
  // ====== DESKTOP (estrutura original preservada) ======
  ?>
  <div id="hdw">
    <div id="hd">

      <!-- Logo (como no original) -->
      <div id="logo" class="vipmin-header">
        <a href="/vipmin" class="brand" aria-label="Vipmin (dashboard)">
          <img src="/media/css/i/logovi.png" alt="Vipmin" />
        </a>
      </div>

      <?php
      // Botão/indicador verde (arquivo original)
      @include __DIR__ . '/veralteracao.php';
      ?>

      <?php if (!empty($login_user)): ?>
        <!-- Chip moderno: usuário + sair (mantido) -->
        <div class="vipmin-userbar">
          <div class="user-chip" title="Você está logado">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <circle cx="12" cy="7.5" r="3.5"></circle>
              <path d="M4 19c0-3.3 3.6-5.5 8-5.5s8 2.2 8 5.5"></path>
            </svg>
            <div class="meta">
              <span class="hello">Olá,</span>
              <strong><?= htmlspecialchars($login_user['realname']) ?></strong>
            </div>
            <a class="logout" href="/autenticacao/logout.php" title="Sair">
              <svg viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M9 7V5a2 2 0 0 1 2-2h7v18h-7a2 2 0 0 1-2-2v-2"></path>
                <path d="M16 12H3m3-3-3 3 3 3"></path>
              </svg>
              <span>Sair</span>
            </a>
          </div>
        </div>
      <?php endif; ?>

      <?php
      // Seu menu clássico (UL, dropdowns etc.) — NÃO alterado
      if (file_exists($__menuDesktop)) {
        include $__menuDesktop;
      }
      ?>

    </div>
  </div>
  <?php
}
