<?php 

function formatException(Throwable $throw){
    return "Erro no arquivo <b>{$throw->getFile()}</b> na <b>linha {$throw->getLine()}</b>: <b><i>{$throw->getMessage()}.</i></b>";
}

?>