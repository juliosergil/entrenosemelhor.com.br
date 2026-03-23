<?php
    require_once('../app.php');    

    try {
        
        $db = new PDO("mysql:host={$INI['db']['host']};dbname={$INI['db']['name']}", "{$INI['db']['user']}", "{$INI['db']['pass']}");

		$sql = "SELECT `pagamentos`.`id`, `pagamentos`.`team_id`, `pagamentos`.`datapagamento`, `planos_publicacao`.`dias`, `team`.`restore` FROM `pagamentos` INNER JOIN `team` ON `pagamentos`.`team_id` = `team`.`id` INNER JOIN `planos_publicacao` ON `pagamentos`.`idplano` = `planos_publicacao`.`id` WHERE `pagamentos`.`status_pagamento` = 'Sucesso'";
        echo $sql;
		$conn = $db->prepare($sql);
        $conn->execute();
        $data = $conn->fetchAll(PDO::FETCH_OBJ);

        foreach($data as $item) {

            $days = ' + ' . $item->dias . ' days';
            echo "<hr>verificando restore do anuncio: ".$item->team_id;
            // Verifica se ainda pode voltar para o topo
            if(strtotime(date("Y-m-d H:i:s")) >= strtotime($item->restore)) {
                echo "<br> hoje é maior ou igual ao ultimo restore, verificando o plano para pode atualizar...";
                // Verificar se ainda pode restaurar
                if(strtotime($item->datapagamento . $days) > strtotime($item->restore)) {                  
                    echo "<br> os dias maximo do plano sao maiores do que o ultimo restore, preparanto pra atualizar...";
                    $conn = $db->prepare("UPDATE `team` SET `restore` = :restore WHERE `id` = :id");
                    $conn->bindParam(':restore', date("Y-m-d H:i:s", strtotime($item->restore . ' +1 day')), PDO::PARAM_STR);
                    $conn->bindParam(':id', $item->team_id, PDO::PARAM_INT);
                    $conn->execute();
                    
                    echo utf8_decode("<br /> Anúncio #{$item->team_id} foi restaurado para o topo!");
                }
            }
        }

        unset($db);
    }
    catch(PDOException $e) {
        
        echo $e->getMessage();
    }
?>