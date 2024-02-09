export function criarHeader(login, perfil, categoria) {

    if (perfil == null) {
        perfil = "img/imgUsers/foto-perfil.avif";
    }

    const HEADER = document.getElementById("reduc-header");

    let nav = document.createElement("nav");
    nav.setAttribute("class", "navbar navbar-dark navbar-expand-lg");

    let divContainer = document.createElement("div");
    divContainer.setAttribute("class", "container");

    let linkImg = document.createElement("a");
    linkImg.setAttribute("class", "navbar-brand d-flex align-items-center");
    linkImg.setAttribute("href", "index.php");

    let img = document.createElement("img");
    img.setAttribute("src", "img/logo.svg");
    img.setAttribute("alt", "Logo REduc");

    let marca = document.createElement("span");
    marca.setAttribute("class", "marca link-header");
    marca.appendChild(document.createTextNode("REduc"));

    let mbutton = document.createElement("button");
    mbutton.setAttribute("class", "navbar-toggler d-lg-none");
    mbutton.setAttribute("data-bs-toggle", "collapse");
    mbutton.setAttribute("data-bs-target", "#collapsibleNavId");

    let mspan = document.createElement("span");
    mspan.setAttribute("class", "navbar-toggler-icon");
    mbutton.appendChild(mspan);

    let div1 = document.createElement("div");
    div1.setAttribute(
        "class",
        "collapse navbar-collapse justify-content-between"
    );
    div1.setAttribute("id", "collapsibleNavId");

    let hform = document.createElement("form");
    // Lembrar de adicionar os action no formulario
    hform.setAttribute("action", "explorar.php");
    hform.setAttribute("method", "get");
    hform.setAttribute("class", "container d-flex");
    hform.setAttribute("id", "header-form");

    let input = document.createElement("input");
    input.setAttribute("type", "text");
    input.setAttribute("placeholder", "Digite o que procura...");
    input.setAttribute("class", "form-control");
    input.setAttribute("name", "search");

    let sbutton = document.createElement("button");
    sbutton.setAttribute("type", "submit");
    sbutton.setAttribute("class", "btn btn-search");

    let icon = document.createElement("i");
    icon.setAttribute("class", "bi bi-search");
    sbutton.appendChild(icon);

    let ul = document.createElement("ul");
    ul.setAttribute("class", "navbar-nav mt-2 mt-lg-0");
    let li = [];
    for (let i = 0; i < 4; i++) {
        li[i] = document.createElement("li");
        li[i].setAttribute("class", "nav-item mx-2");
    }

    let aSobre = document.createElement("a");
    aSobre.setAttribute("class", "nav-link txt-branco link-header");
    aSobre.setAttribute("href", "index.php#sobre");
    aSobre.appendChild(document.createTextNode("Sobre"));

    let aExplorar = document.createElement("a");
    aExplorar.setAttribute("class", "nav-link txt-branco link-header");
    aExplorar.setAttribute("href", "explorar.php");
    aExplorar.appendChild(document.createTextNode("Explorar"));

    let a1 = document.createElement("a");
    let a2 = document.createElement("a");
    if (!login) {
        a1.setAttribute("href", "cadastro.php");
        a1.setAttribute("class", "nav-link btn btn-outline-light txt-branco");
        a1.appendChild(document.createTextNode("Cadastrar"));
        a2.setAttribute("href", "login.php");
        a2.setAttribute("class", "nav-link btn btn-outline-light txt-branco");
        a2.appendChild(document.createTextNode("Entrar"));
        li[3].appendChild(a2);
    } else {
        a1.setAttribute("href", "post_recurso.php");
        a1.setAttribute("class", "nav-link btn btn-outline-light txt-branco");
        a1.setAttribute("id", "publicar");
        a1.appendChild(document.createTextNode("+Recurso"));

        if (categoria == 2 || categoria == 3) {
            var li_pa = document.createElement("li")
            var pa = document.createElement("a")
            pa.setAttribute("class", "nav-link btn btn-outline-light txt-branco")
            pa.setAttribute("id", "Ppa")
            pa.setAttribute("href", "post_pa.php") // !Muda aqui
            pa.appendChild(document.createTextNode("+PA"))
            li_pa.appendChild(pa)
        }

        li[3].setAttribute("id", "header-perfil");
        li[3].setAttribute("onclick", "mostrarMenu()")
        let perfilImg = document.createElement("img");
        perfilImg.setAttribute(
            "class",
            "rounded-circle border border-light border-2"
        );
        perfilImg.setAttribute("src", perfil);
        perfilImg.setAttribute("id", "perfilImg");
        let down = document.createElement("i");
        down.setAttribute("class", "bi bi-caret-down-fill text-light");
        li[3].appendChild(perfilImg);
        li[3].appendChild(down);
        var login_ul = document.createElement("ul");
        login_ul.setAttribute("class", "navbar-nav d-none");
        login_ul.setAttribute("id", "perfil-adm-sair");
        var links = [];
        var id_categoria = categoria == 3 ? 3 : 2;
        for (let i = 0; i < id_categoria; i++) {
            links[i] = document.createElement("li");
            links[i].setAttribute("class", "nav-item mx-2");
        }

        // Icone perfil
        let icon_perfil = document.createElement("i");
        icon_perfil.setAttribute("class", "bi bi-person-circle");
        //

        // Icone painel adm
        if (categoria == 3) {
            // icone
            var icon_adm = document.createElement("i");
            icon_adm.setAttribute("class", "bi bi-clipboard-data");

            // link
            var link_adm = document.createElement("a");
            link_adm.setAttribute("class", "nav-link txt-branco link-header");
            link_adm.setAttribute("href", "adm.php");

            link_adm.appendChild(icon_adm);
            link_adm.appendChild(document.createTextNode("Painel do ADM"));
        }

        // Icone sair
        let icon_sair = document.createElement("i");
        icon_sair.setAttribute("class", "bi bi-box-arrow-right");

        let link_perfil = document.createElement("a");
        link_perfil.setAttribute("class", "nav-link txt-branco link-header");
        link_perfil.setAttribute("href", "meuPerfil.php");


        let link_sair = document.createElement("a");
        link_sair.setAttribute("class", "nav-link txt-branco link-header");
        link_sair.setAttribute("href", "logout.php");

        link_perfil.appendChild(icon_perfil);
        link_perfil.appendChild(document.createTextNode("Perfil"));

        link_sair.appendChild(icon_sair);
        link_sair.appendChild(document.createTextNode("Sair"));

        links[0].appendChild(link_perfil);
        if (categoria == 3) {
            links[1].appendChild(link_adm);
            links[2].appendChild(link_sair);
        } else {
            links[1].appendChild(link_sair);
        }

        for (let i = 0; i < id_categoria; i++) {
            login_ul.appendChild(links[i]);
        }
    }

    // Inserir os elementos nos containers

    li[0].appendChild(aSobre);
    li[1].appendChild(aExplorar);
    li[2].appendChild(a1);

    ul.appendChild(li[0])
    ul.appendChild(li[1])
    ul.appendChild(li[2])

    if (categoria == 2 || categoria == 3) {
        ul.appendChild(li_pa)
        ul.appendChild(li[3])
    } else {
        ul.appendChild(li[3])
    }

    hform.appendChild(input);
    hform.appendChild(sbutton);

    div1.appendChild(hform);
    div1.appendChild(ul);
    if (login) {
        div1.appendChild(login_ul);
    }

    linkImg.appendChild(img);
    linkImg.appendChild(marca);

    divContainer.appendChild(linkImg);
    divContainer.appendChild(mbutton);
    divContainer.appendChild(div1);

    nav.appendChild(divContainer);

    HEADER.appendChild(nav);

}

function mostrarMenu() {
    if (window.innerWidth >= 992) {
        let menu = document.getElementById("perfil-adm-sair");
        menu.classList.toggle("d-none");
    }
}