<?php
  $URL_ATUAL = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  $urla = explode("vipmin", $URL_ATUAL);
  $url = $urla[0];
?>

<div class="veralteracao">
  <a href="<?=$url?>" target="_blank" class="cta-verify" aria-label="Abrir site público">
    <!-- ícone (check) -->
    <svg viewBox="0 0 24 24" aria-hidden="true">
      <path fill="currentColor" d="M9.5 16.5 4.75 11.7l1.5-1.5 3.25 3.2 7.25-7.2 1.5 1.5-8.75 8.8z"/>
    </svg>
  </a>
</div>

<style>
/* garante que o botão fique ancorado ao topo, sem ser FIXO na janela */
#hd{ position: relative; }               /* o container do header vira referência */
.veralteracao{
  position: absolute;                    /* ancora dentro do #hd */
  right: 24px;                           /* encosta no canto direito do topo */
  top: 16px;                             /* ajuste vertical fino */
  z-index: 5;
}

/* reseta qualquer regra antiga que deixava o botão fixo */
.vipmin-header .cta-verify{ position: static !important; }

/* versão somente-ícone (chip redondo) */
.cta-verify{
  --bg1:#22c55e; --bg2:#16a34a; --bd:#15803d;
  width: 38px; height: 38px;
  display:inline-flex; align-items:center; justify-content:center;
  border-radius: 999px;
  background: linear-gradient(180deg,var(--bg1),var(--bg2));
  border: 1px solid var(--bd);
  color:#fff; text-decoration:none;
  box-shadow: 0 6px 20px rgba(34,197,94,.35), inset 0 1px rgba(255,255,255,.15);
  transition: transform .18s ease, box-shadow .18s ease, filter .18s ease;
  padding:0; gap:0;                      /* sem texto */
}
.cta-verify svg{ width:18px; height:18px; }
.cta-verify:hover{ transform:translateY(-1px); }
.cta-verify:active{ transform:none; filter:brightness(.96); }
.cta-verify:focus-visible{
  outline: none;
  box-shadow: 0 0 0 3px rgba(34,197,94,.55), 0 6px 20px rgba(34,197,94,.35);
  border-color:#16a34a;
}

/* (opcional) se o header ficar muito baixo em telas menores, ajusta a distância do topo */
@media (max-width: 1366px){
  .veralteracao{ top: 12px; right: 16px; }
}
</style>
