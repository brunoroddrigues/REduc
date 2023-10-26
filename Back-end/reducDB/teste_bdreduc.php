<?php
try {
    $dns = "mysql: host=localhost;dbname=rductest";
    $usuario = "root";
    $senha = "";

    $conexao = new PDO($dns, $usuario, $senha);

    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo 'conexao bem sucedida';

} catch (\Throwable $th) {
    //throw $th;
}