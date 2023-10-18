<?php
require_once '../class/users/Usuarios.class.php';

if (isset($_POST)) {
  $nome = $_POST['nome'];
  $sobrenome = $_POST['sobrenome'];
  $nomeUsuario = $_POST['username'];
  $datanascimento = $_POST['data_nascimento'];
  if (isset($_POST['cpf'])) {
    $cpf = validateCPF($_POST['cpf']);
  }
  $email = $_POST['email'];
  if (isset($_POST['senha1'])) {
    $senha = $_POST['senha1'];
    $password_hash = password_hash($senha, PASSWORD_DEFAULT);
  }
  $pergunta = intval($_POST['pergunta']);
  $resposta = $_POST['resposta'];
  $instituicao = intval($_POST['instituicao']);
  $categoria = intval($_POST['categoria']);
  if ($categoria == 2) {
    $lattes = $_POST['linkLattes'];
    $areaatuacao = $_POST['area'];
    $categoria_db = ChamarCategoria($categoria);
    $instituicao_db = ChamarInstituicao($instituicao);
    $pergunta_db = ChamarPergunta($pergunta);

    foreach ($categoria_db as $categorias) {
      $categoria_obj = new CategoriaUsuario($categorias->id_categoriaUsuario, $categorias->descritivo);
    }
    foreach ($instituicao_db as $instituicoes) {
      $instituicao_obj = new Instituicao($instituicoes->id_instituicao, $instituicoes->descritivo);
    }
    foreach ($pergunta_db as $perguntas) {
      $pergunta_obj = new Pergunta($perguntas->id_pergunta, $perguntas->descritivo);
    }
    $usuario = new Usuario(nome:$nome, sobrenome: $sobrenome, nomeUsuario: $nomeUsuario, dataNascimento: $datanascimento, cpf: $cpf, email: $email, senha: $password_hash, pergunta: $pergunta_obj, resposta: $resposta, lattes: $lattes, areaAtuacao: $areaatuacao, categoria: $categoria_obj, instituicao: $instituicao_obj);

  }
  if ($categoria == 1) {
    $categoria_db = ChamarCategoria($categoria);
    $instituicao_db = ChamarInstituicao($instituicao);
    $pergunta_db = ChamarPergunta($pergunta);
  
    foreach ($categoria_db as $categorias) {
      $categoria_obj = new CategoriaUsuario($categorias->id_categoriaUsuario, $categorias->descritivo);
    }
    foreach ($instituicao_db as $instituicoes) {
      $instituicao_obj = new Instituicao($instituicoes->id_instituicao, $instituicoes->descritivo);
    }
    foreach ($pergunta_db as $perguntas) {
      $pergunta_obj = new Pergunta($perguntas->id_pergunta, $perguntas->descritivo);
    }
    $usuario = new Usuario(nome:$nome, sobrenome: $sobrenome, nomeUsuario: $nomeUsuario, dataNascimento: $datanascimento, cpf: $cpf, email: $email, senha: $password_hash, pergunta: $pergunta_obj, resposta: $resposta, categoria: $categoria_obj, instituicao: $instituicao_obj);
  
  } 
}

Cadastro($categoria, $usuario);

mostrarUsuarioCadastrado($usuario->getNomeUsuario());


function ChamarCategoria($categoria){
  $parametros = "mysql:host=localhost;dbname=rductest;charset=utf8mb4";
  $conexao = new PDO($parametros, "root", "");
  $sql = "SELECT * FROM categoriaUsuario WHERE id_categoriaUsuario = ?";
  $stm = $conexao->prepare($sql);
  $stm->bindValue(1, $categoria);
  $stm->execute();
  return $stm->fetchALL(PDO::FETCH_OBJ);
}

