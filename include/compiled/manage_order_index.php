<?php include template("manage_header");?>
 
<div id="bdw" class="bdw">
<div id="bd" class="cf">
<div id="coupons">
    <div id="content" class="coupons-box clear mainwide">
		<div class="box clear"> 
            <div class="box-content">
			 <div class="option_box">
					<div class="top-heading group"> <div class="left_float"><h4>Planos</h4></div> </div> 
						 
					<div class="paginacaotop">
					  <?php echo $pagestring; ?>
					</div>

					<div class="atencao">
						Arraste a tabela pra esquerda para ver as outras colunas
					</div>
					  
					<div class="sect" style="clear:both;">
						<table id="orders-list" cellspacing="0" cellpadding="0" border="0" class="coupons-table">
						
						<form method="get">
						<tr><td colspan="13" style="text-align: center;">O plano grátis deve ser <b>sempre o ID 10</b>, para o bom funcionamento da plataforma. O plano grátis já está cadastrado, não sendo necessário criar outro plano grátis  </tr>
						
						<tr>
						<th width="20">ID</th>
						<th width="100">Nome</th>
						<th width="150">Dias de Publicação</th>
						 <!-- <th width="150">Qtde de Anúncios</th> -->
						<? if(file_exists(WWW_MOD."/propostas.inc")){?><th width="150">Destaque</th><? } ?>
						<th width="80">Valor</th>
						<? if(file_exists(WWW_MOD."/topo.inc")){?><th width="80">Volta ao topo</th><? } ?>
						<th width="80">Ativo</th>
						<th width="80">Slide interno</th>
						<th width="500">Texto</th> 
						<th width="500">Editar</th> 
						</th> 
						</tr>
						</form>
						 
						 <?php if(is_array($orders)){foreach($orders AS $index=>$one) { $bregistro =  true;  ?>
						<tr <?php echo $index%2?'':'class="alt"'; ?> id="order-list-id-<?php echo $one['id']; ?>">
						
							<td><?php echo $one['id']; ?></td>
							<td><?php echo $one['nome']; ?></td>
							<td><?php echo $one['dias']; ?></td>
						 <!--    <td><?php echo $one['qtdeanuncio']; ?></td>  -->
							<? if(file_exists(WWW_MOD."/propostas.inc")){?><td><?php echo $one['destaque']; ?></td><? } ?>
							<td><?php echo $one['valor']; ?></td>
							<!-- <td><?php echo $one['top'] == 's' ? 'Sim' : 'Não'; ?></td>-->
							<td><?php echo $one['ativo'] == 's' ? 'Sim' : 'Não'; ?></td>
							<td><?php echo $one['slide_interna'] == 's' ? 'Sim' : 'Não'; ?></td>
							<td><?php echo $one['texto']; ?></td>
							 
							<td class="op" nowrap> <a href="/vipmin/order/edit.php?id=<?php echo $one['id']; ?>"><img alt="Editar Plano" title="Editar Plano" src="/media/css/i/editar.png" style="width: 22px;"></a> 
							 
							 
							</td>
							 
						</tr>
						<?php }}?>
						<?if(!$bregistro){?><tr><td colspan="13" style="text-align: center;">Nenhum registro encontrado.  </tr><? } ?>
						<!-- <tr><td colspan="10"><?php echo $pagestring; ?></tr> -->
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
function msg_reenvia(id){ 
 
	 jQuery.colorbox({html:"<div class='msgsoft'><img src='<?=$PATHSKIN?>/images/ajax-loader2.gif'> Aguarde, o cupom está sendo enviado...</div>"});
	 $.get(WEB_ROOT+"/ajax/manage.php?origem=pedido&action=reenviacupom&id="+id,
	function(data){ 
		jQuery.colorbox({html:data});
	});	 
}

