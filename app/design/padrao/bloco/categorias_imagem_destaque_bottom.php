
<!--GALERIA BOTTOM  
<div class="container pt-5 pb-5">
   <div class="row">
		<div class="col-12 d-flex d-flex-row">
			<h2 class="ml-0">Descubra</h2>
		</div>	
	</div>   
	
	<?php
		$sql_a = "select * from category where displayhome = 'Y' and  display = 'Y' order by sort_order desc";
		$rs_a = mysqli_query(DB::$mConnection,$sql_a); 
	?>
	 
	<div class="row mt-4">
		 <div class="col-12">
			 <div class="discovery-gallery">
			 
			 
					<a href="https://portalolx.olx.com.br/planos" style="background-image: url('<?=$PATHSKIN?>/images/casa_alugar.png');" class="image image-a" lurker="itemhome_1">
					<p class="font-weight-light semi-small">Conheça os nossos</p>
					<p class="h3 mt-0">Planos Profissionais</p>
				</a>
				
				<a href="#"  class="image" style="background-image: url('<?=$PATHSKIN?>/images/casa_alugar.png');" lurker="itemhome_2">
					<p class="font-weight-light semi-small">Quer alugar ou vender?</p>
					<p class="h3 mt-0">Casas e apartamentos</p>
				</a>
				<a href="#" class="image" style="background-image: url('<?=$PATHSKIN?>/images/vendaCelular.png');" lurker="itemhome_3">
					<p class="font-weight-light semi-small">Desapega do seu usado</p>
					<p class="h3 mt-0">Venda seu celular</p>
				</a>
				<a href="#" class="image "  style="background-image: url('<?=$PATHSKIN?>/images/videogames.png');" lurker="itemhome_4">
					<p class="font-weight-light semi-small">Eletr&ocirc;nicos e celulares</p>
					<p class="h3 mt-0">Videogames</p>
				</a>
				<a href="#" class="image  " style="background-image: url('<?=$PATHSKIN?>/images/carros.png');" lurker="itemhome_5">
					<p class="font-weight-light semi-small">Autos e pe&ccedil;as</p>
					<p class="h3 mt-0">Troque de carro</p>
				</a>
				<a href="#" class="image " style="background-image: url('<?=$PATHSKIN?>/images/financiamento.png');" lurker="itemhome_6">
					<p class="font-weight-light semi-small">Financiamento</p>
					<p class="h3 mt-0">Veja as oportunidades!</p>
				</a>
				<a href="" class="image" style="background-image: url('<?=$PATHSKIN?>/images/trator.png');" lurker="itemhome_7">
					<p class="font-weight-light semi-small">Agro e ind&uacute;stria</p>
					<p class="h3 mt-0">Tratores</p>
				</a>
				
			</div>	 
		 </div>	 
	</div>	
   
</div>	  
<!--GALERIA BOTTOM -->