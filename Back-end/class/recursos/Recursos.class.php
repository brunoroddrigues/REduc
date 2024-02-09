<?php
// require_once '../conexao/Conexao.class.php';

class Recursos extends Conexao
{
    public function __construct(
        private int    $id_recurso = 0,
        private string $titulo = "",
        private string $descricao = "",
        private string $datacadastro = "",
        private string $link_img = "",
        private string $link_artigo = "",
        private string $link_video = "",
        private int    $status = 0,
        private int    $nota = 0,
        private array  $disciplina = array(),
        private        $ferramenta = null,
        private array  $curso = array(),
        private        $categoria = null,
        private array  $area = array(),
        private        $usuario = null
    )
    {
        parent:: __construct();
    }

    // metodos set
    public function setIdRecurso($id)
    {
        $this->id_recurso = $id;
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

    public function setArtigo($artigo)
    {
        $this->link_artigo = $artigo;
    }

    public function setVideo($video)
    {
        $this->link_video = $video;
    }

    public function setDisciplina($disciplina)
    {
        $this->disciplina[] = $disciplina;
    }

    public function setCurso($curso)
    {
        $this->curso[] = $curso;
    }

    public function setArea($area)
    {
        $this->area[] = $area;
    }

    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;
    }

    public function setFerramenta($ferramenta)
    {
        $this->ferramenta = $ferramenta;
    }

    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    public function setNota($nota)
    {
        $this->nota = $nota;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    //metodos get
    public function getId()
    {
        return $this->id_recurso;
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

    public function getArtigo()
    {
        return $this->link_artigo;
    }

    public function getVideo()
    {
        return $this->link_video;
    }

    public function getDisciplina()
    {
        return $this->disciplina;
    }

    public function getCurso()
    {
        return $this->curso;
    }

    public function getArea()
    {
        return $this->area;
    }

    public function getCategoria()
    {
        return $this->categoria;
    }

    public function getFerramenta()
    {
        return $this->ferramenta;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function getNota()
    {
        return $this->nota;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function cadastrarRecursoVideo($id_usuario)
    {
        $sql = "CALL proc_CadastroRecursoVideo(?, ?, ?, ?, ?, ?, ?, @id_inserido)";
        $stm = $this->db->prepare($sql);
        $stm->bindValue(1, $this->titulo);
        $stm->bindValue(2, $this->descricao);
        $stm->bindValue(3, $this->link_video);
        $stm->bindValue(4, $id_usuario);
        $stm->bindValue(5, $this->link_img);
        $stm->bindValue(6, $this->categoria->getIdCategoria());
        $stm->bindValue(7, $this->ferramenta->getIdFerramenta());
        $stm->execute();
        $id = $this->db->query("SELECT @id_inserido")->fetchColumn();

        return $id;
    }

    public function cadastrarRecursoArtigo($id_usuario)
    {
        $sql = "CALL proc_CadastroRecursoArtigo(?, ?, ?, ?, ?, ?, ?, @id_inserido)";
        $stm = $this->db->prepare($sql);
        $stm->bindValue(1, $this->titulo);
        $stm->bindValue(2, $this->descricao);
        $stm->bindValue(3, $this->link_artigo);
        $stm->bindValue(4, $id_usuario);
        $stm->bindValue(5, $this->link_img);
        $stm->bindValue(6, $this->categoria->getIdCategoria());
        $stm->bindValue(7, $this->ferramenta->getIdFerramenta());
        $stm->execute();
        $id = $this->db->query("SELECT @id_inserido")->fetchColumn();

        return $id;
    }

    public function buscarRecurso($codigo)
    {
        $sql = "CALL proc_apresentacaoRecurso(?, ?)";
        $stm = $this->db->prepare($sql);
        $stm->bindValue(1, $this->id_recurso);
        $stm->bindValue(2, $codigo);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

    public function recursos4($codigo)
    {
        $sql = "CALL proc_BuscarQuatroRecursos(?)";
        $stm = $this->db->prepare($sql);
        $stm->bindValue(1, $codigo);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

    public function recursosTodos($codigo)
    {
        $sql = "CALL proc_buscarTodosRecursos(?)";
        $stm = $this->db->prepare($sql);
        $stm->bindValue(1, $codigo);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

    public function buscarRecursosNaoPostados()
    {
        $sql = "CALL proc_buscarRecursosNaoPostados()";
        $stm = $this->db->prepare($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

    public function ativar($codigo)
    {
        $sql = "CALL proc_ativar_recurso_adm(?)";
        $stm = $this->db->prepare($sql);
        $stm->bindValue(1, $codigo);
        $stm->execute();
        $this->db = null;
    }

    public function reprovar($codigo)
    {
        $sql = "CALL proc_reprovar_recurso_adm(?)";
        $stm = $this->db->prepare($sql);
        $stm->bindValue(1, $codigo);
        $stm->execute();
        $this->db = null;
    }

    public function PuxarComentarios()
    {
        $sql = "CALL proc_PuxarComentarios(?)";
        $stm = $this->db->prepare($sql);
        $stm->bindValue(1, $this->id_recurso);
        $stm->execute();

        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

    public function PesquisarRecurso($id_usuario, $pesquisa)
    {
        $sql = "CALL proc_pesquisaRecursos(?, ?)";
        $stm = $this->db->prepare($sql);
        $stm->bindValue(1, $id_usuario);
        $stm->bindValue(2, $pesquisa);
        $stm->execute();

        return $stm->fetchAll(PDO::FETCH_OBJ);
    }
}

