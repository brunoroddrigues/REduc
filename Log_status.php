<?php

  if(!isset($_SESSION)) session_start();

  $resposta = array();

  if (!empty($_SESSION)) {
    $resposta['img'] = $_SESSION['perfil'];
    $resposta['status'] = true; 
  } else {
    $resposta['status'] = false;
  }

  echo json_encode($resposta);
?>