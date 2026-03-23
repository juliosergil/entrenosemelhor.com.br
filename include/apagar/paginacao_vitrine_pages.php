<?php

require_once(dirname(dirname(__FILE__)). '/app.php');
 
$sqlcat="";
if($_REQUEST["idcategoria"]){
	$sqlcat =  " and group_id = ".$_REQUEST["idcategoria"];
}
$horaatual = time();

if($INI['option']['paginacao'] == ""){
	$$per_page = 6;
}
else{
	$per_page  = $INI['option']['paginacao'];
} 

$sql = "select * from team where team_type = 'especial' and posicionamento <> 5 and begin_time < '$horaatual' $sqlcat";
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

    J("#pgofertas").load(URLWEB+"/include/paginacao_vitrine.php?page=" + this.id, hideLoader);
    
    return false;
  });
</script>