<?php






if (isset($_POST)) {
  $nome = $_POST['nome'];
  $sobrenome = $_POST['sobrenome'];
  $nomeUsuario = $_POST['username'];
  $cpf = $_POST['cpf'];
  $email = $_POST['email'];
  $senha = $_POST['senha1'];
  $pergunta = $_POST['pergunta'];
  $resposta = $_POST['resp'];
  $instituição = $_POST['instituicao'];
  $categoria = $_POST['categoria'];
  if ($categoria === 'aluno') {
    $categoria = 2;
  } elseif ($categoria === 'professor') {
    $categoria = 3;
  } else {
    echo 'Algo deu errado!';
    $categoria = 'NADA!';
  } 
  
}
echo $categoria . '<br><br>';


echo '<pre>';
var_dump($_POST);
echo '<pre>';

function Cadastro(){
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $nomeUsuario = $_POST['username'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $senha = $_POST['senha1'];
    $pergunta = $_POST['pergunta'];
    $resposta = $_POST['resp'];
    $instituição = $_POST['instituicao'];
    if (isset($_POST['categoria'])) {
        $categoria = $_POST['categoria'];
        if ($categoria === 'aluno') {
          echo 'Você escolheu aluno!';
        } else {
          echo 'Você escolheu professor!';
        }
    }
    
}