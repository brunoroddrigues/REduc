/*                || src || string || int || bool ||                   */
// function criarCard(codigo = 1, imagem, titulo, estrelas, salvo){
//     const CARD_CONTAINER = document.querySelector('[data-container]');

//     let divCol = document.createElement("div");
//     divCol.setAttribute("class", "col-lg-3");

//     let divP = document.createElement("div");
//     divP.setAttribute("class", "p-1");

//     let cardA = document.createElement("a");
//     cardA.setAttribute("class", "card link-reset shadow");
//     cardA.setAttribute("href", "recurso.php?");
//     cardA.setAttribute("data-codigo", codigo);

//     let cardImg = document.createElement("img");
//     cardImg.setAttribute("class", "card-img-top");
//     let src = (imagem !== null) ? imagem : "img/img-padrao.jpg";
//     cardImg.setAttribute("src", src);
//     cardImg.setAttribute("alt", "Imagem do recurso");

//     let divBody = document.createElement("div");
//     divBody.setAttribute("class", "card-body");

//     let h4 = document.createElement("h4");
//     h4.setAttribute("class", "card-title");
//     h4.appendChild(document.createTextNode(titulo));

//     let span = document.createElement("span");
//     span.setAttribute("class", "card-star");
//     let nota = [];
//     let i = 0;
//     for(i = 0; i < 5; i++){
//         nota[i] = document.createElement("i");
//         nota[i].setAttribute("class", "bi bi-star mx-1");
//     }
//     for(i = 0; i < estrelas; i++){
//         nota[i].classList.remove("bi-star");
//         nota[i].classList.add("-");
//     }
//     for(i = 0; i < 5; i++){
//         span.appendChild(nota[i]);
//     }

//     let button = document.createElement("button");
//     button.setAttribute("onclick", "favorito(event, this)");
//     if(salvo == 0) {
//         button.setAttribute("class", "btn p-0 card-flag bi-bookmark");
//     } else {
//         button.setAttribute("class", "btn p-0 card-flag bi-bookmark-fill");
//     }

//     divBody.appendChild(h4);
//     divBody.appendChild(span);
//     divBody.appendChild(button);

//     cardA.appendChild(cardImg);
//     cardA.appendChild(divBody);

//     divP.appendChild(cardA);

//     divCol.appendChild(divP);

//     CARD_CONTAINER.appendChild(divCol);
// }

// function criarCards(){
//     $.ajax({
//         url: "card-data.php",
//         type: "post",
//         dataType: "json",
//         data: {
//             quantidade: document.querySelector('[data-container]').dataset.container
//         },
//         success: (resposta)=>{
//             if(resposta && resposta.length > 0){
//                 resposta.forEach(recurso => {
//                     criarCard(recurso.codigo, recurso.img, recurso.titulo, recurso.nota, recurso.favorito);
//                 });
//             }
//         },
//         error: (xhr, status, error) => {
//             console.log("Não foi possível realizar a operação!");
//             console.log("Erro: " + error);
//             console.log("Status: " + status);
//             console.log("XHR: " + xhr);
//         }
//     })
// }

// criarCards();

function favorito(event, elemento, logado) {
    event.preventDefault();
    if (logado == 0) {
        event.preventDefault();
        alert("Você só pode favoritar um post quando estiver logado!");
    } else {
        var salvo;
        if (elemento.classList.contains("bi-bookmark-fill")) {
            elemento.classList.remove("bi-bookmark-fill");
            elemento.classList.add("bi-bookmark");
            salvo = false;
            console.log("Salvo");
        } else {
            elemento.classList.remove("bi-bookmark")
            elemento.classList.add("bi-bookmark-fill")
            salvo = true;
            console.log("Não salvo");
        }

        $.ajax({
            url: "",
            type: "post",
            data: {
                id_recurso: elemento.parentNode.parentNode.dataset.codigo,
                salvar: salvo
            },
            error: () => {
                alert("Ocorreu um erro inesperado e não foi possível realizar a operação!");
            }
        })
    }
}