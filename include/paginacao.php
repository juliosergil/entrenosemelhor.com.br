<?php

require_once(dirname(dirname(__FILE__)). '/app.php');
 
$sqlcat="";
if($_REQUEST["idcategoria"]  and $_REQUEST['page'] != "recentes"){
	$sqlcat =  " and group_id = ".$_REQUEST["idcategoria"];
}
$horaatual = time();

if($INI['option']['paginacao'] == ""){
	$per_page = 12;
}
else{
	$per_page  = $INI['option']['paginacao'];
} 
if( $_REQUEST['idparceiro'] != ""){ 
	$sql = "select * from team where posicionamento <> 5 and city_id in( ".$city['id'].",0) and begin_time < '$horaatual' and partner_id = ".$_REQUEST['idparceiro']."";
}
if( $_REQUEST['idcategoria'] != "" and $_REQUEST['page'] != "recentes" ){ 
	$sql = " select * from team where posicionamento <> 5 and begin_time < '".time()."' and group_id = ".$_REQUEST['idcategoria']." order by `begin_time` DESC , `now_number` ASC";
}
else{
	  $sql  = " select * from  team where  posicionamento <> 5 and begin_time < '".time()."' and city_id in( ".$city['id'].",0) $sqlcat order by `end_time` DESC , `now_number` ASC";				
} 
//echo "=====".$sql;
$rsd = mysqli_query(DB::$mConnection,$sql);
$count = mysqli_num_rows($rsd);
$pages = ceil($count/$per_page);

?>

<div style="text-align:center;">
 
  <div id="paging_button" style="text-align:center;">
    <ul>
 
    <?php
    //Show page links
    for($i=1; $i<=$pages; $i++)
    {
      echo '<li id="'.$i.'">'.$i.'</li>';
    }?>
 
    </ul>
  </div>
</div>

<script>
  J("#paging_button li").click(function(){
    showLoader();
    
    J("#paging_button li").css({'background-color' : ''});
    J(this).css({'background-color' : '#D8543A'});
	
  <? if( $_REQUEST['idcategoria'] != ""){ ?>
		//J("#pgofertas").load(URLWEB+"/include/paginacao_post.php?page=" + this.id, hideLoader);
  <?} else {?>
		//J("#pgofertas").load(URLWEB+"/include/paginacao_post.php?page=categorias&idcategoria=<?=$_REQUEST['idcategoria']?>&pagina=" + this.id, hideLoader);
  <? } ?>  
    return false;
  });
</script>