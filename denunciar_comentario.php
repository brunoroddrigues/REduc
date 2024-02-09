<?php
require_once("Back-end/functions/func_conexao.php");
require_once("Back-end/class/recursosRequire.php");
require_once("Back-end/class/usersRequire.php");

$id_comentario = $_GET["id_comentario"];
$id_usuario = $_GET["id_usuario"];
$sql = "SELECT * FROM denuncia_comentario WHERE id_comentario = ? AND id_usuario = ?";
$stm = $conn->prepare($sql);
$stm->bindValue(1, $id_comentario);
$stm->bindValue(2, $id_usuario);
$stm->execute();
$resposta = $stm->fetchAll(PDO::FETCH_OBJ);
if (empty($resposta)) {
    $usuario = new Usuario(id_usuario: $id_usuario);
    $comentario = new Comentario(id_comentario: $id_comentario, usuario: $usuario);
    $denuncia = $comentario->DenunciarComentario();
    header('location:recurso.php?id_recurso=' . $_GET['id_recurso']);
    exit;
} else {
    header('location:recurso.php?id_recurso=' . $_GET['id_recurso']);
    exit;
}
?>