<?php include template("manage_header"); ?>
<link rel="stylesheet" href="/media/css/template.css" />

<div id="bdw" class="bdw">
  <div id="bd" class="cf">
    <div id="system">
      <style>
        /* ====== Página de Imagens — Vipmin 3.0 look ====== */
        .vip-wrap{ padding:8px 0 24px; }
        .vip-title h4{ margin:0; }
        .vip-grid{
          display:grid;
          grid-template-columns: repeat(2,minmax(0,1fr));
          gap:26px;
        }
        @media (max-width:1100px){ .vip-grid{ grid-template-columns: 1fr; } }

        .vip-card{
          display:flex; gap:20px;
          background:#fff; border:1px solid #e5e7eb; border-radius:14px;
          padding:16px; align-items:flex-start;
          box-shadow:0 8px 20px rgba(17,24,39,.06);
        }
        .vip-thumb{
          width:34%; max-width:100%; height:160px; object-fit:scale-down;
          border-radius:12px; border:1px solid #e5e7eb; background:#f8fafc;
        }
        .vip-body{ flex:1 1 auto; min-width:0; }

        .vip-meta{
          margin-top:8px; color:#6b7280; font-size:.92rem;
          line-height:1.35;
        }

        .vip-actions{ display:flex; gap:10px; align-items:center; margin-top:10px; flex-wrap:wrap; }
        .vip-btn{
          appearance:none; border:0; cursor:pointer;
          padding:10px 16px; font-weight:700; border-radius:10px;
          box-shadow:0 6px 16px rgba(37,99,235,.18);
          background:#2563eb; color:#fff;
          transition:transform .15s ease, filter .15s ease, box-shadow .15s ease;
        }
        .vip-btn:hover{ transform:translateY(-1px); filter:brightness(1.02); }
        .vip-btn:active{ transform:none; filter:brightness(.98); }

        /* input file “fantasma” + label estilizado */
        .vip-file{ position:absolute; left:-9999px; }
        .vip-choose{
          display:inline-flex; align-items:center; justify-content:center;
          padding:9px 14px; border-radius:10px; border:1px solid #d1d5db;
          background:#fff; color:#111827; font-weight:600; cursor:pointer;
          transition:box-shadow .15s ease, transform .15s ease;
        }
        .vip-choose:hover{ box-shadow:0 4px 12px rgba(0,0,0,.06); transform:translateY(-1px); }

        .vip-chosen{
          font-size:.9rem; color:#374151; padding:4px 8px; background:#f3f4f6;
          border-radius:8px; border:1px dashed #e5e7eb;
          max-width:420px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;
        }

        /* spinner por item */
        .vip-spinner{
          display:inline-flex; align-items:center; gap:8px;
          visibility:hidden; color:#2563eb; font-weight:700;
        }
        .vip-spinner .dot{
          width:8px; height:8px; border-radius:999px; background:#2563eb;
          animation: vip-bounce .9s infinite ease-in-out;
        }
        .vip-spinner .dot:nth-child(2){ animation-delay:.15s; }
        .vip-spinner .dot:nth-child(3){ animation-delay:.3s; }
        @keyframes vip-bounce{
          0%, 80%, 100%{ transform:scale(0); }
          40%{ transform:scale(1); }
        }

        /* ajustes do tema legado */
        #content .inputtip{ font-size:14px; }
        .dashboard ul{ margin-bottom:16px; }
      </style>

      <div class="dashboard" id="dashboard">
        <ul><?php echo mcurrent_system('redes'); ?></ul>
      </div>

      <div id="content" class="clear mainwide">
        <div class="clear box">
          <div class="box-content">
            <div class="option_box">
              <div class="top-heading group vip-title">
                <div class="left_float">
                  <h4>Gerenciar Imagens <!-- — <small>Após atualizar, aperte <strong>CTRL + F5</strong> para limpar o cache</small> --></h4>
                </div>
              </div>

              <div class="vip-wrap">
                <div id="container_box" style="background:#fff; border-radius:16px; padding:16px;">
                  <div class="vip-grid">
<?php
$imagens_excluidas = array(
  'logoweb.png','ajax-loader2.gif','tail.gif','tail1.gif','logo_footer.png','logofeed.png','loading.png',
  'arrow_left.png','arrow_right.png','loading_bg_32.png','loading_32.png','header-overlay.png','arrow-down.png',
  'arrow-up.png','b05.png','bg_menuadmin.png','american-express-icon.png','american_express.png','btbcash.png',
  'visa.png','visa-icon.png','bt_fechar_layer.png','ajax-loader.gif','down.png','offlinemsg.jpg','boleto.jpg',
  'offlinechat.jpg','btn_close_login.png','hover_last_video.png','hover_video.png','hover-top.png','mastercard-icon.png',
  'master_card.png','liquid_control.png','ico_redes_rodape.png','pointer_cidade.png','selectArrow.png','nav_carousel_top.png',
  'offlinechat.jpg','rss.jpg','paypal.jpg','chatoff.png','paypal.png','rss.png','pagseguro_banner.png','mercadopago.png',
  'chatofflinel.png','separacao_top.png','setas_menu_modelo.png','patternBgHome.png','spinner.gif','refresh.png',
  'pointyd.png','pointyc.png','pointyb.png','Nextel.png','video.png','yap.png','new-rss-xml-feed-icon.png','up.png',
  'bg_footer.jpg','email-ok.png','txt-news-bg.png',
);

