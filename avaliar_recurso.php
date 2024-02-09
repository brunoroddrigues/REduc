<?php
if (!isset($_SESSION)) session_start();
if ($_GET['ava']) {
    require_once("Back-end/functions/func_conexao.php");
    $id_recurso = $_GET["id_recurso"];
    $id_usuario = $_GET["id_usuario"];
    $sql = "SELECT * FROM avaliacao_recurso WHERE id_recurso = ? AND id_usuario = ?";
    $stm = $conn->prepare($sql);
    $stm->bindValue(1, $id_recurso);
    $stm->bindValue(2, $id_usuario);
    $stm->execute();
    $retorno = $stm->fetchAll(PDO::FETCH_OBJ);

    if (empty($retorno)) {
        $nota = $_GET['ava'];
        $sql = "INSERT INTO avaliacao_recurso (id_recurso, id_usuario, nota) VALUES (?, ?, ?)";
        $stm = $conn->prepare($sql);
        $stm->bindValue(1, $id_recurso);
        $stm->bindValue(2, $id_usuario);
        $stm->bindValue(3, $nota);
        $stm->execute();
        header('location:recurso.php?id_recurso=' . $id_recurso);
    } else {
        // UPDATE
        $nota = $_GET['ava'];
        $sql = "UPDATE avaliacao_recurso SET nota = ? WHERE id_recurso = ? AND id_usuario = ?";
        $stm = $conn->prepare($sql);
        $stm->bindValue(1, $nota);
        $stm->bindValue(2, $id_recurso);
        $stm->bindValue(3, $id_usuario);
        $stm->execute();
        header('location:recurso.php?id_recurso=' . $id_recurso);
    }
} else {
    header('location:index.php');
}
?>