<?php
    require_once "Back-end/class/recursos/Recursos.class.php";

    if(/*$_POST["quantidade"] == 4*/true) {
        $recurso = new Recurso();
        $resposta = $recurso->card4();
    } else {
        $recurso = new Recurso();
        $resposta = $recurso->cardTodos();
    }

    var_dump($resposta);

    echo json_encode($resposta);
?>