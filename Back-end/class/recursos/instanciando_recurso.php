<?php
require_once 'Recursos.class.php';

$ferramenta = new Ferramenta(1, 'Javascript');

$disciplina = new Disciplina(1, 'Programação Web');
$disciplina2 = new Disciplina(2, 'Programação de sites');

$curso = new Curso(1, 'Sistemas para Internet');

$categoria = new CategoriaRecurso(2, 'Vídeo');

$area = new AreaConhecimento(1, "Ciência da computação", "10300007");

$recurso = new Recursos();

$recurso->setIdRecurso(1);
$recurso->setTitulo('Pragramando página web com Javascript');
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

echo '<h1>Recurso</h1>';
echo '<b>Título:</b> ' . $recurso->getTitulo()  . '<br>';
echo '<b>Descrição:</b> ' . $recurso->getDescricao() . '<br>';
echo '<b>Data de Cadastro:</b> ' . $recurso->getDataCadastro() . '<br>';
echo '<b>link Vídeo (teste):</b> ' . $recurso->getVideo() . '<br>';
echo '<b>Link Artigo (teste):</b> ' . $recurso->getArtigo() . '<br>';
echo '<b>Link img (teste):</b> ' . $recurso->getImg() . '<br>';
echo '<b>Disciplínas:</b> <br>';
foreach ($recurso->getDisciplina() as $disciplina) {
    echo $disciplina->getDisciplina() . '<br>';
}
echo '<b>Cursos:</b> <br>';
foreach ($recurso->getCurso() as $curso) {
    echo $curso->getCurso() . '<br>';
}
echo '<b>Ferramenta:</b><br>' . $recurso->getFerramenta()->getFerramenta() . '<br>';

echo '<b>Categoria:</b><br>' . $recurso->getCategoria()->getCategoria() . '<br>';

echo '<b>Area Do conhecimento:</b> <br>';
foreach ($recurso->getArea() as $Area) {
    echo 'Area: ' . $Area->getArea() . '<br>';
    echo 'Código: ' . $Area->getCod() . '<br>';
}
echo '<b>Nota:</b> ' . $recurso->getNota() . '<br>';


// $data = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));
// $currentDate = $data->format('Y-m-d');