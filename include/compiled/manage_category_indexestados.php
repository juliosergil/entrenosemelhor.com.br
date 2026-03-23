<?php include template("manage_header");?>
<div id="bdw" class="bdw">
<div id="bd" class="cf">
<div id="coupons"> 
    <div id="content" class="coupons-box clear mainwide">
		<div class="box clear"> 
            <div class="box-content">
			<div class="option_box">
				 <div class="top-heading group"> <div class="left_float"><h4>Estados</h4> 
				  <li  style='background: red; color:#fff; font-size: 9px;text-align: center;width: 90px; padding: 10px;' id="log_switch_referral">  <a  style="color:#fff;font-weight: 900;" href="/ajax/manage.php?&action=delall&tabela=estados" class="ajaxlink" ask="Tem certeza que deseja apagar todos os registros ?"> APAGAR TUDO</a></li>  
				  </div> 
					<div style="padding: 10px;">
						<ul id="log_tools"> <li id="log_switch_referral"><a  title="Cadastrar Estado" href="/vipmin/category/editestado.php">Adicionar Estado</a></li> </ul> 
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
						 <th>Estado </th> 
						 <th>Nome </th> 
						<th width="220">  
							<button type="submit" style="width: 80px;"><span>Buscar</span></button>
							<button type="button" onclick="resetFilter()" style="width: 80px"><span>Limpar</span></button>
						</th>
						 </tr>
						<?php if(is_array($categories)){
								foreach($categories AS $index=>$one) { 
						 
									
						?>
						<tr <?php echo $index%2?'':'class="alt"'; ?>>
							<td>	<?php echo $one['id']; ?>	</td> 
							<td>	<?php echo $one['uf']; ?>	</td>
							<td>	<?php echo $one['nome']; ?>	</td>   
							<td class="op">
							 <div style="float: left; margin-right: 2px;">
							 
							  <a href="/ajax/manage.php?&action=deleteestado&id=<?php echo $one['id']; ?>" class="ajaxlink" ask="Tem certeza que deseja apagar este registro?"><img alt="Excluir" title="Excluir" src="/media/css/i/excluir.png" style="width: 22px;">
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
 