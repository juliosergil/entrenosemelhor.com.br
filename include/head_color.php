<style> 
.navbar.navbar-light  { 
	background: <?=$INI['cores']['navbar-light']?> !important;
} 

.icon-background:hover{
	background:<?=$INI['cores']['icon-backgroundhover']?>  !important;
}

.price-header .price-box{
	background:<?=$INI['cores']['cor_header']?> !important;
}
.losangulo{
	background:<?=$INI['cores']['cor_header']?> !important;
}

#top-bar{
	background:<?=$INI['cores']['topbar']?> !important;
}

.button7{
	background-color:<?=$INI['cores']['botaoanunc']?> !important;
}


.navbar-light .navbar-nav .nav-link { 
	color: <?=$INI['cores']['nav-link']?> !important;
}

.searchBox .submitBtn svg{ 
	color: <?=$INI['cores']['lupa']?> !important;
}
a{
	color: <?=$INI['cores']['links']?> !important;  
}
.nav-link  span{
	color: <?=$INI['cores']['nav-link']?> !important;
	
}

<?

/*============================================== IMAGENS =================================*/ 
$tipo="premium";
if($INI['header']['status_'.$tipo]== "Y"){?>
	.adpremium{
		background-image:url("<?=$PATHSKIN."/$tipo/".$INI['header']['arquivo_'.$tipo]?>") !important ;
	}
<? } else {?>
	.adpremium{
		background: <?=$INI['cores']['cor_'.$tipo]?> !important;
	}
<? } ?>

<? 
$tipo="recomendados";
if($INI['header']['status_'.$tipo]== "Y"){?>
	.adrecomendados {
		background-image:url("<?=$PATHSKIN."/$tipo/".$INI['header']['arquivo_'.$tipo]?>") !important ;
	}
	
<? } else {?> 
	.adrecomendados {
		background: <?=$INI['cores']['cor_'.$tipo]?> !important;
	}
<? } ?>
 
  .homeTop {
    background-image:url("<?=$PATHSKIN."header".$INI['header']['arquivo_'.$tipo]?>") !important ;
    /* Create the parallax scrolling effect */
    background-attachment: fixed;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;

  }
	
 
 


  
.recommendation-title{
	color: <?=$INI['cores']['recommendation']?> !important;
}

.premium-title{
	color: <?=$INI['cores']['galpremium']?> !important;
}

 

.content-states { 
	  background:  <?=$INI['cores']['cor_header']?> !important;
}

 
   
.btAnunciar{ 
  background: <?=$INI['cores']['btn-add']?> !important;
}  

  .btn.btn-view { 
	  background: <?=$INI['cores']['btn-add']?> !important;
  }   
  
  .link-1 b { 
	  background: <?=$INI['cores']['btn-add']?> !important;
  }  
    
 .price-list-offer { 
	  color: <?=$INI['cores']['price-list-offer']?> !important;
  } 
  .price-box{ 
	  background: <?=$INI['cores']['price-box']?> !important;
  }  
  
  .info-user{ 
	  background: <?=$INI['cores']['info-block']?> !important;
  } 
   
  .txthead{ 
	  color: <?=$INI['cores']['welcome']?> !important;
  }  
  
 
  
  .content-subtitle{ 
	  color: <?=$INI['cores']['subtitle']?> !important;
  }  
   
  header { 
	  background: <?=$INI['cores']['bgheader']?> !important;
  }
  #map .model-green .state .shape { 
	  background: <?=$INI['cores']['cormapa']?> !important;
  }   
  
  .list-state a { 
	  color: <?=$INI['cores']['cormapa']?> !important;
  } 
  
  #map .model-green .state .icon-state{ 
	  fill: <?=$INI['cores']['fill']?> !important;
  }
  
  .content-gallery{ 
	  background: <?=$INI['cores']['bgheader']?> !important;
  } 
  
  .list-city-offer{ 
	  background: <?=$INI['cores']['backcidade']?> !important;
  } 
  
  #rodape {
	   background: <?=$INI['cores']['rodape']?> !important;   
  }  
  
  .list-footer a {
	   color: <?=$INI['cores']['txtrodape']?> !important;    
  }
  
  .bg-dark {
    background-color: <?=$INI['cores']['rodapesup']?> !important;  
}

</style>