function getExtensao($arquivo) {
  $p = pathinfo($arquivo);
  return strtolower($p['extension'] ?? '');
}

$dir = WWW_ROOT . "/skin/padrao/images";
$dh = @opendir($dir);
if ($dh) {
  while ($file = readdir($dh)) {
    // apenas arquivos “comuns”
    if ($file === '.' || $file === '..') continue;
    if (in_array($file, $imagens_excluidas, true)) continue;
    $ext = getExtensao($file);
    if (!in_array($ext, ['png','jpg','jpeg','gif','webp','ico'], true)) continue;

    $imagesize = @getimagesize($dir . "/" . $file);
    if (!$imagesize) continue;
    $x = $imagesize[0];
    $y = $imagesize[1];

    $idBase = md5($file);
    $fileInputId = "file_$idBase";
    $spinnerId = "sp_$idBase";
    $chosenId  = "ch_$idBase";
    $formId    = "fm_$idBase";
    ?>
    <div class="vip-card">
      <img class="vip-thumb" src="<?=$ROOTPATH?>/skin/padrao/images/<?=htmlspecialchars($file)?>" alt="<?=htmlspecialchars($file)?>" loading="lazy" />

      <div class="vip-body">
        <div class="vip-meta">
          <strong><?=htmlspecialchars($file)?></strong> — Resolução ideal (<?=$x?> × <?=$y?>)
        </div>

        <form id="<?=$formId?>" action="<?php echo $INI['system']['wwwprefix'] ?>/include/upload.php?nome=<?=htmlspecialchars($file)?>" method="post" enctype="multipart/form-data" target="upload_target" onsubmit="return startUpload(this);">
          <div class="vip-actions">
            <label class="vip-choose" for="<?=$fileInputId?>">Escolher ficheiro</label>
            <input class="vip-file" id="<?=$fileInputId?>" name="myfile" type="file" accept=".png,.jpg,.jpeg,.gif,.webp,.ico" />
            <span class="vip-chosen" id="<?=$chosenId?>">Nenhum ficheiro selecionado</span>

            <button type="submit" class="vip-btn">Upload</button>

            <span class="vip-spinner" id="<?=$spinnerId?>">
              <span class="dot"></span><span class="dot"></span><span class="dot"></span>
              Enviando...
            </span>
          </div>

          <input type="hidden" value="<?php echo $INI['system']['wwwprefix'] ?>" name="local">
          <input type="hidden" value="diversas" name="tipo">
        </form>
      </div>
    </div>
    <?php
  }
  closedir($dh);
} else {
  echo '<div class="vip-card"><div class="vip-body"><div class="vip-meta" style="color:#b91c1c;"><strong>Erro:</strong> Não foi possível abrir o diretório de imagens: ' . htmlspecialchars($dir) . '</div></div></div>';
}
?>
                  </div><!-- .vip-grid -->

                  <!-- iframe “alvo” para o upload -->
                  <iframe id="upload_target" name="upload_target" src="#" style="width:0;height:0;border:0;"></iframe>
                </div>
              </div>

            </div>
          </div>
          <div class="box-bottom"></div>
        </div>
      </div>

      <div id="sidebar"></div>
    </div>
  </div>
</div>

<script>
/* ===== Comportamento: spinner por form + nome do arquivo ===== */
let currentSpinner = null;

function startUpload(formEl){
  // mostra o spinner do form atual
  currentSpinner = formEl.querySelector('.vip-spinner');
  if(currentSpinner){ currentSpinner.style.visibility = 'visible'; }

  return true; // continua submit para o iframe
}

// Chamado pelo upload.php (parent.stopUpload(N))
function stopUpload(success){
  if(currentSpinner){ currentSpinner.style.visibility = 'hidden'; currentSpinner = null; }

  if(success == 1 || success == 2){
    alert('Arquivo enviado com sucesso! Acesse o site e aperte CTRL+F5 para limpar o cache do navegador.');
    // Se quiser recarregar a página:
    // location.reload();
  }else{
    alert('Não foi possível enviar o arquivo.');
  }
}

/* Atualiza “nome do arquivo” ao escolher */
document.addEventListener('change', function(e){
  if(e.target && e.target.matches('.vip-file')){
    const span = e.target.form.querySelector('.vip-chosen');
    if(!span) return;
    if(e.target.files && e.target.files[0]){
      span.textContent = e.target.files[0].name;
    }else{
      span.textContent = 'Nenhum ficheiro selecionado';
    }
  }
});
</script>
