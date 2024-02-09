<?php
if (!isset($_SESSION)) session_start();

if (!$_GET["id_pa"]) {
    header('location:index.php');
    die();
} else {
    require_once("Back-end/class/paRequire.php");
    require_once("Back-end/functions/func_conexao.php");
    require_once("Back-end/class/usersRequire.php");

    $pa = new PA(id_pa: $_GET["id_pa"]);
    $codigo = isset($_SESSION["id_usuario"]) ? $_SESSION["id_usuario"] : 0;
    $retorno = $pa->buscarPA($codigo);


    if (!empty($_POST['comentario'])) {
        $novoComentario = $_POST['comentario'];
        $usuario = new Usuario(id_usuario: $_SESSION['id_usuario']);
        $newComentario = new Comentario(recurso: $pa, usuario: $usuario, comentario: $novoComentario);
        $newComentario->adicionarComentario();
    }
}
?>
<!doctype html>
<html lang="pt-br">

<head>
    <title><?php echo $retorno[0]->titulo ?></title>
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
    <div class="container">
        <?php
        echo
            "<div class='arquivo bg-light px-1 py-4 rounded shadow my-4 d-flex'>
                <article class='mx-2 ps-3'>
                    <a href='download_arquivo.php?arqpath={$retorno[0]->arquivo}&id_pa={$_GET['id_pa']}' class='h4'><span class='float-end'><button class='bi bi-file-earmark-pdf-fill btn btn-primary ms-3' data-bs-toggle='modal'></button></span></a>
                </article>
                <p>"
            . ($codigo != 0 ? "Fazer download do arquivo" : "Você precisa entrar na sua conta para fazer download do arquivo")
            .
            "</p>
            </div>";
        ?>

        <section id="avaliacao" class="mb-3 d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <img src="<?php echo $retorno[0]->imgu ?>" alt="foto do usuário" id="fotoUsuario"
                     class="rounded-circle border border-2 fotoUsuario">
                <a href='perfil.php?user=<?php echo $retorno[0]->id_usuario ?>'
                   class="h3 mx-3"><?php echo $retorno[0]->usuario ?></a>
            </div>
            <section id="nota" class="d-flex align-items-center">
                <div class="mx-3">
                    <?php
                    if ($codigo != 0) {
                        $AvaliacaoUsuario = ($retorno[0]->nota != 0) ? $retorno[0]->nota : false;
                        if ($AvaliacaoUsuario) {
                            for ($i = 0; $i < 5; $i++) {
                                if ($i <= ($AvaliacaoUsuario - 1)) {
                                    echo "<a href='avaliar_pa.php?ava=" . $i + 1 . "&id_pa=" . $pa->getIdPA() . "&id_usuario=" . $codigo . "'class='btn bi bi-star-fill p-1'></a>";
                                } else {
                                    echo "<a href='avaliar_pa.php?ava=" . $i + 1 . "&id_pa=" . $pa->getIdPA() . "&id_usuario=" . $codigo . "'class='btn bi bi-star p-0'></a>";
                                }

                            }
                        } else {
                            for ($i = 0; $i < 5; $i++) {
                                echo "<a href='avaliar_pa.php?ava=" . $i + 1 . "&id_pa=" . $pa->getIdPA() . "&id_usuario=" . $codigo . "'class='btn bi bi-star p-0'></a>";
                            }
                        }
                        echo "</div>";
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