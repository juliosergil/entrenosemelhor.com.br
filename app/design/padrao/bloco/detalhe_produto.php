<?php  
 if($team){ 
		
	$user = Table::Fetch('user', $team['user_id']);
	$cidade = Table::Fetch('cidades', $team['city_id']);
	$estado = Table::Fetch('estados', $team['uf'],'uf');
	
	$linkC = gera_link_cat_pai($team['uf'],$team['group_id']); 
			
?>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.9&appId=1139171752771007";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<style>
li {
	margin-left: 15px;
}
</style>

<link rel="stylesheet" id="flexslider-css" href="<?php echo $PATHSKIN; ?>/css/flexslider.css" type="text/css" media="all">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

<script defer src="<?=$ROOTPATH?>/js/flexslider/jquery.flexslider.js"></script>
<script defer src="<?=$ROOTPATH?>/js/flexslider/init.js"></script>

<!-- Syntax Highlighter -->
<script type="text/javascript" src="<?=$ROOTPATH?>/js/flexslider/demo/js/shCore.js"></script>
<script type="text/javascript" src="<?=$ROOTPATH?>/js/flexslider/demo/js/shBrushXml.js"></script>
<script type="text/javascript" src="<?=$ROOTPATH?>/js/flexslider/demo/js/shBrushJScript.js"></script>

<!-- Optional FlexSlider Additions -->
<script src="<?=$ROOTPATH?>/js/flexslider/demo/js/jquery.easing.js"></script>
<script src="<?=$ROOTPATH?>/js/flexslider/demo/js/jquery.mousewheel.js"></script>
<script defer src="<?=$ROOTPATH?>/js/flexslider/demo/js/demo.js"></script>
 
<div class="detalhe_principal_op">
<div style="display:none;" class="tips"><?=__FILE__?></div> 
	<div class="description-offer">
		<div class="title-offer">
		 
		</div> 
		<div class="row">
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-12">
						<h1 class="title-offer">
								<?php
									echo utf8_decode($team['title']);
								?>
						</h1>
					</div>
				</div>	 
			</div>
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-12">
						<div class="price-header">
								<div>							 
									<div class="price-box">							   
										<?php if($team['mostrarpreco'] == 1){?>
											<span class="price">    
												R$ <?php echo number_format($team['team_price'], 2, ",", "."); ?>
											</span>
										<? } ?>	
										<? if($team['mostrarpreco'] == 0){?>
											<span class="price">    
												A combinar
											</span>
										<? } ?>
										
									</div>
									<div class="losangulo"></div>								
								</div>	
							</div>	
						</div>
				</div>	 
		    </div>	
       </div>
		

		<div class="row">
			<div class="col-md-8">
		      <div class="row mobileBR">
				  <div class="col-md-12">
						<div id="slider" class="flexslider fundocinzaa" style="margin:0 0 14px;">
							<ul class="slides"> 
									<? if($team['image']){?><li><img  title="<?=$team['title']?>" alt="<?=$team['title'] ?>" src="<?=getImg($team['image'])?>" /></li><?}?>
									<? if($team['image1']){?><li><img  title="<?=$team['title']?>" alt="<?=$team['title'] ?>" src="<?=getImg($team['image1'])?>" /></li><?}?>
									<? if($team['image2']){?><li><img  title="<?=$team['title']?>" alt="<?=$team['title'] ?>" src="<?=getImg($team['image2'])?>" /></li><?}?>
									<? if($team['gal_image1']){?><li><img  title="<?=$team['title']?>" alt="<?=$team['title'] ?>" src="<?=getImg($team['gal_image1'])?>" /></li><?}?>
									<? if($team['gal_image2']){?><li><img  title="<?=$team['title']?>" alt="<?=$team['title']?>" src="<?=getImg($team['gal_image2'])?>" /></li><?}?>
									<? if($team['gal_image3']){?><li><img  title="<?=$team['title']?>" alt="<?=$team['title'] ?>" src="<?=getImg($team['gal_image3'])?>" /></li><?}?>
									<? if($team['gal_image4']){?><li><img  title="<?=$team['title']?>" alt="<?=$team['title'] ?>" src="<?=getImg($team['gal_image4'])?>" /></li><?}?>
									<? if($team['gal_image5']){?><li><img  title="<?=$team['title']?>" alt="<?=$team['title'] ?>" src="<?=getImg($team['gal_image5'])?>" /></li><?}?>
									<? if($team['gal_image6']){?><li><img  title="<?=$team['title']?>" alt="<?=$team['title'] ?>" src="<?=getImg($team['gal_image6'])?>" /></li><?}?>
									<? if(!$team['image']){?><li><img  title="<?=$team['title']?>" alt="<?=$team['title'] ?>" src="<?=semImg()?>" /></li><?}?>
							</ul>
						</div>
						<div id="carousel" class="flexslider fundocinzaa">
							<ul class="slides">
								<? if($team['image']){?><li><img  title="<?=$team['title']?>" alt="<?=$team['title'] ?>" src="<?=$INI['system']['wwwprefix']."/media/".substr($team['image'],0,-4)."_mini.jpg" ?>" /></li><?}?>
								<? if($team['image1']){?><li><img  title="<?=$team['title']?>" alt="<?=$team['title'] ?>" src="<?=$INI['system']['wwwprefix']."/media/".substr($team['image1'],0,-4)."_mini.jpg" ?>" /></li><?}?>
								<? if($team['image2']){?><li><img  title="<?=$team['title']?>" alt="<?=$team['title'] ?>" src="<?=$INI['system']['wwwprefix']."/media/".substr($team['image2'],0,-4)."_mini.jpg" ?>" /></li><?}?>
								<? if($team['gal_image1']){?><li><img  title="<?=$team['title']?>" alt="<?=$team['title'] ?>" src="<?=$INI['system']['wwwprefix']."/media/".substr($team['gal_image1'],0,-4)."_mini.jpg" ?>" /></li><?}?>
								<? if($team['gal_image2']){?><li><img  title="<?=$team['title']?>" alt="<?=$team['title']?>" src="<?=$INI['system']['wwwprefix']."/media/".substr($team['gal_image2'],0,-4)."_mini.jpg" ?>" /></li><?}?>
								<? if($team['gal_image3']){?><li><img  title="<?=$team['title']?>" alt="<?=$team['title'] ?>" src="<?=$INI['system']['wwwprefix']."/media/".substr($team['gal_image3'],0,-4)."_mini.jpg" ?>" /></li><?}?>
								<? if($team['gal_image4']){?><li><img  title="<?=$team['title']?>" alt="<?=$team['title'] ?>" src="<?=$INI['system']['wwwprefix']."/media/".substr($team['gal_image4'],0,-4)."_mini.jpg" ?>" /></li><?}?>
								<? if($team['gal_image5']){?><li><img  title="<?=$team['title']?>" alt="<?=$team['title'] ?>" src="<?=$INI['system']['wwwprefix']."/media/".substr($team['gal_image5'],0,-4)."_mini.jpg" ?>" /></li><?}?>
								<? if($team['gal_image6']){?><li><img  title="<?=$team['title']?>" alt="<?=$team['title'] ?>" src="<?=$INI['system']['wwwprefix']."/media/".substr($team['gal_image6'],0,-4)."_mini.jpg" ?>" /></li><?}?>
							</ul>
						</div>
				  </div>
			  </div>
			  <!-- 
			  <div class="row">
				  <div class="col-md-12">
                     <h3 class="preco-normal">Pre&ccedil;o: 
                     <b>
					 <?php if($team['mostrarpreco'] == 1){?>
										<span >    
											R$ <?php echo number_format($team['team_price'], 2, ",", "."); ?>
										</span>
									<? } ?>	
									<? if($team['mostrarpreco'] == 0){?>
										<span >    
											A combinar
										</span>
									<? } ?>
									
					</b></h3>
				  </div>
			 </div>
			 -->
			<div class="row">
				  <div class="col-md-12">
				  <div class="text-anuncio desc-none" color="dark" weight="regular" font-weight="400" >			
						<?php
							echo  utf8_decode($team['summary']) ;
						?> 
					</div>	 		
				  </div>
			  </div>

			  <div class="row">
				  <div class="col-md-12 ">
					  <hr />
				     <h3 class="detalhesTitulo">Detalhes</h3>	
					 <div class="row">
					    <div class="col-md-4">
							 <p class="detalhesSubtitulo"><b>Categoria:</b></p>
							 <a class="detalhesLink" href="<?=$linkC?>"><?=getcatpai($team['group_id'])?></b></a>
						</div>
						<div class="col-md-4">
							 <p class="detalhesSubtitulo"><b>C&oacute;digo do anunc&iacute;o:</b></p>
							 <p class="detalhesLink"> <?php echo $team['id']; ?>	 </p>
						</div>
						<div class="col-md-4">
							 <p class="detalhesSubtitulo"><b>Publicado em :</b></p>
							 <p class="detalhesLink"> <?=data($team['create_time'])?>	 </p>
						</div>
						<div class="col-md-4">
						</div>	
					 </div>
				  </div>
			  </div>
			  
			  <div class="row">
				  <div class="col-md-12 ">
					  <hr />
				     <h3 class="detalhesTitulo">Localiza&ccedil;&atilde;o</h3>
					 <div class="row">
					    <div class="col-md-4">
							 <p class="detalhesSubtitulo"><b>Cidade</b></p>
							 <p class="textLocalizacao"><?php echo empty($cidade['nome']) ? "-" : utf8_decode($cidade['nome']); ?></p>
						</div>
						<div class="col-md-4">
							 <p class="detalhesSubtitulo"><b>Estado:</b></p>
							  <p class="textLocalizacao"><?php echo empty($estado['nome']) ? "-" : utf8_decode($estado['nome']); ?></p>
						</div>
					 </div>
				  </div>
			  </div>
			   				
			</div>
			<div class="col-md-4">
				
				<div class="row">
				   <div class="col-md-12 bkanunciante">
				       <div class="anunciante">
						   <div class="dadosAnunciante">
							  <span class="fontAnunciante"><?php echo utf8_decode($user['realname']); ?></span>
							</div>  
							<div class="dadosAnunciante">
								<div>
								
								<div id="mercurie-app" class="sc-EHOje sc-fihHvN eekSaf">
									<div class="ChatComponent__Content-r21tw6-3 egxBnZ sc-EHOje hDmdra">
											<?  if(file_exists(WWW_MOD."/whatsapp.inc")) {?>
												<button class="ChatComponent__StyledButton-r21tw6-2 eeOGIP sc-ifAKCX eiddDe" type="text">
													 Conversar no <a class="btn btn-xl" target="_blank" href="<?=trim(geraurlzap($user['ddd']."".$user['mobile'], utf8_decode($user['realname'])));?>"><img style="height: 30px; " src="<?=$PATHSKIN.'/images/whatsapp.png'?>"/> </a> 
												</button>
										<? } else {?>
											<button class="ChatComponent__StyledButton-r21tw6-2 eeOGIP sc-ifAKCX eiddDe" type="text" style="cursor: revert;"> ( <?php echo $user['ddd']?> ) <?php echo $user['mobile'] ;  ?> </button> 
										<? } ?>
									</div>
								</div>
 
									<!-- 
									 <div class="numeroNone fontTelefone">
										<i class="fa fa-phone iconeTelefone" aria-hidden="true"></i>
										 <?php echo substr($user['mobile'],0,4);  ?>
										 ... <a href="#" id="mostrarNumero"  > mostrar n&uacute;mero</a>
									</div>
									<div class="numeroAll fontTelefone" style="display:none" >
										<i class="fa fa-phone iconeTelefone" aria-hidden="true"></i>
										 <?php
											echo $user['mobile'] ; 
										 ?>
										 
									</div>
									--> 
					 
									<div class="sc-EHOje sc-ghsgMZ gIYRxk">
										<div class="sc-EHOje sc-hIVACf beoesd">
											<span tag="span" color="dark" weight="" font-weight="400" class="sc-bZQynM sc-gipzik jQjJuQ"><?=utf8_decode("Anúncio criado em: ")?><?=date("d / m / Y",strtotime($team['create_time']))?></span>
										</div>
										<div class="sc-EHOje sc-hIVACf beoesd">
											<span tag="span" color="dark" weight="" font-weight="400" class="sc-bZQynM sc-gipzik jQjJuQ"> 
												<?php
												echo  $team['clicados']." visualiza&ccedil;&otilde;es  "; 
												?> 
											</span>
										</div>
									</div>
								<!--								
								<div class="sc-EHOje sc-gGCbJM eVvnjS" style="width: 100%;background: #0d0c0c;height: 34px;color: #fff;padding-top: 6px;"> Compartilhe em suas redes sociais</div>
								-->								
									<div class="sc-EHOje sc-bqjOQT gdipbs">
										<!--
										<div class="sc-EHOje sc-bEjcJn qSqqy">  
										 <div class="addthis_inline_share_toolbox"></div>
										</div>
										-->
										<div class="sc-EHOje sc-jkCMRl kkOxHL">
											<span tag="span" color="dark" weight="" font-weight="400" class="sc-bZQynM sc-gipzik sc-drMfKT jqCDqG"><b><?=utf8_decode($cidade['nome']) . " / " .utf8_decode($estado['nome']); ?></b></span>
										</div>
										<div class="sc-EHOje sc-ekulBa dCBONa">
											<div class="sc-EHOje sc-gVyKpa jzgtxO"><svg width="16" height="16" viewBox="0 0 16 16" class="sc-eXNvrr bWuCHi"> </svg><a href="<?=gera_link_anuncios_user($team['user_id'])?>" class="sc-jKJlTe sc-cpmKsF dcCmvN"><?=utf8_decode("Ver mais anúncios deste vendedor")?></a></div>
										</div>
									</div>
									
								</div>	
							</div>  
						</div>	 						
					</div>				
				</div> 	
				<div class="row">
					 <div class="col-md-12">
						
					 <div class="anunciante">
					 	<div class="title-notice">					
							Fazer Proposta
						</div>
					 	<div class="form-contact">
							<?php 
								//if($team['user_id'] != $login_user['id']) {
									require_once(DIR_BLOCO."/bloco_envioproposta.php"); 
								//}
							?>
						</div>
						</div>
					</div>
				</div> 
				<div class="row">
					<div class="col-md-12"  >
						<div class="anunciante">
							<div class="row">
								<div class="col-md-12 center" >
									<span >
										<img src="<?=$PATHSKIN?>/icones/dicasSeguranca.png"  alt="">
									</span>
								 </div>	
								 <div class="col-md-12">
									<div class="title-notice">					
										Dicas de Seguran&ccedil;a
									</div>
									<ul>
										<li>
											Evite pagar adiantado
										</li>
										<li>
											<?=utf8_decode("Desconfie de an&uacute;ncios n&atilde;o realistas")?>
										</li>
										<li>
											<?=utf8_decode("Fique atento com facilidades e preços bem abaixo do mercado")?>
										</li>
										<li>
											<?=utf8_decode("Sugira locais públicos para suas transações")?>
										</li>
									</ul>
							     </div>	
							</div>	
							
						</div>
					</div>	

				</div>	
				<div class="row">
					<div class="col-md-12">
						<div class="list-banner">
							<?php
								echo $INI['bulletin']['topotodos'];
							?> 
						</div>						
					</div>
				</div>	 
			</div> 
        </div>	
	 
	</div>
</div> 
	
<script> 
	$("img").addClass("img-thumbnail");   
	atualiza_click('<?=$team['id']?>');
	J(".fundo_titulo_oferta").corner("round 3px");
	J(".titulo").corner("round 3px");
</script>

<?php  
	} else{ 
?>
	<div class="home">
		<?// require_once(DIR_BLOCO."/cadasdivo_email.php");   ?>
	</div>
<?php
 } 
?>