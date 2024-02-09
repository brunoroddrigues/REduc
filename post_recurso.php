<?php
require_once "Back-end/functions/func_conexao.php";
require_once "Back-end/class/recursosRequire.php";
require_once "Back-end/class/usersRequire.php";

if (!isset($_SESSION)) session_start();

if (!$_SESSION['id_usuario']) {
    header('location:index.php');
    die();
}

$msgErro = array("", "");

if (!empty($_POST)) {
    if ($_POST['tipo'] == 1) {
        $rotaArquivo = "Recursos/videos/";
        $nomeCampo = "arquivo";
        $nomeArquivo = explode(".", $_FILES[$nomeCampo]["name"]);
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $tmpName = $_FILES[$nomeCampo]["tmp_name"];
        $mimeType = finfo_file($finfo, $tmpName);
        $extensao = end($nomeArquivo);

        $extensoesPermitidas = array("mp4", "webm", "ogg");
        $tiposMidiaPermitida = array("video/mp4", "video/webm", "video/ogg");

        // Valdando arquivo.
        if (!in_array(strtolower($mimeType), $tiposMidiaPermitida) || !in_array(strtolower($extensao), $extensoesPermitidas)) {
            $msgErro[0] = "Arquivo incompatível!";
            $erro = true;
        } else {
            // Gerando nome aleatório.
            $nome = sha1(microtime()) . "." . $extensao;
            // Gerando o caminho do arquivo
            $caminhoDoArquivo = $rotaArquivo . $nome;

            $erro = false;

        }

        if (!empty($_FILES['imagem_recurso']['name'])) {
            $rotaArquivo = "img/imgRecursos/";
            $nomeCampo = "imagem_recurso";
            $nomeArquivo = explode(".", $_FILES[$nomeCampo]["name"]);
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $tmpNameImagem = $_FILES[$nomeCampo]["tmp_name"];
            $mimeType = finfo_file($finfo, $tmpNameImagem);
            $extensao = end($nomeArquivo);

            $extensoesPermitidas = array("jpeg", "png", "svg", 'jpg');
            $tiposMidiaPermitida = array("image/png", "image/svg+xml", "image/jpeg", "image/jpg");

            if (!in_array(strtolower($mimeType), $tiposMidiaPermitida) || !in_array(strtolower($extensao), $extensoesPermitidas)) {
                $msgErro[1] = "Arquivo incompatível!";
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
            $caminhoDaImagem = 'img/imgRecursos/img_recursos_padrao.jpg';
            $upload = false;
        }

        if (!$erro) {
            if ($_POST['ferramenta'] != "Selecione a ferramenta") {
                $ferramenta = new Ferramenta(id_ferramenta: $_POST['ferramenta']);
            } else {
                $ferramenta = new Ferramenta(id_ferramenta: 0);
            }

            $titulo = $_POST['titulo'];
            $descricao = $_POST['descritivo'];
            $tipo = $_POST['tipo'];
            $link_video = $caminhoDoArquivo;
            $link_img = $caminhoDaImagem;
            $id_usuario = $_SESSION['id_usuario'];
            $categoria = new CategoriaRecurso(id_categoria: $tipo);

            $recurso = new Recursos(titulo: $titulo, descricao: $descricao, categoria: $categoria, link_video: $link_video, link_img: $link_img, ferramenta: $ferramenta);

            $id_recurso = $recurso->cadastrarRecursoVideo($id_usuario);

            if ($_POST['disciplina'] != "Selecione a disciplina") {
                $disciplina = $_POST['disciplina'];
                $sql = "INSERT INTO recurso_disciplina (id_recurso, id_disciplina) VALUES (?, ?)";
                $insersao = $conn->prepare($sql);
                $insersao->bindValue(1, $id_recurso);
                $insersao->bindValue(2, $disciplina);
                $insersao->execute();
            }

            if ($_POST['curso'] != "Selecione o curso") {
                $curso = $_POST['curso'];
                $sql = "INSERT INTO recurso_curso (id_recurso, id_curso) VALUES (?, ?)";
                $insersao = $conn->prepare($sql);
                $insersao->bindValue(1, $id_recurso);
                $insersao->bindValue(2, $curso);
                $insersao->execute();
            }

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

    if ($_POST['tipo'] == 2) {
        $rotaArquivo = "Recursos/arquivos/";
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
        if (!empty($_FILES['imagem_recurso']['name'])) {
            $rotaArquivo = "img/imgRecursos/";
            $nomeCampo = "imagem_recurso";
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
            $caminhoDaImagem = 'img/imgRecursos/img_recursos_padrao.jpg';
            $upload = false;
        }
        if (!$erro) {
            if ($_POST['ferramenta'] != "Selecione a ferramenta") {
                $ferramenta = new Ferramenta(id_ferramenta: $_POST['ferramenta']);
            } else {
                $ferramenta = new Ferramenta(id_ferramenta: 0);
            }

            $titulo = $_POST['titulo'];
            $descricao = $_POST['descritivo'];
            $tipo = $_POST['tipo'];
            $link_artigo = $caminhoDoArquivo;
            $link_img = $caminhoDaImagem;
            $id_usuario = $_SESSION['id_usuario'];
            $categoria = new CategoriaRecurso(id_categoria: $tipo);

            $recurso = new Recursos(titulo: $titulo, descricao: $descricao, categoria: $categoria, link_artigo: $link_artigo, link_img: $link_img, ferramenta: $ferramenta);

            $id_recurso = $recurso->cadastrarRecursoArtigo($id_usuario);

            if ($_POST['disciplina'] != "Selecione a disciplina") {
                $disciplina = $_POST['disciplina'];
                $sql = "INSERT INTO recurso_disciplina (id_recurso, id_disciplina) VALUES (?, ?)";
                $insersao = $conn->prepare($sql);
                $insersao->bindValue(1, $id_recurso);
                $insersao->bindValue(2, $disciplina);
                $insersao->execute();
            }

            if ($_POST['curso'] != "Selecione o curso") {
                $curso = $_POST['curso'];
                $sql = "INSERT INTO recurso_curso (id_recurso, id_curso) VALUES (?, ?)";
                $insersao = $conn->prepare($sql);
                $insersao->bindValue(1, $id_recurso);
                $insersao->bindValue(2, $curso);
                $insersao->execute();
            }

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
    <h2 class="h2 text-primary">Publicar um recurso</h2>
    <form id="form" action="#" method="post" enctype=multipart/form-data>
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
                <img id="img" src="img/imgRecursos/img_recursos_padrao.jpg" class="rounded mb-2 bg-dark">
                <input type="file" name="imagem_recurso" class="form-control" onchange="mostrar(this)">
                <span class="text-danger erro"><?php echo $msgErro[1]; ?></span>
            </div>

            <div class="row m-0 my-5">
                <div class="col-md-3">
                    <label class="form-label">Disciplina:</label>
                    <select class="form-select" name="disciplina">
                        <option selected>Selecione a disciplina</option>
                        <?php
                        $sql = "SELECT * FROM disciplinas";
                        $consulta = $conn->prepare($sql);
                        $consulta->execute();
                        $resultado = $consulta->fetchAll(PDO::FETCH_OBJ);
                        foreach ($resultado as $disciplina) {
                            echo "<option value='{$disciplina->id_disciplina}'>{$disciplina->descritivo}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Curso:</label>
                    <select class="form-select" name="curso">
                        <option selected>Selecione o curso</option>
                        <?php
                        $sql = "SELECT * FROM cursos";
                        $consulta = $conn->prepare($sql);
                        $consulta->execute();
                        $resultado = $consulta->fetchAll(PDO::FETCH_OBJ);
                        foreach ($resultado as $curso) {
                            echo "<option value='{$curso->id_curso}'>{$curso->descritivo}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">

                    <label class="form-label">Ferramenta:</label>
                    <select class="form-select" name="ferramenta">
                        <option selected>Selecione a ferramenta</option>
                        <?php
                        $sql = "SELECT * FROM ferramentas";
                        $consulta = $conn->prepare($sql);
                        $consulta->execute();
                        $resultado = $consulta->fetchAll(PDO::FETCH_OBJ);
                        foreach ($resultado as $ferramenta) {
                            echo "<option value='{$ferramenta->id_ferramenta}'>{$ferramenta->descritivo}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Tipo:</label>
                    <select class="form-select" name="tipo">
                        <option selected>Selecione o Tipo</option>
                        <?php
                        $sql = "SELECT * FROM tiporecurso";
                        $consulta = $conn->prepare($sql);
                        $consulta->execute();
                        $resultado = $consulta->fetchAll(PDO::FETCH_OBJ);
                        foreach ($resultado as $tipo) {
                            echo "<option value='{$tipo->id_tiporecurso}'>{$tipo->descritivo}</option>";
                        }
                        ?>
                    </select>
                    <span class="text-danger erro"></span>
                </div>
                <label class="form-label mt-5">Selecione seu Arquivo:</label>
                <input id="file_recurso" type="file" name="arquivo" class="form-control ">
                <span class="text-danger erro"><?php echo $msgErro[0]; ?></span>
            </div>
        </div>
        <input type="submit" value="Publicar" class="btn btn-success" onclick="validar(event)">
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