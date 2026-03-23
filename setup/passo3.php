<?php
/**
 * Setup Vipcom — Passo 3 (Configurando)
 * Compatível com PHP 7.2/7.4
 */
error_reporting(0);
set_time_limit(0);

require_once(dirname(dirname(__FILE__)) . '/include/application.php');

if ($_POST['id'] !== '03') {
    header('Location: /setup/index1.php');
    exit;
}

/* ---------- Entrada ---------- */
$db = isset($_POST['db']) && is_array($_POST['db']) ? $_POST['db'] : [];
$db['host'] = isset($db['host']) ? $db['host'] : '';
$db['user'] = isset($db['user']) ? $db['user'] : '';
$db['pass'] = isset($db['pass']) ? $db['pass'] : '';
$db['name'] = isset($db['name']) ? $db['name'] : '';

/* ---------- Conexão ---------- */
$mysqli = @mysqli_connect($db['host'], $db['user'], $db['pass'], $db['name']);
if (!$mysqli) {
    $msg = 'Nao foi possivel conectar no servidor com os dados informados.';
    header('Location: ./passo2.php?id=02&error=' . urlencode($msg));
    exit;
}

/* ---------- Execução do dump SQL ---------- */
$rootDir = dirname(dirname(__FILE__));
$dumpFile = $rootDir . '/vipcomdump.sql';

if (!is_file($dumpFile) || !filesize($dumpFile)) {
    $msg = 'O arquivo ' . $dumpFile . ' nao existe ou esta vazio. Nao foi possivel criar as tabelas.';
    header('Location: ./passo2.php?id=02&error=' . urlencode($msg));
    exit;
}

$vipcomdump = @file_get_contents($dumpFile);
$errosql = '';

if ($vipcomdump !== false && trim($vipcomdump) !== '') {
    if (!@mysqli_multi_query($mysqli, $vipcomdump)) {
        $errosql .= 'Erro ao executar o dump: ' . mysqli_error($mysqli) . "\n";
    } else {
        // Consumir todos os resultados e coletar erros subsequentes
        do {
            if ($res = mysqli_store_result($mysqli)) {
                mysqli_free_result($res);
            }
            if (mysqli_errno($mysqli)) {
                $errosql .= 'Erro: ' . mysqli_error($mysqli) . "\n";
            }
        } while (mysqli_more_results($mysqli) && mysqli_next_result($mysqli));
    }
} else {
    $errosql .= 'Nao foi possivel ler o arquivo ' . $dumpFile . '.';
}

/* ---------- Salvar configuração (mantido do seu fluxo) ---------- */
$PHP = $INI = array('db' => $db);
if (function_exists('save_config')) {
    @save_config();
}

/* ---------- Preparos da UI ---------- */
$logoWeb  = '/demos/ravenapro/teste/setup/images/logo.png';
$logoDisk = $_SERVER['DOCUMENT_ROOT'] . $logoWeb;
$ver      = file_exists($logoDisk) ? filemtime($logoDisk) : time();
$logoSrc  = $logoWeb . '?v=' . $ver;

