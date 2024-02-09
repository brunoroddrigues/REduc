<?php
if (!empty($_GET)) {
    require_once "Back-end/class/usersRequire.php";
    $usuario = new Usuario(id_usuario: $_GET["userseguindo"]);
    $usuarioSeguido = $_GET["userseguido"];

    $usuario->SeguirUsuario($usuarioSeguido);
    header('location:perfil.php?user=' . $usuarioSeguido);
} else {
    header('location:index.php');
}
?>