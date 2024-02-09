<?php
if (!isset($_SESSION)) session_start();

if (!$_SESSION['id_usuario']) {
    header('location:index.php');
    die();
} else {
    require_once "Back-end/class/usersRequire.php";
    require_once("Back-end/class/paRequire.php");
    $usuario = new Usuario(id_usuario: $_SESSION['id_usuario']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    var_dump($_POST);

    $link = $_POST['link_rede'];
    $tipo = $_POST['tipo_rede'];
    $adicionar_rede = new RedeSocial(id_redesocial: $tipo, link: $link);
    $adicionar_rede->AdicionarRedeSocial($_SESSION['id_usuario']);

    // Apague os dados do $_POST
    unset($_POST);

    // Redirecione para a mesma página
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}
?>

<!doctype html>
<html lang="pt-br">

<head>
    <title>REduc - Perfil</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/perfil.css">
    <link rel="stylesheet" href="assets/css/meuPerfil.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script defer src="assets/js/func.js"></script>
    <script defer src="assets/js/validacoes.js"></script>
    <script defer type="module" src="assets/js/componentes.js"></script>
</head>

<body>
<header id='reduc-header'></header>
<main class='container'>
    <section id="perfil" class="rounded shadow my-5 p-4">
        <figure id="perfil-foto">
            <img src=
                 <?php
                 $dados = $usuario->BuscarPerfilUsuario();
                 echo $dados[0]->img_path;
                 ?> alt="foto de perfil" class='shadow'>
        </figure>
        <article id="perfil-dados">
            <h2 class='h2 text-light'><?php echo $_SESSION['username']; ?></h2>
            <h3 class='h3 text-light'>
                <?php
                $categoria = new CategoriaUsuario(id_categoria: $_SESSION['categoria']);
                $resultado = $categoria->BuscarCategoria();

                echo $resultado[0]->descritivo;
                ?>
            </h3>
            <p class="text-light">
                <?php
                if (!$dados[0]->descricao) {
                    echo "Vá até configurações para adicionar um bio no seu perfil!";
                }
                echo $dados[0]->descricao;
                ?>
            </p>
        </article>
        <div id='perfil-links'>
            <ul>
                <?php
                $nmrRedes = $usuario->BuscarNumeroRedeSociasUsuario();
                if ($nmrRedes[0]->RedesDisponiveis > 0) {
                    echo "<li data-bs-toggle='modal' data-bs-target='#modalId'  >
                    <i class='bi bi-plus-circle-fill'></i>
                    </li>";
                }
                ?>
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
            <a href="config.php" class='btn btn-outline-light'>
                <i class="bi bi-gear-fill"></i>
                Configurações
            </a>
        </div>
    </section>
    <!-- Modal Body -->
    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
    <div class="modal fade" id="modalId" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">Adicionar rede social</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" method="post" id='form_redesocial'>
                    <div class="modal-body">
                        <label>Insira a rede social:</label><br>
                        <select class='form-select' name='tipo_rede'>
                            <option selected>Escolha qual a rede social...</option>
                            <?php
                            $tipos = $usuario->RedeSocialDisponivel();
                            if (is_array($tipos)) {
                                foreach ($tipos as $dado) {
                                    echo "<option value='{$dado->id_redesocial}'>{$dado->descritivo}</option>";
                                }
                            }
                            ?>
                        </select>
                        <br>
                        <label>Insira o link da rede social:</label><br>
                        <input type='text' name='link_rede' placeholder='Insira o link' class='form-control'>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                        <input type="submit" class="btn btn-success" value="Salvar" onclick="ValidarFormRedesocial()">
                    </div>
            </div>
            </form>
        </div>
    </div>
    </div>
    <section id='meus-recursos' class='container bg-light rounded shadow mb-5 mt-5 p-5 d-flex flex-column'>
        <h2 class='txt-roxo mb-4'>Recursos postados</h2>
        <div class='row g-2'>
            <?php
            $codigo = isset($_SESSION["id_usuario"]) ? $_SESSION["id_usuario"] : 0;
            $recursos = $usuario->BuscarMeusRecursos();

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

    <section id='recursos-salvos' class='container bg-light rounded shadow mb-5 mt-5 p-5 d-flex flex-column'>
        <h2 class='txt-roxo mb-4'>Recursos salvos</h2>
        <div class='row g-2'>
            <?php
            $codigo = isset($_SESSION["id_usuario"]) ? $_SESSION["id_usuario"] : 0;
            $recursos = $usuario->BuscarRecursosSalvos();

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
    <?php
    require_once("Back-end/functions/func_conexao.php");
    $sql = "SELECT id_categoriaUsuario 'categoria'
              FROM users u 
              WHERE id_usuario = ?";
    $categoria = $conn->prepare($sql);
    $categoria->bindValue(1, $_SESSION['id_usuario']);
    $categoria->execute();
    $resposta = $categoria->fetchAll(PDO::FETCH_OBJ);
    if ($resposta != 1) {
        $retorno = $usuario->BuscarMinhasPa();
        echo
        "<section id='minhas-pa' class='container bg-light rounded shadow mb-5 mt-5 p-5 d-flex flex-column'>
        <h2 class='txt-roxo mb-4'>Praticas Avaliativas</h2>
        <div class='row g-2'>";
        if (is_array($retorno)) {
            foreach ($retorno as $dado) {
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
                echo "</div>
                  </a>
                </div>
              </div>
            ";
            }
        }
        echo
        " </div>
          <a href='explorar.php' class='btn btn-primary mt-4 align-self-center shadow'>Ver mais &#10095;</a>
        </section>";

    }
    ?>
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