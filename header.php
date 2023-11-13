<header>
    <nav class="navbar navbar-dark navbar-expand-lg">

      <div class="container">

        <a href="index.php" class="navbarbrand d-flex align-items-center">
          <img src="img/logo.svg" alt="Logo REduc">
          <span class="marca link-header">REduc</span>
        </a>

        <button class="navbar-toggler d-lg-none" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div id="collapsibleNavId" class="collapse navbar-collapse justify-content-between">

          <form action="#" method="post" class="container d-flex" id="header-form">

            <input type="text" placeholder="Digite o que procura..." class="form-control">

            <button type="submit" class="btn btn-search">
              <i class="bi bi-search"></i>
            </button>

          </form>

          <ul class="navbar-nav mt-2 mt-lg-0">

            <li class="nav-item mx-2">
              
              <a href="#sobre" class="nav-link txt-branco link-header">Sobre</a>

            </li>

            <li class="nav-item mx-2">
              
              <a href="explorar.php" class="nav-link txt-branco link-header">Explorar</a>

            </li>

            <?php

              if(!empty($_SESSION)){
                echo '
                  <li class="nav-item mx-2">
                    <a href="login.php" class="nav-link btn btn-outline-light txt-branco">Entrar</a>
                  </li>
                ';
                echo '
                  <li class="nav-item mx-2">
                    <a href="cadastrar.php" class="nav-link btn btn-outline-light txt-braco">Cadastrar</a>
                  </li>
                ';
              } else {
                echo '
                  <li class="nav-item mx-2">
                    <a href="post-recurso.php" class="nav-link btn btn-outline-light txt-branco" id="publicar">+ Publicar</a>
                  </li>
                  <li class="nav-item mx-2"  id="perfil-img" onclick="mostrarMenu()">
                    <img class="rounded-circle border border-light border-2 src="img/imgUsers/foto-perfil.avif">
                    <i class="bi bi-caret-down-fill"></i>
                  </li>
                  </ul>
                  <ul class="navbar-nav d-none" id="perfil-adm-sair">
                    <li class="nav-item mx-2">
                      <a href="meuPerfil.php" class="nav-item txt-branco link-header">
                        <i class="bi bi-person-circle"></i> Perfil
                      </a>
                    </li>';
                if($_SESSION['categoria'] == "administrador"){
                  echo '
                    <li class="nav-item mx-2">
                      <a href="adm.php" class="nav-item txt-branco link-header">
                        <i class="bi bi-clipboard-data"></i> Painel do ADM
                      </a>
                    </li>';
                }
                echo '
                  <li class="nav-item mx-2">
                    <a href="logout.php" class="nav-link txt-branco link-header">
                      <i class="bi bi-box-arrow-right"></i> Sair
                    </a>
                  </li>
                  </ul>
                  ';
              }

            ?>

          

        </div>

      </div>
    </nav>
</header>