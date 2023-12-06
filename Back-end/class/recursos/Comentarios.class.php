<?php
class Comentario extends Conexao {
  public function __construct(
    private int $id_comentario = 0,
    private string $comentario = "",
    private string $datacomentario ="",
    private $recurso = null,
    private $usuario = null
  ){
      parent:: __construct();
  }

  public function setIdComentario($id_comentario) {
    $this->id_comentario = $id_comentario;
  }
  public function setComentario($comentario) {
    $this->comentario = $comentario;
  }
  public function setDataComentario($datacomentario) {
    $this->datacomentario = $datacomentario;
  }
  public function setUsuario($usuario) {
    $this->usuario = $usuario;
  }
  public function setRecurso($recurso) {
    $this->recurso = $recurso;
  }

  
}