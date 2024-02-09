<?php
if (!isset($_SESSION)) session_start();
// Caminho para o arquivo PDF
if (empty($_GET)) {
    header('location:index.php');
} else {
    if (!isset($_SESSION["id_usuario"])) {
        if ($_GET['id_recurso']) {
            header('location:recurso.php?id_recurso=' . $_GET['id_recurso']);
        } else {
            header('location:recurso.php?id_recurso=' . $_GET['id_pa']);
        }
    } else {
        $arquivo = $_GET['arqpath'];
    }
}


// Verifica se o arquivo existe
if (file_exists($arquivo)) {
    // Define o cabeçalho para forçar o download do arquivo
    header('Content-Description: File Transfer');
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename=' . basename($arquivo));
    header('Content-Length: ' . filesize($arquivo));
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Expires: 0');
    // Lê o arquivo para download
    readfile($arquivo);
    exit;
} else {
    // Se o arquivo não existir, exibe uma mensagem de erro
    echo "O arquivo não está disponível para download.";
}
?>
