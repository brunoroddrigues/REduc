<?php

class Pergunta extends Conexao
{
    public function __construct(
        private int    $id_pergunta = 0,
        private string $descritivo = ""
    )
    {
        parent:: __construct();
    }

    //set methods
    public function setIdPergunta($id)
    {
        $this->id_pergunta = $id;
    }

    public function setDescritivo($descritivo)
    {
        $this->descritivo = $descritivo;
    }

    //get methods
    public function getIdPergunta()
    {
        return $this->id_pergunta;
    }

    public function getDescritivo()
    {
        return $this->descritivo;
    }

    public function BuscarPergunta()
    {
        $sql = "SELECT * FROM perguntaseguranca WHERE id_pergunta = ?";
        $stm = $this->db->prepare($sql);
        $stm->bindValue(1, $this->id_pergunta);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

    public function BuscarTodasPerguntas()
    {
        $sql = "SELECT * FROM perguntaseguranca";
        $stm = $this->db->prepare($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }
}