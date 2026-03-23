<!-- Fontes modernas para títulos e código -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@500;600&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

<style>
  /* ====== Cabeçalhos de seção ====== */
  .vip-title{
    font-family: "Inter", system-ui, -apple-system, "Segoe UI", Roboto, Arial, "Noto Sans", sans-serif;
    font-weight: 600;
    font-size: 16px;
    color: #0f172a;                 /* slate-900 */
    letter-spacing: .2px;
    margin: 0;
    padding: 10px 0;
  }
  .vip-section-head{
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 6px 10px 8px;
  }

  /* ====== Caixa informativa suave (recolhível) ====== */
  details.vip-infosh{
    font-family: "Inter", system-ui, -apple-system, "Segoe UI", Roboto, Arial, "Noto Sans", sans-serif;
    font-size: 13.5px;
    line-height: 1.6;
    color: #475569;                 /* slate-600 */
    background: #f8fafc;            /* superfície clara */
    border: 1px solid #e5e7eb;
    border-left: 4px solid #2563eb;
    border-radius: 12px;
    padding: 12px 14px 12px 44px;
    margin: 10px 10px 14px;
    box-shadow: 0 1px 2px rgba(16,24,40,.04);
    position: relative;
  }
  details.vip-infosh::before{
    content: "";
    position: absolute;
    left: 14px; top: 12px;
    width: 20px; height: 20px;
    background-image: url('data:image/svg+xml;utf8,\
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">\
        <circle cx="12" cy="12" r="10" fill="%232563eb"/>\
        <rect x="11" y="10" width="2" height="7" rx="1" fill="white"/>\
        <rect x="11" y="6.5" width="2" height="2" rx="1" fill="white"/>\
      </svg>');
    background-size: 20px 20px;
    background-repeat: no-repeat;
  }
  .vip-infosh > summary{
    cursor: pointer;
    list-style: none;
    font-weight: 600;
    color: #334155;                 /* slate-700 */
    user-select: none;
    outline: none;
  }
  .vip-infosh > summary::-webkit-details-marker{ display:none; }
  .vip-infosh > summary::after{
    content: "";
    width: 10px; height: 10px;
    margin-left: 8px;
    display: inline-block;
    transform: rotate(0deg);
    transition: transform .2s ease;
    background-image: url('data:image/svg+xml;utf8,\
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="%236b7280">\
        <path d="M5.23 7.21a.75.75 0 011.06.02L10 10.17l3.71-2.94a.75.75 0 111.04 1.08l-4.24 3.36a.75.75 0 01-.94 0L5.21 8.31a.75.75 0 01.02-1.1z"/>\
      </svg>');
    background-size: 10px 10px;
    background-repeat: no-repeat;
    vertical-align: middle;
  }
  .vip-infosh[open] > summary::after{ transform: rotate(180deg); }
  .vip-infosh__body{ margin-top: 8px; }
  .vip-infosh code{
    font-family: "JetBrains Mono", ui-monospace, SFMono-Regular, Menlo, Consolas, "Liberation Mono", monospace;
    background: #eef2ff;
    color: #1e293b;
    padding: 2px 6px;
    border: 1px solid #e0e7ff;
    border-radius: 6px;
    font-size: 12.5px;
  }
  .vip-infosh kbd{
    font-family: "JetBrains Mono", ui-monospace, SFMono-Regular, Menlo, Consolas, "Liberation Mono", monospace;
    background: #fff;
    border: 1px solid #e5e7eb;
    border-bottom-width: 2px;
    padding: 1px 6px;
    border-radius: 6px;
    font-size: 12px;
    box-shadow: 0 1px 0 rgba(0,0,0,.05);
  }

  /* ====== Textareas de código ====== */
  .vip-textarea{
    width: 100%;
    min-height: 220px;
    padding: 12px 14px;
    border-radius: 12px;
    border: 1px solid #e5e7eb;
    outline: none;
    background: #ffffff;
    font-family: "JetBrains Mono", ui-monospace, SFMono-Regular, Menlo, Consolas, "Liberation Mono", monospace;
    font-size: 13px;
    color: #0f172a;
    box-shadow: 0 1px 2px rgba(16,24,40,.04) inset;
  }
  .vip-textarea:focus{
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37,99,235,.15);
  }
