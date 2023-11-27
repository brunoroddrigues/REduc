const form = document.querySelector("#form");

function validar(event) {
    const erros = document.getElementsByClassName("erro");
    let erro = false;
    if(form.titulo.value == "") {
        erro = true;
        erros[0].innerHTML = "Insira um título para o recurso!";
    }
    if(form.descritivo.value == "") {
        erro = true;
        erros[1].innerHTML = "Insira uma descrição para o recurso!";
    }
    if(form.file_recurso.value == "") {
        erro = true;
        erros[2].innerHTML = "É necessário um arquivo para o recurso!";
    }
    if(erro) {
        event.preventDefault();
    }
}