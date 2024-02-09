<?php
require_once("Back-end/class/paRequire.php");
if ($_GET['id_pa']) {
    $pa = new PA(id_pa: $_GET['id_pa']);
    $pa->AprovarPA();

    header("location: adm.php");
    die();
} else {
    header("location: index.php");
}
?>