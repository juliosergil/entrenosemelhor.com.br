<?php
  
 if($RetornoPagamento->status_transacao == STATUS_APROVADO){
 
	Util::log($RetornoPagamento->id_anuncio." - Status aprovado. Preparando para atualizar tabela de anuncios.");
	Util::log($RetornoPagamento->id_anuncio. " - Verificando a existencia do anuncio...");
	
	/***************************** TRATAMENTO DE SERVICO E CREDITO ****************************************/
	if($RetornoPagamento->pedido_inexistente){
		Util::log($RetornoPagamento->id_anuncio. " - anuncio nao foi localizado nos registros. Parando retorno.");  
		exit;
	}
	else{
		Util::log($RetornoPagamento->id_anuncio. " - Anuncio ". $RetornoPagamento->id_anuncio." encontrado. Verificando status do pagamento.");
	} 
	
	/***************************** INICIO DA ATUALIZACAO DO ANUNCIO NO SITE ****************************************/
	 
	//if($RetornoPagamento->status_pedido_site == '' or $RetornoPagamento->status_pedido_site == 'nao'){// pago == nao
	//	Util::log($RetornoPagamento->id_anuncio. " - Anuncio encontrado com status nao pago. Preparando para atualizar...");
		 
		 insere_dados_pagamento($RetornoPagamento->id_anuncio,$RetornoPagamento->idPedido,$RetornoPagamento->valor_unitario,$RetornoPagamento->user_id,$idplano,"Sucesso","Retorno Automatico - ".$RetornoPagamento->status_transacao);
	 
	//}
	//else if ( $RetornoPagamento->status_pedido_site == 'sim' ) { // pago == sim
	//	Util::log($RetornoPagamento->id_anuncio. " - Anuncio ja estava com status de pago no banco de dados. saindo...");
	//}
	Utility::Redirect( WEB_ROOT );	
} 
	
?>