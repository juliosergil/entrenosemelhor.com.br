<?php include template("manage_header"); ?>

<div id="bdw" class="bdw">
<div id="bd" class="cf">
<div id="system">

  <style>
    /* —— VIPMIN 3.0: Banners ————————————————————————————— */
    .vip-stickybar{
      position: sticky; top: 8px; z-index: 3; display:flex; align-items:center; justify-content:space-between;
      padding:10px 12px; margin-bottom:12px; background:linear-gradient(180deg,#f8fbff,#f4f7fc);
      border:1px solid #e6ecf6; border-radius:12px; box-shadow:0 8px 22px rgba(16,24,40,.05);
    }
    .vip-stickybar h4{ margin:0; font-weight:800; letter-spacing:.2px; color:#0f1a2b }
    .vip-save{
      display:inline-flex; align-items:center; gap:8px; padding:10px 16px; border:0; border-radius:12px; cursor:pointer;
      color:#fff; font-weight:800; background:linear-gradient(180deg,#2f6df6,#1d56dc); box-shadow:0 8px 18px rgba(47,109,246,.28);
    }
    .vip-save[disabled]{ opacity:.6; cursor:not-allowed }
    .vip-notice{
      margin:10px 0 18px; padding:12px 14px; background:#f8fafc; border:1px dashed #dbe3f3; border-left:4px solid #2563eb;
      border-radius:12px; color:#334155;
    }
    .vip-chip{ display:inline-flex; align-items:center; gap:8px; padding:6px 10px; border-radius:999px;
      border:1px solid #e6ecf6; background:#fff; font-weight:700; box-shadow:0 3px 10px rgba(16,24,40,.05);}
    .vip-chip b{font-weight:800;color:#0f172a}

    /* Accordion (nativo <details>) */
    .vip-acc{ border:1px solid #e9edf3; border-radius:14px; background:#fff; box-shadow:0 6px 18px rgba(16,24,40,.06); margin-bottom:14px;}
    .vip-acc > summary{
      list-style:none; cursor:pointer; padding:14px 16px; display:flex; align-items:center; justify-content:space-between;
      font-weight:800; color:#0f172a;
    }
    .vip-acc[open] > summary{ border-bottom:1px solid #eef2f7; }
    .vip-acc summary::-webkit-details-marker{ display:none; }
    .vip-acc__right{ display:flex; align-items:center; gap:10px; }
    .vip-tag{ padding:4px 8px; border-radius:999px; background:#eef4ff; color:#1e3a8a; font-weight:800; font-size:12px; }
    .vip-btn{
      padding:8px 12px; border-radius:10px; border:1px solid #d9e2f1; background:#fff; font-weight:700; cursor:pointer;
    }
    .vip-acc__body{ padding:14px 16px; }
    .vip-helper{ color:#6b7280; font-size:12.5px; margin:4px 0 10px; }

    /* CKEditor ocupa toda a largura do card */
    .vip-editor-wrap{ width:100%; }
    .vip-editor-wrap textarea{ width:100%; height:420px; }

    /* Link bar acima */
    .vip-links{
      display:flex; gap:10px; flex-wrap:wrap; align-items:center; margin:6px 0 14px;
    }
  </style>

  <?php
    // contagem de banners preenchidos (para o chip superior)
    $vip_filled = 0;
    for ($i=1; $i<11; $i++) {
      if (!empty(trim($INI['bulletin'][$i] ?? ''))) $vip_filled++;
    }
  ?>

  <div id="content" class="clear mainwide">
    <div class="clear box">
      <div class="box-content">
        <div class="option_box">

          <!-- Barra fixa topo -->
          <div class="vip-stickybar">
            <h4>Banners rotativos na página de detalhe — evite arquivos com acentos, espaços e ( . _ - )</h4>
            <button type="button" class="vip-save" id="btnSave" onclick="doupdate()">
              <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor" aria-hidden="true"><path d="M17 3H7a2 2 0 0 0-2 2v14l7-3 7 3V5a2 2 0 0 0-2-2z"/></svg>
              <span>Salvar</span>
            </button>
          </div> 
          <form id="banner-form" method="post" action="/vipmin/system/bulletin.php">
            <input type="hidden" name="id" value="<?php echo $system['id']; ?>" />

            <?php for($i=1;$i<11;$i++):
              $val  = htmlspecialchars($INI['bulletin'][$i] ?? '');
              $has  = trim($INI['bulletin'][$i] ?? '') !== '';
            ?>
              <details class="vip-acc" <?= $i <= 2 ? 'open' : '' ?>>
                <summary>
                  <span>Banner <?= $i ?></span>
                  <span class="vip-acc__right">
                    <?php if($has): ?><span class="vip-tag">preenchido</span><?php endif; ?> 
                  </span>
                </summary>
                <div class="vip-acc__body">
                  <div class="vip-helper">Cole aqui seu HTML do banner (imagem, iframe permitido pelo seu CKEditor, etc.).</div>
                  <div class="vip-editor-wrap">
                    <textarea id="bulletin_<?= $i ?>" class="editor ckeditor" name="bulletin[<?= $i ?>]"><?= $val ?></textarea>
                  </div>
                </div>
              </details>
            <?php endfor; ?>

          </form>

        </div><!-- /option_box -->
      </div>
    </div>
  </div>

  <div id="sidebar"></div>

</div>
</div>
</div>

<script>
  // Submete o formulário (mantendo compatibilidade)
  function doupdate(){
    var btn = document.getElementById('btnSave');
    btn.disabled = true;
    // Se CKEditor estiver carregado, garante sync do conteúdo
    if (window.CKEDITOR) {
      for (var name in CKEDITOR.instances) { CKEDITOR.instances[name].updateElement(); }
    }
    document.getElementById('banner-form').submit();
  }

  // Limpa um banner específico
  function clearBanner(i){
    var id = 'bulletin_'+i;
    if (window.CKEDITOR && CKEDITOR.instances[id]) {
      CKEDITOR.instances[id].setData('');
    } else {
      var el = document.getElementById(id);
      if (el) el.value = '';
    }
  }

  // Insere um snippet básico de banner com link
  function insertSnippet(i){
    var id = 'bulletin_'+i;
    var snippet = '<a href="https://seulink" target="_blank" rel="nofollow">'
                + '<img src="https://seu-banner.jpg" alt="Anuncie aqui" style="max-width:100%;height:auto;border:0" />'
                + '</a>';
    if (window.CKEDITOR && CKEDITOR.instances[id]) {
      CKEDITOR.instances[id].insertHtml(snippet);
    } else {
      var el = document.getElementById(id);
      if (!el) return;
      el.value = (el.value || '') + '\n' + snippet + '\n';
    }
  }
</script>

<?php include template("manage_footer"); ?>
