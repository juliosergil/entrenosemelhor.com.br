<?php
  $has_gateway = file_exists(WWW_MOD."/gateway.inc");
?>

<style>
/* ====== LINK DE PAGAMENTO (escopo) ====== */
.planx-pay .planx-field{margin:0 0 14px}
.planx-pay .planx-field label{display:block;font-weight:700;margin:0 0 6px;color:#0f172a}
.planx-pay .planx-input{width:100%;height:44px;border-radius:10px;border:1px solid #e5e7eb;background:#f8fafc;padding:10px 12px;font-size:14px;outline:0;transition:border .15s, box-shadow .15s}
.planx-pay .planx-input:focus{border-color:#6366f1;box-shadow:0 0 0 3px rgba(99,102,241,.15)}
.planx-pay .planx-inline{display:flex;gap:8px;align-items:center}
.planx-pay .planx-hint{font-size:12px;color:#64748b;margin-top:6px}
.planx-pay .planx-btn{height:36px;border-radius:9px;border:1px solid #e5e7eb;background:#fff;padding:0 12px;font-weight:600;cursor:pointer}
.planx-pay .planx-btn:hover{background:#f1f5f9}
.planx-pay .planx-alert{
  border:1px solid #e5e7eb;border-left:4px solid #22c55e;background:#f8fafc;
  border-radius:12px;padding:12px 14px;margin:8px 0 16px;line-height:1.45;color:#0f172a
}
.planx-pay .planx-alert.planx-warn{border-left-color:#f59e0b}
.planx-pay .planx-alert b{color:#0ea5e9}

.planx-pay .planx-steps{display:grid;grid-template-columns:repeat(3,minmax(220px,1fr));gap:14px;margin-top:12px}
@media (max-width:1100px){.planx-pay .planx-steps{grid-template-columns:1fr}}
.planx-pay .planx-stepcard{
  border:1px solid #e5e7eb;border-radius:12px;background:#fff;padding:12px 14px
}
.planx-pay .planx-steptitle{font-weight:800;margin-bottom:8px}
.planx-pay .planx-badges{display:flex;flex-wrap:wrap;gap:8px}
.planx-pay .planx-badge{
  display:inline-block;padding:6px 10px;border-radius:999px;border:1px solid #e5e7eb;
  background:#f8fafc;font-weight:700;font-size:12px;text-decoration:none;color:#0f172a
}
.planx-pay .planx-badge:hover{background:#eef2ff;border-color:#c7d2fe}
</style>

<div class="planx-pay">

  <?php if ($has_gateway): ?>
    <div class="planx-alert">
      <b>Atenção:</b> Detectamos <b>retorno automático</b> integrado.
      Você <u>não precisa</u> informar link de pagamento. Para alterar o valor do plano, basta editar o campo
      <b>“Valor do Plano”</b> nesta tela.
      <br>Se você preencher um link manual neste plano, o retorno automático <b>não</b> atualizará o sistema.
    </div>
  <?php endif; ?>

  <div class="planx-field">
    <label for="linkpagamento">
      Link de pagamento
      <span class="planx-hint">Informe uma URL com <b>https://</b> &nbsp;ex.: <b>https://pag.ae/7Zqjwatjp</b></span>
    </label>

    <div class="planx-inline">
      <input
        type="text"
        maxlength="255"
        id="linkpagamento"
        name="linkpagamento"
        class="planx-input"
        value="<?php echo htmlentities($planos_publicacao['linkpagamento']); ?>"
        placeholder="https://"
      />
      <button type="button" class="planx-btn" id="limpar-link">Limpar</button>
    </div>

    <div class="planx-hint">
      Dica: crie o link na plataforma do seu gateway (PagSeguro, Mercado Pago, PayPal etc.), copie e cole aqui.
      Se usar link manual, o retorno automático fica desativado para este plano.
    </div>
  </div>

  <?php if ($has_gateway): ?>
    <div class="planx-field" style="margin-top:4px">
      <label class="planx-inline" style="font-weight:600">
        <input type="checkbox" id="forcar-manual" style="margin-right:8px">
        Forçar uso de link manual neste plano
      </label>
      <div class="planx-hint">Desmarcado: campo desabilitado e vazio (recomendado para retorno automático).</div>
    </div>
  <?php endif; ?>

  <div class="planx-alert planx-warn">
    <b>Como gerar o link no seu gateway</b><br>
    Acesse sua conta do gateway e procure por <b>Link de Pagamento</b>. Defina nome/valor, salve e copie o link.
  </div>

  <div class="planx-steps">
    <div class="planx-stepcard">
      <div class="planx-steptitle">PagSeguro</div>
      <div class="planx-badges">
        <a target="_blank" class="planx-badge" href="https://www.tkstore.com.br/imagens/linkpag_1.jpg">passo 1</a>
        <a target="_blank" class="planx-badge" href="https://www.tkstore.com.br/imagens/linkpag_2.jpg">passo 2</a>
        <a target="_blank" class="planx-badge" href="https://www.tkstore.com.br/imagens/linkpag_3.jpg">passo 3</a>
        <a target="_blank" class="planx-badge" href="https://www.tkstore.com.br/imagens/linkpag_4.jpg">passo 4</a>
      </div>
    </div>

    <div class="planx-stepcard">
      <div class="planx-steptitle">PayPal</div>
      <div class="planx-badges">
        <a target="_blank" class="planx-badge" href="https://www.tkstore.com.br/imagens/lp1.jpg">passo 1</a>
        <a target="_blank" class="planx-badge" href="https://www.tkstore.com.br/imagens/lp2.jpg">passo 2</a>
        <a target="_blank" class="planx-badge" href="https://www.tkstore.com.br/imagens/lp3.jpg">passo 3</a>
        <a target="_blank" class="planx-badge" href="https://www.tkstore.com.br/imagens/lp4.jpg">passo 4</a>
        <a target="_blank" class="planx-badge" href="https://www.tkstore.com.br/imagens/lp5.jpg">passo 5</a>
      </div>
    </div>

    <div class="planx-stepcard">
      <div class="planx-steptitle">Mercado Pago</div>
      <div class="planx-badges">
        <a target="_blank" class="planx-badge" href="https://www.tkstore.com.br/imagens/mercado_pago_criar_link_pagamento.png">passo 1</a>
        <a target="_blank" class="planx-badge" href="https://www.tkstore.com.br/imagens/mercado_pago_criar_link_pagamento_passo2.png">passo 2</a>
      </div>
    </div>
  </div>

  <div class="planx-hint" style="margin-top:10px">
    Tem outro gateway? Verifique na plataforma se existe a opção de <b>gerar link de pagamento</b>.
  </div>
</div>

<script>
  (function($){
    $(function(){
      var hasGateway = <?php echo $has_gateway ? 'true':'false'; ?>;

      // botão limpar
      $('#limpar-link').click(function(){ $('#linkpagamento').val(''); });

      // comportamento com retorno automático
      if(hasGateway){
        var $input = $('#linkpagamento');
        var $chk   = $('#forcar-manual');

        function applyState(){
          if($chk.is(':checked')){
            $input.prop('disabled', false).attr('placeholder','https://');
          }else{
            $input.val('').prop('disabled', true).attr('placeholder','Integração ativa — deixe vazio');
          }
        }
        $chk.on('change', applyState);
        applyState(); // estado inicial
      }
    });
  })(jQuery);
</script>
