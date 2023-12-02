<?php
    if(!isset($_SESSION)) session_start();
?>
<!doctype html>
<html lang="pt-br">

<head>
  <title>Recurso</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/recurso.css">
</head>

<body>
  <header id="reduc-header"></header>

  <main>
    <?php
        require_once("Back-end/class/conexao/Conexao.class.php");
        require_once("Back-end/class/recursos/Recursos.class.php");

        if($_GET) {
            $recurso = new Recursos(id_recurso: $_GET["id_recurso"]);
            $codigo = isset($_SESSION["id_usuario"]) ? $_SESSION["id_usuario"] : 0;
            $retorno = $recurso->buscarRecurso($codigo);

            // if(isset($retorno[0]->alerta)) {
            //    echo "
            //         <script>
            //             alert('O código informado não possue recurso!');
            //         </script>
            //    "; 
            //     header("location: explorar.php");
            //     die();
            // }
        }
    ?>
    <div class="container">
        <video class="mt-5 mb-3" src="<?php echo $retorno[0]->video ?>"></video>
        <section id="avaliacao" class="mb-3 d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <img src="" alt="foto do usuário" id="fotoUsuario" class="rounded-circle border border-2">
                <a href="" class="h3 mx-3">Usuario</a>
            </div>
            <section id="nota" class="d-flex align-items-center">
                <div class="mx-3">
                <?php
                    $nota1 = 5 - $retorno[0]->nota;
                    $nota2 = 5 - $nota1;
                    for($i = 0; $i < $nota2; $i++) {
                        echo "<button class='btn bi bi-star-fill p-0'></button>";
                    }
                    for($i = 0; $i < $nota1; $i++) {
                        echo "<button class='btn bi bi-star p-0'></button>";
                    }
                    echo "</div>";
                    if($retorno[0]->favorito == 0) {
                        echo "<button class='btn p-0 card-flag bi-bookmark' onclick='favorito(event, this, {$codigo})''></button>";
                      } else {
                        echo "<button class='btn p-0 card-flag bi-bookmark-fill' onclick='favorito(event, this, {$codigo})''></button>";
                      }
                ?>
            </section>
        </section>
        <section id="descricao">
            <h2><?php echo $retorno[0]->titulo ?></h2>
            <span><?php echo $retorno[0]->data ?></span>
            <article class="my-3 mb-5">
                <?php echo $retorno[0]->descricao ?>
            </article>
        </section>
    </div>
  </main>

  <footer id="reduc-footer"></footer>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>

  <!-- Outros javaScript-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script type="module" src="assets/js/componentes.js"></script>
  <script src="assets/js/func.js"></script>
  <script src="assets/js/card.js"></script>
</body>

</html>