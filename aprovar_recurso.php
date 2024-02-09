<?php
require_once("Back-end/class/conexao/Conexao.class.php");
require_once("Back-end/class/recursos/Recursos.class.php");

if ($_GET["id_recurso"]) {
    $recurso = new Recursos();
    $recurso->ativar($_GET["id_recurso"]);

    header("location: adm.php");
    die();
} else {
    header("location: index.php");
}