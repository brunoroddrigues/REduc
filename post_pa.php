<?php
require_once "Back-end/functions/func_conexao.php";
require_once "Back-end/class/conexao/Conexao.class.php";
require_once "Back-end/class/pa/PA.class.php";
require_once "Back-end/class/pa/TiposPA.class.php";
require_once 'Back-end/class/users/Usuarios.class.php';

if (!isset($_SESSION)) session_start();

if (!$_SESSION['id_usuario']) {
    header('location:index.php');
    die();
}

$msgErro = array("", "");

if (!empty($_POST)) {
    $rotaArquivo = "PA/arquivos/";
    $nomeCampo = "arquivo";
    $nomeArquivo = explode(".", $_FILES[$nomeCampo]["name"]);
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $tmpName = $_FILES[$nomeCampo]["tmp_name"];
    $mimeType = finfo_file($finfo, $tmpName);
    $extensao = end($nomeArquivo);

    $extensoesPermitidas = array("pdf");
    $tiposMidiaPermitida = array("application/pdf");

    if (!in_array(strtolower($mimeType), $tiposMidiaPermitida) || !in_array(strtolower($extensao), $extensoesPermitidas)) {
        $msgErro[0] = "Arquivo incompatível, apenas PDF!";
        $erro = true;
    } else {
        // Gerando nome aleatório.
        $nome = sha1(microtime()) . "." . $extensao;
        // Gerando o caminho do arquivo
        $caminhoDoArquivo = $rotaArquivo . $nome;

        $erro = false;
    }
    if (!empty($_FILES['imagem_pa']['name'])) {
        $rotaArquivo = "img/imgPA/";
        $nomeCampo = "imagem_pa";
        $nomeArquivo = explode(".", $_FILES[$nomeCampo]["name"]);
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $tmpNameImagem = $_FILES[$nomeCampo]["tmp_name"];
        $mimeType = finfo_file($finfo, $tmpNameImagem);
        $extensao = end($nomeArquivo);

        $extensoesPermitidas = array("jpeg", "png", "svg", 'jpg');
        $tiposMidiaPermitida = array("image/png", "image/svg+xml", "image/jpeg", "image/jpg");

        if (!in_array(strtolower($mimeType), $tiposMidiaPermitida) || !in_array(strtolower($extensao), $extensoesPermitidas)) {
            $msgErro[1] = "Imagem incompatível!";
            $erro = true;
        } else {
            // Gerando nome aleatório.
            $nome = sha1(microtime()) . "." . $extensao;
            // Gerando o caminho do arquivo
            $caminhoDaImagem = $rotaArquivo . $nome;

            $erro = false;
            $upload = true;

        }

    } else {
        $caminhoDaImagem = 'img/imgPA/img_pa_padrao.jpg';
        $upload = false;
    }
    if (!$erro) {
        $titulo = $_POST['titulo'];
        $descricao = $_POST['descritivo'];
        $tipo = $_POST['tipo'];
        $link_arquivo = $caminhoDoArquivo;
        $link_img = $caminhoDaImagem;
        $usuario = new Usuario(id_usuario: $_SESSION['id_usuario']);
        $categoria = new TipoPA(id_tipo: $tipo);

        $PA = new PA(titulo: $titulo, descricao: $descricao, tipoPA: $categoria, link_arquivo: $link_arquivo, link_img: $link_img, usuario: $usuario);

        $publicar = $PA->PostarPA();

        // Upload do vídeo
        move_uploaded_file($tmpName, dirname(__FILE__) . "/" . $caminhoDoArquivo);
        // Upload da imagem
        if ($upload) {
            move_uploaded_file($tmpNameImagem, dirname(__FILE__) . '/' . $caminhoDaImagem);
        }
        unset($_POST);

        // Redirecione para o index
        header('Location: index.php');
        exit();
    }
}


?>

<!doctype html>
<html lang="pt-br">

<head>
    <title>REduc - Postar</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/post_recurso.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- Scripts do REduc -->
    <script defer src="assets/js/func.js"></script>
    <script defer type="module" src="assets/js/componentes.js"></script>

</head>

<body>
<header id='reduc-header'></header>

<main class="container py-5">
    <h2 class="h2 text-primary">Publicar pratica avaliativa</h2>
    <form id="form" action="post_pa.php" method="post" enctype=multipart/form-data>
        <div class="row">
            <div class="col-md-6">
                <label class="form-label">Título</label>
                <input type="text" name="titulo" class="form-control">
                <span class="text-danger erro"></span>
                <br>
                <label class="form-label">Descrição</label>
                <textarea class="form-control" name="descritivo"></textarea>
                <span class="text-danger erro"></span>
                <br>
            </div>
            <div class="col-md-6">
                <label class="h3 txt-roxo mb-4">Imagem</label>
                <img id="img" src="img/imgPA/img_pa_padrao.jpg" class="rounded mb-2 bg-dark">
                <input type="file" name="imagem_pa" class="form-control" onchange="mostrar(this)">
                <span class="text-danger"><?php echo $msgErro[1]; ?></span>
            </div>
            <div class="col-md-3">
                <label class="form-label">Tipo:</label>
                <select class="form-select" name="tipo">
                    <option selected>Selecione o Tipo</option>
                    <?php
                    $sql = "SELECT * FROM tipos_pa";
                    $consulta = $conn->prepare($sql);
                    $consulta->execute();
                    $resultado = $consulta->fetchAll(PDO::FETCH_OBJ);
                    foreach ($resultado as $tipo) {
                        echo "<option value='{$tipo->id_tipo}'>{$tipo->descritivo}</option>";
                    }
                    ?>
                </select>
                <span class="text-danger erro"></span>
            </div>
            <label class="form-label mt-5">Selecione seu Arquivo:</label>
            <input id="file_pa" type="file" name="arquivo" class="form-control ">
            <span class="text-danger erro"><?php echo $msgErro[0]; ?></span>
        </div>
        </div>
        <input type="submit" value="Publicar" class="btn btn-success" onclick="validarPA(event)">
        <!-- <a href="criar_recurso.html" class="btn btn-primary mx-2"><i class="bi bi-pencil-fill"></i> Escrever recurso</a> -->
    </form>
</main>

<footer id="reduc-footer"></footer>
<!-- Bootstrap JavaScript Libraries -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    function mostrar(img) {
        if (img.files && img.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#img')
                    .attr('src', e.target.result)
                    .width()
                    .height();
            };
            reader.readAsDataURL(img.files[0]);
        }
    }
</script>
<script src="assets/js/post_recurso.js"></script>
</body>

</html>