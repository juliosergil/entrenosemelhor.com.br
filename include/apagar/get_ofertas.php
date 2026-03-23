<?php

$others_now = time();
 
$consulta = "(SELECT `team_type`,`title`,`summary`,`city_id`,`partner_id`,`team_price`,`market_price`,`now_number`,`image`,`detail`,`notice`,`min_number`,`max_number` FROM team where id <> ".$_REQUEST['idoferta']." and end_time > '$others_now' and now_number < max_number and begin_time < '$others_now') UNION 
                  (SELECT `team_type`,`title`,`summary`,`city_id`,`partner_id`,`team_price`,`market_price`,`now_number`,`image`,`detail`,`notice`,`min_number`,`max_number` FROM produtos_afiliados where id <> ".$_REQUEST['idoferta']." and end_time > '$others_now' and now_number < max_number and begin_time < '$others_now')  LIMIT $limiteofertasemail";
$resultado = mysqli_query(DB::$mConnection,$consulta);

while ($linha = mysqli_fetch_assoc($resultado))
{
	$id = $linha["id"];
	$descricao = $linha["summary"];
	$descricao =  str_replace("&nbsp;","",$descricao );
	$descricao =  str_replace("&;","",$descricao );
	$descricao =  str_replace("!;","",$descricao );
	$descricao =  str_replace("?;","",$descricao );

	$cidade_id = $linha["city_id"]; 
	if ($cidade_id == "0"){$nome_cidade = "Nacional";}
	else {
		$consulta2 = "SELECT * FROM category WHERE id = '$cidade_id' LIMIT 1";
		$resultado2 = mysqli_query(DB::$mConnection,$consulta2);
		while ($linha2 = mysqli_fetch_assoc($resultado2))
		{		$nome_cidade = $linha2["name"];		}
	}
	$id_parceiro = $linha["partner_id"];
	$consulta3 = "SELECT * FROM partner WHERE id = '$id_parceiro' LIMIT 1";
	$resultado3 = mysqli_query(DB::$mConnection,$consulta3);
	while ($linha3 = mysqli_fetch_assoc($resultado3))
	{		
	$endereco_parceiro = $linha3["address"];
	$nome_parceiro = $linha3["title"];
	}

	$url_site = $INI['system']['wwwprefix'];
	
	$imagem = $linha["image"];
	$titulo = $linha["title"];
    $titulo  =  str_replace("&nbsp;","",$titulo);
	$titulo =  str_replace("&;","",$titulo );
	$titulo =  str_replace("!;","",$titulo );
	$titulo =  str_replace("?;","",$titulo );

	//$url_imagem = "$url_site/media/$imagem";	
	$url_imagem = "$url_site/media/".substr($imagem,0,-4)."_recentes.jpg";	
	
	$desconto = (100 * ($linha['market_price'] - $linha['team_price']) / $linha['market_price']);
	$desconto_final = ceil($desconto);
	
	$preco_final = str_replace(".", ",", $linha["market_price"]); // Caso o agregador necessite de virgula
	$preco_desconto = str_replace(".", ",", $linha["team_price"]); // Caso o agregador necessite de virgula
	$vendidos =  $linha["now_number"] ; // Caso o agregador necessite de virgula
	
	$timestamp_inicial = $linha["begin_time"];
	$data_inicial = date("Y-m-d H:i:s", $timestamp_inicial); // Caso o agregador necessite de um formato diferente

	$timestamp_final = $linha["end_time"];
	$data_final = date("Y-m-d H:i:s", $timestamp_final); // Caso o agregador necessite de um formato diferente
	
	$timestamp_validade = $linha['expire_time'];
	$validade_final = date("Y-m-d H:i:s", $timestamp_validade); // Caso o agregador necessite de um formato diferente
	
	$var = preg_replace("[ÁÀÂÃ]","A", utf8_decode($titulo) );
	$var = preg_replace("[áàâãª]","a",$var);
	$var = preg_replace("[ÉÈÊ]","E",$var);
	$var = preg_replace("[éèê]","e",$var);
	$var = preg_replace("[Í]","I",$var);
	$var = preg_replace("[ÓÒÔÕ]","O",$var);
	$var = preg_replace("[óòôõº]","o",$var);
	$var = preg_replace("[ÚÙÛ]","U",$var);
	$var = preg_replace("[í]","i",$var);
	$var = preg_replace("[úùû]","u",$var);
	$var = str_replace("Ç","C",$var);
	$var = str_replace("ç","c",$var);

	$nomeurl =    urlamigavel( $var) ;
	
    if($origem=="indicacao"){
		$link = $ROOTPATH."/convite/".$login_user_id;
	}
	else{
		$link = $INI['system']['wwwprefix']."/produto/". $id."/".$nomeurl;	
	}
 	
	if ($timestamp_inicial >= time()) { }
	else {
           $descricao = substr(utf8_decode(strip_tags($descricao)),0,190)."...";
		   $titulo = utf8_decode($titulo);
	  
		   $ofertas .= ' 
			   <table width="209" border="0" style="font-size: 11px;   color: #303030; font-family: Verdana;">
					  <tr>
						<td colspan="3"><a href='.$link.'><img style="width:200px;" border="0" src='.$url_imagem.'> </a></td>
					  </tr> 
					  <tr>
						 <td colspan="3">'.$descricao.'</td>
					  </tr>  
				       <tr>
						<td colspan="3"> <b> De R$ '.$preco_final.' por R$'.$preco_desconto.' </b></td>
					  </tr>
				  
					';
				/*if($vendidos!="" and $vendidos !="0"){
					 $ofertas .= ' <tr style="font-size: 13px;" > <td colspan="3"> <b>'.$vendidos.' vendido(s)</b></td>  </tr>';
				}*/

			$ofertas .= ' </table>   <br> ';
		}
	} 
?>