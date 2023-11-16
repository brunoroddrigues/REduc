<?php
  if(!isset($_SESSION)) session_start();

  if (!$_SESSION['id_usuario']) {
    header('location:index.php');
    die();
  } else {
    require_once "Back-end/class/usersRequire.php";
    $usuario = new Usuario(id_usuario: $_SESSION['id_usuario']);
  }
?>

<!doctype html>
<html lang="pt-br">

<head>
  <title>REduc - configurações</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <link rel="stylesheet" href="./assets/css/style.css">
  <link rel="stylesheet" href="./assets/css/config.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <script defer type="module" src="assets/js/componentes.js"></script>
  
</head>

<body>
  <header id="reduc-header"></header>
  <main>
    <form id="config-form" class="container shadow rounded bg-light my-5 p-5">
        <h2 id="titulo" class="h2 txt-roxo d-flex justify-content-between">Alterar configurações de conta<a href="meuPerfil.html" id="voltar"><i class="bi bi-arrow-left"></i>Voltar</a></h2>
        <hr class="mb-5">
        <div id="campos" class="mb-5">
            <div id="config-dados">
                <h3 class="h3 txt-roxo mb-5">Dados da conta</h3>
                <label class="form-label">Nome de usuário:</label>
                <input type="text" class="form-control" name="" placeholder="Digite o novo nome de usuário...">
                <br>
                <label class="form-label">Nome:</label>
                <input type="text" class="form-control" name="" placeholder="Digite o novo nome...">
                <br>
                <label class="form-label">Sobrenome:</label>
                <input type="text" class="form-control" name="" placeholder="Digite o novo sobrenome...">
                <br>
                <label class="form-label">E-mail</label>
                <input type="email" class="form-control" name="" placeholder="Digite o novo e-mail...">
                <br>
                <label class="form-label">Bio:</label>
                <textarea id="input-bio" class="form-control" placeholder="Digite a nova BIO..."></textarea>
                <br>
                <label class="form-label">Data de nascimento:</label>
                <input type="date" class="form-control" name="">
                <br>
                <label class="form-label">Currículo Lattes:</label>
                <input type="url" class="form-control" name="" placeholder="Insira o link do Lattes...">
                <br>
                <label class="form-label">Área de atuação:</label>
                <input type="text" name="" class="form-control" placeholder="Digite a área de atuação...">
                <br>
                <label class="form-label">Senha:</label>
                <input type="password" class="form-control" name="" placeholder="Digite sua nova senha...">
                <br>
                <label class="form-label">Repita a senha:</label>
                <input type="password" class="form-control" name="" placeholder="Repita sua senha...">
                <br>
                <label class="form-label">Pergunta de segurança:</label>
                <select class='form-select'>
                    <option selected>Selecione a pergunta...</option>
                </select>
                <br>
                <label class="form-label">Resposta de segurança:</label>
                <input type="text" name="" class="form-control" placeholder="Digite a resposta de segurança...">
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
                <input id="input-img" type="file" class="form-control">
            </div>
        </div>
        <input type="reset" value="Redefinir" class="btn btn-danger">
        <input type="submit" value="Enviar" class="btn btn-success">
    </form>
  </main>
  <footer id="reduc-footer"></footer>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</body>

</html>