function mostrarMenu() {
    if (window.innerWidth >= 992) {
        let menu = document.getElementById("perfil-adm-sair");
        menu.classList.toggle("d-none");
    }
}