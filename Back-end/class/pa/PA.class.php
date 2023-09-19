<?php
require_once 'TiposPA.class.php';

class PA{
    public function __construct(
        private int $id_pa = 0,
        private string $titulo = "",
        private string $descricao = "",
        private string $datacadastro = "",
        private string $link_img = "",
        private string $link_arquivo = "",
        private int $nota = 0,
        private $tipoPA = null,
        private $usuario = null
    ){}

    public function setIdPA($id){
        $this->id_pa = $id;
    }
    public function setTitulo($titulo){
        $this->titulo = $titulo;
    }
    public function setDescricao($descricao){
        $this->descricao = $descricao;
    }
    public function setDataCadastro($data){
        $this->datacadastro = $data;
    }
    public function setImg($img){
        $this->link_img = $img;
    }
    public function setArquivo($arquivo){
        $this->link_arquivo = $arquivo;
    }
    public function setTipo($tipo){
        $this->tipoPA = $tipo;
    }
    public function setUsuario($usuario){
        $this->usuario = $usuario;
    }
    public function setNota($nota){
        $this->nota = $nota;
    }

    public function getIdPA(){
        return $this->id_pa ;
    }

    public function getTitulo(){
        return $this->titulo ;
    }

    public function getDescricao(){
        return $this->descricao ;
    }

    public function getDataCadastro(){
        return $this->datacadastro ;
    }

    public function getImg(){
        return $this->link_img ;
    }

    public function getArquivo(){
        return $this->link_arquivo ;
    }

    public function getTipo(){
        return $this->tipoPA ;
    }

    public function getUsuario(){
        return $this->usuario ;
    }
    public function getNota(){
        return $this->nota;
    }
}