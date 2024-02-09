<?php

class CategoriaRecurso
{
    public function __construct(
        private int    $id_categoria = 0,
        private string $categoria = "",
        private array  $recurso = array()
    )
    {
    }

    public function setIdCategoria($id)
    {
        $this->id_categoria = $id;
    }

    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;
    }

    public function setRecurso($recurso)
    {
        $this->recurso[] = $recurso;
    }

    public function getIdCategoria()
    {
        return $this->id_categoria;
    }

    public function getCategoria()
    {
        return $this->categoria;
    }

    public function getRecurso()
    {
        return $this->recurso;
    }
}

/* Testando */

// $categoriateste = new CategoriaRecurso();
// $categoriateste->setIdCategoria(10);
// $categoriateste->setCategoria('Vídeo');

// echo '<pre>';
// var_dump($categoriateste);
// echo '</pre>';