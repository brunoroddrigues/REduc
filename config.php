<?php

  $msg = array("", "", "");

  if(!isset($_SESSION)) session_start();

  if (!$_SESSION['id_usuario']) {
    header('location:index.php');
    die();
  } else {
    require_once "Back-end/class/usersRequire.php";
    $usuario = new Usuario(id_usuario: $_SESSION['id_usuario']);
  }

  if (isset($_POST)) {
    if ($_FILES) {
      $img_usuario = $_FILES['file'];
      $img_nova = explode('.', $img_usuario['name']);

      if ($img_nova[sizeof($img_nova)-1] != 'jpg') {
        $msg[0] = 'Não é possivel salvar esse arquivo, apenas imagens jpg!';
      } else {
        $img_antiga = $usuario->BuscarPerfilUsuario();
        unlink($img_antiga[0]->img_path);

        move_uploaded_file($img_usuario['tmp_name'], 'img/imgUsers/'. $img_usuario['name']);
        $new_path = 'img/imgUsers/'. $img_usuario['name'];

        $usuario->TrocarImg($new_path);

        // Apague os dados do $_POST
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
    <form action="#" method="post" id="config-form" class="container shadow rounded bg-light my-5 p-5" enctype="multipart/form-data">
        <h2 id="titulo" class="h2 txt-roxo d-flex justify-content-between">Alterar configurações de conta<a href="meuPerfil.html" id="voltar"><i class="bi bi-arrow-left"></i>Voltar</a></h2>
        <hr class="mb-5">
        <div id="campos" class="mb-5">
            <div id="config-dados">
                <h3 class="h3 txt-roxo mb-5">Dados da conta</h3>
                <label class="form-label">Nome de usuário:</label>
                <input type="text" class="form-control" name="username" placeholder="Digite o novo nome de usuário..." value="<?php echo isset($_POST['username'])?$_POST['username']:''?>">
                <span class="text-danger"></span>
                <br>
                <label class="form-label">Nome:</label>
                <input type="text" class="form-control" name="nome" placeholder="Digite o novo nome..." value="<?php echo isset($_POST['nome'])?$_POST['nome']:''?>">
                <br>
                <label class="form-label">Sobrenome:</label>
                <input type="text" class="form-control" name="sobrenome" placeholder="Digite o novo sobrenome..." value="<?php echo isset($_POST['sobrenome'])?$_POST['sobrenome']:''?>">
                <br>
                <label class="form-label">E-mail</label>
                <input type="email" class="form-control" name="email" placeholder="Digite o novo e-mail..." value="<?php echo isset($_POST['email'])?$_POST['email']:''?>">
                <br>
                <label class="form-label">Bio:</label>
                <textarea id="input-bio" class="form-control" placeholder="<?php echo isset($_POST['bio'])?$_POST['bio']:'Digite a nova BIO...'?>" name="bio"></textarea>
                <br>
                <label class="form-label">Currículo Lattes:</label>
                <input type="url" class="form-control" name="lattes" placeholder="Insira o link do Lattes..." value="<?php echo isset($_POST['lattes'])?$_POST['lattes']:''?>">
                <br>
                <label class="form-label">Área de atuação:</label>
                <input type="text" name="atuacao" class="form-control" placeholder="Digite a área de atuação..." value="<?php echo isset($_POST['atuacao'])?$_POST['atuacao']:''?>">
                <br>
                <label class="form-label">Senha:</label>
                <input type="password" class="form-control" name="senha" placeholder="Digite sua nova senha..." value="<?php echo isset($_POST['senha'])?$_POST['senha']:''?>">
                <br>
                <label class="form-label">Repita a senha:</label>
                <input type="password" class="form-control" name="senha2" placeholder="Repita sua senha..." value="<?php echo isset($_POST['senha2'])?$_POST['senha2']:''?>">
                <br>
                <label class="form-label">Pergunta de segurança:</label>
                <select class='form-select' name="pergunta">
                    <option selected>Selecione a pergunta...</option>
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
                <input type="text" name="resposta" class="form-control" placeholder="Digite a resposta de segurança..." name="resposta" value="<?php echo isset($_POST['resposta'])?$_POST['resposta']:''?>">
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
                <input id="input-img" type="file" class="form-control" name='file'>
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
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="assets/js/func.js"></script>
</body>

</html>