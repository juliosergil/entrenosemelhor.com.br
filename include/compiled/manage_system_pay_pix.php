
		<div id="container_box">
			<div id="option_contents" class="option_contents"> 
				<div class="form-contain group"> 
					<div class="starts">  									
						<h1><span class="cpanel-date-hint"> </h1>
						<div class="group">
							 Agora você precisa acessar o menu Planos, edite o plano de sua preferencia e informe o link de pagamento e salve. As instruções para criar o link de pagamento estão na página de edição do plano<br>
							 <a  href="/vipmin/order/index.php">Acesse o menu Planos</a> para informar o link de pagamento em cada plano que desejar 
						 </div>	 
					</div> 
				  
				</div> 
			</div>
		</div>
		

     <!-- ********************************************* ABA PIX -->
	 <? 
	 
	 $dirmod = dirname(dirname(getcwd()))."/include/mod/pix.inc";
	  
	 if(file_exists( $dirmod)){	?>
	 <?
	 if( $INI['credito']['mensagem_pix']==""){
		 $INI['credito']['mensagem_pix']="Aponte o leitor de QRcode do seu celular e pague pelo PIX. Depois de realizar o pagamento, envie o comprovante para o email xx@xxx.com.br";
	 }
	 ?>
		<div id="container_box">
			<div id="option_contents" class="option_contents"> 
			
			<div class="form-contain group"> 
				
				 <div class="starts">  									
						<? include "linkdepagamento_pagseguro.txt"; ?>						 
				 </div> 
				  
				</div> 
			
			
			
			
			<br>
				<div class="form-contain group"> 
					<div class="starts">  									
						<div class="report-head">Chave Pix: <span class="cpanel-date-hint"> CPF, CNPJ, CELULAR, EMAIL ou chave aleatória. </div>
						<div class="group">
							<input type="text"  name="credito[chave_pix]" value="<?php echo  $INI['credito']['chave_pix'] ; ?>">  
						 </div>	
						<!--  
						<div class="report-head">Nome do beneficiário: <span class="cpanel-date-hint"> (Obrigatório para aparecer o QRCODE)</div>
						<div class="group">
							<input type="text"  name="credito[beneficiario_pix]" value="<?php echo  $INI['credito']['beneficiario_pix'] ; ?>"> 
						</div>
						
							 <div class="report-head">Cidade do beneficiário:  <span class="cpanel-date-hint"> Apenas a cidade (sem Estado)</div>
						<div class="group">
							<input type="text"  name="credito[cidade_pix]" value="<?php echo  $INI['credito']['cidade_pix'] ; ?>"> 
						</div>		
						-->

						<div class="report-head">Texto para tela de planos (opcional): <span class="cpanel-date-hint">  </div>
						<div class="group">
							<input type="text"  name="credito[mensagem_pix]" value="<?php echo  $INI['credito']['mensagem_pix'] ; ?>"> 
						</div>
						 
						 <b> Se sua chave for celular, informe +55 junto com o DDD mais o número, exemplo +551198765431 tudo junto, sem espaços, parenteses ou traços</b>
					</div> 
				  
				</div> 
			</div>
		</div>
		
	 <? }else {?>
	 
	 <!-- 
		<div id="container_box">
			<div id="option_contents" class="option_contents"> 
				<div class="form-contain group"> 
					<div class="starts">  									
						<h1><a target="_blank"  href="https://www.tkstore.com.br/whmcs/cart.php?a=add&pid=665">Clique aqui</a> e adquira a forma de pagamento por QRCode do Pix: <span class="cpanel-date-hint"> </h1>
						<div class="group">
							 Aumente as chances de transações aprovadas em seu site com o QRcode do Pix
						 </div>	 
					</div> 
				  
				</div> 
			</div>
		</div>
		-->
		
	 <? } ?>
	 
					 