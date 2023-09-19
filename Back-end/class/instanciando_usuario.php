<?php
require_once ('users/Usuarios.class.php');
require_once ('recursos/Recursos.class.php');

$categoria = new CategoriaUsuario(0, 'Administrador');

$instituicao = new Instituicao(0, 'Fatec-Jahu');

$pergunta = new Pergunta(0, 'Qual o nome do seu cachorro?');

$usuario = new Usuario();

$usuario->setIdUsuario(0);
$usuario->setNomeUsuario('Derek Nunes');
$usuario->setNome('Dérek');
$usuario->setSobrenome('Nunes');
$usuario->setDataNasc('04/02/2002');
$usuario->setEmail('derek.nunes@fatec.sp.gov.br');
$usuario->setCpf('45801149985');
$usuario->setCategoria($categoria);
$usuario->setLattes('http://lattes.cnpq.br/2562967883908634');
$usuario->setInstituicao($instituicao);
$usuario->setSenha('Testandosenha');
$usuario->setPergunta($pergunta);
$usuario->setResposta('Não tenho!');

// Instanciando um recurso para esse usuario

$ferramenta = new Ferramenta(1, 'Javascript');

$disciplina = new Disciplina(1, 'Programação Web');
$disciplina2 = new Disciplina(2, 'Programação de sites');

$curso = new Curso(1, 'Sistemas para Internet');

$categoria = new CategoriaRecurso(2, 'Vídeo');

$area = new AreaConhecimento(1, "Ciência da computação", "10300007");

$recurso = new Recursos();

$recurso->setIdRecurso(1);
$recurso->setTitulo('Programando página web com Javascript');
$recurso->setDescricao('Nessa aula ensinarei a programar uma página web usando Javascript');
$recurso->setDataCadastro("12/09/2023");
$recurso->setVideo("");
$recurso->setArtigo("");
$recurso->setImg("");
$recurso->setDisciplina($disciplina);
$recurso->setDisciplina($disciplina2);
$recurso->setCurso($curso);
$recurso->setArea($area);
$recurso->setCategoria($categoria);
$recurso->setFerramenta($ferramenta);
$recurso->setNota(5);
$recurso->setUsuario($usuario);

// Relacionando o recurso com o user

$usuario->setRecursos($recurso);

echo '<h2>Usuarios e seus Recursos - teste</h2><br>';

echo '<h3>Usuario</h3><br>';
echo "<b>Usuario:</b> {$usuario->getNomeUsuario()}<br>";
echo "<b>Email:</b> {$usuario->getEmail()}<br>";
echo "<b>Lattes:</b> {$usuario->getLattes()}<br>";
echo "<b>Instituição:</b> {$usuario->getInstituicao()->getDescritivo()}<br>";

echo '<h3>Recurso</h3><br>';

foreach ($usuario->getRecursos() as $index => $recurso) {
    echo "<b>Recurso " . $index+1 .":</b><br>";
    echo "<b>Titulo:</b> {$recurso->getTitulo()}<br>";
    echo '<b>Descrição:</b> ' . $recurso->getDescricao() . '<br>';
    echo '<b>Data de Cadastro:</b> ' . $recurso->getDataCadastro() . '<br>';
    echo '<b>link Vídeo (teste):</b> ' . $recurso->getVideo() . '<br>';
    echo '<b>Link Artigo (teste):</b> ' . $recurso->getArtigo() . '<br>';
    echo '<b>Link img (teste):</b> ' . $recurso->getImg() . '<br>';
    echo '<b>Disciplínas:</b> ';
    foreach ($recurso->getDisciplina() as $disciplina) {
        echo $disciplina->getDisciplina() . ', ';
    }
    echo '<br><b>Cursos:</b> ';
    foreach ($recurso->getCurso() as $curso) {
        echo $curso->getCurso() . '<br>';
    }
    echo '<b>Ferramenta:</b>' . $recurso->getFerramenta()->getFerramenta() . '<br>';

    echo '<b>Categoria:</b>' . $recurso->getCategoria()->getCategoria() . '<br>';

    echo '<b>Area Do conhecimento:</b> <br>';
    foreach ($recurso->getArea() as $Area) {
        echo 'Area: ' . $Area->getArea() . '<br>';
        echo 'Código: ' . $Area->getCod() . '<br>';
    }
    echo '<b>Nota:</b> ' . $recurso->getNota() . '<br>';
}

