<?php 
	header("Content-Type: text/html; charset=ISO-8859-1");
?>
<div class="container">
	<div class="col-4b"> 
	  <h2>  <span id="rec" style="margin-left:300px;"> <?php echo "Hummm !!! Aconteceu alguma coisa errada. Esta página não existe." ?></span> </h2>
		
		<div class="pgavulsafundonoofers">
		  
		<?php if($city["name"] != ""){ ?>
			<span class="txt9"> Cadastre seu e-mail e receba gratuitamente descontos diários de até 90% ! </span>
		  <?php }  
			else{ ?>
			   <span class="txt9"> Cadastre seu e-mail e receba gratuitamente descontos diários de até 90%!  </span>
			<? } ?>
			
		   <?php if( $_SESSION["error"]  != "" ){  ?> 
				<div class="error"><p class="txt9b">  <?php  echo $_SESSION["error"] ?></p></div>
				<br class="clear" />
			<?php 	
				unset($_SESSION["error"]); 
			}?>
			 <br class="clear" />
			 <br class="clear" /> 
			 
			 <div style="float: right; width: 709px; height: 111px;">
			 
			 <p class="name">
				<input type="text"  style="margin-left: 0px;" name="emailnewshome" id="emailnewshome" onfocus="if(this.value =='Insira seu e-mail' ) this.value=''" onblur="if(this.value=='') this.value='Insira seu e-mail'" value="Insira seu e-mail"   />
			</p>
			 <select name="websites3" style="width: 564px; margin-left: 0px;" id="websites3"  >
				<option value="">Escolha sua Cidade</option>
				<?php echo utf8_decode( Utility::Option(Utility::OptionArray($hotcities, 'id', 'name'), $city['id'])); ?>
			</select>
			
			
		   <input type="hidden" name="acao" value="<?php echo $_REQUEST['acao']?>">
		   
		   </div>
		   
		   <br class="clear" /> 
			
			<img  style="position: absolute; margin-left: 0pt; margin-top: -100px;" src="<?=$PATHSKIN?>/images/bandeiras_de_cartao.png" >  
			 <a style="margin-left: 202px;" href="javascript:envianewsletter($('#emailnewshome').val());"> <img style="margin-left: 23px;"  src="<?=$PATHSKIN?>/images/bg_btn_landing.png" width="375" height="50"></a>
			
				<div class="addthis_toolbox addthis_default_style" style="position:absolute;right:26px;padding:5px 0px 3px 5px;width:186px;margin:25px 0 0;">
			<a class="addthis_button_preferred_1" addthis:url="<?php echo $INI['system']['wwwprefix']; ?>/index.php?id=<?php echo $team["id"]; ?>"></a>
			<a class="addthis_button_preferred_2" addthis:url="<?php echo $INI['system']['wwwprefix']; ?>/index.php?id=<?php echo $team["id"]; ?>"></a>
			<a class="addthis_button_preferred_3" addthis:url="<?php echo $INI['system']['wwwprefix']; ?>/index.php?id=<?php echo $team["id"]; ?>" ></a>
			<a class="addthis_button_preferred_4" addthis:url="<?php echo $INI['system']['wwwprefix']; ?>/index.php?id=<?php echo $team["id"]; ?>" ></a>
			<a class="addthis_button_compact" addthis:url="<?php echo $INI['system']['wwwprefix']; ?>/index.php?id=<?php echo $team["id"]; ?>"></a>
			</div>
			
			<br class="clear" /> 
			<?php if($INI['pagseguro']['acc'] != ""){ ?><img style="margin-top: 10px;margin-left: 5px " src="<?=$PATHSKIN?>/images/pagseguro.png" ><? } ?>
			<?php if($INI['pagamentodg']['acc'] != ""){ ?><img style="margin-top: 10px;margin-left: 5px " src="<?=$PATHSKIN?>/images/pagamentodigital.png" ><? } ?>
			<?php if($INI['moip']['mid'] != ""){ ?><img style="margin-top: 10px;margin-left: 5px " src="<?=$PATHSKIN?>/images/moip.png" ><? } ?>
			<?php if($INI['mercadopago']['acc'] != ""){ ?><img style="margin-top: 10px;margin-left:480px; " src="<?=$PATHSKIN?>/images/mercadopago.png" style="float:left;" ><? } ?>
			
		
			 
							
	   </div>
	</div>
</div>
  
  <script type="text/javascript" src="<?=$ROOTPATH?>/js/include_select_css.js"></script>