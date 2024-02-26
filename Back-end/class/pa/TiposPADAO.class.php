<?php
  class TipoPADAO extends Conexao {
    public function __contruct(){
      parent:: __construct();
    }

    public function inserirTipo($tipo){
      $sql = "INSERT INTO tipos_pa(descritivo) VALUES (?)";
      $stm = $this->db->prepare($sql);
      $stm->bindValue(1, $tipo->getDescritivo());
      $stm->execute();
      $this->db = null;
    }
  } 
?>