<?php
require_once("Back-end/functions/func_conexao.php");
if ($_GET['action']) {
    if ($_GET['action'] == 'aprov') {
        $sql = "DELETE FROM denuncia_comentario WHERE id_comentario = ?";
        $stm = $conn->prepare($sql);
        $stm->bindValue(1, $_GET['id_comentario']);
        $stm->execute();
        header('location:adm.php');
    }
    if ($_GET['action'] == 'reprov') {
        $sql = "DELETE FROM denuncia_comentario WHERE id_comentario = ?";
        $stm = $conn->prepare($sql);
        $stm->bindValue(1, $_GET['id_comentario']);
        $stm->execute();

        $sql2 = "DELETE FROM comentarios_recursos WHERE id_comentario = ?";
        $stm2 = $conn->prepare($sql2);
        $stm2->bindValue(1, $_GET['id_comentario']);
        $stm2->execute();
        header('location:adm.php');
    }
} else {
    header('location:index.php');
}
?>