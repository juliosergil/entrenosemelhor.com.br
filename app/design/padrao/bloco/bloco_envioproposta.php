<?
$user = Table::Fetch('user', $login_user_id);

?>		
<style>
.form input, .form textarea { 
     width: 100% !important;  
}

</style>	
<div style="display:none;" class="tips"><?=__FILE__?></div>
<div class="form">
<form name="form2" method="post" action="#">
	<input type="hidden" value="<?=$team['id']?>" name="idoferta_proposta" id="idoferta_proposta">
	<div class="form-group">
		<div class="clearFix"> 
			<input class="form-control" placeholder="Informe o seu nome" type="text" maxlength="40" class="email" placeholder="Nome" id="nome_proposta" name="nome_proposta" value="<?=$user['realname']?>">
		</div>
	</div>
	<div class="form-group">
		<div class="clearFix"> 
			<input class="form-control" placeholder="Informe o seu email" type="text" maxlength="80" class="email"  placeholder="E-mail"  id="email_proposta" name="email_proposta" value="<?=$user['email']?>">
		</div>
	</div> 
	<div class="form-group">
		<div class="clearFix">
			<input class="form-control"placeholder="Informe o seu telefone" type="text"  maxlength="13" class="telefone" id="telefone_proposta" name="telefone_proposta" value="<?=$user['mobile']?>">
		</div>
	</div>
	<div class="form-group">
		<div class="clearFix"> 
			<textarea class="form-control" placeholder="Informe sua d&uacute;vida" class="mensagem_proposta" id="proposta"  placeholder="Mensagem"  name="proposta"></textarea>
		</div>
	</div>
	<div class="">
		<div class="clearFix">
			<div style="clear:both; width:100%;">
				<a class="bth btAnunciar" style="" href="javascript:enviaproposta();">
					
						<b>
							Enviar
						</b>
				
				</a>
			</div>
		</div>
	</div>
</form>
</div>
<script>
J(".det_form").corner("round 3px"); 
</script>
