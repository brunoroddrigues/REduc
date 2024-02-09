<?php
require_once 'TipoRedeSocial.class.php';

class RedeSocial extends Conexao
{
    public function __construct(
        private int    $id_redesocial = 0,
        private        $tiporede = null,
        private string $link = ""
    )
    {
        parent:: __construct();
    }

    //set methods
    public function setIdRede($id_redesocial)
    {
        $this->id_redesocial = $id_redesocial;
    }

    public function setTipo($tiporede)
    {
        $this->tiporede = $tiporede;
    }

    public function setLink($link)
    {
        $this->link = $link;
    }

    //get methods
    public function getIdRede()
    {
        return $this->id_redesocial;
    }

    public function getTipo()
    {
        return $this->tiporede;
    }

    public function getLink()
    {
        return $this->link;
    }

    public function BuscarRedesocial()
    {
        $sql = "SELECT * FROM user_redesocial WHERE id_userrede = ?";
        $stm = $this->db->prepare($sql);
        $stm->bindValue(1, $this->id_redesocial);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

    public function AdicionarRedeSocial($id_usuario)
    {
        $sql = "CALL proc_AdicionarRedeSocial(?, ?, ?)";
        $stm = $this->db->prepare($sql);
        $stm->bindValue(1, $id_usuario);
        $stm->bindValue(2, $this->id_redesocial);
        $stm->bindValue(3, $this->link);
        $stm->execute();
    }

}