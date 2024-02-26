<?php
  class DisciplinaDAO extends Conexao {
    public function __contruct(){
      parent:: __construct();
    }
  
    public function inserirDisciplina($disciplina){
      $sql = "INSERT INTO disciplinas (descritivo) VALUES (?)";
      $stm = $this->db->prepare($sql);
      $stm->bindValue(1, $disciplina->getDisciplina());
      $stm->execute();
      $this->db = null;
    }
  }
?>