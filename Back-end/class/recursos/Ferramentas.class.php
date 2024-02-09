<?php

class Ferramenta
{
    public function __construct(
        private int    $id_ferramenta = 0,
        private string $ferramenta = "",
        private array  $recurso = array()
    )
    {
    }

    public function setIdFerrmenta($id)
    {
        $this->id_ferramenta = $id;
    }

    public function setFerramenta($ferramenta)
    {
        $this->ferramenta = $ferramenta;
    }

    public function setRecurso($recurso)
    {
        $this->recurso[] = $recurso;
    }

    public function getIdFerramenta()
    {
        return $this->id_ferramenta;
    }

    public function getFerramenta()
    {
        return $this->ferramenta;
    }

    public function getRecurso()
    {
        return $this->recurso;
    }
}

/* Testando */

// $ferramentateste = new Ferramenta();
// $ferramentateste->setIdFerramenta(10);
// $ferramentateste->setFerramenta('Javascript');

// echo "<pre>";
// var_dump($ferramentateste);
// echo "</pre>";