<?php include template("manage_header");?>
 
<div id="bdw" class="bdw">
<div id="bd" class="cf">
<div id="coupons"> 
    <div id="content" class="coupons-box clear mainwide">
		<div class="box clear"> 
            <div class="box-content">
				<div class="option_box">
					<div class="top-heading group"> 
						<div class="left_float">
							<h4> 
							<?php if($selector=='failure'){?>
								 Anúncios Canceladas 
							<?php } else if($selector=='success') { ?>
								 Anúncios válidas, com período finalizado 
							<?php } else if($_REQUEST['acao']=='site') { ?>
								  Anúncios atuais no site  
							<?php } else { ?>
								 Anúncios 
							<?php }?>
							</h4> 
							
						</div> 
							<div class="the-button">
								<input type="hidden" value="remote" id="deliverytype" name="deliverytype">
								<button onclick="javascript:location.href='<?=$ROOTPATH?>/vipmin/team/edit.php'"  id="run-button" class="input-btn" type="button">
									<div name="spinner-top" id="spinner-top" style="width: 83px; display: block;"><img name="imgrec" id="imgrec" src="<?= $ROOTPATH ?>/media/css/i/lendo.gif" style="display: none;"></div>
									<div id="spinner-text">Adicionar</div>
								</button>	
								
								<!-- incluir este bloco para apagar todos os anuncios somente na tela de consulta de anuncios somente se ja tivesse um botao deste 
								<div class="the-button-desk">
									<button onclick="javascript:location.href='<?=$ROOTPATH?>/ajax/manage.php?action=teamremoveall'"  id="run-button" class="input-btn " type="button">
										<div name="spinner-top" id="spinner-top" style="width: 83px; display: block;"><img name="imgrec" id="imgrec" src="<?= $ROOTPATH ?>/media/css/i/lendo.gif" style="display: none;"></div>
										<div id="spinner-text">Apagar Tudo</div>
									</button>
								</div>
								<!-- fim bloco --> 
							</div> 

					</div> 
					<div class="paginacaotop"><?php echo $pagestring; ?></div>		

					<div class="atencao">
						Arraste a tabela pra esquerda para ver as outras colunas
					</div>
				
					<div class="sect" style="clear:both;">
						<table id="orders-list" cellspacing="0" cellpadding="0" border="0" class="coupons-table">
						<form method="get">
						<tr>
						<th width="40">ID <input type="text"  name="idoferta"  id="idoferta" style="width: 50%; color:#303030;font-size:11px;"> </th>
						<th width="350">Anúncio <input type="text"  value="<?=$_REQUEST['team_title']?>" name="team_title"  id="team_title" style="width: 75%; color:#303030;font-size:11px;"></th>
						<th width="40">Cliques  </th>
						 <th width="120"> 
							<select  name="city_id" id="city_id"  style="width:95%;height:23px;font-weight:normal;font-size:11px;">  
							 	<option value=""> Cidade </option>
								 <?php  
								   $indentacao = "....";
								   $sql = "select DISTINCT c.nome, c.id from cidades c INNER JOIN team t ON t.city_id = c.id order by nome";

									$rs = mysqli_query(DB::$mConnection,$sql);
									while($l = mysqli_fetch_assoc($rs)){
									 $selected ="";
									 if($_REQUEST['city_id'] == $l['id']){
											$selected =  " selected ";
									 } 
										echo "<option value='".$l["id"]."' $selected>".displaySubStringWithStrip($l['nome'],30)."</option>";
										 
									} 
								  ?> 		 
							 </select>
						 </th>	

						 <th width="120"> 
							<select  name="group_id" id="group_id"  style="width:95%;height:23px;font-weight:normal;font-size:11px;">  
							 	<option value=""> Categoria </option>
								 <?php  
								   $indentacao = "....";
								   $sql = "select * from category where display ='Y'  and idpai=0 order by sort_order desc,name";

									$rs = mysqli_query(DB::$mConnection,$sql);
									while($l = mysqli_fetch_assoc($rs)){
									 $selected ="";
									 if($_REQUEST['group_id'] == $l['id']){
											$selected =  " selected ";
									 } 
										echo "<option value='$l[id]' $selected>".displaySubStringWithStrip($l['name'],30)."</option>";
										exibe_filhos($l["id"],$indentacao,$_REQUEST['group_id']);
									} 
								  ?> 		 
							 </select>
						 </th>
						
						<th width="120" nowrap><select id="user_id" name="user_id" class="f-input"   style="width:95%;height:23px;font-weight:normal;font-size:11px;"> 
							<option value="">Todos os anunciantes</option>
							<?php  
								   $sql = "select DISTINCT u.realname, u.id from user u INNER JOIN team t ON t.user_id = u.id order by realname ASC";

									$rs = mysqli_query(DB::$mConnection,$sql);
									while($l = mysqli_fetch_assoc($rs)){
									 $selected ="";
									 if($_REQUEST['city_id'] == $l['id']){
											$selected =  " selected ";
									 } 
										echo "<option value='".$l["id"]."' $selected>".displaySubStringWithStrip($l['realname'],30)."</option>";
										 
									} 
							?> 	
						</select> </th>
						<th width="40">Período</th> 
						<th width="60" nowrap>Preço</th>
						<th width="60" nowrap>Status</th>
						<th width="220">  
						<button style="width: 60px;" type="submit"><span>Buscar</span></button>
						<button style="width: 60px"  onclick="resetFilter()" type="button"><span>Limpar</span></button>
						<!-- 
						<button style="width: 60px"  onclick="gerarPDF()" type="button"><span>PDF</span></button>
						<button style="width: 60px" onclick="gerarExcel()" type="button"><span>Excel</span></button>
						-->
						</th>
						</tr>
						</form>
						<?php if(is_array($teams)){foreach($teams AS $index=>$one) { 
								$bregistro =  true; 
								  
								require("manage_team_controle.php");  
							
						 ?>
						<?php $oldstate = $one['state']; ?>
						<?php $one['state'] = team_state($one); ?>
						<tr <?php echo $index%2?'class="normal"':'class="alt"'; ?> id="team-list-id-<?php echo $one['id']; ?>">
							<td><?php echo $one['id']; ?> <img alt="<?=$title?>" title="<?=$title?>" src="/media/css/i/<?=$bandeira?>" style="width: 22px;"> </td>
							<td><?php echo $one['title']; ?></td> 
							<td><?php echo $one['clicados']; ?></td> 
							<td nowrap><?php   echo "<br/>". $cities[$one['city_id']]['nome'];  ?></td> 
							<td nowrap> <?php  echo "<br/>". $groups[$one['group_id']]['name'];  ?></td> 
							<td nowrap> <?php echo $user[$one['user_id']]['realname']; ?></td> 
							<td nowrap><?php if($one['pago']=="sim" or $one['anunciogratis']=="s"){ echo date('d/m/Y',  $one['begin_time'] );?> <br> <?php echo date('d/m/Y',  $one['end_time'] ); } else { echo " - "; }?></td> 
							<td nowrap><span class="money"><span class="money"><?php echo $currency; ?></span><?php echo moneyit3($one['team_price']); ?> <!-- € --></td>
							<td nowrap><span class="money"> <?=$title?></td>
							<td class="op" nowrap>
								
							<div style="float: left; margin-right: 2px;"><a  target="_blank" href="/index.php?idoferta=<?php echo $one['id']; ?>"><img alt="Visualizar Oferta" title="Visualizar Oferta" src="/media/css/i/Monitoring.ico" style="width: 22px;"></a></div>
								
							<div style="float: left; margin-right: 2px;"><a href="/vipmin/team/edit.php?id=<?php echo $one['id']; ?>"><img alt="Editar Oferta" title="Editar Oferta" src="/media/css/i/editar.png" style="width: 22px;"></a></div>
							<div style="float: left; margin-right: 2px;"><a href="/ajax/manage.php?action=teamremove&id=<?php echo $one['id']; ?>" class="ajaxlink" ask="Você tem certeza que deseja apagar essa oferta?" ><img alt="Excluir" title="Excluir" style="width: 17px;" src="/media/css/i/excluir.png"></a></div>
						  
							</td>
						</tr>
						<?php }} ?>
						<?if(!$bregistro){?><tr><td colspan="15" style="text-align: center;">Nenhum registro encontrado. Redefina sua pesquisa</tr><? } ?>
						<tr><td colspan="10"><?php echo $pagestring; ?></tr>
						</table>
					</div> 
				</div>
            </div>
            <div class="box-bottom"></div>
        </div>
    </div>
</div>
</div> <!-- bd end -->
</div> <!-- bdw end -->



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
	window.open(url + '/vipmin/team/pdf.php?'+params, '_blank');
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
	window.open(url + '/vipmin/team/excel.php?'+params, '_blank');
}
 </script>
 