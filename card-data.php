<?php
    require_once "Back-end/class/conexao/Conexao.class.php";
    require_once "Back-end/class/recursos/Recursos.class.php";
    require_once "Back-end/class/users/Usuarios.class.php";

    if(!isset($_SESSION)) session_start();
    var_dump($_SESSION["id_usuario"]);

    $_POST["quantidade"] = 1;


    if($_POST["quantidade"] == 4) {
        $recurso = new Recursos();
        $retorno = $recurso->card4($_SESSION["id_usuario"]);
    } else {
        $recurso = new Recursos();
        $retorno = $recurso->cardTodos($_SESSION["id_usuario"]);
    }

    foreach($retorno as $recurso){
        $resposta[] = $recurso;
    }

    echo json_encode($resposta);
?>