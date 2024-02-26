<?php
  require_once("Back-end/class/conexao/Conexao.class.php");
  require_once("Back-end/class/pa/TiposPADAO.class.php");
  require_once("Back-end/class/pa/TiposPA.class.php");

  if (!isset($_SESSION)) session_start();

  if ($_SESSION["categoria"] != 3) {
      header("location: index.php");
      die();
  }

  if ($_GET["tpa"]) {
    $tipo = new TipoPA(descritivo: $_GET['tpa']);
    $tipoDAO = new TipoPADAO();
    $tipoDAO->inserirTipo($tipo);
    header("location: adm.php");
    die();
  } else {
    header("location: index.php");
  }
?>