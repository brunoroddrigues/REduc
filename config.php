<?php
require_once 'Back-end/functions/func_conexao.php';
$msg = array("", "", "", "");

if (!isset($_SESSION)) session_start();

if (!$_SESSION['id_usuario']) {
    header('location:index.php');
    die();
} else {
    require_once "Back-end/class/usersRequire.php";
    $usuario = new Usuario(id_usuario: $_SESSION['id_usuario']);
}

if (isset($_POST)) {
    if (!empty($_POST['username'])) {
        $novoUsername = $_POST['username'];
        // Testando existencia do novo Nome
        $sql = "SELECT nomeUsuario from users where nomeUsuario = ?";
        $consulta = $conn->prepare($sql);
        $consulta->bindValue(1, $novoUsername);
        $consulta->execute();
        $teste = $consulta->fetchAll(PDO::FETCH_OBJ);
        if (!empty($teste)) {
            $msg[1] = "Nome de usuário ja cadastrado!";
        } else {
            $sql = "UPDATE users SET nomeUsuario = ? WHERE id_usuario = ?";
            $consulta = $conn->prepare($sql);
            $consulta->bindValue(1, $novoUsername);
            $consulta->bindValue(2, $_SESSION['id_usuario']);
            $consulta->execute();
            unset($_POST['username']);
        }

    }

    if (!empty($_POST['nome'])) {
        $novoNome = $_POST['nome'];
        $sql = "UPDATE users SET nome = ? WHERE id_usuario = ?";
        $consulta = $conn->prepare($sql);
        $consulta->bindValue(1, $novoNome);
        $consulta->bindValue(2, $_SESSION['id_usuario']);
        $consulta->execute();
        unset($_POST['nome']);
    }

    if (!empty($_POST['sobrenome'])) {
        $novoSobrenome = $_POST['sobrenome'];
        $sql = "UPDATE users SET sobrenome = ? WHERE id_usuario = ?";
        $consulta = $conn->prepare($sql);
        $consulta->bindValue(1, $novoSobrenome);
        $consulta->bindValue(2, $_SESSION['id_usuario']);
        $consulta->execute();
        unset($_POST['sobrenome']);
    }

    if (!empty($_POST['email'])) {
        $novoEmail = $_POST['email'];
        // Testando existencia do novo Nome
        $sql = "SELECT email from users where email = ?";
        $consulta = $conn->prepare($sql);
        $consulta->bindValue(1, $novoEmail);
        $consulta->execute();
        $teste = $consulta->fetchAll(PDO::FETCH_OBJ);
        if (!empty($teste)) {
            $msg[2] = "Email ja cadastrado!";
        } else {
            $sql = "UPDATE users SET email = ? WHERE id_usuario = ?";
            $consulta = $conn->prepare($sql);
            $consulta->bindValue(1, $novoEmail);
            $consulta->bindValue(2, $_SESSION['id_usuario']);
            $consulta->execute();
            unset($_POST['email']);
        }

    }

    if (!empty($_POST['bio'])) {
        $novaBio = $_POST['bio'];
        $sql = "UPDATE users SET descricao = ? WHERE id_usuario = ?";
        $consulta = $conn->prepare($sql);
        $consulta->bindValue(1, $novaBio);
        $consulta->bindValue(2, $_SESSION['id_usuario']);
        $consulta->execute();
        unset($_POST['bio']);
    }

    if (!empty($_POST['lattes'])) {
        $novoLattes = $_POST['lattes'];
        $sql = "UPDATE users SET link_lattes = ? WHERE id_usuario = ?";
        $consulta = $conn->prepare($sql);
        $consulta->bindValue(1, $novoLattes);
        $consulta->bindValue(2, $_SESSION['id_usuario']);
        $consulta->execute();
        unset($_POST['lattes']);
    }

    if (!empty($_POST['atuacao'])) {
        $novaAtuacao = $_POST['atuacao'];
        $sql = "UPDATE users SET area_atuacao = ? WHERE id_usuario = ?";
        $consulta = $conn->prepare($sql);
        $consulta->bindValue(1, $novaAtuacao);
        $consulta->bindValue(2, $_SESSION['id_usuario']);
        $consulta->execute();
        unset($_POST['atuacao']);
    }

    if (!empty($_POST['senha'])) {
        if (!empty($_POST['senha2'])) {
            if ($_POST['senha2'] == $_POST['senha']) {
                $novaSenha = md5($_POST['senha']);
                $sql = "UPDATE users SET senha = ? WHERE id_usuario = ?";
                $consulta = $conn->prepare($sql);
                $consulta->bindValue(1, $novaSenha);
                $consulta->bindValue(2, $_SESSION['id_usuario']);
                $consulta->execute();
                unset($_POST['senha']);
                unset($_POST['senha2']);
            } else {
                $msg[3] = "As senhas precisam ser iguais!";
            }
        } else {
            $msg[3] = "Preencha a senha!";
        }
    }

    if (!empty($_POST['pergunta'])) {
        if ($_POST['pergunta'] != '0') {
            $novaPergunta = $_POST['pergunta'];
            $sql = "UPDATE users SET id_pergunta = ? WHERE id_usuario = ?";
            $consulta = $conn->prepare($sql);
            $consulta->bindValue(1, $novaPergunta);
            $consulta->bindValue(2, $_SESSION['id_usuario']);
            $consulta->execute();
            unset($_POST['pergunta']);
        }
    }

    if (!empty($_POST['resposta'])) {
        $novaResposta = $_POST['resposta'];
        $sql = "UPDATE users SET resposta_seguranca = ? WHERE id_usuario = ?";
        $consulta = $conn->prepare($sql);
        $consulta->bindValue(1, $novaResposta);
        $consulta->bindValue(2, $_SESSION['id_usuario']);
        $consulta->execute();
        unset($_POST['resposta']);
    }

    if (!empty($_FILES['img_usuario']['name'])) {
        $rotaArquivo = "img/imgUsers/";
        $nomeCampo = "img_usuario";
        $nomeArquivo = explode(".", $_FILES[$nomeCampo]["name"]);
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $tmpNameImagem = $_FILES[$nomeCampo]["tmp_name"];
        $mimeType = finfo_file($finfo, $tmpNameImagem);
        $extensao = end($nomeArquivo);

        $extensoesPermitidas = array("jpeg", "png", "svg", 'jpg');
        $tiposMidiaPermitida = array("image/png", "image/svg+xml", "image/jpeg", "image/jpg");

        if (!in_array(strtolower($mimeType), $tiposMidiaPermitida) || !in_array(strtolower($extensao), $extensoesPermitidas)) {
            $msg[0] = "Arquivo incompatível!";
        } else {
            $img_antiga = $usuario->BuscarPerfilUsuario();
            if ($img_antiga[0]->img_path != "img/imgUsers/img_padrao_user.jpg") {
                unlink($img_antiga[0]->img_path);
            }
            // Gerando nome aleatório.
            $nome = sha1(microtime()) . "." . $extensao;
            // Gerando o caminho do arquivo
            $caminhoDaImagem = $rotaArquivo . $nome;
            move_uploaded_file($tmpNameImagem, dirname(__FILE__) . '/' . $caminhoDaImagem);

            $usuario->TrocarImg($caminhoDaImagem);

            unset($_POST);

            // Redirecione para a mesma página
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit();
        }
    }

}
?>

