<?php
  require_once "Back-end/class/usersRequire.php";

  if(!isset($_SESSION)) session_start();

  if (isset($_SESSION['id_usuario'])) {
    header('location:index.php');
    die();
  }

  $msgErro = "";

  if (isset($_GET['erro'])) {
    $msgErro = "NOME DE USUÁRIO, EMAIL OU CPF JÁ CADASTRADOS";
  }

  if ($_POST) {
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $nomeUsuario = $_POST['username'];
    $datanascimento = $_POST['data_nascimento'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $senha = $_POST['senha1'];
    $password_hash = md5($senha);
    $pergunta = new Pergunta(id_pergunta: $_POST['pergunta']);
    $resposta = $_POST['resposta'];
    $instituicao = new Instituicao(id_instituicao: $_POST['instituicao']);
    $categoria = new CategoriaUsuario(id_categoria: $_POST['categoria']);
    if ($_POST['categoria'] == 2) {
      $lattes = $_POST['linkLattes'];
      $areaatuacao = $_POST['area'];
      $usuario = new Usuario(nome:$nome, sobrenome: $sobrenome, nomeUsuario: $nomeUsuario, dataNascimento: $datanascimento, cpf: $cpf, email: $email, senha: $password_hash, pergunta: $pergunta, resposta: $resposta, lattes: $lattes, areaAtuacao: $areaatuacao, categoria: $categoria, instituicao: $instituicao, status: 0);
      try {
        $usuario->CadastrarProfessor();
        header("location:login.php");
      } catch (PDOException $e) {
        header("location:cadastro.php");
      }
    }
    if ($_POST['categoria'] == 1) {
      $usuario = new Usuario(nome:$nome, sobrenome: $sobrenome, nomeUsuario: $nomeUsuario, dataNascimento: $datanascimento, cpf: $cpf, email: $email, senha: $password_hash, pergunta: $pergunta, resposta: $resposta, categoria: $categoria, instituicao: $instituicao, status: 1);
      try {
        $usuario->CadastrarAluno();
        header("location:login.php");
      } catch (PDOException $e) {
        header("location:cadastro.php?erro=1");
      }
    } 
  }  
?>

<!doctype html>
<html lang="pt-br">
<head>
  <title>Cadastro</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel='stylesheet' href='assets/css/cadastro.css'>

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  <!-- Scripts -->
  <script defer src="assets/js/cadastro.js"></script>
  <script defer src="assets/js/func.js"></script>
  <script defer type="module" src="assets/js/componentes.js"></script>

</head>

<body onload="carregarForm()">
  <header id='reduc-header'></header>
  <main>
    <div class='container rounded shadow p-5 my-5 cadastrar'>
      <div class='row'>
        <form method='POST' action='#' id='form-cadastro' class='col-lg-6 d-flex flex-column justify-content-between'>
          <span class="text-danger"><?php echo $msgErro ?></span> 
          <h2 class='h2'>Cadastrar usuário</h2>

          <!-- 1. Categoria do usuário -->
          <div class='cat-user d-none'>
            <h3 class='h3 text-light'>Categoria de usuário</h3><br>
            <input type='radio' name='categoria' id='aluno'  required="true">
            <label for='aluno' class='radio-button-label' id="label_aluno">Aluno</label>
            <input type='radio' name='categoria' id='professor' >
            <label for='professor' class="radio-button-label" id="label_professor">Professor</label>
            <span id = 'error_cat-user' class="text-danger"></span>
          </div>

          <!-- 2. Dados pessoais -->
          <div class='dados-pessoais d-none'>
            <h3 class='h3 text-light'>Dados pessoais</h3>
            <label>Nome de usuário:</label>
            <br>
            <input type='text' name='username' id="username" class='form-control' placeholder='Digite seu nome de usuário.'>
            <br>
            <span id="error_username" class="text-danger"></span>
            <label>Nome:</label>
            <br>
            <input type='text' name='nome' id="nome" class='form-control' placeholder='Digite seu nome.'>
            <br>
            <span id="error_nome" class="text-danger"></span>
            <label>Sobrenome:</label>
            <br>
            <input type='text' name='sobrenome' id="sobrenome" class='form-control' placeholder='Digite seu sobrenome'>
            <br>
            <span id="error_sobrenome" class="text-danger"></span>
            <label>E-mail:</label>
            <br>
            <input type='email' name='email' id="email" class='form-control' placeholder='Digite seu email.'>
            <br>
            <span id="error_email" class="text-danger"></span>
            <label>CPF:</label>
            <br>
            <input type='text' maxlength="14" name='cpf' id="cpf" class='form-control' placeholder='Digite seu CPF.'>
            <br>
            <span id="error_cpf" class="text-danger"></span>
            <label>Data de Nascimento:</label>
            <br>
            <input type='date' name='data_nascimento' id="data_nascimento" class='form-control' placeholder='Digite sua data de nascimento.'>
            <br>
            <span id="error_data" class="text-danger"></span>
          </div>

          <!-- 3. Dados institucionais -->
          <div class='institucional d-none'>
            <h3 class='h3 text-light'>Informações institucionais</h3>
            <label>Instituição:</label>
            <br> 
            <select class="form-select" name="instituicao" id="instituicao">
              <option value='0' selected>Qual a sua instituição</option>
              <?php
                require_once 'Back-end/class/conexao/Conexao.class.php';
                require_once 'Back-end/class/users/Instituicao.class.php';
                $instituicao = new Instituicao();
                $retorno = $instituicao->BuscarTodasInstituicoes();
                if (is_array($retorno)) {
                  foreach ($retorno as $dado) {
                    echo "<option value='{$dado->id_instituicao}'>{$dado->descritivo}</option>";
                  }
                }
              ?>
            </select>
            <span id="error_inst" class="text-danger"></span>
          </div>

          <!-- 4. Dados de segurança -->
          <div class='seguranca d-none'>
            <h3 class='h3 text-light'>Segurança</h3>
            <label>Digite a senha:</label>
            <br>
            <input type='password' name='senha1' id="senha1" class='form-control' placeholder='Digite a senha.'>
            <br>
            <span id="error_senha1" class="text-danger"></span>
            <label>Repita a senha:</label>
            <br>
            <input type='password' name='senha2' id="senha2" class='form-control' placeholder='Repita a senha.'>
            <br>
            <span id="error_senha2" class="text-danger"></span>
            <span id="error_diferentesenha" class="text-danger"></span>
            <label>Pergunta de segurança:</label>
            <br>
            <select class='form-select' name="pergunta" id="pergunta">
              <option value ='0' selected>Escolha a pergunta de segurança</option>
              <?php
                require_once 'Back-end/class/conexao/Conexao.class.php';
                require_once 'Back-end/class/users/Pergunta.class.php';
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
            <span id="error_pergunta" class="text-danger"></span>
            <label>Resposta de segurança:</label>
            <br>
            <input type='text' name='resposta' id="resposta" class='form-control' placeholder='Digite a resposta de segurança.'>
            <br>
            <span id="error_resposta" class="text-danger"></span>
          </div>
          <br>
          <!-- Btns de controle -->
          <div class='btns-controle'>
            <button class='btn btn-danger btn-controle'>Voltar</button>
            <button class='btn btn-success btn-controle'>Avançar</button>
            <button type='submit' class='btn btn-success d-none btn-controle'>Cadastrar</button>
          </div>
        </form>

        <figure class='col-lg-6 d-flex justify-content-center align-items-center'>
          <img src="img/cadastro-img.svg" alt="Imagem background" class='w-100 p-5 img-cadastro'>
        </figure>
      </div>
    </div>
  </main>
  <footer id="reduc-footer"></footer>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</body>

</html>