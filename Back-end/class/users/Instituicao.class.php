<?php
class Instituicao{
    public function __construct(
        private int $id_instituicao = 0,
        private string $descritivo = "",
        private array $usuario = array()
    ){}

    //set methods
    public function setIdInstituicao($id){
        $this->id_instituicao = $id;
    }
    public function setDescritivo($descritivo){
        $this->descritivo = $descritivo;
    }
    public function setUsuario($usuario){
        $this->usuario[] = $usuario;
    }

    //get methods
    public function getIdInstituicao(){
        return $this->id_instituicao ;
    }
    public function getDescritivo(){
        return $this->descritivo ;
    }
    public function getUsuario(){
        return $this->usuario ;
    }
}