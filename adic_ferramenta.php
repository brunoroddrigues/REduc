<?php
  require_once("Back-end/class/conexao/Conexao.class.php");
  require_once("Back-end/class/recursos/FerramentasDAO.class.php");
  require_once("Back-end/class/recursos/Ferramentas.class.php");

  if (!isset($_SESSION)) session_start();

  if ($_SESSION["categoria"] != 3) {
      header("location: index.php");
      die();
  }

  if ($_GET["ferramenta"]) {
    $ferramenta = new Ferramenta(ferramenta: $_GET['ferramenta']);
    $ferramentaDAO = new FerramentaDAO();
    $ferramentaDAO->inserirFerramenta($ferramenta);
    header("location: adm.php");
    die();
  } else {
    header("location: index.php");
  }
?>