<?php
if (!isset($_SESSION)) session_start();
require_once("Back-end/class/recursosRequire.php");
require_once("Back-end/class/paRequire.php");
if (!empty($_GET)) {
    $recurso = new Recursos();
    $pa = new PA(titulo: $_GET['search']);
    $codigo = isset($_SESSION["id_usuario"]) ? $_SESSION["id_usuario"] : 0;
    $pesquisa = $_GET['search'];
    $retornoPesquisa = $recurso->PesquisarRecurso($codigo, $pesquisa);
    $retornoPa = $pa->PesquisarPA();
}

?>

<!doctype html>
<html lang="pt-br">

<head>
    <title>REduc - Explorar</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- Scripts do REduc -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script defer type="module" src="assets/js/componentes.js"></script>
    <script defer src="assets/js/func.js"></script>
</head>

<body>
<header id='reduc-header'></header>
<main>
    <div class='container p-4'>
        <div class='pesquisar'>
            <form action='explorar.php' method='get' class="d-flex my-2 my-lg-0">
                <input name='search' class="form-control" type="text" placeholder="Digite o que procura...">
                <button class="btn btn-search" type="submit" id="exp-btn-pesq"><i class="bi bi-search"></i></button>
                <button class="btn btn-primary mx-3" type="button" data-bs-toggle="modal" data-bs-target="#modalId"><i
                            class="bi bi-funnel-fill"></i>Filtrar
                </button>
            </form>
        </div>

        <!-- Modal Body -->
        <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
        <div class="modal fade" id="modalId" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
             role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">Filtrar por:</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="#" method="post" id="filtro">
                            <input type="checkbox" class="form-check-input">
                            <label class="form-check-label">Recursos</label><br>

                            <input type="checkbox" class="form-check-input">
                            <label class="form-check-label">Práticas avaliativas</label><br>

                            <input type="checkbox" class="form-check-input">
                            <label class="form-check-label">Perfis</label><br>

                            <hr>

                            <h6>Datas:</h6>

                            <input type="radio" name="data" class="form-check-input">
                            <label class="form-check-label">Todas</label><br>

                            <input type="radio" name="data" class="form-check-input">
                            <label class="form-check-label">Mais recentes</label><br>

                            <input type="radio" name="data" class="form-check-input">
                            <label class="form-check-label">Mais antigos</label><br>

                            <hr>

                            <input type="checkbox" name="curso" class="form-check-input in-check" onclick="checado()">
                            <label class="form-check-label">Curso</label><br>
                            <input type="text" class="in-text form-control my-1 d-none"
                                   placeholder="Digite o nome do curso..." disabled>

                            <input type="checkbox" name="disc" class="form-check-input in-check" onclick="checado()">
                            <label class="form-check-label">Disciplina</label><br>
                            <input type="text" class="in-text form-control my-1 d-none"
                                   placeholder="Digite o nome do curso..." disabled>

                            <input type="checkbox" name="ac" class="form-check-input in-check" onclick="checado()">
                            <label class="form-check-label">Área do conhecimento</label><br>
                            <select class="in-text form-select my-1 d-none" disabled>
                                <option selected>Selecione uma opção...</option>
                                <option value="exatas">Ciências exatas e da Terra</option>
                                <option value="biologicas">Ciências biológicas</option>
                                <option value="engenharia">Engenharia/Tecnologia</option>
                                <option value="saude">Ciências da saúde</option>
                                <option value="agrarias">Ciências agrárias</option>
                                <option value="sociais">Ciências sociais</option>
                                <option value="humanas">Ciências humanas</option>
                                <option value="linguistica">Linguística</option>
                                <option value="letras">Letras e artes</option>
                            </select>

                            <input type="checkbox" name="fermt" class="form-check-input in-check" onclick="checado()">
                            <label class="form-check-label">Ferramentas</label><br>
                            <input type="text" class="in-text form-control my-1 d-none"
                                   placeholder="Digite o nome do curso..." disabled>

                            <hr>

                            <input type="checkbox" class="form-check-input">
                            <label class="form-check-label">Vídeo</label><br>

                            <input type="checkbox" class="form-check-input">
                            <label class="form-check-label">Artigo</label><br>

                            <hr>

                            <!-- Botões de ação -->
                            <input type="reset" class="btn btn-danger" value="Limpar filtros">
                            <button type="button" class="btn btn-success mx-1">Filtrar</button>
                        </form>
                        <!-- <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button> -->
                    </div>

                </div>
            </div>
        </div>

        <div class="container mt-4">
            <h2 class='txt-roxo mb-4'>Recursos</h2>
            <div id='explorar' class="row g-1" data-container="">
                <?php

                if (!empty($_GET['search'])) {
                    if (is_array($retornoPesquisa)) {
                        foreach ($retornoPesquisa as $dado) {
                            echo "
                                <div class='col-lg-3'>
                                <div class='p-1'>
                                    <a href='recurso.php?id_recurso={$dado->codigo}' class='card link-reset shadow' data-codigo='{$dado->codigo}'>
                                    <img src='{$dado->img}' class='card-img-top' alt='Imagem da pratica'>
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

                } else {
                    require_once("Back-end/class/recursosRequire.php");
                    $recurso = new Recursos();
                    $codigo = isset($_SESSION["id_usuario"]) ? $_SESSION["id_usuario"] : 0;
                    $recursos = $recurso->recursosTodos($codigo);

                    if (is_array($recursos)) {
                        foreach ($recursos as $dado) {
                            echo "
                                <div class='col-lg-3'>
                                <div class='p-1'>
                                    <a href='recurso.php?id_recurso={$dado->codigo}' class='card link-reset shadow' data-codigo='{$dado->codigo}'>
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
                }
                ?>
            </div>

        </div>
        <br>
        <h2 class='txt-roxo mb-4'>Praticas Avaliativas</h2>
        <div id='explorar' class="row g-1" data-container="">
            <?php

            if (!empty($_GET)) {
                if (is_array($retornoPa)) {
                    foreach ($retornoPa as $dado) {
                        echo "
                                <div class='col-lg-3'>
                                <div class='p-1'>
                                    <a href='PA.php?id_pa={$dado->codigo}' class='card link-reset shadow' data-codigo='{$dado->codigo}'>
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
                            <div class='card-body'>
                                <h4 class='card-title'>{$dado->tipo}</h4>
                            </div>
                                    </a>
                                </div>
                                </div>
                            ";
                    }
                }
            } else {
                $pa = new PA();
                $retornoPa = $pa->PaTodos();

                if (is_array($retornoPa)) {
                    foreach ($retornoPa as $dado) {
                        echo "
                                    <div class='col-lg-3'>
                                    <div class='p-1'>
                                        <a href='PA.php?id_pa={$dado->codigo}' class='card link-reset shadow' data-codigo='{$dado->codigo}'>
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
                                <div class='card-body'>
                                    <h4 class='card-title'>{$dado->tipo}</h4>
                                </div>
                                        </a>
                                    </div>
                                    </div>
                                ";
                    }
                }
            }
            ?>
        </div>

    </div>

    </div>
</main>
<footer id="reduc-footer"></footer>
<script src="assets/js/explorar.js"></script>
<!-- Bootstrap JavaScript Libraries -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"></script>
<script src="assets/js/card.js"></script>
</body>

</html>