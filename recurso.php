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
            $retorno = $recurso->buscarRecurso();

            // if(isset($retorno[0]->alerta)) {
            //     header("location: explorar.php");
            //     die();
            // }
        }
    ?>
    <div class="container">
        <video class="mt-5 mb-3" src="<?php echo $retorno[0]->video ?>"></video>
        <section id="avaliacao" class="mb-3">
            <button class="btn bi bi-star p-0"></button>
            <button class="btn bi bi-star p-0"></button>
            <button class="btn bi bi-star p-0"></button>
            <button class="btn bi bi-star p-0"></button>
            <button class="btn bi bi-star p-0"></button>
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
</body>

</html>