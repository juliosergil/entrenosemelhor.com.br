<?php include template("manage_header"); ?>
<link rel="stylesheet" href="<?=$ROOTPATH?>/media/css/template.css" />
<link rel="stylesheet" href="<?=$ROOTPATH?>/media/css/dashboard.css" />
  
<?php
/* ===== Helpers dinâmicos para esquemas que variam ===== */

$con = DB::$mConnection;

function table_has_col(mysqli $con, $table, $col) {
  $rs = mysqli_query($con, "SHOW COLUMNS FROM `$table` LIKE '$col'");
  return $rs && mysqli_num_rows($rs) > 0;
}
function first_existing_col(mysqli $con, $table, $candidates) {
  foreach ($candidates as $c) if (table_has_col($con,$table,$c)) return $c;
  return null;
}
function column_type(mysqli $con, $table, $col) {
  $rs = mysqli_query($con, "SHOW COLUMNS FROM `$table` LIKE '$col'");
  if ($rs && ($r=mysqli_fetch_assoc($rs))) return strtolower((string)$r['Type']);
  return '';
}
function date_expr(mysqli $con, $table, $col) {
  $t = column_type($con, $table, $col);
  return (strpos($t,'int')!==false) ? "FROM_UNIXTIME(`$col`)" : "`$col`";
}
function count_total(mysqli $con, $table, $where='1') {
  $rs = mysqli_query($con,"SELECT COUNT(*) n FROM `$table` WHERE $where");
  $n = 0; if($rs && ($r=mysqli_fetch_assoc($rs))) $n=(int)$r['n']; return $n;
}
function count_periods(mysqli $con, $table, $dateCol, $where='1') {
  if (!$dateCol) return ['today'=>0,'month'=>0,'year'=>0];
  $D = date_expr($con,$table,$dateCol);
  $sql = "SELECT
            SUM(CASE WHEN DATE($D)=CURDATE() THEN 1 ELSE 0 END) today,
            SUM(CASE WHEN YEAR($D)=YEAR(CURDATE()) AND MONTH($D)=MONTH(CURDATE()) THEN 1 ELSE 0 END) month,
            SUM(CASE WHEN YEAR($D)=YEAR(CURDATE()) THEN 1 ELSE 0 END) year
          FROM `$table` WHERE $where";
  $rs = mysqli_query($con,$sql);
  $out = ['today'=>0,'month'=>0,'year'=>0];
  if($rs && ($r=mysqli_fetch_assoc($rs))) $out=['today'=>(int)$r['today'],'month'=>(int)$r['month'],'year'=>(int)$r['year']];
  return $out;
}
function count_status_pairs(mysqli $con, $table, $statusCol) {
  if (!$statusCol) return ['active'=>null,'pending'=>null];
  $active  = count_total($con,$table,"`$statusCol` IN ('Y','y','S','s',1,'1','A','ativo','aprovado')");
  $pending = count_total($con,$table,"`$statusCol` IN ('N','n',0,'0','P','pendente','aguardando','revisao')");
  return ['active'=>$active,'pending'=>$pending];
}

/* ====== Coletas por tabela ====== */

/* TEAM – anúncios */
$team_date   = first_existing_col($con,'team',['create_time','created_at','datacad','data','inicio','dt_cadastro']);
$team_status = first_existing_col($con,'team',['status','ativo','active','aprovado','publicado','enabled']);
$team_total  = count_total($con,'team','1');
$team_p      = count_periods($con,'team',$team_date,'1');
$team_s      = count_status_pairs($con,'team',$team_status);

/* USER – cadastros */
$user_date  = first_existing_col($con,'user',['create_time','created_at','datacad','data','dtcad']);
$user_total = count_total($con,'user','1');
$user_p     = count_periods($con,'user',$user_date,'1');

 

/* CATEGORY – categorias */
$cat_total = count_total($con,'category','1');
$cat_date  = first_existing_col($con,'category',['create_time','created_at','datacad','data','dtcad']);
$cat_p     = $cat_date ? count_periods($con,'category',$cat_date,'1') : ['today'=>0,'month'=>0,'year'=>0];

/* PAGE – artigos */
$page_date  = first_existing_col($con,'page',['create_time','created_at','datacad','data','dtcad']);
$page_total = count_total($con,'page','1');
$page_p     = count_periods($con,'page',$page_date,'1');
?>
 
 
 

