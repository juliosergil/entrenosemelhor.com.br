<?php include template("manage_header"); ?>

<div id="bdw" class="bdw">
  <div id="bd" class="cf">
    <div id="system">

      <div class="dashboard" id="dashboard">
        <ul><?php echo mcurrent_system('redes'); ?></ul>
      </div>

      <div id="content" class="clear mainwide vipmin-logo-page">
        <div class="box card">
          <div class="card__title">
            <span class="dot"></span>
            <h2>Alterar Logotipo</h2>
            <p class="subtitle">Após enviar a imagem, use <strong>Ctrl + F5</strong> para limpar o cache do navegador. Pode demorar algunas horas para que o cache seja atualizado na área publica</p>
          </div>

          <div class="card__grid">

            <!-- ==================== LOGO (coluna esquerda) ==================== -->
            <section class="pane">
              <header class="pane__header"> 
                <h3>Logo</h3>
                <small>Resolução ideal <strong>300×98</strong></small>
              </header>

              <figure class="preview"> 
				<img id="logoPreview" src="<?= $ROOTPAHT ?>/include/logo/logo.png?v=<?= time() ?>" alt="Logo atual">
              </figure>

              <form name="img1"
                    action="<?php echo $INI['system']['wwwprefix'] ?>/include/upload.php?nome=logo&width=300&height=98"
                    target="upload_target" method="post" enctype="multipart/form-data"
                    onsubmit="return startUpload();">

                <div class="uploader" id="logoDrop">
                  <input id="logoFile" name="myfile" type="file" accept="image/*">
                  <label for="logoFile" class="btn btn-secondary">Escolher arquivo</label>
                  <button type="submit" name="submitBtn" class="btn btn-primary">Upload</button>
                </div>

                <div class="helper">
                  <span id="logoInfo" class="note">Selecione um arquivo .png, .jpg ou .svg. Ideal 300×98.</span>
                  <div class="links">
                    <a target="_blank" href="https://resizeyourimage.com/PT/">Redimensionar imagem</a> 
                  </div>
                </div>

                <input type="hidden" value="<?php echo $INI['system']['wwwprefix'] ?>" id="local" name="local">
                <iframe id="upload_target" name="upload_target" src="#" class="hidden-iframe"></iframe>

                <div id="f1_upload_process" class="loading">
                  <div class="spinner"></div>
                  <span>Enviando...</span>
                </div>
              </form>
            </section>

            <!-- ==================== FAVICON (coluna direita) ==================== -->
            <section class="pane">
              <header class="pane__header">
                <h3>Favicon</h3>
                <small>Obrigatório <strong>16×16</strong> — extensão <strong>.ico</strong></small>
              </header>

              <figure class="preview preview--favicon"> 
				<img id="faviconPreview" src="<?= $PATHSKIN ?>/images/favicon.ico?v=<?= time() ?>" alt="Favicon atual">
              </figure>

              <form name="img2"
                    action="<?php echo $INI['system']['wwwprefix'] ?>/include/upload.php?nome=favicon&width=724&height=266"
                    target="upload_target" method="post" enctype="multipart/form-data"
                    onsubmit="return startUpload();">

                <div class="uploader" id="favDrop">
                  <input id="faviconFile" name="myfile" type="file" accept=".ico">
                  <label for="faviconFile" class="btn btn-secondary">Escolher arquivo</label>
                  <button type="submit" name="submitBtn" class="btn btn-primary">Upload</button>
                </div>

                <div class="helper">
                  <span id="faviconInfo" class="note">
                    Use um arquivo <strong>.ico 16×16</strong>. Se preciso,
                    <a target="_blank" href="http://favicon-generator.org/">gere seu favicon</a>.
                  </span>
                  <span class="note">Depois do envio, dê <strong>Ctrl + F5</strong> para limpar o cache.</span>
                </div>

                <input type="hidden" value="<?php echo $INI['system']['wwwprefix'] ?>" id="local" name="local">
                <iframe id="upload_target" name="upload_target" src="#" class="hidden-iframe"></iframe>
              </form>
            </section>

          </div>
        </div>
      </div>

      <div id="sidebar"></div>
    </div>
  </div>