</style>

<!-- ========================= METATAGS ========================= -->
<div class="option_box">
  <details class="vip-infosh" open>
    <summary>Como usar metatags</summary>
    <div class="vip-infosh__body">
      <p>Você pode inserir outras <strong>metatags</strong> no seu site. Elas também servem para verificação de autoridade do domínio.</p>
      <p>Exemplo: <code><?=htmlspecialchars('<meta name="site-verification" content="22859341" />') ?></code></p>
      <p>Para conferir se foi inserido, abra o site no Chrome e pressione <kbd>CTRL</kbd>+<kbd>U</kbd> para ver o código-fonte; pesquise pelo seu código no início da página.</p>
    </div>
  </details>

  <div id="container_box">
    <div class="vip-section-head">
      <div class="left_float"><h4 class="vip-title">METATAGS</h4></div>
    </div>
  </div>

  <div id="option_contents" class="option_contents">
    <div class="form-contain group">
      <div class="text_area">
        <textarea cols="45" rows="5" name="system[metatags]" class="format_input vip-textarea"><?php echo $INI['system']['metatags']; ?></textarea>
      </div>
    </div>
  </div>
</div>

<!-- ========================= JS EXTERNO ========================= -->
<div class="option_box">
  <details class="vip-infosh" open>
    <summary>Scripts externos e tags (Google, chat, Facebook, etc.)</summary>
    <div class="vip-infosh__body">
      <p>Você pode inserir códigos JavaScript externos no seu site (tags do Google, scripts de chat, pixels, etc.).</p>
      <p><code>Note que, dependendo do código, o site pode apresentar mau comportamento. Se notar problemas, tente colocar o script no próximo campo; se persistir, remova o código e salve.</code></p>
      <p>Para checar se foi inserido, abra o site no Chrome e pressione <kbd>CTRL</kbd>+<kbd>U</kbd>; pesquise pelo trecho no final da página.</p>
      <p><code><?=htmlspecialchars(' Necessário inserir as tags de inicio e fim do javascript se for o caso <script></script> ')?></code></p>
    </div>
  </details>

  <div id="container_box">
    <div class="vip-section-head">
      <div class="left_float">
        <h4 class="vip-title">
          Códigos JAVASCRIPT — <?=htmlspecialchars('Inclua as tags de abertura e fechamento <script></script> entre os códigos')?>
        </h4>
      </div>
    </div>
  </div>

  <div id="option_contents" class="option_contents">
    <div class="form-contain group">
      <div class="text_area">
        <textarea cols="45" rows="5" name="system[codigosrodape]" class="format_input vip-textarea"><?php echo $INI['system']['codigosrodape']; ?></textarea>
      </div>
    </div>
  </div>
</div>

<!-- ========================= CSS PERSONALIZADO ========================= -->
<div class="option_box">
  <details class="vip-infosh" open>
    <summary>Regras CSS personalizadas</summary>
    <div class="vip-infosh__body">
      <p>Você pode inserir regras <strong>CSS</strong>. <code>Não é preciso incluir as tags <?=htmlspecialchars('<style> </style>')?></code></p>
      <p>Exemplo simples alterando a cor de um elemento com a classe <em>cortextocabecalho</em>. Recomenda-se usar <code><?=htmlspecialchars('!important;')?></code> para garantir a precedência quando necessário:</p>
      <p><code><?=htmlspecialchars('.cortextocabecalho{ color: #336699 !important; }') ?></code></p>
      <p>Para confirmar a inserção, abra o site no Chrome, pressione <kbd>CTRL</kbd>+<kbd>U</kbd> e procure pelo CSS no final da página.</p>
    </div>
  </details>

  <div id="container_box">
    <div class="vip-section-head">
      <div class="left_float"><h4 class="vip-title">Códigos CSS</h4></div>
    </div>
  </div>

  <div id="option_contents" class="option_contents">
    <div class="form-contain group">
      <div class="text_area">
        <textarea cols="45" rows="5" name="system[codigoscss]" class="format_input vip-textarea"><?php echo $INI['system']['codigoscss']; ?></textarea>
      </div>
    </div>
  </div>
</div>
