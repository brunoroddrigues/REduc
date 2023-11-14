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
    <link rel="stylesheet" href="assets/css/explorar.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- Scripts do REduc -->
    <script defer src='assets/js/card.js'></script>
    <script defer src="assets/js/func.js"></script>
    <script defer type="module" src="assets/js/componentes.js"></script>

</head>

<body>
  <header id='reduc-header'></header>
    <main>
        <div class='container p-4'>
            <div class='pesquisar'>
                <form class="d-flex my-2 my-lg-0">
                    <input class="form-control" type="text" placeholder="Digite o que procura...">
                    <button class="btn btn-search" type="submit" id="exp-btn-pesq"><i class="bi bi-search"></i></button>
                    <button class="btn btn-primary mx-3" type="button" data-bs-toggle="modal" data-bs-target="#modalId"><i class="bi bi-funnel-fill"></i>Filtrar</button>
                </form>
            </div>

            <!-- Modal Body -->
            <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
            <div class="modal fade" id="modalId" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
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
                                <input type="text" class="in-text form-control my-1 d-none" placeholder="Digite o nome do curso..." disabled>

                                <input type="checkbox" name="disc" class="form-check-input in-check" onclick="checado()">
                                <label class="form-check-label">Disciplina</label><br>
                                <input type="text" class="in-text form-control my-1 d-none" placeholder="Digite o nome do curso..." disabled>

                                <input type="checkbox" name="ac" class="form-check-input in-check" onclick="checado()">
                                <label class="form-check-label">Área do conhecimento</label><br>
                                <select class="in-text form-select my-1 d-none" disabled>
                                    <option selected>Selecione uma opção...</option>
                                </select>

                                <input type="checkbox" name="fermt" class="form-check-input in-check" onclick="checado()">
                                <label class="form-check-label">Ferramentas</label><br>
                                <input type="text" class="in-text form-control my-1 d-none" placeholder="Digite o nome do curso..." disabled>

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

                <div id='explorar' class="row g-1">

                </div>

            </div>

        </div>
    </main>
    <footer id="reduc-footer"></footer>
    <script src="assets/js/explorar.js"></script>
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