<?php
require_once 'TipoRedeSocial.class.php';    

class RedeSocial{
    public function __construct(
        private int $id_redesocial = 0,
        private $tipo = null,
        private string $link = ""
    ){}

    //set methods
    public function setIdRede($id_redesocial){
        $this->id_redesocial = $id_redesocial;
    }
    public function setTipo($tipo){
        $this->tipo = $tipo;
    }
    public function setLink($link){
        $this->link = $link;
    }

    //get methods
    public function getIdRede(){
        return $this->id_redesocial;
    }
    public function getTipo(){
        return $this->tipo;
    }
    public function getLink(){
        return $this->link;
    }
}