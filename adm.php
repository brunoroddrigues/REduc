<?php
require_once("Back-end/class/recursosRequire.php");
require_once("Back-end/class/paRequire.php");
require_once("Back-end/class/usersRequire.php");

if (!isset($_SESSION)) session_start();

if ($_SESSION["categoria"] != 3) {
    header("location: index.php");
    die();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script defer src="assets/js/func.js"></script>
    <script defer type="module" src="assets/js/componentes.js"></script>
</head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
    .navbar {
        background-color: #131267;
        color: #fff;
        padding: 0%;
    }

    .tab-link {
        padding-left: 50px;
        padding-right: 50px;
        color: #fff;
        background-color: transparent;
    }

    .nav-tabs {
        margin-top: 30px;
    }

    .tab-link:hover {
        background-color: #fff;
        color: #131267;
    }

    .card:hover {
        transform: scale(1.0);
        cursor: auto;
    }
</style>
<title>ADM</title>
</head>

<body>
<header id='reduc-header'></header>
<div>
    <nav class="navbar navbar-expand-lg">
        <div class="container p-0">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent">
                <i class="bi bi-list" style="color: white;"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <ul class="text-light nav nav-tabs fw-bold">

                    <li class="nav-item">
                        <a class="nav-link active tab-link" data-bs-toggle="tab" data-bs-target="#ted" role="tab">Recurso</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link tab-link" data-bs-toggle="tab" data-bs-target="#pa" role="tab">PA</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link tab-link" data-bs-toggle="tab" data-bs-target="#comen"
                           role="tab">Comentarios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link tab-link" data-bs-toggle="tab" data-bs-target="#usua" role="tab">Usuario</a>
                    </li>

                </ul>

            </div>
        </div>
    </nav>

</div>

<main class="container tab-content">


    <div class="tab-pane fade show active " id="ted">
        <?php

        $recursos = new Recursos();
        $dados = $recursos->buscarRecursosNaoPostados();

        if (is_array(($dados))) {
            foreach ($dados as $dado) {
                echo "
                            <div class='card m-4'>
                                <div class='card-header text-light d-flex' style='background-color: #131267;'>
                                    <h3 class='h5'>{$dado->titulo}</h3>
                                </div>
                                <div class='card-body'>
                                    <h4 class='card-subtitle mb-2 fw-bold'>{$dado->usuario}</h4>
                                    <p class='m-3 card-text'>
                                        <h4 class='fw-bold h6'>Descrição:</h4>
                                        {$dado->descricao}
                                    </p>
                                    <a href='recurso.php?id_recurso={$dado->codigo}' class='btn btn-primary'>Visualizar</a>
                                    <a href='aprovar_recurso.php?id_recurso={$dado->codigo}' class='btn btn-success'>Aprovar</a>
                                    <a href='reprovar_recurso.php?id_recurso={$dado->codigo}' class='btn btn-danger'>Reprovar</a>
                                </div>
                                <div class='card-footer'>
                                    Postado em: {$dado->cadastro}
                                </div>
                            </div>
                        ";
            }
        }
        ?>

    </div>
    <div class="tab-pane fade" id="pa">
        <?php
        $pa = new PA();
        $dados = $pa->PaNãoPostadas();
        if (is_array(($dados))) {
            foreach ($dados as $dado) {
                echo "
                            <div class='card m-4'>
                                <div class='card-header text-light d-flex' style='background-color: #131267;'>
                                    <h3 class='h5'>{$dado->titulo}</h3>
                                </div>
                                <div class='card-body'>
                                    <h4 class='card-subtitle mb-2 fw-bold'>{$dado->usuario}</h4>
                                    <p class='m-3 card-text'>
                                        <h4 class='fw-bold h6'>Descrição:</h4>
                                        {$dado->descricao}
                                    </p>
                                    <a href='PA.php?id_pa={$dado->id_pa}' class='btn btn-primary'>Visualizar</a>
                                    <a href='aprovar_pa.php?id_pa={$dado->id_pa}' class='btn btn-success'>Aprovar</a>
                                    <a href='reprovar_pa.php?id_pa={$dado->id_pa}' class='btn btn-danger'>Reprovar</a>
                                </div>
                                <div class='card-footer'>
                                    Postado em: {$dado->cadastro}
                                </div>
                            </div>
                        ";
            }
        }
        ?>
    </div>
    <div class=" tab-pane fade " id="comen">

        <!-- Denuncia De Comentario -->
        <?php
        $comentarios = new Comentario();
        $ComentariosDenunc = $comentarios->PuxarComentariosDenunciados();

        if (is_array($ComentariosDenunc)) {
            foreach ($ComentariosDenunc as $dado) {
                echo
                "<div class=' card m-4'>
                        <div class='card-header text-light  d-flex' style=' background-color: #131267;'>
                            <i class='bi bi-person-circle' style='font-size: 50px;'></i>
                            <p class=' mt-4 ms-3 fw-bold '>
                                {$dado->nomeUsuario}
                            </p>
        
                        </div>
                        <div>
                            <p class='m-3'>
                                {$dado->descritivo}
                            </p>
                            <div class=' d-flex justify-content-end'>
                                <a href='aprov_reprov_coment.php?id_comentario={$dado->id_comentario}&action=aprov' class='btn btn-success m-2 '>Aprovado</a>
        
                                <a href='aprov_reprov_coment.php?id_comentario={$dado->id_comentario}&action=reprov' class='btn btn-danger m-2'>Reprovado</a>
                            </div>
                        </div>
                        <div class='card-footer bg-transparent '>
                            {$dado->datacomentario}
                        </div>
                    </div>";
            }
        }
        ?>
    </div>

    <!-- Fim Dos Comentario -->

    </div>
    <div class=" tab-pane fade" id="usua">

        <!-- Banir Usuario -->

        <div class="row">
            <?php
            $users = new Usuario();
            $inativos = $users->usuariosInativos();

            if (is_array($inativos)) {
                foreach ($inativos as $dados) {
                    echo
                    "<div class='col-lg-6'>
                            <div class='card m-4'>
                                <div class='card-header text-light  d-flex' style='background-color: #131267;'>
                                    <i  class='bi bi-person-circle' style='font-size: 50px;'></i>
                                    <p class='mt-4 ms-3 fw-bold'>{$dados->usuario}</p>
                                </div>
                                <div>
                                    <ul class='list-group fw-bold'>
                                        <li class='list-group-item d-flex justify-content-between align-items-center'>
                                            Nome: {$dados->nome}
                                        </li>
                                        <li class='list-group-item d-flex justify-content-between align-items-center'>
                                            Sobrenome: {$dados->sobrenome}
                                        </li>
                                        <li class='list-group-item d-flex justify-content-between align-items-center'>
                                            email: {$dados->email}
                                        </li>
                                        <li class='list-group-item d-flex justify-content-between align-items-center'>
                                            Instituicao: {$dados->instituicao}
                                        </li>
                                    </ul>   
                                    <div class='d-flex justify-content-end'>
                                        <a href='aprovar_usuario.php?id_usuario={$dados->codigo}' class='btn btn-success m-2'>Aprovar</a>
                                        <a href='banir_usuario.php?id_usuario={$dados->codigo}' class='btn btn-danger m-2'>Banir</a>
                                    </div>  
                                    <div class='card-footer bg-transparent'>
                                        Cadastrado em {$dados->cadastro}
                                    </div>                           
                                </div>
                            </div>
                        </div>";
                }
            }
            ?>
        </div>
    </div>
    <!-- Fim da Aba de Banir Usuario -->
</main>

<!-- Fim do Tabs -->

<footer id="reduc-footer">

</footer>
<script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</html>