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
  }
}

if ($categoria == 2) {
  $usuario = new Usuario(nome:$nome, sobrenome: $sobrenome, nomeUsuario: $nomeUsuario, dataNascimento: $datanascimento, cpf: $cpf, email: $email, senha: $password_hash, pergunta: $pergunta, resposta: $resposta, lattes: $lattes, areaAtuacao: $areaatuacao);

}

// var_dump($lattes);
// echo '<br>';
// var_dump($areaatuacao);
// echo '<br>';
// var_dump($categoria);


echo '<pre>';
var_dump($usuario);
echo '<pre>';

function validateCPF($number) {
  $cpf = preg_replace('/[^0-9]/', "", $number);
  return $cpf;
}

function Cadastro(){
    echo 'teste';
}

