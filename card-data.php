<?php
    require_once "Back-end/class/conexao/Conexao.class.php";
    require_once "Back-end/class/recursos/Recursos.class.php";

    if($_POST["quantidade"] == 4) {
        $recurso = new Recursos();
        $retorno = $recurso->card4();
    } else {
        $recurso = new Recursos();
        $retorno = $recurso->cardTodos();
    }

    foreach($retorno as $recurso){
        $resposta[] = $recurso;
    }

    echo json_encode($resposta);
?>