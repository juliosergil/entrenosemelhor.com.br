<?php include template("manage_header");?>
<?
$emails 		=  $_REQUEST['chave'] ;
$contadoremails =  $_REQUEST['recp'] ; 
$valor 			= $_REQUEST['valor'] ; 
/*
if($valor=="0"){
	$emails ="";
	$contadoremails = Table::Count('user');
	$sql =  "select email from user";
	$rs = mysqli_query(DB::$mConnection,$sql);
	while($row = mysqli_fetch_assoc($rs)){
		$emails .=$row['email'].",";
	}
	$emails =base64_encode($emails );
	$contadoremails =base64_encode($contadoremails );
}
*/
?>
 

<div id="bdw" class="bdw">
<div id="bd" class="cf">
<div id="partner">
	<div class="dashboard" id="dashboard">
		<ul><?php echo mcurrent_system('page'); ?></ul>
	</div>
	<form id="formcad" name="formcad" method="post">
	<div id="content" class="clear mainwide">
        <div class="clear box">
            <div class="box-top"></div>
            <div class="box-content">
                <div class="head"  style="float:left;" ><h2>Envio de mensagem</h2></div>
				<div style="width: 600px; text-align: center;">Esta mensagem será enviada para <?=base64_decode($contadoremails) ?> destinatário(s) <b><span name="modificacao" id="modificacao"></span></b></div>
				<input  type="hidden"  value="<?=$valor?>" name="idmodelo"  id="idmodelo"  >
				
                <div class="sect" style="clear:both;" >
                   <table id="orders-list" cellspacing="0" cellpadding="0" border="0" class="coupons-table">
					<tr style="background:#90C6F3;">
						<th width="60%">Assunto <input  type="text"  name="assunto"  id="assunto" style="width: 70%;color:#303030;font-size:11px;"> </th>
						<th width="40%"> 
						<button style="width: 60px;" type="button" onclick="enviar();"><span>Enviar</span></button> 
						</th>
					</tr>	
					</table> 
						<div class="field" style="width:99%">
							<textarea  id="mensagem" style="width:100%;height:450px;" class="ckeditor" name="mensagem"><?php echo htmlspecialchars($value); ?></textarea> 
						</div>
					   
                </div>
            </div>
            <div class="box-bottom"></div>
        </div>
	</div>
	
	<input name="action" value="enviaemailuser">
	<input name="chave" value="<?=$emails?>">
	<input name="recp" value="<?=$contadoremails?>">
	
	</form>

<div id="sidebar">
</div>

</div>
</div> <!-- bd end -->
</div> <!-- bdw end -->

<script>
  
 
 
function enviar( ){
	  
   assunto = jQuery("#assunto").val(); 
   mensagem =   CKEDITOR.instances['mensagem'].getData();
  jQuery("#mensagem").val(mensagem); 
   
	if(assunto==""){
		alert("Por favor, informe o assunto do email")
		return;
   }   
   
   if(mensagem==""){
		alert("Por favor, informe a mensagem do email")
		return;
   } 
  	jQuery(document).ready(function(){   
			jQuery.colorbox({html:"<div class='msgsoft2'> <img src='<?=$PATHSKIN?>/images/ajax-loader2.gif'> Enviando email. Note que se o seu site não estiver em um servidor semi dedicado ou dedicado esse envio pode demorar algumas horas. Por favor aguarde..</div>"});
	});
	

	jQuery.ajax({
		   type: "POST",
		   cache: false, 
		   async: false,
		   url: "<?=$INI['system']['wwwprefix']?>/ajax/manage.php",
		   data :   $("#formcad").serialize(),
		   success: function(ret){
		   if(jQuery.trim(ret)==""){
				jQuery.colorbox({html:"<div class='msgsoft'> <img src='<?=$ROOTPATH?>/media/css/i/Accept-icon.png'> Envio de email finalizado.</div> "});
			  }  
			  else{
				jQuery.colorbox({html:data});
			  }
		}
	});	
		
   
   
   
 
 	 
}
 
</script>

<?php 
if($valor != "0" and $valor != "00" and $valor){

	$sql =  "select * from modelos_email where id = $valor";
	$rs = mysqli_query(DB::$mConnection,$sql);
	$row = mysqli_fetch_assoc($rs);
	$assunto  = $row['assunto'] ;
	$mensagem  = $row['texto'] ;
	?>
	<script>  
	  jQuery("#assunto").val('<?=$assunto?>');
	</script>
<? } ?>

<script>
  
	/*tinyMCE.init({
		// General options
    language : "pt",
		mode : "textareas",
		theme : "advanced",
		plugins : "safari,pagebreak,style,layer,table,  advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

		// Theme options
		theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,
	   setup : function(ed) {
		ed.onLoadContent.add(function(ed, o) {
          // Output the element name
         //tinyMCE.get("mensagem").setContent('<?=htmlspecialchars_decode($mensagem)?>');
		});
		},
		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",
		//file_browser_callback : "tinyBrowser",
		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}	
	});*/
	
</script>