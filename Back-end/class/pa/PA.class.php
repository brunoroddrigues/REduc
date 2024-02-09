<?php

class PA extends Conexao
{
    public function __construct(
        private int    $id_pa = 0,
        private string $titulo = "",
        private string $descricao = "",
        private string $datacadastro = "",
        private string $link_img = "",
        private string $link_arquivo = "",
        private int    $nota = 0,
        private        $tipoPA = null,
        private        $usuario = null
    )
    {
        parent:: __construct();
    }

    public function setIdPA($id)
    {
        $this->id_pa = $id;
    }

    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    public function setDataCadastro($data)
    {
        $this->datacadastro = $data;
    }

    public function setImg($img)
    {
        $this->link_img = $img;
    }

    public function setArquivo($arquivo)
    {
        $this->link_arquivo = $arquivo;
    }

    public function setTipo($tipo)
    {
        $this->tipoPA = $tipo;
    }

    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    public function setNota($nota)
    {
        $this->nota = $nota;
    }

    public function getIdPA()
    {
        return $this->id_pa;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function getDataCadastro()
    {
        return $this->datacadastro;
    }

    public function getImg()
    {
        return $this->link_img;
    }

    public function getArquivo()
    {
        return $this->link_arquivo;
    }

    public function getTipo()
    {
        return $this->tipoPA;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function getNota()
    {
        return $this->nota;
    }

    public function PostarPA()
    {
        $sql =
            "INSERT INTO pa (titulo, descricao, datacadastro, arquivo_path, img_pa_path, id_usuario, id_tipo, status)
        VALUES	(?, ?, CURRENT_DATE, ?, ?, ?, ?, 0)";
        $stm = $this->db->prepare($sql);
        $stm->bindValue(1, $this->titulo);
        $stm->bindValue(2, $this->descricao);
        $stm->bindValue(3, $this->link_arquivo);
        $stm->bindValue(4, $this->link_img);
        $stm->bindValue(5, $this->usuario->getIdUsuario());
        $stm->bindValue(6, $this->tipoPA->getIdTipo());
        $stm->execute();
    }

    public function PaNãoPostadas()
    {
        $sql = "CALL proc_buscarPaNaoPostados()";
        $stm = $this->db->prepare($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

    public function AprovarPA()
    {
        $sql = "UPDATE pa SET status = 1 WHERE id_pa = ?";
        $stm = $this->db->prepare($sql);
        $stm->bindValue(1, $this->id_pa);
        $stm->execute();
    }

    public function ReprovarPA()
    {
        $sql = "CALL proc_reprovar_pa_adm(?)";
        $stm = $this->db->prepare($sql);
        $stm->bindValue(1, $this->id_pa);
        $stm->execute();
    }

    public function buscarPA($codigo)
    {
        $sql = "CALL proc_apresentacaoPa(?,?)";
        $stm = $this->db->prepare($sql);
        $stm->bindValue(1, $this->id_pa);
        $stm->bindValue(2, $codigo);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

    public function PesquisarPA()
    {
        $sql = "CALL proc_pesquisarPa(?)";
        $stm = $this->db->prepare($sql);
        $stm->bindValue(1, $this->titulo);
        $stm->execute();

        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

    public function PaTodos()
    {
        $sql = "CALL proc_TodasPa()";
        $stm = $this->db->prepare($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }
}