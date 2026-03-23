<!-- 
descomentar o css abaixo

.form-categories {
    padding-bottom: 18px;
    float: left;
    width: 248px;
    border: 1px solid #ccc;
    margin-top: 5px;
    border-radius: 3px;
    padding-left: 4px;
    padding-top: 5px;
}

.form-control-cb {
   
    width: 243px !important;
}

-->

<div style="display:none;height:36px;" class="tips"><?=__FILE__?></div> 

<?
if($_GET['id_category'] !=0 && isset($_GET['id_category']) && !(empty($_GET['id_category']))) {	
	$id_category = strip_tags($_GET['id_category']);
	$sqlaux = " idpai = $id_category and " ;
}
else{
	$sqlaux = " idpai = 0 and " ;
}

/* Busca das categorias */
$sqlF = "select id, name, imagemcateghome from category where $sqlaux  display = 'Y' order by sort_order desc,name";
$rsF = mysqli_query(DB::$mConnection,$sqlF);
 

?>

<form method="GET" name="form-search-offer" id="form-search-offer" action="<?php echo $ROOTPATH; ?>" onsubmit=" return gofind();">
<div class="form-categories">
	<div class="title-block list-categories">
		Pesquisa
	</div>
		<div class="form-group">
			<input class="form-control ckeditor" type="text" name="cppesquisa" id="cppesquisa" placeholder="Buscar por palavra chave" maxlength="28">
			<input type="hidden" name="state" value="<?php echo $state; ?>">
			<input type="hidden" name="city" value="<?php echo $city; ?>">
			<input type="hidden" name="page" value="search">
		</div>
		 
	
		<div class="list-categories"> 
			<ul> 
				<select class="form-control form-control-cb" id="subcategories" name="subcategories" >
				<? if($id_category){?> <option><?php echo utf8_decode($category[name]); ?></option><? } ?>
			<?php
				while($rowF = mysqli_fetch_assoc($rsF)) {
					
					$linkC = gera_link_cat($state,$rowF['id']);    
					 		  
					echo "<option value='".$linkC."'>".utf8_decode($rowF['name'])."</option>"; 
						 
				  } ?>
				</select>
				<br>
				<a href="javascript:history.back(1);"> Voltar </a>
			</ul>
		</div>   
  </div>
  <input type="submit" value="Buscar" name="subenv" id="subenv" style="width: 252px;    background: #18b422;color: #fff;margin-top: 11px;	">
 
 </form> 
 
<script>

function gofind(){ 
 
		var url 		= $("#subcategories").val();	
		//var url = "<?php echo $ROOTPATH; ?>/index.php?page=categoria&idcategoria="+subcategoryid;
		$( "#form-search-offer" ).attr("action", url);
 	
}

function replaceUrlParam(url, paramName, paramValue){
	if(paramValue == null)
		paramValue = '';
	var pattern = new RegExp('\\b('+paramName+'=).*?(&|$)')
	if(url.search(pattern)>=0){
		return url.replace(pattern,'$1' + paramValue + '$2');
	}
	return url + (url.indexOf('?')>0 ? '&' : '?') + paramName + '=' + paramValue 
}
		
</script>