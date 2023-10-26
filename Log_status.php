<?php
    if(!isset($_SESSION)) session_start();

    if ($_SESSION['log'] == 1) {
  
      $logado = $_SESSION['login'] = true;    
      $json = json_encode($logado);
      echo $json;
  
      if ($_SESSION['userstatus'] == 0) {
        session_destroy();
      }
  
    } else {
      session_destroy();
    }
?>