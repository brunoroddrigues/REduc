<?php
class CursoDAO extends Conexao {
  public function __contruct(){
    parent:: __construct();
  }

  public function inserirCurso($curso){
		$sql = "INSERT INTO cursos (descritivo) VALUES (?)";
		$stm = $this->db->prepare($sql);
		$stm->bindValue(1, $curso->getCurso());
		$stm->execute();
    $this->db = null;
	}
}
?>