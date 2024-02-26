<?php

class Curso
{
    public function __construct(
        private int    $id_curso = 0,
        private string $curso = "",
        private array  $recurso = array()
    )
    {
    }

    public function setIdCurso($id)
    {
        $this->id_curso = $id;
    }

    public function setCurso($curso)
    {
        $this->curso = $curso;
    }

    public function setRecurso($recurso)
    {
        $this->recurso[] = $recurso;
    }

    public function getIdCurso()
    {
        return $this->id_curso;
    }

    public function getCurso()
    {
        return $this->curso;
    }

    public function getRecurso()
    {
        return $this->recurso;
    }
}



