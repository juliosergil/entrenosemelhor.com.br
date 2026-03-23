
<link rel='stylesheet' id='style-css'  href='<?=$PATHSKIN?>/css/planosnew.css' type='text/css' media='all' />
<style>
.panel-hover.active .panel-footer, .panel-hover:hover .panel-footer {
    background-color: #666  !important;
    border-color:  #666  !important;
}

 
.panel-hover:hover,
.panel-hover.active { 
  border-color:  <?=$INI['other']['btn-envia']?>  !important; 
}

.panel-hover.active .btn,
.panel-hover:hover .btn { 
  background-color: <?=$INI['other']['btn-envia']?>  !important; 
  border-color: <?=$INI['other']['btn-envia']?>  !important;  
}
	

</style>	
<?php  

$team_id 	= $_REQUEST["id"];  // id do anuncio, quando vier da pagina adminanuciante/team/index.php  (renovacao de anuncio expirado)
$refresh  	= $_REQUEST["refresh"];  //    (renovacao de anuncio expirado)
				
if(isset($login_user)){
	/* Neste ponto verifico se o usuario ja pegou o plano gratis alguma vez. Caso afirmativo
	   o plano gratuito nao sera exibido.
	*/
	$sqlplanos = "SELECT count(id) FROM `team` WHERE anunciogratis = 's' AND user_id = " . $login_user['id'];
	$rsplanos = mysqli_query(DB::$mConnection,$sqlplanos);
	$num = mysqli_fetch_assoc($rsplanos);
	$rule = 0;
	if($num['id'] >= 1) { 
		/* Caso o usuario ja tenha adquirido um plano gratis, e enviado o ID do plano gratis que eh 10. */ 
		$aux =  " and id <>  10 "  ;
 
	} 
}
 
$sqlplanos = "select * from planos_publicacao where ativo = 's' $aux ";
$rsplanos = mysqli_query(DB::$mConnection,$sqlplanos);

$j = 2;
while($row = mysqli_fetch_array($rsplanos)){
	$valor_plano = explode(".", $row['valor']);
	$nomeplano = utf8_decode($row['nome']) ;
	if(!$INI['other']['plano1']){ $INI['other']['plano1'] = "#65492E";}
	if(!$INI['other']['plano2']){ $INI['other']['plano2'] = "#8E8072";}
	$color = $j % 2 == 0 ? $INI['other']['plano1'] : $INI['other']['plano2'];
	$border = $j % 2 == 0 ? $INI['other']['plano1'] : $INI['other']['plano2'];
?>
   <div class="container-fluid col-md-2 col-xs-6"> 
   
		<div class="panel panel-default panel-hover">
		 <div class="panel-footer"><strong><?=ucfirst($nomeplano)?></strong></div> 
		  <div class="panel-body mx-auto">
			<h4 class="txtdias">  <? echo $row['dias']." dias";?>  </h4> 
			<h4 class="h4-panel"><strong><?=htmlentities($INI['system']['currency'])?> <?php echo $valor_plano[0]; ?>,<?php echo $valor_plano[1]; ?></strong></h4>							
		 
			<p class="a-panel">Depoimentos no anuncio</p>
			<p class="a-panel">Foto no resultado da busca</p>
		 
			<?php if($row['temvideo'] == 'VIDEO') { ?> <p class="a-panel">V&iacute;deo no an&uacute;ncio</p>   <?php } ?>
   
				 
		  </div>
		  <div class="panel-footer">
			<a target="_blank" href="<?=$ROOTPATH?>/adminanunciante/team/edit.php?idplano=<?=$row['id']?>&id=<?=$team_id?>&refresh=<?=$refresh?>"><button class="btn btn-block"><strong>CONTRATAR</strong></button></a>
		  </div> 
		  
	  </div>
  </div>  
<?php   
$j ++; 

} ?>