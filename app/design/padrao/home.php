<?php  require_once("include/head.php"); ?>
<body id="page1">
   <?php  require_once(DIR_BLOCO . "/header.php"); ?>  
   <div class="tail-top">
      <div style="display:none;" class="tips"><?=__FILE__?></div>
      <div class="content-home">
         <div class="home-top-background">
            <?php require_once(DIR_BLOCO . "/bloco_home.php"); ?>
         </div>
      </div>
      <?php
         if($INI['option']['cathomeimg'] != "N" ){
         
         	//require_once(DIR_BLOCO . "/categorias_imagem_destaque.php"); 
         }
         
         ?> 
      <!-- recomendados pra voce -->
      <div class="adpremium">
         <?php 
            require_once(DIR_BLOCO . "/galeria_premium.php");
            
            ?>
         <!--Galeria premium-->
         <div class="adrecomendados">
            <?php 
               require_once(DIR_BLOCO . "/recomendados.php");
           ?>    
		   <?php  
              // require_once(DIR_BLOCO . "/recentes.php");
           ?>  
            <div class="content-states">
               <div class="container-states container">
                  <?php // require_once(DIR_BLOCO . "/estados.php"); ?>  
                  <?php  require_once(DIR_BLOCO . "/categorias_imagem_destaque_bottom.php"); ?>  
               </div>
            </div>
         </div>
          <?php  
             require_once(DIR_BLOCO . "/blog.php"); 
             
            ?>
        
      </div>
   </div	> 
   </div> 
   <!--Modal galeria de imagens--> 
   <!-- Modal -->
   <?php require_once(DIR_BLOCO . "/modal.php"); ?> 
   
   
		  
</body>
</html>
 <?php
            require_once(DIR_BLOCO . "/rodape.php");
    ?> 