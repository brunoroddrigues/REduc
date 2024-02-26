<?php
  class FerramentaDAO extends Conexao {
    public function __contruct(){
      parent:: __construct();
    }
  
    public function inserirFerramenta($ferramenta){
      $sql = "INSERT INTO ferramentas(descritivo) VALUES (?)";
      $stm = $this->db->prepare($sql);
      $stm->bindValue(1, $ferramenta->getFerramenta());
      $stm->execute();
      $this->db = null;
    }
  }
?>