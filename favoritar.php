<?php
if (!isset($_SESSION)) session_start();
if ($_GET['fav']) {
    if ($_GET['fav'] == 'true') {
        require_once("Back-end/functions/func_conexao.php");
        $id_recurso = $_GET["id_recurso"];
        $id_usuario = $_GET["id_usuario"];
        $sql = "INSERT INTO recursos_salvos (id_recurso, id_usuario) VALUES (?, ?)";
        $stm = $conn->prepare($sql);
        $stm->bindValue(1, $id_recurso);
        $stm->bindValue(2, $id_usuario);
        $stm->execute();
        header('location:recurso.php?id_recurso=' . $id_recurso);
    } else {
        require_once("Back-end/functions/func_conexao.php");
        $id_recurso = $_GET["id_recurso"];
        $id_usuario = $_GET["id_usuario"];
        $sql = "DELETE FROM recursos_salvos WHERE id_recurso = ? AND id_usuario = ?";
        $stm = $conn->prepare($sql);
        $stm->bindValue(1, $id_recurso);
        $stm->bindValue(2, $id_usuario);
        $stm->execute();
        header('location:recurso.php?id_recurso=' . $id_recurso);
    }
} else {
    header('location:index.php');
}
?>