<?php
	//$sql = "select count(*) as count from team";
	//$rs = mysqli_query(DB::$mConnection,$sql);
	//$row = mysqli_fetch_assoc($rs);
/* Busca das categorias */
$sqlF = "select id, name, imagemcateghome from category where idpai = 0 and display = 'Y' and displaymenu = 'Y'  order by sort_order desc,name limit 12";
$rsF = mysqli_query(DB::$mConnection,$sqlF);
?>
 <div class="homeTop">
    <div class="home-image-top-left"></div>
	 <div class="homeConteiner container">
         <div class="container mt-5">
             <div class="row">
                 <div class="col-12 px-md-4">
                     <h1 class="home-title"><?php echo utf8_decode($INI['system']['titulohome']); ?></h1>
                     <h2 class="home-subtitle"><?php echo utf8_decode($INI['system']['subtitulohome']); ?></h2>
                 </div>
             </div>
         </div>

	     <div class="container mt-5 mb-4">
		    <div class="row">
			   <div class="col-12 px-md-4">
			         <form class="searchBox " novalidate="" role="search" action="<?php echo $ROOTPATH; ?>">
						<select placeholder="Estado" class="inputSearch" id="Estado" name="Estado" >
						<option value="">Estado</option>
						<?php 
						$sql = "SELECT e.uf, e.nome FROM `estados` e WHERE e.uf in ( select b.uf  from team b where b.uf = e.uf and ( b.status is null or b.status = 1 ) and (pago = 'sim' or anunciogratis = 's') and begin_time < '".time()."' and end_time > '".time()."' ) ORDER BY e.nome ASC";
						$estados = mysqli_query(DB::$mConnection,$sql) or die(mysqli_error(DB::$mConnection));
						while ($row = mysqli_fetch_array($estados, MYSQLI_ASSOC)) {
						echo utf8_decode("<option value='{$row['uf']}'>{$row['nome']}</option>");		
						}
						?>
						</select>

						 <input class="inputSearch" type="search" value="" placeholder="Pesquisar" name="cppesquisa" id="cppesquisa">
                        <button class="submitBtn" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
							  <circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg></button>
					 			<input type="hidden" name="state" value="<?php echo $state; ?>">
								<input type="hidden" name="city" value="<?php echo $city; ?>">
								<input type="hidden" name="page" value="search"> 
					 </form>
			   </div>
			</div>
		 </div>
        <div class="container mt-5 mb-4">
			<div class="row" style="margin-left: 0 !important; margin-right: 0 !important;">
				<div class="col-12 px-0 px-md-4">
					<ul id="categories" class="list-unstyled mb-0 list-inline category-stripe pb-3" style="gap: 8px;">
						<?php
                        $colors = [
                            '#f55e5c',
                            '#3ac0ff',
                            '#77df40',
                            '#f4c837',
                            '#c56dfb',
                            '#ff6c00',
							 '#f55e5c',
                            '#3ac0ff',
                            '#77df40',
                            '#f4c837',
                            '#c56dfb',
                            '#ff6c00'
                        ];

                        $i = 0;

						while($rowF = mysqli_fetch_assoc($rsF)) {
							$total = get_total_anuncios_categoria($state, $rowF['id'],$cppesquisa);  
							$linkC = gera_link_cat($state,$rowF['id']); 
							$img = $PATHSKIN."/images/categoriaimage.png";
							if(!(empty($rowF['imagemcateghome']))) { 
								$img = $ROOTPATH."/media/".$rowF['imagemcateghome'];
							}
						?> 
							<li class="list-inline-item" style="margin-right: 0 !important;">
								<a href="<?php echo $linkC; ?>" style="margin-left: 0;">
									<span class="icon-background" style="background-color: <?php echo $colors[$i]; ?>">
										<img src="<?=$img?>" style="width:80px;height:80px" alt="<?=utf8_decode($rowF['name'])?>">
									</span>
									<small><?=utf8_decode($rowF['name'])?></small>
								</a>
							</li>
						<? $i++; } ?>
						 						
					</ul>
				</div>
			</div>
		</div>
	 </div>
	 <div class="home-image-top-right"></div>
<!--div class="content-subtitle">
	<?php
		echo utf8_decode($INI['system']['sitetitle']);
	?>
</div-->
<!-- 
<div class="text">
	Temos <span class="bold"><?php echo $row['count']; ?></span> an&uacute;ncios hoje.
</div>
-->
<!--div class="content-image">
	<img src="<?php echo $PATHSKIN; ?>/images/img_home.png">
</div-->

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const viewportWidth = window.innerWidth;

        if (viewportWidth < 576) {
            const element = document.getElementById('categories');

            if (element) {
                const scrollOffset = Math.floor((viewportWidth - 30 - 16) / 3);
                let currentIndex = 0;

                setInterval(function () {
                    if (currentIndex === 3) {
                        currentIndex = 0;
                    } else {
                        currentIndex++;
                    }

                    element.scroll({
                        top: 0,
                        left: currentIndex * scrollOffset,
                        behavior: 'smooth'
                    });
                }, 5000);
            }
        }
    });
</script>
