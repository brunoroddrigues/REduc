<?php
require_once("Back-end/class/usersRequire.php");

if ($_GET) {
    $usuario = new Usuario(id_usuario: $_GET['id_usuario']);
    $usuario->aprovarUsuario();

    header("location: adm.php");
    die();
}