const form = document.querySelector("#form");

function validar(event) {
    const erros = document.getElementsByClassName("erro");
    let erro = false;
    if (form.titulo.value == "") {
        erro = true;
        erros[0].innerHTML = "Insira um título para o recurso!";
    }
    if (form.descritivo.value == "") {
        erro = true;
        erros[1].innerHTML = "Insira uma descrição para o recurso!";
    }
    if (form.file_recurso.value == "") {
        erro = true;
        erros[3].innerHTML = "É necessário um arquivo para o recurso!";
    }
    if (form.tipo.value == "Selecione o Tipo") {
        erro = true;
        erros[2].innerHTML = "É necessário informar o tipo de recurso!";
    }
    if (erro) {
        event.preventDefault();
    }
}

function validarPA(event) {
    const erros = document.getElementsByClassName("erro");
    let erro = false;
    if (form.titulo.value == "") {
        erro = true;
        erros[0].innerHTML = "Insira um título para o recurso!";
    } else {
        erros[0].innerHTML = "";
    }
    if (form.descritivo.value == "") {
        erro = true;
        erros[1].innerHTML = "Insira uma descrição para o recurso!";
    } else {
        erros[1].innerHTML = "";
    }
    if (form.file_pa.value == "") {
        erro = true;
        erros[3].innerHTML = "É necessário um arquivo para o recurso!";
    } else {
        erros[3].innerHTML = "";
    }
    if (form.tipo.value == "Selecione o Tipo") {
        erro = true;
        erros[2].innerHTML = "É necessário informar o tipo de recurso!";
    } else {
        erros[2].innerHTML = "";
    }
    if (erro) {
        event.preventDefault();
    }
}