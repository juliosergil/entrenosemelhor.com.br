<?php
// ===== Defaults para o conteúdo da manutenção padrão =====
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
?>
 
<!-- ===== Manutenção: Configurações principais ===== -->
<div class="cfg-grid">

  <!-- Coluna Esquerda -->
  <div class="cfg-card">
    <h4>Configurações de manutenção</h4>

    <!-- Página de manutenção -->
    <div class="group">
      <span class="report-head">Página de manutenção:</span>
      <span class="cpanel-date-hint">
        Ativar página inicial de manutenção no site para usuários, exceto Administrador.
        <b>Para testar, faça logoff da administração.</b>
      </span>

      <div class="switch-pills" style="margin-top:6px;">
        <input type="radio" id="idx_on" name="option[index_manutencao]" value="Y" <?php if($INI['option']['index_manutencao']=="Y") echo "checked='checked'"; ?> />
        <label for="idx_on">Sim</label>

        <input type="radio" id="idx_off" name="option[index_manutencao]" value="N" <?php if($INI['option']['index_manutencao']=="N") echo "checked='checked'"; ?> />
        <label for="idx_off">Não</label>

        <img class="tTip" style="cursor:help;margin-left:6px"
             id="Search_ToolTip" src="<?=$ROOTPATH?>/media/css/i/info.png"
             title="Ao ativar essa opção só o administrador terá acesso ao site; os demais usuários verão uma página de aviso com o conteúdo abaixo." />
      </div>
    </div>

    <!-- Página padrão -->
    <div class="group">
      <span class="report-head">Ativar página de manutenção padrão:</span>
      <span class="cpanel-date-hint">Ative para usar a nossa página padrão de manutenção.</span>

      <div class="switch-pills" style="margin-top:6px;">
        <input type="radio" id="mp_on" name="option[manutencao_padrao]" value="s"
               <?php if($INI['option']['manutencao_padrao']=="s" || $INI['option']['manutencao_padrao']=="") echo "checked='checked'"; ?> />
        <label for="mp_on">Sim</label>

        <input type="radio" id="mp_off" name="option[manutencao_padrao]" value="N"
               <?php if($INI['option']['manutencao_padrao']=="N") echo "checked='checked'"; ?> />
        <label for="mp_off">Não</label>

        <img class="tTip" style="cursor:help;margin-left:6px"
             id="Search_ToolTip" src="<?=$ROOTPATH?>/media/css/i/info.png"
             title="Se esta opção estiver ativada, a sua personalização (abaixo) será ignorada." />
      </div>
    </div>

    <!-- Conteúdo da página padrão -->
    <div class="group">
      <span class="report-head">Conteúdo da página manutenção padrão:</span>
      <span class="cpanel-date-hint">Altere somente se ativou a manutenção padrão.</span>

      <div class="group" style="margin-top:8px;">
        <input class="compact" placeholder="Título" type="text" name="option[manutencao_padrao_titulo]"
               value="<?php echo $INI['option']['manutencao_padrao_titulo']; ?>" />
        <img class="tTip" title="Este título aparece apenas quando a manutenção padrão está ativa."
             style="cursor:help;margin-left:6px" src="<?=$ROOTPATH?>/media/css/i/info.png">
      </div>

      <div class="group">
        <input class="compact" placeholder="Frase de cabeçalho" type="text" name="option[manutencao_padrao_cabecalho]"
               value="<?php echo $INI['option']['manutencao_padrao_cabecalho']; ?>" />
        <img class="tTip" title="Texto do cabeçalho da página de manutenção padrão"
             style="cursor:help;margin-left:6px" src="<?=$ROOTPATH?>/media/css/i/info.png">
      </div>

      <div class="group">
        <input class="compact" placeholder="Frase de rodapé" type="text" name="option[manutencao_padrao_rodape]"
               value="<?php echo $INI['option']['manutencao_padrao_rodape']; ?>" />
        <img class="tTip" title="Texto do rodapé da página de manutenção padrão"
             style="cursor:help;margin-left:6px" src="<?=$ROOTPATH?>/media/css/i/info.png">
      </div>
    </div>
  </div>

  <!-- Coluna Direita -->
  <div class="cfg-card">
    <h4>Dica de uso</h4>
    <div class="group">
      Atenção: somente o administrador (logado) terá acesso normal ao site sem ver a página de manutenção.
      Para testar como visitante, abra uma janela anônima do Chrome (CTRL + SHIFT + N) sem estar logado no admin.
    </div>
  </div>

</div><!-- /cfg-grid -->

<!-- ===== Conteúdo personalizado (quando a página padrão estiver desativada) ===== -->
<div class="cfg-card cfg-full" style="margin-top:20px;">
  <h4>Conteúdo da página de manutenção (somente se a <em>padrão</em> estiver desativada)</h4>
  <div class="group" style="margin-top:10px;">
    <div class="text_area">
      <textarea cols="45" rows="5" name="option[conteudopaginamanutencao]" style="width:100%" class="format_input ckeditor"><?php
        echo htmlspecialchars($INI['option']['conteudopaginamanutencao']);
      ?></textarea>
    </div>
  </div>
</div>
