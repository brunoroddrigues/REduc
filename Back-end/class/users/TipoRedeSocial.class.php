<?php
class TipoRedeSocial{
    public function __construct(
        private int $id_tiporedesocial = 0,
        private string $descritivo = ""
    ){}

    // set methods
    public function setIdTipo($id_tiporedesocial){
        $this->id_tiporedesocial = $id_tiporedesocial;
    }
    public function setDescritivo($descritivo){
        $this->descritivo = $descritivo;
    }

    //get methods
    public function getIdTipo(){
        return $this->id_tiporedesocial;
    }
    public function getDescritivo(){
        return $this->descritivo;
    }
}