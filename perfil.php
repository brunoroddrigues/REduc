<?php
if (!isset($_SESSION)) session_start();

require_once("Back-end/functions/func_conexao.php");
require_once "Back-end/class/recursosRequire.php";
require_once "Back-end/class/usersRequire.php";

$usuario = new Usuario(id_usuario: $_GET["user"]);
$visitante = isset($_SESSION["id_usuario"]) ? $_SESSION["id_usuario"] : 0;
$retorno = $usuario->VisitaUsuario($visitante);

?>

<!doctype html>
<html lang="pt-br">

<head>
    <title>REduc - Início</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/perfil.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script defer src="assets/js/func.js"></script>
    <script defer type="module" src="assets/js/componentes.js"></script>
</head>

<body>
<header id='reduc-header'></header>
<main class='container'>
    <section id="perfil" class="rounded shadow my-5 p-4">
        <figure id="perfil-foto">
            <img src="<?php echo $retorno[0]->img_path ?>" alt="foto de perfil" class='shadow'>
        </figure>
        <article id="perfil-dados">
            <h2 class='h2 text-light'><?php echo $retorno[0]->nomeUsuario ?></h2>
            <h3 class='h3 text-light'><?php echo $retorno[0]->categoria ?></h3>
            <p class="text-light">
                <?php echo $retorno[0]->descricao ?>
            </p>
        </article>
        <div id='perfil-links'>
            <ul>
                <?php
                $redesocial = $usuario->BuscarRedeSocial();

                if (is_array($redesocial) && count($redesocial) > 0) {
                    for ($x = 0; $x < count($redesocial); $x++) {
                        if ($redesocial[$x]->id_redesocial == 1) {
                            echo "<li>
                        <a href='{$redesocial[$x]->link_rede}' class='bi bi-twitter text-light'></a>
                        </li>";
                        }
                        if ($redesocial[$x]->id_redesocial == 2) {
                            echo "<li>
                        <a href='{$redesocial[$x]->link_rede}' class='bi bi-instagram text-light'></a>
                        </li>";
                        }
                        if ($redesocial[$x]->id_redesocial == 3) {
                            echo "<li>
                        <a href='{$redesocial[$x]->link_rede}' class='bi bi-github text-light'></a>
                        </li>";
                        }
                        if ($redesocial[$x]->id_redesocial == 4) {
                            echo "<li>
                        <a href='{$redesocial[$x]->link_rede}' class='bi bi-facebook text-light'></a>
                        </li>";
                        }
                        if ($redesocial[$x]->id_redesocial == 5) {
                            echo "<li>
                        <a href='{$redesocial[$x]->link_rede}' class='bi bi-linkedin text-light'></a>
                        </li>";
                        }
                    }
                }
                ?>
            </ul>
        </div>
        <div id="perfil-config">
            <?php
            if ($visitante != 0) {
                $id_usuario = $_SESSION["id_usuario"];
                $sql = "SELECT * FROM seguir WHERE id_userseguindo = ? AND id_userseguido = ?";
                $stm = $conn->prepare($sql);
                $stm->bindValue(1, $id_usuario);
                $stm->bindValue(2, $usuario->getIdUsuario());
                $stm->execute();
                $resposta = $stm->fetchAll(PDO::FETCH_OBJ);
                if (!empty($resposta)) {
                    echo
                        "<a href='unfollow_user.php?userseguido=" . $usuario->getIdUsuario() . "&userseguindo=" . $visitante . "' class='btn btn-outline-light'><i class='bi bi-person-add'></i> Seguindo</a ";
                } else {
                    echo
                        "<a href='follow_user.php?userseguido=" . $usuario->getIdUsuario() . "&userseguindo=" . $visitante . "' class='btn btn-outline-light'><i class='bi bi-person-add'></i> Seguir</a ";
                }
            }
            ?>

        </div>
    </section>

    <section id='recursos' class='container bg-light rounded shadow mb-5 mt-5 p-5 d-flex flex-column'>
        <h2 class='txt-roxo mb-4'>Recursos postados</h2>
        <div class='row g-2'>
            <?php
            $codigo = isset($_SESSION["id_usuario"]) ? $_SESSION["id_usuario"] : 0;
            $recursos = $usuario->BuscarRecursosUsuarioVisita($visitante);

            if (is_array($recursos)) {
                foreach ($recursos as $dado) {
                    echo "
                <div class='col-lg-3'>
                  <div class='p-1'>
                    <a href='recurso.php?id_recurso={$dado->codigo}' class='card link-reset shadow'>
                      <img src='{$dado->img}' class='card-img-top' alt='Imagem do recurso'>
                      <div class='card-body'>
                        <h4 class='card-title'>{$dado->titulo}</h4>
                        <span class='card-star'>";
                    for ($i = 0; $i < 5; $i++) {
                        if ($i <= ($dado->nota - 1)) {
                            echo "<i class='bi bi-star-fill'></i>";
                        } else {
                            echo "<i class='bi bi-star'></i>";
                        }
                    }
                    echo "</span>";
                    if ($codigo != 0) {
                        if ($dado->favorito != 0) {
                            echo "<button class='btn p-0 card-flag bi-bookmark-fill'></button>";
                        }
                    }
                    echo "</div>
                    </a>
                  </div>
                </div>
              ";
                }
            }
            ?>
        </div>
        <a href='explorar.php' class='btn btn-primary mt-4 align-self-center shadow'>Ver mais &#10095;</a>
    </section>

</main>
<footer id="reduc-footer"></footer>
<!-- Bootstrap JavaScript Libraries -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</body>

</html>