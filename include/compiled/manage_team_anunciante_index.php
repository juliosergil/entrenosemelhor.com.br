<?php include template("manage_anunciante_header"); ?>

<?php echo showModal($_SESSION['modal']); ?>
 
<div id="coupons" class="container-fluid"> 
    <div id="content" class="coupons-box clear mainwide row">
		<div class="box clear col-md-12"> 
            <div class="box-content">
				<div class="option_box">
					<div class="top-heading group"> 
							<div class="col-md-3 col-xs-12 col-sm-12" style="padding: 10px;">
								<h4> 
							<?php if($selector=='failure'){?>
								<span style="color:#007bff; font-weight:bold;">
								  Finalizados 
								</span> 
							<?php }  else if($_REQUEST['acao']=='site') { ?>
								<span style="color:#007bff; font-weight:bold;">
								   Anúncios Online  
								</span>
							<?php } else { ?>
							<span style="color:#007bff; font-weight:bold;">
								   Todos  
							</span>
							<?php }?>
							</h4> 
							
						</div> 
						<div class="col-md-9 col-xs-12 col-sm-12" style="padding: 10px;">
							<div class="anunciantes_buttons">
								<div class="col-md-3">
									<button onclick="javascript:location.href='<?=$ROOTPATH?>/adminanunciante/team/edit.php'"  id="run-button" class="btn btn-success btn-block"  type="button">Novo</button>
								</div>
								<div class="col-md-3">
									<button onclick="javascript:location.href='<?=$ROOTPATH?>/adminanunciante/team/failure.php'"  id="run-button" class="btn btn-warning btn-block"  type="button">Cancelados</button>
								</div>
								<div class="col-md-3">
									<button onclick="javascript:location.href='<?=$ROOTPATH?>/adminanunciante/team/index.php?acao=site'"  id="run-button" class="btn btn-primary btn-block"  type="button">No site</button>
								</div>
								<div class="col-md-3">
									<button onclick="javascript:location.href='<?=$ROOTPATH?>/adminanunciante/team/index.php'"  id="run-button" class="btn btn-success btn-block"  type="button">Todos</button>								
								</div>
							</div>
						</div>
					</div>  
				<?php
					$max_string = '';
					$anunciante = Table::Fetch('user', $_SESSION['user_id']);
					$count2SQL = mysqli_fetch_row(mysqli_query(DB::$mConnection,"SELECT COUNT(id) FROM team WHERE user_id = '{$anunciante['id']}'"));
					$count2 = $count2SQL[0];
					if ($anunciante['max_anuncios'] > 0) {
						$diferenca = $anunciante['max_anuncios'] - $count2;
						
						if($diferenca==0){
							$max_string = "Você não tem saldo. Clique em adicionar anúncio para escolher um plano.";
						}
						if($diferenca==1){
							$max_string = "Voce ainda pode cadastrar {$diferenca} anúncio";
						}
						else if($diferenca > 1){
							$max_string = "Voce ainda pode cadastrar {$diferenca} anúncios";
						}
					 //$max_string = utf8_decode("Voce possui {$count2} anuncio(s) de um total de {$anunciante['max_anuncios']} liberado(s) para o seu plano. Resta(m) {$diferenca}.");
					}
					?>  
					<div class="paginacaotop"><?php echo $pagestring; ?> <!-- $max_string --></div>				
					<div class="sect" style="clear:both;">
						<div class="table-responsive">
							 
							<table id="orders-list" class="table table-inverse">
								<thead class="thead-inverse">
									<form method="get">
										<tr>
												  
											<th width="80">ID <br /><input type="text"  name="idoferta"  id="idoferta" style="width: 50%; color:#303030;font-size:11px;"> </th>
											<th width="350">Anúncio <br /><input type="text"  value="<?=$_REQUEST['team_title']?>" name="team_title"  id="team_title" style="width: 75%; color:#303030;font-size:11px;"></th>										 
											 
								
														
															  
																					   
																	
																  
																													   
											 
								
											<th width="40">Cliques <br /></th>
											<th width="120">Cidade</th>
											<th width="40">Período</th> 
											<th width="60" nowrap>Preço</th>
											<th width="60" nowrap>Status</th>
											<th width="220">  
											
												<button type="submit" class="btn btn-success"><span>Buscar</span></button>
												<button onclick="resetFilter()" type="button" class="btn btn-warning"><span>Limpar</span></button> 
																								  
											</th>
										</tr>
									</form>
				
									<?php if(is_array($teams)){foreach($teams AS $index=>$one) { 
											$bregistro =  true; 
											$cidade = $cities[$one['city_id']]['nome'];	 
											require("manage_team_controle.php"); 
											$tituloanuncio = $one['title'];
											
											
											$partner_plano_id = $one['partner_plano_id'];
											$partner_planos  = Table::Fetch('partner_planos',$partner_plano_id);
											$plano_id  = $partner_planos["plano_id"];
											if(empty($plano_id )){
												$plano_id =2;
											}
								
								
									 ?> 
									<?php $oldstate = $one['state']; ?>
									<?php $one['state'] = team_state($one); ?>
									<tr <?php echo $index%2?'class="normal"':'class="alt"'; ?> id="team-list-id-<?php echo $one['id']; ?>">
										<?if($INI['option']['box-anunciogratis']!="Y"){?><td><?php echo $one['id']; ?> <img alt="<?=$title?>" title="<?=$title?>" src="/media/css/i/<?=$bandeira?>" style="width: 22px;"> </td><? } ?>
										<td><?php echo $tituloanuncio ; ?></td> 
										<td><?php echo $one['clicados']; ?></td> 
										<td nowrap><?php echo $cidade ; ?> </td> 
									 
										<td nowrap><?php if($one['pago']=="sim" or $one['anunciogratis']=="s"){ echo date('d/m/Y',  $one['begin_time'] );?> <br> <?php echo date('d/m/Y',  $one['end_time'] ); } else { echo " - "; }?></td> 
										<td nowrap><span class="money"><span class="money"><?php echo $currency; ?></span><?php echo moneyit3($one['team_price']); ?>  <!-- € --></td>
										<td nowrap><span class="money"> <?=$title?></td>
										<td class="op" nowrap>
										<?
										   if($one['pago']  !="sim" and  $one['anunciogratis']!="s"){  ?>
											<div style="float: left; margin-right: 10px;"><a href="/include/compiled/manage_team_pagamento_mercadopago.php?idplano=<?php echo $plano_id; ?>&teamid=<?php echo $one['id']; ?>"  ><img alt="Efetuar o pagamento" title="Efetuar o pagamento" style="width: 28px;" src="/media/css/i/payment-card-icon.png"></a></div>
										 <?php } ?>
										  
										<? if(file_exists(WWW_MOD."/propostas.inc")){  if($oferta_desativada ){?> <div style="float: left; margin-right: 10px;"><a  onclick="javascript:republicaranuncio('<?php echo $one['id']; ?>');" href="#"  ><img alt="Republicar anúncio." title="Republicar anúncio." style="width: 22px;" src="/media/css/i/Button-Refresh-icon.png"></a></div><?  } }?>
										 <?php
											if(isvalidteam($one)){
										?>
										<div style="float: left; margin-right: 10px;"><a  target="_blank" href="/index.php?idoferta=<?php echo $one['id']; ?>"><img alt="Visualizar anúncio" title="Pré visualizar anúncio" src="/media/css/i/Monitoring.png" style="width: 22px;"></a></div>
										<?php
											}
										?>
										<div style="float: left; margin-right: 10px;"><a href="/adminanunciante/team/edit.php?id=<?php echo $one['id']; ?>"><img alt="Editar anúncio" title="Editar anúncio" src="/media/css/i/editar.png" style="width: 22px;"></a></div>
										<div style="float: left; margin-right: 10px;"><a href="/ajax/manage.php?action=teamremove&id=<?php echo $one['id']; ?>" class="ajaxlink" ask="Você tem certeza que deseja apagar esse anúncio?" ><img alt="Excluir" title="Excluir" style="width: 22px;" src="/media/css/i/excluir.png"></a></div>
										 
										<?php 
											$sql =  "SELECT count(id) as total FROM `coupon` where team_id = ".$one['id']; 
											$rs = mysqli_query(DB::$mConnection,$sql);
											$linha = mysqli_fetch_object($rs);
											$total = $linha->total;
										   
										?>
									  
										</td>
									</tr>
									<?php }} ?>
									<?if(!$bregistro){?><tr><td colspan="15" style="text-align: center;">Nenhum registro encontrado. Redefina sua pesquisa</tr><? } ?>
									<tr><td colspan="10"><?php echo $pagestring; ?></tr>
								</thead>
							</table>
			  
						</div>
					</div>
				<div class="box-bottom"></div>
			</div>
		</div>
	</div>
