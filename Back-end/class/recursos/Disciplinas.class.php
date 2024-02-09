<?php

class Disciplina
{
    public function __construct(
        private int    $id_disciplina = 0,
        private string $disciplina = "",
        private array  $recurso = array()
    )
    {
    }

    public function setDisciplina($disciplina)
    {
        $this->disciplina = $disciplina;
    }

    public function setIdDisciplina($id)
    {
        $this->id_disciplina = $id;
    }

    public function setRecurso($recurso)
    {
        $this->recurso[] = $recurso;
    }

    public function getDisciplina()
    {
        return $this->disciplina;
    }

    public function getIdDisciplina()
    {
        return $this->id_disciplina;
    }

    public function getRecurso()
    {
        return $this->recurso;
    }

}

