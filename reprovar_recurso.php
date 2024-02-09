<?php
require_once("Back-end/class/conexao/Conexao.class.php");
require_once("Back-end/class/recursos/Recursos.class.php");
require_once("Back-end/functions/func_conexao.php");

if ($_GET["id_recurso"]) {
    $sql = "SELECT video_path, artigo_path, img_recurso_path FROM recursos WHERE id_recurso = ?";
    $consulta = $conn->prepare($sql);
    $consulta->bindValue(1, $_GET["id_recurso"]);
    $consulta->execute();
    $retorno = $consulta->fetchAll(PDO::FETCH_OBJ);
    $recurso = new Recursos();
    $recurso->reprovar($_GET["id_recurso"]);

    if ($retorno[0]->img_recurso_path != "img/imgRecursos/img_recursos_padrao.jpg") {
        unlink($retorno[0]->img_recurso_path);
    }

    if (!$retorno[0]->artigo_path) {
        unlink($retorno[0]->video_path);
    } else {
        unlink($retorno[0]->artigo_path);
    }

    header("location: adm.php");
    die();
} else {
    header("location: index.php");
}