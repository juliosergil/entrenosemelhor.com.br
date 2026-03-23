<div style="display:none;" class="tips"><?=__FILE__?></div>
<style>
#top-bar {
    background: #3f5d7a none repeat scroll 0 0;
    color: #ffffff;
    border-bottom: 1px solid #f5f3f3;
    line-height: 24px;
    padding: 0px 0;
    border-bottom: 1px solid rgba #faf9f7;
    box-shadow: 0 0 7px rgba(0, 0, 0, 0.3), 0 7px 2px rgba(0, 0, 0, 0.04);
}

.top-bar-phone, .top-bar-home {
    display: block;
    float: left;
    font-size: .85em;
    margin-right: 3px;
    margin-top: 0px;
    padding: 0px 0px;
    color: #d0c8c0;
    font-family: 'Oswald', sans-serif;
    font-weight: 300;
    text-shadow: 1px 1px 0 rgba(0, 0, 0, 0.15);
    position: relative;
    top: 2px;
}
.pull-right {
    float: right!important;
}
#top-bar a{
	font-weight: 300 !important;
	font-family: 'Galano Grotesque', sans-serif !important;
}
.maicon_redes{
	color: #fff !important;
}
</style>
<!-- ----------- Topbar Location and phone -->
<div id="top-bar">
	<div class="container">
		<div class="row">	
			<div class="col-xs-12 col-sm-6 mocenter">	
				
				 <? if(file_exists(WWW_MOD."/mobyads.inc") and $login_user_id){?><i class="fa fa-plus-square faicontopbar" aria-hidden="true"></i> <a href="<?=$ROOTPATH?>/adminanunciante/" title="Anuncie !" style="color:#fff;font-size:13px;" > Anunciar </a><? } ?> 
				<!-- 
				<?php 
					if($INI['mail']['helpphone'] != ""){
				?>
				ou ligue <?php echo $INI['mail']['helpphone']; ?> </span> 
			    <?php
					}
				?> 
				-->
			    <i class="fa fa-search faicontopbar" aria-hidden="true"></i> <a class="idpesquisaavancada" href="<?=$ROOTPATH?>/?Estado=&cppesquisa=&state=&city=&page=search"  style="color:#fff;font-size:13px;margin-right:15px;"> Pesquisar</a> 
			   <!--  <i class="fa fa-university faicontopbar" aria-hidden="true"></i> <a class="" href="<?=$ROOTPATH?>/imobiliarias"  style="color:#fff;font-size:13px;margin-right:15px;"> Imobiliárias</a> -->
			    <i class="fa fa-envelope faicontopbar" aria-hidden="true"></i> <a class="" href="<?=$ROOTPATH?>/contato"  style="color:#fff;font-size:13px;margin-right:15px;"> Contato</a> 
				
				<? if(!$login_user_id){?> 
					 <i class="fa fa-sign-in faicontopbar" aria-hidden="true"></i> <a href="#" title="Entrar !" target="_blank"  data-toggle="modal" data-target="#exampleModal1" style="color:#fff;font-size:13px;margin-right:15px;" ref="assinatura_body">Login</a>
				<? } ?> 
				 <? if($login_user_id){ ?> <i class="fa fa-sign-out faicontopbar" aria-hidden="true"></i>  <a style="color:#fff;font-size:13px;" href="<?=$ROOTPATH?>/sair"> Sair</a>  <? } ?> 
			 
				
			</div> 
			<div class="hidden-xs col-sm-6">
			   <div class="top-bar-social pull-right">
				  <ul class="social-icons icon-flat list-unstyled list-inline">
					  <li> 
					  <? if(!$login_user_id){?> 
							<!-- <i class="fa fa-sign-in faicontopbar" aria-hidden="true"></i> <a href="<?=$ROOTPATH?>/index.php?page=login" title="Entrar !" style="color:#fff;font-size:13px;margin-right:15px;"  > Login</a> -->
					 <? } else {?>
							<i class="fa fa-user faicontopbar" aria-hidden="true"></i> <a href="<?=$ROOTPATH?>/index.php?page=meusdados"   style="color:#fff;font-size:13px;"   > Meus Dados</a>
					 <? } ?>					 
					  </li> 
					   
						<? if($login_user_id) {?> 
							<li> 
								<i class="fa fa-cubes faicontopbar" aria-hidden="true"></i> <a href="<?=$ROOTPATH?>/adminanunciante/team/"   style="color:#fff;font-size:13px;"> Meus Anúncios</a> 
							</li>
						<? } else if($login_user_id == 1 ){ ?>
							<li> 
								<i class="fa fa-cogs faicontopbar" aria-hidden="true"></i> <a href="<?=$ROOTPATH?>/vipmin"   style="color:#fff;font-size:13px;" > Gerenciar Vipmin</a> 
							 </li>
							 
						 <? } ?>
						 
						<!--  <li> <i class="fa fa-book faicontopbar" aria-hidden="true"></i> <a href="<?=$ROOTPATH?>/noticias-e-negocios-imobiliarios" title="Blog !" style="color:#fff;font-size:13px;" > Artigos </a> </li>-->
						
					  <?php if($INI['other']['youtube'] !="" ) { ?> 
							<li>
								<a target="_blank" href="<?php echo $INI['other']['youtube']; ?>">
									<i class="fa fa-youtube maicon_redes"></i>
								</a>
							</li> 
						<?}?>	
						<?php if($INI['other']['twitter'] !="" ) { ?> 
							<li>
								<a target="_blank" href="<?php echo $INI['other']['twitter']; ?>" >
									<i class="fa fa-twitter maicon_redes"></i>
								</a>
							</li> 
						<?}?>									
						<?php if($INI['other']['facebook'] !="" ) { ?> 									
							<li>
								<a target="_blank" href="<?php echo $INI['other']['facebook']; ?>">
									<i class="fa fa-facebook maicon_redes"></i>
								</a>
							</li>
						<?}?>
						<?php if($INI['other']['instagram'] !="" ) { ?> 
							<li>
								<a target="_blank" href="<?php echo $INI['other']['instagram']; ?>">
									<i class="fa fa-instagram maicon_redes"></i>
								</a>
							</li>
						<?}?>	
				   </ul>
			   </div>
			</div> 
		</div> 
	</div> 
</div>
<script>




</script>