<!-- (opcional) atalhos rápidos sob o header -->
  <section class="vmob-quick">
    <a class="tile" href="/vipmin/system/index.php">
      <svg class="qicon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="9"/><path d="M12 8h.01M11 12h2v6h-2"/></svg>
      <span>Informações do Site</span>
    </a>
    <a class="tile" href="/vipmin/system/option.php">
      <svg class="qicon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 21v-7M4 10V3M12 21V10M12 7V3M20 21v-5M20 12V3"/><circle cx="4" cy="14" r="2"/><circle cx="12" cy="10" r="2"/><circle cx="20" cy="17" r="2"/></svg>
      <span>Configurar Sistema</span>
    </a>
    <a class="tile" href="/vipmin/system/logo.php">
      <svg class="qicon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="4" width="18" height="16" rx="2"/><circle cx="8.5" cy="9" r="1.5"/><path d="M21 15l-5-5-4 4-2-2-5 5"/></svg>
      <span>Alterar Logo</span>
    </a>
    <a class="tile" href="/vipmin/system/cores.php">
      <svg class="qicon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="3" width="7" height="14" rx="2"/><rect x="10" y="5" width="7" height="14" rx="2"/></svg>
      <span>Cores do Site</span>
    </a> 
  </section>
  
	  

<div class="vip-grid">

	  
  <!-- Anúncios -->
  <section class="vip-card">
    <span class="vip-tag">Anúncios</span>
    <h3>Total de Anúncios <span class="badge badge-total"><?=number_format($team_total)?></span></h3>
    <ul class="vip-list">
      <li>Hoje <span class="kpi-small"><?=number_format($team_p['today'])?></span></li>
      <li>Mês <span class="kpi-small"><?=number_format($team_p['month'])?></span></li>
      <li>Ano <span class="kpi-small"><?=number_format($team_p['year'])?></span></li>
    </ul>
    <div class="vip-foot">
      <?php if($team_s['active']!==null){ ?>
        <span class="badge badge-ok">Ativos: <?=number_format($team_s['active'])?></span>
        <span class="badge badge-warn">Pendentes: <?=number_format($team_s['pending'])?></span>
      <?php } else { ?>
        <span class="badge badge-total">Status: —</span>
      <?php } ?>
    </div>
  </section>

  <!-- Usuários -->
  <section class="vip-card">
    <span class="vip-tag">Usuários</span>
    <h3>Novos Cadastros <span class="badge badge-total"><?=number_format($user_total)?></span></h3>
    <ul class="vip-list">
      <li>Hoje <span class="kpi-small"><?=number_format($user_p['today'])?></span></li>
      <li>Mês <span class="kpi-small"><?=number_format($user_p['month'])?></span></li>
      <li>Ano <span class="kpi-small"><?=number_format($user_p['year'])?></span></li>
    </ul>
  </section>

  <!-- Avaliações (depoimentos) -->
  <section class="vip-card">
    <span class="vip-tag">Avaliações</span>
    <h3>Avaliações aprovadas <span class="badge badge-total"><?=number_format($dep_total)?></span></h3>
    <ul class="vip-list">
      <li>Hoje <span class="kpi-small"><?=number_format($dep_p['today'])?></span></li>
      <li>Mês <span class="kpi-small"><?=number_format($dep_p['month'])?></span></li>
      <li>Ano <span class="kpi-small"><?=number_format($dep_p['year'])?></span></li>
    </ul>
    <div class="vip-foot">
      <span class="badge badge-ok">Média geral: <?=$dep_avg?><?=($dep_avg!=='—'?' ★':'')?></span>
    </div>
  </section>

  <!-- Categorias -->
  <section class="vip-card">
    <span class="vip-tag">Categorias</span>
    <h3>Total de Categorias <span class="badge badge-total"><?=number_format($cat_total)?></span></h3>
    <ul class="vip-list">
      <li>Hoje <span class="kpi-small"><?=number_format($cat_p['today'])?></span></li>
      <li>Mês <span class="kpi-small"><?=number_format($cat_p['month'])?></span></li>
      <li>Ano <span class="kpi-small"><?=number_format($cat_p['year'])?></span></li>
    </ul>
  </section>

  <!-- Artigos -->
  <section class="vip-card">
    <span class="vip-tag">Artigos</span>
    <h3>Total de Artigos <span class="badge badge-total"><?=number_format($page_total)?></span></h3>
    <ul class="vip-list">
      <li>Hoje <span class="kpi-small"><?=number_format($page_p['today'])?></span></li>
      <li>Mês <span class="kpi-small"><?=number_format($page_p['month'])?></span></li>
      <li>Ano <span class="kpi-small"><?=number_format($page_p['year'])?></span></li>
    </ul>
  </section>

</div>

<div class="clear"></div>
<div class="box-bottom"></div>
