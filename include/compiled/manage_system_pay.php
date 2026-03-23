<?php include template("manage_header");?>

<div id="bdw" class="bdw">
<div id="bd" class="cf">
<div id="partner"> 
	<div id="content" class="clear mainwide">
        <div class="clear box">
            <div class="box-top"></div>
            <div class="box-content"> 
                <div class="sect">
                    <form method="post">
					<!-- ********************************************* ABA PAGSEGURO --> 
					<div class="option_box"> 
						<div class="top-heading group"> <div class="left_float"><h4>Métodos de Pagamento</h4> </div>
						
						
								<div class="the-button"> 
									<button onclick="doupdate();" id="run-button" class="input-btn" type="button">
										<div name="spinner-top" id="spinner-top" style="width: 83px; display: block;"><img name="imgrec" id="imgrec" src="<?=$ROOTPATH?>/media/css/i/lendo.gif" style="display: none;"></div>
										<div id="spinner-text"  >Salvar</div>
									</button>
								</div> 
								

						</div> 
					   
					<!-- ********************************************* ABA PAYPAL -->
				
					 <? include"manage_system_pay_pix.php"; ?>
			  
					</div>  
			     
                 </form>
                </div>
            </div>
            <div class="box-bottom"></div>
        </div>
	</div>

<div id="sidebar">
</div>

</div>
</div> <!-- bd end -->
</div> <!-- bdw end -->
 <script>
	function validador(){
		return true;
	}	
	 
 
</script>