</div>
</div>



 <script> 
 function resetFilter(){
	location.href  = '<?php echo $_SERVER["PHP_SELF"] ?>';
 }
 </script>
    <script>
  function msg(){
		//jQuery.colorbox({html:"<div class='msgsoft'><img src='<?=$PATHSKIN?>/images/ajax-loader2.gif'> Deletando este Anúncio...</div>"});
	}  
  function processar(){
		jQuery.colorbox({html:"<div class='msgsoft'><img src='<?=$PATHSKIN?>/images/ajax-loader2.gif'> Processando, aguarde...</div>"});
	}
	
	
function gerarPDF(){
	var url = <?php echo "'" . $INI['system']['wwwprefix'] . "';"; ?>

	if($('#idoferta').val() != ''){
		var idoferta = $('#idoferta').val();
	}else{
		var idoferta = 'undefined';
	}

	if($('#team_title').val() != ''){
		var team_title = $('#team_title').val();
	}else{
		var team_title = 'undefined';
	}

	if($('#team_type option:selected').val() != ''){
		var team_type = $('#team_type option:selected').val();
	}else{
		var team_type = 'undefined';
	}

	if($('#city_id option:selected').val() != ''){
		var city_id = $('#city_id option:selected').val();
	}else{
		var city_id = 'undefined';
	}

	if($('#partner_id option:selected').val() != ''){
		var partner_id = $('#partner_id option:selected').val();
	}else{
		var partner_id = 'undefined';
	}

	var params = 'team_type='+team_type+'&team_title='+team_title+'&city_id='+city_id+'&partner_id='+partner_id;
	window.open(url + '/adminanunciante/team/pdf.php?'+params, '_blank');
}

