<?php


if (isset($_POST)) {
  $nome = $_POST['nome'];
  $sobrenome = $_POST['sobrenome'];
  $nomeUsuario = $_POST['username'];
  $cpf = $_POST['cpf'];
  $email = $_POST['email'];
  if (isset($_POST['senha1'])) {
    $senha = $_POST['senha1'];
    $password_hash = password_hash($senha, PASSWORD_DEFAULT);
  }
  if (isset($_POST['pergunta'])) {
    $pergunta = $_POST['pergunta'];
    $pergunta_int = intval($pergunta);
  }
  
  $resposta = $_POST['resposta'];
  $instituição = $_POST['instituicao'];
  $categoria = $_POST['categoria'];
  // if ($categoria === 'aluno') {
  //   $categoria = 2;
  // } elseif ($categoria === 'professor') {
  //   $categoria = 3;
  // } else {
  //   echo 'Algo deu errado!';
  //   $categoria = 'NADA!';
  // } 
  
}

var_dump($_POST['categoria']);

echo '<pre>';
var_dump($_POST);
echo '<pre>';

function Cadastro(){
    echo 'teste';
}

