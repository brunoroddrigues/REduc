<?php
  require_once("Back-end/class/conexao/Conexao.class.php");
  require_once("Back-end/class/recursos/DisciplinasDAO.class.php");
  require_once("Back-end/class/recursos/Disciplinas.class.php");

  if (!isset($_SESSION)) session_start();

  if ($_SESSION["categoria"] != 3) {
      header("location: index.php");
      die();
  }

  if ($_GET["disciplina"]) {
    $disciplina = new Disciplina(disciplina: $_GET['disciplina']);
    $disciplinaDAO = new DisciplinaDAO();
    $disciplinaDAO->inserirDisciplina($disciplina);
    header("location: adm.php");
    die();
  } else {
    header("location: index.php");
  }
?>