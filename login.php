<?php
require_once "Back-end/class/conexao/Conexao.class.php";
require_once "Back-end/class/users/Usuarios.class.php";

if (!isset($_SESSION)) session_start();

if (isset($_SESSION['id_usuario'])) {
    header('location:index.php');
    die();
}

$msg = array("", "", "");

if ($_POST) {
    $erro = false;
    if (empty($_POST['email'])) {
        $msg[0] = "Preencha o E-mail";
        $erro = true;
    }
    if (empty($_POST['senha'])) {
        $msg[1] = "Preencha a senha";
        $erro = true;
    }

    if (!$erro) {
        $usuario = new Usuario(email: $_POST['email'], senha: md5($_POST['senha']));
        $retorno = $usuario->verificarUsuario();
        if (is_array($retorno) && count($retorno) > 0) {
            if ($retorno[0]->status != 0) {
                if (!isset($_SESSION)) session_start();
                $_SESSION["id_usuario"] = $retorno[0]->id_usuario;
                $_SESSION["username"] = $retorno[0]->nomeUsuario;
                $_SESSION['categoria'] = $retorno[0]->id_categoriaUsuario;
                $_SESSION['perfil'] = $retorno[0]->img_path;
                header("location: index.php");
                die();
            } else {
                $msg[3] = "USUARIO INATIVO!";
            }
        } else {
            $msg[3] = "E-mail ou senha não conferem!";
        }
    }
}
?>

<!doctype html>
<html lang="pt-br">

<head>
    <title>REduc - login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/cadastro.css">
    <script defer src="assets/js/func.js"></script>
    <script defer type="module" src="assets/js/componentes.js"></script>
</head>

<body>
<header id='reduc-header'></header>
<main>
    <div class='container rounded shadow p-5 my-5 cadastrar'>
        <div class='row'>
            <form method='POST' action='#' id='form-cadastro'
                  class='col-lg-6 d-flex flex-column justify-content-around'>
                <h2 class='h2'>Entrar</h2>
                <!-- Login -->
                <div class='seguranca'>
                    <span class="text-danger"><?php if (!empty($msg[3])) echo $msg[3] ?></span>
                    <br>
                    <label>Digite seu email:</label>
                    <br>
                    <input type="email" name='email' class='form-control' placeholder='Digite seu email...'
                           value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>">
                    <span class="text-danger"><?php echo $msg[0] ?></span>
                    <br>
                    <label>Digite sua senha:</label>
                    <br>
                    <input type='password' name='senha' class='form-control' placeholder='Digite sua senha...'
                           value="<?php echo isset($_POST['senha']) ? $_POST['senha'] : '' ?>">
                    <span class="text-danger"><?php echo $msg[1] ?></span>
                </div>
                <br>
                <!-- Btns de controle -->
                <div class='btns-controle'>
                    <button class='btn btn-danger btn-controle'>Voltar</button>
                    <button type='submit' class='btn btn-success btn-controle'>Entrar</button>
                </div>
            </form>

            <figure class='col-lg-6 d-flex justify-content-center align-items-center'>
                <img src="img/login-img.svg" alt="Imagem background" class='w-100 p-5 img-cadastro'>
            </figure>
        </div>
    </div>
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
</body>

</html>