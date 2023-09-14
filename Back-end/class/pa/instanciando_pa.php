<?php
require_once 'PA.class.php';

$tipoPA = new TipoPA(1, 'Rubrica');

$pa = new PA();

$pa->setIdPA(1);

$pa->setTitulo('Avaliação em rubrica para ensino fundamental');

$pa->setDescricao('Uma forma de avaliar turmas do ensino fundamental por meio da avaliação por rubrica');

$pa->setDataCadastro('12/09/2023');

$pa->setImg("");

$pa->setArquivo("");

$pa->setTipo($tipoPA);

$pa->setNota(4);

echo '<h1>PA</h1>';
echo '<b>Título:</b> ' . $pa->getTitulo()  . '<br>';
echo '<b>Descrição:</b> ' . $pa->getDescricao()  . '<br>';
echo '<b>Data de Cadastro:</b> ' . $pa->getDataCadastro()  . '<br>';
echo '<b>Img (teste):</b> ' . $pa->getImg()  . '<br>';
echo '<b>Arquívo (teste):</b> ' . $pa->getArquivo()  . '<br>';
echo '<b>Tipo:</b> ' . $pa->getTipo()->getDescritivo() . '<br>';
echo '<b>Nota:</b> ' . $pa->getNota() . '<br>';

