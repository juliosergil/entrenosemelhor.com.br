<?php include template("manage_header");?>
<div id="bdw" class="bdw">
<div id="bd" class="cf">
<div id="coupons">   
    <div id="content" class="coupons-box clear mainwide">
		<div class="box clear"> 
            <div class="box-content">
			<div class="option_box">
				 <div class="top-heading group"> <div class="left_float"><h4>Cidades</h4> 
				  </div> 
					<div style="padding: 10px;">
						<ul id="log_tools"> <li id="log_switch_referral"><a  title="Cadastrar Cidade" href="/vipmin/category/editcidades.php">Adicionar Cidade</a></li> </ul> 
					 </div>
				</div>  
					 <div class="sect" style="clear:both;">
						<pre>
						</pre>
						<div class="atencao">
							Arraste a tabela pra esquerda para ver as outras colunas
						</div>
						<table id="orders-list" cellspacing="0" cellpadding="0" border="0" class="coupons-table">
						<form method="get">
						 <tr>
						 <th width="70">ID</th> 
						 <th width="200">Estado
							 <select style="width:95%;height:23px;font-weight:normal;font-size:11px;" class="f-input" name="uf_id" id="uf_id">
								<option value=""></option>
								<?php while($row = mysqli_fetch_assoc($estados)) { ?>
								<option value="<?php echo $row["uf"]; ?>"><?php echo $row["nome"]; ?></option>
								<?php } ?>  
							 </select>
						 </th>
						 <th>Cidade <br /><input type="text"  name="city_id"  id="city_id" style="color:#303030;font-size:11px;height:20px;font-size:12px;width:200px;"></th> 
						<th width="220">  
							<button type="submit" style="width: 80px;"><span>Buscar</span></button>
							<button type="button" onclick="resetFilter()" style="width: 80px"><span>Limpar</span></button>
						</th>
						 </tr>
						<?php if(is_array($categories)){
								foreach($categories AS $index=>$one) { 
									if($one['destaque'] == 0 || empty($one['id'])) {
										$destaque = utf8_encode("Não");
										$color = "red";
									}
									if($one['destaque'] == 1) {
										$destaque = "Sim";
										$color = "green";
									}
									
						?>
						<tr <?php echo $index%2?'':'class="alt"'; ?>>
							<td>	<?php echo $one['id']; ?>	</td> 
							<td>	<?php echo $one['uf']; ?>	</td>
							<td>	<?php echo $one['nome']; ?>	</td>   
							<td class="op">
							 <div style="float: left; margin-right: 2px;">
							 <a href="/vipmin/category/editcidades.php?&id=<?php echo $one['id']; ?>"><img alt="Editar" title="Editar" src="/media/css/i/editar.png" style="width: 22px;">
							 </a>
							  <a href="/ajax/manage.php?&action=deletecidade&id=<?php echo $one['id']; ?>" class="ajaxlink" ask="Tem certeza que deseja apagar este registro"><img alt="Excluir" title="Excluir" src="/media/css/i/excluir.png" style="width: 22px;">
							 </div>
						    </td>
							<?}  ?>
						</tr>
						<?php }?>
						<tr><td colspan="8"><?php echo $pagestring; ?></td></tr>
						</form>
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
  function msg_edit(){
	jQuery.colorbox({html:"<div class='msgsoft'><img src='<?=$PATHSKIN?>/images/ajax-loader2.gif'> Aguarde enquanto carregamos os dados...</div>"});
}
 </script>
 
  <script>
  function msg(){
		return true;
 }
 </script>


  <script> 
 function resetFilter(){
	location.href  = '<?php echo $_SERVER["PHP_SELF"] ?>';
 }
 </script>