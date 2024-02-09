<?php

class TipoRedeSocial extends Conexao
{
    public function __construct(
        private int    $id_tiporedesocial = 0,
        private string $descritivo = ""
    )
    {
        parent:: __construct();
    }

    // set methods
    public function setIdTipo($id_tiporedesocial)
    {
        $this->id_tiporedesocial = $id_tiporedesocial;
    }

    public function setDescritivo($descritivo)
    {
        $this->descritivo = $descritivo;
    }

    //get methods
    public function getIdTipo()
    {
        return $this->id_tiporedesocial;
    }

    public function getDescritivo()
    {
        return $this->descritivo;
    }

    public function BuscarTodosTiposRedesocial()
    {
        $sql = "SELECT * FROM redesocial";
        $stm = $this->db->prepare($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }
}