function msg_pago(){
	jQuery(document).ready(function(){   
			jQuery.colorbox({html:"<div class='msgsoft'><img src='<?=$PATHSKIN?>/images/ajax-loader2.gif'> Aguarde, o status deste pedido está sendo alterado para pago e cupom está sendo enviado ao cliente...</div>"});
		});
}
function detalhepedido(id){
	jQuery.colorbox({html:"<div class='msgsoft'><img src='<?=$PATHSKIN?>/images/ajax-loader2.gif'> Buscando pedido: "+id+"</div>"});
	$.get(WEB_ROOT+"/include/compiled/manage_ajax_dialog_orderview.php?id="+id,
	function(data){ 
		jQuery.colorbox({html:data});
	}); 
}
	 		
</script>


 <script> 
 function resetFilter(){
	location.href  = '<?php echo $_SERVER["PHP_SELF"] ?>';
 } 

  function msg(){
	jQuery.colorbox({html:"<div class='msgsoft'><img src='<?=$PATHSKIN?>/images/ajax-loader2.gif'> Deletando este pedido...</div>"});
}  
 function msg_edit(){
	jQuery.colorbox({html:"<div class='msgsoft'><img src='<?=$PATHSKIN?>/images/ajax-loader2.gif'> Buscando dados. Aguarde...</div>"});

} 
function gerarPDF(){
	var url = <?php echo "'" . $INI['system']['wwwprefix'] . "';"; ?>
	
	if($('#id').val() != ''){
		var id = $('#id').val();
	}else{
		var id = 'undefined';
	}

	if($('#datapedido').val() != ''){
		var datapedido = $('#datapedido').val();
	}else{
		var datapedido = 'undefined';
	}

	if($('#uemail').val() != ''){
		var uemail = $('#uemail').val();
	}else{
		var uemail = 'undefined';
	}

	if($('#team_id option:selected').val() != ''){
		var team_id = $('#team_id option:selected').val();
	}else{
		var team_id = 'undefined';
	}

	if($('#quantity').val() != ''){
		var quantity = $('#quantity').val();
	}else{
		var quantity = 'undefined';
	}

	if($('#origin').val() != ''){
		var origin = $('#origin').val();
	}else{
		var origin = 'undefined';
	}

	if($('#state option:selected').val() != ''){
		var state = $('#state option:selected').val();
	}else{
		var state = 'undefined';
	}

	if($('#credit').val() != ''){
		var credit = $('#credit').val();
	}else{
		var credit = 'undefined';
	}

	var params = 'id='+id+'&datapedido='+datapedido+'&uemail='+uemail+'&team_id='+team_id+'&quantity='+quantity+'&origin='+origin+'&state='+state+'&credit='+credit;
	window.open(url + '/vipmin/order/pdf.php?'+params, '_blank');
}

function gerarExcel(){
	var url = <?php echo "'" . $INI['system']['wwwprefix'] . "';"; ?>
	
	if($('#id').val() != ''){
		var id = $('#id').val();
	}else{
		var id = 'undefined';
	}

	if($('#datapedido').val() != ''){
		var datapedido = $('#datapedido').val();
	}else{
		var datapedido = 'undefined';
	}

	if($('#uemail').val() != ''){
		var uemail = $('#uemail').val();
	}else{
		var uemail = 'undefined';
	}

	if($('#team_id option:selected').val() != ''){
		var team_id = $('#team_id option:selected').val();
	}else{
		var team_id = 'undefined';
	}

	if($('#quantity').val() != ''){
		var quantity = $('#quantity').val();
	}else{
		var quantity = 'undefined';
	}

	if($('#origin').val() != ''){
		var origin = $('#origin').val();
	}else{
		var origin = 'undefined';
	}

	if($('#state option:selected').val() != ''){
		var state = $('#state option:selected').val();
	}else{
		var state = 'undefined';
	}

	if($('#credit').val() != ''){
		var credit = $('#credit').val();
	}else{
		var credit = 'undefined';
	}

	var params = 'id='+id+'&datapedido='+datapedido+'&uemail='+uemail+'&team_id='+team_id+'&quantity='+quantity+'&origin='+origin+'&state='+state+'&credit='+credit;
	window.open(url + '/vipmin/order/excel.php?'+params, '_blank');
}

 </script>