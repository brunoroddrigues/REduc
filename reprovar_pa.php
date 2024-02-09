<?php
require_once("Back-end/class/paRequire.php");
require_once("Back-end/functions/func_conexao.php");
if ($_GET['id_pa']) {
    $sql = "SELECT arquivo_path, img_pa_path FROM pa WHERE id_pa = ?";
    $consulta = $conn->prepare($sql);
    $consulta->bindValue(1, $_GET['id_pa']);
    $consulta->execute();
    $retorno = $consulta->fetchAll(PDO::FETCH_OBJ);

    $pa = new PA(id_pa: $_GET['id_pa']);
    $pa->ReprovarPA();

    if ($retorno[0]->img_pa_path != "img/imgPA/img_pa_padrao.jpg") {
        unlink($retorno[0]->img_pa_path);
    }
    unlink($retorno[0]->arquivo_path);

    header("location: adm.php");
    die();
} else {
    header("location: index.php");
}
?>