</div>

<style>
/* ====== Layout base do card ====== */
.vipmin-logo-page .card{
  background:#fff;
  border-radius:16px;
  box-shadow:0 10px 30px rgba(16,24,40,.06);
  padding:18px 18px 22px;
}
.vipmin-logo-page .card__title{
  display:flex; align-items:center; gap:12px; margin-bottom:12px;
}
.vipmin-logo-page .card__title .dot{
  width:7px; height:7px; border-radius:999px; background:#3b82f6; box-shadow:0 0 0 3px rgba(59,130,246,.12);
}
.vipmin-logo-page .card__title h2{
  margin:0; font-size:18px; font-weight:800; color:#0f172a;
}
.vipmin-logo-page .card__title .subtitle{
  margin:0 0 0 auto; font-size:13px; color:#475569;
}
.vipmin-logo-page .card__grid{
  display:grid; gap:20px; grid-template-columns:1fr 1fr;
}
@media (max-width: 980px){ .vipmin-logo-page .card__grid{ grid-template-columns:1fr; } }

/* ====== Pane ====== */
.vipmin-logo-page .pane{
  border:1px solid #e5e7eb; border-radius:14px; padding:16px;
  background:linear-gradient(180deg,#fff, #fafafa);
}
.pane__header{ display:flex; align-items:baseline; gap:10px; margin-bottom:10px; }
.pane__header h3{ margin:0; font-size:16px; font-weight:700; color:#0b1324; }
.pane__header small{ color:#64748b; }

/* ====== Preview ====== */
.preview{
  display:flex; align-items:center; justify-content:flex-start;
  min-height:110px; padding:12px; border:1px dashed #d1d5db; border-radius:12px; background:#f8fafc;
  margin-bottom:12px;
}
.preview img{ max-width:230px; max-height:110px; border-radius:6px; }
.preview--favicon{ min-height:64px; }
.preview--favicon img{ max-width:64px; max-height:64px; }

/* ====== Uploader ====== */
.uploader{ display:flex; gap:10px; align-items:center; flex-wrap:wrap; }
.uploader input[type=file]{ display:none; }
.btn{
  display:inline-flex; align-items:center; justify-content:center;
  padding:0 14px; border-radius:10px; border:1px solid transparent;
  font-weight:700; font-size:14px; cursor:pointer; text-decoration:none;
}
.btn-primary{
  background:linear-gradient(180deg,#2563eb,#1d4ed8); color:#fff; border-color:#1e40af;
  box-shadow:0 6px 18px rgba(29,78,216,.25), inset 0 1px rgba(255,255,255,.15);
}
.btn-primary:hover{ transform:translateY(-1px); transition:.18s; }
.btn-secondary{
  background:#f3f4f6; color:#111827; border-color:#e5e7eb;
}
.btn-secondary:hover{ background:#eceff3; }

/* ====== Helpers ====== */
.helper{ margin-top:8px; display:flex; flex-direction:column; gap:6px; }
.note{ color:#445168; font-size:12.5px; }
.helper .links{ display:flex; gap:14px; font-size:12.5px; }
.helper .links a{ color:#2563eb; text-decoration:none; }
.helper .links a:hover{ text-decoration:underline; }

/* ====== Loading overlay ====== */
.hidden-iframe{ width:0;height:0;border:0; }
.loading{
  position:fixed; inset:0; background:rgba(15,23,42,.32);
  display:none; align-items:center; justify-content:center; gap:12px; z-index:4000;
  color:#fff; font-weight:700;
}
.loading .spinner{
  width:22px; height:22px; border:3px solid rgba(255,255,255,.35);
  border-top-color:#fff; border-radius:999px; animation:spin .9s linear infinite;
}
@keyframes spin{ to{ transform:rotate(360deg);} }
</style>

<script>
/* ====== Pré-visualização e validação leve ====== */
(function(){
  // preview logo
  const logoInput = document.getElementById('logoFile');
  const logoPrev  = document.getElementById('logoPreview');
  const logoInfo  = document.getElementById('logoInfo');

  logoInput.addEventListener('change', function(){
    const file = this.files && this.files[0]; if(!file) return;
    const reader = new FileReader();
    reader.onload = e => {
      logoPrev.src = e.target.result;
      // checa dimensões IDEAL 300x98 (apenas aviso, não bloqueia)
      const img = new Image();
      img.onload = () => {
        const ok = (img.width === 300 && img.height === 98);
        logoInfo.innerHTML = ok
          ? 'Dimensões perfeitas: 300×98.'
          : 'Dimensões detectadas: <strong>'+img.width+'×'+img.height+
            '</strong> (ideal 300×98). Pode enviar, mas verifique o layout.';
      };
      img.src = e.target.result;
    };
    reader.readAsDataURL(file);
  });

  // preview favicon
  const favInput = document.getElementById('faviconFile');
  const favPrev  = document.getElementById('faviconPreview');
  const favInfo  = document.getElementById('faviconInfo');

  favInput.addEventListener('change', function(){
    const file = this.files && this.files[0]; if(!file) return;
    const name = (file.name||'').toLowerCase();
    if(!name.endsWith('.ico')) {
      favInfo.innerHTML = 'Arquivo selecionado: <strong>'+name+
        '</strong>. O ideal é <strong>.ico 16×16</strong>.';
    } else {
      favInfo.innerHTML = 'OK: arquivo .ico selecionado. Tamanho ideal 16×16.';
    }
    const reader = new FileReader();
    reader.onload = e => { favPrev.src = e.target.result; };
    reader.readAsDataURL(file);
  });

  // drag & drop básico (apenas joga o arquivo no input)
  function bindDrop(zoneId, input){
    const z = document.getElementById(zoneId);
    ['dragenter','dragover'].forEach(ev=>z.addEventListener(ev, e=>{e.preventDefault(); z.classList.add('is-drag');}));
    ['dragleave','drop'].forEach(ev=>z.addEventListener(ev, e=>{e.preventDefault(); z.classList.remove('is-drag');}));
    z.addEventListener('drop', e=>{
      if(e.dataTransfer.files && e.dataTransfer.files.length){
        input.files = e.dataTransfer.files;
        input.dispatchEvent(new Event('change'));
      }
    });
  }
  bindDrop('logoDrop', logoInput);
  bindDrop('favDrop', favInput);
})();
</script>

<script>
function startUpload(){
  document.getElementById('f1_upload_process').style.display = 'flex';
  return true;
}
 
function stopUpload(success){
  // overlay (se existir)
  var overlay = document.getElementById('f1_upload_process');

  // Normaliza o retorno para string (evita erro no jQuery 1.4.2)
  var s = '';
  if (success === null || typeof success === 'undefined') {
    s = '';
  } else {
    s = String(success);
  }

  // trim compatível (sem depender do jQuery.trim antigo)
  s = s.replace(/^\s+|\s+$/g, '');

  if (s == '1'){
    jQuery(function(){
      alert("Arquivo enviado com sucesso! Acesse o site e pressione CTRL + F5 para limpar o cache.");
      location.href = "<?=$ROOTPAHT?>/vipmin/system/logo.php";
    });
  } else if (s == '2'){
    jQuery(function(){
		
			var ts = new Date().getTime();
			var lp = document.getElementById('logoPreview');
			if (lp) lp.src = lp.src.split('?')[0] + '?v=' + ts;


      alert("Enviado, mas as dimensões diferem do ideal. Verifique se não prejudicou o layout.");
      location.href = "<?=$ROOTPAHT?>/vipmin/system/logo.php";
    });
  } else {
    jQuery(function(){
      if (jQuery.colorbox) {
        jQuery.colorbox({html:"<font color=red>Não foi possível enviar o arquivo.</font>"});
      } else {
        alert("Não foi possível enviar o arquivo.");
      }
    });
  }

  if (overlay) overlay.style.display = 'none';
  return true;
} 
</script>

<script>
jQuery(function(){
  jQuery(".caixabox").colorbox({ width:"70%", heigth:"70%" });
});
</script>

<?php include template("manage_footer"); ?>
