<?php /* Login Vipmin – versão moderna, sem jQuery */ ?>
<!doctype html>
<html lang="pt-BR" id="<?php echo $INI['sn']['sn']; ?>">
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $INI['system']['sitename']; ?> — Vipmin • Autenticação</title>
  <link rel="icon" href="<?=$ROOTPATH?>/media/icon/favicon.ico">
  <style>
    :root{
      --bg-start:#0b6a80;
      --bg-end:#0f3954;
      --card-bg:rgba(255,255,255,.08);
      --card-border:rgba(255,255,255,.16);
      --text:#eaf2f5;
      --muted:#b9c7d1;
      --primary:#3b82f6;
      --primary-strong:#2563eb;
      --danger:#ef4444;
      --success:#22c55e;
      --input-bg:rgba(255,255,255,.10);
      --input-border:rgba(255,255,255,.18);
      --shadow: 0 10px 30px rgba(0,0,0,.25);
      --radius: 14px;
      --gap: 18px;
    }
    *{box-sizing:border-box}
    html,body{height:100%}
    body{
      margin:0;
      color:var(--text);
      font:16px/1.4 system-ui,-apple-system,Segoe UI,Roboto,Ubuntu,Cantarell,Noto Sans,"Helvetica Neue",Arial,"Apple Color Emoji","Segoe UI Emoji";
      background: radial-gradient(1200px 650px at 75% 20%, rgba(255,255,255,.06), transparent 60%) ,
                  linear-gradient(160deg,var(--bg-start),var(--bg-end));
      display:grid;
      place-items:center;
      padding:24px;
    }

    /* container */
    .login{
      width:min(420px, 100%);
      background:var(--card-bg);
      border:1px solid var(--card-border);
      border-radius:var(--radius);
      box-shadow:var(--shadow);
      backdrop-filter: blur(6px);
      -webkit-backdrop-filter: blur(6px);
      overflow:hidden;
    }
    .login__header{
      display:flex;
      align-items:center;
      gap:12px;
      padding:22px 22px 10px;
    }
    .login__brand{
      display:flex; align-items:center; gap:12px;
    }
    .login__brand img{height:44px; width:auto; display:block}
    .login__brand h1{
      font-size:18px; margin:0; font-weight:600; letter-spacing:.2px
    }

    .login__body{padding:0 22px 22px;}
    .muted{color:var(--muted); font-size:.92rem}

    /* status / feedback */
    .status{margin:0 22px 18px; display:none; border-left:3px solid var(--muted); padding:12px 14px; border-radius:8px; background:rgba(0,0,0,.2)}
    .status[data-type="info"]{border-color:#60a5fa}
    .status[data-type="success"]{border-color:var(--success)}
    .status[data-type="error"]{border-color:var(--danger)}
    .status__msg{margin:0}

    /* form */
    form{display:grid; gap:var(--gap)}
    .field{display:grid; gap:8px}
    label{font-size:.92rem}
    .control{
      position:relative;
      display:flex;
      align-items:center;
      background:var(--input-bg);
      border:1px solid var(--input-border);
      border-radius:12px;
      padding:0 12px;
      transition:border-color .2s, background .2s;
    }
    .control:focus-within{border-color:#7dd3fc; background:rgba(255,255,255,.14)}
    input{
      appearance:none;
      border:0;
      background:transparent;
      color:var(--text);
      padding:12px 10px;
      width:100%;
      font-size:16px;
      outline:0;
    }
    .toggle-pass{
      border:0; background:transparent; color:var(--muted);
      cursor:pointer; padding:6px; border-radius:8px;
    }
    .toggle-pass:focus-visible{outline:2px solid #7dd3fc; outline-offset:2px}

    /* actions */
    .actions{display:flex; gap:10px; align-items:center; justify-content:space-between}
    .btn{
      appearance:none; border:0; cursor:pointer; border-radius:12px; padding:12px 16px; font-weight:600;
      transition: transform .04s ease, background .2s ease;
    }
    .btn:active{transform:translateY(1px)}
    .btn--primary{background:var(--primary); color:#fff}
    .btn--primary:hover{background:var(--primary-strong)}
    .btn--ghost{background:transparent; color:var(--text); border:1px solid var(--input-border)}
    .btn--ghost:hover{background:rgba(255,255,255,.08)}
    .links{display:flex; justify-content:flex-end}
    .links a{color:#cfe5ff; font-size:.92rem; text-decoration:none}
    .links a:hover{text-decoration:underline}

    /* modal */
    .modal{position:fixed; inset:0; display:none; place-items:center; background:rgba(0,0,0,.4); z-index:50; padding:20px}
    .modal[open]{display:grid}
    .modal__card{
      width:min(420px, 100%);
      background:#0e1723; color:#e8eef4; border:1px solid #223045; border-radius:14px; box-shadow:var(--shadow);
      padding:20px; display:grid; gap:14px;
    }
    .modal__actions{display:flex; gap:10px; justify-content:flex-end}
    .copyright{margin-top:16px; text-align:center; color:var(--muted); font-size:.85rem}

    /* small screens */
    @media (max-width:420px){
      .login__brand h1{font-size:16px}
    }
	
	/* força o mesmo visual do container */
.control { overflow: hidden; } /* arredondamento sem “vazar” */
.control input{
  background-color: transparent !important;
  color: var(--text) !important;
}
.control input::placeholder{ color: var(--muted); }

/* corrige Chrome/Edge autofill que pinta o fundo de branco/amarelo */
.control input:-webkit-autofill,
.control input:-webkit-autofill:hover,
.control input:-webkit-autofill:focus,
.control input:-webkit-autofill:active{
  -webkit-text-fill-color: var(--text) !important;
  caret-color: var(--text) !important;
  -webkit-box-shadow: 0 0 0 1000px var(--input-bg) inset !important;
          box-shadow: 0 0 0 1000px var(--input-bg) inset !important;
  transition: background-color 99999s ease-in-out 0s; /* evita “flash” */
}

/* se existir alguma classe antiga (ex: .std_textbox) que define fundo branco */
.std_textbox,
input[type="text"],
input[type="password"]{
  background-color: transparent !important;
}

  </style>
</head>
<body>

  <div class="login" role="region" aria-label="Autenticação Vipmin">
    <div class="login__header">
      <div class="login__brand">
        <?php if($INI['option']['auth_setup']!="N"){ ?>
          <img src="<?=$ROOTPATH?>/media/css/i/logovi.png" alt="Vipmin">
        <?php } ?> 
      </div>
    </div>

    <!-- feedback -->
    <div id="status" class="status" role="status" aria-live="polite"><p class="status__msg" id="statusMsg"></p></div>

    <div class="login__body">
      <form id="login_form" action="loginpos.php" method="post" target="_top" novalidate>
        <input id="dest_uri" value="/" type="hidden">

        <div class="field">
          <label for="username">Login</label>
          <div class="control">
            <input name="username" id="username" placeholder="Digite seu nome de usuário" autocomplete="username" required>
          </div>
        </div>

        <div class="field">
          <label for="password">Senha</label>
          <div class="control">
            <input name="password" id="password" type="password" placeholder="Digite sua senha" autocomplete="current-password" required>
            <button type="button" class="toggle-pass" id="togglePass" aria-label="Mostrar senha" title="Mostrar/ocultar senha">👁️</button>
          </div>
        </div>

        <div class="actions">
          <button type="button" class="btn btn--primary" id="btnLogin">Entrar</button>
          <button type="button" class="btn btn--ghost" id="btnForgot">Esqueci a senha</button>
        </div>
        <div class="links">
          <span class="muted">Compatível com Firefox e Chrome</span>
        </div>
      </form>
    </div>
  </div>

  <?php if($INI['option']['auth_setup']!="N"){ ?>
    <div class="copyright">© <?=date('Y');?> Vipcom. Todos os direitos reservados.</div>
  <?php } ?>

  <!-- Modal Esqueci a Senha -->
  <dialog class="modal" id="forgotModal">
    <div class="modal__card" role="dialog" aria-labelledby="forgotTitle" aria-modal="true">
      <h2 id="forgotTitle" style="margin:0;font-size:18px">Recuperar senha</h2>
      <p class="muted" style="margin:0">Informe seu e-mail para receber instruções.</p>
      <div class="field" style="margin-top:6px">
        <label for="forgotEmail">E-mail</label>
        <div class="control"><input id="forgotEmail" type="email" placeholder="seu@email.com" autocomplete="email"></div>
      </div>
      <div class="modal__actions">
        <button class="btn btn--ghost" id="forgotClose" type="button">Cancelar</button>
        <button class="btn btn--primary" id="forgotSend" type="button">Enviar</button>
      </div>
    </div>
  </dialog>

<script>
  // Utilidades
  const $ = sel => document.querySelector(sel);
  const statusBox = $('#status');
  const statusMsg = $('#statusMsg');

  function showStatus(msg, type='info'){
    statusMsg.textContent = msg;
    statusBox.dataset.type = type;
    statusBox.style.display = 'block';
  }
  function hideStatus(){ statusBox.style.display = 'none'; }

  // Mostrar/ocultar senha
  $('#togglePass').addEventListener('click', () => {
    const input = $('#password');
    const isPwd = input.type === 'password';
    input.type = isPwd ? 'text' : 'password';
    $('#togglePass').setAttribute('aria-label', isPwd ? 'Ocultar senha' : 'Mostrar senha');
  });

  // Enter para enviar
  ['#username','#password'].forEach(sel=>{
    $(sel).addEventListener('keypress', e => {
      if(e.key === 'Enter'){ e.preventDefault(); doLogin(); }
    });
  });

  // Botões
  $('#btnLogin').addEventListener('click', doLogin);
  $('#btnForgot').addEventListener('click', () => {
    $('#forgotModal').showModal();
    $('#forgotEmail').focus();
  });
  $('#forgotClose').addEventListener('click', () => $('#forgotModal').close());
  $('#forgotSend').addEventListener('click', sendForgot);

  async function doLogin(){
    const u = $('#username').value.trim();
    const p = $('#password').value;

    if(!u){ showStatus('Por favor, informe seu usuário.', 'error'); $('#username').focus(); return; }
    if(!p){ showStatus('Por favor, informe sua senha.', 'error'); $('#password').focus(); return; }

    showStatus('Realizando autenticação…', 'info');
    try{
      const resp = await fetch('login.php', {
        method:'POST',
        headers:{'Content-Type':'application/x-www-form-urlencoded; charset=UTF-8'},
        body: new URLSearchParams({username:u, password:p}).toString(),
        credentials:'same-origin'
      });
      const text = (await resp.text()).trim();

      if(text === ''){ // sucesso (compatível com lógica antiga)
        showStatus('Sucesso! Direcionando para o painel…', 'success');
        // Submete o form para manter o fluxo existente
        document.getElementById('login_form').submit();
      }else{
        showStatus('Falha na autenticação.', 'error');
      }
    }catch(e){
      showStatus('Erro de rede. Tente novamente.', 'error');
    }
  }

  async function sendForgot(){
    const email = $('#forgotEmail').value.trim();
    if(!email){ alert('Informe seu e-mail.'); $('#forgotEmail').focus(); return; }
    try{
      const resp = await fetch('pass.php', { method:'POST', credentials:'same-origin' });
      const text = (await resp.text()).trim();
      alert(text || 'Se seu e-mail estiver cadastrado, você receberá instruções em instantes.');
      $('#forgotModal').close();
    }catch(e){
      alert('Erro ao enviar. Tente novamente.');
    }
  }
</script>
</body>
</html>
