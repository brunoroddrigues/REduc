<?php

class CategoriaUsuario extends Conexao
{
    public function __construct(
        private int    $id_categoria = 0,
        private string $descritivo = "",
        private array  $usuario = array()
    )
    {
        parent:: __construct();
    }

    //set methods
    public function setIdCategoria($id)
    {
        $this->id_categoria = $id;
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
    public function getIdCategoria()
    {
        return $this->id_categoria;
    }

    public function getDescritivo()
    {
        return $this->descritivo;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function BuscarCategoria()
    {
        $sql = "SELECT descritivo FROM categoriausuario WHERE id_categoriaUsuario = ?";
        $stm = $this->db->prepare($sql);
        $stm->bindValue(1, $this->id_categoria);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }
}