function ChamarInstituicao($instituicao){
  $parametros = "mysql:host=localhost;dbname=rductest;charset=utf8mb4";
  $conexao = new PDO($parametros, "root", "");
  $sql = "SELECT * FROM instituicao WHERE id_instituicao = ?";
  $stm = $conexao->prepare($sql);
  $stm->bindValue(1, $instituicao);
  $stm->execute();
  return $stm->fetchALL(PDO::FETCH_OBJ);
}

function ChamarPergunta($pergunta){
  $parametros = "mysql:host=localhost;dbname=rductest;charset=utf8mb4";
  $conexao = new PDO($parametros, "root", "");
  $sql = "SELECT * FROM perguntaSeguranca WHERE id_pergunta = ?";
  $stm = $conexao->prepare($sql);
  $stm->bindValue(1, $pergunta);
  $stm->execute();
  return $stm->fetchALL(PDO::FETCH_OBJ);
}

function validateCPF($number) {
  $cpf = preg_replace('/[^0-9]/', "", $number);
  return $cpf;
}

function Cadastro($categoria, $usuario){
  $parametros = "mysql:host=localhost;dbname=rductest;charset=utf8mb4";
  $conexao = new PDO($parametros, "root", "");
  if ($categoria == 1) {
    $sql = "CALL proc_CadastroAluno(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"; 
    $stm = $conexao->prepare($sql);
    $stm->bindValue(1, $usuario->getNome());
    $stm->bindValue(2, $usuario->getSobrenome());
    $stm->bindValue(3, $usuario->getNomeUsuario());
    $stm->bindValue(4, $usuario->getCpf());
    $stm->bindValue(5, $usuario->getDataNasc());
    $stm->bindValue(6, $usuario->getEmail());
    $stm->bindValue(7, $usuario->getSenha());
    $stm->bindValue(8, $usuario->getPergunta()->getIdPergunta());
    $stm->bindValue(9, $usuario->getResposta());
    $stm->bindValue(10, $usuario->getInstituicao()->getIdInstituicao());
    $stm->bindValue(11, $usuario->getCategoria()->getIdCategoria());
    $stm->execute();
  }
  if ($categoria == 2) {
    $sql = "CALL proc_CadastroProfessor(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"; 
    $stm = $conexao->prepare($sql);
    $stm->bindValue(1, $usuario->getNome());
    $stm->bindValue(2, $usuario->getSobrenome());
    $stm->bindValue(3, $usuario->getNomeUsuario());
    $stm->bindValue(4, $usuario->getCpf());
    $stm->bindValue(5, $usuario->getDataNasc());
    $stm->bindValue(6, $usuario->getEmail());
    $stm->bindValue(7, $usuario->getSenha());
    $stm->bindValue(8, $usuario->getLattes());
    $stm->bindValue(9, $usuario->getAreaAtuacao());
    $stm->bindValue(10, $usuario->getPergunta()->getIdPergunta());
    $stm->bindValue(11, $usuario->getResposta());
    $stm->bindValue(12, $usuario->getInstituicao()->getIdInstituicao());
    $stm->bindValue(13, $usuario->getCategoria()->getIdCategoria());
    $stm->execute();
  }
}

function mostrarUsuarioCadastrado($userName) {
  $user = consultarUsuarioCadastrado($userName);
  echo "<table><thead><tr><th>Nome de usuario</th><th>Email</th></tr></thead>";
  echo "<tbody>";
  foreach ($user as $usuario) {
    echo "<tr>
            <td>{$usuario->nomeUsuario}</td>
            <td>{$usuario->email}</td>
          </tr>";
  }
  echo "</tbody></table>";
}

function consultarUsuarioCadastrado($userName) {
  $parametros = "mysql:host=localhost;dbname=rductest;charset=utf8mb4";
  $conexao = new PDO($parametros, "root", "");
  $sql = "SELECT * FROM users WHERE nomeUsuario = ?";
  $stm = $conexao->prepare($sql);
  $stm->bindValue(1, $userName);
  $stm->execute();
  return $stm->fetchALL(PDO::FETCH_OBJ);
}