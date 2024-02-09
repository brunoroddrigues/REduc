<?php
if (!isset($_SESSION)) session_start();

if (!$_GET["id_recurso"]) {
    header('location:index.php');
    die();
} else {
    require_once "Back-end/functions/func_conexao.php";
    require_once "Back-end/class/conexao/Conexao.class.php";
    require_once "Back-end/class/recursos/Recursos.class.php";
    require_once "Back-end/class/recursos/Comentarios.class.php";
    require_once 'Back-end/class/recursos/Disciplinas.class.php';
    require_once 'Back-end/class/recursos/Ferramentas.class.php';
    require_once 'Back-end/class/recursos/Cursos.class.php';
    require_once 'Back-end/class/recursos/CategoriaRecurso.class.php';
    require_once 'Back-end/class/recursos/AreaConhecimento.class.php';
    require_once 'Back-end/class/users/Usuarios.class.php';

    // Buscando o tipo do recurso
    $id_recurso = $_GET["id_recurso"];
    $sql = "SELECT id_tiporecurso FROM recursos WHERE id_recurso = ?";
    $stm = $conn->prepare($sql);
    $stm->bindValue(1, $id_recurso);
    $stm->execute();
    $tiporecurso = $stm->fetchAll(PDO::FETCH_OBJ);

    $recurso = new Recursos(id_recurso: $_GET["id_recurso"]);
    $codigo = $_SESSION["id_usuario"] ?? 0;
    $retorno = $recurso->buscarRecurso($codigo);


    if (!empty($_POST['comentario'])) {
        $novoComentario = $_POST['comentario'];
        $usuario = new Usuario(id_usuario: $_SESSION['id_usuario']);
        $newComentario = new Comentario(recurso: $recurso, usuario: $usuario, comentario: $novoComentario);
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
        if ($tiporecurso[0]->id_tiporecurso == 1) {
            echo
            "<video class='mt-5 mb-3'controls>
                <source src='{$retorno[0]->video}'>
                </video>";
        } else {
            echo
                "<div class='arquivo bg-light px-1 py-4 rounded shadow my-4 d-flex'>
                    <article class='mx-2 ps-3'>
                        <a href='download_arquivo.php?arqpath={$retorno[0]->arquivo}&id_recurso={$_GET['id_recurso']}' class='h4'><span class='float-end'><button class='bi bi-file-earmark-pdf-fill btn btn-primary ms-3' data-bs-toggle='modal'></button></span></a>
                    </article>
                    <p>"
                . ($codigo != 0 ? "Fazer download do arquivo" : "Você precisa entrar na sua conta para fazer download do arquivo")
                .
                "</p>
                </div>";
        }
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
                                    echo "<a href='avaliar_recurso.php?ava=" . $i + 1 . "&id_recurso=" . $recurso->getId() . "&id_usuario=" . $codigo . "'class='btn bi bi-star-fill p-1'></a>";
                                } else {
                                    echo "<a href='avaliar_recurso.php?ava=" . $i + 1 . "&id_recurso=" . $recurso->getId() . "&id_usuario=" . $codigo . "'class='btn bi bi-star p-0'></a>";
                                }

                            }
                        } else {
                            for ($i = 0; $i < 5; $i++) {
                                echo "<a href='avaliar_recurso.php?ava=" . $i + 1 . "&id_recurso=" . $recurso->getId() . "&id_usuario=" . $codigo . "'class='btn bi bi-star p-0'></a>";
                            }
                        }

                        echo "</div>";
                        if ($retorno[0]->favorito == 0) {
                            echo "<a href='favoritar.php?fav=true&id_recurso=" . $recurso->getId() . "&id_usuario=" . $codigo . "'class='btn p-0 card-flag bi-bookmark'></a>";
                        } else {
                            echo "<a href='favoritar.php?fav=false&id_recurso=" . $recurso->getId() . "&id_usuario=" . $codigo . "'class='btn p-0 card-flag bi-bookmark-fill'></a>";
                        }
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
        <section id="comentarios">
            <?php $comentarios = $recurso->PuxarComentarios(); ?>
            <h2 class="text-primary">Comentários<small class='float-end text-body-secondary h6'>
                    <?php if (!empty($comentarios)) {
                        echo $comentarios[0]->nmrComentarios . " comentario(s)";
                    } else {
                        echo "0 comentarios";
                    } ?>
                </small></h2>
            <?php
            if ($codigo != 0) {
                echo
                "<!-- Digite o comentário -->
                    <form action='recurso.php?id_recurso=$id_recurso' method='post' class='bg-light p-3 my-5 rounded d-flex align-items-center shadow'>
                        <textarea id='input-comentario' class='form-control' name='comentario' placeholder='Digite seu comentário...'></textarea>
                        <button type='submit' class='submit ms-2 rounded-circle bg-primary p-2'><i class='bi bi-send text-light'></i></button>
                    </form>
                    <!-- Fim do input -->";
            }
            ?>

            <?php
            if (is_array($comentarios)) {
                if ($codigo != 0) {
                    foreach ($comentarios as $comentario) {
                        echo
                        "<div class='comentario bg-light px-2 py-4 rounded shadow my-5 d-flex'>
                                <a>
                                    <img src='{$comentario->img}' alt='Foto do usuário' class='mx-1 border border-2 rounded-circle fotoUsuario'>
                                </a>
                                <article class='mx-2 ps-3'>
                                    <a href='perfil.php?user={$comentario->id_usuario}' class='h4'>{$comentario->nomeUsuario}</a><span class='float-end'>{$comentario->data}<a href='denunciar_comentario.php?id_comentario={$comentario->codigo}&id_usuario={$codigo}&id_recurso={$_GET['id_recurso']}' class='btn btn-primary ms-3'>Denunciar</a></span>
                                    <p class='mt-3'>
                                        {$comentario->comentario}
                                    </p>
                                </article>
                            </div>";
                        // Fim do comentario
                    }
                } else {
                    foreach ($comentarios as $comentario) {
                        echo
                        "<div class='comentario bg-light px-2 py-4 rounded shadow my-5 d-flex'>
                                <a>
                                    <img src='{$comentario->img}' alt='Foto do usuário' class='mx-1 border border-2 rounded-circle fotoUsuario'>
                                </a>
                                <article class='mx-2 ps-3'>
                                    <a href='perfil.php?user={$comentario->id_usuario}' class='h4'>{$comentario->nomeUsuario}</a>
                                    <p class='mt-3'>
                                        {$comentario->comentario}
                                    </p>
                                </article>
                            </div>";
                        // Fim do comentario
                    }
                }
            }
            ?>
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