function gerarExcel(){
	var url = <?php echo "'" . $INI['system']['wwwprefix'] . "';"; ?>

	if($('#idoferta').val() != ''){
		var idoferta = $('#idoferta').val();
	}else{
		var idoferta = 'undefined';
	}

	if($('#team_title').val() != ''){
		var team_title = $('#team_title').val();
	}else{
		var team_title = 'undefined';
	}

	if($('#team_type option:selected').val() != ''){
		var team_type = $('#team_type option:selected').val();
	}else{
		var team_type = 'undefined';
	}

	if($('#city_id option:selected').val() != ''){
		var city_id = $('#city_id option:selected').val();
	}else{
		var city_id = 'undefined';
	}

	if($('#partner_id option:selected').val() != ''){
		var partner_id = $('#partner_id option:selected').val();
	}else{
		var partner_id = 'undefined';
	}

	var params = 'team_type='+team_type+'&team_title='+team_title+'&city_id='+city_id+'&partner_id='+partner_id;
	window.open(url + '/adminanunciante/team/excel.php?'+params, '_blank');
}

function republicaranuncio(id){ 
 
	// jQuery.colorbox({html:"<div class='msgsoft'><img src='<?=$PATHSKIN?>/images/ajax-loader2.gif'> Aguarde, estamos renovando este anúncio</div>"});
	 $.get(WEB_ROOT+"/ajax/manage.php?action=republica&id="+id,
	function(data){ 
		//jQuery.colorbox({html:data});
		location.href  = '<?php echo $_SERVER["PHP_SELF"] ?>';
	});	 
}


 </script>