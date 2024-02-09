<?php

class Comentario extends Conexao
{
    public function __construct(
        private int    $id_comentario = 0,
        private string $comentario = "",
        private string $datacomentario = "",
        private        $recurso = null,
        private        $usuario = null
    )
    {
        parent:: __construct();
    }

    public function setIdComentario($id_comentario)
    {
        $this->id_comentario = $id_comentario;
    }

    public function setComentario($comentario)
    {
        $this->comentario = $comentario;
    }

    public function setDataComentario($datacomentario)
    {
        $this->datacomentario = $datacomentario;
    }

    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    public function setRecurso($recurso)
    {
        $this->recurso = $recurso;
    }

    public function adicionarComentario()
    {
        $sql = "CALL proc_adicionarComentario(?, ?, ?)";
        $stm = $this->db->prepare($sql);
        $stm->bindValue(1, $this->recurso->getId());
        $stm->bindValue(2, $this->usuario->getIdUsuario());
        $stm->bindValue(3, $this->comentario);
        $stm->execute();
    }

    public function DenunciarComentario()
    {
        $sql = "INSERT INTO denuncia_comentario (id_usuario, id_comentario) VALUES (?, ?)";
        $stm = $this->db->prepare($sql);
        $stm->bindValue(1, $this->usuario->getIdUsuario());
        $stm->bindValue(2, $this->id_comentario);
        $stm->execute();
    }

    public function PuxarComentariosDenunciados()
    {
        $sql = "CALL proc_PuxarComentariosDenunciados()";
        $stm = $this->db->prepare($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }
}