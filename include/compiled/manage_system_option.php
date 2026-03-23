<?php
/* ===========================================
   Vipmin – Configurações (layout 1 coluna)
   =========================================== */
include template("manage_header");
require("ini.php");

/* Marcação dos radios */ 
$bloco_tkdeveloper_sim = ($INI['option']['bloco_tkdeveloper'] ?? 'N') == 'Y' ? "checked='checked'" : "";
$bloco_tkdeveloper_nao = ($INI['option']['bloco_tkdeveloper'] ?? 'N') != 'Y' ? "checked='checked'" : "";

$debug_sql_sim = ($INI['option']['debug_sql'] ?? 'N') == 'Y' ? "checked='checked'" : "";
$debug_sql_nao = ($INI['option']['debug_sql'] ?? 'N') != 'Y' ? "checked='checked'" : "";

/* Defaults da manutenção */
if (empty($INI['option']['manutencao_padrao_titulo'])) {
    $site = str_replace(["https://www.","http://www.","https://","http://"], "", $ROOTPATH);
    $INI['option']['manutencao_padrao_titulo'] = $site;
}
if (empty($INI['option']['manutencao_padrao_rodape'])) {
    $INI['option']['manutencao_padrao_rodape'] = "Estaremos juntos novamente em breve !";
}
if (empty($INI['option']['manutencao_padrao_cabecalho'])) {
    $INI['option']['manutencao_padrao_cabecalho'] = "Um novo site incrível está sendo construído aqui...";
}

/* Radios manutenção */
$index_manutencao_sim = ($INI['option']['index_manutencao'] ?? 'N') == 'Y' ? "checked='checked'" : "";
$index_manutencao_nao = ($INI['option']['index_manutencao'] ?? 'N') != 'Y' ? "checked='checked'" : "";

$manut_padrao_val = $INI['option']['manutencao_padrao'] ?? 's';
$manut_padrao_sim = ($manut_padrao_val == 's') ? "checked='checked'" : "";
$manut_padrao_nao = ($manut_padrao_val != 's') ? "checked='checked'" : "";
?>

<style>
/* ======== Layout 1 coluna (stack) ======== */
.cfg-stack{
  display:flex;
  flex-direction:column;
  gap:16px;
}

