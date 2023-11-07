<?php
    require_once "Back-end/class/conexao/Conexao.class.php";
    require_once "Back-end/class/recursos/Recursos.class.php";

    $resposta = array();

    // $_POST["quantidade"] = 4;

    if($_POST["quantidade"] == 4) {
        $recurso = new Recursos();
        $retorno = $recurso->card4();
    } else {
        $recurso = new Recursos();
        $retorno = $recurso->cardTodos();
    }
    // $recursos4 = new Recursos();
    // $retornoQuatro = $recursos4->card4();

    // $recursosTodos = new Recursos();
    // $retornoTodos = $recursosTodos->cardTodos();

    // echo "<pre>";
    // var_dump($retornoQuatro);
    // echo"</pre>";

    // echo "<pre>";
    // var_dump($retornoTodos);
    // echo"</pre>";

    foreach($retorno as $recurso){
        $resposta[] = $recurso;
    }

    // echo "<pre>";
    // var_dump($resposta);
    // echo "</pre>";

    echo json_encode($resposta);
?>