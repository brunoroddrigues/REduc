<?php
  require_once("Back-end/class/conexao/Conexao.class.php");
  require_once("Back-end/class/recursos/CursosDAO.class.php");
  require_once("Back-end/class/recursos/Cursos.class.php");

  if (!isset($_SESSION)) session_start();

  if ($_SESSION["categoria"] != 3) {
      header("location: index.php");
      die();
  }

  if ($_GET["curso"]) {
    $curso = new Curso(curso: $_GET['curso']);
    $cursoDAO = new CursoDAO();
    $cursoDAO->inserirCurso($curso);
    header("location: adm.php");
    die();
} else {
    header("location: index.php");
}
?>