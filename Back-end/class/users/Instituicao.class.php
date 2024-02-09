<?php

class Instituicao extends Conexao
{
    public function __construct(
        private int    $id_instituicao = 0,
        private string $descritivo = "",
        private array  $usuario = array()
    )
    {
        parent:: __construct();
    }

    //set methods
    public function setIdInstituicao($id)
    {
        $this->id_instituicao = $id;
    }

    public function setDescritivo($descritivo)
    {
        $this->descritivo = $descritivo;
    }

    public function setUsuario($usuario)
    {
        $this->usuario[] = $usuario;
    }

    //get methods
    public function getIdInstituicao()
    {
        return $this->id_instituicao;
    }

    public function getDescritivo()
    {
        return $this->descritivo;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function BuscarInstituicao()
    {
        $sql = "SELECT * FROM instituicao WHERE id_instituicao = ?";
        $stm = $this->db->prepare($sql);
        $stm->bindValue(1, $this->id_instituicao);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

    public function BuscarTodasInstituicoes()
    {
        $sql = "SELECT * FROM instituicao";
        $stm = $this->db->prepare($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }
}