$temErroSql = ($errosql !== '');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="ISO-8859-1">
  <title>Setup Vipcom — Configurando</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    :root{
      --bg:#0f172a; --panel:#0b1226; --muted:#a3aed0; --text:#e2e8f0;
      --brand:#22c55e; --brand-weak:#16a34a; --danger:#ef4444; --line:#1f2a44;
      --card:#0b1226; --card-2:#0d1630; --shadow:0 10px 30px rgba(0,0,0,.35);
      --radius:14px; --radius-sm:10px; --input:#0b1430;
    }
    *{box-sizing:border-box}
    html,body{height:100%}
    body{
      margin:0; background:
        radial-gradient(1200px 600px at 10% -10%, #1b2a55 0%, transparent 60%),
        radial-gradient(900px 500px at 110% 10%, #1a3a3a 0%, transparent 55%),
        linear-gradient(180deg, #0b1022 0%, #0a0f20 100%);
      color:var(--text); font:14px/1.45 system-ui,-apple-system,Segoe UI,Roboto,Ubuntu,Cantarell,Noto Sans,Helvetica,Arial;
    }
    .wrap{max-width:980px; margin:32px auto; padding:20px;}
    header.app{display:flex; align-items:center; justify-content:space-between; gap:16px; margin-bottom:18px;}
    .brand{display:flex; align-items:center; gap:12px; text-decoration:none; color:var(--text)}
    .brand .logo{height:48px; display:inline-flex; align-items:center; justify-content:center; border-radius:8px; padding:4px 8px; background:#0b142a; border:1px solid #1c2a4f; box-shadow:var(--shadow);}
    .brand .logo img{max-height:42px; width:auto; display:block}
    .brand h1{font-size:18px; margin:0; font-weight:700}
    .brand small{display:block; color:var(--muted); font-weight:500}

    .steps{display:grid; grid-template-columns:repeat(4,1fr); gap:10px; margin:6px 0 20px;}
    .step{background:var(--card-2); border:1px solid var(--line); border-radius:var(--radius-sm); padding:10px 12px; display:flex; align-items:center; gap:10px;}
    .step .badge{width:26px; height:26px; border-radius:7px; display:grid; place-items:center; background:#0c1a38; border:1px solid #19315f; color:#93c5fd; font-weight:700;}
    .step.active{border-color:#22c55e; box-shadow:0 10px 20px rgba(34,197,94,.18) inset, 0 0 0 1px rgba(34,197,94,.25)}
    .step.active .badge{background:#22c55e; border-color:#16a34a; color:#04140b}
    .step span{font-weight:700; font-size:12px; color:#cbd5e1}

    .card{background:rgba(9,14,28,.9); border:1px solid var(--line); border-radius:var(--radius); box-shadow:var(--shadow); overflow:hidden;}
    .card header{padding:16px 18px; display:flex; align-items:center; justify-content:space-between; gap:12px; border-bottom:1px dashed var(--line); background:linear-gradient(180deg, rgba(34,197,94,.08), rgba(34,197,94,.02));}
    .title{font-size:16px; font-weight:800; letter-spacing:.3px}
    .help{font-size:12px; color:#a3aed0}
    .help a{color:#86efac; text-underline-offset:3px}

    .body{padding:16px; display:grid; gap:16px;}
    .ok{background:rgba(34,197,94,.08); border:1px solid rgba(34,197,94,.35); color:#86efac; padding:12px; border-radius:10px}
    .err{background:rgba(239,68,68,.10); border:1px solid rgba(239,68,68,.35); color:#fecaca; padding:12px; border-radius:10px; white-space:pre-wrap}

    form.admin{display:grid; grid-template-columns:1fr; gap:12px}
    @media (min-width:720px){ form.admin{grid-template-columns:1fr 1fr} }
    .field{display:flex; flex-direction:column; gap:6px}
    label{font-weight:700; color:#cbd5e1}
    input[type="text"], input[type="password"]{
      width:100%; padding:12px 12px; border-radius:10px; border:1px solid #223258; background:var(--input); color:var(--text);
      outline:none; transition:border-color .2s ease, box-shadow .2s ease;
    }
    input:focus{border-color:#22c55e; box-shadow:0 0 0 3px rgba(34,197,94,.15)}
    .hint{font-size:12px; color:#a3aed0}

    .actions{display:flex; gap:10px; justify-content:flex-end; padding:14px 16px; border-top:1px dashed var(--line); background:rgba(255,255,255,.02);}
    .btn{appearance:none; border:1px solid transparent; padding:10px 14px; font-weight:800; border-radius:10px; cursor:pointer; transition:.2s transform ease,.2s background ease,.2s border-color ease; letter-spacing:.3px;}
    .btn:active{transform:translateY(1px)}
    .btn.secondary{background:#0b1430; color:#cbd5e1; border-color:#1e2b4d;}
    .btn.primary{background:linear-gradient(135deg, var(--brand), var(--brand-weak)); color:#04140b; border-color:var(--brand-weak); box-shadow:0 8px 18px rgba(34,197,94,.25);}
  </style>
</head>
<body>
  <div class="wrap">
    <header class="app">
      <a href="index.php" class="brand" aria-label="Setup Vipcom">
        <span class="logo">
        <a target="_blank" href="https://vipcomsistemas.com.br/"><img src="images/logo.png" alt="Vipcom Sistemas" loading="eager"></a>
        </span>
        <div>
          <h1>Setup Vipcom</h1>
          <small>Assistente de instalação</small>
        </div>
      </a>
    </header>

    <nav class="steps">
      <div class="step"><div class="badge">1</div><span>Requisitos</span></div>
      <div class="step"><div class="badge">2</div><span>Instalando</span></div>
      <div class="step active"><div class="badge">3</div><span>Configurando</span></div>
      <div class="step"><div class="badge">4</div><span>Finalizando</span></div>
    </nav>

    <div class="card">
      <header>
        <div class="title">Resultado da configura&ccedil;&atilde;o do banco</div>
        <div class="help">Caso prefira, voc&ecirc; pode importar o <b>vipcomdump.sql</b> manualmente via phpMyAdmin.</div>
      </header>

      <div class="body">
        <?php if ($temErroSql): ?>
          <div class="err">
            <b>Ocorreram erros ao criar as tabelas:</b>
<?php echo htmlspecialchars($errosql, ENT_QUOTES, 'ISO-8859-1'); ?>

            <div class="hint" style="margin-top:8px">
              Sugest&atilde;o: apague as tabelas existentes e importe o <b>vipcomdump.sql</b> manualmente.
              Em seguida, rode este SQL para criar o admin padr&atilde;o:
              <br><br>
              delete from user where id = 1;<br>
              INSERT INTO `user` (`id`, `email`, `username`, `realname`, `password`, `manager`, `senha`) VALUES
              (1, 'suportevipcom@gmail.com', 'admin', 'Administrador', '325825be566fa25abab599ff5e00442b', 'Y', '1234567890');
              <br><br>
              Admin: <b>admin</b> / Senha: <b>1234567890</b> &nbsp;?&nbsp; <span class="hint">/vipmin</span>
            </div>
          </div>

          <div class="actions">
            <button type="button" class="btn secondary" onclick="window.location.href='passo2.php?id=02'">Voltar ao Passo 2</button>
          </div>
        <?php else: ?>
          <div class="ok"><b>Importa&ccedil;&atilde;o das tabelas conclu&iacute;da com sucesso.</b></div>

          <form id="form" class="admin" method="post" action="passo4.php" onsubmit="return validarAdmin();">
            <input type="hidden" name="id" value="04">

            <div class="field">
              <label for="emailadmin">Email do Administrador</label>
              <input type="text" id="emailadmin" name="emailadmin" placeholder="seu-email@dominio.com">
              <div class="hint">Usado para acessar o gerenciador</div>
            </div>

            <div class="field">
              <label for="loginadmin">Login</label>
              <input type="text" id="loginadmin" name="loginadmin" placeholder="admin">
              <div class="hint">Nome de usu&aacute;rio do painel</div>
            </div>

            <div class="field">
              <label for="nomeadmin">Nome</label>
              <input type="text" id="nomeadmin" name="nomeadmin" placeholder="Administrador">
            </div>

            <div class="field">
              <label for="senhaadmin">Senha</label>
              <input type="password" id="senhaadmin" name="senhaadmin" placeholder="********">
              <div class="hint">Senha para entrar no gerenciador</div>
            </div>

            <div class="actions" style="grid-column:1 / -1">
              <button type="button" class="btn secondary" onclick="window.location.href='passo2.php?id=02'">Voltar</button>
              <button type="submit" class="btn primary">PR&Oacute;XIMO</button>
            </div>
          </form>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <script>
    function validarAdmin(){
      var email = document.getElementById('emailadmin');
      var login = document.getElementById('loginadmin');
      var nome  = document.getElementById('nomeadmin');
      var senha = document.getElementById('senhaadmin');

      if(!email.value.trim()){
        alert('Por favor, informe o email do administrador'); email.focus(); return false;
      }
      if(!login.value.trim()){
        alert('Por favor, informe o login do administrador'); login.focus(); return false;
      }
      if(!nome.value.trim()){
        alert('Por favor, informe o nome do administrador'); nome.focus(); return false;
      }
      if(!senha.value.trim()){
        alert('Por favor, informe a senha do administrador'); senha.focus(); return false;
      }
      return true;
    }
  </script>
  
  <?php
/* ===========================================================
 * Rodapé Vipcom — WhatsApp de Suporte (Autocontido)
 * Cole este bloco imediatamente ANTES do </body> em todas as páginas.
 * =========================================================== */

/* 1) Seu número do WhatsApp em formato internacional (DDI+DDD+NÚMERO, só dígitos) */
$whatsappNumber = '5531992417207'; // Ex.: SP (11) 91234-5678 => '5511912345678' 

/* 2) Detecta a URL COMPLETA da instalação (padrão: override fixo abaixo) */
$https     = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443);
$scheme    = $https ? 'https' : 'http';
$host      = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : (isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : 'localhost');
$scriptDir = rtrim(str_replace('\\','/', dirname(isset($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : '')), '/');
$autoUrl   = $scheme . '://' . $host . ($scriptDir ? $scriptDir.'/' : '/');

/* 3) Override FIXO da URL do setup (recomendado por você) */
$installUrl = 'https://www.vipcomsites.com.br/demos/ravenapro/teste/setup/';

/*  -> Se quiser usar a detecção automática, comente a linha acima e descomente a abaixo: */
// $installUrl = $autoUrl;

/* 4) Monta o link do WhatsApp com a URL COMPLETA na mensagem */
$waText = rawurlencode("Ola, preciso de ajuda para instalar meu site: {$installUrl}");
$waLink = "https://wa.me/{$whatsappNumber}?text={$waText}";
?>

<style>
  /* ===== Rodapé Vipcom (escopado) ===== */
  .vip-footer{
    margin-top:24px; padding:16px 20px; border-top:1px dashed #1e2b4d;
    background:rgba(255,255,255,.02);
  }
  .vip-footer__inner{
    max-width:980px; margin:0 auto; display:flex; align-items:center;
    justify-content:space-between; gap:12px; flex-wrap:wrap;
    color:#a3aed0; font:14px/1.45 system-ui,-apple-system,"Segoe UI",Roboto,Ubuntu,Cantarell,Noto Sans,Helvetica,Arial;
  }
  .vip-footer__txt{color:#a3aed0}
  .vip-wa{
    display:inline-flex; align-items:center; gap:10px; text-decoration:none; font-weight:800;
    background:#25D366; color:#062b11; padding:10px 14px; border-radius:12px; border:1px solid #1ebe57;
    box-shadow:0 8px 18px rgba(37,211,102,.28); transition:.2s transform ease,.2s box-shadow ease;
    white-space:nowrap;
  }
  .vip-wa:hover{transform:translateY(-1px); box-shadow:0 12px 24px rgba(37,211,102,.34)}
  .vip-wa__icon{
    width:18px; height:18px; display:inline-block; background:currentColor;
    -webkit-mask:url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" fill="%23000" viewBox="0 0 32 32"><path d="M19.11 17.33c-.28-.14-1.64-.81-1.9-.9-.26-.1-.45-.14-.64.14-.19.28-.73.9-.9 1.08-.17.19-.33.21-.61.07-.28-.14-1.18-.43-2.25-1.37-.83-.74-1.39-1.65-1.55-1.93-.16-.28-.02-.43.12-.57.12-.12.28-.33.42-.5.14-.17.19-.28.28-.47.09-.19.05-.35-.02-.5-.07-.14-.64-1.55-.88-2.12-.23-.56-.47-.48-.64-.49-.17-.01-.35-.01-.54-.01s-.5.07-.76.35c-.26.28-1.01.98-1.01 2.38 0 1.4 1.03 2.75 1.17 2.94.14.19 2.02 3.09 4.9 4.33.68.29 1.21.47 1.62.6.68.22 1.3.19 1.79.12.55-.08 1.64-.67 1.87-1.32.23-.65.23-1.21.16-1.33-.07-.12-.26-.19-.54-.33z"/><path d="M26.7 5.3C23.9 2.5 20.2 1 16.3 1 8.3 1 1.9 7.3 1.9 15.2c0 2.6.7 5.1 2 7.3L1 31l8.7-2.8c2.1 1.1 4.5 1.6 6.9 1.6 7.9 0 14.3-6.4 14.3-14.2 0-3.8-1.5-7.5-4.2-10.3zM16.6 27.7c-2.2 0-4.3-.6-6.1-1.6l-.4-.2-5.1 1.7 1.7-5-.3-.5c-1.2-2-1.8-4.3-1.8-6.6C4.7 8.6 10 3.4 16.4 3.4c3.2 0 6.2 1.2 8.5 3.5 2.3 2.3 3.5 5.3 3.5 8.5-.1 6.5-5.4 12.3-11.8 12.3z"/></svg>') center/contain no-repeat;
            mask:url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" fill="%23000" viewBox="0 0 32 32"><path d="M19.11 17.33c-.28-.14-1.64-.81-1.9-.9-.26-.1-.45-.14-.64.14-.19.28-.73.9-.9 1.08-.17.19-.33.21-.61.07-.28-.14-1.18-.43-2.25-1.37-.83-.74-1.39-1.65-1.55-1.93-.16-.28-.02-.43.12-.57.12-.12.28-.33.42-.5.14-.17.19-.28.28-.47.09-.19.05-.35-.02-.5-.07-.14-.64-1.55-.88-2.12-.23-.56-.47-.48-.64-.49-.17-.01-.35-.01-.54-.01s-.5.07-.76.35c-.26.28-1.01.98-1.01 2.38 0 1.4 1.03 2.75 1.17 2.94.14.19 2.02 3.09 4.9 4.33.68.29 1.21.47 1.62.6.68.22 1.3.19 1.79.12.55-.08 1.64-.67 1.87-1.32.23-.65.23-1.21.16-1.33-.07-.12-.26-.19-.54-.33z"/><path d="M26.7 5.3C23.9 2.5 20.2 1 16.3 1 8.3 1 1.9 7.3 1.9 15.2c0 2.6.7 5.1 2 7.3L1 31l8.7-2.8c2.1 1.1 4.5 1.6 6.9 1.6 7.9 0 14.3-6.4 14.3-14.2 0-3.8-1.5-7.5-4.2-10.3zM16.6 27.7c-2.2 0-4.3-.6-6.1-1.6l-.4-.2-5.1 1.7 1.7-5-.3-.5c-1.2-2-1.8-4.3-1.8-6.6C4.7 8.6 10 3.4 16.4 3.4c3.2 0 6.2 1.2 8.5 3.5 2.3 2.3 3.5 5.3 3.5 8.5-.1 6.5-5.4 12.3-11.8 12.3z"/></svg>') center/contain no-repeat;
  }
</style>

<footer class="vip-footer">
  <div class="vip-footer__inner">
    <div class="vip-footer__txt">Precisa de ajuda? Fale com nosso suporte.</div>
    <a class="vip-wa" href="<?php echo htmlspecialchars($waLink, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener" aria-label="Falar com suporte via WhatsApp">
      <span class="vip-wa__icon" aria-hidden="true"></span>
      <span>WhatsApp do Suporte</span>
    </a>
  </div>
</footer>


</body>
</html>
