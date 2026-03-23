<div style="display:none;" class="tips"><?= __FILE__ ?></div>

<?php
require_once(DIR_BLOCO . "/topbar.php");

$link = empty($login_user) ? "#" : $ROOTPATH . "/?page=meusdados";
?>

<header>

  <!-- [VM-ANCHOR: NAV-FIX] separadores e visibilidade desktop/mobile -->
  <style>
    /* Separadores no desktop sem quebrar linha (substitui os antigos <span class="tracin">|</span>) */
    @media (min-width: 992px){
      #navbarResponsive ul.minhaConta > li.nav-item + li.nav-item .nav-link{
        position: relative;
        padding-left: 16px;
        margin-left: 10px;
      }
      #navbarResponsive ul.minhaConta > li.nav-item + li.nav-item .nav-link:before{
        content: "|";
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        opacity: .55;
      }

      /* Garante que o menu mobile NÃO apareça no desktop */
      #navbarResponsive ul.vm-mobile-menu{ display:none !important; }
    }

    @media (max-width: 991.98px){
      /* No mobile, mostra o menu mobile normalmente */
      #navbarResponsive ul.vm-mobile-menu{ display:block !important; }
    }
  </style>

  <nav class="navbar navbar-expand-lg navbar-light bg-white" id="mainNav">
    <div>
      <button class="navbar-toggler" type="button"
              data-toggle="collapse" data-target="#navbarResponsive"
              aria-controls="navbarResponsive" aria-expanded="false"
              aria-label="Toggle navigation"
              onclick="esconderMenu()">
        <span class="navbar-toggler-icon"></span>
      </button>

      <a class="navbar-brand ml-3 ml-lg-0" href="<?= $ROOTPATH ?>">
        <img class="header-logo"
             src="<?= $ROOTPATH ?>/include/logo/logo.png"
             style="max-height: 100px;" />
      </a>
    </div>

    <?php // require_once(DIR_BLOCO . "/bloco_inputpesquisa.php"); ?>

    <div class="collapse navbar-collapse" id="navbarResponsive">

      <ul class="navbar-nav mr-auto d-nome d-lg-flex planos" id="planos"></ul>

      <!-- DESKTOP -->
      <ul class="navbar-nav ml-auto d-nome d-lg-flex minhaConta" id="minhaconta" style="align-items: center">

        <?php if (!empty($login_user_id)) { ?>

          <!-- Removido "Anunciar" aqui para não duplicar com o botão azul -->
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger font-link" href="<?= $ROOTPATH ?>/planos">
              <span><i class="fas fa-user-plus" aria-hidden="true"></i></span> Upgrade
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link js-scroll-trigger font-link" href="<?= $ROOTPATH ?>/adminanunciante">
              <span><i class="fas fa-user" aria-hidden="true"></i></span> Meus Anúncios
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link js-scroll-trigger font-link" href="<?= $ROOTPATH ?>/autenticacao/logout.php">
              <span><i class="fas fa-sign-out-alt" aria-hidden="true"></i></span> Sair
            </a>
          </li>

        <?php } else { ?>

          <!-- No desktop logado = não, mantém opções sem duplicar "Anunciar" -->
          <li class="nav-item">
            <a target="_blank"
               class="nav-link js-scroll-trigger font-link"
               data-toggle="modal" data-target="#exampleModal1">
              <span><i class="fas fa-user" aria-hidden="true"></i></span> Entrar
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link js-scroll-trigger font-link"
               data-toggle="modal" data-target="#exampleModal1">
              <span><i class="fas fa-user-plus" aria-hidden="true"></i></span> Upgrade
            </a>
          </li>

        <?php } ?>

        <!-- Botão CTA (fica no desktop e mobile) -->
        <li class="nav-item">
          <a class="button7"
             <?php if (empty($login_user)) { ?>
               data-toggle="modal" data-target="#exampleModal1"
             <?php } else { ?>
               href="<?= $ROOTPATH ?>/adminanunciante/team/edit.php"
             <?php } ?>>
            Anunciar
          </a>
        </li>
      </ul>

      <!-- MOBILE (colapse) -->
      <ul class="navbar-nav vm-mobile-menu d-lg-none">

        <?php if (!empty($login_user_id)) { ?>

          <li class="nav-item">
            <a class="nav-link js-scroll-trigger font-link" href="<?= $ROOTPATH ?>/adminanunciante/team/edit.php">
              <span><i class="fas fa-user-plus" aria-hidden="true"></i></span> Anunciar
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="<?= $ROOTPATH ?>/planos" lurker="login">Upgrade</a>
          </li>

          <li class="nav-item">
            <a class="nav-link js-scroll-trigger font-link usuarioMenu <?php echo empty($login_user) ? 'tk_logar' : ''; ?>"
               href="<?php echo $link; ?>">
              Meus Dados
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="<?= $ROOTPATH ?>/adminanunciante" lurker="login">Meus Anúncios</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="<?= $ROOTPATH ?>/autenticacao/logout.php" lurker="login">Sair</a>
          </li>

        <?php } else { ?>

          <li class="nav-item">
            <a class="nav-link js-scroll-trigger font-link"
               data-toggle="modal" data-target="#exampleModal1">
              <span><i class="fas fa-user-plus" aria-hidden="true"></i></span> Anunciar
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link js-scroll-trigger font-link"
               <?php if (empty($login_user)) { ?>
                 data-toggle="modal" data-target="#exampleModal1"
               <?php } else { ?>
                 href="<?php echo $link; ?>"
               <?php } ?>>
              Minha Conta
            </a>
          </li>

        <?php } ?>

      </ul>

    </div>
  </nav>

  <hr/>
</header>

<!-- DIV OCULTA QUE IRÁ ABRIR QUANDO A AUTENTICACAO FOR REQUISITADA -->
<?php require_once(WWW_ROOT . "/app/design/padrao/bloco/autenticacao.php"); ?>
<!-- FIM - DIV OCULTA QUE IRÁ ABRIR QUANDO A AUTENTICACAO FOR REQUISITADA -->