<!doctype html>
<html lang="pt-br">

<head>
    <title>REduc - Configurações</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/config.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script defer type="module" src="assets/js/componentes.js"></script>

</head>

<body>
<header id="reduc-header"></header>
<main>
    <form action="#" method="post" id="config-form" class="container shadow rounded bg-light my-5 p-5"
          enctype="multipart/form-data">
        <h2 id="titulo" class="h2 txt-roxo d-flex justify-content-between">Alterar configurações de conta<a
                    href="meuPerfil.php" id="voltar"><i class="bi bi-arrow-left"></i>Voltar</a></h2>
        <hr class="mb-5">
        <div id="campos" class="mb-5">
            <div id="config-dados">
                <h3 class="h3 txt-roxo mb-5">Dados da conta</h3>
                <label class="form-label">Nome de usuário:</label>
                <input type="text" class="form-control" name="username" placeholder="Digite o novo nome de usuário..."
                       value="<?php echo isset($_POST['username']) ? $_POST['username'] : '' ?>">
                <span class="text-danger"><?php echo $msg[1]; ?></span>
                <br>
                <label class="form-label">Nome:</label>
                <input type="text" class="form-control" name="nome" placeholder="Digite o novo nome..."
                       value="<?php echo isset($_POST['nome']) ? $_POST['nome'] : '' ?>">
                <br>
                <label class="form-label">Sobrenome:</label>
                <input type="text" class="form-control" name="sobrenome" placeholder="Digite o novo sobrenome..."
                       value="<?php echo isset($_POST['sobrenome']) ? $_POST['sobrenome'] : '' ?>">
                <br>
                <label class="form-label">E-mail</label>
                <input type="email" class="form-control" name="email" placeholder="Digite o novo e-mail..."
                       value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>">
                <span class="text-danger"><?php echo $msg[2]; ?></span>
                <br>
                <label class="form-label">Bio:</label>
                <textarea id="input-bio" class="form-control"
                          placeholder="<?php echo isset($_POST['bio']) ? $_POST['bio'] : 'Digite a nova BIO...' ?>"
                          name="bio"></textarea>
                <br>
                <label class="form-label">Currículo Lattes:</label>
                <input type="url" class="form-control" name="lattes" placeholder="Insira o link do Lattes..."
                       value="<?php echo isset($_POST['lattes']) ? $_POST['lattes'] : '' ?>">
                <br>
                <label class="form-label">Área de atuação:</label>
                <input type="text" name="atuacao" class="form-control" placeholder="Digite a área de atuação..."
                       value="<?php echo isset($_POST['atuacao']) ? $_POST['atuacao'] : '' ?>">
                <br>
                <label class="form-label">Senha:</label>
                <input type="password" class="form-control" name="senha" placeholder="Digite sua nova senha..."
                       value="<?php echo isset($_POST['senha']) ? $_POST['senha'] : '' ?>">
                <br>
                <label class="form-label">Repita a senha:</label>
                <input type="password" class="form-control" name="senha2" placeholder="Repita sua senha..."
                       value="<?php echo isset($_POST['senha2']) ? $_POST['senha2'] : '' ?>">
                <span class="text-danger"><?php echo $msg[3]; ?></span>
                <br>
                <label class="form-label">Pergunta de segurança:</label>
                <select class='form-select' name="pergunta">
                    <option value='0' selected>Selecione a pergunta...</option>
                    <?php
                    $pergunta = new Pergunta();
                    $retorno = $pergunta->BuscarTodasPerguntas();
                    if (is_array($retorno)) {
                        foreach ($retorno as $dado) {
                            echo "<option value='{$dado->id_pergunta}'>{$dado->descritivo}</option>";
                        }
                    }
                    ?>
                </select>
                <br>
                <label class="form-label">Resposta de segurança:</label>
                <input type="text" name="resposta" class="form-control" placeholder="Digite a resposta de segurança..."
                       name="resposta" value="<?php echo isset($_POST['resposta']) ? $_POST['resposta'] : '' ?>">
            </div>
            <div id="config-img" class="d-flex justify-content-start align-items-center flex-column">
                <h3 class="h3 txt-roxo mb-4">Alterar imagem</h3>
                <label for="input-img" id="label-img" class="rounded-circle mb-4">
                    <img src=
                         <?php
                         $dados = $usuario->BuscarPerfilUsuario();
                         echo $dados[0]->img_path;
                         ?>
                         id="perfil-img" class="border border-4 border-primary rounded-circle">
                    <span id="alterar-img">Alterar<br>Imagem</span>
                </label>
                <input id="input-img" type="file" class="form-control" name='img_usuario'>
                <br>
                <span class="text-danger"><?php echo $msg[0] ?></span>
            </div>
        </div>
        <input type="reset" value="Redefinir" class="btn btn-danger">
        <input type="submit" value="Enviar" class="btn btn-success">
    </form>
</main>
<footer id="reduc-footer"></footer>
<!-- Bootstrap JavaScript Libraries -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
        crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz"
        crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="assets/js/func.js"></script>
</body>

</html>