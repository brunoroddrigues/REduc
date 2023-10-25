<?php
require_once ('conexao/Conexao.class.php');
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

// Instanciando uma rede social e depois relacionando ela ao usuario
$tiporede = new TipoRedeSocial(1, 'Twitter');

$usuario->setRedeSocial(1, $tiporede, 'https://twitter.com/elonmusk');

// Instanciando mais dois usuarios para testar a relação seguir/seguindo

$usuario2 = new Usuario();

$usuario2->setIdUsuario(1);
$usuario2->setNomeUsuario('Nicolas Rissi');
$usuario2->setNome('Nicolas');
$usuario2->setSobrenome('Rissi');
$usuario2->setDataNasc('28/02/2004');
$usuario2->setEmail('nicolas.rissi@fatec.sp.gov.br');
$usuario2->setCpf('42101512274');
$usuario2->setCategoria($categoria);
$usuario2->setLattes('http://lattes.cnpq.br/2562967883908634');
$usuario2->setInstituicao($instituicao);
$usuario2->setSenha('Testandosenha');
$usuario2->setPergunta($pergunta);
$usuario2->setResposta('Não tenho!');

$usuario3 = new Usuario();

$usuario3->setIdUsuario(2);
$usuario3->setNomeUsuario('PedroDomingos');
$usuario3->setNome('Pedro');
$usuario3->setSobrenome('Domingos');
$usuario3->setDataNasc('28/02/2004');
$usuario3->setEmail('pedro.domingos@fatec.sp.gov.br');
$usuario3->setCpf('42101512274');
$usuario3->setCategoria($categoria);
$usuario3->setLattes('http://lattes.cnpq.br/2562967883908634');
$usuario3->setInstituicao($instituicao);
$usuario3->setSenha('Testandosenha');
$usuario3->setPergunta($pergunta);
$usuario3->setResposta('Não tenho!');

// Relacionando os usuarios

$usuario->setSeguidores($usuario2);
$usuario->setSeguidores($usuario3);

$usuario->setSeguindo($usuario2);
$usuario->setSeguindo($usuario3);

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
echo "<b>Redes Social: </b>";
foreach ($usuario->getRedeSocial() as $rede) {
    echo "{$rede->getTipo()->getDescritivo()} - {$rede->getLink()}";
}
echo "<br><b>Seguidores:</b> ";
foreach ($usuario->getSeguidores() as $seguidor) {
    echo " " . $seguidor->getNomeUsuario() . ";";
}
echo "<br><b>Seguindo:</b> ";
foreach ($usuario->getSeguindo() as $seguindo) {
    echo " " . $seguindo->getNomeUsuario() . ";";
}

echo '<br><h3>Recurso</h3><br>';

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


