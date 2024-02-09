<?php

class AreaConhecimento
{
    public function __construct(
        private int    $id_areaconhecimento = 0,
        private string $area = "",
        private string $codarea = "",
        private array  $recurso = array()
    )
    {
    }

    public function setId($id)
    {
        $this->id_areaconhecimento = $id;
    }

    public function setArea($area)
    {
        $this->area = $area;
    }

    public function setCod($codarea)
    {
        $this->codarea = $codarea;
    }

    public function setRecurso($recurso)
    {
        $this->recurso[] = $recurso;
    }

    public function getId()
    {
        return $this->id_areaconhecimento;
    }

    public function getArea()
    {
        return $this->area;
    }

    public function getCod()
    {
        return $this->codarea;
    }

    public function getRecurso()
    {
        return $this->recurso;
    }
}

/* Testando */

// $areateste = new AreaConhecimento();
// $areateste->setId(10);
// $areateste->setArea('Ciência da Computação');
// $areateste->setCod('10300007');

// echo '<pre>';
// var_dump($areateste);
// echo '</pre>';