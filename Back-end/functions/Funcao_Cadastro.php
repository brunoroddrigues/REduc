<?php
require_once '../class/usersRequire.php';


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
    $password_hash = md5($senha);
  }
  $pergunta = new Pergunta(id_pergunta: intval($_POST['pergunta']));
  $resposta = $_POST['resposta'];
  $instituicao = new Instituicao(id_instituicao: intval($_POST['instituicao']));
  $categoria = new CategoriaUsuario(id_categoria: intval($_POST['categoria']));
  if ($categoria->getIdCategoria() == 2) {
    $lattes = $_POST['linkLattes'];
    $areaatuacao = $_POST['area'];

    $categoria_db = $categoria->BuscarCategoria();
    $instituicao_db = $instituicao->BuscarInstituicao();
    $pergunta_db = $pergunta->BuscarPergunta();

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
  if ($categoria->getIdCategoria() == 1) {
    $categoria_db = $categoria->BuscarCategoria();
    $instituicao_db = $instituicao->BuscarInstituicao();
    $pergunta_db = $pergunta->BuscarPergunta();
  
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
} else {
  header("location:../../index.php");
}

Cadastro($usuario);

function validateCPF($number) {
  $cpf = preg_replace('/[^0-9]/', "", $number);
  return $cpf;
}

function Cadastro($usuario){
  $parametros = "mysql:host=localhost;dbname=rductest;charset=utf8mb4";
  $conexao = new PDO($parametros, "root", "");
  $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  if ($usuario->getCategoria()->getIdCategoria() == 1) {
    try {
      $sql = "CALL proc_CadastroAluno(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"; 
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
      $stm->bindValue(12, 1);
      $stm->execute();

      // Abrindo uma sessão para mandar os dados do usuário pra a página Index
      session_start();
      $_SESSION['username'] = $usuario->getNomeUsuario();
      $_SESSION['senha'] = $usuario->getSenha();
      $_SESSION['log'] = 1;
      header("location:../../index.php");
    } catch (PDOException $e) {
      echo 'Erro: ' . $e->getMessage();
      header("location:../../Cadastro.php");
    }
  }
  if ($usuario->getCategoria()->getIdCategoria() == 2) {
    try {
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
    } catch (PDOException $e) {
      echo 'Erro: ' . $e->getMessage();
    }
  }
}
