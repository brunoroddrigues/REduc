<?php
class Pergunta{
    public function __construct(
        private int $id_pergunta = 0,
        private string $descritivo = ""
    ){}

    //set methods
    public function setIdPergunta($id){
        $this->id_pergunta = $id;
    }
    public function setDescritivo($descritivo){
        $this->descritivo = $descritivo;
    }

    //get methods
    public function getIdPergunta(){
        return $this->id_pergunta;
    }
    public function getDescritivo(){
        return $this->descritivo;
    }
}