<?php include template("manage_header"); ?>

<?php
// Variáveis vindas do request (mantive compatibilidade)
$num = rand(100, 500);
$tipo = isset($_REQUEST['tipo']) ? $_REQUEST['tipo'] : 'default';
$nomecampo = "status_".$tipo;

// Nome do campo de arquivo salvo na configuração
$status_arquivo = 'arquivo_'.$tipo;

// Diretório das imagens
$dir = WWW_ROOT . "/skin/padrao/$tipo";
@mkdir($dir);
$dh = @opendir($dir);
?>

<!doctype html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Editar Imagem - Sessão <?= htmlspecialchars($tipo) ?></title>

<style>
/* ===== Reset mínimo ===== */
* { box-sizing: border-box; }
html,body { height:100%; margin:0; font-family: Inter, "Helvetica Neue", Arial, sans-serif; background:#f4f6fb; color:#222; }

/* ===== Container ===== */
.container {
  max-width:1100px;
  margin:28px auto;
  padding:20px;
}

/* ===== Panel ===== */
.panel {
  background:#ffffff;
  border-radius:12px;
  padding:20px;
  box-shadow:0 6px 18px rgba(20,30,50,0.06);
}

/* ===== Header area ===== */
.header-top {
  display:flex;
  gap:16px;
  align-items:center;
  justify-content:space-between;
  flex-wrap:wrap;
  margin-bottom:14px;
}
.header-left h1 { margin:0; font-size:20px; }
.header-left p { margin:6px 0 0; color:#6b7280; font-size:13px; max-width:640px; }

.controls { display:flex; gap:10px; align-items:center; }

/* radio group */
.form-options { display:flex; gap:12px; align-items:center; margin-top:8px; }
.form-options label { display:inline-flex; gap:8px; align-items:center; font-size:14px; color:#373a40; cursor:pointer; }

/* buttons */
.btn {
  border:0;
  padding:10px 14px;
  border-radius:8px;
  font-weight:600;
  cursor:pointer;
  transition:all .14s ease;
}
.btn-primary { background:#0b74d1; color:#fff; }
.btn-primary:hover { transform:translateY(-2px); }
.btn-ghost { background:transparent; border:1px solid #d1d5db; color:#374151; }
.btn-ghost:hover { background:#f8fafc; }

/* ===== Upload area ===== */
.upload-box {
  margin-top:16px;
  padding:14px;
  border-radius:10px;
  background:linear-gradient(180deg,#fcfeff,#fafcff);
  border:1px solid #eef2f7;
}
.upload-title { font-weight:700; font-size:15px; margin:0 0 8px; display:flex; gap:10px; align-items:center; }

/* ===== Grid de imagens ===== */
.grid {
  margin-top:18px;
  display:grid;
  grid-template-columns: repeat(auto-fill,minmax(210px,1fr));
  gap:16px;
}
.card {
  background:#fff;
  border-radius:10px;
  overflow:hidden;
  border:1px solid #e6eef6;
  box-shadow:0 6px 18px rgba(30,40,60,0.04);
  transition:transform .16s ease,box-shadow .16s ease;
  display:flex;
  flex-direction:column;
}
.card:hover { transform:translateY(-6px); box-shadow:0 10px 26px rgba(30,40,60,0.08); }

.card.selected { border-color:#0b74d1; box-shadow:0 10px 30px rgba(11,116,209,0.12); }

.card .thumb {
  width:100%;
  height:140px;
  background:#f3f6fb;
  display:flex;
  align-items:center;
  justify-content:center;
}
.card .thumb img { width:100%; height:100%; object-fit:cover; display:block; }

.card .meta {
  padding:12px;
  text-align:center;
  font-size:13px;
  color:#333;
}
.card .meta .filename { overflow:hidden; text-overflow:ellipsis; white-space:nowrap; display:block; }
.card .meta .actions { margin-top:10px; display:flex; gap:8px; justify-content:center; align-items:center; }

.small-link { font-size:12px; color:#6b7280; text-decoration:none; cursor:pointer; }
.small-link:hover { color:#0b74d1; text-decoration:underline; }

/* radio custom */
.card .meta input[type="radio"] { transform:scale(1.05); }

/* ================================
   CORREÇÃO MOBILE — OPÇÃO 1
   ================================ */
@media (max-width: 520px) {
  .card .meta label { font-size:12px; }

  /* Troca o texto visível por "Selecionar" apenas no mobile */
  .card .meta label::after {
    content: " Selecionar";
    font-weight:600;
    color:#374151;
  }

  /* Oculta o texto original "Escolher" (span.text-original) no mobile */
  .card .meta label .text-original { display:none !important; }
}

/* responsiveness */
@media (max-width:520px){
  .header-top{ flex-direction:column; align-items:stretch; }
  .controls{ justify-content:space-between; }
}

</style>
</head>
<body>
<div class="container">
  <div class="panel" role="main" aria-labelledby="pageTitle">
    <div class="header-top">
      <div class="header-left">
        <h1 id="pageTitle">Imagem para sessão <strong><?= htmlspecialchars($tipo) ?></strong></h1>
        <p>
          Selecione se deseja usar imagem para esta sessão. Se escolher <strong>Sim</strong>, selecione abaixo a imagem desejada e clique em <em>Salvar</em>.
          Se escolher <strong>Não</strong>, o sistema usará as configurações de cor.
        </p>

        <div class="form-options" style="margin-top:12px;" aria-label="Usar imagem">
          <label>
            <input type="radio" id="<?= htmlspecialchars($nomecampo) ?>_y" name="header[<?= htmlspecialchars($nomecampo) ?>]" value="Y"
              <?= (isset($INI['header'][$nomecampo]) && $INI['header'][$nomecampo] == "Y") ? 'checked' : '' ?> >
            Usar imagem
          </label>

          <label>
            <input type="radio" id="<?= htmlspecialchars($nomecampo) ?>_n" name="header[<?= htmlspecialchars($nomecampo) ?>]" value="N"
              <?= (!isset($INI['header'][$nomecampo]) || $INI['header'][$nomecampo] != "Y") ? 'checked' : '' ?> >
            Não usar
          </label>
        </div>
      </div>

      <div class="controls" aria-hidden="false">
        <button type="button" class="btn btn-ghost" title="Voltar" onclick="window.location.href='cores.php'">Voltar</button>
        <button id="saveBtn" type="button" class="btn btn-primary" onclick="submitForm();">Salvar</button>
      </div>
    </div>

    <form id="headerForm" method="post" novalidate>
      <!-- Hidden preservation fields (mantive sua lógica original) -->
      <?php if($tipo != "recomendados"){ ?>
        <input type="hidden" name="header[status_recomendados]" value="<?= htmlspecialchars($INI['header']['status_recomendados']) ?>">
        <input type="hidden" name="header[arquivo_recomendados]" value="<?= htmlspecialchars($INI['header']['arquivo_recomendados']) ?>">
      <?php } ?>
      <?php if($tipo != "premium"){ ?>
        <input type="hidden" name="header[status_premium]" value="<?= htmlspecialchars($INI['header']['status_premium']) ?>">
        <input type="hidden" name="header[arquivo_premium]" value="<?= htmlspecialchars($INI['header']['arquivo_premium']) ?>">
      <?php } ?>
      <?php if($tipo != "header"){ ?>
        <input type="hidden" name="header[status_header]" value="<?= htmlspecialchars($INI['header']['status_header']) ?>">
        <input type="hidden" name="header[arquivo_header]" value="<?= htmlspecialchars($INI['header']['arquivo_header']) ?>">
      <?php } ?>

      <!-- Upload -->
      <div class="upload-box" aria-live="polite">
        <div class="upload-title">Enviar minha própria imagem</div>
        <div style="font-size:13px;color:#4b5563;margin-bottom:8px;">
          Faça upload de uma imagem para esta sessão. Após enviar, atualize (CTRL+F5) e escolha a imagem da lista abaixo.
        </div>
        <iframe allowTransparency="true" frameborder="0" height="88" scrolling="no" src="/vipmin/uploadheader.php?tipo=<?= rawurlencode($tipo) ?>" id="uploadFrame" title="Upload de imagem"></iframe>
      </div>

      <!-- Grid de imagens -->
      <div class="grid" id="imageGrid" role="list" aria-label="Lista de imagens">
        <?php
        if ($dh):
          while (($file = readdir($dh)) !== false):
            if ($file === '.' || $file === '..') continue;
            if (substr($file, 0, 1) === '.') continue;
            $is_selected = (isset($INI['header'][$status_arquivo]) && $INI['header'][$status_arquivo] == $file);
            $card_classes = $is_selected ? 'card selected' : 'card';
            $file_url = $ROOTPATH . "/skin/padrao/{$tipo}/" . rawurlencode($file);
        ?>
        <article class="<?= $card_classes ?>" role="listitem" data-filename="<?= htmlspecialchars($file) ?>">
          <div class="thumb" aria-hidden="false">
            <img src="<?= htmlspecialchars($file_url) ?>" alt="<?= htmlspecialchars($file) ?>">
          </div>
          <div class="meta">
            <span class="filename" title="<?= htmlspecialchars($file) ?>"><?= htmlspecialchars($file) ?></span>

            <div class="actions">
              <label style="display:flex;align-items:center;gap:8px;">
                <input type="radio"
                       name="header[arquivo_<?= htmlspecialchars($tipo) ?>]"
                       value="<?= htmlspecialchars($file) ?>"
                       <?= $is_selected ? 'checked' : '' ?>
                       onclick="selectCard(this)">
                <!-- texto original (visível no desktop); será ocultado no mobile via CSS -->
                <span class="text-original">Escolher</span>
              </label>

              <a href="javascript:void(0)" class="small-link" onclick="confirmExcluir('<?= rawurlencode($file) ?>')">Excluir</a>
            </div>
          </div>
        </article>
        <?php
          endwhile;
          closedir($dh);
        else:
        ?>
        <div style="padding:18px;color:#6b7280;">Nenhuma imagem encontrada para a sessão <strong><?= htmlspecialchars($tipo) ?></strong>.</div>
        <?php endif; ?>
      </div>
    </form>
  </div>
</div>

<script>
/* ===== Utilidades ===== */
function $(sel){ return document.querySelector(sel); }
function $all(sel){ return Array.prototype.slice.call(document.querySelectorAll(sel)); }

/* Seleciona visualmente o card quando o radio é clicado */
function selectCard(radio){
  var card = radio.closest('.card');
  if(!card) return;
  $all('.card').forEach(function(c){ c.classList.remove('selected'); });
  card.classList.add('selected');
}

/* Clique no card seleciona o radio */
document.getElementById('imageGrid').addEventListener('click', function(e){
  var card = e.target.closest('.card');
  if(!card) return;
  if(e.target.closest('.small-link')) return;
  var radio = card.querySelector('input[type="radio"]');
  if(radio){
    radio.checked = true;
    $all('.card').forEach(function(c){ c.classList.remove('selected'); });
    card.classList.add('selected');
  }
});

/* Confirmar exclusão */
function confirmExcluir(fileEncoded){
  var file = decodeURIComponent(fileEncoded);
  if(!confirm("Deseja realmente excluir '" + file + "'? Isso não pode ser desfeito.")) return;
  var loading = document.createElement('div');
  loading.style.position = 'fixed';
  loading.style.left = '0';
  loading.style.top = '0';
  loading.style.width = '100%';
  loading.style.height = '100%';
  loading.style.display = 'flex';
  loading.style.alignItems = 'center';
  loading.style.justifyContent = 'center';
  loading.style.background = 'rgba(0,0,0,0.2)';
  loading.style.zIndex = 9999;
  loading.innerHTML = '<div style="background:#fff;padding:16px;border-radius:8px;box-shadow:0 6px 20px rgba(0,0,0,0.12);">Removendo arquivo...</div>';
  document.body.appendChild(loading);

  var xhr = new XMLHttpRequest();
  xhr.open('GET', '<?= WEB_ROOT ?>/vipmin/delgal.php?file=' + encodeURIComponent(file) + '&tipo=<?= rawurlencode($tipo) ?>', true);
  xhr.onreadystatechange = function(){
    if(xhr.readyState === 4){
      document.body.removeChild(loading);
      var resp = xhr.responseText.trim();
      if(resp === ''){
        window.location.href = '/vipmin/system/header.php?acao=up&tipo=<?= rawurlencode($tipo) ?>';
      } else {
        alert(resp);
      }
    }
  };
  xhr.send();
}

/* Validação antes de salvar (replicando validador original) */
function validateForm(){
  var radios = document.getElementsByName('header[<?= htmlspecialchars($nomecampo) ?>]');
  var escolha = null;
  for(var i=0;i<radios.length;i++){
    if(radios[i].checked){ escolha = radios[i].value; break; }
  }
  if(escolha === 'N'){
    return confirm("O campo 'usar imagem no cabeçalho' não está ativado. Tem certeza disso?");
  }
  if(escolha === 'Y'){
    var arquivos = document.getElementsByName('header[arquivo_<?= htmlspecialchars($tipo) ?>]');
    var any = false;
    for(var j=0;j<arquivos.length;j++){
      if(arquivos[j].checked){ any = true; break; }
    }
    if(!any){
      return confirm("Você marcou 'Usar imagem' mas não selecionou nenhuma imagem. Deseja continuar mesmo assim?");
    }
  }
  return true;
}

/* Submit */
function submitForm(){
  if(!validateForm()) return;
  var btn = document.getElementById('saveBtn');
  btn.disabled = true;
  btn.innerHTML = 'Salvando...';
  setTimeout(function(){ document.getElementById('headerForm').submit(); }, 200);
}

/* Hooks para iframe upload (compatibilidade) */
function startUpload(){ return true; }
function stopUpload(success){
  alert("O arquivo foi carregado com sucesso. Pressione CTRL+F5 para atualizar o cache do navegador. A página será atualizada agora.");
  window.location.href = '/vipmin/system/header.php?acao=up&tipo=<?= rawurlencode($tipo) ?>';
}
</script>

</body>
</html>
