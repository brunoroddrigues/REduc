<?php
    if(!isset($_SESSION)) session_start();

    if($_SESSION["categoria"] != 3) {
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
</style>
<title>Document</title>
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
                            <a class="nav-link active tab-link" data-bs-toggle="tab" data-bs-target="#ted" role="tab">TED</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link tab-link" data-bs-toggle="tab" data-bs-target="#pa" role="tab">PA</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link tab-link" data-bs-toggle="tab" data-bs-target="#comen" role="tab">Comentarios</a>
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
                require_once("Back-end/class/conexao/Conexao.class.php");
                require_once("Back-end/class/recursos/Recursos.class.php");

                $recursos = new Recursos();
                $dados = $recursos->buscarRecursosNaoPostados();

                if(is_array(($dados))) {
                    foreach($dados as $dado) {
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
                                    <a href='' class='btn btn-primary'>Visualizar</a>
                                    <a href='aprovar_recurso.php?id_recurso={$dado->codigo}' class='btn btn-success'>Aprovar</a>
                                    <a href='' class='btn btn-danger'>Reprovar</a>
                                </div>
                                <div class='card-footer'>
                                    Postado em: {$dado->cadastro}
                                </div>
                            </div>
                        ";
                    }
                }
            ?>

            <!-- Conteudo para Provação TED -->

            <!-- <div class="card m-4">
                <div class="card-header text-light   d-flex" style=" background-color: #131267;">

                    <h5>
                        Java Scrip Basico
                        <!-- Titulo Da TED 
                    </h5>

                </div>
                <div class="card-body">
                    <h6 class="card-subtitle mb-2 fw-bold">
                        <p>
                            Derek Nunes
                            <!-- Nick Do Usuario 
                        </p>
                    </h6>
                    <p class="m-3 card-text ">
                    <h6 class="fw-bold">Descrição:</h6>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem similique cumque dolores debitis
                    quidem ratione illo! Officia cum quam rerum, esse qui nostrum id natus? Soluta officia labore enim
                    optio?
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptates inventore blanditiis est ad
                    consequatur tenetur pariatur nisi. Sunt, consequatur itaque, eaque, dolorem error iusto praesentium
                    quas magnam maiores optio perferendis.
                    </p>
                    <div class=" d-flex justify-content-end">
                        <div class="row">
                            <div class="col-lg-3">
                                <button class="btn btn-primary m-2 ">Vizualizar</button>
                            </div>
                            <div class="col-lg-3">
                                <button class="btn btn-success m-2 ">Aprovado</button>
                            </div>
                            <div class="col-lg-3">
                                <button class="btn btn-danger m-2">Reprovado</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent ">
                    Postado em 20/04/2023
                </div>

            </div>

            <!-- Fim Do Conteudo TED-->

        </div>
        <div class="tab-pane fade" id="pa">
                Em densevolvimento
        </div>
        <div class=" tab-pane fade " id=" comen">
            
            <!-- Denuncia De Comentario -->

            <div class=" card m-4">
            <div class="card-header text-light  d-flex" style=" background-color: #131267;">
                <i class="bi bi-person-circle" style="font-size: 50px;"></i>
                <p class=" mt-4 ms-3 fw-bold ">
                    Pedro Henrique
                </p>

            </div>
            <div>
                <p class="m-3">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem similique cumque dolores debitis
                    quidem ratione illo! Officia cum quam rerum, esse qui nostrum id natus? Soluta officia labore enim
                    optio?
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptates inventore blanditiis est ad
                    consequatur tenetur pariatur nisi. Sunt, consequatur itaque, eaque, dolorem error iusto praesentium
                    quas magnam maiores optio perferendis.
                </p>
                <div class=" d-flex justify-content-end">
                    <button class="btn btn-success m-2 ">Aprovado</button>

                    <button class="btn btn-danger m-2">Reprovado</button>
                </div>
            </div>
            <div class="card-footer bg-transparent ">
                Postado em 20/04/2023
            </div>

        </div>

        <!-- Fim Dos Comentario -->

    </div>
    <div class=" tab-pane fade" id="usua">

        <!-- Banir Usuario -->

        <div class="row">
            <div class="col-lg-6">
                <div class="card m-4">
                    <!-- Usuario -->
                    <div class="card-header text-light  d-flex" style=" background-color: #131267;">
                        <i class="bi bi-person-circle" style="font-size: 50px;"></i>
                        <p class=" mt-4 ms-3 fw-bold ">
                            Pedro Henrique
                        </p>

                    </div>
                    <div>
                        <ul class="list-group fw-bold">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Comentarios Banidos
                                <span class="badge bg-primary rounded-pill">14</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                TEDS Banidas
                                <span class="badge bg-primary rounded-pill">2</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                PAS Banidas
                                <span class="badge bg-primary rounded-pill">1</span>
                            </li>
                        </ul>
                        <div class=" d-flex justify-content-end">
                            <button class="btn btn-success m-2 ">Não Banir</button>

                            <button class="btn btn-danger m-2">Banir</button>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent ">
                        Postado em 20/04/2023
                    </div>
                </div><!-- Fim Do Usuario -->
            </div>
            <div class="col-lg-6">
                <!-- Usuario -->
                <div class="card m-4">
                    <div class="card-header text-light  d-flex" style=" background-color: #131267;">
                        <i class="bi bi-person-circle" style="font-size: 50px;"></i> <!-- Img de Perfil -->
                        <p class=" mt-4 ms-3 fw-bold ">
                            Pedro Henrique
                        </p>

                    </div>
                    <div>
                        <ul class="list-group fw-bold">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Comentarios Banidos
                                <span class="badge bg-primary rounded-pill">14</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                TEDS Banidas
                                <span class="badge bg-primary rounded-pill">2</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                PAS Banidas
                                <span class="badge bg-primary rounded-pill">1</span>
                            </li>
                        </ul>
                        <div class=" d-flex justify-content-end">
                            <button class="btn btn-success m-2 ">Não Banir</button>

                            <button class="btn btn-danger m-2">Banir</button>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent ">
                        Postado em 20/04/2023
                    </div>
                </div>
            </div><!-- Fim Do Usuario -->
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