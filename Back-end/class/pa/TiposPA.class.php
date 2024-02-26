<?php

class TipoPA
{
    public function __construct(
        private int    $id_tipo = 0,
        private string $descritivo = "",
        private array  $pa = array()
    )
    {}

    public function setIdTipo($id)
    {
        $this->id_tipo = $id;
    }

    public function setDescritivo($descritivo)
    {
        $this->descritivo = $descritivo;
    }

    public function setPA($pa)
    {
        $this->pa[] = $pa;
    }

    public function getIdTipo()
    {
        return $this->id_tipo;
    }

    public function getDescritivo()
    {
        return $this->descritivo;
    }

    public function getPA()
    {
        return $this->pa;
    }
}

