<?php

  if(!isset($_SESSION)) session_start();

  if (!empty($_SESSION)) {
    $logado = true; 
  } else {
    $logado = false;
  }
  echo json_encode($logado);
?>