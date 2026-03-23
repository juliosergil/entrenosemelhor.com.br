<?php
// ===== Ajustes =====
$whatsappNumber = '5531992417207';

// Logo (cache-busting)
$logoWeb  = './images/logo.png';
$logoDisk = isset($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] . $logoWeb : '';
$ver      = ($logoDisk && file_exists($logoDisk)) ? filemtime($logoDisk) : time();
$logoSrc  = $logoWeb . '?v=' . $ver;

$host        = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost';
$basePath    = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\'); // diretório do arquivo atual
$installUrl  = $scheme . '://' . $host . ($basePath ? $basePath.'/' : '/');

 
// Mensagem com a URL COMPLETA
$waText = rawurlencode("Olá, preciso de ajuda para instalar meu site: {$installUrl}");
$waLink = "https://wa.me/{$whatsappNumber}?text={$waText}";

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>Setup Vipcom — Início</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&display=swap" rel="stylesheet">
  <style>
    :root{
      --bg1:#0b1022; --bg2:#0a0f20;
      --brand:#22c55e; --brand-weak:#16a34a;
      --text:#e2e8f0; --muted:#a3aed0;
      --card:#0d1630; --line:#1e2b4d;
      --shadow:0 18px 45px rgba(0,0,0,.35);
      --radius:18px;
      --wa:#25D366; --wa-dark:#1ebe57;
    }
    *{box-sizing:border-box}
    html,body{height:100%}
    body{
      margin:0; color:var(--text);
      font:16px/1.45 system-ui,-apple-system,"Segoe UI",Roboto,Ubuntu,Cantarell,Noto Sans,Helvetica,Arial;
      background:
        radial-gradient(1200px 600px at 10% -10%, #1b2a55 0%, transparent 60%),
        radial-gradient(900px 500px at 110% 10%, #1a3a3a 0%, transparent 55%),
        linear-gradient(180deg, var(--bg1) 0%, var(--bg2) 100%);
      display:flex; min-height:100%;
      flex-direction:column;
    }
    .wrap{max-width:980px; margin:0 auto; padding:40px 20px; flex:1 0 auto; display:flex; align-items:center; justify-content:center;}
    .card{
      width:100%; text-align:center; background:rgba(9,14,28,.85);
      border:1px solid var(--line); border-radius:var(--radius);
      box-shadow:var(--shadow); padding:32px 24px;
    }
    .logo{
      display:inline-flex; align-items:center; justify-content:center;
      height:64px; border-radius:12px; padding:8px 12px;
      background:#0b142a; border:1px solid #1c2a4f; box-shadow:var(--shadow);
      margin-bottom:16px;
    }
    .logo img{max-height:48px; width:auto; display:block}
    h1{
      font-family:"Quicksand", system-ui, -apple-system, "Segoe UI", Roboto, Ubuntu, Cantarell, "Noto Sans", Helvetica, Arial;
      font-weight:700; letter-spacing:.2px; margin:6px 0 6px; font-size:40px;
    }
    .subtitle{color:var(--muted); margin-bottom:22px}
    .cta{
      display:inline-flex; align-items:center; gap:10px;
      padding:14px 22px; font-weight:800; letter-spacing:.3px; text-decoration:none;
      color:#04140b; border:1px solid var(--brand-weak);
      background:linear-gradient(135deg, var(--brand), var(--brand-weak));
      border-radius:12px; box-shadow:0 10px 22px rgba(34,197,94,.28);
      transition:.2s transform ease,.2s box-shadow ease;
    }
    .cta:hover{transform:translateY(-1px); box-shadow:0 14px 28px rgba(34,197,94,.35)}
    .cta .arrow{font-size:18px; transform:translateY(-1px)}
    .video{margin-top:26px; aspect-ratio:16/9; width:100%; border-radius:14px; overflow:hidden; border:1px solid var(--line); background:#000}
    .video iframe{width:100%; height:100%; display:block; border:0}
    .hint{color:var(--muted); margin-top:12px; font-size:14px}

    /* Footer com WhatsApp */
    footer.footer{
      margin-top:24px; padding:16px 20px; border-top:1px dashed var(--line);
      background:rgba(255,255,255,.02); flex-shrink:0;
    }
    .footer-inner{max-width:980px; margin:0 auto; display:flex; align-items:center; justify-content:space-between; gap:12px; flex-wrap:wrap;}
    .support{color:var(--muted); font-size:14px}
    .wa-btn{
      display:inline-flex; align-items:center; gap:10px; text-decoration:none; font-weight:800;
      background:var(--wa); color:#062b11; padding:10px 14px; border-radius:12px; border:1px solid var(--wa-dark);
      box-shadow:0 8px 18px rgba(37,211,102,.28); transition:.2s transform ease,.2s box-shadow ease;
    }
    .wa-btn:hover{transform:translateY(-1px); box-shadow:0 12px 24px rgba(37,211,102,.34)}
    .wa-icon{
      width:18px; height:18px; display:inline-block;
      background:currentColor; mask:url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" fill="%23000000" viewBox="0 0 32 32"><path d="M19.11 17.33c-.28-.14-1.64-.81-1.9-.9-.26-.1-.45-.14-.64.14-.19.28-.73.9-.9 1.08-.17.19-.33.21-.61.07-.28-.14-1.18-.43-2.25-1.37-.83-.74-1.39-1.65-1.55-1.93-.16-.28-.02-.43.12-.57.12-.12.28-.33.42-.5.14-.17.19-.28.28-.47.09-.19.05-.35-.02-.5-.07-.14-.64-1.55-.88-2.12-.23-.56-.47-.48-.64-.49-.17-.01-.35-.01-.54-.01s-.5.07-.76.35c-.26.28-1.01.98-1.01 2.38 0 1.4 1.03 2.75 1.17 2.94.14.19 2.02 3.09 4.9 4.33.68.29 1.21.47 1.62.6.68.22 1.3.19 1.79.12.55-.08 1.64-.67 1.87-1.32.23-.65.23-1.21.16-1.33-.07-.12-.26-.19-.54-.33z"/><path d="M26.7 5.3C23.9 2.5 20.2 1 16.3 1 8.3 1 1.9 7.3 1.9 15.2c0 2.6.7 5.1 2 7.3L1 31l8.7-2.8c2.1 1.1 4.5 1.6 6.9 1.6 7.9 0 14.3-6.4 14.3-14.2 0-3.8-1.5-7.5-4.2-10.3zM16.6 27.7c-2.2 0-4.3-.6-6.1-1.6l-.4-.2-5.1 1.7 1.7-5-.3-.5c-1.2-2-1.8-4.3-1.8-6.6C4.7 8.6 10 3.4 16.4 3.4c3.2 0 6.2 1.2 8.5 3.5 2.3 2.3 3.5 5.3 3.5 8.5-.1 6.5-5.4 12.3-11.8 12.3z"/></svg>') center / contain no-repeat;
    }
  </style>
</head>
<body>
  <div class="wrap">
    <main class="card">
      <div class="logo">
        <a target="_blank" href="https://vipcomsistemas.com.br/"><img src="<?php echo htmlspecialchars($logoSrc, ENT_QUOTES, 'UTF-8'); ?>" alt="Vipcom Sistemas" loading="eager"></a>
      </div>
      <h1>Vamos instalar o seu site</h1>
      <div class="subtitle">Assistente de instala&ccedil;&atilde;o da Vipcom</div>

      <a class="cta" href="index1.php">
        <span>Iniciar</span> <span class="arrow">→</span>
      </a>

      <div class="video">
        <iframe src="https://www.youtube.com/embed/50S6Ay11r_s"
                title="Tutorial de Instalação"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                allowfullscreen>
        </iframe>
      </div>

      <div class="hint">Se tiver d&uacute;vidas, clique no v&iacute;deo acima para ver o passo a passo.</div>
    </main>
  </div>

  <footer class="footer">
    <div class="footer-inner">
      <div class="support">Precisa de ajuda? Fale com nosso suporte.</div>
      <a class="wa-btn" href="<?php echo htmlspecialchars($waLink, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener" aria-label="Falar com suporte via WhatsApp">
        <span class="wa-icon"></span>
        <span>WhatsApp do Suporte</span>
      </a>
    </div>
  </footer>
</body>
</html>
