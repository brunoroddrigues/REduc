<?php
if (!isset($_SESSION)) session_start();
if ($_GET['ava']) {
    require_once("Back-end/functions/func_conexao.php");
    $id_pa = $_GET["id_pa"];
    $id_usuario = $_GET["id_usuario"];
    $sql = "SELECT * FROM avaliacao_pa WHERE id_pa = ? AND id_usuario = ?";
    $stm = $conn->prepare($sql);
    $stm->bindValue(1, $id_pa);
    $stm->bindValue(2, $id_usuario);
    $stm->execute();
    $retorno = $stm->fetchAll(PDO::FETCH_OBJ);

    if (empty($retorno)) {
        $nota = $_GET['ava'];
        $sql = "INSERT INTO avaliacao_pa (id_pa, id_usuario, nota) VALUES (?, ?, ?)";
        $stm = $conn->prepare($sql);
        $stm->bindValue(1, $id_pa);
        $stm->bindValue(2, $id_usuario);
        $stm->bindValue(3, $nota);
        $stm->execute();
        header('location:PA.php?id_pa=' . $id_pa);
    } else {
        // UPDATE
        $nota = $_GET['ava'];
        $sql = "UPDATE avaliacao_pa SET nota = ? WHERE id_pa = ? AND id_usuario = ?";
        $stm = $conn->prepare($sql);
        $stm->bindValue(1, $nota);
        $stm->bindValue(2, $id_pa);
        $stm->bindValue(3, $id_usuario);
        $stm->execute();
        header('location:PA.php?id_pa=' . $id_pa);
    }
} else {
    header('location:index.php');
}
?>