/* ======== Card ======== */
.cfg-card{
  background:#fff;
  border:1px solid #e5e7eb;
  border-radius:14px;
  padding:16px 18px;
  box-shadow:0 8px 22px rgba(17,24,39,.04), inset 0 1px rgba(255,255,255,.3);
}
.cfg-card h3{
  margin:0 0 12px;
  font:700 18px/1.25 Inter,system-ui,Arial;
  letter-spacing:.3px;
  color:#0f172a;
  display:flex;align-items:center;gap:10px;
}
.cfg-card h3 .dot{
  width:8px;height:8px;border-radius:50%;
  background:linear-gradient(180deg,#2563eb,#22d3ee);
  display:inline-block;
}

/* Descrição e linhas */
.cfg-desc{ color:#4b5563; font:500 13px/1.45 Inter,system-ui,Arial; margin:4px 0 10px; }
.cfg-row{ display:flex; flex-wrap:wrap; gap:10px; align-items:center; margin-top:8px; }

/* Radios Sim/Não estilo “pílula” */
.pill{
  display:inline-flex; gap:8px; align-items:center;
}
.pill label{
  position:relative; display:inline-flex; align-items:center; justify-content:center;
  min-width:56px; height:34px; padding:0 14px; border-radius:99px;
  border:1px solid #e5e7eb; cursor:pointer; user-select:none;
  font:700 13px/1 Inter,system-ui,Arial; color:#111827; background:#fff;
  transition:all .15s ease;
}
.pill input{ display:none; }
.pill input:checked + label{
  color:#fff; border-color:#2563eb;
  background:linear-gradient(180deg,#2563eb,#1d4ed8);
  box-shadow:0 6px 18px rgba(37,99,235,.25);
}

/* Inputs */
.cfg-input, .cfg-text{
  width:100%; background:#f8fafc; border:1px solid #e5e7eb; color:#0f172a;
  border-radius:10px; padding:10px 12px; outline:none;
  font:600 13px/1.25 Inter,system-ui,Arial;
  transition:border-color .15s ease, box-shadow .15s ease;
}
.cfg-input:focus, .cfg-text:focus{
  border-color:#2563eb; box-shadow:0 0 0 3px rgba(37,99,235,.15);
}
.cfg-text{ min-height:62px; resize:vertical; }

/* Grupo 2–3 inputs um embaixo do outro (sem grid) para 1 coluna confortável */
.cfg-group{ display:flex; flex-direction:column; gap:10px; margin-top:8px; }

/* Aviso */
.cfg-note{
  background:#f8fafc; border:1px dashed #d1d5db; color:#334155;
  border-radius:12px; padding:12px 14px; font:600 13px/1.45 Inter,system-ui,Arial;
}

/* Top bar padrão Vipmin */
.top-heading .the-button{ display:flex; gap:8px; }
.input-btn{
  appearance:none; border:0; border-radius:12px; padding:10px 16px; cursor:pointer;
  background:linear-gradient(180deg,#2563eb,#1d4ed8); color:#fff;
  font:800 13px/1 Inter,system-ui,Arial; letter-spacing:.3px;
  box-shadow:0 10px 26px rgba(37,99,235,.28);
}

/* padrão: label preta */
.pill label{
  color:#111;               /* preto */
  transition: color .15s ease;
}

/* quando o rádio está marcado: deixa a label branca */
.pill input[type="radio"]:checked + label{
  color:#fff !important;
}


</style>

<div id="bdw" class="bdw">
  <div id="bd" class="cf">
    <div id="partner">
      <div id="content" class="clear mainwide">
        <div class="clear box">
          <div class="box-top"></div>
          <div class="box-content">
            <div class="sect">
              <form method="post">
                <div class="option_box">
                  <div class="top-heading group">
                    <div class="left_float"><h4>Configurações</h4></div>
                    <div class="the-button">
                      <button onclick="doupdate();" id="run-button" class="input-btn" type="button">
                        <div name="spinner-top" id="spinner-top" style="width:83px;display:block;">
                          <img name="imgrec" id="imgrec" src="<?=$ROOTPATH?>/media/css/i/lendo.gif" style="display:none;">
                        </div>
                        <div id="spinner-text">Salvar</div>
                      </button>
                    </div>
                  </div>

                  <!-- ====== 1 COLUNA: UM CARD POR LINHA ====== -->
                  <div id="container_box" class="cfg-stack">
                    <div id="option_contents" class="option_contents">

                      <!-- TKSTORE DEVELOPER -->
                      <div class="cfg-card">
                        <h3><span class="dot"></span> TKSTORE DEVELOPER</h3>
                        <div class="cfg-desc">Localizador de Arquivos — mostra o caminho exato dos arquivos incluídos (uso para desenvolvedores).</div>
                        <div class="cfg-row pill">
                          <input type="radio" id="tkdevY" name="option[bloco_tkdeveloper]" value="Y" <?=$bloco_tkdeveloper_sim?>>
                          <label for="tkdevY">Sim</label>
                          <input type="radio" id="tkdevN" name="option[bloco_tkdeveloper]" value="N" <?=$bloco_tkdeveloper_nao?>>
                          <label for="tkdevN">Não</label>
                        </div>
                      </div>    
					  
					  <!-- MODERAÇAO DE USUARIO 
                      <div class="cfg-card">
                        <h3><span class="dot"></span> MODERAÇÃO DE USUÁRIO</h3>
                        <div class="cfg-desc">Todo novo usuário que se cadastrar no site, vai ficar aguardando moderação.</div>
                        <div class="cfg-row pill">
                          <input type="radio" id="modY" name="option[moderacao_usuario]" value="Y" <? if($INI['option']['moderacao_usuario']=="Y" or $INI['option']['moderacao_usuario']=="") { echo " checked"; } ?> >
                          <label for="modY">Sim</label>
                          <input type="radio" id="modN" name="option[moderacao_usuario]" value="N" <? if($INI['option']['moderacao_usuario']=="N") { echo " checked"; } ?>>
                          <label for="modN">Não</label>
                        </div>
                      </div>
					  -->

                      <!-- DEBUG SQL ADMIN -->
                      <div class="cfg-card">
                        <h3><span class="dot"></span> ATIVAR DEBUG SQL ADMIN</h3>
                        <div class="cfg-desc">Apenas programadores. Pode interferir no layout público — ative somente se souber o que está fazendo.</div>
                        <div class="cfg-row pill">
                          <input type="radio" id="dbgY" name="option[debug_sql]" value="Y" <?=$debug_sql_sim?>>
                          <label for="dbgY">Sim</label>
                          <input type="radio" id="dbgN" name="option[debug_sql]" value="N" <?=$debug_sql_nao?>>
                          <label for="dbgN">Não</label>
                        </div>
                      </div>       

					<!--
					  <div class="cfg-card">
                        <h3><span class="dot"></span> Avaliar acompanhantes</h3> 
                        <div class="cfg-row pill">
                          <input type="radio" id="dbgY" name="option[depoimentos]" value="Y" <? if($INI['option']['depoimentos'] =="Y" or $INI['option']['depoimentos'] ==""  ){echo "checked='checked'";}?>>
                          <label for="dbgY">Ativar</label>
                          <input type="radio" id="dbgN" name="option[depoimentos]" value="N" <? if($INI['option']['depoimentos'] =="N"    ){echo "checked='checked'";}?>>
                          <label for="dbgN">Desativar</label>
                        </div>
                      </div>
					-->  		 

						<div class="cfg-card">
                        <h3><span class="dot"></span> Moderação de anúncios</h3> 
                        <div class="cfg-row pill">
                          <input type="radio" id="dbgY" name="option[moderacaoanuncios]" value="Y" <?=$moderacaoanuncios_sim?>>
                          <label for="dbgY">Sim</label>
                          <input type="radio" id="dbgN" name="option[moderacaoanuncios]" value="N" <?=$moderacaoanuncios_nao?>>
                          <label for="dbgN">Não</label>
                        </div>
                      </div>
					  
					  
				 
					
											

                      <!-- CONFIGURAÇÕES DE MANUTENÇÃO -->
                      <div class="cfg-card">
                        <h3><span class="dot"></span> CONFIGURAÇÕES DE MANUTENÇÃO</h3>

                        <div class="cfg-desc">
                          <b>Página de manutenção:</b>
                          Ativar página inicial de manutenção no site para usuários, exceto Administrador.
                          <i>Para testar, faça logoff da administração.</i>
                        </div>
                        <div class="cfg-row pill">
                          <input type="radio" id="manIndexY" name="option[index_manutencao]" value="Y" <?=$index_manutencao_sim?>>
                          <label for="manIndexY">Sim</label>
                          <input type="radio" id="manIndexN" name="option[index_manutencao]" value="N" <?=$index_manutencao_nao?>>
                          <label for="manIndexN">Não</label>
                        </div>

                        <div class="cfg-desc" style="margin-top:14px;">
                          <b>Ativar página de manutenção padrão:</b> Ative para usar a nossa página padrão de manutenção.
                          <span class="cfg-note" style="margin-top:8px;">Se esta opção estiver ativada, a personalização abaixo será ignorada.</span>
                        </div>
                        <div class="cfg-row pill">
                          <input type="radio" id="manStdY" name="option[manutencao_padrao]" value="s" <?=$manut_padrao_sim?>>
                          <label for="manStdY">Sim</label>
                          <input type="radio" id="manStdN" name="option[manutencao_padrao]" value="N" <?=$manut_padrao_nao?>>
                          <label for="manStdN">Não</label>
                        </div>

                        <div class="cfg-desc" style="margin-top:14px;">
                          <b>Conteúdo da página manutenção padrão:</b> Altere somente se ativou manutenção padrão.
                        </div>
                        <div class="cfg-group">
                          <input class="cfg-input" type="text" placeholder="Título"
                                 name="option[manutencao_padrao_titulo]"
                                 value="<?=htmlspecialchars($INI['option']['manutencao_padrao_titulo']);?>">
                          <input class="cfg-input" type="text" placeholder="Frase de cabeçalho"
                                 name="option[manutencao_padrao_cabecalho]"
                                 value="<?=htmlspecialchars($INI['option']['manutencao_padrao_cabecalho']);?>">
                          <input class="cfg-input" type="text" placeholder="Frase de rodapé"
                                 name="option[manutencao_padrao_rodape]"
                                 value="<?=htmlspecialchars($INI['option']['manutencao_padrao_rodape']);?>">
                        </div>
                      </div>

                      <!-- DICA DE USO -->
                      <div class="cfg-card">
                        <h3><span class="dot"></span> DICA DE USO</h3>
                        <div class="cfg-note">
                          Atenção: somente o administrador (logado) terá acesso normal ao site sem ver a página de manutenção.
                          Para testar como visitante, abra uma janela anônima do Chrome (CTRL + SHIFT + N) sem estar logado no admin.
                        </div>
                      </div>

                      <!-- CONTEÚDO DA PÁGINA DE MANUTENÇÃO (PERSONALIZADA) -->
                      <div class="cfg-card">
                        <h3><span class="dot"></span> CONTEÚDO DA PÁGINA DE MANUTENÇÃO</h3>
                        <div class="cfg-desc">Somente se a página de manutenção <b>padrão</b> estiver desativada.</div>
                        <textarea class="cfg-text format_input ckeditor" name="option[conteudopaginamanutencao]" rows="6"><?=
                          htmlspecialchars($INI['option']['conteudopaginamanutencao']); ?></textarea>
                      </div>

                      <!-- HIDDENs usados pelo sistema (mantidos) -->
                      <input type="hidden" value="<?=$INI['option']['modulopagamento']?>" name="option[modulopagamento]">
                      <input type="hidden" value="Y" name="option[cpf]">
                      <input type="hidden" value="2" name="option[tpvulc]">
                      <input type="hidden" value=""  name="option[paginainicial]">
                      <input type="hidden" value="Y" name="option[conteudo_oferta_popular]">
                      <input type="hidden" value="Y" name="option[rand_popular]">

                    </div> <!-- /option_contents -->
                  </div>   <!-- /container_box -->
                </div>     <!-- /option_box -->
              </form>
            </div>
          </div>
          <div class="box-bottom"></div>
        </div>
      </div>

      <div id="sidebar"></div>
    </div>
  </div> <!-- bd end -->
</div> <!-- bdw end -->

<script>
function validador(){ return true; }
</script>
